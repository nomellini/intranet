<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SAD - Sistema de Atendimento Datamace</title>
 <link rel="stylesheet" href="include/css.css">
 <script type="text/javascript" language="javascript" src="include/tree.js"></script>
 <script type="text/javascript" language="javascript" src="include/jquery.js"></script>

<script type="text/javascript">

function change(id,muda){

if(muda.src == "http://intranet.datamace.com.br/sad/img/mais.gif"){
	muda.src = "img/menos.gif";
}
else{
muda.src = "img/mais.gif"
}


  ID = document.getElementById(id);

     if(ID.style.display == "")
          ID.style.display = "none";
     else
          ID.style.display = "";



      }
</script>

<script type="text/javascript">
<!--
/*startlist = function() {
if (document.all&&document.getElementById) {
    navRoot = document.getElementById("pmenu");
        for (i=0; i<navRoot.childNodes.length; i++) {
            node = navRoot.childNodes[i];
                if (node.nodeName=="LI") {
                    node.onmouseover=function() {
                    this.className+="over";
                    }
                    node.onmouseout=function() {
                    this.className=this.className.replace("over", "");
                    }
                }
        }
    }
}
window.onload=startlist;*/

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
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
MM_preloadImages('img/bt_salvar_over.gif');
//-->

</script>

</head>

<body onunload="mouse();">


<div id="menuover">
<!--  <div> -->

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td height="25" valign="top" background="img/over_bg_esq.png" ><img src="img/over_seta1.png" alt="" width="14" height="13" vspace="10" border="0"></td>
   <td rowspan="2" bgcolor="#FFFFFF" style="border-bottom:2px solid #004C92; border-top:2px solid #004C92; border-right:2px solid #004C92; padding-bottom:3px; padding-top:3px; padding-left:5px; padding-right:5px; font-size:10px;">  <p id="texto"></p> </td>
   <td rowspan="2" valign="top" background="img/over_sombra_dir.png">&nbsp;</td>
  </tr>

  <tr>
   <td valign="top" style="border-right:2px solid #004C92;">&nbsp;</td>
   </tr>

  <tr>
   <td><img src="img/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td background="img/over_bg_baixo.png" ><img src="img/spacer.gif" width="115" height="1" border="0" alt=""></td>
   <td><img src="img/over_dir_baixo2.png" alt="" width="6" height="5" border="0"></td>
   </tr>
</table>

</div>


<div id="menuover2">


<!--<table border="0" cellpadding="0" cellspacing="0">
  <tr>
   <td height="25" valign="top" background="img/over_bg_esq.png" ><img src="img/over_seta1.png" alt="" width="14" height="13" vspace="10" border="0"></td>
   <td rowspan="2" bgcolor="#FFFFFF" style="border-bottom:2px solid #004C92; border-top:2px solid #004C92; border-right:2px solid #004C92; padding-bottom:3px; padding-top:3px; padding-left:5px; padding-right:5px; font-size:10px;">  <p align="center" id="texto2"></p> </td>
   <td rowspan="2" valign="top" background="img/over_sombra_dir.png">&nbsp;</td>
  </tr>

  <tr>
   <td valign="top" style="border-right:2px solid #004C92;">&nbsp;</td>
   </tr>

  <tr>
   <td><img src="img/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td background="img/over_bg_baixo.png" ><img src="img/spacer.gif" width="115" height="1" border="0" alt=""></td>
   <td><img src="img/over_dir_baixo2.png" alt="" width="6" height="5" border="0"></td>
   </tr>
</table>-->

 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" >&nbsp;</td>
    <td align="center" valign="bottom" background="img/over_bg_topo.png"><img src="img/over_seta2.png" alt="" width="14" height="13" border="0" /></td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" background="img/over_bg_esq.png" ><img src="img/spacer.gif" alt="" width="14" height="13" border="0" /></td>
    <td height="35" bgcolor="#FFFFFF" style="border-bottom:2px solid #004C92; border-top:0px solid #004C92; border-right:2px solid #004C92; padding-bottom:3px; padding-top:3px; padding-left:5px; padding-right:5px; font-size:10px;"><p align="center" id="texto2"></p></td>
    <td valign="top" background="img/over_sombra_dir.png">&nbsp;</td>
  </tr>

  <tr>
    <td><img src="img/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    <td background="img/over_bg_baixo.png" ><img src="img/spacer.gif" width="115" height="1" border="0" alt="" /></td>
    <td><img src="img/over_dir_baixo2.png" alt="" width="6" height="5" border="0" /></td>
  </tr>
</table>



</div>

