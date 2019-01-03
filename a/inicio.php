<?
session_start();

require("cabeca.php");
require("scripts/cores.php");

define(ORDEM_MIN, -5);
define(ORDEM_MAX, 99999);

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

/*	require("scripts/conn.php");
	require("scripts/funcoes.php");
	require("scripts/cores.php");
	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}

	if($ok==14)
	{
		//header("Location: AcessoNegado.html");
	}
*/
	if (isset($acao))
	{
		if ($acao == "trocaramal")
		{
			$sql = "update usuario set ramal = '$ramal' where id_usuario = $id_usuario";
			mysql_query($sql);
		}
	}


	$sqlUsuario = "select nome, ramal, email from usuario where id_usuario = $ok";
	$Usuario = mysql_fetch_object(mysql_query($sqlUsuario));
	$MeuRamal = $Usuario->ramal;


	$agoraTimeStamp=date("Y-m-d H:i:s");
	$agora=strtotime($agoraTimeStamp);

	if ($acao=='novo_status') {
		if ($status != 2) {
			$sql = "update usuario set estado = $status_consultor, estado_hora = '$agoraTimeStamp' where id_usuario = $id_usuario";
			$result = mysql_query($sql);

			if ($status_consultor == 3)
				$sql = "update usuario set sat_idcliente = '$ausente_chamado' where id_usuario = $id_usuario";
			else
				$sql = "update usuario set sat_idcliente = '' where id_usuario = $id_usuario";
			$result = mysql_query($sql);
			//die ($sql);



		}

	}


    if ( ($acao=="mudaestadoconsultor") or  ($acao=="mudaestado") ) {


		$query_rsConsultores = "SELECT count(*) as qtde FROM usuario WHERE ativo = 1 and Estado = 2";

		$rsConsultores = mysql_query($query_rsConsultores) or die(mysql_error());

//		die($query_rsConsultores);

		$row_rsConsultores = mysql_fetch_assoc($rsConsultores) or die(mysql_error());
		$totalRows_rsConsultores = mysql_num_rows($rsConsultores) or die(mysql_error());



		if ( $row_rsConsultores['qtde'] >= 4) {
			$msg = "não pode alterar para não dispon?vel";
		} else {
			if ($acao=="mudaestado") {
				$status = $status + 1;
				if ($status==10) {
				  $status=3;
				} else {
					if ($status>=3) {
					  $status=1;
					}
				}
				$sql = "update usuario set estado = $status, estado_hora = '$agoraTimeStamp' where id_usuario = $ok";
				$result = mysql_query($sql);
			}

			if ($acao=="mudaestadoconsultor") {
				$status = $status + 1;

				// die( "$status, $ok");
				if ( ($status==2) and ($ok != 2)) {
				  $status = 3;
				} else if ($status >= 4) { $status=1;}
				$sql = "update usuario set estado = $status, estado_hora = '$agoraTimeStamp' where id_usuario = $id_consultor";
				$result = mysql_query($sql) or die (mysql_error() . ' <br> ' . $sql);
			}
		}
	}



?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


$query_rsStatusConsultor = "SELECT id, descricao FROM status_consultor where ativo";
$rsStatusConsultor = mysql_query($query_rsStatusConsultor) or die(mysql_error());
$row_rsStatusConsultor = mysql_fetch_assoc($rsStatusConsultor);
$totalRows_rsStatusConsultor = mysql_num_rows($rsStatusConsultor);

$colname_rsUsuario = "-1";
if (isset($_COOKIE['id_usuario'])) {
  $colname_rsUsuario = (get_magic_quotes_gpc()) ? $_COOKIE['id_usuario'] : addslashes($_COOKIE['id_usuario']);
}

$query_rsUsuario = sprintf("SELECT * FROM usuario WHERE id_usuario = %s", GetSQLValueString($colname_rsUsuario, "int"));
$rsUsuario = mysql_query($query_rsUsuario) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);


$query_rsEstadoConsulto = "SELECT * FROM status_consultor WHERE id = " . $row_rsUsuario['Estado'];
$rsEstadoConsulto = mysql_query($query_rsEstadoConsulto) or die(mysql_error());
$row_rsEstadoConsulto = mysql_fetch_assoc($rsEstadoConsulto);
$totalRows_rsEstadoConsulto = mysql_num_rows($rsEstadoConsulto);
?><?
	$sql = "select count(*) as quantidade from mydesktop where id_usuario=$ok";
	$result = mysql_query($sql) or die(mysql_error());
	$linha = mysql_fetch_object($result);
	if ($linha->quantidade == 0) {
	$sql = "insert into mydesktop (id_usuario, tradicional, prioridade, pastas, novo) value ($ok, 1, 1, 1, 1)";
		mysql_query($sql)  or die(mysql_error());
	}

	$sql = "select * from mydesktop where id_usuario=$ok";
	$result = mysql_query($sql) or die(mysql_error());
	$mydesktop = mysql_fetch_object($result);
	// tabela com nome de campo errado
	// o Campo ExibirChamadosEmPastas na verdade significa NAO Exibir
	$excluirchamados = $mydesktop->exibirchamadosempastas;
	$Ic_MeusChamadosDesktop = $mydesktop->Ic_MeusChamadosDesktop==1;


	loga_online($ok, $REMOTE_ADDR, 'Desktop');

	$area = pegaArea($ok);
    $minhasLigacoes = false;
	if ($area == CONSULTORIA)  {
	    $minhasLigacoes = true;
	}

    $sql = "SELECT count(*) as qtde from sigame where id_usuario = $ok;";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$DesktopSigame = $linha->qtde;

    $nomeusuario=peganomeusuario($ok);
	$manut = pegaManut($ok);
	$marketing = pegaMarketing($ok);
	$msgnova = 0;
	$lembretenovo = 0;
	$i_conta = i_contaTarefas($ok);


	$nowTime = date("G:i:s"); // Hora do servidor com 24hr
	$sql =  "select count(*) as qtde from compromisso, compromissousuario where ";
	$sql .= "compromisso.data = '" . date("Y-m-d") . "' and ";
	$sql .= "compromisso.id = compromissousuario.id_compromisso and compromisso.horafim>'$nowTime' and ";
	$sql .= "not compromisso.excluido  and ";
	$sql .= "compromissousuario.id_usuario = $ok;";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$compromissos = $linha->qtde;

    $hoje = date("Y-m-d");

	$sql = "select gerente, area, estado, fl_sat from usuario where id_usuario = $ok";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$status = $linha->estado;
	$consultor = ( ($linha->area == 1) or ($ok==2) );
	$gerente = ($linha->gerente == 1);
	$fl_sat =  ( ($linha->fl_sat)  or ($ok==2) );


	$sql = "select id_cliente, ";
	$sql .= " id, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as minutos, ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(hora_inicio)) / 60 as espera ";
	$sql .= "from ";
	$sql .= " satligacao ";
	$sql .= "where  ";
	$sql .= " FL_ATIVO and ";
	$sql .= " data = '$hoje' and  ";
	$sql .= " ((id_satstatus = 1) or (id_satstatus = 2)) ";
	$sql .= "order by ";
	$sql .= " espera desc ";
	$sql .= "limit 1";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	if (!$linha) {
	  $tempomaximo = 0;
	  $tempominutos = "00:00:00";
	} else {
      $tempomaximo = $linha->espera;
	  $tempominutos = $linha->minutos;
	}


	$lampada = "<img src=imagens/farolverde.jpg width=100 height=40 border=0><br>Normal - ";
	if (  ($tempomaximo>=10) and ($tempomaximo<20)  ) {
	  $lampada = '<img src=imagens/farolamarelo.jpg width=100 height=40 border=0><br>Aten??o - ';
	} else if ($tempomaximo>=20) {
	  $lampada = "<img src=imagens/farolvermelho.jpg width=100 height=40 border=0><br>Cr?tica - ";
	}
	$lampada .= "$tempominutos - $linha->id_cliente";


	// Caso de algum problema e o estado fique maior do que o permitido, volto para
	// Dispon?vel;
	$sql = "update usuario set estado = 1 where id_usuario = $ok and estado > (select max(id) from estado_consultor)";
	mysql_query($sql);


	$EditaDataPrevista = (
	     ($ok == 1) or
		 ($ok==8) or
		 ($ok==12) or
		 ($ok==7)
    );
	// Elis, Edson e Ricardo Apenas

