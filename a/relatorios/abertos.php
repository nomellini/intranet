<?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
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
$bl = 0;
// for($i=2003; $i<2010; $i++) {

//  $sql = "select cliente.bloqueio, cliente.cliente, chamado.id_chamado, chamado.cliente_id, chamado.dataa as AbertoEm, u1.nome as AbertoPor, usuario.nome as EstaCom from   chamado    left join usuario on chamado.destinatario_id = usuario.id_usuario    left join usuario u1 on chamado.consultor_id = u1.id_usuario left join cliente on cliente.id_cliente = chamado.cliente_id where (chamado.descricao <> '') and (chamado.dataa >= '" .($i) . "-01-01') and (chamado.dataa < '".($i+1)."-01-01') and chamado.status <> 1 order by dataa"; 

  $sql = "select p.prioridade, cliente.bloqueio, cliente.cliente, chamado.id_chamado, chamado.cliente_id, chamado.dataa as AbertoEm, u1.nome as AbertoPor, usuario.nome as EstaCom from   chamado    left join usuario on chamado.destinatario_id = usuario.id_usuario    left join usuario u1 on chamado.consultor_id = u1.id_usuario left join cliente on cliente.id_cliente = chamado.cliente_id left join prioridade p on p.id_prioridade = chamado.prioridade_id where (chamado.visible=1) and (chamado.descricao <> '') and chamado.status <> 1 order by dataa"; 

?><br>
<strong><br>
</strong>Chamados 'Em aberto'</strong><br>
<br>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="89" align="center" valign="middle" bgcolor="#003399"><span class="style4">Chamado</span></td>
    <td width="232" bgcolor="#003399"><span class="style4">Prioridade</span></td>
    <td width="354" bgcolor="#003399"><span class="style4">Cliente</span></td>
    <td width="226" align="center" valign="middle" bgcolor="#003399"><span class="style4">Aberto Em </span></td>
    <td width="192" align="center" valign="middle" bgcolor="#003399"><span class="style4">Aberto Por </span></td>
    <td width="193" align="center" valign="middle" bgcolor="#003399"><span class="style4">Est&aacute; com </span></td>
  </tr>
  <?
   $result = mysql_query($sql) or die (mysql_error());
   $conta = 0;
   while ($linha = mysql_fetch_object($result)) {
     $conta++;
	 $dataAbertura = explode('-',  $linha->AbertoEm);
	 $dataAbertura = "$dataAbertura[2]/$dataAbertura[1]/$dataAbertura[0]";
	 if ($linha->bloqueio) {
	   $cor = "$FFEEEE";
	   $bl++;
	 } else {
	   $cor = "#FFFFFF";	 
	 }
  ?>
  <tr bgcolor="<?=$cor?>">
    <td align="center" valign="middle">
	<A HREF="/a/historicochamado.php?id_chamado=<?php echo $linha->id_chamado?>">
	<?php echo number_format($linha->id_chamado, 0, ",", "."); ?></A></td>
    <td align="center" valign="middle"><?php echo $linha->prioridade?></td>
    <td><a href="/a/historico.php?id_cliente=<?php echo $linha->cliente_id?>"><?php echo $linha->cliente?></a></td>
    <td align="center" valign="middle"><?php echo $dataAbertura?></td>
    <td align="center" valign="middle"><?php echo $linha->AbertoPor?></td>
    <td align="center" valign="middle"><?php echo $linha->EstaCom?></td>
  </tr>
  <?
  }
  ?>
  <tr>
    <td colspan="6" align="right" valign="top" bgcolor="#FFFFFF"><strong>Total : <?php echo $conta?> Chamados </strong></td>
  </tr>
</table>

<p>
  <?php
  $totalGeral += $conta;
// }
?>
<br>
    <span class="style5">Total de chamados em aberto: <?php echo $totalGeral?> <br>
Total de chamados com cliente bloqueado: <?=$bl;?></span></p>
</body>
</html>
