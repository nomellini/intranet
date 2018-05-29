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
                    <td align="left" width="80%">
					
					
							<?
					
					$sql20=mysql_query("select * from chamado where id_chamado=". $_GET['id_chamado']);
					
						
					while($reg20=mysql_fetch_assoc($sql20)){
					$status=$reg20['status'];
						
					
					if($status=="2"){
					?>
					<img src="img/titulo_acompanharchamado.gif" width="172" height="33"> 
					<?} else {
					?>
					<img src="img/titulo_acompanharencerrado.gif" width="172" height="33"> 
				
				<?
					}}?>
					
					
					
					
					</td>
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
                <td align="center" class="fundoFormsSemPadding"><table border="0" cellpadding="0" cellspacing="0" width="99%" >
                  <tr>
                    <td height="22" align="left" nowrap class="bgAberto" style="padding-left:3px; padding-right:3px;">Chamado N&ordm; <?echo $_GET['id_chamado'];?></td>
                    <td width="913" align="right">
					
					<table width="90%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td align="right" width="71%">&nbsp;</td>
		
		
		<td align="center" width="10%" class="tituloAcompanharChamado">Ações</td>
		<td align="center" width="24%" class="conteudoAcompanharChamado" style="border-top:1;">
              
			  <?
					
					$sql20=mysql_query("select * from chamado where id_chamado=". $_GET['id_chamado']);
					
						
					while($reg20=mysql_fetch_assoc($sql20)){
					$status=$reg20['status'];
						
					
					if($status=="2"){
					?>
                <a href="enviar_arquivo.php?select5=<?echo $_GET['id_chamado'];?>"><img src="img/icone_detalhes_enviar.gif" width="24" height="16" hspace="0" vspace="1" border="0" style="cursor: help"  onMouseOver="mouseover2('Enviar Arquivo');" onMouseOut="mouseout();"></a>
				   <?} else {
			?>		
			            
			
				<?	}}?>
			  
			    
				
				
				<!--	<a href="#" style="cursor: help" onMouseOver="mouseover('Inscrição Online');" onMouseOut="mouseout();"><img src="img/icone_usuario_inscricaoonline.gif" width="20" height="14" hspace="3" vspace="1" border="0"></a>-->
				
				
						<a href="#ancora"><img src="img/icone_detalhes_inserir.gif" width="24" height="16" hspace="0" vspace="1" border="0"  style="cursor: help" onMouseOver="mouseover2('Enviar Mensagem');" onMouseOut="mouseout();"></a>		
				
  <?
					
					$sql20=mysql_query("select * from chamado where id_chamado=". $_GET['id_chamado']);
					
						
					while($reg20=mysql_fetch_assoc($sql20)){
					$status=$reg20['status'];
						
					
					if($status=="2"){
					?>
<img src="img/icone_detalhes_encerrar.gif" width="24" height="16" hspace="3" vspace="1" border="0"  style="cursor: help" onMouseOver="mouseover2('Encerrar Chamado');" onMouseOut="mouseout();" onClick="upload2(this.form);">
				   <?} else {
			?>		
			            
			
				<?	}}?>				


