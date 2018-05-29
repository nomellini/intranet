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
//	$conta = i_contaTarefas($ok);
	
	
	function listaTarefas($id_conjunto, $id_usuario) {
	
	  $saida = array();
	  
	  // Primeiro listo as tarefas do usuario
	  $sql = "select id_tarefa from i_tarefapessoa WHERE id_usuario = $id_usuario;";
	  $result = mysql_query($sql);
	  $tarefausuario = "...";
	  while ( $linha=mysql_fetch_object($result) )  {
	    $tarefausuario .= "+$linha->id_tarefa";
	  }
	  
	  $sql1 = "SELECT * from i_tarefas WHERE tabela <> '';";
	  $result1 = mysql_query($sql1);
      $conta=0;
	  
	  while ( $linha1 = mysql_fetch_object($result1) ) {

       $tarefa=0;	  
	   $tarefaAux = "+" . $linha1->id;
	   if (strpos( $tarefausuario, $tarefaAux) ) {
	     $tarefa = 1;  // Essa tarefa é desse usuario;
	   }
	  
	   
       // SQL : um pra cada tabela, le o arquivo tabela.sql
	   require( "$linha1->tabela.sql");
	   
	   
       $result = mysql_query($sql);
//	   echo "<br>$sql";
	   $linha = $linha=mysql_fetch_object($result);
	   
//	   $tmp["nome"] = $linha->nome;
	   $data = explode("-", $linha->data);
//	   $tmp["data"] = "$data[2]/$data[1]/$data[0]";
//	   $tmp["hora"] = $linha->hora;
	   $tmp["area"] = $linha1->area;
	   $tmp["descricao"] = $linha1->descricao;	   
	   $tmp["tarefa"] = $linha1->nome;
	   $tmp["t"] = $linha1->nome;
	   
	   
	   $tmp["atencao"] = "";
	   
	   if ($tarefa) {
	     if (!$linha->ok) {
           $tmp["atencao"] = "->";
		 }
	     $tmp["tarefa"] = "<a href=novatarefa.php?tabela=$linha1->tabela&id_conjunto=$id_conjunto>" . $tmp["tarefa"] . "</a>";
	   } 
	   
	   if ($linha->ok) {
		  $tmp["atencao"] = "<a href=\"javascript:alterna($linha1->nome$id_conjunto, txt$linha1->nome$id_conjunto, '+', '-');\">
                             <span id=txt$linha1->nome$id_conjunto>
							 +
							 </span>
							 </a>";
	   }	   
	   
	  if($linha->ok) {
	    $quem = peganomeusuario($linha->id_usuario);
		$existe = $linha->existe ? "SIM" : "Não";
//	    $msg =  "recebeu o OK de " . peganomeusuario($linha->id_usuario) . " no dia $data[2]/$data[1]/$data[0] às $linha->hora<br>";
		
	   // um msg para cada tabela 
	   if ( $linha1->tabela == "i_versao" ) {
	    $msg="";
		require("$linha1->tabela.inc");
		$fp = fopen ("$linha1->tabela.htm", "r");
		while (!feof($fp)) {
		  $buffer = fgets($fp, 4096);
		  $a .= $buffer;
		}
		fclose($fp);
		$msg = eregi_replace("\"", "", $a);	
		eval ("\$msg = \"$msg\";");
	   }
		
		
        $tmp["ok"] = "<font color=#0000ff>";		
		$tmp["ok"] .= "OK";
		$tmp["ok"] .= "</font>";
		$tmp["resumo"] = $msg;	   
	  } else {
        $tmp["ok"] = "<font color=#ff0000>NÃO OK</font>";
	  }	
     $saida[$conta++] = $tmp;
	  
	}  
	return $saida;
}	
	
	
	
?>
<html>
<head>
<title>Minhas Tarefas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="../overlib.js"></SCRIPT>

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
  </b></font></font><font size="4" color="#FF0000">Libera&ccedil;&atilde;o de 
  Release</font><b><font size="1" color="#FF0000"> </font></b></p>
