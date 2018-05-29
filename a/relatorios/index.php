<?
	require("../scripts/conn.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
   loga_online($ok, $REMOTE_ADDR, 'Relatórios');	
?>
<html>
<meta http-equiv="refresh" content="60;URL=../inicio.php">

<script src="coolbuttons.js"></script>
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
<meta http-equiv="refresh" content="60">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" >
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="/a/figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="/a/index.php?novologin=true"><img src="/a/figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="/a/figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="/a/trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="/a/inicio.php"><img src="/a/figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton">&nbsp;</td>
  </tr>
</table>
<hr size="1" noshade>
<font size="1">Usu&aacute;rio <font color="#FF0000">:<b> 
<?=$nomeusuario?>
</b></font></font> 
<p align="center"><font size="1"><font color="#FF0000"><b><img src="../figuras/intro.gif" width="321" height="21"><br>
  </b></font></font> </p>
<p align="center"><b><font size="3" color="#FF0000"> <img src="../figuras/relat.gif" width="20" height="20" align="absmiddle"> 
  Relat&oacute;rios</font></b></p>
<table width="70%" border="0" align="center" bgcolor="#666666" cellpadding="1" cellspacing="1">
  <tr> 
    <td bgcolor="#FCE9BC">01. <a href="r_001.php">Mostra Chamados, descri&ccedil;&atilde;o, 
      sistema, categoria e motivo.</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">02. <a href="listachamados.php">Idem acima. apenas chamados 
      abertos por mim</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">03. <a href="categorias.php">Relat&oacute;rio agrupado 
      por categoria</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">04. <a href="categoriamotivo.php">Relat&oacute;rio agrupado 
      por categorias e motivos</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">05. <a href="clienteschamados.php">Total de chamados 
      por cliente</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">06. <a href="clientescontatos.php">Total de contatos 
      por cliente</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">07. <a href="chamadospordia.php">Chamados por dia</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">08. <a href="chamadospordiadasemana.php">Chamados por 
      dia da semana</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">09. <a href="chamadospormes.php">Chamados por m&ecirc;s</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">10. <a href="chamadosMensal.php">Gr&aacute;fico mensal 
      de chamados</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">11. <a href="mediames.php">M&eacute;dia de contatos 
      por m&ecirc;s</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">12. <a href="versao.php">Sistemas e vers&atilde;o por 
      cliente</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">13. <a href="sistemamotivo.php">Relat&oacute;rio Agrupado 
      por Sistema e Motivos</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">14. <a href="../teste/clientesonline.php">Relat&oacute;rio 
      de chamados abertos por cliente</a> (Online)</td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">15. <a href="diag.php">Relat&oacute;rio de totaliza&ccedil;&atilde;o 
      de diagn&oacute;sticos</a> <strong></strong></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">16. <a href="tempoporsistema.php">Tempo de atendimento 
      por sistema </a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">17. <a href="tempoporcategoria.php">Tempo de atendimento 
      por categoria</a><strong></strong></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">18. <a href="relatorioidle.php">Relat&oacute;rio Gerencial</a> 
      (Restrito &agrave; administra&ccedil;&atilde;o)</td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">19. <a href="contatosporconsultor.php">Contatos por 
      consultor, por data e tipo de contato</a> </td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">20. <a href="pendencias.php">Relat&oacute;rio de Pendencias</a> 
      (Restrito &agrave; administra&ccedil;&atilde;o) </td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">21. <a href="r_021.php">Chamados com contatos 
      encaminhados</a></td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr> 
    <td bgcolor="#FCE9BC">22. <a href="/a/relatorios/relatbaseweb.php">Pesquisar 
      na Base de conhecimento</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">23. 
      <a href="clientestreinamento.php">
      Clientes com treinamento cobrado      </a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">24. <a href="usoconsultoria.php">10 Empresas que mais usam a consultoria </a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">25. <a href="r_025.php">Chamados em aberto</a> </td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">26. <a href="liberacao.php">Libera&ccedil;&atilde;o de chamados</a> </td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">27. <a href="tempo_de_uso.php">Tempo de uso da consultoria por cliente e consultor</a> </td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">28. <a href="iso9000.php">Gest&atilde;o SGQ</a> </td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">29. <a href="r_029.php">Registro de solicita&ccedil;&atilde;o de treinamento</a> </td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">30. <a href="r_030.php">Clientes em p&oacute;s-venda que foram   treinados</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">31. <a href="/a/relatorios/r_031.php">Chamados com contatos reabertos</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">32. <a href="/a/relatorios/r_032.php">Chamados abertos que tem contato meu</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC"><p>33. <a href="/a/relatorios/r_033.php">Clientes com GIP e BANCO DE DADOS</a></p></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">34. <a href="r_034.php">Tempo total de chamados de pós-venda e conversão</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">39. <a href="r_039.php">Meus encaminhamentos</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">40. <a href="r_040.php">Chamados com depend&ecirc;ncias</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">41. <a href="r_041.php">Quantidade de visualiza&ccedil;&otilde;es do recurso de rastreabilidade</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <? if ( ($ok == 98) || ($ok == 12) || ($ok == 7) ) {?>
  <tr>
    <td bgcolor="#FCE9BC">

        <DIV><A href="http://192.168.0.14/a/manut/restricoes.html">Manuten&ccedil;&atilde;o e Relacionamento de Restri&ccedil;&otilde;es:</A></DIV>
        <DIV><A href="http://192.168.0.14/a/manut/CadastroRestricoes.php">Cadastro de Restri&ccedil;&otilde;es para SAD:</A></DIV>
      <DIV><A href="http://192.168.0.14/a/estatisticas/fujitso/">Relat&oacute;rio Fujitsu:/</A></DIV>
          </td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC"><a href="../estatisticas/qualidade/index.php">Estat&iacute;sticas Qualidade</a></td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FCE9BC">&nbsp;</td>
  </tr>
  <? } ?>  
</table>
<p align="center"><font size="3"><b> </b></font></p>


</body>
</html>
