<?php
	require("scripts/conn.php");
	require("scripts/classes.php");	  

	$data = date("d/m/Y H:i:s");
		
	$sql = "select historico, chamado_id from contato where id_contato = $contato_id";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	
	$contato = $linha->historico;	
	
	$id_chamado = $linha->chamado_id;
	
	$_Anexar = $_POST["texto"];
	
	$_Anexar = nl2br($_POST["texto"]);	
	
	$_texto = $contato . "<br><br><i>Texto anexado em " . $data . "</i><br>" . $_Anexar;

	
	$_texto = mysql_real_escape_string ($_texto);	
	
	
	$sql = "update contato set historico = '$_texto' where id_contato = $contato_id";
	mysql_query($sql);
	
	
	// Indicando para destinatário que o chamado tem contato novo
	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);
	$objChamado->lido = 0;
	$objChamado->lidodono = 0;
	$objChamado->lidodono = 0;
    $objChamado->gravaChamado();
	
    loga_novoComplemento($consultor_id, $id_chamado);
	
	header("Location: historicochamado.php?&id_chamado=$chamado_id#$contato_id");	  	
?>
