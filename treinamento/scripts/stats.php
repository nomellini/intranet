<?
 mysql_connect(localhost, sad, data1371);
 mysql_select_db(sad); 
 
 /**
   $ordem pode ser: 
     cliente
	 cliente desc
	 contatos
	 contatos desc
	 tempo
	 tempo desc	  
 **/
function statChamados($ordem,  
		 $consultor, 
		 $atendimento,
		 $status,
		 $categoria,
		 $tipo,
		 $datai,
		 $dataf,
		 $motivo,
		 $id_cliente,
		 $limite,
		 $enc,
		 $palavra,
		 $sistema, 
		 $externo,
		 $rnc
) {


$quando = explode("/", $datai);
$datai = "$quando[2]-$quando[1]-$quando[0]";
$quando = explode("/", $dataf);
$dataf = "$quando[2]-$quando[1]-$quando[0]";

$sql="";
$sql .= "SELECT ";
$sql .= "ch.externo, prioridade.prioridade, prioridade.valor, ";
$sql .= "usuario.nome, ";
$sql .= "sistema.sistema, ";
$sql .= "ch.dataa, ";
$sql .= "ch.horaa, ";
$sql .= "dest.nome as destinatario, ";
$sql .= "status.status, ";
$sql .= "categoria.categoria, ";
$sql .= "motivo.motivo, ";
$sql .= "id_cliente, ";
$sql .= "chamado_id, ";
$sql .= "left(ch.descricao, 60) as descr, ";
$sql .= "ch.descricao as descricaoc, ";
$sql .= "cliente, ";
$sql .= "count(id_contato) AS contatos, ";
$sql .= "SEC_TO_TIME( SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo, ";
$sql .= "SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) )  AS temposeg ";
$sql .= "FROM ";
$sql .= "contato, ";
$sql .= "usuario dest, "; 
$sql .= "sistema, ";
$sql .= "motivo, ";
$sql .= "usuario, ";
$sql .= "categoria, ";
$sql .= "cliente, ";
$sql .= "status, ";
$sql .= "prioridade, ";
$sql .= "chamado ch ";
$sql .= "WHERE ( ";
$sql .= "( contato.chamado_id = ch.id_chamado ) ";
$sql .= "AND ( ch.dataa >= '$datai' ) ";
$sql .= "AND ( ch.dataa <= '$dataf' ) ";
if($motivo) {
  $sql .= "AND (ch.motivo_id = $motivo ) ";
}

if($id_cliente) {
  $sql .= "AND (ch.cliente_id like '$id_cliente%' ) ";
}

if ($tipo) {
  $sql .= "AND ( contato.origem_id = $tipo ) ";
}

if ($sistema) {
  $sql .= "AND ( sistema.id_sistema = $sistema ) ";
}

if ($consultor) {
  $sql .= "AND ( usuario.id_usuario = $consultor ) ";
}
if ($status) {
  $sql .= "AND ( status.id_status = $status ) ";
}

if ($externo) {
  $sql .= "AND ( ch.externo = 1 ) ";
}

if ($rnc) {
  $sql .= "AND ( ch.rnc = 1 ) ";
}

if ($enc) {
  $sql .= "AND (dest.nome<>usuario.nome) "; 
}


if ($categoria) {
  $sql .= "AND ( categoria.id_categoria = $categoria ) ";
}

if ($palavra) {
  $sql .= "AND (( contato.historico like '%$palavra%' ) ";
  $sql .= "or ( ch.descricao like '%$palavra%' )) ";
}

$sql .= "AND ( ch.prioridade_id = prioridade.id_prioridade) ";
$sql .= "AND ( ch.motivo_id = motivo.id_motivo) ";
$sql .= "AND ( dest.id_usuario = ch.destinatario_id )  ";
$sql .= "AND ( sistema.id_sistema = categoria.sistema_id) ";
$sql .= "AND ( ch.status = status.id_status) ";
$sql .= "AND ( ch.categoria_id = categoria.id_categoria) ";
$sql .= "AND ( ch.cliente_id = cliente.id_cliente ) ";
$sql .= "AND ( ch.consultor_id = usuario.id_usuario) ";
$sql .= "AND ( usuario.atendimento = $atendimento) ";
$sql .= ") ";
$sql .= "GROUP BY chamado_id ";
$sql .= "ORDER BY $ordem ";
if ($limite) {
  $sql .= " LIMIT $limite ";
}
$sql .= ";";

//print "<br><b>$sql</b><br>";

   $saida = array();

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
   
     $quando = explode("-", $linha->dataa);
     $tmp["chamado_id"] = $linha->chamado_id;
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["horaa"] = $linha->horaa;
	 $tmp["status"]  = $linha->status;
	 $tmp["consultor"] = $linha->nome;
	 $tmp["cliente"] = $linha->cliente;
	 $tmp["id_cliente"] = $linha->id_cliente;
	 $tmp["contatos"] = $linha->contatos;
	 $tmp["tempo"] = $linha->tempo;
	 $tmp["temposeg"] = $linha->temposeg;
	 $tmp["descricao"] = $linha->descr;
	 $tmp["descricaoc"] = $linha->descricaoc;	 
	 $tmp["destinatario"] = $linha->destinatario;
	 $tmp["sistema"] = $linha->sistema;
	 $tmp["motivo"] = $linha->motivo;	 
	 $tmp["categoria"] = $linha->categoria;
	 $tmp["prioridade"] = $linha->prioridade;
	 $tmp["prioridadev"] = $linha->valor;	 
	 $tmp["externo"] = $linha->externo;	 
	 
	 if ($tmp[status] == "Em aberto") {
	   $tmp["status"] = "<font color=#ff0000>" . $tmp["status"] . "</font>";
	 }
	 
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

 }
 

