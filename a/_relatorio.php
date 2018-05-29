<?
  require("scripts/conn.php");
  
  if ($email) {
    $sql = "Delete from clienteemail where email = '$email'";
	mysql_query($sql);
  }

  if (!$order) {
    $order = "qtde desc";
  }
  
  $sql = "";
  $sql .= "Select pessoacontatada, email, cliente, count(*) as qtde from clienteemail group by email order by ";
  $sql .= $order;
  $result = mysql_query($sql) or die($sql);  
?>	
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
a {
	color: #003366;
	text-decoration: none;
}
a:hover {
	color: #FF0000;
}
-->
</style>
</head>

<body>
<font size="2" face="tahoma">Rela&ccedil;&atilde;o de emails, 
agrupados por endere&ccedil;o e ordenado pelo n&uacute;mero de emails enviados.<br>
Caso deseje zerar a quantidade, clique em Limpar para <strong>ELIMINAR</strong> 
este email do cadastro e come&ccedil;ar a contar novamente.</font><br>
<br>
<table width="79%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td width="53%" height="21"><strong><font color="#FFFFFF" size="2" face="tahoma"><a href="javascript:ordena('email')">email</a> 
      </font></strong></td>
    <td width="18%" align="center" valign="top"><strong><font color="#FFFFFF" size="2" face="tahoma"><a href="javascript:ordena('cliente')">cliente</a> 
      </font></strong></td>
    <td width="14%" align="center" valign="top"><strong><font color="#FFFFFF" size="2" face="tahoma"><a href="javascript:ordena('qtde desc')">qtde</a></font></strong></td>
    <td width="15%" align="center" valign="top"><font color="#FFFFFF" size="2" face="tahoma"><strong>A&ccedil;&atilde;o</strong></font></td>
  </tr>
  <?
    while ($linha=mysql_fetch_object($result)) {
  ?>
  <tr valign="top" bgcolor="#FFFFFF"> 
    <td height="20"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
	<a href="javascript:emaildetalhe('<?=$linha->email?>');">
      <b>
      <?=$linha->email?>
      </b> ( 
      <?=$linha->pessoacontatada?>
      ) </a></font></td>
    <td align="center"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$linha->cliente?>
      </font></td>
    <td align="center"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$linha->qtde?>
      </font></td>
    <td align="center"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <a href="javascript:deleta('<?=$linha->email?>');">Limpar</a></font></td>
  </tr>
  <?
    }
  ?>
</table>
<form action="_relatorio.php" method="post" name="form" id="form">
  <input name="email" type="hidden" id="email" value="">
  <input name="emaildetalhe" type="hidden" id="emaildetalhe" value="">  
  <input name="order" type="hidden" id="order" value="<?=$order?>">
</form>
<br>
<font face="Verdana, Arial, Helvetica, sans-serif"> <strong> 
<? 
  if ($emaildetalhe) {
  $sql = "Select * from clienteemail where email = '$emaildetalhe'";
  $result = mysql_query($sql) or die($sql); 
?>
Detalhando o email <font color="#FF0000">
<?=$emaildetalhe?>
</font></strong></font> 
<table width="79%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td width="31%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pessoa</font></td>
    <td width="27%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Data Envio</font></td>
    <td width="21%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Chamado</font></td>
    <td width="21%" align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cliente</font></td>
  </tr>
  <?
    while ($linha=mysql_fetch_object($result)) {
 	 $data = explode('-', $linha->data);
     $data = "$data[2]/$data[1]/$data[0]";
  ?>
  <tr bgcolor="#FFFFFF"> 
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$linha->pessoacontatada?>
      </font></td>
    <td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$data?>
      </font></td>
    <td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <a href=historicochamado.php?&id_chamado=<?=$linha->chamado?>>
      <?=$linha->chamado?></a>
      </font></td>
    <td align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$linha->cliente?>
      </font></td>
  </tr>
  <?
   }
  ?>
</table>
<?
}
?>
</body>
</html>
<script>
	function deleta(value) {
      if ( window.confirm('ATENÇAO!! \nEssa ação irá zerar o email "'+value+'", confirma ?') ) {
	    document.form.email.value =  value;
		document.form.submit();
	  }
	}
	
	function ordena(value) {
	  document.form.order.value = value;
		document.form.submit();	  
	}
	
	function emaildetalhe(value) {
	    document.form.emaildetalhe.value =  value;
		document.form.submit();
	}
</script>