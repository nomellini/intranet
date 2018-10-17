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


<body>
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
$dias = -3600;
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

		  <? include("include/menu.php"); 		  ?>		  
      </div></td>
       <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="1"></td>
          
		    <td height="35" width="100%">
			
			<table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
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
                <td height="5" align="right"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
       
	   
<?if($_GET['pag']=="2"){?>	   
	   
	          <tr>
<td height="25" align="left" class="fundoForms2">
				<form action="acompanhar_chamado.php"  method="get">
<table width="60%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="65" align="left" style="padding-left: 4px;">Buscar:</td> 
<td width="59" align="left" style="padding-left: 20px;">   
				<select name="select3" class="textField" onChange="location.href('acompanhar_chamado.php?pagina=<?echo $_GET['pagina'];?>&pag=<?echo $_GET['pag'];?>&select='+this.options[this.selectedIndex].value)">
				<option value="<?echo $_GET['select'];?>"> <?$select=$_GET['select']; if($select==""){ echo "Selecione!"; } else { echo $select;}?> </option>
				<option value="numero"> N&uacute;mero </option>
				<option value="Criado em"> Criado em </option>
				<option value="Atualizado em"> Atualizado em  </option>
				<option value="Assunto"> Assunto  </option>
				</select>
</span></td>
<td width="152" align="left" style="padding-left: 20px;">
<?if ($select=="Criado em"){?>
				<input name="textfield" type="text" OnKeyUp="mascaraData(this);" maxlength="10" class="textField" size="30%">
<?}?>
<?if ($select!="Criado em"){?>
				<input name="textfield" type="text" maxlength="10" class="textField" size="30%">
<?}?>	  
</span>
</td>
<td width="42" align="left" style="padding-left: 4px;">
				<input type="image" src="img/bt_buscar.gif" onClick="mascara(this.form);"></td>
				<input type="hidden" name="pag" value="<?$pag=$_GET['pag']; echo $pag;?>">
				</form>
</td>
</tr>
</table>
</td>
</tr>

<?} else {
echo "";
}


$textfield=$_GET['textfield'];
$select3=$_GET['select3'];
$pag=$_GET['pag'];
$numero=$tmp["chamado"];

$_sql = "select * from chamado where visible = 1 and sistema_id != 1024 and cliente_id='" . $v_id_cliente . "' and id_chamado LIKE '%". $textfield . "%' and status=2";


// $_sql = "select * from chamado where  visible = 1 and sistema_id != 1024 and  cliente_id='" . $v_id_cliente . "' and id_chamado LIKE '%". $textfield . "%' and externo=1 and status=2";
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
                    <td width="100" class="tituloAcompanharChamado" align="center">Aberto por </td>
                    <td width="280" class="tituloAcompanharChamado" align="center">Assunto</td>
                    <td width="80" class="tituloAcompanharChamado" align="center">Rastrear</td>                    
                  </tr>
				  <tr><td>
<?
if (  ($select3=="numero" && $pag=="1")  ){


$sql2 = mysql_query($_sql);

while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
$observacao=$reg2['observacao'];
?>

<tr >
    <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>" style="cursor: pointer;" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">
	<?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?>

	</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">&nbsp;<?echo $observacao;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 80);
echo $descricao;?>&nbsp;</td>

</tr> </a>
				   
		   
<?$tr=$tr+1;
		
}}

if ($select3=="numero" && $pag=="2"){


      
$sql2 = mysql_query("select * from chamado where  visible = 1 and sistema_id != 1024 and  cliente_id='" . $v_id_cliente . "' and id_chamado LIKE '%". $textfield . "%' and dataa >= '$xdata' and  status <> 2");

//$sql2 = mysql_query("select * from chamado where  visible = 1 and sistema_id != 1024 and cliente_id='" . $v_id_cliente . "' and id_chamado LIKE '%". $textfield . "%' and externo=0 and dataa >= '$xdata' and  status <> 2");


while($reg2=mysql_fetch_assoc($sql2)){
  

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
$observacao=$reg2['observacao'];
?>
<a href="detalhes_chamado.php?numero=<?echo $numero;?>" style="text-decoration: none; color: black;">
<tr>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">
	<?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?>
	</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?echo $observacao;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 80);
echo $descricao;?></td>

</tr> </a>
<?
}}


if ($select3=="Criado em" && $pag=="1"){
  $textfiel=$_GET['textfield'];
				  $ano=substr("$textfiel",6, 4);
	              $mes=substr("$textfiel",3, 2);
	              $dia=substr("$textfiel",0, 2);
				  
				  $textfield2=$ano . "-" . $mes . "-" . $dia;
$sql2 = mysql_query("select * from chamado where  visible = 1 and sistema_id != 1024 and cliente_id='" . $v_id_cliente . "' and dataa  LIKE '%". $textfield2 . "%' and status=2");

//$sql2 = mysql_query("select * from chamado where cliente_id='" . $v_id_cliente . "' and dataa  LIKE '%". $textfield2 . "%' and externo=1 and status=2");

while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
?>
<a href="detalhes_chamado.php?numero=<?echo $numero;?>" style="text-decoration: none; color: black;">
<tr>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">
	<?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?>
	</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">&nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 80);
echo $descricao;?></td>

</tr> </a>
<?
}}