function statChamados2($ordem,  
         
		 $consultor, 
		 $atendimento,
		 $status,
		 $categoria,
		 $tipo,
		 $datai,
		 $dataf,
		 $motivo,
		 $id_cliente,
		 $limite
) {

$quando = explode("/", $datai);
$datai = "$quando[2]-$quando[1]-$quando[0]";
$quando = explode("/", $dataf);
$dataf = "$quando[2]-$quando[1]-$quando[0]";

$sql="";
$sql .= "SELECT ";
$sql .= "usuario.nome, ";
$sql .= "chamado.dataa, ";
$sql .= "chamado.horaa, ";
$sql .= "status.status, ";
$sql .= "categoria.categoria, ";
$sql .= "motivo.motivo, ";
$sql .= "id_cliente, ";
$sql .= "chamado_id, ";
$sql .= "cliente, ";
$sql .= "count(id_contato) AS contatos, ";
$sql .= "SEC_TO_TIME( SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo, ";
$sql .= "SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) )  AS temposeg ";
$sql .= "FROM ";
$sql .= "contato, ";
$sql .= "motivo, ";
$sql .= "usuario, ";
$sql .= "categoria, ";
$sql .= "cliente, ";
$sql .= "status, ";
$sql .= "chamado ";
$sql .= "WHERE ( ";
$sql .= "( contato.chamado_id = chamado.id_chamado ) ";
$sql .= "AND ( chamado.dataa >= '$datai' ) ";
$sql .= "AND ( chamado.dataa <= '$dataf' ) ";
if($motivo) {
  $sql .= "AND (chamado.motivo_id = $motivo ) ";
}

if($id_cliente) {
  $sql .= "AND (chamado.cliente_id like '$id_cliente%' ) ";
}

if ($tipo) {
  $sql .= "AND ( contato.origem_id = $tipo ) ";
}

if ($consultor) {
  $sql .= "AND ( usuario.id_usuario = $consultor ) ";
}
if ($status) {
  $sql .= "AND ( status.id_status = $status ) ";
}
if ($categoria) {
  $sql .= "AND ( categoria.id_categoria = $categoria ) ";
}

$sql .= "AND ( chamado.motivo_id = motivo.id_motivo) ";
$sql .= "AND ( chamado.status = status.id_status) ";
$sql .= "AND ( chamado.categoria_id = categoria.id_categoria) ";
$sql .= "AND ( chamado.cliente_id = cliente.id_cliente ) ";
$sql .= "AND ( chamado.consultor_id = usuario.id_usuario) ";
$sql .= "AND ( usuario.atendimento = $atendimento) ";
$sql .= ") ";
$sql .= "GROUP BY chamado_id ";
$sql .= "ORDER BY $ordem ";
if ($limite) {
  $sql .= " LIMIT $limite ";
}
$sql .= ";";

//print "<br><b>$sql</b><br>";

   $saida = array();

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
   
     $quando = explode("-", $linha->dataa);
     $tmp["chamado_id"] = $linha->chamado_id;
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["horaa"] = $linha->horaa;
	 $tmp["status"]  = $linha->status;
	 $tmp["consultor"] = $linha->nome;
	 $tmp["cliente"] = $linha->cliente;
	 $tmp["id_cliente"] = $linha->id_cliente;
	 $tmp["contatos"] = $linha->contatos;
	 $tmp["tempo"] = $linha->tempo;
	 $tmp["temposeg"] = $linha->temposeg;
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

}
 
 
function pegaConsultores($atendimento) {

	 $sql = "SELECT usuario.id_usuario, ";
	 $sql .= "usuario.nome from usuario ";
	 $sql .= "where ( ";
	 $sql .= " usuario.atendimento = $atendimento) ";
	 $sql .= "order by nome;";


// print "<br><b>$sql</b><br>";

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {   
     $tmp["id_usuario"] = $linha->id_usuario;
	 $tmp["nome"] = $linha->nome;	 
     $saida[$conta++] = $tmp;
   }   
  return $saida;
}

function pegaSoConsultores($atendimento) {

	 $sql = "SELECT usuario.id_usuario, ";
	 $sql .= "usuario.nome from usuario ";
	 $sql .= "where ( ";
	 $sql .= " usuario.atendimento = $atendimento) ";
	 $sql .= " and area = 1 and ativo ";
	 $sql .= "order by nome;";


// print "<br><b>$sql</b><br>";

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {   
     $tmp["id_usuario"] = $linha->id_usuario;
	 $tmp["nome"] = $linha->nome;	 
     $saida[$conta++] = $tmp;
   }   
  return $saida;
}


function statCategorias($atendimento, $sistema, $categoria, $datai, $dataf, $ordem) {

    $quando = explode("/", $datai);
    $datai = "$quando[2]-$quando[1]-$quando[0]";
    $quando = explode("/", $dataf);
    $dataf = "$quando[2]-$quando[1]-$quando[0]";
    $sql  = "SELECT ";
	$sql .= "categoria.id_categoria, sistema.sistema, categoria.categoria, count(*) AS chamados ";
	$sql .= "FROM  ";
	$sql .= " sistema, categoria, chamado, usuario ";
	$sql .= " WHERE ( ";
	$sql .= "( chamado.categoria_id = categoria.id_categoria) and ";
	$sql .= "( usuario.atendimento = $atendimento) and ";
	$sql .= "( usuario.id_usuario = chamado.consultor_id ) and ";
    $sql .= "( chamado.dataa >= '$datai' ) and ";
    $sql .= "( chamado.dataa <= '$dataf' ) and ";
	$sql .= "( chamado.sistema_id = sistema.id_sistema) ";
	  if ( $sistema ) {
	    $sql .= "and chamado.sistema_id = $sistema ";
	  }
	  if ( $categoria ) {
        $sql .= "and chamado.categoria_id = $categoria ";
	  }
	$sql .= " ) ";
	$sql .= "GROUP BY  ";
	$sql .= "categoria.id_categoria ";
	$sql .= "ORDER BY $ordem;";	
	
    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["sistema"] = $linha->sistema;
	  $tmp["id_categoria"] = $linha->id_categoria;
	  $tmp["categoria"] = $linha->categoria;
	  $tmp["chamados"] = $linha->chamados; 
      $saida[$conta++] = $tmp;
	}
    return $saida;
}


