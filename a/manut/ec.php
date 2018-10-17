<?
	require_once('../../a/scripts/conn.php'); 
	require("../scripts/funcoes.php");

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
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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


$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);

$colname_rsChamado = "-1";
if (isset($_POST['id'])) {
  $colname_rsChamado = (get_magic_quotes_gpc()) ? $_POST['id'] : addslashes($_POST['id']);
}
$colname_rsChamado = $id;

$query_rsChamado = sprintf("SELECT * FROM chamado WHERE id_chamado = %s", GetSQLValueString($colname_rsChamado, "int"));
$rsChamado = mysql_query($query_rsChamado) or die(mysql_error());
$row_rsChamado = mysql_fetch_assoc($rsChamado);
$totalRows_rsChamado = mysql_num_rows($rsChamado);


$query_rsDonos = "SELECT nome, email FROM usuario WHERE id_usuario = 12";
$rsDonos = mysql_query($query_rsDonos) or die(mysql_error());
$row_rsDonos = mysql_fetch_assoc($rsDonos);
$totalRows_rsDonos = mysql_num_rows($rsDonos);

$colname_rsCategoria = "-1";
if (isset($_POST['id'])) {
  $colname_rsCategoria = (get_magic_quotes_gpc()) ? $_POST['id'] : addslashes($_POST['id']);
}
$colname_rsCategoria = $id;

$query_rsCategoria = sprintf("SELECT * FROM categoria WHERE sistema_id = (select sistema_id from chamado where id_chamado = %s) ORDER BY categoria ASC", GetSQLValueString($colname_rsCategoria, "int"));
$rsCategoria = mysql_query($query_rsCategoria) or die(mysql_error());
$row_rsCategoria = mysql_fetch_assoc($rsCategoria);
$totalRows_rsCategoria = mysql_num_rows($rsCategoria);


$query_rsSistena = "SELECT id_sistema, sistema FROM sistema ORDER BY sistema ASC";
$rsSistena = mysql_query($query_rsSistena) or die(mysql_error());
$row_rsSistena = mysql_fetch_assoc($rsSistena);
$totalRows_rsSistena = mysql_num_rows($rsSistena);


$query_rsContatos = "SELECT id_contato, historico, dataa, horaa FROM contato WHERE chamado_id = $id_chamado order by dataa desc, horaa desc";
$rsContatos = mysql_query($query_rsContatos) or die(mysql_error());
$row_rsContatos = mysql_fetch_assoc($rsContatos);
$totalRows_rsContatos = mysql_num_rows($rsContatos);


$query_rsStatus = "SELECT * FROM status";
$rsStatus = mysql_query($query_rsStatus) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);


$query_rsPrioridade = "SELECT id_prioridade, prioridade FROM prioridade";
$rsPrioridade = mysql_query($query_rsPrioridade) or die(mysql_error());
$row_rsPrioridade = mysql_fetch_assoc($rsPrioridade);
$totalRows_rsPrioridade = mysql_num_rows($rsPrioridade);


$query_rsDiagnostico = "SELECT * FROM diagnostico order by diagnostico";
$rsDiagnostico = mysql_query($query_rsDiagnostico) or die(mysql_error());
$row_rsDiagnostico = mysql_fetch_assoc($rsDiagnostico);
$totalRows_rsDiagnostico = mysql_num_rows($rsDiagnostico);


$query_rsMotivos = "SELECT * FROM motivo ORDER BY motivo ASC";
$rsMotivos = mysql_query($query_rsMotivos) or die(mysql_error());
$row_rsMotivos = mysql_fetch_assoc($rsMotivos);
$totalRows_rsMotivos = mysql_num_rows($rsMotivos);


$query_rsClientes = "SELECT id_cliente, concat(cliente,  ' [', id_cliente, ']') cliente FROM cliente ORDER BY cliente ASC";
$rsClientes = mysql_query($query_rsClientes) or die(mysql_error());
$row_rsClientes = mysql_fetch_assoc($rsClientes);
$totalRows_rsClientes = mysql_num_rows($rsClientes);

$colname_rsContatosEmAndamento = "-1";
if (isset($_GET['id'])) {
  $colname_rsContatosEmAndamento = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}

