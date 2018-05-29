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
  
   
  $sql = "UPDATE baseweb set jaDocumentado =  not jaDocumentado ";
  $sql .= "WHERE id=$id;";
  mysql_query($sql);
  header("Location: relatbaseweb.php");  
?>