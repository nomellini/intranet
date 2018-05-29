
//numero.js
function isNumeric(v)
{
 return /^[0-9]+$/.test(v);
}
function removeSpcChars(vr,type){
var ret="",
	re=/197|198|208|215|216|222|223|229|230|240|247|248/,
	c=0,
	s=String(vr);
	
for(var i=0; i < s.length; i++)
{
 c = s.charCodeAt(i);
 if((c>31&&c<253&&(c<127||c>191)&&!re.test(c))||(type=="textarea"&& (c==9||c==13||c==10)))ret+=s.charAt(i);
}
return ret;
}

function numero(event,el,tp)
{
 var t = (typeof event.which != "undefined" && event.which != null ? event.which : event.keyCode), key;
 key = removeSpcChars(String.fromCharCode(t), el.type);
 var tp_sp=/^sp_/.test(tp);
 
 if (!key) return true;
 
 if(/^(percent|percent_interval|(neg_)?(numeric|float(\d{0,1})|money(\d{0,1})))$/.test(tp))
	{
	 return isNumeric(key)||(!/numeric/.test(tp)&&key==","&&el.value.indexOf(",")==-1)||
			(/^neg_/.test(tp)&&key=="-" && el.value.indexOf("-")==-1);
	}
else
	{
	 switch(tp)
		{
		 default: return isNumeric(key);
		}
	}
}
function _isRE(re)
{
 return typeof re=="object" && typeof re.test=="function";
}