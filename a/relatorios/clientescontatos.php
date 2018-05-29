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
 
	if (!$ordem) {
	  $ordem = "contatos ";
	  $desc  = "DESC";
	}
	
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}	
	
	if (!isset($limite)) {
	 $limite = 10;
    }
	
	$o = "$ordem $desc";

	$ch = statClientesContatos( $atendimento, $o, $tipo, $limite, $datai, $dataf, $sistema);

	$total = count($ch);
	
    $somaChamados = 0;
    while( list($tmp1, $tmp) = each($ch) ) {
	  $somaChamados += $tmp["contatos"];
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
<form name="form" method="post" action="clientescontatos.php">
  <div align="center">
    <p><b>Relat&oacute;rio de Contatos por cliente</b></p>
    <table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
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
        <td width="10%">Tipo de contato</td>
        <td colspan="3" bgcolor="#FCE9BC" width="90%"> 
          <select name="tipo" class="unnamed1">
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
      </tr>
      <tr bgcolor="#FCE9BC"> 
        <td width="10%">Sistema</td>
        <td colspan="3" bgcolor="#FCE9BC" width="90%"> 
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
        <td colspan="4"> 
          <p>Limitar resultado em 
            <input type="text" name="limite" size="4" maxlength="4" value="<?=$limite?>" class="unnamed1">
            registros [<a href="javascript:document.form.limite.value='0';document.form.submit();">mostrar 
            todos</a>]<br>
            <input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
            Ordem decrescente ? 
            <input type="hidden" name="ordem" value="<?=$ordem?>">
            <input type="submit" name="Submit2" value="Submit" class="unnamed1">
          </p>
          <p>&nbsp; </p>
        </td>
      </tr>
    </table>
    <br>
  </div>
  </form>
<blockquote> 
  <p><a name="inicio"></a>Total de clientes listados : 
    <?=$total?>
  </p>
</blockquote>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#999999" height="8">
  <tr bgcolor="#CCCCCC"> 
    <td width="25%" align="center"> 
      <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_cliente'; document.form.submit();">Codigo</a></font></div>
    </td>
    <td width="60%" align="center"> 
      <div align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></div>
    </td>
    <td width="15%" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='contatos'; document.form.submit();">Contatos</a></font></td>
    <td width="15%" align="center">Porcentagem</td>
  </tr>
  <?  
  while( list($tmp1, $tmp) = each($ch) ) {
	$id_cliente = $tmp["id_cliente"];
	$chamados = $tmp["contatos"];
	$cliente = $tmp["grau"] . " " . $tmp["cliente"];			
    if($somaChamados) {
	  $ct = $chamados/$somaChamados*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";

?>
  <tr bgcolor="#FCE9BC" align="left"> 
    <td width="25%" height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?=$id_cliente?>
      </font></td>
    <td width="60%" height="16"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="relat2.php?tipo=<?=$tipo?>&id_cliente=<?=$id_cliente?>#inicio"> 
      <?=$cliente?>
      </a></font></td>
    <td width="15%" height="16" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$chamados?>
      </font></td>
    <td width="15%" height="16" align="center"> 
      <?=$ct?>
    </td>
  </tr>
  <?
  }
?>
  <tr bgcolor="#FFFFFF" align="left"> 
    <td width="25%" height="16">&nbsp;</td>
    <td width="60%" height="16"> 
      <div align="right">total de contatos : </div>
    </td>
    <td width="15%" height="16"> 
      <div align="center"> 
        <?=$somaChamados?>
      </div>
    </td>
    <td width="15%" height="16">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF" align="left"> 
    <td colspan="4" height="16"> 
      <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1">[<a href="javascript:history.go(-1)">voltar</a>]</font></font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        </font></div>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"><br>
  </font></font></font></p>
