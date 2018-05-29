<?
	require("scripts/conn.php");		
	require("scripts/funcoes.php");	  	
	$id_chamado = 315175;
	$id_chamado = 380122;
?>
<form name="teste" id="teste">
<?
	$restricoesUsuario = funcoesObterRestricaoChamadoUsuario(12, $id_chamado);
	if (count($restricoesUsuario)>0) {
?>              
<?	
	foreach ($restricoesUsuario as $linha) {
?>
	<input <?php if (!(strcmp($linha["ok"],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="IdsRestricoes[]" id="IdsRestricoes[]" value="<?=$linha["id"]?>"/><?=$linha["descricao"]?><br>    
<?
		}
	}
?> 
    <input type="button" onClick="validaRestricoes()" value="validaRestricoes">
</form>

<?
    $r = funcoesObterStatusRestricao($id_chamado);
	$ok = $r["ok"];	
	$r = $r["impede"];		

	print_r($ok);	
?>


<script>


function validaRestricoes()
{
	
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};	
	
	
	var lista = new Array();	
	<? foreach ($r as $linha) { ?>lista["<?=$linha["id"]?>"] = "<?=$linha["descricao"]?>";<? }?>
	
	var listaok = new Array();
	<? foreach ($ok as $linha) { ?>listaok["<?=$linha["id"]?>"] = "<?=$linha["descricao"]?>";<? }?>
	
	
	var validacao = new Array();
	var chk_arr =  document.getElementsByName("IdsRestricoes[]");
	var chklength = chk_arr.length;
	var tenho = 0;
	
	
	
	var mensagem = "";
	

    for (key in listaok) {		
		var encontrei = false;
		for(k=0;k< chklength;k++)
		{
			if (chk_arr[k].value == key)
			{	
				encontrei = true;
				index = k;
			}		
		}									
		if (encontrei) {
			if (chk_arr[index].checked == false)
			{							
				mensagem = mensagem + listaok[key] + "\n";
			}
		}		
    }	





    for (key in lista) {		
		var encontrei = false;
		for(k=0;k< chklength;k++)
		{
			if (chk_arr[k].value == key)
			{	
				if (chk_arr[k].checked == true)
				{							
					encontrei = true;
				}
			}		
		}							
		
		if (!encontrei) {
			mensagem = mensagem + lista[key] + "\n";
		}		
    }	
	
	if (mensagem!="")
	{
		alert("Restricoes pendentes: \n\n" + mensagem);
		return false;
	} else {
		return true;		
	}
}
	

</script>
