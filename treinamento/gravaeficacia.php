<? 
include('cabeca.inc.php');

 if ($id) {
   $acao = "enviado";
   $data1 = substr($data1,6,4) . '-' . substr($data1,3,2) . '-' . substr($data1,0,2);
   $data2 = substr($data2,6,4) . '-' . substr($data2,3,2) . '-' . substr($data2,0,2);
   $datadevolucao = substr($datadevolucao,6,4) . '-' . substr($datadevolucao,3,2) . '-' . substr($datadevolucao,0,2);
    
   $sSQL = "INSERT into eficacia (titulo, entidade, instrutor, data1, data2, cargahoraria, avaliador, area, treinando, registro, datadevolucao, aprendizagem, justaprendizagem, aplicabilidade, justaplicabilidade, comportamento, justcomportamento, geral, justgeral, nomegestor) VALUES ('$titulo', '$entidade', '$instrutor', '$data1', '$data2', '$cargahoraria', '$avaliador', '$area', '$treinando', '$registro', '$datadevolucao', '$aprendizagem', '$justaprendizagem', '$aplicabilidade', '$justaplicabilidade', '$comportamento', '$justcomportamento', '$geral', '$justgeral', '$login_eficacia')"; 
  
   if(! mysql_query($sSQL)) {
      $acao = mysql_error()." n�o foi enviado";
   }else {
   
   $ideficacia= mysql_insert_id();
  
   if(!mysql_select_db(sad)) {
      echo "<br><br>Problema na sele��o do banco de dados</b><br>";
   };


   $sSQL = "select * from usuario where login = '$login_eficacia' "; 
   if (!$result = mysql_query($sSQL)) {
      echo "<br><br>Problema na aplica��o do SQL</b><br>";
   };
    if (!$linha = mysql_fetch_object($result)) {
     echo "<br><br>n�o consigo pegar o objeto</b><br>";
   };
   
    $nome_usuario = $linha->nome;
    $email_usuario = $linha->email;
   
   	$_smtp_host            = 'smtp.datamace.com.br';
	$_smtp_port            = '587';
	$_smtp_autentica       = 'enabled';
	$_smtp_usuario         = 'treino@datamace.com.br';
	$_smtp_senha           = 'treino221';
	$_confirma_recebimento  = 'N';
	$_texto_padrao         = 'Avalia��o de Efic�cia';
	
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
    $texto_email_html = "Prezado Gestor, <br><br> Identificamos a participa��o de seu colaborador $treinando no treinamento $titulo realizado em $data1. <br><br> Solicitamos, por gentileza, que seja avaliada a efic�cia deste treinamento atrav�s do link abaixo.<br><br>Grato<br>Depto. de Talentos Humanos<br><br>" .
	                    "<a href='http://192.168.0.14/treinamento/eficacia1.php?id=$ideficacia'>clique aqui para avaliar</a>";
	        
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
					$retorno .= "<tr><td>&nbsp;&nbsp;<br>Erro:<br> $mailer->ErrorInfo <br>$login_eficacia</td></tr>";
					$ok = '';
					$msg = "";
                } else { 
                    $retorno .= "<tr><td class=texthomeVerm> efic�cia enviado</td></tr>"; 
					$msg = "com sucesso !";
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
 
<title>Datamace Inform�tica</title>
 
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
  <p><? echo "formul&aacute;rio $acao" ?> <? $msg ?></p>
  <table width="100%" border="0">
    <tr> 
      <td><table width="100%" border="0" bordercolorlight="#FFCC30" bordercolordark="#FFCC30">
          <tr>
            <td width="77%" align="left" valign="top" bgcolor="#FFFFFF">
				<div align="center">Clique <a href="/treinamento/eficacia.php">aqui</a> para incluir uma nova avalia��o de efi�cia.</div>
				<br>
				<br>
				<div align="center">Clique <a href="/treinamento/treinamento.php">aqui</a> para voltar ao menu principal.</div>
				</td>
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
<p align="center">&nbsp;</p>
</body>
</html>
