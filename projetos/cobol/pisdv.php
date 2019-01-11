<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" --> 
<title>C&aacute;lculo de Digito Verificador - PIS</title>
<!-- #EndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
              <div align="left"><a href="http://www.datamace.com.br"><img src="../../imagens/novologo.jpg" width="155" height="41" border="0">
                </a></div>
            </div></td>
            <td width="60%" valign="middle"> <p class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" class="style2">Intranet 
            DATAMACE</font></p></td>
            <td width="23%" valign="bottom" align="right"><span class="style1"><font size="1"> <font class="unnamed1"> 
              <script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;   
      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Terça-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "Sábado";
      diasemana[0] = "Domingo";
     
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
              </font> </font></span></td>
          </tr>
        </table>
        <table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><!-- #BeginEditable "Centro" -->
              <p align="center"><A href="/index.php">Home</A> : Suporte </p>
              <p align="center"><strong>Instru&ccedil;&otilde;es  para o c&aacute;lculo do DV para PIS</strong></p>
              <p align="justify"> <br>
                Algoritmo  para o c&aacute;lculo do PIS<br>
                O PIS &eacute;  composto por onze algarismos, onde o &uacute;ltimo &eacute; chamado de d&iacute;gito verificador, ou  seja, o &uacute;ltimo d&iacute;gito &eacute; criado a partir dos dez primeiros. <br>
                Para  exemplificar melhor, iremos calcular o d&iacute;gito verificador de um PIS imagin&aacute;rio,  por exemplo: 1.208.448.335-X. &nbsp;<br>
                Fazendo o  c&aacute;lculo do d&iacute;gito verificador<br>
                O d&iacute;gito &eacute;  calculado com a distribui&ccedil;&atilde;o dos d&iacute;gitos colocando-se os valores 3, 2, 9, 8, 7,  6, 5, 4, 3, 2 (2 a 9 da direita para a esquerda) conforme a representa&ccedil;&atilde;o  abaixo:</p>
              <div align="center">
                <table border="1" cellpadding="0" width="585">
                  <tr>
                    <td width="175"><br>
                      N&uacute;meros    do PIS </td>
                    <td width="39"><p align="center">1</p></td>
                    <td width="39"><p align="center">2</p></td>
                    <td width="39"><p align="center">0</p></td>
                    <td width="39"><p align="center">8</p></td>
                    <td width="39"><p align="center">4</p></td>
                    <td width="39"><p align="center">4</p></td>
                    <td width="39"><p align="center">8</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="38"><p align="center">5</p></td>
                  </tr>
                  <tr>
                    <td width="175"><p>Valores    definidos para c&aacute;lculo</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="39"><p align="center">2</p></td>
                    <td width="39"><p align="center">9</p></td>
                    <td width="39"><p align="center">8</p></td>
                    <td width="39"><p align="center">7</p></td>
                    <td width="39"><p align="center">6</p></td>
                    <td width="39"><p align="center">5</p></td>
                    <td width="39"><p align="center">4</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="38"><p align="center">2</p></td>
                  </tr>
                </table>
              </div>
              <p>Multiplique  cada algarismo do n&uacute;mero do PIS pelo seu correspondente na linha de baixo.</p>
              <div align="center">
                <table border="1" cellpadding="0" width="592">
                  <tr>
                    <td width="181"><br>
                      N&uacute;meros    do PIS </td>
                    <td width="39"><p align="center">1</p></td>
                    <td width="39"><p align="center">2</p></td>
                    <td width="39"><p align="center">0</p></td>
                    <td width="39"><p align="center">8</p></td>
                    <td width="39"><p align="center">4</p></td>
                    <td width="39"><p align="center">4</p></td>
                    <td width="39"><p align="center">8</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="38"><p align="center">5</p></td>
                  </tr>
                  <tr>
                    <td width="181"><p>Valores    definidos para c&aacute;lculo</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="39"><p align="center">2</p></td>
                    <td width="39"><p align="center">9</p></td>
                    <td width="39"><p align="center">8</p></td>
                    <td width="39"><p align="center">7</p></td>
                    <td width="39"><p align="center">6</p></td>
                    <td width="39"><p align="center">5</p></td>
                    <td width="39"><p align="center">4</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="38"><p align="center">2</p></td>
                  </tr>
                  <tr>
                    <td width="181"><p>Totais</p></td>
                    <td width="39"><p align="center">3</p></td>
                    <td width="39"><p align="center">4</p></td>
                    <td width="39"><p align="center">0</p></td>
                    <td width="39"><p align="center">64</p></td>
                    <td width="39"><p align="center">28</p></td>
                    <td width="39"><p align="center">24</p></td>
                    <td width="39"><p align="center">40</p></td>
                    <td width="39"><p align="center">12</p></td>
                    <td width="39"><p align="center">9</p></td>
                    <td width="38"><p align="center">10</p></td>
                  </tr>
                </table>
              </div>
              <p align="justify">Em seguida  efetuamos a soma dos resultados (3 + 4 + 0 + 64 + 28 + 24 + 40 + 12 + 9 + 10),  o resultado obtido (194) ser&aacute; divido por 11. Considere como quociente apenas o  valor inteiro, o resto da divis&atilde;o ser&aacute; respons&aacute;vel pelo c&aacute;lculo do d&iacute;gito  verificador.<br>
                Vamos acompanhar: 194 dividido por 11  obtemos 17 de quociente e 7 de resto da divis&atilde;o. <br>
                Caso o resto da divis&atilde;o seja menor que 2, o  nosso d&iacute;gito verificador se torna 0 (zero), caso contr&aacute;rio subtrai-se o valor  obtido de 11, que &eacute; nosso caso, sendo assim nosso d&iacute;gito verificador &eacute;: 11-7=4. </p>
              <p align="justify">Confira: 1.208.448.335-4. </p>
              <p>&nbsp;</p> 
             <p>&nbsp;</p>
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
                                   <td class="TabelaPadrao"><a href="../../corporativo/mapadosite/mapasite.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Mapa 
                                     do site</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../ISO9001/Documentos/D04.PDF"><font face="Verdana, Arial, Helvetica, sans-serif">Organograma</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../assistencia/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Assist&ecirc;ncia 
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
                                   <td class="TabelaPadrao"><a href="../../corporativo/feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes 
                                     e Feriados</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="/corporativo/fome.htm"><font face="Verdana, Arial, Helvetica, sans-serif">T&ocirc; 
                                     com fome</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="/servicosgerais/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Manuten&ccedil;&atilde;o</font></a>                                    </td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../corporativo/escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../corporativo/Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es 
                                     sobre v&iacute;rus</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../colaboradores/index.htm">Colaboradores</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../../saude/" target="_blank">Sa&uacute;de e Qualidade de vida</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../../eventos.htm">Eventos Datamace</a></td>
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
                                    <td height="16" bgcolor="#CC9900" class="TabelaRotulo"><a href="../../estrutura/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Estrutura</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao" height="9"><a href="/estrutura/rede.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Rede</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../estrutura/micros.php"><font face="Verdana, Arial, Helvetica, sans-serif">n&ordm; 
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
                                   <td class="TabelaRotulo" valign="top"><a href="../../Apoio/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Apoio</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao" valign="top"><a href="../../Apoio/emails.php"><font face="Verdana, Arial, Helvetica, sans-serif">E-mails</font></a></td>
                                 </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao" valign="top"><a href="../../Apoio/links.html"><font face="Verdana, Arial, Helvetica, sans-serif">Links</font></a></td>
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
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaRotulo"><a href="../../entretenimento/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Entretenimento</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../entretenimento/filmes/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Videoteca</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../entretenimento/livros/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Biblioteca</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="/entretenimento/enquetes.php"><font face="Verdana, Arial, Helvetica, sans-serif">Enquetes</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../entretenimento/mural.htm">Mural 
                                      de an&uacute;ncios</a></td>
                                  </tr>
                                </table>
                                <table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaRotulo" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="../../treinamento/treinamento.php">Treinamento</a></font></td>
                                  </tr>
                                  
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="../../treinamento">Portal</a></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr valign="top"> 
                              <td><table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaRotulo"><a href="../../Intersystem/index.htm">Intersystem</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../Intersystem/compromisso.htm">Compromisso</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../Intersystem/dadosintersystem.htm">Dados 
                                      da empresa</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../Intersystem/missao.htm">Miss&atilde;o</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                    <td class="TabelaPadrao"><a href="../../Intersystem/servicosclientes.htm">Servi&ccedil;os</a></td>
                                  </tr>
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

