<?
	require("scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}

    $chamado = intval($id_cliente);
    if (  $chamado != 0  ) {
      header("Location: historicochamado.php?id_chamado=$chamado");	  
	  echo "chamado";
	}
	$id_cliente = eregi_replace("'", "`", $id_cliente);

	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	
	
    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente));
	$p=$id_cliente;
    $bl = $tmp["bloqueio"];
	$msgbl = "";
	if (!$atendimento) {
	  if ($bl) { $msgbl = "<font color = #ff0000> bloqueado</font>"; }
 	  $bl = 0;
	}
    $cliente = strtoupper($tmp["cliente"]);
	$senha = $tmp["senha"];
	$id_cliente = $tmp["id_cliente"];
	if ($cliente=="") {
	  header ("Location: inicio.php?pesquisa=$p");
	}
	
?>
<script src="coolbuttons.js"></script>
<script>
 
  function vai() {

    if ('-<?=$bl?>' == '-1') {
	  window.alert('Consultoria Bloqueada');
	  return;
	}

    if (  ( '-1' == '-<?=$atendimento?>') && ('<?=$id_cliente?>' != 'DATAMACE') && ('<?=$senha?>' == '00 000') ) {
	  window.alert('Cliente Inativo');
	  return;
	}	
	

	document.form.submit();
  }

  function seleciona() {
    window.name = "pai";
    value = document.form.clientecodigo.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }
</script>

<html>
<head>
<title>Hist&oacute;rico</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="inicio.php"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton">&nbsp;</td>
  </tr>
</table>

<hr size="1" noshade>
<div align="center"> 
  <p align="center"><font size="3">Usu&aacute;rio <font color="#FF0000">:<b> 
    <?=$nomeusuario?>
    </b></font><b> </b></font></p>
  <form name="form" method="post" action="chamado2.php">
    <div align="left"> 
      <table width="90%" border="0" cellspacing="1" cellpadding="1" align="center">
        <tr> 
          <td>Rela&ccedil;&atilde;o de chamados para<br>
            <b> <font size="2"> 
            <?
			  $msg = $cliente;
			  if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
              echo "$msg ($senha)$msgbl";
			?>
            </font></b> <font size="2">&nbsp;&nbsp; </font> 
            <input type="button" name="Button" value="Abrir novo chamado" class="unnamed1" onClick="vai()">
          </td>
        </tr>
      </table>
      <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
      <div align="center"></div>
    </div>
  </form>
  <p align="left"> 
    <!-- TABELA -->
    <?
   $chamadosemaberto = pegaChamadoCliente($atendimento, $id_cliente, 2, 0);
   $total_pendentes = count($chamadosemaberto);
?>
  </p>
  <p><b>Chamados Pendentes : 
    <?=$total_pendentes?>
    <br>
    </b> </p>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#FF0000"> 
      <td width="9%" align="center"> <b><font size="1" color="#FFFFFF">Chamado</font></b></td>
      <td width="11%"> 
        <div align="center"><b><font size="1" color="#FFFFFF">Data Abert.</font></b></div>
      </td>
      <td width="18%"><b><font color="#FFFFFF" size="1">Aberto Por</font></b></td>
      <td width="10%"><b><font color="#FFFFFF" size="1">Prioridade</font></b></td>
      <td width="52%"><b><font size="1" color="#FFFFFF">Descri&ccedil;&atilde;o</font></b></td>
    </tr>
    <?while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {

			   $status = $tmp["status"];
			   $statusStr = ""; 
			   if($status>3) {
			    $statusStr = "<br>".pegaStatus($status);
			   }			   
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
			   $id = $tmp["id_cliente"];
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"];
			   $descricao = $tmp["descricao"];
			   $quem = $tmp["consultor"];
			?>
    <tr bgcolor="#FCE9BC" valign="middle"> 
      <td width="9%" align="center"> <a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>"> 
        <?="$chamado $statusStr"?>
        </a> </td>
      <td width="11%" align="center"> 
        <?=$dataAbertura?>
      </td>
      <td width="18%" align="center"> 
        <?=$quem?>
      </td>
      <td width="10%" align="center"> 
        <?=$pri?>
      </td>
      <td width="52%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        <a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>"> 
        <?=$descricao?>
        </a></font></td>
    </tr>
    <?}?>
  </table>
  <!-- TABELA -->
  <?
   $chamadosemaberto = pegaChamadoCliente($atendimento, $id_cliente, 1, 50);
   $total_pendentes = count($chamadosemaberto);
?>
  <p><b>Chamados Encerrados : 
    <?=$total_pendentes?>
    </b><br>
  </p>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#666666"> 
      <td width="9%" align="center"> <font size="1" color="#FFFFFF">Chamado</font></td>
      <td width="11%"> 
        <div align="center"><font size="1" color="#FFFFFF">Data Abert.</font></div>
      </td>
      <td width="18%"><font color="#FFFFFF" size="1">Aberto Por</font></td>
      <td width="10%"><font color="#FFFFFF" size="1">Prioridade</font></td>
      <td width="52%"><font size="1" color="#FFFFFF">Descri&ccedil;&atilde;o</font></td>
    </tr>
    <?while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {
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
			   $id = $tmp["id_cliente"];
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"];
			   $descricao = $tmp["descricao"];
			   $quem = $tmp["consultor"];
			?>
    <tr bgcolor="#FCE9BC"> 
      <td width="9%" align="center" valign="middle"> <a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>"> 
        <?=$chamado?>
        </a> </td>
      <td width="11%" valign="middle" align="center"> 
        <?=$dataAbertura?>
      </td>
      <td width="18%" valign="middle" align="center"> 
        <?=$quem?>
      </td>
      <td width="10%" valign="middle" align="center"> 
        <?=$pri?>
      </td>
      <td width="52%" valign="bottom"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        <a href="historicochamado.php?id_cliente=<?=$id_cliente?>&id_chamado=<?=$chamado?>"> 
        <?=$descricao?>
        </a> </font></td>
    </tr>
    <?}?>
  </table>
  <br>
  <table width="132" border="0" cellspacing="1" cellpadding="1" align="center" class="coolBar">
    <tr> 
      <td align="center" class="coolButton"><a href="inicio.php"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
        ao in&iacute;cio</a></td>
    </tr>
  </table>
</div>
</body>
</html>
