<?
set_time_limit(0);
ini_set('expect.timeout',-1);
ini_set('max_execution_time',9999999999);

header("Content-Type: text/html;  charset=ISO-8859-1",true); 
// Data no passado
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// Sempre modificado
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
// HTTP/1.0
header("Pragma: no-cache");

error_reporting (E_ALL ^ E_NOTICE ) ;

include_once ('cabeca.inc.php');

	$sSQL = "select * from eficacia where id = $id;"; 
	$result = mysql_query($sSQL);
	$linha = mysql_fetch_object($result);
 
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
	$justaprendizagem = $linha->justaprendizagem;
	$aplicabilidade = $linha->aplicabilidade;
	$justaplicabilidade = $linha->justaplicabilidade;
	$comportamento = $linha->comportamento;
	$justcomportamento = $linha->justcomportamento;
	$geral = $linha->geral;  
	$justgeral = $linha->justgeral;
	$nomegestor = $linha->nomegestor;

	$data1 = substr($data1,8,2) . '-' . substr($data1,5,2) . '-' . substr($data1,0,4);
	$data2 = substr($data2,8,2) . '-' . substr($data2,5,2) . '-' . substr($data2,0,4);
?>


<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" --> 
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
<!--
.style55 {font-weight: bold}
-->
</style>
<style type="text/css">
<!--
.style56 {font-size: 9px}
-->
</style>
  <script language="JavaScript" type="text/javascript">
function fun_confirma() {
	if ((!document.form.aprendizagem[0].checked) && 
		(!document.form.aprendizagem[1].checked) &&
		(!document.form.aprendizagem[2].checked) &&
		(!document.form.aprendizagem[3].checked) &&
		(!document.form.aprendizagem[4].checked) &&
		(!document.form.aprendizagem[5].checked) &&
		(!document.form.aprendizagem[6].checked) &&
		(!document.form.aprendizagem[7].checked) &&
		(!document.form.aprendizagem[8].checked) &&
		(!document.form.aprendizagem[9].checked) &&
		(!document.form.aprendizagem[10].checked) ){
		document.form.aprendizagem[0].focus();
		alert ("Informe o grau de aprendizagem!!!");
		return false;
	}
	
	if(((document.form.aprendizagem[4].checked) ||
		(document.form.aprendizagem[5].checked) ||
		(document.form.aprendizagem[6].checked) ||
		(document.form.aprendizagem[7].checked) ||
		(document.form.aprendizagem[8].checked) ||
		(document.form.aprendizagem[9].checked)) && 
		(!document.form.justaprendizagem.value)){ 
		document.form.justaprendizagem.focus();
		alert("Se a avaliação for de 1 a 6 é obrigatório justificar") 
		return false; 
	}
	
	if ((!document.form.aplicabilidade[0].checked) && 
		(!document.form.aplicabilidade[1].checked) &&
		(!document.form.aplicabilidade[2].checked) &&
		(!document.form.aplicabilidade[3].checked) &&
		(!document.form.aplicabilidade[4].checked) &&
		(!document.form.aplicabilidade[5].checked) &&
		(!document.form.aplicabilidade[6].checked) &&
		(!document.form.aplicabilidade[7].checked) &&
		(!document.form.aplicabilidade[8].checked) &&
		(!document.form.aplicabilidade[9].checked) &&
		(!document.form.aplicabilidade[10].checked)){
		document.form.aplicabilidade[0].focus();
		alert ("Informe o grau de aplicabilidade!!!");
		return false;
	}
	
	if (((document.form.aplicabilidade[4].checked) ||
		(document.form.aplicabilidade[5].checked) ||
		(document.form.aplicabilidade[6].checked) ||
		(document.form.aplicabilidade[7].checked) ||
		(document.form.aplicabilidade[8].checked) ||
		(document.form.aplicabilidade[9].checked)) && 
		(!document.form.justaplicabilidade.value)){
		document.form.justaplicabilidade.focus();
		alert("Se a avaliação for de 1 a 6 é obrigatório justificar") 
		return false; 
	}
	
	if ((!document.form.comportamento[0].checked) && 
		(!document.form.comportamento[1].checked) &&
		(!document.form.comportamento[2].checked) &&
		(!document.form.comportamento[3].checked) &&
		(!document.form.comportamento[4].checked) &&
		(!document.form.comportamento[5].checked) &&
		(!document.form.comportamento[6].checked) &&
		(!document.form.comportamento[7].checked) &&
		(!document.form.comportamento[8].checked) &&
		(!document.form.comportamento[9].checked) &&
		(!document.form.comportamento[10].checked)){
		document.form.comportamento[0].focus();
		alert ("Informe o grau de comportamento!!!");
		return false;
	}
	
	if  (((document.form.comportamento[4].checked) ||
		(document.form.comportamento[5].checked) ||
		(document.form.comportamento[6].checked) ||
		(document.form.comportamento[7].checked) ||
		(document.form.comportamento[8].checked) ||
		(document.form.comportamento[9].checked)) && 
		(!document.form.justcomportamento.value)){
		document.form.justcomportamento.focus();
		alert("Se a avaliação for de 1 a 6 é obrigatório justificar") 
		return false; 
	}
	
	
	if ((!document.form.geral[0].checked) && 
		(!document.form.geral[1].checked) &&
		(!document.form.geral[2].checked) &&
		(!document.form.geral[3].checked) &&
		(!document.form.geral[4].checked) &&
		(!document.form.geral[5].checked) &&
		(!document.form.geral[6].checked) &&
		(!document.form.geral[7].checked) &&
		(!document.form.geral[8].checked) &&
		(!document.form.geral[9].checked) &&
		(!document.form.geral[10].checked)){
		document.form.geral[0].focus();
		alert ("Informe o grau geral!!!");
		return false;
	}

	if (((document.form.geral[4].checked) ||
		(document.form.geral[5].checked) ||
		(document.form.geral[6].checked) ||
		(document.form.geral[7].checked) ||
		(document.form.geral[8].checked) ||
		(document.form.geral[9].checked)) && 
		(!document.form.justgeral.value)){
		document.form.justgeral.focus();
		alert("Se a avaliação for de 1 a 6 é obrigatório justificar") 
		return false; 
	}
	
	if (confirm('Tem certeza que deseja enviar os dados ?')){
		document.form.submit();
	}else{
		return false;
	}
}
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
.style31 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10;
	color: #FFFFFF;
}
.style34 {
	font-size: 10;
	color: #FFFFFF;
}
.style36 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style38 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.style39 {font-size: 10px}
.style45 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.style48 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style50 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }
.style51 {
	font-size: 10;
	color: #000099;
}
.style55 {font-size: 10}
-->
</style>
<script language="JavaScript" src="newpopcalendar.js" type="text/javascript"></script>
<script language="JavaScript" src="data.js" type="text/javascript"></script>