?>
<html>
<style type="text/css">
<!--
.style1 {font-size: 12px}
.style5 {font-family: Tahoma; font-size: 10px; }
.style7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif}
-->
</style>
<head>
<title>Inicio</title>
<meta http-equiv="refresh" content="600;URL=inicio.php">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="pt-br" />
<link rel="stylesheet" href="stilos.css" type="text/css">
<!-- Courtesy of SimplytheBest.net - http://simplythebest.net/scripts/ -->
<STYLE>
.subbarfont {
	font-weight: none; font-size: 13px; color: #cc0000; font-family: arial, verdana, helvetica, sans-serif
}
a.subbar {
	font-weight: none; color: black; font-size: 12px; width: 128px; font-family: arial, verdana, helvetica, sans-serif; text-decoration: none
}
.subbarselected {
	border-right: white 1px solid; border-top: black 1px solid; vertical-align: middle; border-left: black 1px solid; border-bottom: white 1px solid; background-color: #99ccff
}
.subbarnotsel {
	border-right: #6699cc 1px solid; border-top: #6699cc 1px solid; vertical-align: middle; border-left: #6699cc 1px solid; cursor: hand; border-bottom: #6699cc 1px solid
}
.subbarnotselone {
	background-color: #F9FDFF
}
.subbarhover {
	background-color: #ECF8FF
}
.subbarhover2 {
	border-right: black 1px solid; border-top: white 1px solid; vertical-align: middle; border-left: white 1px solid; cursor: hand; color: red; border-bottom: black 1px solid; background-color: #cc99ff
}
.style7 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif}
</STYLE>

<!-- Toastrs -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./js/toastr.js"></script>
<link href="./css/toastr.css" rel="stylesheet" />

</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="relatorios/coolbuttons.js"></script>
<script type="text/javascript" src="scripts/engine.js"></script>
<script type="text/javascript" src="scripts/engine2.js"></script>
	<script type="text/javascript">
		function submit_form(AAcao, AId, Qtde) {
				// Construct URL
				var lId = escape(AId);
				url = 'handle_form.php?acao='+AAcao+'&id=' + lId +'&id_usuario=' + <?= $ok?>;
				teste =  document.getElementById('chamados_lista');

				if (Qtde > 15 )
				{
					teste.innerHTML = 'Sua lista contem mais do que 20 chamados, Abrindo em uma nova janela.';
					window.open(url,'','width=640, height=480');
				}
				else
				{

					teste.innerHTML = '<br>Aguarde... <br><br><img src="figuras/loading1.gif" alt="l" width="16" height="16">';
					ajax_get (url, 'chamados_lista');
				}
		}

		function abre_chamado(AId) {
				// Construct URL
				url = 'historicochamadoclean.php?&id_chamado=' + AId+'&ok=' + <?= $ok?>;
				teste =  document.getElementById('chamados_lista');
				teste.innerHTML = '<br>Aguarde... <br><br><img src="figuras/loading1.gif" alt="l" width="16" height="16">';
				ajax_get (url, 'chamados_lista');
		}


	</script>


<font size="3"><img src="../Sadzinho.jpg" width="900" height="79" alt="Banner SAD"></font>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">

    <tr>
      <td valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
          <tr align="center">
            <td width="72" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
            <td width="87" class="coolButton"><a href="index.php?novologin=true"><img src="figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
            <td width="101" class="coolButton"><a href="/a/relatorios/"><img src="figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">relat&oacute;rios</a></td>
            <td width="111" class="coolButton"><img src="figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="trocasenha.php">Alterar
              Senha</a> </td>
            <td width="118" class="coolButton" align="center" valign="middle">
              <a href="../index.php">Intranet</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="204" class="coolButton"><a href="/agenda/" target="_blank">Agenda
              Corporativa</a></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
     <form id="ramal" method="post">
       <td>

        <font size="1">Usu&aacute;rio <font color="#FF0000">:<b>
        <?=$nomeusuario?> </b></font></font>
        :: Meu Ramal :
        <input name="ramal" type="text" class="style5" id="ramal" size="3" maxlength="3" value="<?= $MeuRamal; ?>">
		<? if (!$MeuRamal) { ?>
        <span class="subbarfont"><---- FAVOR DIGITE SEU RAMAL E CLIQUE OK --&gt;</span>
        <? } ?>

        <input name="muaramal" type="submit" class="style5" id="muaramal" value="ok">    <input name="id_usuario" type="hidden" value="<?= $ok?>"> <input name="acao" type="hidden" value="trocaramal">

<select name="select" class="borda_fina" id="select">
<option value="0">Pesquise aqui</option>
<?
	$sql = "SELECT nome, email, ramal FROM usuario WHERE ativo and ramal is not null ORDER BY nome ASC";
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object($result))
	{
		$display = "$linha->nome - $linha->ramal";
		$value = $linha->ramal;
		 echo "<option value=\"$value\">$display</option>";
	}
?>
</select>
        [<a href="ListaRamais.php" target="_blank">Ver todos</a>]

	</td>
   </form>
</tr>
    <tr>
      <td valign="top"> <table width="100%" border="0" cellspacing="1" cellpadding="1">
        </table>
        <table width="100%" border="0" bgcolor="#CCCCCC" cellpadding="3" cellspacing="1">
          <tr bgcolor="#FFFFFF">
            <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                  <td width="65%"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                      <tr bgcolor="#FFFFFF">
                        <form name="form" method="post" action="historico.php" onSubmit="enviaConsulta();return false;">
                          <td align="left" valign="top"><font size="2"><a href="javascript:seleciona();" title="Digite um trecho do nome do cliente na caixa de texto e depois clique aqui para pesquisar clientes pelo nome">C&oacute;digo
                            do cliente</a><b>&nbsp;</b></font><font color="#0000FF"><b>
                            <input type="hidden" name="action">
                            </b></font><font size="2">&nbsp;</font><font color="#0000FF"><b>
                            <input type="text" name="id_cliente" class="bordaTexto" title="Digite o n?mero do chamado ou o cliente e tecle enter" value="<?=$id_cliente?>">
                            </b>
                            <input type="button" name="Button" value="Ver hist&oacute;rico" class="bordaTexto" title="Digite o n?mero do chamado ou do cliente na caixa de texto ao lado." onClick="enviaConsulta();">
                            &nbsp;[<a href="javascript:seleciona(); " title="Digite um trecho do nome do cliente na caixa de texto e depois clique aqui para pesquisar clientes pelo nome">pesquisa
                            clientes</a>]</font> <input name="id_cliente_exato" type="hidden" id="id_cliente_exato" value="0"></td>
                        </form>
                      </tr>

                    </table></td>
                  <td width="35%"> <table width="100%" border="0"  cellpadding="1" cellspacing="1">
                      <tr bgcolor="#FFFFFF">
                        <form name="form1" method="post" action="relatorios/relat2.php">
                          <td align="right" valign="top"> [<img src="figuras/lupa.gif" width="20" height="20" align="absbottom">busca por palavra
                            <input type="text" name="palavra" class="bordaTexto" title="Digite uma palavra e tecle ENTER, esta palavra ser? pesquisada nos chamados existentes">
                            ] </td>
                        </form>
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
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <table width="100%" border="0" bgcolor="#CCCCCC" cellpadding="3" cellspacing="1">
          <tr bgcolor="#FFFFFF">
            <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr valign="top">

                  <td width="33%">
