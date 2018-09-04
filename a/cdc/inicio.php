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
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
}
.style3 {
	color: #666666;
	font-weight: bold;
	font-size: 10px;
}
.style4 {font-size: 12px}
.style5 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td valign="top"><img height=79 alt="" src="../figuras/topo_sad_e_900.jpg"
            width=800 border=0></td>
  </tr>
  <tr>
    <td valign="top" bordercolor="#FF0000" height="561">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="31%"><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif" size="1">
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
          <td width="35%">
            <div align="center"><font color="#333333" face="Verdana, Arial, Helvetica, sans-serif" size="1"><strong><font color="#003366" size="3" face="Verdana">
              Canal
              do Cliente
            </font><font color="#003366" size="3" face="Verdana"></font></strong>
              </font></div>          </td>
          <td width="34%">
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#FF0000"><a href="http://www.datamace.com.br/index.cfm?conteudo_ID=4">
              Voltar
              ao Site
            </a></font></div>          </td>
        </tr>
        <tr>
          <td colspan="3"><blockquote>
            <p><font color="#333333" size="1"><strong><font color="#003366" size="3"><font size="2" color="#003399" face="Verdana, Arial, Helvetica, sans-serif">
                      <br>
                      </font></font></strong></font><font color="#333333"><strong><font color="#003366"><font color="#003399" face="Verdana, Arial, Helvetica, sans-serif"><span class="style4">Este canal foi criado para que voc&ecirc;,
                      cliente, manifeste a sua opini&atilde;o com rela&ccedil;&atilde;o &agrave; <i>
                      <font color="#990000">qualidade</font></i> <br>
                      dos servi&ccedil;os
                  prestados pela Datamace. </span></font></font></strong>
                      </font>
                      <span class="style4"><font color="#333333">
                      <strong><font color="#003366"><font color="#003399" face="Verdana, Arial, Helvetica, sans-serif">Para d&uacute;vidas com respeito &agrave;
                  utiliza&ccedil;&atilde;o dos produtos, <br>
                  consultoria, etc., devem ser
                  utlizados os seguintes meios: </font></font></strong>
                      </font> </span></p>
            </blockquote>
            <ul>
              <li class="style4">
                <font color="#333333">
                  <strong>
                  <font color="#003366">
                    <font color="#003399" face="Verdana, Arial, Helvetica, sans-serif">
                      Telefone/Fax: (0xx11) 2714-6400                    </font> </font> </strong> </font> </li>
              <li class="style4">
                <font color="#333333">
                  <strong>
                    <font color="#003366">
                      <font color="#003399" face="Verdana, Arial, Helvetica, sans-serif">
                        E-mail: <a href="mailto:suporte@datamace.com.br">suporte@datamace.com.br</a><br>
                      </font> </font> </strong> </font> </li>
              <li class="style4">
                <font color="#333333">
                  <strong>
                    <font color="#003366">
                      <font color="#003399" face="Verdana, Arial, Helvetica, sans-serif"> Atendimento Online: Solicite maiores informa&ccedil;&otilde;es aos
                        nossos consultores </font> </font> </strong> </font> </li>
              <li class="style4 style5">Aten&ccedil;&atilde;o ! N&atilde;o use esse canal para consultoria. </li>
            </ul>            </td>
        </tr>
      </table>
      <hr size="1" color="#003366">
          <form name="form" method="post" action="doabertura.php" onSubmit="return false;"><div align="left">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC">
            <tr valign="top">
              <td width="8%" align="right">
                <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#003399">Seu
                  nome</font></div>              </td>
              <td width="49%"> <font color="#003399">
                <input name="nome" type="text" class="unnamed1" size="90">
                </font></td>
              <td width="43%" rowspan="5" align="right"><table width="91%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="11%" valign="middle"><img src="../../imagens/Pasta.jpg" alt="pasta aberta" width="42" height="37" align="absmiddle"></td>
                  <td width="89%" valign="middle"><span class="style1"> Pesquisas de Satisfa&ccedil;&atilde;o<br>
                    </span>
                    <font size="2">
                      Resultados
                  </font>                    </td>
                </tr>
                <tr>
                  <td colspan="2" valign="middle"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                      <td width="13%" height="28" align="center" valign="middle"><a href="documentos/Pesquisa001.pdf" target="_blank">
                        <img src="../../imagens/icone.gif" width="21" height="22" border="0" align="absmiddle">
                      </a>                      </td>
                      <td width="87%"><span class="style3">Consultoria &ldquo;Suporte ao Cliente&rdquo;<br>
  Per&iacute;odo: 19/04 &agrave; 20/05/2005</span></td>
                    </tr>
                    <tr>
                      <td height="28" align="center" valign="middle"><a href="documentos/Pesquisa002.pdf" target="_blank">
                        <img src="../../imagens/icone.gif" alt="ok" width="21" height="22" border="0" align="absmiddle">
                      </a>                      </td>
                      <td><span class="style3">Sistemas &ldquo;Foco em Produtos&rdquo;<br>
