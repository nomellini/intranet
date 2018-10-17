<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<h2  style="text-align:center">Sistema de Atendimento Datamace</h2>
<?
	require("../a/scripts/conn.php");
	require_once("../a/scripts/funcoes.php");

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

	//$id_chamado = 368082;


?>
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
<br>
<h3 style="margin-bottom: -10px;">Dados B&aacute;sicos</h3>
<hr  style="margin-bottom: 50px;">

<?
	$sql = "select
				   a.descricao area,
				   dataa,
				   status,
				   c.descricao,
				   cl.cliente,
				   p.prioridade
			from chamado c
				 inner join usuario u on u.id_usuario = c.consultor_id
				 inner join area a on a.id = u.area
				 inner join cliente cl on cl.id_cliente = c.cliente_id
      		     inner join prioridade p on p.id_prioridade= c.prioridade_id
			where id_chamado = $id_chamado";
	$result = mysql_query($sql);
	$c = 0;

	while ($linha = mysql_fetch_object($result))
	{
		$abertura = amd2dma($linha->dataa);
		$descricao = nl2br($linha->descricao);
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
      <td width="20%" style="text-align: right"><strong>Cliente :</strong></td>
      <td width="80%"><?=$Cliente?></td>
    </tr>
    <tr>
      <td style="text-align: right"><strong>Data de abertura :</strong></td>
      <td><?=$abertura?></td>
    </tr>
    <tr>
      <td align="center" valign="top" style="text-align: right"><strong>Descri��o :</strong></td>
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

<br>
<br>
<h3  style="margin-bottom: -10px;">Tramita&ccedil;&otilde;es</h3>
<hr  style="margin-bottom: 20px;">

<table width="100%" border="0" cellspacing="1" cellpadding="1" class="FundoCinza">
  <tbody>
    <tr class="FundoBrancoCor">
      <td >�rea</td>
      <td >Recebido em</td>
      <td >Encaminhado em</td>
      <td >Detalhe</td>
    </tr>



<?

	$status = conn_ExecuteScalar("select status from chamado where id_chamado = $id_chamado");

	$sql = "select u.area, dataa, horaa, a.descricao from contato
		     inner join usuario u on contato.destinatario_id =  u.id_usuario
			 inner join area a on a.id = u.area
			 where chamado_id = $id_chamado";

	$result = mysql_query($sql);
	$c = 0;

	while ($linha = mysql_fetch_object($result))
	{
		$c++;
		$AreaId = $linha->area;
		$Area = $linha->descricao;
		$Data = $linha->dataa;
		$Hora = $linha->horaa;

		$DataTela = amd2dma($Data);

		if ($c==1) {
			$DataRecebimento = $DataTela;
			$AreaAnterior = $Area;
			$DataAnterior = $DataTela;
			$DataRecebimentoFinal = $DataAnterior;
			$qt = 1;
			linha($Area, $DataAnterior, "<b>Abertura</b>", "-");
		}

		$msgInteracao = "interação";
		if ($qt > 1)
			$msgInteracao = "intera��es";

		if ($Area == $AreaAnterior)
		{
			$qt++;
			$DataUltimoContao = $DataTela;
		} else {
			linha($AreaAnterior, $DataRecebimento, $DataAnterior, "$qt $msgInteracao");
			$DataRecebimento = $DataTela;
			$DataRecebimentoFinal = $DataAnterior;
			$qt = 1;
		}

		$DataAnterior = $DataTela;
		$AreaAnterior = $Area;
		//$DataRecebimentoFinal = $DataAnterior;
	}

	$msgInteracao = "interação";
	if ($qt > 1)
		$msgInteracao = "intera��es";

	if ($status == 1) {
		if ($DataRecebimentoFinal=="")
		{
			$DataRecebimentoFinal = $DataRecebimento;
			$qt--;
		}
		//echo "Chamado foi  pela �rea de <b>$Area</b>, ap�s $qt $msgInteracao, sendo a ultima em $DataAnterior $Hora";
		linha($Area, $DataRecebimentoFinal, "<b>Encerrado</b> em $DataAnterior", "$qt $msgInteracao");
	} else
	{
		linha($Area, $DataRecebimentoFinal, "<b>Em andamento</b>", "$qt $msgInteracao:<br>�ltima em $DataAnterior");
	}
?>

  </tbody>
</table>