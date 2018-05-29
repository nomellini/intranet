<?php require_once('../../Connections/sad.php'); ?>
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
$query_rsStatus = "SELECT * FROM status";
$rsStatus = mysql_query($query_rsStatus, $sad) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);
?><?
	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	if (!isset($limite)) {
	 $limite = 10;
	}
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	

    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
 

	if (!$ordem) {
	  $ordem = "chamados ";
	  $desc  = "DESC";
	}
	$o = "$ordem $desc";

	$ch = statClientesChamados( $atendimento, $o, $limite, $datai, $dataf, $sistema, $status );

	$total = count($ch);
	
    $somaChamados = 0;
    while( list($tmp1, $tmp) = each($ch) ) {
	  $somaChamados += $tmp["chamados"];
	}
	reset($ch);
	
	
?>
<link rel="stylesheet" href="../stilos.css" type="text/css">
<script src="coolbuttons.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="43%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      p/ relat&oacute;rios</a></td>
  </tr>
</table>
<hr color=#ff0000 noshade size="1">
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"> 
<?echo "Olá, $nomeusuario, hoje é ";?>
</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

<script language="JavaScript">

function limpa() {
  document.form.id_cliente.value='';
}

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }

function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}

      var diasemana = new Array;
      var mesescrito = new Array;
    
      diasemana[1] = "segunda-feira";
      diasemana[2] = "terça-feira";
      diasemana[3] = "quarta-feira";
      diasemana[4] = "quinta-feira";
      diasemana[5] = "sexta-feira";
      diasemana[6] = "sábado";
      diasemana[7] = "domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();   

     document.write (diasemana[diaindex] + ' ' +  dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
</font></font> 
<form name="form" method="post" action="clienteschamados.php">
  <div align="center"><b>Relat&oacute;rio de Chamados por cliente</b><br>
    <br>
  </div>
  <table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FCE9BC" align="left"> 
      <td colspan="2">Data Inicial 
        <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)">
        Data Final 
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> 
        ] </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td width="10%">Sistema</td>
      <td bgcolor="#FCE9BC" width="90%"> 
        <select name="sistema" class="bordaTexto">
          <option value="0">Todos</option>
          <?  

  $arrcat = listaSistemas($atendimento);
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $sistema==$tmp["id_sistema"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_sistema"] . " $s >" . $tmp["sistema"] . "</option>";
  }
?>
        </select>      </td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td>Status</td>
      <td><select name="status" class="bordaTexto" id="status">
          <option value="0" <?php if (!(strcmp(0, "$status"))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsStatus['id_status']?>"<?php if (!(strcmp($row_rsStatus['id_status'], "$status"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStatus['status']?></option>
          <?php
} while ($row_rsStatus = mysql_fetch_assoc($rsStatus));
  $rows = mysql_num_rows($rsStatus);
  if($rows > 0) {
      mysql_data_seek($rsStatus, 0);
	  $row_rsStatus = mysql_fetch_assoc($rsStatus);
  }
?>
      </select></td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="2"> 
        <p>Limitar resultado em 
          <input type="text" name="limite" size="4" maxlength="4" value="<?=$limite?>" class="unnamed1">
          registros [<a href="javascript:document.form.limite.value='0';document.form.submit();">mostrar 
          todos</a>]<br>
          <input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
          Ordem decrescente ? 
          <input type="hidden" name="ordem" value="<?=$ordem?>">
          <input type="submit" name="Submit" value="Submit" class="unnamed1">
        </p>
        <p>&nbsp; </p>      </td>
    </tr>
  </table>
</form>
<blockquote> 
  <p><a name="inicio"></a>Total de clientes listados : 
    <?=$total?>
  </p>
</blockquote>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#999999" height="8">
  <tr bgcolor="#CCCCCC"> 
    <td width="5%" align="center"> 
      <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_cliente'; document.form.submit();">Pos</a></font></div>
    </td>
    <td width="29%" align="center"> 
      <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_cliente'; document.form.submit();">Codigo</a></font></div>
    </td>
    <td width="42%" align="center"> 
      <div align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></div>
    </td>
    <td width="10%" valign="middle" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='chamados'; document.form.submit();">Chamados</a></font></td>
    <td width="14%" align="center">Porcentagem</td>
  </tr>
  <?  
  $pos=1;
  while( list($tmp1, $tmp) = each($ch) ) {
	$id_cliente = $tmp["id_cliente"];	
	$chamados = $tmp["chamados"];
	$cliente = $tmp["grau"] . " " . $tmp["cliente"];	
    if($somaChamados) {
	  $ct = $chamados/$somaChamados*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.3f", $ct) . " %";

?>
  <tr bgcolor="#FCE9BC" align="left"> 
    <td width="5%" height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>"> 
      <?=$pos++?>
      </a></font></td>
    <td width="29%" height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>"> 
      <?=$id_cliente?>
      </a></font></td>
    <td width="42%" height="16"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="relat2.php?id_cliente=<?=$id_cliente?>&sistema=<?=$sistema?>&datai=<?=$datai?>&dataf=<?=$dataf?>#inicio"> 
      <?=$cliente?>
      </a></font></td>
    <td width="10%" height="16" valign="middle" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$chamados?>
      </font></td>
    <td width="14%" height="16" align="center"> 
      <?=$ct?>
    </td>
  </tr>
  <?
  }
?>
  <tr bgcolor="#FFFFFF" align="left"> 
    <td width="5%" height="16">&nbsp;</td>
    <td width="29%" height="16">&nbsp;</td>
    <td width="42%" height="16"> 
      <div align="right">total de chamados : </div>
    </td>
    <td width="10%" height="16" valign="middle" align="center"> 
      <div align="center"> 
        <?=$somaChamados?>
      </div>
    </td>
    <td width="14%" height="16" align="center">&nbsp;</td>
  </tr>
</table>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font></p>

<?php
mysql_free_result($rsStatus);
?>
