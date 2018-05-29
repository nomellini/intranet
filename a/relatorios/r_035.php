<?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	

function sec_to_time($segundos) 
{

	$horas =   (int)($segundos / 3600);
	
	$segundos = $segundos % 3600;
	
	$minutos = (int)($segundos / 60);
	$segundos = $segundos % 60;
  
  $time = sprintf("%02d", $horas) . ":" . 
	      sprintf("%02d", $minutos) . ":" . 
		  sprintf("%02d", $segundos);
  return $time;
}
	
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*2 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if (!isset($orderby)) {
		$orderby = " id_chamado desc";
	}
	
	$orderby .= ", id_chamado";	
		
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
<div align="center">Registros de solicita&ccedil;&atilde;o de treinamento </div>
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

  if ($action == "pesquisar")  {


	$quando = explode("/", $datai);
	$_datai = "$quando[2]-$quando[1]-$quando[0]";
	$quando = explode("/", $dataf);
	$_dataf = "$quando[2]-$quando[1]-$quando[0]";

	if ($bloqueado == "A") {
		$bl = "cliente.bloqueio <> 1 and ";
	} else if ($bloqueado == "I") {
		$bl = "cliente.bloqueio = 1  and ";
	} else {
		$bl = "";
	}


$sql = "
select
  u.nome,
  chamado_id,
  c.dataa,
  horaa,  
  SEC_TO_TIME(TIME_TO_SEC(HORAE) - TIME_TO_SEC(HORAA)) AS duracao,  
  TIME_TO_SEC(HORAE) - TIME_TO_SEC(HORAA) AS segundos
from
  contato c
    inner join usuario u on u.id_usuario = c.consultor_id
where
  TIME_TO_SEC(HORAE) - TIME_TO_SEC(HORAA) > 0 AND
  c.dataa = '2011-05-24'  
order by u.nome, chamado_id
";

?>
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=cliente_id">Usu&aacute;rio</a></td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=dataa">Chamado</a></td>
          <td bgcolor="#FFFFFF" >Cliente</td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=usuario">Data</a></td>
          <td bgcolor="#FFFFFF" >Hora</td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=id_chamado">Dura&ccedil;&atilde;o</a></td>	  
<!--          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=sistema,categoria">Acumulado Chamado </a></td>-->
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=categoria,sistema">Acumulado Usuário </a></td>
    </tr>
  
<?
  $nome = "";
  $ch = 0;
  $resultA = mysql_query($sql) or die (mysql_error());
  while ($linhaA = mysql_fetch_object($resultA)) {
    $usuario = $linhaA->nome;
	$quando = explode("-", $linhaA->dataa);
	$dataa = "$quando[2]/$quando[1]/$quando[0]";
	


	if ($usuario != $nome) {
		$nome = $usuario;
		$AcumuladoUsuario = 0;
		$AcumuladoChamado = 0;		
	} else 
	{
		if ($ch != $linhaA->chamado_id) {
			$ch = $linhaA->chamado_id;
			$AcumuladoChamado = 0;		
		}
	}





	$AcumuladoUsuario += $linhaA->segundos;
	$AcumuladoChamado += $linhaA->segundos;


	
?>
    <tr>
          <td bgcolor="#FFFFFF" ><?=$linhaA->nome;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->chamado_id;?></td>		  
          <td bgcolor="#FFFFFF" >&nbsp;</td>
          <td bgcolor="#FFFFFF" ><?=$dataa;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->horaa;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->duracao;?></td>
<!--		  <td bgcolor="#FFFFFF" ><?=sec_to_time($AcumuladoChamado);?></td>
-->          <td bgcolor="#FFFFFF" ><?=sec_to_time($AcumuladoUsuario);?></td>
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
  <a href="../inicio.php">SAD</a> </div>
  </div>
</body>
</html>
