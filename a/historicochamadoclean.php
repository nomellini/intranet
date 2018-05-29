<?
	require("scripts/conn.php");
	require("scripts/classes.php");	

	$id_usuario = $ok;	
    $fernando = ($ok == 12);

	if ((!isset($id_chamado)) or ($id_chamado=='')) {
		die("Obrigatório número do chamado");
	}


	if (!is_numeric($id_chamado)) {
		die("Chamado deve ser um número");
		//header("Location: index.php");
	}

	$chamados=pegaChamado($id_chamado);
	
	if (count($chamados) == 0) {	
		die("chamado $id_chamado sem contato");
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

<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#F9FDFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="100%">Chamado <a href="historicochamado.php?id_chamado=<?=$id_chamado?>"><strong>
            <?=number_format($id_chamado,0,',','.')?>
          </strong></a><br />
            Cliente
            <?
		 $msg = "<b>$cliente</b> ($senha)";
		 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
         echo $msg . "<br> Fone : $telefone";
		?></td>
        </tr>
        <tr>
          <td><a href="javascript:alterna(Detalhes, txtDetalhes, 'Ver', 'Esconder');"> <span id=txtDetalhes>Ver</span> Detalhes</a> </td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF"><span id="Detalhes" style="display: none">
            <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#003366">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                      <td width="12%" bgcolor="#FFF4F5"> Abertura </td>
                      <td width="36%" bgcolor="#FFF4F5"><?=$objChamado->dataaf?>
                          <?=$objChamado->horaa?>                      </td>
                      <td width="11%" bgcolor="#FFF4F5">Motivo</td>
                      <td width="41%" bgcolor="#FFF4F5"><strong>
                        <?=pegaMotivo($motivo)?>
                      </strong></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFF4F5">Status</td>
                      <td bgcolor="#FFF4F5"><?=$status?>
                        -
                        <?=$prioridade?>                      </td>
                      <td bgcolor="#FFF4F5">Diagn&oacute;stico</td>
                      <td bgcolor="#FFF4F5"><strong>
                        <?=pegaDiagnostico($diagnostico)?>
                        </strong></td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFF4F5">Sistema</td>
                      <td bgcolor="#FFF4F5"><?=pegaSistema($id_sistema)?>                      </td>
                      <td bgcolor="#FFF4F5">Categoria</td>
                      <td bgcolor="#FFF4F5"><?=pegaCategoria($categoria)?>                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#FFF4F5">Aberto Por </td>
                      <td bgcolor="#FFF4F5"><?=$abertopor?></td>
                      <td bgcolor="#FFF4F5">Est&aacute; com </td>
                      <td bgcolor="#FFF4F5"><?=$destinatario?></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            </span> </td>
        </tr>
        <tr>
          <td><strong>Descri&ccedil;&atilde;o</strong></td>
        </tr>
        <tr>
          <td><table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
              <tr>
                <td><span class="style9">
                  <?
		    $descricao = $chamado["descricao"];          
			$descricao = nl2br($descricao);
            print $descricao; 
		?>
                  </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><strong>Contatos</strong></td>
        </tr>
      </table>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="0" >
        <?
  while ( list($tmp1, $tmp) = each($contatos) ) {
			   $abertura = "dia : " . $tmp["dataa"] . "<br>hora : " . $tmp["horaa"] . "<br>duração : " . $tmp["tempo"] ; ;
			   $encerramento = $tmp["datae"] . "<br>" . $tmp["horae"] ;
			   $descricao = $tmp["historico"];
               if ($palavra) {
                 $descricao = eregi_replace($palavra, "<b><font size=3 color=#FF0000>$palavra</font></b>", $descricao);
                }    

    			//$descricao = eregi_replace("\r\n", "<br>",$descricao);
                //$descricao = eregi_replace("\"", "`", $descricao);	

				$descricao = nl2br(" ".$descricao);
				/*
				$descricao = preg_replace('/\s\s+/', ' ', $descricao);
				$descricao = preg_replace('/\s(\w+:\/\/)(\S+)/', ' <a href="\\1\\2" target="_blank">\\1\\2</a>', $descricao);
			    */
				
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
        <tr valign="middle">
          <td width="100%" align="center"><table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#CAE4FF">
              <tr>
                <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFEC">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td ><font color="#000000"> <strong>
                                    <?=$quem?>
                                    </strong> </font> escreveu em <strong>
                                    <?=$tmp["dataa"]?>
                                    </strong> às <strong>
                                    <?=$tmp["horaa"]?>
                                    </strong> </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> </font>
                              <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
                                <tr>
                                  <td><font size="1">
                                    <?  
       print $msg;
?>
                                    <a name="ok"></a></font></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td><img src="../imagens/1pixel.gif" width="1" height="1"></td>
              </tr>
            </table></td>
        </tr>
        <?}?>
      </table></td>
  </tr>
</table>
