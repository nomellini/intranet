<?
session_start();

/*
// para poll inicio
	$cookie_expire = 96; // hours
	$action = (isset($HTTP_GET_VARS['action'])) ? $HTTP_GET_VARS['action'] : '';
	$action = (isset($HTTP_POST_VARS['action'])) ? $HTTP_POST_VARS['action'] : $action;
	$poll_ident = (isset($HTTP_GET_VARS['poll_ident'])) ? $HTTP_GET_VARS['poll_ident'] : '';
	$poll_ident = (isset($HTTP_POST_VARS['poll_ident'])) ? $HTTP_POST_VARS['poll_ident'] : $poll_ident;
	
	if ($action=="vote" && (isset($HTTP_POST_VARS['option_id']) || isset($HTTP_GET_VARS['option_id']))) {
		$cookie_name = "AdvancedPoll".$poll_ident;
		if (!isset($HTTP_COOKIE_VARS[$cookie_name])) {
			$endtime = time()+3600*$cookie_expire;
			setcookie($cookie_name, "1", $endtime);
		}
	}
	
	$poll_path = "/var/www/default/poll202";
	require $poll_path."/include/config.inc.php";
	require $poll_path."/include/$POLLDB[class]";
	require $poll_path."/include/class_poll.php";
	$CLASS["db"] = new polldb_sql;
	$CLASS["db"]->connect(); 
	$php_poll = new poll();
	$php_poll->set_template_set("plain");	
	$php_poll->set_max_bar_length(125);
	$php_poll->set_max_bar_height(10);	
	
	
	
// para poll fim	
*/
require("a/scripts/conn.php");	  
if ( $v_id_usuario ) {
  $ok = $v_id_usuario;
} else {	

//   if ( (substr($REMOTE_ADDR,0,7)=="10.1.0.")  ) {  
//     header("Location: logar.php"); 
//   } else {   

   if (($REMOTE_ADDR != "200.207.89.99") &&  ($REMOTE_ADDR != "200.189.83.9")  ) {    
 	  if ( isset($id_usuario) ) {
	 	$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	 	if ($ok<>$id_usuario) { header("Location: login.php"); }
	 	setcookie("loginok");  
	   } else {
		 header("Location: login.php");
     }
   }
//    } 
}
if ($ok) {
  $nomeusuario=peganomeusuario($ok);	
 }
?>
<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" --> 
<title>Intranet Datamace</title>
<!-- #EndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
              <div align="left"><a href="http://www.datamace.com.br"><img src="imagens/novologo.jpg" width="155" height="41" border="0">
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
<? 
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(datamace);
 $resp = mysql_query("select count(*) as soma from cxsug;");
 $linha = mysql_fetch_object($resp);
 $sugestoes = $linha->soma;
