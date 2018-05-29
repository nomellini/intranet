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
	
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	


	if (!isset($limite))
	{
		$limite  = 10;
	}


	if (!$ordem) {
	  $ordem = "chamados ";
	  $desc  = "DESC";
	}

	if ($desc) {
	  $msg = "Descendente de $ordem";	  
	} else {
	  $msg = "Ascendente de $ordem";
	}
		
	$o = "$ordem $desc";	

    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}

    if (!isset($limite)) {
      $limite=0;
	}

	$ch = statCategoriaMotivo($datai, $dataf, $sistema, $categoria, $motivo, $o, $limite);
	$sistemaId = $sistema;
	$categoriaId = $categoria;

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

function vai() {
  if(document.form.desc.value == 'DESC') {
    document.form.desc.value = '';
  } else {
    document.form.desc.value = 'DESC';
  }
    
  document.form.submit();
}

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
<p align="center"><b>Relat&oacute;rio agrupado por categorias e motivos</b></p>
<p align="center">&nbsp;Total nesta listagem : 
  <?=$total?>
  <br>
</p>
<form name="form" method="post" action="categoriamotivo.php">
  <table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
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
      <td width="10%">Sistema</td>
      <td width="44%"> <select name="sistema" class="bordaTexto">
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
        </select> </td>
      <td width="17%">Motivo</td>
      <td width="29%"> <select name="motivo" class="bordaTexto">
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
        </select> </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td bgcolor="#FCE9BC">Categoria</td>
      <td bgcolor="#FCE9BC"> <select name="categoria" class="bordaTexto">
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
        </select> </td>
      <td bgcolor="#FCE9BC">&nbsp;</td>
      <td bgcolor="#FCE9BC">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4" bgcolor="#FCE9BC"> Resultado em ordem <b> 
        <?=$msg?>
        </b> &nbsp;&nbsp;[<a href="javascript:vai();">Inverter ordena&ccedil;&atilde;o</a>] 
      - Limitar em 
      <label for="limite"></label>
      <input name="limite" type="text" class="borda_fina" id="limite" value="<?=$limite?>" size="10" maxlength="5"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4" bgcolor="#FCE9BC"> <input name="Submit" type="submit" value="pesquisar"> 
      </td>
    </tr>
  </table>
<br>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000" height="8">
  <tr bgcolor="#CCCCCC"> 
    <td width="20%" align="center"> 
      <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='sistema, categoria'; document.form.submit();">Sistema</a></font></div>
    </td>
    <td width="30%" align="center"> 
      <div align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='categoria'; document.form.submit();">Categoria</a></font></div>
    </td>
    <td width="40%"><a href="javascript:document.form.ordem.value='motivo'; document.form.submit();">Motivo</a></td>
    <td width="10%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='chamados'; document.form.submit();">Chamados</a></font></td>
  </tr>
  <?  
  while( list($tmp1, $tmp) = each($ch) ) {
	$id_categoria = $tmp["id_categoria"];
	$id_motivo = $tmp["id_motivo"];	
	$categoria = $tmp["categoria"];
	$chamados = $tmp["chamados"];
	$sistema = $tmp["sistema"];	
    if($somaChamados) {
	  $ct = $chamados/$somaChamados*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";

?>
  <tr bgcolor="#FCE9BC" align="left"> 
    <td width="20%" height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?=$sistema?>
      </font></td>
    <td width="30%" height="16"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="relat2.php?categoria=<?=$id_categoria?>&motivo=<?=$id_motivo?>#inicio"> 
      <?=$categoria?>
      </a></font></td>
    <td width="40%" height="16" bgcolor="#FCE9BC"> 
      <?=$tmp["motivo"]?>
    </td>
    <td width="10%" height="16" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$chamados?>
      </font></td>
  </tr>
  <?
  }
?>
  <tr bgcolor="#FFFFFF" align="left"> 
    <td width="20%" height="16">&nbsp;</td>
    <td width="30%" height="16"> 
      <div align="right">total de chamados : </div>
    </td>
    <td width="40%" height="16">&nbsp;</td>
    <td width="10%" height="16"> 
      <div align="center"> 
        <?=$somaChamados?>
      </div>
    </td>
  </tr>
</table>

<?	
	$link = "categoriamotivo_graph.php?datai=$datai&dataf=$dataf&sistema=$sistemaId&categoria=$categoriaId&motivo=$motivo&o=$o&limite=$limite&total=$somaChamados";
?><br>

<blockquote>
    <img src="<?=$link?>">
</blockquote>        



  <input type="hidden" name="desc" value="<?=$desc?>">
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font> 
  <input type="hidden" name="ordem" value="<?=$ordem?>">
  <br>
</form>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font></p>
