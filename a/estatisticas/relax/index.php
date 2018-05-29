<?
	require("../../scripts/conn.php");	
	if ( isset($id_usuario) ) { $ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: ../index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	if (($ok != 143) & ($ok != 1) & ($ok != 12) & ($ok != 43) & ($ok != 187)  ) {
		header("Location: AcessoProibido.php");
	}
	
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
<title>Estat&iacute;stica da agenda Relax</title>
</head>

<body>
Estatísticas para a agenda Relax
<form id="form1" name="form1" method="post" action="estats.php">  
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
    <p>
    <input type="submit" name="Submit" value="Submit" />
  </p>
</form>
</body>
</html>
<script>
	document.form1.mes.value = <?=$mes?>;
	document.form1.ano.value = <?=$ano?>;
</script>