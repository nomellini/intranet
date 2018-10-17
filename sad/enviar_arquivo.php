<?
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

<script>
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

//-->

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>


</head>


<body onLoad="MM_preloadImages('img/bt_enviar_over.gif','img/bt_cancelar_over.gif')" MM_preloadImages('img/bt_enviar_over.gif')">
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


function upload(name_form){

var enviar = true;

if (document.form2.select5.value=="" && enviar==true){
alert("* Preencha o campo Chamado!");
document.form2.select5.focus();
enviar = false;

}

if (document.form2.imagem.value=="" && enviar==true){
alert("* Preencha o campo Arquivo!");
document.form2.imagem.focus();
enviar = false;

}

if(enviar==true){
document.form2.submit();
}
}

document.write("<div id='layout' align='center' style='width:"+largura_show+";'>");






</script>


<div id="topo">
  <? include("include/topo.php");
  
  ?> 
</div>

<div id="data">
 <? include("include/data.php");?>
</div>
<div id="conteudo">
<script>
function resubmit() {  
 location.href="?select5="+document.form2.select5.value;
}  
</script>		
<form name="form2" enctype="multipart/form-data" method="post" action="getfile.php" />
           
	
		
		
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="190" valign="top" style="padding-left:5px">
	  <div id="menuPrincipal">
	  	<link rel="StyleSheet" href="include/dtree.css" type="text/css" />
	<script type="text/javascript" src="include/dtree.js"></script>

		  <? include("include/menu.php");?>		  
      </div></td>
      <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>
            <td height="35" width="100%"><table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="80%"><img src="img/titulo_enviararquivo.gif" width="172" height="33"> </td>
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
                <td height="5" colspan="4" align="right"><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              <tr>
                <td width="40%" height="25" align="right" class="fundoForms">* Chamado: 
                  <label></label></td>
                <td colspan="3" align="left" class="fundoForms">
				
				
				<select name="select5" class="textField" onChange="resubmit();">  
				
				
			
		
				
				<option value="<?if($_GET['select5']!=""){ echo $_GET['select5'];} else { echo "";}?>" <? if($_GET['select5']!=""){ echo "selected";} else { echo "";}?>><?if($_GET['select5']!=""){ echo $_GET['select5'];} else { echo "Selecione!";}?></option>
			
				
				<? require("scripts/conn.php");
				session_start(); 
				
				
				if ($v_id_cliente=="") {
header("Location: doindex.php");
}

				 if ($v_id_cliente) {
  
  	//die($v_id_cliente);
  
    //$chamadosAbertos = pegaChamadosPorCliente($v_id_cliente, 2);
	//$qtdeAberto = count($chamadosAbertos);
	//$chamadosFechados = pegaChamadosPorCliente($v_id_cliente, 1);
	//$qtdeFechado = count($chamadosFechados); 
}	

$hoje = date("Y-m-d");
$dias = -3650;
$xdata = "86400" * $dias +mktime(0,0,0,date('m'),date('d'),date('Y'));
$xdata = date("Y-m-d",$xdata);

?>
				<?
			
				$sql=mysql_query("select id_chamado, status from chamado where cliente_id='$v_id_cliente' and externo=1 and status=2  and dataa >= '$xdata'");
			
			
			while($reg= mysql_fetch_assoc($sql)){

			$id=$reg['id_chamado'];
			$status=$reg['status'];
		
					?>
				
				<option value="<?echo $id;?>"><?echo $id;?></option>
			
				<?}?>
				 </select>
              <a href="#" style="cursor: help" onMouseOver="mouseover('Selecione um chamado em aberto');" onMouseOut="mouseout();"></a></td>
              </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              <tr>
                <td height="25" align="right" class="fundoForms">Assunto:</td>
                <td colspan="3" align="left" class="fundoForms"><input name="assunto" type="text" class="textField" value="<?
			 if($_GET['select5']!=""){
			$sql=mysql_query("select * from chamado where id_chamado=" . $_GET['select5']);
			while($reg=mysql_fetch_assoc($sql)){
				$assunto=$reg['assunto'];
				}
				echo $assunto;
				} else {
				echo "";
				}
				?>" size="50%"></td>
              </tr>
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              <tr>
                <td height="25" align="right" class="fundoForms" valign="top">* Upload de Arquivo:</td>
                <td colspan="3" align="left" class="fundoForms" style="font-size:10px">
 <p><input type="file" size="35" name="imagem" class="textField"  value=""/> 
<br>          
Arquivos até 2 MB</p>   </tr>
 
              <tr>
                <td height="5" colspan="4" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              <tr>
                <td height="25" rowspan="2" align="right" valign="top" class="fundoForms">Observa&ccedil;&atilde;o: </td>
                <td width="25%" colspan="2" align="right" class="fundoForms"><label>
                  <textarea name="textarea" cols="36%" rows="3" class="longtextField"><?echo $_SESSION['textarea'];?></textarea>
                  <!--  <input type="submit" value="enviar">-->
                </label>				</td>
                <td width="35%" rowspan="2" align="left" class="fundoForms">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="fundoForms" style="padding-top:6px; font-size:10px;"><a href="index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','img/bt_cancelar_over.gif',1)"><img src="img/bt_cancelar.gif" alt="Cancelar" name="Image11" width="59" height="18" vspace="3" border="0"></a>
				<br>
				*Campos Obrigat&oacute;rios				</td>
                <td align="right" valign="top" class="fundoForms" style="padding-top:6px;"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('enviar','','img/bt_enviar_over.gif',1)"><img src="img/bt_enviar.gif" alt="Enviar" name="enviar" width="55" height="18" vspace="3" border="0" onClick="upload(this.form);"></a></td>
              </tr>
              
              <tr>
                <td height="3" colspan="4" align="center" bgcolor="#F5F7FA"><img src="img/spacer.gif" width="50" height="5"></td>
              <tr>
                <td height="25" colspan="4" align="left" style="padding-left:6px; padding-right:5px; padding-top:0px; padding-bottom:2px; font-size:9px;">
				<hr color="#9EAAC7" noshade="noshade" width="100%" size="1" align="center"/>
				Observe que arquivos com mais </span>de 2 MB de tamanho podem causar problemas durante o envio. Por isso, se os arquivos forem maiores de 2 MB, compacte-os. </td>
				</tr>
                 <p class="button" style="position: relative; bottom: 22px; left: 0px;">
			
			<input type="hidden" name="acao" value="imagem" /></p>
            </table>
              </td>
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
