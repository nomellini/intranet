<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?
	require("../scripts/conn.php");	

		$publicar = "1";
		if (!isset($_POST["publicar"]))
		{
			$publicar = "0";
		}

		$Clientes = count($id_cliente);
				
		for ($i=0; $i<$Clientes; $i++) {
			
			$cliente = $id_cliente[$i];
			


			$result = mysql_query("SHOW COLUMNS FROM chamado");
			$sql = "insert into chamado (";
			$inicio = true;
			while ($row = mysql_fetch_assoc($result)) {
				$Campo = $row["Field"];
				if ( ($Campo != "id_chamado") && ($Campo != "nomecliente") && ($Campo != "email") ) {
					if ($inicio) {
						$inicio = false;
					} else {
						$sql .= ", ";
					}
					$sql .= $Campo;					
				}
			}	
			$sql .= ") select ";			
			
			$result = mysql_query("SHOW COLUMNS FROM chamado");
			$inicio = true;
			while ($row = mysql_fetch_assoc($result)) {
				$Campo = $row["Field"];
				if ( ($Campo != "id_chamado") && ($Campo != "nomecliente") && ($Campo != "email") ) {
					
					
					
					if ($inicio) {
						$inicio = false;
					} else {
						$sql .= ", ";
					}
					
					if ($Campo == 'cliente_id') {
						$sql .= "'$cliente'";
					} else if ($Campo == 'chamado_pai_id') {
						$sql .= "$id_chamado";
					} else {
						$sql .= $Campo;
					}

					
	
				}
			}					
			$sql .= " from chamado where id_chamado = $id_chamado";		
																					
			mysql_query($sql) or die(mysql_error() . " - ". $sql);

			$sql = "select max(id_chamado) id from chamado where chamado_pai_id = $id_chamado";
			$result = mysql_query($sql) or die ($sql);
			$row = mysql_fetch_assoc($result);
			$ID = $row["id"];			
			echo $cliente . " - Chamado " . $row["id"] . "<br>";
			
			$sql = "update chamado set publicar = '$publicar' where id_chamado = $ID";
			mysql_query($sql) or die(mysql_error() . " - ". $sql);
			
			
			$result = mysql_query("SHOW COLUMNS FROM contato");
			$sql = "insert into contato (";
			$inicio = true;
			while ($row = mysql_fetch_assoc($result)) {
				$Campo = $row["Field"];
				if ( ($Campo != "id_contato") && ($Campo != "pessoacontatada") ) {
					if ($inicio) {
						$inicio = false;
					} else {
						$sql .= ", ";
					}
					$sql .= $Campo;					
				}
			}	
			$sql .= ") select ";			
			
			$result = mysql_query("SHOW COLUMNS FROM contato");
			$inicio = true;
			while ($row = mysql_fetch_assoc($result)) {
				$Campo = $row["Field"];

				if ( ($Campo != "id_contato") && ($Campo != "pessoacontatada") ) {					
					
					if ($inicio) {
						$inicio = false;
					} else {
						$sql .= ", ";
					}
					
					if ($Campo == 'chamado_id') {
						$sql .= "$ID";
					} else {
						$sql .= $Campo;
					}

					
	
				}
			}					
			$sql .= " from contato where chamado_id = $id_chamado";		
			mysql_query($sql);

		}
		

		

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Replicar Chamado</title>
</head>

<body>
<a href="../inicio.php">voltar</a>
</body>
</html>