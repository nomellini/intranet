<?php require_once('../../Connections/sad.php'); ?>
<?
    if ( isset($id_chamado))
	{
		$id = $id_chamado;
	}
	if ($id) {	
		$id_chamado = $id;
	} else {
		$id_chamado = "-0100";	
	}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
}

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
}

mysql_select_db($database_sad, $sad);
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);

$colname_rsChamado = "-1";
if (isset($_POST['id'])) {
  $colname_rsChamado = (get_magic_quotes_gpc()) ? $_POST['id'] : addslashes($_POST['id']);
}
$colname_rsChamado = $id;
mysql_select_db($database_sad, $sad);
$query_rsChamado = sprintf("SELECT * FROM chamado WHERE id_chamado = %s", GetSQLValueString($colname_rsChamado, "int"));
$rsChamado = mysql_query($query_rsChamado, $sad) or die(mysql_error());
$row_rsChamado = mysql_fetch_assoc($rsChamado);
$totalRows_rsChamado = mysql_num_rows($rsChamado);

mysql_select_db($database_sad, $sad);
$query_rsDonos = "SELECT nome, email FROM usuario WHERE id_usuario = 12";
$rsDonos = mysql_query($query_rsDonos, $sad) or die(mysql_error());
$row_rsDonos = mysql_fetch_assoc($rsDonos);
$totalRows_rsDonos = mysql_num_rows($rsDonos);

$colname_rsCategoria = "-1";
if (isset($_POST['id'])) {
  $colname_rsCategoria = (get_magic_quotes_gpc()) ? $_POST['id'] : addslashes($_POST['id']);
}
$colname_rsCategoria = $id;
mysql_select_db($database_sad, $sad);
$query_rsCategoria = sprintf("SELECT * FROM categoria WHERE sistema_id = (select sistema_id from chamado where id_chamado = %s) ORDER BY categoria ASC", GetSQLValueString($colname_rsCategoria, "int"));
$rsCategoria = mysql_query($query_rsCategoria, $sad) or die(mysql_error());
$row_rsCategoria = mysql_fetch_assoc($rsCategoria);
$totalRows_rsCategoria = mysql_num_rows($rsCategoria);

mysql_select_db($database_sad, $sad);
$query_rsSistena = "SELECT id_sistema, sistema FROM sistema ORDER BY sistema ASC";
$rsSistena = mysql_query($query_rsSistena, $sad) or die(mysql_error());
$row_rsSistena = mysql_fetch_assoc($rsSistena);
$totalRows_rsSistena = mysql_num_rows($rsSistena);

