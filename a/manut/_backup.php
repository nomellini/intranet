<html>
<head>
<title>Backup</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?

  $hoje = date("Y-m-d");
  mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);

  $sql = "delete from chamado where ((descricao='' or descricao is null) and (dataa < '$hoje'));";
  mysql_query($sql);

  $sql = "delete from contato where ((historico='' or historico is null) and (dataa < '$hoje'));";
  mysql_query($sql);

  // Importação dos textos
  // dtmsad1:/var/www/html/ #
  
    $comando=`mysql -usad -pdata1371 sad --local-infile=1 < /var/www/html/backup/c.txt`;

  
  /*
    Local para verificar se todos os clientes estão na tabels ClientePlus. Se houver
	pelo menos um. Devemos direcionar a tela para verificar se devenos colocar os clientes
	em pós venda ou não.
  */
  
  // Backup das bases
/*  
  $comando=`mysqldump suporte  -usad -pdata1371 --add-drop-table > /var/www/html/backup/suporte.txt`;
  $comando=`mysqldump treinamento  -usad -pdata1371 --add-drop-table > /var/www/html/backup/treinamento.txt`;  
  $comando=`mysqldump sympoll -usad -pdata1371 --add-drop-table > /var/www/html/backup/sympoll.txt`;
  $comando=`mysqldump phorum -usad -pdata1371 --add-drop-table > /var/www/html/backup/phorum.txt`;
  $comando=`mysqldump hardware -usad -pdata1371 --add-drop-table > /var/www/html/backup/hardware.txt`;
  $comando=`mysqldump datamace -usad -pdata1371 --add-drop-table > /var/www/html/backup/datamace.txt`;
  $comando=`mysqldump sad  -usad -pdata1371 --add-drop-table > /var/www/html/backup/sadbkp.txt`;
  $comando=`mysqldump estoque  -usad -pdata1371 --add-drop-table > /var/www/html/backup/estoquebkp.txt`;
  $comando = `zip /var/www/html/backup/atendimento.zip /var/www/html/a/_email.txt /var/www/html/backup/sadbkp.txt /var/www/html/backup/datamace.txt /var/www/html/backup/hardware.txt /var/www/html/backup/phorum.txt /var/www/html/backup/suporte.txt /var/www/html/backup/sympoll.txt /var/www/html/backup/estoquebkp.txt /var/www/html/backup/treinamento.txt /var/www/html/backup/backup /var/www/html/backup/restore`;  
  
*/  
 
 
//  $comando = `rm /var/www/html/backup/atendimento.txt -f`;
//  $comando = `rm /var/www/html/backup/sadbkp.txt -f`;
//  $comando = `rm /var/www/html/backup/datamace.txt -f`;
//  $comando = `rm /var/www/html/backup/hardware.txt -f`;
//  $comando = `rm /var/www/html/backup/phorum.txt -f`;
//  $comando = `rm /var/www/html/backup/suporte.txt -f`;
//  $comando = `rm /var/www/html/backup/sympoll.txt  -f`;
//  $comando = `rm /var/www/html/backup/estoquebkp.txt  -f`;  
//  $comando = `rm /var/www/html/backup/treinamento.txt  -f`;    
  
  function insereClientePlus($AId_cliente, $ACliente) {
    $datae = date("Y-m-d");  
    $CST_NOVOCLIENTE=10;
    $lStr = "insert into clienteplus (id_cliente, cliente, fl_posvenda, data_inicio) values ";
	$lStr .= "('$AId_cliente', '$ACliente', $CST_NOVOCLIENTE, '$datae') ";
	mysql_query($lStr) or Die("Fala ao inserir cliente na tabela clientePlus\n<br>$lStr");
  }


  $clientes = mysql_query("select id_cliente, cliente from cliente");
  while ( $linhaCliente = mysql_fetch_object($clientes) ) {
    $id_cliente = $linhaCliente->id_cliente;
	$cliente = $linhaCliente->cliente;
    $clientePlus = mysql_query("select id_cliente from clienteplus where id_cliente = '$id_cliente'");
    if (!$linhaPlus = mysql_fetch_object($clientePlus) ) {      
	  insereClientePlus($id_cliente, $cliente);
     }
  }

  
  
?>
<p><strong>OK</strong><br>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Tabela de Clientes </font> e Sistemas importadas no SAD</p>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><a href="../inicio.php">voltar
  ao sistema de atendimento</a></font></p>
<p>&nbsp;</p>
</body>
</html>