$query_rsContatosEmAndamento = sprintf("SELECT * FROM contato_temp WHERE id_chamado = %s", $colname_rsContatosEmAndamento);
$rsContatosEmAndamento = mysql_query($query_rsContatosEmAndamento) or die(mysql_error());
$row_rsContatosEmAndamento = mysql_fetch_assoc($rsContatosEmAndamento);
$totalRows_rsContatosEmAndamento = mysql_num_rows($rsContatosEmAndamento);
?><?


	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
    
	$pode = connPodeEditarChamado($ok);
	
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


	  if (isset($_POST["externo"])) {
		  $externo = "1";
	  } else {
		  $externo = "0";	  
	  }

	  
	  if (!$chamado_pai_id) {
		  $chamado_pai_id = '0';
	  }

	$dt_release = $dt_versao;
	$sql = "update chamado set rnc = $rnc, nomecliente='$nomecliente', cliente_id = '$id_cliente', externo = $externo,  visible = $visible, sistema_id=$sistema_id, datauc = '$datauc', dataa = '$data', horaa = '$hora', status	=$status, prioridade_id=$id_prioridade, diagnostico_id=$id_diagnostico, email='$Email', id_chamado_espera = $id_chamado_espera, motivo_id = $motivo_id, chamado_pai_motivo='$chamado_pai_motivo', chamado_pai_id=$chamado_pai_id, data_Limite_1 = '$data_limite_1', data_Limite_2 = '$data_limite_2', data_Limite_3 = '$data_limite_3', data_Limite_4 = '$data_limite_4', consultor_id=$consultor_id, destinatario_id=$destinatario_id, descricao='$desc', Ds_Versao='$ds_versao', Dt_Release='$dt_release' "; 
	  
	  if ($categoria_id) {
	  	$sql .= ", categoria_id = $categoria_id ";
	  }
	  
	  $sql .= " where id_chamado=$id_chamado";
	  
	  //die($sql);
	  
	  mysql_query($sql) or die (mysql_error() . ' - :' . $sql);
      //echo $sql;
	  $acao='ver';
	  $id=$id_chamado;
      header( 'Location: ../historicochamado.php?&id_chamado='.$id ) ;
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

		$query_rsCat = "SELECT id_categoria, categoria FROM categoria ";
		$query_rsCat .= " WHERE sistema_id = " . $linha->sistema_id;
		$query_rsCat .= " order by categoria";
		$rsCat = mysql_query($query_rsCat) or die(mysql_error());
		$row_rsCat = mysql_fetch_assoc($rsCat);
		$totalRows_rsCat = mysql_num_rows($rsCat);  		 	  
		  
	} else {
		$descricao = "Chamado não $id existe";
	}
}
	

?><html>
<head>
<title>usuarios</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
      <td width="663" valign="top">
	  <FieldSet>
	  <Legend>Resumo do Chamado para manutenção</Legend>
	  	<div class="oListaContatos">
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
          <td>VERS&Atilde;O</td>
          <td><input name="ds_versao" type="text" class="borda_fina" id="Email3" value="<?php echo $row_rsChamado['Ds_Versao']; ?>" size="10">
            /
              <input name="dt_versao" type="text" class="borda_fina" id="Email4" value="<?php echo $row_rsChamado['Dt_Release']; ?>" size="10"> &nbsp;<img src="../../imagens/novo.gif" width="45" height="15" alt=""/></td>
        </tr>
        <tr valign="top">
          <td>Cliente</td>
          <td><select name="id_cliente" class="borda_fina" id="id_cliente">
            <?php
