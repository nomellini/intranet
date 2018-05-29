<?php 

// Configuration settings for My Site 

// Email Settings 
$site['from_name'] = "$gdousu_nome"; // from email name 
$site['from_email'] = "$f_email_usuario"; // from email address 

// Just in case we need to relay to a different server, 
// provide an option to use external mail server. 
$site['smtp_mode']     = "$gdopad_smtp_autentica"; // enabled or disabled 

$site['smtp_host']     = "$gdopad_smtp_host"; 
$site['smtp_port']     = $gdopad_smtp_port; 
$site['smtp_username'] = "$gdopad_smtp_usuario";
$site['smtp_password'] = "$gdopad_smtp_senha";
if ($gdopad_confirma_recebimento == "S")
    $site['Confirma_Recebimento'] = "$f_email_usuario";
 
?> 
