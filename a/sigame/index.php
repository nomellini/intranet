<?	

	require("../scripts/conn.php");
	require("../scripts/funcoes.php");	
	
	
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


    if ($acao == 'deletar') {
     $sql = "delete from sigame where id_chamado=$id_chamado and id_usuario=$id_usuario;";
	 mysql_query($sql) or die($sql);
	loga_deixarDeSeguirChamado($id_usuario, $id_chamado);
	}
	
$timelinesql = "
select l.id_chamado, 
  l.data, l.hora, u.nome, l.acao acaoId,
  case l.acao
    when 1 then 'Abriu este chamado'
    when 2 then 'Inseriu um contato'
    when 3 then 'Leu o chamado'
    when 4 then 'Encerrou o chamado'
    when 5 then 'Passou a seguir este chamado'
    when 6 then 'Deixou de seguir este chamado'
    when 7 then 'Complementou um contato'	
	when 8 then 'Reabriu o chamado'		
	when 11 then 'Encaminhou'		
	when 12 then 'Manteve pendente'			
	when 13 then 'Iniciou um contato'
	when 14 then 'Cancelou um contato'	
  end acao,
  d.nome destinatario,
  c.destinatario_id,
  id_contato,
  s.sistema,
  c.lido, c.lidodono, c.consultor_id cId, c.descricao,
  concat('[', cl.id_cliente, '] ', cl.cliente)	cliente  
from 
  log l
    inner join usuario u on u.id_usuario = l.id_usuario
    left join usuario d on d.id_usuario = l.id_destinatario
	left join chamado c on c.id_chamado = l.id_chamado
	left join cliente cl on cl.id_cliente = c.cliente_id
	left join sistema s on s.id_sistema = c.sistema_id
where      
     c.status <> -1 and
     l.id_chamado in (select id_chamado from sigame where id_usuario = $id_usuario)
     and l.acao <> 3
order by id desc limit 10";    
?>

<html>
<head>
<title>Siga-me</title>
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
<script type="text/javascript" src="../scripts/engine.js"></script>
	<script type="text/javascript">
		function submit_form(AId) {
				// Construct URL
				url = 'handle_form.php?id=' + AId;				
				
				teste =  document.getElementById('teste'+AId);
				teste.innerHTML = '<br>Aguarde... <br><br><img src="../figuras/loading1.gif" alt="l" width="16" height="16">';				
				ajax_get (url, 'teste'+AId);
		}
	</script>
</head> 
<body bgcolor="#FFFFFF" text="#000000">
<a href="../inicio.php"><img src="../figuras/topo_sad_e_900.jpg" width="900" height="79" border="0"></a>
<br>
<br>
<br>
<label for="textfield"></label>
<br>
<table width="100%%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>10 &uacute;ltimas intera&ccedil;&otilde;es</td>
    <td align="right">Filtrar:       <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'sf', 1)" /></td>
  </tr>
</table>
<table width="100%%" border="0" align="center" cellpadding="1" cellspacing="1" id="sf"> 
  <tr class="tabelaTitulo2">
    <td>Data</td>
    <td>Quem</td>
    <td>A&ccedil;&atilde;o</td>
    <td>Chamado</td>
    <td>Cliente</td>    
  </tr>
  
  <?
  	$result = mysql_query($timelinesql) or die (mysql_error() . " <br><br> " . $timelinesql);
	while($linha = mysql_fetch_object($result)) {
  ?>
  
  <tr class="tabelaCorpo2">
    <td><?=AMD2DMA($linha->data) . " " .  $linha->hora ?></td>
    <td><?="$linha->nome"?></td>
    <td><?="$linha->acao"?></td>
    <td><a target="_blank" href="../historicochamado.php?&id_chamado=<?=$linha->id_chamado?>"><?="$linha->id_chamado"?></a></td>
    <td><a target="_blank" href="../historicochamado.php?&id_chamado=<?=$linha->id_chamado?>"><?="$linha->cliente"?></a></td>    
  </tr>
  <?
	}
  ?>
  
</table><br>


<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td>       <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td><img src="../espera/imagens/nulo.gif" width="1" height="1"></td>
        </tr>
    </table>      </td>
  </tr>
  <tr>
    <td valign="top"><p><a href="../inicio.php">Voltar ao SAD </a><br>
        <span class="style2">Chamados marcados como SIGA-ME </span></p>    </td>
  </tr>
  <tr>
    <td>
	
	<table width="100%" border="0" cellpadding="1" cellspacing="1" class="borda_fina">
      <tr bgcolor="#003366">
        <td width="7%" align="center">&nbsp;</td>
        <td width="9%" height="16" align="center"><font color="#FFFFFF"><em><strong>#</strong></em></font></td>
        <td width="18%"><font color="#FFFFFF"><em><strong>Cliente</strong></em></font></td>
        <td width="66%"><font color="#FFFFFF"><em><strong>Descri&ccedil;&atilde;o</strong></em></font></td>
      </tr>
