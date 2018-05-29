<?
/*
  Arquivo      : lista.php
  Descrição    : Utilizado pelos gerentes, esta página Lista os chamados marcados como rnc
  Autor        : Fernando Nomellini
  Data Criação : 19/09/2003
  Atualizações :   
*/
	require("../scripts/conn.php");
	require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
        $gerente = pegaGerente($ok);		  		
		if (  $ok<>$id_usuario || !$gerente) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}

  if (!isset($ordem)) {
    $ordem = 'dataa desc';
  }
  
  $sql =  "select id_chamado, left(descricao, 100) as descricao, dataa, horaa, datauc from chamado  ";
  $sql .= "where rnc and status != 1 ";
  $sql .= "order by $ordem ";
	
?>
<html>
<script src="../coolbuttons.js"></script>
<head>
<title>Novo chamado RNC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../scripts/stilos.css" type="text/css">
<link rel="stylesheet" href="../stilos.css" type="text/css">
<style type="text/css">
<!--
.bordafinaFonteMaior {

            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #003366; border: #CCCCCC;
            border-style: solid; 
            border-top-width: 1px;
            border-right-width: 1px;
            border-bottom-width: 1px; 
            border-left-width: 1px
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" background="../../agenda/figuras/fundo.gif" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true"><img src="../figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" A??à?9?˜Ÿ9??Ÿ9?class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="../figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="129" class="coolButton"><a href="../inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton"><a href="/agenda/" target="_blank">Agenda 
      Corporativa Datamace</a></td>
  </tr>
</table>
<hr size="1" noshade>
<div align="center">
  <p> <br>
    <strong>Chamados abertos marcados como RNC</strong></p>
  </div>
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
  <?
    $result = mysql_query($sql) or die ($sql);
	while ( $linha = mysql_fetch_object($result) ) {
	  $data = explode('-', $linha->dataa);
	  $dataa = "$data[2]/$data[1]/$data[0]";
	  $data = explode('-', $linha->datauc);
	  $datauc = "$data[2]/$data[1]/$data[0]";	  
	  $id = $linha->id_chamado;
	  $descricao = $linha->descricao;
      $descricao = eregi_replace("\r\n", "<br>",$descricao);
      $descricao = eregi_replace("\"", "`", $descricao);		     
  ?>
  <tr valign="middle"> 
    <td width="100%" align="center" bgcolor="#FCE9BC"><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr> 
          <td valign="top" bgcolor="#003366"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td bgcolor="#FCE9BC"> <table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr> 
                      <td bgcolor="#FCE9a0"><a href="lista.php?ordem=id_chamado desc">Chamado</a> : <b>
                        <a href="rnc.php?id_chamado=<?=$id?>"><?=$id?></a>
                        </b> | <a href="lista.php?ordem=dataa desc">Abertura</a> : <b>
                        <?=$dataa?>
                        </b> | <a href="lista.php?ordem=datauc desc">&Uacute;ltimo contato</a> : <b>
                        <?=$datauc?>
                        </b> </td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td bgcolor="#FCE9BC"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><br>
                  </font> <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr> 
                      <td><font size="1"> 
                    <b><?=$descricao?>...</b>
                        </font></td>
                    </tr>
                  </table>
                  <font face="Verdana, Arial, Helvetica, sans-serif" size="1">&nbsp; 
                  </font></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <?}?>
</table>


</body>
</html>
<SCRIPT>  
function alterna(item){
 if (item.style.display=='none'){
   item.style.display='';
 } else {
   item.style.display='none'
 }
}  
</SCRIPT>
