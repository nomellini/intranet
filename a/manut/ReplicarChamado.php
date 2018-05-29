<?php require_once('../../Connections/sad.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rsChamado = "-1";
if (isset($_POST['Chamado_Id'])) {
  $colname_rsChamado = $_POST['Chamado_Id'];
}
mysql_select_db($database_sad, $sad);
$query_rsChamado = sprintf("SELECT * FROM chamado WHERE id_chamado = %s", GetSQLValueString($colname_rsChamado, "int"));
$rsChamado = mysql_query($query_rsChamado, $sad) or die(mysql_error());
$row_rsChamado = mysql_fetch_assoc($rsChamado);
$totalRows_rsChamado = mysql_num_rows($rsChamado);

mysql_select_db($database_sad, $sad);
$query_rsClientes = "SELECT id_cliente, senha, cliente FROM cliente where not bloqueio and senha <> '' ORDER BY cliente ASC";
$rsClientes = mysql_query($query_rsClientes, $sad) or die(mysql_error());
$row_rsClientes = mysql_fetch_assoc($rsClientes);
$totalRows_rsClientes = mysql_num_rows($rsClientes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<title>Replicar chamado</title>
<link href="../attendere.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>Utilize esta ferramente para replicar o chamado <strong><?php echo $row_rsChamado['id_chamado']; ?></strong></p>
<p><strong>Descri&ccedil;&atilde;o do chamado:</strong><br />
<?php echo $row_rsChamado['descricao']; ?><br />
<strong>Data e hora de abertura:</strong><br />
<?php echo $row_rsChamado['dataa']; ?> <?php echo $row_rsChamado['horaa']; ?></p>
<p>Selecione os clientes que deseja replicar este chamado:<br />
</p>
<form id="form1" name="form1" method="post" action="ReplicarChamado_step_2.php">
  <p>
    <label for="clientes"></label>
	    
    <input name="id_chamado" type="hidden" id="id_chamado" value="<?=$Chamado_Id?>" />
    <br />
    <br />
    Filtrar:<br />
  <label for="textfield"></label>
  <input type="text" name="textfield" id="textfield" onkeyup="filter2(this, 'sf', 1)" />
  </p>
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="563" valign="top"><table border="0" cellspacing="0" cellpadding="0" id="sf">
        <tr>
          <td width="24">cb</td>
          <td width="123">Cliente</td>
          <td width="105">Senha</td>
          <td width="223">Nome</td>
        </tr>
        <?php do { ?>
        <tr>
          <td><input onclick="atualiza()" name="id_cliente[]" type="checkbox" id="<?php echo $row_rsClientes['cliente']; ?>" value="<?php echo $row_rsClientes['id_cliente']; ?>" /></td>
          <td><?php echo $row_rsClientes['id_cliente']; ?></td>
          <td><?php echo $row_rsClientes['senha']; ?></td>
          <td><?php echo $row_rsClientes['cliente']; ?></td>
        </tr>
        <?php } while ($row_rsClientes = mysql_fetch_assoc($rsClientes)); ?>
      </table></td>
      <td width="309" valign="top">
        <p>Clientes selecionados:<br />
        <span id="nomes"></span><br />
        <input name="publicar" type="checkbox" id="publicar" value="1" checked="checked" />
        PUBLICAR CHAMADO PARA O CLIENTE </p>
      <p>
        <input type="submit" name="button" id="button" value="Submit" />
      </p></td>
    </tr>
  </table>
  <p><br />  
  </p>
  <p>    <br />
</p>
</form>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($rsChamado);
mysql_free_result($rsClientes);
?>
<script type="text/javascript">
function filter (term, _id, cellNr){
	var suche = term.value.toLowerCase();
	var table = document.getElementById(_id);
	var ele;
	for (var r = 1; r < table.rows.length; r++){
		ele = table.rows[r].cells[cellNr].innerHTML.replace(/<[^>]+>/g,"");
		if (ele.toLowerCase().indexOf(suche)>=0 )
			table.rows[r].style.display = '';
		else table.rows[r].style.display = 'none';
	}
}

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


function atualiza() {
	var ids;
    var doc_tables = document.all.tags("input");
    var nome, linha, tipo, ativo;
	linha = "";
	ids = "";
    for (i=0; i<doc_tables.length; i++)  { 
		 tipo  = doc_tables(i).type;
		 ativo = doc_tables(i).checked;
         nome  = doc_tables(i).id;
         if ( tipo == "checkbox" && ativo && doc_tables(i).name != "particular") {
		   if (linha != "") { 
		   	linha = linha + "<br>";
			ids = ids + ',';
		   }
           linha = linha + nome;
		   ids = ids + doc_tables(i).value;
         }
        }

	nomes.innerHTML = linha;
}


</script>

