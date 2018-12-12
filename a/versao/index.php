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
	
	loga_online($ok, $REMOTE_ADDR, 'Tarefas');	


	$PodeEditarDataLiberacao = ($ok == 12) || ($ok == 8) || ($ok == 7) || ($ok == 1) ;

    $m[1]="";
	$m[2]="";    
    if ($NOT) {
      $andamento = 0;
	  $m[1] = "index.php";	  	  
	  $m[2] = "terminados";	  	
	  $m[3] = "em andamento";
	} else { 

	  $andamento = 1;	  
	  $m[1] = "index.php?NOT=NOT";
	  $m[2] = "em andamento";
	  $m[3] = "terminados";
	}	
   
	
	function listaTarefas($id_conjunto, $id_usuario, $andamento) {
      $okconjunto = 0;
	  $saida = array();
      $tmp["sublinha"] = 0;	  	  	  
	  
	  // Primeiro listo as tarefas do usuario
	  $sql = "select id_tarefa from i_tarefapessoa WHERE id_usuario = $id_usuario;";
	  $result = mysql_query($sql);
	  $tarefausuario = "...";
	  
	  while ( $linha=mysql_fetch_object($result) )  {
	    $tarefausuario .= "+$linha->id_tarefa";
	  }
	  
	  $sql1 = "SELECT * from i_tarefas WHERE ativo = 1 and tabela <> '' ORDER BY ordem;";
	  $result1 = mysql_query($sql1);
      $conta=0;
	  
	$ok_Anterior = false;
	while ( $linha1 = mysql_fetch_object($result1) ) {
	  

       $tarefa=0;	  
	   $tarefaAux = "+" . $linha1->id;
	   if (strpos( $tarefausuario, $tarefaAux) ) {
	     $tarefa = 1;  // Essa tarefa é desse usuario;
	   }
	  
	   
       // SQL : um pra cada tabela, le o arquivo tabela.sql
       // require( "$linha1->tabela.sql");

       $sql = "SELECT * from $linha1->tabela where id_conjunto = $id_conjunto;";
	   //Echo($sql);
       $result = mysql_query($sql) or die($sql);
	   $linha = mysql_fetch_object($result);
	   $data = explode("-", $linha->data);
	   $tmp["area"] = $linha1->area;
	   $tmp["descricao"] = $linha1->descricao;	   
	   $tmp["tarefa"] = $linha1->nome;
	   $tmp["tabela"] = $linha1->tabela;	   
       $tmp["t"] = $linha1->nome;
	 
			 
	   // pego o OK de todas as tabelas, menos a i_download;
	   if ( $linha1->tabela != 'i_administracao' ) {	   
	     $oktarefa = !$linha->ok;
		 $okconjunto = $okconjunto + $oktarefa ;
		}
		
		//Echo ("Estou aqui");
		//$tarefa indica se a tarefa é deste usuário.
	   if ($tarefa) {
	     if( !$linha->ok ) {
           $tmp["tarefa"] = "<b><u>". $tmp["tarefa"] ."</u></b>";
		   $tmp["sublinha"] = 1;
		 }
		 
/*	     
		if ($andamento or $linha1->tabela=="i_administracao") {
			if (  ! ( ($linha1->tabela == "i_administracao") and ($okconjunto) ) ) {
				$tmp["tarefa"] = "<a href=novatarefa.php?tabela=$linha1->tabela&id_conjunto=$id_conjunto>" . $tmp["tarefa"] . "</a>";
			} else {
				$tmp["tarefa"] = "<font color = #666666><i>" . $tmp["tarefa"] . "</i></font>";
			}		 
		}
*/ 
		if (!$ok_Anterior)
		{
			$tmp["tarefa"] = "<a href=novatarefa.php?tabela=$linha1->tabela&id_conjunto=$id_conjunto>" . $tmp["tarefa"] . "</a>";	
		} 
		else
		{
			$tmp["tarefa"] = "<font color = #666666><i>" . $tmp["tarefa"] . "</i></font>";
		}
		
		


	   } 
		$ok_Anterior = $oktarefa;
	   
       $tmp["atencao"] = "NA";
       if ($linha->existe) {
          $tmp["atencao"] = "<a href=\"javascript:alterna($linha1->tabela$id_conjunto, txt$linha1->tabela$id_conjunto, '+', '-');\">
                             <span id=txt$linha1->tabela$id_conjunto>
							 +
							 </span>
							 </a>";
	   } 
	   $quem = peganomeusuario($linha->id_usuario);	
	
	
	
	  if($linha->ok) {		
        $tmp["color"] = "#EBFEEB";
        $tmp["ok"] = "<font color=#006600><b>OK</b></font>";
        if (!$linha->existe) {
		  $tmp["atencao"] = "";
		}
	  } else {
	    $tmp["color"] = "#FFE6E6";
        $tmp["ok"] = "<font color=#ff0000>FALTA</font>";
	  }
	  


	    $cor = $tmp["color"];
		$a= "";		
	    $re = "$linha1->tabela" . ".inc";
		require($re);
        $re = "$linha1->tabela" . ".det";	

		$fp = fopen ($re, "r");
		while (!feof($fp)) {
			$buffer = fgets($fp, 4096);
			$a .= $buffer;
		}
		fclose($fp);
		$msg = eregi_replace("\"", "", $a);	

		eval ("\$msg = \"$msg\";");
     $tmp["resumo"] = $msg;		 
     $saida[$conta++] = $tmp;
	 

	  
	}  
	return $saida;
}	
	
	
	
