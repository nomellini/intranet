<?	
	require("cabeca.php");
    $UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 2 * 31 ) );  	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Encaminhamentos</title>
<style type="text/css">
<!--

tr.EhMeu {
    color: #FF0000; 
}

tr.NaoEhMeu {
    color: #000000; 
}


.style3 {
	color: #FFFFFF;
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

<body style="font-family:Arial; font-size:12px">
<h2>Meus encaminhamentos dos últimos meses</h2>
<p>
  <?
/*  
if (($ok == 98) || ($ok == 90))
{
	die ("<h1>Perdeu playboy</h1>");
}
*/
  
$UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 2 * 31 ) );  	
if ($ok != -12)
{
	$filtroAdicional = ""; 
	$filtroAdicional .= "and  ( (l.id_destinatario = $ok) or (l.id_usuario = $ok))";
    $UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 4 * 31 ) );  	
}

$sql = "select status.status, c.id_chamado, c.descricao,
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
	
  end acao,
  ud.id_usuario id_destinatario,
  d.nome destinatario,  
  id_contato,
  c.descricao,
  left(sistema.sistema, 20) as sistema,
  left(cliente.cliente,20) as Cliente
from 
  log l
    inner join usuario u on u.id_usuario = l.id_usuario
    left  join usuario d on d.id_usuario = l.id_destinatario
	inner join chamado c on c.id_chamado = l.id_chamado
	inner join usuario ud on c.destinatario_id = ud.id_usuario
	inner join sistema on sistema.id_sistema = c.sistema_id
	inner join cliente on cliente.id_cliente = c.cliente_id
	inner join status on c.status = status.id_status
where (acao = 11 or acao=12 or acao=4 ) and 
	l.data >= '$UltimosDoisMeses'
$filtroAdicional
order by id desc";
$query = mysql_query($sql) or die (mysql_error());
//echo ($sql);
?>
</p>
<p> </p>
Filtrar:
<label for="textfield"></label>
<input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'sf', 1)" />
<br />
<br />
<table width="100%" border="0"  cellpadding="1" cellspacing="1" bgcolor="#999999" id="sf">
  <tr>
    <td bgcolor="#006699"><span class="style3">Chamado</span></td>
    <td bgcolor="#006699"><span class="style3">De</span></td>
    <td bgcolor="#006699"><span class="style3">Para</span></td>
    <td bgcolor="#006699" class="style3">Status</td>    
    <td bgcolor="#006699" class="style3">Sistema</td>
    <td bgcolor="#006699" class="style3">Cliente</td>
    <td bgcolor="#006699"><span class="style3">Data Hora </span></td>
  </tr>
  <?
  while ($linha = mysql_fetch_object($query))
  {
	$ParaMim = ($linha->id_destinatario == $ok);
    $data = AMD2DMA($linha->data) . "  " . $linha->hora;
	$nome = $linha->nome;
	$acao = $linha->acao;
	$IdContato = $linha->id_contato;
	if (($linha->acaoId == 12)) {
		$acao = "<a href=historicochamado.php?id_chamado=" . $linha->id_chamado . "#Id_". $IdContato . ">Manteve pendente</a>";		
	}
	
	if (($linha->acaoId == 11)) {
		$destinatario = $linha->destinatario;
		if ($destinatario){
			$acao = "<a href=historicochamado.php?id_chamado=" . $linha->id_chamado . "#Id_". $IdContato . ">" . $destinatario . "</a>";
		}
	}
	

	$ClasseEhMeu = "NaoEhMeu";
	if ($ParaMim) {
		$ClasseEhMeu = "EhMeu";
	}


	
?>

  <tr 	title="<?= htmlentities( $linha->descricao)?>" class="<?=$ClasseEhMeu?>" >
    <td bgcolor="#FFFFFF"><?=$linha->id_chamado?>    
    </td>
    <td bgcolor="#FFFFFF"><?=$nome?></td>
    <td bgcolor="#FFFFFF"><?=$acao?></td>    
    <td bgcolor="#FFFFFF"><?=$linha->status?>    </td>    
    <td bgcolor="#FFFFFF"><?=$linha->sistema?></td>
    <td bgcolor="#FFFFFF"><?=$linha->Cliente?></td>
    <td bgcolor="#FFFFFF"><?=$data?></td>
  </tr>

  <?
  }
?>
</table>
<p>&nbsp;</p>
</body>
</html>
