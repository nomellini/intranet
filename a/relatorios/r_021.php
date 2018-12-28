<?php 

  require("../cabeca.php");	
?>
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


$query_rsMotivo = "SELECT * FROM motivo WHERE motivo <> '' ORDER BY motivo ASC";
$rsMotivo = mysql_query($query_rsMotivo) or die(mysql_error());
$row_rsMotivo = mysql_fetch_assoc($rsMotivo);
$totalRows_rsMotivo = mysql_num_rows($rsMotivo);


$query_rsTipoContato = "SELECT * FROM origem WHERE origem <> '' ORDER BY origem ASC";
$rsTipoContato = mysql_query($query_rsTipoContato) or die(mysql_error());
$row_rsTipoContato = mysql_fetch_assoc($rsTipoContato);
$totalRows_rsTipoContato = mysql_num_rows($rsTipoContato);
?><?

	require("../scripts/stats.php");	

	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
//    $pode = pegaGerencial($ok);   
//	if(!$pode) {
//	  require("../sinto.htm");
//	  exit;
//	} else {
//	
  {
    if (!isset($limite)) {
	  $limite = 50;
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

    $consultores = pegaConsultores($atendimento);		
    $diagnosticos = pegaDiagnosticos();

	$chamados = statEncaminhamentos( $o, 
	  $reaberto,
	  $id_usuario1, 
	  $id_usuario2, 
	  $acao, 
	  $datai,
	  $dataf,
	  $sistema,
	  $diagnostico,
	  $motivo,
	  $tipocontato,
	  $limite,
	  $palavra,
	  $Id_Categoria,
	  $cliente_id,
	  $horai
	  );	
	$total = count($chamados);
	

    $somaContatos = 0; $somaTempo = 0;
    while( list($tmp1, $tmp) = each($chamados) ) {
	  $somaContatos += $tmp["contatos"];
	  $somaTempo += $tmp["temposeg"];
	}
	reset($chamados);
	$tempoTotal = segToHora($somaTempo);
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link rel="stylesheet" href="/stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" background="../../imagens/fundo.gif" text="#000000"> 
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="..\overlib.js"></SCRIPT>
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
<form name="form" method="post" action="r_021.php">
  Listagem de chamados - 
  <?=$total?>
  <br>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#666666" align="left"> 
      <td colspan="4"><font color="#FFFFFF"><b>Utilize as op&ccedil;&otilde;es 
        abaixo para alterar o relat&oacute;rio</b></font></td>
    </tr>
    <tr bgcolor="#FCE9BC" align="left"> 
      <td colspan="4"><table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td width="16%">Mostrar chamados que </td>
            <td width="84%"><select name="id_usuario1" class="bordaTexto">
              <option value="0">Todos</option>
              <?  
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $id_usuario1==$tmp["id_usuario"] ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
            </select>
              enviou para
              <select name="id_usuario2" class="bordaTexto">
                <option value="0">Todos</option>
                <? 
    reset( $consultores);
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $id_usuario2==$tmp["id_usuario"] ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
              </select></td>
          </tr>
          <tr>
            <td>entre os dias</td>
            <td><input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)">
e
  <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>" onKeyPress="fdata(this)">
[<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> ] ,  Hora inicial 
<input type="text" name="horai" class="bordaTexto" 
  size="6" maxlength="5" value="<?=$horai?>" > 
* listar&aacute; contatos gravados a partir deste hor&aacute;rio</td>
          </tr>
          <tr>
            <td>sobre o sistema </td>
            <td><select name="sistema" class="bordaTexto" onChange="alteraCombo();">
              <option value="0">Todos</option>
<?  	
	$arrcat = listaSistemas($atendimento);
	$qtde = count($arrcat);	
	while( list($tmp1, $tmp) = each($arrcat) ) {
		$s = "";
		if ( $sistema==$tmp["id_sistema"] ) {
			$s = "SELECTED";
		}
		echo "<option value=". $tmp["id_sistema"] . " $s >" . $tmp["sistema"] . "</option>";
	}
?>
            </select></td>
          </tr>
          <tr>
            <td>Categoria</td>
            <td><span id=cat>Seleção de categoria</span></td>
          </tr>
          <tr>
            <td>cujo diagn&oacute;stico foi</td>
            <td><select name="diagnostico" class="bordaTexto">
              <option value="0">Todos</option>
              <?  
    while( list($tmp1, $tmp) = each($diagnosticos) ) {
      $s = "";
      if ( $diagnostico==$tmp["id_diagnostico"] ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_diagnostico"] . " $s >" . $tmp["diagnostico"] . "</option>";
    }
?>
            </select></td>
          </tr>
          <tr>
            <td>cujo motivo foi</td>
            <td><select name="motivo" class="bordaTexto" id="motivo">
              <option value="0" <?php if (!(strcmp(0, $_POST['motivo']))) {echo "selected=\"selected\"";} ?>>TODOS</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsMotivo['id_motivo']?>"<?php if (!(strcmp($row_rsMotivo['id_motivo'], $_POST['motivo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsMotivo['motivo']?></option>
              <?php
} while ($row_rsMotivo = mysql_fetch_assoc($rsMotivo));
  $rows = mysql_num_rows($rsMotivo);
  if($rows > 0) {
      mysql_data_seek($rsMotivo, 0);
	  $row_rsMotivo = mysql_fetch_assoc($rsMotivo);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td>Tipo de contato </td>
            <td><label>
              <select name="tipocontato" class="bordaTexto" id="tipocontato">
                <option value="0" <?php if (!(strcmp(0, $_POST['tipocontato']))) {echo "selected=\"selected\"";} ?>>Todos</option>
                <?php
do {  
?>
                <option value="<?php echo $row_rsTipoContato['id_origem']?>"<?php if (!(strcmp($row_rsTipoContato['id_origem'], $_POST['tipocontato']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsTipoContato['origem']?></option>
                <?php
} while ($row_rsTipoContato = mysql_fetch_assoc($rsTipoContato));
  $rows = mysql_num_rows($rsTipoContato);
  if($rows > 0) {
      mysql_data_seek($rsTipoContato, 0);
	  $row_rsTipoContato = mysql_fetch_assoc($rsTipoContato);
  }
?>
              </select>
            </label></td>
          </tr>
          <tr>
            <td>Contendo a palavra</td>
            <td><label for="palavra"></label>
            <input name="palavra" type="text" class="unnamed1" id="palavra" size="50" value="<?=$palavra?>"></td>
          </tr>
          <tr>
            <td>Cliente</td>
            <td><label for="cliente_id"></label>
            <input name="cliente_id" type="text" class="unnamed1" id="cliente_id" value="<?=$cliente_id?>"></td>
          </tr>
        </table>        
Observa&ccedil;&atilde;o
          <input type="checkbox" name="reaberto" value="1" <? if($reaberto) {echo "checked";}?>>
      Somente os que tiveram um contato REABERTO.</td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="4">Limitar resultado em 
        <input type="text" name="limite" maxlength="4" size="4" value="<?=$limite?>" class="bordaTexto">
        registros [<a href="javascript:document.form.limite.value='0';document.form.submit();">mostrar 
        todos</a>] </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="4"> 
        <input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
        Ordem decrescente ? 
        <input type="hidden" name="ordem" value="<?=$ordem?>">
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
  </table>
</form>
<a name="inicio"></a> 
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
  <tr bgcolor="#CCCCCC"> 
    <td width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_chamado'; document.form.submit();">Chamado</a></font></td>
    <td width="15%" align="center"> <a href="javascript:document.form.ordem.value='dataa'; document.form.submit();">Data</a></td>
    <td width="13%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></td>
    <td width="63%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      </font></td>
  </tr>
  <?  
  while( list($tmp1, $tmp) = each($chamados) ) {

	$historico = $tmp["historico"];
	$descricao = $tmp["descricao"];
	$categoria_str = $tmp["categoria"];
	$dono = $tmp["dono"];
	$cliente = $tmp["cliente"];	
	

?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="4" align="left" height="19"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="#FCE9BC">
          <td height="17" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$tmp["chamado_id"]?>';" >
            <?=$tmp["chamado_id"]?>
          </a></font></td>
          <td height="17" align="center"><?=$tmp["dataa"]?> <?=$tmp["horaa"]?> </td>
          <td height="17" bgcolor="#FCE9BC">Descri&ccedil;&atilde;o</td>
          <td height="17" colspan="3" bgcolor="#FCE9BC" onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'#FCE9BC');"><?=$descricao?></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td height="17" width="9%" align="center">&nbsp;</td>
          <td height="17" width="15%" align="center">&nbsp;</td>
          <td height="17" width="13%" bgcolor="#FCE9BC">Hist&oacute;rico</td>
          <td height="17" colspan="3" bgcolor="#FCE9BC" onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'#FCE9BC');"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            
            <?=$historico?>
            </font></b></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td width="9%">Sistema</td>
          <td width="15%" bgcolor="#FCE9BC"><b><font color="#000000"> 
            <?=$tmp["sistema"]?>
            </font></b></td>
          <td width="13%">Categoria</td>
          <td colspan="3" bgcolor="#FCE9BC"><b><font color="#000000"> 
            <?=$categoria_str?>
            </font></b></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td width="9%">Status</td>
          <td width="15%"><b> 
            <?=$tmp["status"]?>
            </b></td>
          <td width="13%">Fluxo</td>
          <td colspan="3" bgcolor="#FCE9BC"> 
            <?echo "<b><font color=#ff0000>". $tmp["remetente"] . "</font></b> encaminhou para <b><font color=#ff0000>". $tmp["destinatario"] . "</font></b>";
			 
			?>

          </td>
        </tr>
        <tr bgcolor="#FCE9BC">
          <td>Cliente</td>
          <td><?=$cliente?></td>
          <td>Dono</td>
          <td colspan="3" bgcolor="#FCE9BC"><?=$dono?></td>
        </tr>
      </table>
    </td>
  </tr>
  <?
  }
?>
</table>

<br><br><br><br><br><br><br><br><br><br><br>

<script language="javascript">


	function alteraCombo() {
		
		<?
			$sistema = pegaCategorias();
			$qtde    = count($sistema);
		?>		
		id_sistema = new Array(<?=$qtde?>);
		id_categoria = new Array(<?=$qtde?>);	 	 
		ds_categoria = new Array(<?=$qtde?>);
		var strAux;
		<? 
			$conta = 0;
			while ( list($tmp1, $tmp) = each($sistema) ) {
				$conta++;
				$ids = $tmp["id_sistema"];
				$idc = $tmp["id_categoria"];
				$cat = $tmp["categoria"];
				echo "id_sistema[$conta] = $ids;\n";
				echo "id_categoria[$conta] = $idc;\n";
				echo "ds_categoria[$conta] = '$cat';\n";	  
			}
		?>
		
		
		sistema  = document.form.sistema.value;
		categoria_id = '<?=$Id_Categoria?>';
		strAux = '<select name="Id_Categoria" class="unnamed1">\n';
		strAux +=  '<option value=0>Todas as categorias</optiont>\n';
		for(laco=1; laco <= <?=$qtde?>; laco++) {
			if ( id_sistema[laco] == sistema) {
				strAux = strAux +  '<option value = ' + id_categoria[laco] + '>' + ds_categoria[laco]+'</option>\n';
			}	   
		}
		strAux += '</select>';		
		cat.innerHTML = strAux;	 
//		window.alert(categoria_id);
		document.form.Id_Categoria.value = 0;
		
		

		
	}
	
	alteraCombo();
	categoria_id = '<?=$Id_Categoria?>';
	if (categoria_id != '')
	{
		document.form.Id_Categoria.value = '<?=$Id_Categoria?>';
	} 
	
	
</script>


</body>
</html>
<?php
	mysql_free_result($rsMotivo);
	mysql_free_result($rsTipoContato);
?>
<?
	}
?>