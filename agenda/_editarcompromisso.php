<?

 require("../a/scripts/conn.php");

 if ($particular) {
   $p='1';
 } else {
   $p='0';
 }

 $sql = "select obs, id_usuario from compromisso where id = $id_compromisso";
 $result = mysql_query($sql) or die(mysql_error());
 $linha = mysql_fetch_object($result) ;
 $obs = $linha->obs;
 $usuario_criador = $linha->id_usuario;

 $usuarios = count($usuario_id);
 $data = "$ano-$mes-$dia";
 if ($acao != 'excluir') {
   if ($acao != 'copiar') {

	$nomeusuario=peganomeusuario($id_usuario);
	$dataHumana = date("d/m/Y h:i");
	$obs .= "Editado em $dataHumana por $nomeusuario<br>";


	 $sql = "delete from compromissousuario where id_compromisso=$id_compromisso";
	 mysql_query($sql);
	 $sql = "delete from compromisso where id = $id_compromisso";
	 mysql_query($sql);
  }
	 $sql = "insert into compromisso (confidencial, id_usuario, data, hora, horafim, resumo, local,   descricao, id_chamado, id_sala, obs) ";
	 $sql .= " VALUES ($p, $usuario_criador, '$data', '$hora:00', '$horafim:00', '$resumo', '$local', '$descricao', '$id_chamado', '$id_sala', '$obs')";
	 mysql_query($sql) or die (mysql_error());
	 $sql = "select max(id) as id from compromisso where id_usuario=$usuario_criador";
	 $result = mysql_query($sql);
	 $linha = mysql_fetch_object($result);
	 $id_compromisso = $linha->id;

	 $pvt = 0;
	 if ($particular) {
	   $pvt =  1;
	 }

	 for ($i=0; $i<$usuarios; $i++) {
	   $lido = 1;
	   $usuario = $usuario_id[$i];
	   if ( $id_usuario != $usuario_id[$i] ) { $lido = 0;}
	   $sql = "insert into compromissousuario ( id_compromisso, id_usuario, confidencial, lido) ";
	   $sql .= "values ( $id_compromisso, $usuario, $pvt, $lido)";
	   mysql_query($sql) or die (mysql_error());

      	if ($acao == "copiar") {
		  $textEmail = "Novo compromisso (copia)<br> ";
		} else {
		  $textEmail = "Alteração de compromisso<br>$obs";
		}
        $textEmail .= "
<br>
<table width=\"100%\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
  <tr>
    <td width=\"21%\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">Data/Hora</font></td>
    <td width=\"79%\"><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[data] [hora]-[horafim]</font></strong></td>
  </tr>
  <tr>
    <td><font face=\"Verdana, Arial, Helvetica, sans-serif\">Alterado por</font></td>
    <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[dono]</font></strong></td>
  </tr>
  <tr>
    <td><font face=\"Verdana, Arial, Helvetica, sans-serif\">Local</font></td>
    <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[local]</font></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"><em>Descri&ccedil;&atilde;o</em></font></td>
  </tr>
  <tr>
    <td colspan=\"2\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">[descricao]</font></td>
  </tr>
</table>
<p><font face=\"Verdana, Arial, Helvetica, sans-serif\"><HR size=\"1\">
  <font color=\"#CCCCCC\">Datamace 2005</font><br>

</font>
</p>
		";
        EmailAgenda($id_usuario, $usuario, $data, $hora, $horafim, $resumo, $local, $descricao, $textEmail );
  	 }
 } else {
	$log = "Excluido por " . peganomeusuario($id_usuario);
	$sql = "update compromisso set excluido = 1, resumo_ant='$log' where id = $id_compromisso";
    mysql_query($sql) ;
//	die($sql);
	$textEmail = "
<font face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>Compromisso Excluido</strong></font><br>
<br>
<table width=\"100%\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
  <tr>
    <td width=\"21%\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">Data/Hora</font></td>
    <td width=\"79%\"><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[data] [hora]-[horafim]</font></strong></td>
  </tr>
  <tr>
    <td><font face=\"Verdana, Arial, Helvetica, sans-serif\">Excluido por</font></td>
    <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[dono]</font></strong></td>
  </tr>
  <tr>
    <td><font face=\"Verdana, Arial, Helvetica, sans-serif\">Local</font></td>
    <td><strong><font face=\"Verdana, Arial, Helvetica, sans-serif\">[local]</font></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan=\"2\"><font face=\"Verdana, Arial, Helvetica, sans-serif\"><em>Descri&ccedil;&atilde;o</em></font></td>
  </tr>
  <tr>
    <td colspan=\"2\"><font face=\"Verdana, Arial, Helvetica, sans-serif\">[descricao]</font></td>
  </tr>
</table>
<p><font face=\"Verdana, Arial, Helvetica, sans-serif\"><HR size=\"1\">
  <font color=\"#CCCCCC\">Datamace 2005</font><br>

</font>
</p>
	";
    for ($i=0; $i<$usuarios; $i++) {
     $usuario = $usuario_id[$i];
     EmailAgenda($id_usuario, $usuario, $data, $hora, $horafim, $resumo, $local, $descricao, $textEmail );
    }

 }
 header("Location: /agenda/inicio.php");
?>
