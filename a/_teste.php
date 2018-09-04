<?
	require("scripts/conn.php");
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);
		setcookie("loginok");
	} else {
		header("Location: index.php");
	}
	$manut = pegaManut($ok);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?

  $num = count($checkbox);
  print $num;
  for ($i = 0; $i < $num; ++$i) {
     print "<br>-->$checkbox[$i]";
  }

  ?>
<?
$emails = pegaEmails();
?>
<form name="form1" method="post" action="teste.php">
<p>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
    <?
  while ( list($tmp1, $tmp) = each($emails) ) {
		   	   $id = $tmp["id"];
			   $email = $tmp["nome"];

?>
    <tr>
      <td>
        <input type="checkbox" name="checkbox[]" value="<?=$id?>">
    </td>
      <td>
        <?=$email?>
      </td>
<?
  list($tmp1, $tmp) = each($emails) ;
  $id = $tmp["id"];
  $email = $tmp["nome"];
?>


      <td>
        <input type="checkbox" name="checkbox[]" value="<?=$id?>">
    </td>
      <td>
        <?=$email?>
      </td>

<?
  list($tmp1, $tmp) = each($emails) ;
  $id = $tmp["id"];
  $email = $tmp["nome"];
?>


      <td>
        <input type="checkbox" name="checkbox[]" value="<?=$id?>">
    </td>
      <td>
        <?=$email?>
      </td>

<?
  list($tmp1, $tmp) = each($emails) ;
  $id = $tmp["id"];
  $email = $tmp["nome"];
?>


      <td>
        <input type="checkbox" name="checkbox[]" value="<?=$id?>">
    </td>
      <td>
        <?=$email?>
      </td>
<?
  list($tmp1, $tmp) = each($emails) ;
  $id = $tmp["id"];
  $email = $tmp["nome"];
?>


      <td>
        <input type="checkbox" name="checkbox[]" value="<?=$id?>">
    </td>
      <td >
        <?=$email?>
      </td>

  </tr>



<?
}
?>
  </table>
  <p>
    <input type="submit" name="Submit" value="Submit">
  </p>
  </form>




<p>&nbsp;</p>
</body>
</html>
