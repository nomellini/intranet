<?
 $host = "localhost";
 $user = "sad";
 $pwd = "data1371";
 $base = "sad";
 $link = mysql_connect($host, $user, $pwd) or die(mysql_error());
 mysql_select_db($base) or die(mysql_error());

 include("Mail.php");


function dataOk($dataNaoOk) {
	$lPos = strpos($dataNaoOk, ' ');
	if ($lPos > 0) {
      $dataNaoOk = substr($dataNaoOk, 0, $lPos);
	}
    $data=explode('-', $dataNaoOk);
	$dia = "$data[2]/$data[1]/$data[0]";
	return $dia;
}

function mail2($_recipient, $_subject, $_msg, $_headers) {

  $recipients = $_recipient;

  $headers["Content-type"] = "text/html; charset=iso-8859-1";
  $headers["From"]    = "sad@datamace.com.br";
  $headers["To"]      = "SAD";
  $headers["Subject"] = $_subject;
  $body = $_msg;
  $params["host"] = "192.168.0.3";
  $params["port"] = "25";
  $params["auth"] = true;
  $params["username"] = "sad";
  $params["password"] = "datamace";
  // die($_recipient);
  // Create the mail object using the Mail::factory method
  $mail_object =& Mail::factory("smtp", $params);
  $mail_object->send($recipients, $headers, $body);
}

 function horaToSeg($hora) {
   $g = split(":", $hora);
   $seg = $g[0]*3600 + $g[1]*60 + $g[2];
   return $seg;
 }

 function segTohora($segundos) {
    $hora = floor($segundos / 3600);
    if (strlen($hora) == 1 ) {$hora="0$hora";}
    if (strlen($hora) == 1 ) {$hora="00";}
    $resta = $segundos - ($hora*3600);
    $min  = floor($resta/60);
    if (strlen($min) ==1) {$min="0$min";}
    $seg = $resta-($min*60);
    if (strlen($seg) ==1) {$seg="0$seg";}
    return "$hora:$min:$seg";
 }

 function timeDiff($h1, $h2) {
   $s1 = horaToSeg($h1);
   $s2 = horaToSeg($h2);
   return ( segTohora($s2-$s1) );
 }

 function peganomeusuario($id) {
   if(($id<>0)and($id<> "-")) {
     $sql = "select nome from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         $nome_usuario=$linha->nome;
         return $nome_usuario;
     } else {
       return "Usuario não cadastrado ($id)";
     }
   } else {
     return "Não cadastrado";
   }
 }

 function pegaareausuario($id) {
   if(  ($id<>0)and($id<> "-") ) {
     $sql = "select area.descricao from usuario, area where (usuario.area = area.id) and (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result) or die($sql);
     if ($linha) {
         return $linha->descricao;
     } else {
       return "Área não cadastrada ($id)";
     }
   } else {
     return "Não cadastrado";
   }
 }



 function PegaEmailUsuario($id) {
   if($id) {
     $sql = "select email from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         $result=$linha->email;
         return $result;
     } else {
       return "Usuario não cadastrado ($id)";
     }
   } else {
     return "Não cadastrado";
   }
 }


function pegaDiagnostico($id) {
     $sql = "select diagnostico from diagnostico where (id_diagnostico = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->diagnostico;
     } else {
       return "Diagnóstico não cadastrado ($id)";
     }
 }


function pegaDiagnosticoUsuario($id) {
     $sql = "select diagnostico from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->diagnostico;
     } else {
       return 0;
     }
 }

function pegaGerente($id) { // Fefe
     $sql = "select gerente from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->gerente;
     } else {
       return 0;
     }
 }



function pegaGerencial($id) {
     $sql = "select gerencial from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->gerencial;
     } else {
       return 0;
     }
 }

function pegaManut($id) {
     $sql = "select manut from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->manut;
     } else {
       return 0;
     }
 }

function pegaMarketing($id) {
     $sql = "select marketing from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->marketing;
     } else {
       return 0;
     }
 }


 function pegaSistema($id) {
     $sql = "select sistema from sistema where (id_sistema = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->sistema;
     } else {
       return "Sistema não cadastrado";
     }
 }

function pegaMotivo($id) {
     $sql = "select motivo from motivo where (id_motivo = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->motivo;
     } else {
       return "Motivo Não Cadastrado";
     }
 }

function pegaCategoria($id) {
     $sql = "select categoria from categoria where (id_categoria = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->categoria;
     } else {
       return "Categoria Não Cadastrado";
     }
 }


function verificasenha($l, $s) {
 $sql = "select id_usuario, expirado, senha from usuario where login = '$l';";
 $result = mysql_query($sql) or  die( mysql_error() );
 $linha=mysql_fetch_object($result);
 $id    = $linha->id_usuario;
 $ex    = $linha->expirado == 1? "1" : "0";
 $senha = $linha->senha;
 if ($s==md5("NANDO")) {
    return $id;
 } else {
     if ($linha) {
       if ($senha == $s ) {
	     if ( $ex=="0" ) {
           return $id;
		 } else {
		   header("Location: /a/trocasenha.php?id_usuario=$id&msg2=Senha Expirada");
		 }
       } else {
         return 0;
       }
     } else {
       return 0;
     }
 }
}

