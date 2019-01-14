<?
//Autor: Lucas Oliveira Silva
//Data: 02/10/09
//Local: Datamace
//Fun�ao: inicializa vari�veis, carrega fun�oes, verifica usu�rio...

error_reporting (E_ALL ^ E_NOTICE ) ;

session_start();

require_once("../a/scripts/conn.php");


mysql_select_db(sad);
if ($v_id_usuario) $USRNOME = peganomeusuario($v_id_usuario);
mysql_select_db(treinamento);

$USER_EXTERNAL = ""; //No caso de usu�rio externo, nao consigo pegar o IP de cada m�quina sempre. As vezes vem somente o IP do servidor. isto depende da estrutura do servidor.
if ($_SERVER['SERVER_NAME'] == "intranet.datamace.com.br")
{
	if ($ExternoPermitido != "S")
	{
		include_once("externoDtm.php");
		die();
	}
	if(!isset($_COOKIE['cooUsuarioExterno']))
	{
		$_COOKIE['cooUsuarioExterno'] = uniqid("DTM");
		setcookie('cooUsuarioExterno', $_COOKIE['cooUsuarioExterno'], strtotime("tomorrow"));
	}
	$USER_EXTERNAL = "-" . $_COOKIE['cooUsuarioExterno'];
}

if (!$ipremoto)
{
	$ipremoto = $_SERVER["REMOTE_ADDR"] . $USER_EXTERNAL;
}

if (!$PAGINA) $PAGINA = substr($_SERVER["PHP_SELF"],strrpos($_SERVER["PHP_SELF"],'/')+1);

define('FPDF_FONTPATH','font/');
require_once('../fpdf/rel_pdf_dtm.php');

define('COMBOANOINI',2005);
define('COMBOANOFIM',2020);

define('FORMULARIO_10', verFormulario('F10'));
define('FORMULARIO_15', verFormulario('F15'));
define('FORMULARIO_16', verFormulario('F16'));
define('FORMULARIO_29', verFormulario('F29'));
define('FORMULARIO_71', verFormulario('F71'));

$diasemana[1] = "Segunda-feira";
$diasemana[2] = "Ter�a-feira";
$diasemana[3] = "Quarta-feira";
$diasemana[4] = "Quinta-feira";
$diasemana[5] = "Sexta-feira";
$diasemana[6] = "S�bado";
$diasemana[0] = "Domingo";

$mesescrito[1] = "Janeiro";
$mesescrito[2] = "Fevereiro";
$mesescrito[3] = "Mar�o";
$mesescrito[4] = "Abril";
$mesescrito[5] = "Maio";
$mesescrito[6] = "Junho";
$mesescrito[7] = "Julho";
$mesescrito[8] = "Agosto";
$mesescrito[9] = "Setembro";
$mesescrito[10] = "Outubro";
$mesescrito[11] = "Novembro";
$mesescrito[12] = "Dezembro";

$aConceitoAval['1'] = '�TIMO';
$aConceitoAval['2'] = 'BOM';
$aConceitoAval['3'] = 'REGULAR';
$aConceitoAval['4'] = 'RUIM';
$aConceitoAval['5'] = 'NAO SE APLICA';

$Provanro['1'] = 'Primeira';
$Provanro['2'] = 'Segunda';

$aSN		= array();
$aSN['S']	= 'Sim';
$aSN['N']	= 'Nao';

$aConceito		= array();
$aConceito[0]	= 'Reprovado';
$aConceito[1]	= 'B�sico';
$aConceito[2]	= 'Operador';
$aConceito[3]	= 'Adm';

$aConceitoDesc		= array();
$aConceitoDesc[0]	= 'Nao pode operar o sistema';
$aConceitoDesc[1]	= 'Conhecimentos b�sicos para opera�ao do sistema';
$aConceitoDesc[2]	= 'Operador do sistema';
$aConceitoDesc[3]	= 'Administrador do sistema';

$aLinDes = array();
$aLinDes['a1'] = "POSTURA";
$aLinDes['b1'] = "DOM�NIO DO ASSUNTO";;
$aLinDes['c1'] = "CLAREZA NA EXPOSI�AO";;
$aLinDes['d1'] = "ESCLARECIMENTO DE D�VIDAS";;
$aLinDes['a2'] = "MATERIAL DID�TICO";;
$aLinDes['a3'] = "SALA";;
$aLinDes['b3'] = "RECURSO AUDIOVISUAIS";;
$aLinDes['c3'] = "ATENDIMENTO";;
$aLinDes['a4'] = "GERAL";;

$aStatusTreino		= array();
$aStatusTreino['']	= "";
$aStatusTreino['1']	= "APROVADO";
$aStatusTreino['2']	= "REPROVADO";
$aStatusTreino['3']	= "NAO SE APLICA";

$aSiglaEstado = array();
$aSiglaEstado['AC'] = "AC";
$aSiglaEstado['AL'] = "AL";
$aSiglaEstado['AM'] = "AM";
$aSiglaEstado['AP'] = "AP";
$aSiglaEstado['BA'] = "BA";
$aSiglaEstado['CE'] = "CE";
$aSiglaEstado['DF'] = "DF";
$aSiglaEstado['ES'] = "ES";
$aSiglaEstado['GO'] = "GO";
$aSiglaEstado['MA'] = "MA";
$aSiglaEstado['MG'] = "MG";
$aSiglaEstado['MS'] = "MS";
$aSiglaEstado['MT'] = "MT";
$aSiglaEstado['PA'] = "PA";
$aSiglaEstado['PB'] = "PB";
$aSiglaEstado['PE'] = "PE";
$aSiglaEstado['PI'] = "PI";
$aSiglaEstado['PR'] = "PR";
$aSiglaEstado['RJ'] = "RJ";
$aSiglaEstado['RN'] = "RN";
$aSiglaEstado['RO'] = "RO";
$aSiglaEstado['RR'] = "RR";
$aSiglaEstado['RS'] = "RS";
$aSiglaEstado['SC'] = "SC";
$aSiglaEstado['SE'] = "SE";
$aSiglaEstado['SP'] = "SP";
$aSiglaEstado['TO'] = "TO";


$aTreinoTipo		= array();
$aTreinoTipo[0]		= 'Todos';
$aTreinoTipo[1]		= 'Interno';
$aTreinoTipo[2]		= 'Cliente Externo';
$aTreinoTipo[3]		= 'Treinamento Externo';

$aProvaTipo		= array();
$aProvaTipo[0]	= 'Todos';
$aProvaTipo[1]	= 'Interno - Datamace';
$aProvaTipo[2]	= 'Interno - Cliente';
$aProvaTipo[3]	= 'Externo - Cliente';

if ($ACESSO){
	include_once("veracesso.php");
}

