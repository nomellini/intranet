<?
	include_once("../scripts/conn.php");
	include_once("../scripts/funcoes.php");
	
	if (!isset($txtAte))
		$txtAte = AMD2DMA($Data_Atual);
	
	if (!isset($txtDe))
	    $txtDe = "01/01/2000";
		
	if (!isset($rbTipoData))
		$rbTipoData = 'A';
	


//	mysql_select_db($database_sad, $sad);
	$query_rsStatus = "SELECT * FROM status order by id_status";
	$rsStatus = mysql_query($query_rsStatus) or die(mysql_error());
	$row_rsStatus = mysql_fetch_assoc($rsStatus);
	$totalRows_rsStatus = mysql_num_rows($rsStatus);


	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);
		setcookie("loginok");
	} else {
		header("Location: index.php");
	}


	$PermiteExcluir = ($ok == 12) || 
					  ($ok == 8) || 
					  ($ok == 7) || 
					  ($ok == 1) || 
					  ($ok == 98) 	;
	

	if ($acao == "Inserir")
	{
		$update = "update chamado set chamado_pai_motivo = '$chamado_pai_motivo', chamado_pai_id = $id_chamado where id_chamado = $id_chamado_filho ";
		mysql_query($update) or die (mysql_error() . " - " . $update);		
		conn_projetos_VerificaSeEhSubProjeto($id_chamado_filho);		
		conn_projetos_EmailInclusao($id_chamado_filho, $id_chamado, $ok); // Enviar email dizendo que OK inseriu $id_chamado_filho no chamado $id_chamado					
	}
	
	if ($acao == "Excluir")
	{			
		$update = "update chamado set chamado_pai_motivo = '', 
					chamado_pai_id = 0 where id_chamado = $id_chamado_filho ";
		mysql_query($update) or die (mysql_error() . " - " . $update);
		conn_projetos_EmailExclusao($id_chamado_filho, $id_chamado, $ok);		
	}
	
	$sql = "select * from chamado where id_chamado = " . $id_chamado;
	$result = mysql_query($sql);
	$projeto = mysql_fetch_object($result);
	if (($projeto->rnc != 4) && ($projeto->rnc != 5)) {
		header('location:index.php');
	}
	$projeto->dataa = dataOk($projeto->dataa);
	
	$DataDe = DMA2AMD($txtDe);
	$DataAte = DMA2AMD($txtAte);	
	$tipo = $rbTipoData;

	$WhereStatus = "chamado.status = $status";
	if (!isset($_POST["status"]))		
		if (isset($_GET["abertos"])) 
		{	
			$WhereStatus = "( (chamado.status = 3) or (chamado.status = 2))";
			$status = 2;
		} 	


	$complemento = "";	
	if ($tipo == "A") {
		$campo = 'dataa';
		if ($status > 0) {
			$complemento = " and $WhereStatus ";
		}
	} else {
		$campo = 'datauc';
        $complemento = " and (chamado.status = 1) ";
	}
	$filtro = " and ($campo >= '$DataDe' and $campo <= '$DataAte') $complemento ";
	
	$sql = "select  (select dataa from contato where chamado_id=chamado.id_chamado order by id_contato desc limit 1) as duc,
 (select horaa from contato where chamado_id=chamado.id_chamado order by id_contato desc limit 1) as huc, 
 (select count(1) from contato where chamado_id=chamado.id_chamado) as qtde, chamado.*, p.prioridade from chamado inner join prioridade p on chamado.prioridade_id = p.id_prioridade where chamado_pai_motivo = 'P' and chamado_pai_id = " . $id_chamado . " $filtro order by rnc desc, p.valor, status desc, id_chamado";
	echo ("<!-- $sql -->");
	$chamados = mysql_query($sql);

	$sql = "select * from chamado where chamado_pai_motivo = 'R' and  chamado_pai_id = " . $id_chamado;
	$reunioes = mysql_query($sql);
	
	
	$sql = "select id_chamado, dataa, descricao,  ";
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and status = 2 ) as abertos, ";
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and status <> 2) as encerrados ";
	$sql .= "from chamado where id_chamado = $id_chamado ";

		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
			
			$data = dataOk($linha->dataa);			
			$abertos = $linha->abertos;			
			$somaAbertos += $abertos;			
			$fechados = $linha->encerrados;
			$prioridade = $linha->prioridade;
			$somaEncerrados += $fechados;			
			$total = $abertos + $fechados;
			$somaTotal += $total;					
			if ($total != 0) 
			{
				$Completo = 100 * ($fechados / $total);
			} else {
				$Completo = 0;
			}			
			$Completo = number_format( $Completo, 2 );

	
	
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/jscript" src="../../scripts/jquery-1.4.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Projeto</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</head>
<body>
	<form name="frmFiltro" method="post">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="112" class="normalRow style1">Chamado</td>
    <td width="898" class="normalRow"><span class="style1"><strong> <a href="../historicochamado.php?id_chamado=<?= $projeto->id_chamado;?>">
      <?= $projeto->id_chamado;?>
      </a></strong></span></td>
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
  <tr>
    <td class="normalRow style1">Email aviso</td>
    <td class="normalRow"><?= $projeto->email;?></td>
  </tr>
  <tr>
    <td class="normalRow style1">Status</td>
    <td class="normalRow">
	<div class="meter-wrap">
      <div class="meter-value" style="background-color: #09C; width: <?= $Completo ?>%;">
        <div class="meter-text">
          <?= $Completo ?>
          % </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td class="normalRow style1">Data 
      <label> <br />
      </label></td>
    <td class="normalRow">

      <div align="left">
        <input <?php if (!(strcmp($tipo,"E"))) {echo "checked=\"checked\"";} ?> name="rbTipoData" type="radio" value="E" />
