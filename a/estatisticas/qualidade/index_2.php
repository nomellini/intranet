<?
	$anoAtual = date("Y");
    $anofim = date("Y", time()-( 86400*30*1 ) );  
    $mesfim = date("m", time()-( 86400*30*1 ) );  
	
    $anoinicio = date("Y", time()-( 86400*30*13 ) );  
    $mesinicio = date("m", time()-( 86400*30*13 ) );  
	
	if (!isset($datai)) {
		$ano = date("Y", time()-( 86400*30*1 ) );  
		$mes = date("m", time()-( 86400*30*1 ) );
		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);  
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);		
		$di = date("d/m/Y", $DataInicio);		
		$df = date("d/m/Y", $DataFim);
	}else{
		$di = $datai;	
		$df = $dataf;
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>Selecione a refer&ecirc;ncia</p>
<form id="form1" name="form1" method="post" action="estatisticas.php">

    <p>
      <input name="mesinicio" type="hidden" id="mesinicio" value="<?=$mesinicio?>" />
      <input name="anoinicio" type="hidden" id="mesinicio" value="<?=$inicioinicio?>" />
    </p>
    <p>De
      <label>
        <input name="datai" type="text" class="bordaTexto" id="datai" onkeypress="fdata(this)" value="<?=$di?>" size="12" maxlength="10" />
        at&eacute;
  <input name="dataf" type="text" class="bordaTexto" id="dataf" onkeypress="fdata(this)" value="<?=$df?>" size="12" maxlength="10" />
      </label>
      <input type="submit" name="Submit" value="Submit" />
  </p>
</form>
</body>
</html>
<script>
	document.form1.mesinicio.value = <?=$mesinicio?>;
	document.form1.anoinicio.value = <?=$anoinicio?>;
	document.form1.mesfim.value = <?=$mesfim?>;
	document.form1.anofim.value = <?=$anofim?>;


</script>