<?
	if ($_SESSION["Ic_Release"])	{
?>

									<p><a href="/a/versao/">
                      <?  $i_msg = "Liberação de Release";
			    if ($i_conta < 0) { echo "<font color=#ff0000 >$i_msg: " . -$i_conta .  " release(s) em andamento</font>"; } else {echo $i_msg;}

			    if($i_conta > 0) {?>
                      <font color = #ff0000 size = 2>: Você tem
                      <?=$i_conta?>
                      tarefa(s)</font>
                      <? } ?>
                      </a> <br>

<?
	}
?>

                    <? if($manut) {	?>
                    <a href="manut/index.php">Manuten&ccedil;&atilde;o de tabelas</a><br>
                    <?}
             if($marketing) {	?>
                    <a href="manut/marketing.php">Manuten&ccedil;&atilde;o de
                      tabelas de marketing</a><br>
                    <?} ?>
                    <?
			    if (receptor($ok)) {
				  if ($xx = temChamado()) {
                    echo "<a href=\"clientes.php\"><img src=\"figuras/cliente.gif\" width=\"20\" height=\"20\" align=\"absmiddle\" border=\"0\">$xx chamado(s) aberto(s) por cliente</a><br>";
				  }
				}

			  ?>


					<br>
					<a href="projetos/index.php" target="_blank">Projetos em andamento</a>
                  <form name="formulario2" id="formulario2" method="post" action="inicio.php" >

					<?
					  if ($consultor) {
					?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td background="#estados">
                        Meu Status :

						<?
							// Vou destacar o status atendendo.
							$ConsultorAtendendo = $row_rsEstadoConsulto['id'] == 4;
						?>
					    <? if ($ConsultorAtendendo) { ?>
						<span style="color: #F00; font-size: 15px;">
                        <? } ?>

                        <?php echo $row_rsEstadoConsulto['descricao']; ?>

						<? if ($ConsultorAtendendo) { ?>
<br><input type="button" value="Alterar para Dispon?vel"  onClick="mudaStatusParaDisponivel()"></button>

                          </span>
						<? } ?>

                            <br>
                        <a href="?acao=mudaestado&status=<?=$status?>">Alterar para</a>:

                        <select name="status_consultor" id="status_consultor" class="borda_fina" onChange ="AlteraStatusConsultor()">

                          <?php
do {
?>
                          <option value="<?php echo $row_rsStatusConsultor['id']?>"<?php if (!(strcmp($row_rsStatusConsultor['id'], $row_rsUsuario['Estado']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsStatusConsultor['descricao']?></option>
                          <?php
} while ($row_rsStatusConsultor = mysql_fetch_assoc($rsStatusConsultor));
  $rows = mysql_num_rows($rsStatusConsultor);
  if($rows > 0) {
      mysql_data_seek($rsStatusConsultor, 0);
	  $row_rsStatusConsultor = mysql_fetch_assoc($rsStatusConsultor);
  }
?>
                        </select>
                        <input name="ausente_chamado" type="text" class="borda_fina" id="ausente_chamado" value="<?=$row_rsUsuario['sat_idcliente']?>" style='display: none'>
<input name="id_usuario" type="hidden" id="id_usuario" value="<?=$ok?>">
                        <input name="acao" type="hidden" id="acao" value="novo_status">
                        <br>
<span id="msg_muda_status"></span></td>
                      </tr>
                    </table>
<script>
    teste = document.formulario2.status_consultor.value;
	if (teste == 3)
	{
		document.formulario2.ausente_chamado.style.display = ''
	}
	 else
	{
		document.formulario2.ausente_chamado.style.display = 'none'
	}
</script>
					<?
					}
					?>

</form>

</td>
                <td width="33%" align="center"> <p><a href="rnc/relatorios/index.php"><strong>Desktop
                  Qualidade</strong></a>
                    <? if ($gerente) {?>
                    <br>
                  [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_NAOCONFORMIDADE?>">não conformidade</a>] - [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOPREVENTIVA?>">Ação Preventiva</a>] - [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOMELHORIA?>">Ação Melhoria</a>]
                  <?
				   if (($ok == 12) or ($ok==1) or ($ok==98) ) {
				  ?>
                  <br>
                  [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_ABERTURAPROJETO?>">ABERTURA DE PROJETOS</a>]
                  <?
				    }
				  ?>
                  <br>
                  <? }?>
                  <? if ($compromissos) {?>
                  <font size="2"><a href="../agenda/" target="_blank" class="fundoclaro">Agenda
                    : <strong>
                    <?=$compromissos?>
                    </strong>Compromisso(s)</a></font>
                  <? } ?>
                  <?
					  if ($minhasLigacoes) {
					?>
                  <br>
                  <a href="espera/consultor.php" class="style1">Minhas ligações</a>
                  <?
					 }
					  if ($DesktopSigame<>0) {
					?>
                  <a href="sigame/index.php">Desktop SIGA-ME (<? echo $DesktopSigame ?>)</a>
                  <?
					}
					?>
                      <?
					  if(($fl_sat or $consultor) and false) {
					   echo "<a href=\"javascript:janelaFarol();\" border=0>$lampada</a>";
					  }
					?>
                      </p>

<?
			$DemaisRascunhos = FuncoesPegaDemaisRascunho(0, $ok);
			if ($DemaisRascunhos) {
?>
              Rescunhos:<br>
                <?
				foreach($DemaisRascunhos as $tmp)
				{
					$IdChamadoRascunho = $tmp["id_chamado"];
					$TextoChamado = $tmp["texto"];
					if ($tmp["negrito"]) echo "<strong>";
					echo " <a href=historicochamado.php?&id_chamado=$IdChamadoRascunho target=_new>$IdChamadoRascunho - $TextoChamado</a><br>";
					if ($tmp["negrito"]) echo "</strong>";
				}
				?>

                </font>
			  <?
			   }
              ?>



</td>
                <td width="33%" align="right"> <a href="/a/relatorios/relatbaseweb.php"><font size="1">Base
                  de conhecimento web</font></a> <br> <a href="/suporte/index.php"><font size="1">Base
                    de Solu&ccedil;&otilde;es</font></a> <br>
                  <a href="javascript:online();">Quem está On Line</a> <br>
                  <a href="/a/errosFujitsu.php"><font size="1">Erros versão FJ</font></a>
                  </td>
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
  if ($mydesktop->tradicional==1) {
?>


Chamados Pendentes para  <?=$nomeusuario?>     :     	<span id="contapendentes"></span><br>
        Chamados Encaminhados por
        <?=$nomeusuario?>
        :
		<span id="contaencaminhados"></span>

</span>
        <?

			// Campo numero de 1 a 6
			if (!isset($Campo)) {
				$Campo = 8;
			}
			// Ordem = 1 ascendente -1 Ddescentente
			if (!isset($Ordem)) {
				$Ordem = -1;
			}

			$Links = Array();
			$Links[1] = Array();
			$Links[2] = Array();
			$Links[3] = Array();
			$Links[4] = Array();


			$v = 1;
			$Links[$v][1] = "Chamado";
			$Links[$v][2] = "id_chamado";
			$Links[$v][3] = -1;
			$Links[$v][4] = "";
			if ($Campo==$v) {
				$Links[$v][3] = -1 * $Ordem;
				if ($Ordem==1) {
					$Links[$v][4] = "D";
				} else {
					$Links[$v][4] = "A";
				}
			}
			if ($Links[$v][3] == -1) {
				$Links[$v][2] = "id_chamado desc";
			}

			$v++;
			$Links[$v][1] = "Data Abertura";
			$Links[$v][2] = "dataa, horaa";
			$Links[$v][3] = -1;
			$Links[$v][4] = "";
			if ($Campo==$v) {
				$Links[$v][3] = -1 * $Ordem;
				if ($Ordem==1) {
					$Links[$v][4] = "D";
				} else {
					$Links[$v][4] = "A";
				}
			}
			if ($Links[$v][3] == -1) {
				$Links[$v][2] = "dataa desc, horaa desc";
			}

			$v++;
			$Links[$v][1] = "Data Ultimo Contato";
			$Links[$v][2] = "datauc, horauc";
			$Links[$v][3] = -1;
			$Links[$v][4] = "";
			if ($Campo==$v) {
				$Links[$v][3] = -1 * $Ordem;
				if ($Ordem==1) {
					$Links[$v][4] = "D";
				} else {
					$Links[$v][4] = "A";
				}
			}
			if ($Links[$v][3] == -1) {
				$Links[$v][2] = "datauc desc, horauc desc";
			}

			$v++;
			$Links[$v][1] = "Sistema";
			$Links[$v][2] = "sistema";
			$Links[$v][3] = -1;
			$Links[$v][4] = "";
			if ($Campo==$v) {
				$Links[$v][3] = -1 * $Ordem;
				if ($Ordem==1) {
					$Links[$v][4] = "D";
				} else {
					$Links[$v][4] = "A";
				}
			}
			if ($Links[$v][3] == -1) {
				$Links[$v][2] = $Links[$v][2] . " desc";
			}


			$v++;
			$Links[$v][1] = "Prioridade";
			$Links[$v][2] = "prioridade";
			$Links[$v][3] = -1;
			$Links[$v][4] = "";
			if ($Campo==$v) {
				$Links[$v][3] = -1 * $Ordem;
				if ($Ordem==1) {
					$Links[$v][4] = "D";
				} else {
					$Links[$v][4] = "A";
				}
			}
			if ($Links[$v][3] == -1) {
				$Links[$v][2] = $Links[$v][2] . " desc";
			}


			$v++;
			$Links[$v][1] = "Cliente";
			$Links[$v][2] = "cliente";
			$Links[$v][3] = -1;
			$Links[$v][4] = "";
			if ($Campo==$v) {
				$Links[$v][3] = -1 * $Ordem;
				if ($Ordem==1) {
					$Links[$v][4] = "D";
				} else {
					$Links[$v][4] = "A";
				}
			}
			if ($Links[$v][3] == -1) {
				$Links[$v][2] = $Links[$v][2] . " desc";
			}

			$v++;
			$Links[$v][1] = "Categoria";
			$Links[$v][2] = "categoria";
			$Links[$v][3] = -1;
			$Links[$v][4] = "";
			if ($Campo==$v) {
				$Links[$v][3] = -1 * $Ordem;
				if ($Ordem==1) {
					$Links[$v][4] = "D";
				} else {
					$Links[$v][4] = "A";
				}
			}
			if ($Links[$v][3] == -1) {
				$Links[$v][2] = $Links[$v][2] . " desc";
			}


			$v++;
			$Links[$v][1] = "Original";
			$Links[$v][2] = "";
			$Links[$v][3] = 1;
			$Links[$v][4] = "";

			$_Campo = $Links[$Campo][2];

			$ScriptName = $_SERVER['SCRIPT_NAME'];
			$strLinks = "";


			for($i=1; $i<8; $i++)
			{
				$strLinks .= "[<a href=\"";
				$strLinks .= $ScriptName;
				$strLinks .= "?Campo=$i&Ordem=".$Links[$i][3]. "\">";
				$strLinks .= $Links[$i][1] . "</a> ". $Links[$i][4] ."]";
			}


		    $chamadosemaberto =
				FuncoesPegaChamadoPendenteUsuario_ordem($ok, $_Campo);
			$total_pendentes = count($chamadosemaberto);


?>

<span id=msgnova></span><span id=lembretenovo></span> <br>
<a href="javascript:alterna(todos_chamados, txtTodosChamados, '+', '-');">Alternar entre mostrar ou esconder lista de chamados tradicional <span id=txtTodosChamados> - </span> </a>

<div class="hslice" id="sad">
<span id="todos_chamados" style="display: "><br>
Ordenar por <?=$strLinks?><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
      </table>



<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
          <tr bgcolor="#003366">
            <td width="13%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Chamado</font></strong></td>
            <td width="12%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Datas</font></strong></td>
            <td width="10%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">C&oacute;digo
              do cliente</font></strong></td>
            <td width="65%"><strong><font size="1" color="#FFFFFF">Cliente + Descri&ccedil;&atilde;o</font></strong></td>
          </tr>
      </table>
        <?
			$contapendentes = 0;
			$contaencaminhados =0;

			while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {


				$cliente = $tmp["cliente"];
				$cliente_id = $tmp["id_cliente"];

				$prioridade = $tmp["prioridade"];
				$prioridadev = $tmp["prioridadev"];
				if ($prioridadev  <= 100) {
				 $cor = "#ff0000";
				} else if ( ($prioridadev > 100) and ($prioridadev <= 200) ) {
				 $cor = "#FF6600";
				} else if ($prioridadev > 200) {
				 $cor = "#009966";
				}
				$prioridade = "<b><font color=$cor>$prioridade</font></b>";


				$limite1 = $limite2 = $limite3 = $limite4 = '';

				if ($tmp["pos_venda"] <> 1)
				{
					if ($tmp["prioridadeId"] <= 3) {
						if ($cliente_id != 'DATAMACE')
						{
							$limite1 = $tmp["limite1"];
							$limite2 = $tmp["limite2"];
							$limite3 = $tmp["limite3"];
							$limite4 = $tmp["limite4"];
						}
					}
				}

				$sigame = $tmp["sigame"];
                $ordemUsuario = $tmp["Ordem"];
				$chamado = $tmp["chamado"];

				$projeto_desc = FuncoesObterDescricaoChamadoPai( $chamado );

				//echo $chamado . " - ";

				$qtde = $tmp["qtde"];
				if ($qtde) {
					$ChamadosAguardando = conn_PegaChamadosAguardando($chamado);
				} else {
					$ChamadosAguardando = "";
				}

				$espero = $tmp["espero"];
				if ($espero) {
					$espero = conn_PegaAguardandoChamado($chamado);
					$esperoStatus = "";//pegaStatusDoChamado($espero);
				} else {
					$espero = "";
				}


				$sistema = $tmp["sistema"];
				$Ds_Versao = $tmp["Ds_Versao"];
				$Dt_Release = $tmp["Dt_Release"];
				$categoria = $tmp["categoria"];

				$id = $tmp["id_cliente"];
				$status_chamado = $tmp["status"];
				$statusStr = "";
				if($status_chamado>3) {
				$statusStr = "<br>".pegaStatus($status_chamado);
				}


				$senha = $tmp["senha"];

				$dataAbertura = $tmp["dataa"];// . "<br>" . $tmp["horaa"];
				$diasAbertura = $tmp["diasAbertura"];

				$DataUltimoContato = $tmp["datauc"];// . "<br>" . $tmp["horauc"];
				$diasUltimoContato = $tmp["diasUltimoContato"];


				$descricao = $tmp["descricao"];
				$destinatarioId = $tmp["destinatario_id"];
				$usuarioId = $tmp["usuario_id"];
				$remetenteId = $tmp["remetente_id"];
				$pendente = $tmp["pendente"];
				$encaminhado = $tmp["encaminhado"];
				$fone=$tmp["telefone"];
				$bl = $tmp["bloqueio"];

				$isPosVenda = $tmp["pos_venda_ca"];


				$pos_venda = "";

				if ($isPosVenda) {
					$pos_venda = "<b>P?S-VENDA<br/></b>";
				}

				$Editando_Nome = $tmp["Editando_Nome"];
				$Editando_Id = $tmp["Editando_Id"];
				$Editando_Outros = $tmp["qtdeeditando"] > 0;

			   $cor_fundo = CORES_DEFAULT;
               $cor_borda = BORDA_DEFAULT;

			   $largura_borda = 1;

			   if ($tmp["externo"]) {
                 $cor_fundo = CORES_EXTERNO;
			   }


				if ($isPosVenda) {
					$cor_fundo = CORES_POSVENDA;
					$cor_borda = BORDA_POSVENDA;
					$largura_borda = 4;
				}


			   if ($tmp["id_sistema"] == 1024) {
                 $cor_fundo = CORES_QUALIDADE;
			   }
   			   $rncTipo = '';
			   if ($tmp["rnc"]==1) {
			     $rncTipo = "<strong>não conformidade</strong>";
			     if (!$teste) {
    				 $cor_fundo = "#cccccc";
				 } else {
                   $cor_fundo = "#$teste";
				 }
			   }

   			   if ($tmp["rnc"]==3) {
			     $rncTipo = "<strong>Ação de Melhoria</strong>";
			   }
   			   if ($tmp["rnc"]==2) {
			     $rncTipo = "<strong>Ação Preventiva</strong>";
			   }

			   if ($tmp["rnc"]==4) {
			     $rncTipo = "<A href=\"projetos/projeto.php?abertos=1&id_chamado=$chamado\" target=\"_blank\"><strong>Ver projeto</strong></a>";
			     if (!$teste) {
    				 $cor_fundo = "#caaccc";
					 $largura_borda = 2;
					 $cor_borda = BORDA_ACAOMELHORIA;
				 } else {
                   $cor_fundo = "#$teste";
				 }
			   }
			   $rncMensagem = '';
				if ($tmp["rnc"]!=0) {
					$rncResponsavel =  $tmp["rnc_acao_responsavel"];
					$rncPrazo = $tmp["rncPrazo"];
					$rncMensagem = "<br>--> ".$rncTipo."<br>Departamento respons?vel pela ação: <strong>$rncResponsavel</strong>. Prazo: <strong>$rncPrazo</strong>";
				}


			   if ( $tmp["categoria_id"] == CATEGORIA_ACAOMELHORIA) {
                 $cor_fundo = CORES_ACAOMELHORIA;
				 $cor_borda = BORDA_ACAOMELHORIA;
				 $largura_borda = 3;
			   }



			   $lido = 1;                          // So vai ver msg nova
			   if ($destinatarioId == $ok) {       // se o chamado tiver novidades e
                 $lido = $tmp["lido"];             // se o destinatario do contato = consultor atual
			   }
			   if ($usuarioId == $ok) {       // se o chamado tiver novidades e
                 $lido = $tmp["lidodono"];             // se o destinatario do contato = consultor atual
			   }

//			   echo "$limite1 - $Data_Atual";
		$mensagem = "";
		if ($limite1 == $Data_Atual)
		{
			//$cor_fundo = CORES_ACAOMELHORIA;
			$mensagem = "Vence hoje";
			$cor_borda = '#006600';
			$largura_borda = 5;
			$lido = 0;
		} else if ($limite2 == $Data_Atual) {
			$mensagem = "Venceu : 1 dia";
			$cor_borda = '#CC3333';
			$cor_fundo = '#DDFDD9';
			$largura_borda = 4;
			$lido = 0;
		} else if ($limite3 == $Data_Atual)
		{
			$mensagem = "Venceu : 2 dias";
			$cor_fundo = '#FFFFD2';
			$cor_borda = '#FF0000';
			$largura_borda = 6;
			$lido = 0;
		} else if ($limite4 == $Data_Atual)
		{
			$mensagem = "Venceu : 3 dias";
			$cor_borda = '#FF0000';
			$largura_borda = 10;
			$lido = 0;
		}




			   $dataprevista = $tmp["dataprevista"];


			   $sql = "select * from lembrete where id_destinatario = $ok and id_chamado = $chamado and not lido";
		   	   $temLembrete = 0;
			   $result = mysql_query($sql);
			   while ( $linha = mysql_fetch_object($result) ) {
			     $id_lembrete = $linha->id;
			     if (($linha->periodo) == "M" ) {
			       $horario = "08:00:00";
			     } else {
			       $horario = "13:00:00";
			     }
			     $date1=strtotime( $linha->data . ' ' . $horario);
				 if ($agora > $date1) {
				   $temLembrete = 1;
				   break;
				 }
			   }


			     $sql_pasta = "select descricao, id_usuario, id_chamado from pasta
left join chamado_pasta on
  chamado_pasta.id_pasta = pasta.id_pasta
where
  pasta.id_usuario = $ok and
  chamado_pasta.id_chamado = $chamado";
                 $result_pasta = mysql_query($sql_pasta);
				 $pastas = "";
				 $ok_pastas = 0;
				 while ($linha_pasta = mysql_fetch_object($result_pasta)) {
				   if ($ok_pastas) {
				     $pastas .= ", ";
				   }
				   $ok_pastas = 1;
				   $pastas .= $linha_pasta->descricao;
				 }

               $mostrachamado = 1;
               if ($excluirchamados) {
			     if ($pastas != "") {
			       $mostrachamado = 0;
				 }
			   }

				// IF PARA MOSTRAR APENAS NAO LIDOS
				   if ($naolido)
				   if ($lido) {
				   		$mostrachamado = 0;
				   }


			   if (
					($mostrachamado) and
					(
					  (!$encaminhado)
					  or ($encaminhado and ($id_usuario == $destinatarioId))
					  or ($Ic_MeusChamadosDesktop)
					)
		          )

				{
					$contapendentes++;
					$contaencaminhados = ($total_pendentes - $contapendentes);

?>
<div id="ListaChamados">
        <table width="100%" border="0" cellpadding="1" cellspacing="<?=$largura_borda ?>" bgcolor="<?=$cor_borda?>" class="bordagrafite02">
          <tr>
            <td bgcolor="<?=$cor_fundo?>"> <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr valign="bottom">
                  <td width="12%" align="center" valign="middle">
                    <?=$pos_venda?><?
					echo $mensagem;
				   if ($temLembrete) {
                    echo "<a href=\"lembrete/mostralembrete.php?id=$id_lembrete\"><img src=\"figuras/lembrete.jpg\"  width=\"20\" height=\"20\" align=\"absmiddle\" border=\"0\"></a>";
                    $lembretenovo++;

      				}
				?>
                    <? if(!$lido) { echo '<img src=figuras/idea01.gif  align=absmiddle> '; $msgnova++; } ?>
					<a href=historicochamado.php?&id_chamado=<?=$chamado?>>
                    <?= number_format($chamado,0,',','.') . "</a><br>$prioridade $statusStr"?>
					<br>
                    <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:novolembrete(<?=$chamado?>, <?=$ok?>);">Incluir
                    Lembrete</a></td>
                  <td width="13%" align="center" valign="middle">
					<?=$pos_venda?>a:<?=$dataAbertura?> (<?=$diasAbertura?>)
					<br>
					uc: <?=$DataUltimoContato?> (<?=$diasUltimoContato?>)<br><br>
<?php

	if ($EditaDataPrevista) {
	  echo "<a href=\"javascript:dataprevista($chamado, $ok);\">Data prevista</a>";
	} else {
	  echo "Data prevista";
	}
if ($dataprevista <> '00/00/0000') {
	 echo "<br>$dataprevista";
}
?>
                  </td>
                  <td width="10%" align="center" valign="middle"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1">
                    <?=$pos_venda?><?
				 $msg = $id;
                 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
				 $msg .= "<br>$fone";
                 echo $msg;
				 ?>
                    </font>
</td>
                  <td width="65%" valign="middle" > <font face="Verdana, Arial, Helvetica, sans-serif">

			<? if ($Editando_Outros) {?>
			<a href="novocontato.php?id_chamado=<?=$chamado?>" >
			<img src="imagens/EditContatoOutros.png" title="Contato sendo editado por outra pessoa" width="32" height="32" align="absmiddle" border="0">
			</a>
			<? } ?>

			<? if ($Editando_Id) {?>
			<a href="novocontato.php?id_chamado=<?=$chamado?>" >
			<img src="imagens/EditContato.png" title="Contato sendo editado por MIM" width="32" height="32" align="absmiddle" border="0">
			</a>
			<? } ?>



			<?=$pos_venda?>
                    <?="<b>$cliente ($senha)  [$sistema $Ds_Versao $Dt_Release] </b><br><b><a href=historicochamado.php?&id_chamado=$chamado>$descricao...</a></b>"?>
                    <?
              $figura = "";
			  if (
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId != $id_usuario) ) or
                       ($encaminhado and ($id_usuario == $remetenteId) and ($destinatarioId != $id_usuario) ) or
                       ($encaminhado and ($id_usuario != $remetenteId) and ($destinatarioId == $id_usuario) )
					   )
				   {
				      if ($id_usuario != $destinatarioId) {
					    $msg = " para " . peganomeusuario($destinatarioId);
						$seta = "encaminhado.gif";
					  } else {
					    $msg = " à você por " . peganomeusuario($remetenteId);
						$seta = "recebido.gif";
					  }
                      $figura = "<img src=\"figuras/$seta\" align=\"absmiddle\" border=0>";
                      echo " <br><font color=#FF0000>Encaminhado " . $msg . "</font> $figura";
					}
					if ($usuarioId != $id_usuario) {
					  $msg = "Chamado aberto por " . peganomeusuario($usuarioId);
					  echo " <br><font color=#FF0000> $msg </font>";
					}
					echo "<br>Categoria : $categoria";
				?>
                    <?=$rncMensagem?><br>
                  <?=$pos_venda?></font> <?= $projeto_desc; ?> <br>
                  <?= $ChamadosAguardando?><?= $espero?>
<? if (!$_ReadyOnlyStatus) { ?>
                  <input name="oo" type="button" class="borda_fina" onClick="javascript:NovoChamado('<?=$cliente_id?>')" value="Novo Chamado para <?=$cliente_id?>">
<? } ?>

<?
  $ordemMax = ORDEM_MAX;
  $ordemBaixo = $ordemUsuario;
  $ordemCima = $ordemUsuario + 1;
  if ($ordemUsuario > ORDEM_MIN)
  {
	  $ordemBaixo = $ordemUsuario - 1;
  }
?>
p: <?=($ordemUsuario+1)?>
<a href="javascript:novaOrdem(<?=$chamado?>, <?=$ordemMax?>)"><img src="imagens/SadTopo.png" width="10" height="15" border="0" align="absbottom" title="Prioridade M?xima"></a><a href="javascript:novaOrdem(<?=$chamado?>, <?=$ordemCima?>)"><img src="imagens/Sad_Cima_Ordem.png" border="0" height="15" width="10" align="absbottom" title="Aumentar Prioridade"></a><a href="javascript:novaOrdem(<?=$chamado?>, <?=$ordemBaixo?>)"><img src="imagens/Sad_Baixo_Ordem.png" border="0" height="15" width="10" align="absbottom" title="Diminuir Prioridade"></a><a href="javascript:novaOrdem(<?=$chamado?>, <?=ORDEM_MIN?>)"><img src="imagens/SadBotton.png" width="10" height="15"  border="0" align="absbottom" title="Prioridade M?nima"></a> 					<div>
			  <?
			  	$restricoes = funcoesObterStatusRestricao($chamado);
				echo $restricoes["display"];
			  ?>

					</div>
                  </td>
                </tr>
              </table></td>
          </tr>
        </table>
</div>



        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <?}}
			?>
         <br>

		 </span>
		 </div>
		 <?
		  } // if mydesktop->tradicional
		 ?>
		 <br>
		<?
		 if ($mydesktop->novo==1) {
		?>

		 <table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="24%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="2" cellspacing="0">

                    <tr>
					<form action="" name="frmLeChamado" id="frmLeChamado"
onSubmit="javascript:enviaConsultaRapida(); return false;">

                      <td bgcolor="#F9FDFF">Consultar :
                        <input name="consultarapida" type="text" class="borda_fina" id="consultarapida" size="12" accesskey="C " title="Digite o n?mero do chamado e tecle ENTER, ou clique no link OK." >
                        <a href="javascript:enviaConsultaRapida();" title="Digite o n?mero do chamado e tecle ENTER, ou clique no link OK">OK</a>   					    </td>
</form>


                    </tr>


<?
  if($mydesktop->prioridade==1) {
?>

                    <tr>
                      <td bgcolor="#F9FDFF">
                      Chamados comigo </span></td>
                    </tr>
                    <?
	$sql = "Select distinct ";
	$sql .= "  chamado.prioridade_id, prioridade, valor, count(*) as quantidade ";
	$sql .= "from chamado ";
	$sql .= "  inner join prioridade on prioridade.id_prioridade = chamado.prioridade_id ";
	$sql .= "where visible = 1 and ";
	$sql .= "      destinatario_id = $ok ";
	$sql .= "  and status <> 1 ";
	$sql .= "group by ";
	$sql .= "  prioridade_id, valor ";
	$sql .= "order by valor ";
	$result = mysql_query($sql) or die (mysql_error());
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

?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('prioridade',<?=$linha->prioridade_id?>, <?=$linha->quantidade?>);" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style5 style7">
                        <?=$prioridade?> (<?=$linha->quantidade?>) </span> </td>
                    </tr>
                    <?
	}
?>


<?
}
  if($mydesktop->sistema==1) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF"><hr size="1px" color="#6699FF"><span class="style5 style7">Sistemas</span></td>
                    </tr>


 <?
	$sql = "select sistema.id_sistema, sistema.sistema,  count(*) as quantidade ";
	$sql .= "from chamado inner join sistema on sistema.id_sistema = sistema_id ";
	$sql .= "where visible = 1 and  destinatario_id = $ok and status <> 1 ";
	$sql .= "group by sistema order by quantidade desc, sistema";
//	die($sql);
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('sistema',<?=$linha->id_sistema?>, <?=$linha->quantidade?>);" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style5 style7">
                        <strong><?=$linha->sistema?></strong> (<?=$linha->quantidade?>) </span> </td>
                    </tr>
<?
	}
?>
<tr>




<?
}
  if($mydesktop->cliente==1) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF"><hr size="1px" color="#6699FF"><span class="style5 style7">Clientes</span></td>
                    </tr>


 <?
	$sql = "select chamado.cliente_id, sistema.sistema,  count(*) as quantidade ";
	$sql .= "from chamado inner join sistema on sistema.id_sistema = sistema_id ";
	$sql .= "where visible = 1 and  destinatario_id = $ok and status <> 1 ";
	$sql .= "group by cliente_id order by quantidade desc, sistema";
//	die($sql);
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('cliente', '<?=$linha->cliente_id?>', <?=$linha->quantidade?> );" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style5 style7">
                        <strong><?=$linha->cliente_id?></strong> (<?=$linha->quantidade?>) </span> </td>
                    </tr>
<?
	}
