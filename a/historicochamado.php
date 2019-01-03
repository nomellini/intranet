<form name="drag1">
	<input type="hidden" name="id_chamado">
   	<input type="hidden" name="id_contato">
</form><?
	$PermiteReplicarChamado = false;
	$NunesId = 141;
	$FernandoId = 12;
	$DeboraId = 63;
	$HelioId = 3;
	$JanainaQueirogaId = 187 ;
	$JessikaId = 86;
	$LucasId = 175;
	$RosangelaId = 240;

	require("cabeca.php"); 

	/*
	if ($ok == 14)
	{
		$pode = conn_ExecuteScalar("select count(1) from chamado where destinatario_id = $ok and id_chamado = $id_chamado") != 0;
		if (!$pode)
			die('Eneas, veja os <b>seus</b> chamados...');
	}
	*/

	require("scripts/classes_programas.php");

	$diasComContato = conn_ExecuteScalar("select count(distinct(dataa)) dias from contato  where chamado_id = $id_chamado");


	$lista = new ChamadoProgramas($id_chamado);
	$Programas = $lista->Programas;
	$TemProgramas = count($Programas) > 0;

	if (isset($_POST["action"]))
	{
		$Acao = $_POST["action"];
		if ($Acao == "novoPrograma") {
			if ( $_POST["txtPrograma"] != "") {
				AdicionarPrograma($_POST["txtPrograma"], $_POST["txtObs"], $ok, $id_chamado);
			}
		} else if ($Acao == "commit") {
			CommitPrograma($ok, $id_programa, $id_chamado);
		} else if ($Acao == "tirarcommit") {
			TirarCommitPrograma($ok, $id_programa, $id_chamado);
		} else if ($Acao == "excluirprograma") {
			ExcluirPrograma($ok, $id_programa, $id_chamado);
		}

	} else {
		loga_viuChamado($ok, $id_chamado);
	}



	if  ($action == "novaOrdem")
	{

		$comando = "select coalesce(max(Ic_ordem)+1, 1) m from rl_chamado_usuario_ordem inner join chamado c on c.id_chamado = rl_chamado_usuario_ordem.Id_chamado where  c.status <> 1  and c.destinatario_id = $ok and Id_Usuario = $ok and c.Id_chamado != $id_chamado";
		$query = mysql_query($comando) or die (mysql_error() . " -- " . $comando);
		$linha = mysql_fetch_object($query);
		$max = $linha->m;
		if ($ic_Ordem >= $max)
		{
			$ic_Ordem = $max;
		}

		if ($ic_Ordem == 0)
		{
			$comando = "delete from rl_chamado_usuario_ordem where id_usuario = $ok and id_chamado = $id_chamado";
		} else {
					$comando = "insert into rl_chamado_usuario_ordem (id_usuario, id_chamado, ic_ordem)  values ($ok, $id_chamado, $ic_Ordem) on duplicate key update ic_ordem = VALUES(ic_Ordem)";
		}

		mysql_query($comando) or die (mysql_error() . " -- " . $comando);

	}

	$Rascunho = FuncoesPegaRascunho($id_chamado, $ok);
	$DemaisRascunhos = FuncoesPegaDemaisRascunho($id_chamado, $ok);

	$SouGestor = pegaGestor($ok);

	$eneas = false;//($ok == 14);
    $fernando = ($ok == $FernandoId);
	$debora = ($ok == $DeboraId);
	$nunes = ($ok == $NunesId);
	$helio = ($ok == $HelioId);
	$JanainaQueiroga = ($ok == $JanainaQueirogaId) ;
	$Jessika = ($ok == $JessikaId);
	$Lucas = ($ok == $LucasId);
	$Rosangela = ($ok == $RosangelaId);

	$Area = pegaArea($ok);
	$developer = (($Area == 2) || ($Area == 3));


	$PermiteReplicarChamado = ( $fernando || $debora || $Jessika || $JanainaQueiroga || $Lucas || $Rosangela);


	$EditaChamado = connPodeEditarChamado($ok);

	$chamados=pegaChamado($id_chamado);

	$objChamado = new chamado();
	$objChamado->LerChamado($id_chamado);


	$EncerraAutomatico = $objChamado->prioridade_id == 4;
	$DataEncerramentoAutomatico = AMD2DMA($objChamado->Dt_EncerramentoAutomatico);

	// Quais chamados dependem deste aqui
	$ChamadosAguardando = conn_PegaChamadosAguardando($id_chamado);

	if (count($chamados) == 0) {
	  header("location: inicio.php?semresultado=1");
	}

	loga_online($ok, $REMOTE_ADDR, $id_chamado);
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));
    $atendimento = $tmp["atendimento"];

	list($tmp1, $chamado) = each($chamados);

	$rnc = $chamado["rnc"];

	$isProject = $rnc == 4;

    $diagnostico = $chamado["diagnostico"];
	$id_cliente = $chamado["id_cliente"];
	$categoria = $chamado["categoria"];
	$motivo = $chamado["motivo"];
	$id_sistema = $chamado["sistema_id"];

	$SistemaNome = pegaSistema($id_sistema);
	$LinkGrhNet = obterLinkGrhNetTeste($SistemaNome);

	$destinatario = pegaNomeUsuario($chamado["destinatario_id"]);

	$sqlUsuario = "select nome, ramal, email from usuario where id_usuario = " . $chamado["consultor_id"];
	$Dono = mysql_fetch_object(mysql_query($sqlUsuario));
	$abertopor = "<a href=\"mailto:$Dono->email?subject=Chamado $id_chamado\">$Dono->nome</a> ($Dono->ramal)";


	$destinatario_id = $chamado["destinatario_id"];
	if ($ok == $destinatario_id) {
		$nowTime = date("G:i:s");
		$nowDate = date("Y-m-d");
		$sql = "update chamado set lido = 1, datalidodestinatario = '$nowDate',  horalidodestinatario = '$nowTime' where id_chamado = $id_chamado";
		mysql_query($sql);
	}

	if ($ok == $chamado["consultor_id"] ) {
	  $sql = "update chamado set lidodono = 1 where id_chamado = $id_chamado";
	  mysql_query($sql);
	}


	if ( ($ok == $destinatario_id) || ($ok == $chamado["consultor_id"] ))
		if ($ligarLampada==1)
		{
			$sql = "update chamado ";
			if ($ok == $destinatario_id) {
				$sql .= "set lido = 0, ";
			}
			if ($ok == $chamado["consultor_id"] ) {
				$sql .= "lidodono = 0, ";
			}
			$sql .= " datalidodestinatario = '$nowDate',  horalidodestinatario = '$nowTime' where id_chamado = $id_chamado";
			mysql_query($sql);
			header("location: inicio.php");
		}



    list($tmp1, $tmp) = each(pegaClientePorCodigoUnico($id_cliente));
	$cliente = strtoupper($tmp["cliente"]);
	$senha = $tmp["senha"];
	$endereco = $tmp["endereco"];
	$bairro = $tmp["bairro"];
	$cidade = $tmp["cidade"];
	$telefone = $tmp["telefone"];
	$ddd = $tmp["ddd"];
	$id_cliente = $tmp["id_cliente"];

	$UsaBanco = ($tmp["usa_banco"] == 1);
	$msgBanco = "";
	if ($UsaBanco)
	{
		$msgBanco = "<br /><b>Este cliente utiliza base SQL SERVER</b><br />";
	}

	$ClienteDatacenter = '';
	$ClienteIntersystem = '';
	$sql = "select Ic_Intersystem, Ic_Datacenter, Ic_SLA, Qt_SLA, Ic_PosVenda from clienteplus where id_cliente = '$id_cliente'";
	$result = mysql_query($sql); $linha=mysql_fetch_object($result);
	$ClienteIntersystem = $linha->Ic_Intersystem ? "<BR/><BR/><B><FONT COLOR=ff0000>INTERSYSTEM SERVIÇOS</font></b><BR/>" : "" ;
	$ClienteDatacenter = $linha->Ic_Datacenter ? "<BR/><B><FONT COLOR=ff0000>---> USA DATACENTER <---</font></b><BR/>" : "" ;
	$inter = $linha->Ic_Intersystem == 1;

	$Qt_SLA = $linha->Qt_SLA;
	$ClienteSLA = '';
	$ClienteSLAMsg = $linha->Ic_SLA ? "cliente com SLA diferenciado : $Qt_SLA" : '';
	$ClienteSLA = $linha->Ic_SLA ? "<BR/><B><FONT COLOR=ff00000>---> cliente com SLA diferenciado  : $Qt_SLA : 348640 <---</font></b><BR/>" : "" ;
	$ClientePosVenda = '';
	$ClientePosVenda = $linha->Ic_PosVenda ? "<BR/><BR/><B><FONT COLOR=ff00000>---> ! PÓS VENDA ! <---</font></b><BR/>" : "" ;



	$bl = 0;
	if (!$inter) {
	    $bl = $tmp["bloqueio"];
	}

	$grau = "[" . AcertaGrau($tmp["grau"]). "]";

	/*
	   Qualquer alteração aqui deve ser feita em Historico.PHP, pois o c�digo  � o mesmo
	*/
	$EditaChamadoBloqueado = connPodeEditarChamadoBloqueado($ok);
    if ( $EditaChamadoBloqueado ) {
	  $bl=0;
	}

	$podeLiberar = 0;
	if (
	     ($ok == 9 ) or
	     ($fernando) or
	     ($ok == 1 ) or
		 ($ok == 8 ) or
		 ($ok == 7 )
		) {
    	$podeLiberar =1;
	}


    // Aqui devo colocar uma op��o que vai ordenar os contatos por data ou data desc



	if ($ordem) {
	  $ord = "";
	  $linkOrdem = "historicochamado.php?&id_chamado=$id_chamado";
	} else {
	  $ord = "desc";
	  $linkOrdem = "historicochamado.php?&id_chamado=$id_chamado&ordem='certa'";
	}


	if ($filtro_id_consultor <> 0) {
		$contatos = historicoChamadoFiltro($id_chamado, $filtro_id_consultor,  $ord);
	} else {
		$contatos = historicoChamado($id_chamado, $ord);
	}

    $UltimoContato =count($contatos);
	$Ccontador = $UltimoContato + 1;


    $total_pendentes = count($chamadosemaberto);
	$objChamado = new chamado();
	$objChamado->lerChamado($id_chamado);



