<?
include_once ('cabeca.inc.php');

 $sSQL = "SELECT * FROM sad.treinados where id = $id ";
 if (!$result = mysql_query($sSQL)) echo "<br><br>Problema na tabela treinados</b><br>";
 
	$linha = mysql_fetch_object($result);
	$cliente = $linha->cliente;
	$sistema = $linha->sistema;
	$nome = $linha->nome;
	$cargo = $linha->cargo;
	$conceito = $linha->conceito;
	$data = $linha->data;
	$rg = $linha->rg;
      
	$data = substr($data,8,2) . '-' . substr($data,5,2) . '-' . substr($data,0,4);
	
	$result = mysql_query("SELECT descricao FROM treinamento.modulos where cod_sistema = '$sistema' ");
	$linha = mysql_fetch_object($result);
	$desc_sistema = $linha->descricao;
?>
<html>

<head>
 
<title>Datamace Informática</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-size: 9px;
	font-weight: bold;
}
.style10 {color: #006699}
.style18 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style19 {font-size: 9px; font-weight: bold; }
.style20 {font-size: 9px}
.style21 {
	color: #FF0000;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center"> 
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF"> 
              <div align="center"><span class="style10"><strong> Treinando Cadastrado no SAD</strong></span></div>
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
                <tr bgcolor="#006699">
                  <td colspan="2" scope="col"><span class="style1"> Cadastro Pessoal </span></td>
    </tr>
                <tr>
                  <td valign="baseline"><div align="left" class="style19">RG:</div></td>
      <td><span class="style20"><?echo $rg
?></span> </td>
    </tr>
                <tr>
                  <td width="16%" valign="baseline"><div align="left" class="style19"><strong>Nome:</strong></div></td>
      <td width="84%"><span class="style18"><span class="style20"><?echo $nome?></span></span></td>
    </tr>
                <tr>
                  <td valign="baseline"><div align="left" class="style19"><strong>Cargo:</strong></div></td>
      <td><span class="style18"><span class="style20">
	  <? echo $cargo
?></span></span></td>
    </tr>
                <tr>
                  <td valign="baseline"><div align="left" class="style19"><strong>Cliente: </strong></div></td>
      <td><span class="style18"><span class="style20">
	  <? echo $cliente
?></span></span></td>
    </tr>
                <tr>
                  <td valign="baseline"><div align="left" class="style19"><strong>Sistema: </strong></div></td>
      <td><span class="style18"><span class="style20">
	  <? echo $desc_sistema
?></span></span></td>
    </tr>
                <tr>
                  <td valign="baseline"><div align="left" class="style19"><strong>Conceito: </strong></div></td>
      <td><span class="style18"><span class="style20">
	  <? echo $conceito
?></span></span></td>
    </tr>
                <tr>
                  <td valign="baseline"><div align="left" class="style19"><strong>Data: </strong></div></td>
      <td><span class="style18"><span class="style20">
	  <? echo $data
?></span></span></td>
    </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"></a> 
        <br>
        <hr align="center">
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> 
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>      </td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>