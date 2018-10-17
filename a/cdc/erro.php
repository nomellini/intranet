
<?
  if ($erro==1) {
    $msg = "Você não está autorizado a usar o sistema da atendimento";
  }
  if ($erro==2 or !$erro) {
    $msg = "Senha Incorreta, ou usuário não cadastrado";
  }
  if ($erro==3) {
    $msg = "Todos os campos devem ser preenchidos";
  }
  if ($erro==4) {
    $msg = "Você não está autorizado a usar o sistema da atendimento (BLQ)";
  }

?>
<html>
<head>
<title>SAD :: Mensagem de Erro</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="50%"><img src="../../imagens/logotipo%20datamace.gif" width="155" height="41"></td>
    <td width="50%" valign="bottom" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
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

     document.write (diasemana[diaindex] + '<br>' + dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
      </font></td>
  </tr>
</table>
<hr size="1" noshade>
<div align="center">
  <p>Canal do Cliente</p>
  <p align="left"><font color="#FF0000"><b>Mensagem de Erro:</b></font></p>
  <p align="left">
    <?=$msg?>
  </p>
  <hr size="1" noshade>
  <div align="left">[<a href="javascript:history.go(-1);">Tentar novamente</a>]
  </div>
</div>
</body>
</html>

