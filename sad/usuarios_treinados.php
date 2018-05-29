<?  
require("scripts/conn.php");
  session_start(); 
$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
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



//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->


</script>


</head>


<body onLoad="mouse();">
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

function mascaraData(campoData){

var letra = campoData.value;
var letra = letra.replace(/([A-Z])/g,"");
var letra = letra.replace(/([a-z])/g,"");  
campoData.value = letra;


 var data = campoData.value;
 if (data.length == 2){
 data = data + '-';
 campoData.value = data;
 return true;
 }
 if (data.length == 5){
 data = data + '-';
 campoData.value = data;
 return true;
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
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="190" valign="top" style="padding-left:5px">
	  <div id="menuPrincipal">
		  <? include("include/menu.php");
		  
		  			  $textfiel=$_GET['textfield'];
				  $ano=substr("$textfiel",6, 4);
	              $mes=substr("$textfiel",3, 2);
	              $dia=substr("$textfiel",0, 2);
				  
				  $textfield=$ano . "-" . $mes . "-" . $dia;
   	?>		  
      </div></td>
      <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>
            <td height="35" width="100%">
			
			<table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="80%"><img src="img/titulo_usuariostreinados.gif" width="172" height="33"> </td>
                    <td align="right" width="20%"><img src="img/grafismo_titulo.gif" width="103" height="33"> </td>
                  </tr>
                </tbody>
            </table></td>
            <td width="4"><img src="img/spacer.gif" height="5" width="8"></td>
          </tr>
          <tr>
            <td width="6"></td>
            <td class="conteudoSite" align="center" width="100%">
			
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="5" align="right"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td><table width="50%" border="0" cellspacing="0" cellpadding="0">
            					
					
					
					</td>
                
				
				  </tr>
                </table></td>
                </tr>
            
              <tr>
                <td height="25" align="center" class="fundoFormsSemPadding"><table border="0" cellpadding="0" cellspacing="0" width="99%" style="border:solid 1px #0B3685">
                  <tr>
                    <td width="203" class="tituloAcompanharChamado" align="center">Nome</td>
                    <td width="148" class="tituloAcompanharChamado" align="center">E-mail </td>
                    <td width="171" class="tituloAcompanharChamado" align="center">Produto</td>
                    <td width="124" class="tituloAcompanharChamado" align="center">Realizado em  </td>
                    <td width="105" class="tituloAcompanharChamado" align="center">A&ccedil;&otilde;es</td>
                  </tr>
                  
				  <?  
				 
// LISTA USUARIOS TREINADOS 	

				  $sql = mysql_query("select distinct(nome) as nome2, email, produto, data from treinados where cliente='". $v_id_cliente . "' and visivelCliente = 'S'");
                  while($reg= mysql_fetch_assoc($sql)){
				  $nome2=$reg['nome2'];
				  $date=$reg['data'];
				  
				  $email=$reg['email'];
				  $produto=$reg['produto'];
				  $id=$reg['id'];

				 ?>
				   <tr>
               <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $nome2;?> &nbsp;</td>
               <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $email; ?> &nbsp;</td>
               <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $produto; ?> &nbsp;</td>
               <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">
			   
			   <?
	$ano=substr("$date",0, 4);
	$mes=substr("$date",5, 2);
	$dia=substr("$date",8, 2);
	echo $dia . "-". $mes . "-". $ano;  
  ?> &nbsp;</td>
               
			   
			   <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">
		<a href="http://intranet.datamace.com.br/sad/usuarios_treinados.php?nome=<?echo $nome;?>&ativa=1" style="cursor: help"  onMouseOver="mouseover('Atualizar Dados');" onMouseOut="mouseout();"><img src="img/icone_usuario_atualizardados.gif" width="20" height="14" hspace="3" vspace="1" border="0"></a>
				<!--	<a href="#" style="cursor: help" onMouseOver="mouseover('Inscrição Online');" onMouseOut="mouseout();"><img src="img/icone_usuario_inscricaoonline.gif" width="20" height="14" hspace="3" vspace="1" border="0"></a>-->
					<a href="http://intranet.datamace.com.br/sad/excluir_treinado.php?id=<? echo $id;?>&textfield=<?echo $_GET['textfield'];?>&select2=<?echo $_GET['select2'];?>" style="cursor: help" onMouseOver="mouseover('Excluir');" onMouseOut="mouseout();"><img src="img/icone_usuario_excluir.gif" width="20" height="14" hspace="3" vspace="1" border="0"></a>					</td>
                  </tr>
				   <?
				$tr=$tr+1; }
				 ?>
				 
				 
<?if($_GET['ativa'] !=""){?>	<tr><td>
<div <?if($_GET['ativa'] !=""){?> <?} else {?>style="visibility:hidden;" <?}?> id=alterardados> 
<form action="<?echo "salvaratua.php"?>" method="get">

<?
$nome=$_GET['nome'];
$sql=mysql_query("select nome, email, produto, data from treinados where nome='". $nome ."' and cliente='". $v_id_cliente . "'");

while($reg=mysql_fetch_assoc($sql)){
$email=$reg['email'];
$nome2=$reg['teste'];
 }

?>	

				<table width="300" border="0" cellpadding="0" cellspacing="0" >
  <tr>
   <td width="4" rowspan="2" valign="top" background="img/over_bg_esq.png" >&nbsp;</td>
   <td width="215" height="20" bgcolor="#004C92" style="border-bottom:2px solid #004C92; border-top:2px solid #004C92; border-right:2px solid #004C92;  border-left:2px solid #004C92; padding-bottom:0px; padding-top:0px; padding-left:5px; padding-right:5px; color:#FFFFFF">  Atualizando dados de <?echo $nome;?>  </td>
   <td width="61" align="right" bgcolor="#004C92" style="border-bottom:2px solid #004C92; border-top:2px solid #004C92; border-right:2px solid #004C92;  border-left:2px solid #004C92; padding-bottom:0px; padding-top:0px; padding-left:5px; padding-right:5px;"><a href="javascript:history.go(-1)" onClick="clicarfechar();"><img src="img/bt_fechar.gif" border="0" /></a></td>
   <td width="5" rowspan="2" valign="top" background="img/over_sombra_dir.png"><img  src="img/spacer.gif" width="5" height="5" border="0" alt="" /></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF" style="border-bottom:2px solid #004C92; border-top:2px solid #004C92; border-right:2px solid #004C92;  border-left:2px solid #004C92; padding-bottom:3px; padding-top:3px; padding-left:5px"><table width="100%" border="0" cellspacing="0">
      <tr>
        <td width="52" >Nome:</td>
        <td width="222" align="right" style="padding-right:5px; padding-bottom:3px">
          <input name="textfield22" type="text" class="textField" size="35" value="<?  echo $nome2;?>"/></td>
		
      </tr>
      <tr>
        <td width="52">E-mail:</td>
        <td align="right" style="padding-right:5px;">
          <input name="textfield222" type="text" class="textField" size="35" value="<?  echo $email;?>"/></td>
		  <input type="hidden" name="id" value="<?echo $id;?>">
		  <input type="hidden" name="fixa1" value="<?echo $textfield;?>">
		  <input type="hidden" name="fixa2" value="<?echo $select2;?>">
      </tr>
      <tr>
  
	
	
	    <td colspan="2" align="center">

<input type="image" src="img/bt_salvar.gif" value="submit">



</td>        </tr>
    </table>
	</form></td>
  </tr>
  

  <tr>
   <td><img src="img/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td colspan="2" background="img/over_bg_baixo.png" ><img  src="img/spacer.gif" width="115" height="1" border="0" alt=""></td>
   <td><img  src="img/over_dir_baixo2.png" width="6" height="5" border="0" alt=""></td>
   </tr>
</table>

</div></td></tr> <?} else { echo "";}?>
                </table></td>
              </tr>
              <tr>
                <td height="5" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
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