function statClientesContatos($atendimento, $ordem, $tipo, $limite, $datai, $dataf, $sistema) {
// nomellini

 $quando = explode("/", $datai);
 $datai = "$quando[2]-$quando[1]-$quando[0]";
 $quando = explode("/", $dataf);
 $dataf = "$quando[2]-$quando[1]-$quando[0]";


 $sql = "SELECT count(id_contato) as contatos, id_cliente, cliente, ";
 $sql .= "SEC_TO_TIME(sum( TIME_TO_SEC(contato.horae) -TIME_TO_SEC(contato.horaa) ) ) AS tempo, ";
 $sql .= "sum( TIME_TO_SEC(contato.horae) -TIME_TO_SEC(contato.horaa) ) as temposeg ";
 $sql .= "FROM cliente, contato, chamado, usuario WHERE ((chamado.cliente_id=cliente.id_cliente) ";
 if ($tipo) {
  $sql .= "AND (contato.origem_id = $tipo)";
 }
 if ($sistema) {
  $sql .= "AND (chamado.sistema_id = $sistema)";
 }
 $sql .= "AND ( contato.dataa >= '$datai' ) ";
 $sql .= "AND ( contato.dataa <= '$dataf' ) "; 
 $sql .= "AND (contato.chamado_id = chamado.id_chamado) ";
 $sql .= "AND (usuario.id_usuario = chamado.consultor_id) ";
 $sql .= "AND (usuario.atendimento=$atendimento) ";
 $sql .= "AND (chamado.descricao is not NULL) ";
 
 $sql .= ") GROUP BY  cliente ORDER BY $ordem";
 if ($limite)  {
   $sql .= " LIMIT $limite";
 }
 $sql .= ";"; 


// $sql = "SELECT count(id_contato) as contatos, id_cliente, cliente, ";
// $sql .= "SEC_TO_TIME(sum( TIME_TO_SEC(contato.horae) -TIME_TO_SEC(contato.horaa) ) ) AS tempo, ";
// $sql .= "sum( TIME_TO_SEC(contato.horae) -TIME_TO_SEC(contato.horaa) ) as temposeg ";
// $sql .= "FROM cliente, contato, chamado, usuario WHERE ((chamado.cliente_id=cliente.id_cliente) ";
// if ($tipo) {
//  $sql .= "AND (contato.origem_id = $tipo)";
// }
// $sql .= "AND (contato.chamado_id = chamado.id_chamado) ";
// $sql .= "AND (usuario.id_usuario = chamado.consultor_id) ";
// $sql .= "AND (usuario.atendimento=$atendimento) ";
// $sql .= "AND (chamado.descricao is not NULL) ";
 
// $sql .= ") GROUP BY  cliente ORDER BY $ordem";
// if ($limite)  {
//   $sql .= " LIMIT $limite";
// }
// $sql .= ";"; 
  

	
    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["cliente"] = $linha->cliente;
	  $tmp["id_cliente"] = $linha->id_cliente;
	  $tmp["contatos"] = $linha->contatos; 
      $saida[$conta++] = $tmp;
	}
    return $saida;
}





function statClientesChamados($atendimento, $ordem, $limite, $datai, $dataf, $sistema) {

    $quando = explode("/", $datai);
    $datai = "$quando[2]-$quando[1]-$quando[0]";
    $quando = explode("/", $dataf);
    $dataf = "$quando[2]-$quando[1]-$quando[0]";


    $sql = "SELECT id_cliente, cliente, count(id_chamado) as chamados FROM sistema, usuario, chamado, cliente WHERE ((cliente.id_cliente=chamado.cliente_id) and (usuario.atendimento=$atendimento) and (chamado.descricao is not NULL) and (usuario.id_usuario=chamado.consultor_id) ";
	$sql .= "and ( chamado.sistema_id = sistema.id_sistema) ";
    $sql .= "AND ( chamado.dataa >= '$datai' ) ";
    $sql .= "AND ( chamado.dataa <= '$dataf' ) ";	

    if ($sistema) {
      $sql .= "AND ( sistema.id_sistema = $sistema ) ";
    }

    $sql .= " ) GROUP BY cliente_id ORDER BY $ordem, cliente ";
	if ($limite) {
	  $sql .= "LIMIT $limite ";
	}
	$sql .= ";";

    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["cliente"] = $linha->cliente;
	  $tmp["id_cliente"] = $linha->id_cliente;
	  $tmp["chamados"] = $linha->chamados; 
      $saida[$conta++] = $tmp;
	}
    return $saida;
}

function statCategoriaMotivo($datai, $dataf, $sistema, $categoria, $motivo, $o) {

	$quando = explode("/", $datai);
	$datai = "$quando[2]-$quando[1]-$quando[0]";
	$quando = explode("/", $dataf);
	$dataf = "$quando[2]-$quando[1]-$quando[0]";  

	$sql = "select categoria.categoria, categoria.id_categoria, motivo.motivo, motivo.id_motivo, ";
	$sql .= "sistema.sistema, count(id_chamado) as chamados ";
	$sql .= "FROM chamado, motivo, sistema, categoria ";
	$sql .= "WHERE (  ";
	$sql .= "(motivo.id_motivo = chamado.motivo_id) AND ";
	$sql .= "(categoria.id_categoria = chamado.categoria_id) AND ";
	$sql .= "(categoria.sistema_id = sistema.id_sistema) ";
	$sql .= "AND ( chamado.dataa >= '$datai' ) ";
	$sql .= "AND ( chamado.dataa <= '$dataf' ) ";
	  if ($sistema) {
	    $sql .= "and chamado.sistema_id=$sistema ";
	  }
	  if ($motivo) {
	    $sql .= "and chamado.motivo_id = $motivo ";	  
	  }
	  if ($categoria) {
	    $sql .= "and chamado.categoria_id = $categoria ";	  
	  }
	  
	$sql .= ") ";
	$sql .= "GROUP BY ";
	$sql .= "categoria.id_categoria, motivo.id_motivo ";
	$sql .= "ORDER BY $o;";


  
    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["categoria"] = $linha->categoria;
	  $tmp["id_categoria"] = $linha->id_categoria;	  
	  $tmp["id_motivo"] = $linha->id_motivo;
	  $tmp["motivo"] = $linha->motivo;	  
	  $tmp["chamados"] = $linha->chamados; 
 	  $tmp["sistema"] = $linha->sistema;
      $saida[$conta++] = $tmp;
	}
    return $saida;

}



