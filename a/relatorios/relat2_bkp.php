<?php require_once('../../Connections/sad.php'); ?>
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
$query_rsSistema = "SELECT id_sistema, sistema FROM sistema order by sistema";
$rsSistema = mysql_query($query_rsSistema, $sad) or die(mysql_error());
$row_rsSistema = mysql_fetch_assoc($rsSistema);
$totalRows_rsSistema = mysql_num_rows($rsSistema);

mysql_select_db($database_sad, $sad);
$query_rsCategoria = "SELECT id_categoria, categoria, sistema FROM categoria join sistema on sistema.id_sistema = categoria.sistema_id ORDER BY categoria, sistema";
$rsCategoria = mysql_query($query_rsCategoria, $sad) or die(mysql_error());
$row_rsCategoria = mysql_fetch_assoc($rsCategoria);
$totalRows_rsCategoria = mysql_num_rows($rsCategoria);

mysql_select_db($database_sad, $sad);
$query_rsStatus = "SELECT * FROM status order by status";
$rsStatus = mysql_query($query_rsStatus, $sad) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);

mysql_select_db($database_sad, $sad);
$query_rsTipo = "SELECT * FROM origem order by origem";
$rsTipo = mysql_query($query_rsTipo, $sad) or die(mysql_error());
$row_rsTipo = mysql_fetch_assoc($rsTipo);
$totalRows_rsTipo = mysql_num_rows($rsTipo);

mysql_select_db($database_sad, $sad);
$query_rsMotivo = "SELECT * FROM motivo order by motivo";
$rsMotivo = mysql_query($query_rsMotivo, $sad) or die(mysql_error());
$row_rsMotivo = mysql_fetch_assoc($rsMotivo);
$totalRows_rsMotivo = mysql_num_rows($rsMotivo);

mysql_select_db($database_sad, $sad);
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);

mysql_select_db($database_sad, $sad);
$query_rsPrioridade = "SELECT id_prioridade, prioridade FROM prioridade";
$rsPrioridade = mysql_query($query_rsPrioridade, $sad) or die(mysql_error());
$row_rsPrioridade = mysql_fetch_assoc($rsPrioridade);
$totalRows_rsPrioridade = mysql_num_rows($rsPrioridade);

mysql_select_db($database_sad, $sad);
$query_rsAbertoPor = "SELECT id_usuario, nome FROM usuario ORDER BY nome ASC";
$rsAbertoPor = mysql_query($query_rsAbertoPor, $sad) or die(mysql_error());
$row_rsAbertoPor = mysql_fetch_assoc($rsAbertoPor);
$totalRows_rsAbertoPor = mysql_num_rows($rsAbertoPor);
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
	  $limite = 25;
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
	  $ordem = "id_chamado ";
	  $desc  = "DESC";
	}
	$o = "$ordem $desc";

    //$consultores = pegaConsultores($atendimento);		

    if ($acao=='pesquisa') {
		$chamados = statChamados( $o, 
		  $consultor, 
		  $atendimento, 
		  $status, 
		  $categoria, 
		  $tipo, 
		  $datai,
		  $dataf,
		  $motivo,
		  $id_cliente,
		  $limite,
		  $enc,
		  $palavra,
		  $sistema,
		  $externo,
		  $rnc,
		  $id_prioridade,
		  $abertoPor
		  );	
		$total = count($chamados);
	}

/*
    $somaContatos = 0; $somaTempo = 0;
    while( list($tmp1, $tmp) = each($chamados) ) {
	  $somaContatos += $tmp["contatos"];
	  $somaTempo += $tmp["temposeg"];
	}
*/	
//	reset($chamados);
//	$tempoTotal = segToHora($somaTempo);
    loga_online($ok, $REMOTE_ADDR, 'Relatório : 01');	
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<SCRIPT LANGUAGE="JavaScript" SRC="..\overlib.js"></SCRIPT>
<SCRIPT LANGUAGE="Javascript"><!--
function mOvr(src,clrOver) {if (!src.contains(event.fromElement)) {src.style.cursor = 'hand';
src.bgColor = clrOver;
}
}
function mOut(src,clrIn) {if (!src.contains(event.toElement)) {src.style.cursor = 'default';
src.bgColor = clrIn;
}
}
// --> 
</script>
<script src="coolbuttons.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" >
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
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"> <?echo "Olá, $nomeusuario, hoje é ";?> </font><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
<script language="JavaScript">

function mOvr(src,clrOver) {if (!src.contains(event.fromElement)) {src.style.cursor = 'hand';
src.bgColor = clrOver;
}
}
function mOut(src,clrIn) {if (!src.contains(event.toElement)) {src.style.cursor = 'default';
src.bgColor = clrIn;
}
}

