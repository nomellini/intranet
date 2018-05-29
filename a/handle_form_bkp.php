<?
  require("scripts/conn.php");
  require("scripts/classes.php");	  	
?>
<?php
// Check variables
if (empty($_GET['acao'])) {
        die ('<span style="color:red;">Digite um número no id!</span>');
}

  function sqlChamado($AChamadoId) {
//      $result = "select Left(descricao,70) as descricao, ";
//	  $result .= "status.status from chamado inner join ";
//	  $result .= "status on status.id_status = chamado.status ";
//	  $result .= "where id_chamado = $AChamadoId ";    
	  
	
	$result = "select id_chamado, status, cliente_id, ";  
	$result .= "  (select (sistema.sistema) from sistema where sistema.id_sistema = sistema_id) as sistema, ";
	$result .= "(select (prioridade) from prioridade where id_prioridade = prioridade_id) as prioridade, ";
	$result .= "(select valor from prioridade where id_prioridade = prioridade_id) as valor, ";
	$result .= "(select status from status where id_status= chamado.status) as DescStatus, ";
	$result .= "chamado.dataa as DataAbertura, ";
	$result .= "Left(descricao, 100) as descricao ";
	$result .= "from chamado where ";
    $result .= " id_chamado = $AChamadoId ";   	
	//$result .= "order by valor, status, sistema";
	  
	  
	  
	  return  $result;
  }


  if ($_GET['acao'] == 'prioridade') {

    $sql = "select * from prioridade where id_prioridade =". $_GET['id'];
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
	
		

    echo "Por prioridade: $prioridade<br>";

    $sql = "select id_chamado from chamado where destinatario_id=". $_GET['id_usuario'];
	$sql .= " and status <> 1 and prioridade_id = " . $_GET['id'] ;


	$sql = "select id_chamado, status, cliente_id, ";
	$sql .= "  (select (sistema.sistema) from sistema where sistema.id_sistema = sistema_id) as sistema, ";
	$sql .= "(select (prioridade) from prioridade where id_prioridade = prioridade_id) as prioridade, ";
	$sql .= "(select valor from prioridade where id_prioridade = prioridade_id) as valor, ";
	$sql .= "(select status from status where id_status= chamado.status) as DescStatus, ";
	$sql .= "chamado.dataa as DataAbertura, ";
	$sql .= "Left(descricao, 100) as descricao ";
	$sql .= "from chamado where ";
	$sql .= "destinatario_id = $id_usuario and prioridade_id = $id ";
	$sql .= "and status <> 1 ";
	$sql .= "order by valor, status, sistema";

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
	
	  //echo "<a href=\"javascript:abre_chamado($linha->id_chamado)\">$linha->id_chamado</a><br>";

/*	  
	    $sql2 = sqlChamado($linha->id_chamado);
		$result2 = mysql_query($sql2);
		$linha2 = mysql_fetch_object($result2);
		$desc_chamado = $linha2->descricao . "...";
*/
		
?> <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#6666FF">
   <tr>
     <td width="14%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFF2">
         <tr>
           <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
             <tr>
               <td width="26%"><strong><a href="historicochamado.php?id_chamado=<?=$linha->id_chamado?>"><?=number_format($linha->id_chamado,0,',','.')?></a></strong> (<?=$linha->cliente_id?>)</td>
               <td width="74%"><?="$linha->DescStatus"?> [<strong><?=$linha->sistema?></strong>] [<?=$prioridade?>]</td>
             </tr>
             <tr>
               <td colspan="2"><?=$linha->descricao?>...</td>
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
	
 }



  if ($_GET['acao'] == 'sistema') {

    echo "Por Sistema:";


	$sql = "select id_chamado, status, cliente_id,  ";
	$sql .= "  (select (sistema.sistema) from sistema where sistema.id_sistema = sistema_id) as sistema, ";
	$sql .= "(select (prioridade) from prioridade where id_prioridade = prioridade_id) as prioridade, ";
	$sql .= "(select valor from prioridade where id_prioridade = prioridade_id) as valor, ";
	$sql .= "(select status from status where id_status= chamado.status) as DescStatus, ";
	$sql .= "chamado.dataa as DataAbertura, ";
	$sql .= "Left(descricao, 100) as descricao ";
	$sql .= "from chamado where ";
	$sql .= "destinatario_id = $id_usuario and sistema_id = $id ";
	$sql .= "and status <> 1 ";
	$sql .= "order by valor, status, sistema";

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
	
		
?> <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#6666FF">
   <tr>
     <td width="14%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFF2">
         <tr>
           <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
             <tr>
               <td width="26%"><strong><a href="historicochamado.php?id_chamado=<?=$linha->id_chamado?>">
                <?=number_format($linha->id_chamado,0,',','.')?></a>  (<?=$linha->cliente_id?>) </strong></td>
               <td width="74%"><?="$linha->DescStatus"?> [<strong><?=$linha->sistema?></strong>] [<?=$prioridade?>]</td>
             </tr>
             <tr>
               <td colspan="2"><?=$linha->descricao?>...</td>
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
	
 }

