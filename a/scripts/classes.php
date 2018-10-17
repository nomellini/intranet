<?php

require_once("funcoes.php");

class chamado {

	 var $id_chamado;
	 var $consultor_id;
	 var $remetente_id;
	 var $destinatario_id;
	 var $diagnostico_id;
	 var $cliente_id;
	 var $sistema_id;
	 var $categoria_id;
	 var $prioridade_id;
	 var $motivo_id;
	 var $dataa;
	 var $dataaf;
	 var $horaa;
	 var $descricao;
	 var $status;
     var $sistema;
	 var $lido;
	 var $lidodono;	 
	 var $datalidodestinatario;
	 var $horalidodestinatario;
	 var $email;
	 var $nomecliente;
	 var $rnc;
     var $datauc;
	 var $usuario_id_ic;
     var $horauc;
	 var $projeto;	 
	 var $dataprevistaliberacao;
	 var $obs;
	 var $reaberto;
	 var $dependo_de;
	 var $diasDecorridos;
	 var $limite1;
	 var $limite2;
	 var $limite3;	 
	 var $limite4;	 	 
	 var $fl_PodeEncerrar;
	 var $Ds_MotivoNaoEncerrar;
	 var $Dt_Ultimo_Diagnostico;
	 var $Id_Usuario_Diagnostico;
	 var $fl_ProgramaEspecial;
	 var $Ds_ProgramaEspecial;
	 var $chamado_pai_id;
	 var $Dt_Release;
	 var $Ds_Versao;
	 var $Dt_EncerramentoAutomatico;
	 var $Id_Release;
	 var $Ic_ImpedeEncerramentoAutomatico;
	 var $Ic_Ordem;	 
	 var $Ic_Atencao;
	 	
	 function chamado() {
	 }
	
	 function novoChamado($consultorId, $clienteID, $destinatarioID) {

        $dataa = date("Y-m-d");
        $horaa = date("H:i:s");	 
		
		$limite1 = SomaDiasUteis($dataa, 3);
		$limite2 = SomaDiasUteis($limite1, 1);
		$limite3 = SomaDiasUteis($limite2, 1);	
		$limite4 = SomaDiasUteis($limite3, 1);	
		
		
		$sql = "insert into chamado (publicar, consultor_id, destinatario_id, remetente_id, dataa, horaa, cliente_id, status, email, datauc, horauc, usuario_id_uc, data_limite_1, data_limite_2, data_limite_3, data_limite_4) ";
		$sql .= " values ('1', $consultorId, $destinatarioID, $consultorId, '$dataa', '$horaa', '$clienteID', 2, '', '$dataa', '$horaa', $consultorId, '$limite1', '$limite2', '$limite3', '$limite4');";
		mysql_query($sql) or die (mysql_error() . " <br> " . $sql);
		
		$sql = "select max(id_chamado) as novo from chamado where consultor_id = $consultorId";		
		$result = mysql_query($sql);		
		$linha=mysql_fetch_object($result);
		
		$this->id_chamado = $linha->novo;
		$this->lerChamado($this->id_chamado);  
		return $this->id_chamado;		
	 }
	
	
	 function lerChamado($chamadoId) {
	
		$this->id_chamado = $chamadoId;	
        $sql  = "select c.*, datediff(datauc, dataa) diasDecorridos from chamado c WHERE c.id_chamado = $this->id_chamado;";
		
		$result = mysql_query($sql);		
		$linha = mysql_fetch_object($result);

		$this->dataa = $linha->dataa;		
        $quando = explode("-", $this->dataa);
		
		$this->datauc = $linha->datauc;		
		$quando2 = explode("-", $this->dataa);
		
		$this->dataaf = "$quando[2]/$quando[1]/$quando[0]";				
		$this->dataafUC = "$quando2[2]/$quando2[1]/$quando2[0]";						
				
		$this->id_chamado = $chamadoId;
		$this->diasDecorridos = $linha->diasDecorridos;
		$this->consultor_id = $linha->consultor_id;		
		$this->remetente_id = $linha->remetente_id;
		$this->diagnostico_id = $linha->diagnostico_id;
		$this->destinatario_id = $linha->destinatario_id;
		$this->cliente_id = $linha->cliente_id;
		$this->sistema_id = $linha->sistema_id;
		$this->sistema = $linha->sistema_id; 		
		$this->categoria_id = $linha->categoria_id;
		$this->prioridade_id = $linha->prioridade_id;
		$this->motivo_id = $linha->motivo_id;
		$this->email = $linha->email;
		$this->nomecliente = $linha->nomecliente;				
		$this->horaa = $linha->horaa;
		
		$this->usuario_id_uc = $linha->usuario_id_uc;
		
		$this->descricao = $linha->descricao;
		
		
		$this->status = $linha->status;
		$this->lido = $linha->lido;		
		$this->lidodono = $linha->lidodono;				
		$this->rnc = $linha->rnc;
		$this->horauc = $linha->horauc;
		$this->projeto = $linha->projeto;	
		$this->dataprevistaliberacao = $linha->dataprevistaliberacao;
		$this->datalidodestinatario = $linha->datalidodestinatario;
		$this->horalidodestinatario = $linha->horalidodestinatario;		
		$this->obs = $linha->obs;
		$this->reaberto = $linha->fl_reaberto;		
		$this->dependo_de = $linha->Id_chamado_espera;
		
		$this->fl_PodeEncerrar = $linha->fl_PodeEncerrar;
		$this->Ds_MotivoNaoEncerrar = $linha->Ds_MotivoNaoEncerrar;
		
		$this->fl_ProgramaEspecial = $linha->fl_ProgramaEspecial;
		$this->Ds_ProgramaEspecial = $linha->Ds_ProgramaEspecial;


		$this->Dt_Ultimo_Diagnostico = $linha->Dt_Ultimo_Diagnostico;
		$this->Id_Usuario_Diagnostico = $linha->Id_Usuario_Diagnostico;
		
		$this->Dt_Release = $linha->Dt_Release;
		$this->Ds_Versao = $linha->Ds_Versao;
		
		$this->chamado_pai_id = $linha->chamado_pai_id;
		
		$this->Dt_EncerramentoAutomatico = $linha->Dt_EncerramentoAutomatico;
		
		$this->Id_Release = $linha->Id_Release;
		
		$this->Ic_ImpedeEncerramentoAutomatico = $linha->Ic_ImpedeEncerramentoAutomatico;

		
		
		$sql  = "select cat.categoria, cat.pos_venda from categoria cat WHERE cat.id_categoria = $this->categoria_id;";		
		$result = mysql_query($sql);		
		$linha = mysql_fetch_object($result);		
		$this->pos_venda = $linha->pos_venda;
		$this->categoria = $linha->categoria;
		
		return;
	 }
	
