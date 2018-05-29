<?

	require("../../scripts/conn.php");
	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}

	$hoje = date("Y-m-d");	
	$hora = date("H:i:s");	
	$today = date("d/m/Y");		
	
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*0 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	if(!$dataf) {
      $dataf = $today;
	}
	
	$data = explode('/', $datai);
	$dataisql = "$data[2]-$data[1]-$data[0]";
	$data = explode('/', $dataf);
	$datafsql = "$data[2]-$data[1]-$data[0]";
	
?>

<html>
<head>
<title>Liga&ccedil;&otilde;es de hoje</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../todo/stilos.css" type="text/css">
<link href="../../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="120">
</head> 
<body bgcolor="#FFFFFF" text="#000000">
<img src="../../figuras/topo_sad_e_900.jpg" width="900" height="79">
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td>teste      </td>
  </tr>
  <tr> 
    <td valign="top"><form name="form1" method="post" action="">
      <table width="561" border="0">
        <tr>
          <td width="72">Data Inicial            </td>
          <td width="152"><input name="datai" type="text" class="borda_fina" id="datai3" value="<?=$datai?>"></td>
          <td width="76">Data Final </td>
          <td width="243">
            <input name="dataf" type="text" class="borda_fina" id="dataf" value="<?=$dataf?>"></td>
        </tr>
        <tr>
          <td>Cliente</td>
          <td><input name="clientePesquisa" type="text" class="borda_fina" id="clientePesquisa" value="<?=$clientePesquisa?>"></td>
          <td>&nbsp; </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Sistema</td>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="borda_fina" value="OK"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
	<font color="#003366" size="2">      
	 <span id="linhas"></span>
    </font>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#003366"> 
          <td width="15%" height="16"><font color="#FFFFFF"><em><strong>Status</strong></em></font></td>
          <td width="37%"><font color="#FFFFFF"><em><strong>Cliente</strong></em></font></td>
          <td width="11%"><font color="#FFFFFF"><em><strong>Hora Inicio </strong></em></font></td>
          <td width="10%"><font color="#FFFFFF"><em><strong>Hora Fim </strong></em></font></td>
          <td width="11%"><font color="#FFFFFF"><em><strong>Espera</strong></em></font></td>
          <td width="16%"><font color="#FFFFFF"><em><strong>Consultor / Produto</strong></em></font></td>
        </tr>

<?

  $sql = "select satligacao.id_cliente, data, usuario.nome as consultor, id_chamado, satstatus.descricao as status, qtde_aguarde,  satligacao.id, cliente.cliente, sec_to_time(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)  ) as espera, ";
  $sql .= "sistema.sistema as produto, satligacao.motivo, linha, satligacao.hora_inicio, hora_fim, cliente.bloqueio ";
  $sql .= "from satligacao, cliente, sistema, satstatus, usuario ";
  $sql .= "where satstatus.id = satligacao.id_satstatus and usuario.id_usuario = satligacao.id_usuario and ";
  $sql .= "(data >= '$dataisql' and data <= '$datafsql') and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema ";
  if ($id_sistema) {
    $sql .= " and (satligacao.id_produto = $id_sistema ) ";
  }
  if ($clientePesquisa) {
    $sql .= " and ( (cliente like '%$clientePesquisa%') or (satligacao.id_cliente like '%$clientePesquisa%') ) ";
  }
  $sql .= "order by data desc,  hora_inicio desc";
  
//   echo $sql;
  $result = mysql_query($sql) or die($sql);
  $linhas = mysql_affected_rows();
  while ($linha = mysql_fetch_object($result)) {  
    $dia = explode("-", $linha->data);
	$dia = "$dia[2]/$dia[1]/$dia[0]";
    $status = $linha->status;
    $idligacao = $linha->id;
	$id_chamado = $linha->id_chamado;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$linhatel = $linha->linha;
	$motivo = $linha->motivo;
	$hora_inicio = $linha->hora_inicio;
	$hora_fim = $linha->hora_fim;
	$consultor = $linha->consultor;
	$id_cliente = $linha->id_cliente;

    if ($linha->bloqueio) {
	   $bloqueio = "<br><b>Cliente bloqueado</b>";
	} else {
       $bloqueio = '';
	}
	
    $cliente = "$linha->cliente  $bloqueio ($id_cliente)";

	if ($cor=="#E8F1F9") {
      $cor='#ffffff';
	} else {
      $cor='#E8F1F9';
	}

?>

        <tr bgcolor="<?=$cor?>"> 
          <td width="15%">
		  <?
 			echo "<b>";			
		    echo $dia; 
 			echo "</b>";			
			echo "<br>";
		    echo $status;
			/*
			if ($motivo) {
			  echo "<br><b>$motivo</b>";
			}
			*/
		    
    	   ?>
		  </td>
          <td width="37%">
		  <?
		    if ($id_chamado!=0) {
		  ?>
		  <a href="../../historicochamado.php?id_chamado=<?=$id_chamado?>">
		  <?=$cliente?>		  
 		  </a>
		  <? } else {?>
		  <?=$cliente?>
		  <? } ?>

		  </td>
          <td width="11%"><?=$hora_inicio?></td>
          <td width="10%"><?=$hora_fim?></td>
          <td width="11%"><?=$espera?></td>
          <td width="16%"><?=$consultor?>/<?=$produto?></td>
        </tr>
        <?
 }
?>
      </table>
       </td>
  </tr>
  <tr> 
    <td align="right">
      Sad 2004</td>
  </tr>
</table>
<script>
  linhas.innerHTML = '<?=$linhas?> registros encontrados';
</script>
</body>
</html>
