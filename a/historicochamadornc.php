<?
	require("scripts/conn.php");
	require("scripts/classes.php");	
	require("rnc/funcoes.php");	
	
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
	//loga_online($ok, $REMOTE_ADDR, $id_chamado);	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	
	
	list($tmp1, $chamado) = each($chamados);
		
    $diagnostico = $chamado["diagnostico"];
	$id_cliente = $chamado["id_cliente"];
	$categoria = $chamado["categoria"];
	$motivo = $chamado["motivo"];
	$id_sistema = $chamado["sistema_id"];
	$abertopor = pegaNomeUsuario($chamado["consultor_id"]);
	$destinatario = pegaNomeUsuario($chamado["destinatario_id"]);	
	
	$rnc_depto_responsavel = $chamado["rnc_depto_responsavel"];
	$rnc_prazo = dataok($chamado["rnc_prazo"]);	
	$rnc_data = dataok($chamado["rnc_data"]);
	$rnc_acao_responsavel = $chamado["rnc_acao_responsavel"];	
	$rnc_acao_data = dataok($chamado["rnc_acao_data"]);
	$rnc_verif_responsavel = $chamado["rnc_verif_responsavel"];	
	$rnc_verif_data = dataok($chamado["rnc_verif_data"]);

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
	if ( !$atendimento or $ok ==2) {
 	  $bl = 0;
	}
    if ($ok==2 or $ok==41 or $ok==12) {$bl=0; $atendimento=0 ;}  // Marcelo pode abrir chamados em consultoria bloqueada.	
	
    $contatos = historicoChamadoRNC($id_chamado);
    $total_pendentes = count($chamadosemaberto);
	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);
	$tipo = $objChamado->rnc;
	$status = pegaStatus( $objChamado->status );
	if ( $objChamado->status <> 1 ) {
	  $status = "<font color=#000000>".$status."</font>";
	} else {
      $status = "<font color=#000000>".$status."</font>";
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
<table width="100%" border="0">
  <tr>
    <td><a href="javascript:window.print();">Imprimir</a></td>
    <td align="right"><a href="javascript:window.close();">Fechar</a></td>
  </tr>
</table>
<div align="center"> <br>
  <SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
  <script src="coolbuttons.js"></script>
  <font size="3"><em><strong> <?=GetLabelTitulo($tipo)?> 
  número : 
  <?=$id_chamado?>
  </strong> </em> </font></div>
<hr size="1" noshade>

  
<table width="98%" border="0" align="center">
  <tr> 
      <td width="48%">&nbsp;</td>
      <td width="52%">&nbsp;</td>
  </tr>
</table>
  
  
<table width="98%" border="0" align="center">
  <tr bgcolor="#F9F9F9"> 
    <td width="14%" valign="top" bgcolor="#F9F9F9"><strong># Controle</strong></td>
    <td colspan="3" valign="top" bgcolor="#F9F9F9"><font color="#000000"><b> 
      <?=$id_chamado?>
      </b></font></td>
  </tr>
  <tr bgcolor="#F9F9F9"> 
    <td valign="top" bgcolor="#F9F9F9"><strong>Data / Hora</strong></td>
    <td colspan="3" valign="top" bgcolor="#F9F9F9"> 
      <?=$objChamado->dataaf?>
      <?=$objChamado->horaa?>    <? echo $cliente; ?></td>
  </tr>
  <tr bgcolor="#F9F9F9"> 
    <td valign="top" bgcolor="#F9F9F9"><strong><?=GetLabelDescricao($tipo)?></strong></td>
    <td colspan="3" valign="top" bgcolor="#F9F9F9"><font size="3"><font color="#000000"> 
      <?
		    $descricao = $chamado["descricao"];
		  	if ($palavra) {
             $descricao = eregi_replace($palavra, "<b><font  color=#000000>$palavra</font></b>", $descricao);
            }
            
			$descricao = eregi_replace("\r\n", "<br>",$descricao);
            $descricao = eregi_replace("\"", "`", $descricao);	

            print $descricao; 
		?>
      </font></font></td>
  </tr>
  <tr bgcolor="#F9F9F9">
    <td valign="top" bgcolor="#F9F9F9">&nbsp;</td>
    <td width="25%" valign="top" bgcolor="#F9F9F9">&nbsp;</td>
    <td width="22%" valign="top" bgcolor="#F9F9F9">&nbsp;</td>
    <td width="39%" valign="top" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr bgcolor="#F9F9F9">
    <td valign="top" bgcolor="#F9F9F9">Resp.Abertura</td>
    <td valign="top" bgcolor="#F9F9F9"><strong><?=$rnc_depto_responsavel?></strong></td>
    <td valign="top" bgcolor="#F9F9F9">Data: <strong><?=$rnc_data?></strong></td>
    <td valign="top" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr bgcolor="#F9F9F9">
    <td valign="top" bgcolor="#F9F9F9">Resp. A&ccedil;&atilde;o </td>
    <td valign="top" bgcolor="#F9F9F9"><strong><?=$rnc_acao_responsavel?></strong></td>
    <td valign="top" bgcolor="#F9F9F9">Prazo: <strong>
    <?=$rnc_prazo?>
    </strong></td>
    <td valign="top" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
  <tr bgcolor="#F9F9F9">
    <td valign="top" bgcolor="#F9F9F9">Resp. Verif. </td>
    <td valign="top" bgcolor="#F9F9F9"><strong><?=$rnc_verif_responsavel?></td>
    <td valign="top" bgcolor="#F9F9F9">Prazo: <strong><?=$rnc_verif_data?></strong></td>
    <td valign="top" bgcolor="#F9F9F9">&nbsp;</td>
  </tr>
</table>
<br>
  
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
      <td valign="middle" align="center"> <div align="center"></div>
        
</td>
  </tr>
</table>
  <br>

<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
 
  <?
    $tmp1 = array();
	$_Array = Array();
	
    while ( list($tmp1, $tmp) = each($contatos) ) {
			   $abertura = "dia : " . $tmp["dataa"] . "<br>hora : " . $tmp["horaa"] . "<br>duração : " . $tmp["tempo"] ; ;
			   $encerramento = $tmp["datae"] . "<br>" . $tmp["horae"] ;
			   $descricao = $tmp["historico"];
               if ($palavra) {
                 $descricao = eregi_replace($palavra, "<b><font size=3 color=#000000>$palavra</font></b>", $descricao);
                }    
    			$descricao = eregi_replace("\r\n", "<br>",$descricao);
                $descricao = eregi_replace("\"", "`", $descricao);	
				
			   $quem = $tmp["consultor"];
			   $para = $tmp["destinatario"];
			   $origem = $tmp["origem"];
 			   $pessoa = $tmp["pessoacontatada"]; 
			   if ($pessoa == 'disposicao') {
			     $pessoa =  'Correção';
				 $p=1;
				 if ($tipo<>1) {
				  $p=0;
				 }
			   } else if ($pessoa == 'causa') {
			     $pessoa = GetLabelCausa($tipo);//'Causa Raiz';
 				 $p=2; 
			   } else if ($pessoa == 'acao') {
			     $pessoa = GetLabelProposta($tipo);
				 $p=3;
			 //  } else if ($pessoa == 'proposta') {
			 //    $pessoa = 'Proposta para ação preventiva';
			   } else if ($pessoa == 'verificacao') {
			     $pessoa = 'Verificação de Eficácia';
				 $p=4;
			   } else {
			     $pessoa = '';
				 $p=0;
			   }
			   			   
			   $status = $tmp["status"];
			   $publicar = $tmp["publicar"];
			   $frase = "";
			   if ($tmp["encaminhado"]) {$frase="<br><font color=#000000>encaminhado para $para</font>";  }
				if ( $tmp["status_id"] <> 1 ) {
				  $status = "<font color=#000000>".$status."</font>";
				} else {
				  $status = "<font color=#000000>".$status."</font>";
				}  
			   
			   if ($pessoa) {
			     $_tmp["titulo"] = "$pessoa";
				 $_tmp["descricao"] = "$descricao $frase";
				 $_Array[$p] = $_tmp;
			   }

		   }
		   
	
  for($i=2;$i<5;$i++) {		   
  ?>
  <tr> 
    <td colspan="2" align="center" valign="middle"><hr size="1"></td>
  </tr>
  <tr> 
    <td colspan="2" valign="top" bgcolor="#CCCCCC"> 
    <b><?=$_Array[$i]["titulo"];?></b>
    </td>
  </tr>
  <tr valign="top"> 
    <td colspan="2"> <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
        <tr>
          <td>
		  	
	<font face="Verdana, Arial, Helvetica, sans-serif" size="1">
	<?=$_Array[$i]["descricao"];?>
      </font>
	  

		  </td>
        </tr>
      </table> </td>
  </tr>
  <?
    //} // If ($essoa)
    } // while
  ?>
  <tr>
  <td><hr size="1"></td>
  </tr>
</table>
</body>
</html>
