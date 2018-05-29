<?

function pegaChamadoPendenteUsuario_2($usuario) {

 $saida = array();

// $sql .= "SELECT ";
// $sql .= "c.sistema_id, c.externo, c.rnc, c.id_chamado, c.lido, c.lidodono, c.dataa,c.horaa, c.status, ";
// $sql .= " destinatario_id, consultor_id, remetente_id, c.categoria_id, ";
// $sql .= "LEFT(c.descricao, 70) as descricao, cl.id_cliente, cl.cliente, cl.telefone, cl.senha as senhacliente, p.prioridade, p.valor ";
// $sql .= "FROM chamado c, cliente cl, prioridade p ";
// $sql .= "WHERE ((c.cliente_id = cl.id_cliente) ";
// $sql .= "AND ( (c.descricao is not null) AND (c.descricao <> '') )";
// $sql .= "AND ( (c.destinatario_id = $usuario) or (c.consultor_id = $usuario) ) ";
// $sql .= "AND ( c.prioridade_id = p.id_prioridade) ";
// $sql .= "AND (c.status > 1) and (c.status<=3) ) ";
// $sql .= "ORDER BY p.valor, dataa desc, horaa desc;";

 $sql = ""; 
 $sql .= "SELECT ";
 $sql .= "  c.sistema_id, c.externo, c.rnc, c.id_chamado, c.lido, c.lidodono, c.dataa,c.horaa,  ";
 $sql .= "  c.status,destinatario_id, consultor_id, remetente_id, c.categoria_id, ";
 $sql .= "  LEFT(c.descricao, 70) as descricao, cl.id_cliente, cl.cliente, cl.telefone,  ";
 $sql .= "  cl.senha as senhacliente, p.prioridade, p.valor, s.status as statdesc ";
 $sql .= "FROM  ";
 $sql .= "  chamado c,  ";
 $sql .= "  cliente cl,  ";
 $sql .= "  prioridade p, ";
 $sql .= "  status s ";
 $sql .= "WHERE  ";
 $sql .= "      ((c.cliente_id = cl.id_cliente) ";
 $sql .= "  AND ( c.status = s.id_status ) ";
 $sql .= "  AND ( (c.descricao is not null) AND (c.descricao <> '') ) ";
 $sql .= "  AND ( (c.destinatario_id = $usuario) or (c.consultor_id = $usuario) ) ";
 $sql .= "  AND ( c.prioridade_id = p.id_prioridade) ";
 $sql .= "  AND (c.status > 1) and (c.status<=3) ) ";
 $sql .= "ORDER BY  ";
 $sql .= "  p.valor,  ";
 $sql .= "  dataa desc,  ";
 $sql .= "  horaa desc";
 
//	 die($sql);

 $result = mysql_query($sql);
 $conta=0;
   while ($linha = mysql_fetch_object( $result ) ) {

     $quando = explode("-", $linha->dataa);

     $tmp["externo"] = $linha->externo;
     $tmp["lido"] = $linha->lido;
     $tmp["lidodono"] = $linha->lidodono;
     $tmp["usuario_id"] = $linha->consultor_id;
     $tmp["destinatario_id"] = $linha->destinatario_id;
     $tmp["remetente_id"] = $linha->remetente_id;
	 $tmp["categoria_id"] = $linha->categoria_id;


     $tmp["encaminhado"] =  (

          ($tmp["destinatario_id"] != $tmp["remetente_id"]) or
          ($tmp["destinatario_id"] != $tmp["usuario_id"])
     ) ;


     $tmp["id_cliente"] = $linha->id_cliente;
	 $tmp["senha"] = $linha->senhacliente;
     $tmp["cliente"] = $linha->cliente;

     $tmp["chamado"] = $linha->id_chamado;
     $tmp["descricao"] = $linha->descricao;
     $tmp["dataa"] = "$quando[2]/$quando[1]/$quando[0]";
     $tmp["horaa"] = $linha->horaa;
     $tmp["telefone"] = $linha->telefone;
     $tmp["status"] = $linha->status;
     $tmp["prioridade"] = $linha->prioridade;
     $tmp["prioridadev"] = $linha->valor;
     $tmp["id_sistema"] = $linha->sistema_id;
     $tmp["rnc"] = $linha->rnc;
	 $tmp["statusdesc"] = $linha->statdesc;

     $saida[$conta++] = $tmp;
   }

  return $saida;
}





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
	
    $agoraTimeStamp=date("Y-m-d H:i:s");
    $agora=strtotime($agoraTimeStamp);
	
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
	  $lampada = '<img src=imagens/farolamarelo.jpg width=100 height=40 border=0><br>Aten��o - ';
	} else if ($tempomaximo>=20) {
	  $lampada = "<img src=imagens/farolvermelho.jpg width=100 height=40 border=0><br>Cr�tica - ";	
	}
	$lampada .= "$tempominutos - $linha->id_cliente";


	// Caso de algum problema e o estado fique maior do que o permitido, volto para 
	// Dispon�vel;
	$sql = "update usuario set estado = 1 where id_usuario = $ok and estado > 4";
	mysql_query($sql);
	
?>

