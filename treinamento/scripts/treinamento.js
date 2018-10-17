String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}
String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
}
String.prototype.rtrim = function() {
	return this.replace(/\s+$/,"");
}

function evento(evt){
/*
	Autor: Lucas Oliveira Silva
	Date: 14/05/2010
	Trata o evento e devolve os valores
*/
	var evt = (evt) ? evt : ((event) ? event : null);

	re = /\$|,|@|#|~|`|\%|\*|\^|\&|\(|\)|\+|\=|\[|\-|\_|\]|\[|\}|\{|\;|\:|\'|\"|\<|\>|\?|\||\\|\!|\$|\./g;

	this.evt			= evt;

	try{
		this.id			= evt.target.id;
	}catch(err){
		try{
			this.id		= event.srcElement.id;
		}catch(err){}
	}
	try{
		this.nome		= evt.target.name;
	}catch(err){
		try{
			this.nome	= event.srcElement.name;
		}catch(err){}
	}
	try{
		this.valor		= evt.target.value
	}catch(err){
		try{
			this.valor	= event.srcElement.value;
		}catch(err){}
	}
	try{
		this.tipo		= evt.target.type;
	}catch(err){
		try{
			this.tipo	= event.srcElement.type;
		}catch(err){}
	}
	try{
		this.form		= evt.target.form.name;
	}catch(err){
		try{
			this.form	= event.srcElement.form.name
		}catch(err){}
	}

	this.tecla			= ((evt.keyCode) ? evt.keyCode : evt.which);

	if (this.valor) this.valor_l = this.valor.replace(re,'').replace('/','').trim();
	try{
		this.help				= evt.getAttribute("help");
		this.helpid_opc			= evt.getAttribute("helpid_opc");
		this.helpfiltraativo	= evt.getAttribute("helpfiltraativo");
		this.helpid_depend		= evt.getAttribute("helpid_depend");
	}catch(err){}

	if (this.id) this.objeto = $('#'+this.id);

	if ((this.tecla == undefined) || (!this.tecla)) this.tecla = "";
	if ((this.help == undefined) || (!this.help)) this.help = "";
	if ((this.helpid_opc == undefined) || (!this.helpid_opc)) this.helpid_opc = "";
	if ((this.helpfiltraativo == undefined) || (!this.helpfiltraativo)) this.helpfiltraativo = "";
	if ((this.helpid_depend == undefined) || (!this.helpid_depend)) this.helpid_depend = "";

	try{
		this.tag	= $('#'+this.id)[0].tagName.toUpperCase();
	}catch(err){
		this.tag	= " ";
	}
}

function fun_submit(Cvalor){
	$('#id_opc')[0].value = Cvalor;
	$('#'+$('#id_opc')[0].form.id).submit();
}

function fun_excluir(CFrase){
	if (!CFrase) CFrase = 'Confirma a exclus'+String.fromCharCode(227)+'o do Registro?';
	if (confirm(CFrase)){
		fun_submit(3);
	}
}

function fun_novo(Cform,Copcao,Cvalor){	
	list = document.getElementsByTagName('input');
	for(i=0; i < list.length; i++){
		if ((list[i].type == 'text') || (list[i].type == 'password')){
			list[i].value = '';
		}
	}
	list = document.getElementsByTagName('select');
	for(i=0; i < list.length; i++){
		list[i].value = '<null>';
	}
	Copcao.value = Cvalor;
	Cform.submit();
}

function fun_msg(VTipo,VMsg){
	switch(VTipo){
		case 'I':
			alert("Registro Gravado com exito!");
			break;
		case 'U':
			alert("Registro Alterado com exito!");
			break;
		case 'E':
			alert('Registro Exclu'+String.fromCharCode(237)+'do com exito!');
			break;
		case 'D':
			alert('H'+String.fromCharCode(225)+' v'+String.fromCharCode(237)+'nculos para este registro. \n O registro foi atualizado com Status "Inativo"!');
			break;
		case 'M':
			alert(VMsg);
			break;
		case 'R':
			alert('Relatório Gerado com exito!');
			break;
	}
}

function fun_submit(Cvalor){
	$('#id_opc')[0].value = Cvalor;
	$('#'+$('#id_opc').closest('form').attr('id')).submit();
}

