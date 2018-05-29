<?php 
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

$db = new DB();
$prova = new treinamento($adm);
$prova->avalicaoDoTreinamento($flagTipo);

if	($adm != 'S'){
	if ($db->getQuantidadeIP($ipremoto, "A") || !$prova->avaliacaoLiberada){
		require ('negado.php');
		die();
	}
}

if (!$flagTipo) $flagTipo = $prova->avaliacaoTipo;

if ($id_opc == '2') {
	$acao = "enviado";
	$data = substr($data,6,4) . '-' . substr($data,3,2) . '-' . substr($data,0,2);
  
	$tipo = strtoupper($tipo);
	$evento = strtoupper($evento);
	$local = strtoupper($local);
	$a1 = strtoupper($a1);
	$b1 = strtoupper($b1);
	$c1 = strtoupper($c1);
	$d1 = strtoupper($d1);
	$a2 = strtoupper($a2);
	$a3 = strtoupper($a3);
	$b3 = strtoupper($b3);
	$c3 = strtoupper($c3);
	$a4 = strtoupper($a4);
	$observacao = strtoupper($observacao);
	$sugestao= strtoupper($sugestao);
	$reclamacao = strtoupper($reclamacao);
	$elogio = strtoupper($elogio);
	$complemento = strtoupper($complemento);
	$nome = strtoupper($nome);

	$sSQL = "INSERT into avaliatre (tipo, flagTipo, evento, ava_ins_id, local, data, ".
			" a1, b1, c1, d1, a2, a3, b3, c3, a4, observacao, sugestao, reclamacao, nome, ip, elogio, complemento) ".
			" VALUES ".
			" ('$tipo', '$flagTipo', '$evento', '$ava_ins_id', '$local', '$data', ".
			" '$a1', '$b1', '$c1', '$d1', '$a2', '$a3', '$b3', '$c3', '$a4', '$observacao', ".
			" '$sugestao', '$reclamacao', '$nome', '$ipremoto', '$elogio', '$complemento');"; 
   
	if(!mysql_query($sSQL)) {
		$acao = "NÃO foi enviado!";
	}else {
		$acao = "foi enviado com sucesso!";
		$db = new DB();
		$db->setIP($ipremoto, "A");
	}
}

$check_conf_tipo_padrao[$prova->avaliacaoTipoEvento] = 'checked';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<!-- DW6 -->
<head>
<title>Datamace Inform&aacute;tica Ltda.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
		<? if ($flagTipo != 3){ ?>
		'tipo':{'r':true,'l':'Treinamento / Palestra / Workshop / Seminário'},
		<? } ?>
		'evento':{'r':true},
		'ava_ins_id':{'r':true},
		'local':{'r':true},
		'data':{'r':true,'f':'date'},
		'a1':{'r':true},
		'b1':{'r':true,'l':'Avaliação do Consultor / Instrutor / Palestrante'},
		'c1':{'r':true},
		'd1':{'r':true},
		'a2':{'r':true,'l':'Avaliação da qualidade do material didático utilizado'},
		<? if ($flagTipo != 3){ ?>
		'a3':{'r':true,'l':'Avaliação da organização do evento'},
		'b3':{'r':true,'l':'Avaliação da organização do evento'},
		'c3':{'r':true,'l':'Avaliação da organização do evento'},
		<? } ?>
		'a4':{'r':true,'l':'Avaliação geral do evento'},
		'observacao':{'r':false,'l':'Quando avaliação for Regular ou Ruim OBSERVAÇÂO'}
	},
	o_config = {
		'to_disable' : ['BTNGravar', 'BTNVoltar', 'BTNExcluir'],
		'alert' : 3
	};
	var v = new validator('form', a_fields, o_config);

	function Gravar(){
		a_fields['observacao']['r'] = false;
		$('.obsRegular').each(function(index, element) {
			if ($(this)[0].checked){
				a_fields['observacao']['r'] = true;
			}
		});
		return true;
	}

	$().ready(function(){
		$("#evento").autocompleteArray([<? fun_autocomplete('evento') ?>]);
		$("#local").autocompleteArray([<? fun_autocomplete('local') ?>]);
	});


