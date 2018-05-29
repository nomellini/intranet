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
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);
?><?
 require("../a/scripts/conn.php");		
 $BRDays3 = array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");		 
?>
<html>
<head>
<title>Detalhe</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../a/stilos.css" rel="stylesheet" type="text/css">
</head>

<body background="figuras/fundo.gif" leftmargin="0" topmargin="0" marginwidth="22" marginheight="0">
<form action="" method="post" name="proximos" id="proximos">

  <hr size="1">
  
  <input name="dia" type="hidden" id="dia" value="<?=$dia?>">
  <input name="mes" type="hidden" id="mes" value="<?=$mes?>">
  <input name="ano" type="hidden" id="ano" value="<?=$ano?>">
  
  Compromissos a partir de
<?=$dia?>/<?=$mes?>/<?=$ano?><br> 
  <br>


<?  

	$Hoje = date("Ymd");
	
	$Confidencial = "compromisso.confidencial = 0";
	if ( ($UserID == $Consultor) || ($Consultor == 12)	)
	{
		$Confidencial = "compromisso.confidencial <> -1";
	}

  $p = "";
  $sql = "select  data, resumo, hora, horafim, compromisso.confidencial from usuario, compromisso,  ";
  $sql .= "compromissousuario where compromisso.excluido=0 and $Confidencial and ";
  $sql .= " compromissousuario.id_usuario=usuario.id_usuario ";
  $sql .= "and compromisso.id=compromissousuario.id_compromisso and usuario.id_usuario = " . $UserID;
  $sql .= " and data >= '$ano-$mes-$dia'" ;
  $sql .= " order by data ";
  $result = mysql_query($sql) or die (mysql_error());
 ?> 
<label>
<select name="UserID" class="borda_fina" id="UserID">
  <?php
do {  
?>
  <option value="<?php echo $row_rsUsuarios['id_usuario']?>"<?php if (!(strcmp($row_rsUsuarios['id_usuario'], $UserID))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsUsuarios['nome']?></option>
  <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
</select>
</label>
<label>
<input name="Submit" type="submit" class="borda_fina" value="Pesquisar">
</label>
<br>
<br>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#003366">
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr valign="top" bgcolor="#003366"> 
          <td width="15%"><font color="#FFFFFF"><strong>Data</strong></font></td>
          <td width="12%"><font color="#FFFFFF"><strong>Hora</strong></font></td>
          <td width="73%"><font color="#FFFFFF"><strong>Resumo</strong></font></td>
        </tr>
<?		
  while ( $linha2=mysql_fetch_object($result) ) {
    $data = explode("-", $linha2->data);  	
	$Dia_Evento = $data[0].$data[1].$data[2];	
	$color = "FFFFFF";
	if ($Dia_Evento < $Hoje) 
	{
		$color = "cccccc";
	}	
	$DataContato = DiaDaSemana($linha2->data);	
	$Confidencial = $linha2->confidencial ? "Confidencial" : "Público";	
	$data = "$data[2]/$data[1]/$data[0]";
?>
		
        <tr valign="top" bgcolor="#<?=$color?>"> 
          <td><font face="tahoma"><?="$data - $DataContato"?></font></td>
          <td><font face="tahoma"><?=substr($linha2->hora,0,5)?> - <?=substr($linha2->horafim,0,5)?></font></td>
          <td><font face="tahoma"><?="$linha2->resumo [$Confidencial]" ?> </font></td>
        </tr>
<?
}
?>		
      </table></td>
  </tr>
</table>
</form>
</body>
</html>
<?php
mysql_free_result($rsUsuarios);
?>