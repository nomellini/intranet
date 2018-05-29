<?php
// Nas versões anteriores a 4.1.0, $HTTP_POST_FILES deve ser usado ao invés de $_FILES.
// Nas versões anteriores a 4.0.3, use copy() e is_uploaded_file() ao invés move_uploaded_file

$uploaddir = "/var/www/default/public_html/uploads/";
$uploadfile = $_FILES['userfile']['name'];


$uploadfile = $uploaddir . "CH27001-" .$_FILES['userfile']['name'];
$uploadfile = eregi_replace(" ", "", $uploadfile);

print "<pre>";
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    print "O arquivo é valido e foi carregado com sucesso. Aqui esta alguma informação:\n";
    print_r($_FILES);
} else {
    print "Possivel ataque de upload! Aqui esta alguma informação:\n";
    print_r($_FILES);
}
print "</pre>";
?>
