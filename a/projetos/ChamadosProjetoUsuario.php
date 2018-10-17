<?
	include_once("../scripts/conn.php");
	include_once("../scripts/funcoes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/jscript" src="../../scripts/jquery-1.4.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Chamados por usu&aacute;rio e projeto</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.Body #Lista table tr th {
	color: #FFF;
}
.meter-text {    /* The width and height of your image */
    width: 155px; height: 30px;
}
.meter-text {    position: absolute;
    top:0; left:0;

    padding-top: 5px;

    color: #00;
    text-align: center;
	font-weight:bold;
    width: 100%;
}
.meter-value {    /* The width and height of your image */
    width: 155px; height: 30px;
}
.meter-value {    background: #bdbdbd url(meter-outline.png) top left no-repeat;
}
.meter-wrap {    position: relative;
}
.meter-wrap {    /* The width and height of your image */
    width: 155px; height: 30px;
}
.meter-wrap {    background: #bdbdbd url(meter-outline.png) top left no-repeat;
}
.Body #Lista table tr td {
	text-align: center;
}
</style>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="Body">
		<div Class="Titulo">
		  <div align="center"><?= FuncoesObterDescricaoChamado($id_projeto) ?>
		    <p><br />		    </p>

          </div>
		</div>

        <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" summary="Lista os projetos da Datamace">
		      <tr>
		        <th width="15%" bgcolor="#0066FF">Detalhes</th>
		        <th width="15%" bgcolor="#0066FF">Chamado</th>
		        <th width="50%%" bgcolor="#0066FF">Descri&ccedil;&atilde;o</th>
		        <th width="14%" bgcolor="#0066FF">Abertura</th>
		        <th width="7%" bgcolor="#0066FF">Abertos</th>
		        <th width="13%" bgcolor="#0066FF">Encerrados</th>
		        <th width="9%" bgcolor="#0066FF">Total</th>
		        <th width="8%" align="right" bgcolor="#0066FF">Progresso</th>
	          </tr>
		      <tbody>
		        <?
	$somaTempo = 0;

	$sql = "select id_chamado, dataa, descricao,  ";
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and (status = 2 or status = 3)  ) as abertos, ";
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and not (status = 2 or status = 3) ) as encerrados ";
	$sql .= "from chamado where id_chamado = $id_projeto";
//		$sql = "select id_chamado, dataa, descricao, (select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado) chamados from chamado where status = 2 and rnc = 4 and id_chamado > 0 order by dataa desc";
		$result = mysql_query($sql);
		while ($linha = mysql_fetch_object($result)) {
			$data = dataOk($linha->dataa);

			$abertos = $linha->abertos;
			$fechados = $linha->encerrados;
			$total = $abertos + $fechados;



			if ($total != 0)
			{
				$Completo = 100 * ($fechados / $total);
			} else {
				$Completo = 0;
			}

			$Completo = number_format( $Completo, 2 );

			// join("/", array_reverse( explode("-", $linha->dataa) ))
?>
		        <!--
				<tr onclick="vai('<?= $linha->id_chamado?>')"
				class="normalRow"
				onmouseover="this.className='highlightRow'"
				onmouseout="this.className='normalRow'">
-->
		        <tr class="normalRow" >
		          <td align="center"><a href="#" onclick="vai('<?= $linha->id_chamado?>')">Detalhes</a></td>
		          <td align="center"><?= $linha->id_chamado?></td>
		          <td ><?= $linha->descricao?></td>
		          <td align="center"><?= $data ?></td>
		          <td align="center"><?= $abertos ?></td>
		          <td align="center"><?= $fechados ?></td>
		          <td align="center"><?= $total ?></td>
		          <td ><div class="meter-wrap">
		            <div class="meter-value" style="background-color: #09C; width: <?= $Completo ?>%;">
		              <div class="meter-text">
		                <?= $Completo ?>
		                % </div>
	                </div>
		            </div></td>
	            </tr>
		        <?
		}
?>
	          </tbody>
	        </table>
            <br />
			<br />




        <div align="center">        		    <p>Chamados de : <strong><?=$nome?></strong></p></div>
		<div Class="Lista" id="Lista">
		  <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" summary="Lista os projetos da Datamace">
		    <tr>
		      <th width="13%" bgcolor="#0066FF">Chamado</th>
              <th width="70%" bgcolor="#0066FF">Descri��o</th>
              <th bgcolor="#0066FF">Tempo usu&aacute;rio</th>
              <th bgcolor="#0066FF">Tempo  chamado</th>

            </tr>
			<tbody>
