<?
	include_once("../scripts/conn.php");
	include_once("../scripts/funcoes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/jscript" src="../../scripts/jquery-1.4.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Destinat&aacute;rios do projeto</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.meter-wrap{
    position: relative;
}

.meter-wrap, .meter-value, .meter-text {
    /* The width and height of your image */
    width: 155px; height: 30px;
}

.meter-wrap, .meter-value {
    background: #bdbdbd url(meter-outline.png) top left no-repeat;
}

.meter-text {
    position: absolute;
    top:0; left:0;

    padding-top: 5px;

    color: #00;
    text-align: center;
	font-weight:bold;
    width: 100%;
}


.Body #Lista table tr th {
	color: #FFF;
}
</style>
</head>
<body>
	<div class="Body">
		<div Class="Titulo">
		  <div align="center">
		    <p>Chamados em abertos do projeto:<br /><?= FuncoesObterDescricaoChamado($id_projeto) ?><br />
		    </p>
            		<div Class="Lista" id="Lista">
            </div>
		    <p><br />
	        </p>
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
		        <th width="8%" align="right" bgcolor="#0066FF">Tempo</th>
	          </tr>
		      <tbody>
		        <?

	$sql = "select id_chamado, dataa, descricao,  ";
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and (status = 2 or status = 3) ) as abertos, ";
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

		        <tr class="normalRow" >
		          <td align="center"><a href="#" onclick="vai('<?= $linha->id_chamado?>')">Detalhes</a></td>
		          <td align="center"><?= $linha->id_chamado?></td>
		          <td ><?= $linha->descricao?></td>
		          <td align="center"><?= $data ?></td>
		          <td align="center"><?= $abertos ?></td>
		          <td align="center"><?= $fechados ?></td>
		          <td align="center"><?= $total ?></td>
		          <td >
                  <div class="meter-wrap">
		            <div class="meter-value" style="background-color: #09C; width: <?= $Completo ?>%;">
		              <div class="meter-text">
		                <?= $Completo ?>% </div>
	                </div>
		            </div>
                    </td>
		          <td >&nbsp;</td>
	            </tr>
		        <?
		}
?>
	          </tbody>
	        </table>
<br />
<br />


		<div Class="Lista" id="Lista">
		  <table width="650" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" summary="Lista os projetos da Datamace">
		    <tr>
		      <th width="15%" bgcolor="#0066FF">Detalhes</th>
              <th width="50%" bgcolor="#0066FF">Nome Destinat&aacute;rio</th>
		      <th width="14%" bgcolor="#0066FF">Chamados em aberto</th>
		      <th width="14%" bgcolor="#0066FF">Tempo do usu&aacute;rio</th>
		      <th width="14%" bgcolor="#0066FF">Tempo Chamados </th>
            </tr>
			<tbody>
<?
	$somaTempo = 0;
	$sql = "select u.id_usuario, u.nome, count(1) qtde ";
	$sql .= "from chamado inner join usuario u on u.id_usuario = chamado.destinatario_id  ";
	$sql .= "where chamado_pai_id = $id_projeto and (status = 2 or status = 3) group by u.nome, u.id_usuario ";
		$result = mysql_query($sql);
		$soma = 0;
		while ($linha = mysql_fetch_object($result)) {



			$Id_Usuario = $linha->id_usuario;
			$qtde = $linha->qtde;
			$soma += $qtde;


			$sqlTempoTotal = "select sum(time_to_sec(co.horae)-time_to_sec(co.horaa)) tempo from chamado ch  inner join contato co on co.chamado_id = ch.id_chamado where ch.destinatario_id = $Id_Usuario and chamado_pai_id = $id_projeto and co.consultor_id = $Id_Usuario and (ch.status = 2 or ch.status = 3) " ;
			$result1 = mysql_query($sqlTempoTotal) or die($sqlTempoTotal);
			$linha1=mysql_fetch_object($result1);
			$TempoTotalUser = $linha1->tempo;
			$somaTempoUser += $TempoTotalUser;

			$sqlTempoTotal = "select sum(time_to_sec(co.horae)-time_to_sec(co.horaa)) tempo from chamado ch  inner join contato co on co.chamado_id = ch.id_chamado where ch.destinatario_id = $Id_Usuario and chamado_pai_id = $id_projeto and (ch.status = 2 or ch.status = 3) " ;
			$result1 = mysql_query($sqlTempoTotal) or die($sqlTempoTotal);
			$linha1=mysql_fetch_object($result1);
			$TempoTotalChamado = $linha1->tempo;
			$somaTempoChamado += $TempoTotalChamado;



?>
<!--
				<tr onclick="vai('<?= $linha->id_chamado?>')"
				class="normalRow"
				onmouseover="this.className='highlightRow'"
				onmouseout="this.className='normalRow'">
-->
              <tr class="normalRow" >
                <td align="center"><a href="ChamadosProjetoUsuario.php?id_destinatario=<?=$Id_Usuario?>&amp;id_projeto=<?= $id_projeto?>&nome=<?= $linha->nome?>">Chamados</a></td>
              <td ><?= $linha->nome?></td>
              <td align="center"><?= $qtde ?>

              </td>
              <td align="center"><?= sec_to_time($TempoTotalUser)?></td>
              <td align="center"><?= sec_to_time($TempoTotalChamado)?></td>
              </tr>
<?
		}
