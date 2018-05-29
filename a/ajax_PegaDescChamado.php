<?
	require("scripts/conn.php");
  
	$id_cliente = str_replace(",", "", $id_chamado);
	$semPontoNemEspaco = str_replace(".", "", $id_cliente);
	$semPontoNemEspaco = str_replace(" ", "", $semPontoNemEspaco);
	
	// Se o resultado for numérico, mantenho o número
	if (is_numeric($semPontoNemEspaco)) {
		$id_cliente = $semPontoNemEspaco;
	}		
    $id_chamado = intval($id_cliente);
	
	if ( (isset($id_chamado)) && ($id_chamado != '')  ) {
		$sql = "select count(1) as q from chamado where id_chamado = $id_chamado";	  
		$result = mysql_query($sql) or die(mysql_error());
		$linha = mysql_fetch_object($result) or die(mysql_error());
		if (($linha->q) > 0) {
			$sql = "select descricao from chamado where id_chamado = $id_chamado";
			$result = mysql_query($sql) or die(mysql_error());
			$linha = mysql_fetch_object($result) or die(mysql_error());
			$html = $linha->descricao;
		} else {
			$html = "Chamado $id_chamado não existe";
		}
	} else {
		$html = "Sem Chamado";
	}
	//$html = nl2br($html);
	$html = str_replace("\n", "", $html);
	$html = str_replace("\t", "", $html);  
	$html = str_replace("  ", "", $html);
	$html = str_replace("\r", "", $html);
?>
div = document.getElementById('TituloChamadoEspera');
div.innerHTML = '<?php echo $html; ?>';