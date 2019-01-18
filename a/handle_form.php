<?
	require("scripts/conn.php");
	require("scripts/classes.php");
	require("scripts/cores.php");
	$id_usuario = $_GET["id_usuario"];
	$prioridade_id = $_GET["prioridade_id"];
?>
<?php
// Check variables
if (empty($_GET['acao'])) {
        die ('<span style="color:red;">Digite um número no id!</span>');
}

function getSql($ATipo, $AParametro) {
	global $id_usuario;
	global $prioridade_id;

	$sql = "select lido, ";
	$sql .= " datalidodestinatario, dataprevistaliberacao, ";
	$sql .= " horalidodestinatario,  ";
	$sql .= " chamado.sistema_id,  ";
	$sql .= " chamado.lido,  ";
	$sql .= " destinatario_id,  ";
	$sql .= " chamado.externo,  ";
	$sql .= " datauc,  ";
	$sql .= " horauc,  ";
	$sql .= " usuario.nome,  ";
	$sql .= " chamado.rnc, chamado.categoria_id, ";
	$sql .= " time_to_sec(horauc) horaucsec,  ";
	$sql .= " time_to_sec(horalidodestinatario) horalidosec,  ";
	$sql .= " chamado.id_chamado,  ";
	$sql .= " cliente_id,  ";
	$sql .= " u2.nome remetente,  ";
	$sql .= " sistema.sistema as sistema,  ";
	$sql .= " prioridade.prioridade,  ";
	$sql .= " prioridade.valor,  ";
	$sql .= " status.status as DescStatus,  ";
	$sql .= " chamado.dataa as DataAbertura,  ";
	$sql .= " Left(descricao, 100) as descricao  ";
	$sql .= "from  ";
	$sql .= " chamado ";
	$sql .= "  inner join usuario on usuario.id_usuario = chamado.destinatario_id  ";
	$sql .= "  inner join usuario u2 on u2.id_usuario = chamado.remetente_id  ";
	$sql .= "  inner join sistema on sistema.id_sistema = chamado.sistema_id  ";
	$sql .= "  inner join prioridade on prioridade.id_prioridade = chamado.prioridade_id  ";
	$sql .= "  inner join status on status.id_status = chamado.status  ";
	$sql .= "  left join rl_chamado_usuario_ordem uco on ((uco.id_chamado = chamado.id_chamado) and (uco.id_usuario = $id_usuario)) ";
	$sql .= "where chamado.visible = 1 and  ";
	if ($ATipo == 'prioridade') {
		$sql .= "destinatario_id = $id_usuario and prioridade_id = $AParametro ";
		$sql .= "and chamado.status <> 1 ";
	} else if ($ATipo == 'sistema') {
		$sql .= "destinatario_id = $id_usuario and sistema_id = $AParametro ";
		$sql .= "and chamado.status <> 1 ";
	} else if ($ATipo == 'cliente') {
		$sql .= "destinatario_id = $id_usuario and cliente_id = '$AParametro' ";
		$sql .= "and chamado.status <> 1 ";
	} else if (($ATipo == 'encaminhados') || ($ATipo == 'encaminhadosnl')) {
		$sql .= " remetente_id = $id_usuario and destinatario_id <> $id_usuario and chamado.status <> 1 ";
	} else if ($ATipo == 'recebidosPor') {
		$sql .= " remetente_id = $AParametro and destinatario_id = $id_usuario   and chamado.status <> 1 ";
	}
	 else if ($ATipo == 'novidades') {
		$sql .= "((destinatario_id=$id_usuario and lido=0) or  (consultor_id   =  $id_usuario and lidodono=0)) and chamado.status > 1 ";
	} else if ($ATipo == 'pasta') {
		$sql .= " chamado.id_chamado IN (select id_chamado from chamado_pasta where id_pasta =". $AParametro .") ";
	}


	$sql .= "order by  coalesce(uco.Ic_Ordem,0) desc, ";
	$sql .= " lido, prioridade desc, chamado.status,valor,  sistema, rnc, chamado.id_chamado ";//limit 15;";

	return $sql;

}

function getTitulo($ATipo, $AParametro) {
	if ($ATipo == 'prioridade') {
		$sql = "select * from prioridade where id_prioridade =". $AParametro;
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
		$prioridadev = $linha->valor;
		if ($prioridadev  <= 100) {
		$cor = "#ff0000";
		} else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
		$cor = "#FF6600";
		} else if ($prioridadev > 200) {
		$cor = "#009966";
		}
		$prioridade = "<b><font color=$cor>$linha->prioridade</font></b>";
		return "Por prioridade: $prioridade<br>";
	} else if ($ATipo == 'sistema') {
		return "Por sistema:";
	} else if ($ATipo == 'cliente') {
		return "Por cliente:";
	} else if ($ATipo == 'novidades') {
		return "Contatos não lidos:";
	} else if ( ($ATipo == 'encaminhados') | ($ATipo == 'encaminhadosnl')) {
		return "Encaminhados";
	} else if ($ATipo == 'pasta') {
		$sql = "select pasta.descricao from pasta where id_pasta =".$AParametro;
		$result = mysql_query($sql);
		$linha = mysql_fetch_object($result);
		return "pasta: <b>$linha->descricao</b><br><br />";
	} else {
		return "teste";
	}

}

