<?php
//ponto

//	require("../../scripts/conn.php");	
    require("../../espera/relat/funcoes.php");	
    require("../../scripts/stats.php");	


	
	$id = $id_coordenador;
	
	
	$Data = explode('/',$datai);
	$ano = $Data[2];
	$mes = $Data[1];
	$dia = $Data[0];
	
	
	$Data = explode('/',$dataf);
	$anofim = $Data[2];
	$mesfim = $Data[1];
	$diafim = $Data[0];

	
//	$ano = $_POST["anoinicio"];
//	$mes = $_POST["mesinicio"]; 
//		
//	$anofim = $_POST["anofim"];
//	$mesfim = $_POST["mesfim"]; 
	
	/*
	Preciso do dia 1 do mes ano inicio até ultimo dia mes/ano fim
	*/


	
	$DataInicio = mktime(0,0,0, $mes, $dia, $ano-1);  
	$DataFim = mktime(0,0,0, $mesfim, $diafim, $anofim);  
	
	$de = date("Y-m-d", $DataInicio);
	$ate = date("Y-m-d", $DataFim);
	

	//$ate = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime($mesfim.'/01/'.$anofim.' 00:00:00'))));  	
	
	
	$DataDe = $datai; //implode("/", array_reverse( explode ('-', $de)));
	$DataAte = $dataf; //implode("/", array_reverse( explode ('-', $ate)));
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estat&iacute;sticas</title>
<style type="text/css">
<!--
.style1 {font-size: 18.0pt}

#Chamados { border: solid  #036 1px ; margin: 10px}

#Chamados_Interno { border: solid 1px  #CCC; margin: 0px 10px -1px 50px }

#header {border-bottom:solid  #000 1px; margin: 10px; font-size:24px}

#analista {border-bottom:solid  #000 1px; margin: 10px; font-size:24px}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<p>
  <?

    $id_u = array();
	$conta = 0;

	$di =  implode("-", array_reverse( explode ('/', $datai)));
	$df  = implode("-", array_reverse( explode ('/', $dataf)));



	$sql = "select id_usuario, nome, count(1) chamados , sum(contatos) contatos
from 
(select
  us.id_usuario, us.nome, ch.id_chamado, count(1) as contatos  
from
  chamado ch  
    inner join contato co on co.chamado_id = ch.id_chamado        
    inner join usuario us on us.id_usuario = co.consultor_id
where
  co.dataa >= '$di' and co.dataa <= '$df'  
  and co.consultor_id in (173, 175, 8)  
group by us.id_usuario, us.nome, ch.id_chamado) as chamados 

group by nome
order by count(1) desc"	;

	$result = mysql_query($sql) or die( mysql_error());
	
?>
<ol>
<?	
	$ch = $co = 0;
	while(  $linha = mysql_fetch_object($result) )
	{
        $id_u[$conta++] = $linha->id_usuario;
		$ch += $linha->chamados; 
		$co += $linha->contatos;
?>
    <li>[<?= $linha->chamados ?> / <?=  $linha->contatos ?>] - <a href="#<?= $linha->nome ?>"> <?= $linha->nome ?></a></li>
<?
	}
	
	if (!$ordem) {
	  $ordem = "tempo desc";
	}
	$o = "$ordem";

	$TempoPorPeriodo = statContatosPorConsultor2($id_u, $origem, $datai, $dataf, $o);		
	
	$total = count($TempoPorPeriodo);
	
    $somaChamados = 0;
    $somaTempos = 0;
    while( list($tmp1, $tmp) = each($TempoPorPeriodo) ) {
	  $somaChamados += $tmp["contatos"];
	  $somaTempos += $tmp["tempo"];
	}
	reset($TempoPorPeriodo);	
	
	
	
?>  
</ol>



<ul>
	<li><? Echo ( "De $datai até $dataf - Data atual :" . date("d/m/Y h:m") ); ?></li>    
	<li><? Echo ("Total: $ch chamados / $co contatos"); ?></li>
