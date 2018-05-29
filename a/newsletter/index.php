<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body><br>
Utiliza esta p&aacute;gina para enviar email a todos os colaboradores cadstrador 
no sad.<br>
Role tela e veja um exemplo de como deve ser o corpo da mensgem<br>

<form name="form1" method="post" action="email.php">
  <table width="98%" border="0" cellspacing="1" cellpadding="1">
    <tr> 
      <td width="14%" valign="top">Email</td>
      <td width="86%" valign="top"><p>Voc&ecirc; pode digitar mais do que um email separados 
          por virgula.<br>
          Se nao digitar nada, o email &eacute; enviado para todos os colaboradores.<br>
          <input name="email" type="text" id="email" size="80">
        </p>
        </td>
    </tr>
    <tr> 
      <td valign="top"><p>Corpo<br>
          <br>
          vc pode usar<br>
          no corpo da<br>
          Mensagem:</p>
        <p>[data]<br>
          [hora]<br>
          [usuario] </p>
        </td>
      <td valign="top"><textarea name="corpo" cols="80" rows="20" id="corpo"></textarea></td>
    </tr>
    <tr> 
      <td valign="top">Assunto</td>
      <td valign="top"><input name="assunto" type="text" id="assunto"></td>
    </tr>
    <tr>
      <td><input type="button" name="Button" value="Button" onClick="vai()"></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<pre>
e-Newsletter Datamace ::[data] [hora]:[usuario]:

  - RH STUDIO - EVENTOS PROGRAMAVEIS
  - O QUE É ISSO ?
  - NEWSGROUP

---------------------------------------------------------------

  RH STUDIO - EVENTOS PROGRAMAVEIS

  Aqui vai o assunto a ser discutido ou esclarecido.   Aqui vai
o assunto a ser discutido ou esclarecido.   Aqui vai o assunto
a ser discutido ou esclarecido.   Aqui vai o assunto a ser
discutido ou esclarecido.   Aqui vai o assunto a ser discutido
ou esclarecido.   Aqui vai o assunto a ser discutido ou escla-
recido. Aqui vai o assunto a ser discutido ou esclarecido.

Para parcitipar dessa disussão, por favor, não responde a este
email, e sim entre no nosso news, clicando no link abaixo:

<a href="news://10.1.0.51/dtm.softwares.rhstudio>

---------------------------------------------------------------

  O QUE É ISSO ?

  Você está recebendo o e-newsletter, uma publicação sem
periodicidade definida, enviada por email focando determinado
assunto de alguma área da empresa. O  e-newsletter tem como
objetivo manter os colaboradores atualizados com o que está
acontecendo, como também para chamar todos os colaboradores
a discutir algum assunto de interesse da empresa como um todo.

---------------------------------------------------------------

  NEWSGROUP

  Chamados grupos de notícias, ou newsgroups, ou, muitas vezes
apenas news, é um local dividido por assuntos que os colabo-
radores podem discutir um assunto. semelhante ao nosso FORUM.
  Para entrar em algum grupo, primeiro você deve configurar o
programa de email, contate o suporte interno para ajudar na 
configuração.

</pre>
</body>
</html>

<script>
	function vai() {
		if (document.form1.email.value=='') {
			if ( window.confirm('Este news será enviado para todos os colaboradore, confirma ?') ) {
				document.form1.submit();
			}
		} else {
			document.form1.submit();
		}
	}
</script>