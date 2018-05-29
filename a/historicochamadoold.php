<?
	require("scripts/conn.php");
	require("scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	$chamados=pegaChamado($id_chamado);
	if (count($chamados) == 0) {
	  header("location: inicio.php");
	}
	
	loga_online($ok, $REMOTE_ADDR, $id_chamado);	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	
	
	list($tmp1, $chamado) = each($chamados);		
		
	$rnc = $chamado["rnc"];
    $diagnostico = $chamado["diagnostico"];
	$id_cliente = $chamado["id_cliente"];
	$categoria = $chamado["categoria"];
	$motivo = $chamado["motivo"];
	$id_sistema = $chamado["sistema_id"];
	$abertopor = pegaNomeUsuario($chamado["consultor_id"]);
	$destinatario = pegaNomeUsuario($chamado["destinatario_id"]);	

	$destinatario_id = $chamado["destinatario_id"]; 
	if ($ok == $destinatario_id) {
	  $sql = "update chamado set lido = 1 where id_chamado = $id_chamado";
	  mysql_query($sql);
	}
	
	if ($ok == $chamado["consultor_id"] ) {
	  $sql = "update chamado set lidodono = 1 where id_chamado = $id_chamado";
	  mysql_query($sql);
	}
	
		
    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente));
	$cliente = strtoupper($tmp["cliente"]);
	$senha = $tmp["senha"];
	$endereco = $tmp["endereco"];
	$bairro = $tmp["bairro"];
	$cidade = $tmp["cidade"];	
	$telefone = $tmp["telefone"]; 
	$id_cliente = $tmp["id_cliente"];
	$bl = $tmp["bloqueio"];
	
	/*
	  Belo exemplo de como nao se deve programar:
	  OK = 2 - Fernando
	     = 41 e 16 - Sandra
		 = 12 Marcelo

       Marcelo, Sandra e eu podem abrir chamados em consultoria bloqueada.	  	
	   Qualquer alteração aqui deve ser feita em Historico.PHP, pois o código
	   é o mesmo
	*/
    if ($ok==2 or $ok==41 or $ok==12 or $ok=16) {
	  $bl=0;
	}  
	
    $contatos = historicoChamado($id_chamado);
    $total_pendentes = count($chamadosemaberto);
	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);
	
	$status = pegaStatus( $objChamado->status );
	if ( $objChamado->status <> 1 ) {
	  $status = "<font color=#FF0000>".$status."</font>";
	} else {
      $status = "<font color=#0000FF>".$status."</font>";
	}
	  
       
		
