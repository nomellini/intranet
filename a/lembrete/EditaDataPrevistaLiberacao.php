<?
  require("../scripts/conn.php");		  
  $sql = "select dataprevistaliberacao, liberado, obsliberacao from chamado where id_chamado = " . $id_chamado;
  $result = mysql_query($sql);
  $linha = mysql_fetch_object($result);
  $liberado = $linha->liberado;
  $obs = $linha->obsliberacao;
  
  $data = $linha->dataprevistaliberacao;
  $quando = explode("-", $data);
  $dia = $quando[2];
  $mes = $quando[1];
  $ano = $quando[0]; 
  
?>
<html>
<head>
<title>Data Prevista</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../stilos.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
 Data Prevista de libera&ccedil;&atilde;o
<br>
<br>
<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#CCCCCC">
  <tr> 
    <td bgcolor="#FFFFFF">Referente ao Chamado <?=$id_chamado?> <br>
      <form name="form1" method="post" action="DoAlterarDataPrevistaLiberacao.php">
        <table width="100%" border="0" cellspacing="1" cellpadding="1">
          <tr> 
            <td width="16%" valign="top">Data Prevista </td>
            <td width="84%" valign="top"> 
              <input type="text" name="dia" size="3" maxlength="2" class="unnamed1" value="<?=$dia?>">
              /
              <input type="text" name="mes" size="3" maxlength="2" class="unnamed1" value="<?=$mes?>">
              /
              <input type="text" name="ano" size="5" maxlength="4" class="unnamed1" value="<?=$ano?>">
            </td>
          </tr>
          <tr> 
            <td width="16%" valign="top">Status</td>
            <td width="84%" valign="top"> 
              <input <?php if (!(strcmp($liberado,"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="liberado" value="0" checked>
              N&atilde;o Liberado 
              <input <?php if (!(strcmp($liberado,"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="liberado" value="1">
              Liberado </td>
          </tr>
          <tr> 
            <td width="16%" valign="top">Observa&ccedil;&atilde;o</td>
            <td width="84%" valign="top"> 
              <textarea name="observacao" cols="50" rows="6" class="unnamed1" id="observacao"><?php echo $obs?></textarea>
            </td>
          </tr>
          <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%"> 
              <input type="submit" name="Submit" value="Salvar" class="unnamed1">
              <input type="hidden" name="id_chamado" value="<?=$id_chamado?>">
              <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
              <input type="hidden" name="inicio" value="<?=$inicio?>">
            <input name="acao" type="hidden" id="acao" value="alterar">            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
</body>
</html>
