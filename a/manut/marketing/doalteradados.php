<?

  $prospect = !$prospect;

  $quando = explode("/", $previsao);
  $dataa = "$quando[2]-$quando[1]-$quando[0]";		  

  require("../../scripts/conn.php");	
  $sql = "UPDATE clienteplus ";  
  $sql .= "SET endereco = '$endereco', ";
  $sql .= "bairro = '$bairro', ";
  $sql .= "cidade = '$cidade', ";
  $sql .= "uf = '$uf', ";
  $sql .= "cep = '$cep', ";
  $sql .= "telefone = '$telefone', ";
  $sql .= "fax = '$fax', ";
  $sql .= "atendimento = $sad, ";
  $sql .= "bloqueio = $bloqueio, ";
  $sql .= "funcionarios = '$funcionarios', ";
  $sql .= "gip = $gip, ";
  $sql .= "ativo = $ativo, ";
  $sql .= "contabil = $contabil, ";    
  $sql .= "Ic_Intersystem = $Ic_Intersystem, ";    
  $sql .= "Ic_Datacenter = $Ic_Datacenter, ";      
  $sql .= "Ic_SLA = $Ic_SLA, ";        
  $sql .= "Qt_SLA = '$qt_sla', ";          
  $sql .= "Ic_PosVenda = $Ic_PosVenda, ";          
	
  
  if ($responsavel) {
    $sql .= "responsavel = $responsavel, ";
  }
  
  if ($ramo_id) {
    $sql .= "ramo_id = $ramo_id, ";
  }
  
  $sql .= "email = '$email', ";
  $sql .= "site = '$site', ";
  if ($onde_id) {
    $sql .= "onde_id = $onde_id, ";
  }
  $sql .= "cnpj = '$cnpj', ";
  $sql .= "insc = '$insc', ";
  $sql .= "prospect = !$cliente, ";

  if($pessoasnodp) {
    $sql .= "pessoasnodp = $pessoasnodp, ";
  }
  $sql .= "folhaanterior = '$folhaanterior', ";
  $sql .= "previsao = '$dataa', ";
  $sql .= "conversao = '$conversao', ";
  $sql .= "intersystem = '$intersystem', ";
  $sql .= "rede = '$rede', ";
  $sql .= "banco = '$banco', ";
  $sql .= "obs = '$obs' ";
  $sql .= "WHERE id_cliente = '$id_cliente';";



  mysql_query($sql);
  header("Location: clientes02.php?id_cliente=" . rawurlencode($id_cliente)  );
?>