<?	require("../scripts/conn.php");
	require("../scripts/stats.php");
	require("../scripts/classes.php");

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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	ch.dataa,
	ch.email emailchamado,
	st.status,
	cl.cliente,
	ch.cliente_id,
	ce.pessoacontatada usuario,
	ce.email,
	ch.id_chamado,
	si.sistema,
	ca.categoria
from
	chamado ch
		inner join cliente cl on cl.id_cliente = ch.cliente_id
		inner join clienteemail ce on ce.chamado = ch.id_chamado
		inner join categoria ca on ca.id_categoria = ch.categoria_id
		inner join sistema si on si.id_sistema = ch.sistema_id
		inner join status st on st.id_status = ch.status
where
  ce.tipo = 'T' and
  ch.dataa >= '$_datai' and dataa <= '$_dataf'
order by
  $orderby
";

?>
  <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=cliente_id">Cliente</a></td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=dataa">Abertura</a></td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=usuario">Usuário</a></td>
          <td bgcolor="#FFFFFF" >E-mail</td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=id_chamado">Chamado</a></td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=sistema,categoria">Sistema</a></td>
          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=categoria,sistema">Categoria</a></td>
    </tr>

<?
  $resultA = mysql_query($sql) or die (mysql_error());
  while ($linhaA = mysql_fetch_object($resultA)) {
	$quando = explode("-", $linhaA->dataa);
	$dataa = "$quando[2]/$quando[1]/$quando[0]";
	$email1 = $linhaA->email;
	//$email2 = $linhaA->emailchamado;
	$email = $email1;
	if ($email1 == "") {
		$email = $email2;
	}
?>
    <tr>
          <td bgcolor="#FFFFFF" ><?=$linhaA->cliente_id;?></td>
          <td bgcolor="#FFFFFF" ><?=$dataa;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->usuario;?></td>
          <td bgcolor="#FFFFFF" ><a href="mailto:<?=$email;?>"><?=$email;?></a>&nbsp;</td>
          <td bgcolor="#FFFFFF" ><a href="/a/historicochamado.php?&id_chamado=<?=$linhaA->id_chamado;?>" target="_blank"><?=$linhaA->id_chamado;?></a></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->sistema;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->categoria;?></td>
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
