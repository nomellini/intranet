<?

  require("cabeca.php");

  if ($ok) {
    $nomeusuario=peganomeusuario($ok);
   }
?>
<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<title>Intranet Datamace</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<style type="text/css">
<!--
.style2 {color: #000099}
-->
</style>
<style type="text/css">
<!--
.style3 {font-size: 12pt}
-->
</style>
<style type="text/css">
<!--
.style6 {font-size: 12}
-->
</style>
<style type="text/css">
<!--
.style7 {font-size: 12px}
-->
</style>
<style type="text/css">
<!--
.style9 {color: #FFFFFF}
.style9 {color: #FFFFFF}
-->
</style>
<style type="text/css">
<!--
.style10 {color: #FFFFFF}
.style10 {color: #FFFFFF}
-->
</style>
<style type="text/css">
<!--
.style12 {color: #FFFFFF}
.style12 {color: #FFFFFF}
-->
</style>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style13 {color: #FFFFFF}
-->
</style>
<style type="text/css">
<!--
.style14 {color: #FFFFFF}
.style14 {color: #FFFFFF}
-->
</style>
<style type="text/css">
<!--
.style15 {font-size: 9px}
-->
</style>
<style type="text/css">
<!--
.style16 {font-size: 9}
-->
</style>
<style type="text/css">
<!--
.style17 {font-size: 9pt}
-->
</style>
<style type="text/css">
<!--
.style19 {font-size: 12pt}
.style19 {color: #000099}
-->
</style>
<!-- #EndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 18px; font-weight: normal; font-family: Verdana, Arial, Helvetica, sans-serif;color: #FFFFFF;}
.style3 {color: #000099}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
  <table width="100%" border="0">
    <tr>
      <td>
        <table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC38" class="bgTabela" bordercolor="#FF0000">
          <tr align="center" valign="middle">
            <td width="17%"> <div align="center" class="style1">
              <div align="left"><a href="http://www.datamace.com.br"><img src="imagens/novologo.jpg" width="155" height="41" border="0">
                </a></div>
            </div></td>
            <td width="60%" valign="middle"> <p class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" class="style2">Intranet
            DATAMACE</font></p></td>
            <td width="23%" valign="bottom" align="right"><span class="style1"><font size="1"> <font class="unnamed1">
              <script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;
      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Ter�a-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "S�bado";
      diasemana[0] = "Domingo";

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
              </font> </font></span></td>
          </tr>
        </table>
        <table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><!-- #BeginEditable "Centro" -->
              <?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 $resp = mysql_query("select count(*) as soma from cxsug;");
 $linha = mysql_fetch_object($resp);
 $sugestoes = $linha->soma;
?>
              <table width="100%" border="0">
                <tr>
                  <td> <a href="corporativo/faq.htm"></a> <p align="center"><font color="#FF0033"><br>
                    Ol&aacute; </font>
                      <?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 $resp = mysql_query("select count(*) as soma from cxsug;");
 $linha = mysql_fetch_object($resp);
 $sugestoes = $linha->soma;
?>
                      <font color="#FF0033">
                      <? if( $nomeusuario ) { print "$nomeusuario! ";}?>
                      Seja bem vindo &agrave; Intranet Datamace.
                      <?if ($ok) { ?>
                      </font><br>
                      <br>
                      <font color="#FF0033"><a href="login.php?logout=true"><font size="2">(Efetuar logout)</font></a>
                      <?}?>
                  </font></p></td>
                </tr>
              </table>
              <table width="91%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#BDDEF0">
                <tr valign="bottom">
                  <td width="33%" height="96" align="center" valign="middle" bgcolor="#FFFFFF"><a href="/cardapio/cardapio.pdf" target="_blank"><img src="imagens/cardapio.jpg" width="120" height="86" border="0"></a>
                  <a href="servicosgerais/solicitacao.php" target="_blank"></a></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF"><a href="../treinamento/treinamento.php"><img src="imagens/treinamento.jpg" width="154" height="86" border="0"></a></td>
                  <td width="33%" height="96" align="center" valign="middle" bgcolor="#FFFFFF"><div align="center"><a href="/agenda/" class="style3 style6"><img src="agenda/figuras/icone_calendario.JPG" width="154" height="86" border="0" align="absmiddle"><span class="style7"><strong><br>
                  </strong></span></a></div></td>
                </tr>
                <tr valign="bottom">
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF"><a href="ISO9001/index.php"><img src="imagens/iso_logo.jpg" width="154" height="86" border="0"></a></strong></span><br>
                  <span class="style17"><a href="ISO9001/index.php"></a></span> </td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF"><div align="center"><a href="a/"><img src="imagens/Logo_SAD.JPG" width="154" height="86" align="absmiddle" border="0"></a></div></td>
                  <td width="33%" height="96" align="center" valign="middle" bgcolor="#FFFFFF"><p align="center" class="style3 style2"><strong><font size="4" color="#000099"><a href="estrela/index.htm"><img src="imagens/estrela%20ouro1.jpg" width="154" height="86" border="0"></a> <a href="estrela/index.htm"><br>
                  </a> </font></strong></p></td>
                </tr>
                <tr valign="bottom">
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" class="style19" ><strong><a href="caixa/index.php"><img src="imagens/ouvir.jpg" width="154" height="86" border="0"></a><br>
                  </strong><span class="style17"><a href="caixa/index.php"></a></span></td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="http://186.202.182.13/grhnet/" target="_blank"><img src="imagens/Logo_Grh-Net.JPG" width="154" height="86" border="0"><br>
                  </a><a href="http://dtmdata/datamace.htm" target="_blank"></a></td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="https://webmail-seguro.com.br/datamace.com.br/"><img src="imagens/email.jpg" width="154" height="86" border="0"><br>
                  </a></td>
                </tr>
                <tr valign="bottom">
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><p><a href="http://www.santanderbanespa.com.br/portal/gsb/script/templates/GCMRequest.do?page=50" target="_blank"><strong><img src="imagens/santander.jpg" width="154" height="86" border="0"></strong></a><a href="http://www.santanderbanespa.com.br/portal/gsb/script/templates/GCMRequest.do?page=50" target="_blank"><strong><br>
                  </strong><br>
                  </a></p></td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="corporativo/telefones2.php#colab"><img src="imagens/telefone.jpg" width="154" height="86" border="0"><br>
                 </a> </td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="corporativo/ramais.php"><img src="imagens/pabx2.jpg" width="154" height="86" border="0"><br>
                    </a><br>
  <a href="corporativo/faq.htm"></a></td>
                </tr>

                <tr valign="bottom">
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><p>

                    <font size=3px>
                  <a href="/agenda/massagem.php" onclick="window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=640,height=480'); return false;"><img src="imagens/massagem.jpg" width="195" height="114" alt="" border="0" /><br>
                  <span style="font-size: 12px"><br>
                  Agendamendo de massagem</span></a>
                  </font>

                  </strong><br>
                  </a></p></td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="CargosSalarios.PDF" target="_blank"><font size=3px><a href="/agenda/massagem_cadeira.php" onclick="window.open(this.href, '', 'resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no,width=640,height=750'); return false;"><img src="imagens/massagem_cadeira.jpg" width="145" height="159" alt="" border="0" /><br>
                    <span style="font-size: 12px">Agendamendo de massagem na Cadeira</span></a><br></td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="corporativo/ramais.php"><br>
                </a> <a href="a/projetos/index.php"><img src="imagens/projetos.jpg" width="154" height="86" border="0"></a><br><br>  <a href="corporativo/faq.htm"></a></td>
                </tr>
                <tr valign="bottom">
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a  href="corporativo/cipa/index.php"><img src="corporativo/cipa/imagens/1809642-cipa.png" width="97" height="97" alt="Veja os &uacute;ltimos artigos da CIPA" border="0" /></a><a href="http://www.santanderbanespa.com.br/portal/gsb/script/templates/GCMRequest.do?page=50" target="_blank"></a></td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="Pesquisa_de_Satisfacao_2016.pdf" target="_blank"><img src="imagens/pesquisa.jpg" width="120" height="86" border="0"></a><a  href="corporativo/cipa/index.php"></a></td>
                  <td height="96" align="center" valign="middle" bgcolor="#FFFFFF" ><a href="CargosSalarios.PDF" target="_blank"><img src="imagens/salario.jpg" width="154" height="86" border="0"></a><a  href="corporativo/cipa/index.php"></a></td>
                </tr>

              </table>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <table id=menu width="98%"  border="0" cellspacing="0" cellpadding="0" align="center">
                <tr align="center">
                  <td height="12"><font size="1">&nbsp;</font></td>
                  <td><font size="1"><a href="javascript:aba1(1);">Importante</a></font></td>
                  <td><font size="1">&nbsp;</font></td>

                  <td><font size="1">&nbsp;</font></td>
                  <td><font size="1"><a href="javascript:aba1(2);">Estrutura/Apoio</a></font></td>
                  <td><font size="1">&nbsp;</font></td>
                  <td><font size="1">&nbsp;</font></td>
                  <td><font size="1"><a href="javascript:aba1(3);">Aniversariantes</a></font></td>
                  <td><font size="1">&nbsp;</font></td>
                </tr>
              </table>


              <span id="tab1">
              <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
                <tr>
                  <td align="left" valign="top" bgcolor="#FFFFFF"><div align="left"></div>
                    <ul>
                      <table width="95%"  border="0">
                        <tr>
                          <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
                              <tr bgcolor="#FFFFFF">
                                <td width="50%" valign="top"><table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                                    <tr >
                                      <td bgcolor="#2C91C7"><span class="style9"><span class="style10"><strong>Informa&ccedil;&otilde;es</strong></span></span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" valign="top">
                                      <td bgcolor="#FFFFFF"><ul>
                                          <li><a href="ISO9001/Documentos/D19.PDF" target="_blank">Pol&iacute;tica
                                            de Seguran&ccedil;a Datamace</a> <font face="Verdana, Arial, Helvetica, sans-serif"><font face="Verdana, Arial, Helvetica, sans-serif">
                                            </font></font></li>
                                          <li><a href="documents/ManualdoSAD.pdf" target="_blank">Manual
                                            de Utiliza&ccedil;&atilde;o do SAD<font
face="Verdana, Arial, Helvetica, sans-serif"> </font></a><font face="Verdana, Arial, Helvetica, sans-serif"><font face="Verdana, Arial, Helvetica, sans-serif">
                                            </font></font></li>
                                          <li><font color="#003399"><b><a href="suporte/index.php" class="style15 style16 style15 style15 style17 style17">Base
                                            de Solu&ccedil;&otilde;es</a></b></font>
                                            ( <font face="Verdana, Arial, Helvetica, sans-serif"></font><font size="3" color="#003399"><b><a href="suporte/index.php">
                                            </a></b></font> <a href="suporte/index.php"><font size="1"><b>Veja
                                            se a resposta que precisa est&aacute;
                                            aqui !</b></font></a><a href="suporte/index.php">)
                                            </a> </li>
                                          <li><a href="projetos/cobol/index.htm">D&iacute;gitos
                                            Verificadores - Saiba como calcular</a></li>
                                          <li><a href="suporte/orientacoes.pdf" target="_blank">Orienta&ccedil;&otilde;es
                                            para <b><font color="#FF0000">identifica&ccedil;&atilde;o
                                            dos problemas t&eacute;cnicos</font></b>
                                          no ambiente do cliente</a> <font face="Verdana, Arial, Helvetica, sans-serif"></font></li>
                                          <li>
                                            <div align="left">
                                              <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="guiainstalacao.pdf" target="_blank">Guia
                                                de Instala&ccedil;&atilde;o e
                                                Configura&ccedil;&atilde;o dos
                                              aplicativos Datamace</a></font></div>
                                            </div>
                                          </li>
                                          <li>
                                            <div align="left">
                                              <div align="left"><a href="corporativo/faq.htm">Ajuda Intranet</a></div>
                                            </div>
                                          </li>
                                      </ul></td>
                                    </tr>
                                    </table></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
                              <tr bgcolor="#FFFFFF">
                                <td><table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                                    <tr >
                                      <td bgcolor="#2C91C7"><span class="style12"><font face="Verdana, Arial, Helvetica, sans-serif"><b>GrhNet</b></font></span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" valign="top">
                                      <td bgcolor="#FFFFFF"><ul>

                                            <div align="left">
                                              <div align=left><br>
                                                                      </font></a></font></font></div>
                                            </div>
                                          </li>
                                                        <li>
                                                          <div align="left">
                                                            <div align=left><font face="Verdana, Arial, Helvetica, sans-serif">Para acessar base de teste na rede interna, o endere&ccedil;o &eacute; :<font color=#0000ff><br>
                                                            </font><a href="http://192.168.0.14/grhnet/">http://192.168.0.14<font color=#0000ff><font face="Verdana, Arial, Helvetica, sans-serif"></font></font>/grhnet/</a><br>
                                                            <font color=#0000ff> <font face="Verdana, Arial, Helvetica, sans-serif">(usu&aacute;rio 1 e senha 1234 - faz login como gestor)</font></font> </font></div>
                                                          </div>
                                                        </li>
                                                </ul></td>
                                    </tr>
                              </table>                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
                              <tr bgcolor="#FFFFFF">
                                <td width="50%" valign="top"><table width="100%" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                                    <tr >
                                      <td bgcolor="#2C91C7"><span class="style13"><span class="style14"><strong>Diversos</strong></span></span></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF" valign="top">
                                      <td bgcolor="#FFFFFF"><div align="left">
                                          <div align=left>
                                            <ul>
                                              <li><font face="Verdana, Arial, Helvetica, sans-serif"><a href="/a/versao/index.php">Libera&ccedil;&atilde;o de Release</a></font><font face="Verdana, Arial, Helvetica, sans-serif"></font></li>
                                                                <li><font face="Verdana, Arial, Helvetica, sans-serif"><font color="#999999"><a href="projetos/cobol/errorme.htm">Tabela de erros de run-time (RTS)</a></font></font> </li>
                                                                <li> <font face="Verdana, Arial, Helvetica, sans-serif"><a href="versao32bits.html">Vers&atilde;o 32 bits</a> </font></li>
                                                                <li><font face="Verdana, Arial, Helvetica, sans-serif"> </font><a href="noticia/FTPDOS.htm"><font color="#000099" size="2" face="Verdana, Arial, Helvetica, sans-serif">FTP pelo DOS</font></a></li>
                                                                <li><a href="noticia/FTPDOS.htm"><font color="#000099" size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font></a><font face="Verdana, Arial, Helvetica, sans-serif"><a href="quadrodechaves.php" class="style7">Quadro de chaves</a></font></li>
                                                                <li><a href="numeroequip.php">N&uacute;mero dos Equipamentos</a></li>
								<li><a href="isae3402.pdf" target="_blank"> Certificação ISAE 3402 - Locaweb</a></li>
								<li><a href="servicosgerais/solicitacao.php" target="_blank"> Solicitação de Manutenção</a></li>
                                            </ul>
                                          </div>
                                                </div></td>
                                    </tr>
                                    </table></td>
                              </tr>
                          </table></td>
                        </tr>
                      </table>
                      <br>
                      <div align="left">
                          <div align=left></div>
                      </div>
                    </ul>                  </td>
                </tr>
              </table>
              </span>

				<span id="tab4">
               <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
                <tr bgcolor="#FFFFFF">
                  <td width="50%" valign="top">
                    <table width="100%" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <tr >
                        <td bgcolor="#2C91C7"><span class="style1"><b>Corporativo</b></span></td>
                      </tr>
                      <tr bgcolor="#FFFFFF" valign="top">
                        <td bgcolor="#FFFFFF">
                          <ul>
                            <li><a href="/corporativo/index.php"><font size="1">Informa&ccedil;&otilde;es
                              a respeito da empresa, sempre atualizadas. Saiba
                              tudo que &eacute; importante</font></a>.<br>
                            </li>
                          </ul>                        </td>
                      </tr>
                    </table>                  </td>
                  <td width="50%" valign="top">
                    <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#FFFFFF">
                      <tr >
                        <td height="18" bgcolor="#2C91C7"><span class="style1"><b>Projetos</b></span></td>
                      </tr>
                      <tr bgcolor="#FFFFFF" valign="top">
                        <td>
                          <ul>
                            <li><font size="1"><a href="/projetos/index.htm">Saiba
                              sobre os projetos</a></font></li>
                          </ul>                        </td>
                      </tr>
                    </table>                  </td>
                </tr>
              </table>
              </span>

			  <span id="tab2">
              <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
                <tr bgcolor="#FFFFFF">
                  <td width="50%" valign="top">
                    <table width="100%" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <tr bgcolor="#3333FF">
                        <td bgcolor="#2C91C7" ><span class="style1"><b>Estrutura</b></span></td>
                      </tr>
                      <tr bgcolor="#FFFFFF" valign="top">
                        <td>
                          <ul>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/estrutura/index.php">Informa&ccedil;&otilde;es
                              sobre a rede e sobre as instala&ccedil;&otilde;es.
                              Para uso t&eacute;cnico.</a></font></li>
                            <li><font color="#0000FF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/estoque/consulta_estoque.php">Estoque
                              de pe&ccedil;as de reposi&ccedil;&atilde;o</a></font></li>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/corporativo/ramais.PDF" target="_blank">Lista
                            de ramais para impress&atilde;o</a></font></li>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/ver_arquivo1.php">Lista
                            de programas</a></font></li>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="https://webmail-seguro.com.br/datamace.com.br/">E-mail corporativo</a></font></li>

<li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/servicosgerais/solicitacao.php">Solicita&ccedil;&atilde;o de manuten&ccedil;&atilde;o / Suporte Interno </a></font><img src="imagens/novo.gif" alt="novo" width="45" height="15"></li>


                        </ul>                        </td>
                      </tr>
                    </table>                  </td>
                  <td width="50%" valign="top">
                    <table width="100%" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                      <tr bgcolor="#339900">
                        <td bgcolor="#2C91C7" ><span class="style1"><b>Apoio</b></span></td>
                      </tr>
                      <tr bgcolor="#FFFFFF" valign="top">
                        <td bgcolor="#FFFFFF">
                          <ul>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="Apoio/index.php">Informa&ccedil;&otilde;es
                              de apoio ao funcion&aacute;rio Datamace.</a></font></li>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="Apoio/links.html">Links diversos</a> </font></li>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="documents/HorasExtras-2006_001.xls" target="_self">Formul&aacute;rio de horas-extras</a></font></li>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="quadrodechaves.php">Quadro de chaves </a> </font></li>
                        </ul>                        </td>
                      </tr>
                    </table>                  </td>
                </tr>
              </table>
              </span>


			  <span id="tab3">

              <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
                <tr valign="top">
                  <td colspan="2" bgcolor="#FFFFFF">
                    <table width="100%" border="0" align="center">
                      <tr valign="top" align="left">
                        <td colspan="2" height="25">
                          <?
							 $agora = getdate(time());
							 $diahoje = $agora["mday"];
							 $mesatual = $agora["mon"];

							// mysql_select_db(datamace);
							 $sSQL = "SELECT nome, mes, dia FROM funcionarios  Where  mes = " . $mesatual . " ORDER BY dia;";

							 $result = mysql_query($sSQL);
							?>
                          <div align="center">
                            <table width="50%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000099">
                              <tr bgcolor="#2C91C7">
                                <td width="73%" bgcolor="#2C91C7"><span class="style1"><strong>Nome</strong></span></td>
                                <td width="27%" align="center"><span class="style1"><strong>Dia</strong></span></td>
                              </tr>
                              <?
                   while ($linha = mysql_fetch_object($result)) {
                   $nome = $linha->nome;
                   $dia = $linha->dia;
                ?>
                              <tr class="TabelaPadrao">
                                <td width="73%" bgcolor="#BDDEF0">
                                  <?
if ($diahoje == $dia) {
  echo "<img src=\"/imagens/aniv1.gif\"> - ";
};

?>
                                  <?echo $nome?>                                </td>
                                <td width="27%" align="center" bgcolor="#BDDEF0">
                                  <strong><?echo $dia?></strong>                                </td>
                              </tr>
                              <?
                     }
                 ?>
                            </table>
                            <br>
                          </div>                        </td>
                      </tr>
                    </table>                  </td>
                </tr>
              </table>
              </span>
<?
  mysql_close($link);
?>
              <script>
 function ativaAba( tab, x ) {

var tabela = tab;
var posE, posD, porC, ancora, final
final = Math.ceil((( 1 + tabela.rows[0].cells.length ) / 3 ));

for ( var i = 1; i < final ; i++ ) {
  posE = (i-1) * 3;
	posD = posE + 2;
	posC = posE + 1;

	tabela.rows[0].cells[posD].style.width = "10";
	tabela.rows[0].cells[posE].style.width = "12";

	var ok = false;
	for (var j=0; j<tabela.rows[0].cells[posC].all.length; j++) {
   if (tabela.rows[0].cells[posC].all(j).tagName == 'A') {
	   ancora = tabela.rows[0].cells[posC].all(j)     ;
	   ancora.style.fontSize=11;
	   ok = true;
	 }
  }


	if ( x == i ) {  // Ativo
  	if (ok) {
       ancora.style.color = "#0000ff";
		 //ancora.style.color = "#0000ff";
		 ancora.style.textDecoration = 'none';
		}
		if (i!=1) {
  		tabela.rows[0].cells[posE].innerHTML = "<img src=\"../files/ativo_esq1.gif\">";
		} else {
     		tabela.rows[0].cells[posE].innerHTML = "<img src=\"../files/ativo_esq.gif\">";
		}

		if (i==(final-1)) {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/ativo_dir1.gif\">";
		} else {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/ativo_dir.gif\">";
		}


  	tabela.rows[0].cells[posE].style.backgroundColor = '#BDDEF0';
      tabela.rows[0].cells[posC].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;
  } else { // Inativo
	  if (ok) {
      ancora.style.color = "#0000FF";
		ancora.style.textDecoration = 'none';
	  }
	    if ( i==1) {
        tabela.rows[0].cells[posE].innerHTML = '<img src=\"../files/ativo_esq.gif\">';
		} else {
		  tabela.rows[0].cells[posE].innerHTML = '<img src=\"../files/inativo_esq.gif\">';
		}

		if (i==(final-1)) {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/inativo_dir1.gif\">";
		} else {
        tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/inativo_dir.gif\">";
		}

		tabela.rows[0].cells[posC].style.backgroundColor = "#e1e1e1"
      tabela.rows[0].cells[posE].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;
	}
}
}

function ativa(value) {
var a;
for (a=1; a<tabs.length; a++) {
  if (a==value) {
    tabs[a].style.display='';
  } else {
    tabs[a].style.display='none';
  }
}
}


var linhaAtiva = 0;
var tabs = new Array;
tabs[1] = tab1;
tabs[2] = tab2;
tabs[3] = tab3;
tabs[4] = tab4;

function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
 item.style.display='';
 sp.innerHTML  = i2;
 } else {
 item.style.display='none'
 sp.innerHTML  = i1;
 }
}


aba1(1);

function aba1(x) {
 ativaAba(menu, x);
 ativa(x);
}
</script>
              <!-- #EndEditable --></td>
            <td align="right" width="23%" valign="top" >
              <table width="100%" border="0" class="bgTabela">
                <tr bgcolor="#FFCC33" valign="top">
                  <td colspan="2" class="bgTabela">
                    <table width="90%" border="0" align="center">
                      <tr valign="top">
                        <td valign="top">
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                            <tr valign="top">
                              <td valign="top">
                                <table width="100%" border="0" class="bgTabela">
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaRotulo" height="12"><a href="/corporativo/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Corporativo</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Home</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="/a/"><font face="Verdana, Arial, Helvetica, sans-serif">S.A.D</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="ISO9001/Documentos/D04.PDF"><font face="Verdana, Arial, Helvetica, sans-serif">Organograma</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="assistencia/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Assist&ecirc;ncia
                                     M&eacute;dica</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="/corporativo/dadosdaempresa.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Dados
                                     da Empresa</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="/corporativo/aniversarios/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Anivers&aacute;rios</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="corporativo/feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes
                                     e Feriados</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="/servicosgerais/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Manuten&ccedil;&atilde;o</font></a>                                    </td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="corporativo/escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="corporativo/Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es
                                     sobre v&iacute;rus</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="colaboradores/index.htm">Colaboradores</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="saude/" target="_blank">Sa&uacute;de e Qualidade de vida</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="eventos.htm">Eventos Datamace</a></td>
                                 </tr>
                               </table>
                              </td>
                            </tr>
                          </table>
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                            <tr valign="top">
                              <td>
                                <table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td height="16" bgcolor="#CC9900" class="TabelaRotulo"><a href="estrutura/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Estrutura</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" height="9"><a href="/estrutura/rede.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Rede</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="estrutura/micros.php"><font face="Verdana, Arial, Helvetica, sans-serif">n&ordm;
                                      micros</font></a></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                           <tr valign="top">
                             <td> <table width="100%" border="0" class="bgTabela">
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaRotulo" valign="top"><a href="Apoio/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Apoio</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao" valign="top"><a href="Apoio/emails.php"><font face="Verdana, Arial, Helvetica, sans-serif">E-mails</font></a></td>
                                 </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="Apoio/links.html"><font face="Verdana, Arial, Helvetica, sans-serif">Links</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="/corporativo/ramais.php">Ramais</a></font></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="/corporativo/telefones2.php"><font face="Verdana, Arial, Helvetica, sans-serif">Telefones
                                    &uacute;teis</font></a></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr valign="top">
                              <td><table width="100%" border="0" class="bgTabela">
                                                                  </table>
                                <table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaRotulo" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="treinamento/treinamento.php">Treinamento</a></font></td>
                                  </tr>

                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="treinamento">Portal</a></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr valign="top">
                              <td><table width="100%" border="0" class="bgTabela">

                                </table></td>
                            </tr>
                          </table></td>

                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a>
        <br>
        <hr align="center">
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999">
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>
      </td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
</body>
<!-- #EndTemplate --></html>

