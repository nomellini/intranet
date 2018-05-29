<?

  function Funcoes_GetParticipantes($id_compromisso)
  {
	$sql = "Select usuario.nome from usuario, compromissousuario, compromisso where usuario.ativo = 1 and  ";
	$sql .= "compromisso.id = compromissousuario.id_compromisso and compromisso.id = $id_compromisso and usuario.id_usuario = compromissousuario.id_usuario ORDER BY nome;";
	$result = mysql_query($sql);
	while ( $linha2=mysql_fetch_object($result) ) {
	if ($p<>"") { $p .= ", "; }
		$p .= $linha2->nome;
	}
	return $p;
  }

  function Funcoes_Info($aMes, $aDia, $aAno) {
  
    $sql = "SELECT * FROM datas WHERE dia = $aDia and mes = $aMes";
	
    $tmp["nome"] = "";
	
	$result = mysql_query($sql);
	while ($linha = mysql_fetch_object($result)) {
	  if ($tmp["nome"] != "") { $tmp["nome"] .= "<br>";}	  
	  if ($linha->tipo == "F") { $tmp["tipo"] = "Feriado";}	  
	  if ($linha->tipo == "F") { $linha->descricao = "<font color=#ff0000>".$linha->descricao."</font>" ;} 	  	  
	  if ($linha->tipo == "E") { $linha->descricao = "<font color=#0000FF>".$linha->descricao."</font>" ;} 	  	  	  
	  if ($linha->tipo == "C") { $linha->descricao = "<font color=#006699>".$linha->descricao."</font>" ;} 	  	  	  	  
	  $tmp["nome"] .= $linha->descricao;	  
	}


    $tmp["classe"] = "Calendar";	  
	
    if (date("w", mktime(0,0,0,$aMes,$aDia,$aAno,0))==0) {
	  $tmp["cor"] = "#FFC4C4";
	  $tmp["classe"] = "CalendarFeriado";
	} else {
       $tmp["cor"] = "#BDD9E6";
	}
	
	/*
		
	if ($aDia==21 and $aMes==04) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Tiradentes";	
	} else 	if ($aDia==1 and $aMes==5) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Dia do trabalho";	
	} else	if ($aDia==26 and $aMes==5) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Corpus Christi";		  
	} else	if ($aDia==9 and $aMes==7) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Dia da Carta Magna";
	} else	if ($aDia==20 and $aMes==8) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Aniversário de São Bernardo do Campo";		  
	} else	if ($aDia==7 and $aMes==9) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Independência do Brasil";	
	} else	if ($aDia==12 and $aMes==10) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Nossa Senhora Aparecida";	
	} else	if ($aDia==2 and $aMes==11) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Finados";	
	} else	if ($aDia==15 and $aMes==11) {
	  $tmp["tipo"] = "Feriado";
	  $tmp["nome"] = "Proclamação da República";	
	}
	
	*/
	  



	
	
	if ($tmp["tipo"] == "Feriado") {
      $tmp["classe"] = "CalendarFeriado";	
	}
	return $tmp;  
  }
  
?>