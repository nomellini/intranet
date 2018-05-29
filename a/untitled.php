<?

	$horaInicio = date("H:i:s");

	$HoraFim = "14:09:30";
	
	echo $horaInicio;
	
	if ($horaInicio < $HoraFim)
	{
		echo "Opa 1";
	}


	if ($horaInicio == $HoraFim)
	{
		echo "Opa 2";
	}
	
	if ($horaInicio > $HoraFim)
	{
		echo "Opa 3";
	}



?>