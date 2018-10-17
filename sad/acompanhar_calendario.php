<?  
require("scripts/conn.php");
  session_start(); 
  
if ($v_id_cliente=="") {
header("Location: doindex.php");
}  
  
$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>SAD - Sistema de Atendimento Datamace</title>


  <link rel="stylesheet" href="include/css.css">

  <script type="text/JavaScript">
<!--



//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>


</head>


<body>
<script>
var largura;
var altura;
var larguara_show;
var altura_show;
largura = screen.width;
altura = screen.height
if(largura<=1000){
	largura_show = "100%";
}
else if(largura>1001 || largura<1600){
	largura_show = "90%"
}

else if (largura>1600){
	largura_show = "1400px";
}

document.write("<div id='layout' align='center' style='width:"+largura_show+";'>");
</script>


<?
$evento=$_GET['evento'];
if ($evento=="1"){
	//header("Location:http://www.datamace.com.br/portalCliente/sad.asp?data=". $_GET['data']);
}else {
echo "";
}
?>

<div id="topo">
  <? include("include/topo.php");?> 
</div>

<div id="data">
 <? include("include/data.php");?>
</div>
<div id="conteudo">


  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="190" valign="top" style="padding-left:5px">
	  <div id="menuPrincipal">
		<link rel="StyleSheet" href="include/dtree.css" type="text/css" />
	<script type="text/javascript" src="include/dtree.js"></script>

		  <? include("include/menu.php");?>		  
      </div>
	  <div>
	  <br>
	   <? include("include/calendario.php");?>
	  </div>
	  </td>
      <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>
            <td height="35" width="100%"><table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="80%"><img src="img/titulo_acompanharcalendario.gif" width="172" height="33"> </td>
                    <td align="right" width="20%"><img src="img/grafismo_titulo.gif" width="103" height="33"> </td>
                  </tr>
                </tbody>
            </table></td>
            <td width="4"><img src="img/spacer.gif" height="5" width="8"></td>
          </tr>
          <tr>
            <td width="6"></td>
            <td class="conteudoSite" align="center" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" align="right"><img src="img/spacer.gif" width="1" height="5"></td>
                </tr>
              <tr>
                <td height="25" align="left" valign="top" class="fundoForms" style="padding:5px"><table width="540" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="334" bgcolor="#0B3685" style="padding-left:4px; color:#FFFFFF; font-weight:bold;">Tabela de Contribui&ccedil;&atilde;o Pr&ecirc;videnci&aacute;ria </td>
                    <td width="266">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding-left:4px; color:#FFFFFF"><img src="img/spacer.gif" width="50" height="2"></td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#999999" style="padding-left:4px; color:#FFFFFF"><p>Para pagamentos efetuados a partir de JANEIRO/2014<br> 
                      (Portaria Interministerial no. 568  - Publica&ccedil;&atilde;o DOU 31/10/2010) </p>                      </td>
                  </tr>
                </table>
                  <table width="540" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #0B3685">
                    <tr>
                      <td colspan="4" align="center" class="tituloAcompanharCalendario">Sal&aacute;rio de Contribui&ccedil;&atilde;o </td>
                      <td align="center" class="tituloAcompanharCalendario">Al&iacute;quota </td>
                      <td align="center" class="tituloAcompanharCalendario">Sal&aacute;rio Fam&iacute;lia </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="center" class="conteudoAcompanharCalendario">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 682,50</td>
                      <td align="right" class="conteudoAcompanharCalendario">8%</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 35,00</td>
                    </tr>
                    <tr>
                      <td width="60" align="center" class="conteudoAcompanharCalendario2">De</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 681,51</td>
                      <td width="60" align="center" class="conteudoAcompanharCalendario2">At&eacute;</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 1025,81</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">8%</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 24,66 </td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario">De</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 1025.82</td>
                      <td align="center" class="conteudoAcompanharCalendario">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 1.317,07 </td>
                      <td align="right" class="conteudoAcompanharCalendario">8%</td>
                      <td align="right" class="conteudoAcompanharCalendario">-</td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario2">De</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 1.317,08 </td>
                      <td align="center" class="conteudoAcompanharCalendario2">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 2.195,12</td>
                      <td align="right" class="conteudoAcompanharCalendario2">9%</td>
                      <td align="right" class="conteudoAcompanharCalendario2">-</td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario">De </td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 2.195,13</td>
                      <td align="center" class="conteudoAcompanharCalendario">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 4.390,24 </td>
                      <td align="right" class="conteudoAcompanharCalendario">11%</td>
                      <td align="right" class="conteudoAcompanharCalendario">-</td>
                    </tr>
                    <tr>
                      <td colspan="6" align="left" class="conteudoAcompanharCalendario2">* Observe que as duas primeiras faixas dessa tabela foram acrescentadas apenas para estabelecer o limite para pagamento do sal&aacute;rio fam&iacute;lia, p&oacute;rem os valores limites e as al&iacute;quotas s&atilde;o os mesmos da tabela estabelecida pela Portaria Interministerial MPS/MF 19/2014. </td>
                    </tr>
                  </table>
                  
				  </td>
                </tr>
              <tr>
                <td height="5" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              <tr>
              
                <td height="25" align="left" class="fundoForms" style="padding:5px"><table width="540" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="334" bgcolor="#0B3685" style="padding-left:4px; color:#FFFFFF; font-weight:bold;">Tabela IR Retido na Fonte</td>
                    <td width="266">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding-left:4px; color:#FFFFFF"><img src="img/spacer.gif" width="50" height="2"></td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#999999" style="padding-left:4px; color:#FFFFFF">Vig&ecirc;ncia de Janeiro/2014 at&eacute; Dezembro/2014 <br> 
                      (Conforme MP n&ordm; 528/2011 convertida na lei 12.469/2011)</td>
                  </tr>                  
                  
                </table>
                
                
                
                  <table width="540" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #0B3685">
                    <tr>
                      <td colspan="4" align="center" class="tituloAcompanharCalendario">Base de C&aacute;lculo Mensal</td>
                      <td align="center" class="tituloAcompanharCalendario">Al&iacute;quota</td>
                      <td align="center" class="tituloAcompanharCalendario">Parcela a deduzir</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="center" class="conteudoAcompanharCalendario">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 1.787,77 </td>
                      <td align="right" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="right" class="conteudoAcompanharCalendario">Isento</td>
                    </tr>
                    <tr>
                      <td width="60" align="center" class="conteudoAcompanharCalendario2">De</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 1.787,78</td>
                      <td width="60" align="center" class="conteudoAcompanharCalendario2">At&eacute;</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 2.679,29</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">7,5%</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 134,08</td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario">De</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 2.679,30</td>
                      <td align="center" class="conteudoAcompanharCalendario">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 3.572,43 </td>
                      <td align="right" class="conteudoAcompanharCalendario">15%</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 335,03</td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario2">De</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 3.572,44</td>
                      <td align="center" class="conteudoAcompanharCalendario2">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 4.464,81</td>
                      <td align="right" class="conteudoAcompanharCalendario2">22,5%</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 602,96 </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="center" class="conteudoAcompanharCalendario">Acima  </td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 4.464,81</td>
                      <td align="right" class="conteudoAcompanharCalendario">27,5%</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 826,15</td>
                    </tr>
                    <tr>
                      <td colspan="5" align="right" class="conteudoAcompanharCalendario2" style="padding-right:5px;">Dedu&ccedil;&atilde;o por Dependente </td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 179,71</td>
                    </tr>
                  </table>
                  
                  
                  <br />