?>
<tr>




<? }
  if($mydesktop->encaminhados==1) {
?>

<td>
<hr size="1px" color="#6699FF">
</td>
</tr>

 <?
	$sql = "select count(*) as quantidade ";
	$sql .= "from chamado  ";
//	$sql .= "where consultor_id = $ok and remetente_id = $ok and destinatario_id <> $ok and status <> 1 ";
	$sql .= "where visible = 1 and remetente_id = $ok and destinatario_id <> $ok and status <> 1 ";

	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('encaminhados', 0, <?=$linha->quantidade?>);" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'">


                        <strong>Encaminhados </strong>(<?=$linha->quantidade?>) </span> </td>
                    </tr>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('encaminhadosnl', 0, <?=$linha->quantidade?>);" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'">

                        <strong>Encaminhados não lidos</strong></span> </td>
                    </tr>
                    <?
	}
?>

<? }
  if($mydesktop->novidade==1) {
?>

<td>
<hr size="1px" color="#6699FF">
</td>
</tr>

 <?

	$sql = "select count(*) as quantidade from chamado where visible = 1 and
   ((destinatario_id=$ok and lido    =0)
or  (consultor_id   =$ok and lidodono=0)) and status > 1 and descricao is not null";

	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('novidades', 0, <?=$linha->quantidade?>);" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'">


                        <strong><? if ($linha->quantidade!=0) {?><img src="figuras/idea01.gif" alt="Novidades" width="16" height="22" align="absmiddle"><? } ?>Contatos não lido </strong>(<?=$linha->quantidade?>) </span> </td>
                    </tr>
                    <?
	}
