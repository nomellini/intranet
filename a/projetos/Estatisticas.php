<?
	include_once("../scripts/conn.php");
	

	if ($acao == "Inserir")
	{
		$update = "update chamado set chamado_pai_motivo = '$chamado_pai_motivo', chamado_pai_id = $id_chamado where id_chamado = $id_chamado_filho ";
		mysql_query($update) or die (mysql_error() . " - " . $update);
	}
	
	if ($acao == "Excluir")
	{
		$update = "update chamado set chamado_pai_motivo = '', 
					chamado_pai_id = 0 where id_chamado = $id_chamado_filho ";
		mysql_query($update) or die (mysql_error() . " - " . $update);
	}
	
	$sql = "select * from chamado where id_chamado = " . $id_chamado;
	$result = mysql_query($sql);
	$projeto = mysql_fetch_object($result);
	if ($projeto->rnc != 4) {
		header('location:index.php');
	}
	$projeto->dataa = dataOk($projeto->dataa);
	
	
	// Estatísticas;	
	$sql = "select count(1) as qtde from chamado where chamado_pai_id = $id_chamado";
	$result = mysql_query($sql)  or die (mysql_error() . " - " . $sql);
	$linha = mysql_fetch_object($result);
	$qtde = $linha->qtde;

	$sql = "select sec_to_time(sum(time_to_sec(horae) - time_to_sec(horaa))) as qtde from contato where chamado_id in (select id_chamado from chamado where chamado_pai_id =  $id_chamado)";
	$result = mysql_query($sql)  or die (mysql_error() . " - " . $sql);
	$linha = mysql_fetch_object($result);
	$tempo_total = $linha->qtde;	
	
	
	
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/jscript" src="../../scripts/jquery-1.4.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Projeto</title>
<link href="/a/projetos/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>
<body>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="112" class="normalRow style1">Chamado</td>
    <td width="898" class="normalRow"><span class="style1"><strong>
      <a href="../historicochamado.php?id_chamado=<?= $projeto->id_chamado;?>">
    <?= $projeto->id_chamado;?></a></strong></span></td>
  </tr>
  <tr>
    <td class="normalRow style1">Projeto</td>
    <td class="normalRow"><span class="style1"><strong>
      <?= $projeto->descricao;?>
    </strong></span></td>
  </tr>
  <tr>
    <td class="normalRow style1">data de abertura</td>
    <td class="normalRow"><span class="style1"><strong>
      <?= $projeto->dataa;?>
    </strong></span></td>
  </tr>
  <tr>
    <td class="normalRow style1">Situação</td>
    <td class="normalRow"><span class="style1"><strong>
      <?= pegaStatus($projeto->status);?>
    </strong></span></td>
  </tr>
</table>
<p>&nbsp;</p>
<div id="Estatisticas">
	<fieldset>
	<legend>Estatísticas do projeto</legend>	
		<table width="50%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="29%">Chamados:</td>
            <td width="71%"><?=$qtde;?></td>
          </tr>
          <tr>
            <td>Tempo total </td>
            <td><?=$tempo_total;?></td>
          </tr>
        </table>
		<br />
	</fieldset>
</div>

<!--<div id="Reunioes">
	<fieldset>
	<legend>Reuni&otilde;es sobre este projeto</legend>
		<?
			while ($c = mysql_fetch_object($reunioes)) {
				$c->
dataa = dataOk($c->dataa);			
		?> <a href="../historicochamado.php?id_chamado=<?= $c->id_chamado; ?>" target="_blank">
        <?= $c->id_chamado; ?>
        :<br /> 
        <?= $c->descricao; ?></a><br />
		<?
			}	
		?>
	</fieldset>
</div>
-->



<a href="javascript:history.go(-1);">Retornar</a><br />
<br />
<form id="frmExclusao" name="frmExclusao" method="post" action="">
  <input name="id_chamado" type="hidden" id="id_chamado" value="<?=$id_chamado?>" />
  <input name="acao" type="hidden" id="acao" value="Excluir" />
  <input name="id_chamado_filho" type="hidden" id="0" value="F" />
</form>
</body>
</html>
<script>
function vai(id)
{
	var resposta = window.confirm("Confirma tirar o chamado " + id + " deste projeto ?");
	if (resposta)
	{
		document.frmExclusao.id_chamado_filho.value = id;
		document.frmExclusao.submit();
	} 
}
</script>