<div align="center"><span class="style1 style51"><span class="style55 style3">Avalia&ccedil;&atilde;o da Efic&aacute;cia de Treinamento </span></span></div>
<p>&nbsp;</p>
<table width="80%" border="0" align="center">
  <tr>
    <td bgcolor="#006699"><span class="style1 style38"><strong>Este instrumento de avalia&ccedil;&atilde;o tem por finalidade avaliar o &iacute;ndice de efic&aacute;cia da atividade de treinamento realizada e o grau atingido dos objetivos propostos </strong></span></td>
  </tr>
</table>
<form action="gravaeficacia1.php" method="post" name="form" id="form" onSubmit="return fun_confirma();">
  <input type="hidden" name="id" value="<? echo $id ?>" />
    <input type="hidden" name="nomegestor" value="<? echo $nomegestor; ?>" />

  <table width="80%" border="0" align="center">
    <tr>
      <td colspan="4" valign="baseline" bgcolor="#006699" class="style1 style38"><strong>Dados do treinamento: </strong></td>
    </tr>
    <tr>
      <td width="19%" bgcolor="#DBF0EE"><strong><span class="style1 style39 style3 style56 style3">T&iacute;tulo do Treinamento:</span></strong></td>
      <td width="32%" bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $titulo?></span></td>
      <td width="13%" valign="baseline" bgcolor="#DBF0EE"><span class="style3"></span></td>
      <td width="36%" bgcolor="#DBF0EE"><span class="style3"></span></td>
    </tr>
    <tr>
      <td bgcolor="#DBF0EE"><strong><span class="style1 style39 style3 style56">Entidade:</span></strong></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $entidade?></span></td>
      <td valign="baseline" bgcolor="#DBF0EE">&nbsp;</td>
      <td bgcolor="#DBF0EE">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#DBF0EE"><strong><span class="style1 style39 style3 style56">Instrutor:</span></strong></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $instrutor?></span></td>
      <td valign="baseline" bgcolor="#DBF0EE"><span class="style3"></span></td>
      <td bgcolor="#DBF0EE">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#DBF0EE"><strong><span class="style1 style39 style3 style56">Data da Realiza&ccedil;&atilde;o:</span></strong></td>
      <td bgcolor="#DBF0EE"><span class="style56 style3"><?echo $data1?> &agrave; <?echo $data2?></span></td>
      <td valign="baseline" bgcolor="#DBF0EE"><span class="style56 style3"><strong>Carga Hor&aacute;ria: </strong></span></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $cargahoraria?></span></td>
    </tr>
    <tr>
      <td bgcolor="#DBF0EE"><strong><span class="style1 style39 style3 style56">Avaliador:</span></strong></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $avaliador?></span></td>
      <td valign="baseline" bgcolor="#DBF0EE"><span class="style56 style3"><strong>&Aacute;rea:</strong></span></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $area?></span></td>
    </tr>
    <tr>
      <td bgcolor="#DBF0EE"><strong><span class="style1 style39 style3 style56">Treinando:</span></strong></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $treinando?></span></td>
      <td valign="baseline" bgcolor="#DBF0EE"><span class="style56 style3"><strong>Registro:</strong></span></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"><?echo $registro?></span></td>
    </tr>
    <tr>
      <td bgcolor="#DBF0EE"><span class="style56 style3"><strong>Devolver  at&eacute;:</strong></span></td>
      <td bgcolor="#DBF0EE"><span class="style36 style1 style39 style3"> <?echo $datadevolucao?> </span></td>
      <td valign="baseline" bgcolor="#DBF0EE">&nbsp;</td>
      <td bgcolor="#DBF0EE">&nbsp;</td>
    </tr>
  </table>
  <br />