<br />

                  
                  
                  <table width="540" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="334" bgcolor="#0B3685" style="padding-left:4px; color:#FFFFFF; font-weight:bold;">
                    PLR
                    </td>
                    <td width="266">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding-left:4px; color:#FFFFFF"><img src="img/spacer.gif" width="50" height="2"></td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#999999" style="padding-left:4px; color:#FFFFFF">
                    Tabela Exclusiva Para Participação Nos Lucros Ou Resultados (Plr) - Vigência De 01.01 A 31.12.2014
                    Tabela Aplicável Exclusivamente para Participação nos Resultados  (MP 597/2012, convertida na Lei 12.832/2013) e Instrução Normativa RFB 1.433/2013
                     </td>
                  </tr>
                </table>
                  
<table width="540" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #0B3685">
                    <tr>
                      <td colspan="4" align="center" class="tituloAcompanharCalendario">Sal&aacute;rio de Contribui&ccedil;&atilde;o </td>
                      <td align="center" class="tituloAcompanharCalendario">Al&iacute;quota </td>
                      <td align="center" class="tituloAcompanharCalendario">Parcela a deduzir</td>
                    </tr>
                    <tr>
                      <td colspan="2" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="center" class="conteudoAcompanharCalendario">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 6.270,00</td>
                      <td align="right" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="right" class="conteudoAcompanharCalendario">Isento</td>
                    </tr>
                    <tr>
                      <td width="60" align="center" class="conteudoAcompanharCalendario2">De</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 6.270,01</td>
                      <td width="60" align="center" class="conteudoAcompanharCalendario2">At&eacute;</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 9.405,00</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">7,5 %</td>
                      <td width="120" align="right" class="conteudoAcompanharCalendario2">R$ 470,25 </td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario">De</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 9.405,01</td>
                      <td align="center" class="conteudoAcompanharCalendario">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 12.540,00 </td>
                      <td align="right" class="conteudoAcompanharCalendario">15 %</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 1.175,63</td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario2">De</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 12.540,01</td>
                      <td align="center" class="conteudoAcompanharCalendario2">At&eacute;</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 15.675,00</td>
                      <td align="right" class="conteudoAcompanharCalendario2">22,5 %</td>
                      <td align="right" class="conteudoAcompanharCalendario2">R$ 2.116,13</td>
                    </tr>
                    <tr>
                      <td align="center" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="right" class="conteudoAcompanharCalendario">&nbsp;</td>
                      <td align="center" class="conteudoAcompanharCalendario">Acima	</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 15.675,00 </td>
                      <td align="right" class="conteudoAcompanharCalendario">27,5 %</td>
                      <td align="right" class="conteudoAcompanharCalendario">R$ 2.899,88</td>
                    </tr>
                    <tr>
                      <td colspan="6" align="left" class="conteudoAcompanharCalendario2">
                      Nota: Consoante disposto no §6º do art. 3 da Lei 10.101/2000 (incluído pela Lei 12.832/2013), para o cálculo do IRF sobre a PLR não haverá dedução de dependentes e nem de qualquer outra despesa (saúde, educação, previdência privada e etc.), salvo a importância paga a título de pensão alimentícia incidente sobre a PLR (decorrente de determinação judicial), conforme § 10 do mesmo dispositivo legal.
                      </td>
                    </tr>
                  </table>                  
                  
                  
                  
                  </td>
                </tr>
              <tr>
                <td height="5" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              
              
            </table>
              </td>
            <td width="4"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </table>
</div>
<div id="rodape">
<? include("include/rodape.php");?>
</div>

</body>
</html>
