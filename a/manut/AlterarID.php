<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Altera&ccedil;&atilde;o de ID</title>
<link href="../stilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<blockquote>
  <p><strong>Aten&ccedil;&atilde;o</strong>. Nesta tela &eacute; poss&iacute;vel trocar os Id's de um determinado cliente por outro Id, esta rotina afeta somente a tabela de chamados, onde um Id de cliente do chamado est&aacute; amarrada com um Id de cliente na tabela de clientes. Quando no DIP este ID &eacute; alterado, os chamados do cliente devem ser atualizados para refletir este novo ID.<br />
    <strong>-&gt; 
  Use esta tela com sabedoria.</strong></p>
  <p>Digite o ID atual do cliente e tecle TAB. Se o ID existir, vc saber&aacute; quantos chamados ser&atilde;o afetados.<br />
    <br />
    Digite o ID novo, igual ao DIP e tecle TAB. O Sistema ir&aacute; verificar se este ID n&atilde;o est&aacute; em uso.<br />
    <br />
    Digite seu login no SAD e Sua senha e tecle TAB. Se estiver tudo certo voc&ecirc; ver&aacute; o bot&atilde;o de OK. <br />
  Ao apertar o bot&atilde;o o sistema pedir&aacute; a confirma&ccedil;&atilde;o, para confimar clique no OK da janela de confirma&ccedil;&atilde;o. </p>
</blockquote>
<form id="form1" name="form1" method="post" action="doAlterarID.php">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="113">Cliente Atual </td>
      <td width="869"><label>
      <input name="id_cliente" type="text" class="borda_fina" id="id_cliente" onblur="procura(document.form1.id_cliente.value)" size="16" maxlength="15" />
      <span id="nome"></span></label></td>
    </tr>
    <tr>
      <td>Alterar ID para </td>
      <td><label>
        <input name="novo_id" type="text" class="borda_fina" id="novo_id" size="16" maxlength="15" onblur="procura2(document.form1.novo_id.value)"  />
      <span id="nome2"></span></label></td>
    </tr>
    <tr>
      <td>Login no sad </td>
      <td><label>
        <input name="login" type="text" class="borda_fina" id="login" size="15" maxlength="15" />
        senha no sad
        <input name="senha" type="password" class="borda_fina" id="senha" size="15" maxlength="15" onblur="procura3(document.form1.login.value, document.form1.senha.value)" />
      tecle tab </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
	  <span id="nome3"></span></td>
    </tr>
  </table>
  <br />
<?
  echo $msg;
?> SAD 2007
</form>
</body>
</html>
<script>

url = document.location.href;
xend = url.lastIndexOf("/") + 1;
var base_url = url.substring(0, xend);
function ajax_do (url) {
        // Does URL begin with http?
		
        if (url.substring(0, 4) != 'http') {
                url = base_url + url;
        }

        // Create new JS element
        var jsel = document.createElement('SCRIPT');
        jsel.type = 'text/javascript';
        jsel.src = url;

        // Append JS element (therefore executing the 'AJAX' call)
        document.body.appendChild (jsel);
}


  function procura(AIdCliente) {
	ajax_do ('ajax_02.php?id_cliente='+AIdCliente);    
  }

  function procura2(AIdCliente) {
	ajax_do ('ajax_03.php?id_cliente='+AIdCliente);    
  }

  function procura3(ALogin, ASenha) {
	ajax_do ('ajax_04.php?login='+ALogin+'&senha='+ASenha);    
  }

  function vai() {
  
    if (document.form1.id_cliente.value==0) {
	  alert('Selecione um cliente');
	  document.form1.id_cliente.focus();
	  return false;
	}
	
	

	if (document.form1.novo_id.value=='') {
	  alert('Digite o Novo ID deste cliente, igual ao DIP');
	  document.form1.novo_id.focus();
	  return false;
	}
	

	if (document.form1.senha.value=='') {
	  alert('Digite sua senha');
	  document.form1.senha.focus();
	  return false;
	}
	
    var confirma = confirm('ATENÇÂO !!!!\nEsta alteração irá alterar todos os chamados do SAD referente \nao cliente selecionado. Confirma ??');

	
	if (confirma==true) {
		document.form1.submit();  
	} else
	{
	  return false;
	}

	
  }
  
  document.form1.id_cliente.focus();
  
</script>
