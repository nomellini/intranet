<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?
  mysql_connect(localhost, sad, data1371);
  mysql_select_db(sad);
  if ( $ordem=='' ) {
    $ordem = 'semver desc';
  }
?>
<html>
<head>
<title>Dedo Duro</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../stilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>Dias1 = Quantidade de dias do &uacute;timo contato at&eacute; hoje<br>
  Dias2 = Quantidade de dias da abertura at&eacute; hoje<br>
</p>
<table width="82%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#CCCCCC"> 
    <td width="10%"><font size="1" face="verdana"><a href="abertos.php?ordem=id_chamado">Chamado</a>s</font></td>
    <td width="19%"><font size="1" face="verdana"><a href="abertos.php?ordem=usuario.nome">Dono</a></font></td>
    <td width="18%"><font size="1" face="verdana"><a href="abertos.php?ordem=usuario2.nome">Destinatario</a></font></td>
    <td width="16%" align="center"><font size="1" face="verdana">Abertura</font></td>
    <td width="16%" align="center"><font size="1" face="verdana">&Uacute;ltimo 
      Contato</font></td>
    <td width="11%" align="right"><font size="1" face="verdana"><a href="abertos.php?ordem=semver%20desc">Dias1</a></font></td>
    <td width="10%" align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="abertos.php?ordem=aberto%20desc">Dias 
      2</a></font></td>
  </tr>
  <?  
  $sql = "SELECT id_chamado, usuario.nome as dono, usuario2.nome as destinatario, ";
  $sql .= "dataa, datauc, TO_DAYS(datauc)-TO_DAYS(dataa) as dias, ";
  $sql .= "TO_DAYS(NOW())-TO_DAYS(dataa) as aberto,  TO_DAYS(NOW())-TO_DAYS(datauc) as semver ";
  $sql .= "FROM chamado, usuario, usuario as usuario2 ";
  $sql .= "WHERE (status=2 or status=3)  and ";
  $sql .= "      datauc is not null and ";
  $sql .= "      usuario.atendimento and ";
  $sql .= "      usuario.id_usuario = chamado.consultor_id and ";
  $sql .= "      usuario2.id_usuario = chamado.destinatario_id and ";
//  $sql .= "      chamado.consultor_id = chamado.destinatario_id and ";
  $sql .= "      usuario.atendimento ";
  $sql .= "ORDER BY ";
  $sql .= "      $ordem "; 
//  $sql .= "LIMIT 200;";
  $result = mysql_query($sql) or die ($sql);
  while ($linha=mysql_fetch_object($result)) {  
    $id_chamado = $linha->id_chamado;
    $usua  = $linha->dono;
    $dest  = $linha->destinatario;
    $quando = explode("-", $linha->dataa);
	$dataa = "$quando[2]/$quando[1]/$quando[0]";				
    $quando = explode("-", $linha->datauc);
	$datauc = "$quando[2]/$quando[1]/$quando[0]";					
	
	$dias   = $linha->dias;
	$aberto = $linha->aberto;
	$semver = $linha->semver;
    $link = "http://192.168.0.5/a/historicochamado.php?&id_chamado=$id_chamado"
?>
  <tr bgcolor="#FFFFFF"> 
    <td><font size="1" face="verdana"> <?=++$cont?>. <a href="<?=$link?>"> 
      <?=$id_chamado?>
      </a> </font></td>
    <td><font size="1" face="verdana"> 
      <?=$usua?>
      </font></td>
    <td><font size="1" face="verdana"> 
      <?=$dest?>
      </font></td>
    <td align="center"><font size="1" face="verdana"> 
      <?=$dataa?>
      </font></td>
    <td align="center"><font size="1" face="verdana"> 
      <?=$datauc?>
      </font></td>
    <td align="right"><font size="1" face="verdana"> 
      <?=$semver?>
      <br>
      </font></td>
    <td align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <?=$aberto?>
      </font></td>
  </tr>
  <?		
  }
?>
</table>
</body>
</html>
