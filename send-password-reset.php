<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$base_url = "http://localhost/quiz_funcional";

require __DIR__ . "/testeconexao.php";

$sql = "UPDATE usuarios
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($stmt->affected_rows > 0) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->addAddress($email);
    $mail->Subject = "Recuperação de senha";

    $mail->Body = "
        Clique no link para redefinir sua senha:<br><br>
        <a href='{$base_url}/reset-password.php?token={$token}'>
            Redefinir senha
        </a>
        <br><br>
        Expira em 30 minutos.
    ";

    $mail->send();
}

echo "Se o email existir, enviaremos instruções.";