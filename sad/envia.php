<?  
require("scripts/conn.php");
  session_start(); 
$msg=$_SESSION['msg'];
if($msg==""){

}else{
header("Location: doindex.php");
}  
?>
		
<?php


//se existir o arquivo
if(isset($_FILES["arquivo"])){

$arquivo = $_FILES["arquivo"];


$pasta_dir = "/dados/ftp/sites/sad/htdocs/sad/arquivos/";//diretorio dos arquivos

 
//se não existir a pasta ele cria uma
if(!file_exists($pasta_dir)){
mkdir($pasta_dir);
}

$arquivo_nome = $pasta_dir . $arquivo["name"];


// Faz o upload da imagem
move_uploaded_file($arquivo["tmp_name"], $arquivo_nome);


}


$arquivo_nome = $pasta_dir . $arquivo["name"];
$arquivo=$arquivo["name"];
$select5=$_POST['select5'];
$assunto=$_POST['assunto'];
$textarea= $_POST['textarea'];


$sql= mysql_query("update chamado set	assunto  = '$assunto' , 	observacao = '$textarea', arquivo = '$arquivo' where id_chamado = '$select5'");



?>

<script>
alert ("E-mail enviado com sucesso");
window.location='enviar_arquivo.php';
</script>
