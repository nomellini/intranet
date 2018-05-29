<?
	require("slack.php");
	require("scripts/conn.php");
	require("scripts/funcoes.php");
	require("scripts/chamado_pesquisa.php");
	
    //$Guid =	CriarPesquisa(1, 1500019);
	slack_publish("@fnomellini", "1", "Teste Slack", "Datamace");
	slack_publish("@hamilton.neto", "1", "Teste Slack", "Datamace");
	
?>

<a href="http://192.168.0.14/sad/r.php?id=<?=$Guid?>">Teste</a>