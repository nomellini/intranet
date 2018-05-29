// JavaScript Document
var app = angular.module('programasApp', []);

app.controller('ProgramaController', function ($scope, $http) {

	$scope.programas = [
					  {nome:'QG666', obs:'Teste 1'},
					  {nome:'Inicio.aspx', obs:'Teste 2'},
					  {nome:'Inicio.aspx.cs', obs:'Teste 3'}
					 ];
	
	$scope.addPrograma = function() {
		$scope.programas.push({nome:$scope.nm_nome, obs:$scope.ds_obs});
		$scope.nm_nome = "";
		$scope.ds_obs = "";
	}


	/*
	// Fun��o que atualiza os dados
    // Somente dispon�vel aqui dentro, n�o � m�todo p�blico
    function atualizaDados() {
        $http.get('http://192.168.0.14/a/historicochamadologlidosJson.php').
        success(function(data,  status, headers, config) {			
			$scope.c = $scope.c+1;
			$scope.linhas = data;						
        });		
    }
	*/

});


