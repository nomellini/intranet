<?php require_once('../../Connections/sad.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p>Chamado:<br />
  Descrição:<br />
</p>
<p>Setar restrições: 
Caso uma restição já tenha histórico, não será possível excluir uma restrição do chamado.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?
	$sql = "select r.Id, Ds_Descricao restricao, Ic_ImpedeEncerramentoChamado impede from restricoes r left join 
	rl_restricao_chamado rrc on r.Id = rrc.Id_Restricao where rrc.Id_Chamado = " . $_GET["id"];
	echo $sql;
	$result = mysql_query($sql);
	while (!$linha = mysql_fetch_object($result)) {
		echo $linha->restricao;
	}
?>
<p>Historico das restrições:</p>
<table width="65%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td>Restrição</td>
    <td>Situação</td>
    <td>Data</td>
    <td><p>Quem</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>