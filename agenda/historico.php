<?
 require("../a/scripts/conn.php");		
 $BRDays3 = array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");		 
?>
<html>
<head>
<title>Detalhe</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../a/stilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
</head>

<body background="figuras/fundo.gif" leftmargin="0" topmargin="0" marginwidth="22" marginheight="0">
<?
	$p = "";
	$sql = "Select * from compromissohistorico where id = " . $id_historico;
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);  
	$data = explode("-", $linha->data);  
	$Obs = nl2br($linha->obs);


  
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td><div align="center"><span class="style1">HIST&Oacute;RICO DO COMPROMISSO !!!<br>
    </span></div></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#003366">
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td><strong><font color="#003366">Data/Hora da altera&ccedil;&atilde;o: 
            <?="$data[2]/$data[1]/$data[0]"?>
&nbsp;
<?=$linha->hora?>
</font></strong></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF"> 
          <td>&nbsp;</td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF">
          <td><strong>Dados do compromisso original </strong></td>
        </tr>
        <tr valign="top" bgcolor="#FFFFFF">
          <td><?=$Obs?></td>
        </tr>
      </table></td>
  </tr>
</table>

<p align="center"> <a href="javascript:history.back(-1);">voltar !!!!</a> </p>
</body>
</html>
