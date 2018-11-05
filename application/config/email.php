<?php

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.zoho.com';
$config['smtp_port'] = 465;
$config['smtp_timeout'] = '7';
$config['smtp_user'] = 'support@la3andak.com';
$config['smtp_pass'] = 'Tech@123';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['mailtype'] = 'html'; // or html
$config['validation'] = FALSE; // bool whether to validate email or not


//$config['protocol'] = 'sendmail';
//$config['mailpath'] = '/usr/sbin/sendmail';
//$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;