?>
<script>

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
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
<script src="coolbuttons.js"></script>
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
  <table width="98%" border="0">
    <tr> 
      <td width="48%"><font size="2">Sistema de Atendimento Datamace</font></td>
      <td width="52%"> 
        <div align="right"><font size="2">Usu&aacute;rio <font color="#FF0000">:<b> 
          <?=$nomeusuario?>
          </b></font></font></div>
      </td>
    </tr>
  </table>
  <table width="98%" border="0" bgcolor="#000000" cellpadding="1" cellspacing="1">
    <tr bgcolor="#FCE9BC"> 
      <td width="12%" valign="middle" align="center"><font size="2">Chamado </font></td>
      <td width="11%" valign="middle" align="center"> <font size="2">Data </font></td>
      <td width="13%" valign="middle" align="center"><font size="2">Hora</font></td>
      <td width="53%"> <font size="2">Cliente </font></td>
      <td width="11%"> 
        <div align="center"><font size="2">Status</font></div>
      </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td width="12%" align="center"> 
        <div align="center"><font color="#FF0000"><b><font size="3"> 
          <?=$id_chamado?>
          </font></b></font></div>
      </td>
      <td width="11%" align="center"> 
        <div align="center"> 
          <?=$objChamado->dataaf?>
        </div>
      </td>
      <td width="13%" align="center"> 
        <div align="center"> 
          <?=$objChamado->horaa?>
        </div>
      </td>
      <td width="53%" valign="top"> <font size="2"> 
	  <A HREF="javascript:void(0);" onMouseOver="return overlib('<?="$endereco<br>$bairro<br>$cidade<br>$telefone"?>', CAPTION, '<?="$id_cliente ($senha)"?>', WIDTH, 300)" onMouseOut="nd();">
        <?
		 $msg = $cliente;
		 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
         echo $msg . "<br>$telefone";
		?>
        </a></font></td>
      <td width="11%"> 
        <div align="center"><b><font size="3"> 
          <?=$status?>
          </font></b></div>
      </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="5">Sistema : <font color="#0000FF"> 
        <?=pegaSistema($id_sistema)?>
        </font> - Categoria : <font color="#0000FF"> 
        <?=pegaCategoria($categoria)?>
        </font> - Motivo: <font color="#0000FF"> 
        <?=pegaMotivo($motivo)?>
        </font> </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="5"> 
        <p><font size="1">Chamado aberto por : 
          <?=$abertopor?>
          </font> <br>
          <font size="1">Atualmente este chamado esta com : 
          <?=$destinatario?>
          </font> :- Diagn&oacute;stico : <?=pegaDiagnostico($diagnostico)?><br>
          <br>
          <font size="3"><i>&nbsp;Descri&ccedil;&atilde;o</i></font></p>
        <blockquote> 
          <p><font size="3"><font color="#0000FF"> 
		  <?
		    $descricao = $chamado["descricao"];
		  	if ($palavra) {
             $descricao = eregi_replace($palavra, "<b><font  color=#FF0000>$palavra</font></b>", $descricao);
            }
            
			$descricao = eregi_replace("\r\n", "<br>",$descricao);
            $descricao = eregi_replace("\"", "`", $descricao);	

            print $descricao; 
		?>
            <br>
            </font></font></p>
        </blockquote>
      </td>
    </tr>
  </table>
  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td><font size="1">[<a href="#fim">fim da p&aacute;gina</a>]</font></td>
      <td valign="middle" align="center"> 
        <div align="center"></div>
        <p align="center"><font size="2">Contatos Estabelecidos<br>
          <? if($rnc) {?>
          <a href="javascript:rnc();">Imprime Relatório RNC</a> <br>
          <a href="rnc/rnc.php?id_chamado=<?=$id_chamado?>">EDITAR</a> <br>		  
          <script>
  function rnc() {
     window.open('historicochamadornc.php?id_chamado='+<?=$id_chamado?>  , "Seleção", "scrollbars=yes, height=600, width=700");
  }
</script>
<? } ?>
		
          </font></p>
      </td>
      <td align="right"><font size="1">[<a href="#fim">fim da p&aacute;gina</a>]</font></td>
    </tr>
  </table>
  <br>