mysql_select_db($database_sad, $sad);
$query_rsContatos = "SELECT id_contato, historico, dataa, horaa FROM contato WHERE chamado_id = $id_chamado order by dataa desc, horaa desc";
$rsContatos = mysql_query($query_rsContatos, $sad) or die(mysql_error());
$row_rsContatos = mysql_fetch_assoc($rsContatos);
$totalRows_rsContatos = mysql_num_rows($rsContatos);
?><?
	require("../scripts/conn.php");	   		
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
    $pode = pegaManut($ok);   
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {

	if ($acao=='editar') {
	  $desc = mysql_real_escape_string($descricao);
	  if (isset($_POST["visible"])) {
		  $visible = "1";
	  } else {
		  $visible = "0";	  
	  }
	  
	  $sql = "update chamado set visible = $visible, sistema_id=$sistema_id, ";
	  $sql .= "dataa = '$data', horaa = '$hora',	  ";
	  $sql .= "consultor_id=$consultor_id, destinatario_id=$destinatario_id, descricao='$desc' ";
	  
	  if ($categoria_id) {
	  	$sql .= ", categoria_id = $categoria_id ";
	  }
	  
	  $sql .= " where id_chamado=$id_chamado";
	  
	  //die($sql);
	  
	  mysql_query($sql) or die (mysql_error() . ' - :' . $sql);
      //echo $sql;
	  $acao='ver';
	  $id=$id_chamado;
      header( 'Location: ec.php?acao=ver&id='.$id ) ;
	}	

	if ($acao=='deletar') {
	  $sql = "delete from chamado where id_chamado = $idchamado";
	  mysql_query($sql);
	  $sql = "delete from contato whete chamado_id = $idchamado";
	  mysql_query($sql);
	  $acao='ver';
	  $id=$id_chamado;
	}	
	
	if ($acao=='ver') {
		$sql = "";
		$sql .= "select ";
		$sql .= "	sis.sistema, ";
		$sql .= "	c.destinatario_id, ";
		$sql .= "	c.consultor_id, ";
		$sql .= "	c.sistema_id, ";
		$sql .= "	c.descricao, ";
		$sql .= "	c.dataa, ";
		$sql .= "	c.horaa, ";
		$sql .= "	u1.nome dono, ";
		$sql .= "	u2.nome destinatario, ";
		$sql .= "	cat.categoria, ";
		$sql .= "	c.categoria_id ";
		$sql .= "from ";
		$sql .= "	chamado c ";
		$sql .= "		left join usuario u1 on u1.id_usuario = c.consultor_id ";
		$sql .= "		left join usuario u2 on u2.id_usuario = c.destinatario_id ";
		$sql .= "		left join categoria cat on cat.id_categoria = c.categoria_id " ;
		$sql .= "		left join sistema sis on sis.id_sistema = c.sistema_id ";
		$sql .= "where ";
		$sql .= "	id_chamado = $id	";
	 
	  $result = mysql_query($sql) or die ($sql . "<br>" . mysql_error());
	if ($linha = mysql_fetch_object($result)) {
		$dataa = $linha->dataa;
		$horaa = $linha->horaa;
		$id_dono = $linha->consultor_id;
		$id_categoria = $linha->categoria_id;
		$id_sistema = $linha->sistema_id;
		$descricao = $linha->descricao;
		$destinatario = $linha->destinatario;
		$id_destinatario = $linha->destinatario_id;
		$dono = $linha->dono;
		$categoria = $linha->categoria;	
		$sistema = $linha->sistema;
		mysql_select_db($database_sad, $sad);
		$query_rsCat = "SELECT id_categoria, categoria FROM categoria ";
		$query_rsCat .= " WHERE sistema_id = " . $linha->sistema_id;
		$query_rsCat .= " order by categoria";
		$rsCat = mysql_query($query_rsCat, $sad) or die(mysql_error());
		$row_rsCat = mysql_fetch_assoc($rsCat);
		$totalRows_rsCat = mysql_num_rows($rsCat);  		 	  
		  
	} else {
		$descricao = "Chamado não $id existe";
	}
}
	

?><html>
<head>
<title>usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
<img src="../figuras/intro.gif" width="321" height="21"></font> </div>
<form name="form" method="post" >
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="11%">Chamado</td>
      <td width="89%"><input name="id" type="text" class="borda_fina" id="id" value="<?=$id?>">
        <input name="acao" type="hidden" id="acao" value="ver">
        <input name="Submit" type="submit" class="borda_fina" value="ok"></td>
    </tr>
    
  </table>
</form>
<form name="form1" method="post" action="ec.php">
  <table border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="50%" valign="top">
	  <FieldSet>
	  <Legend>Resumo do Chamado para manutenção</Legend>
	  	<div class="ListaContatos">
	  <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr valign="top">
          <td>Sistema</td>
          <td><select name="sistema_id" class="borda_fina" id="sistema_id">
                <?php
do {  
?>
                <option value="<?php echo $row_rsSistena['id_sistema']?>"<?php if (!(strcmp($row_rsSistena['id_sistema'], $row_rsChamado['sistema_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSistena['sistema']?></option>
                <?php
} while ($row_rsSistena = mysql_fetch_assoc($rsSistena));
  $rows = mysql_num_rows($rsSistena);
  if($rows > 0) {
      mysql_data_seek($rsSistena, 0);
	  $row_rsSistena = mysql_fetch_assoc($rsSistena);
  }
?>
              </select></td>
        </tr>
        <tr valign="top">
          <td width="10%">Descri&ccedil;&atilde;o</td>
          <td width="90%"><label>
            <textarea name="descricao" cols="60" rows="9" class="borda_fina" id="descricao"><?=$descricao?>
      </textarea>
          </label></td>
        </tr>
        <tr valign="top">
          <td>Data </td>
          <td><input name="data" type="text" class="borda_fina" value="<?= $dataa?>">  aaaa-mm-dd </td>
        </tr>
        <tr valign="top">
          <td>Hora </td>
          <td><input name="hora" type="text" class="borda_fina" value="<?= $horaa?>"> hh:mm:ss</td>
        </tr>
        <tr valign="top">
          <td>Dono</td>
          <td><select name="consultor_id" class="borda_fina" id="consultor_id">
              <option value="0">Selecione</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsUsuarios['id_usuario']?>" <?php if (!(strcmp($row_rsUsuarios['id_usuario'], $id_dono))) {echo "selected=\"selected\"";} ?> > <?php echo $row_rsUsuarios['nome']?></option>
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
        <tr valign="top">
          <td>Destinat&aacute;rio</td>
          <td><select name="destinatario_id" class="borda_fina" id="destinatario_id">
              <option value="0">Selecione</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsUsuarios['id_usuario']?>" <?php if (!(strcmp($row_rsUsuarios['id_usuario'], $id_destinatario))) {echo "selected=\"selected\"";} ?>  ><?php echo $row_rsUsuarios['nome']?></option>
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
        <tr valign="top">
          <td>Categoria</td>
          <td><select name="categoria_id" class="borda_fina" id="categoria_id">
              <option value="0" <?php if (!(strcmp(0, $row_rsChamado['categoria_id']))) {echo "selected=\"selected\"";} ?>>Selecione</option>
              <?php
do {  
?>
            <option value="<?php echo $row_rsCategoria['id_categoria']?>"<?php if (!(strcmp($row_rsCategoria['id_categoria'], $row_rsChamado['categoria_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsCategoria['categoria']?></option>
            <?php
} while ($row_rsCategoria = mysql_fetch_assoc($rsCategoria));
  $rows = mysql_num_rows($rsCategoria);
  if($rows > 0) {
      mysql_data_seek($rsCategoria, 0);
	  $row_rsCategoria = mysql_fetch_assoc($rsCategoria);
  }
?>
            </select>          </td>
        </tr>
        <tr valign="top">
          <td>&nbsp;</td>
          <td><label>
            <input name="visible" type="checkbox" id="visible" value="checkbox" <?php if (!(strcmp($row_rsChamado['visible'],1))) {echo "checked=\"checked\"";} ?>>
            Visivel</label></td>
        </tr>
        <tr valign="top">
          <td>&nbsp;</td>
          <td><input name="acao" type="hidden" id="acao" value="editar">
              <input name="id_chamado" type="hidden" id="id_chamado" value="<?=$id?>">
              <input name="Submit2" type="button" class="borda_fina" onClick="vai();" value="Confirme"></td>
        </tr>
      </table>
	  </FieldSet>
	  <a href="cnv.php">Listar chamados n&atilde;o vis&iacute;veis</a>
	  </td>
      <td width="50%" valign="top">
	</div>
	<fieldset>	
	<Legend>Contatos</Legend>
	<div class="ListaContatos">
		<?php do { ?>
		<?
			$dataa = explode("-", $row_rsContatos['dataa']);
			$data = "<b>$dataa[2]/$dataa[1]/$dataa[0] " . $row_rsContatos['horaa'] . "</b> ";
 		    $contato = '<a href=EditaContato.php?id_contato=' .$row_rsContatos['id_contato'];
			$contato .= '>' . nl2br( $row_rsContatos['historico']) . "</a>";
			
		?>
		<?php echo $data; ?><br>
		<?php echo $contato; ?>
		<hr color="#FF0000" size="1">
		<?php } while ($row_rsContatos = mysql_fetch_assoc($rsContatos)); ?></p>
	</div>
	</fieldSet>  
	<a href="mc.php?id=<?= $id?>">Excluir chamado</a>
  </td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($rsUsuarios);
mysql_free_result($rsChamado);
mysql_free_result($rsDonos);
mysql_free_result($rsCategoria);
mysql_free_result($rsSistena);
mysql_free_result($rsContatos);
?>
<script>
  function vai() {
    if ( window.confirm('Quer editar mesmo este chamado ?') ) {
	  document.form1.submit();
	}
  }
</script>
<?
}
?>
