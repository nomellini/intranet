<?
	require('../cabeca.php');
	require_once('../scripts/conn.php');


	params_gravar(1, 12);

	$id_usuario_admin = params_obter(PARAM_USUARIO_ADMINISTRADOR);
	$nm_usuario_admin = peganomeusuario($id_usuario_admin);

	if (params_obter(PARAM_DISPARA_EMAIL) )
		$dispara_email = "Sim";
	else
		$dispara_email = "N�o";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Parametros</title>


<style>
.highlight{
	padding: 14px;
	border: 1px solid #e1e1e8;
	-webkit-border-radius: 10px;
}

.bordaArredondada {
	padding: 1px;
	border: 1px solid #B0B0B0;
	background-color: #f7f7f9;
	-webkit-border-radius: 1px;
}

</style>

</head>
<body>

<div class="col-md-12" align="center">
	<h3>PARAMETROS DO SAD</h3>
</div>

<div class="col-md-9">
<table class="table table-condensed table-striped table-hover">
	<tr>
    	<td><strong>Usu&aacute;rio Administrador:</strong></td>
		<td><?=$nm_usuario_admin?></td>
    </tr>
	<tr>
    	<td><strong>Envia emails :</strong></td>
		<td><?=$dispara_email ?></td>
    </tr>
</table>
</div>
</body>
</html>