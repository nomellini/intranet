<?
// Autor: Lucas Oliveira Silva 
// Data: 05/05/2011 11:07
// Local: Datamace
// Objetivo: Libera as provas, de acordo com a matéria, tipo, data e horários

$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

$db = new DB();

if ($id_opc == '2') {
	$result	= mysql_query("select * from config where conf_id = $conf_id");
	
	$conf_data			= substr($conf_data,6,4) . '-' . substr($conf_data,3,2) . '-' . substr($conf_data,0,2);
	if ($conf_provas){
		$conf_provas		= "#".implode('#',$conf_provas)."#";
	}
	$conf_hora_inicial	= str_replace(':','',$conf_hora_inicial);
	$conf_hora_final	= str_replace(':','',$conf_hora_final);
	if (!$conf_tipo) $conf_tipo = '0';
	if (!$conf_libera_aval_tre) $conf_libera_aval_tre = '0';

	$comp	= " config set " .
				" conf_id = $conf_id, " .
				" conf_provas = '$conf_provas', " .
				" conf_data = '$conf_data', " .
				" conf_hora_inicial = '$conf_hora_inicial', " .
				" conf_hora_final = '$conf_hora_final', " .
				" conf_provanro = '$conf_provanro', " .
				" conf_tipo = '$conf_tipo', ".
				" conf_libera_aval_tre = '$conf_libera_aval_tre', ".
				" conf_tipo_padrao = '$conf_tipo_padrao', ".
				" conf_evento_padrao = '$conf_evento_padrao', ".
				" conf_instrutor_padrao = '$conf_instrutor_padrao', ".
				" conf_local_padrao = '$conf_local_padrao',".
				" conf_crc = '$conf_crc'";
			
	if (mysql_num_rows($result) > 0){
		$sSQL = "update " . $comp .
				" where conf_id = $conf_id  ";
		$msgok = 'U';
	}else{
		$sSQL = "insert into " . $comp;
		$msgok = 'I';
	}
	mysql_query($sSQL);

	$id_opc = '1';

}elseif ($id_opc == '3') {
	$result		= mysql_query("delete from config where conf_id = $conf_id");
	$msgok		= 'E';
	$conf_id	= '';
}elseif ($id_opc == '99') {
	$conf_id = '';
}

if ($id_opc == '1' || $id_opc == '10' || $id_opc == '11' || $id_opc == '12' || $id_opc == '13') {
	switch ($id_opc) {
		case '10':
			$vWr = ">= 0 order by conf_id limit 1";
			break;
		case '11':
			$vWr = "> $conf_id limit 1";
			break;
		case '12':
			$vWr = "< $conf_id order by conf_id desc limit 1";
			break;
		case '13':
			$vWr = "<= 32000 order by conf_id desc limit 1";
			break;
		default:
			$vWr = "= $conf_id";
			break;
	}
	$result	= mysql_query("select *, date_format(conf_data,'%d/%m/%Y') as conf_data_f from config where conf_id $vWr");
	if (mysql_num_rows($result) > 0){
		$linha					= mysql_fetch_object($result);
		$conf_id				= $linha->conf_id;
		$conf_data				= $linha->conf_data_f;
		$conf_provas			= explode('#',$linha->conf_provas);
		$conf_hora_inicial		= '';
		if ($linha->conf_hora_inicial)	$conf_hora_inicial	= substr($linha->conf_hora_inicial,0,2) . ":" . substr($linha->conf_hora_inicial,2,2);
		$conf_hora_final		= '';
		if ($linha->conf_hora_final)	$conf_hora_final	= substr($linha->conf_hora_final,0,2) . ":" . substr($linha->conf_hora_final,2,2);
		$conf_provanro			= $linha->conf_provanro;
		$conf_tipo				= $linha->conf_tipo;
		$conf_libera_aval_tre	= $linha->conf_libera_aval_tre;
		$conf_tipo_padrao		= $linha->conf_tipo_padrao;
		$conf_evento_padrao		= $linha->conf_evento_padrao;
		$conf_instrutor_padrao	= $linha->conf_instrutor_padrao;
		$conf_local_padrao		= $linha->conf_local_padrao;
		$conf_crc				= $linha->conf_crc;
	}else{
		$conf_id				= '';
	}
		
}

$conf_novo = "";
if (!$conf_id){
	$result						= mysql_query("select (max(conf_id) + 1) as novo from config");
	$linha						= mysql_fetch_object($result);
	$conf_id					= $linha->novo;
	$conf_novo					= "S";
	$conf_provas				= array();
	$conf_data					= date('d/m/Y');
	$conf_hora_inicial			= '';
	$conf_hora_final			= '';
	$conf_provanro				= '';
	$conf_tipo					= '';
	$conf_libera_aval_tre		= '0';
	$conf_tipo_padrao			= '';
	$conf_evento_padrao			= '';
	$conf_instrutor_padrao		= '';
	$conf_local_padrao			= '';
	$conf_crc					= '';
}

