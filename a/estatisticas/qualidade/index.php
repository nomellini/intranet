<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qualidade - Refer&ecirc;ncia</title>
</head><?
	$anoAtual = date("Y");
    $ano = date("Y", time()-( 86400*30*1 ) );  
    $mes = date("m", time()-( 86400*30*1 ) );  
?>
<body>
<p>Selecione a refer&ecirc;ncia</p>
<form id="form1" name="form1" method="post" action="estatisticas.php">
  M&ecirc;s 
  <select name="mes">
    <option value="1">Janeiro</option>
    <option value="2">Fevereiro</option>
    <option value="3">Mar&ccedil;o</option>
    <option value="4">Abril</option>
    <option value="5">Maio</option>
    <option value="6">Junho</option>
    <option value="7">Julho</option>
    <option value="8">Agosto</option>
    <option value="9">Setembro</option>
    <option value="10">Outubro</option>
    <option value="11">Novembro</option>
    <option value="12">Dezembro</option>
  </select>
  <select name="ano">
  <?
  	$inicio = $anoAtual - 5;
  	for($i=$inicio; $i<=$anoAtual; $i++)
	{
		print "<option value=$i>$i</option>";
	}
  ?>
  </select>
  <label></label>
  <input type="submit" name="Enviar" value="Enviar" id="Enviar" />
</form>
<p>&nbsp;</p>
</body>
</html>
<script>
	document.form1.mes.value = <?=$mes?>;
	document.form1.ano.value = <?=$ano?>;
</script>