<?php 
include_once ('cabeca.inc.php');

if ($acao == 'excluir'){
	if (!$result = mysql_query("delete from avaliatre where id = $id ")){
		echo "<br><br>Problema ao excluir o resgistro: $id</b><br>";
	}else{
		echo "<script>alert('Registro excluído com êxito')</script>";
		include('veravatremanint.php');
		die();
	}
}	

$result = mysql_query("select * from avaliatre where id = $id");
while ($linha = mysql_fetch_object($result)) {
	$id = $linha->id;
	$tipo = $linha->tipo;	  
	$evento = $linha->evento;	  
	$instrutor = $linha->instrutor;
	$local = $linha->local;	  
	$data = $linha->data;
	$a1 = $linha->a1;
	$b1 = $linha->b1;
	$c1 = $linha->c1;
	$d1 = $linha->d1;
	$a2 = $linha->a2;
	$a3 = $linha->a3;
	$b3 = $linha->b3;
	$c3 = $linha->c3;
	$a4 = $linha->a4;
	$observacao	= $linha->observacao;
	$sugestao	= $linha->sugestao;
	$reclamacao	= $linha->reclamacao;
	$ip			= $linha->ip;
	$nome		= $linha->nome;
}

$data = substr($data,8,2) . '-' . substr($data,5,2) . '-' . substr($data,0,4);
$linha = mysql_fetch_object($result);

$result = mysql_query("select * from modulos ");

?>
<html>
<head>
<title>Datamace Inform&aacute;tica Ltda.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<script language="javascript" src="newpopcalendar.js"></script>
<script language="javascript" src="data.js"></script>
<script language="JavaScript">

function confirma() {
	if (confirm('Tem certeza que deseja enviar os dados ?')) 
		document.form.submit();
}
	
function excluir(){
	if (confirm('Tem certeza que deseja excluir os dados?')){
		document.form.acao.value="excluir";
		document.form.action = 'manavatreint.php';
		document.form.submit();
	}
}