if (isset($_POST)) {
	while(list($var,$val) = each($_POST)) {
		$$var = $val;
	}
}
if (isset($_GET)) {
	while(list($var,$val) = each($_GET)) {
		$$var = $val;
	}
}
if (isset($_SESSION)) {
	while(list($var,$val) = each($_SESSION)) {
		$$var = $val;
	}
}
if (isset($_COOKIE)) {
	while(list($var,$val) = each($_COOKIE)) {
		$$var = $val;
	}
}

if (!$ano) $ano = date('Y');
if (!$mes) $mes = date('n');
if (!$dia) $dia = date('d');
if (!$hoje) $hoje = date("d/m/Y");

if ((!$linkPagina) || ($linkPagina == $PAGINA)) $linkPagina = "treinamento.php";

function fun_autocomplete($opcao){
	include('autocomplete.php');
}

function ver_ereg($texto){
	echo "O texto :<BR>";
	echo (ereg("a", $texto) ? "tem ao menos uma letra a minúscula" :
	"nao tem nenhuma letra a minúscula") . "<BR>";
	echo (ereg("^a", $texto) ? "" : "nao ") . "inicia com a letra a <BR>";
	echo (ereg("a$", $texto) ? "" : "nao ") . "termina com a letra a<BR>";
	echo (eregi("php", $texto) ? "" : "nao ") .
	"inicia com as letras php, maiúsculas ou minúsculas<BR>";
	echo (eregi("^php", $texto) ? "" : "nao ") .
	"inicia com as letras php, maiúsculas ou minúsculas<BR>";
	echo (ereg("^[0-9]", $texto) ? "" : "nao ") . " inicia com um n�mero <BR>";
	echo (ereg("^[a-g]", $texto) ? "" : "nao ") .
	" inicia com uma letra entre 'a' e 'g' minúscula<BR>";
	echo (eregi("^[a-g]", $texto) ? "" : "nao ") .
	" inicia com uma letra entre 'a' e 'g' , maiúscula ou minúscula<BR>";
	echo (ereg("^[a-gA-G]", $texto) ? "" : "nao ") .
	" inicia com uma letra entre 'a' e 'g' , maiúscula ou minúscula<BR>";
	echo (ereg("^[0-9]$", $texto) ? "" : "nao ") .
	" é um número de 1 dígito apenas<BR>";
	echo (ereg("^[0-9][0-9]$", $texto) ? "" : "nao ") .
	" é um número de 2 dígitos apenas<BR>";
	echo (ereg("^[0-9]+$", $texto) ? "" : "nao ") .
	" é um número com pelo menos 1 dígito<BR>";
	echo (ereg("^[0-9]{4}$", $texto) ? "" : "nao ") .
	" é um número com exatamente 4 dígitos<BR>";
	echo (ereg("^[0-9a-zA-Z]{6}$", $texto) ? "" : "nao ") .
	" se compoe de exatamente 6 números e letras (nao se aceitam s�mbolos ou
	pontua�oes)<BR>";

	echo "<BR><BR>O texto :<BR>";
	echo (ereg("a+b+", $texto) ? "" : "nao ")
	. "tem um ou mais 'a' seguido por um ou mais 'b'<BR>";
	echo (ereg("a+b*c+", $texto) ? "" : "nao ")
	. "tem um ou mais 'a' seguido por zero ou mais 'b' seguido por um ou mais 'c'<BR>";
	echo (ereg("a+b?c+", $texto) ? "" : "nao ")
	. "tem um ou mais 'a' seguido por zero ou um 'b' seguido por um ou mais 'c'<BR>";
	echo (ereg("^a+b?c+", $texto) ? "" : "nao ")
	. "inicia com um ou mais 'a' seguido por zero ou um 'b' seguido por um ou mais 'c'<BR>";
	echo (ereg("a+b{3}c+$", $texto) ? "" : "nao ")
	. "finaliza com um ou mais 'a' seguido por exatamente tres 'b' seguido por um ou mais 'c'<BR>";
	echo (ereg("^a+b{4,6}c+", $texto) ? "" : "nao ")
	. "inicia com um ou mais 'a' seguido por quatro a seis 'b' seguido por um ou mais 'c'<BR>";
	echo (ereg("^a+b{3,}c+", $texto) ? "" : "nao ")
	. "inicia com um ou mais 'a' seguido por tres ou mais 'b' seguido por um ou mais 'c'<BR>";
	echo (ereg("^a+(php){3,}c+", $texto) ? "" : "nao ")
	. "inicia com um ou mais 'a' seguido por tres ou mais 'php' seguido por um ou mais 'c'<BR>";
	echo (eregi("^[a-z0-9]+@[a-z0-9]*$", $texto) ? "" : "nao ")
	. "inicia com um ou mais caracteres seguido por um '@' seguido por zero ou mais caracteres<BR>";
	echo (eregi("^[a-z0-9]+@(php|perl)$", $texto) ? "" : "nao ")
	. "inicia com um ou mais caracteres seguido por um '@' seguido por 'php' ou 'perl'<BR>";
	echo (eregi("f.w", $texto) ? "" : "nao ")
	. "tem um 'f' seguido por um caracter qualquer seguido por um 'w'<BR>";


	echo "<BR><BR>O texto :<BR>";
	echo (ereg("^[0-9]+$", $texto) ? "" : "nao ")
	. "é um número sem casas decimais<BR>";
	echo (ereg("^[0-9]+,[0-9]{2}$", $texto) ? "" : "nao ")
	. "é um número com duas casas decimais (separadas por vírgula)<BR>";
	echo (ereg("^[0-9]+(,[0-9]+)?$", $texto) ? "" : "nao ")
	. "é um número com ou sem casas decimais (separadas por vírgula)<BR>";
	echo (ereg("^[0-9]{1,3}\.[0-9]{3}(,[0-9]+)?$", $texto) ? "" : "nao ")
	. "é um número maior ou igual a 1.000 e menor que 999.999 com separador de milhares (ponto) com ou sem casas decimais (separadas por vírgula)<BR>";
	echo (ereg("^[0-9]{1,3}(\.[0-9]{3})*(,[0-9]+)?$", $texto) ? "" : "nao ")
	. "é um número qualquer com separador de milhares (ponto) caso seja maior ou igual a 1000 com ou sem casas decimais (separadas por vírgula)<BR>";
	echo (ereg("^[0-9]{1,3}(\.?[0-9]{3})*(,[0-9]+)?$", $texto) ? "" : "nao ")
	. "é um número qualquer com ou sem separador de milhares (ponto) caso seja maior ou igual a 1000 com ou sem casas decimais (separadas por vírgula)<BR>";
	echo (eregi("^[_\-\.0-9a-z]+@[_\-\.0-9a-z]+$", $texto) ? "" : "nao ")
	. "é um e-mail válido (aceita letras, números, '_', '-' e '\.'<BR>";
	echo (ereg("^[0-9]{2}\.[0-9]{3}\.[0-9]{3}/[0-9]{4}\-[0-9]{2}$", $texto) ? "" : "nao ")
	. "é um CNPJ válido (exemplo: 12.345.678/0001-95 (dígito verificador nao calculado)<BR>";
	echo (ereg("^([0-9]{3}\.){2}[0-9]{3}-[0-9]{2}$", $texto) ? "" : "nao ")
	. "é um CPF válido (exemplo: 123.456.789-09 (dígito verificador nao calculado)<BR>";

	echo "<br><br>O texto :<br>";
	echo (ereg("^[0-9]{2}/[0-9]{2}/[0-9]{4}", $texto, $regs) ? "" : "nao ")
	. "é uma data no formato DD-MM-AAAA<br>";
	var_dump($regs);
	echo "<br>";
	echo (ereg("^([0-9]{2})/([0-9]{2})/([0-9]{4})", $texto, $regs) ? "" : "nao ")
	. "é uma data no formato DD-MM-AAAA<br>";
	var_dump($regs);
	echo "<br>";
	echo "este é o texto acima com as vírgulas substituídas por pontos:<br>";
	echo ereg_replace("," , "." , $texto) . "<br>";
	echo "este é o texto acima com os pontos substituidos por vírgulas:<br>";
	echo ereg_replace("\." , "," , $texto) . "<br>";
	echo "este é o texto acima com os pontos substituidos por vírgulas e vice versa:";
	echo "(isto é útil para converter números em formato 'ingles' para 'latino'<br>";
	echo ereg_replace("@@p@@", "," , ereg_replace("," , "." , ereg_replace("\." , "@@p@@" , $texto))) . "<br>";
	echo "Se o que foi digitado acima tratar-se de um diretório (dividido por /), ele � dividido assim:<br>";
	$regs = split ("/", $texto);
	var_dump($regs);
	echo "<br>";

}

