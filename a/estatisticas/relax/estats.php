<?
	require("../../scripts/conn.php");

    function pad($s, $n){
	   $r = $s;
       while (strlen($r) < $n) {
	     $r = "0".$r;
	   }
	   return $r;
	}


	if ($TipoReferencia == "MES") {
		$ano = $_POST["ano"];
		$mes = $_POST["mes"];
		$DataInicio = mktime(0,0,0, $mes, 1, $ano);
		$last_day = date("t", $DataInicio);
		$DataFim =  mktime(0,0,0, $mes, $last_day, $ano);
		$de = date("Y-m-d", $DataInicio);
		$ate = date("Y-m-d", $DataFim);
	} else {

		$Data = explode('/', $de);
		$DataInicio = mktime(0,0,0, $Data[1], $Data[0], $Data[2]);
		$de = "$Data[2]-$Data[1]-$Data[0]";

		$Data = explode('/', $ate);
		$DataFim = mktime(0,0,0, $Data[1], $Data[0], $Data[2]);
		$ate = "$Data[2]-$Data[1]-$Data[0]";
	}


	if ( isset($id_usuario) ) {
    	$ok = verificasenha2($cookieEmailUsuario, $cookieSenhamd5 );
	   	if ($ok<>$id_usuario) { header("Location: index.php?erro=1"); }
	    setcookie("loginok");
	} else {
      header("Location: index.php");
    }

    $nomeusuario=peganomeusuario($ok);
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
	background: url(../../../agenda/figuras/Cadeira.png) no-repeat right bottom
}
body {
	background-color: #E8F1FF;
}
.Fundo .Agendamento .Tabela .Header {
	background-image: url(../../relatorios/imagens/FundoTituloGride.jpg);
	color: #FFFFFF;
}

-->
</style>

<title>Relax</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content=300">
<link href="../../stilos.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center"><font color="#003366" size="3"> Estat&iacute;sticas da Agenda
  Relax</font><br>
<?=date("d/m/Y", $DataInicio);?> at� <?=date("d/m/Y", $DataFim); ?></div>
<font size="1"></font>
<p>
<?
	$dias = array( '', 'Domingo', 'Segunda', 'Ter�a', 'Quarta', 'Quinta', 'Sexta', 'Sabado' );
	$sql = "select count(1) qtde from relax r where (r.data >= '$de') and (r.data <= '$ate') ";

	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$total = $linha->qtde;

	$sql = "SELECT
  DayOfWeek(Data) dia,
  Count(1) qtde,
  (select count(1) from relax r2 where dayofweek(r2.data) = dayofweek(r.data) and hour(r2.hora) < 14 and (r2.data >= '$de') and (r2.data <= '$ate')) as manha,
  (select count(1) from relax r3 where dayofweek(r3.data) = dayofweek(r.data) and hour(r3.hora) >=14 and (r3.data >= '$de') and (r3.data <= '$ate'))  as tarde
FROM relax r
WHERE (r.data >= '$de') and (r.data <= '$ate')
Group By DayOfWeek(Data);";
	$result = mysql_query($sql);
?>
<table width="541" border="1">
<caption><?= $total?> Agendamentos no per�odo</caption>
  <tr>
    <td width="33%"><div align="center">Dia da semana </div></td>
    <td width="27%"><div align="center">% (qtde)</div></td>
    <td width="21%"><div align="center">Manh�</div></td>
    <td width="19%"><div align="center">Tarde</div></td>
  </tr>
