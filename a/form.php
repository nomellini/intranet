<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<?


fixFilesArray($_FILES['userfile']);

foreach ($_FILES['userfile'] as $position => $file) {
	echo $file['name'] . "<br>";
}


	$c = count($_POST["text"]);
	for ($i = 0; $i < $c ; $i++) 
	{
		echo "<br>";	
		echo $_POST["text"][$i];	
	}		
	
	
	
function fixFilesArray(&$files)
{
    $names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);

    foreach ($files as $key => $part) {
        // only deal with valid keys and multiple files
        $key = (string) $key;
        if (isset($names[$key]) && is_array($part)) {
            foreach ($part as $position => $value) {
                $files[$position][$key] = $value;
            }
            // remove old key reference
            unset($files[$key]);
        }
    }
}
	
	
?>
</body>
</html>
