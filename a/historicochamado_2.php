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

    $fernando = ($ok == 12);

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

	
    // Aqui devo colocar uma opção que vai ordenar os contatos por data ou data desc
    
	
	
	if ($ordem) {
	  $ord = "";
	  $linkOrdem = "historicochamado.php?&id_chamado=$id_chamado";	  	  
	} else {
	  $ord = "desc";
	  $linkOrdem = "historicochamado.php?&id_chamado=$id_chamado&ordem='certa'";
	}
	$contatos = historicoChamado($id_chamado, $ord);
	
	
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

<SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
<script src="coolbuttons.js"></script>
<img src="figuras/topo_sad_e_900.jpg" width="900" height="79" >
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
	  
        <?
		 $msg = "$cliente ($senha)";
		 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
         echo $msg . "<br>$telefone";
		?>
      </font></td>
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
          <font size="2"><i>&nbsp;Descri&ccedil;&atilde;o</i></font></p>
        <blockquote> 
          <p><font size="2"><font color="#0000FF"> 
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
      <td>
       <input type="button" name="Button" value="Novo Contato" class="unnamed1" onClick="javascript:document.form.action.value='contato';vai();">	  
     </td>
      <td valign="middle" align="center"> 
        <div align="center"></div>
        <p align="center"><font size="2">Contatos Estabelecidos<br>
        [<a href="<?=$linkOrdem?>">inverter ordem</a>]		
          <br>	  
          <? if($rnc) {?>
          <a href="javascript:rnc();">Imprime Relatório RNC</a> <br>
          <a href="rnc/rnc.php?id_chamado=<?=$id_chamado?>">EDITAR</a> <br>
          <script>
  function rnc() {
     window.open('historicochamadornc.php?id_chamado='+<?=$id_chamado?>  , "Seleção", "scrollbars=yes, height=600, width=700");
  }
</script>
          <? } ?>
          <br>
          <a href="sigame/dosigame.php?id_usuario=<?=$ok?>&id_chamado=<?=$id_chamado?>">SIGA-ME</a></font></p>
      </td>
      <td align="right">
        <input type="submit" name="Submit22" value="Novo Chamado" class="unnamed1" onClick="javascript:document.form.action.value='chamado';vai();">
        
		</td>
    </tr>
  </table>
  <br>
</div>
<form name="upload" enctype="multipart/form-data" action="getfile.php" method="POST">
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
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
			   if ($fernando) {
			    $quem = "$quem (id Contato : ". $tmp["contato_id"] . ")";
			   }
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
  <tr valign="middle"> 
    <td width="100%" align="center" bgcolor="#FCE9BC"><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr> 
          <td valign="top" bgcolor="#003366"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td bgcolor="#FCE9BC"> <table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr> 
                      <td bgcolor="#FCE9a0"> Tipo de contato : 
                        <?=$origem?>
                        | Pessoa contatada : 
                        <?=$pessoa?>
                        | Status do contato : 
                        <?=$status?>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#FCE9a0"><font color="#003399"><b><?=$quem?></b></font> escreveu em <b><?=$tmp["dataa"]?></b> às <b><?=$tmp["horaa"]?></b></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td bgcolor="#FCE9BC"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><br>
                  </font> <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr> 
                      <td><font size="1"> 
                        <?  
       $msg="$descricao $frase";
	   if ($publicar) {
 	     $msg = "$msg<br><i>Visível para o cliente</i>";
       }
       print $msg;
	  ?>
	                        </font></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
										<?
					  $sql = "select * from saduploads where id_contato = "  . $tmp["contato_id"];
					  $up_result = mysql_query($sql);					  
					  while ($up_linha = mysql_fetch_object($up_result)) {
					?>					
                    <tr>
					<td>
                        <table width="618"  border="0" cellspacing="1" cellpadding="1">
                          <tr valign="top">
                            <td width="3%">
							<? if ($ok == $tmp["idconsultor"]) { ?>
							  <a href="ok.php?id=<?=$up_linha->id ?>&id_chamado=<?=$id_chamado ?>"><img src="imagens/deletar.gif" alt="Deletar o arquivo" width="12" height="12" border="0"></a>
						    <? } ?>							  
							</td>
                            <td><a href="/public_html/uploads/<?=$up_linha->nome ?>" target="_blank"> </a>Arquivo anexado:<a href="/public_html/uploads/<?=$up_linha->nome ?>" target="_blank">
							<? 
							  if ( (strpos($up_linha->nome, 'jpg') != 0) or
							       (strpos($up_linha->nome, 'JPG') != 0) or 
								   (strpos($up_linha->nome, 'gif') != 0) or
								   (strpos($up_linha->nome, 'GIF') != 0)  ) {
							    echo "<br><img src=\"/public_html/uploads/" . $up_linha->nome  .  "\" border=0>";
							  } else {
							    echo $up_linha->nome;
							  }
							?>
							
							
                              
                            </a>							</td>
                            </tr>
                        </table>
						</td>
                    </tr>
					<?
					  }
					?>					

<? if ($ok == $tmp["idconsultor"]) { ?>					
                    <tr>
                      <td><strong> arquivo a ser anexado:</strong>
                          <input name="userfile" type="file" class="borda_fina" size="50">
                          <input type="submit" class="borda_fina" value="Anexar">
                          <input type="hidden" name="contato_id" value="<?=$tmp["contato_id"] ?>">
                          <input type="hidden" name="consultor_id" value="<?=$ok ?>">
                          <input type="hidden" name="chamado_id" value="<?=$id_chamado ?>">
                          <a href="javascript:help();">(o que &eacute; isso ?)</a> </td>
                    </tr>
					     				<? }?>
                  </table>
                  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">&nbsp; 
                  </font></td>
              </tr>
              <tr> 
                <td bgcolor="#FCE9a0"> <em>duração do contato: 
                  <?=$tmp["tempo"]?>
                  </em></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <?}?>
</table>
<input type="hidden" name="MAX_FILE_SIZE" value="99999999">
</form >
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
    <td width="12%" align="center">[<a href="javascript:history.go(-1);">voltar</a>]<br>
      [<a href="<?=$linkOrdem?>">inverter ordem</a>]</td>
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
<p align="center">&nbsp; </p>
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
  
  if ('-<?=$sigame?>' != '-') {
    window.alert('Chamado colocado na lista de SIGA-ME');
  }
</script>
</body>
</html>
