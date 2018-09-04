<?php require_once('../Connections/sad.php'); ?>
<?php

	
    require("../a/cabeca.php");	
    require_once("scripts/Calendar.php");

	//$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
	$ok = $id_usuario;
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
$query_rsUsuarios = "SELECT id_usuario, nome FROM usuario WHERE ativo = 1 ORDER BY nome ASC";
$rsUsuarios = mysql_query($query_rsUsuarios, $sad) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);
?><?
/*
   Este é o calendário da datamace.
   Autor : Fernando Nomellini
   Data  : 04/2003
   #C7E1EB
*/

 require("scripts/Funcoes.php");

 $now = date("G:i:s");

 if ($ordem == "") {
  $ordem = 'hora , resumo, usuario.nome';
 } else if ($ordem== "nome") {
   $ordem = "usuario.nome";
 }
    function pad($s, $n){    
	   $r = $s;
       while (strlen($r) < $n) {
	     $r = "0".$r;
	   }
	   return $r;
	}
	
	if ( isset($id_usuario) ) {
    	$ok = $id_usuario;//verificasenha2($cookieEmailUsuario, $cookieSenhamd5 );	  
	   	if ($ok<>$id_usuario) { header("Location: index.php?erro=1"); }
	    setcookie("loginok");  
	} else { 
      header("Location: index.php");
    }

//	die("Temporariamente fora do ar" . $ok);

    if (!isset($dia)) {
      $dia = date("d");
	}
    if (!isset($mes)) {
      $mes = date("m");
	}
    if (!isset($ano)) {
	  $ano = date("Y");
	}	
	$data = "$dia/$mes/$ano";
    $datacompromisso = "$ano-$mes-$dia";
		
	class MyCalendar extends Calendar
	{
		function getCalendarLink($mes, $ano)
		{
			// Redisplay the current page, but with some parameters
			// to set the new month and year
			$s = getenv('SCRIPT_NAME');
			$mes = pad($mes,2); $ano=pad($ano,4);
			return "$s?mes=$mes&ano=$ano";
		}
		
		function getDateLink($dia, $mes, $ano)
		{			
			$dia = pad($dia,2) ; $mes = pad($mes,2); $ano=pad($ano,4);
			return "$s?dia=$dia&mes=$mes&ano=$ano";			
		}
		
	}	

		
    $nomeusuario=peganomeusuario($ok);	
//    loga_online($ok, $REMOTE_ADDR, 'Agenda : ' .$nomeusuario );	

    $cal = new MyCalendar;
    $BRMonths = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    $BRDays = array ("D", "S", "T", "Q", "Q", "S", "S");
    $BRDays2 = array ("DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB");	
    $BRDays3 = array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");		
    $cal->setMonthNames($BRMonths);
    $cal->setDayNames($BRDays);

    $hDia = date("d"); $hMes = date("m"); $hAno = date("Y");
		
	$hoje = "dia=$hDia&mes=$hMes&ano=$hAno";
	$dataAtual = $BRDays3[ date("w") ] . ", $hDia de " . $BRMonths[ $hMes-1 ] . " de $hAno";
	
    $info = Funcoes_Info( $mes, $dia, $ano );	
?><html>
<head>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">

	 $(document).ready(function() {


		$('iframe').load(function()
			{
				this.style.height = "1000 px";
				this.style.width = "100%";
			}
		);

	 });

		
</script>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../a/stilos.css" type="text/css">
<meta http-equiv="refresh" content=300">
</head>
<body bgcolor="#FFFFFF" background="figuras/fundo.gif" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="../a/coolbuttons.js"></script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="72" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../a/figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="87" class="coolButton"><a href="../agenda/index.php?novologin=true"><img src="../a/figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="111" class="coolButton"><img src="../a/figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="../a/trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="118" class="coolButton" align="center" valign="middle"> <a href="../index.php">Intranet</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="204" class="coolButton"><a href="/a/"><strong>SAD</strong></a></td>
  </tr>
</table>

<hr size="1" noshade>
<div align="center"><font color="#003366" size="3"><strong> </strong><strong> 
  </strong><img src="figuras/icone_calendario.gif" width="30" height="29" align="absmiddle">Agenda 
  Datamace </font></div>
<font size="1"></font> 
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td width="40%"><font size="1">Usu&aacute;rio <font color="#FF0000">:<b> 
      <?=$nomeusuario?>
      </b></font></font></td>
    <td width="60%" align="right" valign="top"><a href="/a/">Ir para o SAD</a></td>
  </tr>