	 function gravaChamado() {	 
	 	
		
		$descricao = mysql_real_escape_string ($this->descricao);		
	 
		$sql = "update chamado set consultor_id = $this->consultor_id, ";
		$sql .= "cliente_id = '$this->cliente_id', ";
		$sql .= "destinatario_id = '$this->destinatario_id', ";
		$sql .= "remetente_id = '$this->remetente_id', ";
		$sql .= "sistema_id = $this->sistema_id, ";
		$sql .= "categoria_id = $this->categoria_id, ";
		$sql .= "prioridade_id = $this->prioridade_id, ";
		$sql .= "diagnostico_id = $this->diagnostico_id, ";
		$sql .= "dataa = '$this->dataa', ";
		$sql .= "horaa = '$this->horaa', ";
		$sql .= "obs = '$this->obs', ";	
		$sql .= "fl_reaberto = $this->reaberto, ";				
		$sql .= "dataprevistaliberacao = '$this->dataprevistaliberacao', ";
		$sql .= "datauc = '$this->datauc', ";
		$sql .= "usuario_id_uc = $this->usuario_id_uc, ";

		$sql .= "datalidodestinatario = '$this->datalidodestinatario', ";
		$sql .= "horalidodestinatario = '$this->horalidodestinatario', ";		

		$sql .= "horauc = '$this->horauc', ";		
		$sql .= "status = $this->status, ";
		$sql .= "lido = $this->lido, ";		
		$sql .= "lidodono = $this->lidodono, ";				
		$sql .= "descricao = '$descricao', ";
		$sql .= "projeto = '$this->projeto', ";		
		$sql .= "rnc = $this->rnc, ";
		$sql .= "email = '$this->email', ";		
		$sql .= "nomecliente = '$this->nomecliente', ";
		$sql .= "id_chamado_espera = '$this->dependo_de', ";		
		
		$sql .= "data_limite_1 = '$this->limite1', ";
		$sql .= "data_limite_2 = '$this->limite2', ";
		$sql .= "data_limite_3 = '$this->limite3', ";		
		$sql .= "data_limite_4 = '$this->limite4', ";
		
		
		$sql .= "fl_PodeEncerrar = $this->fl_PodeEncerrar, ";
		$sql .= "Ds_MotivoNaoEncerrar = '$this->Ds_MotivoNaoEncerrar', ";			

		$sql .= "Ds_ProgramaEspecial = '$this->Ds_ProgramaEspecial', ";

		$sql .= "Dt_Release = '$this->Dt_Release', ";		
		$sql .= "Ds_Versao = '$this->Ds_Versao', ";		
		
//		$sql .= "Dt_Ultimo_Diagnostico = '$this->Dt_Ultimo_Diagnostico', ";
		$sql .= "Id_Usuario_Diagnostico = '$this->Id_Usuario_Diagnostico', ";					
		
		$sql .= "Dt_EncerramentoAutomatico = '$this->Dt_EncerramentoAutomatico', ";			
		
		$sql .= "Id_Release = $this->Id_Release, "	;

				
		$sql .= "motivo_id = $this->motivo_id ";
		
		
		$sql .= "WHERE id_chamado = $this->id_chamado;";

		$result = mysql_query($sql) or die (mysql_error() . " <br> " . $sql);
		return $result;
	
	 }


}