$provaId = array();
$result	= mysql_query("select * from provas");
while ($linha = mysql_fetch_object($result)){
	$provaId[$linha->id] = $linha->descricao;
}
$conf_provas = fun_checkbox($provaId,$conf_provas,'conf_provas','','',2,'','');

$check_conf_provanro[$conf_provanro]	= 'checked';
$check_conf_libera_aval['1']			= 'checked';
$check_conf_tipo_padrao[$conf_tipo_padrao] = 'checked';

?>

<html><!-- #BeginTemplate "/Templates/menu.dwt" --><!-- DW6 -->
<head>
<!-- #BeginEditable "doctitle" -->
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
		'conf_id':{'r':true},
		'conf_data':{'r':true,'f':'date','mn':'10'},
		'conf_hora_inicial':{'l':'Hora Inicial','r':true,'mn':'5', 't':'e_conf_horario'},
		'conf_hora_final':{'l':'Hora Final','r':true,'mn':'5', 't':'e_conf_horario'},
		'conf_tipo':{'r':true},
		'conf_tipo_padrao':{'r':false},
		'conf_evento_padrao':{'r':false},
		'conf_instrutor_padrao':{'r':false},
		'conf_local_padrao':{'r':false}
	},
	o_config = {
		'to_disable' : ['BTNGravar', 'BTNVoltar', 'BTNExcluir'],
		'alert' : 3
	};
	var v = new validator('form', a_fields, o_config);

	function Gravar(){
		a_fields['conf_hora_inicial']['r'] = false;
		a_fields['conf_hora_final']['r'] = false;
		a_fields['conf_tipo_padrao']['r'] = false;
		a_fields['conf_evento_padrao']['r'] = false;
		a_fields['conf_instrutor_padrao']['r'] = false;
		a_fields['conf_local_padrao']['r'] = false;

		if (!$('#conf_libera_aval_tre')[0].checked){
			a_fields['conf_hora_inicial']['r'] = true;
			a_fields['conf_hora_final']['r'] = true;
		}
		if ($('#conf_libera_aval_tre')[0].checked){
			a_fields['conf_tipo_padrao']['r'] = true;
			a_fields['conf_evento_padrao']['r'] = true;
			a_fields['conf_instrutor_padrao']['r'] = true;
			a_fields['conf_local_padrao']['r'] = true;
		}
		
		return true;
	}

	$().ready(function(){
		$("#conf_evento_padrao").autocompleteArray([<? fun_autocomplete('evento') ?>]);
		$("#conf_local_padrao").autocompleteArray([<? fun_autocomplete('local') ?>]);

		$("#conf_tipo").bind('change', function(){
			var vText = "";
			if ($(this).val() == 3)
			{
				vText = $('#conf_data')[0].value + $('#conf_hora_inicial')[0].value + $('#conf_hora_final')[0].value;
				vText = crc32(vText);
				$('#conf_crc').show(300);
			}
			else
			{
				$('#conf_crc').hide(300);
			}
			$('#conf_crc')[0].value = vText;
		});
	});

