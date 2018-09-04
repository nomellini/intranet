<?
  require("scripts/conn.php");
  session_start();
  if ($v_id_cliente) {
  $fileAbertura=fopen('abertura.txt', "r");
  $textAbertura = fread( $fileAbertura, 10000);
?>
<html>
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" height="67"><img height=67 alt="" src="Datamace_arquivos/logo_home2.gif"
            width=246 border=0></td>
          <td height="67" align="right" valign="bottom"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000000">
            <?=strtolower($v_cliente)?>
            </font></td>
        </tr>
        <tr>
          <td width="245" valign="middle" height="19"> <font color="#333333" face="Verdana, Arial, Helvetica, sans-serif" size="1">
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
          <td width="133" valign="middle" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000">&nbsp;</font></td>
          <td width="1" valign="middle" bgcolor="#CCCCCC" align="center"><img src="../imagens/spacer.gif" width="1" height="1"></td>
          <td width="406" align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000">&nbsp;&nbsp;Voltar
            ao Site Datamace</font></td>
        </tr>
      </table>
      <p align="center"> <strong><font color="#003366" size="3" face="Verdana">Canal
        do Cliente</font></strong></p>
      <form name="form" method="post" action="doabertura.php" onSubmit="return false;">
        <div align="left">
          <p>
            <?=$textAbertura?>
          </p>
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr valign="top">
              <td width="17%" align="right">Seu nome</td>
              <td width="83%"> <input name="nome" type="text" class="unnamed1" size="50">
              </td>
            </tr>
            <tr valign="top">
              <td width="17%" height="32" align="right">Email</td>
              <td width="83%"> <input type="text" name="email" size="50" maxlength="100" class="unnamed1">
                <br> <font color="#666666">* Preencha o email corretamente se
                quiser receber avisos sobre o andamento desse chamado</font></td>
            </tr>
            <tr valign="top">
              <td width="17%" align="right">Motivo</td>
              <td width="83%"> <i>
                <select name="categoria_id" class="unnamed1" id="categoria_id" >
                  <option value="0">Selecione uma das op&ccedil;&otilde;es</option>
                  <option value="379">Reclama&ccedil;&atilde;o</option>
                  <option value="380">Sugest&atilde;o</option>
                  <option value="378">Elogio</option>
                </select>
                </i> </td>
            </tr>
            <tr valign="top">
              <td width="17%" align="right">Digite aqui sua manifesta&ccedil;&atilde;o</td>
              <td width="83%"> <textarea name="descricao" cols="70" rows="9" class="unnamed1"></textarea>
              </td>
            </tr>
            <tr valign="top">
              <td width="17%">&nbsp;</td>
              <td width="83%"> <input type="button" name="Button" value="Enviar" onClick="vai();">
              </td>
            </tr>
          </table>
        </div>
      </form>
      <hr size="1" noshade align="center"> <div align="center"><font color="#999999">Datamace
        Inform&aacute;tica &copy;2003 - Web Developer : <a href="mailto:fernando@datamace.com.br">Fernando
        Nomellini</a></font> </div></td>
  </tr>
</table>
<script>
  function vai() {
    if (document.form.categoria_id.value == 0) {
	  window.alert("Digite uma categoria");
	  document.form.categoria_id.focus();
	  return;
	}
    if (document.form.descricao.value == "") {
	  window.alert("N�o deixe de escrever a sua manifesta��o");
	  document.form.descricao.focus();
	  return;
	}
	document.form.submit();
  }
</script>
</body>
</html>
<?} else  {
 Header("Location: erro.php");
}
?>