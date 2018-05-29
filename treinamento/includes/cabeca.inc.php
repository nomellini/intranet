<?
// Data no passado
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// Sempre modificado
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
// HTTP/1.0
header("Pragma: no-cache");

error_reporting (E_ALL ^ E_NOTICE ) ;
set_time_limit(0);

session_start();

$ipremoto = $_SERVER["REMOTE_ADDR"];
if (!$ipremoto)
	$ipremoto = $_SERVER["HTTP_X_FORWARDED_FOR"];

function unhtmlentities ($string) {
	$trans_tbl = get_html_translation_table (HTML_ENTITIES);
	$trans_tbl = array_flip ($trans_tbl);
	return strtr ($string, $trans_tbl);
}

//*****************************************************************************	
	if (isset($_POST)) {
		while(list($var,$val) = each($_POST)) {
		     $$var = $val;
		}
	}		 
    if (isset($_GET)) {
		while(list($var,$val) = each($_GET)) {
		     $$var = $val;
		}
	}		 
    if (isset($_SESSION)) {
		while(list($var,$val) = each($_SESSION)) {
		     $$var = $val;
		}
	}		 
    if (isset($_COOKIE)) {
		while(list($var,$val) = each($_COOKIE)) {
		     $$var = $val;
		}
	}		 

//$banco_dados = 'mysql';
//$banco_dados = 'ibase';
$banco_dados = 'mssql';

switch ($banco_dados) {
    case 'ibase' : $db = &ADONewConnection($banco_dados);
                   $db->PConnect('servidor:c:\Datamace\banco\gdocnet.fdb','usuario','senha');
				   if (!$db) die("Erro na conexão com o Banco de Dados.");   

				   break;
	case 'mysql' : 
	               //$db = &ADONewConnection($banco_dados);
                   //$dsn = 'mysql://datamace:datamace@localhost?persist'; 
                   //$db = NewADOConnection($dsn);
				   
				   $db = &ADONewConnection('mysql'); 	
				   $db->PConnect('localhost','datamace','datamace','');
				   
                   if (!$db) die("Erro na conexão com o Banco de Dados: " );  
				   break;
				   
	case 'mssql' : 
				   $db  =& ADONewConnection('odbc_mssql');
                   $dsn = "Driver={SQL Server};Server=DTMSIS11\DTMSIS11;Database=gdocnet;";	
				   $db->PConnect($dsn,'sa','datamace');				   
				   if (!$db) die("Erro na conexão com o Banco de Dados: " );  
				   break;
				   
				   
}				    

$ADODB_LANG     = 'pt-br';

?>