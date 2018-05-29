/*
COMEÇA A FORMATAÇÃO DE REAIS
*********************************************************************************************************************************
*/

documentall = document.all;
/*
* função para formatação de valores monetários
*/
function formatamoney(c) {
    var t = this;
	if(c == undefined) c = 2;		
    var p, d = (t=t.split("."))[1].substr(0, c);
    for(p = (t=t[0]).length; (p-=3) >= 1;) {
	        t = t.substr(0,p) + "." + t.substr(p);
    }
    return t+","+d+Array(parseFloat(c)+1-d.length).join(0);
}

String.prototype.formatCurrency = formatamoney;

function demaskvalue(valor, currency, TAM){
/*
* Se currency é false, retorna o valor sem apenas com os números. Se é true, os dois últimos caracteres são considerados as 
* casas decimais
*/
var val2 = '';
var strCheck = '0123456789';
var len = valor.length;
	if (len== 0){
		return 0.00;
	}

	if (currency ==true){	
		/* Elimina os zeros à esquerda 
		* a variável  <i> passa a ser a localização do primeiro caractere após os zeros e 
		* val2 contém os caracteres (descontando os zeros à esquerda)
		*/
		
		for(var i = 0; i < len; i++)
			if ((valor.charAt(i) != '0') && (valor.charAt(i) != ',')) break;
		
		for(; i < len; i++){
			if (strCheck.indexOf(valor.charAt(i))!=-1) val2+= valor.charAt(i);
		}

		switch (TAM){
			case '1':
				if (val2.length==0)return "0.0";
				if (val2.length==1)return "0." + val2;
				break;
			case '2':
				if (val2.length==0)return "0.00";
				if (val2.length==1)return "0.0" + val2;
				if (val2.length==2)return "0." + val2;
				break;
			case '3':
				if (val2.length==0)return "0.000";
				if (val2.length==1)return "0.00" + val2;
				if (val2.length==2)return "0.0" + val2;
				if (val2.length==3)return "0." + val2;
				break;
			case '4':
				if (val2.length==0)return "0.0000";
				if (val2.length==1)return "0.000" + val2;
				if (val2.length==2)return "0.00" + val2;
				if (val2.length==3)return "0.0" + val2;
				if (val2.length==4)return "0." + val2;
				break;
		}

		var parte1 = val2.substring(0,val2.length-TAM);
		var parte2 = val2.substring(val2.length-TAM);
		var returnvalue = parte1 + "." + parte2;
		return returnvalue;
		
	}
	else{
			/* currency é false: retornamos os valores COM os zeros à esquerda, 
			* sem considerar os últimos 2 algarismos como casas decimais 
			*/
			val3 ="";
			for(var k=0; k < len; k++){
				if (strCheck.indexOf(valor.charAt(k))!=-1) val3+= valor.charAt(k);
			}			
	return val3;
	}
}

function reais(obj,evt, TAM){

	if ((!TAM) || (TAM <= 0)){
		TAM = 2;
	}

//	var whichCode = (window.Event) ? evt.which : evt.keyCode;
	if (navigator.appName == 'Microsoft Internet Explorer') {   
			whichCode = evt.keyCode;   
		} else if (navigator.appName == 'Netscape') {   
			whichCode = evt.which;   
		}   

	/*
	Executa a formatação após o backspace nos navegadores !document.all
	*/
	if (whichCode == 8 && !documentall) {	
	/*
	Previne a ação padrão nos navegadores
	*/
		if (evt.preventDefault){ //standart browsers
				evt.preventDefault();
			}else{ // internet explorer
				evt.returnValue = false;
		}
		var valor = obj.value;
		var x = valor.substring(0,valor.length-1);
		obj.value= demaskvalue(x,true,TAM).formatCurrency(TAM);
		return false;
	}
/*
Executa o Formata Reais e faz o format currency novamente após o backspace
*/
FormataReais(obj,'.',',',evt, TAM);
} // end reais


