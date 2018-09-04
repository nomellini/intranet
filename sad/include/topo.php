<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SAD - Sistema de Atendimento Datamace</title>
 <link rel="stylesheet" href="include/css.css">
</head>

<body>

  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabelaTopo">
    <tbody>
      <tr>
        <td rowspan="3" align="left" valign="bottom" width="33%" style="background-image:url(img/topo_img_esq.jpg); background-attachment:scroll;background-repeat:no-repeat;     padding-bottom:0px; padding-left:8px; color:#FFFFFF; font-size:11px;"><img alt="Sistema de Atendimento Datamace" src="img/spacer.gif" border="0" height="10" width="330" /><br />
        <? echo $_SESSION['cli']; ?></td>

<td rowspan="3" align="right"><img src="img/spacer.gif" width="20"></td> 
   <td width="3" rowspan="2" align="right" valign="top"><img  src="img/borda_menu_topo_esq.jpg" border="0" height="29" width="13"></td>
   <td align="center" background="img/bg_menu_topo.jpg" style="background-repeat: repeat-x; background-attachment: fixed;" ><?$msg=$_SESSION['msg']; if($msg==""){ echo "<a href='index.php' class='menuTopo'>"; ?><?} else { echo "<a href='https://www.datamace.com.br/PortalCliente/' class='menuTopo'>";}?>Home</a> | <?$msg=$_SESSION['msg']; if($msg==""){ echo '<a href="guia_de_suporte.pdf" target="_blank" class="menuTopo">'; } else {echo "<a href='https://www.datamace.com.br/PortalCliente/' class='menuTopo'>";}?>Guia de Suporte</a> |  <?$msg=$_SESSION['msg']; if($msg==""){ echo '<a href="guia_de_suporte.pdf" target="_blank" class="menuTopo">'; } else {echo "<a href='https://www.datamace.com.br/PortalCliente/' class='menuTopo'>";}?><a href="https://www.datamace.com.br/PortalCliente/" class="menuTopo">Sair</a></td>
   <td rowspan="2" valign="top"><img  src="img/borda_menu_topo_dir.jpg" border="0" height="29" width="13"></td> 
    <td rowspan="3" align="left"><img  src="img/spacer.gif" width="10"></td>
     <td width="33%" rowspan="3" align="right" valign="bottom" style="color:#FFFFFF; font-size:11px;"><img src="img/pessoas_chat_topo.jpg" border="0" height="104" width="255"><br />
     

	 	 <script>

var now = new Date(); 
var hours = now.getHours(); 
var minutes = now.getMinutes(); 
var timeValue = "" + ((hours >12) ? hours -12 :hours) 
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += (hours >= 12) ? " PM" : " AM" 
timerRunning = true; 

mydate = new Date(); 
myday = mydate.getDay(); 
mymonth = mydate.getMonth(); 
myweekday= mydate.getDate(); 
weekday= myweekday; 
myyear= mydate.getFullYear(); 
year = myyear

if(myday == 0) 
day = " Domingo, " 

else if(myday == 1) 
day = " Segunda-Feira, " 

else if(myday == 2) 
day = " Terça-Feira, " 

else if(myday == 3) 
day = " Quarta-Feira, " 

else if(myday == 4) 
day = " Quinta-Feira, " 

else if(myday == 5) 
day = " Sexta-Feira, " 

else if(myday == 6) 
day = " Sábado, " 

if(mymonth == 0) 
month = " de Janeiro de " 

else if(mymonth ==1) 
month = " de Fevereiro de " 

else if(mymonth ==2) 
month = " de Março de " 

else if(mymonth ==3) 
month = " de Abril de " 

else if(mymonth ==4) 
month = " de Maio de "

else if(mymonth ==5) 
month = " de Junho de " 

else if(mymonth ==6) 
month = " de Julho de " 

else if(mymonth ==7) 
month = " de Agosto de " 

else if(mymonth ==8) 
month = " de Setembro de " 

else if(mymonth ==9) 
month = " de Outubro de " 

else if(mymonth ==10) 
month = " de Novembro de " 

else if(mymonth ==11) 
month = " de Dezembro de " 

document.write( day + myweekday + month + year+"&nbsp;&nbsp;"); 

</script></td>
   </tr>
    <tr>
   <td width='190' height="12" align='left' valign="top" ><img  src='img/bg_menu_topo_rodape.jpg' border='0' height='10' width='200'></td> 
    </tr> 
    <tr>
   <td width='199' colspan='3' align='center' valign='middle'><a href='index.php' style='text-decoration:none;'><img src='img/logo.jpg' border='0'></a></td>
  

        <!-- <td rowspan="3" align="right"><img src="img/quadrados_topo_esq.jpg" width="150" height="69"></td>  


      <td rowspan="2" align="right" width="3"><img alt="" src="img/borda_menu_topo_esq.jpg" border="0" height="29" width="13"></td>

      <td style="background-repeat: repeat-x; background-attachment: fixed;" align="center" background="img/bg_menu_topo.jpg" ><a href="#" class="menuTopo">Home</a>
      | <a href="#" class="menuTopo">Manual do Usu&aacute;rio</a> | <a href="#" class="menuTopo">Sair</a></td>

      <td rowspan="2" align="left"><img alt="" src="img/borda_menu_topo_dir.jpg" border="0" height="29" width="13"></td>

      <td rowspan="3" align="left"><img alt="" name="topo_r1_c6" src="img/quadrados_topo_dir.gif" border="0" height="69" width="150"></td>

      <td rowspan="3" align="right"><img alt="" name="topo_r1_c7" src="img/pessoas_chat_topo.jpg" border="0" height="69" width="163"></td>

      <td width="1"><img src="img/spacer.gif" border="0" height="20" width="1"></td>
    </tr>

    <tr>

      <td align="left" background="img/bg_menu_topo_rodape.jpg" width="190"><img alt="" src="img/bg_menu_topo_rodape.jpg" border="0" height="9" width="200"></td>

      <td><img src="img/spacer.gif" border="0" height="9" width="1"></td>
    </tr>

    <tr>

      <td width="199" colspan="3" align="center" valign="top"><img alt="" name="topo_r3_c3" src="img/quadrados_topo_centro.gif" border="0" height="40" width="215"></td>
-->
      </tr>
    </tbody>
</table>
  <br />

</body>
</html>
