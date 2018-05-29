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

require_once("scripts/conn.php");
require_once("scripts/classes.php");

conn_EncerraChamadoAutomatico();

$dias = 6;
$MANDAEMAIL = true;

$INSERECONTATO = true;

function emailOuvidor() {
	$sql = "select email from usuario where fl_ouvidor = 1";
	$result = mysql_query($sql);
	$email = "";
	while ($linha = mysql_fetch_object($result)) {
		$email .= ($email == "" ? $linha->email : ";" . $linha->email);
	}
	return $email;
}


function geraSqlCobranca($id_usuario, $dias) {
	$dias -= 0;
	
	$dia = Array();
	$dia[0] = "
	case dayofweek(c.datauc)        
	             when 1 then (c.datauc + interval 4 day)
             when 4 then (c.datauc + interval 5 day)                                                    
             when 5 then (c.datauc + interval 5 day)
             when 6 then (c.datauc + interval 5 day)             
             when 7 then (c.datauc + interval 5 day)                              
             else (c.datauc + interval 3 day)
       end = current_date()
	  ";
	
	$dia[1] = "       case dayofweek(c.datauc)               
             when 1 then (c.datauc + interval 5 day)             
             when 2 then (c.datauc + interval 4 day)
             when 3 then (c.datauc + interval 6 day)             
             when 4 then (c.datauc + interval 6 day)             
             when 5 then (c.datauc + interval 6 day)             
             when 6 then (c.datauc + interval 6 day)                          
             when 7 then (c.datauc + interval 6 day)
       end = current_date() 
	";
	
	$dia[2] = "       case dayofweek(c.datauc)               
             when 1 then (c.datauc + interval 8 day)             
             when 2 then (c.datauc + interval 7 day)
             when 3 then (c.datauc + interval 7 day)             
             when 4 then (c.datauc + interval 7 day)             
             when 5 then (c.datauc + interval 7 day)             
             when 6 then (c.datauc + interval 7 day)                          
             when 7 then (c.datauc + interval 9 day)
       end = current_date()
	";
	
	$dia[3] = "       case dayofweek(c.datauc)               
             when 1 then (c.datauc + interval 9 day)             
             when 2 then (c.datauc + interval 8 day)
             when 3 then (c.datauc + interval 8 day)             
             when 4 then (c.datauc + interval 8 day)             
             when 5 then (c.datauc + interval 8 day)             
             when 6 then (c.datauc + interval 10 day)                          
             when 7 then (c.datauc + interval 10 day)
       end = current_date()
	";
		
	$sql = "
select 
		c.id_chamado,       
		cli.cliente cli,
		cli.grau,
		c.Id_chamado_espera,
		c.cliente_id,
		u.nome, 
		c.datauc,   
        c.horauc,           
		left(c.descricao, 500) descricao,
		c.dataprevistaliberacao,		
		datediff(now(), c.dataprevistaliberacao) diasPrazo,		
       datediff(now(), 
       case  dayofweek(c.datauc)               
             when 1 then (c.datauc + interval 4 day)
             when 4 then (c.datauc + interval 5 day)                                                    
             when 5 then (c.datauc + interval 5 day)
             when 6 then (c.datauc + interval 5 day)             
             when 7 then (c.datauc + interval 5 day)                              
             else (c.datauc + interval 3 day)
       end) as dias,
       case  dayofweek(c.datauc)        
             when 1 then (c.datauc + interval 4 day)
             when 4 then (c.datauc + interval 5 day)                                                    
             when 5 then (c.datauc + interval 5 day)
             when 6 then (c.datauc + interval 5 day)             
             when 7 then (c.datauc + interval 5 day)                              
             else (c.datauc + interval 3 day)
       end limite	   

from 
     chamado c
	   inner join categoria ca on ca.id_categoria = c.categoria_id
       inner join usuario u on u.id_usuario = c.destinatario_id       
       inner join cliente cli on cli.id_cliente = c.cliente_id
where
     1 = 1  
	 and ca.pos_venda <> 1 
	 and c.descricao <> ''
	 and c.destinatario_id = $id_usuario   
     and id_chamado_espera = 0
     and c.prioridade_id <> 4
     and c.prioridade_id <> 6
	 and c.motivo_id <> 21
	 and c.motivo_id <> 46	 
     and c.visible = 1     
     and c.status <> 1               
	 and c.cliente_id <> 'DATAMACE'
	 and c.cliente_id <> 'INTERSYSTEM'
     and u.fl_recebe_cobranca = 1  
     and     
     (          
	 	$dia[$dias]
     ) 
order by nome, grau, datauc desc	 
";
	return $sql;
}



  $ouvidor = emailOuvidor();

$sql = "
select 
  u1.nome,
  u1.id_usuario,
  u1.email,       
  u2.nome nomegestor, u2.email emailgestor
from 
  usuario u1 
    inner join usuario u2 on u2.id_usuario = u1.superior
where
  u1.ativo = 1 and
  u1.fl_recebe_cobranca = 1
order by
  nome
";
  
  
  echo $sql;
  
  $result = mysql_query($sql);
  
  $now = date("G:i:s") ;  
  $hoje = date("Y-m-d");
  
  $agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
  $soma1dia = mktime(-2, 0, 0,  1, 2, 1970); 
  $amanha = date("Y-m-d",$agora+$soma1dia);  
  $data = date("d/m/Y", $agora+$soma1dia) ;


  
  while ($linha=mysql_fetch_object($result)) {	

	$nome = $linha->nome;
	$id_usuario_destino = $linha->id_usuario;
	
	$copias = "";		

	for ($dias = 0; $dias <= 3; $dias++)
	{
	
		
		$sql2 = geraSqlCobranca($id_usuario_destino, $dias);		
				
		$result2 = mysql_query($sql2) or die(mysql_error());		
		
		$compr = mysql_affected_rows();


		
		if ( $compr>0 ) { 	// se o cara tem compromisso:
		
		if ($dias>0) {
			echo "<br><br>dias: $dias - Nome: $nome - Chamados : ";
		}


			while ($linha2=mysql_fetch_object($result2)) {
		
				$grau = AcertaGrau($linha2->grau);
				$cliente = $linha2->cli;
				$id_chamado = $linha2->id_chamado;
		
					if ($dias > 0) {
						//insere_contato($id_chamado, $id_usuario, $dias);		
						echo ($id_chamado . " - ");
					}
				
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
		
				$espero = conn_PegaAguardandoChamado($id_chamado);
				$dependemDeste = conn_PegaChamadosAguardando($id_chamado);
				
		}	
		
	
		
	} /// FIM FOR

		
	}
  }
  
  
?>
