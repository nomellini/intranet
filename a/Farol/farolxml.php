<?
    require("scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	$hoje = date("Y-m-d");		
	
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
	
	if (!$linha->id_cliente) {
       $linha->id_cliente = "Sem espera";
	}
	
	$lampada = "<img src=../imagens/farolverde.jpg width=100 height=40><br>Normal";
      $status="Normal";
      $statusid = 0;
	if (  ($tempomaximo>=10) and ($tempomaximo<20)  ) {
	  $lampada = '<img src=../imagens/farolamarelo.jpg width=100 height=40><br>Atenção';
        $status="Atenção";
        $statusid = 1;
	} else if ($tempomaximo>=20) {
	  $lampada = "<img src=../imagens/farolvermelho.jpg width=100 height=40><br>Crítica";	
        $status="Crítica";
        $statusid = 2;
	}
	$lampada .= "<br><font size=\"2pt\" color=#003399>$tempominutos</font> - $linha->id_cliente";

header("Content-type: text/xml");
print '<?xml version="1.0" encoding="iso-8859-1"?>';
echo "\n";
print '<farol>';
echo "\n";
print "<statusid>$statusid</statusid>";
echo "\n";
print "<status>$status</status>";
echo "\n";
print "<temposegundos>$tempomaximo</temposegundos>";
echo "\n";
print "<tempotexto>$tempominutos</tempotexto>";
echo "\n";
print "<clienteid>$linha->id_cliente</clienteid>";
echo "\n";
print '</farol>';
echo "\n";
exit();
?>