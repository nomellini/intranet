<?  require("../cabeca.php");?>
<!-- #BeginEditable "php" --> 

<!-- #EndEditable -->
<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" --> 

<title>Escolaridade</title>

<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<style type="text/css">
<!--
.style2 {font-size: 9px}
-->
</style><style type="text/css">
<!--
.style4 {
	font-size: 12pt;
	font-weight: bold;
}
-->
</style>
<style type="text/css">
<!--
.style12 {color: #000000}
-->
</style>
<style type="text/css">
<!--
.style13 {font-size: 8pt}
-->
</style>
<style type="text/css">
<!--
.style14 {font-size: 9pt}
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
              <p align="center"><a href="index.php">Corporativo</a> :<font color="#999999"> 
                Escolaridade</font></p>
                                      <?
 mysql_connect('localhost', 'sad', 'data1371');
 mysql_select_db('datamace');
 
   if ($ordem=="") { $ordem="nome";};
   $sSQL = "select * from escolaridade where area = 'Diretoria' order by $ordem, nome"; 
   if (!$result = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
      if (!$linha = mysql_fetch_object($result)) {
      echo "<br><br>não consigo pegar o objeto</b><br>";
   }
   $result = mysql_query($sSQL); 
   
   
   
   if ($ordem=="") { $ordem="nome";};
   $sSQL = "select * from escolaridade where area = 'Sistemas' order by $ordem, nome"; 
   if (!$result1 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
    $result1 = mysql_query($sSQL); 
   
   
    $sSQL = "select * from escolaridade where area = 'T.I.' order by $ordem, nome"; 
    if (!$result2 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
      if (!$linha = mysql_fetch_object($result2)) {
      echo "<br><br>não consigo pegar o objeto1</b><br>";
   }
   $result2= mysql_query($sSQL);       
   
   
   
   $sSQL = "select * from escolaridade where area = 'Consultoria' order by $ordem, nome"; 
   if (!$result3 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result3 = mysql_query($sSQL);        


   
    $sSQL = "select * from escolaridade where area = 'Treinamento' order by $ordem, nome"; 
   if (!$result4 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result4= mysql_query($sSQL);        



    $sSQL = "select * from escolaridade where area = 'Marketing' order by $ordem, nome"; 
    if (!$result5 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result5= mysql_query($sSQL); 


   
    $sSQL = "select * from escolaridade where area = 'Administr' order by $ordem, nome"; 
    if (!$result6 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result6= mysql_query($sSQL); 


   
    $sSQL = "select * from escolaridade where area = 'Talentos' order by $ordem, nome"; 
    if (!$result7 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result7= mysql_query($sSQL); 

   
       $sSQL = "select * from escolaridade where area = 'Juridico' order by $ordem, nome"; 
    if (!$result8 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result8= mysql_query($sSQL); 

       $sSQL = "select * from escolaridade where area = 'Ouvidoria' order by $ordem, nome"; 
    if (!$result9 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result9= mysql_query($sSQL); 
   
       $sSQL = "select * from escolaridade where area = 'Pós Venda' order by $ordem, nome"; 
    if (!$result10 = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela escolaridade</b><br>";
   };
   $result10= mysql_query($sSQL); 

   
 ?>
			  Clique <a href="alterarescolaridade.php">aqui</a> para cadastrar um colaborador
			  <table width="100%" border="1" bordercolor="#006699">
                <tr>
                  <td colspan="6"><div align="center"><span class="style4">Datamace</span></div></td>
                </tr>
                <tr>
                  <td width="13%" height="10%" align="center" valign="middle" bgcolor="#C4E6E2"><span class="style3 style3 style3"><strong>&Aacute;REA</strong></span></td>
                  <td width="40%" align="center" valign="middle" bgcolor="#C4E6E2"><span class="style3 style3 style3"><strong>NOME</strong></span></td>
                  <td width="10%" align="center" valign="middle" bgcolor="#C4E6E2"><span class="style3 style3"><span class="style12 xl28 style3 style3 style3" style="border-left:none;width:54pt"><strong>AT&Eacute; 
                  SEG.GRAU</strong></span></span></td>
                  <td width="13%" align="center" valign="middle" bgcolor="#C4E6E2"><span class="style3 style3"><span class="style12 xl29 style3 style3 style3" style="border-left:none;width:77pt"><strong>EM GRADUA&Ccedil;&Atilde;O</strong></span></span></td>
                  <td width="12%" align="center" valign="middle" bgcolor="#C4E6E2"><span class="style3 style3 style3"><strong> GRADUADO</strong></span></td>
                  <td width="12%" align="center" valign="middle" bgcolor="#C4E6E2"><span class="style3 style3"><span class="style12 xl29 style3 style3 style3" style="border-left:none;width:62pt"><strong>P&Oacute;S 
                  GRADUADO</strong></span></span></td>
                </tr>

                <tr>
                  <td height="10%" colspan="6" bgcolor="#FFFFFF" class=xl24 style3 style='border-top:none;border-left:none' style12>&nbsp;</td>
                </tr>
                <tr>
                                    <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style='border-top:none;border-left:none' style12><span class="style14 style13 style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Diretoria</strong></span></td>                  
                </tr>				
				<?
				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';
				  $grau = '0';
				  
			      while ($linha = mysql_fetch_object($result)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
				  
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  
				  $tot_geral1 = $tot_segrau;
				  $tot_geral2 = $tot_emgrad;
				  $tot_geral3 = $tot_grad;
				  $tot_geral4 = $tot_posgra;
				  
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <span class="style3 style3"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
				<? } 
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				?>
                <tr bgcolor="#EFEFEF">
                  <td width="13%" height=10% bgcolor="#C4E6E2" class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td bgcolor="#C4E6E2" class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Sistemas</strong></span></td>                  
                </tr>				
				<?
				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';
				  $grau = '0';
				  
  				  while ($linha = mysql_fetch_object($result1)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
				  
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}

				  $tot_geral5 = ($tot_segrau + $tot_geral1);
				  $tot_geral6 = ($tot_emgrad + $tot_geral2);
				  $tot_geral7 = ($tot_grad   + $tot_geral3);
				  $tot_geral8 = ($tot_posgra + $tot_geral4);
				  
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?> &nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
				<? } 
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				?>

                <tr bgcolor="#EFEFEF">
                  <td width="13%" height=10% bgcolor="#C4E6E2" class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td bgcolor="#C4E6E2" class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style3 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>T.I.</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';
				  while ($linha = mysql_fetch_object($result2)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral9 = ($tot_segrau  + $tot_geral5);
				  $tot_geral10 = ($tot_emgrad + $tot_geral6);
				  $tot_geral11 = ($tot_grad   + $tot_geral7);
				  $tot_geral12 = ($tot_posgra + $tot_geral8);				  
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?> &nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
				<? } 
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				?>

                <tr bgcolor="#EFEFEF">
                  <td width="13%" height=10% bgcolor="#C4E6E2" class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td bgcolor="#C4E6E2" class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=17 colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Consultoria</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';
			  
				  while ($linha = mysql_fetch_object($result3)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral13 =  ($tot_segrau + $tot_geral9);
				  $tot_geral14 = ($tot_emgrad  + $tot_geral10);
				  $tot_geral15 = ($tot_grad    + $tot_geral11);
				  $tot_geral16 = ($tot_posgra  + $tot_geral12);
				  
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
				<? } 
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				?>

                <tr bgcolor="#EFEFEF">
                  <td width="13%" height=10% bgcolor="#C4E6E2" class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td bgcolor="#C4E6E2" class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Treinamento</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';
				  while ($linha = mysql_fetch_object($result4)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral17 = ($tot_segrau + $tot_geral13);
				  $tot_geral18 = ($tot_emgrad + $tot_geral14);
				  $tot_geral19 = ($tot_grad   + $tot_geral15);
				  $tot_geral20 = ($tot_posgra + $tot_geral16);

				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
				<? } 
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				?>

                <tr bgcolor="#C4E6E2">
                  <td width="13%" height=10% class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style3 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Marketing</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';
				  while ($linha = mysql_fetch_object($result5)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  
				  $tot_geral21 = ($tot_segrau + $tot_geral17);
				  $tot_geral22 = ($tot_emgrad + $tot_geral18);
				  $tot_geral23 = ($tot_grad   + $tot_geral19);
				  $tot_geral24 = ($tot_posgra + $tot_geral20);
				  

				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
				<? } 
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				?>
                <tr bgcolor="#C4E6E2">
                  <td width="13%" height=10% class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style3 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Administra&ccedil;&atilde;o</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';

				  while ($linha = mysql_fetch_object($result6)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral25 = ($tot_segrau + $tot_geral21);
				  $tot_geral26 = ($tot_emgrad + $tot_geral22);
				  $tot_geral27 = ($tot_grad   + $tot_geral23);
				  $tot_geral28 = ($tot_posgra + $tot_geral24);
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
				<? } 
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				
				?>
                <tr bgcolor="#C4E6E2">
                  <td width="13%" height=10% class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style3 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Jur&iacute;dico</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';

				  while ($linha = mysql_fetch_object($result8)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral29 = ($tot_segrau + $tot_geral25);
				  $tot_geral30 = ($tot_emgrad + $tot_geral26);
				  $tot_geral31 = ($tot_grad   + $tot_geral27);
				  $tot_geral32 = ($tot_posgra + $tot_geral28);
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
                  <? } 

				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				  ?>
                <tr bgcolor="#C4E6E2">
                  <td width="13%" height=10% class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style3 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Ouvidoria</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';

				  while ($linha = mysql_fetch_object($result9)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral33 = ($tot_segrau + $tot_geral29);
				  $tot_geral34 = ($tot_emgrad + $tot_geral30);
				  $tot_geral35 = ($tot_grad   + $tot_geral31);
				  $tot_geral36 = ($tot_posgra + $tot_geral32);
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
<? } ?>
				  <?
				  
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}
				?>
                <tr bgcolor="#C4E6E2">
                  <td width="13%" height=10% bgcolor="#C4E6E2" class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td bgcolor="#C4E6E2" class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style3 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>Talentos Humanos</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';

				  while ($linha = mysql_fetch_object($result7)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral37 = ($tot_segrau + $tot_geral33);
				  $tot_geral38 = ($tot_emgrad + $tot_geral34);
				  $tot_geral39 = ($tot_grad   + $tot_geral35);
				  $tot_geral40 = ($tot_posgra + $tot_geral36);
				  
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
<? } ?>
				  <?

				  
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}

				  ?>
                <tr bgcolor="#C4E6E2">
                  <td width="13%" height=10% class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>
<tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10%" colspan="6" bgcolor="#C4E6E2" class=xl24 style3 style3 style3 style='border-top:none;border-left:none' style12><span class="style3 style3 style3 xl24" style="border-top:none;border-left:none"><strong>P&oacute;s Venda</strong></span></td>                  
                </tr>				
				<?
  				  $tot_segrau = '0';
				  $tot_emgrad = '0';
				  $tot_grad   = '0';
				  $tot_posgra = '0';

				  while ($linha = mysql_fetch_object($result10)) {
				  $id         = $linha->id;
				  $area       = $linha->area;
				  $nome       = $linha->nome;
				  $grau       = $linha->grau;
  				  $segrau = '';
				  if($grau == '1')
				  $segrau  =  '1';
				  $emgrad = '';
				  if($grau == '2')
				  $emgrad  =  '1';
			      $grad = '';
				  if($grau == '3')
				  $grad    =  '1';
				  $posgra = '';
				  if($grau == '4')
				  $posgra  =  '1';
				  if($grau == "1"){
				  $tot_segrau = ($tot_segrau  +1);}
				  if($grau == "2"){
				  $tot_emgrad = ($tot_emgrad +1);}
				  if($grau == "3"){
				  $tot_grad = ($tot_grad+1);}
				  if($grau == "4"){
				  $tot_posgra = ($tot_posgra +1);}
				  $tot_geral41 = ($tot_segrau + $tot_geral37);
				  $tot_geral42 = ($tot_emgrad + $tot_geral38);
				  $tot_geral43 = ($tot_grad   + $tot_geral39);
				  $tot_geral44 = ($tot_posgra + $tot_geral40);
				  
				?>
                <tr>
                  <td width="13%" height="10%" bgcolor="#DBF0EE" class=style12 style3 style3 style='border-top:none;border-left:none' xl24>&nbsp;</td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'><span class="xl24 style3 style3" style="border-top:none;border-left:none"><? echo "<a href=alterarescolaridade.php?id=$id>$nome</a>" ?></span></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$segrau" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$emgrad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$grad" ?>&nbsp;</div></td>
                  <td bgcolor="#DBF0EE" class=xl24 style='border-top:none;border-left:none'>
				    <div align="center" class="style3 style3"><? echo "$posgra" ?>&nbsp;</div></td>
                </tr>
<? } ?>
				  <?
				  $tot_gerala = $tot_geral41;
				  $tot_geralb = $tot_geral42;
				  $tot_geralc = $tot_geral43;
				  $tot_gerald = $tot_geral44;
				  			  
				  if ($tot_segrau == "0"){
				  $tot_segrau = "-";}
				  if ($tot_emgrad == "0"){
				  $tot_emgrad = "-";}
				  if ($tot_grad == "0"){
				  $tot_grad = "-";}
				  if ($tot_posgra == "0"){
				  $tot_posgra = "-";}

				  ?>
                <tr bgcolor="#C4E6E2">
                  <td width="13%" height=10% class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais</strong></span></td>
                  <td class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C2:C13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_segrau" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D2:D13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_emgrad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E2:E13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_grad" ?></strong></span></div></td>
                  <td class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F2:F13)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_posgra" ?></strong></span></div></td>
                </tr>				
				
                <tr>
                  <td height=10% colspan="6" class=style1 style3 style3 style='height:12.75pt;border-top:none'>&nbsp;</td>
                </tr>
                <tr bgcolor="#CCCCCC">
                  <td width="13%" height=10% bgcolor="#C4E6E2" class=xl31 style='height:12.75pt;border-top:none'><span class="style3 style3 style3"><strong>Totais DTM</strong></span></td>
                  <td bgcolor="#C4E6E2" class=xl24 style3 style3 style='border-top:none;border-left:none'>&nbsp;</td>

                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(C14,C24,C39,C44,C49)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_gerala" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(D14,D24,D39,D44,D49)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_geralb" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(E14,E24,E39,E44,E49)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_geralc" ?></strong></span></div></td>
                  <td bgcolor="#C4E6E2" class=xl25 style='border-top:none;border-left:none' x:num
  x:fmla="=SUM(F14,F24,F39,F44,F49)"><div align="center" class="style3 style3"><span class="xl24" style="border-top:none;border-left:none"><strong><? echo "$tot_gerald" ?></strong></span></div></td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <p align="center">&nbsp;</p>
              <p align="center">&nbsp;</p>
              <p align="center">&nbsp;</p>
              <p align="center">&nbsp;</p>
              <p align="center">&nbsp;              </p>
              <p align="center">&nbsp;</p>
               
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

