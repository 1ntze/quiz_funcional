<?php
session_start();
include("testeconexao.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../Login/login.php");
    exit();
}

$id = $_SESSION['id_usuario'];

$sql = "SELECT nome, email, xp_total, nivel, data_cadastro FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// SISTEMA DE TÍTULOS POR XP
$xp = $user['xp_total'];

if ($xp < 50) {
    $titulo = "Iniciante Digital";
} elseif ($xp < 150) {
    $titulo = "Aprendiz de Segurança";
} elseif ($xp < 300) {
    $titulo = "Defensor Digital";
} elseif ($xp < 600) {
    $titulo = "Caçador de Golpes";
} elseif ($xp < 1000) {
    $titulo = "Especialista em Segurança";
} else {
    $titulo = "Mestre da Segurança Digital";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEdu | Perfil</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="perfil.css">

    <!-- Icons -->
    <link rel="icon" type="image/png" href="icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
    /* botão perfil  login  */
    .perfil-btn {
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border: none;
        color: white !important;
        border-radius: 50px;
        padding: 6px 14px;
        transition: 0.3s;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .perfil-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(79, 70, 229, 0.5);
    }

    /* avatar navbar */
    .avatar-navbar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
    }
</style>

<body class="dark-mode">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/img/pages/img/logoof.png" width="100" height="70" class="me-2 logo-energia">
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="inicio.php">Início</a></li>
                    <?php if (isset($_SESSION['id_usuario'])): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Jogos</a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="missoes_semlogin.php">Jogos</a>
                        </li>

                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/Pages/ranking.html">Ranking</a></li>
                </ul>

                <button onclick="toggleDark(event)" id="themeBtn" class="btn btn-outline-primary me-3">
                    <i class="bi bi-moon"></i>
                </button>
                <a href="profile.php" class="perfil-btn text-decoration-none">

                    <img src="perfilft.png" class="avatar-navbar" alt="avatar">

                    <span>
                        <?php echo $_SESSION['nome']; ?>
                    </span>

                </a>

                <a href="logout.php">
                    <button class="btn btn-custom ms-2">Sair</button>
                </a>

            </div>
        </div>
    </nav>

    <!-- PERFIL -->
    <section class="py-5">
        <div class="container">

            <div class="card glass-card p-5 text-center">

                <!-- FOTO -->
                <div class="position-relative d-inline-block">
                    <img src="perfilft.png" class="rounded-circle profile-img">

                </div>

                <!-- NOME -->
                <h2 class="mt-4"><b><?= $user['nome']; ?></b></h2>
                <p class="text-muted">
    <p class="text-muted">
    🏆 <strong><?= $titulo ?></strong><br>
    <small><?= $xp ?> XP</small>
</p>
                <!-- INFORMAÇÕES -->
                <div class="d-flex justify-content-center gap-4 mt-4 flex-wrap">

                    <div class="status-box glass-card p-3">
                        <h5><b>Email</b></h5>
                        <p><?= $user['email']; ?></p>
                    </div>

                    <div class="status-box glass-card p-3">
                        <h5><b>XP</b></h5>
                        <p><?= $user['xp_total']; ?> XP</p>
                    </div>

                    <div class="status-box glass-card p-3">
                        <h5><b>Nível</b></h5>
                        <p><?= $user['nivel']; ?></p>
                    </div>

                    <div class="status-box glass-card p-3">
                        <h5><b>Criada em</b></h5>
                        <p>
                            <?= date("d/m/Y", strtotime($user['data_cadastro'])) ?>
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- FOOTER -->
    <footer class="footer-insane position-relative overflow-hidden mt-5">

        <!-- GRID DE FUNDO -->
        <div class="grid-bg"></div>

        <!-- PARTÍCULAS -->
        <div class="particles"></div>

        <!-- LINHA NEON -->
        <div class="neon-line"></div>

        <div class="container text-center position-relative z-2 py-5">

            <!-- LOGO -->
            <div class="footer-logo mb-3">
                <img src="/img/pages/img/logoof.png" alt="CyberEdu Logo" class="logo-img" width="120">
            </div>

            <!-- ÍCONES SOCIAIS -->
            <div class="social-icons mb-4">
                <a href="#" class="mx-2"><i class="bi bi-instagram"></i></a>
                <a href="https://discord.gg/8STKzvKG" class="mx-2"><i class="bi bi-discord"></i></a>
                <a href="#" class="mx-2"><i class="bi bi-youtube"></i></a>
                <a href="https://github.com/1ntze" class="mx-2"><i class="bi bi-github"></i></a>
            </div>

            <!-- COPYRIGHT -->
            <p class="copy small mb-0">© 2026 CyberEdu — Projeto Integrador I — Universidade Virtual do <br> Estado de
                São Paulo | UNIVESP</p>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // DARK MODE
        function toggleDark(e) {
            const body = document.body;
            const btn = document.getElementById("themeBtn");

            body.classList.toggle("dark-mode");

            if (body.classList.contains("dark-mode")) {
                btn.innerHTML = '<i class="bi bi-moon"></i>';
            } else {
                btn.innerHTML = '<i class="bi bi-sun"></i>';
            }
        }

        // TROCAR FOTO
        document.getElementById("uploadPic").addEventListener("change", function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById("profilePic").src = e.target.result;

                    // salva no navegador
                    localStorage.setItem("profilePic", e.target.result);
                }

                reader.readAsDataURL(file);
            }
        });

        // CARREGAR FOTO + DADOS
        window.onload = () => {
            const savedPic = localStorage.getItem("profilePic");
            if (savedPic) {
                document.getElementById("profilePic").src = savedPic;
            }

            const email = localStorage.getItem("email");
            const user = localStorage.getItem("user");
            const date = localStorage.getItem("date");

            if (email) document.getElementById("userEmail").innerText = email;
            if (user) document.getElementById("userId").innerText = user;
            if (date) document.getElementById("userDate").innerText = date;
        }
    </script>

</body>

</html>