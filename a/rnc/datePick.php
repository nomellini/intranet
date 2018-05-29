<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 9px}
-->
</style>
</head>
<body>
<?
/*
   Este é o calendário da datamace.
   Autor : Fernando Nomellini
   Data  : 04/2003
   #C7E1EB
*/
 require("../../a/scripts/conn.php");		
 require("../../agenda/scripts/Calendar.php");
 require("../../agenda/scripts/Funcoes.php");

 $now = date("G:i:s");

 if ($ordem == "") {
  $ordem = 'hora , resumo, usuario.nome';
 } else if ($ordem== "nome") {
   $ordem = "usuario.nome";
 }
    function pad($s, $n){    
	   $r = $s;
       while (strlen($r) < $n) {
	     $r = "0".$r;
	   }
	   return $r;
	}
	

    if (!isset($dia)) {
      $dia = date("d");
	}
    if (!isset($mes)) {
      $mes = date("m");
	}
    if (!isset($ano)) {
	  $ano = date("Y");
	}	
	$data = "$dia/$mes/$ano";
    $datacompromisso = "$ano-$mes-$dia";
		
	class MyCalendar extends Calendar
	{
		function getCalendarLink($mes, $ano)
		{
			// Redisplay the current page, but with some parameters
			// to set the new month and year
			$s = getenv('SCRIPT_NAME');
			$mes = pad($mes,2); $ano=pad($ano,4);
			return "$s?mes=$mes&ano=$ano";
		}
		
		function getDateLink($dia, $mes, $ano)
		{			
			$dia = pad($dia,2) ; $mes = pad($mes,2); $ano=pad($ano,4);
			return "$s?dia=$dia&mes=$mes&ano=$ano&acao=vai";
		}
		
	}	
    $cal = new MyCalendar;
    $BRMonths = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    $BRDays = array ("D", "S", "T", "Q", "Q", "S", "S");
    $BRDays2 = array ("DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB");	
    $BRDays3 = array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");		
    $cal->setMonthNames($BRMonths);
    $cal->setDayNames($BRDays);

    $hDia = date("d"); $hMes = date("m"); $hAno = date("Y");
		
	$hoje = "dia=$hDia&mes=$hMes&ano=$hAno&acao=vai";
	$dataAtual = $BRDays3[ date("w") ] . ", $hDia de " . $BRMonths[ $hMes-1 ] . " de $hAno";
	
    $info = Funcoes_Info( $mes, $dia, $ano );	
	
//	die($acao);
	
?>
<?echo $cal->getMonthView($mes, $ano);
?> <span class="style1">[<a href="datePick.php?<?=$hoje?>">hoje</a>]
</span>
</body>
</html>
<script>

<?  
  if ($acao=='vai') {
?>
	if (opener.document.forma.retorno.value == 'inicio') {
       opener.document.forma.txtDataAberturaInicio.value = '<?=$data?>';	
	} 	
	if (opener.document.forma.retorno.value == 'fim') {
       opener.document.forma.txtDataAberturaFim.value = '<?=$data?>';	
	} 	

	window.close();
<?
  }
?>
</script>