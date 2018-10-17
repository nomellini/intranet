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

function mascara(name_form){
					var enviar = true;
if (name_form.select3.value=="" && enviar==true){
alert("* Preencha o campo Selecione!");
name_form.select3.focus();
enviar = false;

}


if(enviar==true){
name_form.submit();

}


}


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

<?     

  if ($v_id_cliente) {
  
  	//die($v_id_cliente);
  
    $chamadosAbertos = pegaChamadosPorCliente($v_id_cliente, 2);
	$qtdeAberto = count($chamadosAbertos);
	$chamadosFechados = pegaChamadosPorCliente($v_id_cliente, 1);
	$qtdeFechado = count($chamadosFechados); 


}	

//  loga_online(56, $REMOTE_ADDR, 'CLIENTE : Inicio : '. $v_id_cliente);

$hoje = date("Y-m-d");
$dias = -3650;
$xdata = "86400" * $dias +mktime(0,0,0,date('m'),date('d'),date('Y'));
$xdata = date("Y-m-d",$xdata);
?>
		
  <? include("include/topo.php");
  
 
  ?> 
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

		  <? include("include/menu.php");
		  
		  ?>		  
      </div></td>
       <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="1"></td>
          
		    <td height="35" width="100%">
			
			<table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="80%"><img src="img/titulo_acompanharencerrado.gif" width="172" height="33"> </td>
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
                <td height="5" align="right"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
       
	   
<?if($_GET['pag']=="2"){?>	   
	   
	          <tr>
<td height="25" align="left" style="background-color:#F5F7FA;">
				<form action="acompanhar_encerrados.php"  method="get">

<table width="99%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td  align="left" style="padding-left: 4px;">Buscar: 
   
				<select name="select3" class="textField" onChange="location.href('acompanhar_encerrados.php?pagina=1&pag=<?echo $_GET['pag'];?>&select='+this.options[this.selectedIndex].value)">
				<option value="<?echo $_GET['select'];?>"> <?$select=$_GET['select']; if($select==""){ echo "Selecione!"; } else { echo $select;}?> </option>
				<option value="Número"> Número </option>
				<option value="Criado em"> Criado em </option>
				<option value="Atualizado em"> Atualizado em  </option>
				<option value="Assunto"> Assunto  </option>
				</select>

<?

switch($select){ 
case "Criado em":
?>
		<input name="textfield" type="text" OnKeyUp="mascaraData(this);" maxlength="10" class="textField" size="30%">
<?
break;

case "Atualizado em":

?>
<input name="textfield" type="text" OnKeyUp="mascaraData(this);" maxlength="10" class="textField" size="30%">

<?break;?>

<?
default:
?>
				<input name="textfield" type="text" class="textField" size="30%">
<?
break;
}?>	  






				<input type="image" onClick="mascara(this.form);" src="img/bt_buscar.gif" align="middle"></td>
				<input type="hidden" name="pag" value="<?$pag=$_GET['pag']; echo $pag;?>">
				</form>
				
				
		

		<td align="right" style="font-size:9px;">		 
					Dados de <?
	$ano=substr("$xdata",0, 4);
	$mes=substr("$xdata",5, 2);
	$dia=substr("$xdata",8, 2);
	echo $dia . "-". $mes . "-". $ano;?> a <?$dataa=date("d-m-Y"); echo $dataa;?>
</td>
</tr>
</table>
</td>
</tr>

<?} else {
echo "";
}
?>				
<tr>
<td height="5" align="center"><img src="img/spacer.gif" width="50" height="5"></td>
</tr> 
<tr>
<td height="25" align="center" class="fundoFormsSemPadding">
<table border="0" cellpadding="0" cellspacing="0" width="99%"  style="border:solid 1px #0B3685;">
<tr>
<td width="100" class="tituloAcompanharChamado" align="center">N&uacute;mero</td>
<td width="100" class="tituloAcompanharChamado" align="center">Criado em </td>
<td width="100" class="tituloAcompanharChamado" align="center">Atualizado em </td>
<td width="100" class="tituloAcompanharChamado" align="center">Aberto por</td>
<td width="280" class="tituloAcompanharChamado" align="center">Assunto</td>
<td width="80" class="tituloAcompanharChamado" align="center">Rastrear</td>
</tr>
<tr><td>

