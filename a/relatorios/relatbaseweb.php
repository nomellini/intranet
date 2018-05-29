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
	

    if (!isset($limite)) {
	  $limite = 50;
	}
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	


    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*31*24 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if (!$ordem) {
	  $ordem = "data";
	  $desc  = "DESC ";
	}
	if ($ordem=="data" ) {
	  $o = "$ordem $desc, hora $desc ";
	} else {
	 	$o = "$ordem $desc";
    }
	
    $consultores = pegaConsultores($atendimento);		

	$chamados = statBaseWeb( $o, 
		  $consultor, 
		  $datai,
		  $dataf,
		  $limite,
		  $palavra,
		  $sistema,
		  $diagnostico,
		  $base_cliente, 
		  $jaDocumentados,
		  $verInativos,
		  $programa,
		  $descricao
	);	
	$total = count($chamados);
	
	
	$area = pegaArea($ok);

    $podeVer = false;	
	//$podeVer = true;	
	
	$podeEditar = false;
	$podeAlterarDocumentado = false;
	
	if ($area==TREINAMENTO) {
      $podeAlterarDocumentado = true;	
	  $podeVer = true;
	}
	
	
/*
----- Original Message ----- 
From: Elis 
To: Fernando Nomellini 
Sent: Tuesday, January 22, 2008 9:47 AM
Subject: Re: Base de conhecimento


Eu acho que depois de inserido o registro no base de conhecimento, só eu(8), vc(12), Ricardo (7) e Edson(1) poderíamos Editar/Excluir registros

	Troquei :
	if (  ($area == COBOL) || ( $area == DELPHI ) || ($area == QUALIDADE) ) {
	Por: 
	if (  ($ok == 12) || ($ok==1) || ($ok==8) || ($ok==7) ) {	
*/
	
	if (  ($ok == 14) || ($ok == 12) || ($ok==1) || ($ok==8) || ($ok==7) ) {
	  $podeVer = true;
	  $podeEditar = true;
	}
	
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<link rel="stylesheet" href="/a/stilos.css" type="text/css">
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
<form name="form" method="post" action="relatbaseweb.php">
  <div align="center"> Base de conhecimento : 
    <?=$total?>
    registros <br>
    <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> </font><br>
  </div>
  <table width="98%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
    <tr bgcolor="#666666" align="left"> 
      <td colspan="4"><font color="#FFFFFF"><b>Utilize as op&ccedil;&otilde;es 
        abaixo para alterar o relat&oacute;rio</b></font></td>
    </tr>
    <tr bgcolor="#FCE9BC" align="left"> 
      <td colspan="4">Data Inicial 
        <input type="text" name="datai" class="bordaTexto" 
  size="12" maxlength="10" value="<?=$datai?>" onKeyPress="fdata(this)">
        Data Final 
        <input type="text" name="dataf" class="bordaTexto" size="12" maxlength="10" value="<?=$dataf?>">
        [<a href="javascript:document.form.datai.value='<?=$hoje?>';document.form.dataf.value='<?=$hoje?>';document.form.submit();">hoje</a> 
        ] </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td width="8%">Sistema</td>
      <td width="27%"> 
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
      </td>
      <td width="14%">Diagnostico</td>
      <td width="51%"> 
        <select name="diagnostico" class="bordaTexto">
          <option value="0">Todos</option>
          <?  

  $arrcat = listaDiagnosticos();
  while( list($tmp1, $tmp) = each($arrcat) ) {
    $s = "";
    if ( $diagnostico==$tmp["id_diagnostico"] ) {
	  $s = "SELECTED";
	}
    echo "<option value=". $tmp["id_diagnostico"] . " $s >" . $tmp["diagnostico"] . "</option>";
  }
?>
        </select>
      </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td>Consultor</td>
      <td> 
        <select name="consultor" class="BordaTexto">
          <option value="0">Todos</option>
          <?  
    while( list($tmp1, $tmp) = each($consultores) ) {
      $s = "";
      if ( $consultor==$tmp["id_usuario"] ) {
	    $s = "SELECTED";
      }
      echo "<option value=". $tmp["id_usuario"] . " $s >" . $tmp["nome"] . "</option>";
    }
