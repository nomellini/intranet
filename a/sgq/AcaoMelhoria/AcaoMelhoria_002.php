<?php require_once('../../../Connections/sad.php'); ?>
<?php
$colname_rsItem = "-1";
if (isset($_GET['id'])) {
  $colname_rsItem = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_sad, $sad);
$query_rsItem = sprintf("SELECT * FROM sgq_itens WHERE id = %s", $colname_rsItem);
$rsItem = mysql_query($query_rsItem, $sad) or die(mysql_error());
$row_rsItem = mysql_fetch_assoc($rsItem);
$totalRows_rsItem = mysql_num_rows($rsItem);

mysql_select_db($database_sad, $sad);
$query_rsClientes = "SELECT id_cliente, cliente FROM cliente ORDER BY cliente ASC";
$rsClientes = mysql_query($query_rsClientes, $sad) or die(mysql_error());
$row_rsClientes = mysql_fetch_assoc($rsClientes);
$totalRows_rsClientes = mysql_num_rows($rsClientes);

mysql_select_db($database_sad, $sad);
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);

$colid_rsStatus = "-1";
if (isset($_GET['id'])) {
  $colid_rsStatus = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_sad, $sad);
$query_rsStatus = sprintf("SELECT descricao FROM sgq_status INNER JOIN sgq_itens on sgq_itens.id_status = sgq_status.codigo WHERE sgq_itens.id = %s", $colid_rsStatus);
$rsStatus = mysql_query($query_rsStatus, $sad) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);

