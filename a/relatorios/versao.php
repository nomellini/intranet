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
	  $ordem = "versao ";
	  $desc  = "DESC";
	}
	$o = "$ordem $desc";
	
	if (isset($_POST['base_dados']))
	{
		$base = $_POST['base_dados'];
	} else
	{
		$base = 0;
	}
	
	$ch = statVersao( $sistema, $o, $base, $grau );

	$total = count($ch);

	
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
<form name="form" method="post" action="versao.php">
  <div align="center"><b>Relat&oacute;rio de Sistemas e vers&atilde;o</b><br>
    <br>
  </div>
  <table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4"> <table width="438" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="129">Sistema</td>
          <td width="302"><select name="sistema" class="bordaTexto">
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
          </select></td>
        </tr>
        <tr>
          <td> Base de dados </td>
          <td><label for="base_dados"></label>
            <select name="base_dados" class="bordaTexto" id="base_dados">
              <option value="0" selected <?php if (!(strcmp(0, $_POST['base_dados']))) {echo "selected=\"selected\"";} ?>>Todos</option>
              <option value="1" <?php if (!(strcmp(1, $_POST['base_dados']))) {echo "selected=\"selected\"";} ?>>Sem SQL</option>
              <option value="2" <?php if (!(strcmp(2, $_POST['base_dados']))) {echo "selected=\"selected\"";} ?>>Com SQL</option>
            </select></td>
        </tr>
        <tr>
          <td>Grau</td>
          <td><select name="grau" class="bordaTexto">
            <option value="0">Todos</option>
            <option value="G1">G1</option>
            <option value="G2">G2</option>
            <option value="G3">G3</option>
            <option value="ZZ">Sem grau</option>
          </select></td>
        </tr>
      </table>
        <p>
          <input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
        Ordem decrescente ? 
        <input type="hidden" name="ordem" value="<?=$ordem?>">
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </p></td>
    </tr>
  </table>
</form>
<blockquote> 
  <p><a name="inicio"></a>Total de clientes listados : 
    <?=$total?>
  </p>
</blockquote>
<p>Pesquisar : 
  <label for="textfield"></label>
  <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'sf', 1)" />
</p>
<table width="93%" border="0" cellspacing="1" cellpadding="1" align="left" bgcolor="#999999" height="8" id="sf">
  <tr bgcolor="#CCCCCC"> 
    <td width="10%" align="center" height="14"> 
      <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_cliente'; document.form.submit();">Codigo</a></font></div>
    </td>
    <td align="center" height="14"> 
      <div align="left"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente.cliente'; document.form.submit();">Cliente</a></font></div>
    </td>
    <td valign="middle" align="center">SQL SERVER</td>
    <td valign="middle" align="center" height="14"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='sistema.sistema, clisis.32bit'; document.form.submit();">Sistema</a></font></td>
    <td width="5%" align="center" height="14">Inad.</td>
    <td width="5%" align="center" height="14">Bloq.</td>
  </tr>
  <?  
  while( list($tmp1, $tmp) = each($ch) ) {
	$id_cliente = $tmp["id_cliente"];
	$cliente = $tmp["cliente"] . " (". $tmp["grau"] . ")";	
	$sistema = $tmp["sistema"];
	$versao = $tmp["versao"];
	$ina = ""; $bloq="";
	if($tmp["inadimplente"]) {
     $ina="*";
	}
	if ($tmp["bloqueio"]) {
	  $bloq="*";
	}
	$sql = "Não";
	if ($tmp["usa_banco"]) {
	  $sql="<b>SIM</b>";
	} 
	
?>
  <tr bgcolor="#FCE9BC" align="left"> 
    <td width="10%" height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <a href="../../a/manut/marketing/clientes02.php?id_cliente=<?=rawurlencode($id_cliente)?>"> 
      <?=$id_cliente?>
      </a></font></td>
    <td height="16"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="relat2.php?id_cliente=<?=$id_cliente?>#inicio"> 
      <?=$cliente?></a> - [<a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>">Ver hist&oacute;rico</a>]</font></td>
    <td valign="middle" align="center"><?= $sql?></td>
    <td height="16" valign="middle" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$sistema?>
      </font></td>
    <td width="5%" height="16" align="center"> 
      <?=$ina?>
    </td>
    <td width="5%" height="16" align="center">
      <?=$bloq?>
    </td>
  </tr>
  <?
  }
?>
</table>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font></p>
<script type="text/javascript">
function filter2 (phrase, _id){
	var words = phrase.value.toLowerCase().split(" ");
	var table = document.getElementById(_id);
	var ele;
	for (var r = 1; r < table.rows.length; r++){
		ele = table.rows[r].innerHTML.replace(/<[^>]+>/g,"");
	        var displayStyle = 'none';
	        for (var i = 0; i < words.length; i++) {
		    if (ele.toLowerCase().indexOf(words[i])>=0)
			displayStyle = '';
		    else {
			displayStyle = 'none';
			break;
		    }
	        }
		table.rows[r].style.display = displayStyle;
	}
}  
  	if ('<?=$grau?>') {
		document.form.grau.value = '<?=$grau?>' 
	}
  
</script>