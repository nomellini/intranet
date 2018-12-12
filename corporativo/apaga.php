<?

   mysql_connect(localhost, sad, data1371);


    mysql_select_db(datamace);

    if ($acao=="apagar") {
      $sql = "DELETE from TelCol Where id=$id;";
    };

    if ($acao=="ativar") {
      $sql =  "update TelCol set ativo=1 where id=$id;";
    };

    if ($acao=="desativar") {
      $sql = "UPDATE TelCol set ativo = NULL where id=$id;";
    };

    mysql_query($sql);
    header ("Location: topsecret.php"); /* Redirect browser 
                                            to PHP web site */
    exit;                 /* Make sure that code below does 
                         not get executed when we redirect. */    
 

   
 ?>
