function isOn(isValid)
{
	if (isValid)
	{
		$("#menuSenha").css('visibility','hidden');
		$("#menuSenha2").css('visibility','hidden');
		$("#menuPrincipal").css('visibility','visible');
		$("#menuPrincipal2").css('visibility','visible');
	}
	else
	{
		$("#menuSenha").css('visibility','visible');
		$("#menuSenha2").css('visibility','visible');
		$("#menuPrincipal").css('visibility','hidden');
		$("#menuPrincipal2").css('visibility','hidden');
	}
}

function alertaFalso()
{
	alert("Código inválido. Verifique com o instrutor o código de liberação!");
}

$("#BTNDesbloquear").bind('click', function(){
	$.ajax(
	{
		url: "ajax.php?ajaxDTM=confirmaCRC&conf_crc="+$('#conf_crc')[0].value,
		context: document.body,
		success: function(result)
		{
			isOn(result);
			if (result &&
			    result.toString() != 'undefined')
			{
				var _Res = result.split(':');
				var _Data = new Date();
				_Data.setHours(_Res[0], _Res[1], 59);
				$.cookie("xDTMx", $('#conf_crc')[0].value, { expires : _Data });
			}
			else
			{
				alertaFalso();
			}
		}
	})
});



if ($.cookie("xDTMx").toString() != 'undefined')
{
	isOn(true);
}
