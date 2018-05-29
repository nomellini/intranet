<?php require_once('../../Connections/sad.php'); ?>
<?php require_once('../../Connections/sad.php'); ?>
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
$query_rsCliente = "SELECT id_cliente, cliente FROM cliente ORDER BY cliente ASC";
$rsCliente = mysql_query($query_rsCliente, $sad) or die(mysql_error());
$row_rsCliente = mysql_fetch_assoc($rsCliente);
$totalRows_rsCliente = mysql_num_rows($rsCliente);

mysql_select_db($database_sad, $sad);
$query_rsConsultor = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsConsultor = mysql_query($query_rsConsultor, $sad) or die(mysql_error());
$row_rsConsultor = mysql_fetch_assoc($rsConsultor);
$totalRows_rsConsultor = mysql_num_rows($rsConsultor);
?><?
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
	
	
	$agoraTimeStamp=date("Y-m-d H:i:s");
	$agora=strtotime($agoraTimeStamp);

	$hoje = date("d/m/Y");	
	if(!isset($dataate)) {
      $dataate = $hoje;
	}	
	

    if(!isset($datade)) {
       $datade = date("d/m/Y", time() - ( 86400 * 0 ) );  
	}
	
	$dataDeSql = explode('/', $datade);
	$dataDeSql = "$dataDeSql[2]-$dataDeSql[1]-$dataDeSql[0]";
	
	$dataAteSql = explode('/', $dataate);
	$dataAteSql = "$dataAteSql[2]-$dataAteSql[1]-$dataAteSql[0]";
	
	
	if ($consultoria == 0) {
	  $_CONSULTORIA = "";
	} else if ($consultoria == 1) {
	  $_CONSULTORIA = ", (SELECT count(distinct cliente) FROM clisis c where c.32bit = 'S' and c.cliente = cliente.id_cliente  ) as teste";
	} else {
	  $_CONSULTORIA = ", (SELECT count(distinct cliente) FROM clisis c where c.32bit = 'N' and c.cliente = cliente.id_cliente  ) as teste";
	}

	if ($status==0) {
		$_STATUS = '';
	} else if ($status==1) {
	   $_STATUS = " and chamado.status = 1 ";
	} else {
	   $_STATUS = " and chamado.status <> 1 ";		   
	}
	
	if ($cliente_id=='') {
		$_CLIENTE = '';
	} else {
		$_CLIENTE = " and cliente.id_cliente = '$cliente_id' ";
	}
	
	if ($consultor_id=='') {
    	$_CONSULTOR = '';
	} else {
		$_CONSULTOR = " and usuario.id_usuario = $consultor_id ";
	}
	
	$sql = "SELECT
  cliente.cliente, cliente.id_cliente,
  sec_to_time(sum(time_to_sec(c.horae) - time_to_sec(c.horaa))) as tempo,
  sum(time_to_sec(c.horae) - time_to_sec(c.horaa)) as segundos,
  count(chamado_id) as contatos
  $_CONSULTORIA
  
FROM
  contato c
     inner join usuario on c.consultor_id = usuario.id_usuario
     inner join chamado on chamado.id_chamado = c.chamado_id
     inner join cliente on chamado.cliente_id = cliente.id_cliente
     inner join status on status.id_status = chamado.status
WHERE
  cliente.bloqueio = 0 
  and chamado.descricao <> ''
  and chamado.dataa >= '$dataDeSql'
  and chamado.dataa <= '$dataAteSql'
  $_STATUS
  $_CLIENTE
  $_CONSULTOR
group by cliente, id_cliente
ORDER BY segundos desc
limit 20";
	
//	die ($sql);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tempo de uso</title>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">Tempo de uso da consultoria por cliente </div>

<form id="form2" name="form2" method="post" action="">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td colspan="2">Filtros</td>
  </tr>
  <tr>
    <td width="18%">Tipo de chamado </td>
    <td width="82%"><label>
      <select name="status" class="borda_fina" id="status">
        <option value="0" selected="selected" <? echo $tipo==0 ? "selected=\"selected\"" : ""; ?>  <?php if (!(strcmp(0, $_POST['status']))) {echo "selected=\"selected\"";} ?>>Todos</option>
