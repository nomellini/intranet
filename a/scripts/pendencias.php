
<form name="formSubordinado" method="post" action="">
  <hr noshade size="1">
  <a name="pendencias"></a>Ver pend&ecirc;ncias de 
  <select name="subPendente" class="unnamed1" >
    <option value="0"></option>
    <?
	while ( list($tmp1, $tmp) = each($sub) ) {
	  $id = $tmp["id_usuario"];
	  $si = $tmp["nome"] . " - " . $tmp["total"] ;
	  $m="";
	  if ($subPendente==$id) { $m = "selected" ; }
	  echo "<option value=$id $m>$si</option>";	  
	}	
?>
  </select>
  <input type="button" name="Button" value="Enviar" class='unnamed1' onClick='vai();' >
  <hr noshade size="1">
  <?
  if ($subPendente) {
    $chamadosemaberto = pegaChamadoPendenteUsuario($subPendente, 0);
    $total_pendentes = count($chamadosemaberto);
?>
  Pendencias : 
  <?=$total_pendentes?>
  <br>
  <br>
  <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
    <tr bgcolor="#666666"> 
      <td width="13%" align="center" valign="middle"> <font size="1" color="#FFFFFF">Chamado</font></td>
      <td width="12%" align="center" valign="middle"> <font size="1" color="#FFFFFF">Data</font></td>
      <td width="15%" align="center" valign="middle"> <font size="1" color="#FFFFFF">C&oacute;digo 
        do cliente</font></td>
      <td width="65%"><font size="1" color="#FFFFFF">Cliente + Descri&ccedil;&atilde;o</font></td>
    </tr>
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
			   $cliente = $tmp["cliente"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"] . "<br>" . $tmp["horaa"];
			   $descricao = $tmp["descricao"];
			   $destinatarioId = $tmp["destinatario_id"];
			   $usuarioId = $tmp["usuario_id"];
			   $remetenteId = $tmp["remetente_id"];			   
			   $encaminhado = $tmp["encaminhado"];
			?>
    <tr bgcolor="#FCE9BC" valign="bottom"> 
      <td width="13%" align="center" valign="middle"> 
        <?="$chamado<br>$prioridade"?>
      </td>
      <td width="12%" valign="middle" align="center"> 
        <?=$dataAbertura?>
      </td>
      <td width="15%" valign="middle" align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        <?=$id?>
        </font></td>
      <td width="65%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        <?="<b>$cliente</b><br><b><a href=historicochamado.php?id_cliente=" . rawurlencode($id) . "&id_chamado=$chamado>$descricao</a></b>"?>
        <?  $msg = "";
				    if ($encaminhado) {
				    $msg = "Encaminhado para <b>" . peganomeusuario($destinatarioId) . "</b> por <b>" . peganomeusuario($remetenteId) . "</b><br>";
                    }					
					$msg .= "Chamado aberto por <b>" . peganomeusuario($usuarioId) . "</b>";
					echo "<br><font color=#990000> $msg </font>";
					
				?>
        </font></td>
    </tr>
    <?}?>
  </table>
  <?
		}
		?>
</form>
