<?
	require("../scripts/conn.php");		
	require("../scripts/cores.php");				
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}

	if(!isset($orderby)) {
		$orderby = 'dataprevistaliberacao';
	}	
	
	if(!isset($_POST["OrderBy"])) {
		$_POST["OrderBy"] = 'dataprevistaliberacao' ;
	}		
	
	$agoraTimeStamp=date("Y-m-d H:i:s");
	$agora=strtotime($agoraTimeStamp);

	$hoje = date("d/m/Y");	
	if(!isset($datade)) {
      $datade= $hoje;
	}	
	

    if(!isset($dataate)) {
       $dataate = date("d/m/Y", time() + ( 86400 * 7 ) );  
	}
	
	$dataDeSql = explode('/', $datade);
	$dataDeSql = "$dataDeSql[2]-$dataDeSql[1]-$dataDeSql[0]";
	
	$dataAteSql = explode('/', $dataate);
	$dataAteSql = "$dataAteSql[2]-$dataAteSql[1]-$dataAteSql[0]";
	
?>
<?php require_once('../../Connections/sad.php'); ?>
<?php require_once('../scripts/conn.php'); ?>
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

$maxRows_rsChamados = 25;
$pageNum_rsChamados = 0;
if (isset($_GET['pageNum_rsChamados'])) {
  $pageNum_rsChamados = $_GET['pageNum_rsChamados'];
}
$startRow_rsChamados = $pageNum_rsChamados * $maxRows_rsChamados;

$colname_rsChamados = "-1";
if (isset($_POST['liberado'])) {
  $colname_rsChamados = (get_magic_quotes_gpc()) ? $_POST['liberado'] : addslashes($_POST['liberado']);
}

$colname_rsChamados = "-1";
if (isset($_POST['dono_id'])) {
  $colname_rsChamados = (get_magic_quotes_gpc()) ? $_POST['dono_id'] : addslashes($_POST['dono_id']);
}

mysql_select_db($database_sad, $sad);

$query_rsChamados = "SELECT chamado.*, p.prioridade, s.status as statusdesc FROM chamado inner join prioridade p on p.id_prioridade = chamado.prioridade_id inner join status s on s.id_status = chamado.status WHERE (chamado.visible = 1) and (dataprevistaliberacao <> '0000-00-00') and (dataprevistaliberacao>='$dataDeSql') and (dataprevistaliberacao<='$dataAteSql') ";

if ($dono_id <> 0) {
  $query_rsChamados .=  sprintf("and consultor_id = %s ", GetSQLValueString($colname_rsChamados, "int"));
}

$lib = $tipo - 1;
if ($lib <> -1) {
  $query_rsChamados .=  sprintf("and liberado = %s ", GetSQLValueString($lib, "int"));
}

if ($destinatario_id <> 0) {
  $query_rsChamados .=  sprintf("and destinatario_id = %s ", GetSQLValueString($destinatario_id, "str"));
}


$query_rsChamados = $query_rsChamados . " order by $orderby";

$rsChamados = mysql_query($query_rsChamados, $sad) or die(mysql_error() . ' - ' .$query_rsChamados);
$row_rsChamados = mysql_fetch_assoc($rsChamados);
$totalRows_rsChamados = mysql_num_rows($rsChamados);

mysql_select_db($database_sad, $sad);
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);

mysql_select_db($database_sad, $sad);
$query_rsSistemas = "SELECT id_sistema, sistema FROM sistema ORDER BY sistema ASC";
$rsSistemas = mysql_query($query_rsSistemas, $sad) or die(mysql_error());
$row_rsSistemas = mysql_fetch_assoc($rsSistemas);
$totalRows_rsSistemas = mysql_num_rows($rsSistemas);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista de  chamados</title>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
  Relat&oacute;rio dos chamados com data prevista de libera&ccedil;&atilde;o 
</div>

<?
	$EditaDataPrevista = ( 
	     ($ok == 1) or 
		 ($ok == 9) or
		 ($ok==8) or 
		 ($ok==12) or 
		 ($ok==7) 
    );

?>
<form id="form2" name="form2" method="post" action="">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td colspan="2">Filtros</td>
  </tr>
  <tr>
    <td width="11%">Tipo de chamado </td>
    <td width="89%"><label>
      <select name="tipo" class="borda_fina" id="tipo">
        <option value="0" <? echo $tipo==0 ? "selected=\"selected\"" : ""; ?> >Todos</option>
        <option value="2" <? echo $tipo==2 ? "selected=\"selected\"" : ""; ?>>Liberados</option>
        <option value="1" <? echo $tipo==1 ? "selected=\"selected\"" : ""; ?>>N&atilde;o Liberados</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>Dono</td>
    <td><label>
      <select name="dono_id" class="borda_fina" id="dono_id">
        <option value="0" <?php if (!(strcmp(0, $_POST['dono_id']))) {echo "selected=\"selected\"";} ?>>Todos</option>
        <?php