?>
<html>
<head>
<title>Minhas Tarefas</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: x-large}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="../overlib.js"></SCRIPT>
<script src="../relatorios/coolbuttons.js"></script>
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
<p align="center"><font color="#FF0000"><font size="1"><b><br>
  <img src="../figuras/intro.gif" width="321" height="21"><br>
  </b></font></font><font size="3" color="#FF0000">Libera&ccedil;&atilde;o de 
  Release (
  <?=$m[2]?>
)</font></p>
<p> 
  <?
  $txtSQL = "SELECT id, sistema.sistema, versao, plataforma, data, hora, descricao, data_prev_liberacao FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND $NOT !ok ORDER BY data DESC, hora DESC limit 20;";
  $result = mysql_query($txtSQL) or die (mysql_error() . " <br><br> " + $txtSQL);  
  $count = mysql_affected_rows();
?>
  <br>
</p>
<table align="center" width="99%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr bgcolor="#333333"> 
    <td colspan="7"><b><font color="#FFFFFF" size="2">Rela&ccedil;&atilde;o de 
      todos os releases 
      <?=$m[2]?>
      : 
      <?=$count?>
      </font></b></td>
  </tr>
  <tr valign="middle"> 
    <td width="2%" align="center" bgcolor="#666666"><b><font color="#FFFFFF">+</font></b></td>
    <td width="18%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">sistema</font></b></td>
    <td width="5%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">vers&atilde;o</font></b></td>
    <td width="9%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">plataforma</font></b></td>
    <td width="16%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">data/hora</font></b></td>
    <td width="36%" align="left" bgcolor="#666666"><b><font color="#FFFFFF">Descri&ccedil;&atilde;o</font></b></td>
    <td width="14%" align="right" valign="middle" bgcolor="#666666"><b><font color="#FFFFFF">Data prevista libera&ccedil;&atilde;o </font></b></td>
  </tr>
  <?
  while  ( $linha = mysql_fetch_object($result)) {
    $id_conjunto = $linha->id;
    $d = explode("-", $linha->data);
	$data = "$d[2]/$d[1]/$d[0]";
	$d = explode("-", substr(($linha->data_prev_liberacao),0,10));
	$previsao = "$d[2]/$d[1]/$d[0]";	  	
?> 	
  <tr bgcolor="#CCCCCC"> 
    <td width="2%" valign="middle" align="center"> <a href="javascript:alterna(conjunto<?=$id_conjunto?>, txtconjunto<?=$id_conjunto?>, '+', '-');"> 
      <span id=txtconjunto<?=$id_conjunto?>> + </span> </a> </td>
    <td width="18%" align="left"> <span id=sistemaconjunto<?=$id_conjunto?>>
      <?=$linha->sistema?></span>    </td>
    <td width="5%" align="left"> 
      <?=$linha->versao?>    </td>
    <td width="9%" align="left"> 
      <?=$linha->plataforma?>    </td>
    <td width="16%" align="left"> 
      <?="$data  $linha->hora"?>    </td>
    <td width="36%" align="left"> 
      <?=$linha->descricao?>    </td>
    <td width="14%" align="right" valign="middle">
    
    <?
		$link_editar = "#";
		if ($PodeEditarDataLiberacao) {
	  		$link_editar = "AlteraDataLiberacao.php?id=$id_conjunto";
		}
    ?>
    
    <a href="<?=$link_editar?>">
		<?=$previsao?>
	</a>        
    </td>
  </tr>
  <tr valign="top"> 
    <td bgcolor="#FFFFFF" colspan="7">   <span id=conjunto<?=$id_conjunto?> style="display: none"> 
      <table width="92%" border="0" cellspacing="1" cellpadding="1" align="right">
        <tr bgcolor="#000000"> 
          <td width="6%">
          <td width="26%"><b><font color="#CCCCCC">Tarefa </font></b> 
          <td width="37%" ><b><font color="#CCCCCC">Descri&ccedil;&atilde;o</font></b></td>
          <td width="15%" ><b><font color="#CCCCCC">&Aacute;rea </font></b></td>
          <td width="16%" valign="bottom" align="right" ><b><font color="#CCCCCC"> 
            Status 
            </font></b></td>
        </tr>
        <?
  $tarefas = listatarefas( $id_conjunto, $ok, $andamento);  
  $sublinha = 0;
  while ( list($tmp1, $tmp) = each($tarefas) ) {
    $sublinha .= $tmp["sublinha"];
?>
        <tr bgcolor="<?=$tmp["color"]?>"> 
          <td width="6%" align="center" > 
            <?=$tmp["atencao"]?>
          <td width="26%"> 
            <?=$tmp["tarefa"]?>
          <td width="37%" > 
            <?=$tmp["descricao"]?>          </td>
          <td width="15%" > 
            <?=$tmp["area"]?>          </td>
          <td width="16%" valign="bottom" align="right" > 
            <?=$tmp["ok"]?>          </td>
        </tr>
        <tr bgcolor="#EAEAEA" valign="top"> 
          <td colspan="5"><span id=<?=$tmp["tabela"]?><?=$id_conjunto?> style="display: none"> 
            <?=$tmp["resumo"]?>
        </span>        </tr>
        <?	
	}
?>
      </table>
      </span> </td>
  </tr>
  <script>
    if (<?=$sublinha?>) {
       sistemaconjunto<?=$id_conjunto?>.innerHTML = "<b><a href=\"javascript:alterna(conjunto<?=$id_conjunto?>, txtconjunto<?=$id_conjunto?>, '+', '-');\"><u>" + sistemaconjunto<?=$id_conjunto?>.innerHTML + "</u></a></b>";
	} else {
       sistemaconjunto<?=$id_conjunto?>.innerHTML = "<a href=\"javascript:alterna(conjunto<?=$id_conjunto?>, txtconjunto<?=$id_conjunto?>, '+', '-');\">" + sistemaconjunto<?=$id_conjunto?>.innerHTML + "</a>";	
	}
  </script>
  <?
 }
 ?>