Per&iacute;odo: 29/09 &agrave; 18/11/2005</span></td>
                    </tr>
                    <tr>
                      <td height="28" align="center" valign="middle"><a href="documentos/Pesquisa003.pdf" target="_blank"><img src="../../imagens/icone.gif" alt="ok" width="21" height="22" border="0" align="absmiddle"></a></td>
                      <td><span class="style3">Treinamento &ldquo;Foco curso para usu&aacute;rios &rdquo;<br>
                        Per&iacute;odo: 23/01 &agrave; 06/03/2006
</span></td>
                    </tr>
                    <tr>
                      <td height="28" align="center" valign="middle"><a href="documentos/Pesquisa004.pdf" target="_blank"><img src="../../imagens/icone.gif" alt="ok" width="21" height="22" border="0" align="absmiddle"></a></td>
                      <td><span class="style3">Marketing e Vendas <br>
Per&iacute;odo: 24/04 &agrave; 31/05/2006</span></td>
                    </tr>
                    <tr>
                      <td height="28" align="center" valign="middle"><a href="documentos/Pesquisa005.pdf"><img src="../../imagens/icone.gif" alt="ok" width="21" height="22" border="0" align="absmiddle"></a></td>
                      <td><span class="style3">Consultoria &ldquo;Suporte ao Cliente&rdquo;<br>
Per&iacute;odo: 18/07 &agrave; 31/08/2005</span></td>
                    </tr>
                    <tr>
                      <td height="28" align="center" valign="middle"><a href="documentos/Pesquisa006.pdf"><img src="../../imagens/icone.gif" alt="Pesquisa" width="21" height="22" border="0" align="absmiddle"></a></td>
                      <td><span class="style3">Sistemas &ldquo;Foco em Produtos &rdquo;<br>
Per&iacute;odo: 01/12/2006 &agrave; 02/02/2007</span></td>
                    </tr>
                    <tr>
                      <td height="28" align="center" valign="middle"><a href="documentos/Pesquisa007.pdf"><img src="../../imagens/icone.gif" alt="Pesquisa" width="21" height="22" border="0" align="absmiddle"></a></td>
                      <td><span class="style3">Treinamento<br>
Per&iacute;odo: 22/05 &agrave; 16/08/2007 </span></td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr valign="top">
              <td width="8%" height="32" align="right">
                <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#003399">Email</font></div>              </td>
              <td width="49%"> <font color="#003399">
                <input type="text" name="email" size="90" maxlength="100" class="unnamed1">
                <br>
                * Preencha o email corretamente se quiser receber avisos sobre
                o andamento do processo</font></td>
            </tr>
            <tr valign="top">
              <td width="8%" align="right">
                <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#003399">Motivo</font></div>              </td>
              <td width="49%"> <font color="#003399"><i>
                <select name="categoria_id" class="unnamed1" id="categoria_id" >
                  <option value="0">Selecione uma das op&ccedil;&otilde;es</option>
                  <option value="379">Reclama&ccedil;&atilde;o</option>
                  <option value="380">Sugest&atilde;o</option>
                  <option value="378">Elogio</option>
                </select>
                </i> </font></td>
            </tr>
            <tr valign="top">
              <td width="8%" align="right">
                <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" color="#003399">Digite
                  aqui sua manifesta&ccedil;&atilde;o</font></div>              </td>
              <td width="49%"> <font color="#003399">
                <textarea name="descricao" cols="90" rows="9" class="unnamed1"></textarea>
                </font></td>
            </tr>
            <tr valign="top">
              <td width="8%">&nbsp;</td>
              <td width="49%">
                <input type="button" name="Button" value="Enviar" onClick="vai();">              </td>
            </tr>
          </table>

      </form>
      <div align="center"><font color="#999999">Datamace Inform&aacute;tica &copy;2003
        - Web Developer : <a href="mailto:fernando@datamace.com.br">Fernando Nomellini</a></font>
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
        <font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#000000">
        <br>
        <?=strtolower($v_cliente)?>
        </font> </div>    </td>
  </tr>
  <tr>
    <td valign="top" bordercolor="#FF0000" height="561">&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?} else  {
 Header("Location: erro.php");
}
?>