function fun_onload(){

	if ($('input[pri_focu="S"]').length > 1){
		alert('Propriedade "pri_focu" deve ser utilizado somente em 1 campo!');
	};
	$('input[pri_focu="S"]').focus();

	$('.TXTLOAD').each(function(){
		$(this).bind('change', function (event) {
			if (!$(this)[0].value){
				return false;
			}else{
				var vValor = $(this)[0].value;
				$('.TXTLOAD').each(function(index, element) {
					$(this)[0].value = "";
				});
				$(this)[0].value = vValor;
				return fun_submit(1);
			}
		})

	});

	$('input[type="text"]').each(function(){
		var $input	= $(this);

		var IDHelp		= fun_AbreConsulta($input,"");		

/*		var Ajax			= $input[0].getAttribute("ajax");
		if (Ajax == 'blur' || Ajax == 'change'){
			if (IDHelp){
				$('#'+IDHelp).after('&nbsp;<span id="'+$input[0].id+'_desc"></span>');
			}else{
				$('#'+$input[0].id).after('&nbsp;<span id="'+$input[0].id+'_desc"></span>');
			}
			$('#'+$input[0].id).live(Ajax, function (event) {
				return PerformAjax($(this)[0]);
			})
		}
*/

		if ($input[0].getAttribute("calendario") == "S"){
			$('#'+$input[0].id).datepicker({
				inline: true
			})
		};

		if ($input[0].id){
			$('#'+$input[0].id).live('focus', function (event) {
				return $('#'+$input[0].id).select();
			})
		};

		if ($input.hasClass('TXTDATE')){
			$input[0].maxLength			= 10;
			$input[0].size				= 12;
			$input[0].style.textAlign	= 'center';
			$('#'+$input[0].id).live('keypress', function (event) {
				return txtBoxFormat(this, '99/99/9999', event);			
			})
		}else if($input.hasClass('TXTCEP')){
			$input[0].maxLength	= 9;
			$input[0].size		= 11;
			$input[0].style.textAlign	= 'center';
			$('#'+$input[0].id).live('keypress', function (event) {
				return txtBoxFormat(this, '99999-999', event);	
			})
		}else if($input.hasClass('TXTCEI')){
			fun_formataCEI($input, event);
		}else if($input.hasClass('TXTCPF')){
			fun_formataCPF($input, event);
		}else if($input.hasClass('TXTCNPJ')){
			fun_formataCNPJ($input, event);
		}else if($input.hasClass('TXTTEL')){
			$input[0].size		= 19;
			$('#'+$input[0].id).live('keypress', function (event) {
				var vFormato = '99 - 9999-9999';
				$(this)[0].maxLength = 14;
				if ($(this)[0].value.length >= 5)
				{
					if (($(this)[0].value.substring(0,2) == "11" ||
						 $(this)[0].value.substring(0,2) == "12" ||
						 $(this)[0].value.substring(0,2) == "13" ||
						 $(this)[0].value.substring(0,2) == "14" ||
						 $(this)[0].value.substring(0,2) == "15" ||
						 $(this)[0].value.substring(0,2) == "16" ||
						 $(this)[0].value.substring(0,2) == "17" ||
						 $(this)[0].value.substring(0,2) == "18" ||
						 $(this)[0].value.substring(0,2) == "19") &&
						($(this)[0].value.substring(5,6) == "9"))
					{
						$(this)[0].maxLength = 15;
						vFormato = '99 - 99999-9999';
					}
				}
				return txtBoxFormat(this, vFormato, event);
			})
		}else if($input.hasClass('TXTTELSIMPLES')){
			$input[0].maxLength = 9;
			$input[0].size		= 11;
			$('#'+$input[0].id).live('keypress', function (event) {
				return txtBoxFormat(this, '9999-9999', event);
			})
		}else if($input.hasClass('TXTINT')){
			$input[0].size = ($input[0].maxLength + 2);
			$input[0].style.textAlign = 'right';
			$('#'+$input[0].id).live('keydown', function(event) {
				return fun_numerico(event);
			});
		}else if($input.hasClass('TXTREAL')){
			$input[0].style.textAlign	= 'right';
			$input[0].maxLength			= 10;
			$input[0].size				= 10;
			$('#'+$input[0].id).live('keypress', function (event) {
				return reais(this,event);
			});
			$('#'+$input[0].id).live('keydown', function (event) {
				return backspace(this,event);
			})
		}else if ($input.hasClass('TXTHORA')){
			$input[0].maxLength			= 5;
			$input[0].size				= 5;
			$input[0].style.textAlign	= 'center';
			$('#'+$input[0].id).live('keypress', function (event) {
				return txtBoxFormat(this, '99:99', event);			
			})
		}

	});

	$('#BTNGravar').live('click', function(event){
		
		if (!Gravar()){
			return false;
		}
		
		if (!v.exec()){
			return false;
		}else{
			fun_submit(2);
		}
	});

	$('#BTNNovo').live('click', function(event){
		fun_submit('99');
	});

	$('#BTNExcluir').live('click', function(event){
		fun_excluir('');
	});

	$('#BTNVoltar').live('click', function (event){
		if ($(this)[0].getAttribute("voltarPara").replace("/","") != ""){
			window.location = $(this)[0].getAttribute("voltarPara").replace("/","");
		}else if ($('#linkPagina')[0].value != ""){
			window.location = $('#linkPagina')[0].value;
		}else{
			window.location = 'treinamento.php';
		}
	})

/*	relogio();*/
	try{
		fun_msg('msgok','campomsgerro','msg');
	}catch(err){}

	
	fun_msg($('#msgok')[0].value,$('#msg')[0].value);
	$('#msgok')[0].value = '';

}

