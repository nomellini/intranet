#!/usr//bin/php -f
<? 

  require("scripts/conn.php");
  $agoraTimeStamp=date("Y-m-d H:i:s"); 
  $sql = "update usuario set estado = 1, estado_hora = '$agoraTimeStamp' ";
  $sql .= "where id_usuario = 12 and estado <> 3";
  $result = mysql_query($sql) or die($sql);

?>
