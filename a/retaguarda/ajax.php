<?PHP
$data = 'nomellini';

$array = array('nomellini', 120);

header('Content-Type: application/json');
echo json_encode(
	array(
		array('Consultor', 'Pedidos'),
		array('nomellini', 120),		
		array('pamela', 220),		
		array('Carla', 2)
	)
);
?>