<?
$select3=$_GET['select3'];
$textfield=$_GET['textfield'];
if ($select3=="Número"){

$sqlnumero = mysql_query("select * from chamado where publicar = '1' and id_chamado=".$textfield." and cliente_id='" . $v_id_cliente . "'");

while($regnumero=mysql_fetch_assoc($sqlnumero)){

$numero=$regnumero['id_chamado'];
$data=$regnumero['dataa'];
$descricao=$regnumero['descricao']; 
$cliente=$regnumero['cliente_id'];
?>

<tr id="<?$td1=$td1 + 1; echo $td1;?>" onMouseOver="document.getElementById(id).style.textDecorationUnderline='underline';" onMouseOut="document.getElementById(id).style.textDecoration='none';" style="cursor: pointer;">
    <td  onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>&ident=numero';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?echo $numero;?>&nbsp;</td>
    <td  onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>&ident=numero';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?> &nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center">
	<?$sql= mysql_query("select * from contato where id_contato=" . $numero);
					  while($reg=mysql_fetch_assoc($sql)){
					  $dataa=$reg['dataa'];
					  }
					  
					  $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
	                  echo $dia . "-". $mes . "-". $ano; 
					  
					  
					  ?> &nbsp;</td>
    <td  onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>&ident=numero';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?>&nbsp;</td>
    <td  onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>&ident=numero';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao, 0, 90);echo $descricao;?>&nbsp;</td>
    <td>&nbsp; </td>
</tr> </a>

<?$tr=$tr+1;
}
}




if ($select3=="Criado em" && $pag=="2"){
$textfiel=$_GET['textfield'];
				  $ano=substr("$textfiel",6, 4);
	              $mes=substr("$textfiel",3, 2);
	              $dia=substr("$textfiel",0, 2);
				  
				  $textfield2=$ano . "-" . $mes . "-" . $dia;
$sql2 = mysql_query("select * from chamado where publicar = '1' and cliente_id='" . $v_id_cliente . "' and dataa  LIKE '%". $textfield2 . "%' and publicar = '1'");
while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
?>

<tr onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>&ident=Criado em';" id="<?$td1=$td1 + 1; echo $td1;?>" onMouseOver="document.getElementById(id).style.textDecorationUnderline='underline';" onMouseOut="document.getElementById(id).style.textDecoration='none';" style="cursor: pointer;">
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?$sql= mysql_query("select * from contato where id_contato=" . $numero);
					  while($reg=mysql_fetch_assoc($sql)){
					  $dataa=$reg['dataa'];
					  }
					  
					  $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
	                  echo $dia . "-". $mes . "-". $ano; 
					  
					  
					  ?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 90);
echo $descricao;?></td>

    <td>&nbsp; </td>

</tr> </a>
<?$tr=$tr+1;}}


if ($select3=="Assunto" && $pag=="2"){
$sql2 = mysql_query("select * from chamado where publicar = '1' and cliente_id='" . $v_id_cliente . "' and descricao   LIKE '%". $textfield . "%' and publicar = '1'");
while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
?>




<tr onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>&ident=Assunto';" id="<?$td1=$td1 + 1; echo $td1;?>" onMouseOver="document.getElementById(id).style.textDecorationUnderline='underline';" onMouseOut="document.getElementById(id).style.textDecoration='none';" style="cursor: pointer;">
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?
	
	$sql= mysql_query("select * from contato where id_contato=" . $numero);
					  while($reg=mysql_fetch_assoc($sql)){
					  $dataa=$reg['dataa'];
					  }
					  
					  $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
	                  echo $dia . "-". $mes . "-". $ano; 
					  
					  
					  ?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 90);
echo $descricao;?></td>
    <td>&nbsp; </td>

</tr></a>
<?$tr=$tr+1;
}}

if ($select3=="Atualizado em" && $pag=="2"){
$textfiel=$_GET['textfield'];
				  $ano=substr("$textfiel",6, 4);
	              $mes=substr("$textfiel",3, 2);
	              $dia=substr("$textfiel",0, 2);
				  
				  $textfield2=$ano . "-" . $mes . "-" . $dia;
				  
$sql2 = mysql_query("select distinct(chamado_id) from contato where dataa  LIKE '%". $textfield2 . "%'");

while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['chamado_id'];

$sql3 = mysql_query("select * from contato where dataa  LIKE '%". $textfield2 . "%' and chamado_id=".$numero." Limit 1");

while($reg3=mysql_fetch_assoc($sql3)){


$data=$reg3['dataa'];
$descricao=$reg3['historico']; 
$cliente=$reg3['pessoacontatada'];
?>
<tr onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>&ident=Atualizado em';"   id="<?$td1=$td1 + 1; echo $td1;?>" onMouseOver="document.getElementById(id).style.textDecorationUnderline='underline';" onMouseOut="document.getElementById(id).style.textDecoration='none';" style="cursor: pointer;">  
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><? 
	$sql4= mysql_query("select * from chamado where publicar = '1' and id_chamado=" . $numero);
					  while($reg4=mysql_fetch_assoc($sql4)){
					  $dataa=$reg4['dataa'];
					  
					  $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
	                  echo $dia . "-". $mes . "-". $ano; 
					
	
	 ?>&nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?
	
	$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;
	  ?>&nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?>&nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao, 0, 90);
echo $descricao;?>&nbsp;</td>
    <td>AAAAA</td>

</tr> </a>
<?$tr=$tr+1;}}}
}
?>



	  

