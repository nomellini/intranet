<?  
require("scripts/conn.php");
  session_start();  

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

<script language="JavaScript" type="text/javascript">
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


<body onLoad="mouse();MM_preloadImages('img/bt_enviar_over.gif','img/bt_encerrar_chamado_over.gif','img/bt_voltar_over.gif')">
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


function upload(name_form){
var enviar = true;
if (document.detalhes.textarea.value=="" && enviar==true){
alert("Preencha o campo Comentário.");
document.detalhes.textarea.focus();
enviar = false;
}
if(enviar==true){
document.detalhes.action="dohistorico.php";
document.detalhes.submit();

}}

function upload2(name_form){
var enviar = true;
if (document.detalhes.textarea.value=="" && enviar==true){
alert("Justifique o fechamento.");
document.detalhes.textarea.focus();
enviar = false;
}
if(enviar==true){
document.detalhes.action="encerrar.php";
document.detalhes.submit();

}}
</script>


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
		  <? include("include/menu.php");?>		  
      </div></td>
      <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>
            <td height="35" width="100%"><table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="80%"><img src="img/titulo_acompanharchamado.gif" width="172" height="33"> </td>
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
                <td height="5" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
                </tr>
              <tr>
                <td height="25" align="center" class="fundoFormsSemPadding"><table border="0" cellpadding="0" cellspacing="0" width="99%" >
                  <tr>
                    <td height="22" align="left" nowrap class="bgAberto" style="padding-left:5px; padding-right:5px;">Cliente <?
					
					  $sql=mysql_query("select * from contato where chamado_id=" . $_GET['numero']);
				  while($reg= mysql_fetch_assoc($sql)){
				
					
					$pessoacontatada=$reg['pessoacontatada']; }echo $pessoacontatada;?> - Chamado N&ordm; <?echo $_GET['numero'];?> </td>
                    <td width="913"><p style="margin:0px"></p></td>
                    </tr>
                </table>
                  <table border="0" cellpadding="0" cellspacing="0" width="99%" style="border:solid 1px #0B3685">
                    <tr>
                      <td width="73" class="tituloAcompanharChamado">Produto</td>
                      <td width="83" class="tituloAcompanharChamado">Criado em </td>
                      <td width="123" class="tituloAcompanharChamado">Atualizado em </td>
                      <td width="136" class="tituloAcompanharChamado">E-mail </td>
                      <td width="280" class="tituloAcompanharChamado">Assunto</td>
                    </tr>
                  <?$sql=mysql_query("select * from chamado where id_chamado=" . $_GET['numero']);
				  while ($reg= mysql_fetch_assoc($sql)){
				  $produto=$reg['sistema_id'];
				  $criado=$reg['dataa'];
				  $email=$reg['email'];
				  $assunto=$reg['assunto'];
				  }
				  ?>
				    <tr>
                      <td class="conteudoAcompanharChamado">
					  <?$sql= mysql_query("select * from sistema where id_sistema=" . $produto);
					  while($reg=mysql_fetch_assoc($sql)){
					  $sistema=$reg['sistema'];
					  }
					  echo $sistema;
					  ?>
					  
					  </td>
                      <td class="conteudoAcompanharChamado"><?
					  
					  $ano=substr("$criado",0, 4);
	                  $mes=substr("$criado",5, 2);
	                  $dia=substr("$criado",8, 2);
	                  echo $dia . "-". $mes . "-". $ano; 
					 
					?></td>
                      <td class="conteudoAcompanharChamado" >
					   <?$sql= mysql_query("select * from contato where id_contato=" . $_GET['numero']);
					  while($reg=mysql_fetch_assoc($sql)){
					  $dataa=$reg['dataa'];
					  }
					  
					  $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
	                  echo $dia . "-". $mes . "-". $ano; 
					  
					  
					  ?>					  
					  </td>
                      <td class="conteudoAcompanharChamado" ><?echo $email;?></td>
                      <td class="conteudoAcompanharChamado"><?echo $assunto;?></td>
                    </tr>
                   <?
				   
				   ?>
				  
				  </table></td>
              </tr>
              <tr>
                <td height="12" align="center"><img src="img/spacer.gif" width="50" height="12"></td>
                </tr>
              <tr>
                <td height="5" align="center"><table border="0" cellpadding="0" cellspacing="0" width="99%" >
                  <tr>
                    <td width="50" height="22" align="left" nowrap class="bgAberto" style="padding-left:5px; padding-right:5px">Intera&ccedil;&otilde;es </td>
                    <td width="913"><p style="margin:0px"></p></td>
                  </tr>
                </table>
                  <table border="0" cellpadding="0" cellspacing="0" width="99%" style="border:solid 1px #0B3685">
                  <tr>
                    <td width="111" class="tituloAcompanharChamado">Data</td>
                    <td width="138" class="tituloAcompanharChamado">Hora </td>
                    <td width="197" class="tituloAcompanharChamado">Consultor </td>
                    <td width="659" class="tituloAcompanharChamado">Coment&aacute;rios</td>
                  </tr>
				  
				  <?
				  $sql=mysql_query("select * from contato where chamado_id=" . $_GET['numero']);
				  $tr=0;
				  while($reg= mysql_fetch_assoc($sql)){
				  $dataa=$reg['dataa']; 
				  $horaa=$reg['horaa']; 
				  $historico=$reg['historico'];
				  $pessoacontatada=$reg['pessoacontatada']; 
				  				  				  				  ?>
                  <tr>
                    <td class="<?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?
					
					 $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
	                  echo $dia . "-". $mes . "-". $ano; 
					?></td>
                    <td class="<?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $horaa;?></td>
                    <td class="<?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $pessoacontatada;?></td>
                    <td class="<?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $historico;?></td>
                  </tr>
				  
				 <?$tr=$tr+1;
				 }?>
				  
                </table></td>
              </tr>
              
              
              <tr>
                <td height="12" align="center"><img src="img/spacer.gif" width="50" height="12"></td>
              </tr>
              <tr>
                <td height="5" align="center"><table border="0" cellpadding="4" cellspacing="0" width="99%" >
                  <tr>
                    <td align="right" valign="top" class="fundoForms">Inserir Novo  Coment&aacute;rio: </td>
                    <td width="25%" align="right" class="fundoForms"><label>
					
					
				   <form name="detalhes" action="" method="post">
                      <textarea name="textarea" cols="36%" rows="3" class="longtextField"></textarea>
					  <input type="hidden" name="numero" value="<?echo $_GET['numero'];?>"
					  <input type="hidden" name="usuario" value="<?echo $pessoacontatada;?>">
					</form> 
					
                      <br>
                    <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('enviar','','img/bt_enviar_over.gif',1)"><img src="img/bt_enviar.gif" alt="Enviar" name="enviar" width="55" height="18" border="0" onClick="upload(this.form);"></a> </label></td>
                    <td width="35%" align="left" class="fundoForms"><br></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="5" align="center"><img src="img/spacer.gif" width="50" height="12"></td>
              </tr>
              <tr>
                <td height="5" align="center"><table border="0" cellpadding="4" cellspacing="0" width="99%" >
                  <tr>
				  
				    <td width="49%" align="center" valign="top" class="fundoForms"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('bt_encerrra_chamado','','img/bt_encerrar_chamado_over.gif',1)"><img src="img/bt_encerrar_chamado.gif" name="bt_encerrra_chamado" width="116" height="18" border="0" onClick="upload2(this.form);"></a></td>
                    <td width="51%" align="center" valign="top" class="fundoForms"><a href="http://intranet.datamace.com.br/interdevice/acompanhar_chamado.php?pagina=1&pag=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('bt_voltar','','img/bt_voltar_over.gif',1)"><img src="img/bt_voltar.gif" name="bt_voltar" width="59" height="18" border="0"></a></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="5" align="center"><img src="img/spacer.gif" width="50" height="12"></td>
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
