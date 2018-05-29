 
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
       $datai = date("d/m/Y", time()-( 86400*365 ) );  // 86400 = numero de segundos em um dia, 90 = 3 meses atras
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
	  $limite,
	  $palavra,
	  $sistema,
	  $diagnostico);	

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
	  $sistema);	
	
?>
<title>base</title>
<div align="center">
  <p><font size="2" color="#0000FF"><b>Base de conhecimento</b></font></p>
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
		  		  
	//	  $descricao = substr($descricao, 0, 40);
		  $aux = "<a href=../historicochamado.php?id_chamado=" . $tmp["id_chamado"] . "&palavra=". rawurlencode($palavra) .">" . $descricao .  "</a> ";		  $aux = "<a href=../historicochamado.php?id_chamado=" . $tmp["id_chamado"] . "&palavra=". rawurlencode($palavra) .">" . $descricao .  "</a> "		  
		  
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
      <td width="11%" class="tabelaFundo">&nbsp;</td>
      <td width="14%" class="tabelaFundo">Resumo</td>
      <td width="75%" class="tabelaFundo">
        <?=$resumo?>
      </td>
    </tr>
    <?    
		}  
	?>
  </table>
  <p align="center"><b><font color="#0000FF">S.A.D.</font></b> <br>
    <font size="1"> (&uacute;ltimos 20 chamados)</font></p>
</div>
<table width="100%" border="0" cellspacing="1" cellpadding="1" class="tabelaBorda">
  <tr> 
    <td width="11%" class="tabelaTitulo">Chamado</td>
    <td width="14%" class="tabelaTitulo">Sistema</td>
    <td width="75%" class="tabelaTitulo">Descri&ccedil;&atilde;o</td>
  </tr>
  <?
		while (list($tmp1, $tmp) = each($chamados)) {
		  $descricao = $tmp["descricao"];
		  $descricao = eregi_replace("\r\n", "<br>",$descricao);
		  $descricao = eregi_replace("\"", "`", $descricao);	
	//	  $descricao = substr($descricao, 0, 40);
		  $aux = "<a href=../historicochamado.php?id_chamado=" . $tmp["chamado_id"] . "&palavra=". rawurlencode($palavra) .">" . $descricao .  "</a> ";
		  
	?>
  <tr> 
    <td width="11%" class="tabelaFundo"> 
      <?=$tmp["chamado_id"]?>
    </td>
    <td width="14%" class="tabelaFundo"> 
      <?=$tmp["sistema"]?>
    </td>
    <td width="75%" class="tabelaFundo"> 
      <?=$aux?>
    </td>
  </tr>
  <?    
		}  
	?>
</table>

<form name="form1" method="post" action="<?=$SCRIPT_NAME?>">
  Nova busca 
  <input type="text" name="palavra" class="unnamed3">
  <input type="submit" name="Submit" value="Enviar" class="unnamed3">
</form>


<p align="center">[<a href="javascript:window.close();">FECHAR</a>]</p>
