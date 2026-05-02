<?php 
$token = $_GET["token"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Redefinir Senha | CyberEdu®</title>

<!-- Fonte Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="Icon.png">

<style>
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: 
        linear-gradient(135deg, rgba(15, 23, 42, 0.8), rgba(30, 41, 59, 0.8)),
        url('bgrs.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #fff;
    }

    .container {
        background: #111827;
        width: 360px;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.5);
        text-align: center;
    }

    /* ESPAÇO DA IMAGEM */
    .image-box {
        width: 100%;
        height: 160px;
        border-radius: 10px;
        margin-bottom: 15px;
        background: url('iconrdf.png') center/cover no-repeat;
    }

    h2 {
        margin-bottom: 20px;
        color: #38bdf8;
        font-weight: 600;
    }

    label {
        font-size: 13px;
        text-align: left;
        display: block;
        margin-top: 10px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: none;
        border-radius: 8px;
        background: #1f2937;
        color: #fff;
        outline: none;
    }

    input:focus {
        border: 1px solid #38bdf8;
    }

    button {
        width: 100%;
        padding: 12px;
        margin-top: 18px;
        border: none;
        border-radius: 8px;
        background: #38bdf8;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #0ea5e9;
    }

    .hint {
        font-size: 12px;
        margin-top: 10px;
        color: #94a3b8;
    }

    
</style>

</head>
<body>

<div class="container">

    <!-- ESPAÇO DA IMAGEM -->
    <div class="image-box"></div>

    <h2>Redefinição de Senha</h2>

    <form method="POST" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label>Nova senha</label>
        <input type="password" name="password" required>

        <label>Confirmar senha</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Alterar senha</button>

    </form>

    <div class="hint">
        Use uma senha forte com pelo menos 8 caracteres e símbolos!
    </div>

</div>

</body>
</html>