<html>
<meta http-equiv="refresh" content="600;URL=inicio.php">
<style type="text/css">
<!--
.style1 {font-size: 12px}
-->
</style>
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="relatorios/coolbuttons.js"></script>
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
                      <?  $i_msg = "Libera��o de Release ";
			    if ($i_conta < 0) { echo "<font color=#ff0000 >$i_msg : Existem " . -$i_conta .  " releases em andamento</font>"; } else {echo $i_msg;}  
				
			    if($i_conta > 0) {?>
                      <font color = #ff0000 size = 2>: Voc� tem
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



					
					<?
					  if ($consultor) {
					?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center">&nbsp;</td>
                      </tr>					
                      <tr>
                        <td align="center" background="#estados"><a href="?acao=mudaestado&status=<?=$status?>"><img src="imagens/estado<?=$status?>.jpg" width="120" height="20" border="0"></a> <a href="#estados"><br>
                        (<strong>verifique</strong> os outros consultores <br>
                        antes de alterar o seu Estado) </a></td>
                      </tr>
                    </table>					
					<?
					}
					?>
</td>
                <td width="33%" align="center"> <a href="iniciornc.php"><strong>Desktop 
                  RNC</strong></a> 
                  <? if ($gerente) {?>
                  <br>
                  [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_NAOCONFORMIDADE?>">n�o conformidade</a>] - [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOPREVENTIVA?>">A��o Preventiva</a>] - [<a href="rnc/rnc.php?action=novo&tipo=<?=SAD_ACAOMELHORIA?>">A��o Melhoria</a>]
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
                    <br><a href="espera/consultor.php" class="style1">Minhas liga��es</a> 
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
                  <a href="javascript:online();">Quem est� On Line</a>
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
		    $chamadosemaberto = pegaChamadoPendenteUsuario_2($ok);
			$total_pendentes = count($chamadosemaberto);
		  ?>
        Chamados Pendentes para 
        <?=$nomeusuario?>
        : 
        <?=$total_pendentes?>
        <br> <span id=msgnova></span><span id=lembretenovo></span> <br> <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
          <tr bgcolor="#003366"> 
            <td width="13%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Chamado</font></strong></td>
            <td width="7%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">Data</font></strong></td>
            <td width="15%" align="center" valign="middle"> <strong><font size="1" color="#FFFFFF">C&oacute;digo 
              do cliente</font></strong></td>
            <td width="65%"><strong><font size="1" color="#FFFFFF">Cliente + Descri&ccedil;&atilde;o</font></strong></td>
          </tr>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="imagens/nulo.gif" width="1" height="1"></td>
          </tr>
        </table>
        <?
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
			    $statusStr = "<br>".$$tmp["statusdesc"];
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
   			   
			   if ($tmp["rnc"]==1) {
			     if (!$teste) {
    				 $cor_fundo = "#cccccc";
				 } else {
                   $cor_fundo = "#$teste";
				 }
			   }
			   
			   if ($tmp["rnc"]==4) {
			     if (!$teste) {
    				 $cor_fundo = "#caaccc";
					 $largura_borda = 2;
					 $cor_borda = BORDA_ACAOMELHORIA;
				 } else {
                   $cor_fundo = "#$teste";
				 }
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
			   
//			   
//			   $sql = "select * from lembrete where id_destinatario = $ok and id_chamado = $chamado and not lido";
//		   	   $temLembrete = 0;
//			   $result = mysql_query($sql); 
//			   while ( $linha = mysql_fetch_object($result) ) {
//			     $id_lembrete = $linha->id;
//			     if (($linha->periodo) == "M" ) {
//			       $horario = "08:00:00";
//			     } else {
//			       $horario = "13:00:00";			   
//			     }
//			     $date1=strtotime( $linha->data . ' ' . $horario);				 
//				 if ($agora > $date1) {
//				   $temLembrete = 1;				   
//				   break;
//				 }
//			   }
//			   
//			   
			  
			   if ( ($tmp["externo"]) or (!$encaminhado) or ($encaminhado and ($id_usuario == $destinatarioId)) ) {			   
		
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
                    <?="$chamado<br>$prioridade $statusStr"?>
                    <br> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:novolembrete(<?=$chamado?>, <?=$ok?>);">Incluir 
                    Lembrete</a></font> </td>
                  <td width="8%" align="center" valign="middle"> 
                    <?=$dataAbertura?>
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
					    $msg = " � voc� por " . peganomeusuario($remetenteId);						
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
                    </font></td>
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
		?>
        <a href="encaminhados.php">
        <font size="2">
           Ver Chamados Encaminhados e Pend&ecirc;ncias 
        </font></a>
        <br>        <br> 
		
<?
		 // $sub = pegaSubordinados($id_usuario);
		  if (count($sub)) {
		    require("scripts/pendencias.php");
		  }		  
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
      <td align="right" valign="top"><font color="#999999">Sad 2004</font></td>
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
  window.open('selecionacliente.php?id_cliente='+value, "Sele��o", "scrollbars=yes, height=488, width=600");
}


 if( ('-<?=$pesquisa?>'!='-') ) {
  document.form.id_cliente.value='<?=$pesquisa?>';
  seleciona();  
 } else {
  document.form.id_cliente.focus();
 }

 if( <?=$msgnova?> ) {
   msgnova.innerHTML = "Existe(m) <?=$msgnova?> chamado(s) com mensagens n�o lidas (<img src=figuras/idea01.gif  align=absmiddle>)";
 }
 
 if( <?=$lembretenovo?> ) {
   lembretenovo.innerHTML = "<br>Extiste(m) <?=$lembretenovo?> chamado(s) com lembretes n�o lidos (<img src=figuras/lembrete.jpg  align=absmiddle>)<br>";
 }


function novolembrete(chamado, usuario) {
  var newWindow;
  window.name = "pai";  
  newWindow = window.open( 'lembrete/novolembrete.php?inicio=1&id_chamado='+chamado+'&id_usuario='+usuario, '', 'width=500, height=300');
}  

function online() {
   window.open( 'online.php', '', 'scrollbars=yes, width=600, height=400');
   document.form2.submit();
}  
document.form.id_cliente.focus();
</script>
    </p>
      </p>
      <form name="form2" method="post" action="inicio.php">
      </form>
</body>
</html>
