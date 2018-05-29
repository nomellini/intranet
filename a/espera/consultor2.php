<?	

    /*
	+----+--------------------+
	| id | descricao          |
	+----+--------------------+
	|  1 | Em Espera          |
	|  2 | Transferido        |
	|  3 | Atendido Consultor | FIM ATENDIDO
	|  4 | Finalizado         | FIM SEM ATENDER
	+----+--------------------+
	*/
	
	require("../scripts/conn.php");
	
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}

	$hoje = date("Y-m-d");	
	$hora = date("H:i:s");


    if ($acao == 'devolver') {
     if ($id_ligacao) {
	   $sql = "update satligacao set retorno=1, id_satstatus = 1, hora_transferencia=null, motivo='consultor: $motivo' where id = $id_ligacao;";
	   mysql_query($sql) or die($sql);
       header("Location: ../index.php");
	  }
	}

   if ($acao=='atender') {
       if ($id_ligacao) {
		   
		   $sql = "update satligacao set id_satstatus = 3, hora_fim='$hora' where id = $id_ligacao;";
		   mysql_query($sql) or die($sql);
		   
		   $sql = "update usuario set estado = 4, sat_idcliente = '$id_cliente' where id_usuario = $ok";
		   mysql_query($sql);
		   
		   header("Location: ../historico.php?id_cliente=$id_cliente&id_ligacao=$id_ligacao");
		}
   }

    if ($acao == 'desligar') {
     if ($id_ligacao) {	
	   $sql = "update satligacao set id_satstatus = 4, motivo='Consultor cancelou', hora_fim='$hora' where id = $id_ligacao;";
	   mysql_query($sql) or die($sql);
       header("Location: ../index.php");
	  }
	}
   

   $sql = '';
   $sql .= "select ";
   $sql .= "  id, cliente.cliente, cliente.senha, cliente.id_cliente, cliente.bloqueio, ";
   $sql .= "  sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as espera, ";
   $sql .= "  sistema.sistema as produto, linha, qtde_aguarde ";
   $sql .= "from  ";
   $sql .= "  satligacao, cliente, sistema  ";
   $sql .= "where ";
   $sql .= "  id_usuario = $ok and ";
   $sql .= "  data = '$hoje' and  ";
   $sql .= "  satligacao.id_cliente = cliente.id_cliente and  ";
   $sql .= "  satligacao.id_produto = sistema.id_sistema and  ";
   $sql .= "  id_satstatus = 2 order by espera desc";
   $result = mysql_query($sql) or die ($sql);
   while ($linha = mysql_fetch_object($result)) {  
    $bloqueio = $linha->bloqueio;
    $idligacao = $linha->id;
    $cliente = $linha->cliente;
	if ($bloqueio) {
		$cliente .= " <font color='#ff0000'><b>BLOQUEADO</b></font>";
	}
	$id_cliente = $linha->id_cliente;
	$produto = $linha->produto;
	$qtde = $linha->qtde_aguarde;
	$espera = $linha->espera;
	$linhatel = $linha->linha;
 }
 if (!$idligacao) {
    $cliente = "Nenhuma ligação para você";
    $idligacao = 0;		
 }
?>

