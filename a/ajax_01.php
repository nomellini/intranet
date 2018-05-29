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
$query_rsConsultores = "SELECT count(*) as qtde FROM usuario WHERE ativo = 1 and Estado = 2";
$rsConsultores = mysql_query($query_rsConsultores, $sad) or die(mysql_error());
$row_rsConsultores = mysql_fetch_assoc($rsConsultores);
$totalRows_rsConsultores = mysql_num_rows($rsConsultores);

if ($status_id==2) {

    $_QTDE = 2;
    /*
	  Limita em 2 a quantidade de consultores com status não disponível
	*/
    if ( $row_rsConsultores['qtde'] >= $_QTDE ) {
    	$html = "<b><font color=#ff0000> Você não pode alterar seu status para Não Disponível neste momento, pois outros " . $row_rsConsultores['qtde'] . " consultores já estão não disponíveis</font></b>";
	} else {
	    $html = '<input name="Submit2" type="submit" class="borda_fina" value="ok">';
	}
} else {
	    $html = '<input name="Submit2" type="submit" class="borda_fina" value="ok">';
}
	
?>

div = document.getElementById('msg_muda_status');
div.innerHTML = '<?php echo $html; ?>';
<?php
mysql_free_result($rsConsultores);
?>
