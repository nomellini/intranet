<?
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-type: text/json; charset=utf-8");
require("scripts/conn.php");

	/*
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);
		setcookie("loginok");
	} else {
		header("Location: index.php");
	}
	*/

	$hoje = date("Y-m-d");

	// Maior tempo na espera
	$sql = "select  ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(hora_inicio))  as espera ";
	$sql .= "from ";
	$sql .= " satligacao ";
	$sql .= " inner join sistema on satligacao.id_produto = sistema.id_sistema ";
	$sql .= "     inner join cliente on cliente.id_cliente = satligacao.id_cliente ";
	$sql .= "where  ";
	$sql .= " FL_ATIVO and ";
	$sql .= " data = '$hoje' and  ";
	$sql .= " ((id_satstatus = 1) or (id_satstatus = 2)) ";
	$sql .= "order by ";
	$sql .= " espera desc ";
	$sql .= "limit 1";
	$result = mysql_query($sql) or die($sql);
	$linha = mysql_fetch_object($result) ;
	if (!$linha) {
	  $maiorEspera = 0;
	} else {
      $maiorEspera = $linha->espera;
	}


	$sql = "select cliente.id_cliente, sistema.sistema, cliente.grau, satligacao.grau slgrau, ";
	//$sql = "select sistema.sistema, ";
	$sql .= " id, sec_to_time(  time_to_sec(curtime()) - time_to_sec(horaEntrada)  ) as minutos, ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(horaEntrada))  as espera ";
	$sql .= "from ";
	$sql .= " satligacao ";
	$sql .= " inner join sistema on satligacao.id_produto = sistema.id_sistema ";
	$sql .= "     inner join cliente on cliente.id_cliente = satligacao.id_cliente ";
//	$sql .= "where  ( (cliente.grau <> 'ZZ') and (cliente.grau <> 'G3') and (cliente.grau <> '  ')) and ";
	$sql .= "where  ";
	$sql .= " FL_ATIVO and ";
	$sql .= " data = '$hoje' and  ";
	$sql .= " ((id_satstatus = 1) or (id_satstatus = 2)) ";
	$sql .= "order by ";
//	$sql .= " grau , espera desc ";
	$sql .= " satligacao.grau, espera desc ";
	$sql .= "limit 1";
	$result = mysql_query($sql) or die($sql);
	$linha = mysql_fetch_object($result) ;
	if (!$linha) {
	  $tempomaximo = 0;
	  $tempominutos = "00:00:00";
	} else {
      $tempomaximo = $linha->espera;
	  $tempominutos = $linha->minutos;
	}


	$id_cliente = $linha->id_cliente;


	// Fernando - 21.09.2011
	// Descobriu-se que o caractere '&' gera erro no xml e consequentemente, acess violation no programa farol.exe
	$id_cliente = str_replace('&', "e", $id_cliente);

	if (!$id_cliente) {
		$NomeCliente = "Sem espera";

	} else {
		$NomeCliente = $id_cliente . " [" . $linha->grau . "]";
	}

	$lampada = "<img src=../imagens/farolverde.jpg width=100 height=40><br>Normal";
      $status="Normal";
      $statusid = 0;
	if (  ($tempomaximo>=(8*60)) and ($tempomaximo<(15*60))  ) {
	  $lampada = '<img src=../imagens/farolamarelo.jpg width=100 height=40><br>Atenção';
        $status="Atenção";
        $statusid = 1;
	} else if ($tempomaximo>=(15*60)) {
	  $lampada = "<img src=../imagens/farolvermelho.jpg width=100 height=40><br>Crítico";
        $status="Crítico";
        $statusid = 2;
	}
	$lampada .= "<br><font size=\"2pt\" color=#003399>$tempominutos</font> - $id_cliente";


print "{ \n";
print ' "farol": {';
print '  "statusid": "'.$statusid.'",';
print '  "status": "'.$status.'",';
print '  "temposegundos": "'.$tempomaximo.'",';
print '  "tempotexto": "'.$tempominutos.'",';
print '  "clienteid": "'.$NomeCliente.'",';
print '  "produtoid": "'.$linha->sistema.'",';
print '  "maiorespera": "'.$maiorEspera.'"';
print ' },';
echo "\n";


$sql = "select ";
$sql .= "sat_idcliente, ";
$sql .= "id_usuario, ";
$sql .= "nome, ";
$sql .= "estado, ";
$sql .= "sec_to_time(  time_to_sec(curtime()) - time_to_sec(estado_hora)  ) as minutos, ";
$sql .= "(  time_to_sec(curtime()) - time_to_sec(estado_hora)  ) as segundos ";
$sql .= "from usuario where area = 1 and ativo order by nome";

$result = mysql_query($sql) or die ($sql);

print ' "consultores": [';

  while($linha = mysql_fetch_object($result)) {
	$sat_idcliente = "-";
	if (  (($linha->estado==3) | ($linha->estado==4)) and ($linha->sat_idcliente)) {
		$sat_idcliente = $linha->sat_idcliente;
	} else {
		$sat_idcliente = "-";
   }

 $sat_idcliente = eregi_replace("&", "_e_", $sat_idcliente);

    print ' {';
    print '  "nome": "'. $linha->nome.'",';
    print '  "estado": "'.$linha->estado.'",';
    print '  "cliente": "'.$sat_idcliente.'",';
    print '  "tempo": "'. $linha->minutos.'",';
    print '  "TempoEmSegundos": "'. $linha->segundos.'"';
	print " }";
	if (true)
	{
		print ", \n";
	}

 }

print '{}]}';

return;


$sql = "select  ";
$sql .= "sec_to_time(  avg(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)      ) ) as media, ";
$sql .= "count(*) as qtde,  sec_to_time(   max(   time_to_sec(hora_fim) - time_to_sec(hora_inicio)      ) ) as maximo, ";
$sql .= "sec_to_time(   min(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)  ) ) as minimo ";
$sql .= "from satligacao where FL_ATIVO and  (id_satstatus = 3 or id_satstatus = 4 ) and ";
$sql .= "data = '$hoje'";

$result = mysql_query($sql) or die($sql);
$linha = mysql_fetch_object($result);
$tmedio = $linha->media;
$tmaximo = $linha->maximo;
$tminimo = $linha->minimo;
$qtde = $linha->qtde;

print " estatisticas: { \n";
print "	  tempomedio: '$tmedio',\n";
print "	  tempomaximo: '$tmaximo',\n";
print "   tempominimo: '$tminimo',\n";
print "   qtde: '$qtde'\n";
print "}\n";

print "}";


mysql_close($link);
exit();
?>