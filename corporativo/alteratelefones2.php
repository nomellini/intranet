<a name="cima"></a>
<!-- #BeginEditable "php" --> 

<!-- #EndEditable --> 
<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" --> 
<title>Telefones úteis</title>
<style type="text/css">
<!--
.style4 {font-size: 9px}
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
              <p></p><p></p>
              <p class="Titulo" align="center"><a href="/corporativo/index.php">Corporativo</a> 
                : Telefones &Uacute;teis</p>
              <table border="0" cellpadding="0" width="100%">
                <tr bgcolor="#FFFFFF"> 
                  <td width="100%"><font face="Arial Black" size="3"
color="#FFFFFF" class="Titulo">Telefones &Uacute;teis </font><font face="Arial Black"
color="#FFFFFF" class="Titulo"><a href="#cima" class="style4">(voltar ao &iacute;ndice)</a></font><font face="Arial Black" size="3"
color="#FFFFFF" class="Titulo"> <a name="uteis"></a><br>
                    <font size="1">Clique no nome para alterar os dados. Clique <a href="/corporativo/alterartelutil.php">AQUI</a> para cadastrar um novo contato </font>                  </font></td>
                </tr>
              </table>
              <table border="0" cellpadding="0" width="100%">
                <tr> 
                  <td width="100%"><table border="0" cellpadding="0" width="100%">
                    <tr>
                      <td width="100%"><?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 if ($ordem=="") { $ordem="nome";};
 $sSQL = "SELECT  * FROM telUteis order by $ordem, nome ;"; 
 
 
 $result = mysql_query($sSQL);    
?>
                          <table border="0" cellpadding="1" width="100%" cellspacing="1">
                            <tr bgcolor="#FFFFFF" class="TabelaRotulo">
                              <td width="30%"><div align="center"><font size="1"><a href="telefones2.php?ordem=nome#uteis">Nome</a></font></div></td>
                              <td width="20%"><div align="center"><font size="1">Telefone</font></div></td>
                              <td width="15%"><div align="center"><font size="1">Fax</font></div></td>
                              <td width="21%"><div align="center"><font size="1">Homepage</font></div></td>
                              <td width="14%"><div align="center"><font size="1">E-mail</font></div></td>
                            </tr>
                            <?
 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
	  $nome = $linha->nome;
	  $telefone= $linha->telefone;
	  if ($telefone == "") { $telefone = "&nbsp;"; };
	  $email= $linha->email;
      if ($email == "") { $email = "&nbsp;"; };
	  $fax = $linha->fax;
      $homepage = $linha->homepage;
      if ($homepage == "")  
           { $homepage = "&nbsp;"; }
      else
           { $homepage = "<a target=_blank href=http://$homepage>clique aqui</a>";};
		   
		   
		   
?>
                            <tr>
                              <td width="30%" bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo "<a href=alterartelutil.php?id=$id>$nome</a>"?> </font></td>
                              <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $telefone?> </font></td>
                              <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $fax?> </font></td>
                              <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $homepage?> </font></td>
                              <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $email?> </font></td>
                            </tr>
                            <?
  };
 ?>
                          </table>
                          <p>&nbsp;</p></td>
                    </tr>
                  </table>
                  </td>
                </tr>
                <tr bgcolor="#FFFFFF"> 
                  <td width="100%"><font face="Arial Black" size="3"
color="#FFFFFF" class="Titulo">Telefones de Colaboradores<font size="1"><a name="col" id="col"></a></font> </font><font face="Arial Black"
color="#FFFFFF" class="Titulo"><font face="Arial Black"
color="#FFFFFF" class="Titulo"><a href="#cima" class="style4">(voltar ao &iacute;ndice)</a><a href="#uteis" class="style4"></a></font></font><font face="Arial Black" size="3"
color="#FFFFFF" class="Titulo"><font size="1"><a name="colab"></a><br>
                    Clique no nome para alterar os dados. Clique <a href="/corporativo/alterartelcol.php">AQUI</a> 
                  para cadastrar um novo telefone</font></font></td>
                </tr>
              </table>
              <table border="0" cellpadding="0" width="100%">
                <tr> 
                  <td width="100%"> 
                    <?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 if ($ordem=="") { $ordem="nome";};
 $sSQL = "SELECT  * FROM TelCol where (ativo is not NULL) and (divisao <> 'INTERSYSTEM') order by $ordem, nome ;"; 
 $result = mysql_query($sSQL);    
?>
                    <table border="0" cellpadding="1" width="100%" cellspacing="1">
                      <tr bgcolor="#FFFFFF" class="TabelaRotulo"> 
                        <td width="30%"> 
                          <div align="center"><font size="1"><a href="telefones2.php?ordem=nome#col">Nome</a></font></div>                        </td>
                        <td width="20%"> 
						  <div align="center"><font size="1"><a href="telefones2.php?ordem=divisao#col">Departamentos</a></font>					       </div></td>
                        <td width="15%"> 
                          <div align="center"><font size="1">Residencial</font></div>                        </td>
                        <td width="19%"> 
                        <div align="center"><font size="1">Celular</font></div>                        </td>
                        <td width="16%"> 
                        <div align="center"><font size="1">e-mail</font></div>                        </td>
                      </tr>
                      <?
 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
      $nome = $linha->nome;
      $depto= $linha->divisao;
      $fone = $linha->residencial;
      if ($fone == "") { $fone = "&nbsp;"; };
      $cel  = $linha->celular;
      if ($cel == "") { $cel = "&nbsp;"; };
      $email = $linha->email;
      if ($email == "")  
           { $email = "&nbsp;"; };