<div class="tree">
<script type="text/javascript">
		<!--
	d = new dTree('d');
		d.add(1,-1,'  Pastas do SAD  <img src="http://intranet.datamace.com.br/sad/img/icone_menu_principal.gif"><br><img src="img/line2.gif">');
    	d.add(2,1,'<a onmousemove=mouseover("1"); onMouseOut=mouseout();> Chamado <img src="img/icone_menu_chamado.gif"/></a>');
		d.add(4,2,'<a onmousemove=mouseover("6"); onMouseOut=mouseout(); href="abertura.php"> Abrir Chamado</a>');
		d.add(3,2,'<a onmousemove=mouseover("7"); onMouseOut=mouseout(); href="acompanhar_chamado.php?pagina=1&pag=1"> Acompanhar Chamado </a>');
		d.add(5,3,'<a onmousemove=mouseover("8"); onMouseOut=mouseout(); href="acompanhar_encerrados.php?pagina=1&pag=2"> Chamados Encerrados </a>');
		d.add(6,1,'<a onmousemove=mouseover("2"); onMouseOut=mouseout(); href="enviar_arquivo.php"> Enviar Arquivo <img src="img/icone_menu_enviararquivo.gif"/></a>');
		d.add(7,1,'<a onmousemove=mouseover("3"); onMouseOut=mouseout(); href="usuarios_treinados.php"> Usuários Treinados <img src="img/icone_menu_usuarioscadastrados.gif"/></a>');
		d.add(8,1,'<a onmousemove=mouseover("4"); onMouseOut=mouseout(); href="acompanhar_calendario.php?data=<?echo date('d/m/Y');?>&evento=1"> Calendário <img src="img/icone_menu_calendario.gif"/> </a>');
		d.add(9,1,'<a onmousemove=mouseover("5"); onMouseOut=mouseout(); href="estatisticas_sla.php"> Estatística SLA <img src="img/icone_menu_estatisticasla.gif"/></a>');

			document.write(d);
		//-->



</script>

<script>

var IE = false;
if (document.all){IE = true}
else document.captureEvents(Event.MOUSEMOVE);
document.onmousemove=mouse;

function mouse(e){

if (IE)	{
	xcurs = event.clientX;
	ycurs = event.clientY;
}else{
	xcurs = e.pageX;
	ycurs = e.pageY;
}

if (!document.body.scrollTop){
	iL = document.documentElement.scrollLeft;
	iV = document.documentElement.scrollTop;
}else {
	iL = document.body.scrollLeft;
	iV = document.body.scrollTop;
}

xcurs = xcurs + iL;
ycurs = ycurs + iV;


//document.getElementById('position').style.display = 'block';
document.getElementById('menuover').style.left = (xcurs+35)+'px';
document.getElementById('menuover2').style.left = (xcurs-75)+'px';

if (navigator.appName == 'Microsoft Internet Explorer') {
document.getElementById('menuover').style.top =  ycurs-15 + document.body.scrollTop + "px";}
else {
document.getElementById('menuover').style.top =  (ycurs-15)+ "px";}

if (navigator.appName == 'Microsoft Internet Explorer') {
document.getElementById('menuover2').style.top =  ycurs+10 + document.body.scrollTop + "px";}
else {
document.getElementById('menuover2').style.top =  (ycurs+10)+ "px";}


}


function mouseover2(y)
{

xcurs = event.clientX;
ycurs = event.clientY;

texto2.innerHTML = y;
document.getElementById('menuover2').style.left = (xcurs-75)+'px';

if (navigator.appName == 'Microsoft Internet Explorer') {
document.getElementById('menuover2').style.top =  ycurs+10 + document.body.scrollTop + "px";}
else {
document.getElementById('menuover2').style.top =  (ycurs+10)+ "px";}

document.getElementById('menuover2').style.display = 'block';

}



function mouseover(x)
{


	var IE = false;
	if (document.all){IE = true}

	/*
	if (IE)	{
		xcurs = event.clientX;
		ycurs = event.clientY;

		if (!document.body.scrollTop){
			iL = document.documentElement.scrollLeft;
			iV = document.documentElement.scrollTop;
		}else {
			iL = document.body.scrollLeft;
			iV = document.body.scrollTop;
		}

		*/

		if (x == 1) {var resp = "Aqui você abre um chamado para reportar um erro<br>ou acompanha um chamado.";}
		else if (x == 2) {var resp = "Aqui você envia um arquivo para<br>um chamado existente.";}
		else if (x == 3) {var resp = "Aqui você visualiza os<br>usuários cadastrados.";}
		else if (x == 4) {var resp = "Aqui você acompanha o calendário.";}
		else if (x == 5) {var resp = "Aqui você visualiza a estatística.";}
		else if (x == 6) {var resp = "Aqui você abre um chamado.";}
		else if (x == 7) {var resp = "Aqui você acompanha um chamado.";}
		else if (x == 8) {var resp = "Aqui você acompanha os chamados encerrados.";}
		else {var resp = x;}


		document.getElementById("texto").innerHTML = resp

		//texto.innerHTML = resp;
		/*
		document.getElementById('menuover').style.left = (xcurs+35)+'px';
		if (navigator.appName == 'Microsoft Internet Explorer') {
			document.getElementById('menuover').style.top =  ycurs-15 + document.body.scrollTop + "px";
		}else {
			document.getElementById('menuover').style.top =  (ycurs-15)+ "px";
		}
		*/
		document.getElementById('menuover').style.display = 'block';
	//}
}

function mouseout()
{
document.getElementById('menuover').style.left = 0;
document.getElementById('menuover').style.top = 0;
document.getElementById('menuover').style.display = 'none';
document.getElementById('menuover2').style.left = 0;
document.getElementById('menuover2').style.top = 0;
document.getElementById('menuover2').style.display = 'none';
}
</script>
</div>
</div>
</body>

</html>