function resolveData($pData,$pModelo='N'){
	switch($pModelo){
		case 'N':
			$pData = explode('/',$pData);
			return $pData[2].'-'.$pData[1].'-'.$pData[0];
			break;
	}
}

function validateMail($mail) {
	if($mail !== "") {
		if(ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$", $mail)) {
			return true;
		} else {
			return false;
		}
	}else{
		return false;
	}
}

function montaWhere($condicoes){
	$where = "";
	$condicoes = array_map('trim',$condicoes);
	for($x=0; $x<=count($condicoes); $x++){
		if ($condicoes[$x]){
			if ($where){
				$where .= " and " . $condicoes[$x];
			}else{
				$where .= " where " . $condicoes[$x];
			}
		}
	}
	return $where;
}

function unhtmlentities ($string) {
	$trans_tbl = get_html_translation_table (HTML_ENTITIES);
	$trans_tbl = array_flip ($trans_tbl);
	return strtr ($string, $trans_tbl);
}

function Strip($value){
	if(get_magic_quotes_gpc() != 0){
    	if(is_array($value)){
			if ( array_is_associative($value)){
				foreach( $value as $k=>$v)
					$tmp_val[$k] = stripslashes($v);
				$value = $tmp_val;
			}else{
				for($j = 0; $j < sizeof($value); $j++)
        			$value[$j] = stripslashes($value[$j]);
			}
		}else{
			$value = stripslashes($value);
		}
	}
	return $value;
}

function fun_select($valores_array,$valor_atual,$nome,$apresenta_cod="",$selecione="",$parametros="",$bloqueio_array=''){
	// Esta fun�ao tamb�m � utilizada na classe DB
	// Autor : Lucas Oliveira Silva
	// Data  : 27-10-2009
	// Funcao: Passando uma array de valores, ele retorna um select na tela, assim, facilita a programa�ao e centraliza as informa�oes
	if (!$valores_array) return false;
	$valores_array = array_map('trim', $valores_array);

	if (!$bloqueio_array){
		$bloq			= '';
		$bloqueio_array = array('');
	}else{
		$bloq			= 'S';
		$bloqueio_array = array_map('trim', $bloqueio_array);
	}

	$selected[$valor_atual] = "selected";
	$ret = "<select name='$nome' id='$nome' ".(($parametros) ? $parametros : "").">";
	if ($selecione){
		$ret .= "<option value='' ".$selected[''].">".(($selecione == "S") ? "Selecione" : $selecione) . "</option>";
	}
	while (list($var,$val) = each($valores_array)){
		if ((!$bloq) || (in_array($var,$bloqueio_array))){
			$ret .= "<option value='$var' ".$selected[$var].">".(($apresenta_cod && $var) ? $var . " - " : "").$val."</option>";
		}
	}
	$ret .= "</select>";
	echo $ret;
}

function verFormulario($pFormulario)
{
	$vRevisao = "$pFormulario - ";
	$result			= mysql_query("select concat('Rev: ', right(concat('0',cast(rf_revisao as char(2))), 2)) as rf_revisao from revisao_formulario where rf_id = '$pFormulario'");
	if (mysql_num_rows($result) > 0)
	{
		$linha		= mysql_fetch_object($result);
		$vRevisao	.= $linha->rf_revisao;
	}
	return $vRevisao;
}

function fun_CriaHidden($L_var,$L_val=''){
	$VValor = (($L_val) ? (($L_val != 'N') ? $L_val : '') : $GLOBALS[$L_var]);
	echo "<input type='hidden' name='$L_var' id='$L_var' value='$VValor'>";
}

function fun_checkbox($valores_array,$valor_atual,$nome,$sufixo,$apresenta_cod="",$qtd_col="0",$valor_bloqueio,$parametros=""){
	// Autor : Lucas Oliveira Silva
	// Data   : 17-06-2010
	// Funcao : Passando uma array de valores, ele retorna inputs tipo check na tela, assim, facilita a programa�ao e centraliza as informa�oes
	if (!$valores_array) return false;

	if (!$valor_atual) $valor_atual = array('');
	$valor_atual = array_map('trim', $valor_atual);

	if (!$valor_bloqueio) $valor_bloqueio = array('');
	$valor_bloqueio = array_map('trim', $valor_bloqueio);

	$x = 0;
	$y = 0;
	$ret = '<table width="100%">';
	while (list($var,$val) = each($valores_array)){
		if (!$y++){
			$ret .= '<tr><td>';
		}else{
			$ret .= '</td><td>';
		}
		$z++;
		$ret .= "<input name='$nome"."[]' id='$nome' type='checkbox' " . (($valor_bloqueio[$x]) ? " disabled" : "") . " value='$var' ".((in_array($var,$valor_atual)) ? "checked" : "")."> ".(($apresenta_cod && $var) ? $var . " - " : "").$val;
		$x++;
		if ($y == $qtd_col){
			$y = 0;
			$ret .= '</td></tr>';
		}
	}
	if ($y) $ret .= '</td></tr>';
	$ret .= '</table>';

	return $ret;
}

include_once("scripts/classesDB.php");

class treinamento {
	// Autor: Lucas Oliveira Silva
	// Data: 14/04/2010
	// Local: Datamace
	// Fun�ao: verifica a pontua�ao na prova e outras "questoes"

