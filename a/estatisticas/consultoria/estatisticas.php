<?php

//	require("../../scripts/conn.php");	
    require("../../espera/relat/funcoes.php");	
	
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
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<?

	if ($onlines) {

	$sql = "select CONCAT( month(dataa), '/', year(dataa)) ref, count(1) qtde from chamado
        	where externo = 1 and (dataa >= '$de' and dataa <= '$ate')
			group by year(dataa), month(dataa)";
	
	
	$result = mysql_query($sql) or die( mysql_error());

?>
<p>Quantidade de chamados On-Line de
<?= $DataDe;?> at&eacute;
<?= $DataAte;?>
</p>
<table width="25%" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td>Referência</td>
    <td>Chamados</td>
  </tr>
<?
	while(  $linha = mysql_fetch_object($result) )
	{
?>  
  <tr>
    <td><?= $linha->ref ?></td>
    <td><?= $linha->qtde ?></td>
  </tr>
<?


	}
	
?>
</table>

<?
	} // end mostraonlines

?>
<p><br />
  <?
	$DataInicio = mktime(0,0,0, $mes, $dia, $ano);  
	$de = date("Y-m-d", $DataInicio);
	$DataDe = implode("/", array_reverse( explode ('-', $de)));
?>
  Estat&iacute;sticas de <?= $DataDe;?> at&eacute; <?= $DataAte;?>
  <br />
  <br /> 
  Detalhamento
  <?

  $datai = $de;
  $dataf = $ate;  
  $sql = "select cl.grau, ";
  $sql .= "	data, motivo_status, u.nome as consultor, id_chamado,  ";
  $sql .= "	st.descricao as status, qtde_aguarde, sl.id,  ";
  $sql .= "	cl.cliente, sec_to_time( time_to_sec(hora_fim) - time_to_sec(hora_inicio) ) as espera,  ";
  $sql .= "	si.sistema as produto, sl.motivo, linha, sl.hora_inicio, hora_fim,  ";
  $sql .= "	cl.bloqueio, sl.id_satstatus, sl.FL_ATIVO,  ";
  $sql .= "	(time_to_sec(hora_fim) - time_to_sec(hora_inicio)) as esperasec ";
  $sql .= "FROM  ";
  $sql .= "	satligacao sl ";
  $sql .= "		left join cliente cl on cl.id_cliente = sl.id_cliente ";
  $sql .= "		left join sistema si on si.id_sistema = sl.id_produto ";
  $sql .= "		left join satstatus st on st.id = sl.id_satstatus ";
  $sql .= "		left join usuario u on u.id_usuario = sl.id_usuario ";
  $sql .= "WHERE 1=1 ";
  $sql .= "  and data >= '$datai' ";
  $sql .= "  and data <= '$dataf' ";
  
   
  $contador = 0;
  $perdidas = 0;
  $maisque10 = 0;
  $maisque20 = 0;  
  $maisque10n = 0;
  $maisque20n = 0;  
  $inativos = 0;
  $inativosMaior = 0;
  $inativosMenor = 0;
  
//  echo ($sql);
  
  $diasUteis = 0;
  $DataAnterior = "";
  
  $result = mysql_query($sql) or die(mysql_error());
  while ($linha = mysql_fetch_object($result)) { 
   
    $status = $linha->status;
    $idligacao = $linha->id;
	$id_chamado = $linha->id_chamado;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$esperasec = $linha->esperasec;
	$linhatel = $linha->linha;
	$motivo = $linha->motivo_status;
	$hora_inicio = $linha->hora_inicio;
	$hora_fim = $linha->hora_fim;
	$consultor = $linha->consultor;
	$data = $linha->data;
	$Grau = $linha->grau;
	$quando = explode("-", $data);
	
    $data = "$quando[2]/$quando[1]/$quando[0]";
	
	if ($data != $DataAnterior) 
	{
		$diasUteis++;
	}
	
	$ativo = $linha->FL_ATIVO;
	
	$id_satstatus = $linha->id_satstatus;

	if ($id_satstatus == 4) {
	  $perdidas++;

		if (($esperasec >= 480) and ($ativo)) {
		  $maisque10n++;
		}
		if (($esperasec >= 900) and ($ativo)) {
		  $maisque10n--;	  
		  $maisque20n++;	  
		}	  
	  
	} else {
	
		$ok = false;
		if (($esperasec >= 480) and ($ativo)) {
		  $maisque10++;
		}
		if (($esperasec >= 900) and ($ativo)) {
		  $maisque10--;	  
		  $maisque20++;	  
		}
		
		if ((!$ativo)) {		
		  $inativos++;
		}			
		
		if (($esperasec >= 480) and (!$ativo)) {
		  $inativosMaior++;
		}	
	}

	$DataAnterior = $data;
	$contador++;
  }

	$atendidas = $contador-$perdidas - $inativos;
	$mediadia = $contador / $diasUteis;
	$mediadia2 = $atendidas/ $diasUteis;

