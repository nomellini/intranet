<?
$ACESSO = 'S'; // Verifica se o acesso � permitido de acordo com o usu�rio
include_once ('cabeca.inc.php');

if ($ordem=="")  $ordem="nome";

if ($nome) 
	$sSQL = "SELECT  * FROM cadastrotreinamento  where nome like '%$nome%' and year(hoje) = $ano and  month(hoje) = $mes order by $ordem, nome ";
else
	$sSQL = "SELECT  * FROM cadastrotreinamento where year(hoje) = $ano and  month(hoje) = $mes order by $ordem, nome ";

$result = mysql_query($sSQL);   

?>
<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<title>Datamace Inform&aacute;tica Ltda.</title>
<script language="JavaScript" src="../scripts/jquery-1.3.2.min.js" type="text/javascript"></script>
<script language="JavaScript" src="../scripts/jquery.fixedheader.js" type="text/javascript"></script>
<script type="text/javascript"> 
	$(document).ready(function(){
		$("#tabela").fixedHeader({
			width: 750,
			height: 430
		});
	})
</script>
<style type="text/css">
.style4 {font-size: 9px}
.style5 {font-size: 10px}
.style6 {font-size: 9px}
</style>
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
							<form action="vercadtre.php" method="post" name="form">
							<input type="hidden" name="ordem" id="ordem" value="<?=$ordem ?>">
								<table width="100%" border="0" align="center">
									<tr>
										<th align="center"><span class="style8">Cadastro do Treinando</span></th>
									</tr>
									<tr>
										<td><table width="100%" border="1" align="left">
												<tr bgcolor="#D7FFFF">
													<td align="center" valign="middle" bgcolor="#006699"><span class="style1 style12 style11 style5"><strong>Procure pelo nome do treinando </strong></span></td>
												</tr>
												<tr>
													<td bgcolor="#DBF0EE"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">M&ecirc;s </font>
														<select name="mes" id="mes"  onChange="document.form.submit()">
															<?
					$selx = array();
					$selx[$mes] = 'selected';
					for ($x=1; $x<13; $x++){
						echo "<option value='$x' ".$selx[$x].">".$mesescrito[$x]."</option>";
					}
				?>
														</select>
														<font face="Verdana, Arial, Helvetica, sans-serif" size="1">Ano</font>
														<select name="ano" id="ano" onChange="document.form.submit()">
															<?
																		$selx = array();
																		$selx[$ano] = 'selected';
																		for ($x=COMBOANOINI; $x<COMBOANOFIM; $x++){
																			echo "<option value='$x' ".$selx[$x].">$x</option>";
																		}
																	?>
														</select></td>
												</tr>
												<tr>
													<td bgcolor="#DBF0EE"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Nome&nbsp;</font>
														<input name="nome" type="text" id="nome" value="<?echo "$nome" ?>" size="60" />
														<input name="Submit" type="submit" class="style4" value="procura">
													</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td><span class="style6 style6 style6">Treinamento realizado por:</span><span class="style6 style6"> <a href="vercadtreDTM.php">Datamace</a> - <a href="vercadtrePAR.php">Parceiros</a> - <a href="vercadtre.php">Todos</a></span></td>
									</tr>
									<tr>
										<td><table id="tabela" border="1" cellpadding="1" width="732" cellspacing="1">
												<tr bgcolor="#FFFFFF" class="TabelaRotulo">
													<td width="43%" bgcolor="#006699"><a href="#" onClick="document.getElementById('ordem').value = 'empnome'; document.form.submit()" class="style1">Nome da empresa </a></td>
													<td width="42%" bgcolor="#006699"><a href="#" onClick="document.getElementById('ordem').value = 'nome'; document.form.submit()" class="style1">Nome do treinando </a></td>
													<td width="15%" bgcolor="#006699"><a href="#" onClick="document.getElementById('ordem').value = 'hoje'; document.form.submit()" class="style1">Data</a></td>
												</tr>
												<?
 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
      $nome = $linha->nome;
      $cargo = $linha->cargo;
      $areaatuacao = $linha->areaatuacao;
      $tempoarea = $linha->tempoarea;
      $superiordireto = $linha->superiordireto;
      $cargosuperior = $linha->cargosuperior;
	  $hoje = $linha->hoje;
      $empnome = $linha->empnome;empnome;
      $emprua = $linha->emprua;
      $empnumero = $linha->empnumero;
      $empbairro = $linha->empbairro;
      $empcep = $linha->empcep;
      $empcidade = $linha->empcidade;
      $empestado = $linha->empestado;
	  $empfone = $linha->empfone;
      $email = $linha->email;
	  $identifica  = $linha->identifica ;
	  
  $hoje = substr($hoje,8,2) . '/' . substr($hoje,5,2) . '/' . substr($hoje,0,4);
    	   
?>
												<tr>
													<td width="43%" bgcolor="#DBF0EE" ><span class="style4 style5 style5"><? echo "<a href=resultcadtre.php?id=$id>$empnome</a>" ?></span> </td>
													<td bgcolor="#DBF0EE" ><span class="style4 style5 style5"><? echo "<a href=resultcadtre.php?id=$id>$nome</a>" ?></span> </td>
													<td bgcolor="#DBF0EE" ><span class="style4 style5 style5"><? echo "<a href=resultcadtre.php?id=$id>$hoje</a>" ?></span></td>
												</tr>
												<?
  };
 ?>
											</table></td>
									</tr>
									<tr>
										<td><a href="treinamento.php" class="style4">Voltar</a></td>
									</tr>
								</table>
							</form>
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
<p align="center">&nbsp;</p>
</body>
<!-- #EndTemplate --></html>
