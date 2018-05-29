function IsMail( email ) {
//- -------------------------------------------------------
	//var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	//if (!(filter.test(p))) return false;
	var invalidchars = "/:,;";
	if ( email == ""){ return false; }
	for (i=0; i<invalidchars.length; i++) {
		badchar = invalidchars.charAt(i);
		if (email.indexOf(badchar,0) > -1) { return false; }
	}
	atpos = email.indexOf("@",1);
	if (atpos == -1) { return false; }
	if (email.indexOf("@",atpos+1)>-1) { return false; }
	periodpos = email.indexOf(".",atpos)
	if (periodpos == -1) { return false; }
	if (periodpos+3 > email.length) { return false; }
	return true;
}
var _Field = '';
function EnterField( pFIELD, pCOLORin, pCOLORout ){
//- -------------------------------------------------------
	if (_Field == '') {
		if (pFIELD) pFIELD.style.background = pCOLORin;
		_Field = pFIELD;
	}
	else {
		if (_Field) _Field.style.background = pCOLORout;
		if (pFIELD) pFIELD.style.background = pCOLORin;
		_Field = pFIELD;
	}
}
function fun_focaliza(campo1,campo2) {
if (!campo1.value) 
    campo1.focus();
else
   campo2.focus();
}

function abre_pesquisa_menor(programa,tamx,tamy,qtde_por_pag,f_campo_ret,f_campo_descr,exec_pesq,prog) {
    programa += '?qtde_por_pag=' + qtde_por_pag + '&f_campo_ret=' + f_campo_ret + 
	            '&f_campo_descr=' + f_campo_descr + '&exec_pesq=' + exec_pesq +
				'&f_prog=' + prog; 
	open(programa,'','toolbar=no,status=yes,scrollbar=no,resize=no,width=' + tamx + ',height=' + tamy + ',top=150,left=200');
}
function fun_retorna_registro(reg,descr) {
<?= ($f_campo_ret) ? "parent.opener.document.getElementById('$f_campo_ret').value=reg;" : ""; ?>
<?= ($f_campo_descr) ? "parent.opener.document.getElementById('$f_campo_descr').$gdoc_inner=descr;" : ""; ?>
//	parent.opener.document.form.<?=($f_campo_ret) ? $f_campo_ret : 'procid' ?>.value=reg;
//	parent.opener.document.form.<?=($f_campo_descr) ? $f_campo_descr : 'procid' ?>.value=descr;
<?  if ($exec_pesq) {
	    print 'parent.opener.document.form.procid.value=1;
	           parent.opener.document.form.submit();';
    }
?>
	window.close();
}

function fun_carrega_descricao(programa,f_campo_valor,f_campo_ret,f_campo_descr,tabela,campo1,campo2,iframe) {
    programa += '?f_campo_valor=' + f_campo_valor + 
	            '&f_campo_ret=' + f_campo_ret +
	            '&f_campo_descr=' + f_campo_descr +
				'&f_tabela=' + tabela +
				'&f_campo1=' + campo1 + 
				'&f_campo2=' + campo2 ; 
	open(programa,iframe);
}

if (window.Event) document.captureEvents(Event.MOUSEUP); 

function nocontextmenu() 
{ 
return true;
event.cancelBubble = true 
event.returnValue = false; 

return false; 
} 

function norightclick(e) 
{ 
if (window.Event) 
{ 
if (e.which == 2 || e.which == 3) 
return false; 
} 
else 
if (event.button == 2 || event.button == 3) 
{ 
event.cancelBubble = true 
event.returnValue = false; 
return false; 
} 

} 
if (document.layers) { 
document.captureEvents(Event.MOUSEDOWN); 
} 
document.oncontextmenu = nocontextmenu; 
document.onmousedown = norightclick; 
document.onmouseup = norightclick;

