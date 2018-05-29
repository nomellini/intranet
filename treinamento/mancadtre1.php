<?
$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
include_once ('cabeca.inc.php');

if ($rg) {
	$action = "Alteração";
} else {
	$action = "Inclusão";
}

if($id_opc == "33"){

	mysql_query("DELETE from tre_usuario where id = '$idtreino'");  

	mysql_query("DELETE from sad.treinados where id_treinamento = '$idtreino'");

}elseif ($id_opc == "34"){

	if ($prova_tipo == "E"){
		mysql_query("DELETE from respostas where id = '$idtreino'");  
	}elseif ($prova_tipo == "I"){
		mysql_query("DELETE from respostasint where id = '$idtreino'");  
	}

}elseif ($id_opc == "3"){

	mysql_query("DELETE from cadastrotreinamento WHERE rg = '$rg'");
	$result = mysql_query("select id from tre_usuario WHERE rg = '$rg'");
	while ($linha = mysql_fetch_object($result)){
		mysql_query("DELETE from sad.treinados WHERE id_treinamento = '".$linha->id."'");
	}

	mysql_query("DELETE from tre_usuario WHERE rg = '$rg'");

	$rg = "";

}elseif ($id_opc == "2"){

	$nome			= strtoupper($nome); 
	$cargo			= strtoupper($cargo); 
	$areaatuacao	= strtoupper($areaatuacao); 
	$tempoarea		= strtoupper($tempoarea); 
	$superiordireto	= strtoupper($superiordireto); 
	$cargosuperior	= strtoupper($cargosuperior); 
	$empnome		= strtoupper($empnome); 
	$emprua			= strtoupper($emprua); 
	$empbairro		= strtoupper($empbairro); 
	$empcidade		= strtoupper($empcidade); 

	$SQLrg = "select rg from cadastrotreinamento where rg = '$rg'";
	$retorno = mysql_query($SQLrg);
	if (mysql_num_rows($retorno) == 0){
		$msgok = 'I';
		mysql_query("INSERT into cadastrotreinamento (rg, nome, cargo , areaatuacao, tempoarea, superiordireto, cargosuperior, hoje, empnome, emprua, empnumero, empbairro, empcep, empcidade, empestado,empddd, empfone, email, instrutor) VALUES ('$rg', '$nome','$cargo', '$areaatuacao', '$tempoarea', '$superiordireto', '$cargosuperior', '".date('Y-m-d')."', '$empnome', '$emprua', '$empnumero', '$empbairro', '$empcep', '$empcidade', '$empestado', '$empddd', '$empfone', '$email', '$instrutor');");
	} else {
		$msgok = 'U';
   		mysql_query("UPDATE cadastrotreinamento set nome='$nome', cargo='$cargo', areaatuacao='$areaatuacao', tempoarea='$tempoarea', superiordireto='$superiordireto', cargosuperior='$cargosuperior', empnome='$empnome', emprua='$emprua', empnumero='$empnumero', empbairro='$empbairro', empcep='$empcep', empcidade='$empcidade', empestado='$empestado', empddd='$empddd', empfone='$empfone', email='$email', instrutor='$instrutor' where rg = $rg");
	}
	$retorno = mysql_query($SQLrg);
	if (mysql_num_rows($retorno) != 0){
	
		for ($x=0; $x<count($data); $x++ ){
			$data[$x] = substr($data[$x],6,4) . '-' . substr($data[$x],3,2) . '-' . substr($data[$x],0,2);
			$result = mysql_query("UPDATE tre_usuario set data='$data[$x]', modulo='$modulo[$x]', descricao='$descricao[$x]', completo='$completo[$x]', instrutor='$instrutor[$x]' where id = '$id_tre[$x]'");  
		}

		for ($x=0; $x<count($data); $x++){
			$cargo = strtoupper($cargo); 
			$empnome = strtoupper($empnome); 
			if ($descricao[$x]){
			switch ($descricao[$x]){
					case 1:
						$conceito = 'APROVADO';
						break;
					case 2:
						$conceito = 'REPROVADO';
						break;
					case 3:
						$conceito = 'NÃO SE APLICA';
						break;
				}
				$result = mysql_query("select id_treinamento from sad.treinados where id_treinamento = '$id_tre[$x]'");
				$sqlSistema = "(select cod_sistema from treinamento.modulos as B where B.id = $modulo[$x])";
				if(mysql_num_rows($result) == 0){
					mysql_query("INSERT into sad.treinados (cliente, email, sistema , nome , cargo , conceito , data , rg, id_treinamento) VALUES ('$empnome', '$email', $sqlSistema, '$nome', '$cargo', '$conceito', '$data[$x]', '$rg', $id_tre[$x])");
				}else{
					mysql_query("UPDATE sad.treinados set cliente = '$empnome', email = '$email', sistema = $sqlSistema, nome = '$nome', cargo = '$cargo', conceito = '$conceito', data = '$data[$x]', rg = '$rg' where id_treinamento = '$id_tre[$x]'");
				}
			}
		}	
	}
}elseif ($id_opc == "99"){
	$rg = "";
}

