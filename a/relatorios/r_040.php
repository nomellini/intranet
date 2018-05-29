<?	
	require("../cabeca.php");
	$sql = "select c2.id_chamado, left(c2.descricao, 100) descricao, count(1) qtde
       from chamado c
            inner join chamado c2 on c2.id_chamado = c.Id_chamado_espera
where 
      c2.status <> 1
group by c2.id_chamado, left(c2.descricao, 100)
order by count(1) desc";
	$result = mysql_query($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset=iso-8859-1>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chamados com depend&ecirc;ncia</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">


<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>


<body>

<div  id="MainWrap">

<div class="col-md-10">
	<h2>Chamados com depend&ecirc;ncias</h2>
</div>


<div class="col-md-12">
<table class="table table-condensed table-striped table-hover" id="sf">
<thead>
   <tr>
    <th >Chamado</th>  
    <th >Descri&ccedil;&atilde;o</th>
    <th >Dependentes</th>
  </tr>
</thead>  
<tbody>
	<? while($linha = mysql_fetch_object($result)) { ?>
  <tr ng-repeat="linha in linhas">
    <td > <a href=../historicochamado.php?id_chamado=<?=$linha->id_chamado ?>> <?=$linha->id_chamado ?> </a> </abbr>  </td>  
    <td ><?=$linha->descricao ?></td>
    <td align="center"><?=$linha->qtde ?></td>
  </tr>
	<? } ?>  
</tbody>
</table>
</div>
</div>	


<div class="col-md-12">
	<hr />
	<a href="index.php">Voltar para Relatórios</a>
</div>


    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>