</td>
</tr>
		</table>
					
					
					</td>
                    </tr>
                  <tr>
                    <td height="2" colspan="2" align="left" nowrap style="padding-left:3px; padding-right:3px;"><img src="img/spacer.gif" width="50" height="2"></td>
                    </tr>
                </table>
                  <table border="0" cellpadding="0" cellspacing="0" width="99%" style="border:solid 1px #0B3685">
                    <tr>
                      <td width="22%" align="center" class="tituloAcompanharChamado"  style="padding-left:4px;">Criado em </td>
                      <td width="22%" align="center" class="tituloAcompanharChamado"  style="padding-left:4px;">Atualizado em </td>
                      <td width="22%" align="center" class="tituloAcompanharChamado"  style="padding-left:4px;">Produto</td>
                      <td width="17%" align="center" class="tituloAcompanharChamado"  style="padding-left:4px;">Classifica&ccedil;&atilde;o</td>
                      <td width="17%" align="center" class="tituloAcompanharChamado"  style="padding-left:4px;">Status</td>
                    </tr>
                  <?
				  $sql=mysql_query("select * from chamado where id_chamado=" . $_GET['id_chamado']);
				  while ($reg= mysql_fetch_assoc($sql)){
				  $produto=$reg['sistema_id'];
				  $criado=$reg['dataa'];
				  $email=$reg['email'];
				  $assunto=$reg['assunto'];
				  $horaa=$reg['horaa'];
				  }
				  ?>
				    <tr>
                      <td align="center" class="conteudoAcompanharChamado"><?
					  
					  $ano=substr("$criado",2, 2);
	                  $mes=substr("$criado",5, 2);
	                  $dia=substr("$criado",8, 2);
	                  echo $dia . "-". $mes . "-". $ano . "-" . $horaa; 
					 
					?></td>
                      <td align="center" class="conteudoAcompanharChamado">
					  <?
					  
					  $sqlatu=mysql_query("select max(dataa) as dataa, max(horaa) as horaa from contato where chamado_id=" . $_GET['id_chamado'] . "");

				      while($reg=mysql_fetch_assoc($sqlatu)){
					  $dataa=$reg['dataa'];
					  $horaa=$reg['horaa'];
					  
					  }
					  $ano=substr("$dataa",2, 2);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
					 
	                  echo $dia . "-". $mes . "-". $ano ."-". $horaa; 
					  
					  
					  ?></td>
                      <td align="center" class="conteudoAcompanharChamado" ><?$sql= mysql_query("select * from sistema where id_sistema=" . $produto);
					  while($reg=mysql_fetch_assoc($sql)){
					  $sistema=$reg['sistema'];
					  }
					  echo $sistema;
					  ?></td>
                      <td align="center" class="conteudoAcompanharChamado" >
                        <?
					 $sql7=mysql_query("select * from chamado where id_chamado=" . $_GET['id_chamado']);
				     while($reg2= mysql_fetch_assoc($sql7)){
					 $classificacao=$reg2['classificacao_id'];
					}
					if($classificacao!="0"){
					 $sql8=mysql_query("select * from classificacao where id=" . $classificacao);
				     while($reg3= mysql_fetch_assoc($sql8)){
					 $classificacao2=$reg3['descricao'];
					}
					 echo  $classificacao2;
					 } else {
					 echo "";
					 }
					?>
                      </td>
                      <td align="center" class="conteudoAcompanharChamado" >&nbsp;</td>
				    </tr>
				    <tr>
				      <td colspan="5" align="center" class="tituloAcompanharChamado"  style="padding-left:4px;">Assunto</td>
				      </tr>
				    <tr>
				      <td colspan="5" class="conteudoAcompanharChamado">
					  <?
				  $sqlassunto=mysql_query("select * from chamado where id_chamado=" . $_GET['id_chamado']);
				  while ($regassunto= mysql_fetch_assoc($sqlassunto)){
				 $assunto2=$regassunto['assunto'];  
					  echo $assunto2;}?>
					  
					  
					  &nbsp;</td>
				      </tr>
                   <?
				   
				   ?>
				  </table></td>
              </tr>
              <tr>
                <td height="12" align="center"><img src="img/spacer.gif" width="50" height="12"></td>
                </tr>
              <tr>
                <td height="5" align="center"><table border="0" cellpadding="0" cellspacing="0" width="99%" style="border:solid 1px #0B3685">
                  <tr>
                    <td colspan="2" align="center" class="tituloAcompanharChamado"  style="padding-left:2px;">Coment&aacute;rios</td>
                    </tr>
<?
					$sql2=mysql_query("select count(chamado_id) as total from contato where chamado_id=" . $_GET['id_chamado']);
					while($reg= mysql_fetch_assoc($sql2)){
					$numerocount=$reg['total'];
					}
$numerocount=$numerocount+1;

					?>
