<?	
	require("cabeca.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Log chamado</title>
<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<p>
  <?

$sql = "select l.id_chamado, 
  l.data, l.hora, u.nome, l.acao acaoId,
  case l.acao
    when 1 then 'Abriu este chamado'
    when 2 then 'Inseriu um contato'
    when 3 then 'Leu o chamado'
    when 4 then 'Encerrou o chamado'
    when 5 then 'Passou a seguir este chamado'
    when 6 then 'Deixou de seguir este chamado'
    when 7 then 'Complementou um contato'	
	when 8 then 'Reabriu o chamado'		
	when 11 then 'Encaminhou'		
	when 12 then 'Manteve pendente'	
	when 13 then 'Iniciou um contato'
	when 14 then 'Cancelou um contato'			
  end acao,
  d.nome destinatario,
  c.destinatario_id,
  id_contato,
  s.sistema,
  c.lido, c.lidodono, c.consultor_id cId, c.descricao,
  concat('[', cl.id_cliente, '] ', cl.cliente)	cliente  
from 
  log l
    inner join usuario u on u.id_usuario = l.id_usuario
    left join usuario d on d.id_usuario = l.id_destinatario
	left join chamado c on c.id_chamado = l.id_chamado
	left join cliente cl on cl.id_cliente = c.cliente_id
	left join sistema s on s.id_sistema = c.sistema_id
where l.id_chamado = $id_chamado
order by id desc";


$query = mysql_query($sql) or die (mysql_error() . "<br>" . $sql);
?>
</p>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#999999">
  <tr>
    <td bgcolor="#006699"><span class="style3">Data Hora </span></td>
    <td bgcolor="#006699"><span class="style3">Usu&aacute;rio</span></td>
    <td bgcolor="#006699"><span class="style3">A&ccedil;&atilde;o</span></td>
  </tr>
<?
  while ($linha = mysql_fetch_object($query))
  {
    $data = AMD2DMA($linha->data) . "  " . $linha->hora;
	$nome = $linha->nome;
	$acao = $linha->acao;
	$IdContato = $linha->id_contato;
	if ($linha->acaoId == 11) {
		$destinatario = $linha->destinatario;
		if ($destinatario){
			$acao .= " para <a href=historicochamado.php?id_chamado=" . $linha->id_chamado . "#Id_". $IdContato . ">" . $destinatario . "</a>";
		}
	}
?>  
  <tr>
    <td bgcolor="#FFFFFF"><?=$data?></td>
    <td bgcolor="#FFFFFF"><?=$nome?></td>
    <td bgcolor="#FFFFFF"><?=$acao?></td>
  </tr>
<?
  }
?>  
</table>
<p>&nbsp;</p>
</body>
</html>
