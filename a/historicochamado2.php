<?
	$PermiteReplicarChamado = false;
	
	$NunesId = 141;
	$FernandoId = 12;
	$DeboraId = 63;
	$HelioId = 3;
	$JanainaQueirogaId = 187 ;
	$JessikaId = 86 ;
	
	
	require("scripts/conn.php");
	require("scripts/classes.php");	
	if ( isset($id_usuario)) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
	    if (!isset($ok)) {
			header("Location: index.php");
		}
	}

	$SouGestor = pegaGestor($ok);
	
	$eneas = false;//($ok == 14);
    $fernando = ($ok == $FernandoId);
	$debora = ($ok == $DeboraId);
	$nunes = ($ok == $NunesId);
	$helio = ($ok == $HelioId);
	$JanainaQueiroga = ($ok == $JanainaQueirogaId) ;
	$Jessika = ($ok == $JessikaId) ;

	
	$PermiteReplicarChamado = ( $fernando || $debora || $Jessika || $JanainaQueiroga );
	
	
	$EditaChamado = connPodeEditarChamado($ok);
	
	$chamados=pegaChamado($id_chamado);	
	
	// Quais chamados dependem deste aqui
	$ChamadosAguardando = conn_PegaChamadosAguardando($id_chamado);
	
	if (count($chamados) == 0) {
	  header("location: inicio.php?semresultado=1");
	}
	
	loga_online($ok, $REMOTE_ADDR, $id_chamado);	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	
	
	list($tmp1, $chamado) = each($chamados);		
		
	$rnc = $chamado["rnc"];
	
	$isProject = $rnc == 4;
	
    $diagnostico = $chamado["diagnostico"];
	$id_cliente = $chamado["id_cliente"];
	$categoria = $chamado["categoria"];
	$motivo = $chamado["motivo"];
	$id_sistema = $chamado["sistema_id"];



	$destinatario = pegaNomeUsuario($chamado["destinatario_id"]);	
	
	$sqlUsuario = "select nome, ramal, email from usuario where id_usuario = " . $chamado["consultor_id"];
	$Dono = mysql_fetch_object(mysql_query($sqlUsuario));		
	$abertopor = "<a href=\"mailto:$Dono->email?subject=Chamado $id_chamado\">$Dono->nome</a> ($Dono->ramal)"; 
	

	$destinatario_id = $chamado["destinatario_id"]; 
	if ($ok == $destinatario_id) {
		$nowTime = date("G:i:s");
		$nowDate = date("Y-m-d");
		$sql = "update chamado set lido = 1, datalidodestinatario = '$nowDate',  horalidodestinatario = '$nowTime' where id_chamado = $id_chamado";
		mysql_query($sql);
	}
	
	if ($ok == $chamado["consultor_id"] ) {
	  $sql = "update chamado set lidodono = 1 where id_chamado = $id_chamado";
	  mysql_query($sql);
	}
	
	
		
    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente));
	$cliente = strtoupper($tmp["cliente"]);
	$senha = $tmp["senha"];
	$endereco = $tmp["endereco"];
	$bairro = $tmp["bairro"];
	$cidade = $tmp["cidade"];	
	$telefone = $tmp["telefone"]; 
	$id_cliente = $tmp["id_cliente"];

	$UsaBanco = ($tmp["usa_banco"] == 1);	
	$msgBanco = "";
	if ($UsaBanco) 
	{
		$msgBanco = "<br /><b>Este cliente utiliza base SQL SERVER</b><br />";
	}
	
	
	
	$bl = $tmp["bloqueio"];

	$grau = "[" . AcertaGrau($tmp["grau"]). "]";

	/*
	   Qualquer alteração aqui deve ser feita em Historico.PHP, pois o código  é o mesmo
	*/
	$EditaChamadoBloqueado = connPodeEditarChamadoBloqueado($ok);		
    if ( $EditaChamadoBloqueado ) {
	  $bl=0;
	}  
		
	$podeLiberar = 0;
	if (
	     ($ok == 9 ) or
	     ($fernando) or
	     ($ok == 1 ) or 
		 ($ok == 8 ) or 
		 ($ok == 7 ) 
		) {
    	$podeLiberar =1;
	}

	
    // Aqui devo colocar uma opção que vai ordenar os contatos por data ou data desc
    
	
	
	if ($ordem) {
	  $ord = "";
	  $linkOrdem = "historicochamado.php?&id_chamado=$id_chamado";	  	  
	} else {
	  $ord = "desc";
	  $linkOrdem = "historicochamado.php?&id_chamado=$id_chamado&ordem='certa'";
	}
	$contatos = historicoChamado($id_chamado, $ord);
	
    $UltimoContato =count($contatos);
	$Ccontador = $UltimoContato + 1;
	
	
    $total_pendentes = count($chamadosemaberto);
	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);
	
	$diasDecorridos = $objChamado->diasDecorridos;
	
	$status = pegaStatus( $objChamado->status );


	$categoria_desc =  $objChamado->categoria;
	$isPosVenda = $objChamado->pos_venda;
	$pos_venda = "";				
	if ($isPosVenda) {
		$pos_venda = "<b>PÓS-VENDA<br/></b>";
		$categoria_desc =  "<h1>$categoria_desc</h1>";
	}
	
	
	$espero = $objChamado->dependo_de;
	if ($espero) {
		$espero = conn_PegaAguardandoChamado($objChamado->id_chamado);
	} else {
		$espero = "";
	}

	if ( $objChamado->status <> 1 ) {
	  $status = "<font color=#FF0000>".$status."</font>";
	} else {
      $status = "<font color=#0000FF>".$status."</font>";
	}
	  
	$prioridade = pegaPrioridade($objChamado->prioridade_id);
	$prioridade = "<b>$prioridade</b>";
	
	if ($objChamado->dataprevistaliberacao == '0000-00-00') {
		$DataLiberacao = 'Sem data definida';
	} else {
		$DataLiberacao = explode('-', $objChamado->dataprevistaliberacao);
		$DataLiberacao = "$DataLiberacao[2]/$DataLiberacao[1]/$DataLiberacao[0]";
	}
	  
       
		