<?
				  $sql=mysql_query("select * from contato where chamado_id=" . $_GET['id_chamado'] . " order by dataa desc, horaa desc limit 1");
				  $tr=0;
				 
				  while($reg= mysql_fetch_assoc($sql)){
				  $dataa=$reg['dataa']; 
				  $horaa=$reg['horaa']; 
				  $historico=$reg['historico'];
				  $pessoacontatada=$reg['pessoacontatada'];
				  
  if ($v_id_cliente) {
    $historico = historicoChamado($id_chamado, $v_id_cliente);
	$contatos = count($historico);
    $sql20 = "SELECT status, nomecliente, descricao, email, dataa, sistema from chamado, sistema where  id_chamado=".$_GET['id_chamado'];
	$result = mysql_query($sql20) or Die($sql20);
	$linha = mysql_fetch_object($result);

	while ( list($tmp1, $tmp) = each($historico) ) {
	
				  
				  ?>
 <tr>
 <td width="30%" align="left" valign="middle" class="<?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>">
<strong>Contato:</strong> 
<?$numerocount=$numerocount-1; echo $numerocount;?>
<img src="img/spacer.gif" width="8" height="12">
<?
					 $ano=substr("$dataa",2, 2);
	                 $mes=substr("$dataa",5, 2);
	                 $dia=substr("$dataa",8, 2);
	                 echo $dia . "-". $mes . "-". $ano; 
					?>
/<?echo $horaa;?>
    <br>
    <strong>Autor:</strong> 
    <?	

echo peganomeusuario($tmp["consultor"]);
?>
    <br>
    <strong>Status:</strong> </td>
  <td width="70%" class="<?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?=$tmp["historico"];?></td>
 </tr>
				  
<?$tr=$tr+1;
 
}}}?>
				  
                </table></td>
              </tr>
              
              
              <tr>
                <td height="12" align="center"><img src="img/spacer.gif" width="50" height="12"></td>
              </tr>
              <tr>
                <td height="5" align="center"><table border="0" cellpadding="4" cellspacing="0" width="99%" >
                  <tr>
                    <td align="right" valign="top" class="fundoForms">Inserir Novo  Coment&aacute;rio: </td>
                    <td width="25%" align="right" class="fundoForms" id="ancora"><label>
					
					
				   <form name="detalhes" action="" method="post">
                      <textarea name="textarea" cols="50" rows="7" class="longtextField"></textarea>
					  <input type="hidden" name="numero" value="<?echo $_GET['id_chamado'];?>"
					  <input type="hidden" name="usuario" value="<?echo $pessoacontatada;?>">
					  <br>
					  
                      <a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('enviar','','img/bt_enviar_over.gif',1)"><img src="img/bt_enviar.gif" alt="Enviar" name="enviar" width="55" height="18" border="0" onClick="upload(this.form);"></a> 
                      </label>
				   </form> 
					
                      </td>
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
				  
				    <td width="49%" align="center" valign="top" class="fundoForms"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('bt_encerrra_chamado','','img/bt_encerrar_chamado_over.gif',1)">
					
					
					
					
					
					</a></td>
					<?
					
					$sql20=mysql_query("select * from chamado where id_chamado=". $_GET['id_chamado']);
					
						
					while($reg20=mysql_fetch_assoc($sql20)){
					$status=$reg20['status'];
						
					
					if($status=="2"){
					?>
                    <td width="51%" align="center" valign="top" class="fundoForms"><a href="http://intranet.datamace.com.br/interdevice/acompanhar_chamado.php?pagina=1&pag=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('bt_voltar','','img/bt_cancelar_over.gif',1)"><img src="img/bt_cancelar.gif" name="bt_voltar" width="59" height="18" border="0"></a></td>
                   <?} else {
			?>		
			                    <td width="51%" align="center" valign="top" class="fundoForms"><a href="http://intranet.datamace.com.br/interdevice/acompanhar_encerrados.php?pagina=1&pag=2" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('bt_voltar','','img/bt_cancelar_over.gif',1)"><img src="img/bt_cancelar.gif" name="bt_voltar" width="59" height="18" border="0"></a></td>

			
				<?	}}?>
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