<p>
  <?
  $txtSQL = "SELECT id, sistema.sistema, versao, plataforma, data, hora, descricao FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND NOT ok ORDER BY data;";
  $result = mysql_query($txtSQL);  
  $count = mysql_affected_rows();
?>
</p>
<table width="659" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr bgcolor="#333333"> 
    <td colspan="6"><b><font color="#FFFFFF" size="2">Rela&ccedil;&atilde;o de 
      todos os releases em andamento : 
      <?=$count?>
      </font></b></td>
  </tr>
  <tr valign="middle"> 
    <td width="3%" align="center" bgcolor="#666666"><b><font color="#FFFFFF">+</font></b></td>
    <td width="16%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">sistema</font></b></td>
    <td width="9%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">vers&atilde;o</font></b></td>
    <td width="11%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">plataforma</font></b></td>
    <td width="22%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">data/hora</font></b></td>
    <td width="39%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">Descri&ccedil;&atilde;o</font></b></td>
  </tr>
  <?
  while  ( $linha = mysql_fetch_object($result)) {
    $id_conjunto = $linha->id;
    $d = explode("-", $linha->data);
	$data = "$d[2]/$d[1]/$d[0]";
?>
  <tr bgcolor="#CCCCCC"> 
    <td width="3%" valign="middle" align="center"> <a href="javascript:alterna(conjunto<?=$id_conjunto?>, txtconjunto<?=$id_conjunto?>, '+', '-');"> 
      <span id=txtconjunto<?=$id_conjunto?>> + </span> </a> </td>
    <td width="16%" align="left"><a href="#"> 
      <?=$linha->sistema?>
      </a></td>
    <td width="9%" align="left"> 
      <?=$linha->versao?>
    </td>
    <td width="11%" align="left"> 
      <?=$linha->plataforma?>
    </td>
    <td width="22%" align="left"> 
      <?="$data  $linha->hora"?>
    </td>
    <td width="39%" align="left"> 
      <?=$linha->descricao?>
    </td>
  </tr>
  <tr valign="top"> 
    <td bgcolor="#FFFFFF" colspan="6"> <a href="#"> </a> 
	<span id=conjunto<?=$id_conjunto?> style="display: none">
      <table width="90%" border="0" cellspacing="1" cellpadding="1" align="right">
        <?
  $tarefas = listatarefas( $id_conjunto, $ok);
  while ( list($tmp1, $tmp) = each($tarefas) ) {
?>
        <tr> 
          <td width="4%" align="center" bgcolor="#EAEAEA"> 
            <?=$tmp["atencao"]?>
          <td width="26%" bgcolor="#EAEAEA"> 
            <?=$tmp["tarefa"]?>
          <td width="36%" bgcolor="#EAEAEA"> 
            <?=$tmp["descricao"]?>
          </td>
          <td width="21%" bgcolor="#EAEAEA"> 
            <?=$tmp["area"]?>
          </td>
          <td width="13%" valign="bottom" align="right" bgcolor="#EAEAEA"> 
            <?=$tmp["ok"]?>
          </td>
        </tr>
        <tr bgcolor="#EAEAEA" valign="top"> 
          <td colspan="5"><span id=<?=$tmp["t"]?><?=$id_conjunto?> style="display: none"> 
            <?=$tmp["resumo"]?>
            </span> 
        </tr>
        <?	
	}
?>
      </table>
	  </span>
    </td>
  </tr>
  <?
 }
 ?>
</table>
<?
	// Quem pode dar start no conjunto.
	$txtSQL = "select a.id_usuario from i_tarefas c, i_tarefapessoa a where (a.id_tarefa=c.id) and c.nome = 'start' and id_usuario=$ok;";
    $result = mysql_query($txtSQL);
    $start = mysql_affected_rows();
	if ($start) {
       echo("<br><a href=\"novoconjunto.php\">--> Clique aqui para iniciar mais um conjunto</a>");
	}
?>
<p>
  <SCRIPT>

  
function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
   item.style.display='';
   sp.innerHTML  = i2;
 } else {
   item.style.display='none'
   sp.innerHTML  = i1;
 }
}
  
</SCRIPT>
</p>
</body>
</html>
