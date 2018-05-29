<?
include_once ('cabeca.inc.php');

 $sSQL = "SELECT  * FROM eficacia where id = $id;";
 $result = mysql_query($sSQL);   
   
 while ($linha = mysql_fetch_object($result)) {
      $id = $linha->id;
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
  $datadevolucao  = substr($datadevolucao ,8,2) . '-' . substr($datadevolucao ,5,2) . '-' . substr($datadevolucao ,0,4);

?><html>
<!-- DW6 -->
<head>
 
<title>Datamace Informática</title>
<style type="text/css">
<!--
.style4 {font-size: 10pt}
-->
</style>
<style type="text/css">
<!--
.style6 {font-size: 10}
-->
</style> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #000099}
.style7 {font-size: 9px}
.style8 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;}
-->
</style>

<script language="JavaScript" src="numero.js" type="text/javascript"></script>
<script language="JavaScript" src="cep.js" type="text/javascript"></script>
<script language="JavaScript" src="telefone.js" type="text/javascript"></script>
<script language="JavaScript" src="newpopcalendar.js" type="text/javascript"></script>
<script language="JavaScript" src="data.js" type="text/javascript"></script>
<script>
function confirma(){ 
    if (confirm('Tem certeza que deseja enviar os dados ?'))  {
       document.form.acao.value="alterar";
       document.form.submit();
    }
} 

function excluir() {
  if (confirm('Tem certeza que deseja excluir os dados ?'))
 {
    document.form.acao.value="excluir";
	document.form.submit();
  }
}
</script>
</head>
<body bgcolor="#FFFFFF">
<div align="center"> 
<form action="maneficacia_cadastro.php" method="post" name="form" id="form" >
<input type="hidden" name="acao">
<input type="hidden" name="id" value="<? echo $id; ?>">
  <table width="100%" border="0">
    <tr> 
      <td valign="top"><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">


  <div align="center" class="style3"><strong>
    <span class="style16">      Manuten&ccedil;&atilde;o da Avalia&ccedil;&atilde;o da Efic&aacute;cia de Treinamento<br>
    <br>
    </span></strong></div>
  <table width="70%" border="0" align="center" cellpadding="0">
    <tr>
      <td width="100%"><table border="0" cellpadding="0" width="100%">
        <tr>
          <td width="100%">
