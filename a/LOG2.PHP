
<?
require("scripts/conn.php");
require("scripts/stats.php");
$data = date("d/m/Y");
$hora = date("H:i:s");
$usu="";
$consultores = pegaConsultores(1);

$busca='';
if ($palavra) {
  $busca = " and pagina like '%$palavra%'";
}

    $sqlLimite = '';
    if (!isset($limite)) {
	  $limite = 50;
	}
	
	if ($limite) {  $sqlLimite = "LIMIT $limite";}

if($id) { $usu= " AND log.id_usuario = $id "; }
?>
<html>
<head>
<title>On Line</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($refresh) { ?>
<meta http-equiv="refresh" content="<?=$sec?>">
<? } ?>
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?	
  $sql = "select left(pagina,13) as pagina, count(*) as soma from log group by left(pagina, 13) order by soma desc;";
  $result = mysql_query($sql) or die ($sql);
?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><font face="tahoma" size="2"> Data e hora no servidor : <b>
      <?="$data - $hora"?></b>
      </font></td>
    <td align="right"><font face="tahoma" size="2">[<a href="javascript:window.close();">fechar</a>]</font> 
    </td>
  </tr>
</table>
<font face="tahoma" size="2"> </font>
<table width="50%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr bgcolor="#666666" align="center" valign="middle"> 
    <td width="31%"><b><font color="#FFFFFF" face="tahoma" size="2">Pagina</font></b></td>
    <td width="13%"> <font color="#FFFFFF"><b><font face="tahoma" size="2">Hits</font></b></font></td>
  </tr>
  <?
  $conta = 0;
  while ($linha=mysql_fetch_object($result)) {  
    $conta++;
	if ( ($conta % 2) ) {
	  $cor = "#F3F3F3";
	} else {
	  $cor = "#ffffff";
	}
  ?>
  <tr bgcolor="<?=$cor?>"> 
    <td height="19" width="31%"><font face="tahoma" size="2"> 
      <?=$linha->pagina?>
	  </font></td>
    <td width="13%" align="center" valign="middle" height="19"> <font face="tahoma" size="2"> 
      <?=$linha->soma?>
      </font> </td>
  </tr>
  <?}?>
</table>
<p>&nbsp;</p>
</body>
</html>
