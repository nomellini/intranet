<?php

	$trigger = 3; // Chamados com 3 ou mais
	
	
	require("../../scripts/conn.php");	
	require("sql.php");	

	if ($TipoReferencia == "MES") {	
		$ano = $_POST["ano"];
		$mes = $_POST["mes"]; 
		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);  		
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);		
		$de = date("Y-m-d", $DataInicio);
		$ate = date("Y-m-d", $DataFim);
	} else {
		
		
		
		$Data = explode('/', $de);
		$DataInicio = mktime(0,0,0, $Data[1], $Data[0], $Data[2]);			
		$de = "$Data[2]-$Data[1]-$Data[0]"; 	

		$Data = explode('/', $ate);
		$DataFim = mktime(0,0,0, $Data[1], $Data[0], $Data[2]);			
		$ate = "$Data[2]-$Data[1]-$Data[0]"; 			
	}
	
	$Mensagem = "Recebidos";
	if ($tipo == 'E') { $Mensagem = "Enviados ou Pendentes"; }
	if ($tipo == 'A') { $Mensagem = "Enviados, Recebidos ou Pendentes"; }
	
	//$de = '2009-06-01';
	//$ate = '2009-06-31';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estat&iacute;sticas</title>
<style type="text/css">
<!--
.style1 {font-size: 18.0pt}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<p>Contato inseridos no per&iacute;do de <?= date("d/m/Y", $DataInicio);?> Ate <?= date("d/m/Y", $DataFim);?><br />
Contatos &quot;<?php echo $Mensagem ?>&quot;</p>
<p>  Interações entre jurídico e outras áreas

<table border="1" cellspacing="0" cellpadding="0" width="50%">
  <tr>
    <td valign="top" bgcolor="silver">Chamado</td>
    <td valign="top" bgcolor="silver">Sistema</td>	
    <td valign="top" bgcolor="silver"><div align="center">Interações</div></td>
  </tr>
<?

	$sql_001 = getSql_001($de, $ate, $tipo, $diagnostico);	
	$result = mysql_query($sql_001) or die (mysql_error());
	
	$soma = 0;
	
	while ($linha = mysql_fetch_object($result)) {
		$Pessoa = $linha->nome;
		$Chamado = $linha->chamado_id;
		$Sistema = $linha->sistema;
		$Qtde = $linha->soma;
		$soma += $Qtde;
?>
  <tr>
    <td valign="top" bgcolor="silver"><a href="/a/historicochamado.php?id_chamado=<?=$Chamado?>&tipo=<?=$tipo?>" target="_blank"><?=$Chamado?></a></td>
    <td valign="top" bgcolor="silver"><?=$Sistema?></td>
    <td valign="top" bgcolor="silver"><div align="center">
      <?=$Qtde?>
    </div></td>
  </tr>
<?
	}
?>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">T O T A L</td>
    <td valign="top"><div align="center"><?=$soma?> </div></td>
  </tr>
</table>
<div style="page-break-after:always"></div>
<br />
Quantidade de chamado Vs Quantidade de Intera&ccedil;&otilde;es
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="50%" valign="top"><table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="146" align="center"  valign="middle" bgcolor="silver">Intera&ccedil;&otilde;es </td>
        <td width="158" align="center"  valign="middle" bgcolor="silver">Chamados</td>
        <td width="158" align="center"  valign="middle" bgcolor="silver">Total de Intera&ccedil;&otilde;es </td>
        <td width="158" align="center"  valign="middle" bgcolor="silver">%</td>
      </tr>
 <?
 

 	$sql_002 =  getSqlQuantidadeInteracoes($de, $ate, $tipo, $diagnostico);

	$result = mysql_query($sql_002) or die (mysql_error());	
	$soma = 0;
	$total = 0;
	while ($linha = mysql_fetch_object($result)) {
		$Qtde = $linha->soma;
		$total += ($Qtde*$interacoes);
		$soma += $Qtde;
	}
	
	$result = mysql_query($sql_002) or die (mysql_error());		
	
	$p1 = 0;
	
	$p2 = 0;
	
	while ($linha = mysql_fetch_object($result)) {
		$interacoes = $linha->interacoes;
		$Qtde = $linha->soma;
		$total += ($Qtde*$interacoes);

		$Percentual = $Qtde / $soma * 100;
		
		if ($interacoes < $trigger) {
			$p1 += $Percentual;
		} else {
			$p2 += $Percentual;
		}
				
		$Percentual = number_format($Percentual, 2, ',', '');
?>
      <tr>
        <td align="center" valign="middle" bgcolor="silver">            <?=$interacoes?>          </td>
        <td align="center" valign="middle" bgcolor="silver">            <?=$Qtde?>          </td><td align="center" valign="middle" bgcolor="silver">            <?=$Qtde*$interacoes?>
            </td>
        <td align="center" valign="middle" bgcolor="silver">
            <?=$Percentual?> 
          %</td>
      </tr>
      <?
	}
?>
      <tr>
        <td align="center" valign="middle">T O T A L</td>
  <td align="center"  valign="middle">            <?=$soma?>          </td><td align="center"  valign="middle">                  <?=$total?>
                  </td>
        <td align="center"  valign="middle">100%</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><br />
<img src="grafico_001.php?de=<?=$de?>&amp;ate=<?=$ate?>&tipo=<?=$tipo?>&diagnostico=<?=$diagnostico?>" /></td>
  </tr>
</table>
<?
	$p1 = number_format($p1, 2, ',', '');
	$p2 = number_format($p2, 2, ',', '');
	$Media = number_format($total/$soma, 2, ',', '');
?>
<p>M&eacute;dia de Intera&ccedil;&otilde;es por chamado : <?=$total?>/<?=$soma?> = <?=$Media?> Interações por chamado <br />
Chamados com menos do que <?=$trigger?> intera&ccedil;&otilde;es: <?=$p1?> % <br />
Chamados com <?=$trigger?> ou mais intera&ccedil;&otilde;es : <?=$p2?> %<br />
</p>
<br />
Média de intera&ccedil;&otilde;es por chamado dos últimos 12 meses.<br />
<img src="grafico_002.php?ate=<?=$ate?>&tipo=<?=$tipo?>&diagnostico=<?=$diagnostico?>">	<br />
</body>
</html>