?>
<script>

  function seleciona() {
    window.name = "pai";
    value = document.form.clientecodigo.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }
</script>
<html>
<head>
<title>Hist&oacute;rico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link href="sgq/attendere.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style7 {font-family: Arial, Helvetica, sans-serif}
.style8 {font-size: 14px}
-->
</style>
</head>
<body background="../agenda/figuras/fundo.gif" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">

<SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
<script src="coolbuttons.js"></script>
<img src="figuras/topo_sad_e_900.jpg" width="900" height="79" >
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="inicio.php"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton">&nbsp;</td>
  </tr>
</table>
<hr size="1" noshade>
<div align="center"> 
  <table width="98%" border="0">
    <tr> 
      <td width="31%"><font size="2">Sistema de Atendimento Datamace</font></td>
      <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
          <tr bgcolor="#FFFFFF">
            <form action="historico.php" method="post" name="formx" target="_blank" id="formx">
              <td align="left" valign="top"><div align="center"><font color="#0000FF"><b>
                <input type="hidden" name="action2">
                </b></font><font size="2"></font><font color="#0000FF"><b>
                  <input name="id_cliente" type="text" class="bordaTexto" id="id_cliente" title="Digite o n&uacute;mero do chamado ou o cliente e tecle enter">
                  </b>
                  <input name="hist" type="submit" class="bordaTexto" id="hist" title="Digite o n&uacute;mero do chamado ou do cliente na caixa de texto ao lado." value="Ver hist&oacute;rico" >
                </font></div></td>
            </form>
          </tr>
      </table></td>
      <td width="27%"><div align="right"><font size="2">Usu&aacute;rio <font color="#FF0000">:<b>
          <?=$nomeusuario?>
      </b></font></font></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="CorBordaTabelaSad">
    <tr class="CorFundoTabela">
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="SubitemSad">
        <tr >
          <td width="9%" align="center" valign="middle" class="TituloSubitemSad"><font size="2">
            Chamado
          </font></td>
          <td width="14%" align="center" valign="middle" class="TituloSubitemSad"><font size="2">
            Data
          da abertura
          </font></td>
          <td width="13%" align="center" valign="middle" class="TituloSubitemSad"><font size="2">
            Hora
          de abertura
          </font></td>
          <td colspan="2" class="TituloSubitemSad"><font size="2">
            Cliente
          </font></td>
          <td width="17%" class="TituloSubitemSad"><div align="center">
            <font size="2">
              Status            </font>
          </div></td>
        </tr>
        <tr >
          <td width="9%" align="center"><div align="center">
            <font color="#FF0000"><b>
			<font size="3"><?=trim(number_format($id_chamado,0,',','.'))?></font></b>			</font>
          </div></td>
          <td width="14%" align="center"><div align="center">
            <font size="2">
              <strong>
                <?=$objChamado->dataaf?><br><?=DiaDaSemana($objChamado->dataaf);?>
                </strong>              </font>
          </div></td>
          <td width="13%" align="center"><div align="center">
              <font size="3">
                <strong>
                  <?=$objChamado->horaa?>
                </strong>              </font>
          </div></td>
          <td colspan="2" valign="top"><font size="2">
		  		        
         <?
		 $msg = "<b>$cliente $grau</b> ($senha)";		 		
		 $msg = "<a target=\"_blank\" href=\"/a/historico.php?id_cliente=$id_cliente\">$msg</a>";
		 
		 if ($bl) { $msg="<b><font color=#ff0000>$cliente (bloqueado)</font></b>" ;}
		 $msg .= "<br> Fone : $telefone";
         $msg .= " - <a href=\"javascript:selecionapessoa('$id_cliente')\">Contatos</a>";
		 echo $msg;
		 echo "<font color=#FF0000>" . $msgBanco . "</font>";
		?>
          </font>
          
          </td>
          <td width="17%"><div align="center">
            <b>
              <font size="3">
                  <?=$status?> <br> <?=$prioridade?>
                </font>            </b>
          </div></td>
        </tr>
        <tr >
          <td align="right" class="TituloSubitemSad">Sistema&nbsp;</td>
          <td colspan="2" class="TituloSubitemSad">
            <strong>
              <?=pegaSistema($id_sistema)?>
              </strong>           </td>
          <td width="14%" align="right" class="TituloSubitemSad">Categoria &nbsp;</td>
          <td colspan="2" class="TituloSubitemSad">
            <strong>
              <?=$categoria_desc?>
              </strong>            </td>
          </tr>
        <tr class="TituloSubitemSad" >
          <td align="right"><font size="1">
            Aberto por&nbsp;
          </font></td>
          <td colspan="2"><font size="1">
            <strong>
              <?=$abertopor?>
              </strong>
          </font>          </td>
          <td align="right"><font size="1">
            Este chamado est&aacute; com&nbsp;
          </font></td>
          <td colspan="2"><font size="1">
            <strong>
              <?=$destinatario?>
              </strong>
          </font>          </td>
          </tr>
        <tr class="TituloSubitemSad" >
          <td align="right">Diagn&oacute;stico&nbsp;</td>
          <td colspan="2"><strong>
            <?=pegaDiagnostico($diagnostico)?>
          </strong></td>
          <td colspan="2">&nbsp;</td>
          <td align="center" valign="middle"> Libera&ccedil;&atilde;o em </td>
        </tr>
        <tr class="TituloSubitemSad" >
          <td align="right">
              Motivo&nbsp;</td>
          <td colspan="4">
            <strong>
              <?=pegaMotivo($motivo)?>
              </strong>                  </td>
          <td align="center"><p><strong>
            <?=$DataLiberacao?></strong>
			<?
			if ($podeLiberar==1) {
			?>
            <br>
            [<a href="javascript:dataprevista(<?=$id_chamado?>, <?=$ok?>);">Editar Data Libera&ccedil;&atilde;o</a>]
			<?
			}
			?>
			</p>            </td>
        </tr>
        <tr >
          <td colspan="6">
          <p>
              <i><br>
              <font size="2">
                &nbsp;Descri&ccedil;&atilde;o              </font>              </i>
              <blockquote>
                <p>
                  <font size="2">
                    <font color="#0000FF">

                      <strong>
                      <?
		    $descricao = $chamado["descricao"];
		  	if ($palavra) {
             $descricao = eregi_replace($palavra, "<b><font  color=#FF0000>$palavra</font></b>", $descricao); 			 
            }
            
			
			$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4" target="_blank">$2$3$4</a>', $descricao);
											
					
			//$descricao = eregi_replace("C",'A',$descricao);
			
			//$descricao = eregi_replace("<br />", "", $descricao); 			 						
			$descricao = nl2br($descricao);
			
			?>
			<?= $descricao;?>
                      </strong>
                      <br>
					  <?= $ChamadosAguardando?>
					  <?= $espero ?>
                    </font>                  </font>                </p>
					         </p>
              </blockquote><? if ($EditaChamado) { ?> <a href="manut/ec.php?acao=ver&id=<?=$id_chamado?>">.</a><strong> <?php echo $tmp["contato_id"]; ?>
			  
<? } ?>
 <?	if ($PermiteReplicarChamado) { ?>
 	<br><br>
    <div style="text-align:center; font-size:12px">
    <a href="javascript:ReplicarChamado.submit();">Replicar este chamado</a>
    </div>
    <form id="ReplicarChamado" method="post" action="manut/ReplicarChamado.php">
    <input name="Chamado_Id" type="hidden" value="<?=$id_chamado ?>">
    </form>
<? } ?>          
</td>
        </tr>
      </table></td>
    </tr>
  </table>
  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td>
       <input type="button" name="Button" value="Novo Contato" class="NovoContato" onClick="javascript:document.form.action.value='contato';vai();">     </td>
      <td valign="middle" align="center"> 
        <div align="center">
          <font size="1">
            [
            <a href="<?=$linkOrdem?>">
              Inverter ordem            </a>
            ]
            <? if($rnc) {?> 
            ::
            [
            <a href="javascript:rnc();">
              Imprime Relatório RNC            </a>
            ] :: 
            [
            <a href="rnc/rnc.php?id_chamado=<?=$id_chamado?>">
              Editar            </a>
            ]
            <script>
  function rnc() {
     window.open('historicochamadornc.php?id_chamado='+<?=$id_chamado?>  , "Seleção", "scrollbars=yes, height=600, width=700");
  }
            </script>
            <? } ?>
           :: [
           <a href="sigame/dosigame.php?id_usuario=<?=$ok?>&id_chamado=<?=$id_chamado?>">
             Incluir no Desktop &quot;SIGA-ME&quot;           </a>
           ]          </font>        <? if ($isProject) { ?> <br> É Projeto <? } ?> </div>
        <br>
        <div align="center">
          <strong>
          <font size="2">
            Contatos Estabelecidos          </font>          </strong><br>