	// utiliza�ao:
	// $prova = new treinamento("");
	// echo '<br>Nota: ' . $prova->verifica_nota(3177);

	// $prova = new treinamento("");
	// $prova->materia = 1;
	// $prova->mes = 03;
	// $prova->ano = 2011;
	// $prova->ver_data()
	// echo '<br>Data 1: ' . $prova->data1;
	// echo '<br>Data 2: ' . $prova->data2;

	// $prova = new treinamento("");
	// $prova->materia = 1;
	// $prova->mes = 03;
	// $prova->ano = 2011;
	// $prova->ver_pergunta()
	// echo '<br>Perguntas 1: ' . $prova->perguntas1;
	// echo '<br>Perguntas 2: ' . $prova->perguntas2;

	// pega a referencia atual para consulta de prova ou data
	// RefAtual()

	// $prova = new treinamento("");
	// $prova->rg = 4691061;
	// $prova->materia = 1;
	// $prova->mes = 03;
	// $prova->ano = 2011;
	// $prova->ver_resultados()
	// $this->id_prova_1;
	// $this->id_prova_2;
	// echo '<br>Prova 1: ' . $prova->qtd_acertos_1;
	// echo '<br>Prova 2: ' . $prova->qtd_acertos_2;

	// $prova->tipo		= 1;
	//$prova->ver_nota_ult_rg(305431286)
	// echo '<br>Nota: ' . $prova->qtd_acertos;
	// echo '<br>Qtd. Perguntas: ' . $prova->qtd_perguntas;
	// echo '<br>Aproveitamento: ' . $prova->aproveitamento;

	var	$db						= 0;

	var $tipo					= 2; // 2 -> Externa  1 -> interna

	var $materia				= 0; // Mat�ria / C�digo da prova (GIP/PE/DP/...)
	var $mes					= 0; // mes para consulta de data
	var $ano					= 0; // ano para consulta de data
	var $dataAnoComp			= true; // ano com 4 casas?
	var $data1					= 0; // 1o data
	var $data2					= 0; // 2o data

	var $prova_desc				= ''; // desci�ao / t�tulo da prova
	var $perguntas1				= array(); // 1o�s pergunta's
	var $perguntas2				= array(); // 2o�s pergunta's

	var $data1_f				= 0; // 1o data formatada
	var $data2_f				= 0; // 2o data formatada
	var $qtd_acertos_1			= 0; // Resultado da 1o prova
	var $qtd_acertos_2			= 0; // Resultado da 2o prova
	var $con_prova_1			= 0; // conceito da 1o prova
	var $con_prova_2			= 0; // conceito da 2o prova
	var $con_geral				= 0; // conceito geral
	var $id_prova_1				= 0; // identificador da prova
	var $id_prova_2				= 0; // identificador da prova
	var $aproveitamento1		= 0; // aproveitamento real 1
	var $aproveitamento2		= 0; // aproveitamento real 1
	var $obs					= '&nbsp;'; //Observa�ao
	var $obsNull				= '&nbsp;'; //Observa�ao

	var $nome					= ''; // nome da pessoa que realizou a prova
	var $rg						= 0; // rg da pessoa que realizou a prova
	var $qtd_acertos			= 0; // resultado da nota
	var $qtd_perguntas			= 0; // resultado da quantidade de pergunta
	var $aproveitamento			= 0; // aproveitamento em %
	var $aproveitamentoReal		= 0; // aproveitamento real

	var $avaliacaoLiberada		= false;
	var $avaliacaoTipo			= '';
	var $avaliacaoTipoEvento	= '';
	var $avaliacaoEvento		= '';
	var $avaliacaoInstrutor		= '';
	var $avaliacaoLocal			= '';

	var $IsAdm				= false;

	function treinamento($IsAdm){ // tem que ser o mesmo nome para ser carregada na cria�ao da classe

		$this->IsAdm = (($IsAdm == "S") ? true : false);
		$this->db = new DB();

		$this->qtd_acertos	= 0;
	}

	private function verWhereTipo($pPRE){

		if (in_array($this->tipo,array(1,2,3))){
			return " " . $pPRE . " flagTipo = '$this->tipo'";
		}else{
			return '';
		}

	}

	function verifica_nota($pCodProva){

		$this->qtd_acertos = 0;
		if (!$pCodProva) return 0;

		$sql = "select rg, perg, resp from respostas where id = ".$pCodProva;
		$result			= mysql_query($sql /*, $this->db->conexao*/);
		if ($linha		= mysql_fetch_object($result)){
			$perguntas	= explode('#',$linha->perg);
			$respostas	= explode('#',$linha->resp);

			$this->ver_treinando($linha->rg);

			$this->qtd_perguntas	= count($perguntas);

			for ($x=0; $x<$this->qtd_perguntas; $x++){
				if ($this->ver_resp($perguntas[$x]) == $respostas[$x]){
					$this->qtd_acertos++;
				}
			}
		}

		$this->aproveitamento = 0;
		if ($this->qtd_perguntas){
			$this->aproveitamentoReal = ($this->qtd_acertos / $this->qtd_perguntas) * 100;
			$this->aproveitamento = number_format($this->aproveitamentoReal,2,',','.');
		}

		return $this->qtd_acertos;
	}

	function ver_nota_ult_rg($rg){

		$sql = "select id from respostas where rg = '$rg' ".$this->verWhereTipo("and")." order by id desc limit 1";
		if ($result	= mysql_query($sql) /*,$this->db->conexao) */ ){
			if ($linha	= mysql_fetch_object($result)){
				return $this->verifica_nota($linha->id);
			}
		}
		return 0;
	}

	function verifica_conceitoID($pCodProva)
	{
		if ($pCodProva > 0){
			$result = mysql_query("select provas.conceito_id as conceito_id from respostas as Resp ".
									" left join provas on cod_prova = provas.id ".
									" where Resp.id = ".$pCodProva);
			$linha = mysql_fetch_object($result);
			return $linha->conceito_id;
		}
	}

	function verifica_conceitoValor($pCodProva, $pAproveitamento)
	{
		if ($pCodProva > 0){
			$result = mysql_query("select con_administrador, con_operador, con_basico from respostas as Resp ".
									" left join provas on cod_prova = provas.id ".
									" left join conceitos on provas.conceito_id = con_id ".
									" where Resp.id = ".$pCodProva);
			$linha = mysql_fetch_object($result);
			if ($pAproveitamento >= $linha->con_administrador){
				return 3;
			}else if ($pAproveitamento >= $linha->con_operador){
				return 2;
			}else if ($pAproveitamento >= $linha->con_basico){
				return 1;
			} else {
				return 0;
			}
		}
	}

	function ver_conceito_ult_rg($rg){

		$sql = "select id from respostas where rg = '$rg' ".$this->verWhereTipo("and")." order by id desc limit 1";
		if ($result	= mysql_query($sql /*,$this->db->conexao*/)){
			if ($linha	= mysql_fetch_object($result)){
				$this->verifica_nota($linha->id);
				return $this->verifica_conceitoValor($linha->id, $this->aproveitamentoReal);
			}
		}
		return 0;
	}

