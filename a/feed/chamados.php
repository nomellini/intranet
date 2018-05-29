<?php

  function GetDateTime($data, $hora) 
  {
  
	$cd = strtotime($data);
	$tempos = explode(":", $hora);
	
	$newdate = mktime(
		$tempos[0], // Hora
	 	$tempos[1], // Minuto
		$tempos[2], // Segundo
		date('m',$cd),  // Mês
		date('d',$cd),  // Dia
		date('Y',$cd)   // Ano
	);
	return $newdate; 
  }

  
  include("FeedWriter.php");
  include("../scripts/conn.php");  
  include("../scripts/funcoes.php");  
  
  //Creating an instance of FeedWriter class. 
  //The constant RSS1 is passed to mention the version
  $TestFeed = new FeedWriter(RSS1);
  
  //Setting the channel elements
  //Use wrapper functions for common elements
  //For other optional channel elements, use setChannelElement() function
  $TestFeed->setTitle('DTM Chamados');
  $TestFeed->setLink('http://10.98.0.5/a');
  $TestFeed->setDescription('Ultimo contato');
   
  //It's important for RSS 1.0 
  $TestFeed->setChannelAbout('http://www.ajaxray.com/rss2/channel/about');
  
  $hoje = date("Y-m-d");
  $sql = "Select * from chamado where descricao <> '' and status <> 1 and datauc = '$hoje' order by horauc desc";
  $result = mysql_query($sql);
  
	while ($linha = mysql_fetch_object($result)) 
	{
		$newItem = $TestFeed->createNewItem();
		
		$newItem->setTitle("Chamado $linha->id_chamado - $linha->cliente_id " . dataOk($linha->datauc) . " " . $linha->horauc);
		$newItem->setLink("../historicochamado.php?id_chamado=".$linha->id_chamado);
		$newItem->setDate( GetDateTime(add_date($linha->dataa, 1), $linha->horaa) );
		
		$sql = "select historico, dataa, horaa from contato where chamado_id = $linha->id_chamado order by id_contato desc limit 1";
		$r = mysql_query($sql) or $e = mysql_error();
		$l = mysql_fetch_object($r) or $e = mysql_error();
		$d = nl2br($linha->descricao) . "<br><br><b>Último contato " . 
			dataOk($l->dataa) . 
			" " . 
			$l->horaa . 
			"</b><br>" . 
			nl2br($l->historico);
		
				
		$newItem->setDescription($d);
		$newItem->addElement('dc:subject', $linha->cliente_id);  
		
		$TestFeed->addItem($newItem);  
	}
  
  
  
  //OK. Everything is done. Now genarate the feed.
  $TestFeed->genarateFeed();
  
?>