?>
            <table width="100%" border="0">
              <tr> 
                <td width="5%"> <a href="corporativo/faq.htm"> <img src="/imagens/duvida.gif" width="23" height="35" border="0"> 
                  </a> </td>
                <td width="95%" align="center" valign="middle"> <span class="Titulo"><font color="#FF0033"> 
                  <? if( $nomeusuario ) { print "$nomeusuario, ";}?>
                  Seja bem vindo &agrave; Intranet Datamace 
                  <?if ($ok) { ?>
                  <a href="login.php?logout=true"><font size="2">(Efetuar logout)</font></a> 
                  <?}?>
                  </font> </span> </td>
              </tr>
            </table>
            <table width="90%" border="0" align="center">
              <tr valign="bottom"> 
                <td width="50%" colspan="2" align="center"><a href="rhstudio/index.php"><img src="rhstudio/images/Logo_rh%20Studio_r.jpg" border="0"></a></td>
              </tr>
              <tr valign="bottom"> 
                <td width="50%" align="center"><a href="/agenda/"><img src="agenda/figuras/icone_calendario.JPG" width="55" height="55" border="0">Agenda 
                  corporativa </a></td>
                <td width="50%" align="center"><a href="ISO9001/Qualidade.htm"><img src="imagens/iso9001.jpg" width="66" height="40" border="0"></a><a href="ISO9001/Qualidade.htm">Rumo 
                  a ISO 9000</a></td>
              </tr>
              <tr valign="bottom"> 
                <td align="center"><a href="a/"><img src="a/SADLogo.gif" width="230" height="46" align="middle" border="0"></a></td>
                <td align="center"><a href="http://grhnet.datamace.com.br/grhnet"><br>
                  <img src="/imagens/rhweb.gif" width="91" height="46" border="0"></a></td>
              </tr>
              <tr valign="bottom"> 
                <td colspan="2">&nbsp; </td>
              </tr>
            </table>
            <br>
            <table id=menu width="98%"  border="0" cellspacing="0" cellpadding="0" align="center">
              <tr align="center"> 
                <td height="12"><font size="1">&nbsp;</font></td>
                <td><font size="1"><a href="javascript:aba1(1);">Importante</a></font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1"><a href="javascript:aba1(2);">Destaques</a></font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1"><a href="javascript:aba1(3);">Corporativo/Projetos</a></font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1"><a href="javascript:aba1(4);">Estrutura/Apoio</a></font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1">&nbsp;</font></td>
                <td><font size="1"><a href="javascript:aba1(5);">Aniversariantes</a></font></font></td>
                <td><font size="1">&nbsp;</font></td>
              </tr>
            </table>
            <span id="tab1"> 
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
              <tr> 
                <td align="left" valign="top" bgcolor="#FFFFFF"> <div align="left"></div>
                  <ul>
                    <li> 
                      <div align="left"><font color="#FF0000"><strong>Terminal 
                        Services</strong></font><br>
                        <a href="http://10.1.0.51/tsweb">Rede Interna - http://10.1.0.51/tsweb</a><br>
                        <a href="http://200.207.89.99/tsweb">Rede Externa - 
                        http://200.207.89.99/tsweb</a> </div>
                    </li>
                    <li><font face="Verdana, Arial, Helvetica, sans-serif"><a href="/a/versao/index.php">Libera&ccedil;&atilde;o 
                      de Release</a></font></li>
                    <li> 
                      <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif"><b>GrhNet 
                        :</b>- Para acessar de casa o GrhNet deve-se digitar 
                        o seguinte na barra de endere&ccedil;os: <font color="#0000FF"><a href="http://grhnet.datamace.com.br">http://grhnet.datamace.com.br</a></font></font> 
                      </div>
                    </li>
                    <li><font face="Verdana, Arial, Helvetica, sans-serif">Para 
                      Acessar da rede interna, o endere&ccedil;o &eacute; :<font color="#0000FF"><br>
                      <a href="http://10.1.0.51/grhnet">http://10.1.0.51/grhnet</a></font></font> 
                    </li>
                    <li><font face="Verdana, Arial, Helvetica, sans-serif"><font color="#999999"><a href="projetos/cobol/errorme.htm">Tabela 
                      de erros de run-time (RTS)</a></font></font> </li>
                    <li> <font face="Verdana, Arial, Helvetica, sans-serif"><a href="versao32bits.html">Vers&atilde;o 
                      32 bits</a></font></li>
                    <li><a href="noticia/FTPDOS.htm"><font color="#000099" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>FTP 
                      pelo DOS</strong></font></a></li>
                    <li><a href="/corporativo/org.htm">Estrutura Organizacional 
                      Datamace</a></li>
                    <li> <a href="http://200.153.222.207/tsweb"><b>RHDTM na 
                      Dipraxis</b></a></li>
                  </ul></td>
              </tr>
            </table>
            </span> <span id="tab2"> 
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
              <tr valign="top"> 
                <td colspan="2" bgcolor="#FFFFFF"> <table width="100%" border="0" align="center">
                    <tr valign="top" align="left"> 
                      <td colspan="2" height="92"> <ul>
                            <li><b><a href="/phorum/list.php?f=1">Caixa de Sugest&otilde;es 
                              (DTM F&oacute;rum)</a> </b><font size="-6" face="Verdana, Arial, Helvetica, sans-serif"> 
                              ( <?echo $sugestoes?> mensagens) </font> 
                              <ul>
                                <li><a href="/corporativo/cxsug/regras.htm"><font size="1">Regras 
                                  e defini&ccedil;&otilde;es da Caixa de sugest&otilde;es.</font></a></li>
                              </ul>
                            </li>
                            <li> 
                              <div align="left"><a href="corporativo/Inforvirus.htm"><b><font color="#FF0000"><font size="2"><i>Cuidado 
                                </i></font></font></b></a><b><font color="#FF0000"><font size="2"><i><br>
                                </i></font></font></b><a href="corporativo/Inforvirus.htm"><b><font color="#FF0000">Informa&ccedil;&otilde;es 
                                sobre V&iacute;rus</font></b></a><br>
                              </div>
                            </li>
                            <li>
                              <div align="left"><a href="corporativo/Inforspam.htm"><strong><font color="#FF0000">Informa&ccedil;&otilde;es 
                                sobre SPAM</font></strong></a> <img src="/imagens/novo.gif" width="45" height="15"><br>
                              </div>
                            </li>
                            <li><b><a href="http://www.datamace.com.br">Novo Site 
                              DATAMACE</a></b></li>
                          </ul></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            </span> <span id="tab3"> 
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" valign="top"> <table width="100%" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                    <tr > 
                      <td class="TabelaRotulo"><b>Corporativo</b></td>
                    </tr>
                    <tr bgcolor="#FFFFFF" valign="top"> 
                      <td bgcolor="#FFFFFF"> <ul>
                          <li><a href="/corporativo/index.php"><font size="1">Informa&ccedil;&otilde;es 
                            a respeito da empresa, sempre atualizadas. Saiba 
                            tudo que &eacute; importante</font></a>.<br>
                          </li>
                        </ul></td>
                    </tr>
                  </table></td>
                <td width="50%" valign="top"> <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#FFFFFF">
                    <tr bgcolor="#CC0000"> 
                      <td class="TabelaRotulo" height="18"><b>Projetos</b></td>
                    </tr>
                    <tr bgcolor="#FFFFFF" valign="top"> 
                      <td> <ul>
                          <li><font size="1"><a href="/projetos/index.htm">Saiba 
                            sobre os projetos <br>
                            Delphi, Cobol, Intranet e RhStudio</a></font></li>
                        </ul></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            </span> <span id="tab4"> 
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" valign="top"> <table width="100%" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                    <tr bgcolor="#3333FF"> 
                      <td class="TabelaRotulo"><b>Estrutura</b></td>
                    </tr>
                    <tr bgcolor="#FFFFFF" valign="top"> 
                        <td> <ul>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/estrutura/index.php">Informa&ccedil;&otilde;es 
                              sobre a rede e sobre as instala&ccedil;&otilde;es. 
                              Para uso t&eacute;cnico.</a></font></li>
                            <li><font color="#0000FF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/estoque/consulta_estoque.php">Estoque 
                              de pe&ccedil;as de reposi&ccedil;&atilde;o</a></font></li>
                            <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="/corporativo/ramais.PDF">Lista 
                              de ramais para impress&atilde;o</a></font><img src="/imagens/novo.gif" width="45" height="15"><br>
                            </li>
                          </ul></td>
                    </tr>
                  </table></td>
                <td width="50%" valign="top"> <table width="100%" border="1" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                    <tr bgcolor="#339900"> 
                      <td class="TabelaRotulo"><b>Apoio</b></td>
                    </tr>
                    <tr bgcolor="#FFFFFF" valign="top"> 
                      <td> <ul>
                          <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="Apoio/index.php">Informa&ccedil;&otilde;es 
                            de apoio ao funcion&aacute;rio Datamace.</a></font></li>
                          <li><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="Apoio/links.html"> 
                            Links diversos</a> </font></li>
                        </ul></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            </span> <span id="tab5"> 
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#BDDEF0">
              <tr> 
                <td align="center" valign="top" bgcolor="#FFFFFF"> <br> 
                  <?
 $agora = getdate(time());
 $diahoje = $agora["mday"];
 $mesatual = $agora["mon"];

