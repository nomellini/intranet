<?
	require("../a/scripts/conn.php");
	require_once("../a/scripts/funcoes.php");	

	function Log_Tramitacoes($id_chamado)
	{
		$sql = "insert into log_tramitacoes (id_chamado, id_cliente, dt_data) select id_chamado, cliente_id, now() from chamado where id_chamado = $id_chamado";
		mysql_query($sql);	
	}

	function linha($Area, $DataRecebido, $DataEncaminhado, $Detalhe)
	{
		echo "
		<tr class=FundoBranco>
		<td>$Area</td>
		<td class='FundoBrancoCentro'>$DataRecebido &nbsp;</td>
		<td class='FundoBrancoCentro'>$DataEncaminhado &nbsp;</td>
		<td>$Detalhe</td>
		</tr>";	

	}
	
	
	Log_Tramitacoes($id_chamado);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
  <title>SAD - Sistema de Atendimento Datamace</title>


  <link rel="stylesheet" href="include/css.css">

	<link rel="StyleSheet" href="include/dtree.css" type="text/css" />
	<script type="text/javascript" src="include/dtree.js"></script>

<style type="text/css">
    .FundoCinza {
    	background-color: cccccc;
    }
    .FundoBranco {
	    background-color: ffffff;	
    }
    
    .FundoBrancoCentro {
		background-color: ffffff;	
		text-align: center;	
    }        
    .FundoBrancoCor {
		background-color: rgba(0,105,150,1.00);	
		font-weight:bold;
		color:#FFFFFF;
		text-align: center;
    }    
</style>

</head>


<body>


<div id="topo">
	<? include("include/topo.php");?> 
</div>



<div id="data">
 <? include("include/data.php");?>
</div>

<div id="conteudo">


  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="190" valign="top" style="padding-left:5px">
	  <div id="menuPrincipal">
		  <? include("include/menu.php"); 		  ?>		  
      </div>      
      </td>  
      
      
      <td valign="top" style="padding-left:5px">

<h3 style="margin-bottom: -10px;">Dados B&aacute;sicos</h3>
<hr  style="margin-bottom: 10px;">
<?
	$sql = "select 
				   a.descricao area,
				   dataa,
				   status,
				   c.descricao,
				   cl.cliente,
				   p.prioridade,
				   s.sistema
			from chamado c
				 inner join usuario u on u.id_usuario = c.consultor_id
				 inner join area a on a.id = u.area
				 inner join cliente cl on cl.id_cliente = c.cliente_id
      		     inner join prioridade p on p.id_prioridade= c.prioridade_id
				 inner join sistema s on s.id_sistema = c.sistema_id
			where id_chamado = $id_chamado";
	$result = mysql_query($sql);
	$c = 0;		

	while ($linha = mysql_fetch_object($result))
	{
		$abertura = amd2dma($linha->dataa);
		$descricao = nl2br($linha->descricao);
		$sistema = $linha->sistema;
		$Status = "Em andamento";
		if ($linha->status == 1)
		{
			$Status = "Encerrado";
		}
		$Cliente = $linha->cliente;
		$Prioridade = $linha->prioridade;
	}
?>

<table width="95%" border="0" cellspacing="1" cellpadding="1">
  <tbody>
    <tr>
      <td width="20%" style="text-align: right"><strong>Chamado :</strong></td>
      <td width="80%"><?=$id_chamado?></td>
    </tr>
    <tr>
      <td width="20%" style="text-align: right"><strong>Sistema :</strong></td>
      <td width="80%"><?=$sistema?></td>
    </tr>
    <tr>
      <td style="text-align: right"><strong>Data de abertura :</strong></td>
      <td><?=$abertura?></td>
    </tr>
    <tr>
      <td align="center" valign="top" style="text-align: right"><strong>Descrição :</strong></td>
      <td><?=$descricao?></td>
    </tr>
    <tr>
      <td align="center" valign="top" style="text-align: right"><strong>Prioridade :</strong></td>
      <td><?=$Prioridade?></td>
    </tr>
    <tr>
      <td align="center" valign="top" style="text-align: right"><strong>Status :</strong></td>
      <td><?=$Status?></td>
    </tr>
  </tbody>
</table>
<h3  style="margin-bottom: -10px;">Tramita&ccedil;&otilde;es</h3>
<hr  style="margin-bottom: 20px;">

<table width="100%" border="0" cellspacing="1" cellpadding="1" class="FundoCinza">
  <tbody>
    <tr class="FundoBrancoCor">
      <td >Área</td>
      <td >Recebido em</td>
      <td >Encaminhado em</td>
      <td >Detalhe</td>
    </tr>
    


<?

	$status = conn_ExecuteScalar("select status from chamado where id_chamado = $id_chamado");
	
	$sql = "select u.area, dataa, horaa, a.descricao, contato.consultor_id from contato 
		     inner join usuario u on contato.destinatario_id =  u.id_usuario
			 inner join area a on a.id = u.area
			 where chamado_id = $id_chamado";
			 
	$result = mysql_query($sql);
	$c = 0;		
	$cliente = 0;
	while ($linha = mysql_fetch_object($result))
	{
		$c++;
		$AreaId = $linha->area;
		$Area = $linha->descricao;
		$Data = $linha->dataa;
		$Hora = $linha->horaa;
		$consultor_id = $linha->consultor_id;
		
		$DataTela = amd2dma($Data);
		
		if ($c==1) {
			$DataRecebimento = $DataTela;
			$AreaAnterior = $Area;
			$DataAnterior = $DataTela;
			$DataRecebimentoFinal = $DataAnterior;
			$qt = 0;
			linha($Area, $DataAnterior, "<b>Abertura</b>", "-");
		} 			
		
		$msgInteracao = "interação";
		if ($qt > 1) 
			$msgInteracao = "interações";		
		
		if ($Area == $AreaAnterior)
		{
			if ($consultor_id == 56) {
				$cliente++;
			}
			$qt++;
			$DataUltimoContao = $DataTela;
		} else {
			linha($AreaAnterior, $DataRecebimento, $DataAnterior, "$qt $msgInteracao | $cliente de cliente");
			$DataRecebimento = $DataTela;
			$DataRecebimentoFinal = $DataAnterior;
			$qt = 1;
			$cliente = 0;
		}							
		
		$DataAnterior = $DataTela;
		$AreaAnterior = $Area;
		//$DataRecebimentoFinal = $DataAnterior;
	}
	
	$msgInteracao = "interação";
	if ($qt > 1) 
		$msgInteracao = "interações";		
	
	if ($status == 1) {
		if ($DataRecebimentoFinal=="")
		{
			$DataRecebimentoFinal = $DataRecebimento;
			$qt--;
		}
		//echo "Chamado foi  pela área de <b>$Area</b>, após $qt $msgInteracao, sendo a ultima em $DataAnterior $Hora";
		linha($Area, $DataRecebimentoFinal, "<b>Encerrado</b> em $DataAnterior", "$qt $msgInteracao | $cliente de cliente" );		
	} else 
	{
		linha($Area, $DataRecebimentoFinal, "<b>Em andamento</b>", "$qt $msgInteracao | $cliente de cliente:<br>última em $DataAnterior");
	}
?>
    
  </tbody>
</table>




      </td>  
      
     </tr>
  </table>
      

</div>

<div id="rodape">
<? include("include/rodape.php");?>
</div>


