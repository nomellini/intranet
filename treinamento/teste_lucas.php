<?php
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

print_r($_SERVER);

/*
$prova = new treinamento();
//$prova->carrega();
//$prova->cod_prova = 3177;
//echo '<br>Nota: ' . $prova->verifica_nota();

$prova->cod_prova	= 0;
$prova->tipo		= 1;
echo '<br>Nota: ' . $prova->ver_nota_ult_rg(305431286);
echo '<br>Qtd. Perguntas: ' . $prova->qtd_pergunta;
echo '<br>Aproveitamento: ' . $prova->aproveitamento;
*/


// This a copy taken 2008-08-21 from http://siphon9.net/loune/f/ntlm.php.txt to make sure the code is not lost.

// For more information see:

// http://blogs.msdn.com/cellfish/archive/2008/08/26/getting-the-logged-on-windows-user-in-your-apache-server.aspx


// NTLM specs http://davenport.sourceforge.net/ntlm.html


$headers = apache_request_headers();
 
if (!isset($headers['Authorization'])){
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: NTLM');
    exit;
}
 
$auth = $headers['Authorization'];
 
if (substr($auth,0,5) == 'NTLM ') {
    $msg = base64_decode(substr($auth, 5));
    if (substr($msg, 0, 8) != "NTLMSSP\x00")
        die('error header not recognised');
 
    if ($msg[8] == "\x01") {
        $msg2 = "NTLMSSP\x00\x02\x00\x00\x00".
            "\x00\x00\x00\x00". // target name len/alloc
            "\x00\x00\x00\x00". // target name offset
            "\x01\x02\x81\x00". // flags
            "\x00\x00\x00\x00\x00\x00\x00\x00". // challenge
            "\x00\x00\x00\x00\x00\x00\x00\x00". // context
            "\x00\x00\x00\x00\x00\x00\x00\x00"; // target info len/alloc/offset
 
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: NTLM '.trim(base64_encode($msg2)));
        exit;
    }
    else if ($msg[8] == "\x03") {
        function get_msg_str($msg, $start, $unicode = true) {
            $len = (ord($msg[$start+1]) * 256) + ord($msg[$start]);
            $off = (ord($msg[$start+5]) * 256) + ord($msg[$start+4]);
            if ($unicode)
                return str_replace("\0", '', substr($msg, $off, $len));
            else
                return substr($msg, $off, $len);
        }
        $user = get_msg_str($msg, 36);
        $domain = get_msg_str($msg, 28);
        $workstation = get_msg_str($msg, 44);
 
        print "You are $user from $domain/$workstation";
    }
}

?>