//   die($_GET['acao']);


  if ($_GET['acao'] == 'novidades') {


	$sql = "select id_chamado, status, cliente_id,  ";
	$sql .= "  (select (sistema.sistema) from sistema where sistema.id_sistema = sistema_id) as sistema, ";
	$sql .= "(select (prioridade) from prioridade where id_prioridade = prioridade_id) as prioridade, ";
	$sql .= "(select valor from prioridade where id_prioridade = prioridade_id) as valor, ";
	$sql .= "(select status from status where id_status= chamado.status) as DescStatus, ";
	$sql .= "chamado.dataa as DataAbertura, ";
	$sql .= "Left(descricao, 100) as descricao ";
	$sql .= "from chamado where ";
    $sql .= "((destinatario_id=$id_usuario and lido    =0) or  (consultor_id   =  $id_usuario and lidodono=0)) and status > 1";

    //die($sql);

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
	
	  //echo "<a href=\"javascript:abre_chamado($linha->id_chamado)\">$linha->id_chamado</a><br>";

/*	  
	    $sql2 = sqlChamado($linha->id_chamado);
		$result2 = mysql_query($sql2);
		$linha2 = mysql_fetch_object($result2);
		$desc_chamado = $linha2->descricao . "...";
*/
		
?> <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#6666FF">
   <tr>
     <td width="14%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFF2">
         <tr>
           <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
             <tr>
               <td width="26%"><img src="figuras/idea01.gif" alt="novidade" width="16" height="22" align="absmiddle" /><strong><a href="historicochamado.php?id_chamado=<?=$linha->id_chamado?>"><?=number_format($linha->id_chamado,0,',','.')?></a>  (<?=$linha->cliente_id?>)</strong></td>
               <td width="74%"><?="$linha->DescStatus"?> [<strong><?=$linha->sistema?></strong>] [<?=$prioridade?>]</td>
             </tr>
             <tr>
               <td colspan="2"><?=$linha->descricao?>...</td>
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
	
 }




  if ($_GET['acao'] == 'pasta') {


    $sql = "select pasta.descricao from pasta where id_pasta =". $_GET['id'];
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);

    
	echo "pasta: <b>$linha->descricao</b><br><br />";
	  
    $sql = "select id_chamado from chamado_pasta where id_pasta =". $_GET['id'];
	$result = mysql_query($sql);
	while ( $linha = mysql_fetch_object($result) ) {
		//echo "$linha->id_chamado <br>";
		
	    $sql2 = sqlChamado($linha->id_chamado);
		$result2 = mysql_query($sql2);
		$linha2 = mysql_fetch_object($result2);
		$desc_chamado = $linha2->descricao . "...";

		$prioridadev = $linha2->valor;
		if ($prioridadev  <= 100) {
		$cor = "#ff0000";
		} else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
		$cor = "#FF6600";
		} else if ($prioridadev > 200) {
		$cor = "#009966";
		}
		$prioridade = "<b><font color=$cor>$linha2->prioridade</font></b>";
		
		
		
		//$desc_chamado = eregi_replace("\r\n", "<br>",$desc_chamado);
		//$desc_chamado = eregi_replace("\"", "`", $desc_chamado);	

?>

<table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#6666FF">
   <tr>
     <td width="14%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFF2">
         <tr>
           <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
             <tr>
               <td width="26%"><strong><a href="historicochamado.php?id_chamado=<?=$linha2->id_chamado?>"><?=number_format($linha->id_chamado,0,',','.')?></a>  (<?=$linha2->cliente_id?>)</strong></td>
               <td width="74%">[<?=$linha2->DescStatus?>] [<strong><?=$linha2->sistema?></strong>] [<?=$prioridade?>]</td>
             </tr>
             <tr>
               <td colspan="2"><?=$desc_chamado?>...</td>
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
	
  }
?>
