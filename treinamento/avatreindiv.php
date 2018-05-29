<?php 
include_once ('cabeca.inc.php');

   $sSQL = "select  count(ip) as tot_ips from relacaoip where ip = '$ipremoto';"; 
   if (!$result = mysql_query($sSQL)) {
      echo "<br><br>Problema na aplicação do SQL</b><br>";
   };
 
   if (!$linha = mysql_fetch_object($result)) {
     echo "<br><br>não consigo pegar o objeto</b><br>";
   };   
 
     $sSQL = "select * from sistemas "; 
   if (!$result = mysql_query($sSQL)) {
      echo "<br><br>Problema na tabela sistemas</b><br>";
   };  
   
    
   echo $tot_ips;
   $tot_ips   = $linha->tot_ips;  
  
     if ($tot_ips > 0) {
	   require ('negado.php');
	   die();
	   }

$hoje = date("d/m/Y");
?>
<html>
<!-- DW6 -->
<head>
<title>Datamace Inform&aacute;tica Ltda.</title>
<style type="text/css">
<!--
.style29 {font-size: 10pt}
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {color: #FFFFFF; font-size: 12px; }
.style3 {color: #000099}
.style35 {color: #FFFFFF; font-size: 12px; }
.style37 {font-size: 12}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
	<tr>
		<td width="100%" height="69" background="imagens/logo2.jpg" bgcolor="#FFFFFF" class="style50">&nbsp;</td>
	</tr>
</table>
<div align="center">
	<table width="10%" border="0">
		<tr>
			<td><table width="10%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
					<tr>
						<td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><div align="center"><span class="style31">Avalia&ccedil;&atilde;o do Treinamento </span> </div>
							<form name="form" action="alteraavatre.php" method="post">
								<p>
									<input type="hidden" name="id" value="1" />
									<script language="JavaScript"></script>
								</p>
								<p>&nbsp;</p>
								<table width="80%" border="0" align="center">
									<tr>
										<td><div align="justify" class="style29 style3"><strong>Prezado cliente<br />
												Agradecemos a sua presen&ccedil;a neste evento e solicitamos a gentileza de preencher este formul&aacute;rio, pois sua opini&atilde;o &eacute; essencial para o aperfei&ccedil;oamento do nosso trabalho.</strong></div></td>
									</tr>
								</table>
								<p>
									<script language="JavaScript">
	function confirma() {
  
  if (!document.form.local.value){ 
       alert("Deve preencher o campo local de realização do evento") 
	   document.form.local.focus();
	   return false; 
	   }
	  
  if (!document.form.data.value){ 
       alert("Deve preencher o campo data do evento") 
	   document.form.data.focus();
	   return false; 
	   }
	     
    if ((!document.form.a1[0].checked) && 
        (!document.form.a1[1].checked) &&
    	(!document.form.a1[2].checked) &&
	    (!document.form.a1[3].checked) &&
        (!document.form.a1[4].checked) )
    {
     alert ("Avalie o consultor /instrutor / palestrante");
     return false;
    }

    if  (((document.form.a1[2].checked) ||	
          (document.form.a1[3].checked)) && 
	      (!document.form.observacao.value))
	
    { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

    if ((!document.form.b1[0].checked) && 
    (!document.form.b1[1].checked) &&
	(!document.form.b1[2].checked) &&
	(!document.form.b1[3].checked) &&
    (!document.form.b1[4].checked) )
       {
        alert ("Avalie o consultor /instrutor / palestrante");
        return false;
       }

if  (((document.form.b1[2].checked) ||	
	(document.form.b1[3].checked)) && 
	(!document.form.observacao.value))
	
       { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }
 

    if ((!document.form.c1[0].checked) && 
    (!document.form.c1[1].checked) &&
	(!document.form.c1[2].checked) &&
	(!document.form.c1[3].checked) &&
    (!document.form.c1[4].checked) )
    {
     alert ("Avalie o consultor /instrutor / palestrante");
     return false;
    }

if  (((document.form.c1[2].checked) ||	
	(document.form.c1[3].checked)) && 
	(!document.form.observacao.value))
	
       { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

 
    if ((!document.form.d1[0].checked) && 
    (!document.form.d1[1].checked) &&
	(!document.form.d1[2].checked) &&
	(!document.form.d1[3].checked) &&
    (!document.form.d1[4].checked) )
    {
     alert ("Avalie o consultor /instrutor / palestrante");
     return false;
    }

    if  (((document.form.d1[2].checked) ||	
          (document.form.d1[3].checked)) && 
	      (!document.form.observacao.value))
	
       { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

      if ((!document.form.a2[0].checked) && 
    (!document.form.a2[1].checked) &&
	(!document.form.a2[2].checked) &&
	(!document.form.a2[3].checked) &&
    (!document.form.a2[4].checked) )
    {
     alert ("Avalie a qualidade do material didático utilizado");
     return false;
    }

    if  (((document.form.a2[2].checked) ||	
	      (document.form.a2[3].checked)) && 
    	  (!document.form.observacao.value))
	
       { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

    if ((!document.form.a3[0].checked) && 
    (!document.form.a3[1].checked) &&
	(!document.form.a3[2].checked) &&
	(!document.form.a3[3].checked) &&
    (!document.form.a3[4].checked) )
    {
     alert ("Avalie a organização do evento");
     return false;
    }

    if  (((document.form.a3[2].checked) ||	
       	  (document.form.a3[3].checked)) && 
          (!document.form.observacao.value))
	
       { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

    if ((!document.form.b3[0].checked) && 
    (!document.form.b3[1].checked) &&
	(!document.form.b3[2].checked) &&
	(!document.form.b3[3].checked) &&
    (!document.form.b3[4].checked) )
    {
     alert ("Avalie a organização do evento");
     return false;
    }

    if  (((document.form.b3[2].checked) ||	
	      (document.form.b3[3].checked)) && 
	      (!document.form.observacao.value))
	
       { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

    if ((!document.form.c3[0].checked) && 
    (!document.form.c3[1].checked) &&
	(!document.form.c3[2].checked) &&
	(!document.form.c3[3].checked) &&
    (!document.form.c3[4].checked) )
    {
     alert ("Avalie a organização do evento");
     return false;
    }

    if  (((document.form.c3[2].checked) ||	
	      (document.form.c3[3].checked)) && 
	      (!document.form.observacao.value))
	
       { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

   if ((!document.form.a4[0].checked) && 
    (!document.form.a4[1].checked) &&
	(!document.form.a4[2].checked) &&
	(!document.form.a4[3].checked) &&
    (!document.form.a4[4].checked) )
    {
     alert ("Avalie de modo geral: Curso/Palestra/Seminário/Assessoria");
     return false;
    }

    if  (((document.form.a4[2].checked) ||	
      	  (document.form.a4[3].checked)) && 
          (!document.form.observacao.value))

      { 
       alert("Se a avaliação for Regular ou Ruim é obrigatório justificar") 
	   document.form.observacao.focus();
	   return false; 
	   }

    else {
      if (confirm('Tem certeza que deseja enviar os dados ?')) 
    document.form.submit();
		 }
 };
 
   function troca(){
   if(document.form.instrutores.value=OUTROS )
	document.form.instrutor.style="display:''";
	}
   function troca1(){
   if(document.form.descricao.value=OUTROS )
	document.form.evento.style="display:";
	}
	
	function abre(valor)
	{ 
	 if (valor=="OUTROS")    
	    document.getElementById("evento").style.display="block";   
	   else    
	    document.getElementById("evento").style.display="none";
	}

	function abre1(valor)
	{ 
	 if (valor=="OUTROS")    
	    document.getElementById("instrutor").style.display="block";   
	   else    
	    document.getElementById("instrutor").style.display="none";
	}

    </script>
								</p>
								<table width="90%" border="1" align="center">
									<tr>
										<th bgcolor="#006699" scope="col"> <span class="style37">
											<input name="tipo" type="radio" value="CURSO" checked="checked" />
											<span class="style1">Curso</span></span> <span class="style37">
											<input type="radio" name="tipo" value="PALESTRA" />
											<span class="style1">Palestra</span></span> <span class="style37">
											<input type="radio" name="tipo" value="SEMIN&Aacute;RIO" />
											<span class="style1">Semin&aacute;rio
											<input type="radio" name="tipo" value="ASSESSORIA" />
											Assessoria </span></span></th>
									</tr>
								</table>
								<br />
								<table width="90%" border="1" align="center">
									<tr>
										<td valign="baseline" scope="col"><div align="left"><strong>
												<label>Evento: </label>
												</strong></div></td>
										<td valign="baseline" scope="col"><div align="left">
												<label>
												<select name="descricao" id="descricao" onclick="javascript:abre(this.value);" >
													<option>Treinamentos</option>
													<? 
					while ($linha = mysql_fetch_object($result)){
						print "<option value='".$linha->descricao ."'>".$linha->descricao ."</option>";
					}
			   ?>
													<option value="OUTROS">OUTROS</option>
												</select>
												</label>
												<input name="evento" type="text" id="evento" size="35" maxlength="500" style="display:none"/>
											</div></td>
									</tr>
									<tr>
										<td valign="baseline" scope="col"><div align="left"><strong>
												<label>Consultor / Instrutor / Palestrante:</label>
												</strong></div></td>
										<th valign="baseline" scope="col"><div align="left">
												<select name="instrutores" id="instrutores" onclick="javascript:abre1(this.value);">
													<option>Instrutores</option>
													<option value="ANTÔNIO">ANTÔNIO</option>
													<option value="D&Eacute;BORA">D&Eacute;BORA</option>
													<option value="EDSON">EDSON</option>
													<option value="JANAINA">JANAINA</option>
													<option value="NILZA">NILZA</option>
													<option value="OUTROS">OUTROS</option>
												</select>
												<input name="instrutor" type="text" id="instrutor" size="50" maxlength="100" style="display:none"/>
											</div></th>
									</tr>
									<tr>
										<td width="23%" valign="baseline" scope="col"><div align="left"><strong>Local de Realiza&ccedil;&atilde;o: </strong></div></td>
										<th valign="baseline" scope="col"><div align="left">
												<input name="local" type="text" id="local" size="50" maxlength="100" />
											</div></th>
									</tr>
									<tr>
										<td valign="baseline" scope="col"><div align="left"><strong>
												<label> Per&iacute;odo / Data: </label>
												</strong></div></td>
										<td valign="baseline" scope="col"><div align="left">
												<input name="data" type="text" id="data" onKeyUp="return(mascara_data(this));" value="<? echo $hoje ?>" size="10" maxlength="10" READONLY="1"/>
											</div></td>
									</tr>
								</table>
								<br>
								<br />
								<table width="80%" border="1" align="center">
									<tr>
										<td width="41%" bgcolor="#006699" scope="col"><span class="style2">Avalia&ccedil;&atilde;o</span></td>
										<td width="8%" bgcolor="#006699" scope="col"><span class="style2">&Oacute;timo</span></td>
										<td width="7%" bgcolor="#006699" scope="col"><span class="style2">Bom</span></td>
										<td width="10%" bgcolor="#006699" scope="col"><span class="style2">Regular</span></td>
										<td width="7%" bgcolor="#006699" scope="col"><span class="style2">Ruim</span></td>
										<td width="27%" bgcolor="#006699" scope="col"><span class="style2">N&atilde;o se aplica </span></td>
									</tr>
									<tr>
										<td width="41%"><p>1. Avalie o consultor /instrutor / palestrante quanto a(ao):</p></td>
										<td colspan="5">&nbsp;</td>
									</tr>
									<tr>
										<td width="41%" valign="baseline"> Postura.</td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="a1" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="a1" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="a1" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="a1" value="ruim" />
														4</td>
													<td width="45%"><input type="radio" name="a1" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td width="41%" valign="baseline">Dom&iacute;nio do assunto.</td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="b1" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="b1" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="b1" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="b1" value="ruim" />
														4</td>
													<td width="45%"><input type="radio" name="b1" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td width="41%" valign="baseline">Clareza na Exposi&ccedil;&atilde;o.</td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="c1" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="c1" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="c1" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="c1" value="ruim" />
														4</td>
													<td width="45%"><input type="radio" name="c1" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td valign="baseline">Esclarecimento de D&uacute;vidas.</td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="d1" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="d1" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="d1" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="d1" value="ruim" />
														4</td>
													<td width="45%"><input type="radio" name="d1" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline">&nbsp;</td>
									</tr>
									<tr>
										<td valign="baseline"><div align="justify">2. Avalie a qualidade do material did&aacute;tico utilizado: apostilas, v&iacute;deos, transpar&ecirc;ncias, exerc&iacute;cios e cases (quando utilizados).</div></td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="a2" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="a2" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="a2" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="a2" value="ruim" />
														4</td>
													<td width="45%"><input type="radio" name="a2" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline">3. Avalie a organiza&ccedil;&atilde;o do evento: </td>
									</tr>
									<tr>
										<td valign="baseline">Sala.</td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="a3" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="a3" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="a3" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="a3" value="ruim" />
														4</td>
													<td width="45%"><input type="radio" name="a3" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td valign="baseline"><div align="left">Recursos Audiovisuais: retroprojetor/l&acirc;minas, TV, v&iacute;deo cassete, data-show ou VNC (quando utilizados).</div></td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="b3" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="b3" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="b3" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="b3" value="ruim" />
														4</td>
													<td><input type="radio" name="b3" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td valign="baseline">Atendimento (Informa&ccedil;&atilde;o, Inscri&ccedil;&otilde;es e recep&ccedil;&atilde;o).</td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="c3" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="c3" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="c3" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="c3" value="ruim" />
														4</td>
													<td><input type="radio" name="c3" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline">&nbsp;</td>
									</tr>
									<tr>
										<td valign="baseline">4. De modo geral, como se avalia:<br />
											Curso/Palestra/Semin&aacute;rio/Assessoria.</td>
										<td colspan="5"><table width="100%" border="0">
												<tr>
													<td width="13%"><input type="radio" name="a4" value="&oacute;timo" />
														1</td>
													<td width="13%"><input type="radio" name="a4" value="bom" />
														2</td>
													<td width="16%"><input type="radio" name="a4" value="regular" />
														3</td>
													<td width="13%"><input type="radio" name="a4" value="ruim" />
														4</td>
													<td><input type="radio" name="a4" value="n&atilde;o se aplica" />
														5</td>
												</tr>
											</table></td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline" bgcolor="#006699"><div align="justify" class="style35"><em><strong>Observa&ccedil;&atilde;o</strong></em>: Se voc&ecirc; utilizou os conceitos Regular ou Ruim para avaliar os itens acima mencionados, informe o motivo pelo qual sua expectativa n&atilde;o foi atendida. Pretendemos com isto aprimorar cada vez mais nossos servi&ccedil;os, para melhor atend&ecirc;-lo. </div></td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline"><label>
											<textarea name="observacao" cols="80" rows="3" id="observacao"></textarea>
											</label>
										</td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline" bgcolor="#006699"><span class="style35">5. Caso deseje fazer alguma <strong>SUGEST&Atilde;O</strong>, utilize o espa&ccedil;o abaixo: </span></td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline"><textarea name="sugestao" cols="80" rows="3" id="sugestao"></textarea>
										</td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline" bgcolor="#006699"><span class="style35">6. Caso deseje fazer alguma <strong>RECLAMA&Ccedil;&Atilde;O</strong>, utilize o espa&ccedil;o abaixo: </span></td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline"><textarea name="reclamacao" cols="80" rows="3" id="reclamacao"></textarea>
										</td>
									</tr>
									<tr>
										<td colspan="6" valign="baseline"><input name="enviar" id="enviar" type=button onClick="javascript:confirma()" value="Enviar" /></td>
									</tr>
								</table>
								<label></label>
								<label></label>
								<div align="right"></div>
							</form>
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
							<style type="text/css">
<!--
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
-->
              </style>
							<script language="javascript" src="newpopcalendar.js"></script>
							<script language="javascript" src="data.js"></script>
					</tr>
				</table></td>
		</tr>
	</table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>
