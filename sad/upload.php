<?php

function file_extension($filename)
{
	return end(explode(".", $filename));
}

function assign_rand_value($num)
{
  switch($num)
  {
    case "1":
     $rand_value = "a";
    break;
    case "2":
     $rand_value = "b";
    break;
    case "3":
     $rand_value = "c";
    break;
    case "4":
     $rand_value = "d";
    break;
    case "5":
     $rand_value = "e";
    break;
    case "6":
     $rand_value = "f";
    break;
    case "7":
     $rand_value = "g";
    break;
    case "8":
     $rand_value = "h";
    break;
    case "9":
     $rand_value = "i";
    break;
    case "10":
     $rand_value = "j";
    break;
    case "11":
     $rand_value = "k";
    break;
    case "12":
     $rand_value = "l";
    break;
    case "13":
     $rand_value = "m";
    break;
    case "14":
     $rand_value = "n";
    break;
    case "15":
     $rand_value = "o";
    break;
    case "16":
     $rand_value = "p";
    break;
    case "17":
     $rand_value = "q";
    break;
    case "18":
     $rand_value = "r";
    break;
    case "19":
     $rand_value = "s";
    break;
    case "20":
     $rand_value = "t";
    break;
    case "21":
     $rand_value = "u";
    break;
    case "22":
     $rand_value = "v";
    break;
    case "23":
     $rand_value = "w";
    break;
    case "24":
     $rand_value = "x";
    break;
    case "25":
     $rand_value = "y";
    break;
    case "26":
     $rand_value = "z";
    break;
    case "27":
     $rand_value = "0";
    break;
    case "28":
     $rand_value = "1";
    break;
    case "29":
     $rand_value = "2";
    break;
    case "30":
     $rand_value = "3";
    break;
    case "31":
     $rand_value = "4";
    break;
    case "32":
     $rand_value = "5";
    break;
    case "33":
     $rand_value = "6";
    break;
    case "34":
     $rand_value = "7";
    break;
    case "35":
     $rand_value = "8";
    break;
    case "36":
     $rand_value = "9";
    break;
  }
return $rand_value;
}



function get_rand_id($length)
{
	if($length>0) 
	{ 
		$rand_id="";
		for($i=1; $i<=$length; $i++)
		{
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,36);
			$rand_id .= assign_rand_value($num);
		}
	}
	return $rand_id;
}  
function MakeUploadName($pagename,$x) {
	$x = preg_replace('/[^-\\w. ]/', '', $x);
	$x = preg_replace('/^[^[:alnum:]]+/', '', $x);
	return preg_replace('/[^[:alnum:]]+$/', '', $x);
}


require("scripts/conn.php");
  session_start(); 
  
if ($v_id_cliente=="") {
	header("Location: doindex.php");
}

// Aqui incluimos a classe upload
include('class.upload.php');





