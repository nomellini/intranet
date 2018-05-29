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
	
    //$pode = pegaGerencial($ok);   
	$pode = 1;
	
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {

   $objChamado = new chamado();
	

    $hoje = date("d/m/Y");	
	if ( !isset($data) ) {
      $data = date("d/m/Y");
	}
	
	$hoje = true;//($hoje==$data);
	
	
    $quando = explode("/", $data);
    $datar = "$quando[2]-$quando[1]-$quando[0]";
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];
//	$origem = 1;	
	$ch = statIdleDeAte($consultor, $datar, '2011-10-20', $origem);	
	$total = count($ch);
	
	if (!isset($minutos)) {
		$minutos = 0;
	}
	$segundos = $minutos*60;
?>
<html>
<head>
<title>Tempo ocioso</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="..\overlib.js"></SCRIPT>
<script src="coolbuttons.js"></script>
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

 function vai(chamado) {
   location.href = '/a/historicochamado.php?id_chamado=<?=$chamado_id?>';
   location.href = 'inicio.php?subPendente='+document.form2.subPendente.value+"#pendencias";
 }


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
<form name="form" method="post" action="relatorioidle2.php">
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><br>
  <table width="90%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4"> Consultor : 
        <select name="consultor" class="unnamed1">
		<option value="">Todos</option>
          <?  
    $consultores = pegaConsultores($atendimento);		
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $tmp["id_usuario"]==$consultor ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
        </select>
        Quantos minutos de intervalo ? 
        <input type="text" name="minutos" size="4" maxlength="4" class="unnamed1" value="<?=$minutos?>">
        data 
        <input type="text" name="data" size="12" maxlength="12" class="unnamed1" value="<?=$data?>">
        tipo 
        <select name="origem" class="bordaTexto">
          <option value="0">Todos</option>
          <?  

  $arrcat = listaTipos();
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $origem==$tmp["id_origem"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_origem"] . " $s >" . $tmp["origem"] . "</option>";
  }
?>
        </select>
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
  </table>
</form>
<blockquote> 
  <p><a name="inicio"></a>Listagem de chamados <br>
    Total de categorias nesta listagem : 
    <?=$total?>
  </p>
</blockquote>
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#333333" height="8">
  <tr bgcolor="#CCCCCC"> 
    <td colspan="2" align="center">&nbsp;</td>
    <td colspan="3" align="center">Contato</td>
    <td rowspan="2" align="center" width="10%">Intervalo entre<br>
      contatos</td>
  </tr>
  <tr bgcolor="#CCCCCC"> 
    <td width="10%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Consultor</font></td>
    <td width="10%" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Chamado</font></td>
    <td width="10%" align="center">Abertura</td>
    <td width="10%" align="center">Encerramento</td>
    <td width="10%" align="center">dura&ccedil;&atilde;o | Acumu. </td>
  </tr>
  <?  

  $data_ant = "0000-00-00";
  $mudou = 0;
  $primeiro=1;
  while( list($tmp1, $tmp) = each($ch) ) {     
	$chamado_id = $tmp["chamado_id"];
    $objChamado->lerChamado($chamado_id);  
    $nome = $tmp["nome"];
    $data = $tmp["data"];	
	$abriu = peganomeusuario( $objChamado->consultor_id ) ;
	$horaa = $tmp["horaa"];
	$horae = $tmp["horae"];	
    $tempo = $tmp["tempo"];
	$tempoSeg = $tmp["tempoSeg"];
	$origem = pegaOrigem($tmp["origem_id"]);	
    if($primeiro) {
	  $c = $nome;
	  $horaea = $horaa;	
    }  
	
	if (!$horae) {
	  $horae=$horaa;
	  $tempo = "Em Andamento";
	}

	if ($c<>$nome) {
	  $horaea = $horaa;	
	  $mudou = 1;
	} else 

	if ($data <> $data_ant) {
	  $horaea = $horaa;	
	  $primeiro = 1;
  	  $tempoSeg = 0;
	}
	$data_ant  = $data;
	
	
	
	$c=$nome;
	
	$cliente_id = $tmp["cliente_id"];
	
  if ($mudou and !$primeiro)
  {
    $agora = date("H:i:s");
    $idle =  timeDiff( $ha, $agora );
    $seg = HoraToSeg($idle);	
	$mudou = 0;
	$primeiro = 0;
		

		
    if($seg >= $segundos)  {
	?>
  <tr bgcolor="#FFFFFF"> 
    <td height="16" colspan="4" align="right"></td>
    <td height="16" align="center" valign="middle">Tot. <?=SegToHora($SegAcc)?></td>
    <td width="10%" height="16" align="center"> 
      <?=$idle?></td>
  </tr>
  <?
  }
 }  
  $primeiro=0;	 
	if ($horaea==$horaa) {
	  $idle = "Primeiro Contato";
      $SegAcc = $tempoSeg;
	 	  
	 } else {
	   $idle = timeDiff( $horaea, $horaa );
	   $seg = HoraToSeg($idle);	 
	   if (!$primeiro)
		   $SegAcc += $tempoSeg; 
	   
	 }	 
	 $horaea = $horae; 

     if(($seg >= $segundos) or ($idle == "Primeiro Contato")) {
  
?>
  <tr bgcolor="#FCE9BC" align="center" valign="middle"> 
    <td width="10%" height="16"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?=$nome?> <br> <?=$data;?> - <?=$tempoSeg; $acc += $tempoSeg?> <?= SegToHora($acc)?>  
      </font></td>
    <td width="10%" height="16"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$chamado_id?>';" >	
      <?=$chamado_id?>
      <br>
      <?=$origem?>
      </a> </font></td>
    <td width="10%" height="16" bgcolor="#FFCC66"> 
      <?=$horaa?>    </td>
    <td width="10%" height="16" bgcolor="#FFCC66"> 
      <?=$horae?>    </td>
    <td width="10%" height="16" bgcolor="#FFCC66"> 
      <?=$tempo?> &nbsp;&nbsp;|&nbsp;&nbsp;<?= SegToHora($SegAcc)?>   </td>
    <td width="10%" height="16"> 
      <?=$idle?>  </td>
  </tr>
  <? }
 	 $ha = $horae;  
	 
  }
  if (true) {
    $agora = date("H:i:s");
    $idle =  SegToHora($acc);
?>
  <tr bgcolor="#FFFFFF"> 
    <td height="16" colspan="4" align="right"> 
    </td>
    <td height="16" align="center" valign="middle">&nbsp;</td>
    <td width="10%" height="16" align="center"> 
      <?=$idle?></td>
  </tr>

  <?}?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font></p>
<?
}
?>
<!--  // onMouseOver="return overlib('<?=$msg?>', CAPTION, '<?=$cap?>', WIDTH, 400)" onMouseOut="nd();"	 -->