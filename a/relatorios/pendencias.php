<?
	require("../scripts/conn.php");	
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
	
    $pode = pegaGerencial($ok);   
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {
	
      if( !isset($f_id_usuario) ) {
	    $f_id_usuario = $ok;
	  }	
?> 
<html>
<head>
<title>relat&oacute;rio de pendencias</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 11px;
	background: #FFFF00;
	border: 1px  dashed #003399;
	top: 1px; left: 15%;
	position: relative;
}
.ChamadoOk {
	background: #CBF2FE;
}
.ChamadoAguardando 
{
	background:  #FFECEC;
}

-->
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<p align="center"><img src="../figuras/intro.gif" width="321" height="21"> </p>
<p align="center"><font size="3">Relat&oacute;rio de pend&ecirc;ncias<br>
  <font size="1">restrito a gerencia</font></font></p>
<form name="form" method="get" action="<?=$SCRIPT_NAME?>">
  <table width="90%" border="0" cellspacing="1" cellpadding="1" >
    <tr> 
      <td>Selecione o usuario 
        <select name="f_id_usuario" class="unnamed1">
          <?
		  $sql = "select id_usuario, nome from usuario where atendimento and ativo order by nome;";
		  $result = mysql_query($sql) or die ("Erro no SQL <br> $sql");
		  while ( $linha = mysql_fetch_object($result)) {
            $se = "";
		    if ($linha->id_usuario == $f_id_usuario) { $se = "selected"; $nome=$linha->nome; }
		    echo "<option value=" . $linha->id_usuario ." $se>" . $linha->nome . "</option>\n";
		  }
		  ?>
        </select>
      </td>      
    </tr>

    <tr> 
      <td>Selecione a prioridade 
        <select name="f_id_prioridade" class="unnamed1">   
        		    echo "<option value="0" >Todos</option>\n";
   <?
   
  $sql = "
select 
	p.valor,
	p.prioridade, 
	p.id_prioridade,
	count(1) qtde
from 
	chamado c
		inner join prioridade p on p.id_prioridade = c.prioridade_id
		inner join usuario dono on dono.id_usuario = c.consultor_id
		inner join usuario destinatario on destinatario.id_usuario = c.destinatario_id
		left join chamado e on e.id_chamado = c.Id_chamado_espera
		left join status s on s.id_status = e.status		
where 
	(c.visible=1) and 
	(c.status > 1 and c.status < 4) and 
	c.destinatario_id = $f_id_usuario and c.descricao is not null
group by p.valor, p.prioridade, p.id_prioridade";  
		  $result = mysql_query($sql) or die ("Erro no SQL <br> $sql");
		  while ( $linha = mysql_fetch_object($result)) {
            $se = "";
		    if ($linha->id_prioridade == $f_id_prioridade) { $se = "selected"; $nome=$linha->prioridade; }
		    echo "<option value=" . $linha->id_prioridade ." $se>" . $linha->prioridade . " - " . $linha->qtde . "</option>\n";
		  }
		  ?>
        </select>
      </td>      
    </tr>
    
    
    <tr>
      <td><input type="submit" name="Submit" value="Submit" class="unnamed1"></td>
    </tr>
  </table>
  <br>
</form>

<br><span id=bloqueados></span>
<br><?
//  $sql = "select p.prioridade, Id_chamado_espera, cliente_id, id_chamado, descricao, dataa, dono.nome as dono, destinatario.nome as destinatario from chamado, usuario dono, usuario destinatario where (chamado.visible=1) and (destinatario.id_usuario=destinatario_id) and (dono.id_usuario=consultor_id) and  (status > 1 and status < 4) " ;
  //$sql .= "and destinatario_id = $f_id_usuario and descricao is not null;";
  
  
  $sql = "
select 
	p.prioridade, 
	p.id_prioridade,
	c.Id_chamado_espera, 
	c.cliente_id, 
	c.id_chamado, 
	c.descricao, 
	c.dataa, 
	dono.nome as dono, 
	destinatario.nome as destinatario,
    (SELECT dataa FROM contato WHERE id_contato = (select max(id_contato) from contato where chamado_id  = c.id_chamado)) as data_ultimo_contato,
	s.status
from 
	chamado c
		inner join prioridade p on p.id_prioridade = c.prioridade_id
		inner join usuario dono on dono.id_usuario = c.consultor_id
		inner join usuario destinatario on destinatario.id_usuario = c.destinatario_id
		left join chamado e on e.id_chamado = c.Id_chamado_espera
		left join status s on s.id_status = e.status		
where ";

if ($f_id_prioridade) {
	 $sql .= "(p.id_prioridade = $f_id_prioridade) and ";
}

 $sql .= "
	(c.visible=1) and 
	(c.status > 1 and c.status < 4) and 
	c.destinatario_id = $f_id_usuario and c.descricao is not null
