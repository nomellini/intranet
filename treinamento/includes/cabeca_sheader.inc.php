<?
error_reporting (E_ALL ^ E_NOTICE ) ;

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

$db = &ADONewConnection('ibase');
//$db->SetDateLocale('Ge');
	
$db->Connect('dtmsis11:D:\Datamace\banco\gdocnet3.gdb','sysdba','masterkey');

if (strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")) { 
    $gdoc_browser = "MSIE";
	$gdoc_inner = 'innerText';
} else {
    $gdoc_browser = "NETSCAPE";
	$gdoc_inner = 'innerHTML';
}

$dir_padrao_docs = 'D:/Datamace/dir_docs_gdocnet';	
$servidor        = $_SERVER['HTTP_HOST'];
?>