<?
  mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);
  $sql = "Select chamado_id, max(dataa) as data, max(horaa) as hora from contato  group by chamado_id;";
  $result = mysql_query($sql) or die ($sql);
  while ($linha=mysql_fetch_object($result)) {  
    $id_chamado = $linha->chamado_id;
    $datauc  = $linha->data;
    $horauc  = $linha->hora;
    $void = mysql_query("update chamado set datauc='$datauc', horauc='$horauc' where id_chamado = $id_chamado;") or die("erro");	
    echo "ok $id_chamado - ";
  }
?>




 