function statChamadosPorDia($at, $o) {

$dia[0] = "Segunda";
$dia[1] = "Terça";
$dia[2] = "Quarta";
$dia[3] = "Quinta";
$dia[4] = "Sexta";
$dia[5] = "Sábado";
$dia[6] = "Domingo";

$sql = "select dataa, weekday(dataa) as dia, count(*) as chamados from chamado, usuario where chamado.consultor_id=usuario.id_usuario and usuario.atendimento=$at and chamado.descricao is not null group by dataa ORDER BY $o;";

  //  print "<br><b>$sql</b><br>";    
  
    $saida = array();
	
    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
      $quando = explode("-", $linha->dataa);
	  $tmp["data"] = "$quando[2]/$quando[1]/$quando[0]";	
	  $tmp["dia"] = $dia[$linha->dia];
	  $tmp["chamados"] = $linha->chamados; 
      $saida[$conta++] = $tmp;
	}
    return $saida;

}
function statChamadosPorDiaDaSemana($at, $o) {

$dia[0] = "Segunda";
$dia[1] = "Terça";
$dia[2] = "Quarta";
$dia[3] = "Quinta";
$dia[4] = "Sexta";
$dia[5] = "Sábado";
$dia[6] = "Domingo";

$sql = "select  weekday(dataa) as dia, count(*) as chamados from chamado, usuario where chamado.consultor_id=usuario.id_usuario and usuario.atendimento=$at and chamado.descricao is not null group by dia ORDER BY $o;";

  //  print "<br><b>$sql</b><br>";    
  
    $saida = array();
	
    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
      $quando = explode("-", $linha->dataa);
	  $tmp["data"] = "$quando[2]/$quando[1]/$quando[0]";	
	  $tmp["dia"] = $dia[$linha->dia];
	  $tmp["chamados"] = $linha->chamados; 
      $saida[$conta++] = $tmp;
	}
    return $saida;

}

function statChamadosPorMes($at, $o) {

$mes[1] = "Janeiro";
$mes[2] = "Feveieiro";
$mes[3] = "Março";
$mes[4] = "Abril";
$mes[5] = "Maio";
$mes[6] = "Junho";
$mes[7] = "Julho";
$mes[8] = "Agosto";
$mes[9] = "Setembro";
$mes[10] = "Outubro";
$mes[11] = "Novembro";
$mes[12] = "Dezembro";

  $sql = "select month(dataa) as mes, year(dataa) as ano, count(*) as chamados from chamado, usuario where descricao is not null and descricao <> '' and (usuario.id_usuario=chamado.consultor_id) and usuario.atendimento=$at  group by ano, mes ORDER BY $o;";

  //  print "<br><b>$sql</b><br>";    
  
    $saida = array();
	
    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
      $tmp["mesa"] = $linha->mes;
	  $tmp["mes"] = $mes[$linha->mes];
	  $tmp["ano"] = $linha->ano;	  
	  $tmp["chamados"] = $linha->chamados; 
      $saida[$conta++] = $tmp;
	}
    return $saida;

}


function statMensal($at, $ano, $mes) {

$sql = "select weekday(dataa) as dias, year(dataa) as ano, month(dataa) as mes, dayofmonth(dataa) as dia, count(*) as chamados from chamado, usuario where (chamado.descricao is not null) AND (usuario.atendimento=$at) and (usuario.id_usuario=chamado.consultor_id) and  year(dataa) = $ano and month(dataa) = $mes group by dia";
//    print "<br><b>$sql</b><br>";    
  
    $saida = array();	
    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
      $tmp["dia"] = $linha->dia;
	  $tmp["dias"] = $linha->dias;
	  $tmp["chamados"] = $linha->chamados; 
      $saida[$conta++] = $tmp;
	}
    return $saida;
}

function statIdle($consultor, $hoje, $origem) {
  
   $sql = "SELECT origem_id, chamado_id, nome, contato.horaa, horae, SEC_TO_TIME( SUM(TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo FROM contato, usuario WHERE ( (dataa='$hoje' ) ";
   if ($consultor) {
     $sql .= "and (consultor_id = $consultor) ";
   }
   if ($origem) {
     $sql .= "and (origem_id = $origem) ";   
   }
   $sql .= " and (historico is not null)  and (consultor_id = id_usuario)) GROUP BY nome, horaa;";

// print "<br><b>$sql</b><br>";    
  
    $saida = array();	
    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["nome"] = $linha->nome;
      $tmp["cliente_id"] = $linha->cliente_id;
	  $tmp["horaa"] = $linha->horaa;
	  $tmp["horae"] = $linha->horae;	  
 	  $tmp["tempo"] = $linha->tempo;
	  $tmp["origem_id"] = $linha->origem_id; 
	  $tmp["chamado_id"] = $linha->chamado_id;
      $saida[$conta++] = $tmp;
	}
    return $saida;
}