function backspace(obj,evt, TAM){
/*
Essa função basicamente altera o  backspace nos input com máscara reais para os navegadores IE e opera.
O IE não detecta o keycode 8 no evento keypress, por isso, tratamos no keydown.
Como o opera suporta o infame document.all, tratamos dele na mesma parte do código.
*/
	if ((!TAM) || (TAM <= 0)){
		TAM = 2;
	}


//var whichCode = (window.Event) ? evt.which : evt.keyCode;
	if (navigator.appName == 'Microsoft Internet Explorer') {   
			whichCode = evt.keyCode;   
		} else if (navigator.appName == 'Netscape') {   
			whichCode = evt.which;   
		}   
	if (whichCode == 8 && documentall) {	
		var valor = obj.value;
		var x = valor.substring(0,valor.length-1);
		var y = demaskvalue(x,true,TAM).formatCurrency(TAM);
	
		obj.value =""; //necessário para o opera
		obj.value += y;
		
		if (evt.preventDefault){ //standart browsers
				evt.preventDefault();
			}else{ // internet explorer
				evt.returnValue = false;
		}
		return false;
	
	}// end if		
}// end backspace

function FormataReais(fld, milSep, decSep, e, TAM) {

	if ((!TAM) || (TAM <= 0)){
		TAM = 2;
	}

var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';
//var whichCode = (window.Event) ? e.which : e.keyCode;
if (navigator.appName == 'Microsoft Internet Explorer') {   
        whichCode = e.keyCode;   
    } else if (navigator.appName == 'Netscape') {   
        whichCode = e.which;   
    }   


//if (whichCode == 8 ) return true; //backspace - estamos tratando disso em outra função no keydown
if (whichCode == 0 ) return true;
if (whichCode == 9 ) return true; //tecla tab
if (whichCode == 13) return true; //tecla enter
if (whichCode == 16) return true; //shift internet explorer
if (whichCode == 17) return true; //control no internet explorer
if (whichCode == 27 ) return true; //tecla esc
if (whichCode == 34 ) return true; //tecla end
if (whichCode == 35 ) return true;//tecla end
if (whichCode == 36 ) return true; //tecla home

/*
O trecho abaixo previne a ação padrão nos navegadores. Não estamos inserindo o caractere normalmente, mas via script
*/

if (e.preventDefault){ //standart browsers
		e.preventDefault()
	}else{ // internet explorer
		e.returnValue = false
}

var key = String.fromCharCode(whichCode);  // Valor para o código da Chave
if (strCheck.indexOf(key) == -1) return false;  // Chave inválida

/*
Concatenamos ao value o keycode de key, se esse for um número
*/
fld.value += key;

var len = fld.value.length;
var bodeaux = demaskvalue(fld.value,true,TAM).formatCurrency(TAM);
fld.value=bodeaux;

/*
Essa parte da função tão somente move o cursor para o final no opera. Atualmente não existe como movê-lo no konqueror.
*/
  if (fld.createTextRange) {
    var range = fld.createTextRange();
    range.collapse(false);
    range.select();
  }
  else if (fld.setSelectionRange) {
    fld.focus();
    var length = fld.value.length;
    fld.setSelectionRange(length, length);
  }
  return false;

}

/* TERMINA A FORMATAÇÃO DE REAIS
*********************************************************************************************************************************
*********************************************************************************************************************************
*********************************************************************************************************************************
*/

// Utilização de fun_numerico
//$('#'+$input[0].id).live('keydown', function(event) {
//	return fun_numerico(event);
//});
function fun_numerico(e){
	-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()
}

