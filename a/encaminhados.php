<?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);

 
 mysql_query("update chamado set diagnostico_id=9 where diagnostico_id=0;");

 
 $resp = mysql_query("select count(*) as soma from cxsug;");
 $linha = mysql_fetch_object($resp);
 $sugestoes = $linha->soma;

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
	$msgnova = 0;
	$lembretenovo = 0;
	$i_conta = i_contaTarefas($ok);
	
    $agora=date("Y-m-d H:i:s"); 
    $agora=strtotime($agora);

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
      <td valign="top"> 
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr> 
            <td width="50%"><font size="2"><img src="figuras/home.gif" width="20" height="20" align="absmiddle"> 
              Chamados Encaminhados...</font></td>
            <td width="50%" align="right">
              <div align="left"><a href="inicio.php">VOLTAR AO INICIO</a></div>
            </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="60%">&nbsp;</td>
            <td align="right" width="40%" valign="bottom">&nbsp;</td>
          </tr>
        </table>
        <hr noshade size="1">
        <?    $chamadosemaberto = pegaChamadoPendenteUsuario($ok, 1);	
		
		?>
        <br>
        <span id=msgnova></span><span id=lembretenovo></span> <br>
        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
          <tr bgcolor="#666666"> 
            <td width="13%" align="center" valign="middle"> <font size="1" color="#FFFFFF">Chamado</font></td>
            <td width="7%" align="center" valign="middle"> <font size="1" color="#FFFFFF">Data</font></td>
            <td width="15%" align="center" valign="middle"> <font size="1" color="#FFFFFF">C&oacute;digo 
              do cliente</font></td>
            <td width="65%"><font size="1" color="#FFFFFF">Cliente + Descri&ccedil;&atilde;o</font></td>
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
			   
			   $lido = 1;                          // So vai ver msg nova
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
			   
			   
			   if ($encaminhado and (($id_usuario != $destinatarioId))) {
			?>
          <tr bgcolor="#FCE9BC" valign="bottom"> 
            <td width="13%" align="center" valign="middle"> 
              <? 
				   if ($temLembrete) { 
                    echo "<a href=\"lembrete/mostralembrete.php?id=$id_lembrete\"><img src=\"figuras/lembrete.jpg\"  width=\"20\" height=\"20\" align=\"absmiddle\" border=\"0\"></a>";
                    $lembretenovo++;					

      				}
				?>
              <? if(!$lido) { echo '<img src=figuras/idea01.gif  align=absmiddle> '; $msgnova++; } ?>
              <?="$chamado<br>$prioridade"?>
              <br>
              <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:novolembrete(<?=$chamado?>, <?=$ok?>);">Incluir 
              Lembrete</a></font> </td>
            <td width="7%" valign="middle" align="center"> 
              <?=$dataAbertura?>
            </td>
            <td width="15%" valign="middle" align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
              <?
				 $msg = $id;
                 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
				 $msg .= "<br>$fone";
                 echo $msg;
				 ?>
              </font></td>
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
      </td>
    </tr>
  </table>
<?
		  $sub = pegaSubordinados($id_usuario);
		  if (count($sub)) {
		    require("scripts/pendencias.php");
		  }		
$total_chamados = count($pendentes);
		  echo $encaminhado;	
		 // echo $pendentes;		
	//	  echo $tmp1;	
//echo $tmp;	 
		   
		  
		    
?>  
</div>
</body>
</html>

<script>
function vai() {
   location.href = 'encaminhados.php?subPendente='+document.formSubordinado.subPendente.value+"#pendencias";
}
</script>
