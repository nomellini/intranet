<?
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
	
	$sql = "select id_cliente, sistema.sistema, ";
	$sql .= " id, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as minutos, ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(hora_inicio)) / 60 as espera ";
	$sql .= "from ";
	$sql .= " satligacao ";
	$sql .= " inner join sistema on satligacao.id_produto = sistema.id_sistema ";	
	$sql .= "where  ";
	$sql .= " FL_ATIVO and ";
	$sql .= " data = '$hoje' and  ";
	$sql .= " ((id_satstatus = 1) or (id_satstatus = 2)) ";
	$sql .= "order by ";
	$sql .= " espera desc ";
	$sql .= "limit 1";
	$result = mysql_query($sql) or die($sql);
	$linha = mysql_fetch_object($result);
	if (!$linha) {
	  $tempomaximo = 0;
	  $tempominutos = "00:00:00";
	} else {
      $tempomaximo = $linha->espera;
	  $tempominutos = $linha->minutos; 
	}
	
	if (!$linha->id_cliente) {
       $linha->id_cliente = "Sem espera";
	}
	
	$lampada = "<img src=../imagens/farolverde.jpg width=100 height=40><br>Normal";
      $status="Normal";
      $statusid = 0;
	if (  ($tempomaximo>=10) and ($tempomaximo<20)  ) {
	  $lampada = '<img src=../imagens/farolamarelo.jpg width=100 height=40><br>Aten��o';
        $status="Aten��o";
        $statusid = 1;
	} else if ($tempomaximo>=20) {
	  $lampada = "<img src=../imagens/farolvermelho.jpg width=100 height=40><br>Cr�tico";	
        $status="Cr�tico";
        $statusid = 2;
	}
	$lampada .= "<br><font size=\"2pt\" color=#003399>$tempominutos</font> - $linha->id_cliente";

header("Content-type: text/xml");
print '<?xml version="1.0" encoding="iso-8859-1"?>';
echo "\n";

print '<sad>';
echo "\n";

print '<farol>';
echo "\n";
print "<statusid>$statusid</statusid>\n";
print "<status>$status</status>\n";
print "<temposegundos>$tempomaximo</temposegundos>\n";
print "<tempotexto>$tempominutos</tempotexto>\n";
print "<clienteid>$linha->id_cliente</clienteid>\n";
print "<produtoid>$linha->sistema</produtoid>\n";

print '</farol>';
echo "\n";


$sql = "select ";
$sql .= "sat_idcliente, ";
$sql .= "id_usuario, ";
$sql .= "nome, ";
$sql .= "estado, ";
$sql .= "sec_to_time(  time_to_sec(curtime()) - time_to_sec(estado_hora) ) as minutos, ";
$sql .= "(  time_to_sec(curtime()) - time_to_sec(estado_hora)  ) as segundos ";
$sql .= "from usuario where area = 1 and ativo";

$result = mysql_query($sql) or die ($sql);

print "<consultores>\n";

  while($linha = mysql_fetch_object($result)) {
	$sat_idcliente = "-";  
	if (  ($linha->estado==4) and ($linha->sat_idcliente)) {
		$sat_idcliente = $linha->sat_idcliente;
	} else {
		$sat_idcliente = "-";
   }
   
 $sat_idcliente = eregi_replace("&", "_e_", $sat_idcliente);   
   
  

  print "<consultor>\n";
    print "<nome>$linha->nome</nome>\n";
    print "<estado>$linha->estado</estado>\n";
    print "<cliente>$sat_idcliente</cliente>\n";	
    print "<tempo>$linha->minutos</tempo>\n";	
    print "<TempoEmSegundos>$linha->segundos</TempoEmSegundos>\n";			
  print "</consultor>\n";
  
 }

print "</consultores>\n";


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

print "<estatisticas>\n";
print "<tempomedio>$tmedio</tempomedio>\n";
print "<tempomaximo>$tmaximo</tempomaximo>\n";
print "<tempominimo>$tminimo</tempominimo>\n";
print "<qtde>$qtde</qtde>\n";
print "<sql>$sql</sql>\n";
print "</estatisticas>\n";

print '</sad>';
echo "\n";

mysql_close($link);
exit();
?>
