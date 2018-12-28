<?
	require ("../cabeca.php");		
	conn_InserirNaFilaRetaguarda($IdConsultor, $IdChamado);
	
	/*

	--- por retaguarda:	
	select r.nome, count(1)
	from  retaguarda_fila rf
		inner join usuario r on r.id_usuario = rf.Id_Retaguarda
	where r.area = 1 and r.ativo=1 and ic_status = 2 
	group by r.nome
	order by count(1) desc
	
	
	--- por pedido	
	select u.nome, count(1)
	from  retaguarda_fila rf
		inner join usuario u on u.id_usuario = rf.Id_Consultor	
	where u.area = 1 and u.ativo=1 and ic_status = 2 
	group by u.nome
	order by count(1) desc
	*/
?>