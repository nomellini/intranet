
<?
  $data = date("Y-m-d");
  $quando = explode("-", $data);
  $dia = $quando[2];
  $mes = $quando[1];
  $ano = $quando[0];
?>
<html>
<head>
<title>Novo Lembrete</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
Novo Lembrete<br>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr> 
    <td bgcolor="#FFFFFF"><h1> Referente ao Chamado <?=$id_chamado?> </h1><br>
      <form name="form1" method="post" action="donovolembrete.php">
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr> 
            <td width="16%" valign="top">Data</td>
            <td width="84%" valign="top"> 
              <input type="text" name="dia" size="3" maxlength="2" class="unnamed1" value="<?=$dia?>">
              /
              <input type="text" name="mes" size="3" maxlength="2" class="unnamed1" value="<?=$mes?>">
              /
              <input type="text" name="ano" size="5" maxlength="4" class="unnamed1" value="<?=$ano?>">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top">Per&iacute;odo</td>
            <td width="84%" valign="top"> 
              <input type="radio" name="periodo" value="M" checked>
              Manh&atilde; 
              <input type="radio" name="periodo" value="T">
              Tarde </td>
          </tr>
          <tr> 
            <td width="16%" valign="top">Lembrete</td>
            <td width="84%" valign="top"> 
              <textarea name="lembrete" cols="50" rows="6" class="unnamed1"></textarea>
            </td>
          </tr>
          <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%"> 
              <input type="submit" name="Submit" value="Incluir Lembrete" class="unnamed1">
              <input type="hidden" name="id_chamado" value="<?=$id_chamado?>">
              <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
              <input type="hidden" name="inicio" value="<?=$inicio?>">
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>
