<?php require_once('../cabeca.php'); ?>
<?
	mysql_select_db("sad");
	$quem = $_GET["id"]; 
	$sql = "select id_usuario from usuario where md5(id_usuario) = '$quem'";
	$result = mysql_query($sql) or die (mysql_error()); 
	$linha = mysql_fetch_object($result);
	if (!$linha) {
		die ("Nao pode alterar contato");
	} else {
		$id_usuario = $linha->id_usuario;
	}

	if ($acao == "excluir")
	{
		$Data_Atual = date("Y-m-d");
		$Hora_Atual = date("H:i:s"); 
		$TextoAtual = "'CONTATO EXCLUIDO'";
		$id_contato = GetSQLValueString($_POST['id_contato'], "int");	
		$sql = "select historico, chamado_id from contato where id_contato  = $id_contato";
		$result = mysql_query($sql) or die (mysql_error()); 
		$linha = mysql_fetch_object($result);
		$TextoAnterior = $linha->historico;
		$id_chamado = $linha->chamado_id;
		$sql = "insert into tmp_contato_historico (Id_Usuario, id_contato, id_chamado, Data, Hora, Tx_ContatoDe, Tx_ContatoPara)
		values ($id_usuario, $id_contato, $id_chamado, '$Data_Atual', '$Hora_Atual', '$TextoAnterior', $TextoAtual)";		
		mysql_query($sql);
	} else {		
		if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
			$Data_Atual = date("Y-m-d");
			$Hora_Atual = date("H:i:s"); 
			$TextoAtual = GetSQLValueString($_POST['historico'], "text");
			$id_contato = GetSQLValueString($_POST['id_contato'], "int");	
			$sql = "select historico, chamado_id from contato where id_contato  = $id_contato";
			$result = mysql_query($sql) or die (mysql_error(). ' <br> <br><br> ' . $sql);			
			$linha = mysql_fetch_object($result);
			$TextoAnterior = $linha->historico;
			$id_chamado = $linha->chamado_id;
			
			$TextoAnterior = mysql_real_escape_string ($TextoAnterior);		
			$TextoAtual = mysql_real_escape_string ($TextoAtual);						
			
			$sql = "insert into tmp_contato_historico (Id_Usuario, id_contato, id_chamado, Data, Hora, Tx_ContatoDe, Tx_ContatoPara)
			values ($id_usuario, $id_contato, $id_chamado, '$Data_Atual', '$Hora_Atual', '$TextoAnterior', '$TextoAtual')";
			mysql_query($sql) or die (mysql_error() . ' <br> <br><br> <pre>' . $sql . '</pre>');			
		}
	}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {	
  $updateSQL = sprintf("UPDATE contato SET chamado_id=%s, pessoacontatada=%s, origem_id=%s, historico=%s, consultor_id=%s, destinatario_id=%s, dataa=%s, horaa=%s, datae=%s, horae=%s, publicar=%s, rnc=%s, tipo_rnc=%s, horae_original=%s WHERE id_contato=%s",
                       GetSQLValueString($_POST['chamado_id'], "int"),
                       GetSQLValueString($_POST['pessoacontatada'], "text"),
                       GetSQLValueString($_POST['origem'], "int"),
                       GetSQLValueString($_POST['historico'], "text"),
                       GetSQLValueString($_POST['consultor_id'], "int"),
                       GetSQLValueString($_POST['destinatario_id'], "int"),
                       GetSQLValueString($_POST['dataa'], "date"),
                       GetSQLValueString($_POST['horaa'], "date"),
                       GetSQLValueString($_POST['dataa'], "date"),					   
                       GetSQLValueString($_POST['horae'], "date"),
                       GetSQLValueString(isset($_POST['publicar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['rnc'], "int"),
                       GetSQLValueString($_POST['tipo_rnc'], "int"),
                       GetSQLValueString($_POST['horae_original'], "date"),
                       GetSQLValueString($_POST['id_contato'], "int"));	
  $Result1 = mysql_query($updateSQL) or die(mysql_error());
}

$colname_rsContato = "-1";
if (isset($_GET['id_contato'])) {
  $colname_rsContato = $_GET['id_contato'];
}
$colname_rsContato = "-1";
if (isset($_GET['id_contato'])) {
  $colname_rsContato = (get_magic_quotes_gpc()) ? $_GET['id_contato'] : addslashes($_GET['id_contato']);
}


$query_rsContato = sprintf("SELECT * FROM contato WHERE id_contato = %s", $colname_rsContato);
$rsContato = mysql_query($query_rsContato) or die(mysql_error());
$row_rsContato = mysql_fetch_assoc($rsContato);
$totalRows_rsContato = mysql_num_rows($rsContato);


$query_rsOrigem = "SELECT * FROM origem";
$rsOrigem = mysql_query($query_rsOrigem) or die(mysql_error());
$row_rsOrigem = mysql_fetch_assoc($rsOrigem);
$totalRows_rsOrigem = mysql_num_rows($rsOrigem);


$query_rsDestinatarios = "SELECT id_usuario, nome FROM usuario ORDER BY nome ASC";
$rsDestinatarios = mysql_query($query_rsDestinatarios) or die(mysql_error());
$row_rsDestinatarios = mysql_fetch_assoc($rsDestinatarios);
$totalRows_rsDestinatarios = mysql_num_rows($rsDestinatarios);


$query_rsConsultor = "SELECT id_usuario, nome FROM usuario ORDER BY nome ASC";
$rsConsultor = mysql_query($query_rsConsultor) or die(mysql_error());
$row_rsConsultor = mysql_fetch_assoc($rsConsultor);
$totalRows_rsConsultor = mysql_num_rows($rsConsultor);


$query_rsStatus = "SELECT * FROM status";
$rsStatus = mysql_query($query_rsStatus) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);
?>
<?
	if ($acao == "excluir")
	{
		$sql = "Delete from contato where id_contato = $id_contato";
		mysql_query($sql);
	} 
	if ( isset($acao)) {
		header("location: /a/historicochamado.php?&id_chamado=$chamado_id");
	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edita contato</title>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
</head>
<link rel="stylesheet" href="../stilos.css" type="text/css">

<body>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
  <p>Altera&ccedil;&atilde;o de CONTATO:</p>
  <table width="90%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="14%">Coluna</td>
      <td width="86%">Valor</td>
    </tr>
    <tr>
      <td>ID CONTATO </td>
      <td>
      <input name="id_contato" type="text" class="borda_fina" id="id_contato" value="<?php echo $row_rsContato['id_contato']; ?>" size="50" readonly="readonly" disabled="disabled"/> 
      - Hora fim Original: 
      <input name="horae_original" type="text" class="borda_fina" id="horae_original" value="<?php echo $row_rsContato['horae_original']; ?>" /></td>
    </tr>
    <tr>
      <td>CHAMADO</td>
      <td>
      <input name="chamado_id" type="text" class="borda_fina" id="id_chamado" value="<?php echo $row_rsContato['chamado_id']; ?>" size="50" /></td>
    </tr>
    <tr>
      <td>Pessoa Contatada </td>
      <td><input name="pessoacontatada" type="text" class="borda_fina" id="pessoacontatada" value="<?php echo $row_rsContato['pessoacontatada']; ?>" size="50" /></td>
    </tr>
    <tr>
      <td>Data</td>
      <td><input name="dataa" type="text" class="borda_fina" id="dataa" value="<?php echo $row_rsContato['dataa']; ?>" size="12" maxlength="10" /> 
        AAAA-MM-DD </td>
    </tr>
    <tr>
      <td>Hora</td>
      <td>In&iacute;cio: 
        <input name="horaa" type="text" class="borda_fina" id="horaa" value="<?php echo $row_rsContato['horaa']; ?>" size="8" maxlength="8" /> 
        - Fim: 
        <input name="horae" type="text" class="borda_fina" id="horae" value="<?php echo $row_rsContato['horae']; ?>" size="8" maxlength="8" /></td>
    </tr>
    <tr>
      <td>Origem</td>
      <td><select name="origem" class="borda_fina" id="origem">
        <?php
do {  
?>
        <option value="<?php echo $row_rsOrigem['id_origem']?>"<?php if (!(strcmp($row_rsOrigem['id_origem'], $row_rsContato['origem_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsOrigem['origem']?></option>
        <?php
} while ($row_rsOrigem = mysql_fetch_assoc($rsOrigem));
  $rows = mysql_num_rows($rsOrigem);
  if($rows > 0) {
      mysql_data_seek($rsOrigem, 0);
	  $row_rsOrigem = mysql_fetch_assoc($rsOrigem);
  }
?>
      </select> 
      rnc 
      <label>
      <input name="rnc" type="text" id="rnc" size="2" maxlength="2" />
      tipo rnc 
      <input name="tipo_rnc" type="text" id="tipo_rnc" size="2" maxlength="2" />
      </label></td>
    </tr>
    <tr>
      <td>Hist&oacute;rico</td>
      <td><label>
        <textarea  name="historico" cols="80" rows="15"  id="historico"><?php echo $row_rsContato['historico']; ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td>Consultor</td>
      <td><select name="consultor_id" class="borda_fina" id="consultor_id">
        <?php
do {  
?>
        <option value="<?php echo $row_rsConsultor['id_usuario']?>"<?php if (!(strcmp($row_rsConsultor['id_usuario'], $row_rsContato['consultor_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsConsultor['nome']?></option>
        <?php
} while ($row_rsConsultor = mysql_fetch_assoc($rsConsultor));
  $rows = mysql_num_rows($rsConsultor);
  if($rows > 0) {
      mysql_data_seek($rsConsultor, 0);
	  $row_rsConsultor = mysql_fetch_assoc($rsConsultor);
  }
?>
      </select>
      <input name="acao" type="hidden" id="acao" value="editar" />
      <input name="id_contato" type="hidden" id="id_contato" value="<?php echo $row_rsContato['id_contato']; ?>" /></td>
    </tr>
    <tr>
      <td>Destinatario</td>
      <td><select name="destinatario_id" class="borda_fina" id="destinatario_id">
        <?php
do {  
?>
        <option value="<?php echo $row_rsDestinatarios['id_usuario']?>"<?php if (!(strcmp($row_rsDestinatarios['id_usuario'], $row_rsContato['destinatario_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsDestinatarios['nome']?></option>
        <?php
} while ($row_rsDestinatarios = mysql_fetch_assoc($rsDestinatarios));
  $rows = mysql_num_rows($rsDestinatarios);
  if($rows > 0) {
      mysql_data_seek($rsDestinatarios, 0);
	  $row_rsDestinatarios = mysql_fetch_assoc($rsDestinatarios);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>Status</td>
      <td><select name="statusID" class="borda_fina" id="statusID">
        <?php
do {  
?>
        <option value="<?php echo $row_rsStatus['id_status']?>"<?php if (!(strcmp($row_rsStatus['id_status'], $row_rsContato['status_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStatus['status']?></option>
        <?php
} while ($row_rsStatus = mysql_fetch_assoc($rsStatus));
  $rows = mysql_num_rows($rsStatus);
  if($rows > 0) {
      mysql_data_seek($rsStatus, 0);
	  $row_rsStatus = mysql_fetch_assoc($rsStatus);
  }
?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input <?php if (!(strcmp($row_rsContato['publicar'],1))) {echo "checked=\"checked\"";} ?> name="publicar" type="checkbox" id="publicar" value="1" />
      Publicar</label></td>
    </tr>
    <tr>
      <td><label></label></td>
      <td><input type="button" name="Button" value="Alterar" onclick="vai()"/>
      <input type="button" 
	  name="btnExcluir" 
	  value="Exclu&iacute;r este contato" 
	  onclick="excluir();"/></td>
    </tr>
  </table>
  
    
  <input type="hidden" name="MM_update" value="form1">
</form>
<script language="javascript1.3">


	CKEDITOR.replace( 'historico',
		{
			on: { 'instanceReady': function(evt) {
				CKEDITOR.instances.historico.focus();			
			   }
			},
			extraPlugins: 'colorbutton,justify,smiley,horizontalrule,autogrow',			
			setFocusOnStartup : true,			
			enterMode		: 2
		});

	function excluir() 
	{
		if (confirm("Tem Certeza ?"))	
		{
			document.form1.acao.value = "excluir";
			document.form1.submit();
			return true;	
		} else {
			return false;
		}
	}

	function vai()
	{

		/*

        var editor_data = CKEDITOR.instances.historico.getData();				
        CKEDITOR.instances.historico.setData("oi");		
		if (editor_data == "") {
			window.alert("Erro");
			return false;
		}
		
		*/


		
		document.form1.submit();
	}

</script>
</body>
</html>
<?php
mysql_free_result($rsContato);

mysql_free_result($rsOrigem);

mysql_free_result($rsDestinatarios);

mysql_free_result($rsConsultor);

mysql_free_result($rsStatus);
?>
