<?php
 mysql_connect(localhost, sad, data1371) or die ("Erro conectar <br>");
 mysql_select_db(sad)  or die ("Erro selecionar <br>");
 session_start();
 if ($id_cliente) {
    $sql = "SELECT bloqueio, atendimento, cliente, id_cliente FROM clienteplus WHERE id_cliente='$id_cliente'";
    $res = mysql_query($sql) or die ("Erro Select<br>$sql<br>");
    if(mysql_num_rows($res) != 0) {
        $linha = mysql_fetch_object($res);
		if ($linha->bloqueio) {
		  $msg = "4"; // Cliente bloqueado
		} else {
          if ($linha->atendimento) {
            $v_id_cliente = $linha->id_cliente;
		    $v_cliente = $linha->cliente;
		    $v_email = $email;
		    $v_senha = $senha;
            session_register("v_cliente");		
		    session_register("v_email");
		    session_register("v_senha");		
            session_register("v_id_cliente");  
            $msg = "0";		  
		  } else {
            $msg = "1"; // nao perence a atendimento
		  }
	    }
    } else {
      $msg = "2";  // senha ou usuario errado
	}
 } else {
   $msg = "3"; // nao digitou email ou senha
 }
 
 if($msg) {
   Header("Location: erro.php?erro=".$msg);
 } else {
   Header("Location: inicio.php");
 }
?> 
