<? 


  require("scripts/conn.php");
  session_start(); 
  
if ($v_id_cliente=="") {
header("Location: doindex.php");
}

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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<tr> 
    
  <td valign="top"> 
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr> 
        <td colspan="4" height="67"><img height=70 alt="" src="../a/figuras/topo_sad_e.jpg" 
            width=800 border=0> <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000000"> 
          </font></td>
      </tr>
      <tr> 
        <td width="245" valign="middle" height="19" bgcolor="#999999"> <font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
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

     document.write (diasemana[diaindex] + ', ' + dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
          </font></td>
        <td width="133" valign="middle" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000"><a href="inicio.php">In&iacute;cio</a>&nbsp;</font></td>
        <td width="1" valign="middle" bgcolor="#CCCCCC" align="center"><img src="../imagens/spacer.gif" width="1" height="1"></td>
        <td width="406"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000">&nbsp;&nbsp;<a href="abertura.php">Abrir 
          novo chamado</a></font></td>
      </tr>
    </table>
    <p align="center">
      <? if(!$contatos) {?>
      <br>
      Estamos analisando o chamado 
      <?=$id_chamado?>
      <?} else {?>
    </p>
    <form name="form1" method="post" action="dohistorico.php">
      <table width="700" border="1" cellpadding="1">
        <tr>
          <td>
            <table width="700" border="0" cellspacing="1" cellpadding="0" bgcolor="#CCCCCC">
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right" valign="top"> 
                  <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#0033FF">Chamado...:</font></div>
                </td>
                <td width="87%"><font size="1"> 
                  <?=$id_chamado?>
                  </font></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right" valign="top" height="21"> 
                  <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#0033FF">Aberto 
                    por.:</font></div>
                </td>
                <td width="87%" height="21"> 
                  <?=$linha->nomecliente?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right" valign="top" height="19"> 
                  <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#0033FF">Email........:</font></div>
                </td>
                <td width="87%" height="19"> 
                  <?=$linha->email?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right" valign="top"> 
                  <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#0033FF">Descrição..:</font></div>
                </td>
                <td width="87%"><font size="1"><font color="#0000FF"> 
                  <?=$linha->descricao?>
                  </font></font></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right" valign="top"> 
                  <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#0033FF">Produto.....:</font></div>
                </td>
                <td width="87%"><font size="1"><font color="#0000FF"> 
                  <?=$linha->sistema?>
                  </font></font></td>
              </tr>
              <? if (1) {?>
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right" valign="top">
                  <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" color="#0033FF">Inclu&iacute;r 
                    um coment&aacute;rio </font></div>
                </td>
                <td width="87%"> <font size="1"> 
                  <textarea name="descricao" class="unnamed1" cols="120" rows="7"></textarea>
                  </font></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right"><font size="1"></font></td>
                <td width="87%"> <font size="1"> 
                  <input type="submit" name="Submit" value="Enviar" class="unnamed1">
                  </font></td>
              </tr>
              <? } else { ?>
              <tr bgcolor="#FFFFFF"> 
                <td width="13%" align="right"></td>
                <td width="87%"> Chamado Encerrado </td>
              </tr>
              <?}?>
            </table>
            <br>
            <input type="hidden" name="id_chamado" value="<?=$id_chamado?>">
            <input type="hidden" name="id_cliente" value="<?=$v_id_cliente?>">
          </td>
        </tr>
      </table>
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
      <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000000">
      <?=strtolower($v_cliente)?>
      </font> </p>


</body>
</html>
<?
}
?>