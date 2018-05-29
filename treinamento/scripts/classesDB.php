<?

class DB{
	
	var $conexao = 0;
	
	function DB(){
		if (!$usuario)	$usuario	= $GLOBALS['user'];
		if (!$senha)	$senha		= $GLOBALS['pwd'];
		if (!$base)		$base		= 'treinamento';
		if (!$host)		$host		= $GLOBALS['host'];

		$this->conexao = mysql_connect($host, $usuario, $senha) or die(mysql_error());
		mysql_select_db($base) or die(mysql_error());
	}
	
	function getConceitos($pIDConceito){
		$Res	= array();
		$result	= mysql_query("select con_desc_administrador, con_desc_operador, con_desc_basico from treinamento.conceitos where con_id = " . $pIDConceito, $this->conexao);
		$linha	= mysql_fetch_object($result);
		$Res[0]	= 'Reprovado';
		$Res[1]	= $linha->con_desc_basico;
		$Res[2]	= $linha->con_desc_operador;
		$Res[3]	= $linha->con_desc_administrador;
		return $Res;
	}
	
	function getQuantidadeIP($pIP, $pTipo, $pCodProva=0){
		$result	= mysql_query("select count(ip) as tot_ips from treinamento.relacaoip ".
								"where ip = '$pIP'".
								" and date_format(data,'%Y%m%d') = date_format(now(),'%Y%m%d')".
								" and codProva = '$pCodProva'".
								" and tipo = '$pTipo'", $this->conexao);
		$linha	= mysql_fetch_object($result);
		if ($linha->tot_ips > 0){
			return true;
		}else{
			return false;
		}
	}

	function setIP($pIP, $pTipo, $pCodProva=0){
		mysql_query("INSERT into treinamento.relacaoip  (ip, tipo, codProva) ".
					" VALUES ".
					" ('$pIP', '$pTipo', '$pCodProva')", $this->conexao);
	}

	function comboBox($pSQL, $valor_atual, $nome, $apresenta_cod="", $selecione="", $parametros="", $bloqueio_array=''){
		// Irá utilizar as duas primeiras colunas, sendo ID, DESCRICAO sempre
		$Array = array();
		$result	= mysql_query($pSQL, $this->conexao);
		while ($linha = mysql_fetch_row($result)){
			$Array[$linha[0]] = $linha[1];
		}
		return fun_select($Array, $valor_atual, $nome, $apresenta_cod, $selecione, $parametros, $bloqueio_array);
	}
}

?>