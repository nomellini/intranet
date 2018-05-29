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
	

   if (!$limite) {
    $limite = '10';
   }
   

  $sql = "SELECT ";
  $sql .= "  id_chamado, descricao, dataa, datauc, status ";
  $sql .= "FROM ";
  $sql .="  chamado ";
  $sql .="WHERE ";
  $sql .="  sistema_id=22 ";
  
  if (!$fechados) {
    $sql .= "and status <> 1 ";
  }  else {
    $sql .= "and status = 1 ";  
  }
  $sql .="ORDER BY ";
  $sql .="  status desc, ";     
  $sql .="  dataa desc ";       

  
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
      <td colspan="4" align="center" valign="middle"><a href="rhstudio.php?fechados=<?=$fechados?0:1?>">RHSTUDIO 
          no SAD<br>
          (Chamados <?=$fechados?"encerrados":"abertos"?>)</a>
        </td>
    </tr>
  </table>
</form>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td width="11%">Chamado</td>
    <td width="15%">Abertura</td>
    <td width="74%">Descri&ccedil;ao resumida</td>
  </tr>
  <tr> 
    <td colspan="3">
	
	<?
      $result = mysql_query($sql) or die ( "ERRO NO SQL: $sql");  	
	  while ($linha=mysql_fetch_object($result)) {
	    $data = explode('-', $linha->dataa);
		$dataa = "$data[2]/$data[1]/$data[0]";
		$descricao = $linha->descricao;
		$descricao = eregi_replace("\r\n", "<br>",$descricao);
        $descricao = eregi_replace("\"", "`", $descricao);			
		$id_chamado = $linha->id_chamado;
		$status = $linha->status;
		if ($status==1) {
		  $cor = "CCCCCC";
		} else {
		  $cor = "FF0000";
		}
	?>
	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="<?=$cor?>">
        <tr>
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="1">
              <tr valign="top"> 
                <td width="10%"> <a href="../historicochamado.php?&id_chamado=<?=$id_chamado?>"> 
                  <?=$id_chamado?>
                  </a> </td>
                <td width="15%"> 
                  <?=$dataa?>
                </td>
                <td width="75%"> 
                  <?=$descricao?>
                </td>
              </tr>
            </table></td>
        </tr>
    </table><br>
<?
  }
?>
	
	
	 </td>
  </tr>
</table>
</body>
</html>
