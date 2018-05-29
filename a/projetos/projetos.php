<?


	abstract class ProjetoAbstractClass {
		abstract function obterQuantidadeChamados();
		abstract function obterPercentualCompletado();
		abstract function addChamado($Id_chamado);
	}


	class Projeto extends ProjetoAbstractClass {
		
		private $Id_chamado;
		private $Id_area;
		private $Id_status_projeto;
		private $Dt_inicio;
		private $Dt_fim;
		private $Id_dias_projeto;
		
		private $Projeto_itens = array();
		
		private $Quantidade ;
		
		public function __construct($Id_chamado) {
			$this->Id_chamado = $Id_chamado;
		}
		
		function obterQuantidadeChamados()
		{			
		}
		
		function obterPercentualCompletado()
		{
			return 0;
		}
		
		function addChamado($Id_chamado)
		{			
			$this->Projeto_itens;
		}
		
		
				
	}
	
	class ProjetoItem extends ProjetoAbstractClass {
		
		private $Id_chamado;
		
		function __construct($Id_chamado) {
			$this->Id_chamado = $Id_chamado;
		}
		
		function obterQuantidadeChamados()
		{
			return 1;
		}
		
		function obterPercentualCompletado()
		{
			return 0;
		}
		
		function addChamado($Id_chamado)
		{
			return FALSE;
		}
		
	}
	

	$projeto = new Projeto(1);
	$Item = new ProjetoItem(2);
	$projeto->addChamado(3);


?>