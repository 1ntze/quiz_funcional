<?php
session_start();
include("testeconexao.php");
include("xp.php");

// iniciar pergunta
if (!isset($_SESSION['pergunta_atual'])) {
    $_SESSION['pergunta_atual'] = 1;
}

// verificar resposta
if (isset($_POST['resposta'])) {

    $id_alt = $_POST['resposta'];

    $sql_check = "SELECT correta FROM alternativas WHERE id_alternativa = $id_alt";
    $res_check = $conn->query($sql_check);
    $dados = $res_check->fetch_assoc();

   if ($dados && $dados['correta'] == 1) {

    $_SESSION['mensagem'] = "✅ Acertou! +10 XP";

    // adiciona XP ao jogador
    adicionarXP($conn, $_SESSION['id_usuario'], 10);

} else {

    $_SESSION['mensagem'] = "erro";

}

    $_SESSION['pergunta_atual']++;

    header("Location: quiz.php");
    exit();
}

// 🔥 pega total de perguntas automaticamente
$sql_total = "SELECT COUNT(*) as total FROM perguntas";
$res_total = $conn->query($sql_total);
$total = $res_total->fetch_assoc()['total'];

// verifica fim do quiz
if ($_SESSION['pergunta_atual'] > $total) {

    unset($_SESSION['pergunta_atual']);
    unset($_SESSION['mensagem']);

    header("Location: index.php");
    exit();
}

// buscar pergunta atual
$id_pergunta = $_SESSION['pergunta_atual'];

$sql = "SELECT * FROM perguntas WHERE id_pergunta = $id_pergunta";
$result = $conn->query($sql);
$pergunta = $result->fetch_assoc();

// 🔥 evita erro null
if (!$pergunta) {
    echo "<h1>Erro: pergunta não encontrada</h1>";
    exit();
}

// buscar alternativas aleatórias
$sql2 = "SELECT * FROM alternativas WHERE id_pergunta = $id_pergunta ORDER BY RAND()";
$result2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>CyberEdu | Quiz</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonte -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="ranking.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="icon" type="image/png" href="Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


<style>
/* ========================= */
/* 🌞 LIGHT MODE AJUSTADO */
/* ========================= */

body:not(.dark-mode){
    background: #f5f7fb;
    color: #0f172a;
}

