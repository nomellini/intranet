<?

 mysql_connect(localhost, sad, data1371);
 mysql_select_db(sad); 
 $host = "intranet.datamace.com.br";
 
 function peganomeusuario($id) {
   if($id) {
	 $sql = "select nome from usuario where (id_usuario = $id);";
	 $result = mysql_query($sql);
	 $linha=mysql_fetch_object($result);
	 if ($linha) {
		 $nome_usuario=$linha->nome;
		 return $nome_usuario; 
	 } else {
	   return $id==0 ? "Cliente" : "Usuario n�o cadastrado ($id)"; 
	 }
   } else {
     return "Cliente";
   }
 }


 function pegaSistema($id) {
	 $sql = "select sistema from sistema where (id_sistema = $id);";
	 $result = mysql_query($sql);
	 $linha=mysql_fetch_object($result);
	 if ($linha) {
		 return $linha->sistema;
	 } else {
	   return "Sistema n�o cadastrado"; 
	 }
 }



function pegaMotivo($id) {
	 $sql = "select motivo from motivo where (id_motivo = $id);";
	 $result = mysql_query($sql);
	 $linha=mysql_fetch_object($result);
	 if ($linha) {
		 return $linha->motivo;
	 } else {
	   return "Motivo N�o Cadastrado"; 
	 }
 }

function pegaCategoria($id) {
	 $sql = "select categoria from categoria where (id_categoria = $id);";
	 $result = mysql_query($sql);
	 $linha=mysql_fetch_object($result);
	 if ($linha) {
		 return $linha->categoria;
	 } else {
	   return "Categoria N�o Cadastrado"; 
	 }
 }


function pegaStatus($status) {
  $sql = "Select status from status where id_status = $status;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result ) ;
  $idtemp = $linha->status;

  return $idtemp; 
}

//
//  retorna array assossiativo
//  id_cliente -> cliente
//  do usuario passado que tem status = 2 (pendente)
//
function pegaChamadosPorCliente($id_cliente, $status) {
 $saida = array();
 
 if ($status==2) {$s="or (c.status >= 3) ";}
 
 $sql = "SELECT id_chamado, dataa, horaa, left(descricao, 70) as descricao, consultor_id ";
 $sql .= "FROM chamado ";
 $sql .= "WHERE ";
 $sql .= "cliente_id = '$id_cliente' ";
 $sql .= "AND externo = 1 ";
 $sql .= "AND status = $status ";
 $sql .= "ORDER by ";
 $sql .= "dataa desc, horaa desc;";
 
  
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     
	 $quando = explode("-", $linha->dataa);
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["horaa"] = $linha->horaa;
	 $tmp["chamado"] = $linha->id_chamado;
	 if ($linha->consultor_id == 56) {	 $tmp["chamado"] = 'Aguardando' ;}
	 $tmp["descricao"] = $linha->descricao . "...";
     $saida[$conta++] = $tmp;
   }
   
  return $saida;
} 

function ultimoHistoricoChamado($chamado) {
  $sql = "select max(id_contato) as ID from contato where chamado_id  = $chamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  $max = $linha->ID;
  $sql = "SELECT historico FROM contato WHERE id_contato = $max ;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  return  $linha->historico;
}

function historicoChamado($chamado, $id_cliente) {

  $saida = array();
  
  $sql = ""; 
  $sql .= "SELECT ";
  $sql .= "SEC_TO_TIME( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS tempo, ";
  $sql .= "co.dataa, co. datae, co.horaa, co.horae, co.historico, co.pessoacontatada, co.publicar, ";
  $sql .= "co.consultor_id as consultor, u2.nome as destinatario, s.status, s.id_status, o.origem FROM ";
  $sql .= " contato co, usuario u2, origem o, status s, chamado ";
  $sql .= " WHERE ( ";
  $sql .= "      ( co.destinatario_id = u2.id_usuario ) ";  
  $sql .= "AND   ( co.origem_id = o.id_origem ) ";
  $sql .= "AND   ( co.status_id = s.id_status ) ";  
  $sql .= "AND   ( co.publicar = 1) ";
  $sql .= "AND   ( chamado.externo = 1) ";
  $sql .= "AND   ( chamado.id_chamado = co.chamado_id) ";
  $sql .= "AND   ( chamado.cliente_id = '$id_cliente') ";
  $sql .= "AND   ( co.chamado_id = $chamado ) ) "; 
  $sql .= "ORDER BY dataa desc, horaa desc;";

  $result = mysql_query($sql) or die ($sql);

  $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
 
	 $tmp["pessoacontatada"] = $linha->pessoacontatada;
	 $tmp["historico"] = $linha->historico;
	 $tmp["publicar"] = $linha->publicar;
	 $tmp["consultor"] = $linha->consultor;
	 $tmp["destinatario"] = $linha->destinatario;
	 $tmp["status"] = $linha->status;
	 $tmp["status_id"] = $linha->id_status;
	 $tmp["origem"] = $linha->origem;	  
     $quando = explode("-", $linha->dataa);
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["horaa"] = $linha->horaa;	 
     $quando = explode("-", $linha->datae);
	 $tmp["datae"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["horae"] = $linha->horae;
	 $tmp["tempo"] = $linha->tempo;
	 
	 if ($tmp["consultor"] == $tmp["destinatario"])  {
	   $tmp["encaminhado"] = 0;
	 } else {
	   $tmp["encaminhado"] = 1;
	 }
	 
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

}


function pegaChamado($id_chamado) {
 $saida = array();
 $sql = "";
 $sql = "SELECT * FROM chamado ";
 $sql .= "WHERE (";
 $sql .= "(chamado.id_chamado=$id_chamado))";
   
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     
	 $quando = explode("-", $linha->dataa);
	 $tmp["id_cliente"] = $linha->cliente_id;
	 $tmp["cliente"] = $linha->cliente;
	 $tmp["chamado"] = $linha->id_chamado;
	 $tmp["descricao"] = $linha->descricao;
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["prioridade"] = $linha->prioridade;
	 $tmp["consultor_id"] =$linha->consultor_id;
	 $tmp["destinatario_id"] = $linha->destinatario_id;
	 $tmp["remetente_id"] = $linha->remetente_id;
	 $tmp["status_id"] = $linha->status;
	 $tmp["diagnostico_id"] = $linha->diagostico_id;
	 $tmp["motivo"] = $linha->motivo_id;
	 $tmp["sistema_id"] = $linha->sistema_id;
	 $tmp["categoria"] = $linha->categoria_id;
 	 $tmp["encaminhado"] =  ( 
	      
		  ($tmp["destinatario_id"] != $tmp["remetente_id"]) or 
		  ($tmp["destinatario_id"] != $tmp["consultor_id"]) 
     ) ;
 
	 
     $saida[$conta++] = $tmp;
   }
   
  return $saida;
} 


?>
