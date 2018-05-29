<?
 mysql_connect(localhost, root, marcia);
 mysql_select_db(suporte);
 $SQL = "INSERT INTO descr (id_titulo, causa, solucao) VALUES ($id_titulo, '$causa', '$solucao');"; 
 mysql_query($SQL);    
 header ("Location: novo02.php?id_titulo=$id_titulo");  
 exit;  
?> 