/*

 Inicio

*/


	echo getTitulo($_GET['acao'], $_GET['id']);
	$sql = getSql($_GET['acao'], $_GET['id']);

	$result = mysql_query($sql) or die ($sql);
	while ( $linha = mysql_fetch_object($result) ) {

		$prioridadev = $linha->valor;
		if ($prioridadev  <= 100) {
		$cor = "#ff0000";
		} else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
		$cor = "#FF6600";
		} else if ($prioridadev > 200) {
		$cor = "#009966";
		}
		$prioridade = "<b><font color=$cor>$linha->prioridade</font></b>";

		$id_sistema = $linha->sistema_id;
		$extreno = $linha->extrno;
		$rnc = $linha->rnc;
		$categoria_id = $linha->categoria_id;

		$dataultimocontato = $linha->datauc;
		$datalidodestinatario = $linha->datalidodestinatario;

		$horaultimocontato = $linha->horauc;
		$horalidodestinatario = $linha->horalidodestinatario;

		$horalidosec = abs($linha->horalidosec);
		$horaucsec = abs($linha->horaucsec);

		$dataprevistaliberacao = dataOK($linha->dataprevistaliberacao);

		$lido = false;
		if ($dataultimocontato > $datalidodestinatario) {
			$lido = false;
		}
		if ($dataultimocontato <= $datalidodestinatario) {
			$lido = true;
		}

		if ($dataultimocontato == $datalidodestinatario) {
			if ($horaucsec > $horalidosec) {
				$lido = false;
			}
			if ($horaucsec <= $horalidosec) {
				$lido = true;
			}
		}

		$lido = $linha->lido;
		$remetente = $linha->remetente;

		$dataultimocontato = dataOk($dataultimocontato);
		$datalidodestinatario = dataOk($datalidodestinatario);

		$lidostr = "<font color=#FF0000>contato <strong>não</strong> lido por $linha->nome</font>";
		if ($lido) {
			$lidostr = "<font color=#0000FF>contato lido por $linha->nome</font>";
		}

        $lidostr .= " | uc ($remetente)  : $dataultimocontato $horaultimocontato | ul : $datalidodestinatario $horalidodestinatario | ";

        /*
		$lido = 1;
		if ( ($linha->destinatario_id==$id_usuario) and ($linha->lido==0) ) {
			$lido = 0;
		}
		*/


		/*
			Início testes de cores
		*/
			   $cor_fundo = CORES_DEFAULT;
               $cor_borda = "#6666FF";
			   $largura_borda = 0;
			   $rncTipo = "";

			   if ($externo) {
                 $cor_fundo = CORES_EXTERNO;
			   }

			   if ($id_sistema == 1024) {
                 $cor_fundo = CORES_QUALIDADE;
			   }
   			   $rncTipo = '';
			   if ($rnc == 1) {
			     $rncTipo = "<strong>Não conformidade</strong>";
			     if (!$teste) {
    				 $cor_fundo = "#cccccc";
				 } else {
                   $cor_fundo = "#$teste";
				 }
			   }

   			   if ($rnc == 3) {
			     $rncTipo = "<strong>Ação de Melhoria</strong>";
			   }
   			   if ($rnc == 2) {
			     $rncTipo = "<strong>Ação Preventiva</strong>";
			   }

			   if ($rnc == 4) {
			     $rncTipo = "<strong>Abertura de projeto</strong>";
			     if (!$teste) {
    				 $cor_fundo = "#caaccc";
					 $largura_borda = 2;
					 $cor_borda = BORDA_ACAOMELHORIA;
				 } else {
                   $cor_fundo = "#$teste";
				 }
			   }

			   if ( $categoria_id == CATEGORIA_ACAOMELHORIA) {
                 $cor_fundo = CORES_ACAOMELHORIA;
				 $cor_borda = BORDA_ACAOMELHORIA;
				 $largura_borda = 3;
			   }

		/*
			Fim Teste de cores
		*/

$Mostra = true;
$ApenasNaoLidos = false;

if ($_GET['acao'] == "encaminhadosnl")
	$ApenasNaoLidos = true;

if ($ApenasNaoLidos)
	if ($lido==1)
		$Mostra = false;

if ($Mostra) {
?>

<head>
<title>Inicio</title>
<meta http-equiv="refresh" content="600;URL=inicio.php">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="pt-br" />

<link rel="stylesheet" href="../a/stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style5 {font-family: Tahoma; font-size: 10px; }
.style7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif}
-->
</style>
</head>
<table width="100%" border="0" cellpadding="1" cellspacing="<?=$largura_borda ?>" bgcolor="<?=$cor_borda?>">
   <tr>

   <!--
     <td width="14%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFF2">
    -->
     <td width="14%"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="<?=$cor_fundo; ?>">

         <tr>
           <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
             <tr>
               <td width="26%" valign="top"><? if ($lido==0) {?> <img src="figuras/idea01.gif" alt="Novidades" width="16" height="22" align="absmiddle" /><?}?><strong><a href="historicochamado.php?id_chamado=<?=$linha->id_chamado?>"><?=number_format($linha->id_chamado,0,',','.')?></a></strong> (<strong><?=$linha->cliente_id?></strong>) </td>
               <td width="60%" valign="top"><?="$linha->DescStatus"?> [<strong><?=$linha->sistema?></strong>] [<?=$prioridade?>
                ]                 <?=$rncTipo?>
                 [dpl:
                 <?=$dataprevistaliberacao?>
]</td>
               <td width="14%" align="right" valign="top"><a href="javascript:abre_chamado(<?=$linha->id_chamado?>);">Ver Chamado </a>&nbsp;</td>
             </tr>
             <tr>
               <td colspan="3"><?=$linha->descricao?>...</td>
              </tr>
             <tr>
               <td colspan="3"><?=$lidostr?></td>
             </tr>
           </table></td>
         </tr>
       </table></td>
   </tr>
 </table>
<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
<?
 }
	}
//echo $sql;
?>
uc = data e hora do último contato | ul = data e hora da última leitura do chamado pelo destinatário<br />
dpl = data prevista de libera&ccedil;&atilde;o