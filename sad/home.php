

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SAD - Sistema de Atendimento Datamace</title>
 <link rel="stylesheet" href="include/css.css">
</head>

<body>

<table border="0" cellpadding="0" cellspacing="0" height="68" width="100%">

  <tbody>

    <tr>

      <td width="5"><img src="img/spacer.gif" height="5" width="5"></td>

      <td height="35" width="100%">
      <table class="tituloPaginas" border="0" cellpadding="0" cellspacing="0" width="100%">

        <tbody>

          <tr>

            <td align="left" width="86"><img src="img/titulo_home.gif" width="86" height="33"></td>

            <td width="82%" align="center" valign="middle"><?$msg=$_SESSION['msg']; if($msg==""){ echo "";} else {echo "Login encerrado, Clique <a href='http://www.datamace.com.br/portalCliente/' style=' color:black;'>aqui</a> para voltar.";}?></td>
            <td align="right" width="103"><img src="img/grafismo_titulo.gif" width="103" height="33"> </td>
          </tr>
        </tbody>
      </table>

      </td>

      <td width="4"><img src="img/spacer.gif" height="5" width="8"></td>

    </tr>

    <tr>

      <td width="6"> </td>

      <td class="conteudoSite" align="center" width="100%">
	  <img src="img/spacer.gif" width="50" height="4" />
	  <table width="100%">
        <tbody>
          <tr>
            <td width="54%" align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0" height="368" width="98%">
                <tbody>
                  <tr>
                    <td width="4" height="265" rowspan="3" align="right" valign="top" background="img/aba_sombra_esq_bg.gif" ><img  src="img/aba_sombra_esq.gif" height="100%" width="4" ></td>
                    <td colspan="5" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 1px 1px 0px; background-color: rgb(245, 247, 250); padding-left: 3px;" height="14"><img src="img/titulo_aba1.gif"><br>
                    </td>
                    <td width="50%" height="14" align="left" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 0px 0px 1px;"><img  src="img/sombra_home.jpg" border="0" height="23" width="10"></td>
                    <td width="4" height="265" rowspan="3" align="left" valign="top" background="img/aba_sombra_dir_bg.gif"><img  src="img/aba_sombra_dir.gif" border="0" height="100%" width="4"></td>
                  </tr>
                  <tr>
                    <td height="331" colspan="6" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 0px 1px 1px; background-color: rgb(245, 247, 250); padding-right: 3px;"><ul>
                        <li>Abrir um chamado de suporte; </li>
                        <li>Visualizar o
                          andamento dos
                          chamados e inserir coment&aacute;rios;</li>
                        <li>Consultar os chamados encerrados por
                          per&iacute;odo;<br>
                        </li>
                        <li> Voc&ecirc; pode enviar um arquivo,
                        anexando-o a um chamado existente;<br>
                        </li>
                      <li>Consultar os usu&aacute;rios que
                        realizaram treinamentos;<br>
                        </li>
                      <li>Visualizar as datas de vencimento dos
                        encargos sociais;</li>
                    </ul>
                        <p style="padding-left: 8px; padding-top: 8px;"><img src="img/img_aba1.gif"></p>
                      <ul>
                          <li>Clique no &iacute;cone acompanhar
                            chamado e consulte os chamados em aberto. 
                            Se desejar, selecione entre;
                            Abertos pelo Cliente ou pela Datamace;</li>
                          <li>Para saber mais sobre os procedimentos e
                          prazos de resolu&ccedil;&atilde;o dos chamados, 
                          clique no link
                          abaixo e visualize o guia de suporte.</li>
                      </ul>
                      <table width="98%">
                          <tbody>
                            <tr>
                              <td width="7%" align="right"><img src="img/img_interrogacao.gif"> </td>
                              <td width="47%" align="left" style="font-size:9px"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="guia_de_suporte.pdf" target="_blank"><?} else { echo "<a href='#' class='menuTopo'>";}?>Guia de Suporte ao Usu&aacute;rio </a> </td>
                              <td width="46%" align="right" style="font-size:9px">
