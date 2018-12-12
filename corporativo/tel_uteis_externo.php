<?	
  session_start();
  require("../a/scripts/conn.php");
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: /index.php"); }
		    setcookie("loginok");  			
	    } else {
		    header("Location: /index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
?><a name="cima"></a>

<html>
<!-- DW6 -->
<head>
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style4 {font-size: 9px}
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
            <td width="17%"> <div align="center"><a href="http://www.datamace.com.br"><img src="/imagens/novologo.jpg" width="155" height="41" border="0"></a></div></td>
            <td width="60%" valign="middle"> <p><font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" class="tituloIntranet">Intranet 
                DATAMACE</font></p></td>
            <td width="23%" valign="bottom" align="right"><font size="1"> <font color="#FFFFFF" class="unnamed1"> 
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
              </font> </font></td>
          </tr>
        </table>
        <table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">              <? 
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 $resp = mysql_query("select count(*) as soma from cxsug;");
 $linha = mysql_fetch_object($resp);
 $sugestoes = $linha->soma;
?>              <table width="91%" border="0" align="center">
                <tr valign="bottom"> 
                  <td ><a href="/agenda/"><img src="../agenda/figuras/icone_calendario.JPG" width="55" height="55" border="0" align="absmiddle">Agenda 
                    corporativa</a></td>
                </tr>
                <tr valign="bottom"> 
                  <td ><a href="../a/index.php"><img src="../a/SADLogo.gif" width="230" height="46" align="absmiddle" border="0"></a><br>                  </td>
                </tr>
                <tr valign="bottom">
                  <td ><table width="100%" border="0" class="bgTabela">
                    <tr bgcolor="#CC9900" bordercolor="#CC9900">
                      <td class="TabelaRotulo" height="12"><font face="Verdana, Arial, Helvetica, sans-serif"> Entradas permitidas: </font></td>
                    </tr>
                    <tr bgcolor="#CC9900" bordercolor="#CC9900">
                      <td class="TabelaPadrao"><a href="/a/"><font face="Verdana, Arial, Helvetica, sans-serif">S.A.D</font></a></td>
                    </tr>
                    <tr bgcolor="#CC9900" bordercolor="#CC9900">
                      <td class="TabelaPadrao"><a href="/corporativo/dadosdaempresa_externo.htm"> <font face="Verdana, Arial, Helvetica, sans-serif">Dados da Empresa</font></a></td>
                    </tr>
                    <tr bgcolor="#CC9900" bordercolor="#CC9900">
                      <td class="TabelaPadrao" height="13"><a href="/corporativo/tel_uteis_externo.php"> <font face="Verdana, Arial, Helvetica, sans-serif">Telefones &uacute;teis</font></a></td>
                    </tr>
                    <tr bgcolor="#CC9900" bordercolor="#CC9900">
                      <td class="TabelaPadrao" height="13"><a href="../suporte/sup.php">Base de solu&ccedil;&otilde;es</a> </td>
                    </tr>
                  </table>
                    <table width="213" border="1">
                    <tr>
                      <td width="203"><p class="Titulo" align="left"><a href="#uteis">&Uacute;teis</a></p>
                        <p class="Titulo" align="left"><a href="#colab"> Colaboradores</a></p>
                        <p class="Titulo" align="left"><a href="#excolab">Ex-Colaboradores</a></p></td>
                    </tr>
                  </table>
                    <p class="Titulo" align="left">&nbsp;</p>
                    <p class="Titulo" align="left"><a href="#excolab"><br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>  
                      <br>  
                      <br>  
                      <br>  
                      <br>  
                      <br>
                    </a></p>
                    <p class="Titulo" align="center">&nbsp;</p>
              <p class="Titulo" align="center">&nbsp;</p>
              <p class="Titulo" align="center">&nbsp;</p>
              <p class="Titulo" align="center">&nbsp;</p>
              <p class="Titulo" align="center">&nbsp;</p>
              <p class="Titulo" align="center">&nbsp;</p>
              <p class="Titulo" align="center">&nbsp;</p>
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
                              <td width="30%" bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $nome?> </font></td>
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
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br></td>
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
                          <?echo $nome?>
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
                          <td width="30%" bgcolor="#c0c0c0" class="TabelaPadrao"><font size="1"> <?echo $nome?> </font></td>
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
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
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
</td>
                </tr>
              </table>               
			  <font color="#CCCCCC"> &nbsp;&nbsp;Seu IP: <?=$REMOTE_ADDR?>
              </font>		              </td>
          </tr>
        </table>
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> 
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>
      </td>
    </tr>
  </table>
</div>
<p align="center" style="margin-bottom: 0;">&nbsp;</p>
</body>
</html>