?>
</p>
<table width="430" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="65%">Total de liga&ccedil;&otilde;es recebidas</td>
    <td width="35%" align="center" valign="middle"><?=$contador?></td>
  </tr>
  <tr>
    <td>Total de liga&ccedil;&otilde;es atendidas</td>
    <td align="center" valign="middle"><?=$atendidas?></td>
  </tr>
  <tr>
    <td>Total de contatos (geral)</td>
    <td align="center" valign="middle">* mais abaixo</td>
  </tr>
  <tr>
    <td>Dias &uacute;teis</td>
    <td align="center" valign="middle"><?=$diasUteis?></td>
  </tr>
  <tr>
    <td>M&eacute;dia recebidas / dia</td>
    <td align="center" valign="middle"><?= number_format( $mediadia,2) ;?></td>
  </tr>
  <tr>
    <td>M&eacute;dia atendidas / dia</td>
    <td align="center" valign="middle"><?= number_format( $mediadia2,2) ;?></td>
  </tr>
</table>

<?

	$g1 = getBarra($DataDe, $DataAte, "", "G1");
	$g1 = $g1[1];
	$contaG1 = 0;
	for( $i=0; $i<8; $i++)
	{
		$contaG1 += $g1[$i];
	}
	$MetaG1 =  ceil( $contaG1 / 100 * 1.5 );
	$ApuradoG1 = $g1[4] + $g1[5] + $g1[6] + $g1[7] ;

	$g2 = getBarra($DataDe, $DataAte, "", "G2");
	$g = $g2[1];
	$contaG2 = 0;
	for( $i=0; $i<8; $i++)
	{
		$contaG2 += $g[$i];
	}
	$MetaG2 =  ceil( $contaG2 / 100 * 1.5);
	$ApuradoG2 = $g[5] + $g[6] + $g[7] ;

	$g = getBarra($DataDe, $DataAte, "", "G3");
	$g = $g[1];
	$contaG3 = 0;
	for( $i=0; $i<8; $i++)
	{
		$contaG3 += $g[$i];
	}
	$MetaG3 =  ceil( $contaG3 / 100 * 1.5 );
	$ApuradoG3 = $g[6] + $g[7] ;


?>
<p>Metas </p>
<table width="430" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="137">M&aacute;ximo em minutos</td>
    <td width="71" align="center" valign="middle">Total</td>
    <td width="104" align="center" valign="middle">Meta</td>
    <td width="104" align="center" valign="middle">Apurado</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td>G1 - 15</td>
    <td align="center" valign="middle"><?=$contaG1?></td>
    <td align="center" valign="middle"><?=$MetaG1?></td>
    <td align="center" valign="middle"><?=$ApuradoG1?></td>
  </tr>
  <tr>
    <td>G2 - 20</td>
    <td align="center" valign="middle"><?=$contaG2?></td>
    <td align="center" valign="middle"><?=$MetaG2?></td>
    <td align="center" valign="middle"><?=$ApuradoG2?></td>
  </tr>
  <tr>
    <td>G3 - 25</td>
    <td align="center" valign="middle"><?=$contaG3?></td>
    <td align="center" valign="middle"><?=$MetaG3?></td>
    <td align="center" valign="middle"><?=$ApuradoG3?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
</table>
<p><br />
<?
	$sql = funcoesGetSelectContatosPorConsultor($de, $ate);
	$result = mysql_query($sql);
	
?>
</p>
<table width="768" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="263">Nome</td>
    <td width="62" align="right">Contatos</td>
    <td width="105" align="center">%</td>
    <td width="91" align="center">Tempo</td>
    <td width="89" align="center" valign="middle">%</td>
    <td width="125" align="center">Tempo / Contato</td>
  </tr>
<?
	$conta = 0;
	while ($linha = mysql_fetch_object($result))
	{
		$conta += $linha->contatos;
?>  
  <tr>
    <td><?= $linha->nome?> </td>
    <td align="right"><?= $linha->contatos?></td>
    <td align="center"><?= number_format($linha->P,2) ?></td>
    <td align="center"><?= $linha->tempo_total?></td>
    <td align="center" valign="middle"><?= number_format($linha->P_t,2)?></td>
    <td align="center"><?= $linha->tempo_contato?></td>
  </tr>
<?
	}
?>
  <tr>
    <td>TOTAL: </td>
    <td align="right"><?= $conta;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>  
  
</table>

<p>
  <?
$sql = "select  
     m.motivo motivo, 
     count(1) qtde, 
     sec_to_time(sum( time_to_sec(co.horae) - time_to_sec(co.horaa))) tempo
from 
     chamado ch
       inner join contato co on co.chamado_id = ch.id_chamado       
       inner join motivo m on m.id_motivo = motivo_id       
       inner join usuario u on u.id_usuario = co.consultor_id and u.area = 1       
       inner join origem o on o.id_origem = origem_id and origem_id = 1

where 
  co.horaa <> co.horae and
  co.dataa >= '$de' and co.dataa <= '$ate'  

group by m.motivo

order by count(1) desc";

	$result = mysql_query($sql);
?>
</p>
<p>Motivos dos chamados com contato telefônico da consultoria no período
</p>
<table width="767" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="459">Motivo</td>
    <td width="149" align="center">Quantidade</td>
    <td width="141" align="right" valign="middle">Tempo</td>
  </tr>
<?
	$soma = 0;
	while ($linha = mysql_fetch_object($result))
	{
		$soma += $linha->qtde;
?>    
  <tr>
    <td><?= $linha->motivo;?></td>
    <td align="center"><?= $linha->qtde;?></td>
    <td align="right" valign="middle"><?= $linha->tempo;?></td>
  </tr>
<?
	}
?>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><?= $soma;?></td>
    <td align="right" valign="middle">&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
</body>
</html>
