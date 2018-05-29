<?
	require("../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
    $pode = true;//pegaManut($ok);   
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {

?>	
<html>
<head>
<title>manut</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<p><img src="../figuras/intro.gif" width="321" height="21"><br>
  Manuten&ccedil;&atilde;o das tabelas</p>
<table width="16%" border="0" cellpadding="1" cellspacing="1">
  <tr> 
    <td><a href="hierarquias.php">Hierarquias</a></td>
  </tr>
  <tr> 
    <td> 
      <p><a href="usuarios.php">Usu&aacute;rios</a></p>    </td>
  </tr>
  <tr> 
    <td><a href="categorias.php">Categorias</a></td>
  </tr>
  <tr> 
    <td><a href="prioridade.php">Prioridades</a></td>
  </tr>
  <tr> 
    <td><a href="sistema.php">Sistemas</a></td>
  </tr>
  <tr> 
    <td><a href="motivo.php">Motivos</a></td>
  </tr>
  <tr> 
    <td><a href="origem.php">Origem</a></td>
  </tr>
  <tr> 
    <td><a href="status.php">Status</a></td>
  </tr>
  <tr>
    <td><a href="diagnostico.php">Diagnosticos</a></td>
  </tr>
  <tr>
    <td><a href="AlterarID.php">Alterar ID's </a></td>
  </tr>
</table>
<p><a href="backup.php">Clique aqui para FAZER IMPORTA&Ccedil;&Atilde;O + BACKUP 
  do sistema de atendimento</a><br>
  Aten&ccedil;&atilde;o. O Link acima faz um backup do sistema de atendimento, 
  caso queira<br>
  atualizar o cadastro dos clientes, voc&ecirc; deve rodar o exporta.bat<br>
  que esta em '[DTM_SERVER_ADM: \DTM]', para que os arquivos sejam<br>
  atualizados.</p>
<p><a href="../../backup/ultimo.htm">Ver o Backup mais recente</a></p>
<p>[<a href="../inicio.php">voltar ao sistema</a>]</p>
</body>
</html>
<?
}
?>