<?
// Autor: Lucas Oliveira Silva 
// Data: 01/03/2011 19:07
// Local: Home
// Objetivo: Demonstra a grid do help de tabelas e retorna se for o caso

$ACESSO = 'S'; // Verifica se o acesso é permitido de acordo com o usuário
$ExternoPermitido = "S";
include_once ('cabeca.inc.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Helps de Tabelas - <?=$Title ?></title>
<link rel="stylesheet" type="text/css" media="screen" href="css/ui-lightness/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />
<script language="JavaScript" type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery-ui-1.8.9.custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/grid.locale-pt-br.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/jquery.jqGrid.min.js"></script>
</head>
<body style="overflow:hidden">
<?
fun_CriaHidden("TipHelp");
fun_CriaHidden("HelpFiltraAtivo");
fun_CriaHidden("IDForm");
fun_CriaHidden("IDCampoRet");
fun_CriaHidden("HelpID_Opc");
fun_CriaHidden("IDDialog");
fun_CriaHidden("HelpPopUp");
?>
<table id="GridTable"></table>
<div id="GridNav"></div>
</body>
<script>

var IDDialog	= '#'+$('#IDDialog')[0].value;
var IDCampoRet	= '#'+$('#IDCampoRet')[0].value;
var IDForm		= '#'+$('#IDForm')[0].value;

switch($('#TipHelp')[0].value){
    case 'config':
		var Tcaption = 'Cadastro de Configurações';
		var Tsortname = 'conf_id';
		var TcolNames = ['ID', 'Data', 'Início', 'Término'];
		var TcolModel = [
				{name:'conf_id',index:'conf_id', width:80, align:"right"},
				{name:'conf_data',index:'conf_data', width:150, align:"center"},
				{name:'conf_hora_inicial',index:'conf_hora_inicial', width:125, align:"center"},
				{name:'conf_hora_final',index:'conf_hora_final', width:125, align:"center"}
		];
		break;
    case 'perguntas':
		var Tcaption = 'Cadastro de perguntas';
		var Tsortname = 'id';
		var TcolNames = ['ID', 'Pergunta'];
		var TcolModel = [
				{name:'id',index:'id', width:80, align:"right"},
				{name:'descricao',index:'descricao', width:400}
		];
		break;
    case 'modulos':
		var Tcaption = 'Cadastro de Modulos';
		var Tsortname = 'id';
		var TcolNames = ['ID', 'Descrição', 'Sistema'];
		var TcolModel = [
				{name:'M.id',index:'M.id', width:80, align:"right"},
				{name:'M.descricao',index:'M.descricao', width:200},
				{name:'S.descricao',index:'S.descricao', width:200}
		];
		break;
    case 'provas':
		var Tcaption = 'Cadastro de Provas';
		var Tsortname = 'id';
		var TcolNames = ['ID', 'Descrição', 'Qtd Per.'];
		var TcolModel = [
				{name:'id',index:'id', width:80, align:"right"},
				{name:'descricao',index:'descricao', width:300},
				{name:'qtd_perguntas',index:'qtd_perguntas', width:75}
		];
		break;
    case 'treino':
		var Tcaption = 'Cadastro de Treino';
		var Tsortname = 'id';
		var TcolNames = ['ID', 'Descrição'];
		var TcolModel = [
				{name:'id',index:'id', width:80, align:"right"},
				{name:'descricao',index:'descricao', width:400}
		];
		break;
    case 'sistemas':
		var Tcaption = 'Cadastro de Sistemas';
		var Tsortname = 'id';
		var TcolNames = ['ID', 'Descrição'];
		var TcolModel = [
				{name:'id',index:'id', width:80, align:"right"},
				{name:'descricao',index:'descricao', width:400}
		];
		break;
    case 'conceitos':
		var Tcaption = 'Cadastro de Conceitos';
		var Tsortname = 'con_id';
		var TcolNames = ['ID', 'Descrição'];
		var TcolModel = [
				{name:'con_id',index:'con_id', width:80, align:"right"},
				{name:'con_descricao',index:'con_descricao', width:400}
		];
		break;
    case 'treinando':
		var Tcaption = 'Cadastro de Treinandos';
		var Tsortname = 'rg';
		var TcolNames = ['rg', 'Nome', 'Data'];
		var TcolModel = [
				{name:'rg',index:'rg', width:80, align:"right"},
				{name:'nome',index:'nome', width:325},
				{name:'hoje',index:'hoje', width:75, align:"center"}
		];
		break;
	case 'revisao_formulario':
		var Tcaption = 'Cadastro de Revisão de Formulários';
		var Tsortname = 'rf_id';
		var TcolNames = ['Id', 'Descrição', 'Revisão'];
		var TcolModel = [
				{name:'rf_id',index:'rf_id', width:80, align:"right"},
				{name:'rf_descricao',index:'rf_descricao', width:300},
				{name:'rf_reveisao',index:'rf_reveisao', width:100, align:"center"}
		];
		break;
    case 'instrutor':
		var Tcaption = 'Cadastro de Instrutores';
		var Tsortname = 'ins_id';
		var TcolNames = ['Id', 'Nome', 'Email'];
		var TcolModel = [
				{name:'ins_id',index:'ins_id', width:80, align:"right"},
				{name:'ins_nome',index:'ins_nome', width:300},
				{name:'ins_email',index:'ins_email', width:100, align:"center"}
		];
		break;
}

jQuery("#GridTable").jqGrid({        
   	url:'Grids.php?TipHelp='+$('#TipHelp')[0].value+'&HelpFiltraAtivo='+$('#HelpFiltraAtivo')[0].value,
	caption: Tcaption,
   	colNames: TcolNames,
   	colModel: TcolModel,
   	pager: '#GridNav',
   	sortname: Tsortname,
	hidegrid: false,
	height: 232,
	onClickRow: function(id){

		if ($('#HelpPopUp')[0].value == 'S'){
			parent.opener.$(IDCampoRet)[0].value = id;
			if (($('#HelpID_Opc')[0].value != 'undefined') &&
				($('#HelpID_Opc')[0].value)){
				parent.opener.$('#id_opc')[0].value = $('#HelpID_Opc')[0].value;
				parent.opener.$(IDForm).submit();
			}else{
				parent.opener.$(IDCampoRet).blur();
				parent.opener.$(IDCampoRet).focus();
			};
			window.close();
		}else{
			self.parent.$(IDCampoRet)[0].value = id;
			if (($('#HelpID_Opc')[0].value != 'undefined') &&
				($('#HelpID_Opc')[0].value)){
				self.parent.$('#id_opc')[0].value = $('#HelpID_Opc')[0].value;
				self.parent.$(IDForm).submit();
			}else{
				self.parent.$(IDCampoRet).blur();
				self.parent.$(IDCampoRet).focus();
				self.parent.$(IDDialog).dialog('close');
				self.parent.$(IDDialog).remove();
			}
		}
	},
	handleName: 'CMovGrid'
});
jQuery("#GridTable").jqGrid('navGrid','#GridNav',{/*Opções*/});
</script>
</html>
<? die();
	$cntACmp	= ob_get_contents(); 
	ob_end_clean(); 
	$cntACmp	= str_replace("\n",' ',$cntACmp); 
	$cntACmp	= ereg_replace('[[:space:]]+',' ',$cntACmp); 
	ob_start("ob_gzhandler"); 
	echo $cntACmp; 
	ob_end_flush();
?>