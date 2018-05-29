
<?
	require_once("scripts/conn.php");
	require_once("scripts/classes.php");

	insere_contato(213207, 12, 2);

	function insere_contato($id_chamado, $id_usuario, $dias)
	{
	
		$datae = date("Y-m-d");
		$horae = date("H:i:s");					
		$objChamado = new chamado();
		$objContato = new contato();		
		$objChamado->lerChamado($id_chamado);	
		$id_destinatario = $objChamado->destinatario_id;			
		$id_contato_cliente = $objContato->novocontato($id_chamado, 141, $id_usuario, $datae, $horae);
		$objContato->lerContato($id_contato_cliente);		
		$objContato->origem_id = 21 + $dias;
		$objContato->datae = $datae;
		$objContato->horae = $horae;				
		$frasepadrao = "Cobran&ccedil;a de andamento";
		$objContato->historico = "$frasepadrao";			
		$objContato->gravaContato();			  
	

	}
?>
Cobrança de andamento