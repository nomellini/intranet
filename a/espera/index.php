<? // require("/var/www/default/verifica.php"); ?>
<?	/*
	+----+--------------------+
	| id | descricao          |
	+----+--------------------+
	|  1 | Em Espera          |
	|  2 | Transferido        |
	|  3 | Atendido Consultor | FIM ATENDIDO
	|  4 | Finalizado         | FIM SEM ATENDER
	+----+--------------------+
	*/

	require("../scripts/conn.php");
	

    $estado_cliente = 'SP';
	$_FL_SP = "S";

	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);
		setcookie("loginok");
	} else {
		header("Location: index.php");
	}

    if ($id_cliente || $nomesenha) {
//	  $pesquisa = '';
	}



	$hoje = date("Y-m-d");
	$hora = date("H:i:s");

    if (!$id_ligacao) {
	  $id_ligacao = 0;
	}

    if ($acao == 'retomar') {
	   $sql = "update satligacao set id_satstatus = 1, retorno = 1, hora_transferencia=null, motivo='Telefonista:' where id = $idligacao;";
	   mysql_query($sql) or die(mysql_error());
//	  $pesquisa = '';
	}


    if ($acao == 'cancelar') {
	   $sql = "update satligacao set motivo='Telefonista cancelou', id_usuario=$ok, id_satstatus = 4, hora_fim='$hora' where id = $idligacao;";
	   mysql_query($sql) or die(mysql_error());
//	  $pesquisa = '';
	}



   if ($acao=='atendeu') {
	   $sql = "update satligacao set id_satstatus = 3, hora_fim='$hora' where id = $idligacao;";
	   mysql_query($sql) or die($sql);
//	  $pesquisa = '';
   }

	if ( ($acao == "espera") || ($acao=="CriarETransferir") ) {
	  if ($idcliente) {
	  	  $sql = "select id from satligacao where data = '$hoje' and hora_inicio='$hora'";
     	  $result = mysql_query($sql) or die($sql);
	      $qtde = mysql_affected_rows();
		  if ($qtde==0) {
			  $sql = "Insert into satligacao (id_cliente, id_produto, id_satstatus, id_usuario, data, hora_inicio, id_ligacao, linha, grau, horaEntrada, motivo_status) ";
			  $sql .= " values ( ";
			  $sql .= "'" .$idcliente . "', ";
			  $sql .= "" .$id_produto . ", ";
			  $sql .= "1 , ";
			  $sql .= "$ok, ";
			  $sql .= "'" .$hoje . "', ";
			  $sql .= "'" .$hora. "', ";
			  $sql .= "" .$idligacao. ", ";
			  $sql .= "'" .$linhatel ."', ";
			  $sql .= "'" .$grau. "', ";
			  $sql .= "'" .$hora.  "', ";
			  $sql .= "'" .$eSocial.  "') ";			  
			  
			  mysql_query($sql) or die (mysql_error() . ' - ' . $sql) ;
		 }
	  }
	}

	if ($acao=="CriarETransferir") {
	  $sql = "Select id from satligacao where data = '$hoje' and hora_inicio = '$hora'";
	  $result = mysql_query($sql);
	  $linha = mysql_fetch_object($result);
	  $idligacao = $linha->id;
	  $idconsultor = $id_consultor;
	}

    if ( ($acao == 'transferir')  || ($acao=="CriarETransferir") ) {

	   $sql = "select nome, estado from usuario where id_usuario = $idconsultor";
	   $result = mysql_query($sql);
	   $linha = mysql_fetch_object($result);
	   if ($linha->estado != 1) {
	     $Mensagem = "Consultor $linha->nome NÃO DESPONÍVEL, aguarde ou transfira para outro !";
	     header("Location: index.php?msg=$Mensagem");
	   } else {
  	     $sql = "update satligacao set motivo = '', id_satstatus = 2, id_usuario = $idconsultor, hora_transferencia='$hora' where id = $idligacao;";
         mysql_query($sql) or die($sql);
	  }
	}


	$cliente = "Digite o nome de um cliente ou a senha no campo acima";
	if ($acao == "aguarde") {
	  $sql = "update satligacao set qtde_aguarde = qtde_aguarde + 1 where id = $idligacao";
	  mysql_query($sql) or die($sql);
	}

    if ($acao == "pesquisacliente")  {
	  if ($nomesenha) {
         $sql = "select cliente.bloqueio, cliente.id_cliente, cliente.senha, cliente.cliente, cliente.uf, cliente.ddd, cliente.telefone, cliente.grau, Ic_SLA ";
		 $sql .= " from ";
		 $sql .= " cliente ";
		 $sql .= " inner join clienteplus on clienteplus.id_cliente = cliente.id_cliente ";		 
		 $sql .= "where ";
		 $sql .= "cliente.cliente like '%$nomesenha%' or cliente.senha = '$nomesenha' or cliente.id_cliente = '$nomesenha'";
	  } else  {
         $sql = "select bloqueio, id_cliente, senha, cliente, uf, ddd, telefone, grau from cliente where id_cliente = '$id_cliente'";
	  }
	  $sql_1 = $sql;
	 
	  //echo $sql;
	  
	  $result = mysql_query($sql) or die(mysql_error() . " - " . $sql);
	  $qtde = mysql_affected_rows();
      $linha = mysql_fetch_object($result);
	  if ($qtde == 1) {

	    $id_cliente = $linha->id_cliente;
		$senha = $linha->senha;
		
		$ClienteSLA = '';
		$ClienteSLA = $linha->Ic_SLA ? "<br/><B><FONT COLOR=ff00000>---> cliente com SLA diferenciado <---</font></b>" : "" ;
		
		
		$cliente = "$linha->cliente ($senha) -- UF: ". $linha->uf;
		$cliente .= " Fone: ($linha->ddd) $linha->telefone $ClienteSLA";				
				
				
				
				
		$bloqueio = $linha->bloqueio == 1;				
		$OutroDDD = $linha->ddd != '11';
				
		$grau = AcertaGrau($linha->grau);		
		
		$telefone = $linha->telefone;
				
		$posAbre = strpos($telefone, "(");	
		$posFecha = strpos($telefone, ")");				
		$ddd = "";		
		if (is_numeric($posAbre)) {	 
			$ddd = 0 + substr($telefone, $posAbre+1, $posFecha - $PosAbre - 1);
		}	
			
		$_FL_SP =  "S";
		if ($ddd > 0) {
			if ($ddd != 11) {
				$_FL_SP = "N";
			}
		} else {
			$_FL_SP = "I";
		}
			
		
		$estado_cliente = $linha->uf;
		
		if (  ($_FL_SP == "N") || ($estado_cliente != 'SP') || ($OutroDDD) ) {
  			$cliente = " <font color='#006600'>$cliente</font>";			
		}	
			
		if ($bloqueio) {
  			//$cliente .= " <b>BLOQUEADO</b>";
  			$cliente = " <font color='#ff0000'>[BLOQUEADO] $cliente [BLOQUEADO]</font>";						
  			$cliente .= "<br> <font color='#ff0000'><b>Atenção, cliente com consultoria BLOQUEADA - Direcionar para administração !</b></font>";
		}	
		
		$sql = "select fl_posvenda, data_inicioposvenda from clienteplus where id_cliente = '$id_cliente'";	
		$result = mysql_query($sql); $linha=mysql_fetch_object($result);
		$fl_posvenda = $linha->fl_posvenda;
		$data = $linha->data_inicioposvenda;
		$data = explode('-', $data);
		$datainicioposvenda = "$data[2]/$data[1]/$data[0]";

		if ($fl_posvenda==1) {
  			$cliente .= "<br> <font color='#ff0000'><b>Atenção, cliente em PÓS-VENDA !</b></font><br>";
		}	
		

	  } else if (($qtde > 1)) {
	    header("Location: index.php?pesquisa=$nomesenha");
	  } else if ($qtde==0) {
	    $id_cliente = ''; $pesquisa =  ''; $nomesenha='';
	  }
	}


	/* Ligações de hoje	*/
    $sql = "select count(*) as ligTotal from satligacao where data = '$hoje'";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligHoje = $linha->ligTotal;

	/* Ligações de hoje	em espera*/
    $sql = "select count(*) as ligTotal from satligacao where data = '$hoje' and id_satstatus=1";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligEspera = $linha->ligTotal;

	/* Ligações de hoje	transferidas*/
    $sql = "select count(*) as ligTotal from satligacao where data = '$hoje' and id_satstatus=2";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligTransf = $linha->ligTotal;

	/* Ligações de não atendidas*/
    $sql = "select count(*) as ligTotal from satligacao where data = '$hoje' and id_satstatus=4";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligPerdidas = $linha->ligTotal;


    mysql_query("DROP TABLE IF EXISTS ultimos10;");
    mysql_query("create temporary table ultimos10 select time_to_sec(hora_fim)-time_to_sec(hora_inicio) as t from satligacao where FL_ATIVO and id_satstatus = 3 order by id desc limit 5;");
    $sql = "select sec_to_time(avg((t))) as media,  sec_to_time(min((t))) as minimo, sec_to_time(max((t))) as maximo from ultimos10;";