function fun_formataCEI($input, event){
	$input[0].maxLength = 15;
	$input[0].size		= 17;
	$('#'+$input[0].id).live('keypress', function (event) {
		return txtBoxFormat(this, '99.999.99999/99', event);
	})
}

function fun_formataCPF($input, event){
	$input[0].maxLength = 14;
	$input[0].size		= 16;
	$('#'+$input[0].id).live('keypress', function (event) {
		return txtBoxFormat(this, '999.999.999-99', event);
	})
}

function fun_formataCNPJ($input, event){
	$input[0].maxLength = 18;
	$input[0].size		= 21;
	$('#'+$input[0].id).live('keypress', function (event) {
		return txtBoxFormat(this, '99.999.999/9999-99', event);
	})
};

function fun_DestroyConsulta($input){

	var IDImg			= $input[0].id + "_help";
	$('#'+IDImg).remove();
	$('#'+IDImg).die("click");
}

function fun_AbreConsulta($input,Open){
	var Title			= "";
	var Height			= 390;
	var Width			= 500;
	var IDImg			= $input[0].id + "_help";
	var IDFrame			= $input[0].id + "_dialog";
	var TipHelp			= $input[0].getAttribute("help"); /*Opção para op Help*/
	var HelpPopUp		= $input[0].getAttribute("helppopup"); /*Se sim, irá abrir popup invéz de modal*/
	var TipHelpAtivos	= $input[0].getAttribute("helpfiltraativo"); /* Filtra os ativos? */
	var HelpId_Opc		= $input[0].getAttribute("helpid_opc"); /* Opção para submeter a página quando retornar */
	var HelpId_Depend	= $input[0].getAttribute("helpid_depend"); /* Opção para help que depende do valor de outro campo */
	var HelpAjax		= $input[0].getAttribute("ajax"); /* Método de ajax que será executado no retorno do help */
	var BtnNavega		= $input[0].getAttribute("btn_navega"); /* Método de ajax que será executado no retorno do help */

	TipHelp			= ((TipHelp == null) ? "" : TipHelp);
	TipHelpAtivos	= ((TipHelpAtivos == null) ? "" : TipHelpAtivos);
	HelpId_Opc		= ((HelpId_Opc == null) ? "" : HelpId_Opc);
	HelpId_Depend	= ((HelpId_Depend == null) ? "" : HelpId_Depend);

	switch(TipHelp){
		case 'config':
			Title = 'Clique aqui para selecionar a Configuração';
			break;
		case 'perguntas':
			Title = 'Clique aqui para selecionar a Pergunta';
			break;
		case 'modulos':
			Title = 'Clique aqui para selecionar o Módulo';
			break;
		case 'provas':
			Title = 'Clique aqui para selecionar a Prova';
			break;
		case 'treino':
			Title = 'Clique aqui para selecionar o Treinamento';
			break;
		case 'sistemas':
			Title = 'Clique aqui para selecionar o Sistema';
			break;
		case 'conceitos':
			Title = 'Clique aqui para selecionar o Conceito';
			break;
		case 'treinando':
			Title = 'Clique aqui para selecionar o Treinando';
			break;
		case 'revisao_formulario':
			Title = 'Clique aqui para selecionar o Formulário';
			break;
		case 'instrutor':
			Title = 'Clique aqui para selecionar o Instrutor';
			break;
	}

	if (Title){
		var Src = 'Helps.php?TipHelp='				+TipHelp				+
								'&HelpFiltraAtivo='	+TipHelpAtivos			+
								'&IDForm='			+$input[0].form.name	+
								'&IDCampoRet='		+$input[0].id			+
								'&IDDialog='		+IDFrame				+
								'&HelpID_Opc='		+HelpId_Opc				+
								'&HelpId_Depend='	+HelpId_Depend			+
								'&HelpPopUp='		+HelpPopUp				+
								'&HelpAjax='		+HelpAjax				+
								'&Title='			+Title;

		if (Open == "S"){
			if (HelpPopUp == 'S'){
				return fun_AbreConsultaPopUp(Src, Width, Height, IDFrame);
			}else{
				return fun_AbreConsultaModal(Src, Width, Height, IDFrame);
			}
		}else{
			$('#'+$input[0].id).live("keydown", function (event) {
				CObjeto = new evento(event);
				if (CObjeto.tecla == 112){
					if (HelpPopUp == 'S'){
						return fun_AbreConsultaPopUp(Src, Width, Height, IDFrame);
					}else{
						return fun_AbreConsultaModal(Src, Width, Height, IDFrame);
					}
				}else{
					return true;
				};
			});
			$('#'+$input[0].id).after('&nbsp;<img id="'+IDImg+'" src="imagens/lupa1.gif" style="cursor:pointer; width: 18px; heght: 18px;" title="'+Title+'">');
			$('#'+IDImg).live("click", function (event) {
				if (HelpPopUp == 'S'){
					return fun_AbreConsultaPopUp(Src, Width, Height, IDFrame);
				}else{
					return fun_AbreConsultaModal(Src, Width, Height, IDFrame);
				}
			});
			if (BtnNavega == 'S'){
				fun_btnNavegacao($input[0].id, IDImg);
			}
			return IDImg;
		};
	};
}