</table>
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td width="75%" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="50%"><table width="100%" border="0" cellpadding="1" cellspacing="1">
              <tr> 
                <td> <a href="inicio.php?<?=dataLink(somaDia(-1, $dia, $mes, $ano))?>"><img src="figuras/anterior.gif" alt="Anterior" width="20" height="20" border="0" align="absmiddle"></a> 
                  <font color="#FF0000" size="2"><strong> 
                  <?=$data?>
                  </strong></font> <a href="inicio.php?<?=dataLink(somaDia(1, $dia, $mes, $ano))?>" ><img src="figuras/proximo.gif" alt="Pr&oacute;ximo" width="20" height="20" border="0" align="absmiddle"></a> 
                  <span id="vc"></span><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  <?
				    echo $BRDays3[  date("w", mktime(0,0,0,$mes,$dia,$ano,0)) ];
					echo "<br>";
                    if ( $info["nome"] != "")	{
					  echo "<h3>" . $info["nome"] . "</h3>";
					}

				  ?>
                </td>
              </tr>
            </table></td>
          <td width="50%" align="right"><a href="inicio.php?<?=$hoje?>"> 
            <?="Hoje é $dataAtual"?>
            </a> <br> <a href="#Semana">Ver a semana</a></td>
        </tr>
        <tr> 
          <td colspan="2"><table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#003366">
              <tr> 
                <td height="21" bgcolor="#FFFFFF">Compromissos :: <? if (!$_ReadyOnlyStatus) { ?> <a href="../../agenda/novocompromisso.php?<?=dataLink(somaDia(0, $dia, $mes, $ano))?>">Novo 
                  Compromisso</a> <? } ?> <br> 
                  <?php if ( ($view != "todos")  && (date("d/m/Y") == "$dia/$mes/$ano")) { ?>
                  <br>
                  Os compromissos mostrados nessa tela, s&atilde;o aqueles em 
                  que a hora de t&eacute;rmino <br> &eacute; maior do que a hora atual 
                  ( 
                  <?=$now?>
                  ). Clique em [<a href="inicio.php?view=todos">Ver Todos</a>] 
                  <?php } ?>
                  <br> <table width="100%" border="0" cellpadding="1" cellspacing="1">
                    <tr> 
                      <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#A2C8DB">
                          <?  
  $sql = "";			  
  $sql .= "Select distinct compromisso.id, compromisso.hora, compromisso.horafim, usuario.nome, compromisso.resumo, compromisso.local,";
  $sql .= "compromissousuario.confidencial, compromissousuario.lido, compromissousuario.id_usuario "; 
  $sql .= "FROM ";
  $sql .= "  compromisso, compromissousuario, usuario ";
  $sql .= "WHERE ";
  $sql .= "  usuario.ativo =  1 and ";  
  $sql .= "  compromisso.excluido <> 1 and ";
  $sql .= "  compromisso.data = '$ano-$mes-$dia' AND ";
  $sql .= "  compromissousuario.id_compromisso = compromisso.id AND ";
  $sql .= "  compromissousuario.id_usuario = usuario.id_usuario ";
  $sql .= "  AND ( ";
  $sql .= "      ( compromissousuario.confidencial = 0 and compromissousuario.id_usuario <> $ok ) OR ";
  $sql .= "      ( compromissousuario.id_usuario = $ok ) ";
  $sql .= " ) ";
  
  if ( ($view != "todos")  && (date("d/m/Y") == "$dia/$mes/$ano"))  {
    $sql .= "AND horafim > '$now'";
  }
  $sql .= "ORDER BY ";
  $sql .= $ordem;
  $result = mysql_query($sql);
  while ($linha=mysql_fetch_object($result)) {    
    $icones = "";
    
	if ( $linha->id_usuario==$ok &&  !$linha->lido ) {
      $icones .= "<img src=../a/figuras/idea01.gif>";
	}
	
    $CellBgColor = '#E1EFF4'; 			
	$nome = $linha->nome;

	if ($linha->id_usuario==$ok) {
      $CellBgColor = '#C7E1EB';
	  $nome = "<b>$nome</b>";
	  $qtdecomp++;	  
	}
		
	if ($linha->confidencial) {
	  $CellBgColor = '#FFFFCC'; 
	} 	
?>
                          <tr bgcolor="#E1EFF4"> 
                            <td colspan="4" align="center" valign="middle"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
                                <tr> 
                                  <td bgcolor="<?=$CellBgColor?>"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                                      <tr valign="top"> 
                                        <td width="24%"> 
                                          <?=substr($linha->hora,0,5)?>
                                          - 
                                          <?=substr($linha->horafim,0,5)?>
                                          <? if (!$_ReadyOnlyStatus) { ?>
                                          <a href=editar.php?id_compromisso=<?=$linha->id?> >  
                                          <? } ?>                                          
                                          Editar
                                         </td>
                                        <td width="21%"> <A HREF="javascript:janela('<?=$linha->id?>');" class="fundoclaro"> 
                                          <?=$nome?>
                                          </a></td>
                                        <td width="55%"> 
                                          <?=$linha->resumo?>
                                          :: 
                                          <?=$linha->local?>
                                          <br> </td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?
 } if (mysql_affected_rows()==0) {
?>
                          <tr bgcolor="#E1EFF4"> 
                            <td colspan="4"><strong>Nenhum Compromisso para essa 
                              data</strong></td>
                          </tr>
                          <?
 }
