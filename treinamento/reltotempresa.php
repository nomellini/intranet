<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');

	 $sSQL = "SELECT  count(distinct empnome)AS tot_a1 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '01' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result1 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result1);
	 $tot_a1 = $linha->tot_a1;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a1a FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '01' and year(data) = $ano and modulo = '1' and 
	 empnome = 'DESENVOLVIMENTO PROFISSIONAL'
     order by modulos.descricao";
	 $resulta1 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($resulta1);
	 $tot_a1a = $linha->tot_a1a;
     
	 

	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a2 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '02' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result2 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result2);
	 $tot_a2 = $linha->tot_a2;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a3 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '03' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result3 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result3);
	 $tot_a3 = $linha->tot_a3;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a4 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '04' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result4 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result4);
	 $tot_a4 = $linha->tot_a4;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a5 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '05' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result5 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result5);
	 $tot_a5 = $linha->tot_a5;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a6 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '06' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result6 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result6);
	 $tot_a6 = $linha->tot_a6;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a7 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '07' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result7 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result7);
	 $tot_a7 = $linha->tot_a7;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a8 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '08' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result8 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result8);
	 $tot_a8 = $linha->tot_a8;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a9 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '09' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result9 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result9);
	 $tot_a9 = $linha->tot_a9;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a10 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '10' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result10 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result10);
	 $tot_a10 = $linha->tot_a10;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a11 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '11' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result11 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result11);
	 $tot_a11 = $linha->tot_a11;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_a12 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '12' and year(data) = $ano and modulo = '1'
          order by modulos.descricao";
	 $result12 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result12);
	 $tot_a12 = $linha->tot_a12;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b1 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '01' and year(data) = $ano and modulo = '4'
     order by modulos.descricao";
	 $result13 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result13);
	 $tot_b1 = $linha->tot_b1;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b2 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '02' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result14 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result14);
	 $tot_b2 = $linha->tot_b2;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b3 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '03' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result15 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result15);
	 $tot_b3 = $linha->tot_b3;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b4 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '04' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result16 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result16);
	 $tot_b4 = $linha->tot_b4;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b5 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '05' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result17 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result17);
	 $tot_b5 = $linha->tot_b5;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b6 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '06' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result18 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result18);
	 $tot_b6 = $linha->tot_b6;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b7 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '07' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result19 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result19);
	 $tot_b7 = $linha->tot_b7;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b8 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '08' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result20 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result20);
	 $tot_b8 = $linha->tot_b8;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b9 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '09' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result21 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result21);
	 $tot_b9 = $linha->tot_b9;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b10 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '10' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result22 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result22);
	 $tot_b10 = $linha->tot_b10;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b11 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '11' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result23 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result23);
	 $tot_b11 = $linha->tot_b11;
	 
	 $sSQL = "SELECT  count(distinct empnome)AS tot_b12 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '12' and year(data) = $ano and modulo = '4'
          order by modulos.descricao";
	 $result24 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result24);
	 $tot_b12 = $linha->tot_b12;

	 $sSQL = "SELECT count( DISTINCT empnome ) AS tot_c1
	 FROM cadastrotreinamento c
     JOIN tre_usuario t ON t.rg = c.rg
     JOIN modulos ON modulos.id = t.modulo
     WHERE month( 
     DATA ) = '01' AND year( 
     DATA ) =2007 AND modulo
     IN ('5', '6', '7', '8', '9', '10', '17', '23', '24')
     ORDER BY modulos.descricao ";
	 $result25 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result25);
	 $tot_c1 = $linha->tot_c1;
	 
	 $sSQL = "SELECT count(  DISTINCT empnome )  AS tot_c2
     FROM cadastrotreinamento c
     JOIN tre_usuario t ON t.rg = c.rg
     JOIN modulos ON modulos.id = t.modulo
     WHERE month( 
     DATA  )  =  '02' AND year( 
     DATA  )  =  $ano AND modulo in ('16','19','20','21','22','23','24','25','26' )
     ORDER  BY modulos.descricao";
	 $result26 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result26);
	 $tot_c2 = $linha->tot_c2;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c3 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '03' and year(data) = $ano and modulo in     
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result27 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result27);
	 $tot_c3 = $linha->tot_c3;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c4 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '04' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result28 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result28);
	 $tot_c4 = $linha->tot_c4;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c5 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '05' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
	 order by modulos.descricao";
	 $result29 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result29);
	 $tot_c5 = $linha->tot_c5;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c6 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '06' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result30 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result30);
	 $tot_c6 = $linha->tot_c6;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c7 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '07' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result31 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result31);
	 $tot_c7 = $linha->tot_c7;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c8 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '08' and year(data) = $ano and modulo in  
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result32 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result32);
	 $tot_c8 = $linha->tot_c8;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c9 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '09' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result33 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result33);
	 $tot_c9 = $linha->tot_c9;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c10 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '10' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result34 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result34);
	 $tot_c10 = $linha->tot_c10;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c11 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '11' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result35 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result35);
	 $tot_c11 = $linha->tot_c11;
	 
	 $sSQL = "SELECT count(distinct empnome)AS tot_c12 FROM
     cadastrotreinamento c join tre_usuario t on t.rg=c.rg
     join modulos on modulos.id = t.modulo
     where month(data) = '12' and year(data) = $ano and modulo in 
	 ('16','19','20','21','22','23','24','25','26' )
     order by modulos.descricao";
	 $result36 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result36);
	 $tot_c12 = $linha->tot_c12;