?>
<?
}
  if($mydesktop->pastas==1) {
?>                    <tr>
                      <td bgcolor="#F9FDFF"><hr size="1px" color="#6699FF">
                          <span class="style9"> Por Pastas </span></td>
                    </tr>
                    <?
	$sql = "Select pasta.id_pasta, pasta.descricao, (select count(*) from chamado_pasta cp left join chamado c on c.id_chamado = cp.id_chamado where c.visible = 1 and ";
	$sql .= "cp.id_pasta = pasta.id_pasta) as quantidade from pasta ";
	$sql .= " where ";
	$sql .= "id_usuario = $ok order by descricao ";

	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;

?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('pasta',<?=$linha->id_pasta?>, <?=$linha->quantidade?> );" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style9"><strong>[<a href="pastas/excluipasta.php?id_pasta=<?=$linha->id_pasta?>">ex</a>]
                        <?=$linha->descricao?>
                        (
                        <?=$linha->quantidade?>
                        )</strong> </span></td>
                    </tr>
                    <?
	}

?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected' " onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><a href="pastas/criarpasta.php?id_usuario=<?=$ok?>"><span class="style9"><img src="figuras/NovaPasta.jpg" alt="NovaPasta" width="25" height="25" border="0" align="absmiddle">Criar Pasta </span></a></td>
                    </tr>

