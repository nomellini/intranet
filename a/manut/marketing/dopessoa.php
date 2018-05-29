<?
  require("../../scripts/conn.php");	
  $sql = "INSERT into pessoa ";
  $sql .= "(cliente_id, nome, telefone, fax, email, cargo_id, obs) VALUES (";
  $sql .= "'$id_cliente', '$nome', '$telefone', '$fax',  '$email', $cargo_id, '$obs') ;";
  mysql_query($sql);
  header("Location: clientes02.php?id_cliente=" . rawurlencode($id_cliente)  );
?>