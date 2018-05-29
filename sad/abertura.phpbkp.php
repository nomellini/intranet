<? 
 require("scripts/conn.php");
session_start(); 
$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  
  
if ($v_id_cliente) {

  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
  <title>SAD - Sistema de Atendimento Datamace</title>


  <link rel="stylesheet" href="include/css.css">

  <script type="text/JavaScript">
<!--



//-->
</script>

<script>
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
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

//-->

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


</head>


<body onLoad="MM_preloadImages('img/bt_enviar_over.gif')" MM_preloadImages('img/bt_enviar_over.gif')">
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




function upload(){
var enviar = true;

if (document.form.textfield.value=="" && enviar==true){
alert("* Preencha o campo Nome!");
document.form.textfield.focus();
enviar = false;

}

if (document.form.textfield2.value=="" && enviar==true){
alert("* Preencha o campo E-mail!");
document.form.arquivo.focus();
enviar = false;
}

if (document.form.select2.value=="" && enviar==true){
alert("* Preencha o campo Produto!");
document.form.select2.focus();
enviar = false;
}

if (document.form.textfield222.value=="" && enviar==true){
alert("* Preencha o campo Versão!");
document.form.textfield222.focus();
enviar = false;
}

if(enviar==true){
document.form.submit();
}
}

</script>


<div id="topo">
  <? include("include/topo.php");?> 
</div>

<div id="data">
 <? include("include/data.php");?>
</div>
<div id="conteudo">
<form name="form" action="doabertura.php"  method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="190" valign="top" style="padding-left:5px">
	  <div id="menuPrincipal">
		  <? include("include/menu.php");?>		  
      </div></td>
      <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>
            <td height="35" width="100%"><table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="80%"><img src="img/titulo_abrirchamado.gif" width="172" height="33"> </td>
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
                <td height="5" colspan="4" align="right" ><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              <tr>
                <td width="40%" height="25" align="right" class="fundoForms">* Nome:
                  <label></label></td>
<td colspan="3" align="left" class="fundoForms">


<input name="textfield" type="text" class="textField" size="50%" value="<?

 echo $_SESSION['cli']; 

 
?>"></td>
		      </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="25" align="right" class="fundoForms">*E-mail: </td>
                <td colspan="3" align="left" class="fundoForms"><input name="textfield2" type="text" class="textField" value="<?
echo $_SESSION['email'];
  ?>"size="50%"></td>
			  </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="25" align="right" class="fundoForms">*Produto: </td>
                <td colspan="3" align="left" class="fundoForms">
				
							
				<select name="select2" class="textField" style="width:222px;">
                    <option value=>Selecione um sistema</option>
                    <?
	
 $sql=mysql_query("select * from sistema");
 
 while($reg=mysql_fetch_assoc($sql)){
 $sistema=$reg['sistema']; 
 $id_sistema=$reg['id_sistema'];
 
	  echo "<option value=$id_sistema>$sistema</option>";
 	}
  ?>
                  </select>				</td>
              </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="25" align="right" class="fundoForms">*M&oacute;dulo:
                  <label></label></td>
                <td colspan="3" align="left" class="fundoForms"><select name="select" class="textField" style="width:222px;">
				<option value=>Selecione</option>
                </select></td>
              </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="25" align="right" class="fundoForms">*Vers&atilde;o:</td>
                <td colspan="3" align="left" class="fundoForms">
                  <input name="textfield222" type="text" class="textField" size="40%">
                  <a href="#" style="cursor: help" onMouseOver="mouseover('Vers&atilde;o do Produto');" onMouseOut="mouseout();"><img src="img/interrogacao.gif" border="0" align="absmiddle"></a> </td>
		      </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="25" align="right" class="fundoForms">Classifica&ccedil;&atilde;o:</td>
                <td colspan="3" align="left" class="fundoForms"><select name="select4" class="textField" style="width:222px;">
                  <option>Selecione</option>
                  <?
				$sql=mysql_query("SELECT * FROM classificacao ");
				while($reg=mysql_fetch_assoc($sql)){
				$classifica=$reg['descricao'];
				$id=$reg['id'];
				echo "<option value='$id'> $classifica </option>";
				}
				?>
                </select>
                  <a href="#" style="cursor: help" onMouseOver="mouseover('Classifica&ccedil;&atilde;o do Chamado');" onMouseOut="mouseout();"><img src="img/interrogacao.gif" border="0" align="absmiddle"></a></td>
               </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="25" align="right" class="fundoForms">Assunto:</td>
                <td colspan="3" align="left" class="fundoForms"><input name="textfield22" type="text" class="textField" size="40%"></td>
              </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="25" rowspan="2" align="right" valign="top" class="fundoForms">Descri&ccedil;&atilde;o do Chamado: </td>
                <td width="25%" colspan="2" align="right" class="fundoForms">
                  <textarea name="textarea" cols="36%" rows="3" class="longtextField"></textarea>                </td>
              
			    <td width="35%" rowspan="2" align="left" class="fundoForms">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="fundoForms"><span style="padding-right:5px; font-size:10px">*Campos Obrigat&oacute;rios </span></td>
				
                <td align="right" class="fundoForms">
				
				<label><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('enviar','','img/bt_enviar_over.gif',1)"><img src="img/bt_enviar.gif" alt="Enviar" name="enviar" width="55" height="18" border="0" onClick="upload(this.form);"></a></label>				</td>
              </tr>
  <td height="5" colspan="4" align="center" bgcolor="#F5F7FA"><img src="img/spacer.gif" width="50" height="5"></td>
  <tr>
    <td height="25" colspan="4" align="left" style="padding-left:6px; padding-right:5px; padding-top:0px; padding-bottom:2px; font-size:9px;">
	<hr color="#9EAAC7" noshade="noshade" width="100%" size="1" align="center"/>
	N&atilde;o existe restri&ccedil;&atilde;o de hor&aacute;rio para encaminhamento dos chamados, por&eacute;m, ser&atilde;o   tratados em hor&aacute;rio comercial, das 08:00 &agrave;s 17:00. Todos os chamados   recepcionados ap&oacute;s as 17:00hs, poder&atilde;o ser tratados a partir das 08:00hs do dia   &uacute;til seguinte. </td>
  </tr>
            </table></td>
            <td width="4"></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </table>
  </form>
</div>

<div id="rodape">
<? include("include/rodape.php");?>
</div>

</body>
</html>
<?} else  {
 Header("Location: index.php");
}
?>
