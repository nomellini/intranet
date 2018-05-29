<?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(sad); 
 $sql = "UPDATE lembrete set lido = 1 WHERE id=$id";
 mysql_query($sql);
 header("Location: ../inicio.php");
 
?>