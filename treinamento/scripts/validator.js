function limpa_string(CNPJ){
	if(document.layers && parseInt(navigator.appVersion) == 4){
		x = CNPJ.substring(0,2);
		x += CNPJ.substring(3,6);
		x += CNPJ.substring(7,10);
		x += CNPJ.substring(11,15);
		x += CNPJ.substring(16,18);
		return x; 
	}else{
		CNPJ = CNPJ.replace(".","").replace(".","").replace("-","").replace("/","");
		return CNPJ; 
	}
}

/*	'title': {
		'l': 'Title',  // Nome do Retono (Lucas: Implementado para se não tiver, pegar o valor do t_title)
		'r': false,    // requerido ou nao
		'f': 'alpha',  // formataçao, fixa no validator.js
		't': 't_title',// span oi id que será mudado
		
		'm': null,     // Pode ser nulo ou nao!?
		'mn': 2,       // minimo de caracter
		'mx': 10       // máximo de caracter
	},            <-- so ira utilizar virgula se houver mais campos a serem verificados, o ultimo nao precisa*/

// Formataçoes abaixo
var re_dt = /^(\d{2})\/(\d{2})\/(\d{4})$/,
    re_mes_ano = /^(\d{2})\/(\d{4})$/,
    re_tm = /^(\d{1,2})\:(\d{1,2})\:(\d{1,2})$/,
    re_cpf = /^(\d{3})\.(\d{3})\.(\d{3})\-(\d{2})$/,
	re_cnpj = /^(\d{2})\.(\d{3})\.(\d{3})\/(\d{4})-(\d{2})$/;
    re_numero_end = /^[\+\-]?\d*$/,
a_formats = {
	'cep'     : /^(\d{5})\-(\d{3})$/,
	'mes_ano' : /^(\d{2})\-(\d{4})$/,
	'alpha'   : /^[a-zA-Z\.\-\ ]+$/,
	'alphabeto_acento' : /^[a-zA-Z\.\-\á\é\í\ú\ó\à\è\ì\ò\ù\ã\õ\,\.\ ]+$/,
    'alphanum': /^\w+$/,
	'unsigned': /^\d+$/,
	'integer' : /^[\+\-]?\d*$/,
	'real'    : /^[\+\-]?\d*\.?\d*$/,
	'email'   : /^[\w-\.]+\@[\w\.-]+\.[a-z]{2,3}$/,
	'phone'   :  /^(\d{2})\ - (\d{4})\-(\d{4})$/,
    'numero_end'    : function (s_numero_end) {
		// check format
		if (re_numero_end.exec(s_numero_end)){
		   if (s_numero_end == 0){
			  return false;
		   }else{
			   return true;}}
	},
	'date'    : function (s_date) {
		// check format
		if (!re_dt.test(s_date))
			return false;
		// check allowed ranges	
		if (RegExp.$1 > 31 || RegExp.$2 > 12)
			return false;
		// check number of day in month
		var dt_test = new Date(RegExp.$3, Number(RegExp.$2-1), RegExp.$1);
		if (dt_test.getMonth() != Number(RegExp.$2-1))
			return false;
		return true;
	},
/*	'mes_ano'    : function (s_mes_ano) {
		// check format
		if (!re_mes_ano.test(s_mes_ano))
			return false;
		// check allowed ranges	
		if (RegExp.$1 > 12)
			return false;
		// check number of day in month
		return true;
	},*/
    'time'    : function (s_time) {
					// check format
					if (!re_tm.test(s_time))
						return false;
					// check allowed ranges	
					if (RegExp.$1 > 23 || RegExp.$2 > 59 || RegExp.$3 > 59)
						return false;
					return true;
				},
	'cnpj': function (s_cnpj){
				var i;
				if (!re_cnpj.test(s_cnpj)){
					return false;
				}
			
				s_cnpj = limpa_string(s_cnpj);
				var c = s_cnpj.substr(0,12);
				var dv = s_cnpj.substr(12,2);
				var d1 = 0;
				for (i = 0; i < 12; i++){
				d1 += c.charAt(11-i)*(2+(i % 8)); }
				if (d1 == 0){
					return false;
				}
				d1 = 11 - (d1 % 11);
				if (d1 > 9) d1 = 0;
				if (dv.charAt(0) != d1)	{
					return false;
				} 
				d1 *= 2;
				for (i = 0; i < 12; i++){
				   d1 += c.charAt(11-i)*(2+((i+1) % 8)); }
				d1 = 11 - (d1 % 11);
				if (d1 > 9) d1 = 0;
				if (dv.charAt(1) != d1){
					return false;
				}
				return true;
			},
			
    'cpf' : function (s_cpf){
	var i;
	if (!re_cpf.exec(s_cpf))
	   return false;
  	s_cpf = s_cpf.substr(0,3) + s_cpf.substr(4,3) + s_cpf.substr(8,3)+s_cpf.substr(12,2);
	var c = s_cpf.substr(0,9);
	var dv = s_cpf.substr(9,2);
	var d1 = 0;
	for (i = 0; i < 9; i++)	{
	   d1 += c.charAt(i)*(10-i); }
	if (d1 == 0) return false;
	d1 = 11 - (d1 % 11);
	if (d1 > 9) d1 = 0;
	if (dv.charAt(0) != d1)	{
	    return false; }
	 
	d1 *= 2;
	for (i = 0; i < 9; i++)	{
	   d1 += c.charAt(i)*(11-i); }
	d1 = 11 - (d1 % 11);
	if (d1 > 9) d1 = 0;
	   if (dv.charAt(1) != d1)	{
	      return false; }
	return true; }
},
a_messages = [
	'No form name passed to validator construction routine',
	'No array of "%form%" form fields passed to validator construction routine',
	'Form "%form%" can not be found in this document',
	'Incomplete "%n%" form field descriptor entry. "l" attribute is missing',
	'Can not find form field "%n%" in the form "%form%"',
	'Can not find label tag (id="%t%")',
	'Can not verify match. Field "%m%" was not found',
	'"%l%", Preenchimento Obrigatório',
	'Valor "%l%" deve conter no minimo %mn% caracteres',
	'Valor "%l%" deve conter no máximo %mx% caracteres',
	'"%v%" não é um valor válido para "%l%"',
	'"%l%" must match "%ml%"'
]

