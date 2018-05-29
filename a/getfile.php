<?php
  require("scripts/conn.php");
  require("scripts/classes.php");	
  $uploaddir = "/dados/ftp/sites/sad/htdocs/public_html/uploads/";
  $uploadfile = $_FILES['userfile']['name']; 
//  die($uploadfile);
  $nome = $uploadfile;        
  $uploadfile = MakeUploadName($uploadfile,$uploadfile) ;
  $uploadfile = eregi_replace(" ", "", $uploadfile);
  $uploadfile = "$contato_id-" .$uploadfile;    
//  $uploadfile = "" .$uploadfile;    
  $datae = date("Y-m-d");
  $horae = date("H:i:s");	    
  $sql = "insert into saduploads (id_consultor, id_chamado, id_contato, nome, nome_original, data) ";
  $sql .= "values ($consultor_id, $chamado_id, $contato_id, '$uploadfile', '$nome', '$datae $horae')"; 
  $uploadfile = $uploaddir . $uploadfile;    
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
  	mysql_query($sql);
	header("Location: historicochamado.php?&id_chamado=$chamado_id#$contato_id");	  
  } else {
    print "ERRO NUMERO " . $_FILES['userfile']['error'] . " - $uploadfile - <br>";
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