if ($select3=="Criado em" && $pag=="2"){
$textfiel=$_GET['textfield'];
				  $ano=substr("$textfiel",6, 4);
	              $mes=substr("$textfiel",3, 2);
	              $dia=substr("$textfiel",0, 2);
				  
				  $textfield2=$ano . "-" . $mes . "-" . $dia;
$sql2 = mysql_query("select * from chamado where  visible = 1 and sistema_id != 1024 and cliente_id='" . $v_id_cliente . "' and dataa  LIKE '%". $textfield2 . "%' and  dataa >= '$xdata' and  status <> 2");

//$sql2 = mysql_query("select * from chamado where cliente_id='" . $v_id_cliente . "' and dataa  LIKE '%". $textfield2 . "%' and externo=0 and dataa >= '$xdata' and  status <> 2");


while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
?>
<a href="detalhes_chamado.php?numero=<?echo $numero;?>" style="text-decoration: none; color: black;">
<tr>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?>
    		-	<?=$data?>
            </td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">&nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 80);
echo $descricao;?></td>

</tr> </a>
<?}}


if ($select3=="Assunto" && $pag=="1"){
$sql2 = mysql_query("select * from chamado where  visible = 1 and sistema_id != 1024 and  cliente_id='" . $v_id_cliente . "' and descricao LIKE '%". $textfield . "%' and  status=2");

//$sql2 = mysql_query("select * from chamado where  visible = 1 and sistema_id != 1024 and cliente_id='" . $v_id_cliente . "' and descricao LIKE '%". $textfield . "%' and externo=1 and status=2");


while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
?>

<tr  id="<?$td1=$td1 + 1; echo $td1;?>" onMouseOver="document.getElementById(id).style.textDecorationUnderline='underline';" onMouseOut="document.getElementById(id).style.textDecoration='none';">
    <td onClick="detalhes_chamado.php?numero=<?echo $numero;?>" style="cursor: pointer;" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">&nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 80);
echo $descricao;?></td>
</tr> </a>



<?
}}

if ($select3=="Assunto" && $pag=="2"){
$sql2 = mysql_query("select * from chamado where  visible = 1 and sistema_id != 1024 and cliente_id='" . $v_id_cliente . "' and descricao   LIKE '%". $textfield . "%' and dataa >= '$xdata' and  status <> 2");
//$sql2 = mysql_query("select * from chamado where cliente_id='" . $v_id_cliente . "' and descricao   LIKE '%". $textfield . "%' and externo=0 and dataa >= '$xdata' and  status <> 2");

while($reg2=mysql_fetch_assoc($sql2)){

$numero=$reg2['id_chamado'];
$data=$reg2['dataa'];
$descricao=$reg2['descricao']; 
$cliente=$reg2['cliente_id'];
?>




<tr >
    <td onClick="detalhes_chamado.php?numero=<?echo $numero;?>" style="cursor: pointer;" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">&nbsp;</td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
    <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?  $descricao = substr( $descricao,0, 80);
echo $descricao;?></td>

</tr></a>
<?
}}

?>
</td></tr>

		  
<? 
	$fec=$_GET['pag']; 



	if ($fec==1 && $textfield==""){ 
	
	$strSql = "select * from chamado where  visible = 1 and sistema_id != 1024 and cliente_id='$v_id_cliente' and status=2  and dataa >= '$xdata' order by dataa desc, horaa desc";
//	$strSql = "select * from chamado where cliente_id='$v_id_cliente' and externo=1 and status=2  and dataa >= '$xdata' order by dataa desc, horaa desc";

  
$sql = mysql_query($strSql);
while($reg7= mysql_fetch_assoc($sql)){
$numero=$reg7['id_chamado'];
$data=$reg7['dataa'];
$descricao=$reg7['assunto']; 
if ($descricao == "") { 
	$descricao=$reg7['descricao']; 
}
$cliente=$reg7['cliente_id'];

  
  ?>
  <!-- FERNANDO NOMELLINI -->
  <tr id="<?$td1=$td1 + 1; echo $td1;?>" onMouseOver="document.getElementById(id).style.textDecorationUnderline='underline';" onMouseOut="document.getElementById(id).style.textDecoration='none';">
  <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"  align="center"><?echo $numero;?></td>
  <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?$ano=substr("$data",0, 4);	$mes=substr("$data",5, 2);	$dia=substr("$data",8, 2);	echo $dia . "-". $mes . "-". $ano;  ?></td>
  <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">  <?
					  
					  $sqlatu=mysql_query("select max(dataa) as dataa, max(horaa) as horaa from contato where chamado_id=" . $numero . "");

				      while($reg=mysql_fetch_assoc($sqlatu)){
					  $dataa=$reg['dataa'];
					  $horaa=$reg['horaa'];
					  
					  }
					  $ano=substr("$dataa",0, 4);
	                  $mes=substr("$dataa",5, 2);
	                  $dia=substr("$dataa",8, 2);
					 
	                  echo $dia . "-". $mes . "-". $ano; 
					  
					  
					  ?>
  <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?>&nbsp;</td>
  <td onClick="location.href = 'detalhes_chamado.php?id_chamado=<?echo $numero;?>';" class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?$descricao = substr( $descricao, 0 , 80); echo $descricao;?>&nbsp;</td>
  <td onClick="location.href = 'tramitacoes.php?id_chamado=<?echo $numero;?>';"  class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?$descricao = substr( $descricao, 0 , 80); ?>Rastrear</td>  
 </tr></a>
<?$tr=$tr+1;}  } ?>