</script>
<!-- #EndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 18px; font-weight: normal; font-family: Verdana, Arial, Helvetica, sans-serif;color: #FFFFFF;}
.style3 {color: #000099}
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
            <td width="17%"> <div align="center" class="style1">
              <div align="left"><a href="http://www.datamace.com.br"><img src="../imagens/novologo.jpg" width="155" height="41" border="0">
                </a></div>
            </div></td>
            <td width="60%" valign="middle"> <p class="style1"><font face="Verdana, Arial, Helvetica, sans-serif" class="style2">Intranet
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
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF"><!-- #BeginEditable "Centro" -->
							<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form" id="form" >
								<input type="hidden" name="id_opc" id="id_opc">
								<input type="hidden" name="msgok" id="msgok" value="<?=$msgok ?>">
								<input type="hidden" name="msg" id="msg" value="<?=$msg ?>">
								<p>&nbsp;</p>
								<p class="TituloTreino" align="center">Liberação de Provas / Dias de prova</p>
								<table width="89%" align="center">
									<tr>
										<td width="28%" align="right" id="e_conf_id">Código :</td>
										<td width="72%"><input type="text" name="conf_id" id="conf_id" maxlength="10" value="<?=$conf_id ?>" class="TXTINT TXTLOAD" help="config" helpid_opc="1" pri_focu="S" btn_navega="S"></td>
									</tr>
									<tr>
										<td align="right" id="e_conf_data">Data :</td>
										<td><input type="text" name="conf_data" id="conf_data" value="<?=$conf_data ?>" class="TXTDATE" calendario="S"></td>
									</tr>
									<tr>
										<td align="right" id="e_conf_horario">Horário :</td>
										<td><input type="text" name="conf_hora_inicial" id="conf_hora_inicial" maxlength="5" size="5" value="<?=$conf_hora_inicial ?>" class="TXTHORA">
											a
											<input type="text" name="conf_hora_final" id="conf_hora_final" maxlength="5" size="5" value="<?=$conf_hora_final ?>" class="TXTHORA"></td>
									</tr>
									<tr>
										<td align="right" id="e_conf_tipo">Tipo de Treinamento:</td>
										<td><? 
										unset($aProvaTipo[0]);
										fun_select($aProvaTipo,$conf_tipo,'conf_tipo','','S') ?>
									    <input type="text" name="conf_crc" id="conf_crc" maxlength="10" size="12" value="<?=$conf_crc ?>" /></td>
									</tr>
									<tr>
										<td align="right">Sequencia da Prova :</td>
										<td><? fun_select($Provanro,$conf_provanro,'conf_provanro') ?></td>
									</tr>
									<tr>
										<td align="right" id="e_conf_provas">Provas :</td>
										<td><?=$conf_provas ?></td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td align="right">Avaliação do Treinamento:</td>
										<td><input name="conf_libera_aval_tre" id="conf_libera_aval_tre" type="checkbox" value="1" <?=$check_conf_libera_aval[$conf_libera_aval_tre] ?>>
											-> Não filtra por horário</td>
									</tr>
									<tr>
										<td align="right" id="e_conf_tipo_padrao">Tipo do Evento :</td>
										<td><input name="conf_tipo_padrao" id="tipo" type="radio" value="TREINAMENTO" <?=$check_conf_tipo_padrao["TREINAMENTO"] ?>/>
											Treinamento
											<input type="radio" id="conf_tipo_padrao" name="conf_tipo_padrao" value="PALESTRA" <?=$check_conf_tipo_padrao["PALESTRA"] ?>/>
											Palestra
											<input type="radio" id="conf_tipo_padrao" name="conf_tipo_padrao" value="WORKSHOP" <?=$check_conf_tipo_padrao["WORKSHOP"] ?>/>
											Workshop
											<input type="radio" id="tipo" name="conf_tipo_padrao" value="SEMIN&Aacute;RIO" <?=$check_conf_tipo_padrao["SEMINÁRIO"] ?>/>
											Semin&aacute;rio
											<input type="radio" id="conf_tipo_padrao" name="conf_tipo_padrao" value="OUTROS" <?=$check_conf_tipo_padrao["OUTROS"] ?>/>
											Outros</td>
									</tr>
									<tr>
										<td align="right" id="e_conf_evento_padrao">Evento :</td>
										<td><input type="text" name="conf_evento_padrao" id="conf_evento_padrao" mxlength="50" size="50" value="<?=$conf_evento_padrao ?>" title="Nome do evento ao qual está liberando a Prova/Evento. Se preenchido o cliente não precisará preencher"></td>
									</tr>
									<tr>
										<td align="right" id="e_conf_instrutor_padrao">Palestrante / Instrutor :</td>
										<td><? $db->comboBox("select ins_id, ins_nome from instrutor " . (($conf_novo) ? " where ins_ativo = 'S'" : ""), $conf_instrutor_padrao, "conf_instrutor_padrao","","S", 'title="Instrutor que está aplicando a Prova/Evento. Se preenchido o cliente não precisará preencher"'); ?></td>
									</tr>
									<tr>
										<td align="right" id="e_conf_local_padrao">Local :</td>
										<td><input type="text" name="conf_local_padrao" id="conf_local_padrao" mxlength="50" size="50" value="<?=$conf_local_padrao ?>" title="Local da Prova/Evento. Se preenchido o cliente não precisará preencher"></td>
									</tr>									<tr>
										<td colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="2"><input name="BTNGravar" id="BTNGravar" type="button" value="Gravar" />
											&nbsp;
											<input name="BTNExcluir" type="button" id="BTNExcluir" value="Excluir" />
											&nbsp;
											<input name="BTNNovo" type="button" id="BTNNovo" value="Novo" />
											&nbsp;
											<input name="BTNVoltar" id="BTNVoltar" type="button"  value="Voltar" voltarPara=<?=$linkPagina ?>/></td>
									</tr>
								</table>
							</form>
							<!-- #EndEditable --></td>
            <td align="right" width="23%" valign="top" >
              <table width="100%" border="0" class="bgTabela">
                <tr bgcolor="#FFCC33" valign="top">
                  <td colspan="2" class="bgTabela">
                    <table width="90%" border="0" align="center">
                      <tr valign="top">
                        <td valign="top">
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                            <tr valign="top">
                              <td valign="top">
                                <table width="100%" border="0" class="bgTabela">
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
                                    <td class="TabelaPadrao"><a href="/servicosgerais/index.php"><font face="Verdana, Arial, Helvetica, sans-serif">Manuten&ccedil;&atilde;o</font></a>                                    </td>
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
                               </table>
                              </td>
                            </tr>
                          </table>
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                            <tr valign="top">
                              <td>
                                <table width="100%" border="0" class="bgTabela">
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
                                </table>
                              </td>
                            </tr>
                          </table>
                          <table width="100%" border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF" align="center">
                           <tr valign="top">
                             <td> <table width="100%" border="0" class="bgTabela">
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
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a>
        <br>
        <hr align="center">
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999">
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>
      </td>
    </tr>
  </table>
</div>
</body>
<!-- #EndTemplate --></html>