//	if ($objChamado->status == 1) {
//		if ($id_chamado <= 257197) {
//			  header("Location: ../a-bkp/historicochamado.php?id_chamado=$id_chamado");
//			  die("");
//		}
//	}



	$diasDecorridos = $objChamado->diasDecorridos;

	$status = pegaStatus( $objChamado->status );


	$categoria_desc =  $objChamado->categoria;
	$isPosVenda = $objChamado->pos_venda;
	$pos_venda = "";
	if ($isPosVenda) {
		$pos_venda = "<b>P�S-VENDA<br/></b>";
		$categoria_desc =  "<h1>$categoria_desc</h1>";
	}


	$espero = $objChamado->dependo_de;
	if ($espero) {
		$espero = conn_PegaAguardandoChamado($objChamado->id_chamado);
	} else {
		$espero = "";
	}

	if ( $objChamado->status <> 1 ) {
	  $status = "<font color=#FF0000>".$status."</font>";
	} else {
      $status = "<font color=#0000FF>".$status."</font>";
	}

	$prioridade = pegaPrioridade($objChamado->prioridade_id);
	$prioridade = "<b>$prioridade</b>";

	if ($objChamado->dataprevistaliberacao == '0000-00-00') {
		$DataLiberacao = 'Sem data definida';
	} else {
		$DataLiberacao = explode('-', $objChamado->dataprevistaliberacao);
		$DataLiberacao = "$DataLiberacao[2]/$DataLiberacao[1]/$DataLiberacao[0]";
	}


	$projeto_desc = FuncoesObterDescricaoChamadoPai( $id_chamado );
	$sqlTempoTotal = "select sum(time_to_sec(co.horae)-time_to_sec(co.horaa)) tempo from chamado ch  inner join contato co on co.chamado_id = ch.id_chamado where chamado_pai_id = $id_chamado or (id_chamado=$id_chamado)";
	$result = mysql_query($sqlTempoTotal); $linha=mysql_fetch_object($result);
	$TempoTotal = sec_to_time( $linha->tempo);



