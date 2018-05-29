<?	
	require("cabeca.php");
	require("scripts/classes_programas.php");					
	
	$lista = new ChamadoProgramas($id_chamado);
	$Programas = $lista->Programas;
	$TemProgramas = count($Programas) > 0;

	if (isset($_POST["action"]))
	{
		$Acao = $_POST["action"];
		if ($Acao == "novoPrograma") {
			if ( $_POST["txtPrograma"] != "") {
				AdicionarPrograma($_POST["txtPrograma"], $_POST["txtObs"], $ok, $id_chamado);
			}
		}
	} 
	
	$lista_in = obterProgramasVersao($id_chamado);
	$lista_out = obterProgramasForaVersao($id_chamado);					
?>

