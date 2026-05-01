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
    <title>CyberEdu | Dicas do Edu</title>

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
    
    .titulo-efeito2 {
    text-align: center;
    font-size: 2.2rem;
    font-weight: bold;
    position: relative;

    background: linear-gradient(90deg, #6ab082, #3a8ddb, #00b7ff, #00ffae);
    background-size: 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    animation: moverGradiente 4s ease-in-out infinite alternate;
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
.hero-edu {
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 8%;
    position: relative;
    overflow: hidden;

    background: url("dicabg.png") center -10% / 100% no-repeat;

    animation: bgZoom 20s ease-in-out infinite alternate;
}

/* ZOOM LEVE */
@keyframes bgZoom {
    0% { background-size: 100%; }
    100% { background-size: 101%; }
}

.hero-edu {
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 8%;
    position: relative;
    overflow: hidden;

    background: url("dicabg.png") center -10% / 100% no-repeat;

    animation: bgZoom 20s ease-in-out infinite alternate;
}


@keyframes bgZoom {
    0% { background-size: 100%; }
    100% { background-size: 101%; }
}


.hero-edu {
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 8%;
    position: relative;
    overflow: hidden;

    background: url("dicabg.png") center -10% / 100% no-repeat;
}

.hero-edu::before,
.hero-edu::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 70%; /* 👈 controla a altura do efeito */
    pointer-events: none;
}

.hero-edu::before {
    background: linear-gradient(
        120deg,
        transparent 25%,
        rgba(0,255,255,0.25),
        rgba(255,0,255,0.25),
        transparent 75%
    );

    opacity: 0.35; /* antes estava 0.6 */

}

/* partículas (sparkle) */
.hero-edu::after {
    background: url("https://assets.codepen.io/13471/sparkles.gif");
    background-size: cover;
mix-blend-mode: overlay;
    opacity: 0.4;
 height: 95%; /* 👈 ajusta aqui a altura das partículas */
}

/* movimento do brilho */
@keyframes holoMove {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}
.cyber-carousel {
    max-width: 900px;
    margin: auto;
    font-family: 'Poppins', sans-serif;
    color: #fff;
}

/* título mais corporativo */
.cyber-title {
    font-size: 20px;
    font-weight: 600;
    letter-spacing: 0.5px;
    color: #00e5ff;
    margin-bottom: 14px;
}

/* container mais clean */
.cyber-track {
    background: rgba(15, 18, 28, 0.9);
    border: 1px solid rgba(0,229,255,0.15);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

/* slide */
.cyber-slide {
    display: none;
    align-items: center;
    gap: 18px;
    padding: 22px;
}

.cyber-slide.active {
    display: flex;
}

/* imagem mais “dashboard” */
.cyber-slide img {
    width: 170px;
    height: 110px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid rgba(0,229,255,0.2);
}

/* texto */
.cyber-text h3 {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    color: #00e5ff;
}

.cyber-text p {
    font-size: 13px;
    font-weight: 300;
    opacity: 0.85;
    line-height: 1.5;
    max-width: 500px;
}

.cyber-controls {
    margin-top: 10px;
    display: flex;
    justify-content: center; 
    gap: 10px;
}

.cyber-controls button {
    background: transparent;
    border: 1px solid rgba(0,229,255,0.4);
    color: #00e5ff;
    padding: 6px 10px;
    cursor: pointer;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    transition: 0.2s;
}

.cyber-controls button:hover {
    background: rgba(0,229,255,0.1);
}
.cyber-indicator {
    margin-top: 12px;
    display: flex;
    justify-content: center;
    gap: 8px;
}

.cyber-indicator .dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: rgba(255,255,255,0.25);
    transition: 0.3s;
}

.cyber-indicator .dot.active {
    background: #00e5ff;
    box-shadow: 0 0 10px rgba(0,229,255,0.6);
    transform: scale(1.2);
}
.cyber-card{
background: rgba(15,23,42,0.7);
border: 1px solid rgba(59,130,246,0.2);
color: white;
border-radius: 15px;
overflow: hidden;
transition: 0.3s;
backdrop-filter: blur(10px);
}

.cyber-card img{
height: 330px;
object-fit: cover;
width: auto;
}

.cyber-card:hover{
transform: translateY(-5px);
box-shadow: 0 0 20px rgba(59,130,246,0.5);
}

.cyber-card h5{
color:#38bdf8;
}

.cyber-slide-img{
position: relative;
border-radius: 18px;
overflow: hidden;
border: 1px solid rgba(0,229,255,0.2);
box-shadow: 0 0 25px rgba(16, 145, 159, 0.39);
}

.cyber-slide-img img{
height: 420px;
object-fit: cover;

}

/* OVERLAY TEXTO */
.cyber-overlay{
position: absolute;
bottom: 0;
left: 0;
width: 100%;
padding: 25px;

background: linear-gradient(
    to top,
    rgb(0, 2, 0),
    transparent
);

color: white;
}


.cyber-overlay p{
font-size: 14px;
opacity: 0.9;
}

.carousel-control-prev,
.carousel-control-next {
    background: transparent !important;
    width: 5%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-image: none !important;
}


.carousel-control-prev-icon::after {
    content: "‹";
    font-size: 40px;
    color: #00e5ff;
  
}

.carousel-control-next-icon::after {
    content: "›";
    font-size: 40px;
    color: #00e5ff;
   
}


.intro-cyber {
    background: rgba(56, 189, 248, 0.08);
    border-left: 4px solid #38bdf8;
    padding: 20px;
    border-radius: 12px;
    color: #e5e7eb;

    /* efeito */
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 1s ease forwards;
}

.intro-cyber h2 {
    color: #38bdf8;
    margin-bottom: 10px;
}

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.intro-cyber {
    background: rgba(0, 0, 0, 0.65);
    border-left: 5px solid #38bdf8;
    border-radius: 14px;
    padding: 22px;
    color: #e5e7eb;
    box-shadow: 0 0 25px rgba(56, 189, 248, 0.25);

    backdrop-filter: blur(6px);

    /* animação */
    opacity: 0;
    transform: translateY(25px);
    animation: fadeCyber 1s ease forwards;
}

.intro-cyber h2 {
    color: #38bdf8;
    letter-spacing: 2px;
    text-shadow: 0 0 10px rgba(56, 189, 248, 0.6);
    margin-bottom: 10px;
}

.intro-cyber p {
    line-height: 1.6;
}

/* entrada suave */
@keyframes fadeCyber {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#typed-text b {
    color: #38bdf8;
    text-shadow: 0 0 8px rgba(56, 189, 248, 0.6);
    font-weight: 600;
}

#typed-text b {
    color: #22c55e;
    font-weight: 600;
 background: linear-gradient(90deg, #6ab082, #3a8ddb, #00b7ff, #00ffae);
    background-size: 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    animation: moverGradiente 4s ease-in-out infinite alternate;
    /* neon mais suave */
    text-shadow:
        0 0 3px rgba(34, 197, 94, 0.5),
        0 0 6px rgba(34, 197, 94, 0.35);
}
.cyber-card .card-body{
    text-align: left;
}
.titulo-card-neon{
    color:#38bdf8;
     background: linear-gradient(90deg, #6ab082, #3a8ddb, #00b7ff, #00ffae);
    background-size: 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    animation: moverGradiente 4s ease-in-out infinite alternate;
    font-weight:600;
}
.titulo-card-neon{
    color:#38bdf8;
     background: linear-gradient(90deg, #6ab082, #3a8ddb, #00b7ff, #00ffae);
    background-size: 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    animation: moverGradiente 4s ease-in-out infinite alternate;
    font-weight:600;
}
.glass-title {
  font-size: 1.8rem;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 1.5px;

  color: #ffffff;
  background: linear-gradient(90deg, #6bff7a, #ff6363);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;

  position: relative;
}

.glass-title::after {
  content: "";
  display: block;
  width: 60%;
  height: 2px;
  margin: 8px auto 0;
  background: linear-gradient(90deg, transparent, #ed0000, transparent);
  opacity: 0.7;
}
.scope {
  position: relative;
  width: 60px;
  height: 60px;
  margin: 0 auto 10px;
}

/* círculo externo */
.scope::before {
  content: "";
  position: absolute;
  inset: 0;
  border: 3px solid #ff2e2e;
  border-radius: 50%;
}

/* linhas da cruz */
.scope::after {
  content: "";
  position: absolute;
  inset: 0;
  background:
    linear-gradient(#ff2e2e, #ff2e2e) center/2px 100% no-repeat,
    linear-gradient(#ff2e2e, #ff2e2e) center/100% 2px no-repeat;
}

/* círculo interno */
.scope-inner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 28px;
  height: 28px;
  border: 3px solid #ff2e2e;
  border-radius: 50%;
}
.scope {
  animation: aimLock 1.5s ease-in-out infinite;
}

@keyframes aimLock {
  0%, 100% { transform: scale(1); opacity: 0.8; }
  50% { transform: scale(1.15); opacity: 1; }
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

            <!-- LINKS -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="inicio.php">Início</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="missoes_semlogin.php">Jogos</a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="missoes_semlogin.php">Dicas do Edu</a>
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

<section class="hero-edu">

    <div class="hero-content">

       

    
    </div>

  
</section>
<section class="container mt-5">

   <!-- INTRO -->
<div class="intro-cyber mb-4">
   
    <p id="typed-text"></p>
</div>
<BR>
  <div class="scope" id="scope">
  <div class="scope-inner"></div>
</div>

<h2 class="glass-title">
  <b>ALGUNS GOLPES & AMEAÇAS DIGITAIS</b>
</h2>

    <!-- CARDS (AGORA CORRETO) -->
    <div class="row mt-4 g-4">

       <div class="col-md-4">
    <div class="card cyber-card">
        <img src="dicacard/phishingcard.png" class="card-img-top">

        <div class="card-body text-start">
            <h5 class="card-title titulo-card-neon">🐟 Phishing</h5>

            <p>
Phishing é um golpe em que alguém finge ser um site, banco ou app para roubar seus dados, usando mensagens urgentes ou promessas como você ganhou algo ou atualize agora; para se proteger, não clique em links suspeitos, confira o site e nunca compartilhe suas informações.        </div>
    </div>
</div>

        <div class="col-md-4">
            <div class="card cyber-card">
                <img src="dicacard/escard.png" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title titulo-card-neon">⚙ Engenharia Social</h5>
                    <p>Engenharia social é quando alguém manipula você para conseguir informações ou acesso, fingindo ser uma pessoa confiável ou criando situações de urgência; para se proteger, desconfie de pedidos inesperados, não compartilhe dados pessoais e sempre confirme a identidade da pessoa antes de agir.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card cyber-card">
                <img src="dicacard/2FA.png" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title titulo-card-neon">📲 Autentificação de 2 Fatores (2FA)</h5>
A autenticação de dois fatores (2FA) é um método de segurança que exige dois tipos de verificação para acessar uma conta, como senha e um código gerado no Google Authenticator. Isso aumenta a proteção, pois mesmo que a senha seja descoberta, o acesso ainda depende do segundo fator.</div>
           
</div>
        </div>

    </div>
  <!-- CARDS 2 -->
    <div class="row mt-4 g-4">

       <div class="col-md-4">
    <div class="card cyber-card">
        <img src="dicacard/malwarecard.png" class="card-img-top">

        <div class="card-body text-start">
            <h5 class="card-title titulo-card-neon">🦟 Malware</h5>

            <p>
Malware é qualquer programa malicioso que invade teu dispositivo pra roubar dados, espionar ou causar danos sem você perceber, geralmente vindo de links ou downloads suspeitos. Pra evitar, não clique em fontes duvidosas, mantenha tudo atualizado e use antivírus. </div>
    </div>
</div>

        <div class="col-md-4">
            <div class="card cyber-card">
                <img src="dicacard/pix.png" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title titulo-card-neon">💸 Golpe do Pix</h5>
                    <p>O golpe do Pix acontece quando alguém te engana para você enviar dinheiro rápido, geralmente fingindo ser banco ou conhecido pelo WhatsApp. Como o Pix é instantâneo, o valor quase não pode ser recuperado. Desconfie de pedidos urgentes e sempre confirme antes de transferir.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card cyber-card">
                <img src="dicacard/ransoncard.png" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title titulo-card-neon"> 🕷 Ransomware</h5>
 Ransomware é um ataque que bloqueia arquivos ou dispositivo e exige pagamento para liberar acesso; para se proteger, evite links suspeitos, não baixe arquivos desconhecidos e mantenha backups atualizados sempre, use antivírus confiável e mantenha sistema atualizado.                </div>
           
</div>
        </div>

    </div>
     <!-- CARDS 3 -->
    <div class="row mt-4 g-4">

       <div class="col-md-4">
    <div class="card cyber-card">
        <img src="dicacard/wpp2.png" class="card-img-top">

        <div class="card-body text-start">
            <h5 class="card-title titulo-card-neon">🗨 Clonagem de Whatsapp</h5>

            <p>
“Clonagem de WhatsApp” é quando alguém consegue entrar na sua conta sem permissão. No WhatsApp isso acontece principalmente quando a pessoa pega o código de verificação que chega no seu celular e usa para ativar sua conta em outro aparelho, passando a usar como se fosse você. Também pode acontecer pelo WhatsApp Web se alguém escanear o QR Code do seu celular. Ou seja, não é uma clonagem real, é só o roubo do acesso à conta. </div>
    </div>
</div>

        <div class="col-md-4">
            <div class="card cyber-card">
                <img src="dicacard/pix.png" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title titulo-card-neon">➯ Links Maliciosos</h5>
                    <p>Links maliciosos são links falsos criados para enganar pessoas e roubar informações ou causar danos. Eles imitam sites confiáveis e, ao clicar, podem levar a páginas que pedem dados pessoais ou instalam vírus no dispositivo. Normalmente são enviados por mensagens, e-mails ou redes sociais e exploram a confiança ou curiosidade do usuário para fazê-lo clicar.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card cyber-card">
                <img src="dicacard/maninmiddle.png" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title titulo-card-neon"> 👁 Man-in-the-Middle</h5>
 Um ataque Man-in-the-Middle, geralmente em Wi-Fi's públicos acontece quando um invasor fica entre você e a internet, interceptando a conexão. Isso pode ocorrer em redes abertas ou falsas, permitindo que ele veja ou até altere os dados que você envia, principalmente se não estiverem bem protegidos.               </div>
           
</div>
        </div>

    </div>
    

</section>

<section class="container mt-5">

<h2 class="titulo-efeito2 text-start">
🔐 Dicas Rápidas de Segurança
</h2>

<div id="cyberCarousel" class="carousel slide mt-4" data-bs-ride="carousel">

<div class="carousel-inner">

    <!-- ITEM 1 -->
    <div class="carousel-item active">
        <div class="cyber-slide-img">

            <img src="img/cyber-senha.jpg" class="d-block w-100">

            <div class="cyber-overlay">
                <h3>🔑 Senhas Fortes</h3>
                <p>Use combinações complexas com letras, números e símbolos.</p>
            </div>

        </div>
    </div>

    <!-- ITEM 2 -->
    <div class="carousel-item">
        <div class="cyber-slide-img">

            <img src="img/2fa.jpg" class="d-block w-100">

            <div class="cyber-overlay">
                <h3>Autenticação em 2 Fatores</h3>
                <p>A autenticação em dois fatores (2FA) é uma forma de segurança que protege suas contas exigindo duas etapas para confirmar sua identidade. Primeiro, você digita sua senha normalmente, que é algo que você sabe. Depois disso, o sistema pede uma segunda confirmação, que geralmente é um código enviado para o seu celular ou gerado por um aplicativo autenticador. Isso significa que mesmo que alguém descubra sua senha, essa pessoa ainda não consegue acessar sua conta sem ter acesso ao seu celular ou ao segundo código. É como se sua conta tivesse duas portas de segurança: a primeira é a senha e a segunda é uma confirmação extra que só você consegue acessar. Essa camada adicional dificulta muito invasões e golpes, tornando suas contas bem mais seguras.</p>
            </div>

        </div>
    </div>

    <!-- ITEM 3 -->
    <div class="carousel-item">
        <div class="cyber-slide-img">

            <img src="img/wifi-publico.jpg" class="d-block w-100">

            <div class="cyber-overlay">
                <h3>🌐 Wi-Fi Público</h3>
                <p>Redes abertas podem expor seus dados pessoais.</p>
            </div>

        </div>
    </div>

    <!-- ITEM 4 -->
    <div class="carousel-item">
        <div class="cyber-slide-img">

            <img src="dicabg.png" class="d-block w-100">

            <div class="cyber-overlay">
                <h3>💸 Golpes de Pix</h3>
                <p>Sempre confirme antes de transferir qualquer valor.</p>
            </div>

        </div>
    </div>

</div>

<!-- CONTROLES -->
<button class="carousel-control-prev" type="button" data-bs-target="#cyberCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#cyberCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
</button>

</div>
</section>
<div class="cyber-carousel">
<br><br>
  <h2 class="titulo-efeito2" style="text-align: left; width: 70%; margin: 0; display: block; ">
    VOCÊ SABIA?
</h2>

    <div class="cyber-track">

        <div class="cyber-slide active">
            <img src="img/phishing.png" alt="">
            <div class="cyber-text">
                <h3>Origem dos Vírus de Computador </h3>
                <p>O primeiro vírus de computador, chamado “Creeper”, foi criado em 1971 como uma experiência. Desde então, os vírus evoluíram significativamente, tornando a cibersegurança uma prioridade.</p>
            </div>
        </div>

        <div class="cyber-slide">
            <img src="img/senha-fraca.png" alt="">
            <div class="cyber-text">
                <h3>Custo das Violações de Dados</h3>
                <p>Em 2023, o custo médio de uma violação de dados foi de aproximadamente $4,45 milhões. Isso destaca a importância de investir em medidas preventivas.</p>
            </div>
        </div>

        <div class="cyber-slide">
            <img src="img/wifi-publico.png" alt="">
            <div class="cyber-text">
                <h3>Senhas Fracas</h3>
                <p>Estudos mostram que “123456” e “password” ainda são senhas comuns, facilitando o trabalho dos hackers. A adoção de senhas fortes e únicas é essencial..</p>
            </div>
        </div>

        <div class="cyber-slide">
            <img src="img/2fa.png" alt="">
            <div class="cyber-text">
                <h3>Atualizações Regulares

</h3>
                <p>Mantenha todos os sistemas e softwares atualizados para proteger contra vulnerabilidades conhecidas.</p>
            </div>
        </div>

    </div>

  <div class="cyber-indicator">
    <span class="dot active"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
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





let cyberIndex = 0;
const cyberSlides = document.querySelectorAll(".cyber-slide");
const dots = document.querySelectorAll(".cyber-indicator .dot");

function showCyber(i) {
    cyberSlides.forEach(s => s.classList.remove("active"));
    dots.forEach(d => d.classList.remove("active"));

    cyberSlides[i].classList.add("active");
    dots[i].classList.add("active");
}

function nextCyber() {
    cyberIndex = (cyberIndex + 1) % cyberSlides.length;
    showCyber(cyberIndex);
}

let autoSlide = setInterval(nextCyber, 4000);

/* pausa no hover */
const carousel = document.querySelector(".cyber-track");

carousel.addEventListener("mouseenter", () => {
    clearInterval(autoSlide);
});

carousel.addEventListener("mouseleave", () => {
    autoSlide = setInterval(nextCyber, 2000);
});




const text = `Cibersegurança é como um <b>escudo invisível</b> que protege tudo o que você faz na internet: seus sistemas, suas redes e principalmente seus dados. É ela que fica de olho para impedir <b>ataques digitais</b>, golpes e invasões que podem tentar roubar suas informações.

No dia a dia, é essa proteção que ajuda você a não cair em <b>links falsos</b>, mensagens suspeitas ou armadilhas criadas para enganar. Entender como esses riscos funcionam não é exagero — é o que te mantém <b>seguro</b> enquanto você navega, conversa e vive online.

Ficar esperto na internet não é paranoia… é <b><b>sobrevivência digital</b></b>.`;

let i = 0;
const speed = 18;
const target = document.getElementById("typed-text");

function typeWriter() {
    if (!target) return;

    // aqui usamos innerHTML completo (não caractere por caractere quebrando tags)
    target.innerHTML = text.slice(0, i);

    i++;

    if (i <= text.length) {
        setTimeout(typeWriter, speed);
    }
}

document.addEventListener("DOMContentLoaded", typeWriter);

</script>