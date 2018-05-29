<?
include_once ('cabeca.inc.php');

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '01' and year(data) = $ano and modulo = '1' ";
	 $result1 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result1);
	 $tot_a1 = $linha->tot_a1;

     $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '02' and year(data) = $ano and modulo = '1' ";
	 $result2 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result2);
	 $tot_a2 = $linha->tot_a2;

     $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '03' and year(data) = $ano and modulo = '1' ";
	 $result3 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result3);
	 $tot_a3 = $linha->tot_a3;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '04' and year(data) = $ano and modulo = '1' ";
	 $result4 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result4);
	 $tot_a4 = $linha->tot_a4;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '05' and year(data) = $ano and modulo = '1' ";
	 $result5 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result5);
	 $tot_a5 = $linha->tot_a5;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '06' and year(data) = $ano and modulo = '1' ";
	 $result6 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result6);
	 $tot_a6 = $linha->tot_a6;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '07' and year(data) = $ano and modulo = '1' ";
	 $result7 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result7);
	 $tot_a7 = $linha->tot_a7;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '08' and year(data) = $ano and modulo = '1' ";
	 $result8 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result8);
	 $tot_a8 = $linha->tot_a8;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '09' and year(data) = $ano and modulo = '1' ";
	 $result9 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result9);
	 $tot_a9 = $linha->tot_a9;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '10' and year(data) = $ano and modulo = '1' ";
	 $result10 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result10);
	 $tot_a10 = $linha->tot_a10;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '11' and year(data) = $ano and modulo = '1' ";
	 $result11 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result11);
	 $tot_a11 = $linha->tot_a11;

	 $sSQL = "SELECT count(modulo) as tot_a1 from tre_usuario as aval
     where month(data) = '12' and year(data) = $ano and modulo = '1' ";
	 $result12 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result12);
	 $tot_a12 = $linha->tot_a12;

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Relat&oacute;rio por alunos</title>
<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
<script>
function confirma(){ 
 	if (!document.form.ano.value < 2000){ 
       alert("O ano tem que ser superior a 2000") 
	   document.form.ano.focus();
	   return false; 
	   }

 	if (!document.form.ano.value){ 
       alert("Deve preencher o campo ano") 
	   document.form.ano.focus();
	   return false; 
	   }1
else {
       document.form.submit();
} }	   
</script>
</head>

<body>
<form name="form" method="post" action="reltotaluno.php" id="form">
<font face="Verdana, Arial, Helvetica, sans-serif" size="1">Ano</font>
                        <input name="ano" type="text" class="style5" id="ano" value="<? echo "$ano"?>" size="5"/>
                        <label></label>
                        <input name="Submit" type="button" class="style5" onClick="javascript:confirma()" value="procura" >
                         

</form>
<p>&nbsp;</p>
<table width="100%" border="1">
  <tr>
    <td width="10%" bgcolor="#006699"><span class="style3">Meses</span></td>
    <td width="25%" bgcolor="#006699"><div align="center" class="style3">GIP</div></td>
    <td width="37%" bgcolor="#006699"><div align="center" class="style3">Ponto</div></td>
    <td width="14%" bgcolor="#006699"><div align="center" class="style3">RH</div></td>
    <td width="14%" bgcolor="#006699"><div align="center" class="style3">Totais</div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Janeiro</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a1 "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b1  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c1 "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Fevereiro</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a2 "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b2  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c2  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Mar&ccedil;o</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a3  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b3  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c3  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Abril</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a4  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b4  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c4  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Maio</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a5  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b5  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c5  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Junho</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a6  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b6  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c6  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Julho</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a7  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b7  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c7  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Agosto</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a8  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b8  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c8  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Setembro</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a9  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b9  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c9  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Outubro</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a10  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b10  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c10  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Novembro</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a11  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b11  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c11  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Dezembro</span></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_a12  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_b12  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"><strong><?echo " $tot_c12  "?></strong></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
  <tr>
    <td bgcolor="#006699"><span class="style3">Totais</span></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
    <td bgcolor="#DBF0EE"><div align="center"></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
