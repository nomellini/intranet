<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
  <tr>
    <td>Compromissos no per&iacute;odo <img src="../imagens/novo.gif" width="45" height="15" align="absmiddle" /><br />
      <?
require("../a/scripts/conn.php");

function add_time($timestamp, $seconds,$minutes,$hours,$days,$months,$years) { 
  $mytime = mktime(1+$hours,0+$minutes,0+$seconds,1+$months,1+$days,1970+$years); 
  return $timestamp + $mytime; 
} 

$diainicial = strtotime($data);
$BRDays2 = array ("dom", "seg", "ter", "qua", "qui", "sex", "sab");	

for($i=0; $i<15; $i++) {
    $dia = add_time( $diainicial, 0,0,0, $i, 0,0 );	
	$data = date("Y-m-d", $dia);
	echo("dia <b>" . dataOk($data) . " - " . $BRDays2[ date("w", $dia) ] . "</b>") ;
	$sql = "";			  
	$sql .= "Select compromisso.id, usuario.nome as nome, ";
	$sql .= "compromisso.horafim, compromisso.hora, compromissousuario.id_usuario, compromisso.resumo ";
	$sql .= "FROM ";
	$sql .= "  compromisso, compromissousuario, usuario ";
	$sql .= "WHERE ";
	$sql .= "  compromisso.excluido <> 1 and ";
	$sql .= "  compromisso.data = '$data' AND ";
	$sql .= "  compromissousuario.id_compromisso = compromisso.id AND ";
	$sql .= "  compromissousuario.id_usuario = usuario.id_usuario AND";
	$sql .= "  compromissousuario.id_usuario in ($ids) ";
	$sql .= "ORDER BY ";
	$sql .= "  hora , usuario.nome;";
	//echo("<br> $sql <br>");
	$result = mysql_query($sql) or die (mysql_error());
	$hora = "";
	while ($linha=mysql_fetch_object($result)) {    				
		$link = "&nbsp;";	
		$hora=$linha->hora;
		$fim =$linha->horafim;
		$link .= "<br><font size=1>".substr($hora,0,5) . " - ".substr($fim,0,5) . " " ;
		$linkaux = substr( $linha->nome, 0, 20) ;
		$link .= $linkaux ."</font>";
		echo ($link);				
	}
    echo ("<br>");		
}
?></td>
  </tr>
</table>
<br /><br />