<table width="80%" border="1" align="center">
  <tr>
    <td valign="middle" bgcolor="#006699"><p class="style1 style38"><strong>      Indique o grau de aprimoramento adquirido pelo Treinando, quanto a: </strong></p>    </td>
  </tr>
  
  <tr bgcolor="#006699">
    <td><span class="style50 style1"><strong>Aprendizagem: O quanto foi aprendido do conte&uacute;do do treinamento. </strong></span></td>
  </tr>
  <tr>
    <td><span class="style36">
      <input type="radio" name="aprendizagem" value="10" />
10
  <input type="radio" name="aprendizagem" value="9" />
9
<input type="radio" name="aprendizagem" value="8" />
8
<input type="radio" name="aprendizagem" value="7" />
7
<input type="radio" name="aprendizagem" value="6" />
6
<input type="radio" name="aprendizagem" value="5" />
5
<input type="radio" name="aprendizagem" value="4" />
4
<input type="radio" name="aprendizagem" value="3" />
3
<input type="radio" name="aprendizagem" value="2" />
2
<input type="radio" name="aprendizagem" value="1" />
1
<input type="radio" name="aprendizagem" value="0" />
N&atilde;o se aplica</span></td>
  </tr>
  <tr bgcolor="#006699">
    <td><span class="style1 style50"><strong>Justifique: </strong></span></td>
  </tr>
  <tr>
    <td><span class="style17">
      <label>
      <textarea name="justaprendizagem" cols="100" rows="3" id="justaprendizagem"></textarea>
      </label>
    </span></td>
  </tr>
  <tr bgcolor="#006699">
    <td><span class="style50 style1"><strong>Aplicabilidade: O quanto do que se aprendeu no treinamento est&aacute; sendo colocado em pr&aacute;tica nas atividades de trabalho. </strong></span></td>
  </tr>
  <tr>
    <td><span class="style36">
      <input type="radio" name="aplicabilidade" value="10" />
10
  <input type="radio" name="aplicabilidade" value="9" />
