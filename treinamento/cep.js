
//cep.js
function mascaraCep(objeto){
	if (objeto.value.indexOf("-") == -1 && objeto.value.length > 5){ objeto.value = ""; }
	if (objeto.value.length == 5){
		objeto.value += "-";
	}
}

