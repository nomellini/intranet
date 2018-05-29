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


<body>  <!--onLoad="mouse();"-->
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


<?
$evento=$_GET['evento'];
if ($evento=="1"){
header("Location:http://www.datamace.com.br/portalCliente/sad.asp?data=". $_GET['data']);
}else {
echo "";
}
?>

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
	<script type="text/javascript" src="include/estatisticaAjax.js"></script>
		  <? include("include/menu.php");?>		  
      </div>
	  
	  </td>
      <td width="100%" align="right" valign="top"><table width="99%" height="68" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>
            <td height="35" width="100%"><table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td align="left" width="80%"><img src="img/titulo_estatisticasla.gif" width="172" height="33"> </td>
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
                <td height="5" align="right"><img src="img/spacer.gif" width="1" height="5"></td>
                </tr>
              <tr>
                <td align="center" valign="top" class="fundoForms" style="padding:5px"><table width="99%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="35%" height="25" bgcolor="#0B3685" style="padding-left:4px; color:#FFFFFF; font-weight:bold;">Refer&ecirc;ncia - 
                      <label>
                      <select name="mes" class="textField" onChange="showUser(this.value)">
					  <?php
					 comboMesAno();
					 
					  ?> 
                      </select>
                      </label></td>
                    <td width="65%">&nbsp;</td>
                  </tr>
                  
                </table>
				<?php $dataHoje =  subDayIntoDateTraco(date('Ymd'),30);
				
				list ($diaHoje, $mesHoje, $anoHoje) = split ('[/.-]', $dataHoje);
				
				
				
				
				$SQLtotal="SELECT count(id_chamado)as tot FROM chamado WHERE cliente_id='" . $v_id_cliente . "' AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				$resultTotal=mysql_query($SQLtotal);
				while($linhaTotal=mysql_fetch_array($resultTotal))
				{
				$total = $linhaTotal['tot'];
				}
				
				$SQLaberto="SELECT count(id_chamado)as aberto FROM chamado WHERE cliente_id='" . $v_id_cliente . "' AND status = 2 AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				$resultAberto=mysql_query($SQLaberto);
				while($linhaAberto=mysql_fetch_array($resultAberto))
				{
				$aberto = $linhaAberto['aberto'];
				}
				
				$SQLabertoCliente="SELECT count(id_chamado)as aberto FROM chamado WHERE cliente_id='" . $v_id_cliente . "' AND cliente_id <> 'DATAMACE' AND status = 2 AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				$resultAbertoCliente=mysql_query($SQLabertoCliente);
				while($linhaAbertoCliente=mysql_fetch_array($resultAbertoCliente))
				{
				$abertoCliente = $linhaAbertoCliente['aberto'];
				}
				
				$SQLabertoDatamace="SELECT count(id_chamado)as aberto FROM chamado WHERE cliente_id='" . $v_id_cliente . "' AND cliente_id = 'DATAMACE' AND status = 2 AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				$resultAbertoDatamace=mysql_query($SQLabertoDatamace);
				while($linhaAbertoDatamace=mysql_fetch_array($resultAbertoDatamace))
				{
				$abertoDatamace = $linhaAbertoDatamace['aberto'];
				}
				
				
				//$SQLfechado="SELECT count(distinct(co.chamado_id))as pendente FROM chamado AS ch INNER JOIN contato as co ON ch.id_chamado=co.chamado_id WHERE ch.status<>2 AND co.status_id<>2 AND year(ch.dataa)=".$anoHoje." AND ch.externo =0 AND month(ch.dataa)=".$mesHoje;
				$SQLfechado="SELECT count(id_chamado)as fechado FROM chamado WHERE cliente_id='" . $v_id_cliente . "' AND status = 2 AND externo = 1 AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				$resultFechado=mysql_query($SQLfechado);
				while($linhaFechado=mysql_fetch_array($resultFechado))
				{
				$fechado = $linhaFechado['fechado'];
				}
				
				$SQLpendente="SELECT count(id_chamado)as pendente FROM chamado WHERE cliente_id='" . $v_id_cliente . "' AND status = 2 AND externo = 0 AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				//$SQLpendente="SELECT count(distinct(co.chamado_id))as pendente FROM chamado AS ch INNER JOIN contato as co ON ch.id_chamado=co.chamado_id WHERE ch.status=2 AND co.status_id=2 AND year(ch.dataa)=".$anoHoje." AND ch.externo =1 AND month(ch.dataa)=".$mesHoje;
				//echo $SQLpendente;
				$resultPendente=mysql_query($SQLpendente);
				while($linhaPendente=mysql_fetch_array($resultPendente))
				{
				$pendente = $linhaPendente['pendente'];
				}
				
				$SQLmontaChamado="SELECT distinct(chamado_id) cha FROM contato WHERE year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				$resultMonta=mysql_query($SQLmontaChamado);
				$chamadoConct ="";
				while($linhaMonta=mysql_fetch_array($resultMonta))
					{
						$montaChamado = $linhaMonta['cha'];
					if($chamadoConcat!=""){
						$chamadoConcat = $chamadoConcat.",".$montaChamado;
					}
					else{
						$chamadoConcat = $montaChamado;
					}
				}
				
				$SQLmontaAtende="SELECT id_chamado FROM chamado WHERE descricao <> '' and cliente_id='" . $v_id_cliente . "' AND status = 2 AND externo = 0 AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				$resultAtende=mysql_query($SQLmontaAtende);
				while($linhaAtende=mysql_fetch_array($resultAtende))
				{
						$atendoId = $linhaAtende['id_chamado'];
						
						$SQLatendeOrigem="SELECT MAX(id_contato)as id_contato FROM contato WHERE chamado_id=".$atendoId;
						
						$resultAtendeOrigem=mysql_query($SQLatendeOrigem);
						
								while($linhaAtendeOrigem=mysql_fetch_array($resultAtendeOrigem))
								{
									$SQLatendeOrigem2 = "SELECT origem_id FROM contato WHERE id_contato = " . $linhaAtendeOrigem['id_contato'];
									//echo (" $SQLatendeOrigem2 <br><br>");
									
									$resultAtendeOrigem2 = mysql_query($SQLatendeOrigem2) ;
									
									while($linhaAtendeOrigem2=mysql_fetch_array($resultAtendeOrigem2)){
								
											if($linhaAtendeOrigem2['origem_id']=56){
												$atende = $atende+1;
											}
											else{
												$aguardo = $aguardo+1;
											}
									}
								}
				}
					
				if($atende == ""){
					$atende = 0;
				}
				if($aguardo == ""){
					$aguardo = 0;
				}
				
				
				
				$SQLatende="";
						
				$SQLanalise="SELECT count(id_chamado)as analise FROM chamado WHERE id_chamado NOT IN(".$chamadoConcat.") AND status = 2 AND externo = 0 AND year(dataa)=".$anoHoje." AND month(dataa)=".$mesHoje;
				//echo $SQLanalise;
				$resultAnalise=mysql_query($SQLanalise);
				while($linhaAnalise=mysql_fetch_array($resultAnalise))
				{
					$analise = $linhaAnalize['analise'];
					if($analise==""){
					$analise=0;
					}
				}
				
				$SQLatendimento="SELECT count(chamdo_id) as atendimento FROM contato ";
				
				if($aberto!=0){
				$porcPendente = $pendente/($aberto/100);
				$porcPendente = round($porcPendente,2);
				}
				else{
					$porcPendente=0;
				}
				
				if($analise!=0){
				$porcAnalise = $analise/($pendente/100);
				$porcAnalise = round($porcAnalise,2);
				}
				else{
				$porcAnalise = 0;
				}
				
				if($aberto!=0){
					$porcFechado = $fechado/($aberto/100);
					$porcFechado = round($porcFechado,2);
				}
				else{
					$porcFechado = 0;
				}
				
				if($atende!=0){
					$porcAtende = $atende/($pendente/100);
					$porcAtende = round($porcAtende,2);
				}
				else{
					$porcAtende = 0;
				}
				
				if($aguardo!=0){
					$porcAguardo = $aguardo/($pendente/100);
					$porcAguardo = round($porcAguardo,2);
				}
				else{
					$porcAguardo = 0;
				}
				
				if($aberto!=0){
					$porcAbertoCliente = $abertoCliente/($aberto/100);
					$porcAbertoCliente = round($porcAbertoCliente,2);
				}
				else{
					$porcAbertoCliente = 0;
				}
								
				if($aberto!=0){
					$porcAbertoDatamace = $abertoDatamace/($aberto/100);
					$porcAbertoDatamace = round($porcAbertoDatamace,2);
				}
				else{
					$porcAbertoDatamace = 0;
				}
				?>
