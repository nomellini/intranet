<?  require("../../cabeca.php");?><html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" --> 
<title>Anivers&aacute;rios</title>
<style type="text/css">
<!--
.style3 {color: #0000FF}
-->
</style>
<style type="text/css">
<!--
.style4 {color: #000066}
-->
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
	  
<?
  if ($acao=="incluir") {
	mysql_connect(localhost, sad, data1371);
	mysql_select_db(datamace);	
	$sSQL = "INSERT INTO funcionarios (nome, dia, mes) values ('$nome', '$dia', '$mes')";
	$result = mysql_query($sSQL);       
  }
?>			
			
              <p>
                <?
 $agora = getdate(time());
 $diahoje = $agora["mday"];
 $mesatual = $agora["mon"];

 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
// $sSQL = "SELECT id, abr as nome, MONTH(nasc) as mes, DAYOFMONTH(nasc) as dia FROM TelCol  Where  MONTH(nasc) = " . $mesatual . " AND ativo is not null  ORDER BY dia;"; 
 $sSQL = "SELECT id, nome, mes,dia FROM funcionarios  Where  mes = " . $mesatual . " ORDER BY dia;"; 
 $result = mysql_query($sSQL);    

?>
              </p>
              <p align="center" class="Titulo"><a href="/corporativo/index.php">Corporativo</a> 
                : Anivers&aacute;rios<br>
                <font size="2"><a href="#Nome">incluir</a></font></p>
              <table width="33%" height="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td colspan="2" bordercolor="#000000" class="bgTabela"><div align="center" class="style1"><STRONG>Aniversariantes do M&ecirc;s </STRONG></div></td>
                </tr>
                <?
	
	$c=0;
	while ($linha = mysql_fetch_object($result)) {
		$id = $linha->id;
		$nome = $linha->nome;
		$dia = $linha->dia;
		$c++;
		if (($diahoje == $dia) && ($mesatual==$mes)) {
			$dia = "<b>$dia</b>";
			$nome = "<b>$nome</b>";
            $nome .= '<img src="/corporativo/imagens/cake2-b.gif" width="25" height="21" border=0 align="absmiddle">';			
		};
		
		
?>
                <tr class="TabelaPadrao" >
                  <td bordercolor="#000000"><?
  if ($diahoje == $dia) {
    $nome = "<b>$nome</b>";
    echo '<img src="/corporativo/imagens/cake2-b.gif" width="25" height="21">';
  };
?>                    <a href="altera.php?id=<?=$id?>">
                    <?=$dia?>
                    </a></td>
                  <td width="68%" bordercolor="#000000"><a href="altera.php?id=<?=$id?>"><?echo $nome?></a></td>
                </tr>
                <?
 }
  while ($c<7) {
?>

                <?  
  $c++;
  }
 
?>
              </table>
              <br>
              <br>
              <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr align="center" valign="top"> 
                  <td width="33%"> 
                    <?tabela(1);?>                  </td>
                  <td width="33%"><?tabela(2);?></td>
                  <td width="33%"><?tabela(3);?></td>
                </tr>
                <tr align="center" valign="top"> 
                  <td width="33%"><?tabela(4);?></td>
                  <td width="33%"><?tabela(5);?></td>
                  <td width="33%"><?tabela(6);?></td>
                </tr>
                <tr align="center" valign="top"> 
                  <td width="33%"><?tabela(7);?></td>
                  <td width="33%"><?tabela(8);?></td>
                  <td width="33%"><?tabela(9);?></td>
                </tr>
                <tr align="center" valign="top"> 
                  <td width="33%"><?tabela(10);?></td>
                  <td width="33%"><?tabela(11);?></td>
                  <td width="33%"><?tabela(12);?></td>
                </tr>
              </table>
              <form name="form1" method="post" action="index.php">
                Nome<a name="Nome"></a> 
                <input name="nome" type="text" id="nome" size="20" maxlength="50">
                <br>
                dia/Mes 
                <input name="dia" type="text" id="dia" size="3" maxlength="3">
                / 
                <input name="mes" type="text" id="mes" size="3" maxlength="3">
                <input name="Incluir" type="submit" id="Incluir" value="Incluir">
                <input name="acao" type="hidden" id="acao" value="incluir">
              </form>
              <p>&nbsp;</p>
              <p>&nbsp;</p>


<?
function tabela($mes) {
    $cor1 = "#Cccccc";
	$cor2 = "#cccccc";
	$agora = getdate(time());
	$diahoje = $agora["mday"];
	$mesatual = $agora["mon"];
    $BRMonths = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");	
	if ($mesatual==$mes) {
	  $cor = $cor2;
	} else {
	  $cor = $cor1;
	}
	mysql_connect(localhost, sad, data1371);
	mysql_select_db(datamace);	
	$sSQL = "SELECT id, nome, dia FROM funcionarios Where mes = $mes ORDER BY  dia;"; 
	$result = mysql_query($sSQL);     
?>

              <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="<?=$cor?>">
                <tr> 
                  <td colspan="2" class="bgTabela"><strong><font color="#FFFFFF"><?=$BRMonths[$mes-1]?></font></strong></td>
                </tr>
<?
	
	$c=0;
	while ($linha = mysql_fetch_object($result)) {
		$id = $linha->id;
		$nome = $linha->nome;
		$dia = $linha->dia;
		$c++;
		if (($diahoje == $dia) && ($mesatual==$mes)) {
			$dia = "<b>$dia</b>";
			$nome = "<b>$nome</b>";
            $nome .= '<img src="/corporativo/imagens/cake2-b.gif" width="25" height="21" border=0 align="absmiddle">';			
		};
		
		
?>
                <tr class="TabelaPadrao" > 
                  <td width="10%"><span class="style3 style4">
                    <?=$dia?>
                  </span></td>

                  <td width="90%"><a href="altera.php?id=<?=$id?>"><?=$nome?></a>				  </td>
                </tr>
<?
 }
  while ($c<7) {
?>  
              <tr class="TabelaPadrao"> 
                  <td width="10%">&nbsp;</td>
                  <td width="90%">&nbsp;</td>
                </tr>
				  
<?  
  $c++;
  }
 
?>
              </table><br>

<?   
}
?>
			  
			 
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
                                   <td class="TabelaPadrao"><a href="../mapadosite/mapasite.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Mapa 
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
                                   <td class="TabelaPadrao"><a href="../feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes 
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
                                   <td class="TabelaPadrao"><a href="../escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../../suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es 
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

