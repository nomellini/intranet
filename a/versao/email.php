<?php
    require("../scripts/conn.php");
	if ( isset($id_usuario) ) {
		$ok = verificasenha($cookieEmailUsuario, $cookieSenhamd5 );	  
		if ($ok<>$id_usuario) { header("Location: index.php"); }
		$nomeusuario=peganomeusuario($ok);	
		setcookie("loginok");  
	} else {
		header("Location: index.php");
	}
	
	$sql="select 
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
             (TIMESTAMPDIFF(HOUR, Dt_UltimoEmail, now()) > 0)
          )
          or
          ( 
            date(now()) <> date(Dt_UltimoEmail) 
          ) 
      )
      and 
      ok = 0";
	  
	  $result = mysql_query($sql);
	  
	  while ($linha = mysql_fetch_object($result))
	  {
		  $id_usuario = $linha->id_usuario;
		  //if ($id_usuario == 12)
		  {
			  
			  $Sistama = $linha->sistema;
			  $Tarefa = $linha->tarefa;
			  $Nome = $linha->nome;
			  $Email = $linha->email;
			  $DtUltimoEmail = $linha->Dt_UltimoEmail;
			  
			  $Corpo = "$Nome, voce deve fazer sua tarefa no release '$Tarefa' do sistema <b>$Sistama</b>";
			  //echo $Corpo;
			  
			  mail2($Email, "Release pendente", $Corpo, "");
			  			  
		  }
	  }

?>