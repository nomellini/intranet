<?php require_once('../Connections/sad.php'); ?>
<?
	require("scripts/conn.php");		
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
	
	
	$agoraTimeStamp=date("Y-m-d H:i:s");
	$agora=strtotime($agoraTimeStamp);
	
	if ($acao=='novo_status') {
		$sql = "update usuario set estado = $status_consultor, estado_hora = '$agoraTimeStamp' where id_usuario = $id_usuario";
		$result = mysql_query($sql);				
	}

    if ( ($acao=="mudaestadoconsultor") or  ($acao=="mudaestado") ) { 
	
		$query_rsConsultores = "SELECT count(*) as qtde FROM usuario WHERE ativo = 1 and Estado = 2";	
		$rsConsultores = mysql_query($query_rsConsultores, $sad) or die(mysql_error());
		$row_rsConsultores = mysql_fetch_assoc($rsConsultores);
		$totalRows_rsConsultores = mysql_num_rows($rsConsultores);
		
		if ( $row_rsConsultores['qtde'] >= 4) {
			$msg = "Não pode alterar para não disponível";
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
				$status = $status + 1; if ($status==4) { $status=1;}	
				$sql = "update usuario set estado = $status, estado_hora = '$agoraTimeStamp' where id_usuario = $id_consultor";
				//die($sql);
				$result = mysql_query($sql);		
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

mysql_select_db($database_sad, $sad);
$query_rsStatusConsultor = "SELECT id, descricao FROM status_consultor";
$rsStatusConsultor = mysql_query($query_rsStatusConsultor, $sad) or die(mysql_error());
$row_rsStatusConsultor = mysql_fetch_assoc($rsStatusConsultor);
$totalRows_rsStatusConsultor = mysql_num_rows($rsStatusConsultor);

$colname_rsUsuario = "-1";
if (isset($_COOKIE['id_usuario'])) {
  $colname_rsUsuario = (get_magic_quotes_gpc()) ? $_COOKIE['id_usuario'] : addslashes($_COOKIE['id_usuario']);
}
mysql_select_db($database_sad, $sad);
$query_rsUsuario = sprintf("SELECT * FROM usuario WHERE id_usuario = %s", GetSQLValueString($colname_rsUsuario, "int"));
$rsUsuario = mysql_query($query_rsUsuario, $sad) or die(mysql_error());
$row_rsUsuario = mysql_fetch_assoc($rsUsuario);
$totalRows_rsUsuario = mysql_num_rows($rsUsuario);

mysql_select_db($database_sad, $sad);
$query_rsEstadoConsulto = "SELECT * FROM status_consultor WHERE id = " . $row_rsUsuario['Estado'];
$rsEstadoConsulto = mysql_query($query_rsEstadoConsulto, $sad) or die(mysql_error());
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
	$consultor = ($linha->area == 1); 
	$gerente = ($linha->gerente == 1);
	$fl_sat = $linha->fl_sat;


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
	  $lampada = '<img src=imagens/farolamarelo.jpg width=100 height=40 border=0><br>Atenção - ';
	} else if ($tempomaximo>=20) {
	  $lampada = "<img src=imagens/farolvermelho.jpg width=100 height=40 border=0><br>Crítica - ";	
	}
	$lampada .= "$tempominutos - $linha->id_cliente";


	// Caso de algum problema e o estado fique maior do que o permitido, volto para 
	// Disponível;
	$sql = "update usuario set estado = 1 where id_usuario = $ok and estado > 8";
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
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
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

</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="relatorios/coolbuttons.js"></script>
<script type="text/javascript" src="scripts/engine.js"></script>
<script type="text/javascript" src="scripts/engine2.js"></script>
	<script type="text/javascript">
		function submit_form(AAcao, AId) {
				// Construct URL
				var lId = escape(AId);
				url = 'handle_form.php?acao='+AAcao+'&id=' + lId +'&id_usuario=' + <?= $ok?>;
				teste =  document.getElementById('chamados_lista');
				teste.innerHTML = '<br>Aguarde... <br><br><img src="figuras/loading1.gif" alt="l" width="16" height="16">';				
				ajax_get (url, 'chamados_lista');
		}
		
		function abre_chamado(AId) {
				// Construct URL
				url = 'historicochamadoclean.php?&id_chamado=' + AId+'&ok=' + <?= $ok?>;
				teste =  document.getElementById('chamados_lista');
				teste.innerHTML = '<br>Aguarde... <br><br><img src="figuras/loading1.gif" alt="l" width="16" height="16">';				
				ajax_get (url, 'chamados_lista');
		}
		
		
	</script>


<font size="3"><img src="figuras/topo_sad_e_900.jpg" width="900" height="79" ></font>
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
        <font size="1">Usu&aacute;rio <font color="#FF0000">:<b> 
        <?=$nomeusuario?>
        </b></font></font></td>
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
                        <form name="form" method="post" action="historico.php" >
                          <td align="left" valign="top"><font size="2"><a href="javascript:seleciona();">C&oacute;digo 
                            do cliente</a><b>&nbsp;</b></font><font color="#0000FF"><b> 
                            <input type="hidden" name="action">
                            </b></font><font size="2">&nbsp;</font><font color="#0000FF"><b> 
                            <input type="text" name="id_cliente" class="bordaTexto">
                            </b> 
                            <input type="submit" name="Submit" value="Ver hist&oacute;rico" class="bordaTexto" >
                            &nbsp;[<a href="javascript:seleciona(); ">pesquisa</a> 
                            clientes]</font> </td>
                        </form>
                      </tr>
                    </table></td>
                  <td width="35%"> <table width="100%" border="0"  cellpadding="1" cellspacing="1">
                      <tr bgcolor="#FFFFFF"> 
                        <form name="form1" method="post" action="relatorios/relat2.php">
                          <td align="right" valign="top"> [<img src="figuras/lupa.gif" width="20" height="20" align="absbottom">busca 
                            por palavra 
                            <input type="text" name="palavra" class="bordaTexto">
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
                  <td width="33%"> <p><a href="/a/versao/"> 
                      <?  $i_msg = "Liberação de Release ";
			    if ($i_conta < 0) { echo "<font color=#ff0000 >$i_msg : Existe " . -$i_conta .  " releases em andamento</font>"; } else {echo $i_msg;}  
				
			    if($i_conta > 0) {?>
                      <font color = #ff0000 size = 2>: Você tem
                      <?=$i_conta?>
                      tarefa(s)</font> 
                      <? } ?>
                      </a> <br> 
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


					<form name="formulario2" id="formulario2" method="post" action="inicio2.php" >						
					
					<?
					  if ($consultor) {
					?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center">&nbsp;</td>
                      </tr>					
                      <tr>
                        <td background="#estados">
                        Meu Status : <?php echo $row_rsEstadoConsulto['descricao']; ?><br>
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

                        <input name="id_usuario" type="hidden" id="id_usuario" value="<?=$ok?>">
                        <input name="acao" type="hidden" id="acao" value="novo_status">
                        <br>
<span id="msg_muda_status"></span></td>
                      </tr>
                    </table>

					<?
					}
					?>
</form>				
					
</td>
                <td width="33%" align="center"> <a href="rnc/relatorios/index.php"><strong>Desktop 
                  Qualidade</strong></a> 
                  <? if ($gerente) {?>
                  <br>
                  [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_NAOCONFORMIDADE?>">não conformidade</a>] - [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOPREVENTIVA?>">Ação Preventiva</a>] - [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOMELHORIA?>">Ação Melhoria</a>]
				  <?
				   if (($ok == 12) or ($ok==1)) {
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
                    <br><a href="espera/consultor.php" class="style1">Minhas ligações</a> 
					<?
					 }
					  if ($DesktopSigame<>0) {
					?>					
					<br><a href="sigame/index.php">Desktop SIGA-ME (<? echo $DesktopSigame ?>)</a>
					<? 
					}
					?>
                    <br>
                    <?
					  if(($fl_sat or $consultor) and false) {
					   echo "<a href=\"javascript:janelaFarol();\" border=0>$lampada</a>";
					  }
					?>
                    <br>
                  </td>
                <td width="33%" align="right"> <a href="/a/relatorios/relatbaseweb.php"><font size="1">Base 
                  de conhecimento web</font></a> <br> <a href="/suporte/index.php"><font size="1">Base 
                    de Solu&ccedil;&otilde;es</font></a> <br>
                  <a href="javascript:online();">Quem está On Line</a>
                  <br>
                  <br>
                  <br>
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


Chamados Pendentes para  <?=$nomeusuario?>     :     	<span id="contapendentes"></span>
        <br>
        Chamados Encaminhados por
        <?=$nomeusuario?>
        : 
		<span id="contaencaminhados"></span>
		
</span> 
        <?
		    $chamadosemaberto = pegaChamadoPendenteUsuario($ok);
			$total_pendentes = count($chamadosemaberto);
						
	    ?>

<span id=msgnova></span><span id=lembretenovo></span> <br>
<a href="javascript:alterna(todos_chamados, txtTodosChamados, '+', '-');">Alternar entre mostrar ou esconder lista de chamados tradicional <span id=txtTodosChamados> - </span> </a><span id="todos_chamados" style="display: ">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
          <tr bgcolor="#003366"> 
            <td width="13%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Chamado</font></strong></td>
            <td width="7%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Data</font></strong></td>
            <td width="15%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">C&oacute;digo 
              do cliente</font></strong></td>
            <td width="65%"><strong><font size="1" color="#FFFFFF">Cliente + Descri&ccedil;&atilde;o</font></strong></td>
          </tr>
      </table>				
        <?
					   $contapendentes = 0;
					   $contaencaminhados =0;
					  					   
		  while ( list($tmp1, $tmp) = each($chamadosemaberto) ) {
		  
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
			   		  
			   $id = $tmp["id_cliente"];
			   $status_chamado = $tmp["status"];
			   $statusStr = ""; 
			   if($status_chamado>3) {
			    $statusStr = "<br>".pegaStatus($status_chamado);
			   }
			   $cliente = $tmp["cliente"];
			   $senha = $tmp["senha"];
			   $chamado = $tmp["chamado"];			
			   $dataAbertura = $tmp["dataa"] . "<br>" . $tmp["horaa"];
			   $descricao = $tmp["descricao"];
			   $destinatarioId = $tmp["destinatario_id"];
			   $usuarioId = $tmp["usuario_id"];
			   $remetenteId = $tmp["remetente_id"];			
			   $pendente = $tmp["pendente"];   
			   $encaminhado = $tmp["encaminhado"];
			   $fone=$tmp["telefone"];
			   $bl = $tmp["bloqueio"];
			   
			   $cor_fundo = CORES_DEFAULT;
			   
			   
               $cor_borda = BORDA_DEFAULT;
			   $largura_borda = 1;			   
			   
			   if ($tmp["externo"]) {
                 $cor_fundo = CORES_EXTERNO;
			   }
			   
			   if ($tmp["id_sistema"]==24) {
                 $cor_fundo = CORES_QUALIDADE;
			   }
   			   $rncTipo = '';
			   if ($tmp["rnc"]==1) {
			     $rncTipo = "<strong>Não conformidade</strong>";
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
			     $rncTipo = "<strong>Abertura de projeto</strong>";			   
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
					$rncResponsavel =  $tmp["rncDeptoResponsavel"];
					$rncPrazo = $tmp["rncPrazo"];
					$rncMensagem = "<br>--> ".$rncTipo."<br>Departamento responsável: <strong>$rncResponsavel</strong>. Prazo: <strong>$rncPrazo</strong>";
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
			  
			   if (   ($mostrachamado) and    ((!$encaminhado) or 
			                                  ($encaminhado and ($id_usuario == $destinatarioId)))
		          ) {	
  			   $contapendentes++;
			   $contaencaminhados = ($total_pendentes - $contapendentes);
			   

			?>
			
		

        <table width="100%" border="0" cellpadding="1" cellspacing="<?=$largura_borda ?>" bgcolor="<?=$cor_borda?>" class="bordagrafite02">			
          <tr> 
            <td bgcolor="<?=$cor_fundo?>"> <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr valign="bottom"> 
                  <td width="12%" align="center" valign="middle"> 
                    <? 
				   if ($temLembrete) { 
                    echo "<a href=\"lembrete/mostralembrete.php?id=$id_lembrete\"><img src=\"figuras/lembrete.jpg\"  width=\"20\" height=\"20\" align=\"absmiddle\" border=\"0\"></a>";
                    $lembretenovo++;					

      				}
				?>
                    <? if(!$lido) { echo '<img src=figuras/idea01.gif  align=absmiddle> '; $msgnova++; } ?>
                    <?= number_format($chamado,0,',','.') . "<br>$prioridade $statusStr"?>
                    <br> 
                    <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:novolembrete(<?=$chamado?>, <?=$ok?>);">Incluir 
                    Lembrete</a></font></td>
                  <td width="8%" align="center" valign="middle"> 
 
                   Abertura: <?=$dataAbertura?><br>
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
                  <td width="15%" align="center" valign="middle"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
                    <?
				 $msg = $id;
                 if ($bl) { $msg="<b><font color=#ff0000>$cliente</font></b>" ;}
				 $msg .= "<br>$fone";
                 echo $msg;
				 ?>
                    </font></td>
                  <td width="65%" valign="middle" > <font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
                    <?="<b>$cliente ($senha)</b><br><b><a href=historicochamado.php?&id_chamado=$chamado>$descricao...</a></b>"?>
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
				?>
                    <?=$rncMensagem?><br><?=$pastas?></font></td>
                </tr>
              </table></td>
          </tr>
        </table>
		

		
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <?}}
			?>
         <br>        
		 
		 </span>
		 
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
				  
<? 
  if($mydesktop->prioridade==1) {
?>
				  
                    <tr>
                      <td bgcolor="#F9FDFF">
					  Consulta R&aacute;pida por n&uacute;mero <br>
                            <input name="consultarapida" type="text" class="borda_fina" id="consultarapida" size="12">
<a href="javascript:abre_chamado(document.getElementById('consultarapida').value);">OK</a><br>
                      Chamados comigo </span></td>
                    </tr>
                    <?
	$sql = "Select distinct ";
	$sql .= "  chamado.prioridade_id, prioridade, valor, count(*) as quantidade ";
	$sql .= "from chamado ";
	$sql .= "  inner join prioridade on prioridade.id_prioridade = chamado.prioridade_id ";
	$sql .= "where ";
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
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('prioridade',<?=$linha->prioridade_id?> );" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style5 style7">
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
	$sql .= "where destinatario_id = $ok and status <> 1 ";
	$sql .= "group by sistema order by quantidade desc, sistema";
//	die($sql);
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('sistema',<?=$linha->id_sistema?> );" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style5 style7">
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
	$sql .= "where destinatario_id = $ok and status <> 1 ";
	$sql .= "group by cliente_id order by quantidade desc, sistema";
//	die($sql);
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('cliente', '<?=$linha->cliente_id?>' );" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style5 style7">
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
	$sql .= "where remetente_id = $ok and destinatario_id <> $ok and status <> 1 ";

	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('encaminhados', 0);" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'">
				  
					  
                        <strong>Encaminhados </strong>(<?=$linha->quantidade?>) </span> </td>
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
	
	$sql = "select count(*) as quantidade from chamado where
   ((destinatario_id=$ok and lido    =0)
or  (consultor_id   =$ok and lidodono=0)) and status > 1";

	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('novidades', 0);" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'">
				  
					  
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
	$sql = "Select pasta.id_pasta, descricao, (select count(*) from chamado_pasta where ";
	$sql .= "chamado_pasta.id_pasta = pasta.id_pasta) as quantidade from  pasta where ";
	$sql .= "id_usuario = $ok order by descricao ";
	
	$result = mysql_query($sql) or die (mysql_error());
	while ( $linha = mysql_fetch_object($result) ) {
	  $id_pasta = $linha->id_pasta;
	
?>
                    <tr>
                      <td bgcolor="#F9FDFF" onMouseDown="this.className='subbarselected'; abrirlista('pasta',<?=$linha->id_pasta?> );" onMouseOver="this.className='subbarhover'" onMouseOut="this.className='subbarnotselone'"><span class="style9"><strong>[<a href="pastas/excluipasta.php?id_pasta=<?=$linha->id_pasta?>">ex</a>]
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
<a href="preferencias.php?ok=<?=$ok?>">Personalizar meu desktop
</a><img src="../imagens/novo.gif" width="45" height="15" border="0" align="absmiddle"><br>
		
		
<br><a href="encaminhados.php"><font size="2">Ver Chamados Encaminhados e Pendências</font></a><br>

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
				  if (  ($linha->estado==4) and ($linha->sat_idcliente)) {
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
  window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
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
document.form.id_cliente.focus();


<?
if ($mydesktop->tradicional==1) {
?>
contapendentes.innerHTML = '<?=$contapendentes?>';
contaencaminhados.innerHTML = '<?=$contaencaminhados?>';


 if( <?=$msgnova?> ) {
   msgnova.innerHTML = "<br>Existe <?=$msgnova?> chamado(s) com mensagens não lidas (<img src=figuras/idea01.gif  align=absmiddle>)";
 }
 
 if( <?=$lembretenovo?> ) {
   lembretenovo.innerHTML = "<br>Extiste(m) <?=$lembretenovo?> chamado(s) com lembretes não lidos (<img src=figuras/lembrete.jpg  align=absmiddle>)<br>";
 }


<?
}
?>


function abrirlista(AAcao, AId )
{
  submit_form(AAcao, AId);
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


function AlteraStatusConsultor() {
    teste = document.formulario2.status_consultor.value;
	ajax_do ('ajax_01.php?status_id='+teste);
}

</script>
    </p>
      </p>
      <form name="form2" method="post" action="inicio.php">
</form>
</body>
<HEAD>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
</HEAD>
</html>
<?php
mysql_free_result($rsStatusConsultor);
mysql_free_result($rsUsuario);

mysql_free_result($rsEstadoConsulto);
?>