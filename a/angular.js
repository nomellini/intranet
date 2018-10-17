<?
	require("cabeca.php");
    $UltimosDoisMeses = date("Y-m-d", time()-( 86400 * 0  ) );
?>
<!DOCTYPE html>
<html lang="en" ng-app="sadApp">
  <head>
    <meta charset=iso-8859-1>
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
	var words = document.getElementById('textfield').value.toLowerCase().split(" ");
	var table = document.getElementById('sf');
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


var Exec = (function () {
    "use strict";
    return {
        filter: (function () {
			var words = $('#textfield').val().toLowerCase().split(" ");
			var table = window.document.getElementById('sf');
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
        }())
    }
}());
</script>

  </head>


<body>

<div  ng-controller="sadCtrl" id="MainWrap">

<div class="col-md-10">
	<h2>Movimentação do sad</h2>
</div>

<div class="col-md-12">
	Filtrar:<label for="textfield"></label><input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2()" /><br /><br />
</div>

<div class="col-md-12">
{{c}}
<table class="table table-condensed table-striped table-hover" id="sf">
<thead>
   <tr>
    <th >Chamado</th>
    <th >Data Hora</th>
    <th >Usuário</th>
    <th >Ação</th>
    <th >Cliente</th>
    <th >Sistema</th>
  </tr>
</thead>
<tbody>
  <tr ng-repeat="linha in linhas">
    <td ><abbr title="{{linha.descricao}}"> <a href=historicochamado.php?id_chamado={{linha.chamado}}>{{linha.chamado}}</a> </abbr>  </td>
    <td >{{linha.data}}</td>
    <td >{{linha.nome}}</td>
    <td ><a href=historicochamado.php?id_chamado={{linha.chamado}}#Id_{{linha.IdContato}}> {{linha.acao}} </a></td>
    <td >{{linha.cliente}}</td>
    <td ><span class="label label-success">{{linha.sistema}}</span></td>
  </tr>
</tbody>
</table>
</div>
</div>
    <script src="js/angular.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/sad.js"></script>
</body>
</html>
