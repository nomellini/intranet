<?	
	require("../scripts/conn.php");
	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}


   if ($acao=='alterna') {
    header("Location: alternaEstadoEspera.php?id=$id"); 
//    $sql  = "update satligacao set FL_ATIVO = not FL_ATIVO where id = $id";
//	mysql_query($sql);
   }
	

	$hoje = date("Y-m-d");	
	$hora = date("H:i:s");


	
	/* Ligações de hoje	*/
    $sql = "select count(*) as ligTotal from satligacao where FL_ATIVO and data = '$hoje'";	
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligHoje = $linha->ligTotal;
	
	/* Ligações de hoje	em espera*/
    $sql = "select count(*) as ligTotal from satligacao where FL_ATIVO and data = '$hoje' and id_satstatus=1";	
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligEspera = $linha->ligTotal;

	/* Ligações de hoje	transferidas*/
    $sql = "select count(*) as ligTotal from satligacao where FL_ATIVO and data = '$hoje' and id_satstatus=2";	
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligTransf = $linha->ligTotal;

	/* Ligações de não atendidas*/
    $sql = "select count(*) as ligTotal from satligacao where FL_ATIVO and data = '$hoje' and id_satstatus=4";	
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	$ligPerdidas = $linha->ligTotal;


//    mysql_query("DROP TABLE IF EXISTS ultimos10;");
//    mysql_query("create temporary table ultimos10 select time_to_sec(hora_fim)-time_to_sec(hora_inicio) as t from satligacao where id_satstatus = 3 order by id desc limit 5;");
//    $sql = "select sec_to_time(avg((t))) as media,  sec_to_time(min((t))) as minimo, sec_to_time(max((t))) as maximo from ultimos10;";

	$sql = "select  ";
	$sql .= "sec_to_time(  avg(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)      ) ) as media, ";
	$sql .= "count(*) as qtde,  sec_to_time(   max(   time_to_sec(hora_fim) - time_to_sec(hora_inicio)      ) ) as maximo, ";
	$sql .= "sec_to_time(   min(  time_to_sec(hora_fim) - time_to_sec(hora_inicio)  ) ) as minimo ";
    $sql .= "from satligacao where FL_ATIVO and  (id_satstatus = 3 or id_satstatus = 4 ) and ";
	$sql .= "data = '$hoje'";

	$result = mysql_query($sql) or die($sql); 
	$linha = mysql_fetch_object($result);
	$tmedio = $linha->media;
	$tmaximo = $linha->maximo; 
	$tminimo = $linha->minimo;
	$qtdeconsultor = $linha->qtde;
	
?>

