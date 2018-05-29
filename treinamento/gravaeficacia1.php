<? 
include('cabeca.inc.php');

 if ($id) {
   $acao = "enviado";
   $data1 = substr($data1,6,4) . '-' . substr($data1,3,2) . '-' . substr($data1,0,2);
   $data2 = substr($data2,6,4) . '-' . substr($data2,3,2) . '-' . substr($data2,0,2);
   $datadevolucao = substr($datadevolucao,6,4) . '-' . substr($datadevolucao,3,2) . '-' . substr($datadevolucao,0,2);
    
   $sql = "update usuario set estado = $status, estado_hora = '$agoraTimeStamp' where id_usuario = $ok";
		$result = mysql_query($sql);		
			
   $sSQL = "UPDATE eficacia SET  aprendizagem = '$aprendizagem', justaprendizagem = '$justaprendizagem', aplicabilidade = '$aplicabilidade', justaplicabilidade = '$justaplicabilidade', comportamento = '$comportamento', justcomportamento = '$justcomportamento', geral= '$geral', justgeral = '$justgeral'  where id = $id;"; 
  
  
   if(! mysql_query($sSQL)) {
      $acao = mysql_error()." não foi enviado";
   }else {
   
   $ideficacia= mysql_insert_id();


   if(!mysql_select_db(sad)) {
      echo "<br><br>Problema na seleção do banco de dados</b><br>";
   };

   $sSQL = "select * from usuario where login = '$login_eficacia' "; 
   if (!$result = mysql_query($sSQL)) {
      echo "<br><br>Problema na aplicação do SQL</b><br>";
   };
    if (!$linha = mysql_fetch_object($result)) {
     echo "<br><br>não consigo pegar o objeto</b><br>";
   };
   
    $nome_usuario = $linha->nome;
    $email_usuario = $linha->email;
   
   	$_smtp_host            = 'smtp.datamace.com.br';
	$_smtp_port            = '587';
	$_smtp_autentica       = 'enabled';
	$_smtp_usuario         = 'treino@datamace.com.br';
	$_smtp_senha           = 'treino221';
	$_confirma_recebimento  = 'N';
	$_texto_padrao         = 'Formulário Eficácia';

    $site_nome  = "Datamace";
	$site_email = "debora.ulrich@datamace.com.br";
	$cc_email   = "janaina.queiroga@datamace.com.br ";
	$cc_nome    = "Janaina Queiroga";
	require_once('configmail.php'); 
    require_once('mailclass.inc.php'); 
   
    $mailer = new FreakMailer(); 
	$mailer->IsHTML(true); 
	$mailer->SetLanguage('br');
	$mailer->Subject = $_texto_padrao; 
    $mailer->AddEmbeddedImage("imagens/novologo.jpg", "img-cliente", "logo_datamace.jpg");

    $texto_email_html = "Formulário foi preenchido <br><br>" .
						
						"<a href='http://http://192.168.0.14//treinamento/resulteficacia.php?id=$id'>clique aqui para ver.</a>";
	        
			$texto_email_txt = strip_tags($texto_email_html);
			 
			require("corpoemail_envio.php");
			
		        $mailer->Body = $corpo; 
				$mailer->AltBody = unhtmlentities($corpoAlt);
				
		        $mailer->AddAddress("flavia.cristina@datamace.com.br", "Flavia"); 
		        if (trim($cc_email)) {
					$mailer->AddCC("$cc_email", "$cc_nome"); 
				}	
		        if (!$mailer->Send()) { 
                    $retorno .= "<tr><td>Problemas no envio do email </td></tr>"; 
					$retorno .= "<tr><td>&nbsp;&nbsp;Erro: $mailer->ErrorInfo </td></tr>";
					$ok = '';
                } else { 
                    $retorno .= "<tr><td class=texthomeVerm> eficácia enviado</td></tr>"; 
                } 
                $mailer->ClearAddresses(); 
                $mailer->ClearAttachments(); 
   
   
      $acao = "$retorno";
	}  
 }

 ?>

<html>
<!-- DW6 -->
<head>
 
<title>Datamace Informática</title>
 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="/Templates/stilo.css" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 18px; font-weight: normal; font-family: Verdana, Arial, Helvetica, sans-serif;}
.style3 {color: #000099}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div align="center">
  <table width="100%" border="0">
    <tr>
      <th width="17%" scope="col"><div align="left"><img src="imagens/novologo.jpg" width="155" height="41" alt="" /></div></th>
      <th width="41%" scope="col"><span class="style1">Avalia&ccedil;&atilde;o da Efic&aacute;cia do Treinamento </span></th>
      <th width="42%" scope="col">&nbsp;</th>
    </tr>
  </table>
  <p><b> <? echo "formul&aacute;rio $acao" ?></b> com sucesso !</p>
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">


<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;}
-->
</style>
<p align="center">            Clique <a href="javascript:window.close()" >aqui</a><a href="/treinamento/"></a> para fechar a janela.<br>
ou<br>
Clique <a href="../index.php" >aqui</a><a href="/treinamento/"></a> para ir para a intranet.</p>
</td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"></a> 
        <br>
        <hr align="center">
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> 
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>      </td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
</body>
</html>
