<?
  require("../scripts/conn.php");
  $sql = "select id_usuario from sigame where id_usuario = $id_usuario and id_chamado = $id_chamado";
  $result = mysql_query($sql) or die($sql);
  if (!$linha = mysql_fetch_object($result)) {
    $sql = "insert into sigame values ($id_usuario,$id_chamado);";
	mysql_query($sql);
	loga_seguirChamado($id_usuario, $id_chamado) ;
  }
  header("Location: ../historicochamado.php?&id_chamado=$id_chamado&sigame=true");
?>