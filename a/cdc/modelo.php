<? 
  session_start(); 
  if ($v_id_cliente) {
?>
<html>
<head>
<title>t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr> 
    <td width="50%"><img src="../imagens/logotipo%20datamace.gif" width="155" height="41"></td>
    <td width="50%" valign="bottom" align="right"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
      <script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;
    
      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Terça-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "Sábado";
      diasemana[7] = "Domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td>&nbsp;</td>
    <td align="right"><b><font size="1" color="#333333"> 
      <?=strtolower($v_cliente)?>
      </font></b></td>
  </tr>
</table>
<div align="center">
  <p><img src="../a/figuras/intro.gif" width="321" height="21"></p>
  <p align="left">&nbsp;</p>
  <hr size="1" noshade>
  <div align="left"><font color="#999999" size="1">Datamace Inform&aacute;tica 
    &copy;2001</font></div>
  </div>
</body>
</html>
<?} else  {
 Header("Location: index.php");
}
?>