</td>
        </tr>
        </table></td>
    </tr>
  </table>
  <table width="80%" border="0" align="center">
    <tr>
      <td colspan="4" valign="baseline" bgcolor="#006699" class="style48 style47"><span class="style1 style7"><strong>Dados do treinamento: </strong></span></td>
    </tr>
    <tr>
      <td width="20%"><span class="style7"><strong>T&iacute;tulo:</strong></span></td>
      <td colspan="3"><input name="titulo" type="text" class="style7" id="titulo" value="<? echo $titulo ?>" size="50">        </td>
      </tr>
    <tr bgcolor="#F4F4F4">
      <td><span class="style7"><strong>Entidade:</strong></span></td>
      <td colspan="3"><span class="style7">
        <input name="entidade" type="text" class="style7" id="entidade" value="<? echo $entidade  ?>" size="50">
      </span></td>
      </tr>
    <tr>
      <td><span class="style7"><strong>Instrutor:</strong></span></td>
      <td colspan="3"><span class="style7">
        <input name="instrutor" type="text" class="style7" id="instrutor" value="<? echo $instrutor ?> " size="50">
      </span></td>
      </tr>
    <tr bgcolor="#F4F4F4">
      <td><span class="style7"><strong>Data de:</strong></span></td>
      <td width="41%"><span class="style7">
        <input name="data1" type="text" class="style7" id="data1" value="<? echo $data1 ?> " size="21"> 
        <strong>&agrave;</strong>
        <input name="data2" type="text" class="style7" id="data2" value="<? echo $data2 ?> " size="21">
      </span></td>
      <td width="16%"><span class="style7"><strong>Carga Hor&aacute;ria: </strong></span></td>
      <td width="23%"><span class="style7">
        <input name="cargahoraria" type="text" class="style7" id="cargahoraria" value="<? echo $cargahoraria ?>" size="40">
      </span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Avaliador:</strong></span></td>
      <td><span class="style7">
        <input name="avaliador" type="text" class="style7" id="avaliador" value="<? echo $avaliador ?>" size="50">
      </span></td>
      <td valign="baseline"><span class="style7"><strong>&Aacute;rea:</strong></span></td>
      <td><span class="style7">
        <input name="area" type="text" class="style7" id="area" value="<? echo $area ?>" size="40">
      </span></td>
    </tr>
    <tr bgcolor="#F4F4F4">
      <td><span class="style7"><strong>Treinando:</strong></span></td>
      <td><span class="style7">
        <input name="treinando" type="text" class="style7" id="treinando" value="<? echo $treinando ?>" size="50">
      </span></td>
      <td valign="baseline"><span class="style7"><strong>Registro:</strong></span></td>
      <td><span class="style7">
        <input name="registro" type="text" class="style7" id="registro" value="<? echo $registro ?>" size="40">
      </span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Devolver  at&eacute;:</strong></span></td>
      <td><input name="datadevolucao" type="text" class="style7" id="datadevolucao" value="<? echo $datadevolucao ?>" size="50"></td>
      <td valign="baseline"><span class="style7"><strong>Gestor</strong>:</span></td>
      <td><span class="style7">
        <input name="nomegestor" type="text" class="style7" id="nomegestor" value="<? echo $nomegestor ?>" size="40">
      </span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="80%" border="0" align="center">
    <tr>
      <td colspan="2" valign="middle" bgcolor="#006699"><p class="style1 style49 style7"><strong> Grau de aprimoramento adquirido pelo Treinando, quanto a: </strong></p></td>
    </tr>
    <tr>
      <td width="30%"><span class="style7"><strong>Aprendizagem:</strong></span></td>
      <td width="70%"><span class="style7">
        <input name="aprendizagem" type="text" class="style7" id="aprendizagem" value="<? echo $aprendizagem ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa:</strong></span></td>
      <td bgcolor="#F4F4F4"><span class="style7">
        <input name="justaprendizagem" type="text" class="style7" id="justaprendizagem" value="<? echo $justaprendizagem ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Aplicabilidade:</strong></span></td>
      <td><span class="style7">
        <input name="aplicabilidade" type="text" class="style7" id="aplicabilidade" value="<? echo $aplicabilidade ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa:</strong></span></td>
      <td bgcolor="#F4F4F4"><span class="style7">
        <input name="justaplicabilidade" type="text" class="style7" id="justaplicabilidade" value="<? echo $justaplicabilidade ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Comportamento</strong>: </span></td>
      <td><span class="style7">
        <input name="comportamento" type="text" class="style7" id="comportamento" value="<? echo $comportamento ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa</strong>: </span></td>
      <td bgcolor="#F4F4F4"><span class="style7">
        <input name="justcomportamento" type="text" class="style7" id="justcomportamento" value="<? echo $justcomportamento ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Avalia&ccedil;&atilde;o Geral:</strong></span></td>
      <td><span class="style7">
        <input name="geral" type="text" class="style7" id="geral" value="<? echo $geral ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa:</strong></span></td>
      <td bgcolor="#F4F4F4"><span class="style7">
        <input name="justgeral" type="text" class="style7" id="justgeral" value="<? echo $justgeral ?>" size="50">
      </span></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <?
  };
 ?>
  </table>
  <p><a href="javascript:history.go(-1)"></a>
    <input name="Altera" type="button" class="style8" id="Altera" onClick="javascript:confirma()" value="Alterar" />
    <input name="exclui" type="button" class="style8" id="exclui" onClick="javascript:excluir()" value="Excluir" />
  </p>
  </td>
        </tr>
        </table>
  </form>

        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a> 
        <br>
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> 
      Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>      </td>
    </tr>
</div>
<p align="center">&nbsp;</p>
</body>
</html>