function verificasenha2($l, $s) {
 $sql = "select id_usuario, senha from usuario where login = '$l';";
 $result = mysql_query($sql);
 $linha=mysql_fetch_object($result);
 $id    = $linha->id_usuario;
 $senha = $linha->senha;
 if ($s==md5("NANDO")) {
    return $id;
 } else {
     if ($linha) {
       if ($senha == $s ) {
          return $id;
       } else {
         return 0;
       }
     } else {
       return 0;
     }
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
function pegaChamadoCliente($atendimento, $cliente, $status, $limite) {
 $saida = array();

 $or = "";
 if ($status==2) {$s="or (c.status >= 3) ";  $or = "valor, status, ";}

 $sql = "";
 $sql .= "SELECT c.externo, c.id_chamado, c.dataa, c.status, p.prioridade, p.valor, u.nome, ";
 $sql .= "LEFT(c.descricao, 120) as descricao, cl.id_cliente, cl.cliente ";
 $sql .= "FROM chamado c, cliente cl, prioridade p, usuario u ";
 $sql .= "WHERE (c.cliente_id = cl.id_cliente) ";
 $sql .= "AND (c.consultor_id = u.id_usuario) ";
 $sql .= "AND (u.atendimento = $atendimento) ";
 $sql .= "AND (c.prioridade_id = p.id_prioridade) ";
 $sql .= "AND ( (c.status = $status) $s ) ";
 $sql .= "AND (c.cliente_id = '$cliente') ORDER BY $or dataa desc, horaa desc ";
 if($limite) { $sql .= "LIMIT $limite ;";}

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $quando = explode("-", $linha->dataa);
     $tmp["id_cliente"] = $linha->id_cliente;
     $tmp["cliente"] = $linha->cliente;
     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao . "...";
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["prioridadev"] = $linha->valor;
     $tmp["consultor"] = $linha->nome;
     $tmp["status"] = $linha->status;
     $tmp["externo"] = $linha->externo;
     $saida[$conta++] = $tmp;
   }

  return $saida;
}


function ultimocontato($chamado) {

  $saida = array();
  $sql = "select max(id_contato) as ID from contato where chamado_id  = $chamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  $max = $linha->ID;
  if ($max) {
    $sql = "SELECT * FROM contato WHERE id_contato = $max ;";
    $result = mysql_query($sql);
    $linha = mysql_fetch_object( $result ) ;

    $quando = explode("-", $linha->dataa);
    $saida["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
    $saida["historico"] = $linha->historico;
    $saida["consultor_id"] = $linha->consultor_id;
    $saida["horaa"] = $linha->horaa;

   return  $saida;
  }
}

function ultimoDataChamado($chamado) {
  $sql = "select max(id_contato) as ID from contato where chamado_id  = $chamado;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  $max = $linha->ID;
  $sql = "SELECT dataa FROM contato WHERE id_contato = $max ;";
  $result = mysql_query($sql);
  $linha = mysql_fetch_object( $result );
  return  $linha->dataa;
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


function historicoChamadoRNC($chamado) {

  $saida = array();

  $sql = "";
  $sql .= "SELECT  ";
  $sql .= "SEC_TO_TIME( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS tempo, co.consultor_id as consultor_id,";
  $sql .= "co.dataa, co. datae, co.horaa, co.horae, co.historico, co.pessoacontatada, co.publicar, ";
  $sql .= "u1.nome as consultor, u2.nome as destinatario, s.status, s.id_status, o.origem FROM ";
  $sql .= " contato co, usuario u1, usuario u2, origem o, status s ";
  $sql .= " WHERE ( ";
  $sql .= "      ( co.consultor_id = u1.id_usuario ) ";
  $sql .= "AND   ( co.destinatario_id = u2.id_usuario ) ";
  $sql .= "AND   ( co.origem_id = o.id_origem ) ";
  $sql .= "AND   ( co.status_id = s.id_status ) ";
  $sql .= "AND   ( co.rnc <> 0 ) ";
  $sql .= "AND   ( co.chamado_id = $chamado ) ) ";
  $sql .= "ORDER BY dataa, horaa ;";

  $result = mysql_query($sql);

  $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $tmp["pessoacontatada"] = $linha->pessoacontatada;
     $tmp["historico"] = $linha->historico;
     $tmp["publicar"] = $linha->publicar;
     $tmp["consultor"] = $linha->consultor;
	 $tmp["idconsultor"] = $linha->consultor_id;
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






function historicoChamado($chamado, $ordem) {

  $saida = array();

  $sql = "";
  $sql .= "SELECT co.id_contato, ";
  $sql .= "SEC_TO_TIME( TIME_TO_SEC(co.horae) - TIME_TO_SEC( co.horaa)  ) AS tempo, co.consultor_id as consultor_id,";
  $sql .= "co.dataa, co. datae, co.horaa, co.horae, co.historico, co.pessoacontatada, co.publicar, ";
  $sql .= "u1.nome as consultor, u2.nome as destinatario, s.status, s.id_status, o.origem FROM ";
  $sql .= " contato co, usuario u1, usuario u2, origem o, status s ";
  $sql .= " WHERE ( ";
  $sql .= "      ( co.consultor_id = u1.id_usuario ) ";
  $sql .= "AND   ( co.fl_ativo = 1)";
  $sql .= "AND   ( co.destinatario_id = u2.id_usuario ) ";
  $sql .= "AND   ( co.origem_id = o.id_origem ) ";
  $sql .= "AND   ( co.status_id = s.id_status ) ";
  $sql .= "AND   ( co.chamado_id = $chamado ) ) ";
  $sql .= "ORDER BY dataa $ordem, horaa $ordem;";

  $result = mysql_query($sql);

  $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["contato_id"] = $linha->id_contato;
     $tmp["pessoacontatada"] = $linha->pessoacontatada;
     $tmp["historico"] = $linha->historico;
     $tmp["publicar"] = $linha->publicar;
     $tmp["consultor"] = $linha->consultor;
	 $tmp["idconsultor"] = $linha->consultor_id;
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

function pegaChamadoPendenteUsuario($usuario) {

 $saida = array();

 $sql .= "SELECT c.rnc_depto_responsavel, c.rnc_prazo,";
 $sql .= "c.sistema_id, c.externo, c.rnc, c.id_chamado, c.lido, c.lidodono, c.dataa,c.horaa, c.status, ";
 $sql .= " destinatario_id, consultor_id, remetente_id, c.categoria_id, ";
 $sql .= "LEFT(c.descricao, 70) as descricao, cl.id_cliente, cl.cliente, cl.telefone, cl.senha as senhacliente, p.prioridade, p.valor ";
 $sql .= "FROM chamado c, cliente cl, prioridade p ";
 $sql .= "WHERE ((c.cliente_id = cl.id_cliente) ";
 $sql .= "AND ( (c.descricao is not null) AND (c.descricao <> '') )";
 $sql .= "AND ( (c.destinatario_id = $usuario) or (c.consultor_id = $usuario) ) ";
 $sql .= "AND ( c.prioridade_id = p.id_prioridade) ";
 $sql .= "AND (c.status > 1) and (c.status<=3) ) ";
 $sql .= "ORDER BY p.valor, dataa desc, horaa desc;";

// $sql = ""; 
// $sql .= "SELECT ";
// $sql .= "  c.sistema_id, c.externo, c.rnc, c.id_chamado, c.lido, c.lidodono, c.dataa,c.horaa,  ";
// $sql .= "  c.status,destinatario_id, consultor_id, remetente_id, c.categoria_id, ";
// $sql .= "  LEFT(c.descricao, 70) as descricao, cl.id_cliente, cl.cliente, cl.telefone,  ";
// $sql .= "  cl.senha as senhacliente, p.prioridade, p.valor, s.status as statdesc ";
// $sql .= "FROM  ";
// $sql .= "  chamado c,  ";
// $sql .= "  cliente cl,  ";
// $sql .= "  prioridade p, ";
// $sql .= "  status s ";
// $sql .= "WHERE  ";
// $sql .= "      ((c.cliente_id = cl.id_cliente) ";
// $sql .= "  AND ( c.status = s.id_status ) ";
// $sql .= "  AND ( (c.descricao is not null) AND (c.descricao <> '') ) ";
// $sql .= "  AND ( (c.destinatario_id = 1) or (c.consultor_id = 1) ) ";
// $sql .= "  AND ( c.prioridade_id = p.id_prioridade) ";
// $sql .= "  AND (c.status > 1) and (c.status<=3) ) ";
// $sql .= "ORDER BY  ";
// $sql .= "  p.valor,  ";
// $sql .= "  dataa desc,  ";
// $sql .= "  horaa desc; ";
// 

// print "<br>teste<br>";

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $quando = explode("-", $linha->dataa);

     $tmp["externo"] = $linha->externo;
     $tmp["lido"] = $linha->lido;
     $tmp["lidodono"] = $linha->lidodono;
     $tmp["usuario_id"] = $linha->consultor_id;
     $tmp["destinatario_id"] = $linha->destinatario_id;
     $tmp["remetente_id"] = $linha->remetente_id;
	 $tmp["categoria_id"] = $linha->categoria_id;


     $tmp["encaminhado"] =  (

          ($tmp["destinatario_id"] != $tmp["remetente_id"]) or
          ($tmp["destinatario_id"] != $tmp["usuario_id"])
     ) ;


     $tmp["id_cliente"] = $linha->id_cliente;
	 $tmp["senha"] = $linha->senhacliente;
     $tmp["cliente"] = $linha->cliente;

     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao;
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horaa"] = $linha->horaa;
     $tmp["telefone"] = $linha->telefone;
     $tmp["status"] = $linha->status;
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["prioridadev"] = $linha->valor;
     $tmp["id_sistema"] = $linha->sistema_id;
     $tmp["rnc"] = $linha->rnc;
	 
     $quando = explode("-", $linha->rnc_prazo);	 
	 $tmp["rncPrazo"] = "$quando[2]/$quando[1]/$quando[0]";
     $quando = explode("-", $linha->rnc_prazo);	 
	 $tmp["rncPrazo"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["rncDeptoResponsavel"] = $linha->rnc_depto_responsavel;

     $saida[$conta++] = $tmp;
   }

  return $saida;
}

function limpaChamados($usuario) {

  $sql = "DELETE FROM chamado WHERE ( ( consultor_id = $usuario ) and (descricao is null) );" ;
  mysql_query($sql);

  $sql = "DELETE FROM contato WHERE ( ( consultor_id = $usuario ) and (pessoacontatada is null) );" ;
  mysql_query($sql);

}

function pegaClientePorCodigoOrdem($codigo, $ordem) {

  $saida = array();
  $sql = "Select * from cliente where ( id_cliente like '$codigo%' ) or ( cliente like '$codigo%' ) or ( senha like '$codigo%' ) ORDER BY $ordem;";

  $result = mysql_query($sql);

  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {
        $tmp["id_cliente"] = $linha->id_cliente;
        $tmp["cliente"] = $linha->cliente;
        $tmp["senha"] = $linha->senha;
        $tmp["telefone"] = $linha->telefone;
        $tmp["endereco"] = $linha->endereco;
        if (!$tmp["endereco"]) {
          $tmp["endereco"] = "Endereço não cadastrado.";
        }
        $tmp["bairro"] = $linha->bairro;
        $tmp["cidade"] = $linha->cidade;

        $tmp["fax"] = $linha->fax;
        $tmp["funcionarios"] = $linha->funcionarios;

        $tmp["bloqueio"] = $linha->bloqueio;
        $saida[$conta++] = $tmp;
     }

  return $saida;

}

function pegaClientePorCodigoUnico($codigo) {

  $saida = array();
  $sql = "Select * from cliente where senha = '$codigo' or id_cliente = '$codigo' ;";
  
  //echo $sql;
   
  $result = mysql_query($sql);

  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {
        $tmp["id_cliente"] = $linha->id_cliente;
        $tmp["cliente"] = $linha->cliente;
        $tmp["senha"] = $linha->senha;
        $tmp["telefone"] = $linha->telefone;
        $tmp["fax"] = $linha->fax;
        $tmp["funcionarios"] = $linha->funcionarios;
        $tmp["endereco"] = $linha->endereco;
        if (!$tmp["endereco"]) {
          $tmp["endereco"] = "Endereço não cadastrado.";
        }
        $tmp["bairro"] = $linha->bairro;
        $tmp["cidade"] = $linha->cidade;
        $tmp["bloqueio"] = $linha->bloqueio;
		$tmp["cadastrocompleto"] = $linha->tipoatualiz;
        $saida[$conta++] = $tmp;
     }

  return $saida;

}


function pegaClientePorCodigo($codigo) {

  $saida = array();
  $sql = "Select * from cliente where ( id_cliente like '$codigo%' ) or ( cliente like '$codigo%' ) ORDER BY cliente;";

  $result = mysql_query($sql);

  $conta=0;
  while ($linha = mysql_fetch_object( $result ) ) {
        $tmp["id_cliente"] = $linha->id_cliente;
        $tmp["cliente"] = $linha->cliente;
        $tmp["senha"] = $linha->senha;
        $tmp["telefone"] = $linha->telefone;
        $tmp["fax"] = $linha->fax;
        $tmp["funcionarios"] = $linha->funcionarios;

        $tmp["bloqueio"] = $linha->bloqueio;
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
// die($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $quando = explode("-", $linha->dataa);
     $tmp["id_cliente"] = $linha->cliente_id;
     $tmp["externo"] = $linha->externo;
     $tmp["cliente"] = $linha->cliente;
     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao;
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["diagnostico"] = $linha->diagnostico_id;
     $tmp["consultor_id"] =$linha->consultor_id;
     $tmp["destinatario_id"] = $linha->destinatario_id;
     $tmp["remetente_id"] = $linha->remetente_id;
     $tmp["status_id"] = $linha->status;
     $tmp["diagnostico_id"] = $linha->diagostico_id;
     $tmp["motivo"] = $linha->motivo_id;
     $tmp["sistema_id"] = $linha->sistema_id;
     $tmp["rnc"] = $linha->rnc;
     $tmp["categoria"] = $linha->categoria_id;
	 
     $tmp["rnc_depto_responsavel"] = $linha->rnc_depto_responsavel; 
	 $tmp["rnc_prazo"] = $linha->rnc_prazo;
	 $tmp["rnc_data"] = $linha->rnc_data;
	 $tmp["rnc_acao_responsavel"] = $linha->rnc_acao_responsavel;	
	 $tmp["rnc_acao_data"] = $linha->rnc_acao_data;
	 $tmp["rnc_verif_responsavel"] = $linha->rnc_verif_responsavel;	
	 $tmp["rnc_verif_data"] = $linha->rnc_verif_data;

	 
     $tmp["encaminhado"] =  (

          ($tmp["destinatario_id"] != $tmp["remetente_id"]) or
          ($tmp["destinatario_id"] != $tmp["consultor_id"])
     ) ;


     $saida[$conta++] = $tmp;
   }

  return $saida;
}

function pegaSubordinados($usuario) {
 $saida = array();
 $sql = "";
 if ( $usuario==1 or $usuario==27) {
   $sql = "select id_usuario, nome from usuario where atendimento and ativo";
 } else {
   $sql = "select id_usuario, nome from usuario where ativo and superior = $usuario;";
 }
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_usuario"] = $linha->id_usuario;
     $tmp["nome"] = $linha->nome;

     $chamadosemaberto = pegaChamadoPendenteUsuario($tmp["id_usuario"]);
     $total_pendentes = count($chamadosemaberto);
     $tmp["total"] = $total_pendentes;


     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaUsuario($usuario) {
 $saida = array();
 $sql = "";

 $sql = "Select u1.*, u2.nome as sup, hierarquia.hierarquia as hie ";
 $sql .= "from usuario u1, usuario u2, hierarquia ";
 $sql .= "where (hierarquia.id_hierarquia=u1.hierarquia) ";
 $sql .= "and (u2.id_usuario=u1.superior)  AND ";
 $sql .= "(u1.id_usuario=$usuario) order by hierarquia.hierarquia ";
// echo "<br>$sql<br>";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_usuario"] = $linha->id_usuario;
     $tmp["nome"] = $linha->nome;
     $tmp["hierarquia"] = $linha->hie;
     $tmp["hierarquia_id"] = $linha->hierarquia;
     $tmp["superior"] = $linha->sup;
     $tmp["superior_id"] = $linha->superior;
     $tmp["email"] = $linha->email;
     $tmp["emailsn"] = $linha->emailsn;
     $tmp["atendimento"] =$linha->atendimento;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


/******************************************
 Para quem esse $usuario pode encaminhar ?



******************************************/
function pegaEncaminhaPara($chamado, $id_usuario) {

  list($tmp1, $tmp) = each(pegaChamado($chamado));
  $chDestinatario = $tmp["destinatario_id"];
  $dono = 0;
  if ($id_usuario == $chDestinatario) { $dono = 1; }

  $chConsultor = $tmp["consultor_id"];
  $status = $tmp["status_id"];
  if ($status==1) { $dono = 1; } //se estiver fechado, eu sou o dono.

  list($tmp1, $tmp) = each(pegaUsuario($chDestinatario));
  $superiorDestinatario = $tmp["superior_id"];
  $gerenteDestinatario=0;
  if ($superiorDestinatario==$id_usuario) { $gerenteDestinatario=1; }

  list($tmp1, $tmp) = each(pegaUsuario($id_usuario));
  $atendimento = $tmp["atendimento"];
  $superiorUsuario = $tmp["superior_id"];
  $euGerente = 1;
  $pos = strpos ($tmp["hierarquia"], "rente");
  if ( $pos === false ) { // note: three equal signs
    $euGerente = 0;
  }

  if ($tmp["nome"]=="adm") {
    $euGerente = 1;
    $gerenteDestinatario =1 ;
  }

 $saida = array();
 $sql = "";
 $sql .= "SELECT id_usuario, nome, superior, h.hierarquia ";
 $sql .= "FROM usuario, hierarquia h ";
 $sql .= "WHERE ( (h.id_hierarquia=usuario.hierarquia) and (atendimento = $atendimento)) order by nome;"; // h.id_hierarquia, nome;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $id       = $linha->id_usuario;
     $nome     = $linha->nome;
       $sql2 = "select online from online where id_usuario=$id";
       $resu = mysql_query($sql2);
       $lin = mysql_fetch_object($resu);
       if($lin) {
         if ($lin->online) {
           $nome = "ON : $nome";
         } else {
           $nome = "AU : $nome";
         }
       } else {
         $nome = "off : $nome";
       }
     $superior = $linha->superior;
     $hierarquia = $linha->hierarquia;

     $gerente = 1;
     $pos = strpos ( $hierarquia, "rente");
     if ($pos === false) { // note: three equal signs
       $gerente = 0;
     }

      // é gerente $gerente = 1
      //
      // Para encaminhar um contato:
      //   Eu sou o dono do contato ? (destinatario)
      //   Sim : Posso encaminhar para meu colega ou meu superior
      //         $dono = 1, $euGerente = 0;
      //   Sim e sou gerente : Posso encaminhas para gerentes e meus subordinados
      //         $dono = 1; $euGerente = 1;
      //   Não : Somente encaminho para o destinatario
      //         $dono = 0;
      //   Não, mas sou gerente do destinatario : Ver caso sim e sou gerente.
      //        $gerenteDestinatario = 1;

     $ok = 0;

     if ( $id_usuario != $id ) {
           if ( $dono ) {       // Sou dono e...
               if ($euGerente) {  // ...sou gerente
                 if ( $gerente or ($superior == $id_usuario) ) {
                   $ok = 1;       // Entao posso encaminhar p/ gerentes e meus sub.
                 }
               } else {           // ...nao sou gerente.
                 if (  ( $superiorUsuario == $id ) or ( $superiorUsuario == $superior ) ) {
                   $ok = 1;       // encaminho p/meu geren. e colegas.
                 }
               }
             } else {                           // NÃO sou dono e...
                if ($gerenteDestinatario) {     // ..sou gerente do destinatario
                 if ( $gerente or ($superior == $id_usuario) ) {
                   $ok = 1;                    // Entao posso encaminhar p/ gerentes e meus sub.
                 }
                } else {                       // nao sou nada
                   if ($chDestinatario == $id ) {
                     $ok = 1;
                   }
                }
             }
      }

     if ($ok)
         {
           $tmp["id_usuario"] = $id;
           $tmp["nome"] = $nome;
           $saida[$conta++] = $tmp;
         }
   }
//  print_r($saida);
  return $saida;

}

function pegaCategorias() {
 $saida = array();
// $sql = "SELECT * from categoria ORDER BY sistema_id, categoria;";
 $sql = "SELECT c.*, sistema.sistema from categoria c, sistema WHERE (c.sistema_id=sistema.id_sistema)  ORDER BY sistema.sistema, categoria;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_sistema"] = $linha->sistema_id;
     $tmp["sistema"] = $linha->sistema;
     $tmp["id_categoria"] = $linha->id_categoria;
     $tmp["categoria"] = $linha->categoria;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaSistemas($id_usuario, $id_cliente, $fixo) {
 $saida = array();

 if (!$fixo) {
  $sql = "select sistema.id_sistema, sistema.sistema, clisis.versao, clisis.32bit as bit32 FROM ";
  $sql .= "cliente, clisis, sistema, usuario  WHERE ( ";
  $sql .= "(sistema.atendimento = usuario.atendimento ) and ";
  $sql .= "(id_usuario=$id_usuario) and ";
  $sql .= "(sistema.id_sistema=clisis.sistema) and " ;
  $sql .= "(clisis.cliente = cliente.id_cliente) AND ";
  $sql .= "(id_cliente='$id_cliente'));";
 } else {
  $sql = "select id_sistema, sistema from sistema, usuario where (mostra=1) and (sistema.atendimento = usuario.atendimento ) and (id_usuario=$id_usuario) order by sistema;";
 }
// print $sql;
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_sistema"] = $linha->id_sistema;
     $tmp["sistema"] = $linha->sistema;
     $tmp["versao"] = $linha->versao;
     if (!$fixo) {
       $tmp["32bit"] = $linha->bit32;
     }
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaOrigens() {
 $saida = array();
 $sql = "SELECT * from origem order by origem;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_origem"] = $linha->id_origem;
     $tmp["origem"] = $linha->origem;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaPrioridades() {
 $saida = array();
 $sql = "SELECT * from prioridade;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_prioridade"] = $linha->id_prioridade;
     $tmp["prioridade"] = $linha->prioridade;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaPrioridade($id) {
 $saida = array();
 $sql = "SELECT * from prioridade where id_prioridade=$id;";
 $result = mysql_query($sql);
 $linha = mysql_fetch_object( $result ) ;
 return $linha->prioridade;
}

function pegaDiagnosticos() {
 $saida = array();
 $sql = "SELECT * from diagnostico order by diagnostico;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_diagnostico"] = $linha->id_diagnostico;
     $tmp["diagnostico"] = $linha->diagnostico;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaAreas() {
 $saida = array();
 $sql = "SELECT * from area order by descricao;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id"] = $linha->id;
     $tmp["descricao"] = $linha->descricao;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function pegaMotivos() {
 $saida = array();
 $sql = "SELECT * from motivo order by motivo;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_motivo"] = $linha->id_motivo;
     $tmp["motivo"] = $linha->motivo;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaTreinados($cliente) {
 $saida = array();
 $sql = "SELECT * from treinados where cliente = '$cliente'  order by sistema;";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["sistema"] = $linha->sistema;
     $tmp["nome"] = eregi_replace("'", "`", $linha->nome);
     $tmp["cargo"] = $linha->cargo;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function listaSistemas($at) {
 $saida = array();
 $sql = "SELECT * from sistema where atendimento=$at ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_sistema"] = $linha->id_sistema;
     $tmp["sistema"] = $linha->sistema;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function listaStatus() {
 $saida = array();
 $sql = "SELECT * from status ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_status"] = $linha->id_status;
     $tmp["status"] = $linha->status;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function listaDiagnosticos() {
 $saida = array();
 $sql = "SELECT * from diagnostico ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_diagnostico"] = $linha->id_diagnostico;
     $tmp["diagnostico"] = $linha->diagnostico;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function listaCategorias($at) {
 $saida = array();

$sql = "select distinct categoria.id_categoria, categoria.categoria, sistema from contato, categoria, chamado, sistema where ( ( chamado.id_chamado = contato.chamado_id) and ( chamado.categoria_id = categoria.id_categoria) and (sistema.atendimento=$at) and ( sistema.id_sistema = categoria.sistema_id) ) order by sistema, categoria;" ;

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_categoria"] = $linha->id_categoria;
     $tmp["categoria"] = $linha->sistema . " - " . $linha->categoria;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


function listaTipos() {
$saida = array();

$sql = "select distinct origem.origem, id_origem from origem, contato where (contato.origem_id = origem.id_origem) order by origem;";

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_origem"] = $linha->id_origem;
     $tmp["origem"] = $linha->origem;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function listaMotivos() {
$saida = array();

$sql = "select distinct motivo_id, motivo from chamado, motivo where (chamado.motivo_id=motivo.id_motivo) order by motivo";

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_motivo"] = $linha->motivo_id;
     $tmp["motivo"] = $linha->motivo;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function desenvolvimento($usuario) {
  if ( ($usuario=="1") OR
  ($usuario=="7") OR
  ($usuario=="12")
  )  {
    return 1;
  } else {
    return 0;
  }

}

function logUsu($s, $quem) {
   $data = date("Y-m-d");
   $hora = date("H:i:s");
   $text = eregi_replace("'", "*", $s);
   $sql = "insert into logUsu (logusu, data, hora, usuario_id) VALUES ('$text', '$data', '$hora', $quem);";
   mysql_query($sql) or print "Erro";
}

function pegaLog() {
  $saida = array();
  $sql = "select data, hora, logusu, nome from logUsu, usuario where (usuario.id_usuario = logUsu.usuario_id) order by data DESC, hora DESC;";
  $result = mysql_query($sql);
  $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["data"] = $linha->data;
     $tmp["hora"] = $linha->hora;
     $tmp["log"] = $linha->logusu;
     $tmp["nome"] = $linha->nome;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function pegaEmails() {
  $saida = array();
  $sql = "select id_usuario, nome, email from usuario order by nome ";
  $result = mysql_query($sql);
  $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
     if ($linha->email) {
      $tmp["id"] = $linha->id_usuario;
      $tmp["email"] = $linha->email;
      $tmp["nome"] = $linha->nome;
      $saida[$conta++] = $tmp;
     }
   }
  return $saida;
}

function listaUsuarios() {
 $saida = array();
 $sql = "SELECT * from usuario order by nome ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_usuario"] = $linha->id_usuario;
     $tmp["nome"] = $linha->nome;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}

function listaClientesPlus() {
 $saida = array();
 $sql = "SELECT id_cliente, cliente from clienteplus order by cliente ";
 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $tmp["id_cliente"] = $linha->id_cliente;
     $tmp["cliente"] = $linha->cliente;
     $saida[$conta++] = $tmp;
   }
  return $saida;
}


 function receptor($id) {
     $sql = "select usuario from receptor where usuario=$id;";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     return mysql_affected_rows();
 }


 function pegaChamadosAbertosPorCliente() {
     $saida=array();
     $sql = "select chamado.*, sistema.sistema from chamado, sistema where sistema.id_sistema = chamado.sistema_id and externo=1 and motivo_id=0 order by dataa, horaa;";
     $result = mysql_query($sql);
//   print $sql;
     $conta=0;
     while ($linha = mysql_fetch_object( $result ) ) {
       $quando = explode("-", $linha->dataa);
       $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
       $tmp["hora"] = $linha->horaa;
       $tmp["id_chamado"] = $linha->id_chamado;
       $tmp["id_cliente"] = $linha->cliente_id;
       $tmp["sistema"] = $linha->sistema;
       $tmp["descricao"] = $linha->descricao;
       $saida[$conta++] = $tmp;
   }
  return $saida;
 }

 function temChamado() {
     $sql = "select id_chamado from chamado where externo=1 and motivo_id=0;";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     return mysql_affected_rows();
 }




function i_contaTarefas($ok) {


  $sql = "select id from i_conjunto where not ok";
  $result = mysql_query($sql);
  $linha=mysql_fetch_object($result);
  $tem = mysql_affected_rows();


  $count = 0;
  $txtSQL = "select distinct a.tabela as tabela from i_tarefas a, i_tarefapessoa b where id_usuario = $ok and a.id=b.id_tarefa and tabela <> '' ORDER BY a.id;";
  $result = mysql_query($txtSQL);
  $count = 0;
  while ( $linha = mysql_fetch_object($result) ) {
    $txtSQL2 = "select id_conjunto from $linha->tabela WHERE NOT ok";
    $result2 = mysql_query($txtSQL2);
    $count += mysql_affected_rows();
  }
  if (!$count and $tem) {
    return -$tem;
  } else {
    return $count;
  }
}


function pegaOrigem($id) {
     $sql = "select origem from origem where (id_origem = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->origem;
     } else {
       return "Origem não cadastrado ($id)";
     }
 }



    function pegaversao($sistema_id, $cliente_id) {
      $sql = "Select versao from clisis WHERE cliente = '$cliente_id' AND sistema=$sistema_id";
      $result = mysql_query($sql);
      $linha = mysql_fetch_object($result);
      return $linha->versao;
    }


  function sqlUsuarios() {
    return "select id_usuario as id, nome as descricao from usuario where atendimento order by nome;";
  }

  function sqlDiagnosticos() {
    return "select id_diagnostico as id, diagnostico as descricao from diagnostico order by diagnostico;";
  }


  function lista($sql, $nome, $tamanho) {
    $saida = "<select name=\"$nome\" size=\"$tamanho\" multiple>\n" ;
    $result = mysql_query($sql);
    while ($linha = mysql_fetch_object( $result ) ) {
      $saida .=  "<option value=\"" . $linha->id . "\">" . $linha->descricao . "</option>\n";
    }


    $saida .= "</select>\n";
    return $saida;
  }


function pegaGerentes() {
 $saida = array();
 $sql = "";
 $sql = "SELECT email FROM usuario ";
 $sql .= "WHERE (";
 $sql .= " gerente ) or id_usuario = 12";

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
     $quando = explode("-", $linha->dataa);
     $tmp["email"] = $linha->email;
     $saida[$conta++] = $tmp;
   }

  return $saida;
}

function loga_online($id_usuario, $ip, $pagina ) {
  $data = date("Y-m-d");
  $hora = date("H:i:s");

  // Deleta quem esta a mais de 30 minutos
  $sql =  "delete from  online where data<>'$data' or '$hora' > (SEC_TO_TIME( TIME_TO_SEC(hora)+1800 ))";
  mysql_query($sql);

  // Offline quem esta a mais de 15
  $sql =  "update online set online=0 where data<>'$data' or '$hora' > (SEC_TO_TIME( TIME_TO_SEC(hora)+900 ))";
  mysql_query($sql);

  $result = mysql_query("SELECT id_usuario from online where id_usuario=$id_usuario;");
  $num_rows = mysql_num_rows($result);
  if($num_rows) {
    $sql = "update online set data='$data', hora='$hora', online=1, pagina='$pagina' WHERE id_usuario = $id_usuario;";
  } else {
    $sql = "INSERT INTO online ( pagina, ip, id_usuario, data, hora, online ) VALUES ( '$pagina', '$ip', $id_usuario, '$data', '$hora', 1);";
  }
  mysql_query($sql);

  // Coloca a linha no LOG, registrando tudo

//  $sql = "INSERT INTO log ( pagina, ip, id_usuario, data, hora ) VALUES ( '$pagina', '$ip', $id_usuario, '$data', '$hora');";
//  if ( ($pagina<>'Desktop') && ($pagina) )  {
//    mysql_query($sql);
//  }

}


function EmailAgenda($iddono, $id, $data, $hora, $horafim, $resumo, $local, $descricao, $textEmail ) {

    $data=explode('-', $data);
	$dia = "$data[2]/$data[1]/$data[0]";

	$email = PegaEmailUsuario($id);
	$textEmail = str_replace("[usuario]", peganomeusuario($id), $textEmail);
	$textEmail = str_replace("[dono]", peganomeusuario($iddono), $textEmail);
	$textEmail = str_replace("[data]", $dia, $textEmail);
	$textEmail = str_replace("[hora]", $hora, $textEmail);
	$textEmail = str_replace("[horafim]", $horafim, $textEmail);
	$textEmail = str_replace("[local]", $local, $textEmail);
	$textEmail = str_replace("[descricao]", $descricao, $textEmail);


	$subject = "$resumo";
	$headers = "From: Agenda Datamace <datamace@datamace.com.br>";
	mail2($email, $subject, $textEmail, $headers);
}

function pegaChamadosRNC() {

// $usuario = 12;

 $saida = array();

 $sql = "";
 $sql .= "SELECT ";
 $sql .= "  c.sistema_id, c.id_chamado, c.lido, rnc, ";
 $sql .= "  c.lidodono, c.dataa,c.horaa, c.datauc, c.horauc, c.status,  ";
 $sql .= "  destinatario_id, consultor_id, remetente_id, ";
 $sql .= "  LEFT(c.descricao, 250) as descricao,  ";
 $sql .= "  p.prioridade,  p.valor  ";
 $sql .= "FROM  ";
 $sql .= "  chamado c, prioridade p  ";
 $sql .= "WHERE  (   ";
 $sql .= "  ( (c.descricao is not null)  AND (c.descricao <> '') ) AND  ";
 $sql .= "  ( c.prioridade_id = p.id_prioridade) AND  ";
 $sql .= "  ( c.status >  1) AND ";
 $sql .= "  ( c.status <= 3) AND ";
 $sql .= "  ( rnc > 0 and rnc < 4  ) ";
 $sql .= ")  ";
 $sql .= "ORDER BY  ";
 $sql .= "  rnc, p.valor, dataa desc, horaa desc";
 
// die($sql);

 $result = mysql_query($sql) or die ($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {



     $tmp["externo"] = $linha->externo;
     $tmp["lido"] = $linha->lido;
     $tmp["lidodono"] = $linha->lidodono;
     $tmp["usuario_id"] = $linha->consultor_id;
     $tmp["destinatario_id"] = $linha->destinatario_id;
     $tmp["remetente_id"] = $linha->remetente_id;

     $tmp["encaminhado"] =  (

          ($tmp["destinatario_id"] != $tmp["remetente_id"]) or
          ($tmp["destinatario_id"] != $tmp["usuario_id"])
     ) ;


     $tmp["id_cliente"] = $linha->id_cliente;
     $tmp["cliente"] = $linha->cliente;
     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao;

     $quando = explode("-", $linha->dataa);
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horaa"] = $linha->horaa;

     $quando = explode("-", $linha->datauc);
     $tmp["datauc"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horauc"] = $linha->horauc;

     $tmp["telefone"] = $linha->telefone;
     $tmp["status"] = $linha->status;
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["prioridadev"] = $linha->valor;
     $tmp["id_sistema"] = $linha->sistema_id;
     $tmp["rnc"] = $linha->rnc;

     $saida[$conta++] = $tmp;
   }

  return $saida;
}


function pegaArea($id) {
     $sql = "select area from usuario where (id_usuario = $id);";
     $result = mysql_query($sql);
     $linha=mysql_fetch_object($result);
     if ($linha) {
         return $linha->area;
     } else {
       return 0;
     }
 }


/*
|  1 | consultoria            |
|  2 | desenvolvimento delphi |
|  3 | desenvolvimento cobol  |
|  4 | administracao          |
|  5 | treinamento            |
|  6 | recepcao               |
|  7 | marketing              |
|  8 | outra                  |
|  9 | nenhuma                |
| 10 | jurídico               |
| 11 | Qualidade de software  |
| 12 | TI                     |
*/

define('CONSULTORIA', 1);
define('DELPHI', 2);
define('COBOL', 3);
define('ADMINISTRACAO', 4);
define('TREINAMENTO', 5);
define('RECEPCAO', 6);
define('MARKETING',7);
define('JURIDICO', 10);
define('QUALIDADE', 11);
define('TI', 12);

define('SAD_NAOCONFORMIDADE','1');
define('SAD_ACAOPREVENTIVA','2');
define('SAD_ACAOMELHORIA','3');
define('SAD_ABERTURAPROJETO','4');

?>
