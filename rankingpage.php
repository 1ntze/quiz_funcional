<?php
include("testeconexao.php");
Session_start();


$sql = "
SELECT nome, xp_total
FROM ranking_usuarios
ORDER BY xp_total DESC
LIMIT 10
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEdu | Ranking</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="ranking.css">

    <!-- Icons -->
    <link rel="icon" type="image/png" href="icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
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
     .avatar-navbar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
    }


.logo-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 40px;
}

.logo-img {
    width: 500px;
    display: block;
    
    animation: flutuar 3s ease-in-out infinite;

    /* luz mais suave */
    filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.4))
            drop-shadow(0 0 20px rgba(255, 215, 0, 0.25))
            drop-shadow(0 0 30px rgba(255, 215, 0, 0.15));
}

/* animação */
@keyframes flutuar {
    0%   { transform: translateY(0px); }
    50%  { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}
</style>
<body class="dark-mode">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="/img/pages/img/logoof.png" alt="Logo" width="100" height="70" class="me-2 logo-energia">
        </a>

        <!-- TOGGLE -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

           <ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link" href="inicio.php">Início</a>
    </li>

    <?php if (isset($_SESSION['nome'])): ?>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Jogos</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="dicas.php">Dicas do Edu</a>
        </li>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link" href="missoes_semlogin.php">Jogos</a>
        </li>
    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link active" href="rankingpage.php">Ranking</a>
    </li>
</ul>
            <!-- DARK MODE -->
            <button onclick="toggleDark(event)" id="themeBtn" class="btn btn-outline-primary me-3">
                <i class="bi bi-moon"></i>
            </button>

          <!-- PERFIL / LOGIN / SAIR -->
            <?php if(isset($_SESSION['nome'])): ?>

                <!-- PERFIL -->
                <a href="profile.php" class="perfil-btn me-2">
                    <img src="perfilft.png" class="avatar-navbar">
                    <?php echo $_SESSION['nome']; ?>
                </a>

                <!-- SAIR -->
                <button class="btn btn-custom" onclick="window.location.href='logout.php'">
                    Sair
                </button>

            <?php else: ?>

                <!-- LOGIN -->
                <button class="btn btn-custom" onclick="window.location.href='../Login/login.php'">
                    Login
                </button>

            <?php endif; ?>

        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <video autoplay muted loop playsinline class="bg-video">
        <source src="\img\pages\img\bgranking4.mp4" type="video/mp4">
    </video>
</section>

<!-- RANKING -->
<section class="ranking text-center py-5">
    <div class="container">

        <h2 style="color: white;">
            <b class="titulo-efeito">RANKING DE JOGADORES</b>
        </h2>

        <br>

        <div class="rank">

        <?php
        $posicao = 1;

        while($row = $result->fetch_assoc()){

            $xp = $row['xp_total'];

            if($posicao == 1) $pos = "#1";
            elseif($posicao == 2) $pos = "#2";
            elseif($posicao == 3) $pos = "#3";
            else $pos = "#".$posicao;
        ?>

            <div class="player">
                <div class="info">
                    <span><?php echo $pos . " " . $row['nome']; ?></span>
                    <span><?php echo $xp; ?> XP</span>
                </div>
                <div class="bar">
                    <div class="fill" style="--xp: <?php echo $xp; ?>;"></div>
                </div>
            </div>

        <?php
            $posicao++;
        }
        ?>

        </div>
    </div>
</section>

<div class="logo-wrap">
    <img src="mimi.png" alt="" class="logo-img">
</div>

<!-- FOOTER -->
<footer class="footer-insane position-relative overflow-hidden mt-5">

  <div class="grid-bg"></div>
  <div class="particles"></div>
  <div class="neon-line"></div>

  <div class="container text-center position-relative z-2 py-5">

    <div class="footer-logo mb-3">
      <img src="/img/pages/img/logoof.png" alt="CyberEdu Logo" class="logo-img" width="120">
    </div>

    <div class="social-icons mb-4">
                <a href="#" class="mx-2"><i class="bi bi-instagram"></i></a>
                <a href="https://discord.gg/8STKzvKG" class="mx-2"><i class="bi bi-discord"></i></a>
                <a href="#" class="mx-2"><i class="bi bi-youtube"></i></a>
                <a href="https://github.com/1ntze" class="mx-2"><i class="bi bi-github"></i></a>
            </div>

    <p class="copy small mb-0">
      © 2026 CyberEdu — Projeto Integrador I — Universidade Virtual do
<br>Estado de São Paulo | UNIVESP
    </p>

  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// NAVBAR SCROLL
window.addEventListener("scroll", function(){
    const navbar = document.querySelector(".navbar");
    if(window.scrollY > 50){
        navbar.classList.add("scrolled");
    }else{
        navbar.classList.remove("scrolled");
    }
});

// DARK MODE
function toggleDark(e){
    const body = document.body;
    const btn = document.getElementById("themeBtn");

    body.classList.toggle("dark-mode");

    if(body.classList.contains("dark-mode")){
        btn.innerHTML = '<i class="bi bi-moon"></i>';
        btn.classList.add("active");
    }else{
        btn.innerHTML = '<i class="bi bi-sun"></i>';
        btn.classList.remove("active");
    }

    const circle = document.createElement("span");
    circle.classList.add("ripple");

    const rect = btn.getBoundingClientRect();
    circle.style.left = (e.clientX - rect.left) + "px";
    circle.style.top = (e.clientY - rect.top) + "px";

    btn.appendChild(circle);

    setTimeout(() => {
        circle.remove();
    }, 600);
}
</script>

</body>
</html>