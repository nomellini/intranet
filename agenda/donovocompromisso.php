t
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
	
	$d = explode("-", $data);	
	$dia = $d[2];
	$mes = $d[1];
	$ano = $d[0];
	$data_i = mktime(0,0,0, $d[1], $d[2], $d[0]);	
	$dataFinal = $data_i;
	
	$diasamais = 0;	
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
	while ( $data_i <= $dataFinal)  {
//	if (true) {
		$dataEvento = date("Y-m-d", $data_i);	$diasamais++;		
	

	
		$sql = "insert into compromisso (confidencial, id_usuario, data, hora, horafim, resumo, local,   descricao, id_chamado, id_sala, obs) ";
		$sql .= " VALUES ( $p, $id_usuario, '$dataEvento', '$hora:00', '$horafim:00', '$resumo', '$local', '$descricao', '$id_chamado', '$id_sala', '$obs')";
		
		mysql_query($sql) or die (mysql_error());
		
		Envia_email($id_sala, $dataEvento, "$hora:00", $nomeusuario);
		
		$sql = "select max(id) as id from compromisso where id_usuario=$id_usuario";
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
		$id_compromisso = $linha->id;
		
		$strRepetir = "";
		if ($repetir) {
			if ($id_compromisso_origem==0) {
				$id_compromisso_origem = $id_compromisso;
				$strRepetir = "Compromisso repetido até o dia $rdia/$rmes/$rano";				
			}
			$sql = "update compromisso set id_origem = $id_compromisso_origem where id = $id_compromisso;";
			$result = mysql_query($sql);
		}
		
		$pvt = 0;
		if ($particular) {
			$pvt =  1;
		}
		
		
		
		/* 
		A linha abaixo conta quantidade de participantes do array
		$usuario_id, que foi criado automaticamente pelo php (register globals on)
		através dos campos checkbox de seleção de participantes. O Resultado
		é um array com os IDs dos participantes selecionados.
		*/
		$usuarios = count($usuario_id);
		
		$Participantes = "";
		for ($i=0; $i<$usuarios; $i++) {
			if ($Participantes != "") {
				$Participantes .= ", ";
			}
			// peganomeusuario($id) -> Pega o nome de um usuario do sad pelo seu ID
			// Está em conn.php
			$Participantes .= peganomeusuario($usuario_id[$i]);	
		}
		
		// Para cada participante do evento, irei gerar um email.
		for ($i=0; $i<$usuarios; $i++) {
			$lido = 1;
			$usuario = $usuario_id[$i];
			if ( $id_usuario != $usuario_id[$i] ) { $lido = 0;}
			
			if (!isset($ferias)) { $ferias = 0 ; } 
			
			// Cada participante do evento ganha uma entrada na tabela compromissousuario
			$sql = "insert into compromissousuario ( id_compromisso, id_usuario, confidencial, lido, fl_ferias) ";
			$sql .= "values ( $id_compromisso, $usuario, $pvt, $lido, $ferias)";
			mysql_query($sql);  
			
			$textEmail = "
			<font face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Novo Compromisso</strong></font><br>
			<br>
			<table width=\"100%\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
			<td width=\"21%\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">Data/Hora</font></td>
			<td width=\"79%\"><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[data] [hora]-[horafim]</font></strong></td>
			</tr>
			<tr>
			<td><font face=\"Verdana, Arial, Helvetica, sans-serif\">Criado por</font></td>
			<td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[dono]</font></strong></td>
			</tr>
			<tr>
			<td><font face=\"Verdana, Arial, Helvetica, sans-serif\">Local</font></td>
			<td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[local]</font></strong></td>
			</tr>
			<tr>
				<td>Participantes</td>
				<td>$Participantes</td>
			</tr>
			<tr>
				<td></td>
				<td>$strRepetir</td>
			</tr>			
			<tr>
			<td colspan=\"2\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"><em>Descri&ccedil;&atilde;o</em></font></td>
			</tr>
			<tr>
			<td colspan=\"2\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">[descricao]</font></td>
			</tr>
			</table>
			<p><font face=\"Verdana, Arial, Helvetica, sans-serif\"><HR size=\"1\">      
			<font color=\"#CCCCCC\">Datamace 2005</font><br>
			
			</font>
			</p>	
			";
			$titulo = "Novo compromisso";		
			EmailAgenda($id_usuario, $usuario, $dataEvento, $hora, $horafim, $resumo, $local, $descricao, $textEmail, $titulo );
			
			$data_i = mktime(0,0,0, $d[1], $d[2] + $diasamais, $d[0]);
			
		} 
		
		// Agora repito a operação para os eventos 
		
		
		
		header("Location: /agenda/inicio.php?dia=$dia&mes=$mes&ano=$ano"); 
	}	 
	
	function Envia_email($id_sala, $data, $hora, $nomeusuario)
	{
		$sql = "select nome, email as Email_Sala from salas where id = $id_sala";
		$result = mysql_query($sql) or die (mysql_error());
		$linha = mysql_fetch_object($result);
		$Email_Sala = $linha->Email_Sala;
		
		//$Email_Sala = "fernando.nomellini@datamace.com.br";
		
		$nome = $linha->nome;
		
		$data = implode( "/", array_reverse(explode("-", $data)));
		
		if ($Email_Sala) {
			$titulo = "Sala agendada";		
			mail2($Email_Sala, $titulo, "Novo agendamento de sala: <b>$nome</b> no dia $data às $hora por $nomeusuario", $titulo);
		}
	}
?>