9
<input type="radio" name="aplicabilidade" value="8" />
8
<input type="radio" name="aplicabilidade" value="7" />
7
<input type="radio" name="aplicabilidade" value="6" />
6
<input type="radio" name="aplicabilidade" value="5" />
5
<input type="radio" name="aplicabilidade" value="4" />
4
<input type="radio" name="aplicabilidade" value="3" />
3
<input type="radio" name="aplicabilidade" value="2" />
2
<input type="radio" name="aplicabilidade" value="1" />
1
<input type="radio" name="aplicabilidade" value="N&atilde;o se aplica" />
N&atilde;o se aplica </span></td>
  </tr>
  <tr bgcolor="#006699">
    <td><span class="style50 style1"><strong>Justifique: </strong></span></td>
  </tr>
  <tr>
    <td><span class="style17">
      <textarea name="justaplicabilidade" cols="100" rows="3" id="justaplicabilidade"></textarea>
    </span></td>
  </tr>
  <tr bgcolor="#006699">
    <td><span class="style50 style1"><strong>Comportamento: Avaliar a(s) mudan&ccedil;a(s) de procedimento / conduta, ap&oacute;s o treinamento e decorrente do mesmo. </strong></span></td>
  </tr>
  <tr>
    <td><span class="style36">
      <input type="radio" name="comportamento" value="10" />
10
  <input type="radio" name="comportamento" value="9" />
9
<input type="radio" name="comportamento" value="8" />
8
<input type="radio" name="comportamento" value="7" />
7
<input type="radio" name="comportamento" value="6" />
6
<input type="radio" name="comportamento" value="5" />
5
<input type="radio" name="comportamento" value="4" />
4
<input type="radio" name="comportamento" value="3" />
3
<input type="radio" name="comportamento" value="2" />
2
<input type="radio" name="comportamento" value="1" />
1
<input type="radio" name="comportamento" value="N&atilde;o se aplica" />
N&atilde;o se aplica</span></td>
  </tr>
  <tr bgcolor="#006699">
    <td><span class="style1 style50"><strong>Justifique: </strong></span></td>
  </tr>
  <tr>
    <td><span class="style17">
      <textarea name="justcomportamento" cols="100" rows="3" id="justcomportamento"></textarea>
    </span></td>
  </tr>
  <tr bgcolor="#006699">
    <td class="style1 style50"><strong>Avalia&ccedil;&atilde;o Geral:</strong></td>
  </tr>
  <tr>
    <td><span class="style36">
      <input type="radio" name="geral" value="10" />
10
  <input type="radio" name="geral" value="9" />
9
<input type="radio" name="geral" value="8" />
8
<input type="radio" name="geral" value="7" />
7
<input type="radio" name="geral" value="6" />
6
<input type="radio" name="geral" value="5" />
5
<input type="radio" name="geral" value="4" />
4
<input type="radio" name="geral" value="3" />
3
<input type="radio" name="geral" value="2" />
2
<input type="radio" name="geral" value="1" />
1
<input type="radio" name="geral" value="N&atilde;o se aplica" />
N&atilde;o se aplica</span></td>
  </tr>
  <tr bgcolor="#006699">
    <td><span class="style17"><span class="style1 style50"><strong>Justifique: </strong></span></span></td>
  </tr>
  <tr>
    <td><span class="style17">
      <textarea name="justgeral" cols="100" rows="3" id="justgeral"></textarea>
    </span></td>
  </tr>
</table>
<table width="80%" border="0">
  <tr>
    <td><table width="38%" border="1" align="left">
        <tr>
          <td colspan="4" bgcolor="#006699"><span class="style1 style31 style56"><strong>Legenda</strong></span></td>
        </tr>
        <tr>
          <td width="15%"><span class="style56">01</span></td>
          <td width="15%"><span class="style56">&agrave;</span></td>
          <td width="15%"><span class="style56">03</span></td>
          <td width="41%"><span class="style56">N&atilde;o Eficaz </span></td>
        </tr>
        <tr>
          <td width="15%"><span class="style56">04</span></td>
          <td width="15%"><span class="style56">&agrave;</span></td>
          <td width="15%"><span class="style56">06</span></td>
          <td><span class="style56">Pouco Eficaz </span></td>
        </tr>
        <tr>
          <td width="15%">07</td>
          <td width="15%">&agrave;</td>
          <td width="15%">08</td>
          <td><span class="style56">Eficaz</span></td>
        </tr>
        <tr>
          <td width="15%"><span class="style56">09</span></td>
          <td width="15%"><span class="style56">&agrave;</span></td>
          <td width="15%"><span class="style56">10</span></td>
          <td><span class="style56">Muito Eficaz </span></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><span class="style17">
      <input name="enviar" id="enviar" type="submit" value="Enviar" />
    </span></td>
  </tr>
</table>
</form>
<hr />
<table width="100%" border="0">
  <tr>
    <td width="86%"><span class="style12">Datamace Inform&aacute;tica Ltda. </span></td>
    <td width="14%"><span class="style48">F25 - Rev 01 </span></td>
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