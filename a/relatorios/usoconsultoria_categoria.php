<?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
?>
<html>
<head>
<script>
function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}
</script>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div align="center">
 Categoria de D&uacute;vida na opera&ccedil;&atilde;o das 10 empresas que mais usam a consultoria </div>
  <form name="form1" method="post" action="">
    <table width="619" border="1">
      <tr>
        <td width="139">Per&iacute;odo de consulta </td>
        <td width="464">De 
          <label>
          <input name="datai" type="text" class="bordaTexto" id="datai" onKeyPress="fdata(this)" value="<?=$datai?>">
		  
        at&eacute; 
        <input name="dataf" type="text" class="bordaTexto" id="dataf" onKeyPress="fdata(this)" value="<?=$dataf?>">
        </label></td>
      </tr>
      <tr>
        <td>Tipo de cliente </td>
        <td><label>
          <input <?php if (!(strcmp($bloqueado,"A"))) {echo "checked=\"checked\"";} ?> name="bloqueado" type="radio" value="A" checked>
        ATIVOS
        <input <?php if (!(strcmp($bloqueado,"I"))) {echo "checked=\"checked\"";} ?> name="bloqueado" type="radio" value="I">
        INATIVOS
        <input <?php if (!(strcmp($bloqueado,"X"))) {echo "checked=\"checked\"";} ?> name="bloqueado" type="radio" value="X">
        AMBOS</label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="btnPesquisar" type="submit" class="bordaTexto" id="btnPesquisar" value="Pesquisar">
          <input name="action" type="hidden" id="action" value="pesquisar">
        </label></td>
      </tr>
    </table>
  </form>
  <div align="left">
<?php	

  if (true)  {


	$quando = explode("/", $datai);
	$datai = "$quando[2]-$quando[1]-$quando[0]";
	$quando = explode("/", $dataf);
	$dataf = "$quando[2]-$quando[1]-$quando[0]";

	if ($bloqueado == "A") {
			$bl = "cliente.bloqueio <> 1 and ";
	} else if ($bloqueado == "I") {
		$bl = "cliente.bloqueio = 1  and ";
	} else {
		$bl = "";
	}
	  	
  $sql = "select
  cliente_id, cliente.cliente,
  count(*) as q
from
  chamado
    left join cliente on
      cliente.id_cliente = chamado.cliente_id
where 
  $bl 
  (chamado.visible = 1) and   
  cliente_id <> 'DATAMACE' and
  dataa >= '$datai' and
  dataa <= '$dataf'
group by
  cliente_id, cliente.cliente
order by q desc limit 10";
  $clientes = "";
  $resultA = mysql_query($sql) or die (mysql_error());
  while ($linhaA = mysql_fetch_object($resultA)) {
  	$clientes .= "'" . $linhaA->cliente_id . "', ";
  }
  $clientes .= "''";
 // die ($clientes);
 
 
  $sql = " 
select
  ca.categoria,
  ca.id_categoria,
  count(*) as q
from
  chamado ch
    left join motivo mo on mo.id_motivo = ch.motivo_id
    left join categoria ca on ca.id_categoria = ch.categoria_id
where
    ch.motivo_id = 1 and
    ch.cliente_id in ( $clientes ) and
    dataa >= '$datai' and
    dataa <= '$dataf'
group by
  categoria,
  id_categoria
order by
  q desc
limit 20
";

  $resultA = mysql_query($sql) or die (mysql_error());
?>
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
<?

  while ($linhaA = mysql_fetch_object($resultA)) {

	$lDuvida = 0;  
	$lResultado = 0;  
	$lErro = 0;  
	$lOutros = 0;  
	$lTotal = 0;

$sqlB = "
select
  ch.cliente_id,
  cl.cliente,  
  count(*) as q
from
  chamado ch
    left join motivo mo on mo.id_motivo = ch.motivo_id
    left join categoria ca on ca.id_categoria = ch.categoria_id
    left join cliente cl on cl.id_cliente = ch.cliente_id
where
    ch.motivo_id = 1 and
    ch.cliente_id in ( $clientes ) and
    dataa >= '$datai' and
    dataa <= '$dataf'
    and ca.id_categoria = $linhaA->id_categoria
group by
  categoria,
  id_categoria,
  ch.cliente_id
order by
  q desc";

// die ($sqlB);  
  $resultB = mysql_query($sqlB);
  
?>
    <tr>
      <td>
        <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="43%" bgcolor="#FFFFFF">Categoria: <span class="style3">
            <?= $linhaA->categoria?>
            </span></td>
            <td width="57%" bgcolor="#FFFFFF">Quantidade: <?= $linhaA->q?></td>
          </tr>
        </table>
	 </td>
    </tr>
    <tr>
      <td>
        <table width="96%" border="0" align="right" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
		  	<?php  while ($linhaB = mysql_fetch_object($resultB) ) { 
			
			
				$sqlC = "select ch.id_chamado from chamado ch left join motivo mo on mo.id_motivo = ch.motivo_id left join categoria ca on ca.id_categoria = ch.categoria_id left join cliente cl on cl.id_cliente = ch.cliente_id where ch.motivo_id = 1 and ch.cliente_id = '$linhaB->cliente_id' and dataa >= '$datai' and dataa <= '$dataf' and ca.id_categoria = $linhaA->id_categoria order by ch.id_chamado";

				$resultC = mysql_query($sqlC);
				$NumeroDosChamados = '';
				while ($linhaC = mysql_fetch_object($resultC) ) { 
					$NumeroDosChamados = $NumeroDosChamados . '[<a href="../historicochamado.php?id_chamado='.$linhaC->id_chamado.'" target=_blank>';
					$NumeroDosChamados = $NumeroDosChamados . $linhaC->id_chamado . '</a>] ';
				}			
			?>
	          <tr>			
            <td width="43%" bgcolor="#FFFFFF">
			(<?= $linhaB->q?>) - <?= $linhaB->cliente?> :: <?= $NumeroDosChamados?>
			</td>
	      </tr>				
			<?php } ?>		
    
        </table>
	 </td>
    </tr>
	
<?php
  }
?>
  </table>
  <hr>
  </p>
  <?
	    } // Fim if (action = pesquiar)
	  ?>
  </blockquote>
  </div>
  </div>
</body>
</html>
