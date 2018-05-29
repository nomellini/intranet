<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SAD - Sistema de Atendimento Datamace</title>
 <link rel="stylesheet" href="include/css.css">
 <script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.for ms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('img/icone1_over.gif','img/icone2_over.gif','img/icone3_over.gif','img/icone4_over.gif','img/icone5_over.gif','img/icone6_over.gif')">

<table border="0" cellpadding="0" cellspacing="0" height="68" width="100%">

  <tbody>

    <tr>

      <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>

      <td height="35" width="100%">
      <table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">

        <tbody>

          <tr>

            <td align="left" width="80%"><img src="img/titulo_home.gif" width="86" height="33"><?$msg=$_SESSION['msg']; if($msg==""){ echo "";} else {echo " <span style='padding-left:265px; position: relative; bottom: 10px; font-family: arial; font-size: 12px;'>Login encerrado, Clique <a href='http://www.datamace.com.br/portalCliente/' style=' color:black;'>aqui</a> para voltar.</span>";}?> </td>

            <td align="right" width="20%"><img src="img/grafismo_titulo.gif" width="103" height="33"> </td>

          </tr>

        </tbody>
      </table>

      </td>

      <td width="4"><img src="img/spacer.gif" height="5" width="8"></td>

    </tr>

    <tr>

      <td width="6"> </td>

      <td width="100%" align="left" class="conteudoSite"><img src="img/spacer.gif" width="100" height="5" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="20"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="ativa.php?acao=0"><?}else { echo "<a href='#'>";}?><img src="img/aba_voltar_topo.gif" name="icone11" width="20" height="165" border="0" id="icone11"/></a></td>
          <td rowspan="3" align="center" valign="top" style="padding-left:10px;"><table border="0" cellpadding="0" cellspacing="0" height="44%" width="60%">
            <tbody>
              <tr>
                <td width="4" height="265" rowspan="3" align="right" valign="top" background="img/aba_sombra_esq_bg.gif"><img  src="img/aba_sombra_esq.gif" height="100%" width="4" /></td>
                <td colspan="5" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 1px 1px 0px; background-color: rgb(245, 247, 250); padding-left: 3px;" height="14"><img src="img/titulo_aba2.gif" width="167" height="20" /><br />
                </td>
                <td width="400" height="14" align="left" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 0px 0px 1px;"><img  src="img/sombra_home.jpg" border="0" height="23" width="10" /></td>
                <td width="4" height="265" rowspan="3" align="left" valign="top" background="img/aba_sombra_dir_bg.gif" ><img   src="img/aba_sombra_dir.gif" border="0" height="100%" width="4" /></td>
              </tr>
              <tr>
                <td height="252" colspan="6" align="center" valign="middle" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 0px 1px 1px; background-color: rgb(245, 247, 250); padding-right: 3px;"><table width="85%" height="179" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td width="23%" height="99" valign="top"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="abertura.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('icone1','','img/icone1_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone1.gif" name="icone1" width="125" height="80" border="0" id="icone1" /></a></td>
                        <td width="23%" align="center"  valign="top"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="acompanhar_chamado.php?pagina=1&amp;pag=1#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('icone2','','img/icone2_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone2.gif" name="icone2" width="125" height="80" border="0" id="icone2" /></a></td>
                        <td width="23%" align="right"  valign="top"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="enviar_arquivo.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('icone3','','img/icone3_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone3.gif" name="icone3" width="125" height="80" border="0" id="icone3" /></a></td>
                      </tr>
                      <tr>
                        <td height="30" colspan="8" rowspan="1"><br />
                        </td>
                      </tr>
                      <tr>
                        <td width="23%" valign="bottom"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="usuarios_treinados.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('icone4','','img/icone4_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone4.gif" name="icone4" width="125" height="80" border="0" id="icone4" /></a></td>
                        <td width="23%" align="center" valign="bottom"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="acompanhar_calendario.php?data=<?echo date("d/m/Y");?>&evento=1" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('icone5','','img/icone5_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone5.gif" name="icone5" width="125" height="80" border="0" id="icone5" /></a></td>
                        <td width="23%" align="right" valign="bottom"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="estatisticas_sla.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('icone6','','img/icone6_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone6.gif" name="icone6" width="125" height="80" border="0" id="icone6" /></a></td>
                      </tr>
                    </tbody>
                </table></td>
              </tr>
              <tr>
                <td height="10" colspan="6" align="center" valign="top" background="img/aba_sombra_baixo.gif" ><img  src="img/aba_sombra_baixo.gif" border="0" height="12" width="100" /></td>
              </tr>
            </tbody>
          </table></td>
        </tr>
        <tr>
          <td width="20" height="80" style="background-image:url(img/aba_voltar_bg.gif); background-repeat:repeat-y;">&nbsp;</td>
          </tr>
        <tr>
          <td><img src="img/aba_voltar_rodape.gif" width="20" height="47" /></td>
          </tr>
      </table>
	    <img src="img/spacer.gif" width="100" height="5" /></td>
      <td width="4"> </td>

    </tr>

  </tbody>
</table>

</body>
</html>
