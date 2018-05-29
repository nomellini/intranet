<?
  require("../scripts/conn.php"); 
  $sql = "select historico from contato where id_contato = (select max(id_contato) from contato where chamado_id=" . $id .");";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
  $contato = $linha->historico;
?>
<table width="90%" border="1" cellpadding="1" cellspacing="1">
  <tr>
    <td><strong>&Uacute;ltimo contato:</strong><br>
      <br>
    <?=$contato?></td>
  </tr>
</table>