<option value="1" <?php if (!(strcmp(1, $_POST['status']))) {echo "selected=\"selected\"";} ?>>Encerrados</option>
        <option value="2" <?php if (!(strcmp(2, $_POST['status']))) {echo "selected=\"selected\"";} ?>>Em aberto</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>Tipo de consultoria </td>
    <td><label>
      <select name="consultoria" class="borda_fina" id="consultoria">
        <option value="0" selected="selected" <? echo $tipo==0 ? "selected=\"selected\"" : ""; ?>  <?php if (!(strcmp(0, $_POST['consultoria']))) {echo "selected=\"selected\"";} ?>>Todos</option>
        <option value="1" <?php if (!(strcmp(1, $_POST['consultoria']))) {echo "selected=\"selected\"";} ?>>Pago</option>
        <option value="2" <?php if (!(strcmp(2, $_POST['consultoria']))) {echo "selected=\"selected\"";} ?>>N&atilde;o pago</option>
        </select>
    </label></td>
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
    <td>Cliente</td>
    <td><select name="cliente_id" class="borda_fina" id="cliente_id">
      <option value="" <?php if (!(strcmp("", $_POST['cliente_id']))) {echo "selected=\"selected\"";} ?>>Todos</option>
      <?php
do {  
?>
      <option value="<?php echo $row_rsCliente['id_cliente']?>"<?php if (!(strcmp($row_rsCliente['id_cliente'], $_POST['cliente_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsCliente['cliente']?></option>
      <?php
} while ($row_rsCliente = mysql_fetch_assoc($rsCliente));
  $rows = mysql_num_rows($rsCliente);
  if($rows > 0) {
      mysql_data_seek($rsCliente, 0);
	  $row_rsCliente = mysql_fetch_assoc($rsCliente);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td>Consultor</td>
    <td><select name="consultor_id" class="borda_fina" id="consultor_id">
      <option value="" <?php if (!(strcmp("", $_POST['consultor_id']))) {echo "selected=\"selected\"";} ?>>Todos</option>
      <?php
do {  
?><option value="<?php echo $row_rsConsultor['id_usuario']?>"<?php if (!(strcmp($row_rsConsultor['id_usuario'], $_POST['consultor_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsConsultor['nome']?></option>
        <?php
} while ($row_rsConsultor = mysql_fetch_assoc($rsConsultor));
  $rows = mysql_num_rows($rsConsultor);
  if($rows > 0) {
      mysql_data_seek($rsConsultor, 0);
	  $row_rsConsultor = mysql_fetch_assoc($rsConsultor);
  }
?>
    </select>
      <input name="OrderBy" type="hidden" id="OrderBy" value="<?php echo $_POST['OrderBy']; ?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input <?php if (!(strcmp($_POST['desc'],"DESC"))) {echo "checked=\"checked\"";} ?> name="desc" type="checkbox" id="desc" value="DESC" />
      Listar em ordem decrescente </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" class="borda_fina" value="Submit" /></td>
  </tr>
</table>


     
	  
<table width="65%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="39%">Cliente</td>
            <td width="9%" align="center" valign="middle">Tempo</td>
          </tr>
<?
$result = mysql_query($sql) or die(mysql_error() . "<br>" . $sql);
$segundos = 0; $contatos = 0;
while ($linha = mysql_fetch_object($result)) {

  $paga = 'Paga';
  if ($linha->teste == 0) {
    $paga = 'Não paga';
  }
  

  
 {
 
 	$segundos = $segundos + $linha->segundos;
	$contatos = $contatos + $linha->contatos;
		 ?>		  
          <tr>
            <td bgcolor="#FFFFFF"><a href="../historico.php?id_cliente=<? echo $linha->id_cliente ?>" target="_blank"><? echo "$linha->cliente ($paga)"; ?></a></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><? echo $linha->tempo; ?></td>
          </tr>
		    <?
		  } 
}
		?>		  
          <tr>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><strong>
            <?=segTohora($segundos)?>
            </strong></td>
          </tr>
  </table>	  
  
     </td>
  </tr>
</table>
</form>
<p align="center"><a href="../inicio.php">SAD</a></p>
</body>
</html>
<?php
mysql_free_result($rsCliente);

mysql_free_result($rsConsultor);
echo $sql;
?>
<script>
  function filtraempresa(AEmpresa)
  {
  	document.form2.cliente_id.value = AEmpresa;
	document.form2.submit();
  }
  function filtraconsultor(AUsuario)
  {
  	document.form2.consultor_id.value = AUsuario;
	document.form2.submit();
  }
  function orderby(AColuna) {
  	document.form2.OrderBy.value = AColuna;
	document.form2.submit();    
  }
</script>