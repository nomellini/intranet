<?
  $teste=`mysqldump suporte  -uroot -pmarcia --add-drop-table > /var/www/default/backup/suporte.txt`;
  $teste=`mysqldump sympoll -uroot -pmarcia --add-drop-table > /var/www/default/backup/sympoll.txt`;
  $teste=`mysqldump phorum -uroot -pmarcia --add-drop-table > /var/www/default/backup/phorum.txt`;
  $teste=`mysqldump hardware -uroot -pmarcia --add-drop-table > /var/www/default/backup/hardware.txt`;
  $teste=`mysqldump datamace -uroot -pmarcia --add-drop-table > /var/www/default/backup/datamace.txt`;
  $teste=`mysqldump teste  -uroot -pmarcia --add-drop-table > /var/www/default/backup/sadbkp.txt`;
  $teste=`mysqldump estoque  -uroot -pmarcia --add-drop-table > /var/www/default/backup/estoquebkp.txt`;
?>