</table>
<br>
<table width="99%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF">
      <table width="750" border="0" cellspacing="1" cellpadding="1" align="center">
        <tr> 
          <td>Total de tarefas pendentes para voc&ecirc; : <font color=#0000ff><b>
            <? $c=i_contaTarefas($ok) ; if ($c<0) {$c=0;} ; echo $c;?>
            </B></font> </td>
        </tr>
        <tr> 
          <td><font size="1">tarefas com link (<a href="#">cor 
            azul</a>) = Tarefas designadas &agrave; voc&ecirc;. Clique 
            para abrir/Editar.</font></td>
        </tr>
        <tr>
          <td height="13"><font size="1">Sistema em<b><a href="#"><u> negrito 
            e sublinhado</u></a></b> s&atilde;o os sistemas em que existem tarefas 
            designadas a voc&ecirc; faltando OK</font></td>
        </tr>
        <tr> 
          <td><font size="1">tarefas em <b><a href="#"><u>negrito 
            e sublinhado</u></a></b> s&atilde;o as tarefas designadas a voc&ecirc; 
            que ainda n&atilde;o est&atilde;o OK. Clique para abrir.</font></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><font size="1">'NA' = ainda <font color="#FF0000">N&atilde;o Avaliado</font> 
            pelo respons&aacute;vel;</font></td>
        </tr>
        <tr> 
          <td><font size="1">'+' ou '-' = clique no sinal para expandir ou contrair;</font></td>
        </tr>
        <tr> 
          <td><font size="1">' ' (nada) = N&atilde;o existe a tarefa para o determinado 
            Release, a tarefa est&aacute; OK.</font></td>
        </tr>
        <tr> 
          <td> 
            <table width="32%" border="0" cellspacing="1" cellpadding="1" align="center">
              <tr valign="middle" align="center"> 
                <td bgcolor="#EBFEEB" width="50%">Tarefa <b><font color="#006666">OK</font></b></td>
                <td bgcolor="#FFE6E6" width="50%">Tarefa em <font color="#FF0000">FALTA</font></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> 
          <td valign="middle" align="center"> 
            <input type="button" name="Button2" value="Clique aqui para ver os releases <?=$m[3]?>" class="unnamed1" onClick="javascript:location.href=('<?=$m[1]?>');">          
<!--            <input type="button" name="Button2" value="Clique aqui para ver os releases <?=$m[3]?>" class="unnamed1" onClick="javascript:window.navigate('<?=$m[1]?>');"> -->
          </td>
        </tr>
        <?
	// Quem pode dar start no conjunto.
	$txtSQL = "select a.id_usuario from i_tarefas c, i_tarefapessoa a where (a.id_tarefa=c.id) and c.nome = 'start' and id_usuario=$ok;";
    $result = mysql_query($txtSQL);
    $start = mysql_affected_rows();
	if ($start) {
 ?>
        <tr> 
          <td valign="middle" align="center"> 
            <input type="button" name="Button" value="Clique aqui para criar um novo release" class="unnamed1" onClick="javascript:location.href='novoconjunto.php';">
          </td>
        </tr>
        <?		
	}
?>
      </table>
    </td>
  </tr>
</table>
<font size="1"> <br>
</font> 
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

</body>
</html>
