<?php require_once('../Connections/sad.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsPessoas = 22;
$pageNum_rsPessoas = 0;
if (isset($_GET['pageNum_rsPessoas'])) {
  $pageNum_rsPessoas = $_GET['pageNum_rsPessoas'];
}
$startRow_rsPessoas = $pageNum_rsPessoas * $maxRows_rsPessoas;

$colname_rsPessoas = "-1";
if (isset($_GET['cliente_id'])) {
  $colname_rsPessoas = (get_magic_quotes_gpc()) ? $_GET['cliente_id'] : addslashes($_GET['cliente_id']);
}
mysql_select_db($database_sad, $sad);
$query_rsPessoas = sprintf("SELECT id_pessoa, nome, email FROM pessoa WHERE cliente_id = %s ORDER BY nome ASC", GetSQLValueString($colname_rsPessoas, "text"));
$query_limit_rsPessoas = sprintf("%s LIMIT %d, %d", $query_rsPessoas, $startRow_rsPessoas, $maxRows_rsPessoas);
$rsPessoas = mysql_query($query_limit_rsPessoas, $sad) or die(mysql_error());
$row_rsPessoas = mysql_fetch_assoc($rsPessoas);

if (isset($_GET['totalRows_rsPessoas'])) {
  $totalRows_rsPessoas = $_GET['totalRows_rsPessoas'];
} else {
  $all_rsPessoas = mysql_query($query_rsPessoas);
  $totalRows_rsPessoas = mysql_num_rows($all_rsPessoas);
}
$totalPages_rsPessoas = ceil($totalRows_rsPessoas/$maxRows_rsPessoas)-1;

$queryString_rsPessoas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsPessoas") == false && 
        stristr($param, "totalRows_rsPessoas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsPessoas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsPessoas = sprintf("&totalRows_rsPessoas=%d%s", $totalRows_rsPessoas, $queryString_rsPessoas);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista de contatos</title>
<link href="stilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 10px;
	margin-top: 10px;
	margin-right: 10px;
	margin-bottom: 10px;
}
.style3 {color: #F4F4F4; font-weight: bold; }
-->
</style></head>

<body>

Selecione um contato. Total: <?php echo $totalRows_rsPessoas ?> contatos.<br />
<br />
<form method="post" name="form1" action="ExluiPessoa.php">
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#003366">
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="38%" bgcolor="#999999"><span class="style3">Nome</span></td>
        <td width="62%" bgcolor="#999999"><span class="style3">Email</span></td>
      </tr>
      <?php do { ?>
      <tr>
        <td><a href="javascript:vai('<?=$row_rsPessoas['nome']?>','<?=$row_rsPessoas['email']?>')"><?php echo $row_rsPessoas['nome']; ?></a> [ <a href="javascript:Excluir('<?php echo $row_rsPessoas['id_pessoa']; ?>', '<?php echo $row_rsPessoas['nome']; ?>');">Excluir</a> ] </td>
        <td><?php echo $row_rsPessoas['email']; ?></td>
      </tr>
      <?php } while ($row_rsPessoas = mysql_fetch_assoc($rsPessoas)); ?>
    </table></td>
  </tr>
</table>
<input name="id_cliente" type="hidden" value="<?php echo $cliente_id;?>" />
<input name="id_pessoa" type="hidden" value="XX" />
</form>
<br />
  <div align="center">
    <?php if ($pageNum_rsPessoas > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_rsPessoas=%d%s", $currentPage, max(0, $pageNum_rsPessoas - 1), $queryString_rsPessoas); ?>">&lt; Anterior</a> 
      <?php } // Show if not first page ?>
    | Página <?=(1+$pageNum_rsPessoas) ?> de <?= (1+$totalPages_rsPessoas)?> |
    <?php if ($pageNum_rsPessoas < $totalPages_rsPessoas) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_rsPessoas=%d%s", $currentPage, min($totalPages_rsPessoas, $pageNum_rsPessoas + 1), $queryString_rsPessoas); ?>">Pr&oacute;ximo &gt; </a>
      <?php } // Show if not last page ?>
    <br /><br />
    <?php if ($pageNum_rsPessoas >= $totalPages_rsPessoas) { // Show if last page ?>
    [<a href="javascript:vai('','');">Meu contato n&atilde;o aparece nesta lista, vou digitar no chamado</a>]
    <?php } // Show if last page ?>
  </div>
</body>
</html>
<?php
mysql_free_result($rsPessoas);
?>
<script>
 function vai(ANome, AEmail) {
   opener.document.form.pessoacontatada.value = ANome;
   opener.document.form.emailcontatado.value = AEmail;   
   opener.document.form.pessoacontatada.focus();
   window.close();
 }
	function Excluir(pIdPessoa, pNome) {
		if ( window.confirm("Excluir o contato: " +pNome + " ?") ) {
			document.form1.id_pessoa.value = pIdPessoa;
			document.form1.submit();			
		} else {
			return false;
		}		
	}
</script>
