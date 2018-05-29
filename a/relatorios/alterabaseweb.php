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
    $pode = pegaDiagnosticoUsuario($ok);
	$sql = "Select * from baseweb where id  =" . $id;
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link rel="stylesheet" href="/a/stilos.css" type="text/css">
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
<form name="form" method="post" action="doalterabaseweb.php">
  <a name="inicio"></a> 
  <table width="87%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">N&uacute;mero do Chamado </td>
      <td width="71%"> 
        <?=$linha->id_chamado?>
        &nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Data</td>
      <td width="71%"> 
        <?=$linha->data?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Sistema</td>
      <td width="71%"> 
        <?=pegasistema($linha->id_sistema)?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Programa</td>
      <td width="71%"> 
        <input type="text" name="programa" size="50" maxlength="50" class="unnamed1" value="<?=$linha->programa?>">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Relator</td>
      <td width="71%"> 
        <?=peganomeusuario($linha->id_usuario)?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Descri&ccedil;&atilde;o</td>
      <td width="71%"> 
        <input type="text" name="descricao" size="50" class="unnamed1" value="<?=$linha->descricao?>">
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Resumo</td>
      <td width="71%"> 
        <textarea name="resumo" cols="50" rows="8" class="unnamed1"><?=$linha->resumo?></textarea>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%">Diagn&oacute;stico</td>
      <td width="71%"> 
        <?= pegadiagnostico($linha->id_diagnostico)?>
      </td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="29%" height="31">&nbsp;</td>
      <td width="71%" height="31">
        <p>
    <input type="checkbox" name="cliente" value="1" <?=$linha->cliente?"checked":""?>>
    Documenta&ccedil;&atilde;o Internet<br>
    <input type="checkbox" name="somenteDesenvolvimento" value="1" <?=$linha->somenteDesenvolvimento?"checked":""?>  > 
    Vis&iacute;vel somente ao pessoal de desenvolvimento<br>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>(Desmarque este chekbox para que este item seja vis&iacute;vel a todos)<br>
     <br>
     <input name="atualizaData" type="checkbox" id="atualizaData" value="1">
</strong>Atualizar a Data do item na base<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>(Ative esta op&ccedil;&atilde;o para colocar no item a data atual) </strong></p>        </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td width="29%" height="31">&nbsp;</td>
      <td width="71%" height="31"> 
        <input type="submit" name="Submit" value="Enviar">
        <input type="hidden" name="id_base" value="<?=$id?>">
      </td>
    </tr>
  </table>
  </form>
<br><br><br><br><br><br><br><br><br><br><br>

</body>
</html>
