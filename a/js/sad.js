// JavaScript Document
var app = angular.module('sadApp', []);
app.controller('sadCtrl', function ($scope, $http) {

	$scope.c = 0;

	$antes = "[]";
    // Função que atualiza os dados
    // Somente disponível aqui dentro, não é método público
    function atualizaDados() {
        $http.get('http://192.168.0.14/a/historicochamadologlidosJson.php').
        success(function(data,  status, headers, config) {			
			$scope.c = $scope.c+1;
			$scope.linhas = data;						
        });
		
		//Exec.filter();
    }

    // Executa a função na inicalização
    atualizaDados();

    // Altere o intervalo para o que achar mais adequado.
    setInterval(atualizaDados, 5000);
});


function filtraTabela (phrase, _id){
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