<html>
<head>
<title>espera</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../todo/stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="120">
<style type="text/css">
<!--
.style12 {color: #FFFFFF; font-weight: bold; font-size: 14; }
.style17 {font-size: x-small}
.style22 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head> 
<body bgcolor="#FFFFFF" text="#000000">
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79">
<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td valign="top"><div align="center"><font color="#FF0000" size="2"><strong><br>
    </strong></font><font color="#FF0000"><span class="style17"> Liga&ccedil;&otilde;es 
        em espera (
    <?=$ligEspera?>
        )</span></font> 
      </div>
      <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#003366" >
        <tr bgcolor="#003366"> 
          <td width="10%" height="16" align="center"><span class="style22">Aguarda</span></td>
          <td width="4%" align="center"><span class="style22">Linha</span></td>
          <td width="34%" ><span class="style22">Cliente</span></td>
          <td width="10%"><span class="style22">Grau</span></td>
          <td width="11%" align="center"><span class="style22">Tempo</span></td>
          <td width="13%"><span class="style22">Produto</span></td>
          <td width="18%"><span class="style22">Estado</span></td>
        </tr>
        <?
  $sql = "select cliente.grau, motivo_status, FL_ATIVO, qtde_aguarde,  id, cliente.cliente, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as espera, cliente.grau, (time_to_sec(hora_fim) - time_to_sec(hora_inicio)) as esperasec, ";
  $sql .= "sistema.sistema as produto, satligacao.motivo, linha from satligacao, cliente, sistema where ";
  $sql .= "data = '$hoje' and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema and ";
  $sql .= "id_satstatus = 1 order by espera desc";
  $result = mysql_query($sql);
  while ($linha = mysql_fetch_object($result)) {  
    $idligacao = $linha->id;
    $cliente = $linha->cliente;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$linhatel = $linha->linha;
	$motivo = $linha->motivo;
	$ativo = $linha->FL_ATIVO;
	$motivo_status = $linha->motivo_status;
	
	$esperasec = $linha->esperasec;
	
	if ($motivo_status<>'') {
	  $cliente = "$cliente<br>[$motivo_status]";
	}
	if ($ativo) {
	  $link = '<b>ATIVO</b>';
	} else {
	  $link = '<i>INATIVO</i>';		
	  $cliente="<i><b>$cliente</b></i>";
	  $produto="<i>$produto</i>";	  
	  $espera="<i>$esprera</i>";	  	  
	}
	
		$tempoLimite = 1800;	
		if ($Grau == "G1")
		{
			$tempoLimite = 900;
		} else if ($Grau == "G2")  
		{
			$tempoLimite = 1200;
		} else if ($Grau == "G3")
		{
			$tempoLimite = 1500;
		}
		
	
	  	$espera = "$espera ($esperasec)";	
	  
		if ($esperasec >= 480) {
		  $espera = "<b>$espera</b>";
		}
		if ($esperasec >= $tempoLimite)  {
		  $espera = "<font color=#ff0000><b>$espera</b></font>";
		}	
	/*
	if ($cor_fundo=='#E8F1F9') {
      $cor_fundo='#FFFFFF';
	} else {
      $cor_fundo='#E8F1F9';
	}
	*/
     $cor_fundo='#E8F1F9';	
	if (!$ativo) {
      $cor_fundo='#FFFFF8';
	}
	$grau = $linha->grau;	
	$cor = obterCorPorGrau($grau);

	
?>

        <tr bgcolor="<?=$cor_fundo?>"> 
          <td width="10%" align="center"><?=$qtde?> </td>
          <td width="4%" align="center"> 
            <?=$linhatel?></td>
          <td width="34%"> 
            <? echo $cliente;?>
            <?
			  if ($motivo) {
			    echo "<br>Devolvido por <b>$motivo</b>";
			  }
			?></td>
          <td width="10%" align="center" bgcolor="<?=$cor?>"><?=$grau?></td>
          <td width="11%" align="center">
            <?=$espera?></td>
          <td width="13%">
            <?=$produto?></td>
          <td width="18%"><a href="?acao=alterna&id=<?=$idligacao?>"><?=$link?></a></td>
        </tr>
        <?
 }
?>
      </table>
      <br> 
    </td>
  </tr>
  <tr> 
    <td align="center" valign="middle"><span class="style17">Liga&ccedil;&otilde;es 
        Transferidas (
      <?=$ligTransf?>
      )</span><br>        <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr bgcolor="#003366"> 
          <td width="30%"><span class="style12">Cliente</span></td>
          <td width="36%"><span class="style12">Consultor</span></td>
          <td width="8%"><span class="style12">Grau</span></td>
          <td width="26%"><span class="style12">Tempo na espera</span></td>
        </tr>
        <?
  $sql = "select usuario.nome, qtde_aguarde,  id, cliente.cliente, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as espera, ";
  $sql .= "sistema.sistema as produto, linha, cliente.grau from satligacao, cliente, sistema, usuario where usuario.id_usuario = satligacao.id_usuario and ";
  $sql .= "data = '$hoje' and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema and ";
  $sql .= "id_satstatus = 2 order by espera desc";
  $result = mysql_query($sql) or die($sql);
  while ($linha = mysql_fetch_object($result)) {  
    $nome = $linha->nome;
    $idligacao = $linha->id;
    $cliente = $linha->cliente;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$linhatel = $linha->linha;
	$Grau = $linha->grau;
	

		$tempoLimite = 1800;	
		if ($Grau == "G1")
		{
			$tempoLimite = 900;
		} else if ($Grau == "G2")  
		{
			$tempoLimite = 1200;
		} else if ($Grau == "G3")
		{
			$tempoLimite = 1500;
		}
		
	
	
		if ($esperasec >= 480) {
		  $espera = "<b>$espera</b>";
		}
		if ($esperasec >= $tempoLimite)  {
		  $espera = "<font color=#ff0000><b>$espera</b></font>";
		}
			
	
?>
        <tr> 
          <td>
            <?=$cliente?> </td>
          <td> 
<?=$nome?>
            ( 
            <?=$linhatel?>
            ) </td>
          <td>-- <?=$Grau?> --</td>
          <td> 
            <?=$espera?>
          </td>
        </tr>
        <?
 }
?>
      </table>
    <p><font size="3"></font></p></td>
  </tr>
  <tr> 
    <td align="right">
<input name="acao" type="hidden" id="acao" value="XXX"> <input name="idligacao" type="hidden" id="idligacao">
      Sad 2004</td>
  </tr>
  <tr>
    <td align="right"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#003300">
      <tr>
        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
              <td width="31%">Total de liga&ccedil;&otilde;es de hoje</td>
              <td width="15%"><strong><font color="#003366" size="2">
                <?=$ligHoje?>
              </font></strong></td>
              <td width="34%"><strong><font color="#003300">Tempo m&eacute;dio de espera</font></strong></td>
              <td width="20%"><strong><font color="#003300" size="2">
                <?=$tmedio?>
              </font></strong></td>
            </tr>
            <tr>
              <td>Em espera</td>
              <td width="15%"><font color="#FF0000" size="2"><strong>
                <?=$ligEspera?>
              </strong></font></td>
              <td width="34%">Tempo m&aacute;ximo</td>
              <td width="20%"><font size="1">
                <?=$tmaximo?>
              </font></td>
            </tr>
            <tr>
              <td>Atendidas por consultor</td>
              <td width="15%"><strong><font color="#003366" size="2">
                <?=$qtdeconsultor?>
              </font></strong></td>
              <td width="34%">Tempo m&iacute;nimo</td>
              <td width="20%"><font size="1">
                <?=$tminimo?>
              </font></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">** Valores considerando o dia inteiro, liga&ccedil;&otilde;es atendidas e n&atilde;o atendidas </td>
              </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

<br>
<a href="relat/rel001.php">Ver Liga&ccedil;&otilde;es de Hoje</a></body>
</html>

