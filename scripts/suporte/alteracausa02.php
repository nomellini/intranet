<?
 mysql_connect(localhost, root, marcia);
 mysql_select_db(suporte);
 if ($deleta) {
    $SQL = "delete from descr where id = $id_causa;";
    $result =  mysql_query($SQL);    
 } else
 {
   $SQL = "update descr set causa='$causa', solucao='$solucao' where id=$id_causa;"; 
   mysql_query($SQL);  
 }

 header ("Location: alteracausa.php?id_titulo=$id_titulo&id_causa=$id_causa");  
 exit;  
?> 