mysql_select_db($database_sad, $sad);
$query_osTipoOrcamento = "SELECT * FROM sgq_tipo_orcamento";
$osTipoOrcamento = mysql_query($query_osTipoOrcamento, $sad) or die(mysql_error());
$row_osTipoOrcamento = mysql_fetch_assoc($osTipoOrcamento);
$totalRows_osTipoOrcamento = mysql_num_rows($osTipoOrcamento);
?><?
	require("../scripts/dtmtypes.php");
    require("../../scripts/conn.php");			
				
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header(" ../../Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: ../../index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
	
	$nomeusuario=peganomeusuario($ok);
	if ($ok  == $row_rsItem['resp1']) {
	  $podeAssinarAcao = true;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="../../../Templates/PortalQualidade.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Portal da qualidade</title>
<!-- InstanceEndEditable --><!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<link href="../attendere.css" rel="stylesheet" type="text/css" />
</head>

<body background="../../../imagens/fundo.gif">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="72" background="../imagens/portalqualidade.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td height="32" align="left" valign="top"><!-- InstanceBeginEditable name="Central" -->
<form id="form1" name="form1" action="AM_Do_AprovaOrcamento.php" method="post">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="50%">      Usuário:<strong>
        <?=$nomeusuario?>
        </strong>        </td>
        <td width="50%">&nbsp;</td>
      </tr>
    </table>
	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000099">
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="1" cellspacing="1" class="Subitem">
          <tr>
            <td colspan="4" align="center" valign="middle"><font size="2">
              <strong>
              <?=$msg?>
              </strong>
            </font></td>
            </tr>
          <tr>
            <td width="7%">ID</td>
            <td width="60%"><?php echo $row_rsItem['id']; ?></td>
            <td width="8%">STATUS</td>
            <td width="25%"><label><?php echo $row_rsStatus['descricao']; ?></label></td>
          </tr>
          <tr>
            <td>Aberto em </td>
            <td><?php echo $row_rsItem['dataa']; ?>, por <?php echo peganomeusuario($row_rsItem['id_usuario']); ?></td>
            <td>Chamado</td>
            <td><input name="id_chamado" type="text" class="borda_fina" id="id_chamado" value="<?php echo $row_rsItem['id_chamado']; ?>" size="10" maxlength="10" /></td>
          </tr>
          <tr>
            <td>Cliente</td>
            <td><select name="id_cliente" class="borda_fina" id="id_cliente" disabled>
                <option value="0" <?php if (!(strcmp(0, $row_rsItem['id_cliente']))) {echo "selected=\"selected\"";} ?>>Sem cliente selecionado</option>
                <?=$clientes?>
                <?php
do {  
?>
                <option value="<?php echo $row_rsClientes['id_cliente']?>"<?php if (!(strcmp($row_rsClientes['id_cliente'], $row_rsItem['id_cliente']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsClientes['cliente']?></option>
                <?php
} while ($row_rsClientes = mysql_fetch_assoc($rsClientes));
  $rows = mysql_num_rows($rsClientes);
  if($rows > 0) {
      mysql_data_seek($rsClientes, 0);
	  $row_rsClientes = mysql_fetch_assoc($rsClientes);
  }
?>
              </select>            </td>
            <td>Auditoria</td>
            <td><input name="auditoria" type="text" class="borda_fina" id="auditoria" value="<?php echo $row_rsItem['txt_livre1']; ?>" /></td>
          </tr>
          <tr>
            <td>Resumo</td>
            <td colspan="3"><?php echo $row_rsItem['Resumo']; ?></td>
          </tr>
        </table></td>
      </tr>
    </table>
	<br />

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr valign="top">
    <td width="16%" height="80"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
      <tr>
        <td bgcolor="#FFFFFF"><p>
Status:<strong>
<?php echo $row_rsStatus['descricao']; ?><br />
</strong><br />
        </p>          </td>
      </tr>
    </table>
      </td>
    <td width="84%"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="abas">
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">          <a href="AcaoMelhoria_001.php?id=<?=$colname_rsItem?>">A&ccedil;&atilde;o</a> </td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">Or&ccedil;amento
        </a>		</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">
		<a href="AcaoMelhoria_003.php?id=<?=$colname_rsItem?>">          Execu&ccedil;&atilde;o		</a></td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center"><a href="javascript:aba(4)">
Verifica&ccedil;&atilde;o de efic&aacute;cia
		
		</a></td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center"><a href="javascript:aba(5)">
					
          Encerramento
		
		</a></td>
        <td align="center">&nbsp;</td>
        </tr>
    </table>
	<span id="aba1">
	
	<table width="100%" border="0" cellpadding="1" cellspacing="1" class="CorBordaTabela">
      <tr class="CorFundoTabela">
        <td><table width="100%" border="0" align="left" cellpadding="2" cellspacing="2" class="Subitem">
          <tr>
            <td width="15%" class="TituloSubitem"><p> VALOR </p></td>
            <td width="85%" align="right" class="TituloSubitem"><?=$Info["aprovado_acao"]?></td>
          </tr>
          <tr>
            <td colspan="2"><p>
                <input name="VALOR" type="text" class="bordaTexto" id="VALOR" value="<?php echo $row_rsItem['orcamento1']; ?>" />
            </p></td>
          </tr>
          <tr>
            <td colspan="2" class="TituloSubitem">OBSERVA&Ccedil;&Otilde;ES</td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="texto3" cols="100" rows="5" class="bordaTexto" id="textarea2"><?php echo $row_rsItem['texto3']; ?></textarea></td>
          </tr>
          <tr>
            <td colspan="2" class="TituloSubitem">APROVA&Ccedil;&Atilde;O</td>
          </tr>
          <tr>
            <td><p>Respons&aacute;vel</p>
              </td>
            <td><select name="resp1" class="bordaTexto" id="resp1" disabled="disabled">
              <?=$usuarios?>
              <?php
do {  
?><option value="<?php echo $row_rsUsuarios['id_usuario']?>"<?php if (!(strcmp($row_rsUsuarios['id_usuario'], $row_rsItem['resp1']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsUsuarios['nome']?></option>
              <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td>Tipo aprova&ccedil;&atilde;o * </td>
            <td><select name="tipo_aprovacao" class="bordaTexto" id="tipo_aprovacao"  >
              <option value="0" <?php if (!(strcmp(0, $row_rsItem['tipo_orcamento1']))) {echo "selected=\"selected\"";} ?>>Selecione</option>
              <?php
do {  
?>
              <option value="<?php echo $row_osTipoOrcamento['id']?>"<?php if (!(strcmp($row_osTipoOrcamento['id'], $row_rsItem['tipo_orcamento1']))) {echo "selected=\"selected\"";} ?>><?php echo $row_osTipoOrcamento['descricao']?></option>
              <?php
} while ($row_osTipoOrcamento = mysql_fetch_assoc($osTipoOrcamento));
  $rows = mysql_num_rows($osTipoOrcamento);
  if($rows > 0) {
      mysql_data_seek($osTipoOrcamento, 0);
	  $row_osTipoOrcamento = mysql_fetch_assoc($osTipoOrcamento);
  }
?>
              </select>
              <input name="id_item" type="hidden" id="id_item" value="<?php echo $row_rsItem['id']; ?>" />            </td>
          </tr>
          <?
  if ( $podeAssinarAcao  ) {
  
	

?>
          <tr>
            <td>Senha* <font color="#FF0000"> <strong>
            </strong> </font> <br /></td>
            <td><input name="senha2" type="password" class="botao_fino" id="senha2" />
                <input name="Button2" type="button" onclick="vai('')" value="Aprovado" />
              * Para aprovar, digite sua senha e clique no bot&atilde;o</td>
          </tr>
          <?
    } ?>
          
        </table></td>
      </tr>
    </table>
	</span><span id="aba3">

	  </span></td>
  </tr>
</table>
</form>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td height="19" align="left" valign="top">
      <br />
      <a href="javascript:history.go(-1);">
        voltar      </a>
      <hr />
	<font color="#999999" size="1">Datamace Inform&aacute;tica 
    2006
    </font></td>
  </tr>
</table>
<blockquote>&nbsp;</blockquote>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsItem);

mysql_free_result($rsClientes);

mysql_free_result($rsUsuarios);

mysql_free_result($rsStatus);

mysql_free_result($osTipoOrcamento);
?>
<script>



function vai(aSetor) {
  var campo;
	campo = document.form1.tipo_aprovacao;
	if (campo.value == 0) {
	  window.alert("Selecione o tipo de aprovação");
	  campo.focus();
	  return false;
	}
  
  document.form1.submit();
}
</script>
