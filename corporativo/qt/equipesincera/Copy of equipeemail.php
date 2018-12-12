<?
//include("Mail.php");

/*
function mail2($_recipient, $_subject, $_msg, $_headers) {

  $recipients = $_recipient;

  $headers["Content-type"] = "text/html; charset=iso-8859-1";
  $headers["From"]    = "Qualidade Total <sad@datamace.com.br>";
  $headers["To"]      = "Anonimo@datamace.com.br";
  $headers["Subject"] = $_subject;
  $body = $_msg;
  $params["host"] = "mail.datamace.com.br";
  $params["port"] = "25";
  $params["auth"] = true;
  $params["username"] = "dtmmail";
  $params["password"] = "datamail";
  // die($_recipient);
  // Create the mail object using the Mail::factory method
  $mail_object =& Mail::factory("smtp", $params);
  $mail_object->send($recipients, $headers, $body);
}
*/

 function horaToSeg($hora) {
   $g = split(":", $hora);
   $seg = $g[0]*3600 + $g[1]*60 + $g[2];
   return $seg;
 }


if (!$de) { $de="Anonimo";}
$body="<br>
Equipe Sincera:<br>
<br>
Para : $para<br>
Enviado por : $de<br>
<br>
<br>
01. Eu gostaria que você continuasse a<br>
<b>$campo1</b><br>
<br>
02. Eu gostaria que você parasse de<br>
<b>$campo2</b><br>
<br>
03. Eu gostaria que você começasse A<br>
<b>$campo3</b><br>
<br>
<br>
-------------------------------------------------------------<br>
Esta mensagem foi enviada pela Intranet, no link abaixo:<br>
<a href=http://192.168.0.5/corporativo/qt/equipesincera/index.php>http://192.168.0.5/corporativo/qt/equipesincera/index.php</a>
";

mail2($para, "Equipe Sincera", $body, "From: $de <>");
Header("Location: index.php?msg=OK&email=$para");
?>