?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td height="21" bgcolor="#FFFFFF">Lembretes 
                  <table width="100%" border="0" cellpadding="1" cellspacing="1">
                    <tr> 
                      <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#A2C8DB">
                          <?
  $sql = "SELECT id_chamado, obs from lembrete WHERE id_usuario=$ok and data = '$ano-$mes-$dia';";
  $result = mysql_query($sql);
  while ($linha=mysql_fetch_object($result)) {    
?>
                          <tr bgcolor="#E1EFF4"> 
                            <td align="center"><strong><font color="#003366" size="3"><a href="/a/historicochamado.php?&id_chamado=<?=$linha->id_chamado?>" class="fundoclaro"> 
                              <?=$linha->id_chamado?>
                              </a></font></strong></td>
                            <td><strong><font color="#003366" size="3"> 
                              <?=$linha->obs?>
                              </font></strong></td>
                          </tr>
                          <?
 } if (mysql_affected_rows()==0) {
?>
                          <tr bgcolor="#E1EFF4"> 
                            <td colspan="2"><strong>Nenhum lembrete para esta 
                              data</strong></td>
                          </tr>
                          <?
 }
?>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr> 
                <td height="21" bgcolor="#FFFFFF"><form action="novocompromisso.php" method="post" name="form1">
                    <a href="novocompromisso.php?<?=dataLink(somaDia(0, $dia, $mes, $ano))?>">Novo 
                    Compromisso</a> </form></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <br> </td>
    <td width="25%" align="right" valign="top"><?echo $cal->getMonthView($mes, $ano);?>
      <p><form name=cal method=get>
      data
        <input name="dia" type="text" class="borda_fina" id="dia" size="2" maxlength="2" value="<?=$dia?>">/<input name="mes" type="text" class="borda_fina" id="mes" size="2" maxlength="2" value="<?=$mes?>">/<input name="ano" type="text" class="borda_fina" id="ano" size="4" maxlength="4" value="<?=$ano?>">      
        <input name="btnIr" type="submit" class="borda_fina" id="btnIr" value="ir">
        </form>
        <?
//	 include("tarefas.php");
	 ?>
	</p></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
</table>
<img src="../imagens/novo.gif">
<a href="javascript:alterna(salas, txtsalas, '&nbsp;&nbsp;Programação das salas: (clique para ver)', '&nbsp;&nbsp;Programação das salas: (clique para esconder)');"> <span id=txtsalas> &nbsp;&nbsp;Programação das salas: (clique para ver) </span> </a>
<span id="salas" style="display:none">

<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">	
	  
	<?
	  $sql = "select * from salas";
  	  $rsalas = mysql_query($sql);
      while ($salas=mysql_fetch_object($rsalas)) {
	?>  
    <tr bgcolor="#EEFFDD">  	 	
      <td colspan="3" valign="top">

      <?=$salas->nome?> [<?=$salas->localizacao?>] </td>
  </tr>	
	<?
		  
	    $sql = "select hora, horafim, resumo from compromisso where excluido = 0 and  ";
		$sql .= " data = '$datacompromisso' and id_sala = " . $salas->id;
		$sql .= " order by hora ";
//		$sql = "select * from salas";
		$rcompr = mysql_query($sql) or die($sql);
		while ($comp = mysql_fetch_object($rcompr)) {

	?>
	
    <tr> 	
      <td width="9%" valign="top">&nbsp;</td>
      <td colspan="2"><strong>[<?=$comp->hora?> - <?=$comp->horafim?>]</strong>
        <?=$comp->resumo?> 
     </td>
    </tr>



	<? }
	  }
	?>
 
</table>
  Obs - Clique no link 'listar salas' na tela de novo compromisso para reservar uma sala.
</span>
<br>
<br>
&nbsp;&nbsp;<a name="Semana"></a> Semana a partir da data selecionada
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#003366">
        <tr> 
          <td><table width="100%" border="0" cellpadding="1" cellspacing="1" >
		  
