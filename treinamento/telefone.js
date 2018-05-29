
//telefone.js
function mascaratel(objeto){
	if (objeto.value.indexOf("-") == -1 && objeto.value.length > 4){ objeto.value = ""; }
	if (objeto.value.length == 4){
		objeto.value += "-";
	}
}

