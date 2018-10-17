<?
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

if	($adm != 'S'){
	$db = new DB();
	if ($db->getQuantidadeIP($ipremoto, "P", $id)){
		require ('negado.php');
		die();
	}
}

$tot_perguntas = 0;
if ($id) {
	if ($opcao == 'gravar'){
		include_once("altera_rotdp.php");
		die();
	}
	if ($rg){
		$result = mysql_query("select * from cadastrotreinamento where rg = $rg");
		if (!$linha = mysql_fetch_object($result)){
			$msg = "<script>alert('RG: $rg, não encontrado, se correto realize seu cadastro, senão clique em voltar e digite o RG correto. \\n Em caso de dúvidas, chame seu instrutor!');</script>";
			$link_prova = "aval_rotdp.php";
			include_once("cadtre.php");
			die();
		}
		$nome = $linha->nome;
		$empnome = $linha->empnome;
	}

	$prova = new treinamento($adm);
	$prova->RefAtual();
	$prova->rg			= $rg;
	$prova->materia		= $id;
	$prova->ver_pergunta();
	$nome_treinamento	= $prova->prova_desc;

	if ($rg){
		$cod_perguntas = $prova->perguntas1;
		$tot_perguntas	= count($cod_perguntas); // conta quantos registros tem na tabela
	}else{
		$empnome		= "";
		$nome			= "";
	}

}

$hoje = date("d/m/Y");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Datamace Inform&aacute;tica Ltda.</title>
   <link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
   <script language="JavaScript" src="newpopcalendar.js" type="text/javascript"></script>
   <script language="JavaScript" src="numero.js" type="text/javascript"></script>
   <script language="JavaScript" src="data.js" type="text/javascript"></script>
   <script language="JavaScript" type="text/javascript">
function confirma() {
	for (x=1; x<=<?=($tot_perguntas - 1) ?>; x++){

		var field	= "q" + x;
		var qtdtot	= document.getElementsByName(field).length;
		var qtd		= 0;

		for (y=0; y<qtdtot; y++){
			if (document.getElementsByName(field)[y]){
				if (!document.getElementsByName(field)[y].checked){
					qtd++;
				}
			}
			if (qtd == qtdtot){
			 	this.location = "#campo" + x;
				alert ("Verifique a questão: "  + x + " \n Preenchimento Obrigatório!");
				return false;
			}
		}
	}
	
	if (!document.getElementById('rg').value){
		alert ("Rg: Preenchimento Obrigatório! ");
		document.getElementById('rg').focus();
		return false;
	}
	
	if (!document.getElementById('opcao').value){
		return procura();
	}
	
	if (confirm('Tem certeza que deseja enviar os dados ?')){
		document.getElementById('opcao').value = 'gravar';
		document.form.submit();
	}
}

function procura() {
	document.getElementById('opcao').value = 'rg';
	document.form.submit();
	return true;
}

function fun_focus(){
	if (document.getElementById('rg').type == 'text'){
		document.getElementById('rg').focus()
	}
}

   </script>
   </head>
   <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="fun_focus();">
<table width="100%" border="0">
	<tr>
		<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
	</tr>