<?
}
?>
                  </table></td>
                </tr>
            </table></td>
            <td width="76%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <td height="100%" bgcolor="#FFFFFF">
                    <span id="chamados_lista"><br>
 <blockquote>Para ver a lista de chamados por prioridade ou por pasta, clique na prioridade ou na pasta desejada ao lado. Você pode criar quantas pastas desejar e incluir um chamado em qualquer pasta.</blockquote> </span>
                  </td>
              </tr>


            </table></td>
          </tr>
        </table>

<?
  }
?>
<br>
<a href="preferencias.php?ok=<?=$ok?>" title="Clique aqui para personalizar o modo que seu desktop ser? exibido.">Personalizar meu desktop</a><br>


<br><a href="encaminhados.php"><font size="2">Ver Chamados Encaminhados e Pend?ncias</font></a><br>

        <br>

<?
//		  $sub = pegaSubordinados($id_usuario);
//		  if (count($sub)) {
//		    require("scripts/pendencias.php");
//		  }
?>	<a name="estados"></a>

        <?

		  if ( $consultor or $fl_sat ) {

		 ?>

         <table width="45%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
          <tr bgcolor="#333333">
            <td width="17%"><strong><font color="#FFFF00">Nome</font></strong></td>
            <td width="25%"><strong><font color="#FFFF00">Estado</font></strong></td>
            <td width="26%" align="center"><strong><font color="#FFFF00">Cliente</font></strong></td>
            <td width="32%" align="center"><strong><font color="#FFFF00">Tempo</font></strong></td>
          </tr>

		  <?

               //$sql = "select id_usuario, nome, estado from usuario where superior = $ok and ativo";
 				$sql = "select sat_idcliente, id_usuario, nome, estado, sec_to_time(  time_to_sec(curtime()) - time_to_sec(estado_hora)  ) as minutos from usuario where area = 1 and ativo";
				$result = mysql_query($sql) or die ($sql);
				while($linha = mysql_fetch_object($result)) {
				  $sat_idcliente = "&nbsp;";
				  if (  ( ($linha->estado==3) || ($linha->estado==4)) and ($linha->sat_idcliente)) {
					$sat_idcliente = $linha->sat_idcliente;
				  } else {
					$sat_idcliente = "&nbsp;";
				  }

		?>

          <tr bgcolor="#FFFFFF">
            <td><strong>
            <?=$linha->nome?>
            </strong></td>
            <td>
			  <strong>
			    <? if ($gerente or ($linha->id_usuario == $ok)) { ?>
			    <a href="?acao=mudaestadoconsultor&id_consultor=<?=$linha->id_usuario?>&status=<?=$linha->estado?>">
			    <? } ?>
				  <img src="imagens/estado<?=$linha->estado?>.jpg" width="120" height="20" border="0">
			    <? if ($gerente) { ?>
				</a>
			    <? } ?>
			 </strong>
			</td>
            <td align="center" valign="middle"><?=$sat_idcliente?></td>
            <td align="center" valign="middle"><strong>
            <?=$linha->minutos?></strong></td>
          </tr>
		  <?
				}
		  }
		  ?>
        </table>
      </td>
    </tr>
    <tr>
      <td align="right" valign="top"><font color="#999999">
        Sad 2006
      </font></td>
    </tr>
