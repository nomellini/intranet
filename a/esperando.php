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