?>
        </select>
      </td>
      <td>Programa / Evento eSocial
      <label for="textfield">:</label></td>
      <td><input type="text" name="programa" id="programa" value="<?=$programa?>"></td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="2">Limitar resultado em 
        <input type="text" name="limite" maxlength="4" size="4" value="<?=$limite?>" class="bordaTexto">
        registros [<a href="javascript:document.form.limite.value='0';document.form.submit();">mostrar 
        todos</a>] </td>
        <td>Descri&ccedil;&atilde;o / C&oacute;digo Resposta:
        </td>
        <td><input type="text" name="descricao" id="descricao" value="<?=$descricao?>">
        </td>
    </tr>
    <tr bgcolor="#FCE9BC"> 
      <td colspan="4"> 
        <input type="checkbox" name="desc" value="DESC" <? if($desc) {echo "checked";}?>>
        Ordem decrescente ? 
        <input type="hidden" name="ordem" value="<?=$ordem?>">
        Buscar palavra 
        <input type="text" name="palavra" class="bordaTexto" value="<?=$palavra?>">
        <input type="submit" name="Submit" value="Submit" class="unnamed1">
      </td>
    </tr>
    <tr bgcolor="#FFDCB8"> 
      <td colspan="4"> 
        <input type="checkbox" name="base_cliente" value="checkbox" <? if($base_cliente) {echo "checked";}?> >
        Selecione aqui se deseja ver APENAS os marcados com DOCUMENTA&Ccedil;&Atilde;O 
        INTERNET</td>
    </tr>
    <tr bgcolor="#FFDCB8">
      <td colspan="4"><input name="jaDocumentados" type="checkbox" id="jaDocumentados" value="1" <? if($jaDocumentados) {echo "checked";}?>>
      Selecione aqui para ver apenas os NAO DOCUMENTADOS AINDA </td>
    </tr>
    <tr bgcolor="#FFDCB8">
      <td colspan="4"><input name="verInativos" type="checkbox" id="verInativos" value="1" <? if($verInativos) {echo "checked";}?>>
Selecione aqui para incluir chamados j&aacute; registrados</td>
    </tr>
  </table>
</form>
<form action="matabase.php" method="post" name="matabase" id="matabase">
  <input name="id_base" type="hidden" id="id_base">