(<span id="contatos"></span>)        </div>      </td>
      <td align="right">
        <input type="submit" name="Submit22" value="Novo Chamado" class="NovoContato" onClick="javascript:document.form.action.value='chamado';vai();">	  </td>
    </tr>
  </table>
  <br>
</div>

<!-- 
	Em 03.05.2011 - Fernando Nomellini. Troquei todo o conteúdo da tabela de histórico
    para um include. Assim posso usar o mesmo no novo contato.

	INICIO
-->
<? include("_historicochamadoPartial.php") ?>
<!-- FIM -->

<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr valign="middle" align="left"> 
    <td colspan="2">&nbsp;&nbsp;&nbsp;</td>
    <td width="42%">&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr valign="middle" align="left"> 
    <td width="46%" align="left"> <a name="fim"></a>
       <input type="button" name="Button" value="Novo Contato" class="NovoContato" onClick="javascript:document.form.action.value='contato';vai();">
      <br>    </td>
    <td width="12%" align="center">[<a href="javascript:history.go(-1);">voltar</a>]<br>
      [<a href="<?=$linkOrdem?>">inverter ordem</a>]</td>
    <td width="42%" align="right"> 
      <input type="submit" name="Submit2" value="Novo Chamado" class="NovoContato" onClick="javascript:document.form.action.value='chamado';vai();">    </td>
  </tr>
  <tr valign="middle" align="left"> 
    <td align="left" colspan="2"> Selecione esta op&ccedil;&atilde;o para dar 
      <br>
      continuidade a este chamado. </td>
    <td width="42%" align="right">Selecione esta op&ccedil;&atilde;o para abrir 
      um <br>
      novo chamado para este cliente. </td>
  </tr>
  <tr valign="middle" align="left">
    <td align="left" colspan="2">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr valign="middle" align="left">
    <td align="left" colspan="3">
	
          <p><strong>Inserir</strong> na pasta:<br>          
            <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta not in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";
	
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/addchamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}
?><br>

            <strong>Mover</strong> para a pasta:<br>          
            <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta not in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";
	
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/moverchamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}
?>

          
          <br>
          <strong>Retirar</strong> da pasta:<br>
          
          <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta  in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";

	
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/removechamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}

