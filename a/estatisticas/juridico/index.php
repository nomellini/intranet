<?
    $ano = date("Y", time()-( 86400*30*1 ) );  
    $mes = date("m", time()-( 86400*30*1 ) );
	
	$DataInicio = mktime(0,0,0, $mes, 1, $ano);
	$last_day = date("t", $DataInicio);  
	
	$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);
	
	$de = date("d/m/Y", $DataInicio);
	$ate = date("d/m/Y", $DataFim);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estat&iacute;sticas Jur&iacute;dico Datamace</title>
</head>

<body>
Estatísticas para o departamento jurídico
<form id="form1" name="form1" method="post" action="estatisticas.php">  
  <fieldset id="TipoReferencia">  
  <legend>Referência</legend>
  <input name="TipoReferencia" type="radio" value="MES" checked="checked"/> 
  Por Mês (Padr&atilde;o) : 
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
  	$inicio = 2001;
  	for($i=$inicio; $i<=$ano; $i++)
	{
		print "<option value=$i>$i</option>";
	}
  ?>
  </select> <br />
  <input name="TipoReferencia" type="radio" value="FAIXA"/> 
  Por Faixa de Datas : 
  De 
  <label>
  <input name="de" type="text" id="de" value="<?=$de?>" size="11" maxlength="10" />
  </label>
  At&eacute; 
  <label>
  <input name="ate" type="text" id="Ate" value="<?=$ate?>" size="11" maxlength="10" />
  </label>
  </fieldset>  
  
    <br />
	<fieldset id="tipoContato">
	<legend>Tipo de Contato</legend>
  	<input name="tipo" type="radio" value="E" />Enviados<br />
	<input name="tipo" type="radio" value="R" />
	Recebidos <br />
	<input name="tipo" type="radio" value="A" checked="checked" />
	Ambos (Padr&atilde;o) <br />
  	</fieldset>  
	<fieldset id="_diagnostico">
	<legend>Filtro de Diagnóstico</legend>
	Diagn&oacute;stico
  	<select name="diagnostico" id="diagnostico">
  	  <option value="0" selected="selected">Todos</option>
  	  <option value="33">An&aacute;lise</option>
  	  <option value="32">Consultoria</option>
    </select>
  	</fieldset>  	
  <p>
    <input type="submit" name="Submit" value="Submit" />
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
<script>
	document.form1.mes.value = <?=$mes?>;
	document.form1.ano.value = <?=$ano?>;
</script>