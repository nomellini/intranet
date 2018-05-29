<?
  $link = mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);
  session_start(); 
  if ($v_id_cliente) {
  
    $sql = "select destinatario_id from chamado where id_chamado=$id_chamado";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
//	$destinatario_id = $linha->consultor_id;
	$destinatario_id = $linha->destinatario_id;
  
    $descricao = eregi_replace("\"", "`", $descricao);  // Evita " e '
    $descricao = eregi_replace("\'", "`", $descricao);	// no SQL.
    $dataa = date("Y-m-d");
    $horaa = date("H:i:s");	 
	$sql = "INSERT INTO contato (chamado_id, origem_id, historico, consultor_id, ";
	$sql .= "destinatario_id, status_id, dataa, datae, horaa, horae, publicar) ";
	$sql .= "VALUES ($id_chamado, 12, '$descricao', 56, ";
	$sql .= "$destinatario_id, 2, '$dataa', '$dataa', '$horaa', '$horaa', 1);";
    mysql_query($sql) or die ($sql);
	
	$sql = "UPDATE chamado set lidodono=0, lido=0, status=2, remetente_id=56, destinatario_id=$destinatario_id WHERE id_chamado=$id_chamado;";
	mysql_query($sql) or die ($sql);
	
  }
  mysql_close($link);
  header("Location: historico.php?id_chamado=$id_chamado");

?>