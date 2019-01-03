<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');

	 $sSQL = "SELECT count(evento) as tot_a1 from avaliatre as aval
     where month(data) = '01' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO'  and flagTipo = '2'";
	 $result1 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result1);
	 $tot_a1 = $linha->tot_a1;

     $sSQL = "SELECT count(evento) as tot_a2 from avaliatre as aval
     where month(data) = '02' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2' ";
	 $result2 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result2);
	 $tot_a2 = $linha->tot_a2;

     $sSQL = "SELECT count(evento) as tot_a3 from avaliatre as aval
     where month(data) = '03' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result3 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result3);
	 $tot_a3 = $linha->tot_a3;

	 $sSQL = "SELECT count(evento) as tot_a4 from avaliatre as aval
     where month(data) = '04' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result4 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result4);
	 $tot_a4 = $linha->tot_a4;

	 $sSQL = "SELECT count(evento) as tot_a5 from avaliatre as aval
     where month(data) = '05' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result5 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result5);
	 $tot_a5 = $linha->tot_a5;

	 $sSQL = "SELECT count(evento) as tot_a6 from avaliatre as aval
     where month(data) = '06' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result6 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result6);
	 $tot_a6 = $linha->tot_a6;

	 $sSQL = "SELECT count(evento) as tot_a7 from avaliatre as aval
     where month(data) = '07' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result7 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result7);
	 $tot_a7 = $linha->tot_a7;

	 $sSQL = "SELECT count(evento) as tot_a8 from avaliatre as aval
     where month(data) = '08' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result8 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result8);
	 $tot_a8 = $linha->tot_a8;

	 $sSQL = "SELECT count(evento) as tot_a9 from avaliatre as aval
     where month(data) = '09' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result9 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result9);
	 $tot_a9 = $linha->tot_a9;

	 $sSQL = "SELECT count(evento) as tot_a10 from avaliatre as aval
     where month(data) = '10' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result10 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result10);
	 $tot_a10 = $linha->tot_a10;

	 $sSQL = "SELECT count(evento) as tot_a11 from avaliatre as aval
     where month(data) = '11' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result11 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result11);
	 $tot_a11 = $linha->tot_a11;

	 $sSQL = "SELECT count(evento) as tot_a12 from avaliatre as aval
     where month(data) = '12' and year(data) = $ano and evento = 'FOLHA DE PAGAMENTO' and flagTipo = '2'  ";
	 $result12 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result12);
	 $tot_a12 = $linha->tot_a12;

     $sSQL = "SELECT count(evento) as tot_b1 from avaliatre as aval
     where month(data) = '01' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result13 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result13);
	 $tot_b1 = $linha->tot_b1;

     $sSQL = "SELECT count(evento) as tot_b2 from avaliatre as aval
     where month(data) = '02' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result14 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result14);
	 $tot_b2 = $linha->tot_b2;

     $sSQL = "SELECT count(evento) as tot_b3 from avaliatre as aval
     where month(data) = '03' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result15 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result15);
	 $tot_b3 = $linha->tot_b3;

	 $sSQL = "SELECT count(evento) as tot_b4 from avaliatre as aval
     where month(data) = '04' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result16 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result16);
	 $tot_b4 = $linha->tot_b4;

	 $sSQL = "SELECT count(evento) as tot_b5 from avaliatre as aval
     where month(data) = '05' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result17 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result17);
	 $tot_b5 = $linha->tot_b5;

	 $sSQL = "SELECT count(evento) as tot_b6 from avaliatre as aval
     where month(data) = '06' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result18 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result18);
	 $tot_b6 = $linha->tot_b6;

	 $sSQL = "SELECT count(evento) as tot_b7 from avaliatre as aval
     where month(data) = '07' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result19 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result19);
	 $tot_b7 = $linha->tot_b7;

	 $sSQL = "SELECT count(evento) as tot_b8 from avaliatre as aval
     where month(data) = '08' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result20 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result20);
	 $tot_b8 = $linha->tot_b8;

	 $sSQL = "SELECT count(evento) as tot_b9 from avaliatre as aval
     where month(data) = '09' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result21 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result21);
	 $tot_b9 = $linha->tot_b9;

	 $sSQL = "SELECT count(evento) as tot_b10 from avaliatre as aval
     where month(data) = '10' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result22 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result22);
	 $tot_b10 = $linha->tot_b10;

	 $sSQL = "SELECT count(evento) as tot_b11 from avaliatre as aval
     where month(data) = '11' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result23 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result23);
	 $tot_b11 = $linha->tot_b11;

	 $sSQL = "SELECT count(evento) as tot_b12 from avaliatre as aval
     where month(data) = '12' and year(data) = $ano and evento = 'PONTO ELETRÔNICO' and flagTipo = '2'  ";
	 $result24 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result24);
	 $tot_b12 = $linha->tot_b12;


     $sSQL = "SELECT count(evento) as tot_c1 from avaliatre as aval
     where month(data) = '01' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES       		
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2' ";
	 $result25 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result25);
	 $tot_c1 = $linha->tot_c1;

     $sSQL = "SELECT count(evento) as tot_c2 from avaliatre as aval
     where month(data) = '02' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES   
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result26 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result26);
	 $tot_c2 = $linha->tot_c2;
	 
     $sSQL = "SELECT count(evento) as tot_c3 from avaliatre as aval
     where month(data) = '03' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES   
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result27 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result27);
	 $tot_c3 = $linha->tot_c3;

	 $sSQL = "SELECT count(evento) as tot_c4 from avaliatre as aval
     where month(data) = '04' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result28 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result28);
	 $tot_c4 = $linha->tot_c4;

	 $sSQL = "SELECT count(evento) as tot_c5 from avaliatre as aval
     where month(data) = '05' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result29 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result29);
	 $tot_c5 = $linha->tot_c5;

	 $sSQL = "SELECT count(evento) as tot_c6 from avaliatre as aval
     where month(data) = '06' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result30 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result30);
	 $tot_c6 = $linha->tot_c6;

	 $sSQL = "SELECT count(evento) as tot_c7 from avaliatre as aval
     where month(data) = '07' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result31 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result31);
	 $tot_c7 = $linha->tot_c7;

	 $sSQL = "SELECT count(evento) as tot_c8 from avaliatre as aval
     where month(data) = '08' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result32 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result32);
	 $tot_c8 = $linha->tot_c8;

	 $sSQL = "SELECT count(evento) as tot_c9 from avaliatre as aval
     where month(data) = '09' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result33 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result33);
	 $tot_c9 = $linha->tot_c9;

	 $sSQL = "SELECT count(evento) as tot_c10 from avaliatre as aval
     where month(data) = '10' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result34 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result34);
	 $tot_c10 = $linha->tot_c10;

	 $sSQL = "SELECT count(evento) as tot_c11 from avaliatre as aval
     where month(data) = '11' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
	 $result35 = mysql_query($sSQL);
	 $linha = mysql_fetch_object($result35);
	 $tot_c11 = $linha->tot_c11;

	 $sSQL = "SELECT count(evento) as tot_c12 from avaliatre as aval
     where month(data) = '12' and year(data) = $ano and evento in ('CARGOS E SALÁRIOS' , 'RECRUTAMENTO E SELEÇÃO' , 'TREINAMENTO E     COMPETÊNCIA' , 'SEGURANÇA E TRABALHO' , 'MEDICINA OCUPACIONAL' , 'AVALIAÇÃO E DESEMPENHO' , 'SERVIÇO SOCIAL' , 'RELAÇÕES 
	 TRABALHISTAS' , 'ORÇAMENTO PESSOAL' , 'COMPETÊNCIAS' , 'DESEMPENHO E CARREIRA') and flagTipo = '2'  ";
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<div align="center"> 
  <p>Relat&oacute;rio totalizador por alunos</p>
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">

	          <strong>
              </strong>
	          <div align="center" class="style11">

                <table width="98%" border="0">
				<form name="form" method="post" action="reltotaluno.php" id="form">
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
			  
			   $a1 = ( $tot_a1  + $tot_a1b );
			   $b1 = ( $tot_b1  + $tot_b1b );
			   $c1 = ( $tot_c1  + $tot_c1b );
			   
			   $a2 = ( $tot_a2  + $tot_a2b );
			   $b2 = ( $tot_b2  + $tot_b2b );
			   $c2 = ( $tot_c2  + $tot_c2b );
			   
			   $a3 = ( $tot_a3  + $tot_a3b );
			   $b3 = ( $tot_b3  + $tot_b3b );
			   $c3 = ( $tot_c3  + $tot_c3b );
			   
			   $a4 = ( $tot_a4  + $tot_a4b );
			   $b4 = ( $tot_b4  + $tot_b4b );
			   $c4 = ( $tot_c4  + $tot_c4b );
			   
			   $a5 = ( $tot_a5  + $tot_a5b );
			   $b5 = ( $tot_b5  + $tot_b5b );
			   $c5 = ( $tot_c5  + $tot_c5b );
			   
			   $a6 = ( $tot_a6  + $tot_a6b );
			   $b6 = ( $tot_b6  + $tot_b6b );
			   $c6 = ( $tot_c6  + $tot_c6b );
			   
			   $a7 = ( $tot_a7  + $tot_a7b );
			   $b7 = ( $tot_b7  + $tot_b7b );
			   $c7 = ( $tot_c7  + $tot_c7b );
			   
			   $a8 = ( $tot_a8  + $tot_a8b );
			   $b8 = ( $tot_b8  + $tot_b8b );
			   $c8 = ( $tot_c8  + $tot_c8b );
			   
			   $a9 = ( $tot_a9  + $tot_a9b );
			   $b9 = ( $tot_b9  + $tot_b9b );
			   $c9 = ( $tot_c9  + $tot_c9b );
			   
			   $a10 = ( $tot_a10 + $tot_a10b );
			   $b10 = ( $tot_b10 + $tot_b10b );
			   $c10 = ( $tot_c10 + $tot_c10b );
			   
			   $a11 = ( $tot_a11 + $tot_a11b );
			   $b11 = ( $tot_b11 + $tot_b11b );
			   $c11 = ( $tot_c11 + $tot_c11b );
			   
			   $a12 = ( $tot_a12 + $tot_a12b );
			   $b12 = ( $tot_b12 + $tot_b12b );
			   $c12 = ( $tot_c12 + $tot_c12b );
			   
			   $a = ( $a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11 + $a12 );
			   $b = ( $b1 + $b2 + $b3 + $b4 + $b5 + $b6 + $b7 + $b8 + $b9 + $b10 + $b11 + $b12 );
			   $c = ( $c1 + $c2 + $c3 + $c4 + $c5 + $c6 + $c7 + $c8 + $c9 + $c10 + $c11 + $c12 );
			   
			   $tot_jan = ( $a1 + $b1 + $c1 );
			   $tot_fev = ( $a2 + $b2 + $c2 );
			   $tot_mar = ( $a3 + $b3 + $c3 );
			   $tot_abr = ( $a4 + $b4 + $c4 );
			   $tot_mai = ( $a5 + $b5 + $c5 );
			   $tot_jun = ( $a6 + $b6 + $c6 );
			   $tot_jul = ( $a7 + $b7 + $c7 );
			   $tot_ago = ( $a8 + $b8 + $c8 );
			   $tot_set = ( $a9 + $b9 + $c9 );
			   $tot_out = ( $a10 + $b10 + $c10 );
			   $tot_nov = ( $a11 + $b11 + $c11 );
			   $tot_dez = ( $a12 + $b12 + $c12 );
			   
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
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b1  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c1 "?></strong></div></td>
                  <td width="22%" bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_jan"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">FEVEREIRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a2 "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b2  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c2  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_fev"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">MAR&Ccedil;O</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a3  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b3  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c3  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_mar"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">ABRIL</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a4  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b4  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c4  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_abr"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">MAIO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a5  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b5  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c5  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_mai"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">JUNHO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a6  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b6  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c6  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_jun"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">JULHO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a7  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b7  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c7  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_jul"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">AGOSTO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a8  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b8  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c8  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_ago"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">SETEMBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a9  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b9  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c9  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_set"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">OUTUBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a10  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b10  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c10  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_out"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">NOVEMBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a11  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b11  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c11  "?></strong></div></td>
                  <td bgcolor="#DBF0EE" class="style11"><div align="center"><span class="style27"><? echo " $tot_nov"?></span></div></td>
                </tr>
                <tr>
                  <td width="12%" bgcolor="#006699"><span class="style14">DEZEMBRO</span></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $a12  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $b12  "?></strong></div></td>
                  <td bgcolor="#DBF0EE"><div align="center"><strong><? echo " $c12  "?></strong></div></td>
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
              <p>&nbsp;</p></td>
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