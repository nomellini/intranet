<?
 require("../a/scripts/conn.php");		
 require("scripts/Funcoes.php"); 
 require("scripts/Calendar.php");					  
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
	
    function pad($s, $n){    
	   $r = $s;
       while (strlen($r) < $n) {
	     $r = "0".$r;
	   }
	   return $r;
	}
	
	
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
    $BRDays2 = array ("Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab");	
    $cal->setMonthNames($BRMonths);
    $cal->setDayNames($BRDays);

    $hDia = date("d"); $hMes = date("m"); $hAno = date("Y");
		
	$hoje = "dia=$hDia&mes=$hMes&ano=$hAno";
	$dataAtual = "$hDia de " . $BRMonths[ $hMes-1 ] . " de $hAno";
	
    $info = Funcoes_Info( $mes, $dia, $ano );		

?>
<html>
<head>
<title>Novo Compromisso</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../a/stilos.css" rel="stylesheet" type="text/css">
</head>

<body background="figuras/fundo.gif" leftmargin="3" topmargin="3" marginwidth="1" marginheight="1">


<span id='fe'></span>

<script src="../a/relatorios/coolbuttons.js"></script>

<script>
function atualiza() {
	var ids;
    var doc_tables = document.all.tags("input");
    var nome, linha, tipo, ativo;
	linha = "";
	ids = "";
    for (i=0; i<doc_tables.length; i++)  { 
		 tipo  = doc_tables(i).type;
		 ativo = doc_tables(i).checked;
         nome  = doc_tables(i).id;
         if ( tipo == "checkbox" && ativo && doc_tables(i).name != "particular") {
		   if (linha != "") { 
		   	linha = linha + ", ";
			ids = ids + ',';
		   }
           linha = linha + nome;
		   ids = ids + doc_tables(i).value;
         }
        }
  if (linha == "") {
    window.alert("Você deve selecionar pelo menos um nome");
	linha = "<font color=#ff0000>Selecione pelo menos um nome</font>";
  }

	nomes.innerHTML = linha;
	//var lId = escape(ids);
	url = 'handle_form.php?data=<?=$ano?>-<?=$mes?>-<?=$dia?>&ids=' + ids;
	teste =  document.getElementById('compromissos');
	teste.innerHTML = '<br>Aguarde... <br><br><img src="../a/figuras/loading1.gif" alt="l" width="16" height="16">';			
		
	ajax_get(url, "compromissos");
}

// Get base url
url = document.location.href;
xend = url.lastIndexOf("/") + 1;
var base_url = url.substring(0, xend);
var ajax_get_error = false;

function ajax_do (url) {
	// Does URL begin with http?
	if (url.substring(0, 4) != 'http') {
		url = base_url + url;
	}
	// Create new JS element
	var jsel = document.createElement('SCRIPT');
	jsel.type = 'text/javascript';
	jsel.src = url;
	//Append JS element (therefore executing the 'AJAX' call)	;
    //document.body.appendChild (jsel);
	fe.appendChild (jsel);
	return true;
}

function ajax_get (url, el) {
	
	
	// Has element been passed as object or id-string?
	if (typeof(el) == 'string') {
		el = document.getElementById(el);
	}

	// Valid el?
	if (el == null) { return false; }

	// Does URL begin with http?
	if (url.substring(0, 4) != 'http') {
		url = base_url + url;
	}

	// Create getfile URL
	getfile_url = base_url + 'pegaarquivo.php?url=' + escape(url) + '&el=' + escape(el.id);
	// Do Ajax	

	
	ajax_do (getfile_url);
	return true;
}
</script>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="coolBar">
  <tr align="center"> 
    <td width="72" class="coolButton" valign="middle" align="center"><a href="javascript:history.go(-1)"><img src="../a/figuras/voltar.gif" width="20" height="20" align="absmiddle" border="0">voltar</a></td>
    <td width="87" class="coolButton"><a href="../agenda/index.php?novologin=true"><img src="../a/figuras/logout.gif" width="20" height="20" align="absmiddle" border="0">Logout</a></td>
    <td width="111" class="coolButton"><img src="../a/figuras/senha.gif" width="20" height="20" align="absmiddle"><a href="../a/trocasenha.php">Alterar 
      Senha</a> </td>
    <td width="118" class="coolButton" align="center" valign="middle"> <a href="../index.php">Intranet</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="204" class="coolButton">&nbsp;</td>
  </tr>
