<?
	require("../../scripts/conn.php");
	
	$De =  implode("-",  array_reverse(explode('/',$datai)));
	$Ate =  implode("-",  array_reverse(explode('/',$dataf)));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link href="../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estat&iacute;sticas Fujitso</title>

<style type="text/css">
	.zebra { 
		background-color: #dddddd;
	}	
</style>

</head>

<body>


<div style="width:90%">

<fieldset>
 <legend>Chamados de projeto encerrados e abertos encaminhados para o Daniel no período de <?=$datai?> à <?=$dataf?> </legend>
 <br />
<table width="95%" border="0" cellspacing="1" cellpadding="1" id="chamados" align="center">
  <thead>
    <th>Nome</td>
    <th class="OK">Chamados</th>
    <th class="OK">Encerrados</th>
    <th class="OK">%</th>
    <th class="OK">Saldo</th>
	<th class="OK">%</th>    
  </thead>

<?
	$sql = "select u.id_usuario, u.nome from usuario u  inner join rl_recebe_envia r on r.id_envia = u.id_usuario order by u.nome";
	$result_usuarios = mysql_query($sql);
	
	$sEncerrados = 0;
	$sAbertos = 0;

	while ($linha_usuarios = mysql_fetch_object($result_usuarios))
	{
		$id_usuario = $linha_usuarios->id_usuario;
		$nome_usuario = $linha_usuarios->nome;

	mysql_query("DROP TABLE IF EXISTS ChamadosPorConsultor;");
	$sql = "Create temporary table ChamadosPorConsultor
	select chamado_id, c.status
	from contato
	  inner join chamado c on c.id_chamado = contato.chamado_id
	where 
		c.categoria_id in (select id_categoria from categoria where categoria like '%FUJITSU%') and 
		( (c.rnc = 4) or (c.chamado_pai_id <> 0)) and
		contato.dataa >= '$De' and contato.dataa <= '$Ate' and 
		contato.consultor_id = $id_usuario and contato.destinatario_id = 98       
	group by chamado_id, c.status";

	mysql_query($sql) or die (mysql_error());
	
	$sql = "Select Count(1) as q from ChamadosPorConsultor where status = 1";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$Encerrados = $linha->q;
	$sEncerrados += $Encerrados;
	
	$sql = "Select Count(1) as q from ChamadosPorConsultor where status <> 1";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$Abertos = $linha->q;
	$sAbertos += $Abertos;
	
	
	$Total =  $Encerrados + $Abertos;

	$p_Encerrados =  0;
	$p_Saldo = 0;
	
	if($Total != 0 ) {
		$p_Encerrados =  number_format( ($Encerrados / $Total) * 100, 2);
		$p_Saldo = number_format(($Abertos / $Total) * 100, 2);
	}
	
	?>

  <tr>
    <td><?=$nome_usuario?></td>
    <td class="OK"><?= sprintf("%04d", $Total);?></td>
    <td class="OK"><?= sprintf("%04d", $Encerrados)?></td>
    <td class="OK"><?= "$p_Encerrados %" ?></td>
    <td class="OK"><?= sprintf("%04d", $Abertos) ?></td>
    <td class="OK"><?= "$p_Saldo %" ?></td>
  </tr>
    
    <?
	
	

	}
	

	$sTotal = $sEncerrados + $sAbertos;
	if ($sTotal !=  0) {
	$p_sEncerrados =  number_format( ($sEncerrados / $sTotal) * 100, 2);
	$p_sSaldo = number_format(($sAbertos / $sTotal) * 100, 2);
	}

	?>
    
  <tr>
    <td>Totais</td>
    <td class="OK"><b><?= sprintf("%04d", $sTotal);?></b></td>
    <td class="OK"><b><?= sprintf("%04d", $sEncerrados)?></b></td>
    <td class="OK"><?= "$p_sEncerrados %" ?></td>
    <td class="OK"><b><?= sprintf("%04d", $sAbertos) ?></b></td>
    <td class="OK"><?= "$p_sSaldo %" ?></td>
  </tr>
</table>


<br />

</div>
<br />

<br />

<div style="width:90%">
<fieldset >
 <legend>Contatos e tempos para chamados de projeto no período de <?=$datai?> à <?=$dataf?> </legend>
 <br />

<table width="95%" border="0" cellspacing="1" cellpadding="1" id="tempos" align="center">
  <thead>
    <th>Área</th>
    <th>Nome</th>
    <th>Contatos</th>
    <th>Tempo</th>
  </thead>
  
<?
	$sql = "select area.descricao area, u.nome, 
       count(1) as contatos,     
       sec_to_time(sum(time_to_sec(contato.horae) - time_to_sec(contato.horaa))) Tempo
from contato 
     inner join usuario u on u.id_usuario = contato.consultor_id          
     inner join area on area.id = u.area
	 inner join chamado c on c.id_chamado = contato.chamado_id
where
contato.dataa >= '$De' and contato.dataa <= '$Ate' and 

categoria_id in (select id_categoria from categoria where categoria like '%FUJITSU%') and

chamado_id in (select id_chamado from chamado c where (c.rnc = 4) or (c.chamado_pai_id in (select id_chamado from chamado c where (c.rnc = 4))))
group by u.nome, area.descricao
order by area.descricao, u.nome";

	$result = mysql_query($sql) or die ( mysql_error());
	while ($linha = mysql_fetch_object($result))

	{
?>


  <tr>
    <td><?=$linha->area?></td>
    <td><?=$linha->nome?></td>
    <td><?=$linha->contatos?></td>
    <td><?=$linha->Tempo?></td>
  </tr>
  
<?
	}
?>  
</table>
<br />

</fieldset>
</div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
	$("table").attr("border", "0");
	$("#chamados tr:odd").addClass('zebra');	
	$("#tempos tr:odd").addClass('zebra');		
	$("th").css({"color": "blue"});		
});
</script>
</html>