<?
/*
  Arquivo      : /a/adm/index.php
  Autor        : Fernando Nomellini
  Data Criação : 29/01/2005
  
  Data das
  Alterações   : 08/02/2005
  
  Obs :  
  Deverá ser criada uma tabela para indicar o status do cliente, 
  se ele está em pós-venda ou não. Não devo criar um campo na tabela de clientes, 
  pois a tabela de clientes é recriada constantemente pelo DIP e com isso qualquer 
  informação que o sad alterar nesta tabela seria sobreposta. 
  
  Não é possível analisar o status do pós-venda somente olhando se tem um chamado 
  pós-venda, pois, se eu não permitir abrir um novo chamado com cliente em pós-venda, 
  e se esta verificação é feita vendo se tem um chamado de pós-venda, então, 
  o cliente nunca sairá do pós-venda, pois nunca iria se conseguir abrir um novo 
  chamado para sair do pós-venda. 

  Deve-se portanto, se criar uma tela em que seja possível alterar o status 
  do cliente para indicar se o mesmo está ou não em Pós-venda. Caso o cliente 
  estiver em pós-venda, só será possível abrir chamado pela administração 
  
  Quando o cliente for definido como fora do pós-venda, os chamados serão liberados para 
  abertura.
  
  A Tabela ClientePlus contém um campo chamado fl_posvenda boolean
  
  Todo registro da tabela cliente deve ter um correspondente na tabela ClientePlus.
  Um bom lugar para verificar isso é em /a/manut/backup.php, logo após a importação dos clientes.
  
  clisis:
  
  fl_posvenda - Indica se o cliente esta em pos vend aou nao
  ------------
  10 - Cliente Novo
  0 - Fora de pós venda.
  1 - Cliente em pós venda
  
  data_inicio = Data em que o cliente foi incluído no sistema
  data_inicioposvenda - Data em que o cliente foi inclupido no pós venda
  data_fimposvenda - Data em que o cliente foi retirado do pós venda
     
*/
	require("../scripts/conn.php");
	require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	


  
  function insereClientePlus($AId_cliente, $ACliente) {
    $datae = date("Y-m-d");  
    $CST_NOVOCLIENTE=10;
    $lStr = "insert into clienteplus (id_cliente, cliente, fl_posvenda, data_inicio) values ";
	$lStr .= "('$AId_cliente', '$ACliente', $CST_NOVOCLIENTE, '$datae') ";
	mysql_query($lStr) or Die("Fala ao inserir cliente na tabela clientePlus\n<br>$lStr");
  }


  $clientes = mysql_query("select id_cliente, cliente from cliente");
  while ( $linhaCliente = mysql_fetch_object($clientes) ) {
    $id_cliente = $linhaCliente->id_cliente;
	$cliente = $linhaCliente->cliente;
    $clientePlus = mysql_query("select id_cliente from clienteplus where id_cliente = '$id_cliente'");
    if (!$linhaPlus = mysql_fetch_object($clientePlus) ) {      
	  insereClientePlus($id_cliente, $cliente);
     }
  }


$datae = date("Y-m-d");  

if ($acao == 'novos') {
 $lQtdeClientes = count($frm_id_NovoCliente);
 for ($i=0; $i < $lQtdeClientes; $i++) {
   $lIdCliente = $frm_id_NovoCliente[$i];
   $lSql = "update clienteplus set fl_posvenda = 1, data_inicioposvenda='$datae' where id_cliente = '$lIdCliente'";
   mysql_query($lSql);   
 } 
}