</script>
<style type="text/css">
.style29 {font-size: 10pt}
.style31 {
	font-size: 18px;
	color: #4A93B6;
	font-weight: bold;
}
.style1 {
	color: #FFFFFF;
	font-size: 10px;
}
.style3 {color: #000099}
.style4 {font-size: 9px}
.style37 {font-size: 12}
.style40 {color: #FFFFFF; font-size: 9px; font-weight: bold; }
.style41 {color: #FFFFFF; font-size: 9px; }
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 9;
	color: #FFFFFF;
}
body,td,th {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;}
.style6 {font-size: 12px}
.style7 {
	font-size: 14px;
	font-weight: bold;
}
.style12 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #CCCCCC;
}
.style26 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style52 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
	<tr>
		<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
	</tr>
</table>
<form name="form" action="alteramanavatreint.php" method="post">
	<table width="100%" border="0">
		<tr>
			<td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30" class="bgTabela">
					<tr>
						<td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><div align="center"><span class="style31">Avalia&ccedil;&atilde;o do Treinamento </span> </div>
							<input type="hidden" name="id" value="<?=$id ?>" />
							<table width="80%" border="0" align="center">
								<tr>
									<td><div align="justify" class="style29 style3"><strong>Prezado cliente<br />
											Agradecemos a sua presen&ccedil;a neste evento e solicitamos a gentileza de preencher este formul&aacute;rio, pois sua opini&atilde;o &eacute; essencial para o aperfei&ccedil;oamento do nosso trabalho.</strong></div></td>
								</tr>
							</table>
							<table width="80%" border="1" align="center">
								<tr>
									<th bgcolor="#006699" scope="col"> <div align="left"><span class="style37"> <span class="style1">Tipo:</span>
										<select name="tipo" class="style4" id="tipo" onChange="document.form.tipo.value = this.value">
											<option></option>
											<? $seltipo[$tipo] = 'selected'; ?>
											<option value="ASSESSORIA" <?=$seltipo['ASSESSORIA'] ?>>ASSESSORIA</option>
											<option value="CURSO" <?=$seltipo['CURSO'] ?>>CURSO</option>
											<option value="PALESTRA" <?=$seltipo['PALESTRA'] ?>>PALESTRA</option>
											<option value="TREINAMENTO" <?=$seltipo['TREINAMENTO'] ?>>TREINAMENTO</option>
											<option value="SEMIN&Aacute;RIO" <?=$seltipo['SEMIN&Aacute;RIO'] ?>>SEMIN&Aacute;RIO</option>
											<option value="OUTROS" <?=$seltipo['OUTROS'] ?>>OUTROS</option>
										</select>
									</span></div></th>
								</tr>
							</table>
							<br />
							<table width="80%" border="1" align="center">
								<tr>
									<td valign="baseline" scope="col"><div align="left" class="style4"><strong>
											<label>Evento: </label>
									</strong></div></td>
									<td valign="baseline" scope="col"><select name="evento" id="evento">
											<option>Treinamentos</option>
											<? 
													$selevento[$evento] = 'selected';
													while ($linha = mysql_fetch_object($result)){
													   $cod_modulo=$linha->id;
													   $descricao=$linha->descricao;
													   print "<option value='".$descricao . "'" . $selevento[$descricao] . ">".$descricao ."</option>";
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
				$selinst[$instrutor] = "selected";
				$instrutores = mysql_query("select distinct(instrutor) as instrutor from tre_usuario ORDER BY instrutor");
				while ($lininst = mysql_fetch_object($instrutores)){
					echo "<option value='".$lininst->instrutor."' ".$selinst[$lininst->instrutor].">".$lininst->instrutor."</option>";
				}
			   ?>
									</select></th>
								</tr>
								
								<tr>
									<td width="23%" valign="baseline" scope="col"><div align="left" class="style4"><strong>Local de Realiza&ccedil;&atilde;o: </strong></div></td>
									<th valign="baseline" scope="col"><div align="left" class="style4">
											<input name="local" type="text" id="local" value="<? echo $local ?>" size="30" maxlength="100" />
										</div></th>
								</tr>
								<tr>
									<td valign="baseline" scope="col"><div align="left" class="style4"><strong>
											<label> Per&iacute;odo / Data: </label>
											</strong></div></td>
									<td valign="baseline" scope="col"><div align="left" class="style4">
											<input name="data" type="text" id="data" onKeyUp="return(mascara_data(this));" value="<? echo $data ?>" size="10" maxlength="10"/>
											<span class="style52">
											<script language='JavaScript' type="text/javascript">
if (!document.layers)
{
 document.write("<img align='absmiddle' src='imagens/calendario.gif' ");
 document.write(" onclick='popUpCalendario(-10,10,this, document.getElementById(\"data\"),\"dd-mm-yyyy\");'> ");
}
      											</script>
											</span></div></td>
								</tr>
							</table>
							<br />
							<table width="80%" border="1" align="center">
								<tr>
									<td width="50%" bgcolor="#006699" scope="col"><span class="style40">Avalia&ccedil;&atilde;o</span></td>
									<td bgcolor="#006699" scope="col"><span class="style40">Grau de satisfa&ccedil;&atilde;o </span> </td>
								</tr>
								<tr>
									<td colspan="2"><p class="style4">1. Avalie o consultor /instrutor / palestrante quanto a(ao):</p></td>
								</tr>
								<tr>
									<td width="50%" valign="baseline"><span class="style4"> Postura.</span></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $a1 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td width="50%" valign="baseline"><span class="style4">Dom&iacute;nio do assunto.</span></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $b1 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td width="50%" valign="baseline"><span class="style4">Clareza na Exposi&ccedil;&atilde;o.</span></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $c1 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td valign="baseline"><span class="style4">Esclarecimento de D&uacute;vidas.</span></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $d1 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><span class="style4">2. Avalie a qualidade do material did&aacute;tico utilizado:</span></td>
								</tr>
								<tr>
									<td valign="baseline"><div align="justify" class="style4"> apostilas, v&iacute;deos, transpar&ecirc;ncias, exerc&iacute;cios e cases (quando utilizados).</div></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $a2 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><span class="style4">3. Avalie a organiza&ccedil;&atilde;o do evento: </span></td>
								</tr>
								<tr>
									<td valign="baseline"><span class="style4">Sala.</span></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $a3 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td valign="baseline"><div align="justify" class="style4">Recursos Audiovisuais: retroprojetor/l&acirc;minas, TV, v&iacute;deo cassete, data-show ou VNC (quando utilizados).</div></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $b3 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td valign="baseline"><span class="style4">Atendimento (Informa&ccedil;&atilde;o, Inscri&ccedil;&otilde;es e recep&ccedil;&atilde;o).</span></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $c3 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><span class="style4">4. De modo geral, como se avalia:</span></td>
								</tr>
								<tr>
									<td valign="baseline"><span class="style4"> Curso/Palestra/Semin&aacute;rio/Assessoria.</span></td>
									<td><table width="100%" border="0">
											<tr>
												<td class="style4"><? echo $a4 ?></td>
											</tr>
										</table></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline" bgcolor="#006699"><div align="justify" class="style41"><em><strong>Observa&ccedil;&atilde;o</strong></em>: Se voc&ecirc; utilizou os conceitos Regular ou Ruim para avaliar os itens acima mencionados, informe o motivo pelo qual sua expectativa n&atilde;o foi atendida. Pretendemos com isto aprimorar cada vez mais nossos servi&ccedil;os, para melhor atend&ecirc;-lo. </div></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><span class="style4">
										<label> <? echo $observacao ?> </label>
										</span> </td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">5. Caso deseje fazer alguma <strong>SUGEST&Atilde;O</strong>, utilize o espa&ccedil;o abaixo: </span></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><span class="style4"><? echo $sugestao ?></span> </td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">6. Caso deseje fazer alguma <strong>RECLAMA&Ccedil;&Atilde;O</strong>, utilize o espa&ccedil;o abaixo: </span></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><span class="style4"><? echo $reclamacao ?></span> </td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline" bgcolor="#006699"><span class="style41">7. Se desejar, identifique-se</span></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><span class="style4"><? echo $nome ?></span></td>
								</tr>
								<tr>
									<td colspan="2" valign="baseline"><input name="Altera" type="button" class="style4" id="Altera" onClick="javascript:confirma()" value="Alterar" />
										<input name="exclui" type="button" class="style4" id="exclui" onClick="javascript:excluir()" value="Excluir" />
										<input type="button" class="style4" onClick="window.location = 'veravatreman.php'" value="Voltar" />	
										<input type="hidden" name="id" value="<?echo $id?>">
									</td>
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
							</table></td>
					</tr>
				</table></td>
		</tr>
	</table>
</form>
</body>
</html>
