<?
  mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);
  session_start();
  if ($v_id_cliente) {
    $destinatario = 0;
    $descricao = eregi_replace("\"", "`", $descricao);  // Evita " e '
    $descricao = eregi_replace("\'", "`", $descricao);	// no SQL, trocando por `
    $dataa = date("Y-m-d");
    $horaa = date("H:i:s");
	$consultor_origem = 141; // Marcelo
	$destinatario = 141;     // Marcelo Nunes // TODO: Parametrizar
	$motivo_id = 28; 
	$remetente_id = 56; //Cliente
	$sistema_id = 1024; // Qualidade
	$sql  = "INSERT INTO chamado (consultor_id, email, status, cliente_id, descricao, sistema_id, dataa, horaa, ";
	$sql .= "destinatario_id, externo, nomecliente, categoria_id, prioridade_id, motivo_id, remetente_id, lido, lidodono, datauc, horauc) VALUES ";
	$sql .= "($consultor_origem, '$email', 2, '$v_id_cliente', '$descricao', $sistema_id, '$dataa', '$horaa', ";
	$sql .= "$destinatario, 0, '$nome', $categoria_id, 1, $motivo_id , $remetente_id, 0, 0, '$dataa', '$horaa');";
	mysql_query($sql) or $msg = " não pode ser aberto, tente novamente.";
	if(!$msg) {
		$sql = "select max(id_chamado) as novo from chamado where motivo_id=$motivo_id and cliente_id = '$v_id_cliente'";
		mysql_query($sql);
		$result = mysql_query($sql);
		$linha=mysql_fetch_object($result);
	    $chamado = $linha->novo;
		$msg = " foi aberto com sucesso, com o número $chamado.";
	}

	$sql = "";
	$sql .= "INSERT INTO contato ( chamado_id, pessoacontatada, origem_id, historico, consultor_id, ";
	$sql .= "destinatario_id, status_id, dataa, horaa, publicar, rnc, datae, horae) VALUES ";
	$sql .= "($chamado, '$nome', 15, 'Primeiro contato. Inserido pelo sistema', $consultor_origem, $consultor_origem, 2, '$dataa', '$horaa', 0, 0, '$dataa', '$horaa')";

	mysql_query($sql);

	/*
	   Preparando o email para ser enviado ao cliente
	*/
	$fileEmail=fopen('email.txt', "r");
	$textEmail = fread( $fileEmail, 10000);

	$textEmail = str_replace("[nome]", $nome, $textEmail);
	$textEmail = str_replace("[chamado]", $chamado, $textEmail);
	$textEmail = str_replace("[descricao]", $descricao, $textEmail);

	$subject = "DATAMACE - Canal do cliente";
	$headers = "";
	$headers .= "Qualidade <suporte@datamace.com.br>\n";
	mail($email, $subject, $textEmail, $headers);
	mail("suporte@datamace.com.br", $subject, $textEmail, $headers);

	fclose($fileEmail);

?>
<html>
<head>
<title>Confirma&ccedil;ao:</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" height="67"><img height=67 alt="" src="Datamace_arquivos/logo_home2.gif"
            width=246 border=0></td>
    <td height="67" align="right" valign="bottom"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000000">
      <?=strtolower($v_cliente)?>
      </font></td>
  </tr>
  <tr>
    <td width="245" valign="middle" height="19" bgcolor="#999999"> <font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="1">
      <script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;

      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Terça-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "Sábado";
      diasemana[7] = "Domingo";

      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();

     document.write (diasemana[diaindex] + ', ' + dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
      </font></td>
    <td width="133" valign="middle" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000"><a href="inicio.php">In&iacute;cio</a>&nbsp;</font></td>
    <td width="1" valign="middle" bgcolor="#CCCCCC" align="center"><img src="../imagens/spacer.gif" width="1" height="1"></td>
    <td width="406"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000">&nbsp;&nbsp;<a href="abertura.php">Abrir
      novo chamado</a>&nbsp;</font></td>
  </tr>
</table>
<p align="center"><strong><font color="#003366" size="3" face="Verdana">Canal
  do Cliente</font></strong></p>
<table width="94%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><font size="2">Seu chamado foi recebido em nosso Data Center com sucesso,
      aguarde, em breve voc&ecirc; estar&aacute; recebendo o c&oacute;digo correspondente.
      </font></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<div align="center">
  <p align="left"><a href="inicio.php">clique aqui para voltar ao in&iacute;cio</a></p>
  <div align="left"></div>
  <hr size="1" noshade>
  <div align="left"><font color="#999999" size="1">Datamace Inform&aacute;tica
    &copy;2001</font></div>
  </div>
</body>
</html>
<?} else  {
 Header("Location: index.php");
}
?>