<?php
    require("../scripts/conn.php");
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}


	$sql = "select id from i_conjunto where not ok";
	$result = mysql_query($sql);
	$linha=mysql_fetch_object($result);
	$tem = mysql_affected_rows();

	
	if ($tem > 0) {

	$data_atual = date("d m Y");

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
	
	
	  global $data_release;
	
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
	  
	  $sql1 = "SELECT * from i_tarefas WHERE tabela <> '' ORDER BY ordem;";
	  $result1 = mysql_query($sql1);
      $conta=0;
	  while ( $linha1 = mysql_fetch_object($result1) ) {
	 
	  
$Usuarios = "select usuario.nome, usuario.email, usuario.login, usuario.id_usuario from usuario inner join i_tarefapessoa on usuario.id_usuario = i_tarefapessoa.id_usuario where i_tarefapessoa.id_tarefa = $linha1->id order by nome";
	  $uResult = mysql_query($Usuarios);
	  $u = "";
	  while ($usuario=mysql_fetch_object($uResult)) {
	    $u .= "$usuario->nome ou ";
	  }
	  $u = substr($u, 0, strlen($u)-4) . ".";

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
	  
	   
	   $tmp["area"] = $linha1->area;
	   $tmp["descricao"] = $linha1->descricao;	   
	   $tmp["tarefa"] = $linha1->nome;
	   $tmp["tabela"] = $linha1->tabela;	   
       $tmp["t"] = $linha1->nome;
	   $tmp["usuarios"] = $u;
	   
	     
	   
	   // pego o OK de todas as tabelas, menos a i_download;
	   if ( $linha1->tabela != 'i_administracao' ) {
	   
	     $oktarefa = !$linha->ok;
		 
		 $okconjunto = $okconjunto + $oktarefa ;
		}
		
		
	   if ($tarefa) {
	   
	     if( !$linha->ok ) {
           $tmp["tarefa"] = "<b>". $tmp["tarefa"] ."</b>";
		 }
		 
 
		
           $tmp["tarefa"] = $tmp["tarefa"];		   		

	   } 

	   
       $tmp["atencao"] = "NA";
	   /*
       if ($linha->existe) {
          $tmp["atencao"] = "<a href=\"javascript:alterna($linha1->tabela$id_conjunto, txt$linha1->tabela$id_conjunto, '+', '-');\">
                             <span id=txt$linha1->tabela$id_conjunto>
							 +
							 </span>
							 </a>";
	   } 
	   */
	   $quem = peganomeusuario($linha->id_usuario);	
	
	
	
	  if($linha->ok) {		
        $tmp["ok"] = "<font color=#006600><b>OK</b></font>";
        $tmp["atencao"] = "<font color=#006600><b>OK</b></font>";		
	  } else {

        $tmp["ok"] = "<font color=#ff0000>FALTA</font>";
        $tmp["atencao"] = "<font color=#ff0000>FALTA</font>";	
        $tmp["tarefa"] = "<b>". $tmp["tarefa"] ."</b>";			
	  }
	  
	  
	$tmp["color"] = "#DDFFEE";

		if (!$linha->ok) {
			$saida[$conta++] = $tmp;
		}
	 

	  
	}  
	return $saida;
}	
	
	
	
  $txtSQL = "SELECT id, sistema.sistema, versao, plataforma, data, hora, descricao, data_prev_liberacao FROM i_conjunto, sistema WHERE (sistema.id_sistema = i_conjunto.id_sistema) AND $NOT !ok ORDER BY data DESC, hora DESC;";
  $result = mysql_query($txtSQL);  
  $count = mysql_affected_rows();
  
  
  $headers  = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  $headers .= "From: Intranet Datamace<agenda@datamace.com.br>\n";

  $subject = "Releases";
  
  $emailpadrao = "fernando.nomellini@datamace.com.br";
 
  
  $textEmail ="";
  $textEmail .= "  
