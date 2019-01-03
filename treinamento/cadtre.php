<?
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

$prova = new treinamento($adm);
$db = new DB();
$prova->avalicaoDoTreinamento($tipo);

if ($id_opc == '2'){
		$data = substr($data,6,4) . '-' . substr($data,3,2) . '-' . substr($data,0,2);

		$rg			= mysql_real_escape_string($rg);
		$data		= mysql_real_escape_string($data);
		$modulo		= mysql_real_escape_string($modulo);
		$tipotre	= mysql_real_escape_string($tipotre);
		$descricao = mysql_real_escape_string(strtoupper($descricao));
		$tre_ins_id = (int)$tre_ins_id;
		
		$dt_cadastro	= substr($dt_cadastro,6,4) . '-' . substr($dt_cadastro,3,2) . '-' . substr($dt_cadastro,0,2);
		$nome			= mysql_real_escape_string(strtoupper($nome));
		$cargo			= mysql_real_escape_string(strtoupper($cargo));
		$areaatuacao	= mysql_real_escape_string(strtoupper($areaatuacao));
		$tempoarea		= mysql_real_escape_string(strtoupper($tempoarea));
		$superiordireto	= mysql_real_escape_string(strtoupper($superiordireto));
		$cargosuperior	= mysql_real_escape_string(strtoupper($cargosuperior));
		$empnome		= mysql_real_escape_string(strtoupper($empnome));
		$emprua			= mysql_real_escape_string(strtoupper($emprua));
		$empbairro		= mysql_real_escape_string(strtoupper($empbairro));
		$empcidade		= mysql_real_escape_string(strtoupper($empcidade));
		$empestado		= mysql_real_escape_string($empestado);
		$email			= mysql_real_escape_string($email);

		$comp = " cadastrotreinamento set rg='$rg', ".
				"nome='$nome', ".
				"cargo='$cargo', ".
				"areaatuacao='$areaatuacao', ".
				"tempoarea='$tempoarea', ".
				"superiordireto='$superiordireto', ".
				"cargosuperior='$cargosuperior', ".
				"fone='$fone', ".
				"emprua='$emprua', ".
				"empnumero='$empnumero', ".
				"empbairro='$empbairro', ".
				"empcep='$empcep', ".
				"empcidade='$empcidade', ".
				"empestado='$empestado', ".
				"empfone='$empfone', ".
				"email='$email', ".
				"identifica='DATAMACE'  ";

		$result = mysql_query("select * from cadastrotreinamento where rg = '$rg'");
		if (mysql_num_rows($result) > 0){
			$sSQL = "update " . $comp .
					" where rg = '$rg'";
			$msgok = 'U';
		}else{
			$comp .= ", hoje='$data', empnome = '$empnome'";
			$sSQL = "insert into " . $comp;
			$msgok = 'I';
		}
		if (mysql_query($sSQL))
		{
			mysql_query("INSERT into tre_usuario  (rg,    data,    modulo,    descricao, tre_ins_id,   tipotre   ) VALUES " .
										 		 "('$rg', '$data', '$modulo', '0',      '$tre_ins_id', '$tipotre')");
		}
		if ($link_prova){
			$opcao = 'rg';
			$msg = "<script>alert('Registro gravado com êxito. Boa prova!');</script>";
			include($link_prova);
		}else{
			echo "<script>alert('Registro gravado com êxito!');</script>";
			include($linkPagina);
		}
		die();
}

if ($id_opc == '1'){
  
	$result		= mysql_query("select *, date_format(hoje,'%d/%m/%Y') as dt_cadastro from cadastrotreinamento where rg = $rg;");
	$linha		= mysql_fetch_object($result);
	$tot_rg		= mysql_num_rows($result);

	$nome = $linha->nome;
	$cargo = $linha->cargo;  
	$areaatuacao = $linha->areaatuacao;
	$tempoarea = $linha->tempoarea;
	$superiordireto = $linha->superiordireto;
	$cargosuperior = $linha->cargosuperior;
	$dt_cadastro = (($linha->dt_cadastro) ? $linha->dt_cadastro : $dt_cadastro);
	$fone = $linha->fone;
	$empnome = $linha->empnome;
	$emprua = $linha->emprua;
	$empnumero = $linha->empnumero;
	$empbairro = $linha->empbairro;
	$empcep = $linha->empcep;
	$empcidade = $linha->empcidade;  
	$empestado = $linha->empestado;
	$empfone = $linha->empfone;  
	$email = $linha->email;  
	$tre_ins_id = $linha->tre_ins_id;
	$identifica = $linha->identifica;
}

