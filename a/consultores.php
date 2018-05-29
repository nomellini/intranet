<?php require_once('../Connections/sad.php'); ?>
<?
  mysql_select_db($database_sad, $sad);
  if ($acao == "gravar") {  
  	$agoraTimeStamp=date("Y-m-d H:i:s");
	$sql = "update usuario set estado = $status_consultor, estado_hora = '$agoraTimeStamp' where id_usuario = $id";
	$result = mysql_query($sql) or die (mysql_error());
  }
?><?php
mysql_select_db($database_sad, $sad);
$query_rsEstados = "SELECT id, descricao FROM status_consultor WHERE ativo ORDER BY descricao ";
$rsEstados = mysql_query($query_rsEstados, $sad) or die(mysql_error());
$row_rsEstados = mysql_fetch_assoc($rsEstados);
$totalRows_rsEstados = mysql_num_rows($rsEstados);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p><br />
Utilize esta tela para alterar o estado de um consultor.<br /> 
Selecione o novo estado e clique em gravar. Selecione apenas um consultor por vez.<br />
</p>
<form id="form1" name="form1" method="post" action="">
  <table width="88%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
        <tr bgcolor="#333333">
          <td width="17%"><strong><font color="#FFFF00">Nome</font></strong></td>
          <td width="18%"><strong><font color="#FFFF00">Estado Atual </font></strong></td>
          <td width="22%" align="center"><strong><font color="#FFFF00">Cliente</font></strong></td>
          <td width="16%" align="center"><strong><font color="#FFFF00">Tempo</font></strong></td>
          <td width="27%" align="center"><font color="#FFFF00"><strong>Novo Estado </strong></font></td>
        </tr>
        <?
		  
               //$sql = "select id_usuario, nome, estado from usuario where superior = $ok and ativo";
 				$sql = "select sat_idcliente, id_usuario, nome, estado, sec_to_time(  time_to_sec(curtime()) - time_to_sec(estado_hora)  ) as minutos from usuario where area = 1 and ativo";
				$result = mysql_query($sql) or die ($sql);
				while($linha = mysql_fetch_object($result)) {
				  $sat_idcliente = "&nbsp;";  
				  if (  ($linha->estado==4) and ($linha->sat_idcliente)) {
					$sat_idcliente = $linha->sat_idcliente;
				  } else {
					$sat_idcliente = "&nbsp;";
				  }
				
		?>
        <tr bgcolor="#FFFFFF">
          <td><strong>
            <?=$linha->nome?>
          </strong></td>
          <td><strong>
            <? if ($gerente or ($linha->id_usuario == $ok)) { ?>
            <a href="?acao=mudaestadoconsultor&amp;id_consultor=<?=$linha->id_usuario?>&amp;status=<?=$linha->estado?>">
            <? } ?>
            <img src="imagens/estado<?=$linha->estado?>.jpg" width="120" height="20" border="0" />
            <? if ($gerente) { ?>
            </a>
            <? } ?>
          </strong> </td>
          <td align="center" valign="middle"><?=$sat_idcliente?></td>
          <td align="center" valign="middle"><strong>
            <?=$linha->minutos?>
          </strong></td>
          <td align="center" valign="middle"><select name="select" id="select" onchange="vai(this.value, <?=$linha->id_usuario?>)">
            <option value="0">Selecione</option>
            <?php
do {  
?>
            <option value="<?php echo $row_rsEstados['id']?>"><?php echo $row_rsEstados['descricao']?></option>
            <?php
} while ($row_rsEstados = mysql_fetch_assoc($rsEstados));
  $rows = mysql_num_rows($rsEstados);
  if($rows > 0) {
      mysql_data_seek($rsEstados, 0);
	  $row_rsEstados = mysql_fetch_assoc($rsEstados);
  }
?>
                      </select>
          </td>
        </tr>
        <?
		  }		  
		  ?>
  </table>
    <p>
      <label></label>
      <input name="acao" type="hidden" id="acao" value="gravar" />
      <input name="id" type="hidden" id="id" />
      <label>
      <input name="status_consultor" type="hidden" id="status_consultor" />
      <input type="submit" name="Submit" value="Submit" />
      </label>
    </p>
</form>
    <p>&nbsp;</p>
	
<script>
function vai(status, idConsultor) 
{
	document.form1.status_consultor.value = status;
	document.form1.id.value = idConsultor;
}
</script>	
	
</body>
</html>
<?php
mysql_free_result($rsEstados);
?>
