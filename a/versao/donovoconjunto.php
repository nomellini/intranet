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


  function insere($sistema, $versao, $plataforma, $desc, $dataprevista) {

    $nomesistema = pegasistema($sistema);
	$data = date("Y-m-d");
	$hora = date("H:i:s");
	
	$d = explode("/", $dataprevista);
	$previsao = "$d[2]-$d[1]-$d[0]";	

	echo "Criando o conjunto : $nomesistema $versao $plataforma - $data<br>";

	$txtSQL = "INSERT INTO i_conjunto (id_sistema, versao, plataforma, data, hora,  ok, descricao, data_prev_liberacao) ";
	$txtSQL .= "VALUES ( $sistema, '$versao', '$plataforma', '$data', '$hora',  0, '$desc', '$previsao');";
	mysql_query($txtSQL) or DIE ("Erro no SQL $txtSQL<br>".mysql_error());
	$txtSQL = "SELECT max(id) as id FROM i_conjunto WHERE data='$data'";
	$result = mysql_query($txtSQL) or DIE ('erro $txtSQL');
	$linha = mysql_fetch_object( $result );
	$id = $linha->id;
    echo "Criando tarefas : ";
  echo "<br>Nova Versão : ";
	 $txtSQL = "INSERT INTO i_novaversao (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
  echo "Validacao : ";
	 $txtSQL = "INSERT INTO i_validacao (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
  echo "versao : ";
	 $txtSQL = "INSERT INTO i_versao (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Pacote : ";
     $txtSQL = "INSERT INTO i_pacote (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Teste do instalador : ";
     $txtSQL = "INSERT INTO i_instdsv (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Testes da base de dados : ";
     $txtSQL = "INSERT INTO i_dbdsv (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Boletim : ";
     $txtSQL = "INSERT INTO i_boletim (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Boletim Dsv: ";
     $txtSQL = "INSERT INTO i_boletimDsv (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Email : ";
     $txtSQL = "INSERT INTO i_email (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Comunicação : ";
     $txtSQL = "INSERT INTO i_comunicacao (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Datacenter : ";
     $txtSQL = "INSERT INTO i_datacenter (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Sugestão : ";
     $txtSQL = "INSERT INTO i_sugestao (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Testes : ";
     $txtSQL = "INSERT INTO i_teste (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Administração : ";
     $txtSQL = "INSERT INTO i_administracao (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Upload : ";
     $txtSQL = "INSERT INTO i_upload (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Download : ";
     $txtSQL = "INSERT INTO i_download (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Base de dados : ";
     $txtSQL = "INSERT INTO i_posvenda (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
   echo "Ponto de corte : ";
     $txtSQL = "INSERT INTO i_pontocorte (id_conjunto) VALUES ($id);";
	 mysql_query($txtSQL) or DIE ("Erro");
	 echo "ok<br>";
	 
	 
   
	 
   echo "Enviando Email";
   
	$fileEmail=fopen('emailnovorelease.htm', "r");
	$textEmail = fread( $fileEmail, 10000);	
	
    $email = 'dtmrelease@datamace.com.br';
	//$email = 'fernando@datamace.com.br';
	$subject = "Novo release";
	$headers .= "SAD - Sistema de Atendimento Datamace";
	
	$textEmail = str_replace("[abertura]", date("d/m/Y"), $textEmail);
	$textEmail = str_replace("[sistema]", pegaSistema($sistema), $textEmail);
    $textEmail = str_replace("[versao]", $versao, $textEmail);	
	$textEmail = str_replace("[liberacao]", $dataprevista, $textEmail);	
	$textEmail = str_replace("[descricao]", $desc, $textEmail);	
	
	mail2($email, $subject, $textEmail, $headers); 	    	
	

  }

?>
<html>
<head>
<title>Criando conjuntos;</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center">
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="/a/figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="/a/index.php?novologin=true"><img src="/a/figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="/a/figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="/a/trocasenha.php">Alterar
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="/a/inicio.php"><img src="/a/figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton">&nbsp;</td>
  </tr>
</table>
<hr size="1" noshade>
<font size="1">Usu&aacute;rio <font color="#FF0000">:<b>
<?=$nomeusuario?>
</b></font></font><br>
<br>
<br>
<?
  if ($chCj1) {
    insere($sistema1, $versao1, $plataforma1, $desc1, $data1);
  }

  if ($chCj2) {
    insere($sistema2, $versao2, $plataforma2, $desc2, $data2);
  }

  if ($chCj3) {
    insere($sistema3, $versao3, $plataforma3, $desc3, $data3);
  }

  if ($chCj4) {
    insere($sistema4, $versao4, $plataforma4, $desc4, $data4);
  }
?>
<br>
<br>
[<a href="index.php">voltar</a>]
</body>
</html>
