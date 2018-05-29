<?
include_once ('cabeca.inc.php');

 $sSQL = "SELECT  * FROM eficacia where id = $id;";
 $result = mysql_query($sSQL);   
   
 if ($linha = mysql_fetch_object($result)) {
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

?>
<html>
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
-->
</style>
  <script language="JavaScript" type="text/javascript">
function confirma() {
  if (confirm('Tem certeza que deseja enviar os dados ?')) {
    document.form.submit();
  };
}
   </script>
</p>
<form action="reenviaeficacia.php" method="post" name="form" id="form">
  <input type="hidden" name="id" value="1" />
</head>
<body bgcolor="#FFFFFF">
<div align="center"> 
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">


  <div align="center" class="style3"><strong>
    <span class="style16">      Avalia&ccedil;&atilde;o da Efic&aacute;cia de Treinamento<br>
    <br>
    </span></strong></div>
  <table width="70%" border="0" align="center" cellpadding="0">
    <tr>
      <td width="100%"><table border="0" cellpadding="0" width="100%">
        <tr>
          <td width="100%">
<input type="hidden" name="id" value="<? echo $id; ?>">
<input type="hidden" name="data1" value="<? echo $data1; ?>">
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
      <td colspan="3"><span class="style7"><?= $titulo?></span></td>
      </tr>
    <tr bgcolor="#F4F4F4">
      <td><span class="style7"><strong>Entidade:</strong></span></td>
      <td colspan="3"><span class="style7"><?= $entidade?></span></td>
      </tr>
    <tr>
      <td><span class="style7"><strong>Instrutor:</strong></span></td>
      <td colspan="3"><span class="style7"><?= $instrutor?></span></td>
      </tr>
    <tr bgcolor="#F4F4F4">
      <td><span class="style7"><strong>Data de:</strong></span></td>
      <td width="40%"><span class="style7"><?= $data1?> <strong>&agrave;</strong> <?= $data2?></span></td>
      <td width="17%"><span class="style7"><strong>Carga Hor&aacute;ria: </strong></span></td>
      <td width="23%"><span class="style7"><?= $cargahoraria?></span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Avaliador:</strong></span></td>
      <td><span class="style7"><?= $avaliador?></span></td>
      <td valign="baseline"><span class="style7"><strong>&Aacute;rea:</strong></span></td>
      <td><span class="style7"><?= $area?></span></td>
    </tr>
    <tr bgcolor="#F4F4F4">
      <td><span class="style7"><strong>Treinando:</strong></span></td>
      <td><span class="style7"><?= $treinando?></span></td>
      <td valign="baseline"><span class="style7"><strong>Registro:</strong></span></td>
      <td><span class="style7"><?= $registro?></span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Devolver  at&eacute;:</strong></span></td>
      <td>
        
          <span class="style7"><?= $datadevolucao?></span> </td>
      <td valign="baseline"><span class="style7"><strong>Gestor</strong>:</span></td>
      <td><span class="style7"><? echo $nomegestor ?></span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="80%" border="0" align="center">
    <tr>
      <td colspan="2" valign="middle" bgcolor="#006699"><p class="style1 style49 style7"><strong> Grau de aprimoramento adquirido pelo Treinando, quanto a: </strong></p></td>
    </tr>
    <tr>
      <td width="30%"><span class="style7"><strong>Aprendizagem:</strong></span></td>
      <td width="70%"><span class="style7"><?= $aprendizagem ?></span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa:</strong></span></td>
      <td bgcolor="#F4F4F4"><span class="style7"><?= $justaprendizagem ?></span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Aplicabilidade:</strong></span></td>
      <td><span class="style7"><?= $aplicabilidade ?></span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa:</strong></span></td>
      <td bgcolor="#F4F4F4"><span class="style7"><?= $justaplicabilidade ?></span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Comportamento</strong>: </span></td>
      <td><span class="style7"><?= $comportamento ?></span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa</strong>: </span></td>
      <td bgcolor="#F4F4F4"><span class="style7"><?= $justcomportamento ?></span></td>
    </tr>
    <tr>
      <td><span class="style7"><strong>Avalia&ccedil;&atilde;o Geral:</strong></span></td>
      <td><span class="style7"><?= $geral?></span></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4"><span class="style7"><strong>Justificativa:</strong></span></td>
      <td bgcolor="#F4F4F4"><span class="style7"><?= $justgeral?></span></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><table width="38%" border="1">
        <tr>
          <td colspan="4" bgcolor="#006699"><span class="style1 style31"><strong>Legenda</strong></span><span class="style1 style34"></span></td>
        </tr>
        <tr>
          <td width="18%">01</td>
          <td width="11%">&agrave;</td>
          <td width="18%">03</td>
          <td width="53%"><strong>N&atilde;o Eficaz </strong></td>
        </tr>
        <tr>
          <td width="18%">04</td>
          <td width="11%">&agrave;</td>
          <td width="18%">06</td>
          <td><strong>Pouco Eficaz </strong></td>
        </tr>
        <tr>
          <td width="18%">07</td>
          <td width="11%">&agrave;</td>
          <td width="18%">08</td>
          <td><strong>Eficaz</strong></td>
        </tr>
        <tr>
          <td width="18%">09</td>
          <td width="11%">&agrave;</td>
          <td width="18%">10</td>
          <td><strong>Muito Eficaz </strong></td>
        </tr>
        </table>
        <p><span class="style17">
          <span class="style36 style3 style4">
		  
		  <? //* O login dever ser exatamente o usuário da intranet ?> 
          <select name="login_eficacia" class="style7">
            <option value="antonio"> Antonio </option>
            <option value="ariane"> Ariane </option>
            <option value="nomellini"> Fernando</option>												
            <option value="debora"> D&eacute;bora </option>
            <option value="edson"> Edson </option>
            <option value="elis"> Elisangela </option>
            <option value="Helio"> Helio </option>
            <option value="eder"> Eder </option>
            <option value="marcelo.nunes"> Marcelo Nunes </option>
            <option value="ricardo"> Ricardo </option>
            <option value="samuel"> Samuel </option>
            <option value="leandro"> Leandro </option>
          </select>
          </span>
          <input name="enviar" type="button" class="style7" id="enviar" onClick="javascript:confirma()" value="Reenviar" />
        </span></p></td>
    </tr>
    <?
  };
 ?>
  </table>
  <p><a href="javascript:history.go(-1)"></a></p>
  <hr />
  <span class="style12"> </span>
  <p>&nbsp;</p></td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a> 
        <br>
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> 
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>      </td>
    </tr>
  </table>
  </form>
</div>
<p align="center">&nbsp;</p>
</body>
</html>