<?

	$anoAtual = date("Y");
    $anofim = date("Y", time()-( 86400*30*0 ) );  
    $mesfim = date("m", time()-( 86400*30*0 ) );  
	
    $anoinicio = date("Y", time()-( 86400*30*0 ) );  
    $mesinicio = date("m", time()-( 86400*30*0 ) );  
	
	if (!isset($datai)) {
		
		$di = date("d/m/Y");		
		$df = date("d/m/Y");
		
		
		
	}else{
		$di = $datai;	
		$df = $dataf;
	}
	

	

	$user = "sad";
	$pwd = "data1371";
	$base = "sad";
	$link = mysql_connect($host, $user, $pwd) or die(mysql_error());
	mysql_select_db($base) or die(mysql_error());			

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">

	.zebra { 
		background-color: #dddddd;
	}	


	.a {
		color: #00F;
	}
</style>
</head>

<body>
<p>Selecione a refer&ecirc;ncia</p>
<form id="form1" name="form1" method="post" action="estatisticas.php">

    <p>
      <input name="mesinicio" type="hidden" id="mesinicio" value="<?=$mesinicio?>" />
      <input name="anoinicio" type="hidden" id="mesinicio" value="<?=$inicioinicio?>" />
    </p>
    <p>De
      <label>
        <input name="datai" type="text" class="bordaTexto" id="datai" onkeypress="fdata(this)" value="<?=$di?>" size="12" maxlength="10" />
        at&eacute;
  <input name="dataf" type="text" class="bordaTexto" id="dataf" onkeypress="fdata(this)" value="<?=$df?>" size="12" maxlength="10" />
      </label>
      <input type="submit" name="Submit" value="Submit" />
  </p>
</form>
<br />

<div>
        
        <?
			$sql = "Select distinct u.id_usuario id, u.nome nome from chamado inner join usuario u on u.id_usuario = chamado.destinatario_id 
where 

( (categoria_id in (select id_categoria from categoria where categoria like '%FUJITSU%')) or (  descricao like '%fujit%') )

and  status <> 1 and id_chamado in ( select id_chamado from chamado c where (c.chamado_pai_id in (select id_chamado from chamado c where (c.rnc = 4)))) order by u.nome";
			$result1 = mysql_query($sql) or die(mysql_error());			
			while ($linha1 = mysql_fetch_object($result1))
			{			
				$id_usuario = $linha1->id;
				$nome = $linha1->nome;				
				?>

				<fieldset>
                <legend><?="$nome"?></legend>


                
                <table width="95%" bgcolor="#CCCCCC" cellpadding="1" cellspacing="1" align="center">
                <tr class="a">
                	<td width="75%" bgcolor="#FFFFFF"><strong>Projeto</strong></td>
                	<td align="center" bgcolor="#FFFFFF"><strong>Chamados</strong></td>
                	<td align="center" bgcolor="#FFFFFF"><strong>Aguardando</strong></td>  
                	<td align="center" bgcolor="#FFFFFF"><strong>Saldo</strong></td>                                      	
                </tr>	
                
                
				<?
				
/*				$sql = "Select distinct  
       ch.chamado_pai_id ,       
       (select left(p.descricao, 75) from chamado p where p.id_chamado = ch.chamado_pai_id) descr,
       (select count(1) from chamado c1 where c1.chamado_pai_id = ch.chamado_pai_id and c1.destinatario_id = $id_usuario and c1.status <> 1 ) as Chamados,
       (select count(1) from chamado c1 where c1.chamado_pai_id = ch.chamado_pai_id and c1.destinatario_id = $id_usuario and c1.prioridade_id = 7 and c1.status <> 1) as Aguardando,
       (select count(1) from chamado c1 where c1.chamado_pai_id = ch.chamado_pai_id and c1.destinatario_id = $id_usuario and c1.prioridade_id <> 7 and c1.status <> 1) as Saldo

from chamado ch
       inner join usuario u on u.id_usuario = ch.consultor_id 
where      
	ch.categoria_id in (select id_categoria from categoria where categoria like '%FUJITSU%') and
	ch.status <> 1 and 
  ch.status <> 1 and
  ch.destinatario_id = $id_usuario and
  ch.id_chamado in ( select id_chamado from chamado c3 where (c3.chamado_pai_id in (select id_chamado from chamado c2 where (c2.rnc = 4))))                 
order by Descr";*/

	$sql = "Select 
       ch.id_chamado,   
       left(ch.descricao, 75) descr,
       (select count(1) from chamado c1 where c1.chamado_pai_id = ch.id_chamado and c1.destinatario_id = $id_usuario and c1.status <> 1 ) as Chamados,
       (select count(1) from chamado c1 where c1.chamado_pai_id = ch.id_chamado and c1.destinatario_id = $id_usuario and c1.prioridade_id = 7 and c1.status <> 1) as Aguardando,
       (select count(1) from chamado c1 where c1.chamado_pai_id = ch.id_chamado and c1.destinatario_id = $id_usuario and c1.prioridade_id <> 7 and c1.status <> 1) as Saldo
from chamado ch
       inner join usuario u on u.id_usuario = ch.destinatario_id 
where      
  rnc = 4   
  and ( (ch.categoria_id in (select id_categoria from categoria where categoria like '%FUJITSU%')) or (  ch.descricao like '%fujit%') )
  and (  (select count(1) from chamado c1 where c1.chamado_pai_id = ch.id_chamado and c1.destinatario_id = $id_usuario and c1.status <> 1 ) > 0  ) 
order by descr";

					$sChamados = 0;
					$sAguardando = 0;
					$sSaldo = 0;


				$result2 = mysql_query($sql) or die(mysql_error());			
				while ($linha2 = mysql_fetch_object($result2))				
				{
					$Descricao = $linha2->descr;					
					$Descricao = str_replace('<br>', ' - ', $Descricao);
					$sChamados += $linha2->Chamados;
					$sAguardando += $linha2->Aguardando;
					$sSaldo += $linha2->Saldo;
			        $chamado_id = $linha2->id_chamado;
        ?>
        	<tr>
            </a>
            <td width="75%" bgcolor="#FFFFFF">[<a href ="../../projetos/ChamadosProjetoUsuario.php?id_destinatario=<?=$id_usuario?>&id_projeto=<?=$chamado_id?>&nome=<?=$nome?>">			<?=$chamado_id?></a>] <?=$Descricao?>            
            </td>
            <td align="center" bgcolor="#FFFFFF"><?=$linha2->Chamados?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$linha2->Aguardando?></td>
            <td align="center" bgcolor="#FFFFFF"><?=$linha2->Saldo?></td>
            </tr>
        <?
			   }
		?>			   
        	<tr>
            <td width="50%" bgcolor="#FFFFFF"><strong>Total</strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>
            <?=$sChamados?>
            </strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>
            <?=$sAguardando?>
            </strong></td>
            <td align="center" bgcolor="#FFFFFF"><strong>
            <?=$sSaldo?>
            </strong></td>
            </tr>

				   </table>
                   </fieldset>
                <br /><br />           
		<?               
			}
        ?>    
            
</div>

<script>
	document.form1.mesinicio.value = <?=$mesinicio?>;
	document.form1.anoinicio.value = <?=$anoinicio?>;
	document.form1.mesfim.value = <?=$mesfim?>;
	document.form1.anofim.value = <?=$anofim?>;
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
	$("table").attr("border", "0");
	$("tr:odd").addClass('zebra');	
	$("tr:odd").addClass('zebra');		
	$("th").css({"color": "blue"});		
});
</script>

</body>
</html>

