<?
  session_start();
  require("../a/scripts/conn.php");
  require("../verifica.php");	  
  if ( $v_id_usuario ) {
    $ok = $v_id_usuario;
  } else {	

     if (($REMOTE_ADDR != "200.207.89.99") &&  ($REMOTE_ADDR != "200.189.83.9")  ) {    
   	  if ( isset($id_usuario) ) {
	 	$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	 	if ($ok<>$id_usuario) { header("Location: login.php"); }
	 	setcookie("loginok");  
	   } else {
		 header("Location: login.php");
       }
     }
  }
  if ($ok) {
    $nomeusuario=peganomeusuario($ok);	
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<!-- TemplateBeginEditable name="doctitle" -->
<title>Home Page</title>
<!-- TemplateEndEditable -->
<script type="text/javascript">
function IEHoverPseudo() {

	var navItems = document.getElementById("primary-nav").getElementsByTagName("li");
	
	for (var i=0; i<navItems.length; i++) {
		if(navItems[i].className == "menuparent") {
			navItems[i].onmouseover=function() { this.className += " over"; }
			navItems[i].onmouseout=function() { this.className = "menuparent"; }
		}
	}

}
window.onload = IEHoverPseudo;
</script>
<style type="text/css">
        body {
	font: normal 62.5% verdana;
	background-color: #E4E7E9;
	background-image: url();
	background-repeat: no-repeat;
}

        ul#primary-nav,
        ul#primary-nav ul {
              	margin: 0;
              	padding: 0;
              	width: 150px; /* Width of Menu Items */
              	border-bottom: 1px solid #ccc;
              	background: #fff; /* IE6 Bug */
              	font-size: 100%;
	}

        ul#primary-nav li {
        	position: relative;
        	list-style: none;
	}

        ul#primary-nav li a {
        	display: block;
        	text-decoration: none;
        	color: #777;
        	padding: 5px;
        	border: 1px solid #ccc;
        	border-bottom: 0;
	}

/* Fix IE. Hide from IE Mac \*/
* html ul#primary-nav li { float: left; height: 1%; }
* html ul#primary-nav li a { height: 1%; }
/* End */

        ul#primary-nav ul {
        	position: absolute;
        	display: none;
        	left: 149px; /* Set 1px less than menu width */
        	top: 0;
	}

        ul#primary-nav li ul li a { padding: 2px 5px; } /* Sub Menu Styles */
        
        ul#primary-nav li:hover ul ul,
        ul#primary-nav li:hover ul ul ul,
        ul#primary-nav li.over ul ul,
        ul#primary-nav li.over ul ul ul { display: none; } /* Hide sub-menus initially */
        
        ul#primary-nav li:hover ul,
        ul#primary-nav li li:hover ul,
        ul#primary-nav li li li:hover ul,
        ul#primary-nav li.over ul,
        ul#primary-nav li li.over ul,
        ul#primary-nav li li li.over ul { display: block; } /* The magic */
        
        ul#primary-nav li.menuparent { background: transparent url(../nova/arrow.gif) right center no-repeat; }
        
        ul#primary-nav li.menuparent:hover,
        ul#primary-nav li.over { background-color: #f9f9f9; }
        
        ul#primary-nav li a:hover { color: #3A7597; }
