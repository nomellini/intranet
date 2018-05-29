#!/usr/local/bin/php -f
<?

$emailpadrao="fernando.nomellini@datamace.com.br";
$headers  = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From: Agenda Datamace<agenda@datamace.com.br>\n";


  $agora = mktime( date("G"), date("i"), date("s"), date("m"), date("d"), date("Y"),1 );
  $soma1dia = mktime(-2, 0, 0,  1, 2, 1970); 
  $amanha = date("Y-m-d",$agora+$soma1dia);  
  
  echo $amanha;

?>