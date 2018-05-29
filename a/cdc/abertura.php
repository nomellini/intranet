<? 
  require("../a/scripts/conn.php");
  session_start(); 
  if ($v_id_cliente) {
?>
<html>
<head>
<title>SAD :: Abrir chamado</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<SCRIPT>
  function teclado() {
   var ch=String.fromCharCode(window.event.keyCode);
   var re=ch.charCodeAt(0);
   if (re==13) {
     vai(); 
     return false;
   }
  }


  function vai() {
    if (document.form.nome.value=='') {
	  window.alert( 'Por favor, digite o seu nome');
	  document.form.nome.focus();
	  return false;
	}
    if (document.form.sistema.value==0) {
	  window.alert( 'Selecione um sistema');
	  document.form.sistema.focus();
	  return false;
	}  
    if (document.form.descricao.value=='') {
	  window.alert( 'Digite a descrição do problema');
	  document.form.descricao.focus();
	  return false;
	}
  	document.form.submit();	
  }
</SCRIPT>

</head>

<body bgcolor="#FFFFFF" text="#000000">
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
    <td width="406"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000">&nbsp;&nbsp;Voltar 
      ao Site Datamace</font></td>
  </tr>
</table>
<p align="center"><img src="../a/figuras/intro.gif" width="321" height="21"></p>
<div align="center">
<form name="form" method="post" action="doabertura.php" onSubmit="return false;">
    <div align="left">
      <p>Para abrir um chamado, selecione o sistema e digite a descri&ccedil;&atilde;o 
        do problema, em seguida aperte o bot&atilde;o ENVIAR e aguarde a confirma&ccedil;&atilde;o.</p>
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr valign="top"> 
          <td width="17%" align="right"><a href="#nome">Seu nome</a></td>
          <td width="83%"> 
            <input type="text" name="nome" class="unnamed1" onKeyPress="teclado();">
          </td>
        </tr>
        <tr valign="top"> 
          <td width="17%" align="right"><a href="#email">Email</a></td>
          <td width="83%"> 
            <input type="text" name="email" size="50" maxlength="100" class="unnamed1">
            <br>
            <font color="#666666">* Preencha o email corretamente se quiser receber 
            avisos sobre o andamento desse chamado</font></td>
        </tr>
        <tr valign="top"> 
          <td width="17%" align="right"><a href="#produto">Produto</a></td>
          <td width="83%"> <i> 
            <select name="sistema" class="unnamed1" >
              <option value=0>Selecione um sistema</option>
              <?
	$sistema = pegaSistemas(1, $v_id_cliente, 0);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
	  $ve = $tmp["versao"];
	  if ($tmp["32bit"]) { $si="$si 32 bit";} 
	  echo "<option value=$id>$si - $ve</option>";
	}
	$sistema = pegaSistemas(1, $id_cliente, 1);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
	  echo "<option value=$id>$si</option>";	  
	}	
  ?>
            </select>
            </i> </td>
        </tr>
        <tr valign="top"> 
          <td width="17%" align="right"><a href="#desc">Descri&ccedil;&atilde;o</a></td>
          <td width="83%"> 
            <textarea name="descricao" cols="55" rows="5" class="unnamed1"></textarea>
          </td>
        </tr>
        <tr valign="top"> 
          <td width="17%">&nbsp;</td>
          <td width="83%"> 
            <input type="button" name="Button" value="Enviar" onclick="vai();">
          </td>
        </tr>
      </table>
      <p><font color="#0000FF">Aten&ccedil;&atilde;o </font>: Para cada problema, 
        deve ser aberto somente um chamado, mesmo que para o mesmo sistema.</p>
      <hr noshade size="1">
      <p><font color="#FF0000">Help dos campos</font></p>
      <p><a name="nome"></a><font color="#0000FF">Nome</font>: Informe aqui o 
        seu nome. Ele ser&aacute; usado na abertura do chamado.</p>
      <p><a name="email"></a><font color="#0000FF">E-mail</font>: Informando corretamente 
        seu endere&ccedil;o eletr&ocirc;nico, voc&ecirc; ser&aacute; notificado 
        a cada atualiza&ccedil;&atilde;o no chamado atrav&eacute;s de e-mail.</p>
      <p><a name="produto"></a><font color="#0000FF">Produto</font>: Aqui voc&ecirc; 
        deve selecionar o sistema ou servi&ccedil;o da Datamace com o qual esteja 
        tendo alguma d&uacute;vida.</p>
      <p><a name="desc"></a><font color="#0000FF">Descri&ccedil;&atilde;o</font>: 
        Descreva sua d&uacute;vida ou problema. Procure ser espec&iacute;fico 
        de modo que o consultor possa auxilia-lo de forma bem objetiva. Solicitamos 
        que n&atilde;o seja aberto um chamado com mais de um problema, uma vez 
        que o sistema utiliza os conceitos de 'chamado pendente' e 'chamado encerrado'. 
        Dessa forma, abra um chamado para cada problema e quando este for resolvido, 
        o chamado correspondente ser&aacute; encerrado definitivamente.<br>
      </p>
    </div>
  </form>
  <hr size="1" noshade>
  <div align="left">
    <p><font color="#999999" size="1">Datamace Inform&aacute;tica &copy;2001</font></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  </div>
</body>
</html>
<?} else  {
 Header("Location: index.php");
}
?>