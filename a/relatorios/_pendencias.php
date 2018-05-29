<?
	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
    $pode = pegaGerencial($ok);   
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {
	
      if( !isset($f_id_usuario) ) {
	    $f_id_usuario = $ok;
	  }	
?> 
<html>
<head>
<title>relat&oacute;rio de pendencias</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p align="center"><img src="../figuras/intro.gif" width="321" height="21"> </p>
<p align="center"><font size="3">Relat&oacute;rio de pend&ecirc;ncias<br>
  <font size="1">restrito a gerencia</font></font></p>
<form name="form" method="get" action="<?=$SCRIPT_NAME?>">
  <table width="90%" border="0" cellspacing="1" cellpadding="1" >
    <tr> 
      <td>Selecione o usuario 
        <select name="f_id_usuario" class="unnamed1">
          <?
		  $sql = "select id_usuario, nome from usuario where atendimento order by nome;";
		  $result = mysql_query($sql) or die ("Erro no SQL <br> $sql");
		  while ( $linha = mysql_fetch_object($result)) {
            $se = "";
		    if ($linha->id_usuario == $f_id_usuario) { $se = "selected"; $nome=$linha->nome; }
		    echo "<option value=" . $linha->id_usuario ." $se>" . $linha->nome . "</option>\n";
		  }
		  ?>
        </select>
      </td>
    </tr>
    <tr> 
      <td> 
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
  </table>
  <br>
</form>

<br><span id=bloqueados></span>
<br><?
  $sql = "select cliente_id, id_chamado, descricao, dataa, dono.nome as dono, destinatario.nome as destinatario from chamado, usuario dono, usuario destinatario where (destinatario.id_usuario=destinatario_id) and (dono.id_usuario=consultor_id) and  (status > 1 and status < 4) " ;
  $sql .= "and destinatario_id = $f_id_usuario and descricao is not null;";

  if ($sql) {
    $result = mysql_query($sql);
	$total = mysql_affected_rows();
	echo "Chamados que estão com $nome :  $total ";
?>
<table width="99%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000066">
  <tr bgcolor="#0000FF"> 
    <td width="60" valign="middle" align="center"><b><font color="#FFFFFF">Chamado</font></b></td>
    <td width="100" valign="middle" align="center"><b><font color="#FFFFFF">Data</font></b></td>
    <td width="81"><b><font color="#FFFFFF">Dono</font></b></td>
    <td width="104"><b><font color="#FFFFFF">Destinatario</font></b></td>
    <td width="632"><b><font color="#FFFFFF">Descricao</font></b></td>
  </tr>
  <?
 	while ( $linha = mysql_fetch_object($result) ) {
			$descricao = $linha->descricao;
			$descricao = eregi_replace("\r\n", "<br>",$descricao);
            $descricao = eregi_replace("\"", "`", $descricao);
			list($tmp1, $cli) = each(pegaClientePorCodigoUnico( $linha->cliente_id));  
			$cliNome = $cli["cliente"];
			$cliBloq = $cli["bloqueio"];
			if ($cliBloq) $contaBloq++;
	
?>
  <tr bgcolor="#99CCFF"> 
    <td width="60" valign="middle" align="center"> <a href="../historicochamado.php?id_chamado=<?=$linha->id_chamado?>"> 
      <?=$linha->id_chamado?>
      </a></td>
    <td width="100" valign="middle" align="center"> 
      <?    
        $today=date("Y-m-d 00:00"); 
        $date1=strtotime( ultimoDataChamado($linha->id_chamado) );
        $date2=strtotime($today);
        echo "$linha->dataa<br>". ceil ( (($date2-$date1)/86400) ). " dias";  
	  ?>
    </td>
    <td width="81"> 
      <?=$linha->dono?>
    </td>
    <td width="104"> 
      <?=$linha->destinatario?>
    </td>
    <td width="632"> 
	  <b><?=$cliNome?> (<?=$linha->cliente_id?>)</b><br><?=$cliBloq ? "<h1><font color=#ff0000>BLOQUEADO</font></h1>":""?><br>
      <?=$descricao?>
      <hr color=#ff0000 height=1><font color=#333333><?=ultimoHistoricoChamado($linha->id_chamado)?></font><br>&nbsp;
    </td>
  </tr>
  <?}?>
</table>
<?
}
?>
<br>
<br>
<br>
<br>
<?
  $sql = "select cliente_id, id_chamado, descricao, dataa, dono.nome as dono, destinatario.nome as destinatario from chamado, usuario dono, usuario destinatario where (destinatario.id_usuario=destinatario_id) and (dono.id_usuario=consultor_id) and status > 1 " ;
  $sql .= "and consultor_id = $f_id_usuario and descricao is not null and destinatario_id<>consultor_id;"  ;
  if ($sql) {
    $result = mysql_query($sql);
	$total = mysql_affected_rows();
	echo "Chamados que foram abertos por $nome e estão encaminhados :  $total ";
?>
<table width="99%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000066">
  <tr bgcolor="#0000FF"> 
    <td width="60" valign="middle" align="center"><b><font color="#FFFFFF">Chamado</font></b></td>
    <td width="100" valign="middle" align="center"><b><font color="#FFFFFF">Data</font></b></td>
    <td width="81"><b><font color="#FFFFFF">Dono</font></b></td>
    <td width="104"><b><font color="#FFFFFF">Destinatario</font></b></td>
    <td width="632"><b><font color="#FFFFFF">Descricao</font></b></td>
  </tr>
  <?
 	while ( $linha = mysql_fetch_object($result) ) {
			$descricao = $linha->descricao;
			$descricao = eregi_replace("\r\n", "<br>",$descricao);
            $descricao = eregi_replace("\"", "`", $descricao);	
			list($tmp1, $cli) = each(pegaClientePorCodigoUnico( $linha->cliente_id));  
			$cliNome = $cli["cliente"];
			$cliBloq = $cli["bloqueio"];
			if ($cliBloq) $contaBloq++;
	
?>
  <tr bgcolor="#F0F0FF"> 
    <td width="60" valign="middle" align="center"> <a href="../historicochamado.php?id_chamado=<?=$linha->id_chamado?>">
      <?=$linha->id_chamado?>
      </a> </td>
    <td width="100" valign="middle" align="center"> 
      <?=$linha->dataa?>
    </td>
    <td width="81"> 
      <?=$linha->dono?>
    </td>
    <td width="104"> 
      <?=$linha->destinatario?>
    </td>
    <td width="632">
	  <b><?=$cliNome?> (<?=$linha->cliente_id?>)</b><br><?=$cliBloq ? "<h1><font color=#ff0000>BLOQUEADO</font></h1>":""?><br>
      <?=$descricao?>
    </td>
  </tr>
  <?}?>
</table>
<?
}
?>
<script>
  if ( '-' != '<?=$contaBloq?>-') {
    bloqueados.innerHTML = "Total de clientes bloqueados : <?=$contaBloq?>";
  }
</script>
</body>
</html>
<?
}
?>
