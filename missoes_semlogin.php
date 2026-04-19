<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEdu | Ops!</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="ranking.css">
    <!-- Icons -->
    <link rel="icon" type="image/png" href="img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
.hero {
    height: 100vh;
    width: 100%;
    background: url("/img/pages/img/restricao.png") no-repeat center center;
    background-size: cover;
}

/* POPUP */
.popup {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.75);

    display: flex;
    align-items: center;
    justify-content: center;

    z-index: 9999;
}

/* CAIXA */
.popup-box {
    background: #0b1220;
    padding: 35px;
    border-radius: 14px;
    text-align: center;
    width: 340px;
    position: relative;

    border: 1px solid rgba(0, 255, 255, 0.2);

    box-shadow:
        0 0 20px rgba(0,255,255,0.15),
        0 0 40px rgba(0,255,255,0.05);

    animation: fadeUp 0.4s ease;
}

/* TITULO */
.titulo {
    color: #ffffff;
    font-weight: 600;
    margin-bottom: 10px;
}

/* SUBTEXTO */
.sub {
    color: #9ca3af;
    margin-bottom: 25px;
}

/* BOTÃO NEON */
.btn-neon {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: none;

    background: linear-gradient(90deg, #1e6868, #3b82f6);
    color: #fff;
    font-weight: 600;

    box-shadow: 0 0 12px rgba(0,255,255,0.6);

    transition: 0.3s;
}

.btn-neon:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 20px rgba(0,255,255,0.9);
}

/* BOTÃO FECHAR */
.fechar {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 18px;
    cursor: pointer;
    color: #aaa;
}

.fechar:hover {
    color: #fff;
}

/* ANIMAÇÃO */
@keyframes fadeUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
<body class="dark-mode">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">

        <div class="container">

      <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="/img/pages/img/logoof.png" alt="Logo" width="100" height="70" class="me-2 logo-energia">
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">

              <!-- LINKS -->
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="Inicio.php">Início</a>
                </li>

                <?php if(isset($_SESSION['nome'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Jogos</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="missoes_semlogin.php">Jogos</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="rankingpage.php">Ranking</a>
                </li>

            </ul>


              <button onclick="toggleDark(event)" id="themeBtn" class="btn btn-outline-primary me-3">
    <i class="bi bi-moon"></i>
</button>
      <button class="btn btn-custom" onclick="window.location.href='login.php'">
    Login
</button>       

            </div>

        </div>

    </nav>

    <!-- HERO -->
   
<section class="hero"></section>

<!-- FOOTER -->
<footer class="footer-insane position-relative overflow-hidden ">

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

<div id="popupCadastro" class="popup">
  <div class="popup-box">

    <span class="fechar" onclick="fecharPopup()">×</span>
    <img src="/img/pages/img/ops.png" alt="CyberEdu" class="logo-img" width="100">
    <br> <br>
    <h2 class="titulo">Acesso Negado</h2>
    <p class="sub">Você não tem permissão. <br> Crie uma conta para acessar!</p>

    <button class="btn-neon" onclick="irCadastro()">
        CRIAR CONTA
    </button>

  </div>
</div>


<!-- SOM -->
<audio id="somSistema" src="https://www.myinstants.com/media/sounds/windows-xp-startup.mp3"></audio>
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
// MOSTRA AUTOMATICAMENTE
window.onload = function() {
    document.getElementById("popupCadastro").style.display = "flex";
};

// FECHAR
function fecharPopup() {
    document.getElementById("popupCadastro").style.display = "none";
}

// IR PARA CADASTRO
function irCadastro() {
    window.location.href = "Cadastro.php"; 
}

</script>
</script>
</script>