if (!$empestado) $empestado = 'SP';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Datamace Inform&aacute;tica Ltda.</title>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<link rel="stylesheet" href="../scripts/jquery.autocomplete.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" src="../scripts/jquery.autocomplete.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script>

	var a_fields = {
		'rg':{'r':true},
		'nome':{'r':true},
		'cargo':{'r':true},
		'areaatuacao':{'r':true},
		'tempoarea':{'r':true},
		'superiordireto':{'r':true},
		'cargosuperior':{'r':true},
		'fone':{'r':true},
		<? if ($tipo == 2 || $tipo == 3){ ?>
			'empfone':{'r':true},
			'email':{'r':true, 'f':'email'},
			'empnome':{'r':true},
			'emprua':{'r':true},
			'empnumero':{'r':true},
			'empbairro':{'r':true},
			'empcep':{'r':false},
			'empcidade':{'r':true},
			'empestado':{'r':true},
		<? } ?>
		'data':{'r':true, 'f':'date'},
		'modulo':{'r':true},
		'tre_ins_id':{'r':true}
	},
	o_config = {
		'to_disable' : ['BTNGravar', 'BTNVoltar', 'BTNExcluir'],
		'alert' : 3
	};
	var v = new validator('form', a_fields, o_config);

	function Gravar(){
		
		a_fields['cargo']['r']			= false;
		a_fields['superiordireto']['r']	= false;
		a_fields['cargosuperior']['r']	= false;
		<? if ($tipo == 2 || $tipo == 3){ ?>
			a_fields['empnome']['r']		= false;
			a_fields['emprua']['r']			= false;
			a_fields['empnumero']['r']		= false;
			a_fields['empbairro']['r']		= false;
			a_fields['empcidade']['r']		= false;
			a_fields['empestado']['r']		= false;
			a_fields['empfone']['r']		= false;
		<? } ?>

		if ($('#desenv')[0]){
			if (!$('#desenv')[0].checked){
				a_fields['cargo']['r']			= true;
				a_fields['superiordireto']['r']	= true;
				a_fields['cargosuperior']['r']	= true;
				<? if ($tipo == 2 || $tipo == 3){ ?>
					a_fields['empnome']['r']		= true;
					a_fields['emprua']['r']			= true;
					a_fields['empnumero']['r']		= true;
					a_fields['empbairro']['r']		= true;
					a_fields['empcidade']['r']		= true;
					a_fields['empestado']['r']		= true;
					a_fields['empfone']['r']		= true;
				<? } ?>
			}
		}
		
		<? if ($tipo == 2 || $tipo == 3){ ?>
		a_fields['fone']['r']			= false;
		a_fields['empfone']['r']		= true;
		if ($('#empnome')[0].value == 'DESENVOLVIMENTO PROFISSIONAL')
		{
			a_fields['fone']['r']		= true;
			a_fields['empfone']['r']	= false;
		}
		<? } else { ?>
		a_fields['fone']['r']			= true;
		<? } ?>

		return true;
	}

