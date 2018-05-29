<?

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
	 var $email;
	 var $nomecliente;
	 var $rnc;
     var $datauc;
     var $horauc;
	 		 
	 	
	 function chamado() {
	 }
	
	 function novoChamado($consultorId, $clienteID, $destinatarioID) {

        $dataa = date("Y-m-d");
        $horaa = date("H:i:s");	 
		$sql = "insert into chamado (consultor_id, destinatario_id, remetente_id, dataa, horaa, cliente_id, status, email, datauc, horauc) ";
		$sql .= " values ($consultorId, $destinatarioID, $consultorId, '$dataa', '$horaa', '$clienteID', 2, '', '$dataa', '$horaa');";

		mysql_query($sql);
		$sql = "select max(id_chamado) as novo from chamado where consultor_id = $consultorId";
		mysql_query($sql);
		$result = mysql_query($sql);
		$linha=mysql_fetch_object($result);
		$this->id_chamado = $linha->novo;
		$this->lerChamado($this->id_chamado);  
		return $this->id_chamado;		
	 }
	
	
	 function lerChamado($chamadoId) {
	
		$this->id_chamado = $chamadoId;	
        $sql  = "select * from chamado WHERE id_chamado = $this->id_chamado;";

		$result = mysql_query($sql);		
		$linha = mysql_fetch_object($result);

		$this->dataa = $linha->dataa;		
        $quando = explode("-", $this->dataa);
		
		$this->datauc = $linha->datauc;		
		$quando2 = explode("-", $this->dataa);
		
		$this->dataaf = "$quando[2]/$quando[1]/$quando[0]";				
		$this->dataafUC = "$quando2[2]/$quando2[1]/$quando2[0]";						
		
		$this->id_chamado = $chamadoId;
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
		$this->descricao = $linha->descricao;
		$this->status = $linha->status;
		$this->lido = $linha->lido;		
		$this->lidodono = $linha->lidodono;				
		$this->rnc = $linha->rnc;
		$this->horauc = $linha->horauc;
		return;
	 }
	
	 function gravaChamado() {
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
		$sql .= "datauc = '$this->datauc', ";
		$sql .= "horauc = '$this->horauc', ";		
		$sql .= "status = $this->status, ";
		$sql .= "lido = $this->lido, ";		
		$sql .= "lidodono = $this->lidodono, ";				
		$sql .= "descricao = '$this->descricao', ";
		$sql .= "rnc = $this->rnc, ";
		$sql .= "email = '$this->email', ";		
		$sql .= "motivo_id = $this->motivo_id ";
		$sql .= "WHERE id_chamado = $this->id_chamado;";
//	    print $sql; 
		$result = mysql_query($sql);
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

  function novoContato( $chamadoId, $consultorId, $destinatarioId, $dataa, $horaa) {
  
    $http_path = "/var/www/default";
  
    $sql = "INSERT INTO contato ";
    $sql .= "(chamado_id, consultor_id, destinatario_id, dataa, horaa, status_id) ";
    $sql .= "VALUES ($chamadoId,  $consultorId, $destinatarioId, '$dataa', '$horaa', 2);";
	
//    print $sql;
	
    mysql_query($sql);
    $sql = "select max(id_contato) as novo from contato where chamado_id = $chamadoId";	
    mysql_query($sql);
    $result = mysql_query($sql);
    $linha=mysql_fetch_object($result);
    $this->id_contato = $linha->novo;


	if (($this->id_contato % 50)==0) {
      $arq = fopen( $http_path . "/backup/atendimento_bkp.txt", "w");
      $teste=`mysqldump teste -uroot -pmarcia --add-drop-table`;
      fputs( $arq, $teste );
      fclose( $arq );	  	  
	  
      $teste = `zip /var/www/default/backup/backupdiario.zip /var/www/default/backup/atendimento_bkp.txt`;
      $teste = `rm /var/www/default/backup/atendimento_bkp.txt -f`;
	  $teste = `cp /var/www/default/backup/backupdiario.zip /home/samba/backupdiario.zip`;
	  	  
      $arq = fopen($http_path . "/backup/ultimo.htm", "w");
      $teste="<br>Último backup efetuado em $dataa, as $horaa: <a href=\"backupdiario.zip\">Pegue</a>";
      fputs( $arq, $teste );
      fclose( $arq );

		$msg="Um backup acabou de ser rodado
		$dataa $horaa
		chamado : $chamadoId
		contato : $linha->novo
		
		--		
		O arquivo pode ser encontrado na pasta \\\\192.168.0.5\\public\\
		---
		Fernando Nomellini ® 2003
		";
		$recipient = "helio.vezu@datamace.com.br; hamilton.neto@datamace.com.br"; 
		$subject = "Backup SAD";
		$headers = "";
		$headers .= "From: SAD <sad@datamace.com.br>\n";
		mail($recipient, $subject, $msg, $headers);

	 }

	
    return $this->id_contato;
  }


  function lerContato( $id ) {

    $this->id_contato = $id;
	
    $sql = "select * from contato where id_contato = $id;";

    $result = mysql_query($sql);
    $linha = mysql_fetch_object($result);
	
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
		$sql .= "historico = '$this->historico', ";
		$sql .= "rnc = $this->rnc, ";		
		$sql .= "publicar = $this->publicar ";
		$sql .= "WHERE id_contato = $this->id_contato;";	
		$result = mysql_query($sql);
		return $sql;
	 }

}

?>