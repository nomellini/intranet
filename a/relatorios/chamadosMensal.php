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


    $_ano = date("Y", time()-( 86400*30*1 ) );  
    $_mes = date("m", time()-( 86400*30*1 ) );
	
   $diase[0] = "Seg";
   $diase[1] = "Ter";
   $diase[2] = "Qua";
   $diase[3] = "Qui";
   $diase[4] = "Sex";
   $diase[5] = "Sáb";
   $diase[6] = "Dom";
	
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	


    if(!$ano) {
	  $ano = $_ano;
	}
	if(!$mes) {
	  $mes = $_mes;
	}



	$ch = statMensal($atendimento, $ano, $mes);

	$total = count($ch);	
    $somaChamados = 0;
	$maximo = 0;
    while( list($tmp1, $tmp) = each($ch) ) {
	  $somaChamados += $tmp["chamados"];
	}
	reset($ch);
    while( list($tmp1, $tmp) = each($ch) ) {
	$chamados= $tmp["chamados"];
      if($somaChamados) {
	    $ct = $chamados/$somaChamados*100;
	    if ($ct>$maximo) { $maximo=$ct;}
      }
	}
	
	if($maximo) {
      $ai = 11000/$maximo;
	} else {
	  $ai= 0;
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
<form name="form" method="post" action="chamadosMensal.php">
  <div align="center"><b>Acompanhamento di&aacute;rio de n&uacute;mero de chamados 
    abertos</b><br>
    <br>
  </div>
  <table width="90%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4" bgcolor="#FFCC99"> Selecione o ano 
		<select name="ano">
		<?
			$inicio = 2001;
			for($i=$inicio; $i<=$_ano; $i++)
			{
				print "<option value=$i>$i</option>";
			}
		?>
		</select>		
		
        e o m&ecirc;s 
        <select name="mes">
          <option value="1">Janeiro</option>
          <option value="2">Fevereiro</option>
          <option value="3">Mar&ccedil;o</option>
          <option value="4">Abril</option>
          <option value="5">Maio</option>
          <option value="6">Junho</option>
          <option value="7">Julho</option>
          <option value="8">Agosto</option>
          <option value="9">Setembro</option>
          <option value="10">Outubro</option>
          <option value="11">Novembro</option>
          <option value="12">Dezembro</option>
        </select>
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
  </table>
</form>
<table width="90%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
  <tr align="center" valign="bottom"> 
  <?  
  reset($ch);
  while( list($tmp1, $tmp) = each($ch) ) {
	$chamados = $tmp["chamados"];
    if($somaChamados) {
	  $ct = $chamados/$somaChamados*100;
	  $altura = $ai*$chamados/$somaChamados;
	} else {
	  $ct = 0;
	  $altura = 0;
	}
	$ct = sprintf ("%02.1f", $ct) . " %";

?>
  
    <td bgcolor="#FFCC99"> 
      <?="$ct"?>
      <br>
      <img src="../figuras/stats.gif" width="15" height=<?=$altura?>><br>
	  <?="$chamados"?>
    </td>
<?
}
?>	
  </tr>
  <tr align="center"> 
<?  
  reset($ch);
  while( list($tmp1, $tmp) = each($ch) ) {
	$dia = $tmp["dia"];
?>
    <td bgcolor="#FFCC33"> <a href="relat2.php?datai=<?="$dia/$mes/$ano"?>&dataf=<?="$dia/$mes/$ano"?>">
      <? echo  $dia . "<br>" . $diase[$tmp["dias"]] ?>
      </a> </td>
<?
}
?>
  </tr>
</table>
<script>
  document.form.mes.value = <?=$mes?>;
  document.form.ano.value = <?=$ano?>;  
</script>