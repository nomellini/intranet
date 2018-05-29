<?
	require("../funcoes.php");	
    require("../../scripts/conn.php");		
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
            $gerente = pegaGerente($ok);			
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}

    loga_online($ok, $REMOTE_ADDR, 'Desktop rnc');

	
     if ($_POST['txtDataAberturaFim'] == '') {
        $_POST['txtDataAberturaFim'] = date('d/m/Y');
        $_POST['txtDataAberturaInicio'] = date("d/m/Y", time()-( 86400*720 ) );
		$_POST['txtStatus'] = 2;
		$txtStatus = 2;
		
	 }
	 
			$_dataAi = explode('/', $_POST['txtDataAberturaInicio']);
			$diaAi = $_dataAi[0];
			$mesAi = $_dataAi[1];
			$anoAi = $_dataAi[2];
			$_dataAi = "$anoAi-$mesAi[1]-$diaAi[0]";

			$_dataAf = explode('/', $_POST['txtDataAberturaFim']);
			$diaAf = $_dataAf[0];
			$mesAf = $_dataAf[1];
			$anoAf = $_dataAf[2];
			$_dataAf = "$anoAf-$mesAf[1]-$diaAf[0]";
	
    $nomeusuario=peganomeusuario($ok);	
	$manut = pegaManut($ok);
	$marketing = pegaMarketing($ok);	
	$msgnova = 0;
	$lembretenovo = 0;
?>
<html>
<meta http-equiv="refresh" content="600;URL=../../inicio.php">
<style type="text/css">
<!--
.style1 {
	font-size: 12px
}
.style3 {
	color: #999999
}
-->
</style>
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" background="../../../agenda/figuras/fundo.gif" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="../../relatorios/coolbuttons.js"></script> 
<script>
  function rnc(AChamado) {
     window.open('../../historicochamadornc.php?id_chamado='+AChamado  , "Seleção", "scrollbars=yes, height=600, width=700");
  }
  function Teste(AMes, AAno, ARetorno) {
    window.name = "pai";
    window.open('../datePick.php?mes='+AMes+'&ano='+AAno, "Seleção", "scrollbars=yes, height=160, width=200");
  }
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center">
    <td width="72" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"> <img src="../../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0"> voltar </a></td>
    <td width="87" class="coolButton"><a href="../../index.php?novologin=true"> <img src="../../figuras/logout.gif" width="20" height="20" align="absmiddle" border="0"> Logout </a></td>
    <td width="101" class="coolButton"><a href="/a/relatorios/"> <img src="../../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0"> relat&oacute;rios </a></td>
    <td width="111" class="coolButton"><img src="../../figuras/senha.gif" width="20" height="20" align="absmiddle"> <a href="../../trocasenha.php"> Alterar 
      Senha </a></td>
    <td width="118" class="coolButton" align="center" valign="middle"><a href="../../inicio.php"> Desktop </a> &nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="204" class="coolButton"><a href="/agenda/" target="_blank"> Agenda 
      Corporativa Datamace </a></td>
  </tr>
