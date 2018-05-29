<?
include_once ('cabeca.inc.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Datamace Inform&aacute;tica Ltda.</title>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
$TabSad = "treinados";

mysql_query("use treinamento");

$RTre = mysql_query("select tre_usuario.*, ".
					"email, nome, cargo, empnome ".
					"from tre_usuario ".
					"inner join cadastrotreinamento on cadastrotreinamento.rg = tre_usuario.rg ");
//					"where tre_usuario.descricao = 1");
while ($LTre = mysql_fetch_array($RTre)){

	$RSadTre = mysql_query("select id_treinamento from sad.".$TabSad." where id_treinamento = '".$LTre['id']."'");
	
	switch ($LTre['descricao']){
		case 1:
			$conceito = 'APROVADO';
			break;
		case 2:
			$conceito = 'REPROVADO';
			break;
		case 3:
			$conceito = 'NÃO SE APLICA';
			break;
		default:
			$conceito = '';
			break;
	}
	
	if(mysql_num_rows($RSadTre) == 0){
		$SQL = "INSERT into sad.".$TabSad.
				" (cliente,".
				"email,".
				"sistema,".
				"nome,".
				"cargo,".
				"conceito,".
				"data,".
				"rg,".
				"id_treinamento) VALUES (".
				"'".$LTre['empnome']."',".
				"'".$LTre['email']."',".
				"'".$LTre['modulo']."',".
				"'".$LTre['nome']."',".
				"'".$LTre['cargo']."',".
				"'".$conceito."',".
				"'".$LTre['data']."',".
				"'".$LTre['rg']."',".
				"'".$LTre['id']."')";
	}else{
		$SQL = "UPDATE sad.".$TabSad." set ".
				"cliente = '".$LTre['empnome']."',".
				"email = '".$LTre['email']."',".
				"sistema = '".$LTre['modulo']."',".
				"nome = '".$LTre['nome']."',".
				"cargo = '".$LTre['cargo']."',".
				"conceito = '".$conceito."',".
				"data = '".$LTre['data']."',".
				"rg = '".$LTre['rg']."'".
				"where id_treinamento = '".$LTre['id']."'";
	}
//	echo $SQL . "<br>";
	$i++;
	echo $LTre['id'] . " :" . mysql_error(mysql_query($SQL)) . "<br>";
}

echo "Script concluído com $i processado's'."

?>
</body>
</html>