function mediaContatoMensal($origem) {
$mes[1] = "Janeiro";
$mes[2] = "Feveieiro";
$mes[3] = "Março";
$mes[4] = "Abril";
$mes[5] = "Maio";
$mes[6] = "Junho";
$mes[7] = "Julho";
$mes[8] = "Agosto";
$mes[9] = "Setembro";
$mes[10] = "Outubro";
$mes[11] = "Novembro";
$mes[12] = "Dezembro";

 $sql = "SELECT year(dataa) as ano, month(dataa) as mes, SEC_TO_TIME( avg( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) )) as media, avg( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) as mediaseg, count(id_contato) AS contatos, SEC_TO_TIME( SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo, SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) AS temposeg FROM contato WHERE ( ( historico is not null) ";
 if ($origem) {
   $sql .= "and (contato.origem_id = $origem) ";
 }
 $sql .=  ") GROUP BY ano DESC, mes DESC;";
// print "<br><b>$sql</b><br>";    
  
    $saida = array();
	
    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
      $tmp["ano"] = $linha->ano;
	  $tmp["mes"] = $mes[$linha->mes];
	  $tmp["contatos"] = $linha->contatos; 
	  $tmp["media"] = $linha->media; 
	  $tmp["mediaseg"] = $linha->mediaseg; 	  
	  $tmp["tempo"] = $linha->tempo; 
	  $tmp["temposeg"] = $linha->temposeg;
      $saida[$conta++] = $tmp;
	}
    return $saida;
}
 
 
function statContatosPorConsultor($c, $o, $di, $df) {

$quando = explode("/", $di);
$di = "$quando[2]-$quando[1]-$quando[0]";
$quando = explode("/", $df);
$df = "$quando[2]-$quando[1]-$quando[0]";

    $sql = "select nome, count(*) as contatos ";
    $sql .="from ";
    $sql .="contato, usuario where (usuario.id_usuario=contato.consultor_id) ";
    if($o) {
        $sql .= "and (contato.origem_id=$o)";
     }
	 if($c) {
        $sql .= "and (contato.consultor_id=$c) ";
	 }
	$sql .= "and (contato.historico is not null) and (contato.historico<>'') ";
    $sql .= "and (contato.dataa between '$di' and '$df') group by contato.consultor_id order by contatos desc ;";

//    print "<br><b>$sql</b><br>";  
  
    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["contatos"] = $linha->contatos; 
 	  $tmp["nome"] = $linha->nome;
//	  $tmp["tempo"] =  $linha->total;
      $saida[$conta++] = $tmp;
	}
    return $saida;

}
 
 
function statVersao($sistema, $ordem) {

 $sql = "SELECT cliente.bloqueio, cliente.tipoatualiz, cliente.inadimplente, cliente.id_cliente, cliente.cliente, cliente.cliente as cl, clisis.*, clisis.32bit as bit, ";
 $sql .= "sistema.sistema FROM clisis, cliente, sistema ";
 $sql .= "WHERE clisis.cliente = cliente.id_cliente and ";
 $sql .= "clisis.sistema = sistema.id_sistema ";
 if($sistema) {
   $sql .= "and id_sistema = $sistema ";
 }
 $sql .= "order by $ordem;" ;

    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["cliente"] = $linha->cl;
	  $tmp["id_cliente"] = $linha->id_cliente;
	  $tmp["sistema"] = $linha->sistema; 
	  $tmp["versao"] = $linha->versao;
	  $tmp["bloqueio"] = $linha->bloqueio;
	  $tmp["tipoatualiz"] = $linha->tipoatualiz;
	  $tmp["inadimplente"] = $linha->inadimplente;	  
	  if ($linha->bit) {
        $tmp["sistema"] .= " 32 Bits";
	  }
	  
      $saida[$conta++] = $tmp;
	}
    return $saida;
}
 
 
function statSistemaMotivo($ordem,  
		 $atendimento,
		 $datai,
		 $dataf,
		 $sistema
) {

  $quando = explode("/", $datai);
  $datai = "$quando[2]-$quando[1]-$quando[0]";
  $quando = explode("/", $dataf);
  $dataf = "$quando[2]-$quando[1]-$quando[0]";

  $sql="select count(*) as chamados, sistema.sistema, motivo.motivo ";
  $sql .= "from chamado, sistema, motivo ";
  $sql .= "where motivo.id_motivo = chamado.motivo_id ";
  $sql .= "and sistema.id_sistema=chamado.sistema_id ";
  $sql .= "and sistema.atendimento = $atendimento ";
  $sql .= "and dataa >= '$datai' and dataa <= '$dataf' ";
  if ($sistema) {
    $sql .= "and sistema_id = $sistema ";
  }
  $sql .= "group by sistema_id, motivo_id ORDER BY  $ordem;";
  
    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["sistema"] = $linha->sistema;
	  $tmp["motivo"] = $linha->motivo;
	  $tmp["chamados"] = $linha->chamados; 
      $saida[$conta++] = $tmp;
	}
    return $saida;
  
}
 
 
 function statBaseWeb($ordem,  
		 $consultor, 
		 $datai,
		 $dataf,
		 $limite,
		 $palavra,
		 $sistema,
         $diagnostico,
		 $base_cliente,
		 $documentado
) {


$quando = explode("/", $datai);
$datai = "$quando[2]-$quando[1]-$quando[0]";
$quando = explode("/", $dataf);
$dataf = "$quando[2]-$quando[1]-$quando[0]";


$sql = "SELECT baseweb.jaDocumentado, baseweb.somenteDesenvolvimento, id, sistema.sistema, usuario.nome, diagnostico.diagnostico, baseweb.id_chamado as chamado, baseweb.programa, baseweb.data, ";
$sql .= "baseweb.hora, baseweb.descricao, baseweb.resumo, baseweb.cliente FROM sistema, usuario, diagnostico, baseweb ";
$sql .= "WHERE  ( sistema.id_sistema = baseweb.id_sistema AND  usuario.id_usuario = baseweb.id_usuario AND ";
$sql .= "diagnostico.id_diagnostico = baseweb.id_diagnostico ";
$sql .= "AND ( data >= '$datai' ) ";
$sql .= "AND ( data <= '$dataf' ) ";


if ($sistema) {
  $sql .= "AND ( baseweb.id_sistema = $sistema ) ";
}

if ($base_cliente) {
  $sql .= "AND ( baseweb.cliente ) ";
}

if ($documentado) {
  $sql .= "AND (  baseweb.jaDocumentado = 0  && baseweb.cliente) ";
}


if ($consultor) {
  $sql .= "AND ( baseweb.id_usuario = $consultor ) ";
}

if ($diagnostico) {
  $sql .= "AND ( baseweb.id_diagnostico = $diagnostico ) ";
}

if ($palavra) {
  $sql .= "AND (( baseweb.descricao like '%$palavra%' ) ";
  $sql .= "or ( baseweb.resumo like '%$palavra%' )) ";
}

$sql .= ") ";
$sql .= "ORDER BY $ordem ";
if ($limite) {
  $sql .= " LIMIT $limite ";
}
$sql .= ";";

//  print "<br><b>$sql</b><br>";

   $saida = array();

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {   
     $quando = explode("-", $linha->data);
     $tmp["chamado_id"] = $linha->chamado_id;
	 $tmp["diagnostico"] = $linha->diagnostico;
	 $tmp["id_chamado"] = $linha->chamado;
	 $tmp["programa"] = $linha->programa;
	 $tmp["data"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["hora"] = $linha->hora;
	 $tmp["usuario"] = $linha->nome;
	 $tmp["descricao"] = $linha->descricao;
	 $tmp["resumo"] = $linha->resumo;
	 $tmp["sistema"] = $linha->sistema;	 
	 $tmp["cliente"] = $linha->cliente;
	 $tmp["id"] = $linha->id;
	 $tmp["somenteDesenvolvimento"] = $linha->somenteDesenvolvimento;	 
	 $tmp["jaDocumentado"] = $linha->jaDocumentado;	 	 
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

 }
 

function statEncaminhamentos( $o, 
      $reaberto,
	  $remetente, 
	  $destinatario, 
	  $acao, 
	  $datai,
	  $dataf,
	  $sistema,
	  $diagnostico,
	  $limite)
 {
 
   if ($acao == 1) {
     $tmp = $remetente;
	 $remetente = $destinatario;
	 $destinatario = $tmp;
   }

   $quando = explode("/", $datai);
   $datai = "$quando[2]-$quando[1]-$quando[0]";
   $quando = explode("/", $dataf);
   $dataf = "$quando[2]-$quando[1]-$quando[0]";
/*
   $sql = "SELECT contato.dataa, contato.chamado_id, diagnostico.diagnostico, status.status, sistema.sistema, left(contato.historico, 100) as historico, usuario_2.nome as remetente, usuario_1.nome as destinatario, contato.status_id ";
   $sql .= "FROM usuario AS usuario_2, diagnostico, status, usuario AS usuario_1, usuario, sistema, chamado, contato ";
   $sql .= "where ";
   $sql .= "chamado.id_chamado = contato.chamado_id AND sistema.id_sistema = chamado.sistema_id and ";
   $sql .= "usuario.id_usuario = chamado.consultor_id AND usuario_1.id_usuario = contato.destinatario_id AND ";
   $sql .= "status.id_status = chamado.status AND diagnostico.id_diagnostico = chamado.diagnostico_id AND ";
   $sql .= "usuario_2.id_usuario = contato.consultor_id ";
   
*/   

   $sql = "";
   $sql .= "SELECT ";
   $sql .= "   contato.dataa,  ";
   $sql .= "   contato.chamado_id,     ";
   $sql .= "   diagnostico.diagnostico,  ";
   $sql .= "   status.status,  ";
   $sql .= "   sistema.sistema,  ";
   $sql .= "   left(contato.historico, 100) as historico,  ";
   $sql .= "   usuario_2.nome as remetente,  ";
   $sql .= "   usuario_1.nome as destinatario, " ;
   $sql .= "   contato.status_id  ";
   $sql .= "FROM ";
   $sql .= "  contato  ";
   $sql .= "    inner join chamado on (contato.chamado_id = chamado.id_chamado) ";
   $sql .= "    inner join sistema on (sistema.id_sistema = chamado.sistema_id) ";
   $sql .= "    inner join usuario on (usuario.id_usuario = chamado.consultor_id) ";
   $sql .= "    inner join usuario usuario_1 on (usuario_1.id_usuario = contato.destinatario_id)     ";
   $sql .= "    inner join usuario usuario_2 on (usuario_2.id_usuario = contato.consultor_id) ";
   $sql .= "    inner join status on (status.id_status = chamado.status) ";
   $sql .= "    left  join diagnostico on (diagnostico.id_diagnostico = chamado.diagnostico_id) "; // alguns chamados noa tem diag.
   $sql .= "WHERE chamado_id>0 ";
  

   if ($destinatario) {
     $sql .= " AND contato.destinatario_id=$destinatario ";
   }
   if ($remetente) {
     $sql .= " AND contato.consultor_id=$remetente ";
   }
   if ($reaberto) {
     $sql .= " AND contato.status_id = 3 ";
   }
   $sql .= "AND ( contato.dataa >= '$datai' ) ";
   $sql .= "AND ( contato.dataa <= '$dataf' ) ";
   if ($sistema) {
     $sql .= "AND chamado.sistema_id = $sistema ";
   }
   if ($diagnostico) {
     $sql .= "AND chamado.diagnostico_id = $diagnostico ";
   } 
   
   $sql .= "AND contato.destinatario_id<>contato.consultor_id ";
   $sql .= "ORDER BY contato.dataa DESC , contato.chamado_id DESC";
   if ($limite) {
    $sql .= " LIMIT $limite ";
   }
   $sql .= ";";
 
//   echo $sql;
   $saida = array();

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
   
     $quando = explode("-", $linha->dataa);
     $tmp["chamado_id"] = $linha->chamado_id;
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["status"]  = $linha->status;
	 $tmp["remetente"] = $linha->remetente;
	 $tmp["destinatario"] = $linha->destinatario;	 
	 $tmp["historico"] = $linha->historico;
	 $tmp["sistema"] = $linha->sistema;
	 $tmp["diagnostico"] = $linha->diagnostico;	 
	 if (($tmp[status] == "Em aberto") or ($tmp[status] == "Reaberto")) {
	   $tmp["status"] = "<font color=#ff0000>" . $tmp["status"] . "</font>";
	 }
	 $tmp["sql"] = $sql;
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

 }

function statContatosPorConsultor2($c, $o, $di, $df, $ordem) 

{

   $quando = explode("/", $di);
   $di = "$quando[2]-$quando[1]-$quando[0]";
   $quando = explode("/", $df);
   $df = "$quando[2]-$quando[1]-$quando[0]";
  
    $sql = "select nome, count(*) as contatos, ";
    $sql .= "SEC_TO_TIME( SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo ";	
	$sql .= "from contato, usuario where (usuario.id_usuario=contato.consultor_id) ";	
	
	
    if($o) {
        $sql .= "and (contato.origem_id=$o)";
     }
	 if($c) {
        $sql .= "and ( ";
        $total = count($c);
        for($i =0; $i < $total; $i++) {
           $sql .= " contato.consultor_id=$c[$i] " ;
		   if ($i < ($total-1)) { $sql .= " or "; }
        }
		
		$sql .= ") ";
	 }
	$sql .= "and (contato.historico is not null) and (contato.historico<>'') ";
    $sql .= "and (contato.dataa between '$di' and '$df') group by contato.consultor_id order by $ordem ;";

//    print "<br><b>$sql</b><br>";  
  
    $saida = array();

    $result = mysql_query($sql);
    $conta=0;
    while ($linha = mysql_fetch_object( $result ) ) {
	  $tmp["contatos"] = $linha->contatos; 
 	  $tmp["nome"] = $linha->nome;
 	  $tmp["tempo"] = $linha->tempo;	  
      $saida[$conta++] = $tmp;
	}
    return $saida;
}



function statEncaminhamentos2( $o, 
      $reaberto,
	  $remetente, 
	  $destinatario, 
	  $acao, 
	  $datai,
	  $dataf,
	  $sistema,
	  $diagnostico,
	  $limite)
 {

   $quando = explode("/", $datai);
   $datai = "$quando[2]-$quando[1]-$quando[0]";
   $quando = explode("/", $dataf);
   $dataf = "$quando[2]-$quando[1]-$quando[0]";

   $sql = "SELECT contato.dataa, contato.chamado_id, diagnostico.diagnostico, status.status, sistema.sistema, contato.historico, usuario_2.nome as remetente, usuario_1.nome as destinatario, contato.status_id ";
   $sql .= "FROM usuario AS usuario_2, diagnostico, status, usuario AS usuario_1, usuario, sistema, chamado, contato ";
   $sql .= "where ";
   $sql .= "chamado.id_chamado = contato.chamado_id AND sistema.id_sistema = chamado.sistema_id and ";
   $sql .= "usuario.id_usuario = chamado.consultor_id AND usuario_1.id_usuario = contato.destinatario_id AND ";
   $sql .= "status.id_status = chamado.status AND diagnostico.id_diagnostico = chamado.diagnostico_id AND ";
   $sql .= "usuario_2.id_usuario = contato.consultor_id ";
   if ($destinatario) {
        $sql .= "and ( ";
        $total = count($destinatario);
        for($i =0; $i < $total; $i++) {
           $sql .= " contato.destinatario_id=$destinatario[$i] ";
		   if ($i < ($total-1)) { $sql .= " or "; }
        }
	
		$sql .= ") ";
 
   }
   if ($remetente) {
        $sql .= "and ( ";
        $total = count($remetente);
        for($i =0; $i < $total; $i++) {
           $sql .= " contato.consultor_id=$remetente[$i] ";
		   if ($i < ($total-1)) { $sql .= " or "; }
        }
	
		$sql .= ") ";
 
   }
   
   if ($reaberto) {
     $sql .= " AND contato.status_id = 3 ";
   }
   $sql .= "AND ( contato.dataa >= '$datai' ) ";
   $sql .= "AND ( contato.dataa <= '$dataf' ) ";
   if ($sistema) {
     $sql .= "AND chamado.sistema_id = $sistema ";
   }
   if ($diagnostico) {
     $sql .= "AND chamado.diagnostico_id = $diagnostico ";
   } 
   
   $sql .= "AND contato.destinatario_id<>contato.consultor_id ";   $sql .= "ORDER BY contato.dataa DESC , contato.chamado_id DESC";
   if ($limite) {
    $sql .= " LIMIT $limite ";
   }
   $sql .= ";";
 
    echo $sql;
   $saida = array();

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
   
     $quando = explode("-", $linha->dataa);
     $tmp["chamado_id"] = $linha->chamado_id;
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["status"]  = $linha->status;
	 $tmp["remetente"] = $linha->remetente;
	 $tmp["destinatario"] = $linha->destinatario;	 
	 $tmp["historico"] = $linha->historico;
	 $tmp["sistema"] = $linha->sistema;
	 $tmp["diagnostico"] = $linha->diagnostico;	 
	 if (($tmp[status] == "Em aberto") or ($tmp[status] == "Reaberto")) {
	   $tmp["status"] = "<font color=#ff0000>" . $tmp["status"] . "</font>";
	 }
	 
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

 }


 
function statTeste(){

  $sql="select nome, chamado_id, max(contato.dataa) as data, prioridade.prioridade from contato, ";
  $sql .= "chamado, usuario , prioridade  where chamado.id_chamado=contato.chamado_id and (chamado.status=3 or chamado.status = 2) ";
  $sql .= "and usuario.id_usuario=chamado.destinatario_id and usuario.atendimento=1 and usuario.area = 1 ";
  $sql .= "and chamado.prioridade_id=prioridade.id_prioridade ";
  $sql .= "group by contato.chamado_id order by data;";

//  print "<br><b>$sql</b><br>";

   $saida = array();

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {   
     
	 $quando = explode("-", $linha->data);
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 
	 $tmp["nome"] = $linha->nome;
	 $tmp["id_chamado"] = $linha->chamado_id;
	 $tmp["data"] = $linha->data;
	 $tmp["prioridade"] = $linha->prioridade;
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

 }
 


function statRnc001($ordem,  
		 $consultor, 
		 $atendimento,
		 $status,
		 $categoria,
		 $tipo,
		 $datai,
		 $dataf,
		 $motivo,
		 $id_cliente,
		 $limite,
		 $enc,
		 $palavra,
		 $sistema, 
		 $externo,
		 $rnc
) {


$quando = explode("/", $datai);
$datai = "$quando[2]-$quando[1]-$quando[0]";
$quando = explode("/", $dataf);
$dataf = "$quando[2]-$quando[1]-$quando[0]";

$sql="";
$sql .= "SELECT ";
$sql .= "ch.externo, prioridade.prioridade, prioridade.valor, ";
$sql .= "usuario.nome, ";
$sql .= "sistema.sistema, ";
$sql .= "ch.dataa, ";
$sql .= "ch.horaa, ";
$sql .= "dest.nome as destinatario, ";
$sql .= "status.status, ";
$sql .= "categoria.categoria, ";
$sql .= "motivo.motivo, ";
$sql .= "id_cliente, ";
$sql .= "chamado_id, ";
$sql .= "left(ch.descricao, 60) as descr, ";
$sql .= "ch.descricao as descricaoc, ";
$sql .= "cliente ";
//$sql .= "count(id_contato) AS contatos, ";
//$sql .= "SEC_TO_TIME( SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo, ";
//$sql .= "SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) )  AS temposeg ";
$sql .= "FROM ";
//$sql .= "contato, ";
$sql .= "usuario dest, "; 
$sql .= "sistema, ";
$sql .= "motivo, ";
$sql .= "usuario, ";
$sql .= "categoria, ";
$sql .= "cliente, ";
$sql .= "status, ";
$sql .= "prioridade, ";
$sql .= "chamado ch ";
$sql .= "WHERE ( descricao is not null AND descricao <> '' ";
//$sql .= "( contato.chamado_id = ch.id_chamado ) ";
$sql .= "AND ( ch.dataa >= '$datai' ) ";
$sql .= "AND ( ch.dataa <= '$dataf' ) ";
if($motivo) {
  $sql .= "AND (ch.motivo_id = $motivo ) ";
}

if($id_cliente) {
  $sql .= "AND (ch.cliente_id like '$id_cliente%' ) ";
}

//if ($tipo) {
//  $sql .= "AND ( contato.origem_id = $tipo ) ";
//}

if ($sistema) {
  $sql .= "AND ( sistema.id_sistema = $sistema ) ";
}

if ($consultor) {
  $sql .= "AND ( usuario.id_usuario = $consultor ) ";
}
if ($status==1) {
  $sql .= "AND ( status.id_status = 1) ";
} else {
  $sql .= "AND ( status.id_status <> 1 ) ";
}

if ($externo) {
  $sql .= "AND ( ch.externo = 1 ) ";
}

if ($rnc) {
  $sql .= "AND ( ch.rnc = $rnc ) ";
}

if ($enc) {
  $sql .= "AND (dest.nome<>usuario.nome) "; 
}


if ($categoria) {
  $sql .= "AND ( categoria.id_categoria = $categoria ) ";
}

//if ($palavra) {
//  $sql .= "AND (( contato.historico like '%$palavra%' ) ";
//  $sql .= "or ( ch.descricao like '%$palavra%' )) ";
//}

$sql .= "AND ( ch.prioridade_id = prioridade.id_prioridade) ";
$sql .= "AND ( ch.motivo_id = motivo.id_motivo) ";
$sql .= "AND ( dest.id_usuario = ch.destinatario_id )  ";
$sql .= "AND ( sistema.id_sistema = categoria.sistema_id) ";
$sql .= "AND ( ch.status = status.id_status) ";
$sql .= "AND ( ch.categoria_id = categoria.id_categoria) ";
$sql .= "AND ( ch.cliente_id = cliente.id_cliente ) ";
$sql .= "AND ( ch.consultor_id = usuario.id_usuario) ";
$sql .= "AND ( usuario.atendimento = $atendimento) ";
$sql .= ") ";
$sql .= "GROUP BY chamado_id ";
$sql .= "ORDER BY $ordem ";
if ($limite) {
  $sql .= " LIMIT $limite ";
}
$sql .= ";";

print "<br><b>$sql</b><br>";

   $saida = array();

   $result = mysql_query($sql);
   $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {
   
     $quando = explode("-", $linha->dataa);
     $tmp["chamado_id"] = $linha->chamado_id;
	 $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
	 $tmp["horaa"] = $linha->horaa;
	 $tmp["status"]  = $linha->status;
	 $tmp["consultor"] = $linha->nome;
	 $tmp["cliente"] = $linha->cliente;
	 $tmp["id_cliente"] = $linha->id_cliente;
	 $tmp["contatos"] = $linha->contatos;
	 $tmp["tempo"] = $linha->tempo;
	 $tmp["temposeg"] = $linha->temposeg;
	 $tmp["descricao"] = $linha->descr;
	 $tmp["descricaoc"] = $linha->descricaoc;	 
	 $tmp["destinatario"] = $linha->destinatario;
	 $tmp["sistema"] = $linha->sistema;
	 $tmp["motivo"] = $linha->motivo;	 
	 $tmp["categoria"] = $linha->categoria;
	 $tmp["prioridade"] = $linha->prioridade;
	 $tmp["prioridadev"] = $linha->valor;	 
	 $tmp["externo"] = $linha->externo;	 
	 
	 if ($tmp[status] == "Em aberto") {
	   $tmp["status"] = "<font color=#ff0000>" . $tmp["status"] . "</font>";
	 }
	 
     $saida[$conta++] = $tmp;
   }
   
  return $saida;

 }


?>