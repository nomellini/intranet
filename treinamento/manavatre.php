<?php 
include('cabeca.inc.php');

if ($acao == 'excluir'){
	if (!$result = mysql_query("delete from avaliatre where id = $id ")){
		echo "<br><br>Problema ao excluir o resgistro: $id</b><br>";
	}else{
		echo "<script>alert('Registro excluído com êxito')</script>";
		include('veravatreman.php');
		die();
	}
}	

$result = mysql_query("select *, date_format(data, '%d/%m/%Y') as data from avaliatre where id = $id ");
$linha = mysql_fetch_object($result);

$check_flagAvaliadoObs[$linha->flagAvaliadoObs] = "checked";
$check_flagAvaliadoSug[$linha->flagAvaliadoSug] = "checked";
$check_flagAvaliadoElo[$linha->flagAvaliadoElo] = "checked";
$check_flagAvaliadoRec[$linha->flagAvaliadoRec] = "checked";

$data = substr($data,8,2) . '-' . substr($data,5,2) . '-' . substr($data,0,4);
if (!$result = mysql_query("select * from modulos ")) {
	echo "<br><br>Problema na tabela modulos</b><br>";
};  

?>
<html>
<head>
<title>Datamace Inform&aacute;tica Ltda.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.9.custom.css">
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/mascara.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/validator.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/treinamento.js"></script>
<script language="JavaScript">
function confirma() {
	if (confirm('Tem certeza que deseja enviar os dados ?')) 
		document.form.submit();
}
function excluir(){
	if (confirm('Tem certeza que deseja excluir os dados?')){
		document.form.acao.value="excluir";
		document.form.action = 'manavatre.php';
		document.form.submit();
	}
}

</script>
<style type="text/css">
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 9;
	color: #FFFFFF;
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
.style1 {
	color: #FFFFFF;
	font-size: 10px;
}
.style3 {
	color: #000099
}
.style4 {
	font-size: 9px
}
.style37 {
	font-size: 12
}
.style40 {
	color: #FFFFFF;
	font-size: 9px;
	font-weight: bold;
}
.style41 {
	color: #FFFFFF;
	font-size: 9px;
}
.style29 {
	font-size: 10pt
}
-->
</style>
<style type="text/css">
<!--
.style31 {
	font-size: 18px;
	color: #4A93B6;
	font-weight: bold;
}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
    <tr>
        <td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
    </tr>
