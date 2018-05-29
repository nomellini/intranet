<?
  require("../../scripts/conn.php");	


  if(!$deletar) {       
    $sql = "UPDATE pessoa SET ";
    $sql .= "cliente_id = '$cliente_id', nome = '$nome', telefone = '$telefone', fax = '$fax', email = '$email', cargo_id = $cargo_id, obs='$obs' ";
    $sql .= "where id_pessoa = $id_pessoa;";
  } else {
    $sql = "DELETE from pessoa WHERE id_pessoa = $id_pessoa";
  }
  mysql_query($sql);
  header("Location: clientes02.php?id_cliente=" . rawurlencode($cliente_id)  );
?>