?>
                      <tr> 
                        <td width="30%" bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo "<a href=alterartelcol.php?id=$id>$nome</a>"?>
                          </font></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo $depto?>
                          </font></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo $fone?>
                          </font></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo $cel?>
                          </font></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo $email?>
                          </font></td>
                      </tr>
                      <?
  };
 ?>
                    </table>
                    <p>&nbsp;</p>                  </td>
                </tr>
              </table>
               

 

 

              <table border="0" cellpadding="0" width="100%">
                <tr>
                  <td width="100%"><?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 if ($ordem=="") { $ordem="nome";};
 $sSQL = "SELECT  * FROM TelCol where (ativo is not NULL) and (divisao = 'INTERSYSTEM') order by $ordem, nome ;"; 
 $result = mysql_query($sSQL);    
?>
                      <table border="0" cellpadding="1" width="100%" cellspacing="1">
                        <tr bgcolor="#FFFFFF" class="TabelaRotulo">
                          <td width="30%"><div align="center"><font size="1"><a href="telefones2.php?ordem=nome#col">Nome</a></font></div></td>
                          <td width="20%"><div align="center"><font size="1">Intersystem<a href="telefones2.php?ordem=divisao#col"></a></font> </div></td>
                          <td width="15%"><div align="center"><font size="1">Residencial</font></div></td>
                          <td width="19%"><div align="center"><font size="1">Celular</font></div></td>
                          <td width="16%"><div align="center"><font size="1">e-mail</font></div></td>
                        </tr>
                        <?
 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
      $nome = $linha->nome;
      $depto= $linha->divisao;
      $fone = $linha->residencial;
      if ($fone == "") { $fone = "&nbsp;"; };
      $cel  = $linha->celular;
      if ($cel == "") { $cel = "&nbsp;"; };
      $email = $linha->email;
      if ($email == "")  
           { $email = "&nbsp;"; };
?>
                        <tr>
                          <td width="30%" bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo "<a href=alterartelcol.php?id=$id>$nome</a>"?> </font></td>
                          <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $depto?> </font></td>
                          <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $fone?> </font></td>
                          <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $cel?> </font></td>
                          <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $email?> </font></td>
                        </tr>
                        <?
  };
 ?>
                      </table>
                    <p>&nbsp;</p></td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <table border="0" cellpadding="0" width="100%">
                <tr bgcolor="#FFFFFF"> 
                  <td width="100%"><font face="Arial Black" size="3"
color="#FFFFFF" class="Titulo">Telefones de Ex-Colaboradores<font size="1"><a name="col" id="col"></a></font> </font><font face="Arial Black"
color="#FFFFFF" class="Titulo"><font face="Arial Black"
color="#FFFFFF" class="Titulo"><a href="#cima" class="style4">(voltar ao &iacute;ndice)</a><a href="#uteis" class="style4"></a></font></font><font face="Arial Black" size="3"
color="#FFFFFF" class="Titulo"><font size="1"><a name="excolab" id="excolab"></a><br>
                    Clique no nome para alterar os dados. Clique <a href="/corporativo/alterartelexcol.php">AQUI</a> 
                    para cadastrar um novo telefone</font></font></td>
                </tr>
                <tr> 
                  <td width="100%"> 
                    <?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 if ($ordem=="") { $ordem="nome";};
 $sSQL = "SELECT  * FROM Telexcol where (ativo is not NULL) order by $ordem, nome ;"; 
 $result2 = mysql_query($sSQL);    
?>
                    <table border="0" cellpadding="1" width="100%" cellspacing="1">
                      <tr bgcolor="#FFFFFF" class="TabelaRotulo"> 
                        <td width="30%"> 
                          <div align="center"><font size="1"><a href="telefones2.php?ordem=nome#excolab">Nome</a></font></div>                        </td>
                        <td width="20%"> 
						  <div align="center"><font size="1">e-mail<a href="telefones2.php?ordem=divisao#col"></a></font>					       </div></td>
                        <td width="15%"> 
                          <div align="center"><font size="1">Residencial</font></div>                        </td>
                        <td width="21%"> 
                          <div align="center"><font size="1">Celular</font></div>                        </td>
                        <td width="14%"> 
                          <div align="center"><font size="1">Homepage</font></div>                        </td>
                      </tr>
                      <?
 while ($linha = mysql_fetch_object($result2)) {
      $id = $linha->id;
      $nome = $linha->nome;
      $fone = $linha->residencial;
      if ($fone == "") { $fone = "&nbsp;"; };
      $cel  = $linha->celular;
      if ($cel == "") { $cel = "&nbsp;"; };
      $home = $linha->homepage;
      if ($home == "")  
           { $home = "&nbsp;"; }
      else
           { $home = "<a href=http://$home>clique aqui</a>";};
      $email= $linha->email;
?>
                      <tr> 
                        <td width="30%" bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo "<a href=alterartelexcol.php?id=$id>$nome</a>"?>
                          </font></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><a href="mailto://<? echo $email ?>"><font size="1"> 
                          <? echo $email ?>
                          </font></a></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <? echo $fone ?>
                          </font></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo $cel?>
                          </font></td>
                        <td bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> 
                          <?echo $home?>
                          </font></td>
                      </tr>
                      <?
  };
 ?>
                    </table>
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
                    <p>&nbsp;</p>
                    <p>&nbsp;</p></td>
                </tr>
              </table>
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
                                   <td class="TabelaPadrao"><a href="mapadosite/mapasite.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Mapa 
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
                                   <td class="TabelaPadrao"><a href="feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes 
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
                                   <td class="TabelaPadrao"><a href="escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="../suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900"> 
                                   <td class="TabelaPadrao"><a href="Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es 
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
                                    <td class="TabelaRotulo" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="../treinamento/treinamento.php">Treinamento</a></font></td>
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

