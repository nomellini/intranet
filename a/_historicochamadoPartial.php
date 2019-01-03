<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="CorBordaTabelaSad" >
<?


  while ( list($tmp1, $tmp) = each($contatos) ) {
			   $abertura = "dia : " . $tmp["dataa"] . "<br>hora : " . $tmp["horaa"] . "<br>duração : " . $tmp["tempo"] ; ;
			   $encerramento = $tmp["datae"] . "<br>" . $tmp["horae"] ;


				$DataContato = $tmp["DataContato"];
				$DataContato = DiaDaSemana($DataContato) . ", " . $tmp["dias"];

			   $descricao = $tmp["historico"];
			   
               if ($palavra) {
                 $descricao = eregi_replace($palavra, "<b><font size=3 color=#FF0000>$palavra</font></b>", $descricao);
                }    
								
				$Data_Contato = implode( explode("-",  $tmp["DataContato"])); 
				if ($Data_Contato <= 20101007)  {
					$descricao = nl2br(" ".$descricao);
				}	
				
//				$descricao = eregi_replace("r", "<br />", $descricao);
				$descricao = preg_replace('/\s\s+/', ' ', $descricao);					    
				$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4" target="_blank">$2$3$4</a>', $descricao);
				
				// Chave de abertura 	           #1
				// de 0 a três caracteres 0 a 9.   #2
				// um ponto opcional               #3
				// de zero a três caracterez 0-9   #4
				// vírgula Obrigatória             #5
				// Espaços em branco opcionais     #6				
				// Zeros opcionais	               #7
				// digitos do contato              #8
				// Chave de fechamento             #9
				$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\,)([\s])?([0]{0,3})([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4#c_$8" target="_blank">$2$3$4 [$7$8]</a>', $descricao);
												
				//$descricao .= 	 $tmp["DataContato"];
												
			
			// Descrição do nome;			
			
			if ($NovoContato) {
				$class =  "SubitemSadNovoContato";		
			} else {
				$class =  "SubitemSad";				
			}
						
			$class =  "SubitemSad";										
						
			$DestacaContato = $tmp["Ic_Atencao"] == 1;
			$LarguraBorda = 0;
			if ($DestacaContato) {
				$class =  "SubitemSadAlerta";
				$LarguraBorda = 5;
			}

			$DonoDoContatoID = $tmp["consultor_id"];			
			$SuperiorID = $tmp["superior_id"];

			$quem = $tmp["consultor"] . " " . $tmp["ramal"]; 
			
			$PodeEditarTempo = (
				$SouGestor && 
				(
					($ok == $DonoDoContatoID) ||
					($ok == $SuperiorID)
				)
			);
			
			
			if (
				 ($ok == $DonoDoContatoID) &&
				 ($SuperiorID == $NunesId)
			   ) 
			{
				$PodeEditarTempo = true;
			}
			
			if ($fernando) {
				$PodeEditarTempo = true;
			}
			
			if ($nunes and ($DonoDoContatoID == 7))
			{
				$quem = "<font color=\"#006666\" size=\"+1\">$quem</font>";
				
			}
			
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
  <tr valign="middle" class="CorFundoTabela" > 
    <td width="100%" align="center" class="<?=$class?>">
      <table width="100%" border="0" cellpadding="1" cellspacing="<?=$LarguraBorda?>" class="<?=$class?>">
        <tr class="SubitemSad"> 
          <td valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" >
              <tr> 
                <td> <table width="100%" border="0" cellspacing="0" cellpadding="0"  >
                    <tr> 
                      <td class="TituloSubitemSad"><a name="c_<?=$Ccontador?>"><a name="Id_<?=$tmp["contato_id"]?>"></a>
<?
	   print "[<a href=\"#c_1\">Primeiro</a>]";
	   print "[<a href=\"#c_". (($Ccontador)+1)."\">Próximo</a>]";
	   print "[<a href=\"#c_". (($Ccontador)-1)."\">Anterior</a>]";	   
	   print "[<a href=\"#c_".$UltimoContato."\">Último</a>]";
	   if ($Ccontador == $UltimoContato) {
		   print "<a name=c_ultimo></a>";
	   }
	   print " - $contador - $DestacaContato";
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
                      </strong> 
                      
                      </td>
                    </tr>
                    <tr>
                      <td class="TituloSubitemSad"><font color="#000000">
                        <strong>
                        <?=$quem?>
                        </strong>
                        </font> 
                        escreveu em <strong><?=$tmp["dataa"]?> (<?=$DataContato?>)</strong>  :: 
                        In&iacute;cio: <strong><?=$tmp["horaa"]?> </strong> </strong> - Fim: <b><?=$tmp["horae"]?></b> - Dura&ccedil;&atilde;o <B><? print $tmp["tempo"];?></B> 
					  <?  if ($PodeEditarTempo) { ?>
							[<a href="javascript:EditaDuracao(<?=$tmp["contato_id"]?>)">Editar dura&ccedil;&atilde;o</a>]
 						<? } ?></td>
                    </tr>
                </table></td>
              </tr>
              <tr> 
                <td><br>
                <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" >
                  <tr> 
                     <td>
                     <font size="2">
						<?= $msg; ?><a name="ok"></a>
                     </font>

					 </td>
                    </tr>
                  <tr>
                    <td>&nbsp;</td>
                    </tr>
                  <?
					  $sql = "select * from saduploads where id_contato = "  . $tmp["contato_id"] . " order by nome";
					  $up_result = mysql_query($sql);					  
					  while ($up_linha = mysql_fetch_object($up_result)) {
						  $data_upload =  implode("/", array_reverse( explode("-", $up_linha->data)));
					?>					
                  <tr>
                    <td>
                      <table width="618"  border="0" cellspacing="1" cellpadding="1">
                        <tr valign="top">
                          <td width="3%">

                            <? if  ( ($ok == $tmp["idconsultor"])) { ?>
                                       
                             
                                                        
                            <a href="ok.php?id=<?=$up_linha->id ?>&id_chamado=<?=$id_chamado ?>"><img src="imagens/deletar.gif" alt="Deletar o arquivo" width="12" height="12" border="0"></a>
                            <? } ?>							</td>
                              <td>
                              <?
									list($width, $height) = getimagesize("/dados/ftp/sites/sad/htdocs/public_html/uploads/$up_linha->nome");							  
                              ?>
                              Arquivo:  <?=$up_linha->nome_original ?>  anexado em <?=$data_upload?> 
                                <? 								
								
							  if ( (strpos($up_linha->nome, 'jpg') != 0) or
							       (strpos($up_linha->nome, 'JPG') != 0) or 
							       (strpos($up_linha->nome, 'jpeg') != 0) or 								   
							       (strpos($up_linha->nome, 'png') != 0) or
							       (strpos($up_linha->nome, 'bmp') != 0) or 								   
							       (strpos($up_linha->nome, 'BMP') != 0) or 								   								   
								   (strpos($up_linha->nome, 'PNG') != 0) or
								   (strpos($up_linha->nome, 'gif') != 0) or
								   (strpos($up_linha->nome, 'GIF') != 0)  ) {

								$NewWidth = $width;
								$MaxWidth = 800;
								if ($width > $MaxWidth) 
								{
									$ratio = $width / $height;
									$NewWidth = $MaxWidth;
									$NewHeight = $height * $ratio;
								}
								echo "($width x $height)" ;

									
							    echo "<br><a href=/public_html/uploads/$up_linha->nome target=_blank> <img width=$NewWidth src=\"/public_html/uploads/" . $up_linha->nome  .  "\" border=0></a>";
							  } else {
							    echo "<a href=/public_html/uploads/$up_linha->nome target=_blank> $up_linha->nome</a>";
							  }
							  
							?>
                              							</td>
                          </tr>
                        </table>					  </td>
                    </tr>
	<?
	    }
    ?>					
    
<? if ( (!$NovoContato) && /*($ok == 12) or */($ok == $tmp["idconsultor"]) ) { ?>		
	<? if (!$_ReadyOnlyStatus) { ?>                 			
        <form name="upload" enctype="multipart/form-data" action="getfile.php" method="POST">
            <tr>
                <td>
                    <strong>Anexar arquivo a este contato:&nbsp;</strong>					                            						
                    <input name="userfile" type="file" class="borda_fina" size="50"  >
                    <input type="submit" class="borda_fina" value="Anexar">
                    <input type="hidden" name="contato_id" value="<?=$tmp["contato_id"] ?>">
                    <input type="hidden" name="consultor_id" value="<?=$ok ?>">
                    <input type="hidden" name="chamado_id" value="<?=$id_chamado ?>">
                    <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
                </td>
            </tr>
        </form >															
    <? }?>
<? }?>                  
                  
  <? if ( /*($ok == 12) or */($ok == $tmp["idconsultor"]) ) { ?>					
                  
  <form name="append"  action="append.php" method="POST">
    
    <tr>
      <td>
        
        <? if (!$NovoContato) {?>
			<? if (!$_ReadyOnlyStatus) { ?>                 
                <strong>Adicionar texto a este contato: <br>                
                
                <label>
                <textarea name="texto" cols="80" rows="3" class="botao_fino" id="texto"></textarea>
                </label><br></strong> 
                
                <input type="submit" class="borda_fina" value="Adicionar ao contato">
            <? } ?>            
            <input type="hidden" name="contato_id" value="<?=$tmp["contato_id"] ?>">
            <input type="hidden" name="consultor_id" value="<?=$ok ?>">
            <input type="hidden" name="chamado_id" value="<?=$id_chamado ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="99999999">
            
        <? } ?>
        
        </td>
						  
                    </tr>
  </form >
															  
					     				<? }?>
                  </table>
                <font face="Arial, Helvetica, sans-serif" size="1">&nbsp;                </font></td></tr>
              <tr class="TituloSubitemSad"> 
                <td> 
                
<? 
	$_cont = $Ccontador;// sprintf("%03d", $Ccontador);
	echo "<div class=\"dragTestSimples\" style=\"-webkit-user-drag: element; -webkit-user-select:none;\"  draggable=\"true\" ondragstart=\"setDrag($id_chamado, $_cont);return OnDragStart(event)\">Simples</div>";
	echo "<div class=\"dragTest\" style=\"-webkit-user-drag: element; -webkit-user-select:none;\"  draggable=\"true\" ondragstart=\"setDrag($id_chamado, $_cont);return OnDragStart3(event)\">Completo</div><br>";	
	echo "Chamado [" . $id_chamado . ", " . $_cont . "] - http://192.168.0.14/a/historicochamado.php?id_chamado=" . $id_chamado . "#c_" . $_cont . "<br><br>";
?>				
                
                
                <em>
                    

				  <?
				  print $contador . ". Duração do contato: ";
                  print $tmp["tempo"];
				  $segundos += $tmp["temposec"];
				  ?>
                </em>
				
				

<? if ($EditaChamado) { ?><a href="manut/EditaContato.php?id=<?=md5($ok)?>&id_contato=<?=$tmp["contato_id"]?>">.</a><? } ?>				
</td>
              </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <?}?>
</table>