function fun_btnNavegacao(vCampoId, vObjLupa){

	var vId		= parseFloat($('#'+vCampoId)[0].value);
	var vMin	= 1;//parseFloat($('#tableRegMin')[0].value);
	var vMax	= 32000;//parseFloat($('#tableRegMax')[0].value);
	var vFilter	= ' filter: alpha(opacity=40);';

	if (vId == vMin){
		vFirst	= true;
		vFirstG	= vFilter;
	}else{
		vFirst	= false;
		vFirstG	= '';
	}
	if (vId <= vMin){
		vPrev	= true;
		vPrevG	= vFilter;
	}else{
		vPrev	= false;
		vPrevG	= '';
	}

	if (vId >= vMax){
		vNext	= true;
		vNextG	= vFilter;
	}else{
		vNext	= false;
		vNextG	= '';
	}
	if (vId == vMax){
		vLast	= true;
		vLastG	= vFilter;
	}else{
		vLast	= false;
		vLastG	= '';
	}

	$('#'+vObjLupa)
		.after($('<img>')
			.attr('id','btnNavLast')
			.attr('src','imagens/btnLast.png')
			.attr('title','Último registro')
			.attr('width','15')
			.attr('height','15')
			.attr('align','absbottom')
			.attr('disabled',vLast)
			.attr('style','cursor: pointer;'+vLastG)
			.bind('click',function(event){
				return fun_submit(13);
			})
		)
		.after($('<img>')
			.attr('id','btnNavNext')
			.attr('src','imagens/btnNext.png')
			.attr('title','Próximo registro')
			.attr('width','15')
			.attr('height','15')
			.attr('align','absbottom')
			.attr('disabled',vNext)
			.attr('style','cursor: pointer;'+vNextG)
			.bind('click',function(event){
				return fun_submit(12);
			})
		)
		.after($('<img>')
			.attr('id','btnNavPrev')
			.attr('src','imagens/btnPrev.png')
			.attr('title','Registro anterior')
			.attr('width','15')
			.attr('height','15')
			.attr('align','absbottom')
			.attr('disabled',vPrev)
			.attr('style','cursor: pointer;'+vPrevG)
			.bind('click',function(event){
				return fun_submit(11);
			})
		)
		.after($('<img>')
			.attr('id','btnNavFirst')
			.attr('src','imagens/btnFirst.png')
			.attr('title','Primeiro registro')
			.attr('width','15')
			.attr('height','15')
			.attr('align','absbottom')
			.attr('disabled',vFirst)
			.attr('style','cursor: pointer;'+vFirstG)
			.bind('click',function(event){
				return fun_submit(10);
			})
		)
}

