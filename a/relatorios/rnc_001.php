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
	

    $limite = 0;	
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	


    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if (!$ordem) {
	  $ordem = "id_chamado ";
	  $desc  = "DESC";
	}
	$o = "$ordem $desc";

    $consultores = pegaConsultores($atendimento);		


?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
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

<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" ><table width="43%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
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
</font>
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

<form name="form" method="post" action="">

  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
  </font>
  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#666666" align="left"> 
      <td colspan="2"><font color="#FFFFFF"><b>Utilize as op&ccedil;&otilde;es 
        abaixo para alterar o relat&oacute;rio</b></font></td>
    </tr>
    <tr bgcolor="#FCE9BC" align="left"> 
      <td colspan="2">Data Inicial 
        <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)">
        Data Final 
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> 
        ] </td>
    </tr>
    <tr bgcolor="#FCE9BC">
      <td width="6%">Status</td>
      <td><select name="status" class="bordaTexto">
         <option value="0" >Selecione </option>
        <option value="1" >Encerrados</option>
        <option value="2">Abertos</option>
                    </select>      </td> 
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="2"><input type="hidden" name="ordem" value="<?=$ordem?>">
        <input type="submit" name="Submit" value="Submit" class="unnamed1">      </td>
    </tr>
  </table>
</form>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" id="abas">
  <tr>
    <td height="12">&nbsp;</td>
    <td align="center"><a href="javascript:aba(1);">
      N&atilde;o conformidades 
    </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><a href="javascript:aba(2);">
      A&ccedil;&otilde;es de melhoria
    </a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><a href="javascript:aba(3);">
      A&ccedil;&otilde;es Preventivas 
    </a></td>
    <td>&nbsp;</td>
  </tr>
</table>

<span id="tab1">
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF">

