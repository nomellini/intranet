<?php

	require("../a/scripts/conn.php");
	require("../a/scripts/classes.php");	

	$arquivomens="Arquivo enviado: ";
	$data=date("Y-m-d");
	$horaa = date("H:i:s");	
	$arquivo=$_FILES['imagem'];
	$nomearq=$arquivo["name"];

	$sql1 = mysql_query("select destinatario_id, prioridade_id from chamado where id_chamado=$select5");	
	$reg1 = mysql_fetch_assoc($sql1);
	$destinatario_id = $reg1['destinatario_id'];	
	$prioridade_id = $reg1['prioridade_id'];				
	
	$sql2 = "INSERT INTO contato (chamado_id, origem_id, historico, consultor_id, ";
	$sql2 .= "destinatario_id, status_id, dataa, datae, horaa, horae, publicar) ";
	$sql2 .= "VALUES ($select5, 12, '" . $arquivomens . $nomearq ."', 56, ";
	$sql2 .= "$destinatario_id, 2, '$data', '$data', '$horaa', '$horaa', 1);";
	mysql_query($sql2) or die ($sql2);  
	
	$sql1 = mysql_query("select id_contato from contato where chamado_id = $select5 and consultor_id = 56 and dataa = '$data' and horaa = '$horaa'");
	$reg1 = mysql_fetch_assoc($sql1);
	$contato_id = $reg1['id_contato'];
	
	$consultor_id = 56;
	$chamado_id = $select5;
	
	$uploaddir = "/dados/ftp/sites/sad/htdocs/public_html/uploads/";
	$uploadfile = $_FILES['imagem']['name']; 
	$nome = $uploadfile;        
	$uploadfile = MakeUploadName($uploadfile,$uploadfile) ;
	$uploadfile = eregi_replace(" ", "", $uploadfile);
	$uploadfile = "$contato_id-" .$uploadfile;    
	$datae = date("Y-m-d");
	$horae = date("H:i:s");	    
	$sql = "insert into saduploads (id_consultor, id_chamado, id_contato, nome, nome_original, data) ";
	$sql .= "values ($consultor_id, $chamado_id, $contato_id, '$uploadfile', '$nome', '$datae $horae')"; 
	$uploadfile = $uploaddir . $uploadfile;    
	if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile)) {
		mysql_query($sql);
		

		$sql = "UPDATE chamado set 
		lidodono=0, 
		lido=0, 
		status=2,";		
		if ($prioridade_id == 4) {	
			$sql .="prioridade_id = 1, ";
		}		
		$sql .= "remetente_id=56, 
		destinatario_id=$destinatario_id WHERE id_chamado=$chamado_id;";
		
			
		mysql_query($sql) or die ($sql);		
		
		
		
?>
		<script>
		alert ("Arquivo enviado com sucesso!");
		window.location='detalhes_chamado.php?id_chamado=<?echo $select5;?>';
		</script>
<?		
	} else {
		print "ERRO NUMERO " . $_FILES['imagem']['error'] . " - $uploadfile - <br>";
		print "1 e 2 - Arquivo muito grande <br>";	
		print "3 - Upload feito parcialmente<br>";		
		print "4 - Nome invalido<br>";			
	}
	
	
	function MakeUploadName($pagename,$x) {
	$x = preg_replace('/[^-\\w. ]/', '', $x);
	$x = preg_replace('/^[^[:alnum:]]+/', '', $x);
	return preg_replace('/[^[:alnum:]]+$/', '', $x);
	}
	
?>
