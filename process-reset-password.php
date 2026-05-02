<?php

$token = $_POST["token"];
$token_hash = hash("sha256", $token);

include __DIR__ . "/testeconexao.php";

global $conn;

$sql = "SELECT * FROM usuarios WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("Token inválido.");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token expirado.");
}

$password = $_POST["password"];

if (strlen($password) < 8) {
    die("Senha muito curta.");
}

if ($password !== $_POST["password_confirmation"]) {
    die("Senhas não conferem.");
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios
        SET senha = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id_usuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $password_hash, $user["id_usuario"]);
$stmt->execute();

echo "Senha alterada com sucesso!";