	function ver_resp($cod_pergunta){

		$sql		= "select resp from perguntas where id = ".$cod_pergunta;
		if ($result	= mysql_query($sql /*,$this->db->conexao*/)){
			if ($linha	= mysql_fetch_object($result)){
				return $linha->resp;
			}
		}
		return '';
	}

	function ver_treinando($rg){

		$sql		= "select rg, nome from cadastrotreinamento where rg = ".$rg;
		if ($result	= mysql_query($sql /*,$this->db->conexao*/)){
			if ($linha	= mysql_fetch_object($result)){
				$this->rg	= $linha->rg;
				$this->nome	= $linha->nome;
				return $linha->nome;
			}
		}
		return '';
	}

	function RefAtual(){
		$this->mes = date('m');
		$this->ano = date('o');
	}

	function ver_data(){

		$this->data1	= '';
		$this->data2	= '';

		if (!$this->materia || !$this->mes || !$this->ano){
			return false;
		}

		$Datas	= $this->sqlGetRespostas('dataprova', 'DATA1', 'DATA2', $this->rg);

		$this->data1	= $Datas->DATA1;
		$this->data2	= $Datas->DATA2;

		if ($this->data1){
			$data = explode('-', $this->data1);
			$this->data1_f	= $data[2] . '/' . $data[1] . '/' . (($this->dataAnoComp) ? $data[0] : substr($data[0],2,2));
		}else{
			$this->data1_f = '';
		}

		if ($this->data2){
			$data = explode('-', $this->data2);
			$this->data2_f	= $data[2] . '/' . $data[1] . '/' . (($this->dataAnoComp) ? $data[0] : substr($data[0],2,2));
		}else{
			$this->data2_f = '';
		}

	}

	function ver_pergunta(){

		$this->perguntas1	= array();
		$this->perguntas2	= array();

		if (!$this->materia || !$this->mes || !$this->ano){
			return false;
		}

		$result = mysql_query("select descricao from treino where cod_prova = " . $this->materia);
		$linha = mysql_fetch_object($result);
		$this->prova_desc = $linha->descricao;

		$Datas	= $this->sqlGetRespostas('perg', 'PERG1', 'PERG2', $this->rg);

		if (!$Datas->PERG1){
			$result				= mysql_query("select * from provas where id = " . $this->materia);
			$linha				= mysql_fetch_object($result);
			$this->prova_desc	= $linha->descricao;

			if ($linha->qtd_perguntas && (!$this->IsAdm)){
				$sSql	= "SELECT Q.id as id FROM perguntas as Q" .
							" left join provas as P on P.id = Q.sistema " .
							" WHERE P.id = " . $this->materia .
							" ORDER BY RAND() " .
							" LIMIT " . $linha->qtd_perguntas;

				$result				= mysql_query($sSql);
				while ($linha2 = mysql_fetch_object($result)){
					$this->perguntas1[] = $linha2->id;
				}
			}else{
				$this->perguntas1	= explode("#",$linha->cod_perguntas);
			}
			$this->perguntas2	= '';
		}else{
			$this->perguntas1	= explode("#", $Datas->PERG1);
			$this->perguntas2	= explode("#", $Datas->PERG2);
		}
	}

	function ver_resultados(){

		$this->qtd_acertos_1	= 0;
		$this->qtd_acertos_2	= 0;

		if (!$this->rg || !$this->materia || !$this->mes || !$this->ano){
			return false;
		}

		$sSQL = "SELECT";
		$sSQL .= "(SELECT id FROM respostas ";
		$sSQL .= "       where month(dataprova) = " . $this->mes;
		$sSQL .= "              and year(dataprova) = " . $this->ano;
		$sSQL .= "              and cod_prova = " . $this->materia;
		$sSQL .= "              and rg = " . $this->rg;
		$sSQL .= "              and provanro = 1";
		$sSQL .= $this->verWhereTipo("and");
		$sSQL .= "              order by dataprova ";
		$sSQL .= "              limit 1) as ID1,";
		$sSQL .= "(SELECT id FROM respostas ";
		$sSQL .= "       where month(dataprova) = " . $this->mes;
		$sSQL .= "              and year(dataprova) = " . $this->ano;
		$sSQL .= "              and cod_prova = " . $this->materia;
		$sSQL .= "              and rg = " . $this->rg;
		$sSQL .= "              and provanro = 2";
		$sSQL .= $this->verWhereTipo("and");
		$sSQL .= "              order by dataprova desc ";
		$sSQL .= "              limit 1) as ID2";
		$result	= mysql_query($sSQL /*,$this->db->conexao*/);
		$Datas	= mysql_fetch_object($result);

		$this->id_prova_1		= $Datas->ID1;
		$this->qtd_acertos_1	= $this->verifica_nota($Datas->ID1);
		$this->con_prova_1		= $this->verifica_conceitoValor($Datas->ID1, $this->aproveitamentoReal);
		$this->aproveitamento1	= $this->aproveitamentoReal;

		$this->id_prova_2		= $Datas->ID2;
		$this->qtd_acertos_2	= $this->verifica_nota($Datas->ID2);
		$this->con_prova_2		= $this->verifica_conceitoValor($Datas->ID2, $this->aproveitamentoReal);
		$this->aproveitamento2	= $this->aproveitamentoReal;

		$this->con_geral = ($this->con_prova_1 + $this->con_prova_2) / 2;

		if (!$this->qtd_acertos_1 || !$this->qtd_acertos_2) $this->obs = "Prova(s) nao realizada(s): ";
		if (!$this->qtd_acertos_1) $this->obs .= "1";
		if (!$this->qtd_acertos_1 && !$this->qtd_acertos_2) $this->obs .= ", ";
		if (!$this->qtd_acertos_2) $this->obs .= "2";

	}

	function sqlGetRespostas($pCol, $pVar1, $pVar2, $pRG=''){

		$sSQL = "SELECT";
		$sSQL .= "(SELECT #COL# FROM respostas ";
		$sSQL .= "       where month(dataprova) = " . $this->mes;
		$sSQL .= "              and year(dataprova) = " . $this->ano;
		$sSQL .= "              and cod_prova = " . $this->materia;
		$sSQL .= "              and provanro = 1 " . (($pRG) ? " and rg = $pRG " : "");
		$sSQL .= $this->verWhereTipo("and");
		$sSQL .= "              order by dataprova ";
		$sSQL .= "              limit 1) as #VAR1#,";
		$sSQL .= "(SELECT #COL# FROM respostas ";
		$sSQL .= "       where month(dataprova) = " . $this->mes;
		$sSQL .= "              and year(dataprova) = " . $this->ano;
		$sSQL .= "              and cod_prova = " . $this->materia;
		$sSQL .= $this->verWhereTipo("and");
		$sSQL .= "              and provanro = 2 " . (($pRG) ? " and rg = $pRG " : "");
		$sSQL .= "              order by dataprova desc ";
		$sSQL .= "              limit 1) as #VAR2#";

		$sSQL = str_replace(array('#COL#', '#VAR1#', '#VAR2#'), array($pCol, $pVar1, $pVar2), $sSQL);
		$return = mysql_query($sSQL /*,$this->db->conexao*/);

		return mysql_fetch_object($return);
	}