?>
<script>

  function seleciona() {
    window.name = "pai";
    value = document.form.clientecodigo.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }
</script>
<html>
<head>
<title><?=$id_chamado?> - <?=$objChamado->descricao?> : Hist&oacute;rico</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link href="sgq/attendere.css" rel="stylesheet" type="text/css">

<!-- Toastrs -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./js/toastr.js"></script>
<link href="./css/toastr.css" rel="stylesheet" />


<style type="text/css">
<!--
		.dragTest {
			background-color:#e0f0e0;
			width: 65px;
			text-align:center;
			float:left;
		}

		.dragTestSimples {
			background-color:#B2F0F1;
			width: 85px;
			text-align:center;
			float:left;
		}

#drag_me{
    -webkit-user-drag: element;
}
.style7 {
	font-family: Arial, Helvetica, sans-serif
}
.style8 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<body background="../agenda/figuras/fundo.gif" leftmargin="1" topmargin="1" marginwidth="1" marginheight="1">
<SCRIPT LANGUAGE="JavaScript" SRC="overlib.js"></SCRIPT>
<script src="coolbuttons.js"></script><img src="../Sadzinho.jpg" width="900" height="79">
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center">
    <td width="61" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="69" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="82" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
    <td width="115" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar
      Senha</a></td>
    <td width="129" class="coolButton"><a href="inicio.php"><img src="figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar
      ao in&iacute;cio</a></td>
    <td width="259" class="coolButton"><a href="../index.php" target="_blank">Intranet</a></td>
  </tr>