function fun_AbreConsultaPopUp(VSrc, VWidth, VHeight, VIDFrame){
	var idContrle = VIDFrame.replace('_dialog','');
	if (!$('#'+idContrle)[0].disabled)
	{	
		popup = window.open(VSrc,'','toolbar=no,status=yes,scrollbar=no,resize=no,width=' + VWidth + ',height=' + VHeight + ',top=150,left=200');
		popup.focus();
	}
}

function fun_AbreConsultaModal(VSrc, VWidth, VHeight, VIDFrame){
	var idContrle = VIDFrame.replace('_dialog','');
	if (!$('#'+idContrle)[0].disabled)
	{
		$('<iframe id="'+VIDFrame+'" src="'+VSrc+'" height="'+VHeight+'" width="'+VWidth+'" style="border:0; padding:0; width: 100%; overflow:none;" frameborder="0">').dialog({
			title: "Help de Tabelas",
			height: VHeight,
			width: VWidth,
			resizable: false,
			showTitle: true,
			customClose: false,
			handleName: '.CMovGrid'
		});
	}
}

function AbreRelatorio(VTitulo){
	if ($('#arquivo_pdf')[0].value){
		
		vHeight = $(window).height() - 20;
		vWidth = $(window).width();
		if (vWidth > 1400) vWidth = 1400;
		vWidth -= 20;
		
		$('<iframe id="IDREL" src="'+$('#arquivo_pdf')[0].value+'" height="600" width="900" style="border:0; padding:0; width: 100%;" frameborder="0" allowtransparency="true">').dialog({
			title: VTitulo,
			height: vHeight,
			width: vWidth,
			resizable: false,
			showTitle: true,
			customClose: false
		});
	}else{
		alert('Nenhum registro encontrado!');
	}
}

$(document).ready(function(){
	fun_onload();
});

function crc32(s/*, polynomial = 0x04C11DB7, initialValue = 0xFFFFFFFF, finalXORValue = 0xFFFFFFFF*/) {
  s = String(s);
  var polynomial = arguments.length < 2 ? 0x04C11DB7 : (arguments[1] >>> 0);
  var initialValue = arguments.length < 3 ? 0xFFFFFFFF : (arguments[2] >>> 0);
  var finalXORValue = arguments.length < 4 ? 0xFFFFFFFF : (arguments[3] >>> 0);
  var table = new Array(256);

  var reverse = function (x, n) {
    var b = 0;
    while (--n >= 0) {
      b <<= 1;
      b |= x & 1;
      x >>>= 1;
    }
    return b;
  };

  var i = -1;
  while (++i < 256) {
    var g = reverse(i, 32);
    var j = -1;
    while (++j < 8) {
      g = ((g << 1) ^ (((g >>> 31) & 1) * polynomial)) >>> 0;
    }
    table[i] = reverse(g, 32);
  }

  var crc = initialValue;
  var length = s.length;
  var k = -1;
  while (++k < length) {
    var c = s.charCodeAt(k);
    if (c > 255) {
      throw new RangeError();
    }
    var index = (crc & 255) ^ c;
    crc = ((crc >>> 8) ^ table[index]) >>> 0;
  }
  return (crc ^ finalXORValue) >>> 0;
}