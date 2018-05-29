<? 
include('cabeca.inc.php');

 if ($id) {
   $acao = "enviado";
   $data1 = substr($data1,6,4) . '-' . substr($data1,3,2) . '-' . substr($data1,0,2);
   $data2 = substr($data2,6,4) . '-' . substr($data2,3,2) . '-' . substr($data2,0,2);
   $datadevolucao = substr($datadevolucao,6,4) . '-' . substr($datadevolucao,3,2) . '-' . substr($datadevolucao,0,2);
    
   $justaprendizagem = strtoupper($justaprendizagem);
   $justaplicabilidade = strtoupper($justaplicabilidade);
   $justcomportamento = strtoupper($justcomportamento);
   $justgeral = strtoupper($justgeral);
   
    $sSQL = "UPDATE into eficacia   (aprendizagem, justaprendizagem, aplicabilidade, justaplicabilidade, comportamento, justcomportamento, geral, justgeral) VALUES ('$aprendizagem', '$justaprendizagem', '$aplicabilidade', '$justaplicabilidade', '$comportamento', '$justcomportamento', '$geral', '$justgeral');"; 
   
   if(! mysql_query($sSQL)) {
      $acao = mysql_error()." não foi enviado";
   }else {
      $acao = "foi enviado";
	}  
 }

 ?>

<html>
<!-- DW6 -->
<head>
 
<title>Datamace Informática</title>
 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 18px; font-weight: normal; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style3 {color: #000099}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
  <tr>
    <td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
  </tr>
</table>
<div align="center"> 
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">


<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;}
-->
</style>
<p>&nbsp;</p><p align="center"><b> <? echo "formulário $acao" ?></b> com sucesso !<br>
                <br>
                <br>
            Clique <a href="/treinamento/portal.php">aqui</a> para voltar ao menu principal.</p></td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a> 
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
