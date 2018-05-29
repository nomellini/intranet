
<?
require("scripts/conn.php");
require("scripts/stats.php");
$data = date("d/m/Y");
$hora = date("H:i:s");
$usu="";
$consultores = pegaConsultores(1);

$busca='';
if ($palavra) {
  $busca = " and pagina like '%$palavra%'";
}

    $sqlLimite = '';
    if (!isset($limite)) {
	  $limite = 50;
	}
	
	if ($limite) {  $sqlLimite = "LIMIT $limite";}

if($id) { $usu= " AND log.id_usuario = $id "; }
?>
<html>
<head>
<title>On Line</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? if($refresh) { ?>
<meta http-equiv="refresh" content="<?=$sec?>">
<? } ?>
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?	
  $sql = "select usuario.nome, log.* from log, usuario where usuario.id_usuario=log.id_usuario $usu $busca order by data desc, hora desc $sqlLimite;";  
  $result = mysql_query($sql) or die ($sql);
?>
<br>
<form name="form" method="post" action="<?=$SRIPT_NAME?>">
  <table width="60%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="12%">Consultor</td>
      <td width="88%"> 
        <select name="id" class="unnamed1">
          <option value="0">Todos</option>
          <?  
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $id==$tmp["id_usuario"] ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
        </select>
      </td>
    </tr>
    <tr> 
      <td colspan="2">Limitar resultado em 
        <input type="text" name="limite" maxlength="4" size="4" value="<?=$limite?>" class="unnamed1">
        registros [<a href="javascript:document.form.limite.value='0';document.form.submit();">mostrar 
        todos</a>] </td>
    </tr>
    <tr> 
      <td width="12%">Busca</td>
      <td width="88%">
        <input type="text" name="palavra" class="unnamed1" value="<?=$palavra?>">
      </td>
    </tr>
    <tr> 
      <td width="12%">&nbsp;</td>
      <td width="88%">&nbsp;</td>
    </tr>
  </table>
  <br>
  <input type="submit" name="Submit" value="Submit" class="unnamed1">
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td><font face="tahoma" size="2"> Data e hora no servidor : <b>
      <?="$data - $hora"?></b>
      </font></td>
    <td align="right"><font face="tahoma" size="2">[<a href="javascript:window.close();">fechar</a>]</font> 
    </td>
  </tr>
</table>
<font face="tahoma" size="2"> </font>
<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
  <tr bgcolor="#666666" align="center" valign="middle"> 
    <td width="31%"><b><font color="#FFFFFF" face="tahoma" size="2">Nome</font></b></td>
    <td width="13%"> <font color="#FFFFFF"><b><font face="tahoma" size="2">IP</font></b></font></td>
    <td width="12%"> <font color="#FFFFFF"><b><font face="tahoma" size="2">Data</font></b></font></td>
    <td width="14%"> <font color="#FFFFFF"><b><font face="tahoma" size="2">Hora</font></b></font></td>
    <td width="30%"><b><font face="tahoma" size="2" color="#FFFFFF">P&aacute;gina</font></b></td>
  </tr>
  <?
  $conta = 0;
  while ($linha=mysql_fetch_object($result)) {  
    $conta++;
	if ( ($conta % 2) ) {
	  $cor = "#F3F3F3";
	} else {
	  $cor = "#ffffff";
	}
  ?>
  <tr bgcolor="<?=$cor?>"> 
    <td height="19" width="31%"><font face="tahoma" size="2"> 
      <?=$conta?>
      . 
      <?=$linha->nome?>
      ( 
      <?=$linha->id_usuario?>
      ) </font></td>
    <td width="13%" align="center" valign="middle" height="19"> <font face="tahoma" size="2"> 
      <?=$linha->ip?>
      </font> </td>
    <td width="12%" align="center" valign="middle" height="19"> <font face="tahoma" size="2"> 
      <?=$linha->data?>
      </font> </td>
    <td width="14%" align="center" valign="middle" height="19"> <b><font face="tahoma" size="2"> 
      <?=$linha->hora?>
      <br>
      </font> </b></td>
    <td width="30%" align="center" valign="middle" height="19"><font face="tahoma" size="2"><b><font face="tahoma" size="2"> 
      <?=$linha->pagina?>
      </font></b> </font></td>
  </tr>
  <?}?>
</table>
<p>&nbsp;</p>
</body>
</html>
