<?
  require("../scripts/conn.php");		  
  require("../scripts/funcoes.php");

	$sql = "update contato set horae_original = horae where (id_contato = $id_contato) and (horae_original is null)";
	mysql_query($sql);
	
  $segundos = '00';

  $sql = "
  update contato set horae = SEC_TO_TIME(TIME_TO_SEC(HORAA) + TIME_TO_SEC('$horas:$minutos:$segundos'))
  where id_contato = " . $id_contato;

  mysql_query($sql) or die (mysql_error());

?>
<html>
<head>
<title>Dura&ccedil;&atilde;o</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="80%" border="0" cellspacing="1" cellpadding="1" height="98%" align="center">
  <tr>
    <td valign="middle" align="center"><p>dura&ccedil;&atilde;o do contato alterada</p>
      <p><a href="javascript:vai();">Clique Aqui para fechar a janela</a></p></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
  <script>  
  
  function vai() {
	opener.document.form2.submit();   
	window.close();
  }
</script>