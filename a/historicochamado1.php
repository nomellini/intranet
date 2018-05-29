<?
	require("scripts/conn.php");
	require("scripts/classes.php");	
	if ( isset($id_usuario)) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
	    if (!isset($ok)) {
			header("Location: index.php");
		}
	}
	

    $fernando = ($ok == 12) || ($ok==141);
	$chamados=pegaChamado($id_chamado);	
	
	// Quais chamados dependem deste aqui
	$ChamadosAguardando = conn_PegaChamadosAguardando($id_chamado);
	
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
		$nowTime = date("G:i:s");
		$nowDate =date("Y-m-d");
		$sql = "update chamado set lido = 1, datalidodestinatario = '$nowDate',  horalidodestinatario = '$nowTime' where id_chamado = $id_chamado";
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
		 = 44 Antonio Adm

       Marcelo, Sandra e eu podem abrir chamados em consultoria bloqueada.	  	
	   Qualquer alteração aqui deve ser feita em Historico.PHP, pois o código
	   é o mesmo
	*/
    if (
	    ($ok==1) or  // edson
	    ($ok==7) or  // Hudson		
		($ok == 84) or // Luciana
		($ok == 77) or // Luciana		
		($ok == 13) or // Leandro
		($ok==12) or  //Fernando
	    ($ok==132) or 		
	    ($ok== 150) or  		
	    ($ok== 126) or  	
	    ($ok== 39) or  	// Rogerio					
	    ($ok==63) or 	
	    ($ok==6 ) or  //Antonio 
	    ($ok==132) or 
		($ok==2) or 
		($ok==41) or 
		($ok == 141) or // Nunes
		($ok==16) or 
		($ok==196) or 
		($ok==44) ) {
	  $bl=0;
	}  
	
	$podeLiberar = 0;
	if (
	     ($ok == 9) or
	     ($ok==12) or
	     ($ok == 1) or 
		 ($ok==8) or 
		 ($ok==7) 
		) {
    	$podeLiberar =1;
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
	
    $UltimoContato =count($contatos);
	$Ccontador = $UltimoContato + 1;
	
	
    $total_pendentes = count($chamadosemaberto);
	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);
	
	$status = pegaStatus( $objChamado->status );


	$categoria_desc =  $objChamado->categoria;
	$isPosVenda = $objChamado->pos_venda;
	$pos_venda = "";				
	if ($isPosVenda) {
		$pos_venda = "<b>PÓS-VENDA<br/></b>";
		$categoria_desc =  "<h1>$categoria_desc</h1>";
	}
	
	
	$espero = $objChamado->dependo_de;
	if ($espero) {
		$espero = conn_PegaAguardandoChamado($objChamado->id_chamado);
	} else {
		$espero = "";
	}

	if ( $objChamado->status <> 1 ) {
	  $status = "<font color=#FF0000>".$status."</font>";
	} else {
      $status = "<font color=#0000FF>".$status."</font>";
	}
	  
	$prioridade = pegaPrioridade($objChamado->prioridade_id);
	$prioridade = "<b>$prioridade</b>";
	
	if ($objChamado->dataprevistaliberacao == '0000-00-00') {
		$DataLiberacao = 'Sem data definida';
	} else {
		$DataLiberacao = explode('-', $objChamado->dataprevistaliberacao);
		$DataLiberacao = "$DataLiberacao[2]/$DataLiberacao[1]/$DataLiberacao[0]";
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
<link href="sgq/attendere.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body background="../agenda/figuras/fundo.gif" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">

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
      <td width="31%"><font size="2">Sistema de Atendimento Datamace</font></td>
      <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
          <tr bgcolor="#FFFFFF">
            <form action="historico.php" method="post" name="formx" target="_blank" id="formx">
              <td align="left" valign="top"><div align="center"><font color="#0000FF"><b>
                <input type="hidden" name="action2">
                </b></font><font size="2"></font><font color="#0000FF"><b>
                  <input name="id_cliente" type="text" class="bordaTexto" id="id_cliente" title="Digite o n&uacute;mero do chamado ou o cliente e tecle enter">
                  </b>
                  <input name="hist" type="submit" class="bordaTexto" id="hist" title="Digite o n&uacute;mero do chamado ou do cliente na caixa de texto ao lado." value="Ver hist&oacute;rico" >
                </font></div></td>
            </form>
          </tr>
      </table></td>
      <td width="27%"><div align="right"><font size="2">Usu&aacute;rio <font color="#FF0000">:<b>
          <?=$nomeusuario?>
      </b></font></font></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="CorBordaTabelaSad">
    <tr class="CorFundoTabela">
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="SubitemSad">
        <tr >
          <td width="9%" align="center" valign="middle" class="TituloSubitemSad"><font size="2">
            Chamado
          </font></td>
          <td width="14%" align="center" valign="middle" class="TituloSubitemSad"><font size="2">
            Data
          da abertura
          </font></td>
          <td width="13%" align="center" valign="middle" class="TituloSubitemSad"><font size="2">
            Hora
          de abertura
          </font></td>
          <td colspan="2" class="TituloSubitemSad"><font size="2">
            Cliente
          </font></td>
          <td width="17%" class="TituloSubitemSad"><div align="center">
            <font size="2">
              Status            </font>
          </div></td>
        </tr>
        <tr >
          <td width="9%" align="center"><div align="center">
            <font color="#FF0000"><b>
			<font size="3"><?=trim(number_format($id_chamado,0,',','.'))?></font></b>
			</font>
          </div>		  
</td>
          <td width="14%" align="center"><div align="center">
            <font size="2">
              <strong>
                <?=$objChamado->dataaf?><br><?=DiaDaSemana($objChamado->dataaf);?>
                </strong>              </font>
          </div></td>
          <td width="13%" align="center"><div align="center">
              <font size="3">
                <strong>
                  <?=$objChamado->horaa?>
                </strong>              </font>
          </div></td>
          <td colspan="2" valign="top"><font size="2">
		  
         <?
		 $msg = "<b>$cliente</b> ($senha)";
		 
		 $msg = "<a target=\"_blank\" href=\"/a/historico.php?id_cliente=$id_cliente\">$msg</a>";
		 
		 if ($bl) { $msg="<b><font color=#ff0000>$cliente (bloqueado)</font></b>" ;}
         echo $msg . "<br> Fone : $telefone";
		?>
          </font></td>
          <td width="17%"><div align="center">
            <b>
              <font size="3">
                  <?=$status?> <br> <?=$prioridade?>
                </font>            </b>
          </div></td>
        </tr>
        <tr >
          <td align="right" class="TituloSubitemSad">Sistema&nbsp;</td>
          <td colspan="2" class="TituloSubitemSad">
            <strong>
              <?=pegaSistema($id_sistema)?>
              </strong>           </td>
          <td width="14%" align="right" class="TituloSubitemSad">Categoria &nbsp;</td>
          <td colspan="2" class="TituloSubitemSad">
            <strong>
              <?=$categoria_desc?>
              </strong>            </td>
          </tr>
        <tr class="TituloSubitemSad" >
          <td align="right"><font size="1">
            Aberto por&nbsp;
          </font></td>
          <td colspan="2"><font size="1">
            <strong>
              <?=$abertopor?>
              </strong>
          </font>          </td>
          <td align="right"><font size="1">
            Este chamado est&aacute; com&nbsp;
          </font></td>
          <td colspan="2"><font size="1">
            <strong>
              <?=$destinatario?>
              </strong>
          </font>          </td>
          </tr>
        <tr class="TituloSubitemSad" >
          <td align="right">Diagn&oacute;stico&nbsp;</td>
          <td colspan="2"><strong>
            <?=pegaDiagnostico($diagnostico)?>
          </strong></td>
          <td colspan="2">&nbsp;</td>
          <td align="center" valign="middle"> Libera&ccedil;&atilde;o em </td>
        </tr>
        <tr class="TituloSubitemSad" >
          <td align="right">
              Motivo&nbsp;</td>
          <td colspan="4">
            <strong>
              <?=pegaMotivo($motivo)?>
              </strong>                  </td>
          <td align="center"><p><strong>
            <?=$DataLiberacao?></strong>
			<?
			if ($podeLiberar==1) {
			?>
            <br>
            [<a href="javascript:dataprevista(<?=$id_chamado?>, <?=$ok?>);">Editar Data Libera&ccedil;&atilde;o</a>]
			<?
			}
			?>
			</p>
            </td>
        </tr>
        <tr >
          <td colspan="6"><p>
              <i><br>
              <font size="2">
                &nbsp;Descri&ccedil;&atilde;o              </font>              </i>
              <blockquote>
                <p>
                  <font size="2">
                    <font color="#0000FF">
                      <strong>
                      <?
		    $descricao = $chamado["descricao"];
		  	if ($palavra) {
             $descricao = eregi_replace($palavra, "<b><font  color=#FF0000>$palavra</font></b>", $descricao); 			 
            }
            
			
			$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4" target="_blank">$2$3$4</a>', $descricao);
											
					
			//$descricao = eregi_replace("C",'A',$descricao);
			
			$descricao = nl2br($descricao);
            print $descricao; 
		?>
                      </strong>
                      <br>
					  <?= $ChamadosAguardando?>
					  <?= $espero ?>
                    </font>                  </font>                </p>
              </blockquote><? if ($fernando) { ?> <a href="manut/ec.php?acao=ver&id=<?=$id_chamado?>">.</a><strong> <?php echo $tmp["contato_id"]; ?><? } ?></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td>
       <input type="button" name="Button" value="Novo Contato" class="unnamed1" onClick="javascript:document.form.action.value='contato';vai();">	  
     </td>
      <td valign="middle" align="center"> 
        <div align="center">
          <font size="1">
            [
            <a href="<?=$linkOrdem?>">
              Inverter ordem
            </a>
            ]
            <? if($rnc) {?> 
            ::
            [
            <a href="javascript:rnc();">
              Imprime Relatório RNC
            </a>
            ] :: 
            [
            <a href="rnc/rnc.php?id_chamado=<?=$id_chamado?>">
              Editar
            </a>
            ]
            <script>
  function rnc() {
     window.open('historicochamadornc.php?id_chamado='+<?=$id_chamado?>  , "Seleção", "scrollbars=yes, height=600, width=700");
  }
            </script>
            <? } ?>
           :: [
           <a href="sigame/dosigame.php?id_usuario=<?=$ok?>&id_chamado=<?=$id_chamado?>">
             Incluir no Desktop &quot;SIGA-ME&quot;
           </a>
           ]
          </font>
        </div>
        <br>
        <div align="center">
          <strong>
          <font size="2">
            Contatos Estabelecidos
          </font>
          </strong><br>
(<span id="contatos"></span>)
        </div>
      </td>
      <td align="right">
        <input type="submit" name="Submit22" value="Novo Chamado" class="unnamed1" onClick="javascript:document.form.action.value='chamado';vai();">
        
	  </td>
    </tr>
  </table>
  <br>
</div>

<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="CorBordaTabelaSad">
<?
  while ( list($tmp1, $tmp) = each($contatos) ) {
			   $abertura = "dia : " . $tmp["dataa"] . "<br>hora : " . $tmp["horaa"] . "<br>duração : " . $tmp["tempo"] ; ;
			   $encerramento = $tmp["datae"] . "<br>" . $tmp["horae"] ;
			   $descricao = $tmp["historico"];
               if ($palavra) {
                 $descricao = eregi_replace($palavra, "<b><font size=3 color=#FF0000>$palavra</font></b>", $descricao);
                }    
				
				$DataContato = $tmp["DataContato"];
				$DataContato = DiaDaSemana($DataContato);


				//$descricao = eregi_replace('\\\', '-', $descricao);
				
				$descricao = nl2br(" ".$descricao);
				$descricao = preg_replace('/\s\s+/', ' ', $descricao);					
				$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4" target="_blank">$2$3$4</a>', $descricao);
				
				$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\,)([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4#c_$6" target="_blank">$2$3$4 [$6]</a>', $descricao);
				
											
			
				
			   $quem = $tmp["consultor"];
			   $para = $tmp["destinatario"];
			   $origem = $tmp["origem"];
			   $pessoa = $tmp["pessoacontatada"];
			   
			   if ($rnc <> 0) { 
			     $pessoa = '';
			   }
			   
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
				
				
				$Ccontador--;	   
				$contador = "Contato # " . sprintf("%03d", $Ccontador);				
				$msg="$descricao $frase";
				if ($publicar) {
					$msg = "$msg<br><i>Visível para o cliente</i>";
				}
				
			  				
			   
			?>
  <tr valign="middle" class="CorFundoTabela"> 
    <td width="100%" align="center"><table width="100%" border="0" cellpadding="1" cellspacing="1" class="SubitemSad">
        <tr> 
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="TituloSubitemSad"><a name="c_<?=$Ccontador?>"></a>
<?
	   print "[<a href=\"#c_1\">Primeiro</a>]";
	   print "[<a href=\"#c_". (($Ccontador)+1)."\">Próximo</a>]";
	   print "[<a href=\"#c_". (($Ccontador)-1)."\">Anterior</a>]";	   
	   print "[<a href=\"#c_".$UltimoContato."\">Último</a>]";
	   print " - $contador";
?><br>	   	   
			  
					  
					  Tipo de contato : 
                        <strong>
                        <?=$origem?>
                        </strong>
                        | Pessoa contatada : 
                        <strong>
                        <?=$pessoa?>
                        </strong>
                        | Status do contato : 
                        <strong>
                        <?=$status?>
                      </strong></td>
                    </tr>
                    <tr>
                      <td class="TituloSubitemSad"><font color="#000000">
                        <strong>
                        <?=$quem?>
                        </strong>
                        </font> 
                        escreveu em <strong><?=$tmp["dataa"]?> (<?=$DataContato?>)</strong>  às 
                        <strong><?=$tmp["horaa"]?> </strong>                        
						</td>
                    </tr>
                </table></td>
              </tr>
              <tr> 
                <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><br>
                  </font> <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr> 
                      <td><font size="1">
<?  
       print $msg;
?>
	                        <a name="ok"></a></font></td>
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

							<? if  (($ok == $tmp["idconsultor"])) { ?>


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
<? if ( /*($ok == 12) or */($ok == $tmp["idconsultor"]) ) { ?>					
<form name="upload" enctype="multipart/form-data" action="getfile.php" method="POST">

                    <tr>
                      <td><strong>Anexar arquivo a este contato:&nbsp;</strong>
                          <input name="userfile" type="file" class="borda_fina" size="50">
                          <input type="submit" class="borda_fina" value="Anexar">
                          <input type="hidden" name="contato_id" value="<?=$tmp["contato_id"] ?>">
                          <input type="hidden" name="consultor_id" value="<?=$ok ?>">
                          <input type="hidden" name="chamado_id" value="<?=$id_chamado ?>">
							<input type="hidden" name="MAX_FILE_SIZE" value="99999999"></td>
                    </tr>
					
</form >															
					     				<? }?>
										
										
<? if ( /*($ok == 12) or */($ok == $tmp["idconsultor"]) ) { ?>					
<form name="append"  action="append.php" method="POST">

                    <tr>
                      <td><strong>Adicionar texto a este contato: <br>
                          <label>
                            <textarea name="texto" cols="80" rows="3" class="botao_fino" id="texto"></textarea>
                          </label>
                          <br>
</strong>
                        <input type="submit" class="borda_fina" value="Adicionar ao contato">
                          <input type="hidden" name="contato_id" value="<?=$tmp["contato_id"] ?>">
                          <input type="hidden" name="consultor_id" value="<?=$ok ?>">
                          <input type="hidden" name="chamado_id" value="<?=$id_chamado ?>">
						<input type="hidden" name="MAX_FILE_SIZE" value="99999999"></td>
                    </tr>
					
</form >															
					     				<? }?>
                  </table>
                  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">&nbsp; 
                </font></td>
              </tr>
              <tr class="TituloSubitemSad"> 
                <td> <em>
                    

				  <?
				  print $contador . ". Duração do contato: ";
                  print $tmp["tempo"];
				  $segundos += $tmp["temposec"];
				  ?>
                </em>
				
				
<? if ($fernando) { ?><a href="manut/EditaContato.php?id_contato=<?=$tmp["contato_id"]?>">.</a><? } ?>
					  				
				</td>
              </tr>
          </table></td>
        </tr>
    </table></td>
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
      <br>    </td>
    <td width="12%" align="center">[<a href="javascript:history.go(-1);">voltar</a>]<br>
      [<a href="<?=$linkOrdem?>">inverter ordem</a>]</td>
    <td width="42%" align="right"> 
      <input type="submit" name="Submit2" value="Novo Chamado" class="unnamed1" onClick="javascript:document.form.action.value='chamado';vai();">    </td>
  </tr>
  <tr valign="middle" align="left"> 
    <td align="left" colspan="2"> Selecione esta op&ccedil;&atilde;o para dar 
      <br>
      continuidade a este chamado. </td>
    <td width="42%" align="right">Selecione esta op&ccedil;&atilde;o para abrir 
      um <br>
      novo chamado para este cliente. </td>
  </tr>
  <tr valign="middle" align="left">
    <td align="left" colspan="2">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr valign="middle" align="left">
    <td align="left" colspan="3">
	
          <p><strong>Inserir</strong> na pasta:<br>          
            <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta not in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";
	
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/addchamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}
?><br>

            <strong>Mover</strong> para a pasta:<br>          
            <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta not in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";
	
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/moverchamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}
?>

          
          <br>
          <strong>Retirar</strong> da pasta:<br>
          
          <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta  in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";

	
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/removechamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}

?>
  </p>
      <p><a href="pastas/criarpasta.php?id_chamado=<?=$id_chamado?>&id_usuario=<?=$ok?>"><span class="style7"><img src="figuras/NovaPasta.jpg" alt="NovaPasta" width="25" height="25" border="0" align="absmiddle">Criar Pasta e incluir este chamado </span></a> </p>
</td>
  </tr>
</table>

<form name="form" method="post" action="novocontatochamado.php#Contato">	
  <input type="hidden" name="chamado_id" value="<?=$id_chamado?>">
  <input type="hidden" name="cliente_id" value="<?=$id_cliente?>">
  <input type="hidden" name="action">
</form>

<form name="form2" method="post" action="">	
</form>


<p>
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
  

  contatos.innerHTML = '<?php echo "$UltimoContato contato(s) consumindo " . segTohora($segundos);?>';
  
</script>

<script>
	function dataprevista(chamado, usuario) {
	  var newWindow;
	  window.name = "pai";  
	  newWindow = window.open( 'lembrete/EditaDataPrevistaLiberacao.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
	}	
	
</script>
</p>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