<?
  $qtdes = 6;
  for($z=0; $z<1; $z++) {
    $ini = $z + (($qtdes-1)*$z); // +1;
	$fim = $ini + $qtdes - 1;
?>		  
      <tr> 
                <? 		  
		  for ($i=$ini; $i<=$fim; $i++) {

//		    $teste = somaDia($i, $hDia, $hMes, $hAno);
		    $teste = somaDia($i, $dia, $mes, $ano);
			$dataLink = "dia=".date("d", $teste)."&mes=".date("m", $teste)."&ano=".date("Y", $teste);			
			$diaSemana = date("w", $teste);
            $Semana = $BRDays2[$diaSemana];			
			$link = "<a href=inicio.php?$dataLink>".date("d/m", $teste)." $Semana</a><hr size=1>";						
			$data = date("Y-m-d", $teste);		
			/*
			$sql = "SELECT count(*) as qtde from compromisso, compromissousuario where ";
			$sql .= "compromisso.id = compromissousuario.id_compromisso ";
			$sql .= "AND compromisso.data = '$data' AND compromissousuario.id_usuario = $ok";
			*/			
			$sql = "";			  
			$sql .= "Select distinct compromisso.id, usuario.nome as nome, compromisso.hora, compromissousuario.id_usuario ";
			$sql .= "FROM ";
			$sql .= "  compromisso, compromissousuario, usuario ";
			$sql .= "WHERE usuario.ativo = 1 and ";
            $sql .= "  compromisso.excluido <> 1 and ";
			$sql .= "  compromisso.data = '$data' AND ";
			$sql .= "  compromissousuario.id_compromisso = compromisso.id AND ";
			$sql .= "  compromissousuario.id_usuario = usuario.id_usuario ";
			$sql .= "  AND ( ";
			$sql .= "      ( compromissousuario.confidencial = 0 and compromissousuario.id_usuario <> $ok ) OR ";
			$sql .= "      ( compromissousuario.id_usuario = $ok ) ";
			$sql .= " ) ";
			$sql .= "ORDER BY ";
			$sql .= "  hora , usuario.nome;";
			$result = mysql_query($sql);
			$hora = "";
			while ($linha=mysql_fetch_object($result)) {    
//			    if ($hora != $linha->hora) {
				  $hora=$linha->hora;
				  $link .= "<font size=1>".substr($hora,0,5)."</font> ";
//				} else {
//				}
								
				$linkaux = "<A HREF=detalhe.php?id_compromisso=$linha->id TARGET=detalhe class=fundoclaro>$linha->nome</a><br>";
                if ($linha->id_usuario==$ok) {
                $linkaux = "<b>$linkaux</b>";
            	}
				
				$link .= $linkaux;
				
			}
						
		?>
                <td width="14%" align="left" valign="top" bgcolor="<?=cor($teste) ?>"> 
                  <?=$link?></td>
                <?
  }
?>
              </tr>
			  <?}?>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td align="left" valign="top">
    	<iframe  name="detalhe" src="todos.php?Consultor=<?=$ok?>&UserID=<?=$ok?>&dia=<?=$dia?>&mes=<?=$mes?>&ano=<?=$ano?>" ALLOWTRANSPARENCY="true" frameborder="0" align="center">
        </iframe>
    </td>
  </tr>
</table>

<A HREF=todos.php?UserID=<?=$ok?> TARGET=detalhe class=fundoclaro>.</a> 
</body>
</html>
<?php
mysql_free_result($rsUsuarios);
?>
<?

function add($timestamp, $seconds,$minutes,$hours,$days,$months,$years) { 
  $mytime = mktime(1+$hours,0+$minutes,0+$seconds,1+$months,1+$days,1970+$years); 
  return $timestamp + $mytime; 
} 

function dataLink($teste) {
  return "dia=".date("d", $teste)."&mes=".date("m", $teste)."&ano=".date("Y", $teste);      
}

function somaDia($qtde, $dia, $mes, $ano) {
   $today = mktime(0,0,0,$mes,$dia,$ano,1);
   return  add( $today, 0,0,0,$qtde,0,0 );
}

function cor($data) {
  $diaSemana = date("w", $data);
  
  if ($diaSemana == 0 ) {
    return "#BDD9E6";
  } else if ($diaSemana==6) {
    return "#BDD9E6";
  } else {
    return "#E1EFF4";
  }
  
}

if (!$qtdecomp) { $qtdecomp="0";}
?>
<script>
  
function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
   item.style.display='';
   sp.innerHTML  = i2;
 } else {
   item.style.display='none'
   sp.innerHTML  = i1;
 }
}  

function detalhe(id) {
  document.frames("detalhe").src = "detalhe.php?id_detalhe="+id;
}

function janela(id) {
  newWindow = window.open( 'detalhe.php?ed=1&ok=<?=$ok?>&id_compromisso='+id, '', 'top=100, left=100, width=700, height=300');
}

vc.innerHTML = "Você tem <?=$qtdecomp?> compromisso(s)";

</script>