</table>
<hr size="1" noshade>
<div align="center">
  <table width="98%" border="0">
    <tr>
      <td width="31%"><font size="2">Sistema de Atendimento Datamace</font></td>
      <td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
          <tr bgcolor="#FFFFFF">
            <form action="historico.php" method="post" name="formx" target="_blank" id="formx">
              <td align="left" valign="top"><div align="center"><font color="#0000FF"><b>
                  <input type="hidden" name="action2">
                  </b></font><font size="2"></font><font color="#0000FF"><b>
                  <input name="id_cliente" type="text" class="bordaTexto" id="id_cliente" title="Digite o n&uacute;mero do chamado ou o cliente e tecle enter">
                  </b>
                  <input name="hist" type="submit" class="bordaTexto" id="hist" title="Digite o n&uacute;mero do chamado ou do cliente na caixa de texto ao lado." value="Ver hist&oacute;rico" >
                  </font></div></td>
            </form>
          </tr>
        </table></td>
      <td width="27%"><div align="right"><font size="2">Usu&aacute;rio <font color="#FF0000">:<b>
          <?=$nomeusuario?>
          </b></font></font></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" class="CorBordaTabelaSad">
    <tr class="CorFundoTabela">
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="SubitemSad">
          <tr >
            <td width="9%" align="center" valign="middle" class="TituloSubitemSad"><font size="2"> Chamado </font></td>
            <td width="14%" align="center" valign="middle" class="TituloSubitemSad"><font size="2"> Data
              da abertura </font></td>
            <td width="13%" align="center" valign="middle" class="TituloSubitemSad"><font size="2"> Hora
              de abertura </font></td>
            <td colspan="2" class="TituloSubitemSad"><font size="2"> Cliente </font></td>
            <td width="17%" class="TituloSubitemSad"><div align="center"> <font size="2"> Status </font> </div></td>
          </tr>
          <tr >
            <td width="9%" align="center"><div align="center"> <font color="#FF0000"><b> <font size="3">
                <?=trim(number_format($id_chamado,0,',','.'))?>
                </font></b> </font> </div></td>
            <td width="14%" align="center"><div align="center"> <font size="2"> <strong>
                <?=$objChamado->dataaf?>
                <br>
                <?=DiaDaSemana($objChamado->dataaf);?>
                </strong> </font> </div></td>
            <td width="13%" align="center"><div align="center"> <font size="3"> <strong>
                <?=$objChamado->horaa?>
                </strong> </font> </div></td>
            <td colspan="2" valign="top"><font size="2">
              <?
		 $msg = "<b>$cliente [$id_cliente] $grau</b> ($senha) $ClienteIntersystem $ClienteDatacenter $ClienteSLA";
		 $msg = "<a target=\"_blank\" href=\"/a/historico.php?id_cliente=$id_cliente\">$msg</a>";

		 if ($bl) { $msg="<b><font color=#ff0000>$cliente [$id_cliente] (bloqueado)</font></b>" ;}
		 $msg .= "<br> Fone : ($ddd) $telefone";
         $msg .= " - <a href=\"javascript:selecionapessoa('$id_cliente')\">Contatos</a>";
		 echo $msg;
		 echo "<font color=#FF0000>" . $msgBanco . "</font>";
		?>
              </font></td>
            <td width="17%"><div align="center"> <b> <font size="3">
                <?=$status?>
                <br>
                <?="$prioridade"?>
                </font> </b> </div></td>
          </tr>
          <tr >
            <td align="right" class="TituloSubitemSad">Sistema&nbsp;</td>
            <td colspan="2" class="TituloSubitemSad"><strong>
              <?=$SistemaNome?>
              </strong></td>
            <td width="14%" align="right" class="TituloSubitemSad">Categoria &nbsp;</td>
            <td colspan="2" class="TituloSubitemSad"><strong>
              <?=$categoria_desc?>
              </strong></td>
          </tr>
          <tr class="TituloSubitemSad" >
            <td align="right"><font size="1"> Aberto por&nbsp; </font></td>
            <td colspan="2"><font size="1"> <strong>
              <?=$abertopor?>
              </strong> </font></td>
            <td align="right"><font size="1"> Este chamado est&aacute; com&nbsp; </font></td>
            <td colspan="2"><font size="1"> <strong>
              <?=$destinatario?>
              </strong> </font></td>
          </tr>
          <tr class="TituloSubitemSad" >
            <td align="right">Diagn&oacute;stico&nbsp;</td>
            <td colspan="2"><strong>
              <?=pegaDiagnostico($diagnostico)?>
              </strong></td>
            <td colspan="2">&nbsp;</td>
            <td align="center" valign="middle"> Libera&ccedil;&atilde;o em </td>
          </tr>
          <tr class="TituloSubitemSad" >
            <td align="right"> Motivo&nbsp;</td>
            <td colspan="4"><strong>
              <?=pegaMotivo($motivo)?>
              </strong></td>
            <td align="center"><p><strong>
                <?=$DataLiberacao?>
                </strong>
                <?
			if ($podeLiberar==1) {
			?>
                <br>
                [<a href="javascript:dataprevista(<?=$id_chamado?>, <?=$ok?>);">Editar Data Libera&ccedil;&atilde;o</a>]
                <?
			}
			?>
              </p></td>
          </tr>
          <tr >
            <td colspan="6"><p> <i><br>
                <font size="2"> &nbsp;Descri&ccedil;&atilde;o </font> </i>

              <blockquote>
                <p> <font size="2"> <font color="#0000FF"> <strong>
                  <?
		    $descricao = $chamado["descricao"];
		  	if ($palavra) {
              $descricao = eregi_replace($palavra, "<b><font  color=#FF0000>$palavra</font></b>", $descricao);
            }

			$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4" target="_blank">$2$3$4</a>', $descricao);

			$descricao = preg_replace("/(\[)([0-9]{0,3})([.])?([0-9]{0,3})(\,)([\s])?([0]{0,3})([0-9]{0,3})(\])/", '<a href="historicochamado.php?id_chamado=$2$4#c_$8" target="_blank">$2$3$4 [$7$8]</a>', $descricao);

			//$descricao = eregi_replace("C",'A',$descricao);

			//$descricao = eregi_replace("<br />", "", $descricao);
			$descricao = nl2br($descricao);
			?>
                  <?= $descricao;?>
                  <?= $ClientePosVenda ;?>

                  <?
                  if ($EncerraAutomatico) {
					  echo "<br><br><div class=\"CalendarFeriado\">Sera encerrado automaticamente em $DataEncerramentoAutomatico</div><br>";
				  }
				  ?>

                  <?= $projeto_desc; ?>
                  </strong> <br>
                  <?= $ChamadosAguardando?>
                  <?= $espero ?>
                  </font> </font> </p>
                </p>

                <?
				if ($objChamado->lido) {
				?>
                <input type="checkbox" checked="checked" disabled="disabled">Lido pelo destinatário<br><br>
                <?
				}
				?>

                <? if ($objChamado->Ds_ProgramaEspecial != "") {?>
              <div id="ProgramaEspecial"> Programa especial : <b><?=$objChamado->Ds_ProgramaEspecial?></b> </div>
                <? }?>