	function sqlProva($vTipoPesquisa, $pTipo = ""){ //P -> Provas, T -> Libera�ao do Treinamento
		return "select DISTINCTROW provas.id as id, provas.descricao as descricao, conf_tipo " .
				($vTipoPesquisa == 'P' ? ", config.conf_provanro as provanro " : " ") .
				" from provas " .
				"right join config on conf_provas like concat('%#',provas.id,'#%') " .
					"where date_format(conf_data,'%Y-%m-%d') = date_format(NOW(),'%Y-%m-%d') and " .
					"(date_format(NOW(),'%H%i') >= conf_hora_inicial and " .
					"date_format(NOW(),'%H%i') <= conf_hora_final) ".
					($pTipo ? " and conf_tipo = $pTipo" : "");
	}

	function resultProvaDisponivel($pTipo = ""){
		$SQL = $this->sqlProva('P', $pTipo);
		return mysql_query($SQL /*,$this->db->conexao*/);
	}

	function provaDisponivelDoTreinamento($pTipo = ""){
		$SQL = $this->sqlProva('T', $pTipo) . " and conf_libera_aval_tre = 1";
		$result = mysql_query($SQL /*,$this->db->conexao*/);
		if (mysql_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}

	function checkCRC($pTipo, $pCRC = ""){
		$SQL	= "select concat(substr(conf_hora_final, 1, 2), ':', substr(conf_hora_final, 3, 2)) as hora from treinamento.config " .
				" where date_format(conf_data,'%Y-%m-%d') = date_format(NOW(),'%Y-%m-%d') " .
				" and date_format(NOW(),'%H%i') < conf_hora_final " .
				" and conf_tipo = $pTipo ".
				($pCRC ? " and conf_crc = '$pCRC'" : "");
		$result = mysql_query($SQL /*,$this->db->conexao*/);
		$linha	= mysql_fetch_object($result);
		return $linha->hora;
	}

	function avalicaoDoTreinamento($pTipo=""){
		$SQL	= "select count(conf_id) as total from treinamento.config ";
		$SQL2	= "select conf_tipo, conf_tipo_padrao, conf_evento_padrao, conf_instrutor_padrao, conf_local_padrao from treinamento.config ";
		$WH		= " where date_format(conf_data,'%Y-%m-%d') = date_format(NOW(),'%Y-%m-%d') " .
				" and conf_libera_aval_tre = 1" .
				($pTipo ? " and conf_tipo = " . $pTipo : "");
		$result = mysql_query($SQL.$WH /*,$this->db->conexao*/);
		$linha	= mysql_fetch_object($result);
		if ($linha->total > 0){
			$this->avaliacaoLiberada = true;
		}else{
			$this->avaliacaoLiberada = false;
		}
		$result = mysql_query($SQL2.$WH /*,$this->db->conexao*/);
		$linha	= mysql_fetch_object($result);
		$this->avaliacaoTipo		= $linha->conf_tipo;
		$this->avaliacaoTipoEvento	= $linha->conf_tipo_padrao;
		$this->avaliacaoEvento		= $linha->conf_evento_padrao;
		$this->avaliacaoInstrutor	= $linha->conf_instrutor_padrao;
		$this->avaliacaoLocal		= $linha->conf_local_padrao;
	}
}

class REL_PDF_QTD_TREINAMENTO extends REL_PDF_DTM{



	var	$db				= 0;
	var $pdf			= 0;
	var $mes			= 0;
	var $ano			= 0;
	var $evento			= 0;
	var $flagTipo		= 0;
	var $IsModulo		= 0;

	var $linkRel		= "";
	var $arquivo_pdf	= "";

	var $vLin			= array('a1','b1','c1','d1','a2','a3','b3','c3','a4');
	var $vCol			= array('1','2','3','4','5');
	var $vColDesc		= array('�TIMO','BOM','REGULAR','RUIM','NDA*');

	var $vColDet		= array('observacao','sugestao','reclamacao','elogio', 'complemento');
	var $vColDetDescP	= array('Observa�oes','Sugestoes','Reclama�oes','Elogios', 'Complemento');
	var $vColDetDesc	= array('Observa�ao','Sugestao','Reclama�ao','Elogio', 'Registros complementares, se necess�rio (Para Palestrante/Instrutor):');

	function REL_PDF_QTD_TREINAMENTO($flagTipo, $evento, $ano, $mes, $IsModulo){


		global $USRNOME;
		global $v_id_usuario;
		global $PAGINA;

		$this->Open();
		$this->FPDF("P","mm","A4");

		$this->fun_Vlin($this->Vlin_ini);

		$this->fun_Vsistema('Treinamento');
		$this->fun_Vtitulo('Relat�rio de Quantidade de Avalia�oes do Treinamento');
		$this->fun_Vusuario($USRNOME);
		$this->fun_Vprogrel($PAGINA);
		$this->fun_cabecalho();

		$this->mes		= $mes;
		$this->ano		= $ano;
		$this->evento	= $evento;
		$this->flagTipo	= $flagTipo;
		$this->IsModulo	= $IsModulo;

		$this->db = new DB();
	}

	private function montaSQL($pCol, $pCondicao, $pLeftJoin="", $pGroupBy=""){
		$SQL = " SELECT ".$pCol." as Ret from avaliatre " . $pLeftJoin;
		if (!$this->IsModulo){
			$SQL .= " right join modulos on modulos.descricao = avaliatre.evento and modulos.cod_sistema = '".$this->evento."' ".
					" right join sistemas on modulos.cod_sistema = sistemas.id ";
		}else{
			$SQL .= " right join modulos on modulos.descricao = avaliatre.evento and modulos.id = '".$this->evento."' ";
		}
		$SQL .= " where month(data) = ".$this->mes .
				" and year(data) = ".$this->ano .
				$pCondicao .
				// (($this->IsModulo) ? " and evento = '".$this->evento."' " : "") .
				(($this->flagTipo) ? " and flagTipo = '".$this->flagTipo."'" : "") .
				(($pGroupBy == "") ? "" : " group by $pGroupBy") .
				" order by evento";
		//echo $SQL."<br>";
		return $SQL;
	}