function fun_desenv(){
	if ($('#desenv')[0].checked){
		<? if ($tipo == 2 || $tipo == 3){ ?>
			$('#empnome')[0].value = 'DESENVOLVIMENTO PROFISSIONAL';
			$('#emprua')[0].value = '';
			$('#empbairro')[0].value = '';
			$('#empcidade')[0].value = '';
			$('#empcep')[0].value = '';
			$('#empnumero')[0].value = '';
			$('#empfone')[0].value = '';
			$('#empestado')[0].value = 'SP';
		<? } ?>
		$('.desenvolvimento').hide();
	}else{
		<? if ($tipo == 2 || $tipo == 3){ ?>
			$('#empnome')[0].value = '';
			$('#empnome')[0].focus();
		<? } ?>
		$('.desenvolvimento').show();
	}
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
    <tr>
        <td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
    </tr>
</table>
<form action="cadtre.php" method="post" name="form" id="form" >
    <input type="hidden" name="tipo" id="tipo" value="<?=$tipo ?>">
    <input type="hidden" name="linkPagina" id="linkPagina" value="<?=$linkPagina ?>">
    <input type="hidden" name="acao" id="acao" value="<?=$acao ?>">
    <input type="hidden" name="tipotre" id="tipotre" value="<?=$tipotre ?>">
    <input type="hidden" name="link_prova" id="link_prova" value="<?=$link_prova ?>">
    <input type="hidden" name="opcao" id="opcao" value="<?=$opcao ?>">
    <input type="hidden" name="id" id="id" value="<?=$id ?>" />
    <input type="hidden" name="provanro" id="provanro" value="<?=$provanro ?>" />
    <input type="hidden" name="id_opc" id="id_opc">
    <input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
    <input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
    <p class="TituloTreino">Cadastro do Treinando / Treinamento</p>
    <table width="80%" border="0" align="center">
        <tr>
            <td colspan="4" class="thTreinamento">Dados Pessoais</td>
        </tr>
        <tr>
            <td width="21%" id="e_rg">Rg:</td>
            <td width="49%"><input name="rg" type="text" id="rg" size="20" maxlength="20" / value="<?=$rg ?>" class="TXTINT TXTLOAD" pri_focu="S" autocomplete="off"/></td>
            <td width="18%" align="right">Data de Cadastro: </td>
            <td width="12%"><?=$dt_cadastro ?></td>
        </tr>
        <tr>
            <td id="e_nome">Nome:</td>
            <td colspan="3"><input name="nome" type="text" id="nome" value="<?=$nome ?>" size="50" maxlength="150" autocomplete="off"/></td>
        </tr>
        <tr>
            <td id="e_cargo">Cargo:</td>
            <td colspan="3"><input name="cargo" type="text" id="cargo" value="<?=$cargo ?>" size="50" maxlength="50" autocomplete="off"/></td>
        </tr>
        <tr>
            <td id="e_areaatuacao">&Aacute;rea de Atua&ccedil;&atilde;o: </td>
            <td colspan="3"><input name="areaatuacao" type="text" id="areaatuacao" value="<?=$areaatuacao ?>" size="50" maxlength="50" autocomplete="off"/></td>
        </tr>
        <tr>
            <td id="e_tempoarea">Tempo na &aacute;rea: </td>
            <td colspan="3"><input name="tempoarea" type="text" id="tempoarea" value="<?=$tempoarea ?>" size="50" maxlength="15" autocomplete="off"/></td>
        </tr>
        <tr>
            <td id="e_superiordireto">Nome do Sup. Direto: </td>
            <td colspan="3"><input name="superiordireto" type="text" id="superiordireto" value="<?=$superiordireto ?>" size="50" maxlength="150" autocomplete="off"/></td>
        </tr>
        <tr>
            <td id="e_cargosuperior">Cargo do seu Superior: </td>
            <td colspan="3"><input name="cargosuperior" type="text" id="cargosuperior" value="<?=$cargosuperior ?>" size="50" maxlength="50" autocomplete="off"/></td>
        </tr>
        <tr>
            <td id="e_fone">(DDD) Telefone:</td>
            <td colspan="3"><input name="fone" type="text" id="fone" value="<?=$fone ?>" class="TXTTEL" autocomplete="off"/></td>
        </tr>
        <tr>
            <td id="e_email">E-mail:</td>
            <td colspan="3"><input name="email" type="text" id="email" value="<?=$email ?>" size="50" maxlength="100" autocomplete="off"/></td>
        </tr>
    </table>
    <? if ($tipo == 2 || $tipo == 3){ ?>
    <table width="80%" border="0" align="center">
        <tr>
            <td colspan="4" class="thTreinamento">Dados da Empresa</td>
        </tr>
        <tr>
            <td id="e_empnome">Nome da Empresa:</td>
            <td colspan="3"><input name="empnome" type="text" id="empnome" value="<?=$empnome ?>" size="50" maxlength="150" <? if ($tot_rg) echo "readonly" ?> autocomplete="off">
                <? if ($tot_rg){ ?>
                A empresa não pode ser alterada
                <? }else{ ?>
                <input type="checkbox" id="desenv" value="S" onclick="fun_desenv();" />
                Desenvolvimento Profissional
                <? } ?></td>
        </tr>
        <tr class="desenvolvimento">
            <td width="21%" id="e_emprua">Rua:</td>
            <td width="43%"><input name="emprua" type="text" id="emprua" value="<?=$emprua ?>" size="50" maxlength="150" autocomplete="off"/></td>
            <td width="9%" id="e_empnumero">N&uacute;mero:</td>
            <td width="27%"><input name="empnumero" type="text" id="empnumero" value="<?=$empnumero ?>" size="10" maxlength="10" class="TXTINT" autocomplete="off"/></td>
        </tr>
        <tr class="desenvolvimento">
            <td id="e_empbairro">Bairro:</td>
            <td><input name="empbairro" type="text" id="empbairro" value="<?=$empbairro ?>" size="50" maxlength="150" autocomplete="off"/></td>
            <td id="e_empcep">Cep:</td>
            <td><input name="empcep" type="text" id="empcep" value="<?=$empcep ?>" size="10" maxlength="9" class="TXTCEP" autocomplete="off"/></td>
        </tr>
        <tr class="desenvolvimento">
            <td id="e_empcidade">Cidade:</td>
            <td><input name="empcidade" type="text" id="empcidade" value="<?=$empcidade ?>" size="50" maxlength="50" autocomplete="off"/></td>
            <td id="e_empestado">Estado:</td>
            <td><? fun_select($aSiglaEstado,$empestado,'empestado') ?></td>
        </tr>
        <tr class="desenvolvimento">
            <td id="e_empfone">(DDD) Telefone:</td>
            <td colspan="3"><input name="empfone" type="text" id="empfone" value="<?=$empfone ?>" size="42" maxlength="9" class="TXTTEL" autocomplete="off"/></td>
        </tr>
    </table>
    <? } ?>
    <table width="80%" border="0" align="center">
        <tr>
            <td colspan="3" class="thTreinamento">Treinamento</td>
        </tr>
        <tr>
            <td width="159" id="e_data">Data</td>
            <td width="340" id="e_modulo">Treinamento</td>
            <td width="261" id="e_tre_ins_id">Instrutor</td>
        </tr>
        <tr>
            <td><input name="data" type="text" id="data" value="<?=$hoje ?>" class="TXTDATE" <?=(($prova->avaliacaoLiberada) ? "readOnly" : "calendario='S'") ?>/></td>
            <td><? $db->comboBox("select id, descricao from modulos", $modulo, "modulo","","S"); ?></td>
            <td><? (($prova->avaliacaoInstrutor) ? $tre_ins_id = $prova->avaliacaoInstrutor : ""); 
					echo "<input name='tre_ins_id' type='hidden' id='tre_ins_id' value='$tre_ins_id' />";
					$db->comboBox("select ins_id, ins_nome from instrutor where ins_ativo = 'S'", $tre_ins_id, "tre_ins","","S", (($prova->avaliacaoInstrutor) ? "disabled" : "")); ?></td>
        </tr>
    </table>
    <table width="80%" border="0" align="center">
        <tr>
            <td><input name="BTNGravar" id="BTNGravar" type="button" value="Gravar" />
                &nbsp;
                <input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarpara="<?=$linkPagina ?>"/></td>
        </tr>
    </table>
</form>
<hr />
<table width="100%" border="0">
    <tr>
        <td width="84%">Datamace Inform&aacute;tica Ltda. </td>
        <td width="10%"><?=FORMULARIO_10 ?></td>
    </tr>
</table>
<script>

$('#tre_ins').live('change', function (event) {
	$('#tre_ins_id')[0].value = $(this)[0].value;
})

</script>
</body>
</html>
<?=$msg ?>