<?
/*
   Agenda da cadeira de massagens.
   Autor : Lucas Oliveira Silva
   Data  : 06/2016
*/
	 require_once("../a/scripts/conn.php");		
	 require("scripts/Calendar.php");
	 require("scripts/Funcoes.php");


	$diasPermitidos = array(0,1,2,3,4,5,6,7);
	
	$god = conn_IsGod($id_usuario);	

	function add($timestamp, $seconds,$minutes,$hours,$days,$months,$years) { 
	  $mytime = mktime(1+$hours,0+$minutes,0+$seconds,1+$months,1+$days,1970+$years); 
	  return $timestamp + $mytime; 
	} 
	
	function dataLink($teste) {
	  return "dia=".date("d", $teste)."&mes=".date("m", $teste)."&ano=".date("Y", $teste);      
	}
	
	function somaDia($qtde, $dia, $mes, $ano) {	
		
		global $diasPermitidos;
		
		$today = mktime(0,0,0,$mes,$dia,$ano);	
		$direcao = gmp_sign($qtde);		
		$contador = 0;
		
		$today = date('Y-m-d', $today);	
		for ($contador = 0; $contador < abs($qtde); $contador++)
		{
			
			if ($direcao == 1)
				$soma = date('Y-m-d', strtotime( "$today + 1 day" ));
			else
				$soma = date('Y-m-d', strtotime( "$today - 1 day" ));
            $diaSemana = date("w", strtotime($soma));						
			$pode = in_array($diaSemana, $diasPermitidos);			
			$today = $soma;					
			$c = 1;
			while( !$pode )
			{
				if ($direcao == 1)
					$soma = date('Y-m-d', strtotime( "$today + 1 day" ));
				else
					$soma = date('Y-m-d', strtotime( "$today - 1 day" ));	
				$diaSemana = date("w", strtotime($soma));			
				$pode = in_array($diaSemana, $diasPermitidos);				
				$today = $soma;
				$c++;
			}						
			$today = $soma;			
		}		
		return strtotime($today);
	}
	

	
	//somaDia(3, 2, 3, 2016);
	
	
	$HoraInicial_1 = "08:00:00";
	$HoraFinal_1 = "12:00:00";
	
	$HoraInicial_2 = "13:00:00";
	$HoraFinal_2 = "17:00:00";	
	
	$IntervaloEmMinutos = 20;

	$TemAlmoco = true;	
	
	// 0 = Domingo, 1 = Segunda, 2 = terça, 3 = Quarta...

    $BRDays3 = array ("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");		
	
	
			
	if (!isset($dia)) {
		$dia = date("d");
		$mes = date("m");
		$ano = date("Y");
	} 	
	$DataCompromisso = mktime(0, 0, 0,$mes, $dia, $ano);				
	$hoje = $DataCompromisso;
	$HojeSemana = date("w", $DataCompromisso);			
	
	$pode = in_array($HojeSemana, $diasPermitidos);	
	if (!$pode) {
		$hoje = somaDia(1, $dia, $mes, $ano);
		$HojeSemana = date("w", $hoje);	
		$DataCompromisso = $hoje;
	} 
	$diaSemanaTexto = $BRDays3[$HojeSemana];
	
	$dia = date("d", $DataCompromisso);
	$mes = date("m", $DataCompromisso);
	$ano = date("Y", $DataCompromisso);
	
     $segs = (strtotime(date("Y-m-d")) - $DataCompromisso);

     $dias = floor($segs/3600/24);	

	 $m = "";
	 
	 if ($dias < 0)
	 	$sinalDias = -1;
	 else
	 	$sinalDias = 1;
	
	 
	 $dias = abs($dias);
	 if ($sinalDias == -1)
	 {
		 if ($dias == 0) {
			$m = "Hoje";
		 } else if ($dias == 1) {
			$m = "Amanhã";
		 } else if ($dias == 2) {
			$m = "Depois de amanhã";
		 } else 
			$m = "daqui a $dias dias";
		 
	 }
	 else 
	 {
		 if ($dias == 0) {
			$m = "Hoje";
		 } else if ($dias == 1) {
			$m = "Ontem";
		 } else if ($dias == -1) {
			$m = "Amanhã";
		 } else if ($dias == 2) {
			$m = "Anteontem";
		 } else if ($dias == -2) {
			$m = "Depois de amanhã";
		 } else {
			$m = "há $dias dias";
		 } 
	 }
	
	$now = date("G:i:s");	 

	$hoje = strtotime(date("Y-m-d"));

	$restricao = "00:00:00";	
	if ($hoje == $DataCompromisso)  {
		$restricao = "$now";
	} else if ($hoje > $DataCompromisso) {	
		$restricao = "23:59:59";
	}

	// Sem o 0 na frente,  ele não reconhece o horário.	
	if (strlen($restricao) == 7){		
		$restricao = "0".$restricao;
	}

	


	if ($action  == 'grava') {
		$sql = "insert into relax_cadeira (data, hora, id_usuario) values ('$data', '$hora', $id)";
		mysql_query($sql) or die (mysql_error());
	}	
	
	if ($action  == 'apaga') {
		$sql = "delete from relax_cadeira where data='$data' and hora = '$hora' and id_usuario = $id";
		mysql_query($sql) or die (mysql_error());
	}	
	
	if ($action  == 'alterna') {
		if ($presente) {
			$presente = 0;
		} else {
			$presente = 1;
		}
		$sql = "update relax_cadeira set presente = $presente where data='$data' and hora = '$hora' and id_usuario = $id";
		mysql_query($sql) or die (mysql_error());
	}	
	


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
	   	if ($ok<>$id_usuario) { 
			header("Location: index.php?erro=1"); 
		}
	    setcookie("loginok");  
	} else { 
      header("Location: index.php");
    }

	$data = "$dia/$mes/$ano";		
    $datacompromisso = "$ano-$mes-$dia";
	$datacompromissoTimeStamp = mktime(0,0,0,$mes, $dia, $ano);
	$datacompromissoSemanaNumerica = date("w", $datacompromissoTimeStamp);
	$datacompromissoSemanaLiteral = $BRDays3[$datacompromissoSemanaNumerica];

		
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

    $cal = new MyCalendar;
    $BRMonths = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    $BRDays = array ("D", "S", "T", "Q", "Q", "S", "S");
    $BRDays2 = array ("DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB");	
    $cal->setMonthNames($BRMonths);
    $cal->setDayNames($BRDays);

    $hDia = date("d"); $hMes = date("m"); $hAno = date("Y");
		
	$hoje = "dia=$hDia&mes=$hMes&ano=$hAno";
	$dataAtual = $BRDays3[ date("w") ] . ", $hDia de " . $BRMonths[ $hMes-1 ] . " de $hAno";
	
    //$info = Funcoes_Info( $mes, $dia, $ano );	
	
	
	function JaTenhoNesteDia($data, $id) {
		$sql = "select count(1) qtde from usuario u ";
		$sql .= " left join relax_cadeira r on r.id_usuario = u.id_usuario ";
		$sql .= " where r.data='$data' and r.id_usuario=$id;";
		$result = mysql_query($sql) or die (mysql_error());
		$return = 0;		
		if ($linha = mysql_fetch_object($result)) {
			$return = $linha->qtde;
		}
		return $return == 1;
	}
	
	function NomeDoUsuario($data, $hora) {
		$retorno = Array();
		
		$sql = "select u.nome, u.id_usuario, r.presente from usuario u left join relax_cadeira r on r.id_usuario = u.id_usuario ";
		$sql .= " where data='$data' and hora='$hora';";
		$result = mysql_query($sql);
		$return = "";		
		if ($linha = mysql_fetch_object($result)) {
			$return[1] = $linha->nome;
			$return[2] = $linha->id_usuario;		
			$return[3] = $linha->presente;
		}
		return $return;
	}
	
	function PegaClasse($Nome) {
		if ($Nome == "") {
			return "Disponivel";
		} else {
			return "Ocupado";
		}
	}
	
		
	$TemCompromisoNoDia =  JaTenhoNesteDia($datacompromisso, $ok);



	$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );
	
	// 143 - flávia, 187 - Janaina,  12 - Fernando
	$podeVerCompareceu = ($ok == 143) | ($ok == 187) ;//| ($ok == 12)    ;
	
	
