<?	
	header('Content-type: text/html');
/*	
	header('Content-Disposition: attachment; filename="iso9000.txt"');
	header("Content-type: application/octet-stream");	
	header("Content-Type: application/force-download");
*/	
	
	require("../scripts/conn.php");	
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
	
?><?php
$totalGeral;
$bl = 0;
$sql = "SELECT id_chamado, dataa, datauc, s.status, c.cliente_id, c.descricao, si.sistema, ca.categoria, c.rnc_acao_responsavel , c.rnc_acao_data from chamado c, status s, sistema si, categoria ca where (c.visible = 1) and c.categoria_id = ca.id_categoria and c.status = s.id_status and c.sistema_id = si.id_sistema and ( (si.id_sistema = 1024) or (si.id_sistema = 1025) );";

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
	 
	$descricao = str_replace("\n\r", "-", $linha->descricao);	
	$descricao = str_replace("\n", "-", $descricao);
	$descricao = str_replace("<BR>", "-", $descricao);	
	$descricao = str_replace("<br>", "-", $descricao);	
	$descricao = str_replace("<Br>", "-", $descricao);		
	 
  ?>
<A HREF="/a/historicochamado.php?id_chamado=<?php echo $linha->id_chamado?>"><?php echo number_format($linha->id_chamado, 0, ",", "."); ?></A>
|<?php echo $linha->status?>
|<?php echo $linha->sistema?>
|<?php echo $linha->categoria?>
|<a href="/a/historico.php?id_cliente=<?php echo $linha->cliente_id?>"><?php echo $linha->cliente_id?></a>
|<?php echo $dataAbertura?>
|<b><?php echo $linha->rnc_acao_responsavel?></b>
|<b><?php echo $prazo?></b>
|<?php echo $dataEncerramento?>
|<?php echo $descricao?>
<?= "<br>"?>
<? }  ?>