<div id="analise">
                  <table width="99%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="5" colspan="2" bgcolor="#0B3685"><img src="img/spacer.gif" width="1" height="5"></td>
                      </tr>
                    <tr>
                      <td width="50%" valign="top"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="3" class="tituloAcompanharCalendario">An&aacute;lise do Atendimento </td>
                          </tr>
                        <tr>                          
                          <td width="45%" class="conteudoEstatisticas"> Chamados Abertos</td>
                          <td width="45%" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem.gif" width="<?php if($aberto>0){echo "102";}else{echo "2";}  ?>" alt="<?=$aberto;?>" height="13"></td>
						  <td width="10%" class="conteudoEstatisticas" align="right"><?php if($aberto>0){echo "100%";}else{echo "0%";}  ?></td>
                        </tr>
                        <tr>
							<td colspan="3"><hr color="#9eaac7"></td>
						</tr>
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas"> Pelo Cliente </td>
                          <td align="left" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem0.gif" width="<?=$porcAbertoCliente+2?>" alt="<?=$abertoCliente?>" height="13"></td>
                          <td align="right" class="conteudoEstatisticas"><?=$porcAbertoCliente?>%</td>
						</tr>						
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas"> Pela Datamace </td>
                          <td align="left" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem0.gif" width="<?=$porcAbertoDatamace+2?>" alt="<?=$abertoDatamace?>" height="13"></td>
                          <td align="right" class="conteudoEstatisticas"><?=$porcAbertoDatamace?>%</td>
						</tr>
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas"> Encerrados </td>
                          <td align="left" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem1.gif" width="<?=$porcFechado+2?>" alt="<?=$fechado?>" height="13"></td>
                          <td height="19" align="right" class="conteudoEstatisticas"><?=$porcFechado?>%</td>
						</tr>
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas"> Pendentes </td>
                          <td align="left" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem2.gif" width="<?=$porcPendente+2?>" alt="<?=$pendente?>" height="13"></td>
                          <td align="right" class="conteudoEstatisticas"><?=$porcPendente?>%</td>
						</tr>                            
                      </table>

					  </td>
                      <td align="right" valign="top">
					  <table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="3" class="tituloAcompanharCalendario">Status dos Chamados  </td>
                        </tr>
                        <tr>                          
                          <td width="45%" class="conteudoEstatisticas"> Chamados Pendentes </td>
                          <td width="45%" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem2.gif" width="<? if($porcPendente>0){echo 102;}else{echo 2;} ?>" alt="<?=$pendente?>" height="13"></td>
						  <td width="10%" class="conteudoEstatisticas" align="right"><? if($porcPendente>0){echo 100;}else{echo 0;} ?>%</td>
                        </tr>
						<tr>
							<td colspan="3"><hr color="#9eaac7"></td>
						</tr>
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas">Em Atendimento  </td>
                          <td align="left" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem3.gif" width="<?=$porcAtende+2?>" alt="<?=$atende?>" height="13"></td>
						  <td align="right" class="conteudoEstatisticas"><?=$porcAtende?>%</td>
                        </tr>
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas">Aguardando Cliente </td>
                          <td align="left" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem4.gif" width="<?=$porcAguardo+2?>" alt="<?=$aguardo?>" height="13"></td>
						  <td align="right" class="conteudoEstatisticas"><?=$porcAguardo?>%</td>
                        </tr>
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas">Em an&aacute;lise por Sistemas </td>
                          <td align="left" class="conteudoEstatisticas"><img src="img/estatistica_porcentagem5.gif" width="<?=$porcAnalise+2?>" alt="<?=$analise?>" height="13"></td>
						  <td height="19" align="right" class="conteudoEstatisticas"><?=$porcAnalise?>%</td>
                        </tr>
                        <tr>                          
                          <td align="left" class="conteudoEstatisticas">Controle de Qualidade </td>
                          <td align="left" class="conteudoEstatisticas">'porcentagem'</td>
						  <td align="right" class="conteudoEstatisticas">'total'</td>
                        </tr>
                      </table></td>
                    </tr>
                  </table>
</div>
                  <img src="img/spacer.gif" width="50" height="5"><img src="img/spacer.gif" width="50" height="5"></td>
              </tr>
              <tr>
                <td height="5" align="center" valign="top" ><img src="img/spacer.gif" width="20" height="5"></td>
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
