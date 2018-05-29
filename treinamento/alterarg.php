<?
//Autor: Lucas Oliveria Silva
//Data: 06/10/09
//Local: Datamace
//Função: Trocar o RG de pessoas que cadastraram errado

include_once ('cabeca.inc.php');

if($rgnovo && $rgatual && $acao == "alterar")
{

	$msg = "";
	$result = mysql_query("select count(0) as total from cadastrotreinamento where rg = '$rgnovo'");
	if ($linha == mysql_fetch_object($result))
	{
		if (!mysql_query("UPDATE respostas set rg = '$rgatual' where rg = '$rgnovo'; "))
		{
			$msg =  str_replace("'","\'",str_replace('"','\"','Erro ao atualizar os dados: ' . mysql_errno() . " - " . mysql_error()));
		}
		elseif(!mysql_query("UPDATE tre_usuario set rg = '$rgatual' where rg = '$rgnovo'; "))
		{
			$msg =  str_replace("'","\'",str_replace('"','\"','Erro ao atualizar os dados: ' . mysql_errno() . " - " . mysql_error()));
		}
		elseif(!mysql_query("delete from cadastrotreinamento where rg = '$rgnovo'; "))
		{
			$msg =  str_replace("'","\'",str_replace('"','\"','Erro ao atualizar os dados: ' . mysql_errno() . " - " . mysql_error()));
		}
	}
	else
	{
		if (!mysql_query("UPDATE cadastrotreinamento set rg = '$rgnovo' where rg = '$rgatual'; "))
		{
			$msg =  str_replace("'","\'",str_replace('"','\"','Erro ao atualizar os dados: ' . mysql_errno() . " - " . mysql_error()));
		}
	}
	if (!$msg)
	{
		if (!mysql_query("UPDATE respostas set rg = '$rgnovo' where rg = '$rgatual'; "))
		{
			$msg =  str_replace("'","\'",str_replace('"','\"','Erro ao atualizar os dados: ' . mysql_errno() . " - " . mysql_error()));
		}
		elseif(!mysql_query("UPDATE tre_usuario set rg = '$rgnovo' where rg = '$rgatual'; "))
		{
			$msg =  str_replace("'","\'",str_replace('"','\"','Erro ao atualizar os dados: ' . mysql_errno() . " - " . mysql_error()));
		}
		elseif(!mysql_query("delete from cadastrotreinamento where rg = '$rgatual'; "))
		{
			$msg =  str_replace("'","\'",str_replace('"','\"','Erro ao atualizar os dados: ' . mysql_errno() . " - " . mysql_error()));
		}
		else
		{
			$msg = 'Atualização Realizada com êxito';
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Datamace Inform&aacute;tica Ltda.</title>
<script language="JavaScript" src="numero.js" type="text/javascript"></script>
<script>
function confirma(){ 
	if (!document.getElementById('rgnovo').value){
		alert('Rg novo: Preenchimento obrigatório!');
		document.getElementById('rgnovo').focus();
		return false;
	}
    if (confirm('Confirma a alteração do RG?')) {
		document.form.acao.value="alterar";
		document.form.submit();
	}
} 

</script>
<style type="text/css">
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px;}
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style43 {font-size: 10px}
.style45 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #CCCCCC;}
.style47 {
	color: #006699;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style48 {
	color: #006699;
	font-weight: bold;
}
.style52 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form action="alterarg.php" method="post" name="form">
	<input type="hidden" name="acao" id="acao">
	<input type="hidden" name="linkPagina" id="linkPagina" value="<?=$linkPagina ?>">
	<input type="hidden" name="rgtipo" id="rgtipo" value="<?=$rgtipo ?>">

	<table width="100%" border="0">
		<tr>
			<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
		</tr>
		<tr>
			<td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td align="center"><strong><span class="style8">Altera&ccedil;&atilde;o de RG</span></strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><table width="100%" border="1">
				<tr>
					<td align="left"><table width="100%" border="0" align="center">
							<tr>
								<td colspan="3" class="thTreinamento">Altera&ccedil;&atilde;o de RG</th>
							</tr>
							<tr>
								<td width="12%">Rg atual:</td>
								<td width="88%" colspan="2"><input name="rgatual" readonly="readonly" type="text" id="rgatual" value="<? echo $rgatual ?>" onkeypress="return(numero(event,this));" size="23" />
										<span class="style43 style6">(Somente n&uacute;meros) </span></td>
							</tr>
							<tr>
								<td>RG novo :</td>
								<td colspan="2"><input name="rgnovo" type="text" id="rgnovo" value="" onkeypress="return(numero(event,this));" size="23" maxlength="20" /></td>
							</tr>
					</table></th>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input name="button" type="button" onclick="javascript:confirma()" value="Alterar" />
				<input name="button" type="button" onclick="window.location='mancadtre.php'" value="Voltar" /></td>
		</tr>
		<tr>
			<td><hr /></td>
		</tr>
		<tr>
			<td><table width="100%" border="0">
					<tr>
						<td width="90%"><span class="style45">Datamace Inform&aacute;tica Ltda. </span></td>
						<td width="10%"><span>
							<?=FORMULARIO_10 ?>
							</span></td>
					</tr>
				</table></td>
		</tr>
	</table>
</form>
<? if ($msg) echo "<script>alert('$msg')</script>"; ?>
</body>
</html>