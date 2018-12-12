<?

	require("../cabeca.php");	
		
    $Hoje = date("Y-m-d");  
    $Ontem = date("Y-m-d", time()-( 86400*1 ) );  
    $Anteontem = date("Y-m-d", time()-( 86400*2 ) );  	
    $Menos60dias = date("Y-m-d", time()-( 86400*60 ) );
	
	$DataReferencia = $Data_Atual;

		
	$SQL = "select 
	dataa,
	count(*) as contatos, 	
	SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) as Segundos,
	SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) /3600 as Horas, 	
sec_to_time(	SUM( TIME_TO_SEC(contato.horae) - TIME_TO_SEC( contato.horaa) ) ) as Tempo
	
	
  
	from 
	
		contato, 
		usuario 
	
	where 
		(usuario.id_usuario=contato.consultor_id) and 
		( contato.consultor_id = $ok ) and 
		horae <> horaa and 
		( (area = 1) || (area = 2) || (area = 3) || (area = 11))  and 
		(contato.historico is not null) and 
		(contato.historico<>'') and 
		(contato.dataa between '$Menos60dias' and '$Hoje') 

group by 
	contato.dataa
	
	order by dataa desc ;";	
	
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Radar</title>
</head>

<body>
	<div class="container-fluid">
    	<table class="table"> 
        	<thead>
            	<tr>
	                <th scope="col">Data</th>
	                <th scope="col">Contatos</th>
	                <th scope="col">Tempo</th>                    
                </tr>
            </thead>
            <tbody>
            <?
				$query = mysql_query($SQL);
				while ($linha = mysql_fetch_object($query)) {            
					$horas = $linha->Horas;
					$Tempo = $linha->Tempo;
					$Data = AMD2DMA($linha->dataa);
					$contatos = $linha->contatos;
					$class = "class=\"table-success\"";					
					if ($horas <= 7)
						$class = "class=\"table-warning\"";
					if ($horas <= 6)
						$class = "class=\"table-danger\"";

			?>
            <tr <?=$class;?> > 
            	<td><?=$Data?></td>
				<td><?=$contatos?></td>
				<td><?=$Tempo?></td>
            </tr>
            <?
				}
			?>            
            </tbody>
        </table>
    </div>

</body>
</html>