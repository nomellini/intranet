<?
	require("scripts/conn.php");
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);
		setcookie("loginok");
	} else {
		header("Location: index.php");
	}

	if (isset($chamado_id) & isset($cliente_id))
	{
		$sql = "update chamado set cliente_id = '$cliente_id' where id_chamado = $chamado_id";
		mysql_query($sql) or die (mysql_error() . " - "  . $sql);
	}


	$chamados = pegaChamadosAbertosPorCliente();
    loga_online($ok, $REMOTE_ADDR, 'Lista de Ch. Clientes');


?>
<html>
<head>
<title>Chamados abertos por cliente</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center">
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="inicio.php"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton">&nbsp;</td>
  </tr>
</table>
<hr size="1" noshade>
Usu&aacute;rio :
<?=$nomeusuario?>
<p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Chamados de clientes
  que ainda n&atilde;o foram encaminhados:</font></p>
<table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
  <tr bgcolor="#000099">
    <td width="9%" align="center"><i><b><font color="#FFFFFF">Chamado</font></b></i></td>
    <td width="11%" align="center"><i><b><font color="#FFFFFF">Data</font></b></i></td>
    <td width="11%" align="center"><i><b><font color="#FFFFFF">Cliente</font></b></i></td>
    <td width="17%" align="center"><i><b><font color="#FFFFFF">Produto</font></b></i></td>
    <td width="63%"><i><b><font color="#FFFFFF">Descri&ccedil;&atilde;o</font></b></i></td>
  </tr>
  <?
  while( list($tmp1, $tmp) = each($chamados) ) {

?>
  <tr bgcolor="#FFE8C6">
    <td width="9%" valign="middle" align="center">
      <? echo "<a href=chamadoabertoporcliente.php?id_chamado=" . $tmp["id_chamado"] . "&id_cliente=" . rawurlencode($tmp["id_cliente"]) . ">" . $tmp["id_chamado"] . "</a>" ?>
    </td>
    <td width="11%" align="center"><?=$tmp["dataa"]?><br><?=$tmp["hora"]?></td>
    <td width="11%">
      <?=$tmp["id_cliente"]?>
    </td>
    <td width="17%">
      <?=$tmp["sistema"]?>
    </td>
    <td width="63%">
      <?=nl2br($tmp["descricao"])?> <br><br> <b><?=$tmp["email"]?></b>
      <?
	  	if (true)
		{
		?>
<form name="form1" method="post">
  <input name="chamado_id" type="hidden" id="chamado_id" value="<?=$tmp["id_chamado"]?>">
  <label for="cliente_id">Digite a sigla do novo cliente e tecle enter: </label>
  <input id="cliente_id" name="cliente_id" type="text" class="borda_fina" id="cliente_id" value="<?=$tmp["id_cliente"]?>">
</form>
        <?

		}
      ?>
    </td>
  </tr>
  <?}?>
</table>
</body>
</html>
