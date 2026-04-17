
<?php
include("testeconexao.php");

$sql = "
SELECT nome, MAX(xp_total) AS xp_total
FROM ranking_usuarios
GROUP BY nome
ORDER BY xp_total DESC
LIMIT 3
";

$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEdu | Início</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Icons -->
    <link rel="icon" type="image/png" href="Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style> 
/* botão perfil  login  */
.perfil-btn{
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

.perfil-btn:hover{
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(79, 70, 229, 0.5);
}

/* avatar navbar */
.avatar-navbar{
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
}</style> 
<body class="dark-mode">

   <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="Inicio.php">
            <img src="/img/pages/img/logoof.png" alt="Logo" width="100" height="70" class="me-2 logo-energia">
        </a>

        <!-- BOTÃO MOBILE -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <!-- LINKS -->
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="Inicio.php">Início</a>
                </li>

                <?php if(isset($_SESSION['nome'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Missões</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="missoes_semlogin.php">Missões</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="rankingpage.php">Ranking</a>
                </li>

            </ul>

            <!-- BOTÃO DARK MODE -->
            <button onclick="toggleDark(event)" id="themeBtn" class="btn btn-outline-primary me-3">
                <i class="bi bi-moon"></i>
            </button>

            <!-- LOGIN / PERFIL -->
          <?php if(isset($_SESSION['nome'])): ?>

    <a href="profile.php" class="perfil-btn text-decoration-none">

        <img src="perfilft.png" 
             class="avatar-navbar" 
             alt="avatar">

        <span>
            Olá, <?php echo $_SESSION['nome']; ?>
        </span>

    </a>

    <button class="btn btn-custom ms-2" onclick="window.location.href='logout.php'">
        Logout
    </button>

<?php else: ?>

    <button class="btn btn-custom" onclick="window.location.href='login.php'">
        Login
    </button>

<?php endif; ?>

        </div>

    </div>

</nav>


    <!-- HERO -->
    <section class="hero">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-md-6">

                   <h1 class="fw-bold hacker-text2" style="font-size:40px;">
    Olá, agente digital!
</h1>

                    <p class="mt-3 hacker-text">
    Pronto para sua primeira missão digital?
                    </p>
<div class="d-flex gap-3">
             <button class="btn btn-glass-outline"  onclick="window.location.href='login.php'">
            Começar missão
            </button>

            <button class="btn btn-glass-outline" onclick="window.location.href='Cadastro.php'">
          Cadastre-se
        </button>
                </div>

            </div>

        </div>

    </section>

    <!-- COMO FUNCIONA -->
<section class="py-5 text-center fade-in">

    <div class="container">

        <div class="d-flex align-items-center justify-content-center mb-3">

            <div class="linha"></div>

           <img src="/img/pages/img/icon.png" alt="Logo" width="150" class="mx-3 logo-gold">

            <div class="linha"></div>

        </div>
 <h2 style="color: white;">
    <b class="titulo-efeito">COMO FUNCIONA?</b>
</h2>
   
  <!-- SEÇÃO APRENDA / TESTE / EVOLUA -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card card-custom p-4 text-center glass-card">
            <img src="/img/pages/img/1.png" alt="Aprenda" class="card-img-top mb-3 mx-auto card-img">
            <h4><b>APRENDA</b></h4>
            <p>Descubra como funcionam os digitais!</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom p-4 text-center glass-card">
            <img src="/img/pages/img/9.png" alt="Teste" class="card-img-top mb-3 mx-auto card-img">
            <h4><b>TESTE</b></h4>
            <p>Identifique golpes em situações simuladas!</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom p-4 text-center glass-card">
            <img src="/img/pages/img/4.png" alt="Evolua" class="card-img-top mb-3 mx-auto card-img">
            <h4><b>EVOLUA</b></h4>
            <p>Ganhe pontos e suba no ranking!</p>
        </div>
    </div>
</div>

<!-- atividade -->
<section class="py-5 text-center">
    <div class="container">
         <h2 style="color: white;">
<h2 class="titulo-efeito">DESAFIOS DISPONÍVEIS</h2>

   
</div>
        </h2>

        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card card-custom p-4 text-center glass-card">
                    <img src="/img/pages/img/2.png" alt="Missão 1" class="card-img-top mb-3 mx-auto card-img">
                    <h4><b>🎯 Caça ao Golpe</b></h4>
                    <p>Será que você consegue identificar um golpe antes de cair nele? Teste seu radar!</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom p-4 text-center glass-card" >
                    <img src="/img/pages/img/7.png" alt="Missão 2" class="card-img-top mb-3 mx-auto card-img">
                    <h4><b>🛡️ Conta Blindada</b></h4>
                    <p>Deixe suas contas no modo ultra seguro, sem invasões!</p> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom p-4 text-center glass-card">
                    <img src="/img/pages/img/8.png" alt="Missão 3" class="card-img-top mb-3 mx-auto card-img">
                    <h4><b>⚡ Clique Inteligente</b></h4>
                    <p>Nem todo link é confiável… você sabe escolher o certo?<br></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom p-4 text-center glass-card">
                    <img src="/img/pages/img/6.png" alt="Missão 4" class="card-img-top mb-3 mx-auto card-img">
                    <h4><b>🧠 Modo Detetive</b></h4>
                    <p>Use sua mente pra analisar mensagens e descobrir o que é real ou golpe.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- RANKING -->
<section class="ranking text-center py-5">
    <div class="container">

        <h2 style="color: white;">
            <b class="titulo-efeito">RANKING DE JOGADORES</b>
        </h2>

        <br><br>

        <?php
        $players = [];
        while($row = $result->fetch_assoc()){
            $players[] = $row;
        }

        $top1 = $players[0] ?? null;
        $top2 = $players[1] ?? null;
        $top3 = $players[2] ?? null;
        ?>

        <!-- PODIUM -->
        <div class="podium d-flex justify-content-center align-items-end gap-5">

            <!-- 2º lugar -->
            <?php if($top2): ?>
            <div class="rank-card second glass-card">
                <div class="rank-badge silver">2</div>
                <br>
                <img src="/img/pages/img/podium2.png" class="rank-img">
                <h4><?= $top2['nome'] ?></h4>
                <p><?= $top2['xp_total'] ?> XP</p>
                <p>Top 2 — Desafiante</p>
            </div>
            <?php endif; ?>

            <!-- 1º lugar -->
            <?php if($top1): ?>
            <div class="rank-card first glass-card">
                <div class="rank-badge gold">1</div>
                <div class="sparkles"></div>
                <br><br>
                <img src="/img/pages/img/podium.png" class="rank-img first-img">
                <h4><?= $top1['nome'] ?></h4>
                <p><?= $top1['xp_total'] ?> XP</p>
                <p class="rank-text">
                    Top 1 — Lenda <br>
                    <span>Dominando o topo com maestria!</span>
                </p>
            </div>
            <?php endif; ?>

            <!-- 3º lugar -->
            <?php if($top3): ?>
            <div class="rank-card third glass-card">
                <div class="rank-badge bronze">3</div>
                <br>
                <img src="/img/pages/img/podium3.png" class="rank-img">
                <h4><?= $top3['nome'] ?></h4>
                <p><?= $top3['xp_total'] ?> XP</p>
                <p>Top 3 — Elite</p>
            </div>
            <?php endif; ?>

        </div>

        <br><br>

     

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
      <a href="#" class="mx-2"><i class="bi bi-discord"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-youtube"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-github"></i></a>
    </div>

    <!-- COPYRIGHT -->
    <p class="copy small mb-0">© 2026 CyberEdu — Projeto Integrador I — Universidade Virtual do <br> Estado de São Paulo | UNIVESP</p>

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

// ANIMAÇÃO
const elements = document.querySelectorAll(".fade-in");

window.addEventListener("scroll", () => {
    elements.forEach(el => {
        const top = el.getBoundingClientRect().top;
        if(top < window.innerHeight - 100){
            el.classList.add("show");
        }
    });
});

// DARK MODE + ÍCONE
function toggleDark(e){
    const body = document.body;
    const btn = document.getElementById("themeBtn");
    body.classList.toggle("dark-mode");

    // TROCA ÍCONE + ATIVO
    if(body.classList.contains("dark-mode")){
        btn.innerHTML = '<i class="bi bi-moon"></i>';
        btn.classList.add("active");
    }else{
        btn.innerHTML = '<i class="bi bi-sun"></i>';
        btn.classList.remove("active");
    }

    // RIPPLE EFFECT
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
</script>
</script>