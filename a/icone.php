<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Help </title>
<link href="stilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<p><img src="figuras/topo_sad_e_900.jpg" width="588" height="51"></p>
		  Clique no icone desejado para inclui-lo no chamado <br>
		  <?
		    for ($i = 1; $i<=9; $i++) {
		  ?>
            <img src="imagens/icons/icon_<?=$i ?>.gif" border="0" align="absmiddle">
		  <?
		    }
		  ?>
								 
</body>
</html>
<script>
  opener.refresh();
</script>