/*	$sql = "select  ";
	$sql .= "sec_to_time(  avg(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)      ) ) as media, ";
	$sql .= "count(*) as qtde,  sec_to_time(   max(   time_to_sec(hora_fim) - time_to_sec(hora_inicio)      ) ) as maximo, ";
	$sql .= "sec_to_time(   min(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)  ) ) as minimo ";
    $sql .= "from satligacao where id_satstatus = 3 and ";
	$sql .= "data = '$hoje'";
	*/
	$result = mysql_query($sql) or die($sql);
	$linha = mysql_fetch_object($result);
	$tmedio = $linha->media;
	$tmaximo = $linha->maximo;
	$tminimo = $linha->minimo;





	$sql = "select cliente.id_cliente, ";
	$sql .= " id, sec_to_time(  time_to_sec(curtime()) - time_to_sec(horaEntrada)  ) as minutos, ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(horaEntrada)) / 60 as espera ";
	$sql .= "from ";
	$sql .= " satligacao inner join cliente on satligacao.id_cliente = cliente.id_cliente ";
	$sql .= "where ( (satligacao.grau <> 'ZZ') and (satligacao.grau <> 'G3') and (satligacao.grau <> '  ')) and ";
	$sql .= " FL_ATIVO and ";
	$sql .= " data = '$hoje' and  ";
	$sql .= " ((id_satstatus = 1) or (id_satstatus = 2)) ";
	$sql .= "order by ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(horaEntrada)) desc ";
	$sql .= "limit 1";
	$result = mysql_query($sql) or die (mysql_error());
	$linha = mysql_fetch_object($result);
	if (!$linha) {
	  $tempomaximo = 0;
	  $tempominutos = "00:00:00";
	} else {
      $tempomaximo = $linha->espera;
	  $tempominutos = $linha->minutos;
	}


	$lampada = "<img src=../imagens/farolverde.jpg width=100 height=40><br>Normal - ";
	if (  ($tempomaximo > 8) and ($tempomaximo <= 15)  ) {
	  $lampada = '<img src=../imagens/farolamarelo.jpg width=100 height=40><br>Atenção - ';
	} else if ($tempomaximo > 15) {
	  $lampada = "<img src=../imagens/farolvermelho.jpg width=100 height=40><br>Crítica - ";
	}
	$lampada .= "$tempominutos - $linha->id_cliente";