?>
  </p>
      <p><a href="pastas/criarpasta.php?id_chamado=<?=$id_chamado?>&id_usuario=<?=$ok?>"><span class="style7"><img src="figuras/NovaPasta.jpg" alt="NovaPasta" width="25" height="25" border="0" align="absmiddle">Criar Pasta e incluir este chamado </span></a> </p></td>
  </tr>
</table>

<form name="form" method="post" action="novocontatochamado.php#Contato">	
  <input type="hidden" name="chamado_id" value="<?=$id_chamado?>">
  <input type="hidden" name="id_ligacao" value="<?=$id_ligacao?>">  
  <input type="hidden" name="cliente_id" value="<?=$id_cliente?>">
  <input type="hidden" name="action">
</form>

<form name="form2" method="post" action="">	
</form>


<p>
  <script>
  function vai() {
    if ('-<?=$bl?>' == '-1') {
	  window.alert('Consultoria Bloqueada');
	  return;
	}
	
	
   if (  ( '-1' == '-<?=$atendimento?>') && ('<?=$id_cliente?>' != 'DATAMACE') && ('<?=$senha?>' == '00 000') ) {
//	  window.alert('Cliente Inativo');
//	  return;
	}		

  
    document.form.submit();
  }
  
  if ('-<?=$sigame?>' != '-') {
    window.alert('Chamado colocado na lista de SIGA-ME');
  }
  

  <?
  
	$diasDecorridos++;
  	$mm = ($diasDecorridos > 1) ? "s" : "";
	$dd = $diasDecorridos . " dia". $mm;	    
	$ss = ($UltimoContato > 1) ? "s" : "";
   
  
 ?>



	contatos.innerHTML = '<?php echo "$UltimoContato contato$ss consumindo $dd - duração : " . segTohora($segundos);?>';
  
