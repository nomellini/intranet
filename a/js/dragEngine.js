function setDrag(Chamado, Contato)
{
	document.drag1.id_chamado.value = Chamado;
	document.drag1.id_contato.value = Contato;			
}

function OnDragStart1 (event) {
	id_chamado = document.drag1.id_chamado.value;
	link = "Chamado [" + id_chamado + "]";
	event.dataTransfer.setData ("text/plain", link);
	return true;
}


function OnDragStart2 (event) {
	id_chamado = document.drag1.id_chamado.value;
	link = "Chamado [" + id_chamado + "] - http://192.168.0.14/a/historicochamado.php?id_chamado=" + id_chamado;
	event.dataTransfer.setData ("text/plain", link);
	return true;
}

 function OnDragStart3 (event) {
	id_chamado = document.drag1.id_chamado.value;			
	id_contato = document.drag1.id_contato.value;			
	link = "Chamado [" + id_chamado + ", " + id_contato + "] - http://192.168.0.14/a/historicochamado.php?id_chamado=" + id_chamado+"#c_"+id_contato;
	event.dataTransfer.setData ("text/plain", link);
	return true;
}


function OnDragStart (event) {
	id_chamado = document.drag1.id_chamado.value;
	id_contato = document.drag1.id_contato.value;
	link = "Chamado [" + id_chamado + ", " + id_contato + "]";
	event.dataTransfer.setData ("text/plain", link);
	return true;
}