order by p.valor, data_ultimo_contato;";  
// die($sql);

  if ($sql) {
    $result = mysql_query($sql) or die (mysql_error());
	$total = mysql_affected_rows();
	echo "Chamados que estão com $nome :  $total ";
?><?
 	while ( $linha = mysql_fetch_object($result) ) {
			$descricao = $linha->descricao;
			$descricao = eregi_replace("\r\n", "<br>",$descricao);
            $descricao = eregi_replace("\"", "`", $descricao);
			list($tmp1, $cli) = each(pegaClientePorCodigoUnico( $linha->cliente_id));  
			$cliNome = $cli["cliente"];
			$cliBloq = $cli["bloqueio"];
			$Id_chamado_espera = $linha->Id_chamado_espera;
			if ($cliBloq) $contaBloq++;
			
			$esperando = "";
			$cor = "ChamadoOk";
			if ($Id_chamado_espera > 0)
			{
				$esperando = "<span class=\"style1\">Esperando o chamado : <a href=\"../historicochamado.php?id_chamado=$Id_chamado_espera\" target=\"_blank\">$Id_chamado_espera</a> \"$linha->status\"</span>";
				$cor = "ChamadoAguardando";
			}
	
			if (		$linha->id_prioridade > 3 )
			{
				$linha->id_prioridade = 1 ;
				
			}
				
			$cor = "prioridade_" . $linha->id_prioridade;
	
?>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td><table width="99%" border="0" cellpadding="1" cellspacing="0" bgcolor="#003366">
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td class="<?=$cor?>">Chamado # <a href="../historicochamado.php?id_chamado=<?=$linha->id_chamado?>" target="_blank"> <?=$linha->id_chamado?> </a>  - <?=$linha->prioridade?><?= $esperando?><br>
    <?    
        $today=date("Y-m-d 00:00"); 
		$datausuario =  $linha->data_ultimo_contato; // ultimoDataChamado($linha->id_chamado);
        $date1=strtotime( $datausuario );
        $date2=strtotime($today);
		$abertura = strtotime($linha->dataa);
		
		$datausuario = implode ("/",  array_reverse( explode("-", $datausuario) ) );
        echo "Aberto em $linha->dataa, a ". ceil ( (($date2-$abertura)/86400) )." dias";  
	  ?>
    <br>
    <? echo "$linha->destinatario est&aacute; com este chamado a " . ceil ( (($date2-$date1)/86400) ) . " dias, deste $datausuario"?><br>
O dono deste chamado &eacute;
<?=$linha->dono?>
<br>
<br>
<em><strong>Descri&ccedil;&atilde;o do chamado</strong></em><br>
<br>
<b>
<?=$cliNome?>
(
<?=$linha->cliente_id?>
)</b><br>
<?=$cliBloq ? "<h1><font color=#ff0000>BLOQUEADO</font></h1>":""?>
<br>
<?=$descricao?>
<br>
<br>
<em><strong>&uacute;ltimo contato:</strong></em><br>
<font color=#333333>
<br>
<?=ultimoHistoricoChamado($linha->id_chamado)?>
</font></td>
  </tr>
</table> </td>
    <tr>

  </table></td>
  </tr>
  <tr>
    <td><img src="../../agenda/figuras/1pixel.gif" width="1" height="1"></td>
  </tr>
</table>
<?}?>
  <?
}
?>
  <br>
<br>
<br>
<br>
<?
  $sql = "select cliente_id, id_chamado, descricao, dataa, dono.nome as dono, destinatario.nome as destinatario from chamado, usuario dono, usuario destinatario where (destinatario.id_usuario=destinatario_id) and (dono.id_usuario=consultor_id) and status > 1 " ;
  $sql .= "and consultor_id = $f_id_usuario and descricao is not null and destinatario_id<>consultor_id;"  ;
  if ($sql) {
    $result = mysql_query($sql);
	$total = mysql_affected_rows();
	echo "Chamados que foram abertos por $nome e estão encaminhados :  $total ";
?>
<table width="99%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000066">
  <tr bgcolor="#0000FF"> 
    <td width="60" valign="middle" align="center"><b><font color="#FFFFFF">Chamado</font></b></td>
    <td width="100" valign="middle" align="center"><b><font color="#FFFFFF">Data</font></b></td>
    <td width="81"><b><font color="#FFFFFF">Dono</font></b></td>
    <td width="104"><b><font color="#FFFFFF">Destinatario</font></b></td>
    <td width="632"><b><font color="#FFFFFF">Descricao</font></b></td>
  </tr>
  <?
 	while ( $linha = mysql_fetch_object($result) ) {
			$descricao = $linha->descricao;
			$descricao = eregi_replace("\r\n", "<br>",$descricao);
            $descricao = eregi_replace("\"", "`", $descricao);	
			list($tmp1, $cli) = each(pegaClientePorCodigoUnico( $linha->cliente_id));  
			$cliNome = $cli["cliente"];
			$cliBloq = $cli["bloqueio"];
			if ($cliBloq) $contaBloq++;
	
?>
  <tr bgcolor="#F0F0FF"> 
    <td width="60" valign="middle" align="center"> <a href="../historicochamado.php?id_chamado=<?=$linha->id_chamado?>">
      <?=$linha->id_chamado?>
      </a> </td>
    <td width="100" valign="middle" align="center"> 
      <?=$linha->dataa?>
    </td>
    <td width="81"> 
      <?=$linha->dono?>
    </td>
    <td width="104"> 
      <?=$linha->destinatario?>
    </td>
    <td width="632">
	  <b><?=$cliNome?> (<?=$linha->cliente_id?>)</b><br><?=$cliBloq ? "<h1><font color=#ff0000>BLOQUEADO</font></h1>":""?><br>
      <?=$descricao?>
    </td>
  </tr>
  <?}?>
</table>
<?
}
?>
<script>
  if ( '-' != '<?=$contaBloq?>-') {
    bloqueados.innerHTML = "Total de clientes bloqueados : <?=$contaBloq?>";
  }
</script>
</body>
</html>
<?
}
?>