</table>
<form name="form" id="form" action="alteramanavatre.php" method="post">
    <input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
    <input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
    <input type="hidden" name="id" value="<?=$linha->id ?>" />
    <input type="hidden" name="acao" id="acao" value="" />
    <input type="hidden" name="flagTipo" id="flagTipo" value="<?=$flagTipo ?>" />
    <table width="100%" border="0">
        <tr>
            <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
                    <tr>
                        <td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><div align="center"><span class="style31">Avalia&ccedil;&atilde;o do Treinamento </span> </div>
                            <table width="80%" border="0" align="center">
                                <tr>
                                    <td><div align="justify" class="style29 style3"><strong>Prezado cliente<br />
                                            Agradecemos a sua presen&ccedil;a neste evento e solicitamos a gentileza de preencher este formul&aacute;rio, pois sua opini&atilde;o &eacute; essencial para o aperfei&ccedil;oamento do nosso trabalho.</strong></div></td>
                                </tr>
                            </table>
                            <? if ($flagTipo != 3){ ?>
                            <table width="80%" border="1" align="center">
                                <tr>
                                    <th align="left" bgcolor="#006699" scope="col"><span class="style1">Tipo:</span>
                                        <select name="tipo" class="style4" id="tipo" onChange="document.form.tipo.value = this.value">
                                            <option></option>
                                            <? $seltipo[$linha->tipo] = 'selected'; ?>
                                            <option value="ASSESSORIA" <?=$seltipo['ASSESSORIA'] ?>>ASSESSORIA</option>
                                            <option value="CURSO" <?=$seltipo['CURSO'] ?>>CURSO</option>
                                            <option value="PALESTRA" <?=$seltipo['PALESTRA'] ?>>PALESTRA</option>
                                            <option value="TREINAMENTO" <?=$seltipo['TREINAMENTO'] ?>>TREINAMENTO</option>
                                            <option value="SEMINÁRIO" <?=$seltipo['SEMINÁRIO'] ?>>SEMINÁRIO</option>
                                            <option value="OUTROS" <?=$seltipo['OUTROS'] ?>>OUTROS</option>
                                        </select>
                                    </th>
                                </tr>
                            </table>
                            <? }else{ ?>
                            <input name="tipo" type="hidden" id="tipo" value="TREINAMENTO">
                            <? } ?>
                            <br />
                            <table width="80%" border="1" align="center">
                                <tr>
                                    <td valign="baseline" scope="col"><div align="left" class="style4"><strong>
                                            <label>Evento: </label>
                                            </strong></div></td>
                                    <td valign="baseline" scope="col"><select name="evento" id="evento">
                                            <option>Treinamentos</option>
                                            <? 
													$selevento[$linha->evento] = 'selected';
													while ($linha2 = mysql_fetch_object($result)){
													   print "<option value='".$linha2->descricao . "'" . $selevento[$linha2->descricao] . ">".$linha2->descricao ."</option>";
													}
			   ?>
                                        </select>
                                        </label>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td valign="baseline" scope="col"><div align="left" class="style4"><strong>
                                            <label>Instrutor / Palestrante:</label>
                                            </strong></div></td>
                                    <th align="left" scope="col"><select name="instrutor" id="instrutor">
                                            <? 
				$selinst = array();
				$selinst[$linha->ava_ins_id] = "selected";
				$instrutores = mysql_query("select * from instrutor ORDER BY ins_nome");
				while ($lininst = mysql_fetch_object($instrutores)){
					echo "<option value='".$lininst->ins_id."' ".$selinst[$lininst->ins_id].">".$lininst->ins_nome."</option>";
				}
			   ?>
                                        </select></th>
                                </tr>
                                <tr>
                                    <td width="23%" valign="baseline" scope="col"><div align="left" class="style4"><strong>Local de Realiza&ccedil;&atilde;o: </strong></div></td>
                                    <th valign="baseline" scope="col"><div align="left" class="style4">
                                            <input name="local" type="text" id="local" value="<? echo $linha->local ?>" size="30" maxlength="100" />
                                        </div></th>
                                </tr>
                                <tr>
                                    <td valign="baseline" scope="col"><div align="left" class="style4"><strong>
                                            <label> Per&iacute;odo / Data: </label>
                                            </strong></div></td>
                                    <td valign="baseline" scope="col"><div align="left" class="style4">
                                            <input name="data" type="text" id="data" onKeyUp="return(mascara_data(this));" value="<? echo $linha->data ?>" size="10" maxlength="10" class="TXTDATE" calendario="S"/>
                                        </div></td>
                                </tr>
                            </table>
                            <br />
                            <table width="80%" border="1" align="center">
                                <tr>
                                    <td width="50%" bgcolor="#006699" scope="col"><span class="style40">Avalia&ccedil;&atilde;o</span></td>
                                    <td bgcolor="#006699" scope="col"><span class="style40">Grau de satisfa&ccedil;&atilde;o </span></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p class="style4">
                                            <?=++$Cont ?>
                                            . Avalie o consultor /instrutor / palestrante quanto a(ao):</p></td>
                                </tr>
                                <tr>
                                    <td width="50%" valign="baseline"><span class="style4"> Postura.</span></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->a1] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td width="50%" valign="baseline"><span class="style4">Dom&iacute;nio do assunto.</span></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->b1] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td width="50%" valign="baseline"><span class="style4">Clareza na Exposi&ccedil;&atilde;o.</span></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->c1] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><span class="style4">Esclarecimento de D&uacute;vidas.</span></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->d1] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4">
                                        <?=++$Cont ?>
                                        . Avalie a qualidade do material did&aacute;tico utilizado:</span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="justify" class="style4"> apostilas, v&iacute;deos, transpar&ecirc;ncias, exerc&iacute;cios e cases (quando utilizados).</div></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->a2] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <? if ($flagTipo != 3){ ?>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4">
                                        <?=++$Cont ?>
                                        . Avalie a organiza&ccedil;&atilde;o do evento: </span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><span class="style4">Sala.</span></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->a3] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><div align="justify" class="style4">Recursos Audiovisuais: retroprojetor/l&acirc;minas, TV, v&iacute;deo cassete, data-show ou VNC (quando utilizados).</div></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->b3] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><span class="style4">Atendimento (Informa&ccedil;&atilde;o, Inscri&ccedil;&otilde;es e recep&ccedil;&atilde;o).</span></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->c3] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <? } ?>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4">
                                        <?=++$Cont ?>
                                        . De modo geral, como se avalia:</span></td>
                                </tr>
                                <tr>
                                    <td valign="baseline"><span class="style4"> Curso/Palestra/Semin&aacute;rio/Assessoria.</span></td>
                                    <td><table width="100%" border="0">
                                            <tr>
                                                <td class="style4"><? echo $aConceitoAval[$linha->a4] ?></td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline" bgcolor="#006699"><div align="justify" class="style41"><em><strong>Observa&ccedil;&atilde;o</strong></em>: Se voc&ecirc; utilizou os conceitos Regular ou Ruim para avaliar os itens acima mencionados, informe o motivo pelo qual sua expectativa n&atilde;o foi atendida. Pretendemos com isto aprimorar cada vez mais nossos servi&ccedil;os, para melhor atend&ecirc;-lo. 
                                    (<input name="flagAvaliadoObs" id="flagAvaliadoObs" type="radio" value="I"/ <?=$check_flagAvaliadoObs["I"] ?> /> Instrutor ou <input name="flagAvaliadoObs" id="flagAvaliadoObs" type="radio" value="L"/ <?=$check_flagAvaliadoObs["L"] ?> /> Infraestrutura)</div></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4"><? echo $linha->observacao ?>&nbsp; </span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">
                                        <?=++$Cont ?>
                                        . Caso deseje fazer alguma <strong>SUGEST&Atilde;O</strong>, utilize o espa&ccedil;o abaixo: 
                                        (<input name="flagAvaliadoSug" id="flagAvaliadoSug" type="radio" value="I"/ <?=$check_flagAvaliadoSug["I"] ?> /> Instrutor ou <input name="flagAvaliadoSug" id="flagAvaliadoSug" type="radio" value="L"/ <?=$check_flagAvaliadoSug["L"] ?> /> Infraestrutura)</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4"><? echo $linha->sugestao ?>&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">
                                        <?=++$Cont ?>
                                        . Caso deseje fazer alguma <strong>ELOGIO</strong>, utilize o espa&ccedil;o abaixo: 
                                        (<input name="flagAvaliadoElo" id="flagAvaliadoElo" type="radio" value="I"/ <?=$check_flagAvaliadoElo["I"] ?> /> Instrutor ou <input name="flagAvaliadoElo" id="flagAvaliadoElo" type="radio" value="L"/ <?=$check_flagAvaliadoElo["L"] ?> /> Infraestrutura)</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4"><? echo $linha->elogio ?>&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">
                                        <?=++$Cont ?>
                                        . Caso deseje fazer alguma <strong>RECLAMA&Ccedil;&Atilde;O</strong>, utilize o espa&ccedil;o abaixo: 
                                        (<input name="flagAvaliadoRec" id="flagAvaliadoRec" type="radio" value="I"/ <?=$check_flagAvaliadoRec["I"] ?> /> Instrutor ou <input name="flagAvaliadoRec" id="flagAvaliadoRec" type="radio" value="L"/ <?=$check_flagAvaliadoRec["L"] ?> /> Infraestrutura)</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4"><? echo $linha->reclamacao ?>&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">
                                        <?=++$Cont ?>
                                        . Se desejar, identifique-se</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4"><? echo $linha->nome ?>&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">
                                        <?=++$Cont ?>
                                        . Registros complementares, se necess&aacute;rio (Para Palestrantes/Instrutor)</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><span class="style4">
                                        <textarea name="complemento" cols="90" rows="3" id="complemento"><?=$linha->complemento ?>
</textarea>
                                        </span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="baseline"><input type="button" class="style4" onClick="javascript:confirma()" value="Alterar" />
                                        <input type="button" class="style4" onClick="javascript:excluir()" value="Excluir" />
                                        <input type="button" class="style4" onClick="window.location = 'veravatreman.php'" value="Voltar" />
                                        <input type="hidden" name="id" value="<? echo $linha->id?>"></td>
                                </tr>
                            </table>
                            <hr />
                            <span class="style12"> </span>
                            <table width="100%" border="0">
                                <tr>
                                    <td width="90%"><span class="style12">Datamace Inform&aacute;tica Ltda. </span></td>
                                    <td width="10%"><span class="style4">
                                        <?=FORMULARIO_15 ?>
                                        </span></td>
                                </tr>
                            </table>
                    </tr>
                </table></td>
        </tr>
    </table>
</form>
</body>
</html>
