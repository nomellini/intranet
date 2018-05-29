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
	
	$hoje = date("Y-m-d");		
	
	$sql = "select id_cliente, ";
	$sql .= " id, sec_to_time(  time_to_sec(curtime()) - time_to_sec(hora_inicio)  ) as minutos, ";
	$sql .= " (time_to_sec(curtime()) - time_to_sec(hora_inicio)) / 60 as espera ";
	$sql .= "from ";
	$sql .= " satligacao ";
	$sql .= "where  ";
	$sql .= " FL_ATIVO and ";
	$sql .= " data = '$hoje' and  ";
	$sql .= " ((id_satstatus = 1) or (id_satstatus = 2)) ";
	$sql .= "order by ";
	$sql .= " espera desc ";
	$sql .= "limit 1";
	$result = mysql_query($sql);
	$linha = mysql_fetch_object($result);
	if (!$linha) {
	  $tempomaximo = 0;
	  $tempominutos = "00:00:00";
	} else {
      $tempomaximo = $linha->espera;
	  $tempominutos = $linha->minutos; 
	}
	
	if (!$linha->id_cliente) {
       $linha->id_cliente = "Sem espera";
	}
	
	$lampada = "<img src=../imagens/farolverde.jpg width=100 height=40><br>Normal";
	if (  ($tempomaximo>=10) and ($tempomaximo<20)  ) {
	  $lampada = '<img src=../imagens/farolamarelo.jpg width=100 height=40><br>Atenção';
	} else if ($tempomaximo>=20) {
	  $lampada = "<img src=../imagens/farolvermelho.jpg width=100 height=40><br>Crítica";	
	}
	$lampada .= "<br><font size=\"2pt\" color=#003399>$tempominutos</font> - $linha->id_cliente";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Farol</title>
<link href="../stilos.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="5">
<style type="text/css">
<!--
body {
	margin-left: 10px;
	margin-top: 10px;
	margin-right: 10px;
	margin-bottom: 10px;
}
-->
</style></head>

<body>
<table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#003333">
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle"><?=$lampada?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<a href="Javascript:window.close();">X - Fechar</a>
<form name="form1" method="post" action="">
</form>
</body>
</html>
<script>
function abre() {
  window.open('farol.php','','width=250, height=100');
  document.form1.submit();
}
</script>