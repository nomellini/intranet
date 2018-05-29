<?
	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
    $pode = pegaGerencial($ok);   
	//$pode = 1;
	
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {
	

    $hoje = date("d/m/Y");	
	if ( !isset($data) ) {
      $data = date("d/m/Y");
	}
	
	$hoje = ($hoje==$data);
	
    $quando = explode("/", $data);
    $datar = "$quando[2]-$quando[1]-$quando[0]";
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];

	$total = count($ch);
	
	if (!isset($minutos)) {
		$minutos = 0;
	}
	$segundos = $minutos*60;
	

?>


<html>
<head>
<title>Tempo ocioso</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="..\overlib.js"></SCRIPT>
<script src="coolbuttons.js"></script>
<table width="43%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="20%" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="35%" class="coolButton"><a href="/a/inicio.php"><img src="../figuras/home.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      ao in&iacute;cio</a></td>
    <td width="45%" class="coolButton"><a href="/a/relatorios/"><img src="../figuras/relat.gif" width="20" height="20" align="absmiddle" border="0">voltar 
      p/ relat&oacute;rios</a></td>
  </tr>
</table>
<hr color=#ff0000 noshade size="1">
<font size="2" face="Verdana, Arial, Helvetica, sans-serif"><font size="1"> 
<?echo "Olá, $nomeusuario, hoje é ";?>
</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 

<script language="JavaScript">

 function vai(chamado) {
   location.href = '/a/historicochamado.php?id_chamado=<?=$chamado_id?>';
   location.href = 'inicio.php?subPendente='+document.form2.subPendente.value+"#pendencias";
 }


function limpa() {
  document.form.id_cliente.value='';
}

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }

function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}

      var diasemana = new Array;
      var mesescrito = new Array;
    
      diasemana[1] = "segunda-feira";
      diasemana[2] = "terça-feira";
      diasemana[3] = "quarta-feira";
      diasemana[4] = "quinta-feira";
      diasemana[5] = "sexta-feira";
      diasemana[6] = "sábado";
      diasemana[7] = "domingo";
     
      mesescrito[0] = "Janeiro";
      mesescrito[1] = "Fevereiro";
      mesescrito[2] = "Março";
      mesescrito[3] = "Abril";
      mesescrito[4] = "Maio";
      mesescrito[5] = "Junho";
      mesescrito[6] = "Julho";
      mesescrito[7] = "Agosto";
      mesescrito[8] = "Setembro";
      mesescrito[9] = "Outubro";
      mesescrito[10] = "Novembro";
      mesescrito[11] = "Dezembro";

      var datahoje = new Date();
      var dia;
      var mes;
      var ano;
      var diaindex;

      dia = datahoje.getDate();
      mes = datahoje.getMonth();
      ano = datahoje.getYear();
      diaindex = datahoje.getDay();   

     document.write (diasemana[diaindex] + ' ' +  dia + ' de ' + mesescrito[mes] + ' de ' + ano);
</script>
</font></font> 
<form name="form" method="post" action="r_018.php">
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><br>
  <table width="90%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4"> Consultor : 
        <select name="consultor" class="unnamed1">
		<option value="">Todos</option>
          <?  
    $consultores = pegaConsultores($atendimento);		
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $tmp["id_usuario"]==$consultor ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
        </select>
        Quantos minutos de intervalo ? 
        <input type="text" name="minutos" size="4" maxlength="4" class="unnamed1" value="<?=$minutos?>">
        data 
        <input type="text" name="data" size="12" maxlength="12" class="unnamed1" value="<?=$data?>">
        tipo 
        <select name="origem" class="bordaTexto">
          <option value="0">Todos</option>
<?  

  $arrcat = listaTipos();
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $origem==$tmp["id_origem"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_origem"] . " $s >" . $tmp["origem"] . "</option>";
  }
?>
        </select>
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
  </table>
</form>



  <?    
	/*    	
		1. Obter uma lista de funcionário com contato neste dia. Ou apenas o funcionário selecionado no combo:	    
	*/
	$SQL_01 = "select id_usuario, nome from usuario where id_usuario in (select distinct consultor_id from contato where dataa = '$datar' and (TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) <> 0) ";
	if ($consultor) {
		$SQL_01 .=  " and consultor_id = $consultor " ;
	}
	if ($origem) {
		$SQL_01 .=  " and origem_id = $origem ";
	}
	
	
	$SQL_01 .= ") order by nome";
	
	///echo $SQL_01;
	
	$result_01 = mysql_query($SQL_01);
	while ($linha_01 = mysql_fetch_object($result_01)) {
		
		$IdUsuario = $linha_01->id_usuario;
		$Nome = $linha_01->nome;
		
		$AccTempo = 0;
		$SegAcc = 0;
		$AccIdle = 0;
		$idleAcc = 0;
		$primeiro = true;
		
	//	echo "$IdUsuario - $Nome <br><br><br><br><br><br>";
		
		$SQL_02 = "SELECT 
       origem_id, 
       chamado_id, 
       nome, 
       contato.horaa, 
       horae, 
       SEC_TO_TIME( SUM(TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) AS tempo, 
       SUM(TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) AS tempoSec 
FROM 
     contato
            inner join usuario on contato.consultor_id = usuario.id_usuario
WHERE 
      usuario.id_usuario = $IdUsuario
      and (dataa='$datar' ) 
      and (TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) <> 0)
      and (historico is not null)";
	  

	if ($origem)
	{
		$SQL_02 .= "and origem_id = $origem "; 
	}
	  
		$SQL_02 .= " GROUP BY 
		nome, horaa";
		
//		Echo "<br> $SQL_02 <br>";
		
		$result_02 = mysql_query($SQL_02);
		while ($linha_02 = mysql_fetch_object($result_02))
		{	
		
			$IdChamado = $linha_02->chamado_id;
			$horaa =  $linha_02->horaa;
			$horae = $linha_02->horae;	
			$tempo = $linha_02->tempo;
			$tempoSeg = $linha_02->tempoSeg;
			if ($primeiro) {
				$HoraEMax = $horae;
				$primeiro = false;
			} 		
		
			$idle = timeDiff( $HoraEMax, $horaa );
			$seg = HoraToSeg($idle);	 
			$SegAcc += $tempoSeg; 	
			$idleAcc += $seg;
			

			echo "$Nome - $IdChamado - $horaa - $horae - $tempo -  " . SegToHora($seg) . " - " . SegToHora($idleAcc) . " <br>";		
?>

<?
			if ($horae > $HoraEMax)
			{
				$HoraEMax = $horae;
			}
		}
	}
	
	
	
} // end if PODE
?>

