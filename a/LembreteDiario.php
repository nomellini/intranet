<?php

/*
 *  Fernando Nomellini
 * 17/05/2010
 * -------------------
 * Envia Email lembrando dos chamados a cada XXX dias do último contato,
 * sendo XXX configurável através do campo lembrete_dias na tabela usuario.
 *
 * O Próprio envio do lembrete é configurável através do flag lembrete_ativo.
 *
*/

  require("scripts/conn.php");

  $sql = "Select id_usuario, nome, email, lembrete_dias from usuario where lembrete_ativo = 1";
  $result = mysql_query($sql);  
  
  $now = date("G:i:s") ;  
  $hoje = date("Y-m-d");
  
  $agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
  $soma1dia = mktime(-2, 0, 0,  1, 2, 1970); 
  $amanha = date("Y-m-d",$agora+$soma1dia);  
  $data = date("d/m/Y", $agora+$soma1dia) ;

  $headers  = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  $headers .= "From: Lembrete de chamado SAD<agenda@datamace.com.br>\n";

  $subject = "Lembrete de chamados pendentes";
  $textEmail = '<style type="text/css">';
  $textEmail .= '<!-- a:hover {color: #FF0000;text-decoration: underline;}a {	color: #003366;	text-decoration: none;}--></style>';
  $textEmail .= '<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Sistema de Atendimento Datamace<br><br>';
  $textEmail .= "</font>"; 

  
  while ($linha=mysql_fetch_object($result)) {	

    $compromissos = "";	  
    $emailpadrao =  $linha->email;
	$id_usuario = $linha->id_usuario;
		
	$sql2 = "
	select 	
		c.dataprevistaliberacao,
		cli.cliente cli,
		cli.grau,
		c.Id_chamado_espera,
		c.cliente_id,
		u.nome, 
		c.datauc,      
		c.id_chamado,       
		left(c.descricao, 500) descricao,
		datediff(now(), dataa) diasAbertura, 
		datediff(now(), datauc) diasUltimoContato,
		datediff(now(), dataprevistaliberacao) diasPrazo
	from 
		chamado c      
			inner join usuario u on u.id_usuario = c.destinatario_id
			inner join cliente cli on cli.id_cliente = c.cliente_id
	where 
		1 = 1		    
		and c.prioridade_id <> 4
		and dataprevistaliberacao  <= CURRENT_DATE() + INTERVAL (3*LEMBRETE_DIAS) DAY		
		and c.visible = 1
		and u.id_usuario = $linha->id_usuario
		and u.lembrete_ativo = 1
		and c.status <> 1                  
		and datediff(current_date(), datauc) <> 0 
		and datediff(current_date(), datauc) mod lembrete_dias = 0
	order by 
		cli.grau, datauc";


    $result2 = mysql_query($sql2) or die(mysql_error());
	
    $compr = mysql_affected_rows();

	if ( $compr>0 ) { 	// se o cara tem compromisso:
		$compromissos .= "Lembrete de chamados pendentes ($compr) para $linha->nome *<br><br/>";
		$compromissos .= '<table  width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#003366"> ';
	 	$compromissos .= '<td width="15%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Data último contato</font></strong></td>';
	  	$compromissos .= '<td width="5%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Chamado</font></strong></td>';	
	  	$compromissos .= '<td width = "80%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Descrição</font></strong></td></tr>';			
          while ($linha2=mysql_fetch_object($result2)) {
		  
		  	$grau = AcertaGrau($linha2->grau);
			$cliente = $linha2->cli;
			

			$prazo = "";
			if ($linha2->dataprevistaliberacao <> '0000-00-00')
			{
				$diasPrazo = $linha2->diasPrazo;
				
				if ($diasPrazo > 0) {				
					if ($diasPrazo == 1) {
						$m = "Venceu Ontem";
					} else if ($diasPrazo == 2) {
						$m = "Venceu Anteontem";
					} else {					
						$m = "Venceu fazem $diasPrazo dias";
					}
					$m = "<font color=ff0000>$m !!!!</font>";					
				} else {
					$diasPrazo *= -1;
					if ($diasPrazo == 0) {
						$m = "VENCE HOJE !!";
					} else if ($diasPrazo == 1) {
						$m = "VENCE AMANHÃ !";
					} else if ($diasPrazo == 2) {
						$m = "Vence depois de amanhã ";
					} else {					
						$m = "Faltam $diasPrazo para vencer o prazo";
					}
					if ( $diasPrazo < 5 ) {
						$m = "<font color=ff0000>$m!</font>";
					}					
					$diasPrazo *= -1;
				}
				$prazo = "<br/><b>Prazo: " . DataOk($linha2->dataprevistaliberacao) . " (" . $m . ") </b>";
			}

			$espero = conn_PegaAguardandoChamado($linha2->id_chamado);
			$dependemDeste = conn_PegaChamadosAguardando($linha2->id_chamado);

		    $compromissos .= ' <tr bgcolor="#FFFFFF"> ';
		 	$compromissos .= "    <td align=\"center\" valign=\"middle\"><font size=2 face=Tahoma>".DataOk($linha2->datauc) . " (" . $linha2->diasUltimoContato . ") </font></td>
		 	";
		 	$compromissos .= "    <td align=\"center\" valign=\"middle\"><font size=\"2\" face=\"Tahoma\"><a href=\"http://10.98.0.5/a/historicochamado.php?id_chamado=$linha2->id_chamado\"> $linha2->id_chamado </a></font></td>";
		 	$compromissos .= "    <td><font size=\"2\" face=\"Tahoma\"><b>$grau - $linha2->cliente_id - $cliente<br/></b> $linha2->descricao</font>$dependemDeste $espero $prazo</td>";
		 	$compromissos .= '  </tr>'; 											   									
		 	$compromissos .= " <tr bgcolor='#FFFFFF'><td colspan=2>$nomes</td></tr>";		
	   }	  
       $compromissos .= "</table>";
       $compromissos .= "<br/>*Chamados que estão sem contato por um período de dias múltiplo de $linha->lembrete_dias<br/><br/>
       ";
	}	
		
        if ($compr>0)  {
			echo $compromissos;	   
	        //mail($emailpadrao, $subject, $textEmail.$compromissos, $headers);  			
			//mysql_query("update usuario set lembrete_data = '$hoje' where id_usuario = $id_usuario");			
        }

  }    