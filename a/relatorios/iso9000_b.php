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
<title>Relat&oacute;rio ISO 9000</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php
$totalGeral;
$bl = 0;
$sql = "SELECT id_chamado, dataa, datauc, s.status, c.cliente_id, c.descricao, si.sistema, ca.categoria, c.rnc_acao_responsavel , c.rnc_acao_data from chamado c, status s, sistema si, categoria ca where (c.visible = 1) and c.categoria_id = ca.id_categoria and c.status = s.id_status and c.sistema_id = si.id_sistema and ( (si.id_sistema = 1024) or (si.id_sistema = 1025) );";
?><br>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="144" align="center" valign="middle" bgcolor="#003399"><span class="style4">Chamado</span></td>
    <td width="103" bgcolor="#003399"><span class="style4">Status</span></td>	
	<td width="103" bgcolor="#003399"><span class="style4">Sistema</span></td>
		<td width="103" bgcolor="#003399"><span class="style4">Categoria</span></td>
    <td width="103" bgcolor="#003399"><span class="style4">Cliente</span></td>
    <td width="119" align="center" valign="middle" bgcolor="#003399"><span class="style4">Aberto Em </span></td>
    <td width="140" align="center" valign="middle" bgcolor="#003399"><span class="style4">Resp</span></td>
    <td width="140" align="center" valign="middle" bgcolor="#003399"><span class="style4">Data</span></td>
    <td width="140" align="center" valign="middle" bgcolor="#003399"><span class="style4">&Uacute;ltimo Contato  </span></td>
    <td width="453" align="center" valign="middle" bgcolor="#003399"><span class="style4">Descrição</span></td>
  </tr>
  <?
   $result = mysql_query($sql) or die (mysql_error());
   $conta = 0;
   while ($linha = mysql_fetch_object($result)) {
     $conta++;
	 
	 $dataAbertura = explode('-',  $linha->datauc);
	 $dataEncerramento = "$dataAbertura[2]/$dataAbertura[1]/$dataAbertura[0]";
	 
	 $dataAbertura = explode('-',  $linha->dataa);
	 $dataAbertura = "$dataAbertura[2]/$dataAbertura[1]/$dataAbertura[0]";

	 $data = explode('-',  $linha->rnc_acao_data);
	 $prazo = "$data[2]/$data[1]/$data[0]";


	 
	 
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
	<?php echo number_format($linha->id_chamado, 0, ",", "."); ?><br>
	</A></td>
    <td ><?php echo $linha->status?></td>	
    <td ><?php echo $linha->sistema?></td>	
    <td ><?php echo $linha->categoria?></td>		
    <td><a href="/a/historico.php?id_cliente=<?php echo $linha->cliente_id?>"><?php echo $linha->cliente_id?></a></td>
    <td align="center" valign="middle"><?php echo $dataAbertura?></td>
    <td align="center" valign="middle"><b><?php echo $linha->rnc_acao_responsavel?></b></td>
    <td align="center" valign="middle"><b><br>
    <?php echo $prazo?></b></td>
    <td align="center" valign="middle"><?php echo $dataEncerramento?></td>
    <td ><br><?php echo $linha->descricao?></td>
  </tr>
  <?
  }
  ?>
</table>

</body>
</html>
