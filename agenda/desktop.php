<?
/*
   Este é o calendário da datamace.
   Autor : Fernando Nomellini
   Data  : 04/2003
   #C7E1EB
*/
 require("../a/scripts/conn.php");		
 require("scripts/Calendar.php");
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

    $ok = 12;	

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
?>

<html>
<head>
<title>Inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../a/stilos.css" type="text/css">
<meta http-equiv="refresh" content=300">
</head>
<body bgcolor="#FFFFFF" background="figuras/fundo.gif" text="#000000" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">
<script src="../a/coolbuttons.js"></script>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#003366">
  <tr>
    <td height="21" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#A2C8DB">
            <?  
  $sql = "";			  
  $sql .= "Select compromisso.id, compromisso.hora, compromisso.horafim, usuario.nome, compromisso.resumo, compromisso.local,";
  $sql .= "compromissousuario.confidencial, compromissousuario.lido, compromissousuario.id_usuario "; 
  $sql .= "FROM ";
  $sql .= "  compromisso, compromissousuario, usuario ";
  $sql .= "WHERE ";
  $sql .= "  compromisso.excluido <> 1 and ";
  $sql .= "  compromisso.data = '$ano-$mes-$dia' AND ";
  $sql .= "  compromissousuario.id_compromisso = compromisso.id AND ";
  $sql .= "  compromissousuario.id_usuario = usuario.id_usuario ";
  $sql .= "  AND ( ";
  $sql .= "      ( compromissousuario.confidencial = 0 and compromissousuario.id_usuario <> $ok ) OR ";
  $sql .= "      ( compromissousuario.id_usuario = $ok ) ";
  $sql .= " ) and usuario.id_usuario = $ok ";
  
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
                      <td width="16%"><?=substr($linha->hora,0,5)?>
                        <?=substr($linha->horafim,0,5)?>
                        </td>
                      <td width="23%"><A HREF="javascript:janela('<?=$linha->id?>');" class="fundoclaro">
                        <?=$nome?>
                      </a></td>
                      <td width="61%"><?=$linha->resumo?>
                        ::
                        <?=$linha->local?>
                                <br>                      </td>
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
</table>
</body>
</html>
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
