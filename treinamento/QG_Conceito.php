<?

	include_once('cabeca.inc.php');

	$prova = new treinamento("");
	
/*	$result = mysql_query("select id from respostas");
	while ($linha = mysql_fetch_object($result)){
		$prova->verifica_nota($linha->id);
		$vConceito = $prova->verifica_conceitoValor($linha->id, $prova->aproveitamentoReal);
		$vConceitoID = $prova->verifica_conceitoID($linha->id);
		echo "update respostas set conceito_id = '$vConceitoID' ,conceito = '$vConceito' where id = $linha->id<br>";
		mysql_query("update respostas set conceito_id = '$vConceitoID' ,conceito = '$vConceito' where id = $linha->id");
	}
*/
	$result = mysql_query("select id, rg from tre_usuario");
	while ($linha = mysql_fetch_object($result)){
		
		$resultResp = mysql_query(" select R.id as id from tre_usuario as T ".
									" inner join modulos as M on M.id = T.modulo ".
									" inner join sistemas as S on S.id = M.cod_sistema ".
									" inner join respostas as R on month(R.dataprova) = month(T.data) ".
																" and year(R.dataprova) = year(T.data) ".
																" and S.id = (select sistema_id from provas where provas.id = R.cod_prova) ".
									" where T.id = $linha->id ".
											" and R.rg = '$linha->rg' ".
									" order by R.provanro desc limit 1 ");										
		$linhaResp = mysql_fetch_object($resultResp);
		
		$prova->verifica_nota($linhaResp->id);
		$vConceito = $prova->verifica_conceitoValor($linhaResp->id, $prova->aproveitamentoReal);
		$vConceitoID = $prova->verifica_conceitoID($linhaResp->id);				
	
		mysql_query("UPDATE tre_usuario set conceito_id = '$vConceitoID' ,conceito = '$vConceito' where id = $linha->id ");  
	}

?>