<? 
include('cabeca.inc.php');
 
   $acao = "enviado";

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
   
//   	$_smtp_host            = '192.168.0.3';
   	$_smtp_host            = '10.98.0.3';
	$_smtp_port            = '25';
	$_smtp_autentica       = 'enabled';
	$_smtp_usuario         = 'sad';
	$_smtp_senha           = 'datamace';
	$_confirma_recebimento  = 'S';
	$_texto_padrao         = 'Avaliação de Eficácia';

    $site_nome  = "Treinamento Datamace";
	$site_email = "flavia.cristina@datamace.com.br ";
	
	require_once('configmail.php'); 
    require_once('mailclass.inc.php'); 
   
    $mailer = new FreakMailer(); 
	$mailer->IsHTML(true); 
	$mailer->SetLanguage('br');
	$mailer->Subject = $_texto_padrao; 
    $mailer->AddEmbeddedImage("imagens/novologo.jpg", "img-cliente", "logo_datamace.jpg");
    $data1 = substr($data1,8,2) . '-' . substr($data1,5,2) . '-' . substr($data1,0,4);
    $texto_email_html = "Prezado Gestor, <br><br> Identificamos que continua pendente a avalia&ccedil;&atilde;o de seu colaborador. <br><br> Solicitamos, por gentileza, que seja avaliada a eficácia deste treinamento através do link abaixo.<br><br>Grato<br>Depto. Treinamento <br><br>" .
	                    "<a href='http://10.98.0.5/treinamento/eficacia1.php?id=$id'>clique aqui para avaliar</a>";
	        
			$texto_email_txt = strip_tags($texto_email_html);
			 
			require("corpoemail_envio.php");
			
		        $mailer->Body = $corpo; 
				$mailer->AltBody = unhtmlentities($corpoAlt);
				
		        $mailer->AddAddress("$email_usuario", "$nome_usuario"); 
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
//	}  
 //}

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
  <p><? echo "formul&aacute;rio $acao" ?> com sucesso !</p>
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">
<div align="center"></div>

<div align="center">Clique <a href="/treinamento/treinamento.php">aqui</a> para voltar ao menu principal.
  </p>
</div></td>
          </tr>
        </table>
        <br>
        <a href="javascript:history.go(-1)"><img src="/imagens/back_seta.jpg" width="13" height="21" border="0">voltar</a> 
        <br>
        <hr align="center">
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="1" color="#999999"> 
          Datamace Inform&aacute;tica LTDA - Todos os diretos reservados</font></p>      </td>
    </tr>
  </table>
</div>
<p align="center"></p>
</body>
</html>
