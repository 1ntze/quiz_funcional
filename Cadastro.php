<?php
session_start();
include("testeconexao.php");

if (isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if ($nome == "" || $email == "" || $senha == "" || $confirmar_senha == "") {
        $erro = "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Digite um e-mail válido.";
    } elseif ($senha != $confirmar_senha) {
        $erro = "As senhas não coincidem.";
    } else {
        $verifica = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
        $verifica->bind_param("s", $email);
        $verifica->execute();
        $verifica->store_result();

        if ($verifica->num_rows > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, xp_total, nivel) VALUES (?, ?, ?, 0, 1)");
            $stmt->bind_param("sss", $nome, $email, $senhaHash);

            if ($stmt->execute()) {
                $sucesso = "Conta criada com sucesso!";
            } else {
                $erro = "Erro ao cadastrar.";
            }

            $stmt->close();
        }

        $verifica->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEdu | Cadastro</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="css/cadastro/style.css">
    <link rel="icon" type="image/png" href="img/Icon.png">

    <style>
        body {
            background-image: url("img/cadastro/img/Background - Cadastro.png");
        }

        .mensagem {
            margin-top: 12px;
            font-weight: bold;
            font-size: 14px;
        }

        .erro {
            color: red;
        }

        .sucesso {
            color: #00cc66;
        }

        .senha-container {
            position: relative;
        }

        .mostrarSenha {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
        }
    </style>
</head>

<body>
    <video autoplay muted loop id="bg-video">
        <source src="img/background-cadastro.mp4" type="video/mp4">
    </video>

    <div class="container">
        <div class="form-container">
            <form action="" method="POST">
                <img src="img/cadastro/img/logoof.png" class="logo" alt="Ícone de segurança" style="width: 35%;">

                <h1>CADASTRE-SE</h1>
                <h2 style="color:#2d959c; font-size:13px; margin-top:-1px; margin-bottom:10px; text-transform:uppercase;">
                    Vamos proteger sua <br> jornada na internet!
                </h2>

                <div class="formulario">
                    <input type="text" name="nome" placeholder="Usuário" value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">
                </div>

                <div class="formulario">
                    <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>

                <div class="formulario senha-container">
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <span id="toggleSenha" class="mostrarSenha"><i class="fa-regular fa-eye-slash"></i></span>
                </div>

                <div class="formulario senha-container">
                    <input type="password" name="confirmar_senha" id="confirmarSenha" placeholder="Confirme sua senha">
                    <span id="toggleConfirmarSenha" class="mostrarSenha"><i class="fa-regular fa-eye-slash"></i></span>
                </div>

                <button type="submit" class="cta">
                    <span>CADASTRAR</span>
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

                <?php if ($erro != "") { ?>
                    <p class="mensagem erro"><?php echo $erro; ?></p>
                <?php } ?>

                <?php if ($sucesso != "") { ?>
                    <p class="mensagem sucesso"><?php echo $sucesso; ?> </p>
                <?php } ?>

                <a href="login.php" class="link-login">
                    Já possui conta?<br>
                    <b>Faça LOGIN!</b>
                </a>
            </form>
        </div>

        <div class="video-container">
            <video autoplay muted loop class="video-lateral">
                <source src="img/cadastro/img/Cadastro - lateral.mp4" type="video/mp4">
            </video>
        </div>
    </div>

    <script>
        function toggleSenha(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);

            toggle.addEventListener("click", function () {
                const icone = this.querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icone.classList.remove("fa-eye-slash");
                    icone.classList.add("fa-eye");
                } else {
                    input.type = "password";
                    icone.classList.remove("fa-eye");
                    icone.classList.add("fa-eye-slash");
                }
            });
        }

        toggleSenha("senha", "toggleSenha");
        toggleSenha("confirmarSenha", "toggleConfirmarSenha");
    </script>
</body>
</html>