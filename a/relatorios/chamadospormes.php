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
	
    $ano = date("Y", time()-( 86400*30*1 ) );  
    $mes = date("m", time()-( 86400*30*1 ) );
	$last_day = date("t", $DataInicio);  	
	$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);
	$ate = date("Y-m-d", $DataFim);

	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	


	if (!$ordem) {
	  $ordem = "dataa ";
	  $desc  = "DESC";
	}
	$o = "$ordem $desc";

	$ch = statChamadosPorMes($atendimento, $o);

	$total = count($ch);
	
    $somaChamados = 0;
    while( list($tmp1, $tmp) = each($ch) ) {
	  $somaChamados += $tmp["chamados"];
	}
	reset($ch);
	
	
?>
<link rel="stylesheet" href="../stilos.css" type="text/css">
<script src="coolbuttons.js"></script>
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>


<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
 
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
 
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

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
</font></font><font face="Verdana, Arial, Helvetica, sans-serif"><font face="Verdana, Arial, Helvetica, sans-serif"><span class="style1"><br>
<br>
Quantidade de chamados por m&ecirc;s, exclu&iacute;ndo os chamados internos</span></font></font> 
<br>
<br>

<br>
<form name="form" method="post" action="chamadospormes.php">
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><br>
  <table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4">
<input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
        Ordem decrescente ? 
        <input type="hidden" name="ordem" value="<?=$ordem?>">
        <input type="submit" name="Submit" value="Submit">
      </td>
    </tr>
  </table>
</form>
<br>
<br>
<br>
<br>

<img src="grChamadosMensal.php?ate=<?=$ate?>">
<table width="71%" border="0" cellspacing="1" cellpadding="1" align="left" bgcolor="#333333" height="8" id="lista">
<thead>
  <tr bgcolor="#CCCCCC"> 
    <td width="17%" align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='ano, mes'; document.form.submit();">ano</a></font></td>
    <td width="55%"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='mes'; document.form.submit();">Mes</a></font></td>
    <td width="13%" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='chamados'; document.form.submit();">Chamados</a></font></td>
    <td width="15%" align="center">Porcentagem</td>
  </tr>
</thead>
<tbody>
  <?  
  while( list($tmp1, $tmp) = each($ch) ) {
	$ano = $tmp["ano"];
	$mes = $tmp["mes"];
	$mesa = $tmp["mesa"];
	$chamados = $tmp["chamados"];
    if($somaChamados) {
	  $ct = $chamados/$somaChamados*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";

?>
  <tr bgcolor="#FCE9BC"> 
    <td width="17%" height="16" valign="middle" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?=$ano?>
      </font></td>
    <td width="55%" height="16" valign="middle"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <a href="chamadosMensal.php?ano=<?=$ano?>&mes=<?=$mesa?>">
      <?=$mes?></a></font></td>
    <td width="13%" height="16" valign="middle" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$chamados?>
      </font></td>
    <td width="15%" height="16" align="center"> 
      <?=$ct?>
    </td>
  </tr>
  <?
  }
?>
</tbody>  
  <tr bgcolor="#FFFFFF"> 
    <td width="17%" height="16" align="left">&nbsp;</td>
    <td width="55%" height="16" align="left"> 
      <div align="right">total de chamados : </div>
    </td>
    <td width="13%" height="16" align="left"> 
      <div align="center"> 
        <?=$somaChamados?>
      </div>
    </td>
    <td width="15%" height="16" align="left">&nbsp;</td>
  </tr>
</table>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font></p>
<script>

	$(document).ready(function() {
	    $('#lista').dataTable();
	} );

</script>