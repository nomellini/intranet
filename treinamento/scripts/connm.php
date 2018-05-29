<?


function pegaCargo($cargo) {
  if($cargo) {
    $sql = "Select cargo from cargos where id_cargo = $cargo;";
    $result = mysql_query($sql);
    $linha = mysql_fetch_object( $result ) ;
    $idtemp = $linha->cargo;
    return $idtemp; 
  } else {
    return "Não cadastrado";
  }
}

function listaCargo() {
 $saida = array();
 $sql = "SELECT * from cargos order by cargo";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_cargo"] = $linha->id_cargo;
     $tmp["cargo"] = $linha->cargo;
     $saida[$conta++] = $tmp;
   }   
  return $saida;     
}

function pegaRamo($ramo) {
  if ($ramo) {
    $sql = "Select ramo from ramo where id_ramo = $ramo;";
    $result = mysql_query($sql);
    $linha = mysql_fetch_object( $result ) ;
    $idtemp = $linha->ramo;
    return $idtemp; 
  } else {
    return "Ramo não cadastrado";
  }
}

function listaRamo() {
 $saida = array();
 $sql = "SELECT * from ramo order by ramo ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_ramo"] = $linha->id_ramo;
     $tmp["ramo"] = $linha->ramo;
     $saida[$conta++] = $tmp;
   }   
  return $saida;     
}



function pegaOnde($onde) {
  if($onde) {
    $sql = "Select onde from onde where id_onde = $onde;";
    $result = mysql_query($sql);
    $linha = mysql_fetch_object( $result ) ;
    $idtemp = $linha->onde;
    return $idtemp; 
  } else {
    return "Não cadastrado";
  }
  
  
}

function listaOnde() {
 $saida = array();
 $sql = "SELECT * from onde order by onde";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_onde"] = $linha->id_onde;
     $tmp["onde"] = $linha->onde;
     $saida[$conta++] = $tmp;
   }   
  return $saida;     
}


function pegaClientePlus() {
  $saida = array();
  $sql = "Select * from clienteplus ORDER BY cliente;";
  $result = mysql_query($sql);  
  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {	 
	    $tmp["id_cliente"] = $linha->id_cliente;
	    $tmp["cliente"] = $linha->cliente;
        $saida[$conta++] = $tmp;
	 }
  return $saida;    
}

function pegaClientePlusPorCodigo($codigo) {

  $saida = array();
  $sql = "Select * from cliente where id_cliente = '$codigo%';";
  $result = mysql_query($sql);  
  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {	 
	    $tmp["id_cliente"] = $linha->id_cliente;
	    $tmp["cliente"] = $linha->cliente;
		$tmp["senha"] = $linha->senha;		
		$tmp["telefone"] = $linha->telefone;
		$tmp["endereco"] = $linha->endereco;
		$tmp["bairro"] = $linha->bairro;
		$tmp["cidade"] = $linha->cidade;		
		$tmp["fax"] = $linha->fax;
		$tmp["funcionarios"] = $linha->funcionarios;		
		$tmp["bloqueio"] = $linha->bloqueio;
		$tmp["uf"] = $linha->uf;
		$tmp["cep"] = $linha->cep;
		$tmp["responsavel"] = peganomeusuario($linha->responsavel);
		$tmp["ramo"] = pegaRamo($linha->ramo_id);
		$tmp["email"] = $linha->email;
		$tmp["site"] = $linha->site;
		$tmp["onde"] = pegaOnde($linha->onde_id);
		$tmp["cnpj"] = $linha->cnpj;
		$tmp["insc"] = $linha->insc;
		$tmp["prospect"] = $linha->prospect;		
		$tmp["pessoasnodp"] = $linha->pessoasnodp;
		$tmp["folhaanterior"] = $linha->folhaanterior;		
		$tmp["previsao"] = $linha->previsao;
		$tmp["conversao"] = $linha->conversao;
		$tmp["intersystem"] = $linha->intersystem;
		$tmp["rede"] = $linha->rede;
		$tmp["banco"] = $linha->banco;				
        $saida[$conta++] = $tmp;
	 }
  return $saida;    
}

?>