?>
              <tr class="normalRow" >
                <td colspan="2" align="center">Total de chamados em aberto</td>
                <td align="center"><?= $soma ?></td>
                <td align="center"><?= sec_to_time($somaTempoUser)?></td>
                <td align="center"><?= sec_to_time($somaTempoChamado)?></td>
              </tr>

		   </tbody>
          </table>
<br />
<br />


		  <table width="650" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" >
		  						<thead>
		    <tr>
		      <th width="15%" bgcolor="#0066FF">Detalhes</th>
              <th width="50%" bgcolor="#0066FF">Restri��o</th>
		      <th width="14%" bgcolor="#0066FF">Chamados em aberto</th>
            </tr>
						<thead/>
			<tbody>

<?
	$sql = "select
  r.id, r.Ds_Descricao, count(1) q
from
     chamado c
       left join rl_restricao_chamado rc on rc.Id_Chamado = c.id_chamado
       left join restricoes r on r.Id = rc.Id_Restricao
where chamado_pai_id = $id_projeto and (status = 2 or status = 3)
group by
  r.id, r.Ds_Descricao
order by Ds_Descricao";
		$result = mysql_query($sql);
		$soma = 0;
		while ($linha = mysql_fetch_object($result)) {
			$Id = $linha->id;
			if(!$Id)
			{
				$Id =0 ;
			}
			$desc = $linha->Ds_Descricao;
			$qtde = $linha->q;
			if ($desc=="")	{
				$desc = "Sem restri��o";
			}
			$class = "normalRow";
			if ($Id == $Id_Restricao)
			{
				$class = "";
			}
?>
              <tr class="<?=$class?>" >
                <td align="center"><a href="?id_projeto=<?=$id_projeto?>&Id_Restricao=<?=$Id?>">Chamados</a></td>
              <td ><?=$desc?></td>
              <td align="center"><?= $qtde ?></td>
              </tr>
<?
		}
?>
			</tbody>
		  </table>
          <br />
          <br />

		  <table width="650" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" >
		  						<thead>
		    <tr>
		      <th width="5%" bgcolor="#0066FF">Chamado</th>
              <th width="20%" bgcolor="#0066FF">Destinatario</th>
		      <th width="75%" bgcolor="#0066FF">Descri��o</th>
            </tr>
						<thead/>
			<tbody>

<?
	if ($Id_Restricao > 0) {
		$s = "(rc.Id_Restricao = $Id_Restricao)";
	} else {
			$s = "(rc.Id_Restricao is null)";
	}

	{
		$sql = "select
		   c.id_chamado, u.nome, left(descricao, 300) d
		from
			 chamado c
			   left join rl_restricao_chamado rc on rc.Id_Chamado = c.id_chamado
			   left join restricoes r on r.Id = rc.Id_Restricao
			   left join usuario u on u.id_usuario = c.destinatario_id
		where chamado_pai_id = $id_projeto and (status = 2 or status = 3) and $s
		order by u.nome";
		$result = mysql_query($sql);
		$soma = 0;
		while ($linha = mysql_fetch_object($result)) {
			$id_chamado = $linha->id_chamado;
			$nome = $linha->nome;
			$descricao = $linha->d;
?>
              <tr class="normalRow" ><td align="center"><?=conn_linkChamado($id_chamado)?></a></td>
              <td ><?=$nome?></td>
              <td align="left"><?= $descricao?></td>
              </tr>


<?
	}
	}
?>
			</tbody>
		  </table>


		</div>
	</div>
</body>
</html>
<script>
	function vai(id) {
		window.location = "projeto.php?id_chamado=" + id;
	}
</script>