<? 
include('cabeca.inc.php');

 if ($id) {
   $acao = "enviado";
   $data1 = substr($data1,6,4) . '-' . substr($data1,3,2) . '-' . substr($data1,0,2);
   $data2 = substr($data2,6,4) . '-' . substr($data2,3,2) . '-' . substr($data2,0,2);
   $data3 = substr($data3,6,4) . '-' . substr($data3,3,2) . '-' . substr($data3,0,2);
   $data4 = substr($data4,6,4) . '-' . substr($data4,3,2) . '-' . substr($data4,0,2);
   $data5 = substr($data5,6,4) . '-' . substr($data5,3,2) . '-' . substr($data5,0,2);
   $dataprova = substr($dataprova,6,4) . '-' . substr($dataprova,3,2) . '-' . substr($dataprova,0,2);
   
   $empnome  = strtoupper($empnome);
   $nome  = strtoupper($nome);
   $q1  = strtoupper($q1);
   $q2  = strtoupper($q2);
   $q3  = strtoupper($q3);
   $q4  = strtoupper($q4);
   $q5  = strtoupper($q5);
   $q6  = strtoupper($q6);
   $q7  = strtoupper($q7);
   $q8  = strtoupper($q8);
   $q9  = strtoupper($q9);
   $q10  = strtoupper($q10);
   $q11  = strtoupper($q11);
   $q12  = strtoupper($q12);
   $q13  = strtoupper($q13);
   $q14  = strtoupper($q14);
   $q15  = strtoupper($q15);
   $q16  = strtoupper($q16);
   $q17  = strtoupper($q17);
   $q18  = strtoupper($q18);
   $q19  = strtoupper($q19);
   $q20  = strtoupper($q20);
	
$sSQL = "INSERT into avaliacao1 (empnome, nome, data1, data2, data3, data4, data5, dataprova, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15, q16, q17, q18, q19, q20) VALUES ('$empnome', '$nome', '$data1', '$data2', '$data3', '$data4', '$data5', '$dataprova', '$q1', '$q2', '$q3', '$q4', '$q5', '$q6', '$q7', '$q8', '$q9', '$q10', '$q11', '$q12', '$q13', '$q14', '$q15', '$q16', '$q17', '$q18', '$q19', '$q20');";
  
  
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
