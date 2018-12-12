#!/usr/bin/php -f
<? 
  echo("1");
  $FileName = "BackupSAD_" . date('H_i') . ".zip";
  echo("2. " . $FileName);  
  $FileNameOrigem = "/dados/ftp/sites/sad/htdocs/backup/".$FileName;
  echo("3. " . $FileNameOrigem);    
  $NOME = "zip " . $FileNameOrigem . "/dados/ftp/sites/sad/htdocs/backup/bkp*";
  $teste=`mysqldump -usad -pdata1371 sad --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/bkpsad.txt`;
  $teste=`mysqldump -usad -pdata1371 treinamento --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/bkptreinamento.txt`;  
  $teste=`mysqldump -usad -pdata1371 datamace --add-drop-table > /dados/ftp/sites/sad/htdocs/backup/bkpdatamace.txt`;    
  $outputShell = shell_exec($NOME) ;

$ftp_server = '192.168.0.1';
$ftp_user_name = 'sad';
$ftp_user_pass = 'napoleao';

$conn_id = ftp_connect($ftp_server);

// login com o nome de usuário e senha

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// confere a conexão
if ((!$conn_id) || (!$login_result)) {
       echo "A conexão FTP falhou!";
       echo "Tentou conectar ao servidor $ftp_server para o usuário $ftp_user_name";
       exit;
   } else {
       echo "Conectaado ao servidor $ftp_server, para o usuário $ftp_user_name";
   }

// carrega o arquivo
$upload = ftp_put($conn_id, $FileName, $FileNameOrigem, 1);

// confere o upload do arquivo
if (!$upload) {
       echo "O upload FTP falhou!";
   } else {
       echo "Carregado o arquivo $source_file no servidor $ftp_server como $destination_file";
   }

// fecha a conexão FTP
ftp_close($conn_id);

$outputShell = shell_exec('rm /dados/ftp/sites/sad/htdocs/backup/zi* -f') ;
?>
