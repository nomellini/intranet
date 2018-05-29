<?php require_once('../Connections/sad.php'); ?>
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

mysql_select_db($database_sad, $sad);
$query_rsCliente = "SELECT id_cliente, cliente FROM cliente WHERE id_cliente = '$cliente_id'";
$rsCliente = mysql_query($query_rsCliente, $sad) or die(mysql_error());
$row_rsCliente = mysql_fetch_assoc($rsCliente);
$totalRows_rsCliente = mysql_num_rows($rsCliente);
?><?
	/*
	Preparando o email para ser enviado ao cliente 
	*/

//    ini_set('error_reporting', 'E_ALL');
//    ini_set('display_errors', '1');	


	//mail2($Email, $subject, $textEmail, $headers);
	
		
	$NomeCliente = $objChamado->nomecliente;
	$EmailCliente = $objChamado->email;


	if ($NomeCliente=='') {
		$NomeCliente = 'Nome não cadastrado';
	}
	
	if ($EmailCliente=='') {
		$EmailCliente = 'eder@datamace.com.br';
	}
		
    //$EmailCliente = 'fernando@datamace.com.br';
	
	$Email = $EmailCliente;
	
	$data = explode('-', $objChamado->dataa);
	$data = "$data[2]/$data[1]/$data[0]";

	$descricao = eregi_replace("\r\n", "<br>",$objChamado->descricao);
	$descricao = eregi_replace("\"", "`", $descricao);	
	
	$fileEmail = fopen('_EmailChamado.htm', "r");
	
	$textEmail = fread( $fileEmail, 100000);	
	$textEmail = str_replace("[nome]", "$NomeTreinando ($EmailCliente)", $textEmail);
	$textEmail = str_replace("[id_chamado]", number_format($chamado_id,0,',','.'), $textEmail);
	$textEmail = str_replace("[email]", $EmailCliente, $textEmail);	
	$textEmail = str_replace("[sistema]", pegaSistema($sistema_id), $textEmail);	
    $textEmail = str_replace("[descricao]", $descricao, $textEmail);	
	$textEmail = str_replace("[usuario]", $NomeCliente, $textEmail);
	$textEmail = str_replace("[cliente]", $row_rsCliente['cliente'], $textEmail);				
	$textEmail = str_replace("[data_abertura]", $data, $textEmail);		
	


	$subject = "Chamado $chamado_id - Encerramento";
	$headers = "";
	$headers .= "Suporte Datamace";
	

    if ($cliente_id != 'DATAMACE') {
		mail2($Email, $subject, $textEmail, $headers);
	}

		
	fclose($fileEmail);  
	
	$_data = date("Y-m-d");	
	$sql = "";
	$sql .= "INSERT INTO clienteemail(email, pessoacontatada, chamado, cliente, data) ";
	$sql .= "VALUES ('Email Chamado [$emailpadrao]', '$pessoacontatada', '$chamado_id', '$cliente_id', '$_data')";
	mysql_query($sql) or die ($sql);		
  
?>
<?php
mysql_free_result($rsCliente);
?>