?>
<html>
<head>
<style type="text/css">
<!--

.Agendamento {
	font-size: 12px;
}

.Tabela {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	border: 1px solid #CCCCCC;
}

.Tabela td {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
	font-size: 13px;
}

.Disponivel {
	background-color: #E4FEDA;
}

.Ocupado {
	background-color: #FFECEF;
}

.Fundo {
	background: url(figuras/Cadeira.png) no-repeat right bottom
}

body {
	background-color: #E8F1FF;
    overflow-x: hidden;
	overflow-y: hidden;
}
.Fundo .Agendamento .Tabela .Header {
	background-image: url(../a/relatorios/imagens/FundoTituloGride.jpg);
	color: #FFFFFF;
}

-->
</style>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	function grava(hora) {
		document.form1.action.value = 'grava';
		document.form1.hora.value = hora;
		document.form1.submit();
	}
	function apaga(hora) {		
	     if ( window.confirm('Excluir este agendamento ?') ) {		
			document.form1.action.value = 'apaga';
			document.form1.hora.value = hora;
			document.form1.submit();
		 }	else {
		 	return false;
		 }
	}	
	function alterna(hora, id, presente) {
		if (presente == '') {
			document.form1.presente.value = '0';
		} else {
			document.form1.presente.value = presente;	
		}
		document.form1.action.value = 'alterna';
		document.form1.hora.value = hora;
		document.form1.id.value = id;
		document.form1.submit();
	}	
	
