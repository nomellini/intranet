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
 Relatório das 10 empresas n&atilde;o bloqueadas que mais usam a consultoria
</div>
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
          <input <?php if (!(strcmp($_POST['bloqueado'],"A"))) {echo "checked=\"checked\"";} ?> name="bloqueado" type="radio" value="A" checked>
        ATIVOS
        <input <?php if (!(strcmp($_POST['bloqueado'],"I"))) {echo "checked=\"checked\"";} ?> name="bloqueado" type="radio" value="I">
        INATIVOS
        <input <?php if (!(strcmp($_POST['bloqueado'],"X"))) {echo "checked=\"checked\"";} ?> name="bloqueado" type="radio" value="X">
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

	$dataioriginal = $datai;
	$dataforiginal = $dataf;

  if ($action == "pesquisar")  {


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
  cliente_id, cliente.cliente, cliente.cidade, 
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
  cliente_id, cliente.cliente, cliente.cidade 
order by q desc limit 10";

?>
  <a href="usoconsultoria_categoria.php?ok=true&datai=<?= $dataioriginal?>&dataf=<?= $dataforiginal?>&bloqueado=<?= $bloqueado?>">Ver relat&oacute;rio detalhado de d&uacute;vida na opera&ccedil;&atilde;o</a>
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
<?
  $resultA = mysql_query($sql) or die (mysql_error());
    
	$gDuvida = 0;  
	$gResultado = 0;  
	$gErro = 0;  
	$gOutros = 0;  
	$gTotal = 0;

  while ($linhaA = mysql_fetch_object($resultA)) {

	$lDuvida = 0;  
	$lResultado = 0;  
	$lErro = 0;  
	$lOutros = 0;  
	$lTotal = 0;

    $sqlB = "
select 
  motivo, motivo_id, count(*) as q 
from 
  chamado 
    left join motivo on motivo.id_motivo = chamado.motivo_id
where 
  cliente_id = '$linhaA->cliente_id' and
  dataa >= '$datai' and
  dataa <= '$dataf'   
group by 
  motivo, motivo_id 
order by 
  q desc";
  $resultB = mysql_query($sqlB);
  while ($linhaB = mysql_fetch_object($resultB) ) {
    $valor = $linhaB->q;
    if ($linhaB->motivo_id==1) {
		$lDuvida += $valor;
	} else if ($linhaB->motivo_id==9) {
		$lResultado += $valor;
	} else if ($linhaB->motivo_id==2) {	  
		$lErro += $valor;
	} else {
		$lOutros += $valor;
	}
	$lTotal += $valor;
  } 
  

  $lpDuvida = $lDuvida / $lTotal * 100;
  $lpResultado = $lResultado / $lTotal * 100;  
  $lpErro = $lErro / $lTotal * 100;
  $lpOutros = $lOutros / $lTotal * 100;
  $lpDuvida =   number_format($lpDuvida, 2, ',', ' ');
  $lpResultado =   number_format($lpResultado, 2, ',', ' ');
  $lpErro =   number_format($lpErro, 2, ',', ' ');
  $lpOutros =   number_format($lpOutros, 2, ',', ' ');
          
  $gDuvida += $lDuvida;
  $gResultado += $lResultado;
  $gErro  += $lErro;
  $gOutros += $lOutros;
  $gTotal += $lTotal;
  
  
?>
    <tr>
      <td><br>
        <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="33%" rowspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style3">
              <?= "$linhaA->cliente <br>[$linhaA->cidade]"?>
            </span></td>
            <td width="15%" align="center" valign="middle" bgcolor="#003366"><span class="style1">D&uacute;vida na opera&ccedil;&atilde;o </span></td>
            <td width="26%" align="center" valign="middle" bgcolor="#003366"><span class="style1">N&atilde;o Obt&ecirc;m Resultado esperado </span></td>
            <td width="7%" align="center" valign="middle" bgcolor="#003366"><span class="style1">Erro</span></td>
            <td width="10%" align="center" valign="middle" bgcolor="#003366"><span class="style1">Outros</span></td>
            <td width="9%" align="center" valign="middle" bgcolor="#003366"><span class="style1">Total</span></td>
          </tr>
          <tr>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lDuvida?></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lResultado?></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lErro?></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lOutros?></td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><span class="style2">
              <?=$lTotal?>
            </span></td>
          </tr>
          <tr>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lpDuvida?> % </td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lpResultado?> % </td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lpErro?> % </td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=$lpOutros?> % </td>
            <td align="center" valign="middle" bgcolor="#FFFFFF"><?=100?> % </td>
          </tr>
        </table></td>
    </tr>
<?php
  }
  
  if ($gTotal != 0) {
  
  $gpDuvida = $gDuvida / $gTotal * 100;
  $gpResultado = $gResultado / $gTotal * 100;  
  $gpErro = $gErro / $gTotal * 100;
  $gpOutros = $gOutros / $gTotal * 100;
  $gpDuvida =   number_format($gpDuvida, 2, ',', ' ');
  $gpResultado =   number_format($gpResultado, 2, ',', ' ');
  $gpErro =   number_format($gpErro, 2, ',', ' ');
  $gpOutros =   number_format($gpOutros, 2, ',', ' ');
  }
  
?>
  </table>
  <hr>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="33%" rowspan="3" align="center" valign="middle" bgcolor="#E4FCE8">TOTAIS</td>
            <td width="15%" align="center" valign="middle" bgcolor="#006633"><span class="style1">D&uacute;vida na opera&ccedil;&atilde;o </span></td>
            <td width="26%" align="center" valign="middle" bgcolor="#006633"><span class="style1">N&atilde;o Obt&ecirc;m Resultado esperado </span></td>
            <td width="7%" align="center" valign="middle" bgcolor="#006633"><span class="style1">Erro</span></td>
            <td width="10%" align="center" valign="middle" bgcolor="#006633"><span class="style1">Outros</span></td>
            <td width="9%" align="center" valign="middle" bgcolor="#006633"><span class="style1">Total</span></td>
          </tr>
          <tr>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gDuvida?></td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gResultado?></td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gErro?></td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gOutros?></td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><span class="style2">
              <?=$gTotal?>
            </span></td>
          </tr>
          <tr>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gpDuvida?> % </td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gpResultado?> % </td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gpErro?> % </td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=$gpOutros?> % </td>
            <td align="center" valign="middle" bgcolor="#E4FCE8"><?=100?> % </td>
          </tr>
    </table>  
        
      </p>
	  <?
	    } // Fim if (action = pesquiar)
	  ?>
    </blockquote>
</div></div>
</body>
</html>