</table>
<hr size="1" noshade>
<div align="center"><font color="#003366" size="3"><strong><br>
  </strong>Agenda Datamace<br>
  Agendando um novo <strong>compromisso</strong></font></div>
<form name="form1" method="post" action="donovocompromisso.php">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr> 
      <td width="8%" valign="top">Data </td>
      <td width="54%"> <font size="3"><strong> 
        <?=$data?>
        <input name="data" type="hidden" id="data" value="<?="$ano-$mes-$dia"?>">
        </strong> <font color="#FF0000" size="1">(Selecione a data antes de selecionar 
        os participantes)</font><strong> </strong></font></td>
      <td width="2%" rowspan="9" align="left" valign="top"><font color="#003366" size="3">
        <?
        echo $cal->getMonthView($mes, $ano);
		

					echo "<br>";
                    if ( $info["tipo"] == "Feriado")	{
					  echo "<h3>" . $info["nome"] . "</h3>";
					}


		?>
      </font></td>
      <td width="0%" rowspan="9" align="left" valign="top" bgcolor="#333333"><img src="figuras/1pixel.gif" width="1" height="1"></td>
      <td width="35%" rowspan="9" align="left" valign="top"><span id="compromissos"></span></td>
    </tr>
    <tr> 
      <td valign="top">Hora </td>
      <td>das 
        <input name="hora" type="text" class="borda_fina" id="hora" size="6" maxlength="5">
        (hh:mm) at&eacute; 
        <input name="horafim" type="text" class="borda_fina" id="horafim" size="5" maxlength="5">
        (hh:mm) </td>
    </tr>
    <tr> 
      <td valign="top">Resumo</td>
      <td><input name="resumo" type="text" class="borda_fina" id="resumo" size="50" maxlength="50"></td>
    </tr>
    <tr> 
      <td valign="top">local</td>
      <td><input name="local" type="text" class="borda_fina" id="local" size="50" maxlength="50"> 
      [<a href="javascript:listasalas()">listar salas</a>] 
      <input name="id_sala" type="hidden" id="id_sala" value="0">
      <img src="../imagens/novo.gif" width="45" height="15"></td>
    </tr>
    <tr> 
      <td valign="top">Descri&ccedil;&atilde;o</td>
      <td><textarea name="descricao" cols="100" rows="6" class="borda_fina" id="descricao"></textarea></td>
    </tr>
    <tr> 
      <td valign="top">Chamado</td>
      <td><input name="id_chamado" type="text" class="borda_fina" id="id_chamado" size="12" maxlength="12"></td>
    </tr>
    <tr> 
      <td valign="top">Status</td>
      <td><input name="particular" type="checkbox" id="particular" value="1">
        Confidencial</td>
    </tr>
    <tr> 
      <td valign="top"><a href="#ok">Participantes</a></td>
      <td><span id="nomes">...</span></td>
    </tr>
    <tr> 
      <td valign="top">&nbsp;</td>
      <td><input name="Submit" type="submit" class="borda_fina" value="Criar"> <input name="id_usuario" type="hidden" id="id_usuario" value="<?=$ok?>"></td>
    </tr>
  </table>
  <br>
  <table width="95%" border="0" cellspacing="0" cellpadding="0" id="abas" align="Default">
    <tr> 
      <?
	$sql = "select distinct upper(left(nome, 1)) as nome from usuario where ativo order by nome;";
	$result = mysql_query($sql);
    while ($linha=mysql_fetch_object($result)) {    
	  $l = $linha->nome;	  
	  $qtde++;
      echo "<td></td><td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"javascript:aba($qtde)\">$l</a></font></td><td></td>";	  
	}
?>
    </tr>
  </table>
  <?
	$sql = "select distinct left(nome, 1) as nome from usuario where ativo  order by nome;";
	$result = mysql_query($sql);
    while ($linha=mysql_fetch_object($result)) {    
	  $l = $linha->nome;	  
	  $qtde++;
	
   ?>
  <span id="nomes<?=strtoupper($l)?>" style="Display: none"> 
  <table width="95%" border="0" cellpadding="1" cellspacing="1" bgcolor="225398">
    <tr> 
      <td bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
          <?	  
	  $sql2 = "select id_usuario, nome, email from usuario where ativo and upper(left(nome,1))='$l'";
  	  $result2 = mysql_query($sql2);
      while ($linha2=mysql_fetch_object($result2)) { 
	    $s = "";
	    if ($ok == $linha2->id_usuario) {
		  $s="checked";
		}
   ?>
          <tr> 
            <td width="1%"  bgcolor="#FFFFFF"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <input id="<?=$linha2->nome?>" type="checkbox" name="usuario_id[]" value="<?=$linha2->id_usuario?>" onClick="atualiza()" <?=$s?>  >
              </font></td>
            <td width="99%" bgcolor="#FFFFFF"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <?=$linha2->nome?>
              ( 
              <?=$linha2->email?>
              )</font></td>
          </tr>
          <?	  
	  }
  ?>
        </table></td>
    </tr>
  </table>
  </span> 
  <?
  	}