Encerramento 
<input <?php if (!(strcmp($tipo,"A"))) {echo "checked=\"checked\"";} ?> name="rbTipoData" type="radio" value="A"  />
Abertura : De 
        <input name="txtDe" type="text" id="txtDe" value = "<?=$txtDe?>" size="12" maxlength="10" />
        a 
        <input name="txtAte" type="text" id="txtAte" value = "<?=$txtAte?>" size="12" maxlength="10"/>
      </div></td>
  </tr>
  <tr>
    <td class="normalRow style1">Status</td>
    <td class="normalRow"><label>
      <div align="left">
        <select name="status" class="bordaTexto" id="status">
          <option value="0" <?php if (!(strcmp(0, "$status"))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsStatus['id_status']?>"<?php if (!(strcmp($row_rsStatus['id_status'], "$status"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStatus['status']?></option>
          <?php
} while ($row_rsStatus = mysql_fetch_assoc($rsStatus));
  $rows = mysql_num_rows($rsStatus);
  if($rows > 0) {
      mysql_data_seek($rsStatus, 0);
	  $row_rsStatus = mysql_fetch_assoc($rsStatus);
  }
?>
        </select>
        <label>
        <input type="submit" name="Submit2" value="Buscar" />
        </label>
      </div>
      </label></td>
  </tr>
</table>
	<input type="hidden" value="filtrar" />
  <input name="id_chamado" type="hidden" value="<?= $projeto->id_chamado;?>" />
</form>

<form id="form1" name="form1" method="post" action="">
  Adicionar um chamado a este projeto:
  <input name="id_chamado_filho" type="text" id="id_chamado" />
  <input type="submit" name="Submit" value="Adicionar" />
  <span class="normalRow"><span class="style1"><strong><a href="../historicochamado.php?id_chamado=<?= $projeto->id_chamado;?>"> </a></strong></span></span>
  <input name="id_chamado" type="hidden" value="<?= $projeto->id_chamado;?>" />
  <input name="chamado_pai_motivo" type="hidden" value="P" />
  <input name="acao" type="hidden" value="Inserir" />
</form>
<p>[<a href="../relatorios/r_037.php?id_chamado=<?=$id_chamado?>">ver estatísticas</a>]
  [<a href="ChamadosProjeto.php?id_projeto=<?=$id_chamado?>">ver destinatarios</a>]</p>
<p>
</p>
<table width="100%%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td align="left">Filtrar:
      <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'projetos', 1)" /></td>
    <td align="right"></td>
  </tr>
</table>
<div id="Chamados">
  <fieldset>
  <legend><strong>Chamados</strong> sobre este projeto<br />
  </legend>
  <table width="100%" border="0" cellspacing="2" cellpadding="2" id="projetos">
    <tr>
      <th width="188">N&uacute;mero</th>
      <th width="116">Data</th>
      <th width="344">Descri&ccedil;&atilde;o</th>
      <th width="115">Vers&atilde;o</th>
      <th width="189">Destinatario</th>
      <th width="94">Status</th>
      <th width="64">uc</th>
      <? if ($PermiteExcluir) { ?>
      <th width="64">Excluir</th>
      <? } ?>
    </tr>
    <tbody>
      <?
			while ($c = mysql_fetch_object($chamados)) {
				$c->dataa = dataOk($c->dataa);
				$UltimoContato = dataOk($c->duc) . "<br>" . $c->huc;
				$Qtde = $c->qtde;
				$link = "../historicochamado.php?id_chamado=".$c->id_chamado . "#c_".$Qtde;
				$rnc = $c->rnc;
				$style = "chamado";
				$link = "../historicochamado.php?id_chamado=$c->id_chamado";
				if ($rnc == 5) {
					$style = "subprojeto";
					$link = "projeto.php?id_chamado=$c->id_chamado";
				}
		?>
      <tr class="<?=$style?>">
        <td align="left" valign="top"><a href="<?=$link?>" target="_blank">
          <?= $c->id_chamado; ?>
          </a> </td>
        <td align="left" valign="top"><?= $c->dataa; ?></td>
        <td align="left" valign="top"><?= "$c->descricao" ?></td>
        <td align="center" valign="middle"><?= "$c->Ds_Versao" ?></td>
        <td align="center" valign="middle"><?= peganomeusuario($c->destinatario_id);?></td>
        <td align="center" valign="middle"><?= pegaStatus($c->status) . "<br><b>[$c->prioridade]</b>";?></td>
        <td align="center" valign="middle"><a href="<?=$link?>" target="_blank"><?= $UltimoContato ?></a></td>
        <? if ($PermiteExcluir) { ?>
        <td align="center" valign="middle"><a href="javascript:vai(<?= $c->id_chamado; ?>)"><img src="../imagens/deletar.gif" width="25" height="25" border="0" /></a></td>
        <? } ?>
      </tr>
      <tr>
        <td colspan="8"><hr size="1" color="#CCCCCC" /></td>
      </tr>
      <?
			}
		?>
    </tbody>
  </table>
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
<?= $c->descricao; ?>
</a><br />
<?
			}	
		?>
</fieldset>
</div>
--> <a href="index.php">Retornar</a><br />
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
function filter2 (phrase, _id){
	var words = phrase.value.toLowerCase().split(" ");
	var table = document.getElementById(_id);
	var ele;
	for (var r = 1; r < table.rows.length; r++){
		ele = table.rows[r].innerHTML.replace(/<[^>]+>/g,"");
	        var displayStyle = 'none';
	        for (var i = 0; i < words.length; i++) {
		    if (ele.toLowerCase().indexOf(words[i])>=0)
			displayStyle = '';
		    else {
			displayStyle = 'none';
			break;
		    }
	        }
		table.rows[r].style.display = displayStyle;
	}
}  
</script>
