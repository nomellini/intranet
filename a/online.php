<?
require("scripts/conn.php");
$data = date("d/m/Y");
$hora = date("H:i:s");
?>
<html>
<head>
<title>On Line</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="5">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?	
  $data = date("Y-m-d");
  $hora = date("H:i:s");
  $sql =  "update online set online=0 where data<>'$data' or '$hora' > (SEC_TO_TIME( TIME_TO_SEC(hora)+900 ))";
  mysql_query($sql);
  $sql =  "delete from  online where data<>'$data' or '$hora' > (SEC_TO_TIME( TIME_TO_SEC(hora)+1800 ))";
  mysql_query($sql); 

  $sql = "select (SEC_TO_TIME( TIME_TO_SEC(hora)+900 )) as corte, usuario.nome, online.* from online, usuario where usuario.id_usuario=online.id_usuario order by online.online desc, usuario.nome;";  
  $result = mysql_query($sql) or die ($sql);
?>
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
<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr bgcolor="#666666" align="center" valign="middle"> 
    <td><b><font color="#FFFFFF" face="tahoma" size="2">Nome</font></b></td>
    <td width="15%"> <font color="#FFFFFF"><b><font face="tahoma" size="2">Id 
      </font></b></font></td>
    <td width="15%"> <font color="#FFFFFF"><b><font face="tahoma" size="2">Ip 
      </font></b></font></td>
    <td width="15%"> <font color="#FFFFFF"><b><font face="tahoma" size="2">Login 
      </font></b></font></td>
    <td width="15%"><b><font color="#FFFFFF" face="tahoma" size="2">Status</font></b></td>
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
    <td height="19"><font face="tahoma" size="2"> 
      <?=$conta?>
      . 
      <?=$linha->nome?>
      </font></td>
    <td width="15%" align="center" valign="middle" height="19"> <font face="tahoma" size="2"> 
      <?=$linha->id_usuario?>
      </font> </td>
    <td width="15%" align="center" valign="middle" height="19"> <font face="tahoma" size="2"> 
      <?=$linha->ip?>
      </font> </td>
    <td width="15%" align="center" valign="middle" height="19"> <b><font face="tahoma" size="2"> 
      <?=$linha->hora?>
      <br>
      </font> </b></td>
    <td width="15%" align="center" valign="middle" height="19"><font face="tahoma" size="2"> 
      <?=$linha->online?"On Line":"Ausente"?>
      </font></td>
  </tr>
  <?}?>
</table>
<p>&nbsp;</p>
</body>
</html>
