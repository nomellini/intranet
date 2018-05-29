<?
	require("../scripts/conn.php");
	require("../scripts/funcoes.php");		
	require("funcoes.php");	
	require("../scripts/classes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<style type="text/css">

hr {
	color:#666
}

p {
	font-family:Arial, Helvetica, sans-serif;
}

.Titulo 
{
	color:#666
}
</style>

</head>

<body>
<?
	$sql = "select data, texto_anterior, u.nome from rnc_memory m 
			inner join usuario u on u.id_usuario = m.id_usuario 
			where id_chamado = $Chamado and campo = '$Campo'
			order by id desc";
	$result = mysql_query($sql) or die ($sql);	
	while ($linha = mysql_fetch_object($result))
	{
?>		
    <p class="Titulo"><strong><?=dataOk($linha->data);?></strong> - <?=$linha->nome;?></p>
    <p style="font-weight:bold"><?=$linha->texto_anterior;?></p>
    <hr size=1px/>  
<?        
	}
?>
</body>
</html>
