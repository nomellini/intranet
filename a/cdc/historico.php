<?
  require("scripts/conn.php");
  session_start();
  if ($v_id_cliente) {
    $historico = historicoChamado($id_chamado, $v_id_cliente);
	$contatos = count($historico);
    $sql = "SELECT status, nomecliente, descricao, email, dataa, sistema from chamado, sistema where sistema.id_sistema=chamado.sistema_id and id_chamado = $id_chamado";
	$result = mysql_query($sql) or Die($sql);
	$linha = mysql_fetch_object($result);
?>
<html>
<head>
<title>Historico do Chamado</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<tr>

  <td valign="top">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3" height="67"><img height=67 alt="" src="Datamace_arquivos/logo_home2.gif"
            width=246 border=0></td>
        <td height="67" align="right" valign="bottom"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000000">
          <?=strtolower($v_cliente)?>
          </font></td>
      </tr>
      <tr>
        <td width="245" valign="middle" height="19" bgcolor="#999999"> <font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="1">
          <script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;

      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Ter�a-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "S�bado";
      diasemana[7] = "Domingo";

      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Mar�o";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();

     document.write (diasemana[diaindex] + ', ' + dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
          </font></td>
        <td width="133" valign="middle" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000"><a href="inicio.php">In&iacute;cio</a>&nbsp;</font></td>
        <td width="1" valign="middle" bgcolor="#CCCCCC" align="center"><img src="../imagens/spacer.gif" width="1" height="1"></td>
        <td width="406"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000">&nbsp;&nbsp;<a href="abertura.php">Abrir
          novo chamado</a></font></td>
      </tr>
    </table>
    <p align="center"><img src="../a/figuras/intro.gif" width="321" height="21"><br>
      <? if(!$contatos) {?>
      <br>
      Estamos analisando o chamado
      <?=$id_chamado?>
      <?} else {?>
    </p>
    <form name="form1" method="post" action="dohistorico.php">
      <table width="643" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
        <tr bgcolor="#FFFFFF">
          <td width="15%" align="right" valign="top"><font size="1">Chamado</font></td>
          <td width="85%"><font size="1">
            <?=$id_chamado?>
            </font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="15%" align="right" valign="top">Aberto por</td>
          <td width="85%"><?=$linha->nomecliente?></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="15%" align="right" valign="top"><font size="1">Descri��o</font></td>
          <td width="85%"><font size="1"><font color="#0000FF">
            <?=$linha->descricao?>
            </font></font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="15%" align="right" valign="top"><font size="1">Produto</font></td>
          <td width="85%"><font size="1"><font color="#0000FF">
            <?=$linha->sistema?>
            </font></font></td>
        </tr>
		<? if ($linha->status != 1) {?>
        <tr bgcolor="#FFFFFF">
          <td width="15%" align="right" valign="top"><font size="1">Inclu&iacute;r
            um coment&aacute;rio </font></td>
          <td width="85%"> <font size="1">
            <textarea name="descricao" class="unnamed1" cols="50" rows="2"></textarea>
            </font></td>
        </tr>

        <tr bgcolor="#FFFFFF">
          <td width="15%" align="right"><font size="1"></font></td>
          <td width="85%"> <font size="1">
            <input type="submit" name="Submit" value="Enviar" class="unnamed1">
            </font></td>
        </tr>
		<? } else { ?>
        <tr bgcolor="#FFFFFF">
          <td width="15%" align="right"></td>
          <td width="85%"> Chamado Encerrado
            </td>
        </tr>
      <?}?>
      </table>
      <br>
      <input type="hidden" name="id_chamado" value="<?=$id_chamado?>">
      <input type="hidden" name="id_cliente" value="<?=$v_id_cliente?>">
    </form>
    <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#7575FF">
      <tr bgcolor="#7575FF">
        <td width="5%"><b><font color="#FFFFFF">Data</font></b></td>
        <td width="7%"><b><font color="#FFFFFF">Hora</font></b></td>
        <td width="23%"><b><font color="#FFFFFF">Consultor</font></b></td>
        <td width="65%"><b><font color="#FFFFFF">Hist&oacute;rico</font></b></td>
      </tr>
      <?
	   while ( list($tmp1, $tmp) = each($historico) ) {
	 ?>
      <tr bgcolor="#ECECFF">
        <td width="5%">
          <?=$tmp["dataa"]?>
        </td>
        <td width="7%">
          <?=$tmp["horaa"]?>
        </td>
        <td width="23%">
          <?=peganomeusuario($tmp["consultor"]);?>
        </td>
        <td width="65%">
          <?=$tmp["historico"]?>
        </td>
      </tr>
      <?}?>
    </table>
    <p align="left">
      <?}?>
    </p>


</body>
</html>
<?
}
?>