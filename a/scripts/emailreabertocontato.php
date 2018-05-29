<?
  list($tmp1, $tmp) = each( pegaClientePorCodigo($objChamado->cliente_id) );
  $Cliente = $tmp["cliente"];
  
  list($tmp1, $tmp) = each( pegaUsuario($id_usuario) );
  $emailUsuario = $tmp["email"];
  $novoDono = $tmp["nome"];
  $emailsn = $tmp["emailsn"];
  
  list($tmp1, $tmp) = each( pegaUsuario($objChamado->consultor_id) );
  $antigoDono = $tmp["nome"];   
  $emailAntigoDono = $tmp["email"]; 
  
  $sistema = pegaSistema( $objChamado->sistema_id );



$msg = "
<style type=\"text/css\">
<!--
.style1 {color: #990033}
.ListaContatos {
	overflow: auto;
	height: 300px;
}
-->
</style>
<table width=\"80%\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#0000FF\">
  <tr bgcolor=\"#FFFFFF\">
    <td align=\"center\" valign=\"middle\"><h3 align=\"center\"><br />
      Sistema de Atendimento Datamace - <span class=\"style1\">Reabertura de chamado</span></h3>
      <table width=\"99%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
        <tr>
          <td colspan=\"2\">O Chamado <a href=\"http://192.168.0.14/a/historicochamado.php?id_chamado=$objChamado->id_chamado\">$objChamado->id_chamado</a> foi reaberto por <strong>$novoDono</strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width=\"91\">Chamado</td>
          <td width=\"426\"><strong>$objChamado->id_chamado</strong></td>
        </tr>
        <tr>
          <td>Aberto Em </td>
          <td><strong>$objChamado->dataaf - $objChamado->horaa</strong></td>
        </tr>
        <tr>
          <td>Cliente</td>
          <td><strong>$Cliente ($objChamado->cliente_id)</strong></td>
        </tr>
        <tr>
          <td>Sistema</td>
          <td><strong>$sistema</strong></td>
        </tr>
        <tr>
          <td colspan=\"2\"><hr color=\"#990033\" size=\"1\" /></td>
        </tr>
        <tr>
          <td colspan=\"2\">&nbsp;</td>
        </tr>
        <tr>
          <td colspan=\"2\"><strong>Descri&ccedil;&atilde;o do Chamado </strong></td>
        </tr>
        <tr>
          <td colspan=\"2\">$objChamado->descricao</td>
        </tr>
        <tr>
          <td colspan=\"2\">&nbsp;</td>
        </tr>
        <tr>
          <td colspan=\"2\"><strong>Contatos</strong></td>
        </tr>
        <tr>
          <td colspan=\"2\">
	<fieldset>	
	<Legend>Contatos</Legend>
	<div class=\"ListaContatos\">";
		$c = 0;
		$query_rsContatos = "SELECT id_contato, historico, dataa, horaa FROM contato WHERE chamado_id = $objChamado->id_chamado order by dataa desc, horaa desc";
		$rsContatos = mysql_query($query_rsContatos) or die(mysql_error());
		$row_rsContatos = mysql_fetch_assoc($rsContatos);
		$totalRows_rsContatos = mysql_num_rows($rsContatos);		
		do {
			$dataa = explode("-", $row_rsContatos['dataa']);
			$data = "<b>$dataa[2]/$dataa[1]/$dataa[0] " . $row_rsContatos['horaa'] . "</b> ";			
			$msg .= "$data <br>";			
			if ($c==0) {
				$msg .= nl2br($historico);
				$c=1;			
			} else {
				$msg .= nl2br( $row_rsContatos['historico']);
			}
            $msg .= "<hr color=\"#FF0000\" size=\"1\">";
	
         } while ($row_rsContatos = mysql_fetch_assoc($rsContatos));
		 
		
		$msg .= "
		</p>
	</div>
	</fieldSet></td>
        </tr>
        <tr>
          <td colspan=\"2\">&nbsp;</td>
        </tr>
        <tr>
          <td colspan=\"2\" align=\"right\" valign=\"top\">Grupo Datamace - 2010 </td>
        </tr>
      </table></td>
  </tr>
</table>

";

  $ReplyTo = "$emailUsuario:$novoDono [Via SAD]";  


  $recipient = "$emailAntigoDono"; 
  $subject = "S.A.D. - Reabertura de Chamado";

  $headers = "$Usuario [Via SAD]". "+" . $ReplyTo;

  
  mail2($recipient, $subject, $msg, $headers);
?>