?>

<html>
<!-- DW6 -->
<head>
 
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style5 {font-size: 9px}
.style11 {font-weight: bold}
.style12 {color: #000000; font-size: 12px;}
.style14 {color: #FFFFFF; font-weight: bold; }
.style27 {color: #999999; font-weight: bold; }
-->
</style>
<script>
function confirma(){ 
 	if (document.form.ano.value < 2000){ 
       alert("Ano deve ser maior que 2000") 
	   document.form.ano.focus();
	   return false; 
	   }
 	if (!document.form.ano.value){ 
       alert("Deve preencher o campo ano") 
	   document.form.ano.focus();
	   return false; 
	   }
else {
       document.form.submit();
} }	   
</script>
</head>
<body bgcolor="#FFFFFF">
<div align="center">Relat&oacute;rio totalizador por empresas </div>
<div align="center">
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">

	          <strong>
              </strong>
	          <div align="center" class="style11">

                <table width="98%" border="0"> <br>
                <form name="form" method="post" action="reltotempresa.php" id="form">
                  <tr bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
                    <td align="center" valign="middle" bgcolor="#DBF0EE"><div align="left">
                     
                        <font face="Verdana, Arial, Helvetica, sans-serif" size="1">Ano</font>
                        <input name="ano" type="text" class="style5" id="ano" value="<? echo "$ano" ?>" 
						size="4" maxlength="4"/>
                        <label></label>
                        <input name="Submit" type="button" class="style5" onClick="javascript:confirma()" value="procura" >
                      
                            </div></td>
                  </tr>
                  <tr>
                  </tr>
				  </form>
                </table>
              </div>
			  
			  <? 
			  
			  
			   $a1 = ( $tot_a1 - $tot_a1a);
			   
			   $a = ( $a1 + $tot_a2 + $tot_a3 + $tot_a4 + $tot_a5 + $tot_a6 + $tot_a7 + $tot_a8 + $tot_a9 + $tot_a10 + $tot_a11 + $tot_a12 );
			   $b = ( $tot_b1 + $tot_b2 + $tot_b3 + $tot_b4 + $tot_b5 + $tot_b6 + $b7 + $tot_b8 + $tot_b9 + $tot_b10 + $tot_b11 + $tot_b12 );
			   $c = ( $tot_c1 + $tot_c2 + $tot_c3 + $tot_c4 + $tot_c5 + $tot_c6 + $c7 + $tot_c8 + $tot_c9 + $tot_c10 + $tot_c11 + $tot_c12 );
			   
			   $tot_jan = ( $a1 + $tot_b1 + $tot_c1 );
			   $tot_fev = ( $tot_a2 + $tot_b2 + $tot_c2 );
			   $tot_mar = ( $tot_a3 + $tot_b3 + $tot_c3 );
			   $tot_abr = ( $tot_a4 + $tot_b4 + $tot_c4 );
			   $tot_mai = ( $tot_a5 + $tot_b5 + $tot_c5 );
			   $tot_jun = ( $tot_a6 + $tot_b6 + $tot_c6 );
			   $tot_jul = ( $tot_a7 + $tot_b7 + $tot_c7 );
			   $tot_ago = ( $tot_a8 + $tot_b8 + $tot_c8 );
			   $tot_set = ( $tot_a9 + $tot_b9 + $tot_c9 );
			   $tot_out = ( $tot_a10 + $tot_b10 + $tot_c10 );
			   $tot_nov = ( $tot_a11 + $tot_b11 + $tot_c11 );
			   $tot_dez = ( $tot_a12 + $tot_b12 + $tot_c12 );
			   
			   $tot_tot = ( $a + $b + $c );
						 
			  ?>
			  
              <table width="98%" border="0" align="center" class="style12">
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">Meses</span></td>
                  <td width="22%" bgcolor="#006699"><div align="center" class="style14">GIP</div></td>
                  <td width="22%" bgcolor="#006699"><div align="center" class="style14">PONTO</div></td>
                  <td width="22%" bgcolor="#006699"><div align="center" class="style14">RH</div></td>
                  <td width="22%" bgcolor="#006699"><div align="center"><span class="style1"><strong>Totais</strong></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">JANEIRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a1 "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b1  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c1 "?></strong></div></td>
                  <td width="22%" bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_jan"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">FEVEREIRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a2 "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b2  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c2  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_fev"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">MAR&Ccedil;O</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a3  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b3  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c3  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_mar"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">ABRIL</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a4  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b4  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c4  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_abr"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">MAIO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a5  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b5  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c5  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_mai"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">JUNHO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a6  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b6  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c6  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_jun"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">JULHO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a7  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b7  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c7  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_jul"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">AGOSTO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a8  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b8  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c8  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_ago"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">SETEMBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a9  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b9  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c9  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_set"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">OUTUBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a10  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b10  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c10  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_out"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">NOVEMBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a11  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b11  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c11  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_nov"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">DEZEMBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_a12  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_b12  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $tot_c12  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_dez"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style1"><strong>Totais</strong></span></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center" class="style27"><? echo " $a"?></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center" class="style27"><? echo " $b"?></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center" class="style27"><? echo " $c"?></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_tot"?></span></div></td>
                </tr>
              </table>
              <table width="98%" border="0" align="center">
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
            <hr>            <p>&nbsp;</p></td>
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