<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="60%">
<?
			   if ($Rascunho) {
              ?>
                <strong>Aten��o</strong>, Existe rascunho seu neste chamado - Para excluir entre em novo contato e em seguida "Cancelar Contato"<br><blockquote>
				<?=$Rascunho?>
                </blockquote>
			  <?
			   }
              ?>
              <?
			   if ($DemaisRascunhos) {
              ?>

                Chamados com rascunho seu :
              	<font color="#FF0000"><br>


                <?
				foreach($DemaisRascunhos as $tmp)
				{
					$IdChamadoRascunho = $tmp["id_chamado"];
					$TextoChamado = $tmp["texto"];
					if ($tmp["negrito"]) echo "<strong>";
					echo dataOk($tmp["data"]) . " " . $tmp["hora"] . " <a href=historicochamado.php?&id_chamado=$IdChamadoRascunho target=_new>$IdChamadoRascunho - $TextoChamado</a><br>";
					if ($tmp["negrito"]) echo "</strong>";
				}
				?>

                </font>
			  <?
			   }
              ?>
              <?= $LinkGrhNet?>

    </td>
    <td width="40%" align="center" valign="middle">
    <div class="TamanhoDoTextoDeVersaoERelease">
    	<?="$objChamado->Ds_Versao $objChamado->Dt_Release"  ?>
	</div>
    </td>
  </tr>
</table>




              <? if ($EditaChamado) { ?>
              <a href="manut/ec.php?userid=<?=md5($ok)?>&acao=ver&id=<?=$id_chamado?>">.</a><?php echo $tmp["contato_id"]; ?>
              <? } ?>
              <?	if ($PermiteReplicarChamado) { ?>
              <br>
              <br>
              <div style="text-align:center; font-size:12px"> <a href="javascript:ReplicarChamado.submit();">Replicar este chamado</a> </div>
              <form id="ReplicarChamado" method="post" action="manut/ReplicarChamado.php">
                <input name="Chamado_Id" type="hidden" value="<?=$id_chamado ?>">
              </form>
              <? } ?>

			  <?
			  	$restricoes = funcoesObterStatusRestricao($id_chamado);
				echo $restricoes["display"];
			  ?>

<form id="restricoes" method="post" action="AdicionaRestricaoChamado.php">
<?
  $restricoes = conn_obterListaRestricoes($ok, $id_chamado);
  if ($restricoes) {
?>
<br>
<br>
<a href="javascript:alterna(divRestricoes);">&nbsp;&nbsp;&nbsp; +Restriçõees</a>
<div id="divRestricoes" style="display:none">
<table border="0" cellspacing="1" cellpadding="1" >
  <tr>
    <td>&nbsp;</td>
    <td><b>Selecione as restri&ccedil;&otilde;es para adicionar a este chamado</b></td>
  </tr>
<?
	foreach ($restricoes as $linha) {
?>
  <tr>
    <td><input name="id_restricao[]" type="checkbox" id="id_restricao" value="<?=$linha["id"]?>"></td>
    <td><p>
      <?=$linha["descricao"]?>
    </p></td>
  </tr>
<?
  }
?>
  <tr>
  <td>
  </td>
  <td>
  <input type="submit" name="button" id="button" value="Adicionar">
<input type="hidden" name="id_chamado" id="id_chamado" value="<?=$id_chamado?>">
</td>
  </tr>

</table>
</div>
<?
	}
?>


<? if (true) {


	$sql  = "select Ic_Ordem from rl_chamado_usuario_ordem where Id_Usuario = $ok and Id_Chamado = $id_chamado";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ordemUsuario = $linha->Ic_Ordem;
	$ordemMax = 9999999;
	$ordemBaixo = $ordemUsuario;
	$ordemCima = $ordemUsuario + 1;
	if ($ordemUsuario > 0)
	{
		$ordemBaixo = $ordemUsuario - 1;
	}
?>
<br>p: <?=($ordemUsuario+1)?>
<a href="javascript:novaOrdem(<?=$id_chamado?>, <?=$ordemMax?>)"><img src="imagens/SadTopo.png" width="10" height="15" border="0" align="absbottom" title="Prioridade Máxima"></a><a href="javascript:novaOrdem(<?=$id_chamado?>, <?=$ordemCima?>)"><img src="imagens/Sad_Cima_Ordem.png" border="0" height="15" width="10" align="absbottom" title="Aumentar Prioridade"></a><a href="javascript:novaOrdem(<?=$id_chamado?>, <?=$ordemBaixo?>)"><img src="imagens/Sad_Baixo_Ordem.png" border="0" height="15" width="10" align="absbottom" title="Diminuir Prioridade"></a><a href="javascript:novaOrdem(<?=$id_chamado?>, 0)"><img src="imagens/SadBotton.png" width="10" height="15"  border="0" align="absbottom" title="Prioridade Mínima"></a>
<? } ?>
</form>

