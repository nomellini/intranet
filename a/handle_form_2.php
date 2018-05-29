<?
  require("scripts/conn.php");
  require("scripts/classes.php");	  	
  $id_usuario = $_GET["id_usuario"];
  $prioridade_id = $_GET["prioridade_id"];
?>
<?php
// Check variables
if (empty($_GET['acao'])) {
        die ('<span style="color:red;">Digite um número no id!</span>');
}

function getSql($ATipo, $AParametro) {
	global $id_usuario;
	global $prioridade_id;	
	
	$sql = "select ";
	$sql .= " datalidodestinatario, horalidodestinatario,  ";	
	$sql .= " datauc, horauc, usuario.nome,  ";		
	$sql .= " time_to_sec(horauc) horaucsec, ";
	$sql .= " time_to_sec(horalidodestinatario) horalidosec, ";	
	$sql .= " id_chamado, status, cliente_id,  ";
	$sql .= "(select (sistema.sistema) from sistema where sistema.id_sistema = sistema_id) as sistema, ";
	$sql .= "(select (prioridade) from prioridade where id_prioridade = prioridade_id) as prioridade, ";
	$sql .= "(select valor from prioridade where id_prioridade = prioridade_id) as valor, ";
	$sql .= "(select status from status where id_status= chamado.status) as DescStatus, ";
	$sql .= "chamado.dataa as DataAbertura, ";
	$sql .= "Left(descricao, 100) as descricao ";
	$sql .= "from chamado ";
	$sql .= "  inner join usuario on id_usuario = destinatario_id ";	
	$sql .= "where ";	
	
	if ($ATipo == 'prioridade') {	
		$sql .= "destinatario_id = $id_usuario and prioridade_id = $AParametro ";
		$sql .= "and status <> 1 ";
		$sql .= "order by valor, status, sistema";
	} else if ($ATipo == 'sistema') {
		$sql .= "destinatario_id = $id_usuario and sistema_id = $AParametro ";
		$sql .= "and status <> 1 ";
		$sql .= "order by valor, status, sistema";	
	} else if ($ATipo == 'novidades') {
		$sql .= "((destinatario_id=$id_usuario and lido    =0) or  (consultor_id   =  $id_usuario and lidodono=0)) and status > 1";	
	} else if ($ATipo == 'pasta') {
		$sql .= " id_chamado IN (select id_chamado from chamado_pasta where id_pasta =". $AParametro .") ";	
		$sql .= "order by valor, status, sistema";	
	    //$sql = "select id_chamado from chamado_pasta where id_pasta =". $AParametro;		
	} 

	return $sql;	

}

function getTitulo($ATipo, $AParametro) {
	if ($ATipo == 'prioridade') {	
		$sql = "select * from prioridade where id_prioridade =". $AParametro;
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);	
		$prioridadev = $linha->valor;
		if ($prioridadev  <= 100) {
		$cor = "#ff0000";
		} else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
		$cor = "#FF6600";
		} else if ($prioridadev > 200) {
		$cor = "#009966";
		}
		$prioridade = "<b><font color=$cor>$linha->prioridade</font></b>";	
		return "Por prioridade: $prioridade<br>";	
	} else if ($ATipo == 'sistema') {
		return "Por sistema:";
	} else if ($ATipo == 'novidades') {
		return "Contatos não lidos:";
	} else if ($ATipo == 'pasta') {
		$sql = "select pasta.descricao from pasta where id_pasta =".$AParametro;
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
		return "pasta: <b>$linha->descricao</b><br><br />";
	} else {
		return "teste";
	}

}

	echo getTitulo($_GET['acao'], $_GET['id']);
	$sql = getSql($_GET['acao'], $_GET['id']);	

	$result = mysql_query($sql);
	while ( $linha = mysql_fetch_object($result) ) {
	
		$prioridadev = $linha->valor;
		if ($prioridadev  <= 100) {
		$cor = "#ff0000";
		} else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
		$cor = "#FF6600";
		} else if ($prioridadev > 200) {
		$cor = "#009966";
		}
		$prioridade = "<b><font color=$cor>$linha->prioridade</font></b>";
		
		$dataultimocontato = $linha->datauc;
		$datalidodestinatario = $linha->datalidodestinatario;
		
		$horaultimocontato = $linha->horauc;
		$horalidodestinatario = $linha->horalidodestinatario;
				
		$horalidosec = abs($linha->horalidosec);
		$horaucsec = abs($linha->horaucsec);



		$lido = false;		
		if ($dataultimocontato > $datalidodestinatario) {	
			$lido = false;
		}
		if ($dataultimocontato < $datalidodestinatario) {			
			$lido = true;
		}

		if ($dataultimocontato == $datalidodestinatario) {			
			if ($horaucsec > $horalidosec) {
				$lido = false;			
			}
			if ($horaucsec <= $horalidosec) {
				$lido = true;			
			}
		}
		
		$dataultimocontato = dataOk($dataultimocontato);
		$datalidodestinatario = dataOk($datalidodestinatario);		
		
		$lidostr = "<font color=#FF0000>contato <strong>não</strong> lido por $linha->nome</font>";
		if ($lido) {
			$lidostr = "<font color=#0000FF>contato lido por $linha->nome</font>";
		}
		
        $lidostr .= " | uc : $dataultimocontato $horaultimocontato | ul : $datalidodestinatario $horalidodestinatario | "
		
		
		
?> <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#6666FF">
   <tr>
     <td width="14%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFF2">
         <tr>
           <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
             <tr>
               <td width="26%"><strong><a href="historicochamado.php?id_chamado=<?=$linha->id_chamado?>"><?=number_format($linha->id_chamado,0,',','.')?></a></strong> (<strong><?=$linha->cliente_id?></strong>)</td>
               <td width="74%"><?="$linha->DescStatus"?> [<strong><?=$linha->sistema?></strong>] [<?=$prioridade?>]</td>
             </tr>
             <tr>
               <td colspan="2"><?=$linha->descricao?>...</td>
              </tr>
             <tr>
               <td colspan="2"><?=$lidostr?></td>
             </tr>
           </table></td>
         </tr>
       </table></td>
   </tr>
 </table>
<table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
<?
 }	
?>
<HEAD>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
</HEAD>