function limpa() {
  document.form.id_cliente.value='';
}

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('../selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
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
<form name="form" method="post" action="relat2.php">
  <?
if (
     ($id_usuario==1) or ($id_usuario==15) or // Edson  - Ronaldo
	 ($id_usuario==2) or ($id_usuario==19) or // Marcelo - ADM
	 ($id_usuario==12) or // Fernando
	 ($id_usuario==141)   // Marcelo Nunes
	 )
	 {

?>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#FCE9BC">
      <td width="23%">Consultor</td>
      <td width="77%"><label>
        <select name="consultor" class="bordaTexto" id="consultor">
          <option value="0" <?php if (!(strcmp(0, "$consultor"))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsUsuarios['id_usuario']?>"<?php if (!(strcmp($row_rsUsuarios['id_usuario'], "$consultor"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsUsuarios['nome']?></option>
          <?php
} while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios));
  $rows = mysql_num_rows($rsUsuarios);
  if($rows > 0) {
      mysql_data_seek($rsUsuarios, 0);
	  $row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
  }
?>
        </select>
      </label>      </td>
    </tr>
  </table>
  <?
   }
 ?>
  <div align="center"> Listagem de chamados -
    <?=$total?>
    <br>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><br>
  </div>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#666666" align="left">
      <td colspan="4"><font color="#FFFFFF"><b>Utilize as op&ccedil;&otilde;es 
        abaixo para alterar o relat&oacute;rio</b></font></td>
    </tr>
    <tr bgcolor="#FCE9BC" align="left">
      <td colspan="4">Data Inicial
        <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)">
        Data Final
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>" onKeyPress="fdata(this)">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> ] </td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td width="14%">Sistema</td>
      <td width="27%"><label>
        <select name="sistema" class="bordaTexto" id="sistema">
          <option value="0" <?php if (!(strcmp(0, "$sistema"))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsSistema['id_sistema']?>"<?php if (!(strcmp($row_rsSistema['id_sistema'], "$sistema"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsSistema['sistema']?></option>
          <?php
} while ($row_rsSistema = mysql_fetch_assoc($rsSistema));
  $rows = mysql_num_rows($rsSistema);
  if($rows > 0) {
      mysql_data_seek($rsSistema, 0);
	  $row_rsSistema = mysql_fetch_assoc($rsSistema);
  }
?>
        </select>
      </label></td>
      <td width="11%">Status</td>
      <td width="48%"><label>
        <select name="status" class="bordaTexto" id="status">
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
        </select>
      </label></td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td width="14%">Tipo</td>
      <td width="27%"><label>
        <select name="tipo" class="bordaTexto" id="tipo">
          <option value="0" <?php if (!(strcmp(0, "$tipo"))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsTipo['id_origem']?>"<?php if (!(strcmp($row_rsTipo['id_origem'], "$tipo"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsTipo['origem']?></option>
          <?php
} while ($row_rsTipo = mysql_fetch_assoc($rsTipo));
  $rows = mysql_num_rows($rsTipo);
  if($rows > 0) {
      mysql_data_seek($rsTipo, 0);
	  $row_rsTipo = mysql_fetch_assoc($rsTipo);
  }