function txtBoxFormat(objeto, sMask, evtKeyPress) {
	var i, nCount, sValue, fldLen, mskLen,bolMask, sCod, nTecla;
	var tecla = evtKeyPress.keyCode;
	
	if(document.all) { // Internet Explorer
		nTecla = evtKeyPress.keyCode;
	}else if(document.layers){ // Nestcape
		nTecla = evtKeyPress.which;
	}else{
		nTecla = evtKeyPress.which;
	}

	if (tecla == 8 || tecla == 9 || tecla == 13 || tecla == 46){
		return true;
	}
	
	sValue = objeto.value;
	
	// Limpa todos os caracteres de formatação que
	// já estiverem no campo.
	sValue = sValue.toString().replace(/-/g, ""); 
	sValue = sValue.toString().replace(/\./g, ""); 
	sValue = sValue.toString().replace(/\//g, ""); 
	sValue = sValue.toString().replace(/:/g, ""); 
	sValue = sValue.toString().replace(/\(/g, ""); 
	sValue = sValue.toString().replace(/\)/g, ""); 
	sValue = sValue.toString().replace(/\s/g, ""); 
/*
	sValue = sValue.toString().replace( "-", "" );
	sValue = sValue.toString().replace( "-", "" );
	sValue = sValue.toString().replace( ".", "" );
	sValue = sValue.toString().replace( ".", "" );
	sValue = sValue.toString().replace( "/", "" );
	sValue = sValue.toString().replace( "/", "" );
	sValue = sValue.toString().replace( ":", "" );
	sValue = sValue.toString().replace( ":", "" );
	sValue = sValue.toString().replace( "(", "" );
	sValue = sValue.toString().replace( "(", "" );
	sValue = sValue.toString().replace( ")", "" );
	sValue = sValue.toString().replace( ")", "" );
	sValue = sValue.toString().replace( " ", "" );
	sValue = sValue.toString().replace( " ", "" );
*/	
	fldLen = sValue.length; 
	mskLen = sMask.length;

	i		= 0;
	nCount	= 0;
	sCod	= "";
	mskLen	= fldLen;
	
	while (i <= mskLen){
		bolMask = ((sMask.charAt(i) == "-") || (sMask.charAt(i) == ".") || (sMask.charAt(i) == "/") || (sMask.charAt(i) == ":"))
		bolMask = bolMask || ((sMask.charAt(i) == "(") || (sMask.charAt(i) == ")") || (sMask.charAt(i) == " "))
		
		if (bolMask) {
			sCod += sMask.charAt(i);
			mskLen++;
		}else {
			sCod += sValue.charAt(nCount);
			nCount++;
		}
		i++;
	}

	objeto.value = sCod;
	
	if (nTecla != 8) { // backspace
		if (sMask.charAt(i-1) == "9") { // apenas números...
			return ((nTecla > 47) && (nTecla < 58));
		}else { // qualquer caracter...
			return true;
		} 
	}else{
		return true;
	}
}

//Termina a Função ENTER VIRA TABULACAO

function entertab(formc,campo){
	if (!campo || !formc){
		return false;
	}
	
	nextfield = campo;
	prevfield = campo;
	netscape = '';
	ver  = navigator.appVersion; len = ver.length;
	
	for(iln = 0; iln < len; iln++){
		if (ver.charAt(iln) == '('){
			break;
		}
	}
	netscape = (ver.charAt(iln+1).toUpperCase() != 'C');
	
	function keyDown(DnEvents) {
		k    = (netscape) ? DnEvents.which : window.event.keyCode;
		nome = (navigator.appName == 'Netscape') ? DnEvents.target.name: event.srcElement.name;        
		objnext = eval(formc + '.' + nextfield );		
		typenext = objnext.type;
		if (!typenext) {  
			objnext = eval(formc + '.' + nextfield + '[0]' );
			typenext = objnext.type;
		}
		if (nome == 'pessoa_sexo'){// Específico Café Miragem
			if (k == 70){
				eval(formc + '.' + nome + '[1].checked = true;');
			}
			if (k == 77){
				eval(formc + '.' + nome + '[0].checked = true;');
			}
		}
		
		if ((k == 9) ||(k == 13) || (k == 40) ||(k == 34)){
			if (nextfield == 'done') {
				return false;
			}else{
				if (typenext == 'radio'){
					try{
						eval(formc + '.' + nextfield + '[0].focus();');
						eval(formc + '.' + nextfield + '[0].select();');
					}catch(e){
						return false;
					}
				}else{
					if ((formc) && (nextfield)){
						try{
							eval(formc + '.' + nextfield + '.focus();');
						}catch(error){
							return false;
						}
					}
				}
				return false;
			}
		}
		
		objprev = eval(formc + '.' + prevfield );
		typeprev = objprev.type;
		if (!typeprev){
			objprev = eval(formc + '.' + prevfield + '[0]' );
			typeprev = objprev.type;
		}
	
		if ((k == 27) ||(k == 38) || (k == 33)) { 
			if (prevfield == 'done') {
				return false;
			}else{
				if (typeprev == 'radio'){
					eval(formc + '.' + prevfield + '[0].focus();');
					eval(formc + '.' + prevfield + '[0].select();');
				}else{
					eval(formc + '.' + prevfield + '.focus()');
				}
				return false;
			}
		}		
	}

	//  document.onkeydown = keyDown;
	//  if (netscape) document.captureEvents(Event.KEYDOWN|Event.KEYUP);
	if (document.addEventListener){
		document.addEventListener('keydown', keyDown, false); 
	} else if (document.attachEvent){
		document.attachEvent('onkeydown', keyDown);
	}
}