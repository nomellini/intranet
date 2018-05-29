<?
/*
  Arquivo      : rnc.php
  Descrição    : Utilizado pelos gerentes, esta página cria e dá manutenção em chamados
                 especiais, os RNC. cada chamado rnc é composto de 5 contatos fixos, identificados
				 pelo campo PessoaContatada  
  Autor        : Fernando Nomellini
  Data Criação : 02/06/2003
  Atualizações : 07/06/2003  
*/
	require("../scripts/conn.php");
	require("../scripts/funcoes.php");		
	require("funcoes.php");	
	require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
        $gerente = pegaGerente($ok);		  		
//		$gerente = 1;
		if (  $ok<>$id_usuario || !$gerente) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
 
	function TemHistorico($pCampo, $chamado)
	{
		$sql = "select count(1) qtde from rnc_memory where id_chamado = $chamado and campo = '$pCampo'";
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);		
		if ($linha->qtde > 0)
		{
			echo "<a href=historico.php?Campo=$pCampo&Chamado=$chamado target='_new'>";
			echo "Abrir histórico";
			echo "</a>";			
		}
	}
	

    $disabled = "";
	
	/*
		Quem pode editar os dados de prazos e departamentos responsáveis.
	*/
    $podeEditar =  (
		($ok==12)   or    // Fernando
		($ok==3)   or    // Helio
		($ok==1)   or    // Edson	
		($ok==73)   or    // Edson Adm
		($ok == 63) or    // Débora
		($ok == 143)      // Flávia
		or ($ok == 13 )     // Leandro
		or ($ok == 141)      // Marcelo Nunes
	); 
	
	$mensagem = "";
	
	//$podeEditar = false; // Testes
	if (!$podeEditar) {
		$disabled = 'disabled="true"';
		$podeEditar = "NAO";		
		$mensagem = "<br><b>Usuário sem permissão para alterar dados de responsáveis, alterações destas informações não serão gravadas.</b>";		
	} else {
		$podeEditar = "SIM";		
	}
 
	if ( ($tipo<>SAD_NAOCONFORMIDADE) and 
	     ($tipo<>SAD_ACAOPREVENTIVA) and 
		 ($tipo<>SAD_ACAOMELHORIA) and
		 ($tipo<>SAD_ABERTURAPROJETO))
	  $tipo = SAD_NAOCONFORMIDADE;
	
	/*
	  Dentro do chamado eu pego os contatos identificados pelo campo pessoacontatada
	*/

	function pegaTipo($_chamado) {
	  $sql = "select rnc from chamado where id_chamado = $_chamado";
	  $result = mysql_query($sql);
	  $linha = mysql_fetch_object($result);
	  return $linha->historico;
	}
	
	

    $objChamado = new chamado();	
		
	if ($action=="novo") {
 	    $novo = 1;
        $datae = date("Y-m-d");
        $horae = date("H:i:s");	
				
		$objChamado = new chamado();	
		$objContato = new contato();
		$chamado = $objChamado->novoChamado($ok, 'DATAMACE', $ok);		
		$objChamado->lerChamado($chamado);			
		$objChamado->sistema_id = 1025;
		$objChamado->categoria_id = 383;
		$objChamado->prioridade_id = 1;
		$objChamado->motivo_id = 30;
		$objChamado->datauc = $datae;		
		$objChamado->horauc = $horae;			
        $objChamado->diagnostico_id = 9;
		$objChamado->externo = 0;
		$objChamado->diagnostico_id = 9;
		$objChamado->email = "";
		$objChamado->lido = 1;
		$objChamado->lidodono = 1;
		$objChamado->nomecliente = "";
		$objChamado->rnc = $tipo;
		$objChamado->datauc = $datae;
		$objChamado->horauc = $horae;
	    $objChamado->gravaChamado();			
		
		$dataa = $objChamado->dataa;		
		$horaa = $objChamado->horaa;
     	
		$data = explode("-", $dataa);			
		$rnc_acao_data = '';
		$rnc_data = "$data[2]/$data[1]/$data[0]";
	
			
		$contato = $objContato->novocontato($chamado, $ok, $ok, $dataa, $horaa);	
		$dataa = $objChamado->dataaf;	
		loga_online($ok, $REMOTE_ADDR, "Novo RNC : " . $chamado);		
	} else {
	    $novo = 0;
	    $chamado = $id_chamado;
		if ($chamado) {
            $action="editar";			
			$objChamado->lerChamado($chamado);
			$obs = $objChamado->obs;
			$descricao = $objChamado->descricao;				
			$disposicao = pegarnc($chamado, 'disposicao');
			$causa = pegarnc($chamado, 'causa');
			$acao = pegarnc($chamado, 'acao');
//			$proposta = pegarnc($chamado, 'proposta');
			$verificacao = pegarnc($chamado, 'verificacao');		
			
			$sql = "select rnc, rnc_depto_responsavel, rnc_data, rnc_prazo, ";
			$sql .= "rnc_acao_responsavel, rnc_acao_data, ";
			$sql .= "rnc_verif_responsavel, rnc_verif_data ";			
			$sql .= " from chamado where id_chamado = $chamado";
		    $result = mysql_query($sql) or die($sql);
            $linha = mysql_fetch_object($result) or die($sql);			
			
			$tipo = $linha->rnc;
			$rnc_depto = $linha->rnc_depto_responsavel;
			$data = explode("-",$linha->rnc_prazo);			
			$rnc_prazo = "$data[2]/$data[1]/$data[0]";
			$data = explode("-", $linha->rnc_data);
			$rnc_data = "$data[2]/$data[1]/$data[0]";
			$data = explode("-", $linha->rnc_acao_data);			
			$rnc_acao_data = "$data[2]/$data[1]/$data[0]";
			$data = explode("-", $linha->rnc_verif_data);						
			$rnc_verif_data = "$data[2]/$data[1]/$data[0]";
			$rnc_acao_responsavel = $linha->rnc_acao_responsavel;
			$rnc_verif_responsavel = $linha->rnc_verif_responsavel;			
			if ( ($tipo <> 1) and ($tipo<>2) and ($tipo<>3) and ($tipo<>4) )
			  $tipo = 1;
			
		} else {
		header("Location: index.php");
		}
	}	
	
	if ($tipo<>4) {
      $ldisposicao = "Ação corretiva Imediata";
	  $lverif = "Verificação Eficácia";
	  $lshow = "";
	} else {
      $ldisposicao = "Primeiro Contato";
	  $lverif = "";
	  $lshow = "display=none";
	}
