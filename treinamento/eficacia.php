<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');
 if ($id) {

   $sSQL = "select * from eficacia where id = $id;"; 
   if (!$result = mysql_query($sSQL)) {
      echo "<br><br>Problema na aplicação do SQL</b><br>";
   };

   if (!$linha = mysql_fetch_object($result)) {
     echo "<br><br>não consigo pegar o objeto</b><br>";
   };
 
  $titulo = $linha->titulo;
  $entidade = $linha->entidade;  
  $instrutor = $linha->instrutor;
  $data1 = $linha->data1;
  $data2 = $linha->data2;
  $cargahoraria = $linha->cargahoraria;
  $avaliador = $linha->avaliador;
  $area = $linha->area;
  $treinando = $linha->treinando;
  $registro = $linha->registro;
  $datadevolucao = $linha->datadevolucao;
  $aprendizagem = $linha->aprendizagem;
  $aplicabilidade = $linha->aplicabilidade;
  $comportamento = $linha->comportamento;
  $geral = $linha->geral;  
}

?>
<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
<!--
.style4 {
	font-size: 9px
}
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
							<div align="center">
								<p>
									<style type="text/css">
<!--
.style1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;
}
a:link {
	color: #0000CC;
}
a:visited {
	color: #0000CC;
}
a:hover {
	color: #0000CC;
}
a:active {
	color: #0000CC;
}
.style12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #CCCCCC;
}
div.MsoNormal {margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman";}
li.MsoNormal {margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman";}
p.MsoNormal {margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman";}
div.MsoBlockText {margin-top:0cm;
	margin-right:-1.4pt;
	margin-bottom:0cm;
	margin-left:37.7pt;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-19.85pt;
	font-size:12.0pt;
	font-family:Arial;}
li.MsoBlockText {margin-top:0cm;
	margin-right:-1.4pt;
	margin-bottom:0cm;
	margin-left:37.7pt;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-19.85pt;
	font-size:12.0pt;
	font-family:Arial;}
p.MsoBlockText {margin-top:0cm;
	margin-right:-1.4pt;
	margin-bottom:0cm;
	margin-left:37.7pt;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-19.85pt;
	font-size:12.0pt;
	font-family:Arial;}
div.MsoBodyTextIndent2 {margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:41.7pt;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-19.85pt;
	font-size:12.0pt;
	font-family:Arial;}
li.MsoBodyTextIndent2 {margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:41.7pt;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-19.85pt;
	font-size:12.0pt;
	font-family:Arial;}
p.MsoBodyTextIndent2 {margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:41.7pt;
	margin-bottom:.0001pt;
	text-align:justify;
	text-indent:-19.85pt;
	font-size:12.0pt;
	font-family:Arial;}
.style17 {font-size: 12px}
.style36 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style37 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #FFFFFF;
}
.style39 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
              </style>
									<script language="JavaScript" src="newpopcalendar.js" type="text/javascript"></script> 
									<script language="JavaScript" src="data.js" type="text/javascript"></script> 
									<script language="JavaScript" src="scripts\jquery-1.4.4.min.js" type="text/javascript"></script> 
									<script language="JavaScript" src="scripts\jquery.cookie.js" type="text/javascript"></script> 
									<span class="style3"><strong>Avalia&ccedil;&atilde;o da Efic&aacute;cia do treinamento </strong></span></p>
							</div>
							<table width="100%" border="0" align="center">
								<tr>
									<td bgcolor="#006699" class="style37 style1"><div align="justify"><strong>Este instrumento de avalia&ccedil;&atilde;o tem por finalidade avaliar o &iacute;ndice de efic&aacute;cia da atividade de treinamento realizada e o grau atingido dos objetivos propostos </strong></div></td>
								</tr>
							</table>
							<p> 
								<script language="JavaScript" type="text/javascript">
function confirma() {
  if (!document.form.titulo.value){ 
       alert("Deve preencher o campo Título do treinamento.") 
	   document.form.titulo.focus();
	   return false; 
	   }
  if (!document.form.entidade.value){ 
       alert("Deve preencher o campo Entidade.") 
	   document.form.entidade.focus();
	   return false; 
	   }	   
  if (!document.form.instrutor.value){ 
       alert("Deve preencher o campo Instrutor.") 
	   document.form.instrutor.focus();
	   return false; 
	   }
  if (!document.form.data1.value){ 
       alert("Deve preencher o campo Data da realização do treinamento.") 
	   document.form.data1.focus();
	   return false; 
	   }
  if (!document.form.data2.value){ 
       alert("Deve preencher o campo Data da realização do treinamento.") 
	   document.form.data2.focus();
	   return false; 
	   }
  if (!document.form.cargahoraria.value){ 
       alert("Deve preencher o campo Carga horária.") 
	   document.form.cargahoraria.focus();
	   return false; 
	   }
  if (!document.form.avaliador.value){ 
       alert("Deve preencher o campo Avaliador.") 
	   document.form.avaliador.focus();
	   return false; 
	   }
  if (!document.form.area.value){ 
       alert("Deve preencher o campo Área.") 
	   document.form.area.focus();
	   return false; 
	   }   	   
  if (!document.form.treinando.value){ 
       alert("Deve preencher o campo Treinando.") 
	   document.form.treinando.focus();
	   return false; 
	   }  
  if (!document.form.registro.value){ 
       alert("Deve preencher o campo Registro.") 
	   document.form.registro.focus();
	   return false; 
	   }  
  if (!document.form.datadevolucao.value){ 
       alert("Deve preencher o campo Data da devolução do formulário") 
	   document.form.datadevolucao.focus();
	   return false; 
	   }  

  if (confirm('Tem certeza que deseja enviar os dados ?')) {
	$('input[type="text"]').each(function(){
		$.cookie('coo_'+$(this)[0].id, $(this)[0].value);
	});
	$.cookie('coo_login_eficacia', $('#login_eficacia')[0].value);
	document.form.submit();
  };
}

$(function(){
	$('input[type="text"]').each(function(){
		if ($.cookie('coo_'+$(this)[0].id)){
			$(this)[0].value = $.cookie('coo_'+$(this)[0].id);
		}
	});
	if ($.cookie('coo_login_eficacia')){
		$('#login_eficacia')[0].value = $.cookie('coo_login_eficacia');
	}
	$('#treinando')[0].value = '';
});

</script> 
							</p>
							<form action="gravaeficacia.php" method="post" name="form" id="form">
								<input type="hidden" name="id" value="1" />
								<table width="100%" border="0" align="center">
									<tr bgcolor="#006699">
										<td colspan="4" valign="baseline"><span class="style1 style37"><strong>Digite os dados abaixo: </strong></span></td>
									</tr>
									<tr>
										<td width="22%" valign="baseline" bgcolor="#DBF0EE"><span class="style4 style4 style4 style3 style4 style4">T&iacute;tulo do Treinamento:</span></td>
										<td width="40%" bgcolor="#DBF0EE"><input name="titulo" type="text" class="style4" id="titulo" size="40" maxlength="50" /></td>
										<td width="18%" valign="baseline" bgcolor="#DBF0EE">&nbsp;</td>
										<td width="20%" bgcolor="#DBF0EE">&nbsp;</td>
									</tr>
									<tr>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">Entidade:</span></td>
										<td bgcolor="#DBF0EE"><input name="entidade" type="text" class="style4" id="entidade" size="40" maxlength="50" /></td>
										<td valign="baseline" bgcolor="#DBF0EE">&nbsp;</td>
										<td bgcolor="#DBF0EE">&nbsp;</td>
									</tr>
									<tr>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">Instrutor</span></td>
										<td bgcolor="#DBF0EE"><input name="instrutor" type="text" class="style4" id="instrutor" size="40" maxlength="100" /></td>
										<td valign="baseline" bgcolor="#DBF0EE">&nbsp;</td>
										<td bgcolor="#DBF0EE">&nbsp;</td>
									</tr>
									<tr>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style4 style4 style3">Data da Realiza&ccedil;&atilde;o:</span></td>
										<td bgcolor="#DBF0EE"><span class="style4 style3">
											<input name="data1" type="text" class="style4" id="data1" onKeyUp="return(mascara_data(this));" size="10" maxlength="10" />
											<script language='JavaScript' type="text/javascript">
if (!document.layers)
{
 document.write("<img align='absmiddle' src='imagens/calendario.gif' ");
 document.write(" onclick='popUpCalendario(-10,10,this, document.form.data1,\"dd/mm/yyyy\");'> ");
}
      </script> 
											&agrave;
											<input name="data2" type="text" class="style4" id="data2" onKeyUp="return(mascara_data(this));" size="10" maxlength="10" />
											<script language='JavaScript' type="text/javascript">
if (!document.layers)
{
 document.write("<img align='absmiddle' src='imagens/calendario.gif' ");
 document.write(" onclick='popUpCalendario(-10,10,this, document.form.data2,\"dd/mm/yyyy\");'> ");
}
  </script> 
											</span></td>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">Carga Hor&aacute;ria: </span></td>
										<td bgcolor="#DBF0EE"><input name="cargahoraria" type="text" class="style4" id="cargahoraria" size="20" maxlength="10" /></td>
									</tr>
									<tr>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">Avaliador:</span></td>
										<td bgcolor="#DBF0EE"><input name="avaliador" type="text" class="style4" id="avaliador" size="40" maxlength="50" /></td>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">&Aacute;rea:</span></td>
										<td bgcolor="#DBF0EE"><input name="area" type="text" class="style4" id="area" size="20" maxlength="50" /></td>
									</tr>
									<tr>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">Treinando:</span></td>
										<td bgcolor="#DBF0EE"><input name="treinando" type="text" class="style4" id="treinando" size="40" maxlength="50" /></td>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">Registro:</span></td>
										<td bgcolor="#DBF0EE"><input name="registro" type="text" class="style4" id="registro" size="20" maxlength="15" /></td>
									</tr>
									<tr>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style4 style3">Devolver  at&eacute;:</span></td>
										<td bgcolor="#DBF0EE"><span class="style36 style3">
											<input name="datadevolucao" type="text" class="style4" id="datadevolucao" onKeyUp="return(mascara_data(this));" size="10" maxlength="10" />
											<script language='JavaScript' type="text/javascript">
if (!document.layers)
{
 document.write("<img align='absmiddle' src='imagens/calendario.gif' ");
 document.write(" onclick='popUpCalendario(-10,10,this, document.form.datadevolucao,\"dd/mm/yyyy\");'> ");
}
</script> 
											</span></td>
										<td valign="baseline" bgcolor="#DBF0EE">&nbsp;</td>
										<td bgcolor="#DBF0EE">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4" valign="baseline" bgcolor="#DBF0EE"><span class="style3"></span></td>
									</tr>
									<tr>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style3 style4">
											<label>Enviar para: </label>
											</span></td>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style36 style3 style4">
											<? //* O login dever ser exatamente o usuário da intranet ?>
											<select name="login_eficacia" id="login_eficacia" class="style4">
												<option value="nomellini"> Fernando</option>
												<option value="debora"> D&eacute;bora </option>
												<option value="edson"> Edson </option>
												<option value="Helio"> Helio </option>
												<option value="eder"> Eder </option>
												<option value="ricardo"> Ricardo </option>
												<option value="samuel"> Samuel </option>
												<option value="lucas"> Lucas </option>
                                                <option value="elias"> Elias </option>
                                                <option value="flavia"> Flávia Cristina </option>
                                                <option value="marcelo"> Marcelo Chinaglia </option>
											</select>
											</span></td>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style3"></span></td>
										<td valign="baseline" bgcolor="#DBF0EE"><span class="style3"></span></td>
									</tr>
								</table>
								<br />
								<input name="enviar" id="enviar" type="button" onClick="javascript:confirma()" value="Enviar" />
								<input type="button" onClick="window.location = '/treinamento/treinamento.php'" value="Voltar" />
							</form>
							<hr />
							<span class="style12"> </span><!-- #EndEditable --></td>
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