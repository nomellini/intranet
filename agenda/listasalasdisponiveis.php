<?
 require("../a/scripts/conn.php");		
 require("scripts/Funcoes.php"); 
 require("scripts/Calendar.php");					  
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
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
			return "$s?dia=$dia&mes=$mes&ano=$ano";			
		}
		
	}	

		
    $nomeusuario=peganomeusuario($ok);	
    $cal = new MyCalendar;
    $BRMonths = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    $BRDays = array ("D", "S", "T", "Q", "Q", "S", "S");
    $BRDays2 = array ("Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab");	
    $cal->setMonthNames($BRMonths);
    $cal->setDayNames($BRDays);

    $hDia = date("d"); $hMes = date("m"); $hAno = date("Y");
		
	$hoje = "dia=$hDia&mes=$hMes&ano=$hAno";
	$dataAtual = "$hDia de " . $BRMonths[ $hMes-1 ] . " de $hAno";
	
    $info = Funcoes_Info( $mes, $dia, $ano );		

?>
<html>
<head>
<title>Novo Compromisso</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../a/stilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {font-size: 12px}
.style3 {
	color: #003366;
	font-weight: bold;
}
.style5 {
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
</head>

<body  leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<div align="center">  
  Agendando uma <strong>sala</strong></font>
  <p class="style2"><strong><font color="#003366">  Data : 
    <?=$data?><br>
  </strong>
Verifique o horário de seu compromisso (<?=$hi?> - <?=$hf?>) <br>
e se a a sala desejada esta disponível</p>
</div>
    <form action="donovocompromisso.php" method="post" name="form1" id="form1">
      <table width="95%" border="0" cellpadding="1" cellspacing="1">
    <tr> 
      <td colspan="3" valign="top"><input name="id_sala" type="radio" value="0" checked onFocus="muda('','0')">
        <span class="style5">
        Este compromisso não utiliza sala
      </span> </td>
      </tr>	
	  
	<?
	  $sql = "select * from salas where ativo order by pos, nome";
  	  $rsalas = mysql_query($sql);
      while ($salas=mysql_fetch_object($rsalas)) {
	?>  
    <tr bgcolor="#EEFFDD">  	 	
      <td colspan="3" valign="top"><input name="id_sala" type="radio" value="<?=$salas->id?>"  onClick="muda('<?=$salas->nome?>', '<?=$salas->id?>')">
        <span class="style2">
        <span class="style3">
        <?=$salas->nome?> 
        -</span>        <?=$salas->localizacao?>
      </span> <?=$salas->obs?></td>
      </tr>	
	<?
		  
	    $sql = "select hora, horafim, resumo from compromisso where excluido = 0 and  ";
		$sql .= " data = '$datacompromisso' and id_sala = " . $salas->id;
		$sql .= " order by hora ";
//		$sql = "select * from salas";
		$rcompr = mysql_query($sql);
		while ($comp = mysql_fetch_object($rcompr)) {

	?>
	
    <tr> 	
      <td width="9%" valign="top">&nbsp;</td>
      <td colspan="2"><strong>[<?=$comp->hora?> - <?=$comp->horafim?>]</strong> - <span class="style2">
        <?=$comp->resumo?> 
      </span></td>
    </tr>


	<? }
	  }
	?>
    <tr> 
      <td colspan="3" valign="top"><input type="button" name="Button" value="Enviar" onClick="vai();">
      <input name="nomesala" type="hidden" id="nomesala">
      <input name="idsala" type="hidden" id="idsala"></td>
    </tr>
 
  </table>
  <br>
  <table width="95%" border="0" cellspacing="0" cellpadding="0" id="abas" align="Default">
    <tr> 
      
</form>
</body>
</html>
<script>
function vai() {
  opener.document.form1.local.value = document.form1.nomesala.value;
  opener.document.form1.id_sala.value = document.form1.idsala.value;
  window.close();  
}

function muda(ATexto, AId) {
  document.form1.nomesala.value = ATexto;
  document.form1.idsala.value = AId;
}
</script>