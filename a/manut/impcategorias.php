<?
	require("../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
?>
<html>
<head>
<title>Listagem de todas as categorias</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<?
$categorias = pegaCategorias();
$total = count($categorias);
$loop = 0;
?>
<body bgcolor="#FFFFFF" text="#000000">
<p>Listagem das categorias:</p>
<table width="99%" border="0" cellspacing="1" cellpadding="1">
  <tr align="left" valign="top"> 
    <td width="50%"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
        <tr bgcolor="#333333"> 
          <td width="32%"><b><font color="#FFFFFF">Sistema</font></b></td>
          <td width="68%"><b><font color="#FFFFFF">Categoria</font></b></td>
        </tr>
<?
while($loop++ < $total/2) {
 list($tmp1, $tmp) = each($categorias)
?>
        <tr bgcolor="#FFFFFF"> 
          <td width="32%"> <font size="-6"> 
            <?=$tmp["sistema"]?>
            </font></td>
          <td width="68%"> <font size="-6"> 
            <?=$tmp["categoria"]?>
            </font></td>
        </tr>
        <?}?>
      </table>
    </td>
    <td width="50%"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
        <tr bgcolor="#333333"> 
          <td width="32%"><b><font color="#FFFFFF">Sistema</font></b></td>
          <td width="68%"><b><font color="#FFFFFF">Categoria</font></b></td>
        </tr>
        <?
 while( $loop++ < $total ) {
 list($tmp1, $tmp) = each($categorias)
 
?>
        <tr bgcolor="#FFFFFF"> 
          <td width="32%"> <font size="-6"> 
            <?=$tmp["sistema"]?>
            </font></td>
          <td width="68%"> <font size="-6"> 
            <?=$tmp["categoria"]?>
            </font></td>
        </tr>
        <?}?>
      </table>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>