do {  
?>
        <option value="<?php echo $row_rsUsuarios['id_usuario']?>"<?php if (!(strcmp($row_rsUsuarios['id_usuario'], $_POST['dono_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsUsuarios['nome']?></option>
        <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>Destinat&aacute;rio</td>
    <td><select name="destinatario_id" class="borda_fina" id="destinatario_id">
      <option value="0" <?php if (!(strcmp(0, $_POST['destinatario_id']))) {echo "selected=\"selected\"";} ?>>Todos</option>
      <?php
do {  
?>
      <option value="<?php echo $row_rsUsuarios['id_usuario']?>"<?php if (!(strcmp($row_rsUsuarios['id_usuario'], $_POST['destinatario_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsUsuarios['nome']?></option>
      <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
    </select>
      <label></label></td>
  </tr>
  <tr>
    <td>Sistema</td>
    <td><select name="id_sistema" class="borda_fina" id="id_sistema">
      <option value="0" <?php if (!(strcmp(0, $_POST['id_sistema']))) {echo "selected=\"selected\"";} ?>>Todos</option>
      <?php
do {  
?><option value="<?php echo $row_rsSistemas['id_sistema']?>"<?php if (!(strcmp($row_rsSistemas['id_sistema'], $_POST['id_sistema']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSistemas['sistema']?></option>
      <?php
} while ($row_rsSistemas = mysql_fetch_assoc($rsSistemas));
  $rows = mysql_num_rows($rsSistemas);
  if($rows > 0) {
      mysql_data_seek($rsSistemas, 0);
	  $row_rsSistemas = mysql_fetch_assoc($rsSistemas);
  }
?>
    </select> 
      NAO IMPLEMENTADO AINDA 
</td>
  </tr>
  <tr>
    <td>Data In&iacute;cio </td>
    <td>
      <input name="datade" type="text" class="bordaTexto" id="datade" value="<?php echo $datade; ?>" size="12" maxlength="10" />    </td>
  </tr>
  <tr>
    <td>Data Fim </td>
    <td>
      <input name="dataate" type="text" class="bordaTexto" id="dataate" value="<?php echo $dataate; ?>" size="12" maxlength="10" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Classificar por 
      <label>
      <input <?php if (!(strcmp($_POST['OrderBy'],"id_chamado"))) {echo "checked=\"checked\"";} ?> name="orderby" type="radio" value="id_chamado" />
      chamado 
      <input <?php if (!(strcmp($_POST['OrderBy'],"dataprevistaliberacao"))) {echo "checked=\"checked\"";} ?> name="orderby" type="radio" value="dataprevistaliberacao" />
      Data Prevista</label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" class="borda_fina" value="Submit" /></td>
  </tr>
</table>


<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td bgcolor="#FFFFFF">
	
	  <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
    <tr>
      <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
        <tr>
          <td width="16%" align="center"><strong>Chamado </strong></td>
          <td width="16%"><strong>Previs&atilde;o</strong></td>
          <td width="16%"><strong>Liberado ? </strong></td>
          <td width="16%"><strong>Quando</strong></td>
          <td width="16%"><strong>Dono</strong></td>
          <td width="16%"><strong>Destinat&aacute;rio</strong></td>
        </tr>
      </table></td>
    </tr>
  </table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><img src="../../imagens/1pixel.gif" alt="" width="1" height="1" /></td>
    </tr>
  </table>
  
    <?php do { ?>  
          <?
		  $dono_id = $row_rsChamados['consultor_id'];
		  $status = $row_rsChamados['statusdesc'];
		  $prioridade = $row_rsChamados['prioridade'];
          $chamado = $row_rsChamados['id_chamado'];
		  $SimNao = $row_rsChamados['liberado'] == 1 ? "Sim" : "N&atilde;o";
		  if (1) {
		  $SimNao =  "<a href=\"javascript:dataprevista($chamado, $ok);\">$SimNao</a>";
		  }
		  $data = dataOk($row_rsChamados['dataprevistaliberacao']);
		?>
  
  <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#62CCFF">
    <tr>
      <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFEA">
        <tr>
          <td width="16%" align="center" valign="middle"><a href="../historicochamado.php?id_chamado=<?php echo $row_rsChamados['id_chamado']; ?>"><?php echo number_format($row_rsChamados['id_chamado'], 0, ",", "."); ?></a> </br><?=$prioridade?> / <?=$status?></td>
          <td width="16%"><?php echo $data; ?></td>
          <td width="16%"><?php echo $SimNao ?></td>
          <td width="16%"><? echo dataOk($row_rsChamados['dataliberacao']);?></br></td>
          <td width="16%"><?php echo peganomeusuario($dono_id); ?></td>
          <td width="16%"><?php echo peganomeusuario($row_rsChamados['destinatario_id']); ?></td>
        </tr>
      </table></td>
    </tr>
  </table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><img src="../../imagens/1pixel.gif" alt="" width="1" height="1" /></td>
    </tr>
  </table>  
      <?php } while ($row_rsChamados = mysql_fetch_assoc($rsChamados)); ?> 

	
	
	
	
	</td>
  </tr>
</table>
<br />
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
<?php
mysql_free_result($rsChamados);

mysql_free_result($rsUsuarios);

mysql_free_result($rsSistemas);
?>
<script>
	function dataprevista(chamado, usuario) {
	  var newWindow;
	  window.name = "pai";  
	  newWindow = window.open( '../lembrete/EditaDataPrevistaLiberacao.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
	}
</script>
