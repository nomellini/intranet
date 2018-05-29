<?
 require("../a/scripts/conn.php");		
 require("scripts/Funcoes.php");
 
 $now = date("G:i:s") ;  
 $agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
 $DataAtual = date("Y-m-d",$agora);  
 
 $soma15min = mktime(-3, 15, 0,  1, 1, 1970); // Soma 15 minutos
 $soma30min = mktime(-3, 30, 0,  1, 1, 1970); // Soma 15 minutos 

 $amanha = date("Y-m-d",$agora+$soma15min);  
 $data = date("d/m/Y", $agora+$soma15min) ; 


 $s15 = date("G:i:s",$agora+$soma15min);  
 $s30 = date("G:i:s",$agora+$soma30min);   
 
 $agora = date("G:i:s", $agora) ; 
 
	echo "15: $s15<br>";
 
	$sql = "select u.nome, u.email, r.hora from usuario u inner join relax r on r.id_usuario = u.id_usuario where data = '$DataAtual' and hora > '$s15' and hora < '$s30'  order by hora ";

	$result = mysql_query($sql) or die (mysql_error());
	while ($linha=mysql_fetch_object($result)) {	
		echo "Nome: $linha->nome  -- Email: $linha->email  -- Hora : $linha->hora<br>";		
	}
	
	
	echo "30: $s30<br>";	
 
?>
