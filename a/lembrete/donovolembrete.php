<html>
<head>
<title>Ok</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?

 mysql_connect(localhost, sad, data1371);
 mysql_select_db(sad); 

 $lembrete = eregi_replace("\r\n", "<br>", $lembrete);   
 $lembrete = eregi_replace("'" ,   "`", $lembrete);
 $lembrete = eregi_replace("\"",   "`", $lembrete); 
 
 $data = "$ano-$mes-$dia";
 
 $sql = "insert into lembrete (id_chamado, id_usuario, id_destinatario, data, periodo, obs) ";
 $sql .= "VALUES ($id_chamado, $id_usuario, $id_usuario, '$data', '$periodo', '$lembrete');";
 mysql_query($sql) or die ("ERRO : " . $sql);
 
 $dataEvento = $data;
	
		$Data_Atual = date("d/m/Y");
		$resumo = "Lembrete de chamado: $id_chamado";
		$local = 'Datamace';
		$descricao = "Lembretre inserido em $Data_Atual";
		$id_sala = 0;
		$obs = "";		
		$sql = "insert into compromisso (confidencial, id_usuario, data, hora, horafim, resumo, local,   descricao, id_chamado, id_sala, obs) ";
		$sql .= " VALUES ( 1, $id_usuario, '$dataEvento', '08:00:00', '17:00:00', '$resumo', '$local', '$descricao', '$id_chamado', '$id_sala', '$obs')";
		
		mysql_query($sql) or die (mysql_error());	
		
		
	 
	 
		$sql = "select max(id) as id from compromisso where id_usuario=$id_usuario";
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
		$id_compromisso = $linha->id;	 
	 
		// Cada participante do evento ganha uma entrada na tabela compromissousuario
		$sql = "insert into compromissousuario ( id_compromisso, id_usuario, confidencial, lido, fl_ferias) ";
		$sql .= "values ( $id_compromisso, $id_usuario, 1, 0, 0)";
		mysql_query($sql);	 
	 
  
?>

<table width="80%" border="0" cellspacing="1" cellpadding="1" height="98%" align="center">
  <tr>
    <td valign="middle" align="center">
      <p>Lembrete adicionado com Sucesso !</p>
      <p><a href="javascript:vai();">Clique Aqui para fechar a janela</a></p>
    </td>
  </tr>
</table>
  <script>  
  
  function vai() {
   if ( '-1' == '-<?=$inicio?>' ) {
    var picoles = window.open("","pai");
	picoles.document.form2.submit();
   }
	window.close();
  }
</script>

</body>
</html>