<? $pag=$_GET['pag']; if ($pag=="2" && $textfield==""){



$tr1=1;
$total_reg = "20"; 
if(!$pagina) {$pc = "1";} else {$pc = $pagina;}
$numero_links = "7"; 
$intervalo = $numero_links;
$inicio = $pc-1;
$inicio = $inicio*$total_reg;


$condSQL="where  visible = 1 and cliente_id='" . $v_id_cliente . "' and dataa >= '$xdata' and  status <> 2";
//$condSQL="where externo=0 and cliente_id='" . $v_id_cliente . "' and dataa >= '$xdata' and  status <> 2";

$sql = mysql_query("select * from chamado ".$condSQL);
$tr = mysql_num_rows($sql);

  
$sqll = mysql_query("select * from chamado  $condSQL  LIMIT $inicio,$total_reg ");

 
$tp = ceil($tr/$total_reg);

while($reg7= mysql_fetch_assoc($sqll)){
$numero=$reg7['id_chamado'];
$data=$reg7['dataa'];
$descricao=$reg7['descricao']; 
if ($descricao == "") { 
	$descricao=$reg7['assunto']; 
}
$cliente=$reg7['cliente_id'];

  
  ?>
   <a href="detalhes_chamado.php?numero=<?echo $numero;?>" style="text-decoration: none; color: black;">
  <tr>
  <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?echo $numero;?></td>
  <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center"><?$ano=substr("$data",0, 4);
	$mes=substr("$data",5, 2);
	$dia=substr("$data",8, 2);
	echo $dia . "-". $mes . "-". $ano;  ?></td>
  <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>" align="center">&nbsp;</td>
  <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?echo $cliente;?></td>
  <td class=" <?if ($tr%2==0){?>conteudoAcompanharChamado<?} else {?>conteudoAcompanharChamado2<?}?>"><?$descricao = substr( $descricao, 0,  80); echo $descricao;?></td>
 </tr></a>
<?$tr=$tr+1;}?>



<?

echo "<table border='0'><tr><td class='font2'>&nbsp;";



$aux = $tp/$intervalo;
$aux1 = $pc/$intervalo;
$pi = $aux1 * $intervalo;
if ($pi == "0") {$pi = "1";}$pf = $pi + $intervalo -1;$anterior = $pi-$intervalo;
if($pc<=$intervalo) {$anterior = 1;}$aux2 = $pi + 1;
if($pi>1) {$aux = $pi - 1;$aux2 = $pi + 1;
echo "<table border='0'><tr><td class='font2'>&nbsp;";
echo "<b  class='class='font2'' ></b><a href='acompanhar_chamado.php?pag=2&$pagina=$aux' class='font2'><img src='img/bt_anterior.gif' border='0' hspace='5' align='middle'></a>&nbsp;";}
else{	
 echo "<font size='1' class='font2' face='Verdana'>&nbsp; ";	 
echo " <img src='img/bt_anterior.gif' border='0' hspace='5' align='middle'>";     
echo "</font>";}
for ($pi;$pi<$pf;$pi++) {     
 if($pi<=$tp) {          
 if($pc==$pi) {		  	 
 echo "<strong><font size='1' class='font2' face='Verdana'>";            
  echo "<b>[" . $pi . "]</b>&nbsp;";			 
  echo "</font></strong>";       
     } else {		     
  echo "<a  class='font1' href='acompanhar_chamado.php?pag=2&pagina=" . $pi . "'>" . $pi . "</a>&nbsp;";          }      }}
   if($pc != $tp){   	 
    echo "<strong><font size='1' class='font1' face='Verdana'>";      
	echo "<a class='class='font1' href='acompanhar_chamado.php?pag=2&pagina=$aux2'><img src='img/bt_proxima.gif' alt='Enviar' border='0' hspace='9' align='middle'></a> ";     
	 echo "</font></strong>";	}	
	 else	{ 	
	  echo "<font class='font2' size='1' face='Verdana'>";	 
	 echo "<img src='img/bt_proxima.gif' alt='Enviar' border='0' hspace='9' align='middle'>";  
	    echo "</font></td></tr></table>";	} 
}
	
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
