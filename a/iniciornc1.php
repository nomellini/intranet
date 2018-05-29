<?
 mysql_connect(localhost, root, marcia);
 mysql_select_db(datamace);

/*
  $resp = mysql_query("select count(*) as soma from cxsug;");
  $linha = mysql_fetch_object($resp);
  $sugestoes = $linha->soma;
*/  

    require("scripts/conn.php");		
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
            $gerente = pegaGerente($ok);			
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}


    loga_online($ok, $REMOTE_ADDR, 'Desktop rnc');

/*	
    $sql = "SELECT * from noticia ";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$noticia_chamada = $linha->titulo;
	$noticia_link = $linha->link;
*/	
	
    $nomeusuario=peganomeusuario($ok);	
	$manut = pegaManut($ok);
	$marketing = pegaMarketing($ok);	
	$msgnova = 0;
	$lembretenovo = 0;
	
	/*
	$i_conta = i_contaTarefas($ok);	
    $agora=date("Y-m-d H:i:s");
    $agora=strtotime($agora);	
	$nowTime = date("G:i:s"); // Hora do servidor com 24hr	
	$sql =  "select count(*) as qtde from compromisso, compromissousuario where ";
	$sql .= "compromisso.data = '" . date("Y-m-d") . "' and ";
	$sql .= "compromisso.id = compromissousuario.id_compromisso and compromisso.horafim>'$nowTime' and ";
	$sql .= "not compromisso.excluido  and ";
	$sql .= "compromissousuario.id_usuario = $ok;";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$compromissos = $linha->qtde;
	*/
?>
<html>
<meta http-equiv="refresh" content="600;URL=inicio.php">
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="relatorios/coolbuttons.js"></script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="72" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="87" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="101" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="111" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="118" class="coolButton" align="center" valign="middle"> <a href="../index.php">Intranet</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="204" class="coolButton"><a href="/agenda/" target="_blank">Agenda 
      Corporativa Datamace</a></td>
  </tr>
