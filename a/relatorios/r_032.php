<?	require("../scripts/conn.php");	
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
		
    if(!$datai) {
       $datai = date("d/m/Y", time()-( 86400*2 ) );  // 86400 = numero de segundos em um dia, 90 = 2 meses atras
	}
	
	$hoje = date("d/m/Y");	
	if(!$dataf) {
      $dataf = $hoje;
	}
	
	if (!isset($orderby)) {
		$orderby = " id_chamado desc";
	}
	
	$orderby .= ", id_chamado";	
		
?>
<html>
<head>
<script>
function fdata(src) {
  if (src.value.length==2 || src.value.length==5 ){src.value=src.value+"/";}
}
</script>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="stilos.css" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {font-weight: bold}
.style3 {font-weight: bold}
-->
</style>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
</head>
<body bgcolor="#FFFFFF" text="#000000">

<div align="center"><br>
  Chamados abertos quem tem pelo menos um contato meu.<br>
  <br>
  <br>
</div>
  <div align="left">
    <p>Pesquisar :
      <label for="textfield"></label>
      <input name="textfield" type="text" class="borda_fina" id="textfield" onKeyUp="filter2(this, 'sf', 1)" /><?php	

/*$sql_1 = "select id_chamado, descricao, u.nome, r.nome remetente from chamado ch 
left join usuario u on u.id_usuario = destinatario_id
left join usuario r on r.id_usuario = remetente_id
where status = 2
and visible = 1 
and consultor_id = $ok
and destinatario_id <> $ok
and exists (select * from contato where consultor_id = $ok and chamado_id = ch.id_chamado) and id_chamado <> 0
order by u.nome, r.nome, dataa DESC ";*/


$sql_1 = "select id_chamado, descricao, u.nome, r.nome remetente from chamado ch 
left join usuario u on u.id_usuario = destinatario_id
left join usuario r on r.id_usuario = remetente_id
where status = 2
and visible = 1 
and destinatario_id <> $ok
and exists (select * from contato where consultor_id = $ok and chamado_id = ch.id_chamado) and id_chamado <> 0
order by u.nome, r.nome, dataa DESC ";

?></p>
    <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999" id="sf">
    <tr>
          <td width="10%" bgcolor="#FFFFFF" >Chamado</td>
          <td width="21%" bgcolor="#FFFFFF" >Destinat&aacute;rio</td>
          <td width="69%" bgcolor="#FFFFFF" >Descricao</td>
    </tr>
  
<?
  $r = 0;
  $resultA = mysql_query($sql_1) or die (mysql_error());
  while ($linhaA = mysql_fetch_object($resultA)) {
  	$r++;
  /*
	$quando = explode("-", $linhaA->dataa);
	$dataa = "$quando[2]/$quando[1]/$quando[0]";
	$email1 = $linhaA->email;
	//$email2 = $linhaA->emailchamado;
	$email = $email1;
	if ($email1 == "") {
		$email = $email2;
	}
	*/
?>

    <tr>
          <td bgcolor="#FFFFFF" ><?=$linhaA->id_chamado;?></td>
          <td bgcolor="#FFFFFF" ><strong><?=$linhaA->nome;?> </strong><- <?=$linhaA->remetente;?></td>
          <td bgcolor="#FFFFFF" ><a href="../historicochamado.php?id_chamado=<?=$linhaA->id_chamado;?>">
          <?=nl2br($linhaA->descricao);?></a></td>
    </tr>
	
<?php
  }
 ?>
  </table>
  
  <p>
    <?  
$sql = "select u.nome, count(id_chamado)  q from chamado ch 
inner join usuario u on u.id_usuario = destinatario_id
where status = 2
and visible = 1 
and destinatario_id <> $ok
and exists (select * from contato where consultor_id = $ok and chamado_id = ch.id_chamado) and id_chamado <> 0
group by u.nome order by count(id_chamado)";

?>
    
    <br>
  </p>
  <p>Resumo. Quantidade de chamados por colaborador</p>
  <table width="289"  border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
<tr>
          <td bgcolor="#FFFFFF" >Nome</td>
          <td bgcolor="#FFFFFF" >Quantidade</td>
    </tr>
  
<?
  $c = 0;
  $resultA = mysql_query($sql) or die (mysql_error());
  while ($linhaA = mysql_fetch_object($resultA)) {
  	$c += $linhaA->q;
  /*
	$quando = explode("-", $linhaA->dataa);
	$dataa = "$quando[2]/$quando[1]/$quando[0]";
	$email1 = $linhaA->email;
	//$email2 = $linhaA->emailchamado;
	$email = $email1;
	if ($email1 == "") {
		$email = $email2;
	}
	*/
?>
    <tr>
          <td bgcolor="#FFFFFF" ><?=$linhaA->nome;?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->q;?></td>
    </tr>
<?php
  }
 ?>
     <tr>
          <td bgcolor="#FFFFFF" >Soma</td>
          <td bgcolor="#FFFFFF" ><?=$c;?></td>
    </tr>
  </table>  
  

  <hr>
  </p>
  </blockquote>
<a href="../inicio.php">SAD</a> </div>
  </div>
</body>
</html>
<script type="text/javascript">
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
  
</script>