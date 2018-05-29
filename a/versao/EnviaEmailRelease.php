<?	require("../scripts/conn.php");	?>

<?
	// Tem tarefas ?
	$Sql = "SELECT count(1) as qtde FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND !ok";
	$result = mysql_query($Sql);
	$linha = mysql_fetch_object($result);
	$quantidade = $linha->qtde;
	
	if ($quantidade > 0) {



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
		
	   if ($tarefa) {
	     if( !$linha->ok ) {
           $tmp["tarefa"] = "<b><u>". $tmp["tarefa"] ."</u></b>";
		   $tmp["sublinha"] = 1;
		 }
		 
	     if ($andamento or $linha1->tabela=="i_administracao") {
		     if (  ! ( ($linha1->tabela == "i_administracao") and ($okconjunto) ) ) {
			   $tmp["tarefa"] = "<a href=http://10.98.0.5/a/versao/novatarefa.php?tabela=$linha1->tabela&id_conjunto=$id_conjunto>" . $tmp["tarefa"] . "</a>";
			 } else {
			   $tmp["tarefa"] = "<font color = #666666><i>" . $tmp["tarefa"] . "</i></font>";
			 }		 
			 
        }		
 
		

	   } 

	   
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
	

	$Sql = "select distinct  usuario.nome, usuario.email, usuario.id_usuario from usuario inner join i_tarefapessoa on usuario.id_usuario = i_tarefapessoa.id_usuario";
	$resultUsuarios = mysql_query($Sql);
	while ($linhaUsuario = mysql_fetch_object($resultUsuarios)) {
		

	$ok = $linhaUsuario->id_usuario;
		
//	if ( ($ok != 12) && ($ok != 8) )
//		continue;
	
?>
<?
$txtBody = "
<html>
<head>
<title>Minhas Tarefas</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<link rel=\"stylesheet\" href=\"http://10.98.0.5/a/stilos.css\" type=\"text/css\">
<style type=\"text/css\">
<!--
.style1 {font-size: x-large}
-->
</style>
</head>

<body bgcolor=\"#FFFFFF\" text=\"#000000\" leftmargin=\"1\" topmargin=\"1\" marginwidth=\"1\" marginheight=\"1\">
<DIV ID=\"overDiv\" STYLE=\"position:absolute; visibility:hide; z-index: 1;\"></DIV>
";
?>
<?
  $txtSQL = "SELECT id, sistema.sistema, versao, plataforma, data, hora, descricao, data_prev_liberacao FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND $NOT !ok ORDER BY data DESC, hora DESC;";
  $result = mysql_query($txtSQL);  
  $count = mysql_affected_rows();
?>
<?
$txtBody .= "
<br>
<table align=center width=99% border=0 cellspacing=1 cellpadding=1 bgcolor=#CCCCCC>
  <tr bgcolor=#333333> 
    <td colspan=7><b><font color=#FFFFFF size=2>Rela&ccedil;&atilde;o de 
      todos os releases 
      $m[2]
      : 
      $count
      </font></b></td>
  </tr>
  <tr valign=middle> 

    <td width=18% align=left bgcolor=#666666><b><font color=#FFFFFF>sistema</font></b></td>
    <td width=5% align=left bgcolor=#666666><b><font color=#FFFFFF>vers&atilde;o</font></b></td>
    <td width=9% align=left bgcolor=#666666><b><font color=#FFFFFF>plataforma</font></b></td>
    <td width=16% align=left bgcolor=#666666><b><font color=#FFFFFF>data/hora</font></b></td>
    <td width=36% align=left bgcolor=#666666><b><font color=#FFFFFF>Descri&ccedil;&atilde;o</font></b></td>
    <td width=14% align=right valign=middle bgcolor=#666666><b><font color=#FFFFFF>Data prevista libera&ccedil;&atilde;o </font></b></td>
  </tr>";
  ?>  
  <?
  while  ( $linha = mysql_fetch_object($result)) {
    $id_conjunto = $linha->id;
    $d = explode("-", $linha->data);
	$data = "$d[2]/$d[1]/$d[0]";
	$d = explode("-", substr(($linha->data_prev_liberacao),0,10));
	$previsao = "$d[2]/$d[1]/$d[0]";	  	
?> 	
<?
	$txtBody .= "
  <tr bgcolor=#CCCCCC> 

    <td width=18% align=left> <span id=sistemaconjunto".$id_conjunto.">" . $linha->sistema . "</span>    </td>
    <td width=5% align=left> 
      ". $linha->versao . " </td>
    <td width=9% align=left> 
      ". $linha->plataforma . "  </td>
    <td width=16% align=left> 
      ".$data . "  ".   $linha->hora . "</td>
    <td width=36% align=left> 
      $linha->descricao    </td>
    <td width=14% align=right valign=middle>
	$previsao
	</td>
  </tr>
  <tr valign=top> 
    <td bgcolor=#FFFFFF colspan=7>   <span id=conjunto".$id_conjunto." style=display: > 
      <table width=92% border=0 cellspacing=1 cellpadding=1 align=right>
        <tr bgcolor=#000000> 
          <td width=6%>
          <td width=26%><b><font color=#CCCCCC>Tarefa </font></b> 
          <td width=37% ><b><font color=#CCCCCC>Descri&ccedil;&atilde;o</font></b></td>
          <td width=15% ><b><font color=#CCCCCC>&Aacute;rea </font></b></td>
          <td width=16% valign=bottom align=right ><b><font color=#CCCCCC> 
            Status 
            </font></b></td>
        </tr>";
?>		
<?
  $tarefas = listatarefas( $id_conjunto, $ok, $andamento);  
  $sublinha = 0;
  while ( list($tmp1, $tmp) = each($tarefas) ) {
    $sublinha .= $tmp["sublinha"];
?>

<?

$txtBody .= "<tr bgcolor=$tmp[color]> 
          <td width=6% align=center > 
            $tmp[atencao]
          <td width=26%> 
            $tmp[tarefa]
          <td width=37% > 
            $tmp[descricao]         </td>
          <td width=15% > 
            $tmp[area]          </td>
          <td width=16% valign=bottom align=right > 
            $tmp[ok]          </td>
        </tr>";

?>

<?	
	}
?>

<?
$txtBody .= "
      </table>
      </span> </td>
  </tr>
  <script>
    if ($sublinha) {
       sistemaconjunto$id_conjunto.innerHTML = \"<b><a href=\"javascript:alterna(conjunto$id_conjunto, txtconjunto$id_conjunto, '+', '-');\"><u>\" + sistemaconjunto$id_conjunto.innerHTML + \"</u></a></b>\";
	} else {
       sistemaconjuntoid_conjunto.innerHTML = \"<a href=\"javascript:alterna(conjunto$id_conjunto, txtconjunto$id_conjunto, '+', '-');\">\" + sistemaconjunto$id_conjunto.innerHTML + \"</a>\";	
	}
  </script>
";
?>  
  <?
 }
 ?>
 
 <?
 $txtBody .= "
</table>
<font size=1> <br>
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
";
?>

<?	
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: Intranet Datamace<agenda@datamace.com.br>\n";
	$_email = $linhaUsuario->email;
	$subject = "Releases DTM";
	mail($_email, $subject, $txtBody, $headers);	 	  			
	
	} // End 	while ($linha = mysql_fetch_object($resultUsuarios)) {
	
	
}// End if quantidade > 0
?>