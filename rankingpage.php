<?php
include("testeconexao.php");

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

            <!-- LINKS -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="inicio.php">Início</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="missoes_semlogin.php">Missões</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="rankingpage.php">Ranking</a>
                </li>
            </ul>

            <!-- DARK MODE -->
            <button onclick="toggleDark(event)" id="themeBtn" class="btn btn-outline-primary me-3">
                <i class="bi bi-moon"></i>
            </button>

            <!-- LOGIN / LOGOUT -->
            <?php if(isset($_SESSION['nome'])): ?>

                <!-- SAIR (mesmo modelo de botão simples) -->
                <button class="btn btn-custom me-2" onclick="window.location.href='logout.php'">
                    Sair
                </button>

            <?php else: ?>

                <!-- LOGIN (mantido padrão simples) -->
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
      <a href="#" class="mx-2"><i class="bi bi-discord"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-youtube"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-github"></i></a>
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