</table>

<script>
function vai() {
   location.href = 'inicio.php?subPendente='+document.formSubordinado.subPendente.value+"#pendencias";
}

function janelaFarol(){
  window.open('./espera/farol.php','','width=250, height=100');
}


function seleciona() {
  window.name = "pai";
  value = document.form.id_cliente.value;
  newwindow= window.open('selecionacliente.php?id_cliente='+value, "Sele??o", "scrollbars=yes, height=488, width=600");
   newwindow.focus();
}


 if( ('-<?=$pesquisa?>'!='-') ) {
  document.form.id_cliente.value='<?=$pesquisa?>';
  seleciona();
 } else {
  document.form.id_cliente.focus();
 }


function novolembrete(chamado, usuario) {
  var newWindow;
  window.name = "pai";
  newWindow = window.open( 'lembrete/novolembrete.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
}


function dataprevista(chamado, usuario) {
  var newWindow;
  window.name = "pai";
  newWindow = window.open( 'lembrete/EditaDataPrevistaLiberacao.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
}


function online() {
   window.open( 'online.php', '', 'scrollbars=yes, width=600, height=400');
   document.form2.submit();
}
//document.form.id_cliente.focus();


<?
if ($mydesktop->tradicional==1) {
?>
contapendentes.innerHTML = '<?=$contapendentes?>';
contaencaminhados.innerHTML = '<?=$contaencaminhados?>';


 if( <?=$msgnova?> ) {
   msgnova.innerHTML = "<br>Existe <?=$msgnova?> chamado(s) com mensagens não lidas (<img src=figuras/idea01.gif  align=absmiddle>) [<a href='?naolido=1'>ver apenas não lidos</a>]";
 }

 if ( '<?=$naolido?>' == '1')
 {
   msgnova.innerHTML = "<br>Vendo apenas não lidos [<a href='?naolido=0'>ver todos</a>]";
 }

 if( <?=$lembretenovo?> ) {
   lembretenovo.innerHTML = "<br>Extiste(m) <?=$lembretenovo?> chamado(s) com lembretes não lidos (<img src=figuras/lembrete.jpg  align=absmiddle>)<br>";
 }


<?
}
?>

String.prototype.trim = function() {
	return this.replace(/^\s*/, "").replace(/\s*$/, "");
}

function enviaConsultaRapida() {

/*
  document.frmLeChamado.consultarapida.value = document.frmLeChamado.consultarapida.value.trim();
  document.frmLeChamado.consultarapida.value = document.frmLeChamado.consultarapida.value.replace(".", "");
  document.frmLeChamado.consultarapida.value = document.frmLeChamado.consultarapida.value.replace(".", "");
  document.frmLeChamado.consultarapida.value = document.frmLeChamado.consultarapida.value.replace(",", "");
  document.frmLeChamado.consultarapida.value = document.frmLeChamado.consultarapida.value.replace(",", "");
  */
  abre_chamado(document.getElementById('consultarapida').value);
}

function enviaConsulta() {
 /*
  document.form.id_cliente.value = document.form.id_cliente.value.trim();
  document.form.id_cliente.value = document.form.id_cliente.value.replace(".","");
  document.form.id_cliente.value = document.form.id_cliente.value.replace(".","");
  document.form.id_cliente.value = document.form.id_cliente.value.replace(",","");
  document.form.id_cliente.value = document.form.id_cliente.value.replace(",","");
  */
  document.form.submit();
}

function abrirlista(AAcao, AId, Qtde)
{
  submit_form(AAcao, AId, Qtde);
}

function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
   item.style.display='';
   sp.innerHTML  = i2;
 } else {
   item.style.display='none'
   sp.innerHTML  = i1;
 }
}


