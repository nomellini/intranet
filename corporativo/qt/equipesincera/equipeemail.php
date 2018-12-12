<?

require("../a/scripts/conn.php");		
//mail2("fernando.nomellini@datamace.com.br", "Teste", "Corpo", "From: Teste");


if (!$de) { $de="Anonimo";}
$body="<br>
Equipe Sincera:<br>
<br>
Para : $para<br>
Enviado por : $de<br>
<br>
<br>
01. Eu gostaria que você continuasse a<br>
<b>$campo1</b><br>
<br>
02. Eu gostaria que você parasse de<br>
<b>$campo2</b><br>
<br>
03. Eu gostaria que você começasse A<br>
<b>$campo3</b><br>
<br>
<br>
-------------------------------------------------------------<br>
Esta mensagem foi enviada pela Intranet, no link abaixo:<br>
<a href=http://192.168.0.5/corporativo/qt/equipesincera/index.php>http://192.168.0.5/corporativo/qt/equipesincera/index.php</a>
";
mail2($para, "Equipe Sincera", $body, "From: $de <>");
Header("Location: index.php?msg=OK&email=$para");
?>