</script>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
	color: #FFFFFF;
}
.style2 {
	color: #FFFFFF;
	font-size: 12px;
}
.style3 {
	color: #000099
}
.style35 {
	color: #FFFFFF;
	font-size: 12px;
}
.style37 {
	font-size: 12
}
body, td, th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style6 {
	font-size: 12px
}
.style7 {
	font-size: 14px;
	font-weight: bold;
}
.style12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #CCCCCC;
}
.style26 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style29 {
	font-size: 10pt
}
.style31 {
	font-size: 18px;
	color: #4A93B6;
	font-weight: bold;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form action="avatre.php" method="post" name="form" id="form" >
    <input type="hidden" name="adm" id="adm" value="<?=$adm ?>">
    <input type="hidden" name="id_opc" id="id_opc">
    <input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
    <input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
    <input type="hidden" name="flagTipo" id="flagTipo" value="<?=$flagTipo ?>" />
    <input type="hidden" name="linkPagina" id="linkPagina" value="<?=$linkPagina ?>" />
    <table width="100%" border="0">
        <tr>
            <td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <? if ($id_opc == '2'){ ?>
        <tr>
            <td class="TituloTreino"><br>
                <br>
                <b>
                <center>
                    <? echo "Formulário $acao" ?>
                </center>
                </b> <br>
                <br>
                <br>
                <center>
                    Clique <a href="/treinamento/<?=$linkPagina ?>">aqui</a> para voltar ao menu principal. <br>
                </center>
                <br></td>
        </tr>
        <? }else{ ?>
        <tr>
            <td class="TituloTreino" align="center">Avaliação
                <?=(($flagTipo == 1) ? "Interna do Treinamento" : "do Treinando") ?></td>
        </tr>
        <tr>
            <td width="80%"><div align="justify" class="style29 style3"><strong>Prezado
                    <? if ($flagTipo == 1) echo "colaborador"; else echo "cliente"; ?>
                    <br />
                    Agradecemos a sua presen&ccedil;a neste evento e solicitamos a gentileza de preencher este formul&aacute;rio, pois sua opini&atilde;o &eacute; essencial para o aperfei&ccedil;oamento do nosso trabalho.</strong></div></td>
        </tr>
        <? if ($flagTipo != 3){ ?>
        <tr>
            <td><table width="80%" border="1" align="center">
                    <tr>
                        <td class="thTreinamento" id="e_tipo"><input name="tipo" id="tipo" type="radio" value="TREINAMENTO"/ <?=$check_conf_tipo_padrao["TREINAMENTO"] ?>>
                            Treinamento
                            <input type="radio" id="tipo" name="tipo" value="PALESTRA"  <?=$check_conf_tipo_padrao["PALESTRA"] ?>/>
                            Palestra
                            <input type="radio" id="tipo" name="tipo" value="WORKSHOP"  <?=$check_conf_tipo_padrao["WORKSHOP"] ?>/>
                            Workshop
                            <input type="radio" id="tipo" name="tipo" value="SEMIN&Aacute;RIO"  <?=$check_conf_tipo_padrao["SEMINÁRIO"] ?>/>
                            Semin&aacute;rio
                            <input type="radio" id="tipo" name="tipo" value="OUTROS"  <?=$check_conf_tipo_padrao["OUTROS"] ?>/>
                            Outros </td>
                    </tr>
                </table></td>
        </tr>
        <? }else{ ?>
        <input name="tipo" type="hidden" id="tipo" value="TREINAMENTO">
        <? } ?>
        <tr>
            <td><table width="80%" border="1" align="center">
                    <tr>
                        <td width="25%" id="e_evento">Evento:</td>
                        <td width="75%"><input name="evento" type="text" id="evento" size="50" maxlength="50" value="<?=$prova->avaliacaoEvento ?>" <?=(($prova->avaliacaoEvento) ? "readOnly" : "") ?> /></td>
                    </tr>
                    <tr>
                        <td id="e_ava_ins_id">Consultor / Instrutor / Palestrante:</td>
                        <td><? (($prova->avaliacaoInstrutor) ? $ava_ins_id = $prova->avaliacaoInstrutor : ""); 
					echo "<input name='ava_ins_id' type='hidden' id='ava_ins_id' value='$ava_ins_id' />";
					$db->comboBox("select ins_id, ins_nome from instrutor where ins_ativo = 'S'", $ava_ins_id, "ava_ins","","S", (($prova->avaliacaoInstrutor) ? "disabled" : "")); ?></td>
                    </tr>
                    <tr>
                        <td id="e_local">Local:</td>
                        <td><input name="local" type="text" id="local" size="50" maxlength="100" value="<?=$prova->avaliacaoLocal ?>" <?=(($prova->avaliacaoLocal) ? "readOnly" : "") ?> /></td>
                    </tr>
                    <tr>
                        <td id="e_data">Data:</td>
                        <td><input name="data" type="text" id="data" value="<?=$hoje ?>" size="10" maxlength="10" class='TXTDATE' <?=(($prova->avaliacaoLiberada && $adm != "S") ? "readOnly" : "calendario='S'") ?>/></td>
                    </tr>
                </table></td>
        </tr>
        <tr>
            <td><table width="80%" border="1" align="center">
                    <tr>
                        <td width="50%" class="thTreinamento">Avalia&ccedil;&atilde;o</td>
                        <td width="10%" class="thTreinamento">&Oacute;timo</td>
                        <td width="10%" class="thTreinamento">Bom</td>
                        <td width="10%" class="thTreinamento">Regular</td>
                        <td width="10%" class="thTreinamento">Ruim</td>
                        <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                        <td width="10%" class="thTreinamento">Não desejo
                            avaliar *</td>
                        <? } ?>
                    </tr>
                    <tr>
                        <td width="50%"><p>
                                <?=++$Numeracao ?>
                                . Avalie o consultor /instrutor / palestrante quanto a(ao):</p></td>
                        <td colspan="5">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="50%" id="e_a1">Postura.</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="a1" id="a1" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="a1" id="a1" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="a1" id="a1" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="a1" id="a1" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="a1" id="a1" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td width="50%"id="e_b1">Dom&iacute;nio do assunto.</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="b1" id="b1" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="b1" id="b1" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="b1" id="b1" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="b1" id="b1" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="b1" id="b1" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td width="50%"id="e_c1">Clareza na Exposi&ccedil;&atilde;o.</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="c1" id="c1" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="c1" id="c1" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="c1" id="c1" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="c1" id="c1" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="c1" id="c1" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td id="e_d1">Esclarecimento de D&uacute;vidas.</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="d1" id="d1" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="d1" id="d1" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="d1" id="d1" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="d1" id="d1" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="d1" id="d1" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    <tr>
                        <td id="e_a2"><?=++$Numeracao ?>
                            . Avalie a qualidade do material did&aacute;tico utilizado: apostilas, v&iacute;deos, transpar&ecirc;ncias, exerc&iacute;cios e cases (quando utilizados).</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="a2" id="a2" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="a2" id="a2" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="a2" id="a2" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="a2" id="a2" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="a2" id="a2" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    <? if ($flagTipo != 3){ ?>
                    <tr>
                        <td colspan="6"><?=++$Numeracao ?>
                            . Avalie a organiza&ccedil;&atilde;o do evento: </td>
                    </tr>
                    <tr>
                        <td id="e_a3">Sala.</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="a3" id="a3" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="a3" id="a3" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="a3" id="a3" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="a3" id="a3" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="a3" id="a3" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td id="e_b3">Recursos Audiovisuais: retroprojetor/l&acirc;minas, TV, v&iacute;deo cassete, data-show ou VNC (Se utilizados).</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="b3" id="b3" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="b3" id="b3" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="b3" id="b3" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="b3" id="b3" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="b3" id="b3" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td id="e_c3">Atendimento (Informa&ccedil;&atilde;o, Inscri&ccedil;&otilde;es e recep&ccedil;&atilde;o).</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="c3" id="c3" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="c3" id="c3" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="c3" id="c3" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="c3" id="c3" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="c3" id="c3" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td id="e_a4"><?=++$Numeracao ?>
                            . De modo geral, como  avalia o evento:</td>
                        <td colspan="5"><table width="100%" border="0">
                                <tr>
                                    <td align="center"><input type="radio" name="a4" id="a4" value="1" />
                                        4</td>
                                    <td align="center"><input type="radio" name="a4" id="a4" value="2" />
                                        3</td>
                                    <td align="center"><input type="radio" name="a4" id="a4" value="3" class="obsRegular" />
                                        2</td>
                                    <td align="center"><input type="radio" name="a4" id="a4" value="4" class="obsRegular" />
                                        1</td>
                                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                                    <td align="center"><input type="radio" name="a4" id="a4" value="5" /></td>
                                    <? } ?>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="thTreinamento" id="e_observacao" style="text-align:justify"><em><strong>Observa&ccedil;&atilde;o</strong></em>: <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Se você utilizou os conceitos Regular ou Ruim para avaliar os itens acima mencionados, informe o motivo
                            pelo qual sua expectativa não foi atendida. Pretendemos com isto aprimorar cada vez mais nossos serviços,
                            para melhor atendê-lo.</td>
                    </tr>
                    <tr>
                        <td colspan="6"><label>
                                <textarea name="observacao" cols="95" rows="3" id="observacao"></textarea>
                            </label></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="thTreinamento" style="text-align:left"><?=++$Numeracao ?>
                            . Caso deseje fazer alguma <strong>SUGEST&Atilde;O</strong> sobre o treinamento, utilize o espa&ccedil;o abaixo:</td>
                    </tr>
                    <tr>
                        <td colspan="6"><textarea name="sugestao" cols="95" rows="3" id="sugestao"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="thTreinamento" style="text-align:left"><?=++$Numeracao ?>
                            . Caso deseje fazer alguma <strong>RECLAMA&Ccedil;&Atilde;O</strong><strong></strong> sobre o treinamento, utilize o espa&ccedil;o abaixo:</td>
                    </tr>
                    <tr>
                        <td colspan="6"><textarea name="reclamacao" cols="95" rows="3" id="reclamacao"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="thTreinamento" style="text-align:left"><?=++$Numeracao ?>
                            . Caso deseje fazer algum <strong>ELOGIO</strong>, utilize o espa&ccedil;o abaixo:</td>
                    </tr>
                    <tr>
                        <td colspan="6"><textarea name="elogio" cols="95" rows="3" id="elogio"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="thTreinamento" style="text-align:left"><?=++$Numeracao ?>
                            . Se desejar, identifique-se:</td>
                    </tr>
                    <tr>
                        <td colspan="6"><textarea name="nome" cols="95" rows="3" id="nome"></textarea></td>
                    </tr>
                    <? if($adm=="S"){ ?>
                    <tr>
                        <td colspan="6" class="thTreinamento" style="text-align:left"><?=++$Numeracao ?>
                            . Registros complementares, se necessário (Para Palestrante/Instrutor):</td>
                    </tr>
                    <tr>
                        <td colspan="6"><textarea name="complemento" cols="95" rows="3" id="complemento"></textarea></td>
                    </tr>
                    <? } ?>
                    <? if ($linkPagina == "treinamento.php" && $flagTipo != 1){ ?>
                    <tr>
                        <td colspan="6" class="thTreinamento">* Obs.: A opção “Não desejo avaliar” não será considerada nos resultados dos indicadores.</td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td colspan="2"><input name="BTNGravar" id="BTNGravar" type="button" value="Gravar" />
                            &nbsp;
                            <input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarPara=<?=$linkPagina ?> onClick="window.location = '<?=$linkPagina ?>'"/></td>
                    </tr>
                    <? } ?>
                </table></td>
        </tr>
    </table>
    <table width="100%" border="0">
        <tr>
            <td width="90%">Datamace Inform&aacute;tica Ltda. </td>
            <td width="10%"><?=(($flagTipo == 3) ? FORMULARIO_71 : FORMULARIO_15) ?></td>
        </tr>
    </table>
</form>
<script>

$('#ava_ins').live('change', function (event) {
	$('#ava_ins_id')[0].value = $(this)[0].value;
})

</script>
</body>
</html>