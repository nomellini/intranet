<?php require_once('../../../Connections/sad.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_sad, $sad);
$query_rsClientes = "SELECT id_cliente, cliente, grau FROM cliente ORDER BY cliente ASC";
$rsClientes = mysql_query($query_rsClientes, $sad) or die(mysql_error());
$row_rsClientes = mysql_fetch_assoc($rsClientes);
$totalRows_rsClientes = mysql_num_rows($rsClientes);
?><?
	//require_once("../../scripts/classes.php");	
	require_once("../../scripts/conn.php");
	require_once("../../scripts/stats.php");	
	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
   if ($acao=='alterna') {
    $sql  = "update satligacao set FL_ATIVO = not FL_ATIVO where id = $id_ligacao";
	mysql_query($sql);
   }
   
    
    if (!$ordem) {
      $ordem = "  data desc, ";
      $ordem .= "  hora_inicio ";
    }
	$ordem .= " $direcao";
	
	if ($direcao=='DESC') {
	  $direcao = 'ASC';	   
	} else {
      $direcao='DESC';
	}

	
	
    $podeAlternar = false;	
	if (($ok==2) or ($ok==12)) {
	  $podeAlternar = true;
	}
	
    if(!$datai) {
       $datai = date("d/m/Y" );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}	
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
    $consultores = pegaSoConsultores(1);			
		
?>

<html>
<head>
<title>Liga&ccedil;&otilde;es de hoje</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../todo/stilos.css" type="text/css">
<link href="../../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1120">
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
.style3 {
	color: #0000FF;
	font-weight: bold;
}
.style5 {font-size: 12px}
.style6 {
	color: #003366;
	font-style: italic;
	font-weight: bold;
}
.style7 {color: #0000FF}
.style9 {font-size: 12px; color: #FF0000; }
.style10 {color: #FF0000}
.style11 {font-size: 12px; color: #0000FF; }
-->
</style>
</head> 
<body bgcolor="#FFFFFF" text="#000000">
<img src="../../figuras/topo_sad_e_900.jpg" width="900" height="79">
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td><form action="rel001.php" method="post" name="form" id="form">
      <table width="100%"  border="0">
        <tr>
          <td width="11%">Data Inicio </td>
          <td width="89%"><font color="#FF0000" size="2">
        
            <input name="datai" type="text" class="borda_fina" id="datai" value="<?=$datai?>" size="12" maxlength="10">
</font></td>
        </tr>
        <tr>
          <td>Data Fim </td>
          <td><font color="#FF0000" size="2">
            <input name="dataf" type="text" class="borda_fina" id="dataf" value="<?=$dataf?>" size="12" maxlength="10">
</font></td>
        </tr>
        <tr>
          <td>Consultor</td>
          <td><select name="id_consultor" class="unnamed1" id="id_consultor">
          <option value="0">Todos</option>
          <?  
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $id_consultor==$tmp["id_usuario"] ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
        </select>
            <input name="id_ligacao" type="hidden" id="id_ligacao">
            <input name="acao" type="hidden" id="acao">
            <input name="ordem" type="hidden" id="ordem"> <input name="direcao" type="hidden" id="direcao" value="<?=$direcao ?>"></td>
        </tr>
        <tr>
          <td>Cliente</td>
          <td><select name="cliente_id" class="unnamed1" id="cliente_id">
            <option value="0" <?php if (!(strcmp(0, $_POST['cliente_id']))) {echo "selected=\"selected\"";} ?>>Todos</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsClientes['id_cliente']?>"<?php if (!(strcmp($row_rsClientes['id_cliente'], $_POST['cliente_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsClientes['cliente']?></option>
            <?php
} while ($row_rsClientes = mysql_fetch_assoc($rsClientes));
  $rows = mysql_num_rows($rsClientes);
  if($rows > 0) {
      mysql_data_seek($rsClientes, 0);
	  $row_rsClientes = mysql_fetch_assoc($rsClientes);
  }
?>
          </select>
            <input name="Submit" type="submit" class="bordaTexto" value="Executar consulta"></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr> 
    <td valign="top">
      <a href="#STATS">Estat&iacute;sticas</a>
      <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr bgcolor="#D5EAFF"> 
          <td width="8%"><span class="style6"><a href="javascript:ordem(1);">Data</a></span></td>		
          <td width="15%" height="16"><span class="style6"><a href="javascript:ordem(2);">Status</a></span></td>
          <td width="24%"><span class="style6"><a href="javascript:ordem(3);">Cliente</a></span></td>
          <td width="4%" align="center" valign="middle"><a href="javascript:ordem(4);"><strong>Grau</strong></a></td>
          <td width="7%" align="center" valign="middle"><span class="style6"><a href="javascript:ordem(4);">Hora Inicio </a></span></td>
          <td width="8%" align="center" valign="middle"><span class="style6"><a href="javascript:ordem(5);">Hora Fim</a> </span></td>
          <td width="5%" align="center" valign="middle"><span class="style6"><a href="javascript:ordem(6);">Espera</a></span></td>
          <td width="29%"><span class="style6"><a href="javascript:ordem(7);">Consultor / Produto</a></span></td>
        </tr>

<?

  $quando = explode("/", $datai);
  $datai = "$quando[2]-$quando[1]-$quando[0]";
  $quando = explode("/", $dataf);  
  $dataf = "$quando[2]-$quando[1]-$quando[0]";


  $sql = "select cl.grau, ";
  $sql .= "	data, motivo_status, u.nome as consultor, id_chamado,  ";
  $sql .= "	st.descricao as status, qtde_aguarde, sl.id,  ";
  $sql .= "	cl.cliente, sec_to_time( time_to_sec(hora_fim) - time_to_sec(hora_inicio) ) as espera,  ";
  $sql .= "	si.sistema as produto, sl.motivo, linha, sl.hora_inicio, hora_fim,  ";
  $sql .= "	cl.bloqueio, sl.id_satstatus, sl.FL_ATIVO,  ";
  $sql .= "	(time_to_sec(hora_fim) - time_to_sec(hora_inicio)) as esperasec ";
  $sql .= "FROM  ";
  $sql .= "	satligacao sl ";
  $sql .= "		left join cliente cl on cl.id_cliente = sl.id_cliente ";
  $sql .= "		left join sistema si on si.id_sistema = sl.id_produto ";
  $sql .= "		left join satstatus st on st.id = sl.id_satstatus ";
  $sql .= "		left join usuario u on u.id_usuario = sl.id_usuario ";
  $sql .= "WHERE 1=1 ";
  
	

/*
  $sql = "select ";
  $sql .= "  data, motivo_status, ";
  $sql .= "  usuario.nome as consultor, ";
  $sql .= "  id_chamado, ";
  $sql .= "  satstatus.descricao as status, ";
  $sql .= "  qtde_aguarde,  ";
  $sql .= "  satligacao.id, ";
  $sql .= "  cliente.cliente, ";
  $sql .= "  sec_to_time(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)  ) as espera, ";
  $sql .= "  sistema.sistema as produto, ";
  $sql .= "  satligacao.motivo, ";
  $sql .= "  linha, ";
  $sql .= "  satligacao.hora_inicio, ";
  $sql .= "  hora_fim, ";
  $sql .= "  cliente.bloqueio, ";
  $sql .= "  satligacao.id_satstatus, ";
  $sql .= "  satligacao.FL_ATIVO, ";
  $sql .= "  (time_to_sec(hora_fim) - time_to_sec(hora_inicio))   as esperasec ";
  $sql .= "FROM ";
  $sql .= "  satligacao, ";
  $sql .= "  cliente, ";
  $sql .= "  sistema, ";
  $sql .= "  satstatus, ";
  $sql .= "  usuario ";
  $sql .= "WHERE ";
  */
//  $sql .= "      satstatus.id = satligacao.id_satstatus ";
//  $sql .= "  and usuario.id_usuario = satligacao.id_usuario ";
  $sql .= "  and data >= '$datai' ";
  $sql .= "  and data <= '$dataf' ";
//  $sql .= "  and satligacao.id_cliente = cliente.id_cliente ";
//  $sql .= "  and satligacao.id_produto = sistema.id_sistema ";
  if ($id_consultor) {
    $sql .= " and u.id_usuario = $id_consultor ";
  }
  if ($cliente_id) {
    $sql .= " and sl.id_cliente = '$cliente_id' ";  
  }
  $sql .= "ORDER BY  $ordem";
  
//	  die($sql);
  
  $contador = 0;
  $perdidas = 0;
  $maisque10 = 0;
  $maisque20 = 0;  
  $maisque10n = 0;
  $maisque20n = 0;  
  $inativos = 0;
  $inativosMaior = 0;
  $inativosMenor = 0;
    
  $result = mysql_query($sql) or die(mysql_error());
  while ($linha = mysql_fetch_object($result)) {  
    $status = $linha->status;
    $idligacao = $linha->id;
	$id_chamado = $linha->id_chamado;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$esperasec = $linha->esperasec;
	$linhatel = $linha->linha;
	$motivo = $linha->motivo_status;
	$hora_inicio = $linha->hora_inicio;
	$hora_fim = $linha->hora_fim;
	$consultor = $linha->consultor;
	$data = $linha->data;
	$Grau = $linha->grau;
	$quando = explode("-", $data);
	
    $data = "$quando[2]/$quando[1]/$quando[0]";
	$ativo = $linha->FL_ATIVO;
	
	$id_satstatus = $linha->id_satstatus;	
	$perdida = $id_satstatus == 4;
	if ($perdida) { $status = "<b>$status</b>";}	
	
	// G1 15 = 900, G2 20 = 1200, G3 25 = 1500

	if ($perdida == 4) {
	  	$perdidas++;

		if (($esperasec >= 480) and ($ativo)) {
		  $maisque10n++;
		}
		if (($esperasec >= 900) and ($ativo)) {
		  $maisque10n--;	  
		  $maisque20n++;	  
		}	  
	  
	} else {

		$tempoLimite = 1800;	
		if ($Grau == "G1")
		{
			$tempoLimite = 900;
		} else if ($Grau == "G2")  
		{
			$tempoLimite = 1200;
		} else if ($Grau == "G3")
		{
			$tempoLimite = 1500;
		}
		
	
	
		$ok = false;
		if (($esperasec >= 480) and ($ativo)) {
		  $espera = "<b>$espera</b>";
		  $ok = true;	  
		  $maisque10++;
		}
		if (($esperasec >= $tempoLimite) and ($ativo)) {
		  $espera = "<font color=#ff0000><b>$espera</b></font>";
		  $ok = true;	  	  
		  $maisque10--;	  
		  $maisque20++;	  
		}
		

		$bg = "#FFFFFF";
		if ((!$ativo)) {		
		  $inativos++;
          $bg = "#cccccc";
		}			
		
		if (($esperasec >= 480) and (!$ativo)) {
		  $espera = "<font color=#0000ff><b>$espera</b></font>";
		  $ok = true;	  
		  $inativosMaior++;
		}	
	}

	if ($ok) {
	  if ($podeAlternar) {
	    $data = "<a href=\"javascript:document.form.id_ligacao.value='$idligacao';document.form.acao.value='alterna';document.form.submit();\">$data</a>";
	  }
	}
	
	
	$contador++;
	

    if ($linha->bloqueio) {
	   $bloqueio = "<br><b>Cliente bloqueado</b>";
	} else {
       $bloqueio = '';
	}
	
    $cliente = $linha->cliente . $bloqueio;

	if ($cor=="#E8F1F9") {
      $cor='#ffffff';
	} else {
      $cor='#E8F1F9';
	}
	$cor = $bg;

?>

        <tr bgcolor="<?=$cor?>"> 
          <td width="8%"><?=$data?></td>		  		
          <td width="15%"><? echo $status;  ?></td>
          <td width="24%">
		  <?
		    if ($id_chamado!=0) {
		  ?>
		  <a href="../../historicochamado.php?id_chamado=<?=$id_chamado?>">
		  <?=$cliente?>		  
 		  </a>
		  <? } else {?>
		  <?=$cliente?>
		  <? } 
			if ($motivo) {
			  echo "<br><b>--> $motivo</b>";
			}
			
			$cor = obterCorPorGrau($Grau);
			
			
		?></td>
          <td width="4%" align="center" valign="middle" bgcolor="<?=$cor?>"><?=$Grau?></td>
          <td width="7%" align="center" valign="middle" ><?=$hora_inicio?></td>
          <td width="8%" align="center" valign="middle"><?=$hora_fim?></td>
          <td width="5%" align="center" valign="middle"><?=$espera?></td>
          <td width="29%"><?=$consultor?>/<?=$produto?></td>
        </tr>
        <?
 }
?>
        <tr> 
          <td width="8%"><font color="#FFFFFF"><em><a name="STATS"></a></em></font></td>		
          <td width="15%" height="16"><font color="#FFFFFF"><em></em></font></td>
          <td width="24%"><font color="#FFFFFF"><em></em></font></td>
          <td width="4%" align="center" valign="middle">&nbsp;</td>
          <td width="7%" align="center" valign="middle"><font color="#FFFFFF"><em></em></font></td>
          <td width="8%" align="center" valign="middle"><font color="#FFFFFF"><em></em></font></td>
          <td width="5%" align="center" valign="middle"><font color="#FFFFFF"><em></em></font></td>
          <td width="29%"><font color="#FFFFFF"><em></em></font></td>
        </tr>
        <tr>
          <td>Total</td>
          <td height="16"><span class="style1">
            <?=$contador?>
          ligações</span></td>
          <td>&nbsp;</td>
          <td align="center" valign="middle">&nbsp;</td>
          <td align="center" valign="middle">&nbsp;</td>
          <td align="center" valign="middle">&nbsp;</td>
          <td align="center" valign="middle">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7">Estat&iacute;sticas</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7"><span class="style11">liga&ccedil;&otilde;es atendidas 
            - 
            <?=$atendidas = $contador-$perdidas - $inativos;?>
            <?=$atendidade?>
            <? if ($atendidas> 0) { ?>            
          (
          <?= number_format($atendidas/$contador*100, 2,',','.')  ?>
%) </span> ... ( + <?=$inativos?> ligações finalizadas)</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7"><span class="style5">
            <?=sprintf("%04d", ($atendidas) - $maisque10 - $maisque20)?>
 (<?= sprintf("%01.2f", ((($atendidas) - $maisque10 - $maisque20)/($atendidas)*100)) ?>
%) clientes atendidos esperaram menos do que 8 minutos </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7"><span class="style5">
            <?=sprintf("%04d", $maisque10)?> 
          (<?= sprintf("%01.2f", ($maisque10/($atendidas)*100)) ?>
           %) clientes  atendidos esperaram entre 8 e 15 minutos</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7"><span class="style5">
            <?=sprintf("%04d", $maisque20)?> 
          (<?= sprintf("%.2f", $maisque20/($atendidas)*100)  ?>
           %) clientes  atendidos esperaram mais que 15 minutos</span></td>
        </tr>
            <? } // fim  if ($atendidas> 0) {   ?>     
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="2"><span class="style9"> liga&ccedil;&otilde;es <strong>n&atilde;o</strong> atendidas 
            - 
            <?=$perdidas?>
            <? if ($perdidas > 0) { ?>
&nbsp;(
<?= number_format($perdidas/$contador*100, 2,',','.')  ?>
%) </span></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7"><span class="style5">
            <?=sprintf("%04d", $perdidas - $maisque10n - $maisque20n)?> (
<?= sprintf("%01.2f", (($perdidas - $maisque10n - $maisque20n)/($perdidas)*100)) ?>
%) clientes n&atilde;o atendidos esperaram menos do que 8 minutos </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7"><span class="style5">
            <?=sprintf("%04d", $maisque10n)?>
            (
  <?= sprintf("%01.2f", ($maisque10n/($perdidas)*100)) ?>
            %) clientes n&atilde;o atendidos esperaram entre 8 e 15 minutos</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="7"><span class="style5">
            <?=sprintf("%04d", $maisque20n)?>
            (
  <?= sprintf("%.2f", $maisque20n/($perdidas)*100)  ?>
            %) clientes  n&atilde;o atendidos esperaram mais que 15 minutos</span></td>
        </tr>
                    <? } ?>
                    <tr>
                      <td>&nbsp;</td>
                      <td height="16" colspan="4">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td height="16" colspan="4">Liga&ccedil;&otilde;es inativas abaixo de 8 minutos: <?=($inativos - $inativosMaior);?></td>
                      <td>&nbsp;</td>
                      <td colspan="2">&nbsp;</td>
                    </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="16" colspan="4">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><strong>Preto</strong></td>
          <td colspan="3">Cliente esperou mais que 8 minutos </td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><span class="style2">Vermelho</span></td>
          <td colspan="3">Cliente G1 esperou mais que 15 minutos, G2 mais que 20 e G3 mais que 25</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><span class="style3">Azul</span> (<?=$inativosMaior?>)</td>
          <td colspan="6">mais que 8 minutos. <strong>N&Atilde;O</strong> entra nas estat&iacute;sticas </td>
        </tr>
        <tr bgcolor="#FFEAF1">
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFEAF1">&nbsp;</td>
          <td colspan="6">&nbsp;</td>
        </tr>
      </table>
    <br>    </td>
  </tr>
  <tr> 
    <td align="right">
      Sad 2004</td>
  </tr>
</table>


</body>
</html>
<?php
mysql_free_result($rsClientes);
?>
<script>
function ordem(aValue) {
  var lOrdem;
  
  if (aValue == 6) {
    lOrdem = 'esperasec';
  } else if (aValue == 3) {
    lOrdem = 'cliente.cliente';
  } else if (aValue == 7) {
    lOrdem = 'consultor ';
  } else if (aValue == 1) {
    lOrdem = 'data';
  } else if (aValue == 4) {
    lOrdem = 'hora_inicio';
  } else if (aValue == 5) {
    lOrdem = 'hora_fim';
  } else if (aValue == 2) {
    lOrdem = 'status';
  }



  
  
  document.form.ordem.value = lOrdem;
  document.form.submit();
}
</script>