<?
	require("../a/scripts/conn.php");		
	
	if ($horafim == "") {
		$horafim = "18:00";
	}
	if ($particular) {
		$p='1';
	} else {
		$p='0';
	}

	// 27/08/2009 - Recurso para repetir evento.	
	
	$data = '2009-08-27';
	$rdia = 28;
	$rmes = 9;
	$rano = 2009;
	$RepeatEvent = 1;
	
	
	$d = explode("-", $data);	
	$data_i = mktime(0,0,0, $d[1], $d[2], $d[0]);	
	$dataFinal = $data_i;
	
	$i = 0;	
	$repetir = false;
	$id_compromisso_origem = 0;
	if (isset($RepeatEvent)) {
		$repetir = true;
		$dataFinal = mktime(0,0,0,$rmes,$rdia,$rano);
	}
	
	
	
	
	// peganomeusuario($id) -> Pega o nome de um usuario do sad pelo seu ID
	// Está em conn.php
	$nomeusuario=peganomeusuario($id_usuario);	
	$dataHumana = date("d/m/Y h:i");
	$obs = "Criado em $dataHumana por $nomeusuario<br>";

	// as linhas abaixo não fazem sentido para mim.... Devem ter sido criadas para
	// Algum teste, pois sempre irá passar pela gravação
	$gravamesmoassim = false;
	$ok = true; 
	echo ("fim  = " . date("Y-m-d", $dataFinal) . "<br><br>");
	
	while ( ($data_i <= $dataFinal) ) {
//	if (true) {

		$dataEvento = date("Y-m-d", $data_i);	$i++;		
		echo ($dataEvento . " - " . $i . " - " . ( ($i < 10) && ($data_i <= $dataFinal) ) );
		
	

		
		$strRepetir = "";
		if ($repetir) {
			if ($id_compromisso_origem==0) {
				$id_compromisso_origem = $id_compromisso;
				$strRepetir = "Compromisso repetido até o dia $rdia/$rmes/$rano";				
			}
		}
		
		$pvt = 0;
		if ($particular) {
			$pvt =  1;
		}
		
		
		
			
			$data_i = mktime(0,0,0, $d[1], $d[2] + $i, $d[0]);
			
		} 
		
		// Agora repito a operação para os eventos 
		
		
		
?>
