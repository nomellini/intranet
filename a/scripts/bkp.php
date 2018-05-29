<?
/*
      $arq = fopen("/home/httpd/html/backup/atendimento_bkp.txt", "w");
      $teste=`mysqldump teste -uroot -pmarcia --add-drop-table`;
      fputs( $arq, $teste );
      fclose( $arq );	  	  
	  
      $teste = `zip /home/httpd/html/backup/backupdiario.zip /home/httpd/html/backup/atendimento_bkp.txt`;
      $teste = `rm /home/httpd/html/backup/atendimento_bkp.txt -f`;
	  $teste = `cp /home/httpd/html/backup/backupdiario.zip /var/www/default/backup/backupdiario.zip`;
*/	  	  
      $arq = fopen("/home/httpd/html/backup/ultimo.htm", "w");
      $teste="<br>Último backup efetuado em $dataa, as $horaa: <a href=\"backupdiario.zip\">Pegue</a>";
      fputs( $arq, $teste );
      fclose( $arq );
?>