<?
$ACESSO = 'S'; // Verifica se o acesso � permitido de acordo com o usu�rio
$ExternoPermitido = "S";
include_once("cabeca.inc.php");

$timestamp = mktime(date("Y"));
$x = gmdate("Y");

mysql_select_db(datamace);
$resp = mysql_query("select count(*) as soma from cxsug;");
$linha = mysql_fetch_object($resp);
$sugestoes = $linha->soma;
?>
<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<title>Treinamento</title>
<style type="text/css">
.style54 {font-size: 12pt}
.style55 {font-size: 12}
.style56 {
	color: #FFFFFF;
	font-size: 13px;
}
.style48 {font-size: 12px; }
</style>
<script type="text/javascript">
 function GetWindowsUserName()
        {
            var win = new ActiveXObject("WScript.Shell");
            var username=(win.ExpandEnvironmentStrings("%USERNAME%"));
			alert(username);
        }
		window.onload = GetWindowsUserName();
    </script>
</script>
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
              <div align="left"><a href="http://www.datamace.com.br"><img src="../imagens/novologo.jpg" width="155" height="41" border="0">
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
							<table width="100%" border="0">
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td align="center"><font color="#FF0033">
											<? mysql_select_db(sad);
				   if ($USRACESSO) { echo peganomeusuario($v_id_usuario) . ", ";}
				   mysql_select_db(treinamento); ?>
											seja bem vindo ao Sistema de Gest&atilde;o do Treinamento</font>  </td>
								</tr>
							</table>
							<p class="TituloTreino" align="center"><A href="/index.php" >Home:</A> Treinamento </p>
							<table width="90%" border="0" align="center">
								<tr>
									<td colspan="2" class="thTreinamento">Treinandos</td>
								</tr>
								<tr>
									<td colspan="2"><a href="mancadtre.php">Cadastro Pessoal do Treinando</a></td>
								</tr>
								<tr>
									<td colspan="2"><a href="eficacia.php">Avalia&ccedil;&atilde;o da Efic&aacute;cia de Treinamento</a></td>
								</tr>
								<tr>
									<td colspan="2" >&nbsp;</td>
								</tr>
								<tr>
									<td width="50%" class="thTreinamento">Treinamento Clientes</td>
									<td width="50%" class="thTreinamento">Treinamento Interno </td>
								</tr>
								<tr>
									<td><a href="avatre.php?flagTipo=2&tipo=2&adm=S">Avalia&ccedil;&atilde;o do Treinamento </a></td>
									<td><a href="avatre.php?flagTipo=1&tipo=1&adm=S">Avalia&ccedil;&atilde;o do Treinamento </a></td>
								</tr>
								<tr>
									<td><a href="avatre.php?flagTipo=3&tipo=3&adm=S">Avalia&ccedil;&atilde;o do Treinamento Externo</a></td>
									<td><a href="oriava.php?tipo=1&adm=S">Avalia&ccedil;&otilde;es de Aprendizagem </a></td>
								</tr>
								<tr>
									<td><a href="oriava.php?&tipo=2&adm=S">Avalia&ccedil;&atilde;o de Aprendizagem</a></td>
									<td><a href="ver_gip.php?flagTipo=1">Resultado das avalia&ccedil;&otilde;es</a></td>
								</tr>
								<tr>
									<td><a href="ver_gip.php?flagTipo=2">Resultado das avalia&ccedil;&otilde;es</a></td>
									<td><a href="cadtre.php?tipo=1&tipotre=2">Cadastro de Treinamento</a></td>
								</tr>
								<tr>
									<td><a href="cadtre.php?tipo=1&tipotre=1">Cadastro de Treinamento</a></td>
									<td><a href="cadtre.php?tipo=2&tipotre=2">Cadastro de Treinamento por parceiros</a></td>
								</tr>
								<tr>
									<td colspan="2" >&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Treinamento Geral</td>
								</tr>
								<tr>
									<td colspan="2"><a href="reltotalunotot.php?ano=<?=$x ?>">Relat&oacute;rio totalizador geral</a></td>
								</tr>
								<tr>
									<td colspan="2" >&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Manuten&ccedil;&atilde;o Sistema</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								    <td><a href="instrutor.php">Cadastro de Instrutores</a></td>
									<td><a href="cria_treinamento.php">Cadastro dos Treinamentos </a></td>
							    </tr>
								<tr>
									<td><a href="cria_sistemas.php">Cadastro de Sistemas</a></td>
									<td><a href="cria_modulos.php">Cadastro de M&oacute;dulos</a></td>
								</tr>
								<tr>
									<td><a href="cria_perguntas.php">Cadastro de Perguntas</a></td>
									<td><a href="ip.php" >Lista de IP&acute;s </a></td>
								</tr>
								<tr>
									<td><a href="cad_conceitos.php">Cadastro de Conceitos</a></td>
									<td><a href="config.php">Configura&ccedil;&atilde;o / Sele&ccedil;&atilde;o da Prova</a></td>
								</tr>
								<tr>
									<td><a href="cria_provas.php">Cadastro de Provas</a></td>
									<td><a href="cria_revisao_formularios.php">Cadastro de Revis&atilde;o de Formul&aacute;rios</a></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Manuten&ccedil;&atilde;o Clientes</td>
								</tr>
								<tr>
									<td colspan="2"><a href="veravatreman.php">Avalia&ccedil;&atilde;o do Treinamento</a></td>
								</tr>
								<tr>
									<td colspan="2"><a href="vermaneficacia.php">Altera&ccedil;&atilde;o de Efic&aacute;cia </a></td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>								<tr>
									<td colspan="2" class="thTreinamento">Manual</td>
								</tr>
								<tr>
									<td><a href="manual.php">Manual do treinamento </a></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Portal</td>
								</tr>
								<tr>
									<td colspan="2"><a href="portal.php">Portal do Treinando</a></td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Relat&oacute;rios Gerais </td>
								</tr>
								<tr>
									<td><a href="vercadtre.php">Cadastro do Treinando</a></td>
									<td><a href="reltotempresa.php">Relat&oacute;rio totalizador por empresas</a></td>
								</tr>
								<tr>
									<td><a href="veravatre.php">Avalia&ccedil;&atilde;o individual do Treinamento</a></td>
									<td><a href="vertresad.php">Confirmados SAD</a></td>
								</tr>
								<tr>
									<td><a href="veravatreteste.php">Avalia&ccedil;&atilde;o Geral do Treinamento - m&oacute;dulos</a></td>
									<td><a href="ver_gipte.php">Comparativo de Assimila&ccedil;&atilde;o do Treinamento</a></td>
								</tr>
								<tr>
									<td><a href="veravatresistema.php">Avalia&ccedil;&atilde;o Geral do Treinamento - sistemas</a></td>
									<td><a href="rel_treinados.php">Treinados</a></td>
								</tr>
								<tr>
								    <td><a href="verAvaTreTreinando.php">Avalia&ccedil;&atilde;o do Treinando</a></td>
								    <td>&nbsp;</td>
							    </tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Relat&oacute;rios Internos &quot;Colaboradores&quot;</td>
								</tr>
								<tr>
									<td><a href="reltotalunoint.php?ano=<?=$x ?>">Relat&oacute;rio totalizador por colaborador </a></td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Relat&oacute;rios  &quot;Par&acirc;metriza&ccedil;&atilde;o&quot; </td>
								</tr>
								<tr>
									<td><a href="verperguntas.php">Lista de Perguntas</a></td>
									<td><a href="versistemas.php">Lista de sistemas</a></td>
								</tr>
								<tr>
									<td><a href="verprovas.php">Lista de Provas</a></td>
									<td><a href="rel_modulos.php?linkPagina=<?=$PAGINA ?>">M&oacute;dulos</a></td>
								</tr>
								<tr>
									<td><a href="vertreinamento.php">Lista de Treinamentos</a></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="2" class="thTreinamento">Relat&oacute;rios &quot;Gest&atilde;o de Talentos&quot; </td>
								</tr>
								<tr>
									<td><a href="vereficacia.php">Avalia&ccedil;&atilde;o da Efic&aacute;cia de Treinamento</a></td>
									<td><a href="reltotaluno.php">Relat&oacute;rio totalizador por alunos</a></td>
								</tr>
								<tr>
									<td><a href="vereficaciateste.php">Atraso da Avalia&ccedil;&atilde;o de Efic&aacute;cia</a></td>
									<td>&nbsp;</td>
								</tr>
							</table>
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
                                   <td class="TabelaPadrao"><a href="../corporativo/mapadosite/mapasite.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Mapa
                                     do site</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../ISO9001/Documentos/D04.PDF"><font face="Verdana, Arial, Helvetica, sans-serif">Organograma</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../assistencia/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Assist&ecirc;ncia
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
                                   <td class="TabelaPadrao"><a href="../corporativo/feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes
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
                                   <td class="TabelaPadrao"><a href="../corporativo/escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../corporativo/Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es
                                     sobre v&iacute;rus</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../colaboradores/index.htm">Colaboradores</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../saude/" target="_blank">Sa&uacute;de e Qualidade de vida</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="../eventos.htm">Eventos Datamace</a></td>
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
                                    <td height="16" bgcolor="#CC9900" class="TabelaRotulo"><a href="../estrutura/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Estrutura</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" height="9"><a href="/estrutura/rede.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Rede</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../estrutura/micros.php"><font face="Verdana, Arial, Helvetica, sans-serif">n&ordm;
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
                                   <td class="TabelaRotulo" valign="top"><a href="../Apoio/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Apoio</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao" valign="top"><a href="../Apoio/emails.php"><font face="Verdana, Arial, Helvetica, sans-serif">E-mails</font></a></td>
                                 </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="../Apoio/links.html"><font face="Verdana, Arial, Helvetica, sans-serif">Links</font></a></td>
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
                                    <td class="TabelaRotulo"><a href="../entretenimento/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Entretenimento</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../entretenimento/filmes/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Videoteca</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../entretenimento/livros/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Biblioteca</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="/entretenimento/enquetes.php"><font face="Verdana, Arial, Helvetica, sans-serif">Enquetes</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../entretenimento/mural.htm">Mural
                                      de an&uacute;ncios</a></td>
                                  </tr>
                                </table>
                                <table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaRotulo" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="treinamento.php">Treinamento</a></font></td>
                                  </tr>

                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="../treinamento">Portal</a></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr valign="top">
                              <td><table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaRotulo"><a href="../Intersystem/index.htm">Intersystem</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../Intersystem/compromisso.htm">Compromisso</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../Intersystem/dadosintersystem.htm">Dados
                                      da empresa</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../Intersystem/missao.htm">Miss&atilde;o</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="../Intersystem/servicosclientes.htm">Servi&ccedil;os</a></td>
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
</body>
<!-- #EndTemplate --></html>
