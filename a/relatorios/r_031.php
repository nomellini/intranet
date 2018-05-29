<?php require_once('../../Connections/sad.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_sad, $sad);
$query_rsConsultores = "SELECT id_usuario, nome FROM usuario WHERE ativo and area = 1";
$rsConsultores = mysql_query($query_rsConsultores, $sad) or die(mysql_error());
$row_rsConsultores = mysql_fetch_assoc($rsConsultores);
$totalRows_rsConsultores = mysql_num_rows($rsConsultores);
?><?
    $ano = date("Y", time()-( 86400*30*1 ) );  
    $mes = date("m", time()-( 86400*30*1 ) );  
	
	
	
	if ($acao == 'listar') 
	{
		$ano = $_POST["ano"];
		$mes = $_POST["mes"]; 
		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);  
		
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);
		
		$de = date("Y-m-d", $DataInicio);
		$DeTela = date("d/m/Y", $DataInicio);
		$ate = date("Y-m-d", $DataFim);
		$AteTela = date("d/m/Y", $DataFim);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Chamador reabertos</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="r_031.php">
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
  	$inicio = $ano - 5;
  	for($i=$inicio; $i<=($ano+2); $i++)
	{
		print "<option value=$i>$i</option>";
	}
  ?>
  </select>
  <input type="submit" name="Submit" value="Enviar" />
  <input name="acao" type="hidden" id="acao" value="listar" />
</form>

  <?
	if ($acao=="listar") {
		echo "<hr>De: $DeTela Até $AteTela";
		echo " - Chamados com contato de reabertura";
		$sql = "
		SELECT  	
			DISTINCT s.status, u.nome, co.chamado_id, co.dataa
		FROM 
			contato co 
				inner join chamado ch on co.chamado_id = ch.id_chamado
				inner join usuario u on u.id_usuario = ch.consultor_id
				inner join status s on s.id_status = ch.status
		WHERE 
			u.area = 1 and 
			co.dataa >= '$de' and
			co.dataa <= '$ate' and
			co.status_id = 3
		ORDER BY
			ch.id_chamado";
		$result = mysql_query($sql) or die ($sql);
?>
</p>
<table cellpadding="1" cellspacing="1" bgcolor="#003366" >
  <tr>
    <td bgcolor="#FFFFFF">Aberto por</td>
    <td bgcolor="#FFFFFF">REaberto por</td>	
    <td bgcolor="#FFFFFF">Chamado</td>
    <td bgcolor="#FFFFFF">Data contato </td>
    <td bgcolor="#FFFFFF">Status</td>
    <td align="center" valign="middle" bgcolor="#FFFFFF">Quantidade</td>	
  </tr>
  <?
		while ($linha = mysql_fetch_object($result)) {
			$id = $linha->chamado_id;
		
			$sql2 = "select count(1) q from contato where chamado_id = $id and status_id = 3";
			$result2 = mysql_query($sql2);
			$linha2 = mysql_fetch_object($result2);
			$qtde = $linha2->q;
			
			$sql3 = "select u.nome nome from contato c inner join usuario u on u.id_usuario = c.consultor_id where chamado_id = $id order by id_contato limit  1";
			$result3 = mysql_query($sql3) or die ($sql3);
			$linha3 = mysql_fetch_object($result3);
			$nome = $linha3->nome;
			
		
			$link="../historicochamado.php?id_chamado=$linha->chamado_id";
  ?>
  <tr>
    <td bgcolor="#FFFFFF"><?=$nome?></td>
    <td bgcolor="#FFFFFF"><?=$linha->nome?></td>	
    <td bgcolor="#FFFFFF"><a href="<?=$link?>"><?=$linha->chamado_id?></a></td>
    <td bgcolor="#FFFFFF"><?=$linha->dataa?></td>
    <td bgcolor="#FFFFFF"><?=$linha->status?></td>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$qtde?></td>	
  </tr>
  <?
  	}	
  ?>
</table>

  <?
  	}	
  ?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsConsultores);
?>
<script>
	document.form1.mes.value = <?=$mes?>;
	document.form1.ano.value = <?=$ano?>;
</script>