<?
	require("cabeca.php");
    $UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 20  ) );
?>
<!DOCTYPE html>
<html lang="en">


  <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tudo</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


<style type="text/css">
<!--
	.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>

<script>
function filter2 (){
	var phrase = document.getElementById("textfield");
	var words = phrase.value.toLowerCase().split(" ");
	var table = document.getElementById("sf");
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


<body>
<div class="col-md-10">
	<h2>Movimentações do sad : <?= number_format(conn_ExecuteScalar("select count(1) from log"), 0, ',', '.')?> itens no log</h2>
</div>


<p>
<?
$ultimos = "limit 100";
if (isset($_GET["ultimos"]))
{
	$ultimos = "limit " . $_GET["ultimos"];
}
$sql = "select distinct c.id_chamado, left(cl.cliente, 20) cliente,
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
	when 15 then 'Fez login'
	when 127 then 'Outros'
  end acao,
  d.nome destinatario,
  c.destinatario_id,
  id_contato,
  s.sistema, st.status,  st.id_status,
  c.lido, c.lidodono, c.consultor_id cId, c.descricao, l.pagina
from
  log l
    inner join usuario u on u.id_usuario = l.id_usuario
    left join usuario d on d.id_usuario = l.id_destinatario
	left join chamado c on c.id_chamado = l.id_chamado
	left join cliente cl on cl.id_cliente = c.cliente_id
	left join sistema s on s.id_sistema = c.sistema_id
	left join status st on st.id_status = c.status
where ";
//$sql .= " acao in (1, 2, 3,  11,12) and ";
$sql .= " l.data >= '$UltimosDoisMeses'
order by id desc $ultimos";
$query = mysql_query($sql) or die (mysql_error());
?>
</p>
<p>
</p>


<div class="col-md-12">
	Filtrar:<label for="textfield"></label>  <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2()" value="<?=$_GET["filtro"]?>" /><br /><br />
</div>

<div class="col-md-12">
<table class="table table-condensed table-striped table-hover" id="sf">
<thead>
   <tr>
    <td >Contador</td>
    <th >Chamado</th>
    <th >Data Hora</th>
    <th >Usuário</th>
    <th >Ação</th>
    <th >Cliente</th>
    <th >Sistema</th>
  </tr>
</thead>
<tbody>
<?
  $c = 1;
  while ($linha = mysql_fetch_object($query))
  {

	$contador = sprintf("%03d", $c++);

    $data = AMD2DMA($linha->data) . "  " . $linha->hora;
	$nome = $linha->nome;
	$acao = $linha->acao;
	$IdContato = $linha->id_contato;
	$sistema = $linha->sistema;
	$ConsultorId = $linha->cId;
	$status = $linha->status;
	$idStatus = $linha->id_status;

	$descricao = htmlentities( $linha->descricao);

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

	$cliente = $linha->cliente;
	if ($linha->acaoId == 127)
	{
		$cliente = $linha->pagina;
		$sistema = "Acesso negado";
	} else if ($linha->acaoId == 15)
	{
		$sistema = "Login";
	}



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

	if ($idStatus==2) {
		$lblStatus = "<span class=\"label label-danger\">$status</span>";
	} else {
		$lblStatus = "<span class=\"label label-success\">$status</span>";
	}

?>
  <tr <?=$classDestinatario?>>
    <td ><?=$contador?></td>
    <td ><abbr title="<?=$descricao?>"> <a href=historicochamado.php?id_chamado=<?=$linha->id_chamado?>><?=$linha->id_chamado?>  </a> </abbr>  </td>
    <td ><?=$data?></td>
    <td ><?=$nome?></td>
    <td ><?=$acao?> <?="$lblLidoEu $lblLidoDestinatario"?></td>
    <td ><?=$cliente?></td>
    <td ><span class="label label-success"><?=$sistema?></span> <?=$lblStatus?> </td>
  </tr>
<?
  }
?>
</tbody>
</table>
</div>


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

	<script>
	filter2();
	</script>

</body>
</html>
