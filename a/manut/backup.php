<?
	require("../cabeca.php");
//	require("../scripts/conn.php");	
?><html>
<head>
<title>Backup</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?


  mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);

  $hoje = date("Y-m-d");
  $sql = "delete from chamado where ((descricao='' or descricao is null) and (dataa < '$hoje'));";
  mysql_query($sql);
  $sql = "delete from contato where ((historico='' or historico is null) and (dataa < '$hoje'));";
  mysql_query($sql);

//die ("ok");
  // Importação dos textos
  // dtmsad1:/dados/ftp/sites/sad/htdocs #
  
  
  // Todo:
  /*
  
  	1. Pegar lista de clientes bloqueados que tem chamados abertos.
	
	
select distinct cliente_id from chamado 
inner join cliente on cliente.id_cliente = chamado.cliente_id
where chamado.status = 2 and cliente.bloqueio = 1
order by cliente.cliente
	
	
	2. Recriar clientes conforme abaixo  
  */
  
  	$sql =  "select distinct cliente_id from chamado inner join cliente on cliente.id_cliente = chamado.cliente_id 
			 where chamado.status = 2 and cliente.bloqueio = 1
              order by cliente.cliente  ";
  
    $lista = array();
	$conta = 0;
  	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object($result))
	{
		$lista[$conta] = $linha->cliente_id;		
		$conta++;
	}
  

  echo "inicio<br>";
    $comando=`mysql -usad -pdata1371 sad --local-infile=1 < /dados/ftp/sites/sad/htdocs/backup/c.txt`;
  echo "Fim<br>";	
  
  loga_integracao($ok);  

  /*
  	3. Criar lista de desbloqueados que estavam na lista do item 1.	
	4. Listar os chamados em aberto da lista acima.
	5. Enviar email aos destinatários, dizendo que o cliente foi desbloqueado.  
	
	para cada cliente do select lá em cima:
	
	select distinct u.nome, u.email, cl.cliente from chamado c
inner join usuario u on u.id_usuario = c.destinatario_id
inner join cliente cl on cl.id_cliente = c.cliente_id
where cliente_id = 'VERTICE BOOKS' and status = 2 and cl.bloqueio = 0
	
	  */
	  
	foreach( $lista as $cliente_id )
	{
		
		$sql = "
select distinct u.nome, u.email, cl.cliente from chamado c
inner join usuario u on u.id_usuario = c.destinatario_id
inner join cliente cl on cl.id_cliente = c.cliente_id
where cliente_id = '$cliente_id' and status = 2 and cl.bloqueio = 0";
		$result = mysql_query($sql);
		while ($linha = mysql_fetch_object($result))
		{
			$mensagem = "$linha->nome, o cliente <b>$linha->cliente</b> acaba de ser desbloqueado. Por favor, verifique seus chamados em nome deste cliente<br>";
			
			$emailDestinatario = $linha->email;	
			//$emailDestinatario = "fernando@datamace.com.br";	
			
					
			$subject = "Cliente Desbloqueado: ". $linha->cliente;
			$headers = "Datamace Informática";
			
			mail2($emailDestinatario, $subject, $mensagem, $headers);
			
			
		}
	}	  


	
   // $comando=`mysql -usad -pdata1371 sad --local-infile=1 < /dados/ftp/sites/sad/htdocs/backup/c.txt`;
  
  /*
    Local para verificar se todos os clientes estão na tabels ClientePlus. Se houver
	pelo menos um. Devemos direcionar a tela para verificar se devenos colocar os clientes
	em pós venda ou não.
  */
  
  // Backup das bases
  $comando=`mysqldump suporte  -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/suporte.txt`;
  $comando=`mysqldump treinamento  -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/treinamento.txt`;  
  $comando=`mysqldump sympoll -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/sympoll.txt`;
  $comando=`mysqldump phorum -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/phorum.txt`;
  $comando=`mysqldump hardware -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/hardware.txt`;
  $comando=`mysqldump datamace -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/datamace.txt`;
  $comando=`mysqldump sad  -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/sadbkp.txt`;
  $comando=`mysqldump estoque  -usad -pdata1371 --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/estoquebkp.txt`;
  $comando = `zip /dados/ftp/sites/sad/htdocs/backup/atendimento.zip /dados/ftp/sites/sad/htdocs/a/_email.txt /dados/ftp/sites/sad/htdocs/backup/sadbkp.txt /dados/ftp/sites/sad/htdocs/backup/datamace.txt /dados/ftp/sites/sad/htdocs/backup/hardware.txt /dados/ftp/sites/sad/htdocs/backup/phorum.txt /dados/ftp/sites/sad/htdocs/backup/suporte.txt /dados/ftp/sites/sad/htdocs/backup/sympoll.txt /dados/ftp/sites/sad/htdocs/backup/estoquebkp.txt /dados/ftp/sites/sad/htdocs/backup/treinamento.txt /dados/ftp/sites/sad/htdocs/backup/backup /dados/ftp/sites/sad/htdocs/backup/restore`;  
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/atendimento.txt -f`;
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/sadbkp.txt -f`;
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/datamace.txt -f`;
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/hardware.txt -f`;
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/phorum.txt -f`;
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/suporte.txt -f`;
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/sympoll.txt  -f`;
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/estoquebkp.txt  -f`;  
//  $comando = `rm /dados/ftp/sites/sad/htdocs/backup/treinamento.txt  -f`;    
  
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
