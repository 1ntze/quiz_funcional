<?php
session_start();
include("testeconexao.php");
if(isset($_SESSION['id_usuario'])){
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){

    $usuario = $result->fetch_assoc();

    if(password_verify($senha, $usuario['senha'])){

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: index.php");
        exit();

    }else{
        $erro = "Usuário ou senha inválidos!";
    }

}else{
    $erro = "Usuário ou senha inválidos!";
}

}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEdu | Login</title>

    <link rel="stylesheet" href="css/login/style.css">
    <link rel="icon" type="image/png" href="img/cadastro/img/Icon.png">
    <style>
    body {
        background-image: url("img/login/Background.png");
    }
    .overlay {
        background-image: url("img/login/Polaroid.png");
    }
    </style>
</head>
<body>

<div class="container">

    <div class="form-container login-container">
        <form id="formulario-login" action="" method="POST">
            <img src="img/cadastro/img/logoof.png" class="logo" alt="Ícone de segurança" style="width: 80%;">
            <h1>LOGIN</h1>
            <h2 style="color:#2d959c; font-size:12px; margin: top 15px; margin-bottom:10px; text-transform:uppercase;">
                Bem-vindo de volta, agente.<br>
                A missão continua.
            </h2>

            <!-- LOGIN -->
            <div class="formulario">
                <input type="text" id="emaillogin" placeholder="E-mail" name="email">
                <small></small>
            </div>

            <!-- SENHA -->
            <div class="formulario">
                <input type="password" id="senhalogin" placeholder="Senha" name="senha">
                <small ></small>
                <p style="color: red; font-weight: 600; font-size: small;"><?php if (isset($erro)) echo $erro; ?></p>
            </div>

            <!-- ESQUECI SENHA -->
            <a href="/Cadastro/Cadastro.html" style="color:#2d959c; font-size:11px; text-transform:uppercase; text-align:center;">
                <br>
                <b>ESQUECI MINHA SENHA</b>
            </a>
  <br>
            <!-- BOTÃO ENTRAR -->
            <button type="submit" class="cta">
                <span>ENTRAR</span>
                <span>
                    <svg width="66px" height="43px" viewBox="0 0 66 43">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path class="one" d="M40.15,3.89 L43.97,0.13 C44.17,-0.05 44.48,-0.05 44.67,0.13 L65.69,20.78 C66.08,21.17 66.09,21.80 65.70,22.19 L44.67,42.86 C44.48,43.05 44.17,43.05 43.97,42.86 L40.15,39.10 L56.99,21.85 L40.15,4.60 Z" fill="#FFFFFF"/>
                            <path class="two" d="M20.15,3.89 L23.97,0.13 L45.69,20.78 L24.67,42.86 L20.15,39.10 L36.99,21.85 L20.15,4.60 Z" fill="#FFFFFF"/>
                            <path class="three" d="M0.15,3.89 L3.97,0.13 L25.69,20.78 L4.67,42.86 L0.15,39.10 L16.99,21.85 L0.15,4.60 Z" fill="#FFFFFF"/>
                        </g>
                    </svg>
                </span>
            </button>

            <!-- Link cadastro -->
            <a href="cadastro.php" style="color:#13777e; text-decoration:none; font-size:12px;">
                <br>  <br>
                Não possui conta?<br>
                <b>CADASTRE-SE!</b>
            </a>
        </form>
    </div>

  
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-direita"></div>
        </div>
    </div>

</div>
</body>
</html>