<?
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

	$chamados = statChamados( 
		$o, 
		$ok, 
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
		0, 	  
		0,
		$id_prioridade,
		$abertoPor,
		0, 0, 0		  	  
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
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

<form name="form" method="post" action="listachamados.php">
  <?
if (
     ($id_usuario==1) or ($id_usuario==15) or // Edson  - Ronaldo
	 ($id_usuario==2) or ($id_usuario==19) or // Marcelo - ADM
	 ($id_usuario==12) // Fernando
	 )
	 {

?>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#FCE9BC"> 
      <td width="23%">Consultor</td>
      <td width="77%"> 
        <select name="consultor" class="unnamed1">
          <option value="0">Todos</option>
          <?  
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $consultor==$tmp["id_usuario"] ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
        </select>
      </td>
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
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> 
        ] </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td width="14%">Categoria</td>
      <td width="27%"> 
        <select name="categoria" class="bordaTexto">
          <option value="0">Todos</option>
          <?  

  $arrcat = listaCategorias($atendimento);
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $categoria==$tmp["id_categoria"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_categoria"] . " $s >" . $tmp["categoria"] . "</option>";
  }
?>
        </select>
      </td>
      <td width="8%">Status</td>
      <td width="51%"> 
        <select name="status" class="bordaTexto">
          <option value="0">Todos</option>
          <?  
  $arrstatus = listaStatus();
  while( list($tmp1, $tmp) = each($arrstatus) ) {
    $s = "";
    if ( $status==$tmp["id_status"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_status"] . " $s >" . $tmp["status"] . "</option>";
  }
?>
        </select>
      </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td width="14%">Tipo</td>
      <td width="27%"> 
        <select name="tipo" class="bordaTexto">
          <option value="0">Todos</option>
          <?  

  $arrcat = listaTipos();
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $tipo==$tmp["id_origem"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_origem"] . " $s >" . $tmp["origem"] . "</option>";
  }
?>
        </select>
      </td>
      <td width="8%">Motivo</td>
      <td width="51%"> 
        <select name="motivo" class="bordaTexto">
          <option value="0">Todos</option>
          <?  
  $arrstatus = listaMotivos();
  while( list($tmp1, $tmp) = each($arrstatus) ) {
    $s = "";
    if ( $motivo==$tmp["id_motivo"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_motivo"] . " $s >" . $tmp["motivo"] . "</option>";
  }
?>
        </select>
      </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td width="14%">Cliente</td>
      <td colspan="3" bgcolor="#FCE9BC"> 
        <input type="text" name="id_cliente" class="bordaTexto" size="20" maxlength="20" value="<?=$id_cliente?>">
        [<a href="javascript:seleciona(); ">pesquisar</a>] [<a href="javascript:limpa();">Limpar 
        Cliente</a>]</td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td>Sistema</td>
      <td colspan="3">
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
        </select>
      </td>
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
        Buscar palavra 
        <input type="text" name="palavra" class="bordaTexto" value="<?=$palavra?>">
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
      <a href="javascript:document.form.ordem.value='descr'; document.form.submit();">Descri&ccedil;&atilde;o</a> 
      -[<a href="javascript:document.form.ordem.value='valor'; document.form.submit();">prioridade</a>][<a href="javascript:document.form.ordem.value='sistema'; document.form.submit();">sistema</a>] 
      [<a href="javascript:document.form.ordem.value='categoria'; document.form.submit();">Categoria</a>] 
      [<a href="javascript:document.form.ordem.value='status'; document.form.submit();">status</a>][<a href="javascript:document.form.ordem.value='motivo'; document.form.submit();">motivo</a>] 
      [<a href="javascript:document.form.ordem.value='tempo'; document.form.submit();">tempo</a>] 
      [<a href="javascript:document.form.ordem.value='nome'; document.form.submit();">consultor</a>][<a href="javascript:document.form.ordem.value='contatos'; document.form.submit();">contatos</a>]</font></td>
  </tr>
  <?  
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
  
  
    $id = $tmp["chamado_id"];
	$cliente = $tmp["cliente"];
	$id_cliente=$tmp["id_cliente"];
	$contatos = $tmp["contatos"];
	$tempo = $tmp["tempo"];
	$tempos = $tmp["temposeg"];
	$dataa = $tmp["dataa"];
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
	
	$msg = "<b>Chamado aberto em $dataa:<br></b> " . $descricaoc;
	$msg = "$msg<hr noshade size=1><b>Ultimo Contato:<br></b> ". ultimoHistoricoChamado($id);
	$msg = eregi_replace("\r\n", "<br>", $msg);
	$msg = eregi_replace("\"", "`", $msg);	

    list($tmp1, $tmp2) = each(pegaClientePorCodigoUnico($cliente_id));	
	$cap = strtoupper($tmp2["cliente"]) . " ($cliente_id)";

?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="4" align="left" height="19"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="#FCE9BC"> 
          <td height="17" width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">
		  <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" onMouseOver="return overlib('<?=$msg?>', CAPTION, '<?=$cap?>', WIDTH, 400)" onMouseOut="nd();">
            <?=$ch?>
            </a></font></td>
          <td height="17" width="15%" align="center"> 
            <?=$dataa?>
          </td>
          <td height="17" width="13%" bgcolor="#FCE9BC"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>"> 
            <?=$id_cliente?>
            </a></font></td>
          <td height="17" colspan="3" bgcolor="#FCE9BC" onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'#FCE9BC');"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <a href="../historicochamado.php?id_chamado=<?=$id?>&palavra=<?=$palavra?>"> 
            <?=$descricao?>
            ...</a></font></b></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td width="9%">Sistema</td>
          <td width="15%" bgcolor="#FCE9BC"><b><font color="#000000"> 
            <?=$tmp["sistema"]?>
            </font></b></td>
          <td width="13%">Categoria</td>
          <td colspan="3" bgcolor="#FCE9BC"><b><font color="#000000"> 
            <?=$tmp["categoria"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td width="9%">Status</td>
          <td width="15%"><b> 
            <?=$tmp["status"]?>
            </b></td>
          <td width="13%">Motivo</td>
          <td colspan="3" bgcolor="#FCE9BC"><b><font color="#000000"> 
            <?=$tmp["motivo"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td width="9%">Prioridade</td>
          <td width="15%" bgcolor="#FCE9BC"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <?=$pri?>
            </font></b> </td>
          <td width="13%">Aberto por</td>
          <td width="41%"> 
            <?
			  echo "<b><font color=#006600>".$tmp["consultor"]."</font></b>" ;
			  if ($tmp["consultor"]  != $tmp["destinatario"] ) {
			    echo " - Encaminhado para : <b><font color=#ff0000>". $tmp["destinatario"] . "</font></b>";
			  }
			 
			?>
          </td>
          <td width="12%">Contatos</td>
          <td width="10%"> 
            <?=$contatos?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?
  }
?>
</table>

<br><br><br><br><br><br><br><br><br><br><br>

</body>
</html>