// mysql_select_db(datamace);
 $sSQL = "SELECT nome, mes, dia FROM funcionarios  Where  mes = " . $mesatual . " ORDER BY dia;"; 

 $result = mysql_query($sSQL);           
?>
                  <table width="50%" border="0" bgcolor="#000000">
                    <tr class="TabelaRotulo"> 
                      <td width="79%">Nome</td>
                      <td width="21%" align="center">Dia</td>
                    </tr>
                    <?
                   while ($linha = mysql_fetch_object($result)) {
                   $nome = $linha->nome;
                   $dia = $linha->dia;
                ?>
                    <tr class="TabelaPadrao"> 
                      <td width="79%"> 
                        <?
if ($diahoje == $dia) {
  echo "<img src=\"/imagens/aniv1.gif\"> - ";
};

?>
                        <?echo $nome?> </td>
                      <td width="21%" align="center"> <?echo $dia?> </td>
                    </tr>
                    <? 
                     }
                 ?>
                  </table>
                  <br> <table width=276 border=0 cellpadding=0 cellspacing=0>
                    <tr> 
                      <td rowspan=3 align="left" valign="top" width=9><img src="http://www.estadao.com.br/img/manchetes/ticker_esq.gif" width=9 height=25 vspace=0 hspace=0></td>
                      <td bgcolor="#FFCC00"><img src="http://www.estadao.com.br/img/dotclear.gif" width=258 height=1 vspace=0 hspace=0></td>
                      <td rowspan=3 align="right" valign="top" width=9><img src="http://www.estadao.com.br/img/manchetes/ticker_dir.gif" width=9 height=25 hspace=0 vspace=0></td>
                    </tr>
                    <tr> 
                      <td align="center"><a href="http://www.estadao.com.br/agestado/"><img src="http://www.estadao.com.br/redacao1/MarqueeD.gif" width=235 height=23 border=0></a></td>
                    </tr>
                    <tr> 
                      <td bgcolor="#FFCC00"><img src="http://www.estadao.com.br/img/dotclear.gif" width=258 height=1 vspace=0 hspace=0></td>
                    </tr>
                  </table>
                  <br> </td>
              </tr>
            </table>
            </span>
			  <span id=tab6>
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td valign="middle"> <br>
                  <? 
					//echo $php_poll->poll_process(5);
					?> 
					</td>
              </tr>
            </table>