if ($id_opc == 1){

	$result = mysql_query("select *, date_format(hoje,'%d/%m/%Y') as hoje from cadastrotreinamento where rg = $rg");
	if ($linha = mysql_fetch_object($result)){
		$rg = $linha->rg;
		$nome = $linha->nome;
		$cargo = $linha->cargo;  
		$areaatuacao = $linha->areaatuacao;
		$tempoarea = $linha->tempoarea;
		$superiordireto = $linha->superiordireto;
		$cargosuperior = $linha->cargosuperior;
		$dataCadastro = $linha->hoje;
		$empnome = $linha->empnome;
		$emprua = $linha->emprua;
		$empnumero = $linha->empnumero;
		$empbairro = $linha->empbairro;
		$empcep = $linha->empcep;
		$empcidade = $linha->empcidade;  
		$empestado = $linha->empestado;
		$empddd = $linha->empddd;    
		$empfone = $linha->empfone;  
		$email = $linha->email;  
		$instrutor = $linha->instrutor;
		$tot_rg = count($rg);
	}else{
		$rgNovo = $rg;
		$rg = "";
	}
}

if (!$rg){
	$rg = $rgNovo;
	$nome = "";
	$cargo = "";  
	$areaatuacao = "";
	$tempoarea = "";
	$superiordireto = "";
	$cargosuperior = "";
	$dataCadastro = date('d/m/Y');
	$empnome = "";
	$emprua = "";
	$empnumero = "";
	$empbairro = "";
	$empcep = "";
	$empcidade = "";  
	$empestado = "";
	$empddd = "";    
	$empfone = "";  
	$email = "";  
	$instrutor = "";
}


$ModulosID = array();
$result = mysql_query("select id, descricao from modulos");
while ($linha = mysql_fetch_object($result)){
	$ModulosID[$linha->id] = $linha->descricao;
}

$InstrutorID = array();
$result = mysql_query("select distinct(instrutor) as instrutor from tre_usuario ORDER BY instrutor");
while ($linha = mysql_fetch_object($result)){
	$InstrutorID[$linha->instrutor] = $linha->instrutor;
}