</form>
<a name="inicio"></a> 
<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#000000">
  <tr bgcolor="#CCCCCC"> 
    <td width="9%" align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="javascript:document.form.ordem.value='id_chamado'; document.form.submit();">-</a></font></td>
    <td width="17%" align="center"> <font size="1"><a href="javascript:document.form.ordem.value='data'; document.form.submit();">Data</a> 
      / <a href="javascript:document.form.ordem.value='sistema'; document.form.submit();">Sistema</a> 
      / <a href="javascript:document.form.ordem.value='programa'; document.form.submit();">Prog</a></font></td>
    <td width="11%">&nbsp;</td>
    <td width="63%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
      <a href="javascript:document.form.ordem.value='descricao'; document.form.submit();">Descri&ccedil;&atilde;o</a> 
      / <a href="javascript:document.form.ordem.value='resumo'; document.form.submit();">Resumo</a></font></td>
  </tr>
  <?  
  
	function search_exif($array, $nome)
	{
		foreach ($array as $data)
		{
			if ($data['nome'] == $nome)
				return $data['nome'];
		}
	}  
  
  $sistemas = array();
 
  while( list($tmp1, $tmp) = each($chamados) ) {
	  
  
 
    $id = $tmp["chamado_id"];
	$data = $tmp["data"] . " - " . $tmp["hora"];
	$descricao = $tmp["descricao"];
	$resumo = $tmp["resumo"];	
	$somenteDesenvolvimento = $tmp["somenteDesenvolvimento"];
	
	$sistema = $tmp["sistema"];	
	
	if (!search_exif($sistemas, $sistema)) {
		$sistemas[$sistema]["nome"] = $sistema;
		$sistemas[$sistema]["qtde"] = 1;
 	} else 
	{
		$sistemas[$sistema]["qtde"] = $sistemas[$sistema]["qtde"] + 1;
	}

	
	if ($palavra) {
      $descricao = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $descricao);
      $resumo = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $resumo);	  
     }

	$msgDocumentado = '';

    if ($tmp["cliente"]) {
	  $cor="#FFDCB8";
	  
		if ($podeAlterarDocumentado) {
		  $msgDocumentado = "<br><br>";
		  $jaDocumentado = $tmp["jaDocumentado"];
		  if ($jaDocumentado) {
			$msgDocumentado .= "Item <strong>JÁ</strong> documentado ";
		  } else {
			$msgDocumentado .= "Item <strong>AINDA NÃO</strong> documentado ";
		  }
		  $msgDocumentado  .= " (clique para alternar) <br><br>";
		  
		  $msgDocumentado = "<a href=\"alternabasewebdocumentacao.php?id=" . $tmp["id"] .  "\">$msgDocumentado</a>";
		}
	  
	  
	} else {
	  $cor = "#FCE9BC";
	}
	
	if (!$tmp["ativo"])	
		$cor = "#cccccc";
	
	$msg = "$resumo";
	$msg = eregi_replace("\r\n", "<br>", $msg);
	$msg = eregi_replace("\"", "`", $msg);	
		

	if (  ($ok == 63) || ($ok==187)) { // Débora ou Janaina Queiroga
		$somenteDesenvolvimento = true;
		$podeVer = true;
		//$podeEditar = true;		
		$podeAlterarDocumentado = true;		
	}


	$podeVer = true;

	if ( $podeVer || !$somenteDesenvolvimento) {
	   $msgAutorizado = "";
	   if ($somenteDesenvolvimento) {
         $msgAutorizado = "<strong>Este item é visível somente ao pessoal autorizado</strong><br>";    }

?>
  <tr bgcolor="#FFFFFF"> 
    <td colspan="4" align="left" height="19"> 
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#FFFFFF">
        <tr bgcolor="<?=$cor?>"> 
          <td height="17" width="9%"><font face="Verdana, Arial, Helvetica, sans-serif"> 
		    <? if ($podeEditar) { ?>
			  <a href="alterabaseweb.php?id=<?=$tmp["id"]?>">[Editar]</a><br>
  			  <a href="javascript:deleta('<?=$tmp["id"]?>', '<?=$tmp["id_chamado"]?>')">[Excluir]</a>
			<? }
			  else { 
			    echo "Chamado"; 
		    }?><br> Data </font></td>
          <td height="17" width="17%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="1"><a href="../historicochamado.php?id_chamado=<?=$tmp["id_chamado"]?>"> 
            <?=$tmp["id_chamado"]?> - <?=$tmp["status"]?> 
            <br>
            </a></font> 
            <?=$data?>          </td>
          <td height="17" width="11%"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            Descri&ccedil;&atilde;o</font></td>
          <td height="17" colspan="3" width="63%"  ><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
            <? echo "$msgAutorizado$descricao$msgDocumentado"; ?>
			
			

			
            </font></td>
        </tr>
        <tr bgcolor="<?=$cor?>"> 
          <td width="9%">Sistema<br>
            Programa </td>
          <td width="17%"><font color="#000000"> <b> 
            <?=$sistema?>
            <br>
            </b></font><font color="#FF0000">
            <?=$tmp["programa"]?>
            </font> </td>
          <td width="11%">Resumo</td>
          <td colspan="3" width="63%"><font color="#000000"> 
            <?=$msg?>
            </font></td>
        </tr>
        <tr bgcolor="<?=$cor?>"> 
          <td width="9%">Relator</td>
          <td width="17%"><b><font color="#000000"> 
            <?=$tmp["usuario"]?>
            </font></b></td>
          <td width="11%">Diagn&oacute;stico</td>
          <td colspan="3" width="63%"><font color="#000000"> 
            <?=$tmp["diagnostico"]?>
            </font></td>
        </tr>
        <tr bgcolor="<?=$cor?>">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>Documenta&ccedil;&atilde;o</td>
          <td colspan="3"><?=$tmp["documentacao"]?></td>
        </tr>
        
      </table>
    </td>
  </tr>
  <?
   }
  }
?>
</table>

<br>
<hr/>
Sistemas   </br>
<?
	$soma = 0;
	foreach($sistemas as $sistema)	
	{
		echo "<li>" . $sistema["nome"] . " - " .  $sistema["qtde"]  . "</li>";
		$soma +=   $sistema["qtde"] ;
	}
	echo $soma;
?>
   
</ul>


<script>
  function deleta(Aid, AChamado) {
    if (window.confirm('Deseja excluir base do chamado ' + AChamado + ' ?')) {
      document.matabase.id_base.value = Aid;
	  document.matabase.submit();
	}
  }
</script>
</body>
</html>
