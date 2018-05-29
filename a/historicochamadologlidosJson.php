<?	
header('Content-type: text/html; charset=iso-8859-1');
require("cabeca.php");
$UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 0  ) );  	
$sql = "select c.id_chamado, left(cl.cliente, 20) cliente,
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
  c.lido, c.lidodono, c.consultor_id cId, left(c.descricao, 20) descricao
from 
  log l
    inner join usuario u on u.id_usuario = l.id_usuario
    left join usuario d on d.id_usuario = l.id_destinatario
	left join chamado c on c.id_chamado = l.id_chamado
	left join cliente cl on cl.id_cliente = c.cliente_id
	left join sistema s on s.id_sistema = c.sistema_id
where ";
//$sql .= " acao in (1, 2, 3,  11,12) and ";
$sql .= " l.data >= '$UltimosDoisMeses' 
order by id desc limit 10";

$query = mysql_query($sql) or die (mysql_error());

echo "[";
  $c=0;
  while ($linha = mysql_fetch_object($query))
  {
    $data = AMD2DMA($linha->data) . "  " . $linha->hora;
	$nome = $linha->nome;
	$acao = $linha->acao;
	$IdContato = $linha->id_contato;
	$sistema = $linha->sistema;	
	$ConsultorId = $linha->cId;
	
//	$descricao = htmlentities( $linha->descricao);
	$descricao = $linha->descricao;


	/*
	if ($linha->acaoId == 12) {	
		if ($destinatario){
			$acao = "<a href=historicochamado.php?id_chamado=" . $linha->id_chamado . "#Id_". $IdContato . "> $acao </a>";
		}
	}
	if ($linha->acaoId == 11) {
		$destinatario = $linha->destinatario;
		if ($destinatario){
			$acao = "<a href=historicochamado.php?id_chamado=" . $linha->id_chamado . "#Id_". $IdContato . "> $acao para " . $destinatario . "</a>";
		}
	}
	*/

	
	$classDestinatario = "";	
	$lblLidoEu = "";
	
	if ($linha->destinatario_id == $ok)
	{
		
		$classDestinatario = "class=success";
		
		$lblLidoEu = "<span class=\"label label-danger\">!</span>";
		
		if ($linha->lido == 0) {	
			$lblLidoEu = "<span class=\"label label-success\">!</span> $lbLidoEu";
		}
	} 
	
	$lblLidoDestinatario = "";
	if ($ConsultorId == $ok)
	{
		if ($linha->lidodono == 0) {	
			$lblLidoDestinatario = "<span class=\"label label-warning\">*</span>";
		}	
	}

	if ($c) { 
		echo "}, ";
	}	
	echo "{ ";
	echo "\"chamado\" : \"$linha->id_chamado\", ";	
	echo "\"sistema\" : \"$linha->sistema\", ";		
	//echo "\"descricao\" : \"$descricao\", ";			
	echo "\"IdContato\" : \"$IdContato\", ";			
	echo "\"data\" : \"$data\", ";
	echo "\"nome\" : \"$nome\", ";
	echo "\"acao\" : \"$acao\", "; // $lblLidoEu $lblLidoDestinatario
	echo "\"cliente\" : \"$linha->cliente\" ";	
	$c++;
 }

echo "}]";
?>