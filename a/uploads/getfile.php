<?php
// Nas vers�es anteriores a 4.1.0, $HTTP_POST_FILES deve ser usado ao inv�s de $_FILES.
// Nas vers�es anteriores a 4.0.3, use copy() e is_uploaded_file() ao inv�s move_uploaded_file

$uploaddir = "/var/www/default/public_html/uploads/";
$uploadfile = $_FILES['userfile']['name'];


$uploadfile = $uploaddir . "CH27001-" .$_FILES['userfile']['name'];
$uploadfile = eregi_replace(" ", "", $uploadfile);

print "<pre>";
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    print "O arquivo � valido e foi carregado com sucesso. Aqui esta alguma informa��o:\n";
    print_r($_FILES);
} else {
    print "Possivel ataque de upload! Aqui esta alguma informa��o:\n";
    print_r($_FILES);
}
print "</pre>";
?>
