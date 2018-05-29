<?
    require("../../../agenda/scripts/Calendar.php");
    require("../../../agenda/scripts/Funcoes.php");	
    require("funcoes.php");	

	if (!isset($origem))
	{
		$origem = 1;
	}

	$today = date("d/m/Y");	

	
	if(!isset($id_sistema)) {
	  $id_sistema = 0;
	}

	if(!isset($rbdata)) {
	  $rbdata = "datai";
	}
	
	
	if(!$datai) {
      $datai = $today;
	}
	if(!$dataf) {
      $dataf = $today;
	}
	if(!$acao) {
      $acao = "unico";
	}
	

	$dataarray = explode("/", $dataf);			
    $datasql2 = "$dataarray[2]-$dataarray[1]-$dataarray[0]";	
	
	$dataarray = explode("/", $datai);	
    $datasql = "$dataarray[2]-$dataarray[1]-$dataarray[0]";
    $dia = $dataarray[0];
    if (!isset($mes)) {
      $mes = $dataarray[1];
	}
    if (!isset($ano)) {	
      $ano = $dataarray[2];
	}
	
	$data = "$dia/$mes/$ano";
	
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
		    return "javascript:setDia($dia,$mes,$ano)";			
		}
		
	}	
	
    $cal = new MyCalendar;
    $BRMonths = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    $BRDays = array ("D", "S", "T", "Q", "Q", "S", "S");
    $BRDays2 = array ("DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB");	
    $BRDays3 = array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");		
    $cal->setMonthNames($BRMonths);
    $cal->setDayNames($BRDays);
	
	//getBarraContatos($datai, $dataf, 1);
 		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Gr&aacute;ficos de tempo de espera</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../stilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0" cellspacing="1" cellpadding="1">
  <tr valign="top">
    <td width="50%"><img src="gr.php?id_sistema=<?=$id_sistema?>&datai=<?=$datai?>&dataf=<?=$dataf?>&acao=<?=$acao?>"></td>
    <td width="50%" rowspan="2"><form name="form1"  method="post" action="">
      <table width="100%" border="0">
        <tr valign="top">
          <td width="144"><?echo $cal->getMonthView($mes, $ano);?></td>
          </tr>
        <tr valign="top">
          <td>
            <table width="100%"  border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td width="11%">Data 1 </td>
                <td width="89%"><input name="datai" type="text" class="borda_fina" id="dataf3" value="<?=$datai?>">
                  <input name="rbdata" type="radio" value="datai" <?=$rbdata=="datai"?"checked":""?>></td>
              </tr>
              <tr>
                <td>Data 2 </td>
                <td><input name="dataf" type="text" class="borda_fina" id="dataf" value="<?=$dataf?>">
                  <input name="rbdata" type="radio" value="dataf" <?=$rbdata=="dataf"?"checked":""?> ></td>
              </tr>
              <tr>
                <td>Sistema</td>
                <td>
<select name="id_sistema" class="borda_fina">
<option value="0">Todos</option>
<?	
//	$sql = "select * from sistema";
	$sql = "select distinct ";
	$sql .= "  sistema.id_sistema, sistema.sistema ";
	$sql .= "from  ";
	$sql .= "  satligacao, sistema ";
	$sql .= "where ";
	$sql .= "  satligacao.id_produto = sistema.id_sistema and ";
	$sql .= "  satligacao.data >= '$datasql' and ";
	$sql .= "  satligacao.data <= '$datasql2' and ";	
	$sql .= "  satligacao.id_satstatus = 3 ";	
	$sql .= "order by ";
	$sql .= "  sistema.sistema";
	$result = mysql_query($sql);
	while( $linha =mysql_fetch_object($result)) {    
		$id = $linha->id_sistema;		
		$nome = $linha->sistema; 
		$s = "";
		if ($id==$id_sistema) {
		  $s="selected";
		}
?>
          <option value="<?=$id?>" <?=$s?> >  <?=$nome?>
          </option>
<?
}
?>
        </select>

				</td>
              </tr>
            </table>            

          <input name="acao" type="radio" value="comparativo" <?=$acao=="comparativo"?"checked":""?> >
          Comparativo<br>
          <input name="acao" type="radio" value="deate" <?=$acao=="deate"?"checked":""?>>
Faixa De-At&eacute;<br>
<input name="acao" value="unico" type="radio" <?=$acao=="unico"?"checked":""?>  > 
Somente data 1
</td>
        </tr>
        <tr valign="top">
          <td><input name="Submit" type="submit" class="borda_fina" value="Ver gr&aacute;fico"></td>
        </tr>
        <tr valign="top">
          <td><a href="rel001.php?datai=<?=$datai?>&dataf=<?=$dataf?>">Ir para relat&oacute;rio detalhado do dia escolhido</a> </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr valign="top">
    <td width="50%">Clientes GRAU 1 <br>
    <img src="grbarras.php?id_sistema=<?=$id_sistema?>&datai=<?=$datai?>&dataf=<?=$dataf?>&acao=<?=$acao?>&grupo=G1"></td>
  </tr>
  <tr valign="top">
    <td width="50%">Clientes GRAU 2 <br>
    <img src="grbarras.php?id_sistema=<?=$id_sistema?>&datai=<?=$datai?>&dataf=<?=$dataf?>&acao=<?=$acao?>&grupo=G2"></td>
  </tr>
  <tr valign="top">
    <td width="50%">Clientes GRAU 3 <br>
    <img src="grbarras.php?id_sistema=<?=$id_sistema?>&datai=<?=$datai?>&dataf=<?=$dataf?>&acao=<?=$acao?>&grupo=G3"></td>
  </tr>
  <tr valign="top">
    <td width="50%">Clientes GRAU 4  (Sem defini&ccedil;&atilde;o de grau) <br>
    <img src="grbarras.php?id_sistema=<?=$id_sistema?>&datai=<?=$datai?>&dataf=<?=$dataf?>&acao=<?=$acao?>&grupo=nada"></td>
  </tr>
  <tr valign="top">
    <td width="50%">Todos os clientes combinados <br>
    <img src="grbarras.php?id_sistema=<?=$id_sistema?>&datai=<?=$datai?>&dataf=<?=$dataf?>&acao=<?=$acao?>&grupo=todos"></td>
  </tr>
  <tr valign="top">
    <td width="50%">Contatos - Geral<br>
    <img src="grbarras.php?tipo=contatos&datai=<?=$datai?>&dataf=<?=$dataf?>&origem=0&acao=<?=$acao?>"></td>    
  </tr>
  <tr valign="top">
    <td width="50%">Contatos -           <select name="origem" class="unnamed1">
            <option value="0">Todos</option>
            <?  

  $arrcat = listaTipos();
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $origem==$tmp["id_origem"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_origem"] . " $s >" . $tmp["origem"] . "</option>";
  }
?>
          </select><br>
    <img src="grbarras.php?tipo=contatos&datai=<?=$datai?>&dataf=<?=$dataf?>&origem=1&acao=<?=$acao?>"></td>    
  </tr>
  
</table>

<br>
</body>
</html>
<script>
  function setDia(dia, mes, ano) {
    var data = dia+"/"+mes+"/"+ano;
	
	j=document.form1.rbdata.length; //alert(j)
	for (i=0; i<j; i++){
		if(document.form1.rbdata[i].checked) var rbdata = document.form1.rbdata[i].value
	}
	
	if ( rbdata != "dataf") {
		document.form1.datai.value = data;
	} else {
		document.form1.dataf.value = data;	
	}
	document.form1.submit();
  }
</script>
