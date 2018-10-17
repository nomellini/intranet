<?
    require("scripts/conn.php");		
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
    $nomeusuario=peganomeusuario($ok);	
	$manut = pegaManut($ok);
	$marketing = pegaMarketing($ok);	
?>
<html>
<meta http-equiv="refresh" content="60;URL=inicio.php">
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<meta http-equiv="refresh" content="60">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
<script src="relatorios/coolbuttons.js"></script>

<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="72" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="87" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="101" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="111" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="118" class="coolButton" align="center" valign="middle"> <a href="../index.php">Intranet</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="204" class="coolButton">&nbsp;</td>
  </tr>
</table>
<hr size="1" noshade>
<font size="1">Usu&aacute;rio <font color="#FF0000">:<b> 
<?=$nomeusuario?>
</b></font></font> 
<div align="center"> 
  <p align="center"><font size="3"><img src="figuras/intro.gif" width="321" height="21"><b> 
    </b></font></p>
  <table width="90%" border="0" cellspacing="1" cellpadding="1" align="center">
    <tr> 
      <td><font size="2"><img src="figuras/home.gif" width="20" height="20" align="absmiddle"> 
        Manuten&ccedil;&atilde;o de chamados:</font> 
        <form name="form" method="post" action="historico.php" >
          <font size="2">C&oacute;digo do cliente<b>&nbsp;</b></font><font color="#0000FF"><b> 
          <input type="hidden" name="action">
          <input type="text" name="id_cliente" class="bordaTexto">
          </b> 
          <input type="submit" name="Submit" value="Ver hist&oacute;rico" class="bordaTexto" >
          <br>
          <font color="#666666">(ou n&uacute;mero do chamado)</font><br>
          &nbsp;[<a href="javascript:seleciona(); ">pesquisa</a>]</font> 
        </form>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="60%"> 			  <font size="2"> <b> 
              <? 
			    if (receptor($ok)) {
				  if ($xx = temChamado()) {
                    echo "<a href=\"clientes.php\"><img src=\"figuras/cliente.gif\" width=\"20\" height=\"20\" align=\"absmiddle\" border=\"0\">exitem 
                $xx novos chamados abertos por cliente</a>";
				  }
				}
			  ?>
              </b></font> <br>
              <? if($manut) {	?>
              <a href="manut/index.php">Manuten&ccedil;&atilde;o de tabelas</a><br>
              <?}
             if($marketing) {	?>
              <a href="manut/marketing.php">Manuten&ccedil;&atilde;o de tabelas 
              de marketing</a><br>
              <br>
              <?} ?>
              Clique na descri&ccedil;&atilde;o para obter detalhes do chamado 
              correspondente. </td>
            <td align="right" width="40%" valign="bottom"> 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td align="left" valign="middle">[<a href="relatorios/index.php"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">Relat&oacute;rios</a>]</td>
                </tr>
                <tr> 
                  <td align="left" valign="middle"> 
                    <form name="form1" method="post" action="relatorios/relat2.php">
                      [<img src="figuras/lupa.gif" width="20" height="20" align="absbottom">busca 
                      por palavra 
                      <input type="text" name="palavra" class="unnamed1">
                      ] 
                    </form>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <hr noshade size="1">
        <?
		    $chamadosemaberto = pegaChamadoPendenteUsuario($ok);
			$total_pendentes = count($chamadosemaberto);
		  ?>
        Chamados Pendentes para 
        <?=$nomeusuario?>
        : 
        <?=$total_pendentes?>
        <br>
        <br>
        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
          <tr bgcolor="#666666"> 
            <td width="13%" align="center" valign="middle"> <font size="1" color="#FFFFFF">Chamado</font></td>
            <td width="7%" align="center" valign="middle"> <font size="1" color="#FFFFFF">Data</font></td>
            <td width="15%" align="center" valign="middle"> <font size="1" color="#FFFFFF">C&oacute;digo 
              do cliente</font></td>
            <td width="65%"><font size="1" color="#FFFFFF">Cliente + Descri&ccedil;&atilde;o</font></td>
          </tr>
          <?while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {
		   	   $prioridade = $tmp["prioridade"];
			   $prioridadev = $tmp["prioridadev"];
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $prioridade = "<b><font color=$cor>$prioridade</font></b>";
			   		  
			   $id = $tmp["id_cliente"];
			   $status = $tmp["status"];
			   $statusStr = ""; 
			   if($status>3) {
			    $statusStr = "<br>".pegaStatus($status);
			   }
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"] . "<br>" . $tmp["horaa"];
			   $descricao = $tmp["descricao"];
			   $destinatarioId = $tmp["destinatario_id"];
			   $usuarioId = $tmp["usuario_id"];
			   $remetenteId = $tmp["remetente_id"];			
			   $pendente = $tmp["pendente"];   
			   $encaminhado = $tmp["encaminhado"];
			   $fone=$tmp["telefone"];
			   $bl = $tmp["bloqueio"];
			   
			   $ultimocontato = ultimocontato($chamado);
			   $lastdate = $ultimocontato["dataa"];
			   $lasthistorico = $ultimocontato["historico"];
               $lasthistorico = eregi_replace("\r\n", "<br>",$lasthistorico);
               $lasthistorico = eregi_replace("\"", "`", $lasthistorico);			   
			   $msg="Último contato em : $lastdate às " . $ultimocontato["horaa"] . " por " . peganomeusuario($ultimocontato["consultor_id"]) . "<hr size=1 noshade>$lasthistorico";               
			   
			   if ( (!$encaminhado) or ($encaminhado and ($id_usuario == $destinatarioId)) ) {			   
			?>
          <tr bgcolor="#FCE9BC" valign="bottom"> 
            <td width="13%" align="center" valign="middle"> 
              <?="$chamado<br>$prioridade $statusStr"?>
            </td>
            <td width="7%" valign="middle" align="center"> 
              <?=$dataAbertura?>
            </td>
            <td width="15%" valign="middle" align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
			<A HREF="javascript:location.href = 'historicochamado.php?&id_chamado=<?=$chamado?>';" onMouseOver="return overlib('<?=$msg?>', WIDTH, 400, HEIGHT, 50, ABOVE)" onMouseOut="nd();">
              <?
				 $msg = $id;
                 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
				 $msg .= "<br>$fone";
                 echo $msg;
				 ?>
				 </a>
              </font></td>
            <td width="65%" valign="middle" bgcolor="#FCE9BC"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
              <?="<b>$cliente</b><br><b><a href=historicochamado.php?&id_chamado=$chamado>$descricao</a></b>"?>
              <? if (
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId != $id_usuario) ) or				
                       ($encaminhado and ($id_usuario == $remetenteId) and ($destinatarioId != $id_usuario) ) or 
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId == $id_usuario) )					   
					   )
				   {
				      if ($id_usuario != $destinatarioId) {
					    $msg = " para " . peganomeusuario($destinatarioId);
					  } else {
					    $msg = " à você por " . peganomeusuario($remetenteId);
					  }
                      echo " <br><font color=#FF0000>Encaminhado " . $msg . "</font>";
					}
					if ($usuarioId != $id_usuario) {
					  $msg = "Chamado aberto por " . peganomeusuario($usuarioId);
					  echo " <br><font color=#FF0000> $msg </font>";
					}
				?>
              </font></td>
          </tr>
          <?}}
			?>
          <tr> 
            <td bgcolor="#ffffff" colspan=4> 
              <hr size=1 noshade>
            </td>
          </tr>
          <?
            reset($chamadosemaberto);
            while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {
		   	   $prioridade = $tmp["prioridade"];
			   $prioridadev = $tmp["prioridadev"];
			   if ($prioridadev  <= 100) {
			     $cor = "#ff0000";
			   } else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
			     $cor = "#FF6600";
			   } else if ($prioridadev > 200) {
			     $cor = "#009966";
			   }
			   $prioridade = "<b><font color=$cor>$prioridade</font></b>";
			   $id = $tmp["id_cliente"];
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"] . "<br>" . $tmp["horaa"];
			   $descricao = $tmp["descricao"];
			   $destinatarioId = $tmp["destinatario_id"];
			   $usuarioId = $tmp["usuario_id"];
			   $remetenteId = $tmp["remetente_id"];			
			   $pendente = $tmp["pendente"];   
			   $encaminhado = $tmp["encaminhado"];
			   $fone=$tmp["telefone"];
			   $bl = $tmp["bloqueio"];

			   $ultimocontato = ultimocontato($chamado);
			   $lastdate = $ultimocontato["dataa"];
			   $lasthistorico = $ultimocontato["historico"];
               $lasthistorico = eregi_replace("\r\n", "<br>",$lasthistorico);
               $lasthistorico = eregi_replace("\"", "`", $lasthistorico);			   
			   $msg="Último contato em : $lastdate às " . $ultimocontato["horaa"] . " por " . peganomeusuario($ultimocontato["consultor_id"]) . "<hr size=1 noshade>$lasthistorico";               
			   
			   if ($encaminhado and (($id_usuario != $destinatarioId))) {
			?>
          <tr bgcolor="#FCE9BC" valign="bottom"> 
            <td width="13%" align="center" valign="middle"> 
              <?="$chamado<br>$prioridade"?>
            </td>
            <td width="7%" valign="middle" align="center"> 
              <?=$dataAbertura?>
            </td>
            <td width="15%" valign="middle" align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
              <A HREF="javascript:location.href = 'historicochamado.php?&id_chamado=<?=$chamado?>';" onMouseOver="return overlib('<?=$msg?>', WIDTH, 400, HEIGHT, 50, ABOVE, FGCOLOR, '#FFFFC8')" onMouseOut="nd();"> 
              <?
				 $msg = $id;
                 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
				 $msg .= "<br>$fone";
                 echo $msg;
				 ?>
              </a> </font></td>
            <td width="65%" valign="middle"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
              <?="<b>$cliente</b><br><b><a href=historicochamado.php?&id_chamado=$chamado>$descricao</a></b>"?>
              <? if (
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId != $id_usuario) ) or				
                       ($encaminhado and ($id_usuario == $remetenteId) and ($destinatarioId != $id_usuario) ) or 
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId == $id_usuario) )					   
					   )
				   {
				      if ($id_usuario != $destinatarioId) {
					    $msg = " para " . peganomeusuario($destinatarioId);
					  } else {
					    $msg = " à você por " . peganomeusuario($remetenteId);
					  }
                      echo " <br><font color=#FF0000>Encaminhado " . $msg . "</font>";
					}
					if ($usuarioId != $id_usuario) {
					  $msg = "Chamado aberto por " . peganomeusuario($usuarioId);
					  echo " <br><font color=#FF0000> $msg </font>";
					}
				?>
              </font></td>
          </tr>
          <?}
			}?>
        </table>
        <br>
        <?
		  $sub = pegaSubordinados($id_usuario);
		  if (count($sub)) {
		    require("scripts/pendencias.php");
		  }
		  ?>
        <br>
      </td>
    </tr>
  </table>
</div>
<p>
  <script>



 function vai() {
   location.href = 'inicio.php?subPendente='+document.form2.subPendente.value+"#pendencias";
 }
 

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }


 if( ('-<?=$pesquisa?>'!='-') ) {
  document.form.id_cliente.value='<?=$pesquisa?>';
  seleciona();  
 } else {
  document.form.id_cliente.focus();
 }
 
</script>
</p>
<p>&nbsp; </p>
</body>
</html>
