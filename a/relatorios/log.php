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
	  $ordem = "dataa ";
	  $desc  = "DESC";
	}
	$o = "$ordem $desc";

	$ch = pegaLog();
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
<blockquote> 
  <p><a name="inicio"></a></p>
</blockquote>
<table width="93%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#333333" height="8">
  <tr bgcolor="#CCCCCC"> 
    <td width="10%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Data</font></td>
    <td width="11%" align="center">hora</td>
    <td width="58%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1">Log</font></td>
    <td width="21%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Nome</font></td>
  </tr>
  <?  
  while( list($tmp1, $tmp) = each($ch) ) {
	$dataa = $tmp["data"];
	$hora = $tmp["hora"];
	$log =  $tmp["log"];
	$nome = $tmp["nome"];
?>
  <tr bgcolor="#FCE9BC"> 
    <td width="10%" height="16" valign="middle" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?=$dataa?>
      </font></td>
    <td width="11%" height="16" valign="middle" align="center"> 
      <?=$hora?>
    </td>
    <td width="58%" height="16" valign="middle"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?=$log?>
      </font></td>
    <td width="21%" height="16" valign="middle"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$nome?>
      </font></td>
  </tr>
  <?
  }
?>
</table>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font></p>