// validator counstruction routine
function validator(s_form, a_fields, o_cfg) {
	this.f_error = validator_error;
	this.f_alert = o_cfg && o_cfg.alert
		? function(s_msg) { alert(s_msg); return false }
		: function() { return false };
		
	// check required parameters
	if (!s_form)	
		return this.f_alert(this.f_error(0));
	this.s_form = s_form;
	
	if (!a_fields || typeof(a_fields) != 'object')
		return this.f_alert(this.f_error(1));
	this.a_fields = a_fields;

	this.a_2disable = o_cfg && o_cfg['to_disable'] && typeof(o_cfg['to_disable']) == 'object'
		? o_cfg['to_disable']
		: [];

	this.exec = validator_exec;
}

// validator execution method
function validator_exec(){

	if ($('#'+this.s_form).leght == 0){
		return this.f_alert(this.f_error(2));
	}

	var o_form = $('#'+this.s_form)[0];
	
//	b_dom = document.body && document.body.innerHTML;

	// check integrity of the form fields description structure
	for (var n_key in this.a_fields) {

		this.a_fields[n_key].n_error = null; /* limpa os erros */

		// check input description entry
		this.a_fields[n_key]['n'] = n_key;
		if (!this.a_fields[n_key]['t']) this.a_fields[n_key]['t'] = "e_"+n_key;

		if (!this.a_fields[n_key]['l'])
			try{
				this.a_fields[n_key]['l'] = $('#'+this.a_fields[n_key]['t'])[0].innerHTML;
				this.a_fields[n_key]['l'] = this.a_fields[n_key]['l'].replace(' : ','').replace(' :','').replace(': ','').replace(':','');
			}catch(err){}

		if ($(o_form)[0][n_key] == 0)
			return this.f_alert(this.f_error(4, this.a_fields[n_key]));

		this.a_fields[n_key].o_input = $(o_form)[0][n_key];
	}

	// reset labels highlight
	for (var n_key in this.a_fields) {
		if (!this.a_fields[n_key]['t']) this.a_fields[n_key]['t'] = "e_"+n_key;

		if ($('#'+this.a_fields[n_key]['t']).length == 0){
			return this.f_alert(this.f_error(5, this.a_fields[n_key]));
		}
		// normal state parameters assigned here
		$('#'+this.a_fields[n_key]['t']).removeClass('tfvHighlight');
	}

	// collect values depending on the type of the input
	for (var n_key in this.a_fields) {
		var s_value = '';

		o_input = this.a_fields[n_key].o_input;
		
		switch ($('#'+n_key)[0].type){
			case 'radio':
				for (var n_index = 0; n_index < o_input.length; n_index++){
					if (o_input[n_index].checked) {
						s_value = o_input[n_index].value;
						break;
					}
				}
				break;
			case 'select':
				s_value = o_input.selectedIndex > -1
					? o_input.options[o_input.selectedIndex].value
					: null;
				break;
			case 'checkbox':
				s_value = o_input.checked ? o_input.value : '';
				break;
			default:
				s_value = $('#'+this.a_fields[n_key]['n'])[0].value;
				break;
		}
		this.a_fields[n_key]['v'] = s_value.replace(/(^\s+)|(\s+$)/g, '');
	}
	
	// check for errors
	var n_errors_count = 0,
		n_another, o_format_check;
	for (var n_key in this.a_fields) {
		o_format_check = this.a_fields[n_key]['f'] && a_formats[this.a_fields[n_key]['f']]
			? a_formats[this.a_fields[n_key]['f']]
			: null;

		// reset previous error if any
		this.a_fields[n_key].n_error = null;

		if (this.a_fields[n_key]['f'] == 'real'){ // implementado por lucas para números reais
			this.a_fields[n_key]['v'] = fun_real(this.a_fields[n_key]['v']);
		}

		// check reqired fields
		if (this.a_fields[n_key]['r'] && !this.a_fields[n_key]['v']) {
			this.a_fields[n_key].n_error = 1;
			n_errors_count++;
		}
		// check length
		else if (this.a_fields[n_key]['mn'] && 
				 this.a_fields[n_key]['v'] != '' &&
				 String(this.a_fields[n_key]['v']).length < this.a_fields[n_key]['mn']) {
			this.a_fields[n_key].n_error = 2;
			n_errors_count++;
		}
		else if (this.a_fields[n_key]['mx'] && String(this.a_fields[n_key]['v']).length > this.a_fields[n_key]['mx']) {
			this.a_fields[n_key].n_error = 3;
			n_errors_count++;
		}
		// check format
		else if (this.a_fields[n_key]['v'] && this.a_fields[n_key]['f'] && (
			(typeof(o_format_check) == 'function'
			&& !o_format_check(this.a_fields[n_key]['v']))
			|| (typeof(o_format_check) != 'function'
			&& !o_format_check.test(this.a_fields[n_key]['v'])))
			) {
			this.a_fields[n_key].n_error = 4;
			n_errors_count++;
		}
		// check match	
		else if (this.a_fields[n_key]['m']) {
			for (var n_key2 in this.a_fields)
				if (n_key2 == this.a_fields[n_key]['m']) {
					n_another = n_key2;
					break;
				}
			if (n_another == null)
				return this.f_alert(this.f_error(6, this.a_fields[n_key]));
			if (this.a_fields[n_another]['v'] != this.a_fields[n_key]['v']) {
				this.a_fields[n_key]['ml'] = this.a_fields[n_another]['l'];
				this.a_fields[n_key].n_error = 5;
				n_errors_count++;
			}
		}
	}

	// collect error messages and highlight captions for errorneous fields
	var s_alert_message = '',
		e_first_error;

	if (n_errors_count) {
		for (var n_key in this.a_fields) {
			var n_error_type = this.a_fields[n_key].n_error,
				s_message = '';
				
			if (n_error_type)
				s_message = this.f_error(n_error_type + 6, this.a_fields[n_key]);

			if (s_message) {
				if (!e_first_error)
					e_first_error = o_form.elements[n_key];
				if ($('#campomsgerro')[0]){
					s_alert_message += s_message + "<br>"; 
				}else{
					s_alert_message += s_message + "\n";
				}

				// highlighted state parameters assigned here
				$('#'+this.a_fields[n_key]['t']).addClass('tfvHighlight');
			}
		}
		if ($('#campomsgerro')[0]){
			$('#campomsgerro')[0].innerHTML = '';                    
			$('#campomsgerro')[0].innerHTML = s_alert_message;
		}else{
			alert(s_alert_message);
		}
		// set focus to first errorneous field
		if (e_first_error.focus && e_first_error.type != 'hidden'  && !e_first_error.disabled)
			eval("e_first_error.focus()");
		// cancel form submission if errors detected
		return false;
	}
	
	for (n_key in this.a_2disable)
		if (o_form.elements[this.a_2disable[n_key]])
			o_form.elements[this.a_2disable[n_key]].disabled = true;

	return true;
}

function validator_error(n_index) {
	var s_ = a_messages[n_index], n_i = 1, s_key;
	for (; n_i < arguments.length; n_i ++)
		for (s_key in arguments[n_i])
			s_ = s_.replace('%' + s_key + '%', arguments[n_i][s_key]);
	s_ = s_.replace('%form%', this.s_form);
	return s_
}

function get_element (s_id) {
	return (document.all ? document.all[s_id] : (document.getElementById ? document.getElementById(s_id) : null));
}