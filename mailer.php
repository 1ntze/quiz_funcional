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

$mail->Username = "cyberedu.noreply@gmail.com";
$mail->Password = "nind ogbu vhvo eymu";

$mail->isHTML(true);
$mail->CharSet = "UTF-8";

$mail->setFrom("cyberedu.noreply@gmail.com", "CyberEdu®");

return $mail;