<?
   $sql = '';
   $sql .= "select ";
   $sql .= "  chamado.*, sigame.id_chamado ch ";
   $sql .= "from ";
   $sql .= "  sigame left join chamado on sigame.id_chamado=chamado.id_chamado ";
   $sql .= "where ";
   $sql .= "  sigame.id_usuario = $ok order by datauc desc;";
   $result = mysql_query($sql) or die ($sql);
   while ($linha = mysql_fetch_object($result)) {  
	$id = $linha->id_chamado;
	$cliente = $linha->cliente_id;
	$descricao = $linha->descricao; 
	$datauc = explode('-', $linha->datauc);
	$UltimoContato = "$datauc[2]/$datauc[1]/$datauc[0] $linha->horauc";
	$descricao = eregi_replace("\r\n", "<br>",$descricao);
	$descricao = eregi_replace("\"", "`", $descricao);	
	
	$status = pegaStatus( $linha->status );
	if ( $linha->status <> 1 ) {
	  $status = "<font color=#FF0000>".$status."</font>";
	} else {
      $status = "<font color=#0000FF>".$status."</font>";
	}
	
	$destinatario = peganomeusuario( $linha->destinatario_id );
	

?>
      <tr>
        <td width="7%" align="center"><a href="javascript:fnc_deletar(<?=$linha->ch?>)">TIRAR</a></td>
        <td width="9%" align="center"><font size="1"><a href="../historicochamado.php?&id_chamado=<?=$id?>"><?=$id?></a></font><br>
          <font size="1" color="000000">
          <?=$status?>
        </font></td>
        <td width="18%"><font color="#003333" size="1"><? echo "$cliente<br>$UltimoContato";?></font></td>
        <td width="66%"><font size="1" color="000000"><br>
          Último destinatário deste chamado :<font color="#006666"> <strong><?=$destinatario?></strong></font><br>
		  <br>
		  Descrição:<br>
		  <strong><?=$descricao?></strong>
        </font>

		
		<div id="teste<?=$id?>">
<br><a href="javascript:submit_form(<?=$id?>)">Clique aqui para ver o último contato</a></div>
		
		</td>
      </tr>
	  <tr>
	  <td colspan="4"><hr heigth="1"></td>
	  </tr>
      <?
 }
?>
    </table>
	
	</td>
  </tr>
  <tr> 
    <td align="right">
      Sad 2004</td>
  </tr>
  <tr>
    <td align="right">
	<form name="form1" method="post" action="">
      <input name="id_chamado" type="hidden" >
      <input name="id_usuario" type="hidden" value="<?=$ok?>">	  
      <input name="acao" type="hidden" id="acao" value="deletar">
    </form></td>
  </tr>
  <tr>
    <td align="right"></td>
  </tr>
</table>





<p><em>	<strong>SIGA-ME</strong></em> permite voc&ecirc; rastrear um chamado qualquer<br>
Para SEGUIR um chamado, clique no link SIGA-ME que aparece no Hist&oacute;rico do chamado.<br>
Nesta tela voc&ecirc; pode tirar o chamado da sua lista, ou entrar no chamado para ler os contatos. <br>
A data que aparece abaixo do c&oacute;digo do cliente &eacute; a data do &uacute;ltimo contato </p>
</body>
</html>
<script>

function filter2 (phrase, _id){
	var words = phrase.value.toLowerCase().split(" ");
	var table = document.getElementById(_id);
	var ele;
	for (var r = 1; r < table.rows.length; r++){
		ele = table.rows[r].innerHTML.replace(/<[^>]+>/g,"");
	        var displayStyle = 'none';
	        for (var i = 0; i < words.length; i++) {
		    if (ele.toLowerCase().indexOf(words[i])>=0)
			displayStyle = '';
		    else {
			displayStyle = 'none';
			break;
		    }
	        }
		table.rows[r].style.display = displayStyle;
	}
}  

function fnc_deletar(aId) {
  document.form1.id_chamado.value = aId;
  document.form1.acao.value = 'deletar';
  document.form1.submit();
}
</script>