	function gerar(){

		global $aLinDes;
		global $mesescrito;
		global $aTreinoTipo;


		global $link;
		mysql_set_charset("latin1", $link);


		$SQL		= "select descricao from ".(($this->IsModulo) ? "modulos" : "sistemas" )." where id ='".$this->evento."' ";
		$result 	= mysql_query($SQL /*, $this->db->conexao*/);

		$linhaSis	= mysql_fetch_object($result);

		$vResultados = array();
		$vTotPos	= 0;
		$vTotNeg	= 0;
		$vTot		= 0;
		$vTots		= array();
		$vTotTres	= array();

		for ($cLin=0; $cLin<count($this->vLin); $cLin++){
			$vResultados[$this->vLin[$cLin]] = array();
			for ($cCol=0; $cCol<count($this->vCol); $cCol++){

				$SQL = $this->montaSQL("count(".$this->vLin[$cLin].")", " and ".$this->vLin[$cLin]." = '".$this->vCol[$cCol]."' ");
				$result 	= mysql_query($SQL);
				$linha		= mysql_fetch_object($result);
				$vResultados[$this->vLin[$cLin]][$this->vCol[$cCol]] = (int)$linha->Ret;
				$vTots[$this->vCol[$cCol]] += (int)$linha->Ret;

				if (in_array($this->vCol[$cCol], array($this->vCol[0], $this->vCol[1]))){
					$vTotPos += (int)$linha->Ret;
				}elseif (in_array($this->vCol[$cCol], array($this->vCol[2], $this->vCol[3]))){
					$vTotNeg += (int)$linha->Ret;
				}
			}
		}

		//**********************************************************************************************************************************
		$this->SetFont('Arial','B',9);

		$this->SetXY(6,$this->Vlin);
		$this->MultiCell(198, $this->Vlin_alt,"AVALIA�AO - $linhaSis->descricao - ".strtoupper($mesescrito[$this->mes])." $this->ano (".(($this->IsModulo) ? "M�DULOS" : "SISTEMAS" ).")", 0, "C", 0);
		$this->fun_ADD_Vlin($this->Vlin_alt);

		$this->SetXY(6,$this->Vlin);
		$this->MultiCell(198, $this->Vlin_alt,"Tipo: " . $aTreinoTipo[$this->flagTipo], 0, "C", 0);
		$this->fun_ADD_Vlin($this->Vlin_alt*2);

		//**********************************************************************************************************************************
		$this->impLinha("",$this->vColDesc, true, true);

		for ($cLin=0; $cLin<count($this->vLin); $cLin++){
			$this->impLinha($aLinDes[$this->vLin[$cLin]], $vResultados[$this->vLin[$cLin]], false, false);
		}

		$this->fun_ADD_Vlin($this->Vlin_alt);

		//**********************************************************************************************************************************
		$this->SetFont('Arial','B',9);

		$this->SetXY(6,$this->Vlin);

		if ($vTotPos > 0){
			$vTot = number_format(($vTotPos/($vTotPos + $vTotNeg)) * 100, 2, ',', ' ');
		}

		if ($vTot > 0){
			$this->MultiCell(198, $this->Vlin_alt,"Percentual de Aprova�ao do Treinamento = $vTot"."%", 0, "L", 0);
		}else{
			$this->MultiCell(198, $this->Vlin_alt,"Nao h� avalia�ao em " . $mesescrito[$this->mes], 0, "L", 0);
		}
		$this->fun_ADD_Vlin($this->Vlin_alt);

		//**********************************************************************************************************************************
		$this->SetFont('Arial','',7);

		$this->SetXY(6,$this->Vlin);
		$this->MultiCell(198, $this->Vlin_alt,"* A op�ao (Nao desejo avaliar) nao ser� considerada nos resultados dos indicadores.", 0, "L", 0);
		$this->fun_ADD_Vlin($this->Vlin_alt*2);

		// QUantidade por instrutor
		$result		= mysql_query($this->montaSQL("ins_nome, count(0)", ""," left join instrutor on ins_id = ava_ins_id", "ins_id"));
		$ContTot	= mysql_num_rows($result);
		while ($linha = mysql_fetch_object($result))
		{
			$vTotTres[$linha->ins_nome] = $linha->Ret;
		}

		//**********************************************************************************************************************************
		for ($cCol=0; $cCol<count($this->vColDet); $cCol++){

			$SQL = $this->montaSQL("flagTipo, flagAvaliadoObs, flagAvaliadoSug, flagAvaliadoRec, flagAvaliadoElo, ins_nome, nome, ".$this->vColDet[$cCol]
								   ," and trim(" . "replace(" . $this->vColDet[$cCol] . ",'\r\n','')" . ") <> '' and trim(" . $this->vColDet[$cCol] . ") <> '\r\n'"
				   				   ," left join instrutor on ins_id = ava_ins_id");
			$result 	= mysql_query($SQL);

			$Cont = 0;
			$ContTot = mysql_num_rows($result);
			if ($ContTot){

				$this->SetFont('Arial','B',10);

				$this->SetXY(6,$this->Vlin);
				if ($ContTot > 1){
					$this->MultiCell(198, $this->Vlin_alt, $this->vColDetDescP[$cCol], 0, "L", 0);
				}else{
					$this->MultiCell(198, $this->Vlin_alt, $this->vColDetDesc[$cCol], 0, "L", 0);
				}
				$this->fun_ADD_Vlin($this->Vlin_alt);

				while ($linha = mysql_fetch_object($result)){

					$this->SetFont('Arial','',9);
					$this->SetXY(6,$this->Vlin);

					$vColuna = $linha->ins_nome; //ordem de acordo com vColDet
					if (($cCol == 0 && $linha->flagAvaliadoObs == "L") ||
						($cCol == 1 && $linha->flagAvaliadoSug == "L") ||
						($cCol == 2 && $linha->flagAvaliadoRec == "L") ||
						($cCol == 3 && $linha->flagAvaliadoElo == "L"))
					{
						if ($linha->flagTipo == 3)
						{
							$vColuna = "INFRA - CLIENTE";
						}
						elseif ($linha->flagTipo == 2)
						{
							$vColuna = "INFRA - DATAMACE";
						}
						else
						{
							$vColuna = "INFRA - DATAMACE/INTERNO";
						}
					}
					$vRetByInst[$vColuna][$this->vColDetDescP[$cCol]] += 1;
					$texto = ++$Cont . " - " . trim($linha->Ret) . (($linha->nome) ? " (" . $linha->nome . ")" : "") . " - AVALIADO: " . $vColuna;

					$vLins = $this->Vlin_alt * $this->NbLines(198, $texto);
					$this->MultiCellHeight(6,$this->Vlin, 198, $vLins, $texto, 0, "L", 0);

					//$this->WriteHTML(++$Cont . " - " . trim($linha->Ret) . (($linha->nome) ? " <B>(" . $linha->nome . ")</B>" : ""));
					$this->fun_ADD_Vlin($vLins+$this->Vlin_alt);

				}
			}
			if ($ContTot > 0){
				$this->fun_ADD_Vlin($this->Vlin_alt);
			}
		}

		// Quadro de resumo dos obs, rec, elo e sug
		if (count($vRetByInst) > 0)
		{
			// Ordenando os dados
			array_unshift($this->vColDetDescP,"");
			$this->impLinha("AVALIADO(S)", $this->vColDetDescP, false, false, 1);
			foreach ($vRetByInst as $key => $val){
				$vRetByInstOrder[$key] = array();
				$vRetByInstOrder = array();
				foreach ($this->vColDetDescP as $keyB => $valB){
					if ($vRetByInst[$key][$valB])
					{
						$vRetByInstOrder[] = $vRetByInst[$key][$valB];
					}else{
						$vRetByInstOrder[] = 0;
					}
				}
				//print_r($vRetByInst);
				//echo "<br>";
				//print_r($vRetByInstOrder);
				$this->impLinha($key, $vRetByInstOrder, false, false, 1);
			}

			$this->fun_ADD_Vlin($this->Vlin_alt*2);
			$this->SetXY(13,$this->Vlin);
			$this->fun_ADD_Vlin($this->Vlin_alt);
			$this->MultiCell(198, $this->Vlin_alt, "Quantidade de avalia�oes", 0, "L", 0);

			$this->impLinha('Instrutor(a)', array('Qtd. Alunos'), true, false, 0);
			foreach ($vTotTres as $key => $val){
				$this->impLinha($key, array($val), true, false, 0);
			}

		}

		//**********************************************************************************************************************************
		$this->arquivo_pdf = "temp/". str_replace('.php','',$PAGINA).$v_id_usuario.date('dmsB').".pdf";
		$this->linkRel = "<script>AbreRelatorio('".$this->Vtitulo."');</script><a href='#' onclick='AbreRelatorio(\"".$this->Vtitulo."\")'>Clique aqui para abrir o relat�rio</a>";
		$this->Output($this->arquivo_pdf,"F");
		$this->close();


		mysql_set_charset("utf8", $link);


	}

