<?php 

// Configuration settings for My Site 

// Email Settings 
$site['from_name'] = "$site_nome"; // from email name 
$site['from_email'] = "$site_email"; // from email address 

// Just in case we need to relay to a different server, 
// provide an option to use external mail server. 
$site['smtp_mode']     = "$_smtp_autentica"; // enabled or disabled 

$site['smtp_host']     = "$_smtp_host"; 
$site['smtp_port']     =  $_smtp_port; 
$site['smtp_username'] = "$_smtp_usuario";
$site['smtp_password'] = "$_smtp_senha";
 
?> 
