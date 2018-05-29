<?php require_once('../Connections/sad.php'); ?>
<?php
 
 require("scripts/conn.php");		
 
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}

 $usuario = $ok;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Chamados</title>
<link href="../cssSAD.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="Outer-content">

  <div class="inner-content">
  
	<div class="header"></div>
 	
	<div class="Menu">
		|<a href="#">Logout</a>|
		|<a href="#">Relatórios</a>|
		|<a href="#">Alterar Senha</a>|
		|<a href="#">Intranet</a>|
		|<a href="#">Agenda Corporativa</a>|
	</div>	  

	<div class="Usuario">
		Usuário: <span class="User">Fernando Nomellini</span>
	</div>

	<div class="ListaChamados">
			
	<div class="CabecalhoChamadoInner">	
		<table class="ChamadoTabela">
			<tr>
				<td class="ChamadoColuna1">Chamado</td>
				<td class="ChamadoColuna2">Data</td>
				<td class="ChamadoColuna3">Cliente</td>
				<td class="ChamadoColuna4">Descrição</td>
			</tr>
		</table>
	</div>
	
<? 
	$sql .= "SELECT c.rnc_depto_responsavel, c.rnc_prazo, dataprevistaliberacao, liberado, ";
	$sql .= "c.sistema_id, c.externo, c.rnc, c.id_chamado, c.lido, c.lidodono, c.dataa,c.horaa, c.status, ";
	$sql .= " destinatario_id, consultor_id, remetente_id, cat.pos_venda,   ";
	$sql .= "LEFT(c.descricao, 200) as descricao, cl.id_cliente, cl.cliente, cl.telefone, cl.senha as senhacliente, p.prioridade, p.valor ";
	$sql .= "FROM chamado c, cliente cl, prioridade p, categoria cat ";
	$sql .= "WHERE ((c.cliente_id = cl.id_cliente) ";
	$sql .= "AND ( (c.descricao is not null) AND (c.descricao <> '') )";
	$sql .= "AND ( (c.destinatario_id = $usuario) or (c.consultor_id = $usuario) ) ";
	$sql .= "AND ( c.prioridade_id = p.id_prioridade) ";
	$sql .= "AND ( c.categoria_id = cat.id_categoria ) "; 
	$sql .= "AND (c.status <> 1))"; 
	$sql .= "ORDER BY p.valor, dataa desc, horaa desc;";
	
	$result = mysql_query($sql) or die($sql);
	while ($linha = mysql_fetch_object($result)) {
		$Style = "ChamadoQualidade";
		$id_chamado = $linha->id_chamado;
		if ($id_chamado % 2 == 0) {
			$Style = "ChamadoNormal";
		}
?>
<div class="<?= $Style?>">
 <table class="ChamadoTabela">
  <tr>
   <td class="ChamadoColuna1">
    <?= number_format($linha->id_chamado,0,',','.') ?>
   </td>
   <td class="ChamadoColuna2">
    <?= $linha->dataa?>
   </td>
   <td class="ChamadoColuna3">
    <span class="ChamadoClienteID"><?= $linha->id_cliente?></span>
   </td>
   <td class="ChamadoColuna4"><?= $linha->cliente?><br />
    <span class="ChamadoDescricao">
      <a href="#">
        <?= $linha->descricao?>...
      </a>
    </span>
   </tr>
 </table>			
</div>
<?
	}
?>

			
	</div>

  </div>
  
	<span class="rodape">
		<p>
			SAD - Sistema de Atendimento Datamace - 2009
		</p>
	</span>
  
  
</div>
</div>

</body>
</html>
