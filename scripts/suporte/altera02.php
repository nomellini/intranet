<?
 mysql_connect(localhost, root, marcia);
 mysql_select_db(suporte);
 if ($deleta) {

    $SQL = "DELETE FROM titulo WHERE id=$id;";  
    $result = mysql_query($SQL);
    $SQL = "delete from descr where id_titulo = $id;";
    $result =  mysql_query($SQL);    
 } else
 {
   $SQL = "update titulo set titulo='$titulo', id_so=$so, obs='$obs' where id=$id;"; 
   mysql_query($SQL);    
 }

 header ("Location: manut.php");  
 exit;  
?> 