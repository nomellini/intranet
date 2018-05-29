<?
	require("../../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
    $pode = pegaMarketing($ok);
	if(!$pode) {
	  require("../../sinto.htm");
	  exit;
	} else {
	

	$alfabeto = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";


	if(!$letra) 
		if (!$TIPO)	
		  $letra = "A";
		  
	$tamanho=strlen($alfabeto);
	$le = strtoupper(substr($letra, 0, 1));
	$link = "";
	for( $i=0; $i < $tamanho; $i++) {
	  $l = substr($alfabeto, $i, 1);
	  if ($l <> $le ) {
        $link .= "<a href=\"$SCRIPT_NAME?letra=$l\">$l</a> \n";
	  } else {
	    $link .= "<font size=\"3\" color=\"#FF0000\"><b>$l</b></font> ";
	  }
	}
    $link .= "<a href=\"$SCRIPT_NAME?TIPO=sla\">sla</a> \n";
	  
?>
<html>
<head>
<script src="../../coolbuttons.js"></script>
<link rel="stylesheet" href="../../stilos.css" type="text/css">
<body bgcolor="#FFFFFF" text="#000000">
<table width="50%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton"><a href="/a/manut/marketing.php"><img src="../../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      p/ manuten&ccedil;&atilde;o</a></td>
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
<title>Listagem de clientes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../stilos.css" type="text/css">
<p><img src="../../figuras/intro.gif" width="321" height="21"> <br>
  Cadastro de Clientes</p>
<p> 
  <?=$link?>
<form action="clientes01.php" name="form">
  Selecione uma letra acima ou tecle as primeiras letras do cliente 
  <input type="text" name="letra" class="unnamed1" onKeyPress=teclado(); value="<?=$letra?>"><br>
  
</form>
<p>Selecione um cliente para maiores detalhes ou clique em [<a href="novocliente.php">Cadastrar 
  novo cliente</a>]<br>
</p>
<table width="80%" border="0" cellspacing="1" cellpadding="1">
  <tr bgcolor="#666666"> 
    <td width="21%"><b><font color="#FFFFFF">C&oacute;digo</font></b></td>
    <td width="79%"><b><font color="#FFFFFF">Nome</font></b></td>
  </tr>
  <?
    $sql = "SELECT id_cliente, cliente FROM clienteplus WHERE ( cliente like '$letra%' OR id_cliente like '$letra%') ";
	if ($TIPO == 'sla')
		$sql .= " and ic_sla = 1 ";
	$sql .= " ORDER BY cliente;";
	$result = mysql_query($sql);
	while( $linha = mysql_fetch_object($result) ) {
	  $id = $linha->id_cliente;
	  $cl = $linha->cliente;	  
  ?>
  <tr bgcolor="#FCE9BC"> 
    <td width="21%"><a href="clientes02.php?id_cliente=<?=rawurlencode($id)?>"> 
      <?=$id?>
      </a></td>
    <td width="79%"><a href="clientes02.php?id_cliente=<?=rawurlencode($id)?>"> 
      <?=$cl?>
      </a></td>
  </tr>
  <?
  }
  ?>
</table>
<p>&nbsp;</p>
<script>
  function teclado() {
  var ch=String.fromCharCode(window.event.keyCode);
  var t = 0;
  var re=ch.charCodeAt(0);
  if (re==13) {
    document.form.submit();   
  }
  }
 
</script>
</body>
</html>
<?
}
?>