?>
<html>
<script src="../coolbuttons.js"></script>
<head>
<title>Novo chamado RNC/RAP/ACM</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../scripts/stilos.css" type="text/css">
<link rel="stylesheet" href="../stilos.css" type="text/css">
<style type="text/css">
<!--
.bordafinaFonteMaior {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #003366;
	border: #CCCCCC;
	border-style: solid;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px
}
.style1 {
	font-size: 14px;
	font-weight: bold;
}
.style4 {
	font-size: 24px
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" background="../../agenda/figuras/fundo.gif" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center">
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true"><img src="../figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="../figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
      Senha</a></td>
    <td width="129" class="coolButton"><a href="../inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton"><a href="/agenda/" target="_blank">Agenda 
      Corporativa Datamace</a></td>
  </tr>
</table>
<hr size="1" noshade>
<div align="center">
  <p><br>
    <span class="style4">
    <?=GetLabelTitulo($tipo)?>
    </span><br>
  </p>
  <form action="dornc.php" method="post" name="form" id="form">
    <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
      <tr>
        <td><span class="style1">N&uacute;mero de controle :
          <?=$chamado?>
          </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?=GetLabelDescricao($tipo)?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td><textarea name="chamado" cols="120" rows="8" class="bordafinaFonteMaior" id="chamado"><?=$descricao?></textarea></td>
            </tr>
            <tr>
              <td>Departamento respons&aacute;vel pela abertura:
                <input <?=$disabled?> name="depto" type="text" class="bordaTexto" id="depto" value="<?=$rnc_depto?>" size="22" maxlength="20">
                / Data de abertura
                <input <?=$disabled?> name="rnc_data" type="text" class="bordaTexto" id="rnc_data" value="<?=$rnc_data?>" size="12" maxlength="12">
                <?=$mensagem?>
                <br></td>
            </tr>
          </table></td>
      </tr>
      <?
	    if ($tipo==1) {
	  ?>
      <tr>
        <td><a href="javascript:alterna(disposicao);">[          <?=$ldisposicao?>          ] </a> <? TemHistorico("Disposicao", $chamado); ?></td>
      </tr>
      <tr>
        <td><span id="disposicao" style="">
          <table width="100%" border="0" cellspacing="1" cellpadding="1" >
            <tr>
              <td><textarea name="disposicao" cols="120" rows="8" class="bordafinaFonteMaior" id="disposicao"><?=$disposicao?></textarea></td>
            </tr>
          </table>
          </span></td>
      </tr>
      <?
	    }
	  ?>
      <tr>
        <td><a href="javascript:alterna(causa);">
          <input name="Submit3" type="submit" class="bordaTexto" value="Gravar">
          <br>
          [ <?=GetLabelCausa($tipo) ?> ]</a> <? TemHistorico("causa", $chamado); ?></td>
      </tr>
      <tr>
        <td ><span id="causa" style="<?= $lshow?>">
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td><textarea name="causa" cols="120" rows="8" class="bordafinaFonteMaior" id="causa"><?=$causa?></textarea>
                </td>
            </tr>
            <tr>
              <td><br>
                <input name="Submit4" type="submit" class="bordaTexto" value="Gravar"></td>
            </tr>
          </table>
          </span ></td>
      </tr>
      <tr>
        <td><a href="javascript:alterna(corretiva);">[<?=GetLabelProposta($tipo)?>]</a> <? TemHistorico("acao", $chamado); ?></td>
      </tr>
      <tr>
        <td><span id= "corretiva" style="<?= $lshow?>">
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td><textarea name="acao" cols="120" rows="8" class="bordafinaFonteMaior" id="acao"><?=$acao?></textarea><br>                
                Respons&aacute;vel pela a&ccedil;&atilde;o :
                <input <?=$disabled?> name="rnc_acao_resp" type="text" class="bordaTexto" id="rnc_acao_resp" value="<?=$rnc_acao_responsavel?>" size="22" maxlength="20">
                / Prazo para a implementa&ccedil;&atilde;o da a&ccedil;&atilde;o
                <input <?=$disabled?> name="rnc_prazo" type="text" class="bordaTexto" id="rnc_prazo" value="<?=$rnc_prazo?>" size="12" maxlength="12">
                <?=$mensagem?></td>
            </tr>
          </table>
          </span></td>
      </tr>
      <tr>
        <td><a href="javascript:alterna(implantacao);">
          <input name="Submit5" type="submit" class="bordaTexto" value="Gravar">
          <br>
          [          <?=$lverif?>          ]</a> <?	TemHistorico("verificacao", $chamado) ?></td>
      </tr>
      <tr>
        <td><span id= "implantacao" style="<?= $lshow?>"> verificação
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td>
                  <textarea name="verificacao" cols="120" rows="8" class="bordafinaFonteMaior" id="verificacao"><?=$verificacao?></textarea>                  
                </td>
            </tr>
            <tr>
              <td>Respons&aacute;vel pela verifica&ccedil;&atilde;o :
                <input <?=$disabled?> name="rnc_verif_resp" type="text" class="bordaTexto" id="rnc_verif_resp" value="<?=$rnc_verif_responsavel?>" size="22" maxlength="20">
                / Prazo para auditar a a&ccedil;&atilde;o
                <input <?=$disabled?> name="rnc_verif_data" type="text" class="bordaTexto" id="rnc_verif_data" value="<?=$rnc_verif_data?>" size="12" maxlength="12">
                <?=$mensagem?></td>
            </tr>
            <tr>
              <td><label></label></td>
            </tr>
          </table>
          </span></td>
      </tr>
      <tr>
        <td><input name="Submit" type="submit" class="bordaTexto" value="Gravar"></td>
      </tr>
      <tr>
        <td><span style="display: none"> Historico das altera&ccedil;&otilde;es.<br>
          <textarea name="obs" cols="150" rows="6"  class="borda_fina" id="obs"><?=$obs?></textarea>
          </span></td>
      </tr>
    </table>
    <div align="left">
      <input name="action" type="hidden" id="action" value="<?=$action?>">
      <input name="id_chamado" type="hidden" id="id_chamado" value="<?=$chamado?>">
      <input name="tipo" type="hidden" id="tipo" value="<?=$tipo?>">
      <input name="podeEditar" type="hidden" id="podeEditar" value="<?=$podeEditar?>">
    </div>
    <!--<?=nl2br($obs)?>-->
  </form>
</div>
</body>
</html>
<SCRIPT>  
function alterna(item){
 if (item.style.display=='none'){
   item.style.display='';
 } else {
   item.style.display='none'
 }
}  
</SCRIPT>