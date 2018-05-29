<?
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


   loga_online($ok, $REMOTE_ADDR, 'Desktop');
	
    $sql = "SELECT * from noticia ";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$noticia_chamada = $linha->titulo;
	$noticia_link = $linha->link;
	
    $nomeusuario=peganomeusuario($ok);	
	$manut = pegaManut($ok);
	$marketing = pegaMarketing($ok);	
	$msgnova = 0;
	$lembretenovo = 0;
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
?>
<html>
<meta http-equiv="refresh" content="600;URL=inicio.php">
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="relatorios/coolbuttons.js"></script>
<div align="center"> 
  <table width="900" border="0" cellspacing="1" cellpadding="1" align="center">
    <tr> 
      <td valign="top"><font size="3"><img src="figuras/topo_sad_e_900.jpg" width="900" height="79"></font></td>
    </tr>
    <tr> 
      <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
          <tr align="center"> 
            <td width="72" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
            <td width="87" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
            <td width="101" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
            <td width="111" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
              Senha</a> </td>
            <td width="118" class="coolButton" align="center" valign="middle"> 
              <a href="../index.php">Intranet</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="204" class="coolButton"><a href="/agenda/" target="_blank">Agenda 
              Corporativa</a></td>
          </tr>
        </table>
        <font size="1">Usu&aacute;rio <font color="#FF0000">:<b> 
        <?=$nomeusuario?>
        </b></font></font></td>
    </tr>
    <tr> 
      <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="1">
        </table>
        <table width="100%" border="0" bgcolor="#CCCCCC" cellpadding="3" cellspacing="1">
          <tr bgcolor="#FFFFFF"> 
            <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr> 
                  <td width="65%"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                      <tr bgcolor="#FFFFFF"> 
                        <form name="form" method="post" action="historico.php" >
                          <td align="left" valign="top"><font size="2"><a href="javascript:seleciona();">C&oacute;digo 
                            do cliente</a><b>&nbsp;</b></font><font color="#0000FF"><b> 
                            <input type="hidden" name="action">
                            </b></font><font size="2">&nbsp;</font><font color="#0000FF"><b> 
                            <input type="text" name="id_cliente" class="bordaTexto">
                            </b> 
                            <input type="submit" name="Submit" value="Ver hist&oacute;rico" class="bordaTexto" >
                            &nbsp;[<a href="javascript:seleciona(); ">pesquisa</a> 
                            clientes]</font> </td>
                        </form>
                      </tr>
                    </table></td>
                  <td width="35%"> <table width="100%" border="0"  cellpadding="1" cellspacing="1">
                      <tr bgcolor="#FFFFFF"> 
                        <form name="form1" method="post" action="relatorios/relat2.php">
                          <td align="right" valign="top"> [<img src="figuras/lupa.gif" width="20" height="20" align="absbottom">busca 
                            por palavra 
                            <input type="text" name="palavra" class="bordaTexto">
                            ] </td>
                        </form>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <table width="100%" border="0" bgcolor="#CCCCCC" cellpadding="3" cellspacing="1">
          <tr bgcolor="#FFFFFF"> 
            <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr valign="top"> 
                  <td width="33%"> <a href="/a/versao/"> 
                    <?  $i_msg = "Liberação de Release ";
			    if ($i_conta < 0) { echo "<font color=#ff0000 >$i_msg : Existem " . -$i_conta .  " releases em andamento</font>"; } else {echo $i_msg;}  
				
			    if($i_conta > 0) {?>
                    <font color = #ff0000 size = 2>: Você tem 
                    <?=$i_conta?>
                    tarefa(s)</font> 
                    <? } ?>
                    </a> <br> 
                    <? if($manut) {	?>
                    <a href="manut/index.php">Manuten&ccedil;&atilde;o de tabelas</a><br> 
                    <?}
             if($marketing) {	?>
                    <a href="manut/marketing.php">Manuten&ccedil;&atilde;o de 
                    tabelas de marketing</a><br> 
                    <?} ?>
                    <? 
			    if (receptor($ok)) {
				  if ($xx = temChamado()) {
                    echo "<a href=\"clientes.php\"><img src=\"figuras/cliente.gif\" width=\"20\" height=\"20\" align=\"absmiddle\" border=\"0\">$xx chamado(s) aberto(s) por cliente</a><br>";
				  }
				}
			  ?>
                  </td>
                <td width="33%" align="center"> <a href="iniciornc.php"><strong>Desktop 
                  RNC</strong></a> 
                  <? if ($gerente) {?>
                  <br>
                    <a href="rnc/rnc.php?action=novo">Abrir novo chamado de n&atilde;o 
                    conformidade</a> <br> 
                    <? }?>
                    <? if ($compromissos) {?>
                    <font size="2"><a href="../agenda/" target="_blank" class="fundoclaro">Agenda 
                    : <strong> 
                    <?=$compromissos?>
                    </strong>Compromisso(s)</a></font> 
                    <? } ?>
                    <br>                    <a href="espera/consultor.php" class="style1">Minhas ligações</a>                  </td>
                  
                <td width="33%" align="right"> <a href="/a/relatorios/relatbaseweb.php"><font size="1">Base 
                  de conhecimento web</font></a> <br> <a href="/suporte/index.php"><font size="1">Base 
                    de Solu&ccedil;&otilde;es</font></a> <br>
                  <a href="javascript:online();">Quem está On Line</a><a href="<?=$noticia_link?>"> 
                  <?=$noticia_chamada?>
                  </a><br></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <?
		    $chamadosemaberto = pegaChamadoPendenteUsuario($ok);
			$total_pendentes = count($chamadosemaberto);
		  ?>
        Chamados Pendentes para 
        <?=$nomeusuario?>
        : 
        <?=$total_pendentes?>
        <br> <span id=msgnova></span><span id=lembretenovo></span> <br> <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
          <tr bgcolor="#003366"> 
            <td width="13%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Chamado</font></strong></td>
            <td width="7%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Data</font></strong></td>
            <td width="15%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">C&oacute;digo 
              do cliente</font></strong></td>
            <td width="65%"><strong><font size="1" color="#FFFFFF">Cliente + Descri&ccedil;&atilde;o</font></strong></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
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
			   $senha = $tmp["senha"];
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
			   $cor_fundo = "#FCE9BC";
			   $cor_fundo = "#FFFFEC";
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
			   
			   
			   $sql = "select * from lembrete where id_destinatario = $ok and id_chamado = $chamado and not lido";
		   	   $temLembrete = 0;
			   $result = mysql_query($sql); 
			   while ( $linha = mysql_fetch_object($result) ) {
			     $id_lembrete = $linha->id;
			     if (($linha->periodo) == "M" ) {
			       $horario = "08:00:00";
			     } else {
			       $horario = "13:00:00";			   
			     }
			     $date1=strtotime( $linha->data . ' ' . $horario);				 
				 if ($agora > $date1) {
				   $temLembrete = 1;				   
				   break;
				 }
			   }
			   
			   
			  
			   if ( ($tmp["externo"]) or (!$encaminhado) or ($encaminhado and ($id_usuario == $destinatarioId)) ) {			   
			?>
        <table width="100%" border="0" cellpadding="1" cellspacing="1" class="bordagrafite02">
          <tr> 
            <td bgcolor="<?=$cor_fundo?>"> <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr valign="bottom"> 
                  <td width="12%" align="center" valign="middle"> 
                    <? 
				   if ($temLembrete) { 
                    echo "<a href=\"lembrete/mostralembrete.php?id=$id_lembrete\"><img src=\"figuras/lembrete.jpg\"  width=\"20\" height=\"20\" align=\"absmiddle\" border=\"0\"></a>";
                    $lembretenovo++;					

      				}
				?>
                    <? if(!$lido) { echo '<img src=figuras/idea01.gif  align=absmiddle> '; $msgnova++; } ?>
                    <?="$chamado<br>$prioridade $statusStr"?>
                    <br> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:novolembrete(<?=$chamado?>, <?=$ok?>);">Incluir 
                    Lembrete</a></font> </td>
                  <td width="8%" align="center" valign="middle"> 
                    <?=$dataAbertura?>
                  </td>
                  <td width="15%" align="center" valign="middle"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
                    <?
				 $msg = $id;
                 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
				 $msg .= "<br>$fone";
                 echo $msg;
				 ?>
                    </font></td>
                  <td width="65%" valign="middle" > <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
                    <?="<b>$cliente ($senha)</b><br><b><a href=historicochamado.php?&id_chamado=$chamado>$descricao...</a></b>"?>
                    <? 
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
                    </font></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <?}}
			?>
        <a href="encaminhados.php">
        <font size="2"> VER CHAMADOS ENCAMINHADOS</font></a> <br> 
        <?
		  $sub = pegaSubordinados($id_usuario);
		  if (count($sub)) {
		    require("scripts/pendencias.php");
		  }
		  ?>
      </td>
    </tr>
    <tr>
      <td align="right" valign="top"><font color="#999999">Sad 2004</font></td>
    </tr>
  </table>

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

document.form.id_cliente.focus();
    </script>
    </p>
      </p>
</body>
</html>