<? if ($semresultado)  { ?>
	window.alert('Sem resultado para sua pesquisa');
<? }?>


function AlteraStatusConsultor() {
    teste = document.formulario2.status_consultor.value;
	if (teste == 3)
	{
		document.formulario2.ausente_chamado.style.display = ''
	}
	 else
	{
		document.formulario2.ausente_chamado.style.display = 'none'
	}
	ajax_do ('ajax_01.php?status_id='+teste);
}

function mudaStatusParaDisponivel()
{
	document.formulario2.status_consultor.value = 1;
	AlteraStatusConsultor();
	document.formulario2.submit();
}

</script>
    </p>
      </p>
<form name="form2" method="post" action="inicio.php">
</form>

<form name="form_novocontato" method="post" action="chamado.php">
  <input type="hidden" name="id_cliente" value="<?=$id_cliente?>">
  <input type="hidden" name="action">
</form>

<form name="form_novaordem" id="form_novaordem" method="post" action="inicio.php" >
  <input type="hidden" name="id_chamado" >
  <input type="hidden" name="ic_Ordem" >
  <input type="hidden" name="action" value="novaOrdem">
</form>

<script>
  function novaOrdem(chamado, ordem)
  {
	  document.form_novaordem.id_chamado.value = chamado;
	  document.form_novaordem.ic_Ordem.value = ordem;
	  document.form_novaordem.submit();
  }
</script>
</body>
<HEAD>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
</HEAD>
</html>
<script language="javascript">

  if ('true' == '<?=$lembrete?>') {
	novolembrete('<?=$id_chamado?>', '<?=$ok?>');
  }

  function NovoChamado(cliente_id)
  {
      document.form_novocontato.id_cliente.value = cliente_id;
	  document.form_novocontato.submit();

  }
</script>

<script>

	<?
		if ($ok == 12 || $area==1) {
			$qtde = conn_executeScalar("select count(1) from  retaguarda_fila where ic_status=1 ");
			if ($qtde > 0)
				echo 'toastr["info"]("<a href=\'./retaguarda/index.php\' target=\'blank\'>Há ' . $qtde . ' pessoa(s) na fila</a>");';		}
	?>

</script>

<?php
mysql_free_result($rsStatusConsultor);
mysql_free_result($rsUsuario);
mysql_free_result($rsEstadoConsulto);
?>