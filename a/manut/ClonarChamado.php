<form action="ClonarChamadoDo.php" method="post" name="form" >
	Chamado Atual 
	  <input name="chamado_origem" type="text" id="chamado_atual">
  <br>
	Chamado Destino
    <label>
    <input name="chamado_destino" type="text" id="chamado_destino">
    </label>
    <br>
    <label>
    <input type="button" name="Submit" value="Submit" onClick="vai()">
    </label>
</form>
<p>Chamados disponíveis para o dia 
<?php echo $_GET['dataa']; ?><br>
<?php 
	require_once('../../Connections/sad.php'); 
	mysql_select_db(sad) or die(mysql_error());
?>	
<br>
<?

	$sql = "select id_chamado, horaa from chamado where dataa = '$dataa' order by id_chamado";
	$result = mysql_query($sql) or die (mysql_error());
	$linha = mysql_fetch_object($result);

	$chamado_anterior = $linha->id_chamado;
	$hora_anterior = $linha->horaa;
	while ($linha = mysql_fetch_object($result))
	{
		$chamado_atual = $linha->id_chamado;
		$hora_atual = $linha->horaa;
		$diff = $chamado_atual - $chamado_anterior;
		if ($diff > 1) {
			for ($i = ($chamado_anterior + 1); $i < $chamado_atual; $i++) {
?>		
				<a href="javascript:marca('<?=$i?>');"><?=$i?> - <?=$hora_anterior?></a><br>		
<?			
			}	
		}			
		$chamado_anterior = $chamado_atual;
		$hora_anterior = $hora_atual;
	}	

?>
  
<script language="javascript">
	function marca(id) {
		document.form.chamado_destino.value = id;
	}
	
	
	function vai() {
		if ( window.confirm("Clonar " + document.form.chamado_origem.value + " no " + document.form.chamado_destino.value + " ? ")) {
			document.form.submit();
		} else {
			return false;
		}
		
	}
	
</script>