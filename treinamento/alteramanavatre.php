<? 
include('cabeca.inc.php');

if ($id) {

	$tipo = strtoupper($tipo);
	$evento = strtoupper($evento);
	$local = strtoupper($local);
	$data = resolveData($data);
	$complemento = strtoupper($complemento);

	$set = "";
	if ($flagAvaliadoObs){
		$set = ", flagAvaliadoObs = '" . $flagAvaliadoObs . "'";
	}
	if ($flagAvaliadoSug){
		$set .= ", flagAvaliadoSug = '" . $flagAvaliadoSug . "'";
	}
	if ($flagAvaliadoElo){
		$set .= ", flagAvaliadoElo = '" . $flagAvaliadoElo . "'";
	}
	if ($flagAvaliadoRec){
		$set .= ", flagAvaliadoRec = '" . $flagAvaliadoRec . "'";
	}

   $sSQL = "update avaliatre set tipo='$tipo', evento='$evento', ava_ins_id='$instrutor', local='$local', data='$data', complemento='$complemento' $set where id = $id";
   if(!mysql_query($sSQL)) {
      $acao = "N�O foi alterado!";
   }else {
      $acao = "foi alterado com sucesso!";
	}  
 }

 ?>

<html>
<head>
 
<title>Datamace Inform�tica</title>
 
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
<p>&nbsp;</p>
<p align="center"><b> <? echo "formul�rio $acao" ?></b><br>
                <br>
                <br>
Clique <a href="/treinamento/treinamento.php">aqui</a> para voltar ao menu principal.</p>
<p align="center">
  
</p></td>
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