<?

	$conta = 0;
	$contaGpz = 0;
	$sql = "select id_chamado, left(descricao, 200) d, prioridade_id  from chamado inner join usuario u on u.id_usuario = chamado.destinatario_id where chamado_pai_id = $id_projeto and (status = 2 or status = 3)  and destinatario_id = $id_destinatario";

		$result = mysql_query($sql);
		while ($linha = mysql_fetch_object($result)) {
			$conta++;

			if (   (strpos($linha->d, "GPZ") > 0) || (strpos($linha->d, "PEX") > 0)  )
			{
				$contaGpz++;
			}

			$sqlTempoTotal = "select sum(time_to_sec(co.horae)-time_to_sec(co.horaa)) tempo from chamado ch  inner join contato co on co.chamado_id = ch.id_chamado where co.consultor_id = $id_destinatario and ch.id_chamado = $linha->id_chamado" ;
			$result1 = mysql_query($sqlTempoTotal) or die($sqlTempoTotal);
			$linha1=mysql_fetch_object($result1);
			$TempoTotalUser = $linha1->tempo;
			$somaTempoUser += $TempoTotalUser;

			$sqlTempoTotal = "select sum(time_to_sec(co.horae)-time_to_sec(co.horaa)) tempo from chamado ch  inner join contato co on co.chamado_id = ch.id_chamado where ch.id_chamado = $linha->id_chamado" ;
			$result1 = mysql_query($sqlTempoTotal) or die($sqlTempoTotal);
			$linha1=mysql_fetch_object($result1);
			$TempoTotalChamado = $linha1->tempo;
			$somaTempoChamado += $TempoTotalChamado;


			$Negrito = ($linha->prioridade_id == 7);

			$restricoes = funcoesObterStatusRestricao($linha->id_chamado);



?>

              <tr class="normalRow" >
              <td align="center"><a href="../historicochamado.php?id_chamado=<?=$linha->id_chamado?>" target="_blank"><?=$linha->id_chamado?></a></td>
              <td align="left">
		        <?if($Negrito==1) { echo "<b>"; }?>
				  <?= str_replace("<br>", " - ", $linha->d )?>
			    <?if($Negrito==1) { echo "</b>"; }?>
				<div>
					<?=$restricoes["display"];?>
				</div>
			  </td>
              <td align="center"><?=sec_to_time($TempoTotalUser)?></td>
              <td align="center"><?=sec_to_time($TempoTotalChamado)?></td>
              </tr>

<?

		}
?>
              <tr class="normalRow" >
                <td align="center">Total </td>
                <td > &nbsp;&nbsp;<?=$conta?>  Chamados.....   (<?=$contaGpz?>) Especiais</td>
                <td align="center"> <?=sec_to_time($somaTempoUser)?></td>
                <td align="center"> <?=sec_to_time($somaTempoChamado)?></td>
              </tr>
		   </tbody>
          </table>

          <p><br />

          </p>

          <table width="65%" border="0" align="center" cellpadding="1" cellspacing="1">
            <tr>
              <td>Chamados que o usuário <?=$nome?> está trabalhando <b>hoje</b>: </td>
            </tr>
          </table>

          <table width="65%" border="0" align="center" cellpadding="1" cellspacing="1">
<?

	$sql = "select id_chamado, hora from contato_temp where data = '$Data_Atual' and id_usuario = $id_destinatario order by hora";
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_array($result)) {
?>
            <tr>
              <td>
<?
		echo "<a href=\"../historicochamado.php?id_chamado="
		  . $linha["id_chamado"]
		  . "\" target=\"_blank\"><?=$linha->id_chamado?>"
		  . $linha["id_chamado"]
		  . " </a> - Hora Inicio: "
		  . $linha["hora"];

?>
              </td>
            </tr>
<?
	}
?>
          </table>


<!--  Ainda n�o estou mostrando os chamados encerrados.

		<div Class="Titulo">
		  <div align="center"><br />
	      Projetos encerrados</div>
		</div>
		  <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" summary="Lista os projetos da Datamace">
		    <tr>
              <th width="14%" bgcolor="#FFFFFF">Chamado</th>
		      <th width="64%" bgcolor="#FFFFFF">Descri&ccedil;&atilde;o</th>
		      <th width="22%" bgcolor="#FFFFFF">Data</th>
	        </tr>

<?
		$sql = "select id_chamado, dataa, descricao, status from chamado where status = 1 and rnc = 4 and id_chamado > 0 order by dataa desc";
		$result = mysql_query($sql);
		while ($linha = mysql_fetch_object($result)) {
			$data = dataOk($linha->dataa);
			// join("/", array_reverse( explode("-", $linha->dataa) ))
?>
            <tr onclick="vai('<?= $linha->id_chamado?>')">
              <td align="center" bgcolor="#FFFFFF"><?= $linha->id_chamado?></td>
              <td bgcolor="#FFFFFF"><?= $linha->descricao?></td>
              <td align="center" bgcolor="#FFFFFF"><?= $data ?></td>
            </tr>
<?
		}
?>
          </table>
		  -->
		</div>
	</div>
</body>
</html>
<script>
	function vai(id) {
		window.location = "projeto.php?id_chamado=" + id;
	}
</script>