<html>
<head>
<title>espera</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../todo/stilos.css" type="text/css">
<link href="../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="120">
<style type="text/css">
<!--
.style2 {font-size: 14px}
.style8 {font-size: 24px}
.style12 {
	color: #FF0000;
	font-size: 16px;
	font-weight: bold;
}
.style14 {font-size: 16px; font-weight: bold; }
.style16 {font-size: 24px; color: #003333; }
body {
	background-image: url(../../agenda/figuras/fundo.gif);
}
-->
</style>
</head> 
<body bgcolor="#FFFFFF" text="#000000">
<img src="../figuras/topo_sad_e_900.jpg" width="900" height="79"><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td>       <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="imagens/nulo.gif" width="1" height="1"></td>
        </tr>
    </table>      </td>
  </tr>
  <tr>
    <td valign="top"><p><br>
        <span class="style2">Liga&ccedil;&atilde;o a ser atendida</span></p>    </td>
  </tr>
  <tr> 
    <td valign="top"><blockquote>
        <p><br> 
        </p>
    </blockquote></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="1" cellspacing="1" class="bordagrafite02">
      <tr>
        <td width="16%"><span class="style2">Cliente</span></td>
        <td width="84%" ><span class="style14"><font color="#003333">
          <?=$cliente?>
        </font></span></td>
      </tr>
      <tr>
        <td><span class="style2">Produto</span></td>
        <td >
          <span class="style12">
          <?=$produto?>
          </span> </td>
      </tr>
      <tr>
        <td><span class="style2">Tempo em espera </span></td>
        <td >
          <span class="style14">
          <?=$espera?>
          </span></td>
      </tr>
    </table>   </td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellpadding="1" cellspacing="1" class="bordagrafite02">
      <tr align="center" valign="middle" bgcolor="#FFFFCC" class="borda_fina">
        <td width="33%"><span class="style16"><a href="javascript:fnc_atender();">ATENDER</a></span></td>
        <td width="33%"><span class="style8"><a href="javascript:fnc_devolver();">DEVOLVER</a><br>
        </span>
          <span class="style8">        </span></td>
        <td width="33%"><span class="style8"><a href="javascript:fnc_desligar();">DESLIGAR</a></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Liga&ccedil;&otilde;es atendidas hoje </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1" class="borda_fina">
      <tr bgcolor="#003366">
        <td width="13%" height="16" align="center"><font color="#FFFFFF"><em><strong>Hora</strong></em></font></td>
        <td width="41%"><font color="#FFFFFF"><em><strong>Cliente</strong></em></font></td>
        <td width="46%"><font color="#FFFFFF"><em><strong>Produto</strong></em></font></td>
      </tr>
<?
  $sql = "select cliente.cliente, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as espera, ";
  $sql .= "sistema.sistema as produto, hora_fim from satligacao, cliente, sistema where ";
  $sql .= "data = '$hoje' and satligacao.id_cliente = cliente.id_cliente and satligacao.id_produto = sistema.id_sistema and ";
  $sql .= "id_satstatus = 3 and id_usuario=$ok order by hora_fim desc";
  $result = mysql_query($sql);
  while ($linha = mysql_fetch_object($result)) {   
    $cliente = $linha->cliente;
	$produto = $linha->produto;
	$hora = $linha->hora_fim;
?>
      <tr>
        <td width="13%" align="center"><font size="1"><?=$hora?></font></td>
        <td width="41%"><font color="#003333" size="1"><? echo $cliente;?></font></td>
        <td width="46%"><font size="1">
          <?=$produto?>
        </font></td>
      </tr>
      <?
 }
?>
    </table></td>
  </tr>
  <tr> 
    <td align="right">
      Sad 2004</td>
  </tr>
  <tr>
    <td align="right"><form name="form1" method="post" action="">
      <input name="id_ligacao" type="hidden"  value="<?=$idligacao?>">
      <input name="id_cliente" type="hidden"  value="<?=$id_cliente?>">
      <input name="acao" type="hidden" id="acao">
      <input name="motivo" type="hidden" id="motivo">
    </form></td>
  </tr>
  <tr>
    <td align="right"></td>
  </tr>
</table>
</body>
</html>
<script>
function fnc_retomar(aId) {
  document.transf.idligacao.value = aId;
  document.transf.acao.value = 'retomar';
  document.transf.submit();
}

function fnc_atender() {
  document.form1.acao.value = 'atender';
  document.form1.submit();
}

function fnc_desligar() {
  if (window.confirm('O Cliente DESLIGOU o telefone ?')) {
    document.form1.acao.value = 'desligar';
	document.form1.submit();
  }
}

function fnc_devolver() {
  var mot
  mot = window.prompt("Qual o motivo para devolução ? (max 100 caracteres)", "");
  if (mot!="") {
	  document.form1.motivo.value = mot;
	  document.form1.acao.value = 'devolver';
	  document.form1.submit();
  } else {
    window.alert('Digite o motivo');
  }
}

</script>