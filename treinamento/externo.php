<?
$ExternoPermitido = "S";
require_once('cabeca.inc.php');
echo $conf_crc;
$db = new DB();
$prova = new treinamento($adm);
$vCrc = $prova->checkCRC(3, $conf_crc);
if (!$vCrc)
{
	include_once("externoDtm.php");
	die();
}

?>
<html>
<head>
<title>Datamace Inform&aacute;tica Ltda.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<link rel="stylesheet" href="../scripts/jquery.autocomplete.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" src="../scripts/jquery.autocomplete.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jQueryCookie.js"></script>
<style type="text/css">
<!--
.style51 {
	font-size: 16px;
	color: #000099;
	font-weight: bold;
}
a, html, body, td, th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
a:hover, a:link, a:active, a:visited {
	color: #0000CC;
	text-decoration: none;
}
html, body, .logo {
	height: 100%;
	width: 100%;
}
thead, tfoot {
	height: 10%;
}
.tbody, tbody {
	height: 80%;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <thead>
    <tr>
      <td colspan="3" width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
  </thead>
  <tbody>
    <tr class="tbody">
      <th colspan="3"><span class="style51">Portal do Treinando (Externo)</span></th>
    </tr>
    <tr>
      <th colspan="3">&nbsp;</th>
    </tr>
    <tr>
      <th colspan="3">&nbsp;</th>
    </tr>
    <tr>
      <td colspan="3" id="menuPrincipal" style="visibility:hidden"><div align="left">Menu Principal
          <table cellspacing="0" cellpadding="0" width="220" border="0">
            <tbody>
              <tr>
                <td bgcolor="#ff0000"><img height="1" alt="." src="themes/Imagic2/imatges/comuns/espai.gif" width="1" border="0" /></td>
              </tr>
            </tbody>
          </table>
        </div></td>
    </tr>
    <tr id="menuPrincipal2" align="left" style="visibility:hidden">
      <td colspan="3" ><br>
        <ul>
          <li><a href="cadtre.php?flagTipo=3&tipo=3&tipotre=1&linkPagina=externo.php">Cadastro do Treinando</a></li>
          <li><a href="avatre.php?flagTipo=3&tipo=3&linkPagina=externo.php">Avalia&ccedil;&atilde;o do Treinamento</a></li>
          <li><a href="oriava.php?flagTipo=3&tipo=3&linkPagina=externo.php">Avalia&ccedil;&atilde;o de Aprendizagem </a></li>
          <li><a href="javascript:window.close()" >Sair</a></li>
        </ul></td>
    </tr>
    <tr id="menuSenha" align="left">
      <td colspan="3">Entre com a senha para desbloquear o menu :</td>
    </tr>
    <tr id="menuSenha2">
      <td colspan="3"><input type="text" name="conf_crc" id="conf_crc" maxlength="10" size="10" value="<?=$conf_crc ?>" />
        <input name="BTNDesbloquear" id="BTNDesbloquear" type="button" value="Desbloquear" /></td>
    </tr>
    <tr>
      <th colspan="3">&nbsp;</th>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <th width="17%"><img src="imagens/novologo.jpg" width="155" height="41" alt="teste" /></th>
      <th>&nbsp;</th>
      <th width="17%" align="right" valign="baseline"><?=$ipremoto ?></th>
    </tr>
  </tfoot>
</table>
<script language="JavaScript" type="text/javascript" src="scripts/externo.js"></script>
</body>
</html>