</script>
<title>Agenda de massagem</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content=300">
<link href="../a/stilos.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center"><font color="#003366" size="3"> Agendamento de Massagem na Cadeira</font></div>
<font size="1"></font>

<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td width="40%"><font size="1">Usu&aacute;rio <font color="#FF0000">:<b>
      <?=$nomeusuario?>
      </b></font></font></td>
    <td width="60%" align="right" valign="top"></td>
  </tr>
</table>


<form name="form1" method="post" action="">
  <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" Class="aFundo">
    <tr>
      <td width="82%" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                <tr>
                  <td><p><a href="massagem_cadeira.php?<?=dataLink(somaDia(-1, $dia, $mes, $ano))?>"><br>
                    <img src="figuras/anterior.gif" alt="Anterior" width="20" height="20" border="0" align="absmiddle"></a> <font color="#FF0000" size="2"><strong>
                    <?="$data - $datacompromissoSemanaLiteral ($m)" ?>
                    </strong></font> <a href="massagem_cadeira.php?<?=dataLink(somaDia(1, $dia, $mes, $ano))?>" ><img src="figuras/proximo.gif" alt="Pr&oacute;ximo" width="20" height="20" border="0" align="absmiddle"></a> <span id="vc"></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    <br>
                    <br>
                  </p></td>
                </tr>
                <tr>
                  <td><div Class="Agendamento">
                      <table width="620" cellpadding="0" cellspacing="0" class="Tabela">
                        <thead Class="Header">
                          <tr>
                            <th width="68">Hora</th>
                            <th width="312">Nome</th>
                                                        <? if ($podeVerCompareceu) { ?>
                            <th width="226">Presen&ccedil;a</th>
                                                        <? }?>
                          </tr>
                        </thead>
                        <tbody>
