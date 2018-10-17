<?php

  require("scripts/conn.php");

  $sql = "Select id_usuario, nome, email from usuario ";//where id_usuario=12";
  $result = mysql_query($sql);

  $now = date("G:i:s") ;

  $agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
  $soma1dia = mktime(-2, 0, 0,  1, 2, 1970);
  $amanha = date("Y-m-d",$agora+$soma1dia);
  $data = date("d/m/Y", $agora+$soma1dia) ;

  $headers  = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
//  $headers .= "From: Agenda Datamace<agenda@datamace.com.br>\n";

  $subject = "Compromisso $data";
  $textEmail = '<style type="text/css">';
  $textEmail .= '<!-- a:hover {color: #FF0000;text-decoration: underline;}a {	color: #003366;	text-decoration: none;}--></style>';
  $textEmail .= '<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://192.168.0.14/agenda/inicio.php">Agenda corporativa Datamace</a><br><br>';
  $textEmail .= "Você tem compromisso(s) para amanhã ($data)<br><br>";
  $textEmail .= "</font>";


  while ($linha=mysql_fetch_object($result)) {

    $compromissos = "";
    $emailpadrao =  $linha->email;
	$id_usuario = $linha->id_usuario;

    $sql2 = "select  data, resumo, hora, horafim, id_compromisso from usuario, compromisso,  ";
    $sql2 .= "compromissousuario where ";
	$sql2 .= "compromisso.excluido=0 and ";
	$sql2 .= "compromissousuario.id_usuario=usuario.id_usuario and ";
    $sql2 .= "compromisso.id=compromissousuario.id_compromisso and ";
	$sql2 .= "usuario.id_usuario = " . $linha->id_usuario;
    $sql2 .= " and data = '$amanha'" ;
    $sql2 .= " order by hora ";
    $result2 = mysql_query($sql2);
    $compr = mysql_affected_rows();

	if ( $compr>0 ) { 	// se o cara tem compromisso:

		$compromissos .= '<table width="400" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#003366"> ';
	 	$compromissos .= '<td width="20%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Hora</font></strong></td>';
	  	$compromissos .= '<td width="61%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Resumo</font></strong></td></tr>';
          while ($linha2=mysql_fetch_object($result2)) {
		    $idc = $linha2->id_compromisso;
		    $compromissos .= ' <tr bgcolor="#FFFFFF"> ';
		 	$compromissos .= "    <td><font size=2 face=Tahoma>$linha2->hora</font></td>";
		 	$compromissos .= "    <td><font size=\"2\" face=\"Tahoma\">$linha2->resumo</font></td>";
		 	$compromissos .= '  </tr>';

				$sql3 = "SELECT u.nome, u.email, u.id_usuario FROM ";
		     	$sql3 .= "	  compromissousuario c inner join usuario u on u.id_usuario = c.id_usuario ";
				$sql3 .= "  where id_compromisso = $idc order by u.nome;";
				$result3 = mysql_query($sql3);
				$nomes = "- ";
				while($linha3=mysql_fetch_object($result3)) {
				  if ($linha3->id_usuario == $id_usuario) {$nomes .= "<b>"; }
				  $nomes .= "$linha3->nome";
				  if ($linha3->id_usuario == $id_usuario) {$nomes .= "</b>"; }
				  if ($nomes != "") { $nomes = "$nomes - "; }
				}

		 	$compromissos .= " <tr bgcolor='#FFFFFF'><td colspan=2>$nomes</td></tr>";
	   }
          $compromissos .= "</table>";
	}

        if ($compr>0)  {
	        mail2($emailpadrao, $subject, $textEmail.$compromissos, 'Agenda Datamace');
        }
    }














	$now = date("G:i:s") ;
	$agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
	$soma1dia = mktime(-2, 0, 0,  1, 2, 1970);
	$amanha = date("Y-m-d",$agora+$soma1dia);
	$data = date("d/m/Y", $agora+$soma1dia) ;

	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$subject = "Massagem em $data";

	$sql2 = "select email, nome, hora from relax inner join usuario on usuario.id_usuario = relax.id_usuario where relax.data = '$amanha' order by hora ";

	mail2('fernando@datamace.com.br', "Massagem SQL", $sql2, "Massagem SQL");

	$result2 = mysql_query($sql2) or die (mysql_error());

	$compr = mysql_affected_rows();

	if ( $compr>0 ) {

          while ($linha2=mysql_fetch_object($result2)) {



				$emailpadrao =  $linha2->email;
				$id_usuario = $linha2->id_usuario;


				$textEmail = '<style type="text/css">';
				$textEmail .= '<!-- a:hover {color: #FF0000;text-decoration: underline;}a {	color: #003366;	text-decoration: none;}--></style>';
				$textEmail .= '<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://10.98.0.5/agenda/">Agenda DE MASSAGEM</a><br><br>';
				$textEmail .= "$linha2->nome Você tem <b>Massagem</b> para amanhã ($data)<br><br>";
				$textEmail .= "</font>";

				$compromissos = "";
				$compromissos = '<table width="400" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#003366"> ';
				$compromissos .= '<td width="20%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Hora</font></strong></td>';
				$compromissos .= '<td width="61%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Resumo</font></strong></td></tr>';
				$compromissos .= ' <tr bgcolor="#FFFFFF"> ';
				$compromissos .= "    <td><font size=2 face=Tahoma>$linha2->hora</font></td>";
				$compromissos .= "    <td><font size=\"2\" face=\"Tahoma\">Massagem</font></td>";
				$compromissos .= '  </tr>';
				$compromissos .= "</table>";

		        mail2($emailpadrao, $subject, $textEmail.$compromissos, 'Agenda Datamace');
				mail2('fernando@datamace.com.br', $subject, $textEmail.$compromissos, 'Agenda Datamace');
	   }
	}


?>