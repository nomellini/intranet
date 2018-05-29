<?
	require("scripts/conn.php");	   		
	if ($id_restricao) {
		foreach($id_restricao as $IdRestricao)
		{
			$sql = "insert into rl_restricao_chamado (Id_Restricao, Id_Chamado) values ($IdRestricao, $id_chamado)";
			mysql_query($sql);
			echo "$sql <br>";
		}
	}	
    header( 'Location: historicochamado.php?&id_chamado='.$id_chamado ) ;
?>