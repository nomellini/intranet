<?
	include_once("../scripts/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/jscript" src="../../scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/sad.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Projetos</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.Body #Lista table tr th {
	color: #FFF;
}
</style>
</head>
<body>

<?
	$status_a = "(status = 2 or status = 3)";

	$status= "(status = 2 or status = 3)";
	$_link = "index.php?encerrados=1";
	$_textoa = "encerrados";
	$_textob = "em aberto";	
	if ($encerrados ==1) {
		$status_a = "(status = 1)";
		$_link = "index.php?encerrados=0";
		$_textoa = "abertos";
		$_textob = "encerrados";	
	}
?>

	<div class="Body">
		<div Class="Titulo">
		  <div align="center">Projetos <?=$_textob?> - ver <a href="<?=$_link?>"><?=$_textoa?></a><br />
		    <br />
		  </div>
		</div>
		
Filtrar:<label for="textfield"></label>  
<input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filtraTabela(this, 'sf', 1)" /><br /><br />		
		
		<div Class="Lista" id="Lista">
		  <table width="95%" 
		  id='sf'
		  border="0" 
		  align="center" 
		  cellpadding="1" 
		  cellspacing="1" 
		  bgcolor="#CCCCCC" summary="Lista os projetos da Datamace">
		    <tr>
		      <th width="15%" bgcolor="#0066FF">Destinatários</th>
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

	$somaTempo = 0;
	$somaAbertos = 0;
	$somaEncerrados = 0;
	$somaTotal = 0;
			
	$sql = "select id_chamado, dataa, descricao,  ";
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and $status and prioridade_id = 3) as urgentissimo, ";	
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and $status and prioridade_id = 2) as urgente, ";	
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and $status and prioridade_id = 1) as normal, ";	
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and $status and prioridade_id > 3) as outros, ";				
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and $status) as abertos, ";
	$sql .= "(select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado and not $status) as encerrados ";
	$sql .= "from chamado where $status_a and rnc = 4 and id_chamado > 0 order by dataa desc ";
//		$sql = "select id_chamado, dataa, descricao, (select count(1) from chamado c1 where chamado_pai_id = chamado.id_chamado) chamados from chamado where status = 2 and rnc = 4 and id_chamado > 0 order by dataa desc";	
		$result = mysql_query($sql);
		
		while ($linha = mysql_fetch_object($result)) {
			
			

			$sqlTempoTotal = "select sum(time_to_sec(co.horae)-time_to_sec(co.horaa)) tempo from chamado ch  inner join contato co on co.chamado_id = ch.id_chamado where chamado_pai_id = $linha->id_chamado or (id_chamado=$linha->id_chamado)";
			$result1 = mysql_query($sqlTempoTotal); $linha1=mysql_fetch_object($result1);
			$TempoTotal = $linha1->tempo;
			$somaTempo += $TempoTotal;
			
			$data = dataOk($linha->dataa);
			
			
			$urgentissimo = $linha->urgentissimo;
			$urgente = $linha->urgente;
			$normal = $linha->normal;
			$outros = $linha->outros;
			
			$prioridades = "Urgentissimos: $urgentissimo
Urgentes: $urgente
Normal: $normal
Outros: $outros";
			
			$abertos = $linha->abertos;			
			$somaAbertos += $abertos;
			
			$fechados = $linha->encerrados;
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
			
			// join("/", array_reverse( explode("-", $linha->dataa) ))
?>			
<!--            
				<tr onclick="vai('<?= $linha->id_chamado?>')" 
				class="normalRow" 
				onmouseover="this.className='highlightRow'" 
				onmouseout="this.className='normalRow'">
-->
              <tr class="normalRow" >
                <td align="center"><a href="ChamadosProjeto.php?id_projeto=<?= $linha->id_chamado?>">Destinatários</a></td>
                <td align="center"><a href="#" onclick="vai('<?= $linha->id_chamado?>')">Detalhes</a></td>
              <td align="center"><?= $linha->id_chamado?></td>
              <td ><?= $linha->descricao?></td>
              <td align="center"><?= $data ?></td>
              <td align="center">
				<a href="#" onclick="abertos('<?= $linha->id_chamado?>')">		  
				  <abbr title="<?=$prioridades?>">				  
				  	<?= $abertos ?>			  
				  </abbr>
				</a>
			  </td>              
              <td align="center"><?= $fechados ?></td>
              <td align="center"><?= $total ?></td>              
              <td >			  			  
                <div class="meter-wrap">
                    <div class="meter-value" style="background-color: #09C; width: <?= $Completo ?>%;">
                        <div class="meter-text">
			              <?= $Completo ?>%                        </div>
                    </div>
                </div>              			  			                              			  			                
              </td>                            
			  <td align="center"><?= sec_to_time($TempoTotal)?></td>              	
            </tr>
<?
		}
		
			if ($somaTotal != 0) 
			{
				$Completo = 100 * ($somaEncerrados / $somaTotal);
			} else {
				$Completo = 0;
			}
			
			$Completo = number_format( $Completo, 2 );
?>		
              <tr class="normalRow" >
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td >&nbsp;</td>
              <td align="center">Totais</td>
              <td align="center"><?= $somaAbertos?></td>              
              <td align="center"><?= $somaEncerrados ?></td>
              <td align="center"><?= $somaTotal ?></td>              
              <td >
                 <div class="meter-wrap">
                    <div class="meter-value" style="background-color: #09C; width: <?= $Completo ?>%;">
                        <div class="meter-text">
			              <?= $Completo ?>%                        </div>
                    </div>
                </div>              			  			                              			  			
              
              </td>                            
			  <td align="center"><?= sec_to_time($somaTempo) ?></td>              	
            </tr>
		   </tbody>
          </table>
		  <p>&nbsp;</p>
		  <p>&nbsp;</p>
<!--  Ainda não estou mostrando os chamados encerrados.
	  
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

	function abertos(id) {
		window.location = "projeto.php?abertos=1&id_chamado=" + id;
	}

	
	$('textfield').keyup();

</script>