.style6 {
	font-size: 12px;
	font-weight: bold;
}
.style8 {color: #CCCCCC}
.style9 {color: #CCCCCC; font-weight: bold; }
.style12 {color: #FF0000}
.style13 {color: #000000}
.style14 {font-size: 9pt}
.style16 {color: #000000; font-size: 9pt; }
.style17 {
	color: #FFFFFF;
	font-weight: bold;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
</head>
<body link="#0000CC" vlink="#0000CC" alink="#0000CC" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCFF99">
    <td height="17" colspan="4" bgcolor="#3366CC" id="dateformat"><div align="center" class="style17">    Intranet Datamace </div></td>
  </tr>
  <tr bgcolor="#3366CC">
    <td colspan="2" bgcolor="#FFFFFF"><a href="../nova/www.datamace.com.br"><img src="../imagens/logo_datamace_frase.gif" alt="" width="206" height="64" border="0" /></a></td>
    <td width="572" valign="top" bgcolor="#FFFFFF"><div align="center">
      <p align="left" class="style14"><span class="style16" align="left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong></strong>Pol&iacute;tica da Qualidade.</strong></span></p>
      <ul><div align="left"></div>
          <div align="left"></div>
          <li class="style14">
          <div align="left"><span class="style13" align="left">Produzir e fornecer software e servi&ccedil;os com qualidade.</span></div>
        </li>
        <li class="style14">
          <div align="left"><span class="style13">Satisfazer aos clientes atrav&eacute;s do atendimento dos seus requisitos.</span></div>
        </li>
        <li>
          <div align="left" class="style14">Promover melhoria   cont&iacute;nua dos processos e do sistema de gest&atilde;o da qualidade.</div>
        </li>
      </ul>
    </div>      <div align="center"></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><img src="../imagens/Top5 2007.jpg" width="122" height="67" /></div></td>
  </tr>
  
  

  <tr>
    <td colspan="4" bgcolor="#003366"><img src="../nova/mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

  <tr bgcolor="#CCFF99">
  	<td height="17" colspan="4" bgcolor="#E4E7E9" id="dateformat">
	  <div align="right"><span class="style1">
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
     document.write (diasemana[diaindex]+ ', '  + dia + ' de ' + mesescrito[mes] + ' de ' + ano);

              </script>
    </span></div></td>
  </tr>
 <tr>
    <td colspan="4" bgcolor="#003366"><img src="../nova/mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

 <tr>
    <td width="165" valign="top" bgcolor="#3366CC">
	<table border="0" cellspacing="0" cellpadding="0" width="158" id="navigation">
	  <tr>
        <td><p class="style9">&nbsp;&nbsp;Menu</p>          </td>
	    </tr>
        <tr>
          <td width="158">
<ul id="primary-nav">

  <li><a href="../index.php"><strong>Home</strong></a></li>

  <li class="menuparent"><a href="../corporativo/index.php">Corporativo</a> 
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">SAD</a></li>
      <li><a href="#">Mapa do site</a></li>
      <li><a href="#">Organograma</a></li>
      <li><a href="#">Assistência Médica</a></li>
      <li><a href="#">Dados da Empresa</a></li>
	  <li><a href="#">Ramais</a></li>
	  <li><a href="#">Aniversários</a></li>
	  <li><a href="#">Pontes e Feriados</a></li>
	  <li><a href="#">Telefones Úteis</a></li>
	  <li><a href="#">Tô com fome</a></li>
	  <li><a href="#">Manutenção</a></li>
	  <li><a href="#">Escolaridade</a></li>
	  <li><a href="#">Representantes</a></li>
	  <li><a href="#">Suporte</a></li>
	  <li><a href="#">Informações sobre vírus</a></li>
	  <li><a href="#">Colaboradores</a></li>
	  <li><a href="conv.php">Convênios Datamace</a></li>
	  <li><a href="#">Saúde e Qualidade</a></li>
	  <li><a href="#">Eventos Datamace</a></li>
    </ul>
  </li>

  <li class="menuparent"><a href="#">Projetos</a> 
    <ul>
      <li><a href="#">Delphi</a></li>
      <li><a href="#">Cobol</a></li>
      <li><a href="#">Intranet</a></li>
      <li><a href="#">Cobol Web</a></li>
      <li><a href="#">RH Studio</a></li>
    </ul>
  </li>

  <li class="menuparent"><a href="#">Estrutura</a> 
    <ul>
      <li><a href="#">Rede</a></li>
      <li><a href="#">Nº micros</a></li>
    </ul>
  </li>
  
  <li class="menuparent"><a href="../Apoio/index.php">Apoio</a> 
    <ul>
      <li><a href="#">E-mails</a></li>
      <li><a href="#">Links</a></li>
    </ul>
  </li>  
  <li class="menuparent"><a href="#">Entretenimento</a> 
    <ul>
      <li><a href="#">Videoteca</a></li>
      <li><a href="#">Biblioteca</a></li>
      <li><a href="#">Enquetes</a></li>
      <li><a href="#">Mural</a></li>
    </ul>
  </li>  
  <li class="menuparent"><a href="../Apoio/index.php">Treinamento</a> 
    <ul>
      <li><a href="#">Cadastros</a></li>
      <li><a href="#">Relatórios</a></li>
      <li><a href="#">Portal</a></li>
    </ul>
  </li>  
  <li class="menuparent"><a href="../Apoio/index.php">Intersystem</a> 
    <ul>
      <li><a href="#">Compromisso</a></li>
      <li><a href="#">dados da empresa</a></li>
      <li><a href="#">Missão</a></li>
      <li><a href="#">Serviços</a></li>
    </ul>
  </li>  
</ul></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>        </tr>
      </table>
 	 <br />
  	&nbsp;<br />
  	&nbsp;<br />
  	&nbsp;<br /> 	</td>
    <td width="58" align="right" valign="top" bgcolor="f9f9f9">&nbsp;</td>
    <td valign="top" bgcolor="#f9f9f9"><!-- TemplateBeginEditable name="EditRegion" -->EditRegion<!-- TemplateEndEditable --></td>
    <td width="190" valign="top" bgcolor="#3366CC"><table border="0" cellspacing="0" cellpadding="0" width="190">
    <tr>
      <td valign="top" bgcolor="#3366CC"><div align="right" class="style9">
        <div align="center">Acesso r&aacute;pido </div>
      </div>
        <table width="90%" height="0" border="1" align="right" cellpadding="0" cellspacing="0" class="menuparent">
            <tr>
              <td bgcolor="#FFFFFF"><div align="center">
                <p><a href="/agenda/"><img src="../agenda/figuras/logoagenda.jpg" width="103" height="91" border="0" /></a><br />
                </p>
                </div></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF"><div align="center"><a href="../a/inicio.php"><img src="../imagens/LogoSad.jpg" width="105" height="68" vspace="6" border="0" /></a></div></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF"><div align="center"><a href="http://dtmgrhnet/datamace.htm" target="_blank"><br />
                <img src="../nova/imagens/Logo_Grh-Net.JPG" width="147" height="25" border="0" /></a></div></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF"><div align="center"><a href="../nova/ISO9001/index.php"><strong class="style6"> <br />
              </strong></a><a href="../ISO9001/index.php"><img src="../imagens/iso.jpg" width="135" height="51" border="0" /></a></div></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF"><div align="center"><a href="http://www.santanderbanespa.com.br/portal/gsb/script/templates/GCMRequest.do?page=50" target="_blank"><br />
                <img src="../imagens/banespa.gif" width="86" height="41" border="0" /></a><br />
              </div></td>
            </tr>
          </table>
          <p align="center"><br />
           </td>
      </tr>
</table></td>
 </tr>
  <tr>
    <td width="165" bgcolor="#3366CC">&nbsp;</td>
    <td colspan="2" bgcolor="#3366CC"><div align="center" class="style8">Datamace Inform&aacute;tica LTDA - Todos os diretos reservados &copy;2008 </div></td>
    <td width="190" bgcolor="#3366CC">&nbsp;</td>
  </tr>
</table>
</body>
</html>
