<?
 mysql_connect(localhost, root, marcia);
 mysql_select_db(suporte);
 $SQL = "INSERT INTO titulo (titulo, id_so, obs) VALUES ('$titulo', $so, '$obs');"; 
 mysql_query($SQL);    
 $SQL = "SELECT max(id) as novo from titulo;"; 
 $result = mysql_query($SQL);      
 $linha = mysql_fetch_object($result);
 $id = $linha->novo;
 header ("Location: novo02.php?id_titulo=$id");  
 exit;  
?> 