<!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset=iso-8859-1>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tudo</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    
    <script src="js/angular.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>





    
<body>

Nosso Portal<br>

Para entrar no GrhNet, clique no botão: 

<input type="button" id="btnGrhNet" title="btnGrhNet" value="GrhNet">


<p class="js-emaillink">[334123, 12]</p>
<p><button class="js-emailcopybtn">copiar</button></p>

</body>

</html>
<script>


    $(document).delegate('#btnGrhNet', 'click', function () {

        var criptoAjax = criptografarWS(
            "http://www.rhnet.com.br/BOH/WebServices/DtmCriptWebService.asmx/Criptografar"
            ,"36169046848"   // CPF DO USUÁRIO LOGADO NO seu PORTAL
            ,"dtmalterei"    // CHAVE DE CRIPTOGRAFIA, DEFINIDA NA CA DO GRHNET
            ,"Portal_web"    // Apenas descritivo
            ,"1"             // Tempo em minutos que a chave será valida
        );
            
        criptoAjax.success(function (data, status) {
            if (status == "success") {
                var retorno = $.parseJSON(data.d);
				openGrhNet(retorno);
            }
        });
        
        criptoAjax.error(function (data, status, error) {
            if (data.responseText == "")
                alert("Sem retorno Webservice");
            else
				alert(data.responseText);
				//alert($.parseJSON(data.responseText).Message);
        });

    });


function criptografarWS(pURL, pTexto, pSenha, pOrigem, pMinExpiracao) {

    return $.ajax({
        type: 'POST'
        , url: pURL
        , contentType: 'application/json; charset=utf-8'
        , dataType: 'json'		
		, crossDomain: true
        , data: "{'pTexto':'" + pTexto + "', 'pSenha':'" + pSenha + "', 'pOrigem':'" + pOrigem + "', 'pMinExpiracao':'" + pMinExpiracao + "'}"
    });

}

function openGrhNet(pCripto)
{
	window.open('http://www.rhnet.com.br/BOH/Default.aspx?LoginExterno=' + pCripto, 'Teste');
}
// Teste Fernando Nomellini

var copyEmailBtn = document.querySelector('.js-emailcopybtn');  
copyEmailBtn.addEventListener('click', function(event) {  
  // Select the email link anchor text  
  var emailLink = document.querySelector('.js-emaillink');  
  var range = document.createRange();  
  range.selectNode(emailLink);  
  window.getSelection().addRange(range);  

  try {  
    // Now that we've selected the anchor text, execute the copy command  
    var successful = document.execCommand('copy');  
    var msg = successful ? 'successful' : 'unsuccessful';  
    console.log('Copy email command was ' + msg);  
  } catch(err) {  
    console.log('Oops, unable to copy');  
  }  

  // Remove the selections - NOTE: Should use
  // removeRange(range) when it is supported  
  window.getSelection().removeAllRanges();  
});
</script> 