<?
   /* op��o para marcar como não lido - Inicio  */
	if ( ($ok == $destinatario_id) )
	{
?>
<form name="ligaLampada"><input type="hidden" value="1" name="ligarLampada"><input type="hidden" value="<?=$id_chamado?>" name="id_chamado"><a href="javascript:document.ligaLampada.submit();">Marcar como não lido</a><br>
  <br>

</form>
<?
   }
   /* op��o para marcar como não lido - fim */
?>

<?
	if ($TemProgramas)
	{
?>
	<table  border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td bordercolor="#FFFFFF" bgcolor="#0066FF"><span class="style8">Programa</span></td>
    <td bordercolor="#FFFFFF" bgcolor="#0066FF"><span class="style8">Comitado </span></td>
    <td bordercolor="#FFFFFF" bgcolor="#0066FF"><span class="style8">Respons�vel </span></td>
	    <td bordercolor="#FFFFFF" bgcolor="#0066FF"><span class="style8">Pacote</span></td>
	<? if ($developer) {?>
	    <td bordercolor="#FFFFFF" bgcolor="#0066FF"><span class="style8">Ação</span></td>
	<? }?>
  </tr>

  <?
  	foreach($Programas as $programa) {
		$id_programa = $programa->Id;
		$EuCriei = $programa->id_usuario == $ok;
		$Commitado = $programa->ic_commit;
		$checked = $Commitado ? 'checked' : '';

		$Botoes = "-";
		if ($EuCriei) {
			if ($Commitado)
			{
				$Botoes = " <input type=\"button\" value=\"Tirar Commit\" onclick='document.frmProgramas.id_programa.value=$id_programa; document.frmProgramas.action.value = \"tirarcommit\"; document.frmProgramas.submit(); '>";
			} else
			{
				$Botoes = " <input type=\"button\" value=\"Commit\"  onclick=\"document.frmProgramas.id_programa.value='$id_programa'; document.frmProgramas.action.value='commit'; document.frmProgramas.submit(); \" > / <input type=\"button\" value=\"Excluir\" onclick=\"document.frmProgramas.id_programa.value='$id_programa'; document.frmProgramas.action.value='excluirprograma'; document.frmProgramas.submit();\" >";
			}
		}
  ?>
  <tr>
    <td bgcolor="#FFFFFF"><?=$programa->nm_nome?></td>
    <td bgcolor="#FFFFFF"><div align="center">
      <input name="" type="checkbox" value="" <?=$checked?> disabled="disabled" readonly>
    </div></td>
    <td bgcolor="#FFFFFF" ><?=$programa->Responsavel?></td>
    <td bgcolor="#FFFFFF" ><?=$programa->ds_versao?></td>
	<? if ($developer) {?>
    	<td bgcolor="#FFFFFF" align="center"><?= $Botoes?></td>
	<? }?>
  </tr>
<?
	}
?>
</table><br>
<?
	}
?>
<-- Link para o chamado
<? echo "<div class=\"dragTestSimples\" style=\"-webkit-user-drag: element; -webkit-user-select:none;\"  draggable=\"true\" ondragstart=\"setDrag($id_chamado,'');return OnDragStart1(event)\">[$id_chamado]</div>";?>
<? echo "<div class=\"dragTest\" style=\"-webkit-user-drag: element; -webkit-user-select:none;\"  draggable=\"true\" ondragstart=\"setDrag($id_chamado,0);return OnDragStart2(event)\">Completo</div>";?>

<? if ($developer && !$_ReadyOnlyStatus) {?>
	<form name="frmProgramas" method="post">
	  <p>&nbsp;</p>
	  <table width="100%" border="0" cellspacing="1" cellpadding="1">
	    <tbody>
	      <tr>
	        <td><label for="txtNome">Programa</label>
              <input type="text" name="txtPrograma">
              <input type="submit" value="Adicionar Programa">
              <input type="hidden" name="id_chamado" value="<?=$id_chamado?>">
              <input type="hidden" name="id_programa" >
              <input type="hidden" name="action" value="novoPrograma"></td>
	        <td align="right">

	        </tr>
	      </tbody>
	    </table>


	  <p>&nbsp;</p>
	</form>
<? } ?>

		<input type="button" name="button2" id="button2" value="DOCUMENTAÇÃO" onClick="Documentacao()">


<?

//	echo "<br> Chamados que citam este : " ;
//	foreach( funcoes_ChamadosQueMeCitam($id_chamado) as $link )
//		echo $link  . " - ";

