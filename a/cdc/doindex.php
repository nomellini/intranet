<?php
 mysql_connect(localhost, sad, data1371) or die ("Erro conectar <br>");
 mysql_select_db(sad)  or die ("Erro selecionar <br>");
 session_start();
 if ($id_cliente) {
    $sql = "SELECT cliente, id_cliente FROM cliente WHERE id_cliente='$id_cliente'";
    $res = mysql_query($sql) or die ("Erro Select<br>$sql<br>");
    if(mysql_num_rows($res) != 0) {
        $linha = mysql_fetch_object($res);
            $v_id_cliente = $linha->id_cliente;
		    $v_cliente = $linha->cliente;
            session_register("v_cliente");		
            session_register("v_id_cliente");  
            $msg = "0";		  
    } else {
      $msg = "2";  // Usuario não existe
	}
 } else {
   $msg = "3"; // Não entrou na página pelo site
 }
 
 if($msg) {
   Header("Location: erro.php?erro=".$msg);
 } else {
   Header("Location: inicio.php");
 }
?> 
