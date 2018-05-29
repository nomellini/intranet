#!/usr//bin/php -f
<? 

  require("scripts/conn.php");


  $sql = "Select email, v_ativo, v_mensagem, v_assunto from usuario";
  $result = mysql_query($sql);
  while ($linha=mysql_fetch_object($result)) {
    $email = $linha->email;
    $ativo = $linha->v_ativo;
    $mensagem = $linha->v_mensagem;
    $assunto = $linha->v_assunto;

 
    $aux = explode("@", $email);
    $usuario = $aux[0];
    
    echo "\n$usuario";
 
    $arquivo = "/home/$usuario/.vacation.msg";

    if (file_exists($arquivo)) {

      echo  "\n--->$ativo<---, $mensagem $assunto\n";

      $handle = fopen($arquivo, "w+") or die("Deu pau");
      $conteudo = fread ($handle, filesize ($arquivo));
      fwrite($handle, $mensagem);
      fclose($handle);

      $linha = "\\$usuario, \"|/usr/bin/vacation -r -t0 $usuario\"";
      
      if (!$ativo) {
         $linha = "#$linha";
      }

  
      $arquivo = "/home/$usuario/.forward";
      $handle = fopen($arquivo, "w+") or die("Deu pau");
      $conteudo = fread ($handle, filesize ($arquivo));
      fwrite($handle, $linha);
      fclose($handle);
   }
}


?>