?>
<script>

function ativaAba( tab, x ) {

  var tabela = tab;
  var posE, posD, porC, ancora, final
  final = Math.ceil((( 1 + tabela.rows[0].cells.length ) / 3 ));
     
  for ( var i = 1; i < final ; i++ ) {
  
    posE = (i-1) * 3;
	posD = posE + 2;
	posC = posE + 1;		
			
	tabela.rows[0].cells[posD].style.width = "10";
	tabela.rows[0].cells[posE].style.width = "12";		
	
	var ok = false;
	for (var j=0; j<tabela.rows[0].cells[posC].all.length; j++) {
     if (tabela.rows[0].cells[posC].all(j).tagName == 'A') {
	   ancora = tabela.rows[0].cells[posC].all(j)     ;
	   ancora.style.fontSize=12;
	   ok = true;
	 }
    }
	
	
	if ( x == i ) {  // Ativo		
    	if (ok) {
         ancora.style.color = "#CCCCCC";	
		 ancora.style.textDecoration = 'none';		
		}
		if (i!=1) { 
    		tabela.rows[0].cells[posE].innerHTML = "<img src=\"figuras/ativo_esq1.gif\">";
		} else {
       		tabela.rows[0].cells[posE].innerHTML = "<img src=\"figuras/ativo_esq.gif\">";
		}		
		
		if (i==(final-1)) {		
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/ativo_dir1.gif\">";
		} else {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/ativo_dir.gif\">";
		}

	    	
    	tabela.rows[0].cells[posE].style.backgroundColor = '#225398';
        tabela.rows[0].cells[posC].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posE].style.backgroundColor;		
    } else { // Inativo	
	  if (ok) {
        ancora.style.color = "#0000FF";	
		ancora.style.textDecoration = 'none';
	  }
	    if ( i==1) {
          tabela.rows[0].cells[posE].innerHTML = '<img src=\"figuras/ativo_esq.gif\">';
		} else {
		  tabela.rows[0].cells[posE].innerHTML = '<img src=\"figuras/inativo_esq.gif\">';
		}
		
		if (i==(final-1)) {
		  tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/inativo_dir1.gif\">";   		
		} else {
          tabela.rows[0].cells[posD].innerHTML = "<img src=\"figuras/inativo_dir.gif\">";		
		}

		tabela.rows[0].cells[posC].style.backgroundColor = "#e1e1e1"
        tabela.rows[0].cells[posE].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;		
		tabela.rows[0].cells[posD].style.backgroundColor = tabela.rows[0].cells[posC].style.backgroundColor;				
	}		
  }  
}  

function ativa(value) {
  var a;
  for (a=1; a<tabs.length; a++) {
    if (a==value) {
      tabs[a].style.display='';
    } else {
      tabs[a].style.display='none';
    }
  }
}

function aba(x) {
   ativa(x);
   ativaAba( abas, x);
 }

  
 function envia() {
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

  var tabs = new Array;  
  <?
    $qtde=0;
	$sql = "select distinct upper(left(nome, 1)) as nome from usuario where ativo order by nome;";
	$result = mysql_query($sql);
    while ($linha=mysql_fetch_object($result)) {    
	  $l = $linha->nome;	  
	  $qtde++;
	  echo "tabs[".$qtde."] = nomes".strtoupper($l).";\n";
	}
  ?>
aba(1);

function alterna(obj, nome) {
  
}
/*
 * Alterado por Fernando Nomellini 15.03.2003
 * function mudaTodos
 */
atualiza();

function listasalas(ADia, AMes, AAno) {
 ADia = '<?=$dia?>';
 AMes = '<?=$mes?>';
 AAno = '<?=$ano?>';
 Ahi = document.form1.hora.value;
 Ahf = document.form1.horafim.value;
  window.open('listasalasdisponiveis.php?dia='+ADia+'&mes='+AMes+'&ano='+AAno+'&hi='+Ahi+'&hf='+Ahf, "Seleção", "scrollbars=yes, height=488, width=600");
}

</script>

</form>

</body>

</html>