</table>
<p class="TituloTreino"><? echo $nome_treinamento; ?></p>
<p align="center" class="style5">AVALIA&Ccedil;&Atilde;O DE PR&Eacute;-REQUISITOS</p>
<form action="aval_rotdp.php" method="post" name="form" id="form" onsubmit="return confirma()">
	<input type="hidden" name="adm" id="adm" value="<?=$adm ?>">
	<input type="hidden" name="opcao" id="opcao" value="<?=$opcao ?>">
	<input type="hidden" name="linkPagina" id="linkPagina" value="<?=$linkPagina ?>" />
	<input type="hidden" name="id" id="id" value="<?=$id ?>" />
	<input type="hidden" name="tipo" id="tipo" value="<?=$tipo ?>" />
	<input type="hidden" name="provanro" id="provanro" value="<?=$provanro ?>" />
	<table width="80%" border="0" align="center">
		<tr>
			<td>Rg: </td>
			<td width="39%"><input name="rg" type="<? if (!$rg){ ?>text<? }else{ ?>hidden<? } ?>" id="rg" size="30" maxlength="150" / value="<?=$rg ?>" onkeypress="return(numero(event,this));" autocomplete="off"/>
				<?=$rg; ?></td>
			<td width="44%"><? if (!$tot_perguntas){ ?>
				<input type="button" onclick="javascript:procura()" value="Pesquisar" />
				<? } ?></td>
		</tr>
		<tr>
			<td width="17%">Nome da Empresa:</td>
			<td colspan="2"><input name="empnome" id="empnome" type="hidden" value="<? echo $empnome ?>">
				<? echo $empnome ?></td>
		</tr>
		<tr>
			<td>Nome do Treinando:</td>
			<td colspan="2"><input name="nome" id="nome" type="hidden" value="<? echo $nome ?>">
				<? echo $nome ?></td>
		</tr>
		<tr>
			<td>Data da prova:</td>
			<td colspan="2"><input name="dataprova" type="hidden" id="dataprova" value="<? echo $hoje ?>">
				<?=$hoje ?></td>
		</tr>
		<tr>
			<td>Tipo de Prova:</td>
			<td colspan="2"><?= ($tipo == 1 ? 'Avaliação Interna' : ($tipo == 2 ?  'Avaliação Externa' : 'Avaliação Externa - Cliente')); ?></td>
		</tr>
	</table>
	<br />
	<br />
	<table width="80%" border="0" align="center">
		<?
for ($x=0;$x < $tot_perguntas;$x++) {

	if (!$cod_perguntas[$x]) continue;
	
	$result = mysql_query("select * from perguntas where id = $cod_perguntas[$x];");
	$linha = mysql_fetch_object($result);

	$cod_pergunta = $linha->id; 

?>
		<tr>
			<td class="thTreinamento" style="text-align:left"><a name="campo<?=$x+1 ?>" id="campo<?=$x ?>"></a>
				<input type="hidden" name="perguntas[]" id="perguntas[]" value="<?=$cod_perguntas[$x] ?>" />
				<? echo $x+1 . " - " . $linha->descricao ?></td>
		</tr>
		<tr>
			<td><?
  if ($linha->opcao_a) {
 ?>
				<input type="radio" name="q<?=$x+1 ?>" id="q<?=$x+1 ?>" value="a" />
				<? echo $linha->opcao_a ?><br />
				<?
  }
  if ($linha->opcao_b) {
 ?>
				<input type="radio" name="q<?=$x+1 ?>" id="q<?=$x+1 ?>" value="b" />
				<? echo $linha->opcao_b ?><br />
				<?
  }
  if ($linha->opcao_c) {
 ?>
				<input type="radio" name="q<?=$x+1 ?>" id="q<?=$x+1 ?>" value="c" />
				<? echo $linha->opcao_c ?><br />
				<?
  }
  if ($linha->opcao_d) {
 ?>
				<input type="radio" name="q<?=$x+1 ?>" id="q<?=$x+1 ?>" value="d" />
				<? echo $linha->opcao_d ?><br />
				<?
  }
}

?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><? if ($tot_perguntas){ ?>
				<input type="button" onclick="javascript:confirma()" value="Enviar" />
				<? } ?>
				<input type="button" onclick="window.location = '<?=$linkPagina ?>'" value="Voltar" /></td>
		</tr>
	</table>
</form>
<hr />
<table width="100%" border="0">
	<tr>
		<td width="90%">Datamace Inform&aacute;tica Ltda. </td>
		<td width="10%"><?=($id == 3 || $id == 4 ? FORMULARIO_29 : FORMULARIO_16) ?></td>
	</tr>
</table>
</body>
</html>
<?=$msg ?>