?>
<html>
<head>
<title>espera</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../todo/stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="50">
<style type="text/css">
<!--
.style5 {font-size: 9px; color: #FFFFFF; font-weight: bold; }
.cl_critica {
	background-color: #FF9999;
}
.cl_atencao {
	background-color: #FFFFCC;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79">
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td>      <table width="100%" border="0" bgcolor="#CCCCCC" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF">
          <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
				  <form name="form" action="index.php" method="post" onSubmit="pesquisacliente();" >
                <tr>
                  <td><font size="2">Pesquisa (por c&oacute;digo ou nome)</font>
                    <input name="nomesenha" type="text" class="bordaTexto" size="15" maxlength="20">
                    <input name="Submit4" type="submit" class="bordaTexto" value="ok" >
                    <input name="acao" type="hidden" value="pesquisacliente">
					<input name="id_cliente" type="hidden" id="id_cliente">
					<input name="id_cliente_exato" type="hidden" id="id_cliente_exato" value="">
                    <input name="id_linha" type="hidden" id="id_linha" >
                    <input name="id_ligacao" type="hidden" id="id_ligacao">
                    (<a href="javascript:alterna(ultimos10)">&Uacute;ltimos 10 clientes atendidos</a>)
					<span id="ultimos10" style="display: none ">
                    <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                      <tr bgcolor="#003333">
                        <td width="5%"><span class="style5">Linha</span></td>
                        <td width="13%"><span class="style5">C&oacute;digo</span></td>
                        <td width="50%"><span class="style5">Raz&atilde;o social </span></td>
                        <td width="20%"><span class="style5">Consultor</span></font></td>
                      </tr>
<?
  $sql = "";
  $sql .= "select  id, cliente.id_cliente, cliente.cliente, cliente.senha, linha, hora_inicio, usuario.nome ";
  $sql .= "from  satligacao, cliente, usuario where usuario.id_usuario = satligacao.id_usuario and satligacao.id_cliente = cliente.id_cliente  and id_satstatus = 3 order by  data desc, hora_transferencia desc  limit 10";
  $result = mysql_query($sql);
  while ($linha = mysql_fetch_object($result)) {
?>
                      <tr>
                        <td align="center"><? echo $linha->linha ?></td>
                        <td><? echo $linha->id_cliente ?></td>
                        <td><a href="javascript:fnc_reaproveitar('<? echo $linha->id_cliente ?>', <? echo $linha->id?>, <? echo $linha->linha?>);"><? echo $linha->cliente ?> (<? echo $linha->senha ?>) </a></td>
                        <td><? echo $linha->nome ?></td>
                      </tr>
<?
}
?>
                    </table>
					</span>
</td>
                  </tr>
              </form>
            </table></td>
        </tr>
      </table>
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="imagens/nulo.gif" width="1" height="1"></td>
        </tr>
      </table>
      <table width="100%" border="0" bgcolor="#CCCCCC" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF">
          <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
              <form name="espera" method="post" action="index.php">
                <tr>
                  <td width="8%">Cliente</td>
                  <td colspan="2"><strong><font size="3"> <? echo "$cliente" ?> </font></strong></td>
                </tr>
                <tr>
                  <td height="23">Tronco</td>
                  <td width="55%" align="left">
                  
                  <input name="linhatel" type="text" class="borda_fina" size="5" maxlength="5">
                  
                    
                    Produto               <select name="id_produto" class="unnamed1" >
                <option value=0></option>
<?
	$sistema = pegaSistemas($ok, $id_cliente, 0);
	$qtde = count($sistema);
	while ( list($tmp1, $tmp) = each($sistema) ) {
	  $id = $tmp["id_sistema"];
	  $si = $tmp["sistema"];
	  $ve = $tmp["versao"];
	  
/*	  
	  if  ($tmp["32bit"]) 
	    { 
		  $si="$si :: Treinamento com custo ";
		} else { 
		  $si="$si";
		 }
		 
*/		  $si="$si"; 
		 
	  echo "<option value=$id>$si</option>";
	}

  ?>
              </select>
                    <input type="checkbox" name="eSocial" id="eSocial" value="eSocial">
                    <label for="checkbox">eSocial </label>
                    <input name="Submit3" type="button" class="bordaTexto" value="Espera" onClick="fnc_espera();">
                    <input name="acao" type="hidden" id="acao9" value="espera">
                    <input name="grau" type="hidden"  value="<?=$grau?>">
                    <input name="idcliente" type="hidden" id="idcliente"  value="<?=$id_cliente?>">
                    <input name="idligacao" type="hidden"  value="<?=$id_ligacao?>">
</td>
                  <td width="37%" align="right"><input name="Button" type="button" class="bordaTexto" value="Transferir" onClick="fnc_transfereSemEspera();">
                    <select name="id_consultor" class="bordaTexto" id="id_consultor">
                      <option value="0" selected>Selecione</option>
<?
  $sql = "select nome, id_usuario from usuario where area  = 1 and ativo=1 order by nome;";
  $result = mysql_query($sql);
  while ($linha = mysql_fetch_object($result)) {
?>

                      <option value="<?=$linha->id_usuario?>"><?=$linha->nome?></option>
<?
}
?>
                  </select></td>
                </tr>
              </form>
            </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><font color="#FF0000" size="2"><strong>Liga&ccedil;&otilde;es
      em espera (
      <?=$ligEspera?>
      )</strong></font>
      <table width="100%" border="0" cellpadding="1" cellspacing="1" class="Mtable">
        <tr bgcolor="#003366">
          <td width="6%" height="16" align="center"><font color="#FFFFFF"><em><strong>Cancela</strong></em></font></td>
          <td width="9%" align="center"><font color="#FFFFFF"><em><strong>Aguarda</strong></em></font></td>
          <td width="7%" align="center"><font color="#FFFFFF"><em><strong>Tronco</strong></em></font></td>
          <td width="38%"><font color="#FFFFFF"><em><strong>Cliente / Grau </strong></em></font></td>
          <td width="9%" align="center"><font color="#FFFFFF"><em><strong>Tempo</strong></em></font></td>
		            <td width="9%" align="center"><font color="#FFFFFF"><em><strong>Total</strong></em></font></td>
          <td width="22%"><font color="#FFFFFF"><em><strong>Produto</strong></em></font></td>
        </tr>
<?

//  $sql = "select fl_posvenda from clienteplus where id_cliente = " . QuotedStr($id_cliente);

  $sql = "select satligacao.motivo_status, cliente.bloqueio, cliente.grau, satligacao.grau slgrau, cliente.ddd, ";
  $sql .= "qtde_aguarde,  id, cliente.uf, cliente.cliente, ";
  $sql .= "sec_to_time( time_to_sec(curtime()) - time_to_sec(horaEntrada) ) as espera, ";
  $sql .= "(time_to_sec(curtime()) - time_to_sec(horaEntrada)) / 60 as minutos,";
  $sql .= "sec_to_time( time_to_sec(curtime()) - time_to_sec(hora_inicio) ) as esperaTotal, "  ;
  $sql .= "(time_to_sec(curtime()) - time_to_sec(hora_inicio)) / 60 as minutosTotal,";    
  $sql .= "sistema.sistema as produto, satligacao.motivo, linha from satligacao, cliente, sistema where ";
  $sql .= "data = '$hoje' and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema and ";
    $sql .= "id_satstatus = 1 order by esperaTotal desc";
//  $sql .= "id_satstatus = 1 order by satligacao.grau, espera desc";
//  die($sql);
  $result = mysql_query($sql);
  while ($linha = mysql_fetch_object($result)) {
    $idligacao = $linha->id;
	$cliente = $linha->cliente;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	
	$_bloqueio = $linha->bloqueio == 1;
	
	$espera = $linha->espera ;
	$espera =  $espera == "" ? "&nbsp;" : $espera;
	$esperaTotal = $linha->esperaTotal;
	
	$minutos = $linha->minutos;
	$minutosTotal = $linha->minutosTotal;
	
	$linhatel = $linha->linha;
	$motivo = $linha->motivo;
	
	$grau = AcertaGrau($linha->grau);
	$slgrau = AcertaGrau($linha->slgrau);
	
	$motivo_status = $linha->motivo_status;
	
	$uf = $linha->uf;
		
	$classeCSS = "cl_normal";	
	if ( ($slgrau == 'G1') || ($slgrau == 'G2') ) {
		if (  ($minutos > 8) and ($minutos <= 15)  ) {
		  $classeCSS = 'cl_atencao';
		} else if ($minutos > 15) {
		  $classeCSS = "cl_critica";
		}
	}

	$classeCSStotal = "cl_normal";	
	if (  ($minutosTotal > 8) and ($minutosTotal <= 15)  ) {
	  $classeCSStotal = 'cl_atencao';
	} else if ($minutosTotal > 15) {
	  $classeCSStotal = "cl_critica";
	}


/*
	if ( ($grau != $slgrau) ) 
		$grau = "[$grau] -> [$slgrau]";
	else
*/
		$grau = "[$slgrau]";


//	echo "-> $uf, $linha->ddd, $_FL_SP";
	
	if ( ($uf != 'SP') || ($linha->ddd != "11") ) {
	  $cliente = "<b>$cliente - (DDD: $linha->ddd - UF: $uf)</b>";
	}
	
	if ($_bloqueio)	
	{		
	$cliente = "<b>CONSULTORIA BLOQUEADA !</b> - $cliente - <b>CONSULTORIA BLOQUEADA !</b>";
	}
	
?>

        <tr class="<?=$classeCSS?>">
          <td width="6%" align="center"><font size="1"><a href="javascript:fnc_cancela('<?=$idligacao?>', '<?=$cliente?>');"><img src="../imagens/deletar.gif" width="12" height="12" border="0"></a></font></td>
          <td width="9%" align="center"><font size="1"><a href="javascript:document.transf.idligacao.value='<?=$idligacao?>';document.transf.acao.value='aguarde';document.transf.submit();">Clique
            (
            <?=$qtde?>
            )</a></font></td>
          <td width="7%" align="center"> <font size="1">
            <?=$linhatel?>
            </font></td>
          <td width="38%"><font color="#003333" size="1"><a href="javascript:cliente('<?=$cliente?>', '<?=$produto?>', <?=$idligacao?>);">
            <? echo "$grau $cliente";?>
            </a>
			<?
			  if ($motivo) {
			    echo "<br>Devolvido por <b>$motivo</b>";
			  }
			?>
			</font></td>
          <td width="9%" align="center"><font size="1">
            <?=$espera?>
            </font></td>
          <td width="9%" align="center" name="total" class="<?=$classeCSStotal?>"><font size="1">
            <?=$esperaTotal?>
            </font></td>			
          <td width="22%"><font size="1">
            <?=$produto?> <?= $motivo_status ? "- $motivo_status" : ""?>
            </font></td>
        </tr>
        <?
 }
?>
      </table>
      <br> <h3><?=$msg?></h3>
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr valign="top">
          <td width="43%">
            <table width="100%" border="0" cellpadding="1" cellspacing="1" class="Mtable">
              <tr bgcolor="#003333">
                <td colspan="3" bgcolor="#003366"><strong><font color="#FFFFFF" size="1">Consultor</font></strong></td>
              </tr>
<?
//  $sql = "select nome, id_usuario, estado, sat_idcliente from usuario where area  = 1 and ativo=1 order by nome;";
	$sql = "select c.grau, nome, id_usuario, estado, sat_idcliente from usuario left  join cliente c on c.id_cliente = usuario.sat_idcliente where area  = 1 and ativo=1 order by nome;";

  $result = mysql_query($sql);
  while ($linha = mysql_fetch_object($result)) {


	$grau = AcertaGrau($linha->grau);
	

  $sat_idcliente = "&nbsp;";
  if (  ($linha->estado==4) and ($linha->sat_idcliente)) {


    $sat_idcliente = $linha->sat_idcliente;
	
	if (($grau != '  ') || ($grau != 'ZZ')) {
		$sat_idcliente .= "[$grau]";
	}
	
  } else {
    $sat_idcliente = "&nbsp;";
  }

?>
              <tr>
                <td width="37%">
				 <font size="1">
				   <? if ( (($linha->estado == 8)) or ($linha->estado == 1)) { ?>
				   <a href="javascript:consultor('<?=$linha->nome?>', <?=$linha->id_usuario?>);">
				   <? } ?>
                    <?=$linha->nome?>
				   <? if ( (($linha->estado == 8)) or ($linha->estado == 1))  { ?>
                   </a>
				   <? } ?>
				  </font>
			    </td>
                <td width="30%">
                   <img src="../imagens/estado<?=$linha->estado?>.jpg" width="120" height="20" border="0">
				</td>
                <td width="33%"><?=$sat_idcliente?></td>
              </tr>
              <?
 }
?>
            </table>
            <form action="index.php" method="post" name="transf" id="transf">
              <input name="Submit2" type="button" class="bordaTexto" value="Confirma" onClick="transfere();">
              <input name="acao" type="hidden" id="acao2">
              <input name="idligacao" type="hidden" id="idligacao">
              <input name="idconsultor" type="hidden" id="idconsultor2">
            </form>
          </td>
          <td width="57%">
            <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
              <tr>
                <td><table width="100%" border="0" cellpadding="1" cellspacing="1" class="Mtable">
                    <tr bgcolor="#003366">
                      <td colspan="2"><font color="#FFFFFF" size="1"><strong>Pr&oacute;xima
                        transfer&ecirc;ncia ser&aacute; :</strong></font></td>
                    </tr>
                    <tr>
                      <td width="17%"><font size="1">Consultor</font></td>
                      <td width="83%"><font size="1"><b><span id="SpanConsultor"></span></b></font></td>
                    </tr>
                    <tr>
                      <td><font size="1">Atender&aacute;</font></td>
                      <td><font size="1"><b><span id="SpanCliente"></span></b></font></td>
                    </tr>
                    <tr>
                      <td><font size="1">Sobre</font></td>
                      <td><font size="1"><b><span id="SpanProduto"></span></b></font></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#003300">
                    <tr>
                      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td colspan="2" align="center"><strong>&Uacute;ltimas 5 liga&ccedil;&otilde;es atendidas</strong></td>
                          </tr>
                          <tr>
                            <td width="31%">Total de liga&ccedil;&otilde;es de
                              hoje</td>
                            <td width="15%"><strong><font color="#003366" size="2">
                              <?=$ligHoje?>
                              </font></strong></td>
                            <td width="34%"><strong><font color="#003300">Tempo
                              m&eacute;dio de espera</font></strong></td>
                            <td width="20%"><strong><font color="#003300" size="2">
                              <?=$tmedio?>
                              </font></strong></td>
                          </tr>
                          <tr>
                            <td>Em espera</td>
                            <td width="15%"><font color="#FF0000" size="2"><strong>
                              <?=$ligEspera?>
                              </strong></font></td>
                            <td width="34%">Tempo m&aacute;ximo</td>
                            <td width="20%"><font size="1">
                              <?=$tmaximo?>
                              </font></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td width="15%"><strong><font color="#003366" size="2">
                              <?=$qtdeconsultor?>
                              </font></strong></td>
                            <td width="34%">Tempo m&iacute;nimo</td>
                            <td width="20%"><font size="1">
                              <?=$tminimo?>
                              </font></td>
                          </tr>
                          <tr align="center" valign="middle">
                            <td colspan="4"><?=$lampada?></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
</td>
  </tr>
  <tr>
    <td align="center" valign="middle"><p><font size="3">Liga&ccedil;&otilde;es </font><font size="3">Transferidas (
        <?=$ligTransf?>
        )</font></p>
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="26%">Cliente</td>
          <td width="10%">Consultor</td>
          <td width="64%">Tempo na espera</td>
        </tr>
        <?
  $sql = "select usuario.nome, qtde_aguarde,  id, cliente.cliente, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as espera, ";
  $sql .= "sistema.sistema as produto, linha from satligacao, cliente, sistema, usuario where usuario.id_usuario = satligacao.id_usuario and ";
  $sql .= "data = '$hoje' and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema and ";
  $sql .= "id_satstatus = 2 order by espera desc";
  $result = mysql_query($sql) or die($sql);
  while ($linha = mysql_fetch_object($result)) {
    $nome = $linha->nome;
    $idligacao = $linha->id;
    $cliente = $linha->cliente;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$linhatel = $linha->linha;
?>
        <tr>
          <td><a href="javascript:fnc_retomar(<?=$idligacao?>);">
            <?=$cliente?>
          </a> </td>
          <td><a href="javascript:fnc_retomar(<?=$idligacao?>);">
            <?=$nome?>
            </a> (
            <?=$linhatel?>
            ) </td>
          <td><?=$espera?>
          </td>
        </tr>
        <?
 }
?>
      </table>
      <p><font size="3"></font></p></td>
  </tr>
  <tr>
    <td align="right"><p>
      <input name="acao" type="hidden" id="acao" value="XXX">
      <input name="idligacao" type="hidden" id="idligacao">
    Sad 2008</p>
    </td>
  </tr>
</table>
</body>
</html>
<script>
	 
	if ( 	
	    ('1' == '<?=$OutroDDD?>') || 
		('<?=$_FL_SP?>' == 'N') ||
		('<?=$estado_cliente?>' != 'SP') 
	 ) { 
    alert('Atenção !\nCliente de outro estado (<?=$estado_cliente?>) ou DDD diferente de 11 !\nEste cliente tem atendimento diferenciado\nVerifique com o gerente do suporte');
  }
  
  
  if ('1' == '<?=$fl_posvenda?>') {
     alert('Atenção!\nCliente em PÓS-VENDA\nEste cliente tem atendimento diferenciado\nVerifique com a Intersystem');
  }
  
  
  
  if ('1' == '<?=$bloqueio?>') {
     alert('Atenção!\nCliente BLOQUEADO para consultoria. Favor direcionar para administração');
  }
  
  

  function mudou( valor ) {
    document.form1.acao.value = "alterachecked"
    document.form1.id.value = valor.value;
	document.form1.submit();
  }


  function deleta(value) {
    if ( window.confirm('Confirma deletar : ' + value +  ' ? ')) {
			document.form1.acao.value='deletar';
			document.form1.submit();
   	}
  }

  function dep(value) {
    window.open("memo.php?id="+value, "","scrollbars=yes, height=300, width=600");
  }

function cliente(Anome, Aproduto, Aid) {
  SpanCliente.innerHTML = Anome;
  SpanProduto.innerHTML = Aproduto;
  document.transf.idligacao.value  = Aid;
}

function consultor(Anome, Aid) {
  SpanConsultor.innerHTML = Anome;
  document.transf.idconsultor.value = Aid;
}

function transfere() {
  if (document.transf.idligacao.value == '') {
    window.alert('Você deve clicar no nome do cliente a ser transferido');
	return false;
  }
  if (document.transf.idconsultor.value == '') {
    window.alert('Você deve clicar no nome do consultor que receberá a ligação ');
	return false;
  }
  document.transf.acao.value = 'transferir';
  document.transf.submit();
}

function teste(aId) {
  document.transf.idligacao.value = aId;
  document.transf.acao.value = 'atendeu';
  document.transf.submit();
}

function fnc_retomar(aId) {
  document.transf.idligacao.value = aId;
  document.transf.acao.value = 'retomar';
  document.transf.submit();
}

function seleciona() {
  window.name = "pai";
  value = document.form.id_cliente.value;
  window.open('../selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
}

 if(
      ('-<?=$pesquisa?>'!='-')
    ) {
  document.form.id_cliente.value='<?=$pesquisa?>';
  seleciona();
 } else {
  document.form.nomesenha.focus();
 }

</script>
<?

/*
  -- todas as ligacoes desligadas
  select
    id, data, id_cliente, hora_inicio, hora_fim, hora_transferencia,
    sec_to_time(time_to_sec(hora_fim)-time_to_sec(hora_inicio)) as tempo
  from
    satligacao
  where id_satstatus=4;



  -- todas as ligacoes desligadas
  select
    id, data, id_cliente, hora_transferencia as tr, hora_fim,
    sec_to_time(time_to_sec(hora_fim)-time_to_sec(hora_transferencia)) as tempo
  from
    satligacao
  where id_satstatus=3;

*/

mysql_close($link);
?>
<script>

  function fnc_reaproveitar(Aid_cliente, Aid_ligacao, ALinha) {
    document.form.id_cliente.value = Aid_cliente;
    document.form.id_ligacao.value = Aid_ligacao;
    document.form.id_linha.value = ALinha;
    document.form.submit();
  }

  function pesquisacliente() {
    document.form.acao.value='pesquisacliente';
//	document.form.id_cliente.value=document.form.nomesenha.value;
	document.form.submit();
  }

function alterna(item){
 if (item.style.display=='none'){
   item.style.display='';
 } else {
   item.style.display='none'
 }
}

</script>
<script>
function fnc_transfereSemEspera() {
  if (document.espera.id_consultor.value == 0) {
    window.alert("Primeiro você deve escolher um consultor");
	document.espera.id_consultor.focus();
	return false;
  }
  document.espera.acao.value = 'CriarETransferir';
  fnc_espera()
}

function fnc_espera() {

  if (document.espera.idcliente.value == "") {
    window.alert("Primeiro você deve escolher um cliente nas ligações em espera");
//	document.form.id_cliente.focus();
	return false;
  }

  if (document.espera.linhatel.value == -1) {
    window.alert("Selecione uma linha");
	document.espera.linhatel.focus();
	return false;
  }

  if (document.espera.id_produto.value == 0) {
    window.alert("Selecione um produto");
	document.espera.id_produto.focus();
	return false;
  }
  document.espera.submit();
}

function fnc_cancela(aLigacao, aCliente) {
  if (window.confirm('Cancelar ligação do cliente ' + aCliente + ' ? ')) {
     document.transf.idligacao.value=aLigacao;
	 document.transf.acao.value='cancelar';
	 document.transf.submit();
  }

}

</script>
<?
/*
	echo "Flag: $_FL_SP <br>";
	echo "Telefone: $telefone <br>";	
	echo "DDD: $ddd <br>";		
	echo "posAbre: $posAbre <br> " . is_numeric($posAbre);
*/	
?>