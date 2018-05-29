<?

class Programa
{
	var $Id;
	var $id_chamado;
	var $id_usuario;
	var $dt_DataCriacao;
	var $nm_nome;
	var $ic_commit;
	var $dt_commit;
	var $id_usuario_commit;
	var $ds_obs;
	var $ds_versao;
	var $Responsavel;
}

class ChamadoProgramas
{
	var $Programas = array();
	var $id_chamado;
	
	function __construct($pId_chamado)
	{
		$this->id_chamado = $pId_chamado;		
		$this->CarregarProgramas();		
	}
	
	function estaTudoComitado() 	
	{
		$array = $this->Programas;		
		foreach ($array as $item)		
			if ($item->ic_commit == 0)
			{
				$ok = 0;
				return 0;
			}
		
		return 1;	
	}
	
	function obterProgramasSemCommit()
	{
		$lista = array();
		foreach($this->Programas as $item)
		{
			if ($item->ic_commit == 0)			
			{
				array_push($lista, $item);
			}
		}
		return $lista;
	}
	
	function CarregarProgramas()
	{	
		$c=0;
		$sql = "select cp.*, u.nome
from chamado_programas cp
inner join usuario u on u.id_usuario = cp.id_usuario
where ic_ativo <> 0 and id_chamado = " . $this->id_chamado . " order by Id";
		$query = mysql_query($sql) or die (mysql_error());
		while ($linha = mysql_fetch_object($query))
		{
			$this->PopularUmPrograma($linha);
		}			
	}
	
	function PopularUmPrograma($linha)
	{
		$programa = new Programa();
		$programa->Id = $linha->Id;
		$programa->id_chamado = $linha->id_chamado;
		$programa->id_usuario = $linha->id_usuario;
		$programa->dt_DataCriacao = $linha->dt_DataCriacao;
		$programa->nm_nome = $linha->nm_nome;
		$programa->ic_commit = $linha->ic_commit;
		$programa->dt_commit = $linha->dt_commit;
		$programa->id_usuario_commit = $linha->id_usuario_commit;
		$programa->ds_obs = $linha->ds_obs;	
		$programa->Responsavel = $linha->nome;		
		$programa->ds_versao = $linha->ds_versao;
		array_push($this->Programas, $programa);
	}
}



?>
