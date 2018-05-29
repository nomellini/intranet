<?	/*
	+----+--------------------+
	| id | descricao          |
	+----+--------------------+
	|  1 | Em Espera          |
	|  2 | Transferido        |
	|  3 | Atendido Consultor | FIM ATENDIDO
	|  4 | Finalizado         | FIM SEM ATENDER
	+----+--------------------+
	*/
	
	// Esperado como parametro id_cliente
	
	require("../scripts/conn.php");
	

	$hoje = date("Y-m-d");	
	$hora = date("H:i:s");

    if (!$id_ligacao) {
	  $id_ligacao = 0;
	}

/*	
	if ($acao=="CriarETransferir") {
	  $sql = "Select id from satligacao where data = '$hoje' and hora_inicio = '$hora'";
	  $result = mysql_query($sql);
	  $linha = mysql_fetch_object($result);
	  $idligacao = $linha->id;
	  $idconsultor = $id_consultor;
	}
	
    if ( ($acao == 'transferir')  || ($acao=="CriarETransferir") ) {
	
	   $sql = "select nome, estado from usuario where id_usuario = $idconsultor";
	   $result = mysql_query($sql);
	   $linha = mysql_fetch_object($result);
	   if ($linha->estado != 1) {
	     $Mensagem = "Consultor $linha->nome NÃO DESPONÍVEL, aguarde ou transfira para outro !";
	     header("Location: index.php?msg=$Mensagem");
	   } else {
  	     $sql = "update satligacao set motivo = '', id_satstatus = 2, id_usuario = $idconsultor, hora_transferencia='$hora' where id = $idligacao;";
         mysql_query($sql) or die($sql);
	  }
	}
	
	
	$cliente = "Digite o nome de um cliente ou a senha no campo acima";
	if ($acao == "aguarde") {
	  $sql = "update satligacao set qtde_aguarde = qtde_aguarde + 1 where id = $idligacao";
	  mysql_query($sql) or die($sql);
	}
	
    if ($acao == "pesquisacliente")  {
	  if ($nomesenha) {
         $sql = "select bloqueio, id_cliente, senha, cliente from cliente where cliente like '%$nomesenha%' or senha = '$nomesenha' or id_cliente = '$nomesenha'";	  
	  } else if ($id_cliente) {
         $sql = "select bloqueio, id_cliente, senha, cliente from cliente where id_cliente = '$id_cliente'";	  
	  }
	  $result = mysql_query($sql) or die($sql);
	  $qtde = mysql_affected_rows();	  
      $linha = mysql_fetch_object($result);	  
	  if ($qtde == 1) {	  
	  
	    $id_cliente = $linha->id_cliente;
		$senha = $linha->senha;		
		$cliente = "$linha->cliente ($senha)";
		if ($linha->bloqueio) {
  		$cliente .= " <font color='#ff0000'><b>BLOQUEADO</b></font>";
		}
		
	  } else if (($qtde > 1)) {
	    header("Location: index.php?pesquisa=$nomesenha");
	  } else if ($qtde==0) {
	    $id_cliente = ''; $pesquisa =  ''; $nomesenha='';
	  }
	}
	*/
	
	/* Ligações de hoje	*/
    $sql = "select count(*) as ligTotal from satligacao where data = '$hoje'";	
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligHoje = $linha->ligTotal;
	
	/* Ligações de hoje	em espera*/
    $sql = "select count(*) as ligTotal from satligacao where data = '$hoje' and id_satstatus=1";	
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligEspera = $linha->ligTotal;


    mysql_query("DROP TABLE IF EXISTS ultimos10;");
    mysql_query("create temporary table ultimos10 select time_to_sec(hora_fim)-time_to_sec(hora_inicio) as t from satligacao where FL_ATIVO and id_satstatus = 3 order by id desc limit 5;");
    $sql = "select sec_to_time(avg((t))) as media,  sec_to_time(min((t))) as minimo, sec_to_time(max((t))) as maximo from ultimos10;";

	$result = mysql_query($sql) or die($sql); 
	$linha = mysql_fetch_object($result);
	$tmedio = $linha->media;
	$tmaximo = $linha->maximo; 
	$tminimo = $linha->minimo;
	

	$sql = "select id_cliente, ";
	$sql .= " id, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as minutos, ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(hora_inicio)) / 60 as espera ";
	$sql .= "from ";
	$sql .= " satligacao ";
	$sql .= "where  ";
	$sql .= " FL_ATIVO and ";
	$sql .= " data = '$hoje' and  ";
	$sql .= " ((id_satstatus = 1) or (id_satstatus = 2)) ";
	$sql .= "order by ";
	$sql .= " espera desc ";
	$sql .= "limit 1";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	if (!$linha) {
	  $tempomaximo = 0;
	  $tempominutos = "00:00:00";
	} else {
      $tempomaximo = $linha->espera;
	  $tempominutos = $linha->minutos; 
	}
		

