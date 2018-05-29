 
<link rel="stylesheet" href="/a/stilos.css" type="text/css">
<?
    require("../scripts/conn.php");	
    require("../scripts/stats.php");	
	require("../scripts/classes.php");	
	
		
   if (!isset($limite)) {
	  $limite = 20;
	}
	
    list($tmp1, $tmp) = each(pegaUsuario($id_usuario));  
    $atendimento = $tmp["atendimento"];	

    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*365 ) );  // 86400 = numero de segundos em um dia, 365 = 1 ano atrás
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

	
	if(!$palavra) { $palavra="ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ";}

	$baseweb = statBaseWeb( "data DESC", 
	  $consultor, 
	  $datai,
	  $dataf,
	  $limite * 3,                    // Limite
	  $palavra,
	  $sistema,
	  $diagnostico, '', 0);	

	$chamados = statChamados( $o, 
	  $consultor, 
	  $atendimento, 
	  $status, 
	  $categoria, 
	  $tipo, 
	  $datai,
	  $dataf,
	  $motivo,
	  $id_cliente,
	  $limite,
	  $enc,
	  $palavra,
	  $sistema, 0, 0, 0, 0 , 0);	
	
?>
<title>base</title>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
<div align="center"> 
  <p><b><font color="#0000FF">S.A.D.</font></b> <br>
  
  
  <div id="lista">
  
    <font size="1"> (&uacute;ltimos 
    <select name="qtde" class="borda_fina"  onchange="vai()" >
      <option value="10" <?php if (!(strcmp(10, $limite))) {echo "selected=\"selected\"";} ?>>10</option>
      <option value="20" <?php if (!(strcmp(20, $limite))) {echo "selected=\"selected\"";} ?>>20</option>
      <option value="30" <?php if (!(strcmp(30, $limite))) {echo "selected=\"selected\"";} ?>>30</option>
      <option value="40" <?php if (!(strcmp(40, $limite))) {echo "selected=\"selected\"";} ?>>40</option>
      <option value="50" <?php if (!(strcmp(50, $limite))) {echo "selected=\"selected\"";} ?>>50</option>
      <option value="0" <?php if (!(strcmp(0, $limite))) {echo "selected=\"selected\"";} ?>>Todos</option>
    </select> 
    chamados)</font>
	</div>
	</p>
</div>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="tabelaBorda">
  <tr>
    <td width="8%" class="tabelaTitulo" valign="middle" align="center">Chamado</td>
    <td width="9%" class="tabelaTitulo" valign="middle" align="center"> data</td>
    <td width="16%" class="tabelaTitulo">Cliente</td>
    <td width="16%" class="tabelaTitulo">Sistema</td>
    <td width="67%" class="tabelaTitulo">Descri&ccedil;&atilde;o</td>
  </tr>
  <?
		while (list($tmp1, $tmp) = each($chamados)) {
		  $descricao = $tmp["descricao"];
		  $descricao = eregi_replace("\r\n", "<br>",$descricao);
		  $descricao = eregi_replace("\"", "`", $descricao);	
          $descricao = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $descricao);		  
	//	  $descricao = substr($descricao, 0, 40);
    		  $aux = "<a href=../historicochamado.php?id_chamado=" . $tmp["chamado_id"] . "&palavra=". rawurlencode($palavra) .">" . $descricao .  "</a> ";
		  
	?>
  <tr>
    <td width="8%" class="tabelaFundo" valign="middle" align="center"> 
      <?=$tmp["chamado_id"]?>
    </td>
    <td width="9%" class="tabelaFundo" valign="middle" align="center"> 
      <?=$tmp["dataa"]?>
    </td>
    <td width="16%" class="tabelaFundo">      <?=$tmp["cliente"]?></td>
    <td width="16%" class="tabelaFundo"> 
      <?=$tmp["sistema"]?>
    </td>
    <td width="67%" class="tabelaFundo"> 
      <?=$aux?>
    </td>
  </tr>
  <?    
		}  
	?>
</table>

<p align="center"><font size="2" color="#0000FF"><b>Base de conhecimento<br>
  </b></font><font size="1">(&uacute;ltimas <?=($limite * 3)?> entradas)</font><font size="2" color="#0000FF"><b> 
  </b></font></p>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="tabelaBorda">
  <tr> 
    <td width="11%" class="tabelaTitulo">Chamado</td>
    <td width="14%" class="tabelaTitulo">Sistema</td>
    <td width="75%" class="tabelaTitulo">Descri&ccedil;&atilde;o</td>
  </tr>
  <?
		while (list($tmp1, $tmp) = each($baseweb)) {
		  $descricao = $tmp["descricao"];
		  $descricao = eregi_replace("\r\n", "<br>",$descricao);
		  $descricao = eregi_replace("\"", "`", $descricao);	
		  $resumo = $tmp["resumo"];
		  $resumo = eregi_replace("\r\n", "<br>",$resumo);
		  $resumo = eregi_replace("\"", "`", $resumo);	
          $descricao = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $descricao);
          $resumo = eregi_replace($palavra, "<b><font size=2 color=#FF0000>$palavra</font></b>", $resumo);	  
		  
		  		  
	//	  $descricao = substr($descricao, 0, 40);
	//	  $aux = "<a href=../historicochamado.php?id_chamado=" . $tmp["id_chamado"] . "&palavra=". rawurlencode($palavra) .">" . $descricao .  "</a> ";		  $aux = "<a href=../historicochamado.php?id_chamado=" . $tmp["id_chamado"] . "&palavra=". rawurlencode($palavra) .">" . $descricao .  "</a> "		  
	      $aux= $descricao;
		  
	?>
  <tr> 
    <td width="11%" class="tabelaFundo"> 
      <?=$tmp["id_chamado"]?>
    </td>
    <td width="14%" class="tabelaFundo"> 
      <?=$tmp["sistema"]?>
    </td>
    <td width="75%" class="tabelaFundo"> 
      <?=$aux?>
    </td>
  </tr>
  <tr> 
    <td width="11%" class="tabelaFundo"> 
      <?=$tmp["data"]?>
    </td>
    <td width="14%" class="tabelaFundo">Resumo</td>
    <td width="75%" class="tabelaFundo"> 
      <?=$resumo?>
    </td>
  </tr>
  <tr> 

    <td width="3%" class="tabelaFundo" height="20">  <?=$tmp["cliente"]?></td>
    <td width="3%" class="tabelaFundo" height="20">Programa </td>
    <td width="5%" class="tabelaFundo" height="20"> 
      <?=$tmp["programa"]?>
    </td>
  </tr>
  <tr> 
    <td colspan=3 width="11%" class="tabelaFundo" height="20"> 
      <hr size="1">
    </td>
  </tr>
  <?    
		}  
	?>
</table>
<p align="center"><b><font color="#0000FF"></font></b></p>
<form name="form1" method="post" action="">
  Nova busca 
  <input type="text" name="palavra" class="unnamed3" value="<?=$palavra?>">
  <input type="submit" name="Submit" value="Enviar" class="unnamed3">
  <input name="limite" type="hidden" id="limite" value="<?=$limite?>" />
</form>

<script language="javascript1.3">
function vai()
{
	var oVDiv=document.getElementById("qtde");
	document.form1.limite.value = oVDiv.value;

	var oDiv=document.getElementById("lista");
	oDiv.innerHTML = "Aguarde...";

	document.form1.submit();
}
</script>
<p align="center">[<a href="javascript:window.close();">FECHAR</a>]</p>