$result2 = mysql_query("SELECT *, date_format(data,'%d/%m/%Y') as data FROM tre_usuario where rg = '$rg'");
$result3 = mysql_query("SELECT respostas.id, perg, resp, date_format(dataprova,'%d/%m/%Y') as dataprova, cod_prova, provas.descricao as descricao, provanro, ip, date_format(resp_hora,'%h:%i') as hora FROM respostas
       left join provas on cod_prova = provas.id
	   where respostas.rg = '$rg'
       ORDER BY cod_prova, provanro");
	   
$result4 = mysql_query("SELECT respostasint.id, perg, resp, date_format(dataprova,'%d/%m/%Y') as dataprova, cod_prova, provas.descricao as descricao, provanro, ip, date_format(resp_hora,'%h:%i') as hora FROM respostasint
       left join provas on cod_prova = provas.id
	   where respostasint.rg = '$rg'
       ORDER BY cod_prova, provanro");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<link rel="stylesheet" href="../scripts/jquery.autocomplete.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" src="../scripts/jquery.autocomplete.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script>

	var a_fields = {
		'rg':{'r':true,'f':'integer'},
		'nome':{'r':true},
		'cargo':{'r':true},
		'areaatuacao':{'r':true},
		'tempoarea':{'r':true},
		'superiordireto':{'r':true},
		'cargosuperior':{'r':true},
		'email':{'r':true,'f':'email'},
		'empnome':{'r':true},
		'emprua':{'r':true},
		'empnumero':{'r':true,'f':'integer'},
		'empbairro':{'r':true},
		'empcep':{'r':false,'f':'cep'},
		'empcidade':{'r':true},
		'empestado':{'r':true},
		'empddd':{'r':true,'f':'integer'}
	},
	o_config = {
		'to_disable' : ['BTNGravar', 'BTNVoltar', 'BTNExcluir'],
		'alert' : 3
	};
	var v = new validator('form', a_fields, o_config);

	function Gravar(){
		return true;
	}

	function excluir_treinamento(numero){
		if (confirm('Tem certeza que deseja excluir o Treinamento?')){
			$('#idtreino')[0].value = numero;
			fun_submit(33);
		}
	}
	
	function excluir_prova(tipo,numero){
		if (confirm('Tem certeza que deseja excluir a Prova?')){
			$('#prova_tipo')[0].value = tipo;
			$('#idtreino')[0].value = numero;
			fun_submit(34);
		}
	}
	
	$().ready(function(){
		$("#empnome").autocompleteArray([<? fun_autocomplete('empresa') ?>]);
	});

</script>
<!-- #EndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF
}
.style2 {
	font-size: 18px;
	font-weight: normal;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
.style3 {
	color: #000099
}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
	<table width="100%" border="0">
		<tr>
				<td>
			<table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC38" class="bgTabela" bordercolor="#FF0000">
				<tr align="center" valign="middle">
					<td width="17%"><div align="center" class="style1">
							<div align="left"><a href="http://www.datamace.com.br"><img src="../imagens/novologo.jpg" width="155" height="41" border="0"> </a></div>
						</div></td>
					<td width="60%" valign="middle"><p class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" class="style2">Intranet 
							DATAMACE</font></p></td>
					<td width="23%" valign="bottom" align="right"><span class="style1"><font size="1"> <font class="unnamed1"> 
						<script language="JavaScript">
      var diasemana = new Array;
      var mesescrito = new Array;   
      diasemana[1] = "Segunda-feira";
      diasemana[2] = "Terça-feira";
      diasemana[3] = "Quarta-feira";
      diasemana[4] = "Quinta-feira";
      diasemana[5] = "Sexta-feira";
      diasemana[6] = "Sábado";
      diasemana[0] = "Domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();   
     document.write (diasemana[diaindex] + '<br>' + dia + ' de ' + mesescrito[mes] + ' de ' + ano);

              </script> 
						</font> </font></span></td>
				</tr>
			</table>
			<table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
				<tr>
						<td width="77%" align="left" valign="top" bgcolor="#FFFFFF">
					<!-- #BeginEditable "Centro" -->
					<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form" id="form" >
						<input type="hidden" name="id" id="id" value="<?=$id ?>">
						<input type="hidden" name="prova_tipo" id="prova_tipo">
						<input type="hidden" name="idtreino" id="idtreino">
						<input type="hidden" name="id_opc" id="id_opc">
						<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
						<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
						<p>&nbsp;</p>
						<p class="TituloTreino" align="center">Manuten&ccedil;&atilde;o do Cadastro Pessoal</p>
						<table width="100%" border="0">
							<tr>
								<td colspan="4" class="thTreinamento">Cadastro Pessoal</td>
							</tr>
							<tr>
								<td id="e_rg">Rg:</td>
								<td width="291"><input type="text" name="rg" id="rg" maxlength="20" value="<?=$rg ?>" class="TXTLOAD" help="treinando" helpid_opc="1" pri_focu="S"></td>
								<td align="right">Data de Cadastro: </td>
								<td width="64"><?=$dataCadastro ?></td>
							</tr>
							<tr>
								<td width="118" id="e_nome">Nome:</td>
								<td colspan="3"><input name="nome" type="text" id="nome" value="<?=$nome ?>" size="50" maxlength="150" /></td>
							</tr>
							<tr>
								<td width="118" id="e_cargo">Cargo:</td>
								<td colspan="3"><input name="cargo" type="text" id="cargo" value="<?=$cargo ?>" size="50" maxlength="50" /></td>
							</tr>
							<tr>
								<td width="118" id="e_areaatuacao">&Aacute;rea de Atua&ccedil;&atilde;o:</td>
								<td colspan="3"><input name="areaatuacao" type="text" id="areaatuacao" value="<?=$areaatuacao ?>" size="50" maxlength="50" /></td>
							</tr>
							<tr>
								<td width="118" id="e_tempoarea">Tempo na &aacute;rea:</td>
								<td colspan="3"><input name="tempoarea" type="text" id="tempoarea" value="<?=$tempoarea ?>" size="50" maxlength="15" /></td>
							</tr>
							<tr>
								<td width="118" id="e_superiordireto">Nome do Sup. Direto:</td>
								<td colspan="3"><input name="superiordireto" type="text" id="superiordireto" value="<?=$superiordireto ?>" size="50" maxlength="150" /></td>
							</tr>
							<tr>
								<td width="118" id="e_cargosuperior">Cargo do seu Superior:</td>
								<td colspan="3"><input name="cargosuperior" type="text" id="cargosuperior" value="<?=$cargosuperior ?>" size="50" maxlength="50" /></td>
							</tr>
							<tr>
								<td id="e_email">E-mail:</td>
								<td colspan="3"><input name="email" type="text" id="email" value="<?=$email ?>" size="50" maxlength="50" /></td>
							</tr>
						</table>
						<table width="100%" border="0">
							<tr>
								<td colspan="4" class="thTreinamento">Endere&ccedil;o da Empresa</td>
							</tr>
							<tr>
								<td id="e_empnome">Nome da Empresa:</td>
								<td colspan="3"><input name="empnome" type="text" id="empnome" value="<?=$empnome ?>" size="50" maxlength="150" /></td>
							</tr>
							<tr>
								<td width="17%" id="e_emprua">Rua:</td>
								<td width="49%"><input name="emprua" type="text" id="emprua" value="<?=$emprua ?>" size="50" maxlength="150" /></td>
								<td width="7%" id="e_empnumero">N&uacute;mero:</td>
								<td width="27%"><input name="empnumero" type="text" class="TXTINT" id="empnumero" value="<?=$empnumero ?>" size="10" maxlength="6" /></td>
							</tr>
							<tr>
								<td id="e_empbairro">Bairro:</td>
								<td><input name="empbairro" type="text" id="empbairro" value="<?=$empbairro ?>" size="50" maxlength="150" /></td>
								<td id="e_empcep">Cep:</td>
								<td><input name="empcep" type="text" class="TXTCEP" id="empcep" value="<?=$empcep ?>" size="10" maxlength="9"/></td>
							</tr>
							<tr>
								<td id="e_empcidade">Cidade:</td>
								<td><input name="empcidade" type="text" id="empcidade" value="<?=$empcidade ?>" size="50" maxlength="50" /></td>
								<td id="e_empestado">Estado:</td>
								<td><?=fun_select($aSiglaEstado,$empestado,'empestado','','','class="style4"') ?></td>
							</tr>
							<tr>
								<td id="e_empddd">(DDD) Telefone:</td>
								<td><input name="empddd" type="text" id="empddd" value="<?=$empddd ?>" class="TXTINT" size="4" maxlength="3"/>
									<input name="empfone" type="text" id="empfone" value="<?=$empfone ?>" class="TXTTELSIMPLES" size="42" maxlength="9"/></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
						<table width="100%" border="0">
							<tr>
								<td colspan="6" class="thTreinamento">Treinamentos</td>
							</tr>
							<tr>
								<th width="20%">Data</th>
								<th width="18%">Treinamento</th>
								<th width="13%">Instrutor</th>
								<th width="23%">Treina. Completo</th>
								<th width="20%">Conceito</th>
								<th width="6%">Excluir</th>
							</tr>
							<tr>
								<?
while ($linha = mysql_fetch_object($result2)) {
	$id = $linha->id;
	$rg = $linha->rg;
	$data = $linha->data;
	$modulo = $linha->modulo;
	$instrutor = $linha->instrutor;
	$completo = $linha->completo;
	$descricao = $linha->descricao;
?>
								<td class="style4 style52"><input type="hidden" name="id_tre[]" value="<?=$id ?>"/>
									<input name="data[]" type="text" id="data<?=$id ?>" size="12" value="<?=$data ?>" class="TXTDATE" calendario="S" /></td>
								<td><?=fun_select($ModulosID,$modulo,'modulo[]','','','class="style4"') ?></td>
								<td><?=fun_select($InstrutorID,$instrutor,'instrutor[]','','','class="style4"') ?></td>
								<td><?=fun_select($aSN,$completo,'completo[]','','','class="style4"') ?></td>
								<td><?=fun_select($aStatusTreino,$descricao,'descricao[]','','','class="style4"') ?></td>
								<td><input name="Excluir" type="button" id="Excluir" onclick="javascript:excluir_treinamento(<?=$id ?>)" value="Excluir" /></td>
							</tr>
							<? } ?>
						</table>
						<? if (mysql_num_rows($result3)){ ?>
						<table width="100%" border="0">
							<tr>
								<td colspan="8" class="thTreinamento">Provas Realizadas (Externo)</td>
							</tr>
							<tr>
								<th width="6%">Id</th>
								<th width="16%">Data</th>
								<th width="43%">Prova</th>
								<th width="13%">N&uacute;mero da Prova</th>
								<th width="8%">Perguntas</th>
								<th width="8%">Respostas</th>
								<th width="6%">Excluir</th>
							</tr>
							<tr>
								<?

 while ($linha = mysql_fetch_object($result3)) {
      $id			= $linha->id;
      $data			= $linha->dataprova;
      $hora			= $linha->hora;
      $cod_prova	= $linha->cod_prova;
	  $descricao	= $linha->descricao;
      $provanro		= $linha->provanro;
	  $perg			= $linha->perg;
      $resp			= $linha->resp;
	  $ip			= $linha->ip;

?>
								<td align="left"><?=$id ?></td>
								<td align="left"><?=$data . ' - ' . $hora ?></td>
								<td align="left"><?=$cod_prova . ' - ' . $descricao ?></td>
								<td align="center"><?=$provanro ?></td>
								<td align="center"><?=(($perg) ? "<img src='imagens\ok1.gif' border='0'>" : "") ?></td>
								<td align="center"><?=(($resp) ? "<img src='imagens\ok1.gif' border='0'>" : "") ?></td>
								<td><input name="Excluir" type="button" id="Excluir" onclick="javascript:excluir_prova('E',<?=$id ?>)" value="Excluir" /></td>
							</tr>
							<? } ?>
						</table>
						<? } ?>
						<? if (mysql_num_rows($result4)){ ?>
						<table width="100%" border="0">
							<tr>
								<td colspan="8" class="thTreinamento">Provas Realizadas (Interno)</td>
							</tr>
							<tr>
								<th width="6%">Id</th>
								<th width="16%">Data</th>
								<th width="43%">Prova</th>
								<th width="13%">N&uacute;mero da Prova</th>
								<th width="8%">Perguntas</th>
								<th width="8%">Respostas</th>
								<th width="6%">Excluir</th>
							</tr>
							<tr>
								<?

 while ($linha = mysql_fetch_object($result4)) {
      $id			= $linha->id;
      $data			= $linha->dataprova;
      $hora			= $linha->hora;
      $cod_prova	= $linha->cod_prova;
	  $descricao	= $linha->descricao;
      $provanro		= $linha->provanro;
	  $perg			= $linha->perg;
      $resp			= $linha->resp;
	  $ip			= $linha->ip;

?>
								<td align="left"><?=$id ?></td>
								<td align="left"><?=$data . ' - ' . $hora ?></td>
								<td align="left"><?=$cod_prova . ' - ' . $descricao ?></td>
								<td align="center"><?=$provanro ?></td>
								<td align="center"><?=(($perg) ? "<img src='imagens\ok1.gif' border='0'>" : "") ?></td>
								<td align="center"><?=(($resp) ? "<img src='imagens\ok1.gif' border='0'>" : "") ?></td>
								<td><input name="Excluir2" type="button" id="Excluir2" onclick="javascript:excluir_prova('I',<?=$id ?>)" value="Excluir" /></td>
							</tr>
							<? } ?>
						</table>
						<? } ?>
						<br />
						<br />
						<input name="BTNGravar" id="BTNGravar" type="button" value="Gravar" />
						&nbsp;
						<input type="button" onclick="window.location = 'alterarg.php?rgatual=<?=$rg ?>'" value="Alterar RG" />
						&nbsp;
						<input name="BTNExcluir" type="button" id="BTNExcluir" value="Excluir" />
						&nbsp;
						<input name="BTNNovo" type="button" id="BTNNovo" value="Novo" />
						&nbsp;
						<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" />
						<br />
						<br />
						<table width="100%" border="0">
							<tr>
								<td width="86%"><span class="style45">Datamace Inform&aacute;tica Ltda. </span></td>
								<td width="14%"><span>
									<?=FORMULARIO_10 ?>
									</span></td>
							</tr>
						</table>
					</form>
					<!-- #EndEditable -->
					</td>
				
				
					<td align="right" width="23%" valign="top" ><table width="100%" border="0" class="bgTabela">
							<tr bgcolor="#FFCC33" valign="top">
								<td colspan="2" class="bgTabela"><table width="90%" border="0" align="center">
										<tr valign="top">
											<td valign="top"><table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
													<tr valign="top">
														<td valign="top"><table width="100%" border="0" class="bgTabela">
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaRotulo" height="12"><a href="/corporativo/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Corporativo</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Home</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="/a/"><font face="Verdana, Arial, Helvetica, sans-serif">S.A.D</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../corporativo/mapadosite/mapasite.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Mapa 
																		do site</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../ISO9001/Documentos/D04.PDF"><font face="Verdana, Arial, Helvetica, sans-serif">Organograma</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../assistencia/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Assist&ecirc;ncia 
																		M&eacute;dica</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="/corporativo/dadosdaempresa.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Dados 
																		da Empresa</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="/corporativo/aniversarios/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Anivers&aacute;rios</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../corporativo/feriados.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Pontes 
																		e Feriados</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="/corporativo/fome.htm"><font face="Verdana, Arial, Helvetica, sans-serif">T&ocirc; 
																		com fome</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="/servicosgerais/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Manuten&ccedil;&atilde;o</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../corporativo/escolaridade.php"><font face="Verdana, Arial, Helvetica, sans-serif">Escolaridade</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../representantes/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Representantes</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../suporte/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Suporte</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../corporativo/Inforvirus.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Informa&ccedil;&otilde;es 
																		sobre v&iacute;rus</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../colaboradores/index.htm">Colaboradores</a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../saude/" target="_blank">Sa&uacute;de e Qualidade de vida</a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../eventos.htm">Eventos Datamace</a></td>
																</tr>
															</table></td>
													</tr>
												</table>
												<table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
													<tr valign="top">
														<td><table width="100%" border="0" class="bgTabela">
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td height="16" bgcolor="#CC9900" class="TabelaRotulo"><a href="../estrutura/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Estrutura</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao" height="9"><a href="/estrutura/rede.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Rede</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../estrutura/micros.php"><font face="Verdana, Arial, Helvetica, sans-serif">n&ordm; 
																		micros</font></a></td>
																</tr>
															</table></td>
													</tr>
												</table>
												<table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
													<tr valign="top">
														<td><table width="100%" border="0" class="bgTabela">
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaRotulo" valign="top"><a href="../Apoio/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Apoio</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao" valign="top"><a href="../Apoio/emails.php"><font face="Verdana, Arial, Helvetica, sans-serif">E-mails</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao" valign="top"><a href="../Apoio/links.html"><font face="Verdana, Arial, Helvetica, sans-serif">Links</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="/corporativo/ramais.php">Ramais</a></font></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao" valign="top"><a href="/corporativo/telefones2.php"><font face="Verdana, Arial, Helvetica, sans-serif">Telefones 
																		&uacute;teis</font></a></td>
																</tr>
															</table></td>
													</tr>
													<tr valign="top">
														<td><table width="100%" border="0" class="bgTabela">
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaRotulo"><a href="../entretenimento/index.htm"><font face="Verdana, Arial, Helvetica, sans-serif">Entretenimento</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../entretenimento/filmes/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Videoteca</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../entretenimento/livros/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Biblioteca</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="/entretenimento/enquetes.php"><font face="Verdana, Arial, Helvetica, sans-serif">Enquetes</font></a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../entretenimento/mural.htm">Mural 
																		de an&uacute;ncios</a></td>
																</tr>
															</table>
															<table width="100%" border="0" class="bgTabela">
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaRotulo" valign="top"><font face="Verdana, Arial, Helvetica, sans-serif"><a href="treinamento.php">Treinamento</a></font></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao" valign="top"><a href="../treinamento">Portal</a></td>
																</tr>
															</table></td>
													</tr>
													<tr valign="top">
														<td><table width="100%" border="0" class="bgTabela">
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaRotulo"><a href="../Intersystem/index.htm">Intersystem</a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../Intersystem/compromisso.htm">Compromisso</a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../Intersystem/dadosintersystem.htm">Dados 
																		da empresa</a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../Intersystem/missao.htm">Miss&atilde;o</a></td>
																</tr>
																<tr bgcolor="#CC9900" bordercolor="#CC9900">
																	<td class="TabelaPadrao"><a href="../Intersystem/servicosclientes.htm">Servi&ccedil;os</a></td>
																</tr>
															</table></td>
													</tr>
												</table></td>
										</tr>
									</table></td>
							</tr>
						</table></td>
				</tr>
			</table>
			<br>
			<a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a> <br>
			<hr align="center">
			<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>
				</td>
		</tr>
	</table>
</div>
<p align="center">&nbsp;</p>
</body>
<!-- #EndTemplate -->
</html>
