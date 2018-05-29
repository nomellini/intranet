<?

  require("../../scripts/conn.php");

  $sql = "SELECT 
    * 
  from 
    satligacao 
  where 
    FL_ATIVO = 0
  order by 
    data desc, hora_inicio desc";
	
  $result = mysql_query($sql) or die(mysql_error());
  
  
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Liga&ccedil;&otilde;es inativas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../stilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="136" bgcolor="#003366"><span class="style1">Cliente</span></td>
    <td width="89" bgcolor="#003366"><span class="style1">Data</span></td>
    <td width="105" bgcolor="#003366"><span class="style1">Hora</span></td>
    <td width="307" bgcolor="#003366"><span class="style1">Motivo</span></td>
  </tr>
  
  <?
  while ($linha=mysql_fetch_object($result)) {
  ?>
  
  <tr>
    <td bgcolor="#FFFFFF"><?=$linha->id_cliente?></td>
    <td bgcolor="#FFFFFF"><?=$linha->data?></td>
    <td bgcolor="#FFFFFF"><?=$linha->hora_inicio?></td>
    <td bgcolor="#FFFFFF"><?=$linha->motivo_status?></td>
  </tr>
  <?
   }
  ?>
</table>
</body>
</html>
