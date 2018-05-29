<?
  require("../scripts/conn.php");
  if (($u) and ($t)) {
    $sql = "delete from i_tarefapessoa where id_usuario=$u and id_tarefa=$t";
	mysql_query( $sql);
  }
?>
<html><title>Tarefas Release</title>
<body>
 <form id="form1" name="form1" method="post" action="addTarefaPessoa.php">
<p>Lista de tarefas / Usuarios por tarefa<br />
Adicionar:<br />
  <label>Tarefa
      <select name="tarefa" id="tarefa">
	  
	  <?
	      $Tarefas = 'select * from i_tarefas order by ordem';
          $tresult = mysql_query($Tarefas);
          while ($tarefa=mysql_fetch_object($tresult)) {
		  
	  ?>
        <option value="<?=$tarefa->id?>"><?=$tarefa->nome?></option>
	  <?
	   }
	  ?>
      </select>

  </label>
  <label>Pessoa
  <select name="pessoa" id="pessoa">
	  <?
	      $Tarefas = 'select * from usuario order by nome';
          $tresult = mysql_query($Tarefas);
          while ($tarefa=mysql_fetch_object($tresult)) {
		  
	  ?>
        <option value="<?=$tarefa->id_usuario?>"><?=$tarefa->nome?></option>
	  <?
	   }
	  ?>
  </select>
  </label>
  <label>Add
  <input type="submit" name="Submit" value="Submit" />
  </label>
</p>
	  </form> 
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#003366">
  <tr>
    <td width="20%" bgcolor="#FFFFFF"><strong>Tarefa</strong></td>
    <td width="80%" bgcolor="#FFFFFF"><strong>Usuarios</strong></td>
  </tr>
  <?
    $Tarefas = 'select * from i_tarefas order by ordem';
    $tresult = mysql_query($Tarefas);
    while ($tarefa=mysql_fetch_object($tresult)) {
	  $id = $tarefa->id;
	  $Usuarios = "select distinct
	  	usuario.nome, 
		usuario.email, 
		usuario.login, 
		usuario.id_usuario 
	from 
		usuario 
			inner join i_tarefapessoa on usuario.id_usuario = i_tarefapessoa.id_usuario 
	where 
	    usuario.ativo = 1 and 
		i_tarefapessoa.id_tarefa = $id 
	order by nome";
	  $uResult = mysql_query($Usuarios);
	  $u = "";
	  while ($usuario=mysql_fetch_object($uResult)) {
	    $u .= "<a href=\"tarefas.php?t=$id&u=$usuario->id_usuario\">$usuario->nome</a> $usuario->email ($usuario->login)<br>";
	  }
  ?>
  <tr>
    <td height="20" bgcolor="#FFFFFF"><?= "$tarefa->id. $tarefa->nome"?>
      <br />

        <label></label>
     
        <label></label>
    <br />    </td>
    <td bgcolor="#FFFFFF"><?= $u?></td>
  </tr>
  <?
  }
  ?>
</table>
<p>
  <input name="id_tarefa" type="hidden" id="id_tarefa" />
  <input name="id_usuario" type="hidden" id="id_usuario" />
</p>

</body>


</html>
