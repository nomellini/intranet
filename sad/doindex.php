<?php

//http://10.98.0.5/sad/doindex.php?id_cliente=datamace&email=fernando@datamace.com.br&cliente=Fernando_Nomellini
	
	 mysql_connect(localhost, sad, data1371) or die ("Erro conectar <br>");
	 mysql_select_db(sad)  or die ("Erro selecionar <br>");
	 session_start();
	
	/* 
	 
	if($_SESSION['id']==""){	
		header("Location: index.php");
	}
	
	*/
	
	if (!isset($_GET["id_cliente"]))  {
		die ("Código do cliente não informado");
	}
 
	

 
	if ( ($id_cliente=="00 000") or ($id_cliente=="DTM")) {
		$id_cliente="DATAMACE";
	}

	if ($id_cliente=="00000") {
		$id_cliente="DATAMACE";
	}
 

	$garantindo = $email;
		
	$_SESSION['garantindo'] = $garantindo;  
	$_SESSION['email'] = $email;
 
 

 
 if ($id_cliente) {
 	 
    $sql = "SELECT bloqueio, 1 as atendimento, cliente, id_cliente FROM cliente WHERE id_cliente='$id_cliente' or senha = '$id_cliente'";


	
    $res = mysql_query($sql) or die ("Erro Select<br>$sql<br>");
	
    if(mysql_num_rows($res) != 0) {
				
        $linha = mysql_fetch_object($res);

		//print_r($linha);		
	    //die('id cliente nulo');
		
		if ($linha->bloqueio) {
			
			$msg = "4"; // Cliente bloqueado
			
		} else {
		
          if ($linha->atendimento) {
		 	  
		  
            $v_id_cliente = $linha->id_cliente;
		    $v_cliente = $linha->cliente;
		    
			$v_senha = $senha;
			$id=$_GET['id_cliente'];
			
			$_SESSION['cli'] = $v_cliente; 
			
			$usuario = $_GET['cliente'];
			
			$_SESSION['cli2'] =  $usuario; 						
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $garantindo;
			
			//die($usuario);
									
            session_register("v_cliente");		
		    session_register("v_senha");		
            session_register("v_id_cliente");   	 	
			
            $msg = "0";		
			

 
		  } else {
            $msg = "1"; // nao perence a atendimento
		  }
	    }
    } else {
     $msg = "2";  // senha ou usuario errado
     die("usuario incorreto");
	}
 } else {
   $msg = ""; // nao digitou email ou senha
 }
 
if($msg) {
	$_SESSION['msg'] = $msg;
    //print_r($_SESSION) & die('');  	
	echo "<form name='erro' action='index.php' method='post'><input type='hidden' name='erro' value='$msg'></form><script>document.erro.submit();</script>";
 } 
 
 
			
else {
	if (!$garantido) {
		$garantido = "Seu e-mail";
		//die('E-mail não informado');
	}
	if ($id) {
		$id = "";
		//die('E-mail não informado');
	}
	
 if ($id!="" && $garantindo==""){
 	die('o');
	header("Location:http://www.datamace.com.br/portalCliente/sad2.asp?id=". $id);
}else {
	$_SESSION['msg'] ="";
   Header("Location: index.php");
   }
}
 

?> 