</table>
<hr size="1" noshade>
<font size="1">Usu&aacute;rio <font color="#FF0000">:<b> 
<?=$nomeusuario?>
</b></font></font> 
<div align="center"> <font size="3"><img src="figuras/intro.gif" width="321" height="21"><b> 
  <br>
  RNC</b></font> 
  <table width="90%" border="0" cellspacing="1" cellpadding="1" align="center">
    <tr> 
      <td height="103" align="left" valign="top"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="60%"> <br>
              <? if ($gerente) {?>
              <a href="rnc/rnc.php?action=novo">Abrir novo chamado de n&atilde;o 
              conformidade</a> 
              <? }?>
            </td>
          </tr>
        </table>
        <hr noshade size="1">
        <?
		    $chamadosemaberto = pegaChamadosRNC();
			$total_pendentes = count($chamadosemaberto);
		  ?>
        RNC Pendentes : 
        <?=$total_pendentes?>
        <table width="100%" cellpadding="2" cellspacing="2">
          <tr > 
            <td width="100%" valign="top"> 
              <?
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
			   $status = $tmp["status"];
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"] . " às " . $tmp["horaa"];
			   $datauc = $tmp["datauc"] . " às " . $tmp["horauc"];
			   $descricao = $tmp["descricao"];
			   $destinatarioId = $tmp["destinatario_id"];
			   $usuarioId = $tmp["usuario_id"];
			   $remetenteId = $tmp["remetente_id"];			
			   $pendente = $tmp["pendente"];   
			   $encaminhado = $tmp["encaminhado"];
			   $fone=$tmp["telefone"];
			   $bl = $tmp["bloqueio"];
			   $cor_fundo = "#FCE9BC";
			   if ($tmp["externo"]) {
                 $cor_fundo = "#D2E3FF";
			   }
			   if ($tmp["id_sistema"]==24) {
                 $cor_fundo = "#DFEEE6";
			   }
   			   if ($tmp["rnc"]==1) {
			     if (!$teste) {
    				 $cor_fundo = "#cccccc";
				 } else {
                   $cor_fundo = "#$teste";
				 }
			   }

			   
			   $lido = 1;                          // So vai ver msg nova
			   if ($destinatarioId == $ok) {       // se o chamado tiver novidades e
                 $lido = $tmp["lido"];             // se o destinatario do contato = consultor atual
			   }
			   if ($usuarioId == $ok) {       // se o chamado tiver novidades e
                 $lido = $tmp["lidodono"];             // se o destinatario do contato = consultor atual
			   }			   
     		?>
              <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#003366">
                <tr> 
                  <td> <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                      <tr bgcolor="#D6F8F7"> 
                        <td valign="middle" bgcolor="#B7F2F1" > 
                          <? 
						    if(!$lido) { echo '<img src=figuras/idea01.gif  align=absmiddle> '; $msgnova++; } 
						  ?>
                          <font size="2"> Chamado <b><? echo $chamado ?></b> aberto em 
                          <? echo $dataAbertura ?> &uacute;ltimo contato em <? echo $datauc ?></font> 
                        </td>
                        <td align="right" valign="middle" bgcolor="#B7F2F1" ><font size="2"><? echo $prioridade ?></font></td>
                      </tr>
                      <tr bgcolor="#D6F8F7"> 
                        <td colspan="2" valign="middle" >
						<br> <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
                          <?
			    
							$descricao = eregi_replace("\r\n", "<br>",$descricao);
							$descricao = eregi_replace("\"", "`", $descricao);	
							echo "<a href=historicochamado.php?&id_chamado=$chamado>$descricao...</a><br>";
							
				
              $figura = "";			  			  
			  if (
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId != $id_usuario) ) or				
                       ($encaminhado and ($id_usuario == $remetenteId) and ($destinatarioId != $id_usuario) ) or 
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId == $id_usuario) )					   
					   )
				   {
				      if ($id_usuario != $destinatarioId) {
					    $msg = " para " . peganomeusuario($destinatarioId);
						$seta = "encaminhado.gif";
					  } else {
					    $msg = " à você por " . peganomeusuario($remetenteId);						
						$seta = "recebido.gif";
					  }
                      $figura = "<img src=\"figuras/$seta\" align=\"absmiddle\" border=0>";					  
                      echo " <br><font color=#FF0000>Encaminhado " . $msg . "</font> $figura";
					}
					if ($usuarioId != $id_usuario) {
					  $msg = "Chamado aberto por " . peganomeusuario($usuarioId);
					  echo " <br><font color=#FF0000> $msg </font>";
					}
				?>
                        </td>
                      </tr>
                    </table>
					</td>
                </tr>
              </table>
			  <img src="../imagens/1pixel.gif"><br>                  
              <? 
			    }
              ?>

            </td>
          </tr>
        </table> 
	 </td>
    </tr>
  </table>
</div>
<script>
 function vai() {
   location.href = 'inicio.php?subPendente='+document.form2.subPendente.value+"#pendencias";
 }
 

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }



 if( <?=$msgnova?> ) {
   msgnova.innerHTML = "Existe(m) <?=$msgnova?> chamado(s) com mensagens não lidas (<img src=figuras/idea01.gif  align=absmiddle>)";
 }
 
 if( <?=$lembretenovo?> ) {
   lembretenovo.innerHTML = "<br>Extiste(m) <?=$lembretenovo?> chamado(s) com lembretes não lidos (<img src=figuras/lembrete.jpg  align=absmiddle>)<br>";
 }


function novolembrete(chamado, usuario) {
  var newWindow;
  window.name = "pai";  
  newWindow = window.open( 'lembrete/novolembrete.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
}  

function online() {
   window.open( 'online.php', '', 'scrollbars=yes, width=600, height=400');
}  


</script>

</body>
</html>
