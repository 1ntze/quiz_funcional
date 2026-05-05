<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

$mail->SMTPDebug = 0; // 2 para debug

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = $_ENV['MAIL_USER'];
$mail->Password =  $_ENV['MAIL_PASS'];

$mail->isHTML(true);
$mail->CharSet = "UTF-8";

$mail->setFrom("email cyberedu", "CyberEdu®");

return $mail;
