<?php require_once('../Connections/sad.php'); ?>
<?php require("../cabeca.php"); ?>
<?php require_once('../a/scripts/chamado_pesquisa.php'); ?>
<?
	if (!$is_god)
     die("Acesso negado");
?><?
function Estatisticas($DataInicio, $DataFim)
{
	$di = DMA2AMD($DataInicio);
	$df = DMA2AMD($DataFim);
	$sql = "select 
       usuario.nome,
	   case Ic_Solucionado 
	     when 'S' then 'Sim'
		 when 'N' then 'Não'
	   end solucionado,
       avg(vl_nota) media, 
       count(vl_nota) total, 
       max(vl_nota) maximo, 
       min(vl_nota) minimo
from 
     chamado_pesquisa      
       inner join chamado c on c.id_chamado = chamado_pesquisa.id_chamado
       inner join sistema s on s.id_sistema = c.sistema_id
       inner join contato on contato.id_contato = chamado_pesquisa.id_contato
       inner join usuario on usuario.id_usuario = contato.consultor_id
where 
    date(dt_criacao) >= '$di'
and date(dt_criacao) <= '$df'
and vl_nota is not null
group by usuario.nome, Ic_Solucionado";

	$result = mysql_query($sql);	

	return $result;		
}

function SemResposta($DataInicio, $DataFim)
{
	$di = DMA2AMD($DataInicio);
	$df = DMA2AMD($DataFim);
	$sql = "select count(1) from chamado_pesquisa  
where 
    date(dt_criacao) >= '$di'
and date(dt_criacao) <= '$df'
and vl_nota is null";

	return conn_ExecuteScalar($sql);

}

?>
<?

    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}

	
	$TotalSim = 0;
	$TotalNao = 0;
	$minima = 10;
	$maxima = 1;
	
	$estatisticas = Estatisticas($datai, $dataf);
	
?><html>
  <head>
    <title>Pesquisa Datamace</title>	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
	  .table td,th {
		text-align: center;
      }
    </style>
    
    <script type="text/javascript" src="../scripts/loader.js"></script>

    
  </head>
  

  <body>

    <div class="container-fluid">           


    <div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
				
				<div class="navbar-header">					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="#">Datamace Inform&aacute;tica</a>
				</div>								
			</nav>
		</div>
	</div>

<br>
<br>
<br>
<h3>Resultado da pesquisa de satisfação do SAD</h3>


	<div class="row">
		<div class="col-md-12">
            <form id="form1" name="form1" method="post" >
			<div class="form-group">					 					
              <input name="mesinicio" type="hidden" id="mesinicio" value="<?=$mesinicio?>" />
               <input name="anoinicio" type="hidden" id="mesinicio" value="<?=$inicioinicio?>" />
            
            De <input name="datai" type="text" id="datai" onkeypress="fdata(this)" value="<?=$datai?>" size="12" maxlength="10" /> at&eacute;
               <input name="dataf" type="text" id="dataf" onkeypress="fdata(this)" value="<?=$dataf?>" size="12" maxlength="10" />    
			  <button type="button" id="enviar" class="btn btn-default" onClick="document.form1.submit();">
              	Ver resultados
              </button>               
             </div>
          </form>			
      </div>
    </div>

	<div class="row">
		<div class="col-md-12">        
        <hr/>
		</div>
	</div>    


	<div class="row">
		<div class="col-md-6">        
    
              <table class="table">
                <thead>
                  <tr>
                    <th>Consultor</th>
                    <th>Soluc.</th>
                    <th>Respostas</th>
                    <th>Média</th>
                  </tr>
                </thead>
                <tbody>
                <? while ($linha = mysql_fetch_object($estatisticas)) { ?>
                  <tr>
                    <td><?=$linha->nome?></td>                          
                    <td><?=$linha->solucionado?></td>        
                    <td><?=$linha->total?></td>        
                    <td><?= number_format($linha->media,2)?></td>
                  </tr>
                <? 
                        $Total += $linha->total;
                        if ($minima > $linha->minimo) $minima = $linha->minimo;
                        if ($maxima < $linha->maximo) $maxima = $linha->maximo;			
                        if ($linha->solucionado == "Sim")
                            $TotalSim += $linha->total;
                        else
                            $TotalNao += $linha->total;
                        
                    } 
                ?>          
                  <tr>
                    <td></td>        
                    <td></td>                            
                    <td><?=$Total?></td>        
                    <td></td>        
                  </tr>    
                </tbody>
              </table>
         </div>
        
        	<div class="col-md-6">        
				    <div id="piechart" style="width: 640;"></div>            
            </div>
               
     
	</div>    

		<div class="col-md-12">                
          <p><br>
            Pesquisas não respondidas : <?=SemResposta($datai, $dataf)?>
          </p>
          <p><a href="resultadopesquisa.php">Ver Global</a></p>
          <p><a href="resultadopesquisaSistema.php">Ver por Sistema</a></p>
		</div>   

	<div class="row">
		<div class="col-md-12">        
        <hr/>
		</div>
	</div>    
    
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

	var data = google.visualization.arrayToDataTable([
	  ['Solucionado', 'Resposta'],
	  ['SIM', <?=$TotalSim?>],
	  ['NAO', <?=$TotalNao?>]
	]);

	var options = {
	  title: '',

      pieStartAngle: 100
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
  }
</script>       


	
	<div class="row">
		<div class="col-md-12">        
		    <img src="../Logo30Anos.png" width="197" height="100">                
	  </div>
	</div>    
    
</div>



</body>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>    
    
<script>
    $(document).ready(function () {
        $('#enviar').click(function(){
						
																	
		    var retorno = true;
						
			$('.SolucionadoValidation').text("");
			$('.notaValidation').text("");
			
			var gender=$('#Solucionado').val();
            if ($("#Solucionado:checked").length == 0){
                $('.SolucionadoValidation').text("Por favor responda, Seu problema foi solucionado ?");
                retorno = false;
            }
			
			
			var gender=$('#nota').val();
            if ($("#nota:checked").length == 0){
                $('.notaValidation').text("Por favor, Dê uma nota para o atendimento recebido");
				retorno = false;
            }
			
			if (retorno)
				retorno = window.confirm("Enviar pesquisa ?");
			
			if (retorno==true)
				document.form1.submit();
				
        });
    });
</script>  

 
    

</html>