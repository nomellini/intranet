<?

      $arq = fopen("/home/httpd/html/backup/atendimentoZ", "w");
      $teste=`mysqldump teste  -uroot -pmarcia --add-drop-table`;
      fputs( $arq, $teste );
      fclose( $arq );
	  
     $teste = `zip /home/httpd/html/backup/'date +%d%m'.zip /home/httpd/html/backup/atendimentoZ`;	  
	  

?>