if ($acao == 'tirarposvenda') {
 $lQtdeClientes = count($frm_Id_ClientePosVenda);
 for ($i=0; $i < $lQtdeClientes; $i++) {
   $lIdCliente = $frm_Id_ClientePosVenda[$i];
   $lSql = "update clienteplus set fl_posvenda = 0, data_fimposvenda='$datae'  where id_cliente = '$lIdCliente'";
   mysql_query($lSql);   
 } 
} else if ($acao == 'colocarposvenda') {
 $lQtdeClientes = count($frm_Id_NovoClientePosVenda);
 for ($i=0; $i < $lQtdeClientes; $i++) {
   $lIdCliente = $frm_Id_NovoClientePosVenda[$i];
   $lSql = "update clienteplus set fl_posvenda = 1, data_inicioposvenda='$datae'  where id_cliente = '$lIdCliente'";
   mysql_query($lSql);   
 } 
}

?>
<html>
<head>
<script src="../coolbuttons.js"></script>
<title>Administração SAD</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../scripts/stilos.css" type="text/css">
<link rel="stylesheet" href="../stilos.css" type="text/css">
<style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; }
.style9 {color: #FFFFFF; font-weight: bold; font-size: 12px; }
.style10 {
	color: #FF0000;
	font-weight: bold;
}
.style11 {font-size: 12px}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" >

<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="../index.php?novologin=true"><img src="../figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="../figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="../trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="../inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton"><a href="/agenda/" target="_blank">Agenda 
      Corporativa Datamace</a></td>
  </tr>
</table>
<hr size="1" noshade>
<form name="form" method="post" action="">
  <p>&nbsp;</p>
  <table width="80%"  border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="120">Pesquisar Cliente </td>
      <td><input name="txtPesquisa" type="text" class="borda_fina" id="txtPesquisa" size="50" maxlength="120">
        <input name="Button" type="button" class="borda_fina" value="Ok" onClick="javascript:document.form.acao.value='pesquisar';vai();">
        </td>
    </tr>
    <tr>
      <td width="120">&nbsp;</td>
      <td>        *Fa&ccedil;a uma pesquisa para colocar um cliente em p&oacute;s venda. (<span class="style11">Clique em OK</span>) </td>
    </tr>
  </table>
  <br>
  <?
    if ($acao=='pesquisar') {
  ?>
  <table width="80%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="tblClientes" summary="Tabela que mostra quais clientes s&atilde;o novos. Pede para determinar quais deles ser&atilde;o p&oacute;s-venda e quais n&atilde;o ser&atilde;o.">
    <caption>
    <span class="style10">  Pesquisa de cliente    </span>
    </caption>
    <tr bgcolor="#FFFFCC">
      <td width="120" align="center" valign="middle"><span class="style10">Colocar em <br>
      P&oacute;s venda </span></td>
      <td><span class="style10">Cliente </span></td>
    </tr>
    <?
  $lSql = "select id_cliente, cliente from ";
  $lSql .= "clienteplus ";
  $lSql .= "where (id_cliente like '$txtPesquisa*') or (cliente like '%$txtPesquisa%');"; 

  $clientes = mysql_query($lSql) or Die ($lSql);
  
  while ( $linhaCliente = mysql_fetch_object($clientes) ) {
    $id_cliente = $linhaCliente->id_cliente;
	$cliente = $linhaCliente->cliente;
?>
    <tr bgcolor="#FFFFFF">
      <td width="120" align="center" valign="middle">
        <input name="frm_Id_NovoClientePosVenda[]" type="checkbox" id="frm_Id_ClientePosVenda[]2" value="<?=$id_cliente?>">
      </td>
      <td><?="$cliente ('$id_cliente')" ?></td>
    </tr>
    <?
}
?>
    <tr bgcolor="#FFFFFF">
      <td width="120" align="center" valign="middle"></td>
      <td><input name="ok22" type="button" class="borda_fina" id="ok22" value="ok" onClick="javascript:document.form.acao.value='colocarposvenda';vai();">
      *Selecione os clientes resultantes da pesquisa e clique em OK para coloca-los em p&oacute;s venda. </td>
    </tr>
  </table>
 
  <br>
  <?
}
  ?>
  
  <table width="80%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#000000" id="tblClientes" summary="Tabela que mostra quais clientes s&atilde;o novos. Pede para determinar quais deles ser&atilde;o p&oacute;s-venda e quais n&atilde;o ser&atilde;o.">
  <caption>
  Clientes em P&oacute;s-Venda.
  </caption>
  <tr bgcolor="#003366">
    <td width="120" align="center" valign="middle"><span class="style9">TIRAR DO<br>
      P&oacute;s venda </span></td>
    <td><span class="style9">Cliente [Data in&iacute;cio p&oacute;s-venda]</span></td>
  </tr>
  <?
  $lSql = "select id_cliente, cliente, data_inicioposvenda  from ";
  $lSql .= "clienteplus ";
  $lSql .= "where (clienteplus.fl_posvenda = 1);"; 

  $clientes = mysql_query($lSql) or Die ($lSql);
  
  while ( $linhaCliente = mysql_fetch_object($clientes) ) {
    $id_cliente = $linhaCliente->id_cliente;
	$cliente = $linhaCliente->cliente;
	$data = $linhaCliente->data_inicioposvenda;
	$data = explode('-', $data);
	$datainicio = "$data[2]/$data[1]/$data[0]"
	
?>
  <tr bgcolor="#FFFFFF">
    <td width="120" align="center" valign="middle">
      <input name="frm_Id_ClientePosVenda[]" type="checkbox" id="frm_Id_ClientePosVenda[]" value="<?=$id_cliente?>">    </td>
    <td><?="$cliente ('$id_cliente') [$datainicio]"?></td>
  </tr>
  <?
}
?>
  <tr bgcolor="#FFFFFF">
    <td width="120" align="center" valign="middle"></td>
    <td><input name="ok2" type="button" class="borda_fina" id="ok2" value="ok" onClick="javascript:document.form.acao.value='tirarposvenda';vai();">
      *Para tirar um cliente da situa&ccedil;&atilde;o p&oacute;s venda, selecione um ou mais clientes e clique em OK. </td>
  </tr>
</table>
<br>
<table width="80%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="tblClientes" summary="Tabela que mostra quais clientes são novos. Pede para determinar quais deles serão pós-venda e quais não serão.">
  <caption>
  Novos clientes.
  </caption>
  <tr bgcolor="#666666">
    <td width="120" align="center" valign="middle"><span class="style4">P&oacute;s venda </span></td>
    <td><span class="style4">Cliente [Data cadastro do cliente no sistema] </span></td>
  </tr>
  
<?
  $lSql = "select id_cliente, cliente, data_inicio from ";
  $lSql .= "clienteplus ";
  $lSql .= "where (clienteplus.fl_posvenda = 10);";
  

  $clientes = mysql_query($lSql) or Die ($lSql);
  
  while ( $linhaCliente = mysql_fetch_object($clientes) ) {
    $id_cliente = $linhaCliente->id_cliente;
	$cliente = $linhaCliente->cliente;
	$data = $linhaCliente->data_inicio;
	$data = explode('-', $data);
	$datainicio = "$data[2]/$data[1]/$data[0]"
?>  
  
  <tr bgcolor="#FFFFFF">
    <td width="120" align="center" valign="middle">
      <input name="frm_id_NovoCliente[]" type="checkbox" id="frm_id_NovoCliente[]" value="<?=$id_cliente?>">    </td>
    <td><?="$cliente ('$id_cliente')  [$datainicio]" ?></td>
  </tr>
  
<?
}
?>
  <tr bgcolor="#FFFFFF">
    <td width="120" align="center" valign="middle"></td>
    <td><input name="ok" type="button" class="borda_fina" id="ok" value="ok" onClick="javascript:document.form.acao.value='novos';vai();">
    *Clientes novos aparecer&atilde;o nesta lista, para coloca-los na situa&ccedil;&atilde;o de p&oacute;s venda, selecione um ou mais clientes e clique em OK </td>
  </tr>
</table>
<input name="acao" type="hidden" id="acao">
</form>
 <br>
<br>
</body>
</html>
<script>
  function vai() {
    document.form.submit();
  }
</script>
