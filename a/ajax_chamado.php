<?
	header('Content-type: text/html; charset=iso-8859-1');	
	require('scripts/conn.php');
	$Status = 0;
	$Mensagem = "";
	if (!is_numeric($id_chamado))
	{
		$Status = -1;
		$Mensagem = "Digite um numero de chamado válido";
	} 
	else 
	{
		$temChamado = conn_ExecuteScalar("select count(1) from chamado where id_chamado = '$id_chamado'");
		if ($temChamado == 0) {
			$Status = -1;
			$Mensagem = "O chamado '$id_chamado' não existe";			
		} else {
			$sql = "select status, left(descricao, 100) descricao from chamado where id_chamado = $id_chamado;";
			$Query = mysql_query($sql);
			$linha = mysql_fetch_object($Query);
			$Status = $linha->status;
			$Mensagem = $linha->descricao;            
			if ($Status == 1)
			{
				$Mensagem = "O Chamado '$id_chamado' está encerrado";
			} else {
				$Mensagem = mysql_real_escape_string ($Mensagem);					
			}
		}
	}
	$Json = '{"Status" : "' . $Status . '", "Mensagem" : "' . $Mensagem . '", "Chamado" : "' . $id_chamado . '"}';
	echo $Json;
?>