/* NAVBAR */
body:not(.dark-mode) .navbar{
    background: #ffffff !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

body:not(.dark-mode) .nav-link{
    color: #1e293b !important;
}

body:not(.dark-mode) .nav-link.active{
    color: #2563eb !important;
    font-weight: 600;
}

/* PERGUNTA BOX */
body:not(.dark-mode) .pergunta-box{
    background: #ffffff;
    color: #0f172a;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

/* BOTÕES */
body:not(.dark-mode) .alt-btn{
    background: #f1f5f9;
    color: #0f172a;
    border: 1px solid #e2e8f0;
}

body:not(.dark-mode) .alt-btn:hover{
    background: #e0e7ff;
    box-shadow: 0 0 15px rgba(37,99,235,0.4);
}

/* BOTÃO PADRÃO */
body:not(.dark-mode) button{
    background: #2563eb;
    color: white;
}

body:not(.dark-mode) button:hover{
    background: #1d4ed8;
}

/* PROGRESSO */
body:not(.dark-mode) .progress-container{
    background: #e2e8f0;
}

body:not(.dark-mode) .progress-bar{
    background: linear-gradient(90deg, #2563eb, #60a5fa);
}

/* TEXTO PROGRESSO */
body:not(.dark-mode) .progresso-text{
    color: #475569;
}

/* RANKING */
body:not(.dark-mode) .ranking{
    background: #ffffff;
    color: #0f172a;
}

body:not(.dark-mode) .ranking th{
    background: #2563eb;
}

body:not(.dark-mode) .ranking tr:hover{
    background: #f1f5f9;
}

/* FOOTER */
body:not(.dark-mode) footer{
    color: #475569;
}

/* OVERLAY (mantém contraste bom) */
body:not(.dark-mode) .overlay-erro,
body:not(.dark-mode) .overlay-acerto{
    background: rgba(0,0,0,0.7);
}

/* FIM QUIZ */
body:not(.dark-mode) .fim-box{
    background: #ffffff;
    color: #0f172a;
    border: 1px solid #e2e8f0;
}

body:not(.dark-mode) .fim-box h1{
    color: #f59e0b;
    text-shadow: none;
}
    /* LIMITAR LARGURA  */
.container{
    max-width: 700px;
}

/* PERGUNTA */
.pergunta-box{
    background: rgba(15,23,42,0.85);
    padding: 25px;
    border-radius: 20px;
    margin-bottom: 25px;

    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 25px rgba(59,130,246,0.2);

    animation: fadeInUp 0.6s ease;
}

/* BOTÕES RESPOSTA */
.alt-btn{
    width: 100%;
    padding: 18px;
    margin: 10px 0;
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.1);
    
    background: rgba(30, 58, 138, 0.3);
    color: white;
    font-size: 16px;
    text-align: left;

    backdrop-filter: blur(10px);

    transition: 0.3s;
    cursor: pointer;

    animation: fadeInUp 0.5s ease;
}

.alt-btn:hover{
    transform: scale(1.03);
    background: rgba(59,130,246,0.4);
    box-shadow: 0 0 20px rgba(59,130,246,0.8);
}

.alt-btn:active{
    transform: scale(0.97);
}

/* PROGRESSO */
.progress-container{
    width: 100%;
    height: 12px;
    background: rgba(255,255,255,0.1);
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 10px;
}

.progress-bar{
    height: 100%;
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    border-radius: 20px;
    transition: 0.5s;
    box-shadow: 0 0 15px #3b82f6;
}

.progresso-text{
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 20px;
}

/* MENSAGENS */
.msg-ok{
    background: rgba(34,197,94,0.2);
    border: 1px solid #22c55e;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
    animation: fadeIn 0.5s;
}

.msg-erro{
    background: rgba(239,68,68,0.2);
    border: 1px solid #ef4444;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
    animation: fadeIn 0.5s;
}
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

/* OVERLAY (SERVE PRA OS DOIS) */
.overlay-erro,
.overlay-acerto{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

     background: rgba(0,0,0,0.55);
    backdrop-filter: blur(4px);

    display: flex;
    justify-content: center;
    align-items: center;

    z-index: 9999;

    animation: fadeIn 0.3s ease;
}

.overlay-erro,
.overlay-acerto{
    opacity: 1;
    transition: opacity 0.4s ease;
}

/* CAIXA (SERVE PRA OS DOIS) */
.gameover-box,
.acerto-box{
    text-align: center;
    color: white;

    animation: zoomIn 0.4s ease;
}

/* RAPOSA (MESMO TAMANHO E ANIMAÇÃO) */
.raposa-boss,
.raposa-win{
    width: 230px;
    height: auto;

    margin-bottom: 15px;

    animation: raposaPop 0.5s ease;
}

/* TEXO PADRÃO */
.gameover-box h1,
.acerto-box h1{
    font-size: 42px;
    margin-bottom: 10px;
}

.gameover-box p,
.acerto-box p{
    font-size: 18px;
    opacity: 0.9;
}

/* 🔴 ERRO (SÓ MUDA COR) */
.overlay-erro .raposa-boss{
    filter: drop-shadow(0 0 25px #ef4444);
}

.overlay-erro h1{
    color: #ef4444;
    text-shadow: 0 0 20px #ef4444;
}

/* 🟢 ACERTO (SÓ MUDA COR) */
.overlay-acerto .raposa-win{
    filter: drop-shadow(0 0 25px #22c55e);
}

.overlay-acerto h1{
    color: #22c55e;
    text-shadow: 0 0 20px #22c55e;
}

/* ANIMAÇÕES (ÚNICAS PRA TUDO) */
@keyframes zoomIn{
    from{
        transform: scale(0.7);
        opacity: 0;
    }
    to{
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes raposaPop{
    0%{transform: scale(0.8);}
    50%{transform: scale(1.2);}
    100%{transform: scale(1);}
}

.confete-container{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
}

.confete{
    position: absolute;
    top: -10px;
    width: 8px;
    height: 14px;
    opacity: 0.8;

    animation: cair linear forwards;
}

@keyframes cair{
    to{
        transform: translateY(100vh) rotate(360deg);
    }
}
/* OVERLAY FINAL */
.overlay-fim{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    background: radial-gradient(circle at center, rgba(15,23,42,0.95), #020617);

    display: flex;
    justify-content: center;
    align-items: center;

    z-index: 9999;
    overflow: hidden;
}

/* CAIXA CENTRAL */
.fim-box{
    text-align: center;
    color: white;

    padding: 40px;
    border-radius: 25px;

    background: rgba(15,23,42,0.8);
    backdrop-filter: blur(12px);

    border: 1px solid rgba(255,255,255,0.1);

    box-shadow: 
        0 0 30px rgba(59,130,246,0.3),
        0 0 60px rgba(59,130,246,0.2);

    animation: zoomIn 0.5s ease;
}

/* TROFÉU */
.trofeu{
    width: 220px;
    height: 220px;

    object-fit: contain;

    margin-bottom: 20px;

    filter: drop-shadow(0 0 30px gold);

    animation: trofeuGlow 2s infinite alternate;
}

/* TÍTULO */
.fim-box h1{
    font-size: 45px;
    margin-bottom: 10px;

    color: gold;
    text-shadow: 0 0 25px gold;
}

/* TEXTO */
.fim-box p{
    font-size: 18px;
    opacity: 0.85;
    margin-bottom: 20px;
}

/* BOTÃO */
.fim-box button{
    padding: 15px 35px;
    border-radius: 12px;
    border: none;

    background: linear-gradient(45deg, #3b82f6, #2563eb);
    color: white;
    font-size: 16px;

    cursor: pointer;

    transition: 0.3s;
    box-shadow: 0 0 15px rgba(59,130,246,0.6);
}

.fim-box button:hover{
    transform: scale(1.1);
    box-shadow: 0 0 35px rgba(59,130,246,1);
}

/* ANIMAÇÕES */
@keyframes zoomIn{
    from{
        transform: scale(0.7);
        opacity: 0;
    }
    to{
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes trofeuGlow{
    from{
        transform: scale(1);
        filter: drop-shadow(0 0 20px gold);
    }
    to{
        transform: scale(1.1);
        filter: drop-shadow(0 0 40px gold);
    }
}

/* botão perfil estilo login cyber */
.perfil-btn{
    background: linear-gradient(135deg, #4f46e5, #06b6d4);
    border: none;
    color: white !important;
    border-radius: 50px;
    padding: 6px 14px;
    transition: 0.3s;
    font-weight: 500;
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

      <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="/img/pages/img/logoof.png" alt="Logo" width="100" height="70" class="me-2 logo-energia">
</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="Inicio.php">Início</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="rankingpage.php">Ranking</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="index.php">Jogos</a>
                    </li>


                </ul>

<!-- BOTÕES DIREITA -->
<button onclick="toggleDark(event)" id="themeBtn" class="btn btn-outline-primary me-3">
    <i class="bi bi-sun"></i>
</button>

<?php if(isset($_SESSION['nome'])): ?>

    <!-- PERFIL COM AVATAR -->
    <a href="profile.php" class="d-flex align-items-center btn btn-outline-primary me-2 perfil-btn">

      <img src="perfilft.png" class="avatar-navbar me-2">

         <?php echo $_SESSION['nome']; ?>
    </a>

    <!-- SAIR -->
    <button class="btn btn-custom" onclick="window.location.href='logout.php'">
        <b> Sair</b>
    </button>

<?php else: ?>

    <!-- LOGIN -->
    <a href="login.php" class="btn btn-primary">
        Entrar
    </a>

<?php endif; ?>

</nav>
    
    <div class="container">

<?php
$progresso = ($_SESSION['pergunta_atual'] / $total) * 100;
?>

<!-- BARRA -->
<div class="progress-container">
    <div class="progress-bar" style="width: <?php echo $progresso; ?>%"></div>
</div>

<p class="progresso-text">
    Pergunta <?php echo $_SESSION['pergunta_atual']; ?> de <?php echo $total; ?>
</p>
<?php

if (isset($_SESSION['mensagem']) && $_SESSION['pergunta_atual'] <= $total) {

    if ($_SESSION['mensagem'] == "erro") {

        echo "
        <div class='overlay-erro'>
            <div class='gameover-box'>
                <img src='errou.png' class='raposa-boss'>
                <h1><b> ERROU!</b></h1>
                <p>Não… não… não! Você consegue melhor que isso!</p>
            </div>
        </div>
        ";

    } else {

        echo "
        <div class='overlay-acerto'>

            <div class='confete-container'></div>

            <div class='acerto-box'>
                <img src='acertou.png' class='raposa-win'>
                <h1><b> ACERTOU!</b></h1>
                <p>Essa foi de quem sabe! 👀 Receba seu XP!</p>
            </div>

        </div>
        ";
    }

    unset($_SESSION['mensagem']);
}
?>
<!-- PERGUNTA -->
<div class="pergunta-box">
    <h2><?php echo $pergunta['texto_pergunta']; ?></h2>
</div>

<!-- ALTERNATIVAS -->
<?php while($alt = $result2->fetch_assoc()) { ?>
    <form method="POST">
        <button 
            type="submit" 
            name="resposta" 
            value="<?php echo $alt['id_alternativa']; ?>" 
            class="alt-btn">
            <?php echo $alt['texto_alternativa']; ?>
        </button>
    </form>
<?php } ?>

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
      <a href="#" class="mx-2"><i class="bi bi-discord"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-youtube"></i></a>
      <a href="#" class="mx-2"><i class="bi bi-github"></i></a>
    </div>

    <!-- COPYRIGHT -->
    <p class="copy small mb-0">© 2026 CyberEdu — Projeto Integrador I — Universidade Virtual do <br> Estado de São Paulo | UNIVESP</p>

  </div>
</footer>
<audio id="somErro">
    <source src="data:audio/wav;base64,UklGRiQAAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQAAAAA=" type="audio/wav">
</audio>
</html>

<script>
window.addEventListener("load", () => {

    const erro = document.querySelector('.overlay-erro');
    const acerto = document.querySelector('.overlay-acerto');

    // ❌ ERRO
    if(erro){
        const audio = document.getElementById('somErro');
        if(audio){
            audio.currentTime = 0;
            audio.play().catch(()=>{});
        }

        setTimeout(() => erro.style.display = 'none', 3000);
    }

    // ✅ ACERTO
    if(acerto){
        const audio = document.getElementById('somAcerto');
        if(audio){
            audio.currentTime = 0;
            audio.play().catch(()=>{});
        }

        // 🎉 CONFETE
        const container = document.querySelector('.confete-container');

        if(container){
            for(let i = 0; i < 80; i++){

                const confete = document.createElement("div");
                confete.classList.add("confete");

                confete.style.left = Math.random() * 100 + "vw";
                confete.style.animationDuration = (Math.random() * 2 + 2) + "s";

                // 🔥 AQUI DENTRO (CORRETO)
                confete.style.width = (Math.random() * 6 + 6) + "px";
                confete.style.height = (Math.random() * 10 + 10) + "px";
                confete.style.borderRadius = Math.random() > 0.5 ? "50%" : "0";

                const cores = ["#22c55e", "#3b82f6", "#facc15", "#ef4444", "#a855f7"];
                confete.style.background = cores[Math.floor(Math.random() * cores.length)];

                container.appendChild(confete);
            }
        }

        setTimeout(() => acerto.style.display = 'none', 3200);
    }

});

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