</span>			  
            <script>
 function ativaAba( tab, x ) {

var tabela = tab;
var posE, posD, porC, ancora, final
final = Math.ceil((( 1 + tabela.rows[0].cells.length ) / 3 ));
   
for ( var i = 1; i < final ; i++ ) {
  posE = (i-1) * 3;
	posD = posE + 2;
	posC = posE + 1;		
			
	tabela.rows[0].cells[posD].style.width = "10";
	tabela.rows[0].cells[posE].style.width = "12";		
	
	var ok = false;
	for (var j=0; j<tabela.rows[0].cells[posC].all.length; j++) {
   if (tabela.rows[0].cells[posC].all(j).tagName == 'A') {
	   ancora = tabela.rows[0].cells[posC].all(j)     ;
	   ancora.style.fontSize=11;
	   ok = true;
	 }
  }
	
	
	if ( x == i ) {  // Ativo		
  	if (ok) {
       ancora.style.color = "#0000ff";	
		 //ancora.style.color = "#0000ff";	
		 ancora.style.textDecoration = 'none';		
		}
		if (i!=1) { 
  		tabela.rows[0].cells[posE].innerHTML = "<img src=\"../files/ativo_esq1.gif\">";
		} else {
     		tabela.rows[0].cells[posE].innerHTML = "<img src=\"../files/ativo_esq.gif\">";
		}		
		
		if (i==(final-1)) {		
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/ativo_dir1.gif\">";
		} else {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/ativo_dir.gif\">";
		}

	    	
  	tabela.rows[0].cells[posE].style.backgroundColor = '#BDDEF0';
      tabela.rows[0].cells[posC].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
  } else { // Inativo	
	  if (ok) {
      ancora.style.color = "#0000FF";	
		ancora.style.textDecoration = 'none';
	  }
	    if ( i==1) {
        tabela.rows[0].cells[posE].innerHTML = '<img src=\"../files/ativo_esq.gif\">';
		} else {
		  tabela.rows[0].cells[posE].innerHTML = '<img src=\"../files/inativo_esq.gif\">';
		}
		
		if (i==(final-1)) {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/inativo_dir1.gif\">";   		
		} else {
        tabela.rows[0].cells[posD].innerHTML = "<img src=\"../files/inativo_dir.gif\">";		
		}

		tabela.rows[0].cells[posC].style.backgroundColor = "#e1e1e1"
      tabela.rows[0].cells[posE].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;				
	}		
}  
}  