?>
        </select>
      </label></td>
      <td width="11%">Motivo</td>
      <td width="48%"><label>
        <select name="motivo" class="bordaTexto" id="motivo">
          <option value="0" <?php if (!(strcmp(0, "$motivo"))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?>
          <option value="<?php echo $row_rsMotivo['id_motivo']?>"<?php if (!(strcmp($row_rsMotivo['id_motivo'], "$motivo"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsMotivo['motivo']?></option>
          <?php
} while ($row_rsMotivo = mysql_fetch_assoc($rsMotivo));
  $rows = mysql_num_rows($rsMotivo);
  if($rows > 0) {
      mysql_data_seek($rsMotivo, 0);
	  $row_rsMotivo = mysql_fetch_assoc($rsMotivo);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td width="14%">Cliente</td>
      <td colspan="3" bgcolor="#FCE9BC"><input type="text" name="id_cliente" class="bordaTexto" size="20" maxlength="20" value="<?=$id_cliente?>">
        [<a href="javascript:seleciona(); ">pesquisar</a>] [<a href="javascript:limpa();">Limpar 
        Cliente</a>]</td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td>Prioridade</td>
      <td><select name="id_prioridade" class="bordaTexto" id="id_prioridade">
        <option value="0" <?php if (!(strcmp(0, "$id_prioridade"))) {echo "selected=\"selected\"";} ?>>Todos</option>
        <?php
do {  
?><option value="<?php echo $row_rsPrioridade['id_prioridade']?>"<?php if (!(strcmp($row_rsPrioridade['id_prioridade'], "$id_prioridade"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsPrioridade['prioridade']?></option>
        <?php
} while ($row_rsPrioridade = mysql_fetch_assoc($rsPrioridade));
  $rows = mysql_num_rows($rsPrioridade);
  if($rows > 0) {
      mysql_data_seek($rsPrioridade, 0);
	  $row_rsPrioridade = mysql_fetch_assoc($rsPrioridade);
  }
?>
      </select></td>
      <td>Aberto Por </td>
      <td><select name="abertoPor" class="bordaTexto" id="abertoPor">
        <option value="0" <?php if (!(strcmp(0, "$abertoPor"))) {echo "selected=\"selected\"";} ?>>Todos</option>
        <?php
do {  
?><option value="<?php echo $row_rsAbertoPor['id_usuario']?>"<?php if (!(strcmp($row_rsAbertoPor['id_usuario'], "$abertoPor"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsAbertoPor['nome']?></option>
        <?php
} while ($row_rsAbertoPor = mysql_fetch_assoc($rsAbertoPor));
  $rows = mysql_num_rows($rsAbertoPor);
  if($rows > 0) {
      mysql_data_seek($rsAbertoPor, 0);
	  $row_rsAbertoPor = mysql_fetch_assoc($rsAbertoPor);
  }
?>
      </select></td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td>Categoria</td>
      <td colspan="3"><label></label>      <label>
        <select name="categoria" class="bordaTexto" id="categoria">
          <option value="0" <?php if (!(strcmp(0, "$categoria"))) {echo "selected=\"selected\"";} ?>>Todos</option>
          <?php
do {  
?><option value="<?php echo $row_rsCategoria['id_categoria']?>"<?php if (!(strcmp($row_rsCategoria['id_categoria'], "$categoria"))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsCategoria['categoria']?> (<?php echo $row_rsCategoria['sistema']; ?>) </option>
          <?php
} while ($row_rsCategoria = mysql_fetch_assoc($rsCategoria));
  $rows = mysql_num_rows($rsCategoria);
  if($rows > 0) {
      mysql_data_seek($rsCategoria, 0);
	  $row_rsCategoria = mysql_fetch_assoc($rsCategoria);
  }
?>
        </select>
      </label></td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td colspan="4">Limitar resultado em
        <input type="text" name="limite" maxlength="4" size="4" value="<?=$limite?>" class="bordaTexto">
        registros [<a href="javascript:document.form.limite.value='0';document.form.submit();">mostrar 
        todos</a>]
        <input type="checkbox" name="externo" value="1" <? if($externo) {echo "checked";}?> >
        abertos por cliente
        <input name="rnc" type="checkbox"  value="1" <? if($rnc) {echo "checked";}?> >
        RNC </td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td colspan="4"><input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
        Ordem decrescente ?
        <input type="hidden" name="ordem" value="<?=$ordem?>">
        Buscar palavra
        <input type="text" name="palavra" class="bordaTexto" value="<?=$palavra?>">
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
        <input name="acao" type="hidden" id="acao" value="pesquisa">      </td>
    </tr>
  </table>
</form>
<a name="inicio"></a>
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
  <tr bgcolor="#CCCCCC">
    <td width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_chamado'; document.form.submit();">Chamado</a></font></td>
    <td width="15%" align="center"><a href="javascript:document.form.ordem.value='dataa'; document.form.submit();">Data</a></td>
    <td width="13%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></td>
    <td width="63%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <a href="javascript:document.form.ordem.value='descr'; document.form.submit();">Descri&ccedil;&atilde;o</a> -[<a href="javascript:document.form.ordem.value='valor'; document.form.submit();">prioridade</a>][<a href="javascript:document.form.ordem.value='sistema'; document.form.submit();">sistema</a>] 
      [<a href="javascript:document.form.ordem.value='categoria'; document.form.submit();">Categoria</a>] 
      [<a href="javascript:document.form.ordem.value='status'; document.form.submit();">status</a>][<a href="javascript:document.form.ordem.value='motivo'; document.form.submit();">motivo</a>] 
      [<a href="javascript:document.form.ordem.value='tempo'; document.form.submit();">tempo</a>] 
      [<a href="javascript:document.form.ordem.value='nome'; document.form.submit();">consultor</a>][<a href="javascript:document.form.ordem.value='contatos'; document.form.submit();">contatos</a>]</font></td>
  </tr>
  <?  
  if ($acao=='pesquisa') {
	  while( list($tmp1, $tmp) = each($chamados) ) {
	  
				   $pri = $tmp["prioridade"];
				   $prioridadev = $tmp["prioridadev"];
				   if ($prioridadev  <= 100) {
					 $cor = "#ff0000";
				   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
					 $cor = "#FF6600";
				   } else if ($prioridadev > 200) {
					 $cor = "#009966";
				   }
				   $pri = "<b><font color=$cor>$pri</font></b>";	
				   
				   $cor_fundo = "#FCE9BC";
				   if ($tmp["externo"]) {
					 $cor_fundo = "#D2E3FF";
				   }			   
	  
	  
		$id = $tmp["chamado_id"];
		$cliente = $tmp["cliente"];
		$id_cliente=$tmp["id_cliente"];
		$contatos = $tmp["contatos"];
		$tempo = $tmp["tempo"];
		$tempos = $tmp["temposeg"];
		$dataa = $tmp["dataa"];
		
		$status = $tmp["status"];

		$data = $tmp["datauc"];	
		
		
		$data = explode('-', $data);
		
		$datauc = "";
	    if ($tmp["status_id"]==1) {		
			$datauc = "em $data[2]/$data[1]/$data[0]";
			$status = "$status $datauc";
		}
		
		$descricao = $tmp["descricao"];
		$descricaoc = $tmp["descricaoc"];	
		if ($palavra) {
		  $descricao = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $descricao);
		 }
	
		if($somaContatos) {
		  $ct = $contatos/$somaContatos*100;
		} else {
		  $ct = 0;
		}
		$ct = sprintf ("%02.2f", $ct) . " %";
		
		if ($somaTempo) {
		  $pt = $tempos/$somaTempo*100; 
		} else {
		  $pt = 0;
		}
		$pt = sprintf ("%02.2f", $pt) . " %";	
		$ch = sprintf ("%04.0f", $id);
		
	//	$msg = "<b>Chamado aberto em $dataa:<br></b> " . $descricaoc;
	//	$msg = "$msg<hr noshade size=1><b>Ultimo Contato:<br></b> ". ultimoHistoricoChamado($id);
	//	$msg = eregi_replace("\r\n", "<br>", $msg);
	//	$msg = eregi_replace("\"", "`", $msg);	
	
		list($tmp1, $tmp2) = each(pegaClientePorCodigoUnico($cliente_id));	
		$cap = strtoupper($tmp2["cliente"]) . " ($cliente_id)";
	
?>
  <tr bgcolor="#FFFFFF">
    <td colspan="4" align="left" height="19"><table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="<?=$cor_fundo?>">
          <td height="17" width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" >
            <!--            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" onMouseOver="return overlib('<?=$msg?>', CAPTION, '<?=$cap?>', WIDTH, 400)" onMouseOut="nd();"> 			-->
            <?=$ch?>
            </a></font></td>
          <td height="17" width="15%" align="center"><?=$dataa?>
          </td>
          <td height="17" width="13%" ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>">
            <?=$id_cliente?>
            </a></font></td>
          <td height="17" colspan="3"  onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'<?=$cor_fundo?>');"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> <a href="../historicochamado.php?id_chamado=<?=$id?>&palavra=<?=$palavra?>">
            <?=$descricao?>
            ...</a></font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" >
          <td width="9%">Sistema</td>
          <td width="15%" ><b><font color="#000000">
            <?=$tmp["sistema"]?>
            </font></b></td>
          <td width="13%">Categoria</td>
          <td colspan="3" ><b><font color="#000000">
            <?=$tmp["categoria"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" >
          <td width="9%">Status</td>
          <td width="15%"><b>
            <?=$status?>
            </b></td>
          <td width="13%">Motivo</td>
          <td colspan="3" ><b><font color="#000000">
            <?=$tmp["motivo"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" >
          <td width="9%">Prioridade</td>
          <td width="15%" ><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
            <?=$pri?>
            </font></b> </td>
          <td width="13%">Aberto por</td>
          <td width="41%"><?
			  echo "<b><font color=#006600>".$tmp["consultor"]."</font></b>" ;
			  if ($tmp["consultor"]  != $tmp["destinatario"] ) {
			    echo " - Encaminhado para : <b><font color=#ff0000>". $tmp["destinatario"] . "</font></b>";
			  }
			 
			?>
          </td>
          <td width="12%">Contatos</td>
          <td width="10%"><?=$contatos?>
          </td>
        </tr>
      </table></td>
  </tr>
  <?
	  }
	}
?>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
<?php
mysql_free_result($rsSistema);

mysql_free_result($rsCategoria);

mysql_free_result($rsStatus);

mysql_free_result($rsTipo);

mysql_free_result($rsMotivo);

mysql_free_result($rsUsuarios);

mysql_free_result($rsPrioridade);

mysql_free_result($rsAbertoPor);
?>
