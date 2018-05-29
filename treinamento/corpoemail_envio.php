<?

$corpo = ' 
<HTML>
<HEAD>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<STYLE>
<!--
.EstiloDeCorreioEletrnico19
 {color:black;}
.Section1
 {page:Section1;}

BODY P 
 { FONT-SIZE: 10pt; COLOR: black; FONT-FAMILY: verdana;
   MARGIN-BOTTOM: 6pt;   }
.style1 {color: #
	font-weight: bold;
	color: #566697;
}
 
-->
</STYLE>
</HEAD>
<BODY 
bgColor=#FFFFFF link=#000099 vLink=#000099 class="Normal" lang=PT-BR>
<DIV class=Section1 align=center>
  <TABLE width="600" border=0 cellPadding=0 
cellSpacing=0>
    <TBODY>
      <TR>
        <TD  class="Normal"><P><IMG src="cid:img-cliente" alt=""  hspace="0" border="0" align=baseline></P></TD>
      </TR>
      <TR>
        <TD bgColor=#FFFFFF class="Normal"><P align=center class="style1" style="TEXT-ALIGN: center"><FONT 
      face=Verdana size=5><SPAN 
      style="FONT-WEIGHT: bold; FONT-SIZE: 16pt; FONT-FAMILY: Verdana;">Avaliação de Eficácia</SPAN></FONT>
          <P></P>
		  <p><table>
	    <tr><td><div align="justify">' . stripslashes(nl2br($texto_email_html)) .'</div></td></tr></table></p>        </TD>
      </TR>
      <TR>
        <TD class="Normal">&nbsp;</TD>
      </TR>
    </TBODY>
  </TABLE>
</DIV>
</BODY>
</HTML>  ';

$corpoAlt = '
Eficácia 

' . $texto_email_txt ;


?>