</ul>








  <table width="99%" border="0" cellspacing="1" cellpadding="1" bgcolor="#333333" height="8" align="center">
    <tr bgcolor="#CCCCCC"> 
      <td width="53%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Nome</font></td>
      <td width="21%" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Contatos</font></td>
      <td width="26%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Tempo</font></td>
      <td width="26%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Porcentagem</font></td>
    </tr>
    <?  
	$somaTempo = 0;
  while( list($tmp1, $tmp) = each($TempoPorPeriodo 	) ) {
	$ano = $tmp["nome"];
	$chamados = $tmp["contatos"];
	
	$tempo = $tmp["tempo"];
	$somaTempo += $tempo;
	
    if($somaTempos) {
	  $ct = $tempo/$somaTempos*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";

?>
    <tr bgcolor="#FCE9BC"> 
      <td width="53%" height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        <?=$ano?>
        </font></td>
      <td width="21%" height="16" valign="middle" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?=$chamados?>
        </font></td>
      <td width="26%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?=sec_to_time($tempo)?></font></td>
      <td width="26%" height="16" align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1">        <?=$ct?></font>
      </td>
    </tr>
    <?
  }
?>
    <tr bgcolor="#FFFFFF"> 
      <td width="53%" height="16" align="left">&nbsp;</td>
      <td width="21%" height="16" align="left"> <div align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1">       <?=$somaChamados?></font>
        </div></td>
      <td width="26%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><?=sec_to_time($somaTempo)?></font></td>
      <td width="26%" height="16" align="left">&nbsp;</td>
    </tr>
  </table>
  
  
  




<?

	$result = mysql_query($sql) or die( mysql_error());
	
?>

<div id="header">Analista / Chamados </div><br />

<div id="Chamados">

<?
	while(  $linha = mysql_fetch_object($result) )
	{
?>  
	<div id= "analista"><a name="<?= $linha->nome ?>" id="ID_10"></a><?= $linha->nome ?> - <?= $linha->chamados ?> Chamados </div>
    
    <table width="90%" border="0" cellspacing="1" cellpadding="1">

<?

	$id_usuario = $linha->id_usuario;
	
	$sql = "select 
		ch.cliente_id,
		cl.grau,
		ch.id_chamado, 
		p.prioridade,
        left(ch.descricao, 100) descricao,
		status.status
		
from
  chamado ch  
    inner join contato co on co.chamado_id = ch.id_chamado    
	inner join status on status.id_status = ch.status
    inner join cliente cl on cl.id_cliente = ch.cliente_id
   inner join prioridade p on p.id_prioridade = ch.prioridade_id	
	
where
  co.dataa >= '$di' and co.dataa <= '$df'  
  and co.consultor_id in ($id_usuario)  
group by ch.id_chamado
order by status.id_status desc, p.valor, cl.grau, cl.cliente
";
	

  
	  $result2 = mysql_query($sql) or die(mysql_error() . " - " . $sql)	  ;	  

	  
      while(  $linha2 = mysql_fetch_object($result2) ) 	{
		  
		  	  	$desc = str_replace("<br>", ".", $linha2->descricao);
				$contato = str_replace("<br>", ".", $linha2->contato);
				$contato = str_replace("<br />", ".", $linha2->contato);								
				$id = $linha2->id_chamado;
				$diag = $linha2->diagnostico;
				//$desc = $linha2->descricao;
		
			  echo "  <tr>";				
?>    



    <td>[<?=$linha2->grau?>]</td>
    <td><?=$linha2->status?></td>
    <td><a href="/a/historicochamado.php?&id_chamado=<?=$id?>"> <?=$linha2->id_chamado?> </a></td>
    <td><?=$linha2->cliente_id?></td>
    <td><?=$linha2->prioridade?></td>
    <td><?= $desc ?> </td>
    <td> <b><?=$contato?> </b>;</td>
    <td><?=$linha2->diagnostico?></td>






<?

	echo "  </tr>";

	} // end while(  $linha2 = mysql_fetch_object($result2) )
?>    

  </table>
<?
	


	} // End while(  $linha = mysql_fetch_object($result) )

	
?>
<br />

</div>
<p><br />


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
