<?
  require("../scripts/conn.php");
  require("../scripts/funcoes.php");
  $sql = "select
  	horaa,
	horae,
	sec_to_time(time_to_sec(horae) - time_to_sec(horaa)) as duracao ,

      extract( HOUR from sec_to_time(time_to_sec(horae) - time_to_sec(horaa))) as hora,
      extract( MINUTE from sec_to_time(time_to_sec(horae) - time_to_sec(horaa))) as minuto,
      extract( SECOND from sec_to_time(time_to_sec(horae) - time_to_sec(horaa))) as segundo

from
contato where id_contato = " . $id_contato;

  $result = mysql_query($sql) or die (mysql_error());
  $linha = mysql_fetch_object($result);

	$DuracaoAtual = $linha->duracao;
	$hora = $linha->hora;
	$minuto = $linha->minuto;
	$segundo = $linha->segundo;

?>
<html>
<head>
<title>Data Prevista</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
Edi��o de dura��o de contato
<br>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr>
    <td align="center" bgcolor="#FFFFFF">Referente ao contato <?=$id_contato?> <br></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF">Dura&ccedil;&atilde;o atual: <?= $DuracaoAtual ?></td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><p>Nova dura&ccedil;&atilde;o</p>
      <form action="doEditaDuracao.php" method="post" name="form1" id="form1">
        <p>
          <select name="horas" class="unnamed1" id="horas">
            <? for ($i = 0 ; $i < 24; $i++) {
			   $item = sprintf("%02d", $i);
	           $s= "";
			   if ( $i == $hora )
			   {
				   $s = "selected";
			   }
		  ?>
            <option value="<?= $item?>" <?= $s?>> <?= $item?>       </option>
            <? } ?>
          </select>
          H

          <select name="minutos" class="unnamed1" id="minutos">
            <? for ($i = 0 ; $i < 60; $i++) {
			   $item = sprintf("%02d", $i);
	           $s= "";
			   if ( $i == $minuto )
			   {
				   $s = "selected";
			   }
		  ?>
            <option value="<?= $item?>" <?= $s?>> <?= $item?>         </option>
            <? } ?>
          </select>
          M</p>
        <p>
          <input type="submit" name="button" id="button" value="ok">
          <input type="hidden" name="id_contato" id="id_contato" value="<?= $id_contato?>">
        </p>
      </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
