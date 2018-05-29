<?php

  require("scripts/conn.php");
  $now = date("G:i:s") ;  
  
  $agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
  $soma1dia = mktime(-2, 0, 0,  1, 2, 1970); 
  $amanha = date("Y-m-d",$agora+$soma1dia);  
	$data = date("d/m/Y", $agora+$soma1dia) ;
	
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	//  $headers .= "From: Agenda Datamace<agenda@datamace.com.br>\n";
	
	$subject = "Massagem em $data";
	
	$amanha = "2016-11-24";	
	
	$sql2 = "select email, nome, hora from relax inner join usuario on usuario.id_usuario = relax.id_usuario where relax.data = '$amanha' order by hora ";
	
//	echo $sql2;
	
	$result2 = mysql_query($sql2) or die (mysql_error());


    $compr = mysql_affected_rows();

	if ( $compr>0 ) { 	
	


          while ($linha2=mysql_fetch_object($result2)) {

				$compromissos = "";	  

				$compromissos = '<table width="400" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#003366"> ';
				$compromissos .= '<td width="20%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Hora</font></strong></td>';
				$compromissos .= '<td width="61%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Resumo</font></strong></td></tr>';	
			  
				$textEmail = '<style type="text/css">';
				$textEmail .= '<!-- a:hover {color: #FF0000;text-decoration: underline;}a {	color: #003366;	text-decoration: none;}--></style>';
				$textEmail .= '<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://10.98.0.5/agenda/">Agenda DE MASSAGEM</a><br><br>';
				$textEmail .= "$linha2->nome Você tem <b>Massagem</b> para amanhã ($data)<br><br>";
				$textEmail .= "</font>"; 							  
				
				$emailpadrao =  $linha2->email;
				$id_usuario = $linha2->id_usuario;										    			
				
				$compromissos .= ' <tr bgcolor="#FFFFFF"> ';
				$compromissos .= "    <td><font size=2 face=Tahoma>$linha2->hora</font></td>";
				$compromissos .= "    <td><font size=\"2\" face=\"Tahoma\">Massagem</font></td>";								
				$compromissos .= '  </tr>'; 											   							
				$compromissos .= "</table>";

				//echo $textEmail.$compromissos;				
		        //mail2($emailpadrao, $subject, $textEmail.$compromissos, 'Agenda Datamace');  
				mail2('fernando@datamace.com.br', $subject, $textEmail.$compromissos, 'Agenda Datamace');  

	   }	  		  
		  
	}	

       

       
?> 