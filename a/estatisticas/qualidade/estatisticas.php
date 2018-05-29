<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Qualidade - Resultados</title>
</head><?php
  
  require("../../scripts/conn.php");	
 

  $ano = $_POST["ano"];
  $mes = $_POST["mes"]; 
  $DataInicio = mktime(0,0,0, $mes, 1, $ano);
  $last_day = date("t", $DataInicio);  
  
  $DataFim =  mktime(0,0,0, $mes, $last_day, $ano);
  
  $de = date("Y-m-d", $DataInicio);
  $ate = date("Y-m-d", $DataFim);

  
	$sql = "select 
  'Reclamações' nome, 
  count(1) as qtde
from 
  chamado c 
where 
  c.categoria_id = 379 and
  c.dataa >= '$de' and c.dataa <= '$ate'

union 
  
select 
  'Elogio' nome, 
  count(1) as qtde
from 
  chamado c 
where 
  c.categoria_id = 378 and
  c.dataa >= '$de' and c.dataa <= '$ate'";
	
	
// echo $sql . "<br>";	
	
?>

<style type="text/css">
.teste {
	color: #D6D6D6;
	font-weight: bold;
}
.teste td {
	color: #FFFFFF;
}
.ok {
	font-weight: bold;
}
.oki {
	font-style: italic;
}
</style>

<p>Estat&iacute;sticas de qualidade para a refer&ecirc;ncia  <?=$mes?>/<?=$ano?></p>

<hr size=1/>

<p>Elogios x Reclamações</p>


<table border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">

  <tr class="teste">
    <td bgcolor="#006699">Tipo</td>
    <td align="center" bgcolor="#006699">Qtde</td>
  </tr>
<?
	$result = mysql_query($sql) or die ( mysql_error() . " ----- " . $sql);  
  	while ($linha = mysql_fetch_object($result)) {
?>
  <tr>
    <td bgcolor="#FFFFFF"><?=$linha->nome?></td>
    <td align="right" bgcolor="#FFFFFF" class="ok"><?=$linha->qtde?></td>
  </tr>
<?
	}
?>

</table>


<?

	$sql = "select 'Andamento' tipo, count(1) as qtde
from
  contato c 
   left join usuario u on u.id_usuario = c.destinatario_id
where
  c.origem_id = 22
  and c.dataa >= '$de' and c.dataa <= '$ate'
union 

select 'Cobr 1' tipo, count(1) as qtde
from
  contato c 
   left join usuario u on u.id_usuario = c.destinatario_id
where
  c.origem_id = 23
  and c.dataa >= '$de' and c.dataa <= '$ate'
union 

select 'Cobr 2' tipo, count(1) as qtde
from
  contato c 
   left join usuario u on u.id_usuario = c.destinatario_id
where
  c.origem_id = 24
  and c.dataa >= '$de' and c.dataa <= '$ate'

union

select 'Cobr 3' tipo, count(1) as qtde
from
  contato c 
   left join usuario u on u.id_usuario = c.destinatario_id
where
  c.origem_id = 29
  and c.dataa >= '$de' and c.dataa <= '$ate'";
	
	$total = 0;
	//echo $sql;
?>

<br />
<hr size=1/>
<p>Cobranças por tipo de cobrança</p>

<table border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">

  <tr class="teste">
    <td bgcolor="#006699">Tipo</td>
    <td align="center" bgcolor="#006699">Qtde</td>
  </tr>
<?
	$result = mysql_query($sql) or die ( mysql_error() . " ----- " . $sql);  
  	while ($linha = mysql_fetch_object($result)) {
		$total += $linha->qtde;
?>
  <tr>
    <td bgcolor="#FFFFFF"><?=$linha->tipo?></td>
    <td align="right" bgcolor="#FFFFFF" class="ok"><?=$linha->qtde?></td>
  </tr>
<?
	}
?>
  <tr>
    <td bgcolor="#FFFFFF"><strong>Total</strong></td>
    <td align="right" bgcolor="#FFFFFF" class="ok"><strong>
      <?=$total?>
    </strong></td>
  </tr>

</table>













<?

	$sql = "select u.nome nome, count(1) qtde
from
  contato c 
    left join usuario u on u.id_usuario = c.destinatario_id
where
  c.origem_id in (22, 23, 24, 29)
  and c.dataa >= '$de' and c.dataa <= '$ate'
group by
  u.nome
order by count(1) desc";

	$total = 0;	

	
?>

<br />
<hr size=1/>
<p>Total de cobranças por colaborador</p>

<table border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">

  <tr class="teste">
    <td bgcolor="#006699">Nome</td>
    <td align="center" bgcolor="#006699">Qtde</td>
  </tr>
<?
	$result = mysql_query($sql) or die ( mysql_error() . " ----- " . $sql);  
  	while ($linha = mysql_fetch_object($result)) {
		$total += $linha->qtde;
?>
  <tr>
    <td bgcolor="#FFFFFF"><?=$linha->nome?></td>
    <td align="right" bgcolor="#FFFFFF" class="ok"><?=$linha->qtde?></td>
  </tr>
<?
	}
?>
  <tr>
    <td bgcolor="#FFFFFF"><strong>Total</strong></td>
    <td align="right" bgcolor="#FFFFFF" class="ok"><strong>
      <?=$total?>
    </strong></td>
  </tr>

</table>
