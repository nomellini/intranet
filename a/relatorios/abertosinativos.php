<?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	

?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; }
.style5 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php
$totalGeral;
for($i=2001; $i<2008; $i++) {
  $sql = "select cliente.cliente, chamado.id_chamado, chamado.dataa as AbertoEm, u1.nome as AbertoPor,   usuario.nome as EstaCom from   chamado    left join usuario on chamado.destinatario_id = usuario.id_usuario left join usuario u1 on chamado.consultor_id = u1.id_usuario left join cliente on cliente.id_cliente = chamado.cliente_id where (chamado.dataa >= '" .($i) . "-01-01') and (chamado.dataa < '".($i+1)."-01-01') and chamado.status <> 1 and cliente.bloqueio"; 
  

?><br>
<strong><br>
</strong>Chamados 'Em aberto', abertos no ano <strong> 
<?=$i?>
</strong><br>
<br>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="306" bgcolor="#003399"><span class="style4">Chamado</span></td>
    <td width="137" bgcolor="#003399"><span class="style4">Aberto Em </span></td>
    <td width="349" bgcolor="#003399"><span class="style4">Aberto Por </span></td>
    <td width="184" bgcolor="#003399"><span class="style4">Est&aacute; com </span></td>
  </tr>
  <?
   $result = mysql_query($sql) or die (mysql_error());
   $conta = 0;
   while ($linha = mysql_fetch_object($result)) {
     $conta++;
  ?>
  <tr>
    <td bgcolor="#FFFFFF">
	<A HREF="/a/historicochamado.php?id_chamado=<?php echo $linha->id_chamado?>">
	<?php echo $linha->id_chamado?><br>
	<?php echo $linha->cliente?></A></td>
    <td bgcolor="#FFFFFF"><?php echo $linha->AbertoEm?></td>
    <td bgcolor="#FFFFFF"><?php echo $linha->AbertoPor?></td>
    <td bgcolor="#FFFFFF"><?php echo $linha->EstaCom?></td>
  </tr>
  <?
  }
  ?>
  <tr>
    <td colspan="4" align="right" valign="top" bgcolor="#FFFFFF"><strong>Total : <?php echo $conta?> Chamados </strong></td>
  </tr>
</table>

<?php
  $totalGeral += $conta;
 }
?><br>
<span class="style5">Total de chamados em aberto: <?php echo $totalGeral?></span>
</body>
</html>
