<style>
		<!--
		.ZeroDia {color: #006600;}
		.UmDia {color: #CC3333; background-color: #DDFDD9}
		.DoisDias { color:#FF0000; background-color: #FFFFD2}
		.TresDias {color: #FF0000; background-color: #FEDFDE}
		-->
</style><?php
/*
 *  Fernando Nomellini
 * 17/05/2010
 * -------------------
 * Envia Email lembrando dos chamados a cada XXX dias do �ltimo contato,
 * sendo XXX configur�vel atrav�s do campo lembrete_dias na tabela usuario.
 *
 * O Pr�prio envio do lembrete � configur�vel atrav�s do flag lembrete_ativo.
 *
*/

require_once("scripts/conn.php");
require_once("scripts/classes.php");

$dias = 6;
$MANDAEMAIL = false;
$INSERECONTATO = true;
function emailOuvidor() {
	$sql = "select email from usuario where fl_ouvidor = 1";
	$result = mysql_query($sql);
	$email = "";
	while ($linha = mysql_fetch_object($result)) {
		$email .= ($email == "" ? $linha->email : ";" . $linha->email);
	}
	return $email;
}


function geraSqlCobranca($id_usuario, $dias) {

	$dias += 1;
	$sql = "select * from chamado where data_limite_$dias = CURRENT_DATE and status <> 1 and cliente_id <> 'DATAMACE'";

	$dias -= 0;

	$dia = Array();
	$dia[0] = "
	case dayofweek(c.datauc)
	             when 1 then (c.datauc + interval 4 day)
             when 4 then (c.datauc + interval 5 day)
             when 5 then (c.datauc + interval 5 day)
             when 6 then (c.datauc + interval 5 day)
             when 7 then (c.datauc + interval 5 day)
             else (c.datauc + interval 3 day)
       end = current_date()
	  ";

	$dia[1] = "       case dayofweek(c.datauc)
             when 1 then (c.datauc + interval 5 day)
             when 2 then (c.datauc + interval 4 day)
             when 3 then (c.datauc + interval 6 day)
             when 4 then (c.datauc + interval 6 day)
             when 5 then (c.datauc + interval 6 day)
             when 6 then (c.datauc + interval 6 day)
             when 7 then (c.datauc + interval 6 day)
       end = current_date()
	";

	$dia[2] = "       case dayofweek(c.datauc)
             when 1 then (c.datauc + interval 8 day)
             when 2 then (c.datauc + interval 7 day)
             when 3 then (c.datauc + interval 7 day)
             when 4 then (c.datauc + interval 7 day)
             when 5 then (c.datauc + interval 7 day)
             when 6 then (c.datauc + interval 7 day)
             when 7 then (c.datauc + interval 9 day)
       end = current_date()
	";

	$dia[3] = "       case dayofweek(c.datauc)
             when 1 then (c.datauc + interval 9 day)
             when 2 then (c.datauc + interval 8 day)
             when 3 then (c.datauc + interval 8 day)
             when 4 then (c.datauc + interval 8 day)
             when 5 then (c.datauc + interval 8 day)
             when 6 then (c.datauc + interval 10 day)
             when 7 then (c.datauc + interval 10 day)
       end = current_date()
	";

	$sql = "
select
		c.id_chamado,
		cli.cliente cli,
		cli.grau,
		c.Id_chamado_espera,
		c.cliente_id,
		u.nome,
		c.datauc,
        c.horauc,
		left(c.descricao, 500) descricao,
		c.dataprevistaliberacao,
		datediff(now(), c.dataprevistaliberacao) diasPrazo,
       datediff(now(),
       case  dayofweek(c.datauc)
             when 1 then (c.datauc + interval 4 day)
             when 4 then (c.datauc + interval 5 day)
             when 5 then (c.datauc + interval 5 day)
             when 6 then (c.datauc + interval 5 day)
             when 7 then (c.datauc + interval 5 day)
             else (c.datauc + interval 3 day)
       end) as dias,
       case  dayofweek(c.datauc)
             when 1 then (c.datauc + interval 4 day)
             when 4 then (c.datauc + interval 5 day)
             when 5 then (c.datauc + interval 5 day)
             when 6 then (c.datauc + interval 5 day)
             when 7 then (c.datauc + interval 5 day)
             else (c.datauc + interval 3 day)
       end limite

from
     chamado c
	   inner join categoria ca on ca.id_categoria = c.categoria_id
       inner join usuario u on u.id_usuario = c.destinatario_id
       inner join cliente cli on cli.id_cliente = c.cliente_id
where
     1 = 1
	 and ca.pos_venda <> 1
	 and c.descricao <> ''
	 and c.destinatario_id = $id_usuario
     and id_chamado_espera = 0
     and c.prioridade_id <> 4
     and c.visible = 1
     and c.status <> 1
     and c.cliente_id <> 'DATAMACE'
     and u.fl_recebe_cobranca = 1
     and
     (
	 	$dia[$dias]
     )
order by nome, grau, datauc desc
";
	return $sql;
}

function geraEmail($dias) {
}







  $ouvidor = emailOuvidor();

$sql = "
select
  u1.nome,
  u1.id_usuario,
  u1.email,
  u2.nome nomegestor, u2.email emailgestor
from
  usuario u1
    inner join usuario u2 on u2.id_usuario = u1.superior
where
  u1.fl_recebe_cobranca = 1
order by
  nome
";

  $result = mysql_query($sql);

  $now = date("G:i:s") ;
  $hoje = date("Y-m-d");

  $agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
  $soma1dia = mktime(-2, 0, 0,  1, 2, 1970);
  $amanha = date("Y-m-d",$agora+$soma1dia);
  $data = date("d/m/Y", $agora+$soma1dia) ;

  $headers  = "MIME-Version: 1.0\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\n";
  //$headers .= "From: Lembrete de chamado SAD<agenda@datamace.com.br>\n";

  $textEmail = '<style type="text/css">';
  $textEmail .= "
		<!--
		.ZeroDia {color: #006600;}
		.UmDia {color: #CC3333; background-color: #DDFDD9}
		.DoisDias { color:#FF0000; background-color: #FFFFD2}
		.TresDias {color: #FF0000; background-color: #FEDFDE}
		-->
  ";
  $textEmail .= '<!-- a:hover {color: #FF0000;text-decoration: underline;}a {	color: #003366;	text-decoration: none;}--></style>';
  $textEmail .= '<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Sistema de Atendimento Datamace<br><br>';
  $textEmail .= "</font>";


  while ($linha=mysql_fetch_object($result)) {



    $emailpadrao =  $linha->email;
	$id_usuario = $linha->id_usuario;
	$NomeGerente = $linha->nomegestor;
	$EmailGestor = $linha->emailgestor;

	$copias = "";

	for ($dias = 0; $dias <= 3; $dias++)
	{

		if ($dias == 0)
			$subject = "VENCIMENTO DE PRAZO !!!";
		else
			$subject = "COBRANÇA DE ANDAMENTO " . ($dias) . " - $linha->nome";



		$sql_check = getaSQLVerificaFeriados($id_usuario);
		$result_check = mysql_query($sql_check) or die(mysql_error());
		while ($linha_check = mysql_fetch_object($result_check)) {

		}




		$sql2 = geraSqlCobranca($id_usuario, $dias);
		$result2 = mysql_query($sql2) or die(mysql_error());
		$compr = mysql_affected_rows();

		$result2 = mysql_query($sql2) or die(mysql_error());

		if ( $compr>0 ) { 	// se o cara tem compromisso:

			$compromissos = "<p align=center>";
			if ($dias == 0) {
				$compromissos .= "<span class=\"ZeroDia\">ATENÇÃO !!! VENCE HOJE";
			}


			if ($dias == 1) {
				$compromissos .= "<span class=\"UmDia\">COBRAN&Ccedil;A DE ANDAMENTO - UM DIA DE ATRASO";
			}

			if ($dias == 2) {
				$copias .= $linha->emailgestor;
				$compromissos .= "<span class=\"DoisDias\">COBRAN&Ccedil;A DE ANDAMENTO - DOIS DIAS DE ATRASO";
			}

			if ($dias == 3) {
				$copias .= ";" . $ouvidor;
				$compromissos .= "<span class=\"TresDias\">COBRAN&Ccedil;A DE ANDAMENTO - TR&Ecirc;S DIAS DE ATRASO";
			}

			$compromissos .= "<br>$compr chamado(s)  - <strong>$linha->nome </strong></span></p>";

			$compromissos .= '<table  width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"><tr bgcolor="#003366"> ';
			$compromissos .= '<td width="10%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Data último contato</font></strong></td>';
			$compromissos .= '<td width="10%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Data Limite</font></strong></td>';
			$compromissos .= '<td width="5%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Chamado</font></strong></td>';
			$compromissos .= '<td width = "80%"><strong><font color="#FFFFFF" size="2" face="Tahoma">Descrição</font></strong></td>';
			while ($linha2=mysql_fetch_object($result2)) {

				$grau = AcertaGrau($linha2->grau);
				$cliente = $linha2->cli;
				$id_chamado = $linha2->id_chamado;

				/*
					Ao retirar o coment�rio da linha abaixo, o sistema ir� gerar um contato para cada chamado listado
				*/
				if ($INSERECONTATO)
				{
					if ($dias > 0) {
						insere_contato($id_chamado, $id_usuario, $dias);
					}
				}

				$prazo = "";
				if ($linha2->dataprevistaliberacao <> '0000-00-00')
				{
					$diasPrazo = $linha2->diasPrazo;

					if ($diasPrazo > 0) {
						if ($diasPrazo == 1) {
							$m = "Venceu Ontem";
						} else if ($diasPrazo == 2) {
							$m = "Venceu Anteontem";
						} else {
							$m = "Venceu fazem $diasPrazo dias";
						}
						$m = "<font color=ff0000>$m !!!!</font>";
					} else {
						$diasPrazo *= -1;
						if ($diasPrazo == 0) {
							$m = "VENCE HOJE !!";
						} else if ($diasPrazo == 1) {
							$m = "VENCE AMANHÃ !";
						} else if ($diasPrazo == 2) {
							$m = "Vence depois de amanhã ";
						} else {
							$m = "Faltam $diasPrazo para vencer o prazo";
						}
						if ( $diasPrazo < 5 ) {
							$m = "<font color=ff0000>$m!</font>";
						}
						$diasPrazo *= -1;
					}
					$prazo = "<br/><b>Prazo: " . DataOk($linha2->dataprevistaliberacao) . " (" . $m . ") </b>";
				}

				$espero = conn_PegaAguardandoChamado($id_chamado);
				$dependemDeste = conn_PegaChamadosAguardando($id_chamado);

				$compromissos .= ' <tr bgcolor="#FFFFFF"> ';
				$compromissos .= "    <td align=\"center\" valign=\"middle\"><font size=2 face=Tahoma>".DataOk($linha2->datauc) . "</font></td>";
				$compromissos .= "    <td align=\"center\" valign=\"middle\"><font size=2 face=Tahoma> " . DataOk($linha2->limite) . " " . $linha2->horauc . "</font></td>";
				$compromissos .= "    <td align=\"center\" valign=\"middle\"><font size=\"2\" face=\"Tahoma\"><a href=\"http://10.98.0.5/a/historicochamado.php?id_chamado=$linha2->id_chamado\"> $linha2->id_chamado </a></font></td>";
				$compromissos .= "    <td><font size=\"2\" face=\"Tahoma\"><b>$grau - $linha2->cliente_id - $cliente<br/></b> $linha2->descricao</font>$dependemDeste $espero $prazo</td>";
				$compromissos .= '  </tr>';
				//$compromissos .= " <tr bgcolor='#FFFFFF'><td colspan=2>$nomes</td></tr>";
				}
				$compromissos .= "</table>
				<p>";
		}

		if ($compr>0)  {





			if ($MANDAEMAIL == true) {
				$headers  = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";
				$headers .= "From: COBRANÇA DE ANDAMENTO SAD<agenda@datamace.com.br>\n";
				$headers .= "CC: $copias";
				mail($emailpadrao, $subject, $textEmail.$compromissos, $headers);
			} else {
				echo $compromissos;
			}
		}



	} /// FIM FOR


  }

  function insere_contato($id_chamado, $id_usuario, $dias)
  {

		$datae = date("Y-m-d");
		$horae = date("H:i:s");
		$objChamado = new chamado();
		$objContato = new contato();
		$objChamado->lerChamado($id_chamado);
		$id_destinatario = $objChamado->destinatario_id;
		$id_contato_cliente = $objContato->novocontato($id_chamado, 141, $id_usuario, $datae, $horae);
		$objContato->lerContato($id_contato_cliente);
		$objContato->origem_id = 21 + $dias;
		$objContato->datae = $datae;
		$objContato->horae = $horae;
		$frasepadrao = "Cobrança de andamento";
		$objContato->historico = "$frasepadrao";
		$objContato->gravaContato();

  }

?>
