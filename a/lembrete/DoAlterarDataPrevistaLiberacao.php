<?
	require("../scripts/conn.php");		
	require("../scripts/classes.php");
?><html>
<head>
<title>Ok</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?
	
	mysql_connect(localhost, sad, data1371);
	mysql_select_db(sad); 
	
	$lembrete = eregi_replace("\r\n", "<br>", $observacao);   
	$lembrete = eregi_replace("'" ,   "`", $lembrete);
	$lembrete = eregi_replace("\"",   "`", $lembrete); 
	
	
	$prazoAnterior = conn_PegaPrazo($id_chamado);
	$prazoAtual = "$ano-$mes-$dia";
	
	$data = $prazoAtual;
	
	
	
	$sql = "update chamado set dataprevistaliberacao = '$data', liberado=$liberado, obsliberacao='$lembrete' where id_chamado = $id_chamado";
	mysql_query($sql) or die (mysql_error() . " : " . $sql);


	if ($liberado) {
		$data = Conn_Hoje();	 
	} else {
		$data = '0000-00-00';
	}
	
	$sql = "update chamado set dataliberacao = '$data' where id_chamado = $id_chamado";
	mysql_query($sql) or die (mysql_error() . " : " . $sql);
	
	// Inserir um contato com 
	
	
	if ($prazoAnterior != $prazoAtual) 
	{
		
		$datae = date("Y-m-d");
		$horae = date("H:i:s");	
		
		
		$objChamado = new chamado();
		$objContato = new contato();	
		
		$objChamado->lerChamado($id_chamado);
	
		$id_destinatario = $objChamado->destinatario_id;	
		
		$id_contato_cliente = $objContato->novocontato($id_chamado, $id_usuario, $id_destinatario, $datae, $horae);	
		$objContato->lerContato($id_contato_cliente);
		
		$objContato->origem_id = 37;
		$objContato->motivo_id = 95;
			
		
		$objContato->datae = $datae;
		$objContato->horae = $horae;				
		$frasepadrao = "Alteração de prazo de " . DataOk($prazoAnterior) . " para " . DataOk($prazoAtual);
		$objContato->historico = "$frasepadrao";			
		$objContato->gravaContato();				

	}
  
?>

<table width="80%" border="0" cellspacing="1" cellpadding="1" height="98%" align="center">
  <tr>
    <td valign="middle" align="center">
      <p>Data prevista de liberação alterada</p>
      <p><a href="javascript:vai();">Clique Aqui para fechar a janela</a></p>
    </td>
  </tr>
</table>
  <script>  
  
  function vai() {
   if ( '-1' == '-<?=$inicio?>' ) {
	opener.document.form2.submit();
   }
	window.close();
  }
</script>

</body>
</html>
