<?php require_once('../../Connections/sad.php'); ?>
<?php
mysql_select_db($database_sad, $sad);
$query_rsClientes = "SELECT id_cliente, cliente FROM cliente ORDER BY id_cliente ASC";
$rsClientes = mysql_query($query_rsClientes, $sad) or die(mysql_error());
$row_rsClientes = mysql_fetch_assoc($rsClientes);
$totalRows_rsClientes = mysql_num_rows($rsClientes);

mysql_select_db($database_sad, $sad);
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);
?><?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	

	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
	


	
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*0 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if ($orderBy == '') {
		$orderBy = " id_chamado ";
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
<label></label>
<div align="center">Contatos estabelecidos </div>
  <form name="form1" method="post" action="">
    <table width="619" border="0">
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
        <td>Cliente</td>
        <td><select name="id_cliente" class="bordaTexto" id="id_cliente">
          <option value="0" <?php if (!(strcmp(0, $_POST['id_cliente']))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsClientes['id_cliente']?>"<?php if (!(strcmp($row_rsClientes['id_cliente'], $_POST['id_cliente']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsClientes['id_cliente']?></option>
          <?php
} while ($row_rsClientes = mysql_fetch_assoc($rsClientes));
  $rows = mysql_num_rows($rsClientes);
  if($rows > 0) {
      mysql_data_seek($rsClientes, 0);
	  $row_rsClientes = mysql_fetch_assoc($rsClientes);
  }
?>
                        </select></td>
      </tr>
      <tr>
        <td>Usu&aacute;rio</td>
        <td><label>
          <select name="UserId" class="bordaTexto" id="UserId">
            <option value="0" <?php if (!(strcmp(0, $UserId))) {echo "selected=\"selected\"";} ?>>Todos</option>
            <?php
do {  
?><option value="<?php echo $row_rsUsuarios['id_usuario']?>"<?php if (!(strcmp($row_rsUsuarios['id_usuario'], $UserId))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsUsuarios['nome']?></option>
            <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
              </select>
        [<a href="javascript:filtraconsultor('<?=$ok?>');">EU</a>]        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="btnPesquisar" type="submit" class="bordaTexto" id="btnPesquisar" value="Pesquisar">
          <input name="action" type="hidden" id="action" value="pesquisar">
          <input name="orderBy" type="hidden" id="orderBy">
        </label></td>
      </tr>
    </table>
  </form>
<div align="left">
<?php	




	$quando = explode("/", $datai);
	$_datai = "$quando[2]-$quando[1]-$quando[0]";
	$quando = explode("/", $dataf);
	$_dataf = "$quando[2]-$quando[1]-$quando[0]";
	
	

  if ($action == "pesquisar")  {
  
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
  chamado.cliente_id,
  chamado_id,
  c.consultor_id,
  c.dataa,
  c.horaa,  
  SEC_TO_TIME(TIME_TO_SEC(c.HORAE) - TIME_TO_SEC(c.HORAA)) AS duracao,  
  TIME_TO_SEC(c.HORAE) - TIME_TO_SEC(c.HORAA) AS segundos
from
  contato c
    inner join usuario u on u.id_usuario = c.consultor_id
	inner join chamado on chamado.id_chamado = c.chamado_id
where
  TIME_TO_SEC(c.HORAE) - TIME_TO_SEC(c.HORAA) > 0 AND ";
  
  if ($id_cliente <> '0') {
  	$sql .= " chamado.cliente_id = '$id_cliente' and ";
  }

  if ($UserId <> '0') {
  	$sql .= " c.consultor_id = '$UserId' and ";
  }
  
  $sql .= " c.dataa >= '$_datai'  
  and c.dataa <= '$_dataf'
  
  order by $orderBy, c.dataa
";

?>
  <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr>
          <td bgcolor="#FFFFFF" ><a href="javascript:order('nome')">Usu&aacute;rio</a></td>
          <td bgcolor="#FFFFFF" ><a href="javascript:order('chamado_id')">Chamado</a></td>
          <td bgcolor="#FFFFFF" ><a href="javascript:order('cliente_id')">Cliente</a></td>
          <td bgcolor="#FFFFFF" >Data</td>
          <td bgcolor="#FFFFFF" >Hora</td>
          <td bgcolor="#FFFFFF" >Dura&ccedil;&atilde;o</td>	  
<!--          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=categoria,sistema">Acumulado Usu&aacute;rio </a></td> -->
          <td bgcolor="#FFFFFF" >Acumulado total </td>
      <!--          <td bgcolor="#FFFFFF" ><a href="r_029.php?action=pesquisar&datai=<?=$datai?>&dataf=<?=$dataf?>&orderby=sistema,categoria">Acumulado Chamado </a></td>-->
    </tr>
  
<?

	
  $nome = "";
  $ch = 0;
  
  $AcumuladoTotal = 0;
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
	$AcumuladoTotal += $linhaA->segundos;

	
?>

    <tr>
          <td bgcolor="#FFFFFF" ><?=$linhaA->nome;?> [<a href="javascript:filtraconsultor('<?=$linhaA->consultor_id?>');">filtrar</a>]</td>
          <td bgcolor="#FFFFFF" ><a href="r_034_b.php?id_chamado=<?=$linhaA->chamado_id;?>" target="_blank"><?=$linhaA->chamado_id;?></a></td>		  
          <td bgcolor="#FFFFFF" ><?=$linhaA->cliente_id?> [<a href="javascript:filtraempresa('<?=$linhaA->cliente_id?>');">Filtrar</a>]</td>
          <td bgcolor="#FFFFFF" ><?=$dataa;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->horaa;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->duracao;?></td>
<!--          <td bgcolor="#FFFFFF" ><?=sec_to_time($AcumuladoUsuario);?></td> -->
          <td bgcolor="#FFFFFF" ><?=sec_to_time($AcumuladoTotal);?></td>
      <!--		  <td bgcolor="#FFFFFF" ><?=sec_to_time($AcumuladoChamado);?></td>
-->          
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
  
  <script>
  function filtraempresa(AEmpresa)
  {
  	document.form1.id_cliente.value = AEmpresa;
	document.form1.submit();
  }
  function filtraconsultor(AUsuario)
  {
  	document.form1.UserId.value = AUsuario;
	document.form1.submit();
  }
  function order(Ordem)
  {
  	document.form1.orderBy.value = Ordem;
	document.form1.submit();
  }

  </script>
  
</body>
</html>
<?php
mysql_free_result($rsClientes);
mysql_free_result($rsUsuarios);
?>
