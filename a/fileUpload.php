<?
	$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
	$max_file_size = 1024*100; //100 kb
	$path = "uploads/"; // Upload directory
	$count = 0;
	
	fixFilesArray($_FILES['arquivos']);    		

	foreach ($_FILES['arquivos'] as $position => $file) 
	{
	}
/*	
	foreach ($_FILES['arquivos']['name'] as $f => $name) 
	{
		if ($_FILES['arquivos']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	
		
			
		if ($_FILES['arquivos']['error'][$f] == 0) {	           
	        if ($_FILES['arquivos']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            //if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
				echo($f);				
	            $count++; // Number of successfully uploaded file
	        }
	    }		

	}
	*/
	
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