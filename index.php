<?php 
include("testeconexao.php");
include("session.php");

$sqlRanking = "
SELECT nome, xp_total
FROM ranking_usuarios
ORDER BY xp_total DESC
LIMIT 5
";

$ranking = $conn->query($sqlRanking);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberEdu | Modos de Jogo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="ranking.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="icon" type="image/png" href="Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<style>
    /* NAVBAR FIX (SEM ESPAÇO) */
.navbar{
    padding:0 20px !important;
    min-height:60px;
}

.navbar .container{
    margin-top:0 !important;
    padding-top:0 !important;
    padding-bottom:0 !important;
}
/* IMPORTANTE: NÃO QUEBRAR NAVBAR */
.main-container{
margin-top:100px;
animation: fadeIn 1s ease;
}

/* RESET */
*{
margin:0;
padding:0;
box-sizing:border-box;
}

/* BODY */
body{
font-family:'Poppins', sans-serif;
color:white;
text-align:center;
min-height:100vh;
display:flex;
flex-direction:column;
overflow-x:hidden;

/* BACKGROUND CYBER */
background:
radial-gradient(circle at 20% 30%, rgba(59,130,246,0.2), transparent 40%),
radial-gradient(circle at 80% 70%, rgba(30,58,138,0.3), transparent 40%),
linear-gradient(270deg, #020617, #0f172a, #1e3a8a);

background-size: 200% 200%;
animation: bgMove 12s ease infinite;
}

/* GRID */
body::after{
content:"";
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background-image:
linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
background-size:40px 40px;
pointer-events:none;
}

/* PARTÍCULAS */
body::before{
content:"";
position:fixed;
top:0;
left:0;
width:200%;
height:200%;
background-image: radial-gradient(white 1px, transparent 1px);
background-size: 60px 60px;
opacity:0.1;
animation: particlesMove 40s linear infinite;
pointer-events:none;
}

/* ANIMAÇÕES */
@keyframes bgMove{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

@keyframes particlesMove{
0%{transform:translate(0,0);}
100%{transform:translate(-200px,-200px);}
}

/* CONTAINER */
.container{
margin-top:100px;
animation: fadeIn 1s ease;
}

/* TÍTULOS */
h1{
font-size:40px;
margin-bottom:10px;
text-shadow:0 0 15px rgba(59,130,246,0.8);

}

h2{
margin-bottom:15px;
}

/* BOTÕES */
button{
padding:15px 30px;
margin:10px;
border:none;
border-radius:12px;
cursor:pointer;
font-size:16px;
background:#1e3a8a;
color:white;
transition:0.3s;
box-shadow:0 0 10px rgba(30,58,138,0.5);
}

button:hover{
transform:translateY(-3px) scale(1.05);
background:#2563eb;
box-shadow:0 0 25px rgba(37,99,235,1);
}

/* RANKING */
.ranking{
margin-top:50px;
width:360px;
margin-left:auto;
margin-right:auto;
background:rgba(255,255,255,0.95);
color:black;
border-radius:15px;
padding:20px;
box-shadow:0 0 25px rgba(0,0,0,0.5);
animation: fadeInUp 1s ease;
}

.ranking table{
width:100%;
border-collapse:collapse;
}

.ranking th{
background:#1e3a8a;
color:white;
padding:10px;
}

.ranking td{
padding:8px;
border-bottom:1px solid #ddd;
text-align:center;
transition:0.2s;
}

.ranking tr:hover{
background:#e0e7ff;
transform:scale(1.02);
}

/* FOOTER */
/* FOOTER MELHORADO (SEM BUG DE ESPAÇO) */
footer{
    margin-top:auto;
    padding:20px;
    font-size:14px;
    color:#94a3b8;
    position:relative;
    overflow:hidden;
}

footer::before{
    content:"";
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:2px;
    background:linear-gradient(90deg, transparent, #3b82f6, transparent);
    animation:lineMove 3s linear infinite;
}

@keyframes lineMove{
0%{left:-100%;}
100%{left:100%;}
}

/* IMPORTANTE: EVITA ESPAÇO EXTRA */
footer .container{
    margin-top:0 !important;
}

@keyframes lineMove{
0%{left:-100%;}
100%{left:100%;}
}

/* TEXTO */
.footer-text{
animation: pulse 2s infinite;
}

@keyframes pulse{
0%,100%{opacity:0.6;}
50%{opacity:1;}
}

/* ENTRADA */
@keyframes fadeIn{
from{opacity:0;}
to{opacity:1;}
}

@keyframes fadeInUp{
from{
opacity:0;
transform:translateY(20px);
}
to{
opacity:1;
transform:translateY(0);
}
}
/* BANNER */
.banner{
margin-top:0;
height:600px;

background:
linear-gradient(rgba(2, 6, 23, 0), rgba(2, 6, 23, 0)),
url('/img/pages/img/bgrankingindex.png');

background-size:cover;
background-position:center;
} border-bottom:1px solid rgba(255,255,255,0.1);

/* DARK MODE */
body.dark-mode{
    background:
    radial-gradient(circle at 20% 30%, rgba(59,130,246,0.3), transparent 40%),
    radial-gradient(circle at 80% 70%, rgba(30,58,138,0.4), transparent 40%),
    linear-gradient(270deg, #020617, #020617, #0f172a);
}

/* NAVBAR DARK */
body.dark-mode .navbar{
    background: rgba(2,6,23,0.9) !important;
    backdrop-filter: blur(10px);
}

body.dark-mode .nav-link{
    color: #cbd5f5 !important;
}

body.dark-mode .nav-link.active{
    color: #3b82f6 !important;
}

/* BOTÕES */
body.dark-mode button{
    background:#1e40af;
}

/* RANKING */
body.dark-mode .ranking{
    background: rgba(15,23,42,0.95);
    color:white;
}

body.dark-mode .ranking th{
    background:#1e40af;
}
/* CAIXA PRINCIPAL */
.game-box{
    max-width:650px;
    margin:auto;
    padding:35px;

    background: rgba(15,23,42,0.6);
    backdrop-filter: blur(15px);

    border-radius:25px;
    border:1px solid rgba(59,130,246,0.15);

    box-shadow:
        0 0 40px rgba(59,130,246,0.15),
        inset 0 0 20px rgba(59,130,246,0.05);

    position:relative;
    overflow:hidden;
}

/* LINHA NEON ANIMADA */
.game-box::before{
    content:"";
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:2px;
    background:linear-gradient(90deg, transparent, #3b82f6, transparent);
    animation:neonLine 3s linear infinite;
}

@keyframes neonLine{
    0%{left:-100%;}
    100%{left:100%;}
}

/* PLAYER */
.player{
    font-size:26px;
    margin-bottom:10px;
    color:#3b82f6;
    text-shadow:0 0 10px rgba(26, 108, 238, 0.56);
}

/* SUBTITLE */
.subtitle{
    margin-bottom:30px;
    color:#94a3b8;
    letter-spacing:1px;
}

/* GRID */
.game-buttons{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

/* BOTÕES BASE */
.game-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    padding:16px;
    border-radius:14px;

    text-decoration:none;
    color:white;
    font-weight:500;

    position:relative;
    overflow:hidden;

    transition:0.3s;
}

/* EFEITO DE LUZ */
.game-btn::after{
    content:"";
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
    transition:0.5s;
}

.game-btn:hover::after{
    left:100%;
}

/* HOVER BASE */
.game-btn:hover{
    transform:translateY(-6px) scale(1.04);
}

/* VARIAÇÕES (CADA BOTÃO DIFERENTE) */

/* QUIZ */
.quiz{
    background: linear-gradient(45deg, #1e3a8a, #2563eb);
    box-shadow:0 0 15px rgba(37,99,235,0.4);
}
.quiz:hover{
    box-shadow:0 0 30px rgba(37,99,235,1);
}

/* MEMORIA */
.memoria{
    background: linear-gradient(45deg, #065f46, #10b981);
    box-shadow:0 0 15px rgba(16,185,129,0.4);
}
.memoria:hover{
    box-shadow:0 0 30px rgba(16,185,129,1);
}

/* VERDADEIRO/FALSO */
.vf{
    background: linear-gradient(45deg, #92400e, #f59e0b);
    box-shadow:0 0 15px rgba(245,158,11,0.4);
}
.vf:hover{
    box-shadow:0 0 30px rgba(245,158,11,1);
}

/* GOLPE */
.golpe{
    background: linear-gradient(45deg, #7f1d1d, #ef4444);
    box-shadow:0 0 15px rgba(239,68,68,0.4);
}
.golpe:hover{
    box-shadow:0 0 30px rgba(239,68,68,1);
}

/* RESPONSIVO */
@media(max-width:600px){
    .game-buttons{
        grid-template-columns:1fr;
    }
}
/* CAIXA */
.ranking{
    max-width:500px;
    margin:50px auto;

    padding:25px;
    border-radius:20px;

    background: rgba(15,23,42,0.7);
    backdrop-filter: blur(15px);

    border:1px solid rgba(59,130,246,0.2);

    box-shadow:0 0 40px rgba(59,130,246,0.15);
}

/* TÍTULO */
.ranking-title{
    margin-bottom:25px;
    text-align:center;
    color:#e0e7ff;
    text-shadow:0 0 10px rgba(59,130,246,0.7);
}

/* LISTA */
.ranking-list{
    display:flex;
    flex-direction:column;
    gap:12px;
}

/* ITEM */
.rank-item{
    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:12px;
    border-radius:12px;

    background: rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.05);

    transition:0.3s;
}

/* HOVER */
.rank-item:hover{
    transform:scale(1.02);
    background: rgba(59,130,246,0.08);
}

/* POSIÇÃO */
.rank-pos{
    font-size:18px;
    width:40px;
}

/* INFO */
.rank-info{
    flex:1;
    margin:0 10px;
}

.rank-name{
    display:block;
    font-weight:500;
}

/* XP BAR */
.xp-bar{
    width:100%;
    height:6px;
    background: rgba(255,255,255,0.1);
    border-radius:10px;
    margin-top:5px;
    overflow:hidden;
}

.xp-fill{
    height:100%;
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    box-shadow:0 0 10px #3b82f6;
    animation: xpAnim 1s ease;
}

@keyframes xpAnim{
    from{width:0;}
}

/* XP TEXTO */
.rank-xp{
    font-size:14px;
    color:#93c5fd;
}

/* TOP 3 DESTAQUE */
.top-1{
    border:1px solid gold;
    box-shadow:0 0 15px gold;
}

.top-2{
    border:1px solid silver;
    box-shadow:0 0 10px silver;
}

.top-3{
    border:1px solid #cd7f32;
    box-shadow:0 0 10px #cd7f32;
}

.dashboard-wrapper{
    display:flex;
    gap:40px;
    max-width:1200px;
    margin:100px auto;
    padding:0 20px;
    align-items:flex-start;
}

.dashboard-wrapper .game-box{
    flex:2;
}

.dashboard-wrapper .ranking{
    flex:1;
    margin:0;
}

@media(max-width:900px){
    .dashboard-wrapper{
        flex-direction:column;
    }
}
/* botão perfil login */
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
    text-decoration: none; /* CORRETO */
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
}
</style>

</head>
<body id="mainBody" class="dark-mode">
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
                            <a class="nav-link active" href="index.php">Jogos</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="missoes_semlogin.php">Jogos</a>
                        </li>
                    <?php endif; ?>

 <li class="nav-item">
        <a class="nav-link" href="dicas.php">Dicas do Edu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="rankingpage.php">Ranking</a>
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
    <section class="banner">

</div>

</section>
<div class="dashboard-wrapper">

    <!-- GAME -->
    <div class="game-box">
        <p class="subtitle"><b>Usuário.:</b></p>
        <h2 class="player">
            <?php echo $_SESSION['nome']; ?>
        </h2>
    <br>
        <p class="subtitle"><b>Escolha o modo de jogo.:</b></p>

        <div class="game-buttons">

            <a href="quiz.php" class="game-btn quiz">
                📚 <span>Jogar Quiz</span>
            </a>

            <a href="memoria.php" class="game-btn memoria">
                🧠 <span>Jogo da Memória</span>
            </a>

            <a href="verdadeiro_falso.php" class="game-btn vf">
                ✔ <span>Verdadeiro ou Falso</span>
            </a>

            <a href="https://forms.office.com/r/jR5vr9Jbtg" class="game-btn golpe">
                🔎 <span>Faça sua sugestão!</span>
            </a>

        </div>
    </div>

    <!-- RANKING -->
    <div class="ranking">

        <h2 class="ranking-title"><b> Ranking</b></h2>

        <div class="ranking-list">

        <?php
        $posicao = 1;

        while($row = $ranking->fetch_assoc()){

        if($posicao == 1) $medalha = "🥇";
        elseif($posicao == 2) $medalha = "🥈";
        elseif($posicao == 3) $medalha = "🥉";
        else $medalha = "#".$posicao;
        ?>

        <div class="rank-item top-<?php echo $posicao; ?>">

            <div class="rank-pos"><?php echo $medalha; ?></div>

            <div class="rank-info">
                <span class="rank-name"><?php echo $row['nome']; ?></span>

                <div class="xp-bar">
                    <div class="xp-fill" style="width: <?php echo min($row['xp_total'],100); ?>%;"></div>
                </div>
            </div>

            <div class="rank-xp">
                <?php echo $row['xp_total']; ?> XP
            </div>

        </div>

        <?php
        $posicao++;
        }
        ?>

        </div>

    </div>

</div>

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
    <p class="copy small mb-0">© 2026 CyberEdu — Projeto Integrador I — Universidade Virtual do <br> Estado de São Paulo | UNIVESP</p>

  </div>
</footer>

</body>
</html>


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

// DARK MODE + RIPPLE (CORRETO)
function toggleDark(e){
    const body = document.getElementById("mainBody");
    const btn = document.getElementById("themeBtn");

    body.classList.toggle("dark-mode");

    // ÍCONE CERTO
    if(body.classList.contains("dark-mode")){
        btn.innerHTML = '<i class="bi bi-moon"></i>'; // 🌙
    }else{
        btn.innerHTML = '<i class="bi bi-sun"></i>'; // ☀️
    }

    // RIPPLE
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