</div>
<table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
  <tr bgcolor="#666666"> 
    <td width="15%" align="center"> <b><font size="1" color="#FFFFFF">Tipo de 
      contato e pessoa contatada </font></b></td>
    <td width="15%" align="center"><b><font color="#FFFFFF" size="1">Atendido 
      por quem<br>
      e status</font></b></td>
    <td align="center"> <b><font size="1" color="#FFFFFF">Abertura</font></b></td>
    <td width="49%"><b><font size="1" color="#FFFFFF">Hist&oacute;rico</font></b></td>
  </tr>
  <?while ( list($tmp1, $tmp) = each($contatos) ) {
			   $abertura = "dia : " . $tmp["dataa"] . "<br>hora : " . $tmp["horaa"] . "<br>duração : " . $tmp["tempo"] ; ;
			   $encerramento = $tmp["datae"] . "<br>" . $tmp["horae"] ;
			   $descricao = $tmp["historico"];
               if ($palavra) {
                 $descricao = eregi_replace($palavra, "<b><font size=3 color=#FF0000>$palavra</font></b>", $descricao);
                }    
    			$descricao = eregi_replace("\r\n", "<br>",$descricao);
                $descricao = eregi_replace("\"", "`", $descricao);	
				
			   $quem = $tmp["consultor"];
			   $para = $tmp["destinatario"];
			   $origem = $tmp["origem"];
			   $pessoa = $tmp["pessoacontatada"];
			   $email  = $objChamado->email;
			   
			   if (($pessoa <> "") and ($email <> "")) {
			     $pessoa = "<a href=mailto:$email>$pessoa</a>";
			   }
			   
			   $status = $tmp["status"];
			   $publicar = $tmp["publicar"];
			   $frase = "";
			   if ($tmp["encaminhado"]) {$frase="<br><font color=#ff0000>encaminhado para $para</font>";  }
				if ( $tmp["status_id"] <> 1 ) {
				  $status = "<font color=#FF0000>".$status."</font>";
				} else {
				  $status = "<font color=#0000FF>".$status."</font>";
				}  
			   
			?>
  <tr bgcolor="#FCE9BC" valign="middle"> 
    <td width="15%" align="center"> 
	  <?
		 print "$origem<br>$pessoa";
	?>

    </td>
    <td width="15%" align="center"> 
      <?="$quem<br>$status"?>
    </td>
    <td> 
      <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FCE9BC" align="center">
        <tr bgcolor="#FCE9BC" valign="middle"> 
          <td width="7%">dia </td>
          <td width="14%"><b> 
            <?=$tmp["dataa"]?>
            </b> </td>
        </tr>
        <tr bgcolor="#FCE9BC" valign="middle"> 
          <td width="7%">hora</td>
          <td width="14%"> 
            <?=$tmp["horaa"]?>
          </td>
        </tr>
        <tr bgcolor="#FCE9BC" valign="middle"> 
          <td width="7%">dura&ccedil;&atilde;o</td>
          <td width="14%"> 
            <?=$tmp["tempo"]?>
          </td>
        </tr>
      </table>
    </td>
    <td width="49%" bgcolor="#FCE9BC"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
      <?  
       $msg="$descricao $frase";
	   if ($publicar) {
 	     $msg = "$msg<br><i>Visível para o cliente</i>";
       }
       print $msg;
	  ?>
      </font></td>
  </tr>
  <?}?>
</table>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr valign="middle" align="left"> 
    <td colspan="2">&nbsp;&nbsp;&nbsp;</td>
    <td width="42%">&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr valign="middle" align="left"> 
    <td width="46%" align="left"> <a name="fim"></a>
<input type="button" name="Button" value="Novo Contato" class="unnamed1" onClick="javascript:document.form.action.value='contato';vai();">
      <br>
    </td>
    <td width="12%" align="center">[<a href="javascript:history.go(-1);">voltar</a>]</td>
    <td width="42%" align="right"> 
      <input type="submit" name="Submit2" value="Novo Chamado" class="unnamed1" onClick="javascript:document.form.action.value='chamado';vai();">
    </td>
  </tr>
  <tr valign="middle" align="left"> 
    <td align="left" colspan="2"> Selecione esta op&ccedil;&atilde;o para dar 
      <br>
      continuidade a este chamado. </td>
    <td width="42%" align="right">Selecione esta op&ccedil;&atilde;o para abrir 
      um <br>
      novo chamado para este cliente. </td>
  </tr>
</table>
<p align="center"> <br>
</p>
<form name="form" method="post" action="novocontatochamado.php#Contato">
  <input type="hidden" name="chamado_id" value="<?=$id_chamado?>">
  <input type="hidden" name="cliente_id" value="<?=$id_cliente?>">
  <input type="hidden" name="action">
</form>
<script>
  function vai() {
    if ('-<?=$bl?>' == '-1') {
	  window.alert('Consultoria Bloqueada');
	  return;
	}
	
	
   if (  ( '-1' == '-<?=$atendimento?>') && ('<?=$id_cliente?>' != 'DATAMACE') && ('<?=$senha?>' == '00 000') ) {
//	  window.alert('Cliente Inativo');
//	  return;
	}		

  
    document.form.submit();
  }
</script>
</body>
</html>
