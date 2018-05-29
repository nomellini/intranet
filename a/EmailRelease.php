<?php

	require("scripts/conn.php");

	error_reporting(0);		    

	$sql="select distinct 
  c.id id_conjunto,
  u.id_usuario,
  s.sistema, 
  t.nome tarefa, 
  u.nome, 
  u.email, 
  c.Dt_UltimoEmail 
from 
  i_conjunto c
    inner join sistema s on c.id_sistema = s.id_sistema
    inner join i_tarefas t on t.id = c.Id_Next
    inner join i_tarefapessoa tp on tp.id_tarefa = c.Id_Next
    inner join usuario u on u.id_usuario = tp.id_usuario
where 
      (
        
          (
             (date(now()) = date(Dt_UltimoEmail))
             and
             (TIMESTAMPDIFF(HOUR, Dt_UltimoEmail, now()) >= 2)
          )
          or
          ( 
            date(now()) <> date(Dt_UltimoEmail) 
          ) 
      )
	  and ok = 0";
	  
	  $result = mysql_query($sql) or die (mysql_error() . " - " . $Sql);

	$Dt_UltimoEmail = date("Y-m-d H:i:s");
	while ($linha = mysql_fetch_object($result))
	{
		$id_usuario = $linha->id_usuario;
		//if ($id_usuario == 12)
		
		{
		
			$id_conjunto = $linha->id_conjunto;
			$Sistama = $linha->sistema;
			$Tarefa = $linha->tarefa;
			$Nome = $linha->nome;
			$Email = $linha->email;
			$DtUltimoEmail = $linha->Dt_UltimoEmail;
			
			$Corpo = "$Nome, voce deve fazer sua tarefa no release '$Tarefa' do sistema <b>$Sistama</b>";			
			
			mail2($Email, "Release pendente", $Corpo, "");						
			
			$Sql = "update i_conjunto set Dt_UltimoEmail = '$Dt_UltimoEmail' where id = $id_conjunto";
			mysql_query($Sql) or die(mysql_error() . " - " . $Sql);  
			
			  
		}
	}
	
?>