<? 
include_once('cabeca.inc.php');

if	($adm != 'S'){
	$db = new DB();
	if ($db->getQuantidadeIP($ipremoto, "P", $id)){
		require ('negado.php');
		die();
	}
}

if ($id && $tipo) {

	$acao = "enviado";
	$dataprova = substr($dataprova,6,4) . '-' . substr($dataprova,3,2) . '-' . substr($dataprova,0,2);
	
	$cod_prova        = $id;

	if ($provanro == 2){
		$prova1 = mysql_query("SELECT rg " .
					" FROM respostas where rg = '$rg' and" .
					" month(dataprova) = " . substr($dataprova,5,2) .
					" and cod_prova = $cod_prova" .
					" and flagTipo = '$tipo'".
					" and provanro = 1");
		$prova1tot = mysql_num_rows($prova1);
	}

	$perguntas = implode('#',$perguntas);

	reset($_POST);
	while(list($var,$val) = each($_POST)) {
		if (substr($var,0,1)=='q'){
			eval('$resp .= $'.substr($var,0,strlen($var)).'."#";');
		}	  
	}

	$empnome	= strtoupper(mysql_real_escape_string($empnome)); 
	$resp		= strtoupper(mysql_real_escape_string($resp));
	
	$sSQL = "INSERT into respostas (rg, flagTipo, empnome, dataprova, cod_prova, perg, resp, provanro, ip ) 
			VALUES ('$rg', '$tipo', '$empnome', '$dataprova', '$cod_prova', '$perguntas', '$resp', '$provanro', '$ipremoto' )";

	$vID = $vID2 = 0;
	if(!mysql_query($sSQL)) {
		$acao = mysql_error()." não foi enviado";
	}else {
		$acao = "";
		$vID = mysql_insert_id();
	}
	if ($vID > 0){
		$acao = "foi enviado";
		if (!$prova1tot && $provanro == 2){
			mysql_query("INSERT into respostas (rg, flagTipo, empnome, dataprova, cod_prova, perg, resp, provanro, ip ) 
						VALUES ('$rg', '$tipo', '$empnome', '$dataprova', '$cod_prova', '$perguntas', '$resp', '1', '$ipremoto' )");
			$vID2 = mysql_insert_id();
		}
	} 

	$prova = new treinamento("");
	$prova->tipo = $tipo;
	$prova->verifica_nota($vID);
	$vConceito = $prova->verifica_conceitoValor($vID, $prova->aproveitamentoReal);
	$vConceitoID = $prova->verifica_conceitoID($vID);

	if ($vID > 0) mysql_query("update respostas set conceito_id = '$vConceitoID' ,conceito = '$vConceito' where id = $vID");
	if ($vID2 > 0) mysql_query("update respostas set conceito_id = '$vConceitoID' ,conceito = '$vConceito' where id = $vID2");

	$db = new DB();
	$db->setIP($ipremoto, "P", $id);
}

?>
<html>
<!-- DW6 -->
<head>
<title>Datamace Informática</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF
}
.style2 {
	font-size: 18px;
	font-weight: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style3 {
	color: #000099
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
	<tr>
		<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
	</tr>
</table>
<div align="center">
	<table width="100%" border="0">
		<tr>
			<td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
					<tr>
						<td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><p>
							<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;}
-->
						</style>
						</p>
							<p>&nbsp;</p>
							<p>&nbsp; </p>
							<table width="536" border="0" align="center">
								<tr>
									<td width="115">Treinando:</td>
									<td width="411">&nbsp;
										<?=$prova->rg . ' - ' . $prova->nome ?></td>
								</tr>
								<tr>
									<td>Perguntas:</td>
									<td>&nbsp;
										<?=$prova->qtd_perguntas ?></td>
								</tr>
								<tr>
									<td>Acertos:</td>
									<td>&nbsp;
										<?=$prova->qtd_acertos ?></td>
								</tr>
								<tr>
									<td>Aproveitamento:</td>
									<td>&nbsp;
										<?=$prova->aproveitamento . " %" ?></td>
								</tr>
								
							</table>
							<p>&nbsp;</p>
							<p align="center">Clique <font face="Verdana, Arial, Helvetica, sans-serif" size="4" color="#FF0000"><a href="<? if ($tipo == 1) echo "/index.php"; else echo "/treinamento/$linkPagina"; ?>">aqui</a></font> para voltar ao menu principal.</p>
							<p align="center">&nbsp;</p>
							<p align="center">&nbsp;</p></td>
					</tr>
				</table>
				<br>
				<hr align="center">
				<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p></td>
		</tr>
	</table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>