class contato {

  var $id_contato;
  var $chamado_id;
  var $dataa;
  var $horaa;
  var $horaaf;
  var $datae;
  var $pessoacontatada;
  var $origem;
  var $origem_id;
  var $historico;
  var $consultor;
  var $consultor_id;
  var $destinatario;
  var $destinatario_id;
  var $status_id;
  var $publicar;
  var $rnc;
  var $idc;
  var $Ic_Atencao;
  
   function __construct() {
	   $this->Ic_Atencao = 0;
   }  

  function novoContato( $chamadoId, $consultorId, $destinatarioId, $dataa, $horaa) {
  
 
    $sql = "INSERT INTO contato ";
    $sql .= "(chamado_id, consultor_id, destinatario_id, dataa, horaa, status_id, idc, Ic_Atencao) ";
    $sql .= "VALUES ($chamadoId,  $consultorId, $destinatarioId, '$dataa', '$horaa', 2, $chamadoId, 0);";
	
//    print $sql;
	
    mysql_query($sql) or die( mysql_error() . ' - ' . $sql );
    $sql = "select max(id_contato) as novo from contato where chamado_id = $chamadoId";	
    mysql_query($sql) or die( mysql_error() . ' - ' . $sql ) ;
    $result = mysql_query($sql) or die( mysql_error() . ' - ' . $sql );
    $linha=mysql_fetch_object($result);
    $this->id_contato = $linha->novo;
    return $this->id_contato;
  }


  function lerContato( $id ) {

    $this->id_contato = $id;
	
    $sql = "select * from contato where id_contato = $id;";

    $result = mysql_query($sql) or die (mysql_error() . ' - ' . $sql );
    $linha = mysql_fetch_object($result) or die (mysql_error() . ' - ' . $sql);
	
    $this->id_contato = $linha->id_contato;
    $this->chamado_id = $linha->chamado_id;
    $this->dataa = $linha->dataa;
    $quando = explode("-", $this->dataa);
    $this->dataaf = "$quando[2]/$quando[1]/$quando[0]";				
	
    $this->datae = $linha->datae;
    $this->horaa = $linha->horaa;
    $this->horae = $linha->horae;
    $this->pessoacontatada = $linha->pessoacontatada;
    $this->origem_id = $linha->origem_id;
    $this->historico = $linha->historico;
    $this->consultor_id = $linha->consultor_id;
    $this->destinatario_id = $linha->destinatario_id;
    $this->status_id = $linha->status_id;
	$this->publicar = $linha->publicar;
	$this->rnc = $linha->rnc;


  }

	 function gravaContato() {
		
		$historico = mysql_real_escape_string ($this->historico);
		
		$sql = "update contato set ";
		$sql .= "dataa = '$this->dataa', ";
		$sql .= "horaa = '$this->horaa', ";
		$sql .= "datae = '$this->datae', ";
		$sql .= "horae = '$this->horae', ";		
		$sql .= "status_id = $this->status_id, ";
		$sql .= "consultor_id = $this->consultor_id,  ";
		$sql .= "destinatario_id = $this->destinatario_id,  ";
		$sql .= "pessoacontatada = '$this->pessoacontatada', ";
		$sql .= "origem_id = $this->origem_id, ";
		$sql .= "historico = '$historico', ";
		$sql .= "rnc = $this->rnc, ";		
		$sql .= "Ic_Atencao = $this->Ic_Atencao, ";
		$sql .= "publicar = $this->publicar ";
		$sql .= "WHERE id_contato = $this->id_contato;";	
		$result = mysql_query($sql)  or die (mysql_error() . " <br> " . $sql);
		return $sql;
	 }

}

?>