</script>

<script>
	function dataprevista(chamado, usuario) {
	  var newWindow;
	  window.name = "pai";  
	  newWindow = window.open( 'lembrete/EditaDataPrevistaLiberacao.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
	}	

	function EditaDuracao(contato) {
	  var newWindow;
	  window.name = "pai";  
	  newWindow = window.open( 'EditaDuracao/EditaDuracao.php?id_contato='+contato, '', 'width=500, height=300');
	}	
	
	
</script>
</p>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<script type="text/javascript" language="javascript">
	if ( "<?=$anexo?>" == "true") 
	{
		// window.alert("Por favor, anexe seu(s) arquivo(s)");
	}
	
	
function selecionapessoa(AClienteId) {
	window.open('selecionapessoaemail.php?id_chamado=<?=$id_chamado?>&cliente_id='+AClienteId,'','width=536, height=410');	
}	
</script>


<? 
		$sql = "select
  u.nome, c.hora
from
  contato_temp c
    inner join usuario u on c.id_usuario = u.id_usuario        
where 
      c.id_usuario <> $ok and
      data = '" . date("Y-m-d") . "'
      and id_chamado = $id_chamado
order by hora ";
	  

	  $msg = "Usuários trabalhando neste chamado\\n\\n";
	  $temMsg = false;
	  $result = mysql_query($sql);
	  while ($linha = mysql_fetch_object($result)) {
		$temMsg = true;
	  	$msg .= "$linha->nome, desde às $linha->hora\\n";
	  }
	  
	  mysql_free_result($result);	  
	  
	  if ($temMsg) {
?>	
<script>
  window.alert( '<?=$msg?>' );	
</script>


<?	
		}  // End if tem mensagem
?>