// Verificamos se a acao é igual a imagem
if ($_POST['acao'] == 'imagem') 
{
    // Instanciamos o objeto Upload
    $handle = new Upload($_FILES['imagem']);

    // Então verificamos se o arquivo foi carregado corretamente
    if ($handle->uploaded) 
	{       
        // Definimos as configurações desejadas da imagem maior
       // $handle->image_resize            = true;
        //$handle->image_ratio_y           = false;
        //$handle->image_x                 = 640;
		//$handle->image_y                 = 480;
		//$handle->image_watermark         = 'watermark.png';
		//$handle->image_watermark_x       = -10;
		//$handle->image_watermark_y       = -10;
		//$handle->image_bevel = 20;
		//$handle->image_bevel_color1 = '#FF0000';
		//$handle->image_reflection_height = '25%';
		//$handle->image_reflection_space = -6;


		$code = get_rand_id(6);

		$arquivo=$_FILES['imagem'];
		$uploadfile = $arquivo["name"];
		$uploadfile = MakeUploadName($uploadfile,$uploadfile) ;
		$uploadfile = str_replace(" ", "", $uploadfile);
		$uploadfile = str_replace("-", "_", $uploadfile);		
		$uploadfile =  $code . "_" .$uploadfile;   
		$file_extension = file_extension($uploadfile); 
		

		$handle->file_new_name_body = $uploadfile;

		
        // Definimos a pasta para onde a imagem maior será armazenada
        $handle->Process('/dados/ftp/sites/sad/htdocs/public_html/uploads/');


		

        // Em caso de sucesso no upload podemos fazer outras ações como insert em um banco de cados
        if ($handle->processed) 
		{
		
		
			$uploadfile = $code . "_" . $handle->file_src_name_body . $file_extension .  "." .$file_extension;
			$uploadfile = str_replace(" ", "", $uploadfile);
			$uploadfile = str_replace("-", "_", $uploadfile);		

			
			
            // Eximos a informação de sucesso ou qualquer outra ação de sua escolha
			$arquivo=$_FILES['imagem'];
			$nomearq=$arquivo["name"];
			
			


$arquivo_nome = $pasta_dir . $arquivo["name"];

$arquivo=$arquivo["name"];
$select5=$_POST['select5'];
$assunto=$_POST['assunto'];
$textarea= $_POST['textarea'];
$_SESSION['textarea'] = "";
$arquivomens="Arquivo enviado: ";
$data=date("Y/m/d");
$horaa = date("H:i:s");

$sql= mysql_query("update chamado set	assunto  = '$assunto' , 	observacao = '$textarea', arquivo = '$nomearq' where id_chamado = '$select5'");

$sql1 =mysql_query("select destinatario_id from chamado where id_chamado=$select5");	
while($reg1=mysql_fetch_assoc($sql1)){
	$destinatario_id = $reg1['destinatario_id'];
}	
	
	
$sql2 = "INSERT INTO contato (chamado_id, origem_id, historico, consultor_id, ";
$sql2 .= "destinatario_id, status_id, dataa, datae, horaa, horae, publicar) ";
$sql2 .= "VALUES ($select5, 12, '" . $arquivomens . $nomearq ."', 56, ";
$sql2 .= "$destinatario_id, 2, '$data', '$data', '$horaa', '$horaa', 1);";
mysql_query($sql2) or die ($sql2);

	
$sql2 = "select id_contato from contato where chamado_id = $select5 and origem_id = 12 and consultor_id = 56 and dataa = '$data' and horaa = '$horaa' ";
$result = mysql_query($sql2) or die ($sql2);
$linha = mysql_fetch_object($result);
$contato_id = $linha->id_contato;

$sql2 = "insert into saduploads (id_consultor, id_chamado, id_contato, nome, nome_original, data) ";
$sql2 .= "values (56, $select5, $contato_id, '$uploadfile', '$arquivo', '$data $horaa')"; 
mysql_query($sql2) or die ($sql2);



?>
<script>
alert ("Arquivo enviado com sucesso!");
window.location='detalhes_chamado.php?id_chamado=<?echo $select5;?>';
</script>
<?
      } 
		else 
		{
            // Em caso de erro listamos o erro abaixo
            echo '<fieldset>';
            echo '  <legend>Erro encontrado!</legend>';
            echo '  Erro: ' . $handle->error . '';
            echo '</fieldset>';
        }

        // Aqui nos devifimos nossas configurações de imagem do thumbs
        $handle->image_resize            = true;
        $handle->image_ratio_y           = false;
        $handle->image_x                 = 100;
		$handle->image_y       			 = 75;
        $handle->image_contrast          = 10;
		$handle->jpeg_quality            = 70;
		$handle->file_new_name_body =    "1";
		
        // Definimos a pasta para onde a imagem thumbs será armazenada
        $handle->Process('');
        
        // Excluimos os arquivos temporarios
        $handle-> Clean();

    } 
	else 
	{
$textarea= $_POST['textarea'];
$_SESSION['textarea'] = $textarea;
?>
 <script>
alert ("Arquivo excedeu o limite permitido de 2MB");
window.location='enviar_arquivo.php?select5=<?echo $select5;?>';
</script>
 <?
    } 
}

echo '<p><a href="index.html">Voltar</a></p>';
// Aqui somente recupero o nome da imagem caso queira fazer um insert em banco de dados
$nome_da_imagem = $handle->file_dst_name;

echo $nome_da_imagem;
?> 
</body>

</html>
