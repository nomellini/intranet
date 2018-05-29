<?
	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	
    $pode = 1;// pegaGerencial($ok);   
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {
	
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	

    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*5 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}

	if (!$ordem) {
	  $ordem = "media desc";
	  
	}
	$o = "$ordem";

	if (isset($id_u)) {
		$ch = statContatosPorConsultor2($id_u, $origem, $datai, $dataf, $o);
		$total = count($ch);	
		$somaChamados = 0;
		$somaTempos = 0;
		while( list($tmp1, $tmp) = each($ch) ) {
			$somaChamados += $tmp["contatos"];
			$somaTempos += $tmp["tempo"];
		}
		reset($ch);		
	} 

	

	
?> 
<html>
<link rel="stylesheet" href="../stilos.css" type="text/css">
<script src="coolbuttons.js"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">
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
<script language="JavaScript">

function limpa() {
  document.form.id_cliente.value='';
}

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
  }

</script>
</font></font> 
<form name="form" method="post" action="contatosporconsultor.php">
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font> 
  <table width="90%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC" align="center">
    <tr bgcolor="#FFFFFF"> 
      <td colspan="4"> <p> 
          data incial 
                <input type="text" name="datai" size="15" maxlength="12" class="unnamed1" value="<?=$datai?>">
          data final 
          <input type="text" name="dataf" size="15" maxlength="12" value="<?=$dataf?>" class="unnamed1">
          [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a>] 
          <br>
          origem do contato 
          <select name="origem" class="unnamed1">
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
          <input type="submit" name="Submit2" value="Submit" class="unnamed1">
          <input name="ordem" type="hidden" id="ordem">
        </p>
      </td>
    </tr>
  </table>
  <br>

<blockquote> 
  <p><a name="inicio"></a></p>
</blockquote>
<a href="http://10.98.0.5/a/relatorios/contatosporconsultorimpressao.php?origem=<?=$origem?>&datai=<?=$datai?>&dataf=<?=$dataf?>&consultor=<?=$consultor?>">Impress&atilde;o</a> 
  <table width="90%" height="8" border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
    <tr bgcolor="#CCCCCC"> 
      <td align="center"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='nome'; document.form.submit();">Nome</a></font></td>
      <td align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='contatos desc'; document.form.submit();">Contatos</a></font></td>
      <td align="center"><a href="javascript:document.form.ordem.value='tempo desc'; document.form.submit();">Tempo</a></td>
      <td align="center">Dias Trabalhados</td>
      <td align="center"><a href="javascript:document.form.ordem.value='media desc'; document.form.submit();">M&eacute;dia </a><br>
      (horas por dia)</td>
      <td align="center">Porcentagem</td>
    </tr>
    <?  
if (isset($id_u)) {	
	$somaTempo = 0;
	while( list($tmp1, $tmp) = each($ch) ) {
	$ano = $tmp["nome"];
	$chamados = $tmp["contatos"];
	$dias = $tmp["dias"];		
	$tempo = $tmp["tempo"];
	
	$media = sec_to_time($tempo / $dias);
	
	$somaTempo += $tempo;
	
	if($somaTempos) {
		$ct = $tempo/$somaTempos*100;
	} else {
		$ct = 0;
	}
	$ct = sprintf ("%02.2f", $ct) . " %";
	
?>
    <tr bgcolor="#FCE9BC"> 
      <td height="16"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
        <?=$ano?>
        </font></td>
      <td height="16" valign="middle" align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
        <?=$chamados?>
        </font></td>
      <td align="center"><?=sec_to_time($tempo)?></td>
      <td align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=$dias?>
      </font></td>
      <td align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
        <?=$media?>
      </font></td>
      <td height="16" align="center"> 
        <?=$ct?>
      </td>
    </tr>
    <?
  }
?>
    <tr bgcolor="#FFFFFF"> 
      <td height="16" align="left">&nbsp;</td>
      <td height="16" align="left"> <div align="center"> 
          <?=$somaChamados?>
        </div></td>
      <td align="center"><?=sec_to_time($somaTempo)?></td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td height="16" align="left">&nbsp;</td>
    </tr>
  </table>
<?
		}
	}
?>


<br>
<br>

<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('id_u[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

<input type="checkbox" onClick="toggle(this)" />Ligar / Desligar todos<br/>

<table width="70%" border="0" cellspacing="1">
<?
	$sql = 	"select id_usuario, nome, area from usuario where (area = 2 or area = 3 or area =1 || (area = 11) ) and ativo = 1 and atendimento = 1 order by area desc, nome";
	$result = mysql_query($sql);
	
	while ($linha = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$temDado = true;
?>

	<tr>
<?
		for($i = 1; $i<=4; $i++) {
			$nome = "&nbsp;";
			$id = 0;
			$ch  = "";
			if ($i > 1)			
				$temDado = $linha = mysql_fetch_array($result, MYSQL_ASSOC);
			 
			if ($temDado) {
				$area = $linha["area"];
				$nome = $linha["nome"] ;
				
				$nome = "$nome";
				
				if ($area == 2)
				{
					$nome = "<font color=\"#0033FF\">$nome</font>";
				}
				if ($area == 3)
				{
					$nome = "<font color=\"#FF0000\">$nome</font>";
				}
				if ($area == 11)
				{
					$nome = "<font color=#333300>$nome</font>";
				}
								
				$id = $linha["id_usuario"];

				$checked =  "";
				if (isset($_POST["id_u"]))
					foreach($_POST["id_u"] as $key => $value) {
						if ($value == $id) 
						{
							$checked =  "checked=\"checked\"";
							//$nome = "<b>$nome</b>";
						}
					}


				$ch = "<input name=\"id_u[]\" type=\"checkbox\" value='$id' $checked  >";				
			}
			
			echo "<td>$ch $nome </td>";
		}
?>
   </tr>
	
<?
	
	}
?>
</table>	

</form>

<SCRIPT>  
function alterna(item, sp, i1, i2){
 if (item.style.display=='none'){
   item.style.display='';
   sp.innerHTML  = i2;
 } else {
   item.style.display='none'
   sp.innerHTML  = i1;
 }
}  
  </SCRIPT>
