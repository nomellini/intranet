<?
	require("../scripts/conn.php");	
	$sql = "select memo from todo where id = " . $id;
	$result = mysql_query($sql);
	$linha=mysql_fetch_object($result);	
	$memo = $linha->memo;
	if (!$memo) {
	  $memo = "Sem descrição detalhada";
	}
	$memo = eregi_replace("\r\n", "<br>",$memo);
	$memo = eregi_replace("\"", "`", $memo);	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../stilos.css" rel="stylesheet" type="text/css">
</head>

<body background="../../agenda/figuras/fundo.gif" leftmargin="10" topmargin="10" marginwidth="10" marginheight="10">
<table width="98%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td align="right"><a href="javascript:window.close();">FECHAR</a></td>
  </tr>
</table>
<p><font size="3"><strong>Memo: <font color="#003366"> <br>
  <br>
  <?=$memo?>
  </font></strong><font color="#003366"> </font></font> </p>
</body>
</html>