<? $pag=$_GET['pag']; if ($pag=="2" && $textfield==""){


/* [ Dados para paginação ] */

$tr1=1;
$total_reg = "20"; 
if(!$pagina) {$pc = "1";} else {$pc = $pagina;}
$numero_links = "10"; 
$intervalo = $numero_links;
$inicio = $pc-1;
$inicio = $inicio*$total_reg;

/* [ Pega todos os chamados fechados ] */

$condSQL="where cliente_id='" . $v_id_cliente . "' and  publicar = '1' and  status=1 and dataa >= '$xdata' order by dataa desc";
$sql = mysql_query("select * from chamado ".$condSQL) or die (mysql_error());
$tr = mysql_num_rows($sql);


$sqlpegachamados= mysql_query("select * from chamado where cliente_id='" . $v_id_cliente . "' and  publicar = '1' and  status=1 and dataa >= '$xdata' order by dataa desc, horaa desc LIMIT $inicio,$total_reg");
$tp = ceil($tr/$total_reg);

while($regpegachamados=mysql_fetch_assoc($sqlpegachamados)){
$idpegachamados=$regpegachamados['id_chamado'];
$data=$regpegachamados['dataa'];
$descricao=$regpegachamados['assunto']; 

if ($descricao=="") {
	$descricao=$regpegachamados['descricao']; 
}

$cliente=$regpegachamados['cliente_id'];
?>

      <tr id="<?$td1=$td1 + 1; echo $td1;?>" onMouseOver="document.getElementById(id).style.textDecorationUnderline='underline';" onMouseOut="document.getElementById(id).style.textDecoration='none';" style="cursor: pointer;">
        <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?=$idpegachamados?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?=$idpegachamados;?>&nbsp;</td>
        <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?=$idpegachamados?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">
  <?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?>
	
	&nbsp;</td>
        <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?=$idpegachamados?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">
		<?  $sqlatu=mysql_query("select max(dataa) as dataa, max(horaa) as horaa from contato where chamado_id=" . $idpegachamados . "");

				      while($reg=mysql_fetch_assoc($sqlatu)){
					  $dataa=$reg['dataa'];
					  $horaa=$reg['horaa'];
					  
					  }
					  $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
					 
	                  echo $dia . "-". $mes . "-". $ano; ?> &nbsp;</td>
	    <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?=$idpegachamados?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?echo $cliente;?>&nbsp;</td>
        <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?=$idpegachamados?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="left"><?$descricao = substr( $descricao, 0, 90); echo $descricao;?>&nbsp;</td>
        <td onClick="location.href = 'tramitacoes.php?id_chamado=<?=$idpegachamados?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" >Rastrear</td>
       </tr>
       
       </a>
	  <?$tr=$tr+1;

} /* [ Finaliza o while de todos os chamados ] */
 


echo "<form action='' name='demo' method='get'><table border='0'><tr><td class='font2'>&nbsp;";


$aux = $tp/$intervalo;
$aux1 = $pc/$intervalo;
$pi = $aux1 * $intervalo;
if ($pi == "0") {$pi = "1";}
$pf = $pi + $intervalo -1;
$anterior = $pi-$intervalo;

if($pc<=$intervalo) {$anterior = 1;}$aux2 = $pi + 1;

if($pi>1) {
$aux = $pi - 1;
$aux2= $pi + 1;

            echo "<a href='acompanhar_encerrados.php?pag=2&pagina=$aux' style='font-family: arial; color: black; text-decoration: none;'><img src='img/bt_anterior.gif' border='0' hspace='5' align='middle'></a>&nbsp;";}
else{	
 echo "<font face='Verdana'>";	 
 echo "";     
 echo "</font>";
    }

 for ($pi;$pi<$pf;$pi++) {     
 		if($pi<=$tp) {          
 			if($pc==$pi) {		  	 
				echo "<font size='1' class='font1' face='Verdana'>";
 					for($i==0;$i<=$tp;$i++){
					  if($i==$_GET['pagina']){
					
     					 echo "[<a href='acompanhar_encerrados.php?pag=2&pagina=$i' style='font-family: arial; color: black; text-decoration: none;'>" . $i . "</a>]";
     
											} ELSE {
						 echo "&nbsp;<a href='acompanhar_encerrados.php?pag=2&pagina=$i' style='font-family: arial; color: black; text-decoration: none;'>" .$i . "</a>&nbsp;";
						 
						 }
						 echo "</font>"; 	
	
											}	
							}}}
   if($pc != $tp){   	 
    echo "<strong><font face='Verdana'>";      
	echo "<a href='acompanhar_encerrados.php?pag=2&pagina=$aux2' style='font-family: arial; color: black; text-decoration: none;'><img src='img/bt_proxima.gif' border='0' hspace='9' align='middle'></a>";     
	echo "</font></strong>";	
	 
	 }	
	 else{ 	
	 echo "<font face='Verdana'>";	 
	 echo "";  
	 echo "</font></td></tr></table></form>";	
	 }
 
} /* [ Finaliza o IF ] */
?>
				</table>
				</table></td>
            </tr>
              <tr>
                <td height="5" align="center"><img src="img/spacer.gif" width="5" height="5"></td>
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