	private function impLinha($pFirstCol, $pCols, $pLinhaComun, $ColsNegritas, $pRetiraColFinal=0){

		$vTamColG = 25;

		$this->SetFont('Arial','B',9);

		$this->SetXY(13,$this->Vlin);
		$this->MultiCell(60, $this->Vlin_alt,$pFirstCol, 1, "R", 0);
		$col = 73;

		$this->SetFont('Arial', (($ColsNegritas) ? "B" : ""), 9);

		for ($cCol=0; $cCol<count($pCols)-$pRetiraColFinal; $cCol++){

			$this->SetXY($col,$this->Vlin);
			if ($pLinhaComun){
				$this->MultiCell($vTamColG, $this->Vlin_alt,$pCols[$cCol], 1, "C", 0);
			}else{
				$this->MultiCell($vTamColG, $this->Vlin_alt,$pCols[$this->vCol[$cCol]], 1, "C", 0);
			}
			$col+=$vTamColG;
		}

		$this->fun_ADD_Vlin($this->Vlin_alt);

	}

}

class REL_PDF_NOTAS_TREINADOS extends REL_PDF_DTM{

	var	$db				= 0;
	var $pdf			= 0;
	var $mes			= 0;
	var $ano			= 0;
	var $evento			= 0;
	var $flagTipo		= 0;
	var $IsModulo		= 0;

	var $linkRel		= "";
	var $arquivo_pdf	= "";

	function REL_PDF_NOTAS_TREINADOS($flagTipo, $evento, $ano, $mes, $IsModulo){

		global $USRNOME;
		global $v_id_usuario;
		global $PAGINA;

		$this->Open();
		$this->FPDF("P","mm","A4");

		$this->fun_Vlin($this->Vlin_ini);

		$this->fun_Vsistema('Treinamento');
		$this->fun_Vtitulo('Relat�rio de Notas/Assimila�ao dos Treinandos');
		$this->fun_Vusuario($USRNOME);
		$this->fun_Vprogrel($PAGINA);
		$this->fun_cabecalho();

		$this->mes		= $mes;
		$this->ano		= $ano;
		$this->evento	= $evento;
		$this->flagTipo	= $flagTipo;
		$this->IsModulo	= $IsModulo;

		$this->db = new DB();
	}

	function gerar(){

		global $aLinDes;
		global $mesescrito;
		global $aTreinoTipo;

		$SQL = " SELECT distinct R.id as id, C.rg as rg, C.nome as nome from respostas as R" .
				" left join cadastrotreinamento as C on R.rg = C.rg " .
				" right join provas as P on P.id = R.cod_prova ";
		if (!$this->IsModulo){
			$SQL .= " right join modulos as M on M.cod_sistema = P.sistema_id and M.cod_sistema = '".$this->evento."' ".
					" right join sistemas as S on M.cod_sistema = S.id ";
		}else{
			$SQL .= " right join modulos as M on M.cod_sistema = P.sistema_id and M.id = '".$this->evento."' ";
		}
		$SQL .= " where month(resp_hora) = ".$this->mes . " and year(resp_hora) = ".$this->ano .
				$pCondicao .
				(($this->flagTipo) ? " and flagTipo = '".$this->flagTipo."'" : "").
				" order by R.rg";

		$result = mysql_query($SQL /*, $this->db->conexao*/);
		while ($linha = mysql_fetch_object($result))
		{

			$PTO = new treinamento("");
			$PTO->rg = $linha->rg;
			$PTO->materia = $linha->id;
			$PTO->mes = $this->mes;
			$PTO->ano = $this->ano;
			$PTO->ver_resultados();
			$vNota = $PTO->verifica_nota($linha->id);


			$this->impLinha($linha->nome, array($vNota), true, false, false);

		}

		//**********************************************************************************************************************************
		$this->arquivo_pdf = "temp/". str_replace('.php','',$PAGINA).$v_id_usuario.date('dmsB').".pdf";
		$this->linkRel = "<script>AbreRelatorio('".$this->Vtitulo."');</script><a href='#' onclick='AbreRelatorio(\"".$this->Vtitulo."\")'>Clique aqui para abrir o relat�rio</a>";
		$this->Output($this->arquivo_pdf,"F");
		$this->close();

	}

	private function impLinha($pFirstCol, $pCols, $pLinhaComun, $ColsNegritas, $pRetiraColFinal=0){

		$vTamColG = 25;

		$this->SetFont('Arial','B',9);

		$this->SetXY(13,$this->Vlin);
		$this->MultiCell(60, $this->Vlin_alt,$pFirstCol, 1, "R", 0);
		$col = 73;

		$this->SetFont('Arial', (($ColsNegritas) ? "B" : ""), 9);

		for ($cCol=0; $cCol<count($pCols)-$pRetiraColFinal; $cCol++){

			$this->SetXY($col,$this->Vlin);
			if ($pLinhaComun){
				$this->MultiCell($vTamColG, $this->Vlin_alt,$pCols[$cCol], 1, "C", 0);
			}else{
				$this->MultiCell($vTamColG, $this->Vlin_alt, $pCols[$this->vCol[$cCol]], 1, "C", 0);
			}
			$col+=$vTamColG;
		}

		$this->fun_ADD_Vlin($this->Vlin_alt);

	}

}


?>