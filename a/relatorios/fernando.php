<?php require_once('../../Connections/sad.php'); ?>
<?	require("../scripts/conn.php");	
	require("../scripts/stats.php");	
	require("../scripts/classes.php");	

	if (!$v_id_usuario) {
    	if ( isset($id_usuario) ) {
    		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
	    	if ($ok<>$id_usuario) { header("Location: index.php"); }
		    setcookie("loginok");  
	    } else {
		    header("Location: index.php");
	    }
	} else {
	    $ok = $v_id_usuario;
	}
	


	
		
?>
<html>
<head>
<title>Relat&oacute;rio S.A.D.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
</head>
<body bgcolor="#FFFFFF" text="#000000">
<label></label>
<div align="center">Contatos estabelecidos </div>
<div align="left">
  <?php	


$sql = "
select 
       concat('<a href=http://192.168.0.14/a/historicochamado.php?&id_chamado=', id_chamado, ' Target=_new >', id_chamado ,'</a>') link,
       cliente_id, 
       right(descricao, 100) descricao, 
       datauc,       
       p.prioridade,              
       s.sistema
       
from 
     chamado      
       inner join prioridade p on p.id_prioridade = prioridade_id       
       inner join sistema s on s.id_sistema = sistema_id
where 
      destinatario_id = $ok and status = 2 and visible = 1
--                      and cliente_id <> 'DATAMACE'       
                      and (sistema_id = 12 or sistema_id = 103)
order by
      p.valor, cliente_id, datauc 
";

?>
  <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr>
          <td bgcolor="#FFFFFF" ><a href="javascript:order('nome')">Link</a></td>
          <td bgcolor="#FFFFFF" ><a href="javascript:order('cliente_id')">Cliente</a></td>
          <td bgcolor="#FFFFFF" >Descrição</td>
          <td bgcolor="#FFFFFF" >Prioridade</td>
    </tr>
  
<?

	
  $nome = "";
  $ch = 0;
  
  $AcumuladoTotal = 0;
  $resultA = mysql_query($sql) or die (mysql_error() . '- ' . $sql);
  
  while ($linhaA = mysql_fetch_object($resultA)) {
    

?>

    <tr>
          <td bgcolor="#FFFFFF" ><?=$linhaA->link;?> </td>

          <td bgcolor="#FFFFFF" ><?=$linhaA->cliente_id?> </td>
          <td bgcolor="#FFFFFF" ><?=($linhaA->descricao);?></td>
          <td bgcolor="#FFFFFF" ><?=$linhaA->prioridade?></td>
    </tr>
<?php
  }
 ?>
  </table>
  <hr>
  </p>

  </blockquote>
  <a href="../inicio.php">SAD</a> </div>
  </div>
  
</body>
</html>
