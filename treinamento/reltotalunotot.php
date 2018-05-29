<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');
?>
<html>
<!-- DW6 -->
<head>
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style5 {font-size: 9px}
#tabela th{
	background-color:#006699;
	font-weight:bold;
	color:#FFFFFF;
	font-size: 12px;
}
#tabela td{
	background-color:#DBF0EE;
	font-size: 12px;
}
</style>
<script>
function confirma(){ 
 	if (document.form.ano.value < 2000){ 
       alert("Ano deve ser maior que 2000") 
	   document.form.ano.focus();
	   return false; 
	   }
 	if (!document.form.ano.value){ 
       alert("Deve preencher o campo ano") 
	   document.form.ano.focus();
	   return false; 
	   }
else {
       document.form.submit();
} }	   
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form name="form" method="post" action="reltotalunotot.php" id="form">
	<table width="100%" border="0">
		<tr>
			<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center"><strong><span class="style8">Relat&oacute;rio totalizador</span></strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><table width="100%" border="0">
					<tr bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
						<td width="18%" bgcolor="#DBF0EE"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Selecione o ano:</font></td>
						<td width="82%" bgcolor="#DBF0EE"><select name="ano" id="ano">
							<?
																		$selx = array();
																		$selx[$ano] = 'selected';
																		for ($x=COMBOANOINI; $x<COMBOANOFIM; $x++){
																			echo "<option value='$x' ".$selx[$x].">$x</option>";
																		}
																	?>
						</select></td>
					</tr>
					<tr bordercolorlight='#FFCC30' bordercolordark='#FFCC30'>
						<td bgcolor='#DBF0EE'><font face="Verdana, Arial, Helvetica, sans-serif" size="1">Selecione o(s) m&oacute;dulo(s):</font></td>
						<td bgcolor='#DBF0EE'>
							<table>
								<tr>
									<td><?
$sistemas		= mysql_query("select * from sistemas");
$x = 1;
if (!$sis_sel){
	$sis = array(1,6,4,12);
}else{
	$sis = $sis_sel;
}

while ($lin_sis = mysql_fetch_object($sistemas)){

	if ($x > 1) echo "<td>";
	echo "<input type='checkbox' name='sis_sel[]' id='sis_sel[]' value='".$lin_sis->id."' ". ((in_array($lin_sis->id,$sis)) ? "checked" : "") .">".
	((in_array($lin_sis->id,$sis)) ? "<b>" : "") . $lin_sis->descricao . ((in_array($lin_sis->id,$sis)) ? "</b>" : "");

	if ($x++ % 4 == 0){
		echo "</td></tr>";
		$x = 1;
	}else{
		echo "</td>";
	}

	if ($x == 1) echo "<tr><td>";
}
?>									</td>
								</tr>
							</table></td>
					</tr>
			</table></td>
		</tr>
		<tr>
			<td><input name="submit" type="submit" value='Pesquisar'></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><table width='100%' border='0' id='tabela'>
					<?
if ($sis_sel){
	// cabeçalho dos sistemas
	$cont			= 0;
	$sistemaid		= array();
	$sistemas		= mysql_query("select * from sistemas where id in (".implode(',',$sis_sel).") order by id");
	$totsis			= mysql_num_rows($sistemas);

?>
					<tr>
						<th>Mês</th>
						<? while($sistema = mysql_fetch_object($sistemas)){
											$sistemaid[++$cont] = $sistema->id;;
									?>
						<th colspan='2'><?=$sistema->descricao ?></th>
						<? } ?>
						<th colspan='2'>Total / Mês</th>
					</tr>
					<?

// cabeçalho de tipo: empresas / alunos
?>
					<tr>
						<th>Tipo</th>
						<? for ($c=0; $c<=$cont; $c++){ ?>
						<th>Empresa</th>
						<th>Aluno</th>
						<? } ?>
					</tr>
					<?
	// corpo com os valores mensais por sistemas
	$totmensal = 0;
	for ($mes=1; $mes<=12; $mes++){

?>
					<tr>
						<th align="left"><?=$mesescrito[$mes] ?></th>
						<? 
		$subtotalalumes	= 0;
		$subtotalempmes	= 0;
		for ($c=1; $c<=$cont; $c++){
	
			$SQLalutot = "SELECT count(distinct(T.rg)) as total from tre_usuario as T".
									" left join modulos as M on M.id = T.modulo".
									" left join sistemas as S on S.id = M.cod_sistema".
									" where S.id = ".$sistemaid[$c].
									" and T.completo = 'S'".
									" and year(T.data) = ".$ano.
									" and  month(T.data) = ".$mes;
			$totais = mysql_query($SQLalutot);
			$totalalu = mysql_fetch_object($totais);
	
			$SQLemptot = "SELECT count(distinct(C.empnome)) as total from tre_usuario as T ".
									" left join cadastrotreinamento as C on C.rg = T.rg".
									" left join modulos as M on M.id = T.modulo".
									" left join sistemas as S on S.id = M.cod_sistema".
									" where S.id = ".$sistemaid[$c].
									" and T.completo = 'S'".
									" and year(T.data) = ".$ano.
									" and month(T.data) = ".$mes.
									" and C.empnome <> 'DESENVOLVIMENTO PROFISSIONAL'";
			$totais = mysql_query($SQLemptot);
			$totalemp = mysql_fetch_object($totais);
	
			$subtotalalumes	+= $totalalu->total;
			$subtotaisalu[$sistemaid[$c]] += $totalalu->total;
			$subtotalempmes	+= $totalemp->total;
			$subtotaisemp[$sistemaid[$c]] += $totalemp->total;
			
?>
						<td align="right"><?=$totalemp->total ?></td>
						<td align="right"><?=$totalalu->total ?></td>
						<?

	}
		$totalumensal		+= $subtotalalumes;
		$totempmensal		+= $subtotalempmes;
?>
						<th align="right"><?=$subtotalempmes ?></th>
						<th align="right"><?=$subtotalalumes ?></th>
					</tr>
					<? 
	}

}
// rodapé com os valores de subtotais e totais
?>
					<tr>
						<th align="left">Totais</th>
						<? 
for ($c=1; $c<=$cont; $c++){
?>
						<th align="right"><?=$subtotaisemp[$sistemaid[$c]] ?></th>
						<th align="right"><?=$subtotaisalu[$sistemaid[$c]] ?></th>
						<?
}
?>
						<th align="right"><?=$totempmensal ?></th>
						<th align="right"><?=$totalumensal ?></th>
					</tr>
				</table></td>
		</tr>
	</table>
	<table>
		<tr>
			<td><a href="treinamento.php" class="style5">Voltar</a></td>
		</tr>
	</table>
	<hr align="center">
	<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>
	</td>
	</tr>
	</table>
</form>
</body>
</html>