?>
<html>
<head>
<title>Espera</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../todo/stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="50">
<style type="text/css">
<!--
.style5 {font-size: 9px; color: #FFFFFF; font-weight: bold; }
-->
</style>
</head> 
<body bgcolor="#FFFFFF" text="#000000">
<table width="99%"  border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td><img src="../figuras/topo_sad_c.jpg" width="800" height="70"></td>
  </tr>
  <tr>
    <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000"><a href="http://www.datamace.com.br/index.cfm?conteudo_Id=4">&nbsp;Voltar ao Site Datamace</a></font></td>
  </tr>
</table>
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td valign="top"><font color="#FF0000" size="2"><strong>Liga&ccedil;&otilde;es 
      em espera ( 
      <?=$ligEspera?>
      ) </strong></font>
      <table width="100%" border="0" cellpadding="1" cellspacing="1" class="Mtable">
        <tr bgcolor="#003366"> 
          <td width="66%" height="16"> <font color="#FFFFFF"><strong>Cliente</strong></font></td>
        </tr>
        <?
 $i=0;
  $sql = "select qtde_aguarde,  id, cliente.id_cliente, cliente.cliente, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as espera, ";
  $sql .= "sistema.sistema as produto, satligacao.motivo, linha from satligacao, cliente, sistema where ";
  $sql .= "data = '$hoje' and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema and ";
  $sql .= "id_satstatus = 1 order by espera desc";
  $result = mysql_query($sql);
  while ($linha = mysql_fetch_object($result)) {  
    $i++;
    $idligacao = $linha->id;
    $cliente = $linha->cliente;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$linhatel = $linha->linha;
	$motivo = $linha->motivo;
	$idcliente = $linha->id_cliente;
	
	if ($id_cliente == $idcliente) {
	  $cliente = "<b><- Esta é a sua posição na espera</b>";
	} else {
	  $cliente = "Cliente na espera";
	}
?>

        <tr> 
          <td width="66%"><font color="#003333" size="1"><? echo "$i. $cliente";?>
			</font></td>
        </tr>
        <?
 }
?>
      </table><br>
<br>      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#003300">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="1" cellspacing="1">
              <tr>
                <td width="32%"><strong><font color="#003300">Tempo m&eacute;dio de espera</font></strong></td>
                <td width="68%"><strong><font color="#003300" size="2">
                  <?=$tmedio?> (</font>&Uacute;ltimas 5 liga&ccedil;&otilde;es atendidas<font color="#003300" size="2">)                 </font></strong></td>
              </tr>
              <tr>
                <td width="32%">Tempo m&aacute;ximo de hoje </td>
                <td width="68%"><font size="1">
                  <?=$tmaximo?> </font></td>
              </tr>
              <tr>
                <td>Liga&ccedil;&otilde;es atendidas hoje <br>
                </td>
                <td><font size="1">
                  <?=$ligHoje?>
                Ligações. </font></td>
              </tr>
              <tr>
                <td>Data e hora atuais </td>
                <td><?=date('d/m/y H:i')?></td>
              </tr>
          </table></td>
        </tr>
      </table
    ></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Voc&ecirc; pode contactar nossos consultores atrav&eacute;s dos sequintes canais de comunica&ccedil;&atilde;o: </td>
  </tr>
  <tr>
    <td valign="top"><ul>
      <li>Telefone: (0 xx 11) 4122-6400</li>
      <li>Fax: (0 xx 11) 4330-5444</li>
      <li><a href="/sad/doindex.php?id_cliente=<?=$id_cliente?>">SAD OnLine</a></li>
    </ul></td>
  </tr>
</table>

<p>&nbsp;</p>
</body>
</html>