<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
  <tr bgcolor="#CCCCCC"> 
    <td width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_chamado'; document.form.submit();">Chamado</a></font></td>
    <td width="15%" align="center"> <a href="javascript:document.form.ordem.value='dataa'; document.form.submit();">Data</a></td>
    <td width="13%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></td>
    <td width="63%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <a href="javascript:document.form.ordem.value='descr'; document.form.submit();">Descri&ccedil;&atilde;o</a> 
      -[<a href="javascript:document.form.ordem.value='valor'; document.form.submit();">prioridade</a>][<a href="javascript:document.form.ordem.value='sistema'; document.form.submit();">sistema</a>] 
      [<a href="javascript:document.form.ordem.value='categoria'; document.form.submit();">Categoria</a>] 
      [<a href="javascript:document.form.ordem.value='status'; document.form.submit();">status</a>][<a href="javascript:document.form.ordem.value='motivo'; document.form.submit();">motivo</a>] 
      [<a href="javascript:document.form.ordem.value='tempo'; document.form.submit();">tempo</a>] 
      [<a href="javascript:document.form.ordem.value='nome'; document.form.submit();">consultor</a>][<a href="javascript:document.form.ordem.value='contatos'; document.form.submit();">contatos</a>]</font></td>
  </tr>
  
  
  
  
  <?  
  

	$chamados = statRnc001($o, 
	  $consultor, 
	  $atendimento, 
	  $status, 
	  $categoria, 
	  $tipo, 
	  $datai,
	  $dataf,
	  $motivo,
	  $id_cliente,
	  $limite,
	  $enc,
	  $palavra,
	  $sistema,
	  $externo,
	  1);	

	$total = count($chamados);
	reset($chamados);
  
  while( list($tmp1, $tmp) = each($chamados) ) {
  
		   	   $pri = $tmp["prioridade"];
			   $prioridadev = $tmp["prioridadev"];
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $pri = "<b><font color=$cor>$pri</font></b>";	
			   
			   $cor_fundo = "#FCE9BC";
			   if ($tmp["externo"]) {
                 $cor_fundo = "#D2E3FF";
			   }			   
  
  
    $id = $tmp["chamado_id"];
	$cliente = $tmp["cliente"];
	$id_cliente=$tmp["id_cliente"];
	$contatos = $tmp["contatos"];
	$tempo = $tmp["tempo"];
	$tempos = $tmp["temposeg"];
	$dataa = $tmp["dataa"];
	$descricao = $tmp["descricao"];
	$descricaoc = $tmp["descricaoc"];	
	if ($palavra) {
      $descricao = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $descricao);
     }

	if($somaContatos) {
	  $ct = $contatos/$somaContatos*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";
	
	if ($somaTempo) {
      $pt = $tempos/$somaTempo*100; 
	} else {
	  $pt = 0;
	}
	$pt = sprintf ("%02.2f", $pt) . " %";	
	$ch = sprintf ("%04.0f", $id);
	
//	$msg = "<b>Chamado aberto em $dataa:<br></b> " . $descricaoc;
//	$msg = "$msg<hr noshade size=1><b>Ultimo Contato:<br></b> ". ultimoHistoricoChamado($id);
//	$msg = eregi_replace("\r\n", "<br>", $msg);
//	$msg = eregi_replace("\"", "`", $msg);	

    list($tmp1, $tmp2) = each(pegaClientePorCodigoUnico($cliente_id));	
	$cap = strtoupper($tmp2["cliente"]) . " ($cliente_id)";

?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="4" align="left" height="19"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="<?=$cor_fundo?>"> 
          <td height="17" width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" > 

<!--            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" onMouseOver="return overlib('<?=$msg?>', CAPTION, '<?=$cap?>', WIDTH, 400)" onMouseOut="nd();"> 			-->
            <?=$ch?>
            </a></font></td>
          <td height="17" width="15%" align="center"> 
            <?=$dataa?>
          </td>
          <td height="17" width="13%" ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>"> 
            <?=$id_cliente?>
            </a></font></td>
          <td height="17" colspan="3"  onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'<?=$cor_fundo?>');"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <a href="../historicochamado.php?id_chamado=<?=$id?>&palavra=<?=$palavra?>"> 
            <?=$descricao?>
            ...</a></font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Sistema</td>
          <td width="15%" ><b><font color="#000000"> 
            <?=$tmp["sistema"]?>
            </font></b></td>
          <td width="13%">Categoria</td>
          <td colspan="3" ><b><font color="#000000"> 
            <?=$tmp["categoria"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Status</td>
          <td width="15%"><b> 
            <?=$tmp["status"]?>
            </b></td>
          <td width="13%">Motivo</td>
          <td colspan="3" ><b><font color="#000000"> 
            <?=$tmp["motivo"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Prioridade</td>
          <td width="15%" ><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <?=$pri?>
            </font></b> </td>
          <td width="13%">Aberto por</td>
          <td width="41%"> 
            <?
			  echo "<b><font color=#006600>".$tmp["consultor"]."</font></b>" ;
			  if ($tmp["consultor"]  != $tmp["destinatario"] ) {
			    echo " - Encaminhado para : <b><font color=#ff0000>". $tmp["destinatario"] . "</font></b>";
			  }
			 
			?>
          </td>
          <td width="12%">Contatos</td>
          <td width="10%"> 
            <?=$contatos?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?
  }
?>
</table>

    </td>
  </tr>
</table>
</span>

<span  id="tab2">
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF">
	
	
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
  <tr bgcolor="#CCCCCC"> 
    <td width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_chamado'; document.form.submit();">Chamado</a></font></td>
    <td width="15%" align="center"> <a href="javascript:document.form.ordem.value='dataa'; document.form.submit();">Data</a></td>
    <td width="13%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></td>
    <td width="63%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <a href="javascript:document.form.ordem.value='descr'; document.form.submit();">Descri&ccedil;&atilde;o</a> 
      -[<a href="javascript:document.form.ordem.value='valor'; document.form.submit();">prioridade</a>][<a href="javascript:document.form.ordem.value='sistema'; document.form.submit();">sistema</a>] 
      [<a href="javascript:document.form.ordem.value='categoria'; document.form.submit();">Categoria</a>] 
      [<a href="javascript:document.form.ordem.value='status'; document.form.submit();">status</a>][<a href="javascript:document.form.ordem.value='motivo'; document.form.submit();">motivo</a>] 
      [<a href="javascript:document.form.ordem.value='tempo'; document.form.submit();">tempo</a>] 
      [<a href="javascript:document.form.ordem.value='nome'; document.form.submit();">consultor</a>][<a href="javascript:document.form.ordem.value='contatos'; document.form.submit();">contatos</a>]</font></td>
  </tr>
  
  
  
  
  <?  
  

	$chamados = statRnc001($o, 
	  $consultor, 
	  $atendimento, 
	  $status, 
	  $categoria, 
	  $tipo, 
	  $datai,
	  $dataf,
	  $motivo,
	  $id_cliente,
	  $limite,
	  $enc,
	  $palavra,
	  $sistema,
	  $externo,
	  2);	

	$total = count($chamados);
	reset($chamados);
  
  while( list($tmp1, $tmp) = each($chamados) ) {
  
		   	   $pri = $tmp["prioridade"];
			   $prioridadev = $tmp["prioridadev"];
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $pri = "<b><font color=$cor>$pri</font></b>";	
			   
			   $cor_fundo = "#FCE9BC";
			   if ($tmp["externo"]) {
                 $cor_fundo = "#D2E3FF";
			   }			   
  
  
    $id = $tmp["chamado_id"];
	$cliente = $tmp["cliente"];
	$id_cliente=$tmp["id_cliente"];
	$contatos = $tmp["contatos"];
	$tempo = $tmp["tempo"];
	$tempos = $tmp["temposeg"];
	$dataa = $tmp["dataa"];
	$descricao = $tmp["descricao"];
	$descricaoc = $tmp["descricaoc"];	
	if ($palavra) {
      $descricao = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $descricao);
     }

	if($somaContatos) {
	  $ct = $contatos/$somaContatos*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";
	
	if ($somaTempo) {
      $pt = $tempos/$somaTempo*100; 
	} else {
	  $pt = 0;
	}
	$pt = sprintf ("%02.2f", $pt) . " %";	
	$ch = sprintf ("%04.0f", $id);
	
//	$msg = "<b>Chamado aberto em $dataa:<br></b> " . $descricaoc;
//	$msg = "$msg<hr noshade size=1><b>Ultimo Contato:<br></b> ". ultimoHistoricoChamado($id);
//	$msg = eregi_replace("\r\n", "<br>", $msg);
//	$msg = eregi_replace("\"", "`", $msg);	

    list($tmp1, $tmp2) = each(pegaClientePorCodigoUnico($cliente_id));	
	$cap = strtoupper($tmp2["cliente"]) . " ($cliente_id)";

?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="4" align="left" height="19"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="<?=$cor_fundo?>"> 
          <td height="17" width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" > 

<!--            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" onMouseOver="return overlib('<?=$msg?>', CAPTION, '<?=$cap?>', WIDTH, 400)" onMouseOut="nd();"> 			-->
            <?=$ch?>
            </a></font></td>
          <td height="17" width="15%" align="center"> 
            <?=$dataa?>
          </td>
          <td height="17" width="13%" ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>"> 
            <?=$id_cliente?>
            </a></font></td>
          <td height="17" colspan="3"  onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'<?=$cor_fundo?>');"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <a href="../historicochamado.php?id_chamado=<?=$id?>&palavra=<?=$palavra?>"> 
            <?=$descricao?>
            ...</a></font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Sistema</td>
          <td width="15%" ><b><font color="#000000"> 
            <?=$tmp["sistema"]?>
            </font></b></td>
          <td width="13%">Categoria</td>
          <td colspan="3" ><b><font color="#000000"> 
            <?=$tmp["categoria"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Status</td>
          <td width="15%"><b> 
            <?=$tmp["status"]?>
            </b></td>
          <td width="13%">Motivo</td>
          <td colspan="3" ><b><font color="#000000"> 
            <?=$tmp["motivo"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Prioridade</td>
          <td width="15%" ><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <?=$pri?>
            </font></b> </td>
          <td width="13%">Aberto por</td>
          <td width="41%"> 
            <?
			  echo "<b><font color=#006600>".$tmp["consultor"]."</font></b>" ;
			  if ($tmp["consultor"]  != $tmp["destinatario"] ) {
			    echo " - Encaminhado para : <b><font color=#ff0000>". $tmp["destinatario"] . "</font></b>";
			  }
			 
			?>
          </td>
          <td width="12%">Contatos</td>
          <td width="10%"> 
            <?=$contatos?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?
  }
?>
</table>
	
    </td>
  </tr>
</table>
</span>

<span id="tab3">
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF">
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
  <tr bgcolor="#CCCCCC"> 
    <td width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_chamado'; document.form.submit();">Chamado</a></font></td>
    <td width="15%" align="center"> <a href="javascript:document.form.ordem.value='dataa'; document.form.submit();">Data</a></td>
    <td width="13%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></td>
    <td width="63%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <a href="javascript:document.form.ordem.value='descr'; document.form.submit();">Descri&ccedil;&atilde;o</a> 
      -[<a href="javascript:document.form.ordem.value='valor'; document.form.submit();">prioridade</a>][<a href="javascript:document.form.ordem.value='sistema'; document.form.submit();">sistema</a>] 
      [<a href="javascript:document.form.ordem.value='categoria'; document.form.submit();">Categoria</a>] 
      [<a href="javascript:document.form.ordem.value='status'; document.form.submit();">status</a>][<a href="javascript:document.form.ordem.value='motivo'; document.form.submit();">motivo</a>] 
      [<a href="javascript:document.form.ordem.value='tempo'; document.form.submit();">tempo</a>] 
      [<a href="javascript:document.form.ordem.value='nome'; document.form.submit();">consultor</a>][<a href="javascript:document.form.ordem.value='contatos'; document.form.submit();">contatos</a>]</font></td>
  </tr>
  
  
  
  
  <?  
  

	$chamados = statRnc001($o, 
	  $consultor, 
	  $atendimento, 
	  $status, 
	  $categoria, 
	  $tipo, 
	  $datai,
	  $dataf,
	  $motivo,
	  $id_cliente,
	  $limite,
	  $enc,
	  $palavra,
	  $sistema,
	  $externo,
	  3);	

	$total = count($chamados);
	reset($chamados);
  
  while( list($tmp1, $tmp) = each($chamados) ) {
  
		   	   $pri = $tmp["prioridade"];
			   $prioridadev = $tmp["prioridadev"];
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $pri = "<b><font color=$cor>$pri</font></b>";	
			   
			   $cor_fundo = "#FCE9BC";
			   if ($tmp["externo"]) {
                 $cor_fundo = "#D2E3FF";
			   }			   
  
  
    $id = $tmp["chamado_id"];
	$cliente = $tmp["cliente"];
	$id_cliente=$tmp["id_cliente"];
	$contatos = $tmp["contatos"];
	$tempo = $tmp["tempo"];
	$tempos = $tmp["temposeg"];
	$dataa = $tmp["dataa"];
	$descricao = $tmp["descricao"];
	$descricaoc = $tmp["descricaoc"];	
	if ($palavra) {
      $descricao = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $descricao);
     }

	if($somaContatos) {
	  $ct = $contatos/$somaContatos*100;
	} else {
	  $ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";
	
	if ($somaTempo) {
      $pt = $tempos/$somaTempo*100; 
	} else {
	  $pt = 0;
	}
	$pt = sprintf ("%02.2f", $pt) . " %";	
	$ch = sprintf ("%04.0f", $id);
	
//	$msg = "<b>Chamado aberto em $dataa:<br></b> " . $descricaoc;
//	$msg = "$msg<hr noshade size=1><b>Ultimo Contato:<br></b> ". ultimoHistoricoChamado($id);
//	$msg = eregi_replace("\r\n", "<br>", $msg);
//	$msg = eregi_replace("\"", "`", $msg);	

    list($tmp1, $tmp2) = each(pegaClientePorCodigoUnico($cliente_id));	
	$cap = strtoupper($tmp2["cliente"]) . " ($cliente_id)";

?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="4" align="left" height="19"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="<?=$cor_fundo?>"> 
          <td height="17" width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" > 

<!--            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$id?>';" onMouseOver="return overlib('<?=$msg?>', CAPTION, '<?=$cap?>', WIDTH, 400)" onMouseOut="nd();"> 			-->
            <?=$ch?>
            </a></font></td>
          <td height="17" width="15%" align="center"> 
            <?=$dataa?>
          </td>
          <td height="17" width="13%" ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="../historico.php?id_cliente=<?=rawurlencode($id_cliente)?>"> 
            <?=$id_cliente?>
            </a></font></td>
          <td height="17" colspan="3"  onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'<?=$cor_fundo?>');"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <a href="../historicochamado.php?id_chamado=<?=$id?>&palavra=<?=$palavra?>"> 
            <?=$descricao?>
            ...</a></font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Sistema</td>
          <td width="15%" ><b><font color="#000000"> 
            <?=$tmp["sistema"]?>
            </font></b></td>
          <td width="13%">Categoria</td>
          <td colspan="3" ><b><font color="#000000"> 
            <?=$tmp["categoria"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Status</td>
          <td width="15%"><b> 
            <?=$tmp["status"]?>
            </b></td>
          <td width="13%">Motivo</td>
          <td colspan="3" ><b><font color="#000000"> 
            <?=$tmp["motivo"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="<?=$cor_fundo?>" > 
          <td width="9%">Prioridade</td>
          <td width="15%" ><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <?=$pri?>
            </font></b> </td>
          <td width="13%">Aberto por</td>
          <td width="41%"> 
            <?
			  echo "<b><font color=#006600>".$tmp["consultor"]."</font></b>" ;
			  if ($tmp["consultor"]  != $tmp["destinatario"] ) {
			    echo " - Encaminhado para : <b><font color=#ff0000>". $tmp["destinatario"] . "</font></b>";
			  }
			 
			?>
          </td>
          <td width="12%">Contatos</td>
          <td width="10%"> 
            <?=$contatos?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?
  }
?>
</table>
	
    </td>
  </tr>
</table>
</span>

<p>&nbsp;
</p>


<br><br><br><br><br><br><br><br><br><br><br>

</body>
</html>
<script>
var tabs = new Array;  
tabs[1] = tab1;
tabs[2] = tab2;
tabs[3] = tab3;    
  
function ativaAba( tab, x ) {

  var tabela = tab;
  var posE, posD, porC, ancora, final
  final = Math.ceil((( 1 + tabela.rows[0].cells.length ) / 3 ));
     
  for ( var i = 1; i < final ; i++ ) {
  
    posE = (i-1) * 3;
	posD = posE + 2;
	posC = posE + 1;		
			
	tabela.rows[0].cells[posD].style.width = "10";
	tabela.rows[0].cells[posE].style.width = "12";		
	
	var ok = false;
	for (var j=0; j<tabela.rows[0].cells[posC].all.length; j++) {
     if (tabela.rows[0].cells[posC].all(j).tagName == 'A') {
	   ancora = tabela.rows[0].cells[posC].all(j)     ;
	   ancora.style.fontSize=12;
	   ok = true;
	 }
    }
	
	
	if ( x == i ) {  // Ativo		
    	if (ok) {
         ancora.style.color = "#0000ff";	
		 ancora.style.textDecoration = 'none';		
		}
		if (i!=1) { 
    		tabela.rows[0].cells[posE].innerHTML = "<img src=\"../../files/ativo_esq1.gif\">";
		} else {
       		tabela.rows[0].cells[posE].innerHTML = "<img src=\"../../files/ativo_esq.gif\">";
		}		
		
		if (i==(final-1)) {		
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../../files/ativo_dir1.gif\">";
		} else {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../../files/ativo_dir.gif\">";
		}

	    	
    	tabela.rows[0].cells[posE].style.backgroundColor = '#BDDEF0';
        tabela.rows[0].cells[posC].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
    } else { // Inativo	
	  if (ok) {
        ancora.style.color = "#0000FF";	
		ancora.style.textDecoration = 'none';
	  }
	    if ( i==1) {
          tabela.rows[0].cells[posE].innerHTML = '<img src=\"../../files/ativo_esq.gif\">';
		} else {
		  tabela.rows[0].cells[posE].innerHTML = '<img src=\"../../files/inativo_esq.gif\">';
		}
		
		if (i==(final-1)) {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../../files/inativo_dir1.gif\">";   		
		} else {
          tabela.rows[0].cells[posD].innerHTML = "<img src=\"../../files/inativo_dir.gif\">";		
		}

		tabela.rows[0].cells[posC].style.backgroundColor = "#e1e1e1"
        tabela.rows[0].cells[posE].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;				
	}		
  }  
}  

function ativa(value) {
  var a;
  for (a=1; a<tabs.length; a++) {
    if (a==value) {
      tabs[a].style.display='';
    } else {
      tabs[a].style.display='none';
    }
  }
}

function aba(x) {
   ativa(x);
   ativaAba( abas, x);
 }

  
 function envia() {
 }


function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
   item.style.display='';
   sp.innerHTML  = i2;
 } else {
   item.style.display='none'
   sp.innerHTML  = i1;
 }
}  

  

aba(1);

</script>