?>

            </td>
          </tr>
        </table></td>
    </tr>
  </table>

  <br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td>
            <? if (!$_ReadyOnlyStatus) { ?>
      <input type="button" name="Button" value="Novo Contato" class="NovoContato" onClick="javascript:document.form.action.value='contato';vai();">
            <? } ?>
      </td>
      <td valign="middle" align="center"><div align="center"> <font size="1"> [ <a href="<?=$linkOrdem?>"> Inverter ordem </a> ]
          <? if($rnc) {?>
          ::
          [ <a href="javascript:rnc();"> Imprime Relat�rio RNC </a> ] ::
          [ <a href="rnc/rnc.php?id_chamado=<?=$id_chamado?>"> Editar </a> ]
          <script>
  function rnc() {
     window.open('historicochamadornc.php?id_chamado='+<?=$id_chamado?>  , "Sele��o", "scrollbars=yes, height=600, width=700");
  }
            </script>
          <? } ?>
          :: [ <a href="sigame/dosigame.php?id_usuario=<?=$ok?>&id_chamado=<?=$id_chamado?>"> Incluir no Desktop &quot;SIGA-ME&quot; </a> ] </font>
          <? if ($isProject) { ?>
          <br><h3>Tempo total do projeto : <?=$TempoTotal?></h3>
          <? } ?>
        </div>
          <form name="frmFiltro" method="post" action="">
        <br>
        <div align="center"> <strong> <font size="2">
          <input type="hidden" name="id_chamado" id="id_chamado" value="<?=$id_chamado?>">
          Contatos Estabelecidos </font> </strong> (Filtrar contatos :
            <label for="filtro_id_consultor"></label>
            <select name="filtro_id_consultor" class="bordaTexto" id="filtro_id_consultor" onChange="javascript:frmFiltro.submit();">
              <option value="0">Todos</option>

<?

		$sql = "select distinct u.id_usuario, u.nome
					from contato c inner join usuario u on u.id_usuario = c.consultor_id
					where chamado_id = $id_chamado order by nome";
		$result = mysql_query($sql);
		while ($linha = mysql_fetch_object($result)) {
				$s = "";

				if ($linha->id_usuario == $filtro_id_consultor) {
					$s = "selected = 'selected'";
				}
?>

              <option value="<?=$linha->id_usuario?>" <?=$s?> ><?=$linha->nome?></option>
<?
		}
?>
            </select>
          )<br>
          (<span id="contatos"></span>) </div>
        </form>
          </td>
      <td align="right">
      <? if (!$_ReadyOnlyStatus) { ?>
      <input type="submit" name="Submit22" value="Novo Chamado" class="NovoContato" onClick="javascript:document.form.action.value='chamado';vai();">
      <? } ?>

      </td>
    </tr>
  </table>
  <br>
</div>

<!--
	Em 03.05.2011 - Fernando Nomellini. Troquei todo o conte�do da tabela de hist�rico
    para um include. Assim posso usar o mesmo no novo contato.

	INICIO
-->
<div align="center" style="font-size:16px" ><?= $ClienteSLA ?></div><br>
<? include("_historicochamadoPartial.php") ?>
<!-- FIM -->

<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr valign="middle" align="left">
    <td colspan="2">&nbsp;&nbsp;&nbsp;</td>
    <td width="42%">&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr valign="middle" align="left">
    <td width="46%" align="left"><a name="fim"></a>
          <? if (!$_ReadyOnlyStatus) { ?>
      <input type="button" name="Button" value="Novo Contato" class="NovoContato" onClick="javascript:document.form.action.value='contato';vai();">
          <? } ?>
      <br></td>
    <td width="12%" align="center">[<a href="javascript:history.go(-1);">voltar</a>]<br>
      [<a href="<?=$linkOrdem?>">inverter ordem</a>]</td>
    <td width="42%" align="right">
          <? if (!$_ReadyOnlyStatus) { ?>
    <input type="submit" name="Submit2" value="Novo Chamado" class="NovoContato" onClick="javascript:document.form.action.value='chamado';vai();">
          <? } ?>
    </td>
  </tr>
  <tr valign="middle" align="left">
    <td align="left" colspan="2"> Selecione esta op&ccedil;&atilde;o para dar <br>
      continuidade a este chamado. </td>
    <td width="42%" align="right">Selecione esta op&ccedil;&atilde;o para abrir
      um <br>
      novo chamado para este cliente. </td>
  </tr>
  <tr valign="middle" align="left">
    <td align="left" colspan="2">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr valign="middle" align="left">
    <td align="left" colspan="3"><p><strong>Inserir</strong> na pasta:<br>
        <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta not in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";

	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/addchamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}
?>
        <br>
        <strong>Mover</strong> para a pasta:<br>
        <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta not in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";

	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/moverchamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}
?>
        <br>
        <strong>Retirar</strong> da pasta:<br>
        <?
	$sql = "select id_pasta, descricao from pasta where pasta.id_usuario = $ok and ";
	$sql .= "pasta.id_pasta  in (select id_pasta from chamado_pasta where id_chamado = $id_chamado);";


	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	  $pasta = "&nbsp;&nbsp;-><a href=\"pastas/removechamadopasta.php?id_pasta=$id_pasta&id_usuario=$ok&id_chamado=$id_chamado\">";
	  $pasta .= $linha->descricao;
	  $pasta .= "</a><br>";
	  echo $pasta;
	}