do {  
?>
            <option value="<?php echo $row_rsClientes['id_cliente']?>"<?php if (!(strcmp($row_rsClientes['id_cliente'], $row_rsChamado['cliente_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsClientes['cliente']?></option>
            <?php
} while ($row_rsClientes = mysql_fetch_assoc($rsClientes));
  $rows = mysql_num_rows($rsClientes);
  if($rows > 0) {
      mysql_data_seek($rsClientes, 0);
	  $row_rsClientes = mysql_fetch_assoc($rsClientes);
  }
?>
          </select></td>
        </tr>
        <tr valign="top">
          <td width="10%">Descri&ccedil;&atilde;o</td>
          <td width="90%"><label>
            <textarea name="descricao" cols="70" rows="8" class="borda_fina" id="descricao"><?=$descricao?>
      </textarea>
          </label></td>
        </tr>
        <tr valign="top">
          <td>Assunto</td>
          <td><label>
            <input name="Assunto" type="text" class="borda_fina" id="Assunto" value="<?php echo $row_rsChamado['assunto']; ?>">
          </label></td>
        </tr>
        <tr valign="top">
          <td>Data </td>
          <td><input name="data" type="text" class="borda_fina" value="<?= $dataa?>">  
          &uacute;ltimo contato 
            <input name="datauc" type="text" class="borda_fina" id="datauc" value="<?php echo $row_rsChamado['datauc']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>Hora </td>
          <td><input name="hora" type="text" class="borda_fina" value="<?= $horaa?>"> hh:mm:ss</td>
        </tr>
        <tr valign="top">
          <td>Status</td>
          <td><select name="status" class="borda_fina" id="status">
            <?php
do {  
?>
            <option value="<?php echo $row_rsStatus['id_status']?>"<?php if (!(strcmp($row_rsStatus['id_status'], $row_rsChamado['status']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStatus['status']?></option>
            <?php
} while ($row_rsStatus = mysql_fetch_assoc($rsStatus));
  $rows = mysql_num_rows($rsStatus);
  if($rows > 0) {
      mysql_data_seek($rsStatus, 0);
	  $row_rsStatus = mysql_fetch_assoc($rsStatus);
  }
?>
          </select>
            <label></label></td>
        </tr>
        <tr valign="top">
          <td>Prioridade</td>
          <td><select name="id_prioridade" class="borda_fina" id="id_prioridade">
            <?php
do {  
?>
            <option value="<?php echo $row_rsPrioridade['id_prioridade']?>"<?php if (!(strcmp($row_rsPrioridade['id_prioridade'], $row_rsChamado['prioridade_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsPrioridade['prioridade']?></option>
            <?php
} while ($row_rsPrioridade = mysql_fetch_assoc($rsPrioridade));
  $rows = mysql_num_rows($rsPrioridade);
  if($rows > 0) {
      mysql_data_seek($rsPrioridade, 0);
	  $row_rsPrioridade = mysql_fetch_assoc($rsPrioridade);
  }
?>
          </select>
            <br>
            Chamado
            <label>Espera 
            <input name="id_chamado_espera" type="text" class="borda_fina" id="id_chamado_espera" value="<?php echo $row_rsChamado['Id_chamado_espera']; ?>">
            </label></td>
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
          <td>Motivo</td>
          <td><select name="motivo_id" class="borda_fina" id="motivo_id">
            <option value="0" <?php if (!(strcmp(0, $row_rsChamado['motivo_id']))) {echo "selected=\"selected\"";} ?>>Selecione</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsMotivos['id_motivo']?>"<?php if (!(strcmp($row_rsMotivos['id_motivo'], $row_rsChamado['motivo_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsMotivos['motivo']?></option>
            <?php
} while ($row_rsMotivos = mysql_fetch_assoc($rsMotivos));
  $rows = mysql_num_rows($rsMotivos);
  if($rows > 0) {
      mysql_data_seek($rsMotivos, 0);
	  $row_rsMotivos = mysql_fetch_assoc($rsMotivos);
  }
?>
          </select></td>
        </tr>
        <tr valign="top">
          <td>Diagn&oacute;stico</td>
          <td><select name="id_diagnostico" class="borda_fina" id="id_diagnostico">
            <option value="0" <?php if (!(strcmp(0, $row_rsChamado['diagnostico_id']))) {echo "selected=\"selected\"";} ?>>Não cadastrado</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsDiagnostico['id_diagnostico']?>"<?php if (!(strcmp($row_rsDiagnostico['id_diagnostico'], $row_rsChamado['diagnostico_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsDiagnostico['diagnostico']?></option>
            <?php
} while ($row_rsDiagnostico = mysql_fetch_assoc($rsDiagnostico));
  $rows = mysql_num_rows($rsDiagnostico);
  if($rows > 0) {
      mysql_data_seek($rsDiagnostico, 0);
	  $row_rsDiagnostico = mysql_fetch_assoc($rsDiagnostico);
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
          <td>Pessoa contatada</td>
          <td><input name="nomecliente" type="text" class="borda_fina" id="Email2" value="<?php echo $row_rsChamado['nomecliente']; ?>" size="60"></td>
        </tr>
        <tr valign="top">
          <td>E-mail</td>
          <td><input name="Email" type="text" class="borda_fina" id="Email" value="<?php echo $row_rsChamado['email']; ?>" size="60"></td>
        </tr>
        <tr valign="top">
          <td>&nbsp;</td>
          <td><label>
            <input name="visible" type="checkbox" id="visible" value="checkbox" <?php if (!(strcmp($row_rsChamado['visible'],1))) {echo "checked=\"checked\"";} ?>>
            Visivel no desktop</label></td>
        </tr>
        <tr valign="top">
          <td>Limite 1 </td>
          <td><input name="data_limite_1" type="text" class="borda_fina" id="data_limite_1" value="<?php echo $row_rsChamado['data_limite_1']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>Limite 2 </td>
          <td><input name="data_limite_2" type="text" class="borda_fina" id="data_limite_2" value="<?php echo $row_rsChamado['data_limite_2']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>Limite 3 </td>
          <td><input name="data_limite_3" type="text" class="borda_fina" id="data_limite_3" value="<?php echo $row_rsChamado['data_limite_3']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>Limite 4 </td>
          <td><input name="data_limite_4" type="text" class="borda_fina" id="data_limite_4" value="<?php echo $row_rsChamado['data_limite_4']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>Chamado_pai_id</td>
          <td><input name="chamado_pai_id" type="text" class="borda_fina" id="chamado_pai_id" value="<?php echo $row_rsChamado['chamado_pai_id']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>Chamado_pai_motivo</td>
          <td><input name="chamado_pai_motivo" type="text" class="borda_fina" id="chamado_pai_motivo" value="<?php echo $row_rsChamado['chamado_pai_motivo']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>Vis&iacute;vel ao cliente</td>
          <td><input name="externo" type="checkbox" id="externo" value="1" <?php if (!(strcmp($row_rsChamado['externo'],1))) {echo "checked=\"checked\"";} ?>></td>
        </tr>
        <tr valign="top">
          <td>RNC</td>
          <td><input name="rnc" type="text" class="borda_fina" id="rnc" value="<?php echo $row_rsChamado['rnc']; ?>"></td>
        </tr>
        <tr valign="top">
          <td>&nbsp;</td>
          <td><input name="acao" type="hidden" id="acao" value="editar">
              <input name="id_chamado" type="hidden" id="id_chamado" value="<?=$id?>">
              <input name="Submit2" type="button" class="borda_fina" onClick="vai();" value="Confirme"></td>
        </tr>
      </table>
	  </FieldSet>
	<a href="cnv.php">Listar chamados n&atilde;o vis&iacute;veis</a>	  </td>
      <td width="468" valign="top">

	<fieldset>	
	<Legend>Contatos</Legend>
	<div class="ListaContatos">
		<?php do { ?>
		<?
			$dataa = explode("-", $row_rsContatos['dataa']);
			$data = "<b>$dataa[2]/$dataa[1]/$dataa[0] " . $row_rsContatos['horaa'] . "</b> ";
 		    $contato = '<a href=EditaContato.php?id=' . $userid . '&id_contato=' .$row_rsContatos['id_contato'];
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

<br>
<form name="form2" method="post" action="">
  Contatos:<br>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>A&ccedil;&atilde;o</td>
      <td>Usu&aacute;rio</td>
      <td>Data</td>
      <td>Hora in&iacute;cio </td>
      <td>Texto</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><a href="excluiContatoEmAndamento.php?id_chamado=<?php echo $row_rsContatosEmAndamento['id_chamado']; ?>&id_user=<?php echo $row_rsContatosEmAndamento['id_usuario']; ?>">Excluir</a></td>
        <td><select name="select">
            <?php
do {  
?>
            <option value="<?php echo $row_rsUsuarios['id_usuario']?>"<?php if (!(strcmp($row_rsUsuarios['id_usuario'], $row_rsContatosEmAndamento['id_usuario']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsUsuarios['nome']?></option>
            <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
          </select>
</td>
        <td><?php echo $row_rsContatosEmAndamento['data']; ?></td>
        <td><?php echo $row_rsContatosEmAndamento['hora']; ?></td>
        <td><?php echo $row_rsContatosEmAndamento['contato']; ?></td>
      </tr>
      <?php } while ($row_rsContatosEmAndamento = mysql_fetch_assoc($rsContatosEmAndamento)); ?>
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
mysql_free_result($rsStatus);
mysql_free_result($rsPrioridade);
mysql_free_result($rsDiagnostico);
mysql_free_result($rsMotivos);
mysql_free_result($rsClientes);
mysql_free_result($rsContatosEmAndamento);
mysql_close($link);
?>
<script>
  function vai() {
    if ( window.confirm('Confirma gravação das alterações ?') ) {
	  document.form1.submit();
	}
  }
</script>
<?
}
?>