<style type=\"text/css\">
<!--
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
.style9 {color: #333333; font-weight: bold; }
.style11 {color: #00FFFF}
-->
</style>

<table align=\"center\" width=\"99%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" bgcolor=\"#CCCCCC\">
  <tr bgcolor=\"#333333\">
    <td colspan=\"7\"><span class=\"style2\">Releases em aberto com tarefas pendentes</span></td>
  </tr>
  <tr valign=\"middle\">
    <td width=\"2%\" align=\"center\" bgcolor=\"#666666\"><span class=\"style1\">+</span></td>
    <td width=\"18%\" align=\"left\" bgcolor=\"#666666\"><span class=\"style2\"><b>sistema</b></span></td>
    <td width=\"5%\" align=\"left\" bgcolor=\"#666666\"><span class=\"style2\"><b>vers&atilde;o</b></span></td>
    <td width=\"9%\" align=\"left\" bgcolor=\"#666666\"><span class=\"style2\"><b>plataforma</b></span></td>
    <td width=\"16%\" align=\"left\" bgcolor=\"#666666\"><span class=\"style2\"><b>data/hora</b></span></td>
    <td width=\"36%\" align=\"left\" bgcolor=\"#666666\"><span class=\"style2\"><b>Descri&ccedil;&atilde;o</b></span></td>
    <td width=\"14%\" align=\"right\" valign=\"middle\" bgcolor=\"#666666\"><span class=\"style2\"><b>Data prevista libera&ccedil;&atilde;o </b></span></td>
  </tr>";
  while  ( $linha = mysql_fetch_object($result)) {
  
    $id_conjunto = $linha->id;
	$data_release = $linha->data;
	
    $d = explode("-", $linha->data);
	$data = "$d[2]/$d[1]/$d[0]";
	$d = explode("-", substr(($linha->data_prev_liberacao),0,10));
	$previsao = "$d[2]/$d[1]/$d[0]";	 
	$bgColor =  $tmp["color"];	
	
	$data1 = explode("-", $linha->data_prev_liberacao ); 
	$dia = $data1[2];
	$mes = $data1[1];
	$ano = $data1[0];
	$d_garan = strtotime("+7 day", mktime(0, 0, 0, $mes, $dia, $ano));
	$amanha = date("Y-m-d",$d_garan);  
	
	
	$data2 = explode("-", $amanha ); 
	$dia = $data2[2];
	$mes = $data2[1];
	$ano = $data2[0];
	$vencimento = mktime(0, 0, 0, $mes, $dia, $ano);
	
	
	$data3 = date("Y-m-d"); 
	$data1 = explode("-", $data3 ); 
	$dia = $data1[2];
	$mes = $data1[1];
	$ano = $data1[0];
	$hoje = mktime(0, 0, 0, $mes, $dia, $ano);		
	
	if( $vencimento <= $hoje )
		$bgColor = "#FFD9DA";
	else
		$bgColor = "#CEEFFF";
	
  
  $textEmail .= "
  <tr bgcolor=\"#CCCCCC\">
    <td width=\"2%\" align=\"center\" valign=\"middle\" bgcolor=\"$bgColor\"><span class=\"style9\">&nbsp;</span></td>
    <td width=\"18%\" align=\"left\" bgcolor=\"$bgColor\"><span class=\"style9\">
    $linha->sistema
    </span> </td>
    <td width=\"5%\" align=\"left\" bgcolor=\"$bgColor\"><span class=\"style9\">
    $linha->versao
    </span> </td>
    <td width=\"9%\" align=\"left\" bgcolor=\"$bgColor\"><span class=\"style9\">
    $linha->plataforma
    </span> </td>
    <td width=\"16%\" align=\"left\" bgcolor=\"$bgColor\"><span class=\"style9\">
    $data  $linha->hora
    </span> </td>
    <td width=\"36%\" align=\"left\" bgcolor=\"$bgColor\"><span class=\"style9\">
    $linha->descricao
    </span> </td>
    <td width=\"14%\" align=\"right\" valign=\"middle\" bgcolor=\"$bgColor\"><span class=\"style9\">
    $previsao
    </span></td>
  </tr>
  <tr valign=\"top\">
    <td bgcolor=\"#FFFFFF\" colspan=\"7\">
      <table width=\"92%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"right\">
        <tr bgcolor=\"#000000\">

          <td width=\"19%\"><span class=style2><b>Tarefa </b></span> </td>
          <td width=\"32%\" ><span class=style2><b>Descri&ccedil;&atilde;o</b></span></td>
          <td width=\"49%\" ><span class=style2><b>Respons&aacute;veis </b></span></td>
        </tr>";

  $tarefas = listatarefas( $id_conjunto, $ok, $andamento);  
  while ( list($tmp1, $tmp) = each($tarefas) ) {
  
  $textEmail .= "  
        <tr bgcolor=\"$bgColor\">
          <td width=\"19%\">".$tmp["tarefa"]."</td>
          <td width=\"32%\">".$tmp["descricao"]."</td>
          <td width=\"49%\">".$tmp["usuarios"]."</td>
        </tr>";

	}

  $textEmail .= " 
      </table>      </td>
  </tr>";
 }
  $textEmail .= " 
</table>
<br />
<table width=\"99%\" border=\"0\" align=\"center\">
  <tr>
    <td bgcolor=\"#CEEFFF\">Releases em dia com tarefas pendentes </td>
  </tr>
  <tr>
    <td bgcolor=\"#FFD9DA\">Release em atraso com tarefas pendentes  </td>
  </tr>
  <tr>
    <td>Aos reponsáveis pelas tarefas em aberto, favor analisar com brevidade</td>
  </tr>
</table>";

	$sql = "select distinct u.email email from ";
	$sql .= "usuario u inner join i_tarefapessoa tp on tp.id_usuario = u.id_usuario ";
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object($result)) {
		$_email .= $linha->email;
		mail($_email, $subject, $textEmail, $headers);
	}
  }
?>