<?
	$m = 0; $t = 0; $d = 0;
	while ($linha = mysql_fetch_object($result))
	{
		$TotalDoDia = $linha->qtde;
		$d += $TotalDoDia;
		if ($total != 0) {
			$Percentual = ($linha->qtde / $total) * 100;
		} else {
			$Percentual = 0;
		}
		$Percentual = number_format($Percentual, 1, ',', '.') . " %";
		$Manha = $linha->manha;
		$m += $Manha;
		$Tarde = $linha->tarde;
		$t += $Tarde;
		if ($TotalDoDia != 0) {
			$ManhaPercentual = number_format( 100* ($Manha/$TotalDoDia), 1, ',', '.') . " %";
			$TardePercentual = number_format( 100*($Tarde/$TotalDoDia), 1, ',', '.') . " %";
		} else {
			$ManhaPercentual = 0;
			$TardePercentual = 0;
		}

?>
  <tr>
    <td width="33%"><div align="center"><?=$dias[$linha->dia]?></div></td>
    <td width="27%"><div align="center"><?="$Percentual ($TotalDoDia)" ?></div></td>
    <td width="21%"><div align="center"><?="$ManhaPercentual ($Manha)"?></div></td>
    <td width="19%"><div align="center"><?="$TardePercentual ($Tarde)"?></div></td>
  </tr>
<?
	}
	if ($d!=0) {
		$mp = number_format( 100*($m/$d), 1, ',', '.') . " %";
		$tp = number_format( 100*($t/$d), 1, ',', '.') . " %";
	} else {
		$mp = 0;
		$tp = 0;
	}
?>
  <tr>
    <td width="33%"><div align="center"><strong>Totais</strong></div></td>
    <td width="27%"><div align="center"><strong>
      <?=$d ?>
    </strong></div></td>
    <td width="21%"><div align="center"><strong>
      <?="$mp ($m)" ?>
    </strong></div></td>
    <td width="19%"><div align="center"><strong>
      <?="$tp ($t)" ?>
    </strong></div></td>
  </tr>
</table>

<br>


<?

	$sql = "select
  u.nome,
  (select count(1) from relax r2 where r2.id_usuario = r.id_usuario and presente = 0 and (r2.data >= '$de') and (r2.data <= '$ate') 	 ) as f,
  (select count(1) from relax r3 where r3.id_usuario = r.id_usuario and presente = 1 and (r3.data >= '$de') and (r3.data <= '$ate') 	) as c,
  count(1) as t
from
  relax r
    inner join usuario u on u.id_usuario = r.id_usuario
WHERE (r.data >= '$de') and (r.data <= '$ate')
group by u.nome
order by c desc, nome";
	$result = mysql_query($sql) or die (mysql_error());
?>
<table width="542" border="1">
<caption>Usuários</caption>
  <tr>
    <td width="32%"><div align="left">Usuário</div></td>
    <td width="21%"><div align="center">Compareceu</div></td>
    <td width="32%"><div align="center">Faltou</div></td>
    <td width="15%"><div align="center">Total</div></td>
  </tr>
<?
	$c1 = 0; $c2 = 0; $c3 = 0;
	while ($linha = mysql_fetch_object($result))
	{
		//$Percentual = ($linha->qtde / $total) * 100;
		//$Percentual = number_format($Percentual, 2, ',', '.') . "%";
		$c1 += $linha->c ;
		$c2 += $linha->f ;
		$c3 += $linha->t ;

?>
  <tr>
    <td width="32%"><div align="left">
      <?=$linha->nome?>
    </div></td>
    <td width="21%"><div align="center"><?=$linha->c ?></div></td>
    <td width="32%"><div align="center"><?=$linha->f ?></div></td>
    <td width="15%"><div align="center"><?=$linha->t ?></div></td>
  </tr>
<?
	}
	if ($c3 != 0) {
		$cp = number_format( 100*($c1/$c3), 2, ',', '.') . " %";
		$fp = number_format( 100*($c2/$c3), 2, ',', '.') . " %";
	} else {
		$cp = 0;
		$fp = 0;
	}
?>
  <tr>
    <td width="32%"><div align="left"><strong>Totais</strong></div></td>
    <td width="21%"><div align="center"><strong>
      <?="$c1 ($cp)"?>
    </strong></div></td>
    <td width="32%"><div align="center"><strong>
      <?="$c2 ($fp)" ?>
    </strong></div></td>
    <td width="15%"><div align="center"><strong>
      <?="$c3"?>
    </strong></div></td>
  </tr>
</table>
</p>
</body>
</html>