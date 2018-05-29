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
	
	$mes = date("m");
	$ano = date("Y");
	
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	   $datai = "01/$mes/$ano";
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if ($id_sistema) {
	  $sistema = $id_sistema;
	}

   if (!$limite) {
    $limite = '10';
   }
  $quando = explode("/", $datai);
  $datair = "$quando[2]-$quando[1]-$quando[0]";
  $quando = explode("/", $dataf);
  $datafr = "$quando[2]-$quando[1]-$quando[0]";

  $sql  = "SELECT ";
  $sql .= "sistema.sistema, ";
  $sql .= "categoria.categoria, ";
  $sql .= "sum(time_to_sec(contato.horae) - time_to_sec(contato.horaa)) as tempo, ";
  $sql .= "sec_to_time(sum(time_to_sec(contato.horae) - time_to_sec(contato.horaa))) as t, ";
  $sql .= "count(*) as qtde ";
  $sql .= "from ";
  $sql .= "  chamado,"; 
  $sql .= "  contato, ";
  $sql .= "  categoria, ";
  $sql .= "  sistema ";
  $sql .= "where ";
  $sql .= "  contato.dataa >= '$datair' and contato.dataa <= '$datafr' and ";
  $sql .= "  chamado.sistema_id = sistema.id_sistema and ";
  $sql .= "  chamado.categoria_id = categoria.id_categoria and ";
  $sql .= "  chamado.id_chamado = contato.chamado_id and ";
  $sql .= "  chamado.descricao is not null  ";
  if ($sistema) {
    $sql .= "  and sistema.id_sistema = $sistema  ";
  } 
  $sql .= "group by ";
  $sql .= "  sistema, ";
  $sql .= " categoria ";
  $sql .= "order by ";
  $sql .= " tempo desc "; 
  $sql .= "LIMIT $limite";
 
  $result = mysql_query($sql);
  $total = 0; $contatos = 0;
  while ($linha = mysql_fetch_object($result)) 
  {
    $total += $linha->tempo;
    $contatos += $linha->qtde;	  
  }
  $result = mysql_query($sql);

?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" background="../../agenda/figuras/fundo.gif" text="#000000"> 
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
<form name="form" method="post" action="tempoporcategoria.php">
  <table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
    <tr align="left"> 
      <td colspan="4">Data Inicial 
        <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>">
        Data Final 
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> 
        ]&nbsp;&nbsp;&nbsp;&nbsp;Sistema 
        <select name="sistema" class="bordaTexto">
          <option value="0">Todos</option>
          <?  
  $arrcat = listaSistemas(1);
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $sistema==$tmp["id_sistema"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_sistema"] . " $s >" . $tmp["sistema"] . "</option>";
  }
?>
        </select> <input name="Button" type="button" class="unnamed1" value="Todos" onClick="javascript:document.form.limite.value='99999';document.form.submit();">
        <input name="Submit2" type="button" class="unnamed1" value="10 primeiros" onClick="javascript:document.form.limite.value='10';document.form.submit();">
        <input name="limite" type="hidden" id="limite" value="1000">
        <br>
        <a href="#grafico">ver gr&aacute;fico</a></td>
    </tr>
  </table>
</form>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="Mtable">
  <tr> 
    <td width="47%" height="19" align="left" bgcolor="#666666"><strong><font color="#FFFFFF">Categoria</font></strong></td>
    <td width="19%" align="right" bgcolor="#666666"><strong><font color="#FFFFFF">Tempo</font></strong></td>
    <td width="18%" align="center" bgcolor="#666666"><strong><font color="#FFFFFF">Porcentagem</font></strong></td>
    <td width="16%" align="right" bgcolor="#666666"><strong><font color="#FFFFFF">Contatos</font></strong></td>
  </tr>
  <?  
  while ($linha = mysql_fetch_object($result)) 
  {  
?>
  <tr> 
    <td height="19" align="left"> 
      <?=++$soma?>
      . 
      <? if (!$sistema) {
	      echo "$linha->sistema. ";
	  	     } 
	  ?>
      <?=$linha->categoria?>
    </td>
    <?
        $ct = $linha->tempo/$total*100;
		$ct = sprintf ("%02.2f", $ct) . "%";
	?>
    <td align="right"> <b> 
      <?=$linha->t?>
      </b> <div align="center"></div></td>
    <td align="center"> 
      <?=$ct?>
    </td>
    <td align="right"> 
      <?
        $ct = $linha->qtde/$contatos*100;
		$ct = sprintf ("%02.2f", $ct) . "%";
	?>
      <b> 
      <?=$linha->qtde?>
      </b>&nbsp;&nbsp; 
      <?=$ct?>
    </td>
  </tr>
  <?
  }
?>
  <tr valign="middle"> 
    <td height="19" align="right">Tempo Total : </td>
    <td align="right"> <strong><font color="#003366"> 
      <?=segTohora($total)?>
      </font></strong> 
      <div align="center"></div></td>
    <td align="center">&nbsp;</td>
    <td align="center"><strong><font color="#003366"> 
      <?=$contatos?>
      </font></strong></td>
  </tr>
</table>
</body>
</html>
