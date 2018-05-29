<?php require_once('../Connections/sad.php'); ?>
<?php require_once('../a/scripts/classes.php'); ?>
<?php require_once('../a/scripts/conn.php'); ?>
<?php require_once('../a/scripts/chamado_pesquisa.php'); ?>
<?	
	$pesquisa = obterPesquisaPorGuid($id);
	
	$Dt_Atendimento = amd2dma($pesquisa->dt_criacao);
	$Hr_Atendimento = $pesquisa->hr_criacao;
	
	$Dt_Resposta = amd2dma($pesquisa->dt_resposta) . " " . $pesquisa->hr_resposta;
	
	$Chamado = $pesquisa->id_chamado;
	$Solucionado = $pesquisa->ic_solucionado;
	$Nota = $pesquisa->vl_nota;	
	$Nome = $pesquisa->nome;	

?>
<html>
  <head>
    <title>Pesquisa Datamace</title>	

<!--
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>  
    <link href="css/bootstrap.min.css" rel="stylesheet">    
 -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link href="css/style.css" rel="stylesheet">
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

  
    
	<div class="row">
		<div class="col-md-12">
			
          <h3><br/><br/>Pesquisa de satisfa&ccedil;&atilde;o - chamado <strong><?=$Chamado?></strong>
          aberto em <?= "$Dt_Atendimento $Hr_Atendimento"?> por <?=$Nome?><br>
		    </h3>		
            <h4><blockquote><i><?=trim($pesquisa->descricao)?></i><blockquote></h4>                                   
				Por favor responda:<br>	            
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<form role="form" method="post" name="form1" action="doPesquisa.php">
			  <input type="hidden" name="id" value="<?=$id?>">
				<br/>
				<div class="form-group">					 					
					<label for="exampleInputEmail1">
						Seu problema foi solucionado ?
					</label>

					<div class="radio">
					<label>
                     <input type="radio" id="Solucionado" value="S" name="Solucionado" <? if ("S" == $Solucionado) {echo "checked='checked'";} ?>>Sim
					 </label>
					</div>
					<div class="radio">
					<label><input type="radio" id="Solucionado" value="N" name="Solucionado" <? if ("N" == $Solucionado) {echo "checked='checked'";}   ?> >N&atilde;o</label>
					</div>
                    <div class='SolucionadoValidation' style="color:#BF3134;"></div>   
				</div>

				<br/>

					<label for="exampleInputEmail1">
						D&ecirc; uma nota para o atendimento recebido. Sendo 1 para totalmente insatisfeito e 5 para totalmente satisfeito
					</label>
				<br/><br/>
				<div class="form-group">					 					
					<? for ($i=1; $i<=5; $i++) {?>

                    <div class="radio-inline">
					  <label><input type="radio" id="nota" value="<?=$i?>" name="nota" <? if ("$i" == "$Nota") {echo "checked='checked'";} ?>><?=$i?></label></div>                                       
					<? } ?>                                        
                    <div class='notaValidation' style="color:#BF3134;"></div>   
				</div>
<? if ("" == $Solucionado) { ?>
			  <button type="button" id="enviar" class="btn btn-default" >
					Enviar Pesquisa
				</button>
<? } else { ?>
	Esta pesquisa já foi respondida em <?=$Dt_Resposta?>. Obrigado !
<? } ?>
	                
            
            
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
            
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajude a melhorar o nosso atendimento.<br>
                    Por favor, descreva abaixo o motivo de seu problema n&atilde;o ter sido solucionado e/ou sua nota ficar abaixo de 4.</h4>
                  </div>
                  <div class="modal-body">
                  
                  
                    <label>
	                    <textarea name="Texto" id="Texto" cols="60" rows="5" autofocus></textarea>
                    </label>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal" >Fechar</button>                                      
                    <button type="button" class="btn btn-default" onClick="vai();">Enviar</button>
                  </div>
                </div>
            
              </div>
            </div> 

			</form>
		</div>
	</div>






    
    <img src="../Logo30Anos.png" width="197" height="100">
    
	<div class="row">
		<div class="col-md-12">
        
        			<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="#"></a>
					  </li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					</ul>
				</div>
				
			</nav>
        
        
        
						
		</div>
	</div>
</div>





</body>
    
<script>

	function vai() {
		    var retorno = true;


		
						
			$('.SolucionadoValidation').text("");
			$('.notaValidation').text("");
			
			var solucionado = $("input[name='Solucionado']:checked").val()
			var nota = $("input[name='nota']:checked").val()
			var TextRequired = (solucionado == "N") || (nota <= 3);
									
			
            if ($("#Solucionado:checked").length == 0)
			{
                $('.SolucionadoValidation').text("Por favor responda, Seu problema foi solucionado ?");
				TextRequired = false;
                retorno = false;
            }
			
			
			
			
            if ($("#nota:checked").length == 0)
			{
                $('.notaValidation').text("Por favor, Dê uma nota para o atendimento recebido");
				TextRequired = false;				
				retorno = false;
            }
			
			if(TextRequired)
			{			
			
				var Texto = $("#Texto").val();			
				
				if (Texto == "") {			
					retorno = false;
					$("#Texto").show().focus();					
					$("#myModal").modal();
				} else {
					retorno = true;
					$("#myModal").modal('hide');
				}

			}
			
			if (retorno)
				retorno = window.confirm("Enviar pesquisa ?");
			
			if (retorno==true)
				document.form1.submit();				
	}

    $(document).ready(function () {
		$('#enviar').click(function(){
			vai();														
		});
    });
</script>  

</html>