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
	if(!$pode) {
	  require("../sinto.htm");
	  exit;
	} else {
	

    if (!isset($limite)) {
	  $limite = 50;
	}
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	


    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*93 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if (!$ordem) {
	  $ordem = "id_chamado ";
	  $desc  = "DESC";
	}
	$o = "$ordem $desc";

    $consultores = pegaConsultores($atendimento);		
    $diagnosticos = pegaDiagnosticos();

	$chamados = statEncaminhamentos2( $o, 
	  $reaberto,
	  $id_usuario1, 
	  $id_usuario2, 
	  $acao, 
	  $datai,
	  $dataf,
	  $sistema,
	  $diagnostico,
	  $limite);	
	$total = count($chamados);

    $somaContatos = 0; $somaTempo = 0;
    while( list($tmp1, $tmp) = each($chamados) ) {
	  $somaContatos += $tmp["contatos"];
	  $somaTempo += $tmp["temposeg"];
	}
	reset($chamados);
	$tempoTotal = segToHora($somaTempo);
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link rel="stylesheet" href="/stilos.css" type="text/css">
</head> <body bgcolor="#FFFFFF" text="#000000"> 
<DIV ID="overDiv" STYLE="position:absolute; visibility:hide; z-index: 1;"></DIV>
<SCRIPT LANGUAGE="JavaScript" SRC="..\overlib.js"></SCRIPT>
<SCRIPT LANGUAGE="Javascript"><!--
function mOvr(src,clrOver) {if (!src.contains(event.fromElement)) {src.style.cursor = 'hand';
src.bgColor = clrOver;
}
}
function mOut(src,clrIn) {if (!src.contains(event.toElement)) {src.style.cursor = 'default';
src.bgColor = clrIn;
}
}
// --> 
</script>
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
<?echo "Olá, $nomeusuario, hoje é ";?>
</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
<script language="JavaScript">

function mOvr(src,clrOver) {if (!src.contains(event.fromElement)) {src.style.cursor = 'hand';
src.bgColor = clrOver;
}
}
function mOut(src,clrIn) {if (!src.contains(event.toElement)) {src.style.cursor = 'default';
src.bgColor = clrIn;
}
}

function limpa() {
  document.form.id_cliente.value='';
}

  function seleciona() {
    window.name = "pai";
    value = document.form.id_cliente.value;
    window.open('../selecionacliente.php?id_cliente='+value, "Seleção", "scrollbars=yes, height=488, width=600");
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
<form name="form" method="post" action="encaminhamentos2.php">
  Listagem de chamados - 
  <?=$total?>
  <br>
  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><br>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#666666" align="left"> 
      <td colspan="4"><font color="#FFFFFF"><b>Utilize as op&ccedil;&otilde;es 
        abaixo para alterar o relat&oacute;rio</b></font></td>
    </tr>
    <tr bgcolor="#FCE9BC" align="left"> 
      <td colspan="4">Quero ver todos os chamados que <a href="javascript:alterna(rem, txtrem, '[Remetentes]', '[Ok]');"><span id=txtrem>[Remetentes]</span> 
        </a> <span id="rem" style="display: none"> 
        <?
  echo lista(sqlUsuarios(), "id_usuario1[]", 15);
?>
        </span> enviou para <a href="javascript:alterna(des, txtdes, '[Destinatários]', '[Ok]');"><span id=txtdes>[Destinatários]</span> 
        </a> <span id="des" style="display: none"> 
        <?
  echo lista(sqlUsuarios(), "id_usuario2[]", 15);
?>
        </span> <br>
        entre os dias 
        <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)">
        e 
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> 
        ] , <br>
        sobre o sistema 
        <select name="sistema" class="bordaTexto">
          <option value="0">Todos</option>
          <?  

  $arrcat = listaSistemas($atendimento);
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $sistema==$tmp["id_sistema"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_sistema"] . " $s >" . $tmp["sistema"] . "</option>";
  }
?>
        </select>
        , <br>
        cujo diagn&oacute;stico foi <a href="javascript:alterna(diag, txtdiag, '[Diagnostico]', '[Ok]');"><span id=txtdiag>[Diagnostico]</span> 
        </a> <span id=diag style="display: none"> <?
  echo lista(sqlDiagnosticos(), "diagnostico[]", 9);
?> </span> <br>
        Observa&ccedil;&atilde;o 
        <input type="checkbox" name="reaberto" value="1" <? if($reaberto) {echo "checked";}?>>
        Somente os que tiveram um contato REABERTO.</td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="4">Limitar resultado em 
        <input type="text" name="limite" maxlength="4" size="4" value="<?=$limite?>" class="bordaTexto">
        registros [<a href="javascript:document.form.limite.value='0';document.form.submit();">mostrar 
        todos</a>] </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="4"> 
        <input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
        Ordem decrescente ? 
        <input type="hidden" name="ordem" value="<?=$ordem?>">
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
  </table>
</form>
<a name="inicio"></a> 
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
  <tr bgcolor="#CCCCCC"> 
    <td width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_chamado'; document.form.submit();">Chamado</a></font></td>
    <td width="15%" align="center"> <a href="javascript:document.form.ordem.value='dataa'; document.form.submit();">Data</a></td>
    <td width="13%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="javascript:document.form.ordem.value='cliente'; document.form.submit();">Cliente</a></font></td>
    <td width="63%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      </font></td>
  </tr>
  <?  
  while( list($tmp1, $tmp) = each($chamados) ) {

	$descricao = $tmp["historico"];
	

?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="4" align="left" height="19"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="#FCE9BC"> 
          <td height="17" width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"> 
            <A HREF="javascript:location.href = '/a/historicochamado.php?id_chamado=<?=$tmp["chamado_id"]?>';" > 
            <?=$tmp["chamado_id"]?>
            </a></font></td>
          <td height="17" width="15%" align="center"> 
            <?=$tmp["dataa"]?>
          </td>
          <td height="17" width="13%" bgcolor="#FCE9BC">Hist&oacute;rico</td>
          <td height="17" colspan="3" bgcolor="#FCE9BC" onMouseOver="mOvr(this,'#FFCC33');" onMouseOut="mOut(this,'#FCE9BC');"><b><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            
            <?=$descricao?>
            </font></b></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td width="9%">Sistema</td>
          <td width="15%" bgcolor="#FCE9BC"><b><font color="#000000"> 
            <?=$tmp["sistema"]?>
            </font></b></td>
          <td width="13%">DIAGN&Oacute;STICO</td>
          <td colspan="3" bgcolor="#FCE9BC"><b><font color="#000000"> 
            <?=$tmp["diagnostico"]?>
            </font></b></td>
        </tr>
        <tr bgcolor="#FCE9BC"> 
          <td width="9%">Status</td>
          <td width="15%"><b> 
            <?=$tmp["status"]?>
            </b></td>
          <td width="13%">Fluxo</td>
          <td colspan="3" bgcolor="#FCE9BC"> 
            <?echo "<b><font color=#ff0000>". $tmp["remetente"] . "</font></b> encaminhou para <b><font color=#ff0000>". $tmp["destinatario"] . "</font></b>";
			 
			?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?
  }
?>
</table>


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

</body>
</html>
<?
}
?>