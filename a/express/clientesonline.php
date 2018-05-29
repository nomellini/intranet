<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?
  mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);
  if ( $ordem=='' ) {
    $ordem = 'chamados desc';
  }
?>
<html>
<head>
<title>chamados abertos por cliente :: SAD Datamace</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../stilos.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<br>
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="..\overlib.js"></SCRIPT>
<SCRIPT LANGUAGE="Javascript"><!--
function mOvr(src,clrOver) {if (!src.contains(event.fromElement)) {src.style.cursor = 'hand';
src.bgColor = clrOver;
}
}
function mOut(src,clrIn) {if (!src.contains(event.toElement)) {src.style.cursor = 'default';
src.bgColor = clrIn;
}
}
// --> 
</script>
<script src="../relatorios/coolbuttons.js"></script>
<table width="55%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      p/ relat&oacute;rios</a></td>
  </tr>
</table>
<hr color=#ff0000 noshade size="1">
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"> </font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
</font></font><br>
<strong>Relat&oacute;rio de chamados abertos por cliente </strong><br>
  <br>
<font color="#FF0000"><strong>Obs</strong>. S&oacute; aparece na lista o cliente 
que abriu pelo menos um chamado pelo Online</font> 
<table width="82%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td width="31%"><font size="1" face="verdana">ID Cliente </font></td>
    <td width="55%"><font size="1" face="verdana"><a href="clientesonline.php?ordem=cliente">Nome 
      </a></font></td>
    <td width="14%"><a href="clientesonline.php?ordem=chamados%20desc">Chamados</a> 
      * </td>
  </tr>
  <?  
  $sql = "";
  $sql .= "SELECT cliente.id_cliente, cliente.cliente, count(*) as chamados from cliente, chamado ";
  $sql .= "WHERE chamado.visible = 1 and ";
  $sql .= "  cliente.id_cliente = chamado.cliente_id AND ";
  $sql .= "  cliente.atendimento ";
  $sql .= "and   chamado.externo ";
  $sql .= "GROUP BY ";
  $sql .= "  cliente_id ";
  $sql .= "ORDER BY ";
  $sql .= "  $ordem";
  $result = mysql_query($sql) or die ($sql);
  while ($linha=mysql_fetch_object($result)) {  
    $id_cliente = $linha->id_cliente;
    $nome  = $linha->cliente;
    $link = "http://192.168.0.5/a/historico.php?&id_cliente=$id_cliente"
?>
  <tr bgcolor="#FFFFFF"> 
    <td><font size="1" face="verdana"> 
      <?=++$cont?>
      . <a href="<?=$link?>"> 
      <?=$id_cliente?>
      </a> </font></td>
    <td><font size="1" face="verdana"> 
      <?=$nome?>
      </font></td>
    <td><?=$linha->chamados?></td>
  </tr>
  <?		
  }
?>
</table>

<p>*Somente chamados abertos pelo cliente</p>
</body>
</html>