<?
					// Primeiro per&iacute;odo
					$HoraInicial = $HoraInicial_1;
					$HoraFinal = $HoraFinal_1;
					$timestampFinal = strtotime("$HoraFinal");
					$timestamp = strtotime("$HoraInicial");
					$next_time = date('H:i:s', $timestamp);
					while ($timestamp < $timestampFinal) {
					
						$dados = NomeDoUsuario($datacompromisso, $next_time);
						$NomeUsuario = $dados[1];
						$IdUsuario = $dados[2];
						$Presente = $dados[3];
						

						
						$MeuLink = ($ok == $IdUsuario) || $god;
						$Classe = PegaClasse($NomeUsuario);
					
						$flag = 0;
						if ($NomeUsuario == "") {
							$msg = "&nbsp;";
							if (!$TemCompromisoNoDia) {								
								$link = "<a href=\"javascript:grava('$next_time');\">Reservar este horário</a>";
								$flag = 1;
							} else {
								$link = "-";
								$flag = 1;								
							}
						} else {
							if ($MeuLink) {
								$link = $NomeUsuario . " <a href=\"javascript:apaga('$next_time');\">Excluir</a>";
								$flag = 2;								
							}
							else {
								$link = $NomeUsuario;
								$flag = 2;								
							}
						}
						
						if ($next_time > $restricao) {
							//$link = "$restricao";
							
						} else {
							if ($flag==1) {
								$link = "Este Horário ficou sem uso";
							}
							if ($flag==2) {
								$link = $NomeUsuario;
							}												
						}						
						
						$msg = "&nbsp;";
						if ($NomeUsuario != "")				
							if ( $podeVerCompareceu) {							
								if($Presente) {
									$msg = "Compareceu";
								} else {
									$msg = "Não Compareceu";	
								}							
								$msg = "<b>$msg</b>";														
								$msg .= "&nbsp;&nbsp;<a href=\"javascript:alterna('$next_time', '$IdUsuario', '$Presente');\">[Trocar]</a>";
							}					
					
					
					?>
                          <tr class="<?=$Classe?>">
                            <td><b><?=$next_time?></b></td>
                            <td><?=$link?></td>
                            <? if ($podeVerCompareceu) { ?>
                            <td><?=$msg?></td>
                            <? } ?>
                          </tr>
                      <?
						$timestamp = strtotime("$HoraInicial");
						$etime = strtotime("+$IntervaloEmMinutos minutes", $timestamp);
						$next_time = date('H:i:s', $etime);
						$HoraInicial = $next_time;    
						$timestamp = strtotime("$HoraInicial");						
					}
						if ($TemAlmoco) {
					?>
                          <tr>
                            <td>----</td>
                            <td>-- Pausa para o almo&ccedil;o --</td>
                            <? if ($podeVerCompareceu) { ?>
                            <td>--</td>
                            <? } ?>

                          </tr>
                    <?
						}
					// Primeiro per&iacute;odo
					$HoraInicial = $HoraInicial_2;
					$HoraFinal = $HoraFinal_2;
					$timestampFinal = strtotime("$HoraFinal");
					$timestamp = strtotime("$HoraInicial");
					$next_time = date('H:i:s', $timestamp);
					while ($timestamp < $timestampFinal) {
					
						$dados = NomeDoUsuario($datacompromisso, $next_time);
						$NomeUsuario = $dados[1];
						$IdUsuario = $dados[2];
						$Presente = $dados[3];
						
						

						$MeuLink = $ok == $IdUsuario;
						$Classe = PegaClasse($NomeUsuario);
					
						$flag = 0;
						if ($NomeUsuario == "") {
							$msg = "&nbsp;";
							if (!$TemCompromisoNoDia) {								
								$link = "<a href=\"javascript:grava('$next_time');\">Reservar este horário</a>";
								$flag = 1;
							} else {
								$link = "-";
								$flag = 1;								
							}
						} else {
							if ($MeuLink) {
								$link = $NomeUsuario . " <a href=\"javascript:apaga('$next_time');\">Excluir</a>";
								$flag = 2;								
							}
							else {
								$link = $NomeUsuario;
								$flag = 2;								
							}
						}
						
						if ($next_time > $restricao) {
							//$link = "$restricao";
							if ($flag==2) {
							}												
						} else {
							if ($flag==1) {
								$link = "Este Horário ficou sem uso";
							}
							if ($flag==2) {
								$link = $NomeUsuario;
							}					
							
						}
					
						$Aguardando = ( ($next_time > $restricao) && ($flag==2) );							
					
						$msg = "&nbsp;";
						if ($NomeUsuario != "")				
							if ( $podeVerCompareceu) {							
								if ($Aguardando)
									$msg = "Aguardando";
								else
									if($Presente) {
										$msg = "Compareceu";
									} else {
										$msg = "Não Compareceu";	
									}			
								if (!$Aguardando) {
									$msg = "<b>$msg</b>";														
									$msg .= "&nbsp;&nbsp;<a href=\"javascript:alterna('$next_time', '$IdUsuario', '$Presente');\">[Trocar]</a>";
								}
							}
											
					
					?>
                          <tr class="<?=$Classe?>">
                            <td><b><?=$next_time?></b></td>
                            <td><?=$link?></td>
                            <? if ($podeVerCompareceu) { ?>
                            <td><?=$msg?></td>
                            <? } ?>

                          </tr>
                          <?
						$timestamp = strtotime("$HoraInicial");
						$etime = strtotime("+$IntervaloEmMinutos minutes", $timestamp);
						$next_time = date('H:i:s', $etime);
						$HoraInicial = $next_time;  
						$timestamp = strtotime("$HoraInicial");						
					}
					?>
                        </tbody>
                      </table>
                  </div></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><input name="action" type="hidden" id="action">
            <input name="data" type="hidden" id="data" value="<?=$datacompromisso?>">
            <input name="hora" type="hidden" id="hora" value="">
            <input name="presente" type="hidden" id="presente" value="">
            <input name="id" type="hidden" id="id" value="<?=$ok?>"></td>
          </tr>
        </table>
          <br>
      </td>
      <td width="18%" align="right" valign="top"><?echo $cal->getMonthView($mes, $ano);?>
      <p> </p></td>
    </tr>
  </table>
</form>
<input name="btnFechar" type="button" id="btnFechar" title="fechar" onclick="window.close()" value="Fechar">

<p><?
$tabela = "relax_cadeira";
 require("_stats.php");
 ?></p>
</body>
</html>
<?


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

?>