function ativa(value) {
var a;
for (a=1; a<tabs.length; a++) {
  if (a==value) {
    tabs[a].style.display='';
  } else {
    tabs[a].style.display='none';
  }
}
}


var linhaAtiva = 0;
var tabs = new Array;
tabs[1] = tab1;
tabs[2] = tab2;
tabs[3] = tab3;      
tabs[4] = tab4; 
tabs[5] = tab5;   

function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
 item.style.display='';
 sp.innerHTML  = i2;
 } else {
 item.style.display='none'
 sp.innerHTML  = i1;
 }
}  


aba1(1);

function aba1(x) {
 ativaAba(menu, x); 
 ativa(x);
}
</script>
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
                                   <td class="TabelaPadrao"><a href="corporativo/mapadosite/mapasite.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Mapa
                                     do site</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="ISO9001/Documentos/D04.PDF"><font face="Verdana, Arial, Helvetica, sans-serif">Organograma</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="assistencia/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Assist&ecirc;ncia
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
                                   <td class="TabelaPadrao"><a href="corporativo/feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes
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
                                   <td class="TabelaPadrao"><a href="corporativo/escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="corporativo/Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es
                                     sobre v&iacute;rus</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="colaboradores/index.htm">Colaboradores</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="saude/" target="_blank">Sa&uacute;de e Qualidade de vida</a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao"><a href="eventos.htm">Eventos Datamace</a></td>
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
                                    <td height="16" bgcolor="#CC9900" class="TabelaRotulo"><a href="estrutura/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Estrutura</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" height="9"><a href="/estrutura/rede.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Rede</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="estrutura/micros.php"><font face="Verdana, Arial, Helvetica, sans-serif">n&ordm;
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
                                   <td class="TabelaRotulo" valign="top"><a href="Apoio/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Apoio</font></a></td>
                                 </tr>
                                 <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                   <td class="TabelaPadrao" valign="top"><a href="Apoio/emails.php"><font face="Verdana, Arial, Helvetica, sans-serif">E-mails</font></a></td>
                                 </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="Apoio/links.html"><font face="Verdana, Arial, Helvetica, sans-serif">Links</font></a></td>
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
                                    <td class="TabelaRotulo"><a href="entretenimento/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Entretenimento</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="entretenimento/filmes/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Videoteca</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="entretenimento/livros/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Biblioteca</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="/entretenimento/enquetes.php"><font face="Verdana, Arial, Helvetica, sans-serif">Enquetes</font></a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="entretenimento/mural.htm">Mural
                                      de an&uacute;ncios</a></td>
                                  </tr>
                                </table>
                                <table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaRotulo" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="treinamento/treinamento.php">Treinamento</a></font></td>
                                  </tr>

                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao" valign="top"><a href="treinamento">Portal</a></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr valign="top">
                              <td><table width="100%" border="0" class="bgTabela">
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaRotulo"><a href="Intersystem/index.htm">Intersystem</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="Intersystem/compromisso.htm">Compromisso</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="Intersystem/dadosintersystem.htm">Dados
                                      da empresa</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="Intersystem/missao.htm">Miss&atilde;o</a></td>
                                  </tr>
                                  <tr bgcolor="#CC9900" bordercolor="#CC9900">
                                    <td class="TabelaPadrao"><a href="Intersystem/servicosclientes.htm">Servi&ccedil;os</a></td>
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
</body>
<!-- #EndTemplate --></html>