?>
      </p>
      <p><a href="pastas/criarpasta.php?id_chamado=<?=$id_chamado?>&id_usuario=<?=$ok?>"><span class="style7"><img src="figuras/NovaPasta.jpg" alt="NovaPasta" width="25" height="25" border="0" align="absmiddle">Criar Pasta e incluir este chamado </span></a> </p></td>
  </tr>
</table>
<form name="form" method="post" action="novocontatochamado.php#Contato">
  <input type="hidden" name="chamado_id" value="<?=$id_chamado?>">
  <input type="hidden" name="id_ligacao" value="<?=$id_ligacao?>">
  <input type="hidden" name="cliente_id" value="<?=$id_cliente?>">
  <input type="hidden" name="horae" value="<?=date("H:i:s")?>">
  <input type="hidden" name="action">
</form>
<form name="form2" method="post" action="">
</form>
<p>
  <script>
  function vai() {
    if ('-<?=$bl?>' == '-1') {
	  toastr.error('Consultoria Bloqueada');
	  return;
	}


   if (  ( '-1' == '-<?=$atendimento?>') && ('<?=$id_cliente?>' != 'DATAMACE') && ('<?=$senha?>' == '00 000') ) {
//	  window.alert('Cliente Inativo');
//	  return;
	}


    document.form.submit();
  }

  if ('-<?=$sigame?>' != '-') {
    toastr.info('Chamado colocado na lista de SIGA-ME');
  }


  <?

	$diasDecorridos++;


	$diasDecorridos = $diasComContato;

  	$mm = ($diasDecorridos > 1) ? "s" : "";
	$dd = $diasDecorridos . " dia". $mm;
	$ss = ($UltimoContato > 1) ? "s" : "";

    $media = $segundos / $diasComContato / 60 / 60;
	$media = number_format($media, 2);

 ?>



	contatos.innerHTML = '<?php echo "$UltimoContato contato$ss consumindo $dd - duração : " . segTohora($segundos) . " - $media Hrs/Dia";?>';

</script>
  <script>
	function dataprevista(chamado, usuario) {
	  var newWindow;
	  window.name = "pai";
	  newWindow = window.open( 'lembrete/EditaDataPrevistaLiberacao.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
	}

	function EditaDuracao(contato) {
	  var newWindow;
	  window.name = "pai";
	  newWindow = window.open( 'EditaDuracao/EditaDuracao.php?id_contato='+contato, '', 'width=500, height=300');
	}


</script>
</p>

<form name="form_novaordem" id="form_novaordem" method="post" action="historicochamado.php?id_chamado=<?=$id_chamado?>" >
  <input type="hidden" name="id_chamado" >
  <input type="hidden" name="ic_Ordem" >
  <input type="hidden" name="action" value="novaOrdem">
</form>
<a href="javascript:abreLog()">.</a>
<script>
  function novaOrdem(chamado, ordem)
  {
	  document.form_novaordem.id_chamado.value = chamado;
	  document.form_novaordem.ic_Ordem.value = ordem;
	  document.form_novaordem.submit();
  }
</script>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<script type="text/javascript" language="javascript">
	if ( "<?=$anexo?>" == "true")
	{
		// window.alert("Por favor, anexe seu(s) arquivo(s)");
	}

function abreLog()
{
    window.open('historicochamadolog.php?id_chamado=<?=$id_chamado?>', "Sele��o", "scrollbars=yes, height=488, width=600");
}

function selecionapessoa(AClienteId) {
	window.open('selecionapessoaemail.php?id_chamado=<?=$id_chamado?>&cliente_id='+AClienteId,'','width=536, height=410');
}

function alterna(item){
 if (item.style.display=='none'){
   item.style.display='';
 } else {
   item.style.display='none'
 }
}


</script>
<?

	  $temMsg = false;

		$sql = "select
  u.nome, c.hora
from
  contato_temp c
    inner join usuario u on c.id_usuario = u.id_usuario
where
      c.id_usuario <> $ok and
      data = '" . date("Y-m-d") . "'
      and id_chamado = $id_chamado
order by hora ";


	  $msg = "Usuários trabalhando neste chamado\\n\\n";
	  $result = mysql_query($sql) or die (mysql_error() . " - " . $sql);
	  while ($linha = mysql_fetch_object($result)) {
		$temMsg = true;
	  	$msg .= "$linha->nome, desde às $linha->hora\\n";
	  }

	  mysql_free_result($result);

	  if ($temMsg) {
?>
<script>
  toastr.info( '<?=$msg?>' );
</script>
<?
		}  // End if tem mensagem

?>

<script>
function Documentacao()
{
    window.open('documentacao.php?id_chamado=<?=$id_chamado?>', "Sele��o", "scrollbars=yes, height=600, width=800");
}

<? if ($_ReadyOnlyStatus) { ?>
	toastr.info('<?=$_ReadyOnlyMessage ?>');
<? } ?>
</script>

<script type="text/javascript" src="js/dragEngine.js">
</script>

<script>
 if ('' != '<?=$ClienteSLA?>') {
 	toastr.info("<?=$ClienteSLAMsg?>");
 }
</script>
