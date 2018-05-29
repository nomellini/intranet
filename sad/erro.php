<?
 require("scripts/conn.php");
session_start(); 
$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  


if ($v_id_cliente=="") {
header("Location: doindex.php");
}
  if ($erro==1) {
    $msg = "Você não está autorizado a usar o sistema da atendimento (ATM).";
  }
  if ($erro==2 or !$erro) {
    $msg = "Senha Incorreta, ou usuário não cadastrado.";
  }
  if ($erro==3) {
    $msg = "Todos os campos devem ser preenchidos.";
  }
  if ($erro==4) {
    $msg = "Você não está autorizado a usar o sistema da atendimento (BLQ).";
  }
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
  <title>SAD - Sistema de Atendimento Datamace</title>


  <link rel="stylesheet" href="include/css.css">

  <script type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
//-->
</script>
</head>


<body onLoad="MM_preloadImages('img/icone1_over.gif','img/icone2_over.gif','img/icone3_over.gif','img/icone4_over.gif','img/icone5_over.gif','img/icone6_over.gif')">

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
<div id="topo">
  <? include("include/topo.php");?> 
</div>
<div id="data">
   <? include("include/data.php");?>
</div>

<div id="conteudo">

<table width="100%" align="center">
<tr>
<td align="center">

<b>Erro: <?=$msg?></b><br><br>
<a href="#" style="text-decoration:none; color:#000000">Voltar e tentar novamente.</a> </td>
 </tr>
 </table>
    
</div>

<div id="rodape">

<? include("include/rodape.php");?>

</div>

</body>
</html>