</table>
<hr size="1" noshade>
<font size="1"> Usu&aacute;rio <font color="#FF0000"> : <b>
<?=$nomeusuario?>
</b> </font> </font>
<div align="center"> <font size="3"> <a name="ok"> </a> <img src="../../figuras/intro.gif" width="321" height="21" class="alpha"> <b> <br>
  Desktop da Qualidade </b></font>
  <form action="" method="post" name="forma">
    <table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
      <tr>
        <td height="103" align="left" valign="top">Data atual:
          <?=date("d/m/Y h:m")?>
          <br>
          <? if ($gerente) {?>
          Abrir novo chamado : 
          [ <a href="../../rnc/rnc.php?action=novo&tipo=<?=SAD_NAOCONFORMIDADE?>"> n&atilde;o conformidade </a> ] - [ <a href="../../rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOPREVENTIVA?>"> A&ccedil;&atilde;o Preventiva </a> ] - [ <a href="../../rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOMELHORIA?>"> A&ccedil;&atilde;o Melhoria </a> ]
          <? }?>
          <br>
          <br>
          1. Filtros<br>
          <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td height="1px" colspan="4" bgcolor="#CCCCCC"><img src="../../../imagens/1pixel.gif" width="1" height="1"></td>
            </tr>
            <tr>
              <td width="17%">Data Abertura Inicio </td>
              <td width="37%"><input name="txtDataAberturaInicio" type="text" class="borda_fina" id="txtDataAberturaInicio" value="<?php echo $_POST['txtDataAberturaInicio']; ?>" size="12" maxlength="10">
                <a href="javascript:document.forma.retorno.value='inicio';Teste(<?=$mesAi?>, <?=$anoAi?>);"><img src="../../imagens/gerenciartarefa.gif" width="18" height="18" border="0" align="absmiddle"></a></td>
              <td width="19%">Tipo chamado </td>
              <td width="27%"><label>
                  <select name="txtTipoChamado" class="bordaTexto" id="txtTipoChamado">
                    <option value="0" selected <?php if (!(strcmp(0, $_POST['txtTipoChamado']))) {echo "selected=\"selected\"";} ?>>Todos</option>
                    <option value="1" <?php if (!(strcmp(1, $_POST['txtTipoChamado']))) {echo "selected=\"selected\"";} ?>>N&atilde;o conformidades</option>
                    <option value="2" <?php if (!(strcmp(2, $_POST['txtTipoChamado']))) {echo "selected=\"selected\"";} ?>>A&ccedil;&atilde;o Preventiva</option>
                    <option value="3" <?php if (!(strcmp(3, $_POST['txtTipoChamado']))) {echo "selected=\"selected\"";} ?>>A&ccedil;&atilde;o Melhoria</option>
                  </select>
                </label>
                <label class="borda_fina"></label></td>
            </tr>
            <tr>
              <td>Data abertura Fim </td>
              <td><input name="txtDataAberturaFim" type="text" class="borda_fina" id="txtDataAberturaFim" value="<?php echo $_POST['txtDataAberturaFim']; ?>" size="12" maxlength="10">
                <a href="javascript:document.forma.retorno.value='fim';Teste(<?=$mesAf?>, <?=$anoAf?>, document.forma.txtDataAberturaFim);"><img src="../../imagens/gerenciartarefa.gif" width="18" height="18" border="0" align="absmiddle"></a></td>
              <td>Status</td>
              <td><select name="txtStatus" class="bordaTexto" id="txtStatus">
                  <option value="9" selected <?php if (!(strcmp(9, $_POST['txtStatus']))) {echo "selected=\"selected\"";} ?>>Todos</option>
                  <option value="2" <?php if (!(strcmp(2, $_POST['txtStatus']))) {echo "selected=\"selected\"";} ?>>Em aberto</option>
                  <option value="1" <?php if (!(strcmp(1, $_POST['txtStatus']))) {echo "selected=\"selected\"";} ?>>Encerrados</option>
                </select></td>
            </tr>
            <tr>
              <td><input name="retorno" type="hidden" id="retorno" value="fim"></td>
              <td><input name="Submit" type="submit" value="Enviar"></td>
              <td>Diagn&oacute;stico</td>
              <td><select name="txtDiagnostico" class="bordaTexto" id="txtDiagnostico">
                  <option value="0" selected <?php if (!(strcmp(0, $_POST['txtDiagnostico']))) {echo "selected=\"selected\"";} ?>>Todos</option>
                  <option value="3" <?php if (!(strcmp(3, $_POST['txtDiagnostico']))) {echo "selected=\"selected\"";} ?>>NC Cr&iacute;tica</option>
                  <option value="25" <?php if (!(strcmp(25, $_POST['txtDiagnostico']))) {echo "selected=\"selected\"";} ?>>Improcedente</option>
                </select></td>
            </tr>
            <tr>
              <td colspan="4" bgcolor="#CCCCCC"><label><img src="../../../imagens/1pixel.gif" width="1" height="1"></label></td>
            </tr>
          </table>
          2. Resultados:&nbsp;<strong><span id="contador"></span></strong>&nbsp;registro(s)
          <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td><?
	
			$sql = "SELECT id_chamado, LEFT(descricao, 250) as descricao, rnc, diagnostico_id, prioridade.valor as prioridadedev, ";
			$sql .= "rnc_depto_responsavel, rnc_prazo, rnc_data, destinatario_id, datauc, prioridade.prioridade, ";
			$sql .= "prioridade_id, dataa, status ";
			$sql .= "from ";
			$sql .= "chamado inner join prioridade on (prioridade.id_prioridade = chamado.prioridade_id ) ";
			$sql .= "where chamado.visible = 1 and chamado.descricao <> '' and  ";

			if ($txtTipoChamado) { 
			  $sql .= "rnc = $txtTipoChamado ";
			} else {
			$sql .= "(rnc > 0) and (rnc < 4) ";
			}			
			if ( $txtStatus && ($txtStatus <> "9") ) {
  			  $sql .= "and status = $txtStatus ";
			}
			
			if ( $txtDiagnostico ) {
				$sql .= "and diagnostico_id =  $txtDiagnostico";
			}
			
			$_dataAi = explode('/', $_POST['txtDataAberturaInicio']);
			$_dataAi = "$_dataAi[2]-$_dataAi[1]-$_dataAi[0]";

			$_dataAf = explode('/', $_POST['txtDataAberturaFim']);
			$_dataAf = "$_dataAf[2]-$_dataAf[1]-$_dataAf[0]";
			
			$sql .= " and ( dataa >= '$_dataAi' and dataa <= '$_dataAf') ";
			
			$sql .= "order by ";
			$sql .= "rnc, Dataa desc";
			
			//die($sql);
			
			
			
			$result = mysql_query($sql);
			$contador = 0;
			while ($linha = mysql_fetch_object($result)) {

				$_id_chamado = $linha->id_chamado;
				
				
				$_descricao = $linha->descricao;
				$_descricao .= "...";
				$_descricao = eregi_replace("\r\n", "<br>",$_descricao);
				$_descricao = eregi_replace("\"", "`", $_descricao);	
				
			    $msgCritico = "";
				if ($linha->diagnostico_id==3) {
				  if ($linha->status != 1) {
				  $msgCritico = "<font color=#ff0000><strong>Não conformidade crítica</strong></font>";
				  } else {
				  $msgCritico = "<font color=#006600><strong>Não conformidade crítica</strong></font>";
				  }
				}		  
				if ($linha->diagnostico_id==25) { //Improcedente
				  $msgCritico = "<font color=#ff0000><strong>Improcedente</strong></font>";				
				}
			  
				$_tipoRnc = $linha->rnc;
				if ($_tipoRnc == 1) {
					$_tipoRnc = "Não conformidade";
					$bg_color = "#F4FDFF";
				} else 
				if ($_tipoRnc == 2) {
					$_tipoRnc = "Ação Preventiva";
					$bg_color = "#aaF9DC";				
				} else 
				if ($_tipoRnc == 3) {
					$_tipoRnc = "Ação de Melhoria";
					$bg_color = "#FEEDE0";				
				//$bg_color = CORES_QUALIDADE;
				} 
				
				if ($linha->diagnostico_id==25) { //Improcedente
				  $msgCritico = "<font color=#ff0000><strong>Improcedente</strong></font>";	
					$bg_color = "#EFE8FF";					  			
				}
				
				
				$_data = explode('-', $linha->dataa);
				$_data = "$_data[2]/$_data[1]/$_data[0]";
				$_id_Prioridade = $linha->prioridade_id;
				if ($linha->status != 1) {
					$status = "<font color=#ff0000>Aberto</font>";
				} else {
					$_data_e = explode('-', $linha->datauc);
					$_data_e = "$_data_e[2]/$_data_e[1]/$_data_e[0]";
				    $status = "<font color=#006600>Encerrado</font>";
					$msg = "<br>Data de encerramento: <strong>$_data_e</strong>";
				}
				$status = "<b>$status</b>";
				
				$prioridade = $linha->prioridade;
 			   $prioridadev = $linha->prioridadedev;
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $prioridade = "<b><font color=$cor>$prioridade</font></b>";
				
				
			  
			$destinatarioId = $linha->destinatario_id;
			$rnc_depto = $linha->rnc_depto_responsavel;
			$data = explode("-",$linha->rnc_prazo);			
			$rnc_prazo = "$data[2]/$data[1]/$data[0]";
			$data = explode("-", $linha->rnc_data);
			$rnc_data = "$data[2]/$data[1]/$data[0]";
			/*
			$data = explode("-", $linha->rnc_acao_data);			
			$rnc_acao_data = "$data[2]/$data[1]/$data[0]";
			$data = explode("-", $linha->rnc_verif_data);						
			$rnc_verif_data = "$data[2]/$data[1]/$data[0]";
			$rnc_acao_responsavel = $linha->rnc_acao_responsavel;
			$rnc_verif_responsavel = $linha->rnc_verif_responsavel;		
			*/	

  		     if   ( !$meu or ($meu and ($destinatarioId == $ok))  )           {  
			   $contador++;
			  
			?>
                <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
                  <tr>
                    <td><table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#003366">
                        <tr>
                          <td width="10%" colspan="2" rowspan="2" valign="top" bgcolor="<?=$bg_color?>"><a href="../rnc.php?id_chamado=<?=$_id_chamado?>"  target="_blank"><img src="../../imagens/edit_enable.gif" alt="Editar" width="25" height="25" border="0" align="absmiddle"></a><a href="javascript:rnc(<?=$_id_chamado?>);"><img src="../../imagens/Print_Enable.gif" alt="Imprimir" width="25" height="25" border="0" align="absmiddle"></a><a href="../../historicochamado.php?id_chamado=<?=$_id_chamado?>" target="_blank"></a> <a href="../../historicochamado.php?id_chamado=<?=$_id_chamado?>" target="_blank" class="style1">
                            <?=$_id_chamado?>
                            </a><br>
                            <?=$status?></td>
                          <td width="82%" valign="top" bgcolor="<?=$bg_color?>"><strong>
                            <?=$_tipoRnc?>
                            </strong> <span class="style3">Aberta em
                            <?=$_data?>
                            </span>
                            <?=$msgCritico?>
                            <br>
                            Departamento Responsável:<strong>
                            <?=$rnc_depto?>
                            </strong> <br>
                            Data: <strong>
                            <?=$rnc_data?>
                            </strong> -  Prazo: <strong>
                            <?=$rnc_prazo?>
                            </strong>
                            <?=$msg?>
                            <br>
                            Prioridade:
                            <?=$prioridade?>
                            <hr size="1"></td>
                        </tr>
                        <tr>
                          <td width="82%" valign="top" bgcolor="<?=$bg_color?>"><span class="style1">
                            <blockquote>
                              <?=$_descricao?>
                            </blockquote>
                            </span></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="imagens/nulo.gif" width="1" height="1"></td>
                  </tr>
                </table>
                <?
			   }
			  }
            ?></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td height="103" align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="103" align="left" valign="top">&nbsp;</td>
      </tr>
    </table>
  </form>
</div>
<p> 
  <script>
 function vai() {
   location.href = 'inicio.php?subPendente='+document.form2.subPendente.value+"#pendencias";
 }
 

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }



 if( <?=$msgnova?> ) {
   msgnova.innerHTML = "Existe(m) <?=$msgnova?> chamado(s) com mensagens não lidas (<img src=figuras/idea01.gif  align=absmiddle>)";
 }
 
 if( <?=$lembretenovo?> ) {
   lembretenovo.innerHTML = "<br>Extiste(m) <?=$lembretenovo?> chamado(s) com lembretes não lidos (<img src=figuras/lembrete.jpg  align=absmiddle>)<br>";
 }


function novolembrete(chamado, usuario) {
  var newWindow;
  window.name = "pai";  
  newWindow = window.open( 'lembrete/novolembrete.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
}  

function online() {
   window.open( 'online.php', '', 'scrollbars=yes, width=600, height=400');
}  


contador.innerHTML = '<?=$contador?>';

</script>
</body>
</html>
