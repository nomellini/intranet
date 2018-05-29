<?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	

?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; }
.style5 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>

<script>
function filter2 (phrase, _id){
	var words = phrase.value.toLowerCase().split(" ");
	var table = document.getElementById(_id);
	var ele;
	for (var r = 1; r < table.rows.length; r++){
		ele = table.rows[r].innerHTML.replace(/<[^>]+>/g,"");
	        var displayStyle = 'none';
	        for (var i = 0; i < words.length; i++) {
		    if (ele.toLowerCase().indexOf(words[i])>=0)
			displayStyle = '';
		    else {
			displayStyle = 'none';
			break;
		    }
	        }
		table.rows[r].style.display = displayStyle;
	}
}  
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p>
  <?php
$totalGeral;
$bl = 0;
// for($i=2003; $i<2010; $i++) {

//  $sql = "select cliente.bloqueio, cliente.cliente, chamado.id_chamado, chamado.cliente_id, chamado.dataa as AbertoEm, u1.nome as AbertoPor, usuario.nome as EstaCom from   chamado    left join usuario on chamado.destinatario_id = usuario.id_usuario    left join usuario u1 on chamado.consultor_id = u1.id_usuario left join cliente on cliente.id_cliente = chamado.cliente_id where (chamado.descricao <> '') and (chamado.dataa >= '" .($i) . "-01-01') and (chamado.dataa < '".($i+1)."-01-01') and chamado.status <> 1 order by dataa"; 

	$cliente = " and (chamado.cliente_id <> 'DATAMACE') ";
	$chkDatamace = "";
	
	$bloqueado = " and (cliente.bloqueio  = 0) ";
	$chkBloqueio = "";
	if ($ckbMostraDatamace)
	{
		$cliente = "";	
		$chkDatamace = "checked=checked";
	}
	
	if ($ckbMostraInativo)
	{
		$bloqueado = "";
		$chkBloqueio = "checked=checked";
	}

  $sql = "select p.prioridade, cliente.bloqueio, cliente.cliente, chamado.id_chamado, chamado.cliente_id, chamado.dataa as AbertoEm, u1.nome as AbertoPor, usuario.nome as EstaCom, mo.motivo, d.diagnostico, c.categoria, s.sistema ";
  $sql .= "from   chamado    ";
  $sql .= "left join usuario on chamado.destinatario_id = usuario.id_usuario ";
  $sql .= "left join usuario u1 on chamado.consultor_id = u1.id_usuario ";
  $sql .= "left join cliente on cliente.id_cliente = chamado.cliente_id ";
  $sql .= "left join prioridade p on p.id_prioridade = chamado.prioridade_id ";
  $sql .= "left join motivo mo on mo.id_motivo = chamado.motivo_id ";
  $sql .= "left join diagnostico d on d.id_diagnostico = chamado.diagnostico_id ";
  $sql .= "left join categoria c on c.id_categoria = chamado.categoria_id  ";
  $sql .= "left join clienteplus cp on cp.id_cliente = cliente.id_cliente ";
  $sql .= "left join sistema s on s.id_sistema = chamado.sistema_id ";  
  $sql .= "where  (Ic_Intersystem <> 1 and cliente_id <> 'INTERSYSTEM') and (chamado.visible=1) and (chamado.descricao <> '') and chamado.status <> 1 $cliente $bloqueado order by p.valor, dataa "; 

	//echo $sql;

?>
  <br>
  <strong><br>
</strong>Chamados 'Em aberto'</strong></p>
<form action="" method="post" name="form1" id="form1">
  <p>
    <input name="ckbMostraDatamace" type="checkbox" id="ckbMostraDatamace" value="1" <?=$chkDatamace?> >
    <label for="ckbMostraDatamace">Mostrar 'Datamace' 
      <input name="ckbMostraInativo" type="checkbox" id="ckbMostraInativo" value="1" <?=$chkBloqueio?> >
    Mostrar Bloqueados </label><input type="submit" name="submit" id="submit" value="Enviar">
  </p>
</form>
<p>
  Filtrar:<label for="textfield"></label>
  <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'sf', 1)" />
</p>

<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="sf" >
  <tr>
    <td width="89" align="center" valign="middle" bgcolor="#003399"><span class="style4">Chamado</span></td>
    <td width="232" bgcolor="#003399"><span class="style4">Prioridade</span></td>
    <td width="354" bgcolor="#003399"><span class="style4">Cliente</span></td>
    <td width="226" align="center" valign="middle" bgcolor="#003399"><span class="style4">Aberto Em </span></td>
    <td width="193" align="center" valign="middle" bgcolor="#003399"><span class="style4">Est&aacute; com </span></td>
    <td width="193" align="center" valign="middle" bgcolor="#003399" class="style4">Sistema</td>
    <td width="193" align="center" valign="middle" bgcolor="#003399" class="style4">Motivo</td>
    <td width="193" align="center" valign="middle" bgcolor="#003399" class="style4">Diag</td>
    <td width="193" align="center" valign="middle" bgcolor="#003399" class="style4">Categoria</td>
  </tr>
  <?
   $result = mysql_query($sql) or die (mysql_error());
   $conta = 0;
   while ($linha = mysql_fetch_object($result)) {
     $conta++;
	 $dataAbertura = explode('-',  $linha->AbertoEm);
	 $dataAbertura = "$dataAbertura[2]/$dataAbertura[1]/$dataAbertura[0]";
	 if ($linha->bloqueio) {
	   $cor = "$FFEEEE";
	   $bl++;
	 } else {
	   $cor = "#FFFFFF";	 
	 }
  ?>
  <tr bgcolor="<?=$cor?>">
    <td align="center" valign="middle">
	<A HREF="/a/historicochamado.php?id_chamado=<?php echo $linha->id_chamado?>" target="_blank">
	<?php echo number_format($linha->id_chamado, 0, ",", "."); ?></A></td>
    <td align="center" valign="middle"><?php echo $linha->prioridade?></td>
    <td><a href="/a/historico.php?id_cliente=<?php echo $linha->cliente_id?>"><?php echo $linha->cliente?></a></td>
    <td align="center" valign="middle"><?php echo $dataAbertura?></td>
    <td align="center" valign="middle"><?php echo $linha->EstaCom?></td>
    <td align="center" valign="middle"><?php echo $linha->sistema?></td>
    <td align="center" valign="middle"><?php echo $linha->motivo?></td>
    <td align="center" valign="middle"><?php echo $linha->diagnostico?></td>
    <td align="center" valign="middle"><?php echo $linha->categoria?></td>
  </tr>
  <?
  }
  ?>
  <tr>
    <td colspan="9" align="right" valign="top" bgcolor="#FFFFFF"><strong>Total : <?php echo $conta?> Chamados </strong></td>
  </tr>
</table>

<p>
  <?php
  $totalGeral += $conta;
// }
?>
<br>
    <span class="style5">Total de chamados em aberto: <?php echo $totalGeral?> <br>
Total de chamados com cliente bloqueado: <?=$bl;?></span></p>
</body>
</html>