<script>
function resubmit(envia) {  
 location.href="ativa.php?acao=1";
}  
</script>
	  <input type="checkbox" name="checkbox" value="checkbox" <?$msg=$_SESSION['msg']; if($msg==""){ ?> onClick="resubmit(this.form)" <?} else { echo "";}?>>
                                Esconder janela </label>
	
	
								<?echo $_GET['categoria'];?>
							  </td>
                            </tr>
                          </tbody>
                      </table></td>
                  </tr>
                  <tr>
                    <td height="10" colspan="6" align="center" valign="top" background="img/aba_sombra_baixo.gif"><img src="img/aba_sombra_baixo.gif"  width="100" height="12" border="0"></td>
                  </tr>
                </tbody>
            </table></td>
            <td width="46%" align="right" valign="top"><table border="0" cellpadding="0" cellspacing="0" height="44%" width="98%">
                <tbody>
                  <tr>
                    <td width="3" height="265" rowspan="3" align="right" valign="top" background="img/aba_sombra_esq_bg.gif"><img  src="img/aba_sombra_esq.gif" height="100%" width="4"></td>
                    <td colspan="5" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 1px 1px 0px; background-color: rgb(245, 247, 250); padding-left: 3px;" height="14"><img src="img/titulo_aba2.gif" width="167" height="20" /><br>
                    </td>
                    <td width="55%" height="14" align="left" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 0px 0px 1px;"><img  src="img/sombra_home.jpg" border="0" height="23" width="10"></td>
                    <td width="3" height="265" rowspan="3" align="left" valign="top" background="img/aba_sombra_dir_bg.gif" ><img   src="img/aba_sombra_dir.gif" border="0" height="100%" width="4"></td>
                  </tr>
                  <tr>
                    <td height="252" colspan="6" align="center" valign="middle" style="border-style: solid; border-color: rgb(158, 170, 199); border-width: 0px 1px 1px; background-color: rgb(245, 247, 250); padding-right: 3px;"><table width="85%" height="179" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                             
		   
						    <td width="23%" height="99" valign="top"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="abertura.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('icone1','','img/icone1_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone1.gif" name="icone1" width="125" height="80" border="0" id="icone1" /></a></td>
                            <td width="23%" align="center"  valign="top"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="acompanhar_chamado.php?pagina=1&amp;pag=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('icone2','','img/icone2_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone2.gif" name="icone2" width="125" height="80" border="0" id="icone2" /></a></td>
                            <td width="23%" align="right"  valign="top"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="enviar_arquivo.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('icone3','','img/icone3_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone3.gif" name="icone3" width="125" height="80" border="0" id="icone3" /></a></td>
                          </tr>
                          <tr>
                            <td height="30" colspan="8" rowspan="1"><br />                            </td>
                          </tr>
                          <tr>
                            <td width="23%" valign="bottom"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="usuarios_treinados.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('icone4','','img/icone4_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone4.gif" name="icone4" width="125" height="80" border="0" id="icone4" /></a></td>
                            <td width="23%" align="center" valign="bottom"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="acompanhar_calendario.php?data=<?echo date("d/m/Y");?>&evento=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('icone5','','img/icone5_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone5.gif" name="icone5" width="125" height="80" border="0" id="icone5" /></a></td>
                            <td width="23%" align="right" valign="bottom"><?$msg=$_SESSION['msg']; if($msg==""){ ?><a href="estatisticas_sla.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('icone6','','img/icone6_over.gif',1)"><?} else { echo "<a href='#' class='menuTopo'>";}?><img src="img/icone6.gif" name="icone6" width="125" height="80" border="0" id="icone6" /></a></td>
                          </tr>
                        </tbody>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="10" colspan="6" align="center" valign="top" background="img/aba_sombra_baixo.gif" ><img  src="img/aba_sombra_baixo.gif" border="0" height="12" width="100"></td>
                  </tr>
                </tbody>
            </table></td>
          </tr>
        </tbody>
      </table></td>
      <td width="4"> </td>

    </tr>

  </tbody>
</table>

</body>
</html>
