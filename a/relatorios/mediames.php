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


	$ch = StatsMediaContatoMensal($tipo, $datamace);

	$total = count($ch);
	
    $somaChamados = 0;
	$somaTempo = 0;
	$somaMedias = 0;
    while( list($tmp1, $tmp) = each($ch) ) {
	  $somaChamados += $tmp["contatos"];
	  $somaTempo += $tmp["temposeg"];	  
	  $somaMedia += $tmp["mediaseg"];
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
<div align="center"></div>
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
<form name="form" method="post" action="mediames.php">
  <div align="center"><b>M&eacute;dia de Contatos por M&ecirc;s</b> 
    <table width="98%" border="0" cellspacing="1" cellpadding="1">
      <tr valign="bottom"> 
        <td width="13%" height="6"> 
          <p>&nbsp;</p>
          <p>Tipo de contato</p>        </td>
        <td width="87%" height="6"> 
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
          </select></td>
      </tr>
      <tr valign="bottom">
        <td height="6">&nbsp;</td>
        <td height="6"><input <?php if (!(strcmp($_POST['datamace'],1))) {echo "checked=\"checked\"";} ?> name="datamace" type="checkbox" id="datamace" value="1" >
        Datamace</td>
      </tr>
      <tr valign="bottom">
        <td height="6">&nbsp;</td>
        <td height="6"><input type="submit" name="Submit" value="Submit" class="unnamed1"></td>
      </tr>
    </table>
    
  </div>
</form>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#999999" height="8">
  <tr bgcolor="#CCCCCC" align="center"> 
    <td width="20%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1">Ano</font></td>
    <td width="20%"> M&ecirc;s</td>
    <td width="20%"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Contatos</font></td>
    <td width="20%"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Tempo</font></td>
    <td width="20%"> M&eacute;dia</td>
  </tr>
  <?  
  while( list($tmp1, $tmp) = each($ch) ) {
	$id_cliente = $tmp["id_cliente"];
	$contatos = $tmp["contatos"];
	$ano = $tmp["ano"];	
	$mes = $tmp["mes"];	
	$tempo = $tmp["tempo"];
	$media = $tmp["media"];	
?>
  <tr bgcolor="#FCE9BC" align="center"> 
    <td width="20%" height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?=$ano?>
      </font></td>
    <td width="20%" height="16"> 
      <?=$mes?>
    </td>
    <td width="20%" height="16"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="relat2.php?tipo=<?=$tipo?>&id_cliente=<?=$id_cliente?>#inicio"> 
      <?=$contatos?>
      </a></font></td>
    <td width="20%" height="16"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$tempo?>
      </font></td>
    <td width="20%" height="16"> 
      <?=$media?>
    </td>
  </tr>
  <?
  }
?>
  <tr bgcolor="#FFFFFF" align="left"> 
    <td colspan="5" height="16"> 
      <div align="center"></div>
    </td>
  </tr>
</table>
<br>
<table width="70%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#CCCCCC">
  <tr bgcolor="#FFF4E8"> 
    <td width="33%">&nbsp;</td>
    <td width="24%"><b>Totais</b></td>
    <td width="43%"><b>M&eacute;dias</b></td>
  </tr>
  <tr bgcolor="#FFF4E8"> 
    <td width="33%"><b>Contatos</b></td>
    <td width="24%"> 
      <?=$somaChamados?>
    </td>
    <td width="43%"> <b> 
      <?=$somaChamados/$total?>
      </b> contatos / m&ecirc;s</td>
  </tr>
  <tr bgcolor="#FFF4E8"> 
    <td width="33%" height="19"><b>Tempo </b></td>
    <td width="24%" height="19"> 
      <?=segTohora($somaTempo)?>
    </td>
    <td width="43%" height="19"> <b> 
      <?=segTohora(floor($somaTempo/$somaChamados))?>
      </b> horas / contato</td>
  </tr>
</table>
<p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1">[<a href="javascript:history.go(-1)">voltar</a>]</font></font></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  </font></p>
<p>&nbsp;</p>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"><br>
  </font></font></font></p>
