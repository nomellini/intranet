<?
  require("../scripts/conn.php");		
  /**
  $descricao = eregi_replace("\"", "`", $descricao);
  $descricao = eregi_replace("\'", "`", $descricao);		
  $resumo = eregi_replace("\"", "`", $resumo);
  $resumo = eregi_replace("\'", "`", $resumo);		
  $programa = eregi_replace("\"", "`", $programa);
  $programa = eregi_replace("\'", "`", $programa);		 
  **/
  
  $data = date('Y-m-d');
  $hora = date("H:i:s");
  
  if ($cliente) {
   $vai = '1' ;
  } else {
   $vai = '0';
  }
   
  if ($somenteDesenvolvimento) {
   $SD = '1' ;
  } else {
   $SD = '0';
  }
  
  
  $sql = "UPDATE baseweb set somenteDesenvolvimento =  $SD, ";

  if ($atualizaData==1) {  
	  $sql .= "data = '$data', ";  
	  $sql .= "hora = '$hora', ";    
  }
  
  $sql .= "resumo = '$resumo', ";
  $sql .= "descricao = '$descricao', ";
  $sql .= "programa = '$programa', ";
  $sql .= "cliente = $vai ";
  $sql .= "WHERE id=$id_base;";
  mysql_query($sql);
  header("Location: relatbaseweb.php");  
?>