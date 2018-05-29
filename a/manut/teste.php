<?

$ok = 1;
if (is_uploaded_file($userfile1)) {
    copy($userfile1, "/home/httpd/html/backup/$userfile1_name");
} else {
    $ok=0;
}

if (is_uploaded_file($userfile2)) {
    copy($userfile2, "/home/httpd/html/backup/$userfile2_name");
} else {
    $ok=0;
}

if (is_uploaded_file($userfile3)) {
    copy($userfile3, "/home/httpd/html/backup/$userfile3_name");
} else {
    $ok=0;
}

if ($ok) {
  header("Location: backup.php");
}

?>

     

