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
       $datai = date("d/m/Y", time()-( 86400*31 ) );  // 86400 = numero de segundos em um dia, 90 = 3 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
 
  $tmp = explode('/', $datai);
  $dataisql = "$tmp[2]-$tmp[1]-$tmp[0]";
  $tmp = explode('/', $dataf);
  $datafsql = "$tmp[2]-$tmp[1]-$tmp[0]";

  $sql  = "SELECT ";
  $sql .= "count(*) as soma, diagnostico ";
  $sql .= "FROM ";
  $sql .= "  chamado, diagnostico ";
  $sql .= "WHERE ";
  $sql .= "  id_diagnostico = diagnostico_id and ";
//  $sql .= "  diagnostico_id <> 9  and ";
  $sql .= "  chamado.dataa >= '$dataisql' and ";  
  $sql .= "  chamado.dataa <= '$datafsql' ";  
  if ($sistema) {
    $sql .= "and chamado.sistema_id = $sistema "; 
	$sisName = " o sistema <b>" . pegaSistema($sistema) . "</b>";
  } else {
    $sisName = " <b>todos</b> os sistemas ";
  }
  $sisName .= " no período de $datai até $dataf ";
  $sql .= "GROUP BY ";
  $sql .= "diagnostico_id order by soma desc";  
  $result = mysql_query($sql) or die($sql);

?>
<html>
<head>
<title>Relat&oacute;rio de Diagn&oacute;sticos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
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
<script src="coolbuttons.js"></script></head>
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
<form name="form" method="post" action="diag.php">
  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
    <tr align="left"> 
      <td width="45%" bgcolor="#666666"><font color="#FFFFFF"><b>Utilize as op&ccedil;&otilde;es 
        abaixo para alterar o relat&oacute;rio</b></font></td>
    </tr>
    <tr align="left"> 
      <td bgcolor="#FCE9BC">Data Inicial 
        <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" >
        Data Final 
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> 
        ] </td>
    </tr>
    <tr align="left"> 
      <td bgcolor="#FCE9BC"> Selecione o sistema 
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
        </select> </td>
    </tr>
    <tr align="left"> 
      <td><input type="submit" name="Submit" value="enviar"></td>
    </tr>
  </table>
<p>&nbsp;</p></form>


<table width="98%" border="1" align="center" cellpadding="1" cellspacing="1" bgcolor="#333333">
<caption>Diagnósticos para <?=$sisName?> </caption>
  <tr bgcolor="#333333"> 
    <td width="68%"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Diagn&oacute;stico</font></strong></td>
    <td width="32%" align="center"><strong><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">Quantidade</font></strong></td>
  </tr>
  <?
  $linhas = array();
  $qtde = 1;
  $soma = 0;
  $maior = 0;
  while ($linha=mysql_fetch_object($result)) {
    $tmp["diag"] = $linha->diagnostico;
	$tmp["qtde"] = $linha->soma;
	$linhas[$qtde] = $tmp;
	$soma += $tmp["qtde"];
?>
  <tr bgcolor="#FCE9BC"> 
    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $qtde++ . ". ".  $tmp["diag"]?></font></td>
    <td align="center" valign="middle"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $tmp["qtde"]?></font></td>
  </tr>
  <?
  }
?>
  <tr bgcolor="#FCE9BC"> 
    <td><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Soma</font></strong></td>
    <td align="center" valign="middle"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$soma?>
      </font></strong></td>
  </tr>
</table>

<br>
<br>
<?
 $maior = $linhas[1]["qtde"];
?>

<br>

<table width="98%" border="1" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
  <tr align="center" valign="bottom"> 
  <?  

  reset($linhas);
  $somaChamados = $soma;
  while( list($tmp1, $tmp) = each($linhas) ) {
	$chamados = $tmp["qtde"];
    if($somaChamados) {
	  $ct = $chamados/$somaChamados*100;
	  $altura = (200 * $chamados ) / $linhas[1]["qtde"];
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
  reset($linhas);
  $qtde = 1;
  while( list($tmp1, $tmp) = each($linhas) ) {
?>
    <td bgcolor="#FFCC33"> <? echo  $qtde++  ?></td>
<?
}
?>
  </tr>
</table>

<div align="center"><br>
  <br>
  SAD - Sistema de Atendimento Datamace </div>
</body>
</html>