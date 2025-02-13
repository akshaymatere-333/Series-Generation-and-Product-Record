<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_user' => 'zeteshubham@gmail.com',
    'smtp_pass' => 'lkcgotuvjanrfkrg', // Replace with your Gmail password (or app password)
    'mailtype' => 'html', // Set to 'text' if you want to send plain text emails
    'charset' => 'utf-8', // Character encoding for the email
    'smtp_crypto' => 'tls'
     // Use 'ssl' for port 465 and 'tls' for port 587
);