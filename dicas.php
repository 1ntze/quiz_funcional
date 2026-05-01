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
black;

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
    background:black;
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

    background: url("bgn.png") center -10% / 100% no-repeat;

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

    background: url("bgn.png") center -10% / 100% no-repeat;

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

    background: url("bgn.png") center -10% / 100% no-repeat;
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
        rgba(0, 234, 255, 0.25),
        rgba(255, 0, 0, 0.25),
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


.carousel-control-prev-icon::after,
.carousel-control-next-icon::after {
    color: #ef4444; /* 🔴 vermelho cyber */
    text-shadow: 0 0 10px rgba(239, 68, 68, 0.8);
}

/* hover mais agressivo */
.carousel-control-prev:hover .carousel-control-prev-icon::after,
.carousel-control-next:hover .carousel-control-next-icon::after {
    color: #ff0000;
    text-shadow: 0 0 20px rgba(255, 0, 0, 1);
}

/* fundo invisível mais clean */
.carousel-control-prev,
.carousel-control-next {
    background: transparent !important;
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

.glass-title2 {
  font-size: 1.8rem;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 1.5px;

  color: #ffffff;
  background: linear-gradient(90deg, #0f8935b6, #2374b6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;

  position: relative;
}
.glass-title2::after {
  content: "";
  display: block;
  width: 60%;
  height: 2px;
  margin: 8px auto 0;
  background: linear-gradient(90deg, transparent, #00aaed, transparent);
  opacity: 0.7;
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
.cyber-card {
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    background: #0f172a;
}

/* ✨ partículas sempre visíveis */
.cyber-card::after {
    content: "";
    position: absolute;
    inset: 0;

    background: url("https://assets.codepen.io/13471/sparkles.gif");
    background-size: cover;

    mix-blend-mode: overlay;
    opacity: 0.25;

    pointer-events: none;
}

/* 🌈 brilho holográfico sempre ativo */
.cyber-card::before {
    content: "";
    position: absolute;
    inset: 0;

    background: linear-gradient(
        120deg,
        transparent 20%,
     rgba(239,68,68,0.25),
rgba(220,38,38,0.25),
rgba(239,68,68,0.25),
        transparent 80%
    );

    animation: holoMove 4s linear infinite;
    opacity: 0.6; /* 👈 agora sempre visível */
}

/* animação */
@keyframes holoMove {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
.polaroid {
  width: 320px;
  flex-shrink: 0;
}

.polaroid-inner {
  background: #f4f1e8;
  padding: 14px 14px 25px;
  position: relative;

  background-image: 
    radial-gradient(rgba(0,0,0,0.05) 1px, transparent 1px),
    linear-gradient(120deg, rgba(255,255,255,0.3), rgba(0,0,0,0.1));
  background-size: 4px 4px, 100% 100%;

  border-radius: 6px 8px 5px 10px;

  box-shadow:
    0 20px 40px rgba(0,0,0,0.6),
    inset 0 0 30px rgba(0,0,0,0.15);

  transform: rotate(-2deg);
  transform-origin: center bottom;
  transition: 0.4s;
}

/* rotação aleatória CORRETA */
.polaroid:nth-child(odd) .polaroid-inner {
  transform: rotate(-3deg);
}

.polaroid:nth-child(even) .polaroid-inner {
  transform: rotate(2.5deg);
}

/* efeitos AGORA no lugar certo */
.polaroid-inner::before {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: inherit;
  pointer-events: none;

  background: radial-gradient(
    circle at center,
    transparent 60%,
    rgba(0,0,0,0.25) 100%
  );
}

.polaroid-inner::after {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: inherit;
  pointer-events: none;

  background: linear-gradient(
    to bottom,
    rgba(0,0,0,0.15),
    transparent 20%,
    transparent 80%,
    rgba(0,0,0,0.2)
  );
}

/* imagem */
.polaroid img {
  width: 100%;
  height: 240px;
  object-fit: cover;
 
  border-radius: 3px;
}

/* texto */
.caption h3,
.caption p {
  font-family: 'Courier New', monospace;
  color: black;
}

/* hover PERFEITO */
.polaroid:hover .polaroid-inner {
  transform: scale(1.08) rotate(0deg) translateY(-10px);
  box-shadow:
    0 30px 60px rgba(0,0,0,0.8),
    0 0 20px rgba(255,0,0,0.3);
}

/* botões (sem bootstrap azul) */
.carousel-btn {
  all: unset;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;

  background: black;
  color: white;
  padding: 10px 14px;
  border-radius: 8px;
  z-index: 2;
}

.prev { left: 10px; }
.next { right: 10px; }

/* track */
.carousel-track {
  display: flex;
  gap: 20px;
  align-items: flex-start;
  transition: transform 0.5s ease;
  width: max-content;
}

/* container */
.polaroid-carousel {
  overflow: hidden;
  position: relative;
  width: 100%;
  padding: 60px 20px; /* 🔥 evita corte */
}

.netflix-row{
  display:flex;
  gap:25px;
  overflow-x:auto;
  padding:20px;
  position:relative;
}

.netflix-card{
  min-width:220px;
  height:330px;
  border-radius:14px;
  background-size:cover;
  background-position:center;
  cursor:pointer;
  position:relative;
  transition: all 0.4s ease;
  z-index:1;
}

/* TEXTO */
.netflix-card span{
  position:absolute;
  bottom:10px;
  left:10px;
  font-weight:bold;
  background:rgba(0,0,0,0.7);
  padding:6px 12px;
  border-radius:6px;
}

/* 🔥 HOVER ESTILO NETFLIX */
.netflix-row:hover .netflix-card{
  opacity:0.3;
  transform: scale(0.95);
  filter: blur(1px);
}

.netflix-card:hover{
  transform: scale(1.3);
  opacity:1 !important;
  filter: blur(0) !important;
  z-index:10;

  box-shadow:
    0 20px 50px rgba(0,0,0,0.8),
    0 0 30px rgba(239,68,68,0.7);
}

/* LEVE DESLOCAMENTO LATERAL (efeito Netflix real) */
.netflix-card:hover ~ .netflix-card{
  transform: translateX(40px);
}.netflix-modal{
  display:none;
  position:fixed;
  inset:0;
  background:rgba(0,0,0,0.85);
  backdrop-filter: blur(10px);
  justify-content:center;
  align-items:center;
  z-index:9999;

  opacity:0;
  transition:0.3s;
}

.netflix-modal.show{
  display:flex;
  opacity:1;
}

.netflix-content{
  background:#0f172a;
  padding:35px;
  border-radius:18px;
  max-width:550px;
  width:90%;
  text-align:left;

  transform: scale(0.8);
  transition:0.3s;

  box-shadow:
    0 0 40px rgba(59,130,246,0.5),
    0 0 80px rgba(0,0,0,0.8);
}

.netflix-modal.show .netflix-content{
  transform: scale(1);
}

.reco-row{
  display:flex;
  gap:10px;
  margin-top:10px;
}

.reco-card{
  width:100px;
  height:140px;
  border-radius:8px;
  background-size:cover;
  background-position:center;
  cursor:pointer;
  transition:0.3s;
}

.reco-card:hover{
  transform:scale(1.1);
}

.netflix-content.expanded{
  width: 900px;
  max-width: 95%;
  padding: 0;
  overflow: hidden;
}

/* HERO */
.modal-hero{
  height: 350px;
  background-size: cover;
  background-position: center;
  position: relative;
  display:flex;
  align-items:flex-end;
}

.modal-hero .overlay{
  position:absolute;
  inset:0;
  background: linear-gradient(to top, #0f172a 20%, transparent);
}

.hero-info{
  position:relative;
  padding:25px;
  z-index:2;
}

.hero-info h1{
  font-size:32px;
  font-weight:bold;
}

.tags span{
  background:#ef4444;
  padding:4px 10px;
  margin-right:5px;
  border-radius:5px;
  font-size:12px;
}

/* BOTÕES */
.modal-actions{
  margin-top:15px;
}

.btn-play{
  background:#ef4444;
  border:none;
  padding:10px 18px;
  border-radius:8px;
  margin-right:10px;
  color:white;
  cursor:pointer;
}

.btn-info{
  background:#334155;
  border:none;
  padding:10px 18px;
  border-radius:8px;
  color:white;
  cursor:pointer;
}

/* DETALHES */
.modal-details{
  display:flex;
  gap:20px;
  padding:20px;
}

.modal-details .col{
  flex:1;
  background:#020617;
  padding:15px;
  border-radius:10px;
}

/* FUNDO DO MODAL */
.netflix-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.85);
  backdrop-filter: blur(8px);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 999;
}

/* CONTEÚDO */
.netflix-content {
  width: 85%;
  max-width: 1100px;
  background: #141414;
  border-radius: 12px;
  overflow: hidden;
  animation: fadeIn 0.4s ease;
  box-shadow: 0 0 40px rgba(0,0,0,0.8);
}

/* ANIMAÇÃO */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* BOTÃO FECHAR */
.close {
  position: absolute;
  top: 15px;
  right: 20px;
  background: rgba(0,0,0,0.6);
  border: none;
  color: #fff;
  font-size: 22px;
  padding: 5px 10px;
  border-radius: 50%;
  cursor: pointer;
  transition: 0.3s;
}

.close:hover {
  background: #e50914;
}

/* HERO */
.modal-hero {
  position: relative;
  height: 400px;
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: flex-end;
}

.modal-hero .overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  background: linear-gradient(to top, #141414 10%, transparent 60%);
}

.hero-info {
  position: relative;
  padding: 30px;
  max-width: 600px;
}

/* TÍTULO */
.hero-info h1 {
  font-size: 2.2rem;
  margin-bottom: 10px;
}

/* TAGS */
.tags {
  margin-bottom: 10px;
}

.tag {
  display: inline-block;
  background: rgba(255,255,255,0.1);
  padding: 5px 10px;
  margin-right: 5px;
  border-radius: 5px;
  font-size: 12px;
}

.tag.highlight {
  background: #e50914;
}

/* TEXTO */
.hero-info p {
  font-size: 14px;
  color: #ccc;
  margin-bottom: 15px;
}

/* BOTÕES */
.modal-actions {
  display: flex;
  gap: 10px;
}

.btn {
  padding: 10px 18px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-weight: bold;
  transition: 0.3s;
}

.btn.primary {
  background: #e50914;
  color: #fff;
}

.btn.primary:hover {
  background: #ff1f2d;
  transform: scale(1.05);
}

.btn.secondary {
  background: rgba(255,255,255,0.1);
  color: #fff;
}

.btn.secondary:hover {
  background: rgba(255,255,255,0.2);
}

/* DETALHES */
.modal-details {
  display: flex;
  gap: 20px;
  padding: 25px;
}

.modal-details .col {
  flex: 1;
}

.modal-details h4 {
  margin-bottom: 8px;
}

.modal-details p {
  font-size: 14px;
  color: #bbb;
}

/* RECOMENDAÇÕES */
.reco-section {
  padding: 20px;
}

.reco-section h4 {
  margin-bottom: 10px;
}

.reco-row {
  display: flex;
  gap: 10px;
  overflow-x: auto;
}

/* CARD */
.reco-row .card2 {
  min-width: 150px;
  height: 220px;
  background-size: cover;
  background-position: center;
  border-radius: 8px;
  cursor: pointer;
  transition: 0.3s;
  position: relative;
}

.reco-row .card:hover {
  transform: scale(1.1);
  z-index: 2;
}

/* SCROLL BONITO */
.reco-row::-webkit-scrollbar {
  height: 6px;
}

.reco-row::-webkit-scrollbar-thumb {
  background: #333;
  border-radius: 10px;
}/* LINHA */
.reco-row {
  display: flex;
  gap: 14px;
  overflow-x: auto;
  padding-bottom: 10px;
}

/* SCROLL SUAVE */
.reco-row::-webkit-scrollbar {
  height: 6px;
}
.reco-row::-webkit-scrollbar-thumb {
  background: #444;
  border-radius: 10px;
}



/* OVERLAY ESCURO */
.card2::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.85), transparent 60%);
}

/* TEXTO */
.card-overlay {
  position: absolute;
  bottom: 10px;
  left: 10px;
  right: 10px;
  z-index: 2;
}

.card-overlay h5 {
  font-size: 14px;
  margin: 0;
}

/* HOVER BONITO */
.card2:hover {
  transform: scale(1.15);
  z-index: 5;
  box-shadow: 0 10px 25px rgba(0,0,0,0.8);
}

/* EFEITO NOS VIZINHOS */
.reco-row:hover .card2 {
  opacity: 0.4;
}

.reco-row .card2:hover {
  opacity: 1;
}
.reco-header,
.reco-row {
  padding-left: 40px; /* ajusta aqui o quanto quer mover 👉 */
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
                <img src="dicacard/link.png" class="card-img-top">
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

  <div class="polaroid-carousel">

    <button class="carousel-btn prev">❮</button>

    <div class="carousel-track">

      <div class="polaroid">
        <div class="polaroid-inner">
          <img src="dicacard/origem.png">
          <div class="caption">
            <br>
          <h3 style="font-size: 20px;"><b> Primeiros Vírus</b></h3>
            <p>O Brain (1986) foi o primeiro vírus de PC IBM PC.
Entrava por disquete ao ligar o computador e se copiava para outros. Não era destrutivo, mas mostrou que o boot controla tudo.</p>
          </div>
        </div>
      </div>

      <div class="polaroid">
        <div class="polaroid-inner">
          <img src="dicacard/cp.png">
          <div class="caption">
            <br>
           <h3 style="font-size: 20px;"><b>Creeper</b></h3>
            <p>Criado em 1971, foi um dos primeiros programas a se espalhar sozinho. Ele só mostrava a mensagem: “I’m the creeper, catch me if you can!”</p>
          </div>
        </div>
      </div>

      <div class="polaroid">
        <div class="polaroid-inner">
          <img src="dicacard/ily.png">
          <div class="caption">
             <br>
             <h3 style="font-size: 20px;"> <b>I love you ♡</b></h3>
            <p>Foi um worm de 2000 — um tipo de vírus que se espalha sozinho pela rede — disfarçado de “carta de amor”. Ao abrir, infectava o PC, apagava arquivos e se enviava para contatos, atingindo milhões.</p>
          </div>
        </div>
      </div>

      <div class="polaroid">
        <div class="polaroid-inner">
          <img src="dicacard/419.png">
          <div class="caption">
            <br>
            <h3 style="font-size: 20px;"> <b> ♕ Príncipe Nigeriano (419)</b></h3>
            <p>O golpe 419 é uma fraude por e-mail que promete dinheiro fácil, como heranças ou prêmios. Para receber, a vítima paga taxas antecipadas e nunca vê o valor. O nome vem da lei da Nigéria contra esse tipo de crime.</p>
          </div>
        </div>
      </div>

      <div class="polaroid">
        <div class="polaroid-inner">
          <img src="dicacard/engs.png">
          <div class="caption">
              <br>
            <h3 style="font-size: 20px;"> <b> Eng. Social X Erro Humano</b></h3>
            <p>Engenharia social é quando golpistas enganam pessoas em vez de atacar sistemas. Eles fingem ser bancos, empresas ou conhecidos para roubar senhas e dados. O foco do golpe é o erro humano, não a tecnologia.</p>
          </div>
        </div>
      </div>
    </div>

    <button class="carousel-btn next">❯</button>

  </div>

</section>

    <div class="cyber-track">

</div>

<section class="container mt-5">

  <div class="scope" id="scope">
  <div class="scope-inner"></div>
</div>

<h2 class="glass-title">
  <b>IDENTIFIQUE E REAJA</b>
</h2>
<BR>
<div class="netflix-row">

  <div class="netflix-card" onclick="openModal('phishing')"
    style="background-image:url('dicacard/netphishing.png')">
    <span>PHISHING</span>
  </div>

  <div class="netflix-card" onclick="openModal('banco')"
    style="background-image:url('dicacard/pix.png')">
    <span>GOLPE BANCÁRIO</span>
  </div>

  <div class="netflix-card" onclick="openModal('boleto')"
    style="background-image:url('dicacard/link.png')">
    <span>BOLETO FALSO</span>
  </div>

  <div class="netflix-card" onclick="openModal('promo')"
    style="background-image:url('dicacard/wpp2.png')">
    <span>PROMOÇÕES FALSAS</span>
  </div>

  <div class="netflix-card" onclick="openModal('site')"
    style="background-image:url('dicacard/malwarecard.png')">
    <span>SITES FALSOS</span>
  </div>

</div>

</section>

<!-- MODAL -->
<div id="netflixModal" class="netflix-modal">
  <div class="netflix-content expanded">

    <span class="close" onclick="closeModal()">×</span>

    <!-- CAPA GRANDE -->
    <div class="modal-hero" id="modalHero">
      <div class="overlay"></div>

      <div class="hero-info">
        <h1 id="modalTitle"></h1>

        <div class="tags">
          <span>Segurança</span>
          <span>Educação</span>
          <span>Digital</span>
        </div>

        <p id="modalText"></p>

        <div class="modal-actions">
          <button class="btn-play">⚠️ Como identificar?</button>
          <button class="btn-info">🛡 Como se proteger?</button>
        </div>
      </div>
    </div>

    <!-- DETALHES -->
    <div class="modal-details">
      <div class="col">
        <h4>💡 <b>O QUE FAZER?</b></h4>
        <p id="modalDo"></p>
      </div>

      <div class="col">
        <h4>🚨<b> SINAIS DE GOLPE</b></h4>
        <p id="modalSigns"></p>
      </div>
    </div>

   <div class="reco-header">
  <h4>🔥 <b>Recomendados</b></h4>
</div>

<div id="recommendations" class="reco-row"></div>
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



const track = document.querySelector('.carousel-track');
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

let scrollAmount = 0;

function getCardWidth() {
  const card = document.querySelector('.polaroid');
  const style = window.getComputedStyle(track);
  const gap = parseInt(style.gap) || 0;

  return card.offsetWidth + gap;
}

function getMaxScroll() {
  return track.scrollWidth - track.parentElement.offsetWidth;
}

nextBtn.addEventListener('click', () => {
  scrollAmount += getCardWidth();

  if (scrollAmount > getMaxScroll()) {
    scrollAmount = getMaxScroll();
  }

  track.style.transform = `translateX(-${scrollAmount}px)`;
});

prevBtn.addEventListener('click', () => {
  scrollAmount -= getCardWidth();

  if (scrollAmount < 0) {
    scrollAmount = 0;
  }

  track.style.transform = `translateX(-${scrollAmount}px)`;
});



function closeModal(){
  const modal = document.getElementById("netflixModal");

  modal.classList.remove("show");

  setTimeout(() => {
    modal.style.display = "none";
  }, 300);
}

/* fechar clicando fora */
window.addEventListener("click", (e)=>{
  const modal = document.getElementById("netflixModal");
  if(e.target === modal){
    closeModal();
  }
});
const database = {
  phishing: {
    title: "🎣 Phishing",
    img: "dicacard/netphishing.png",
    text: "Phishing é um golpe em que alguém tenta te enganar para roubar seus dados, fingindo ser uma empresa, banco ou serviço confiável.",
    do: "Quando você identificar um possível phishing, não clique em nenhum link e não baixe anexos. Não forneça dados pessoais, senhas ou códigos de verificação. Se a mensagem parecer ser de uma empresa ou banco, acesse o site ou aplicativo oficial diretamente pelo navegador para confirmar a informação. Também é importante apagar a mensagem e, se possível, denunciar o golpe na própria plataforma ou serviço.",
    signs: "Os sinais de phishing incluem mensagens com urgência ou pressão para você agir rápido, como avisos de bloqueio de conta ou perda de acesso, links estranhos ou diferentes do endereço oficial da empresa, páginas ou mensagens com erros de português e formatação estranha, pedidos inesperados de senhas, códigos de verificação ou dados pessoais, além de remetentes desconhecidos ou que se passam por empresas conhecidas de forma suspeita.",
    tags: ["link","fake","dados"]
  },

  banco: {
    title: "🏦 Golpe Bancário",
    img: "dicacard/pix.png",
    text: "Criminosos fingem ser bancos para roubar dinheiro.",
    do: "Nunca passe códigos ou senhas.",
    signs: "Pedido urgente, ligação estranha, pressão.",
    tags: ["dinheiro","urgente"]
  },

  boleto: {
    title: "📄 Boleto Falso",
    img: "dicacard/link.png",
    text: "Boletos adulterados desviam seu pagamento.",
    do: "Confira o nome do beneficiário.",
    signs: "Valor estranho, código alterado.",
    tags: ["dinheiro","fake"]
  },

  promo: {
    title: "🎁 Promoção Falsa",
    img: "dicacard/wpp2.png",
    text: "Ofertas falsas para roubar dados.",
    do: "Desconfie de promoções irreais.",
    signs: "Muito barato, prazo urgente.",
    tags: ["link","fake"]
  },

  site: {
    title: "🌐 Site Falso",
    img: "dicacard/malwarecard.png",
    text: "Sites clonados roubam informações.",
    do: "Verifique HTTPS e domínio.",
    signs: "URL estranha, layout estranho.",
    tags: ["link","fake"]
  }
};

/* ABRIR MODAL + IA */
function openModal(type){
  const data = database[type];
  const modal = document.getElementById("netflixModal");

  document.getElementById("modalTitle").innerText = data.title;
  document.getElementById("modalText").innerText = data.text;
  document.getElementById("modalDo").innerText = data.do;
  document.getElementById("modalSigns").innerText = data.signs;

  document.getElementById("modalHero").style.backgroundImage = `url('${data.img}')`;

  // IA recomenda
  const recos = getRecommendations(type);
  const container = document.getElementById("recommendations");
  container.innerHTML = "";

  recos.forEach(r => {
    const item = database[r.key];

    container.innerHTML += `
      <div class="reco-card"
        style="background-image:url('${item.img}')"
        onclick="openModal('${r.key}')">
      </div>
    `;
  });

  modal.style.display = "flex";
  setTimeout(()=> modal.classList.add("show"), 10);
}
function getRecommendations(current){
  const currentTags = database[current].tags;

  let scores = [];

  for(let key in database){
    if(key === current) continue;

    let match = database[key].tags.filter(tag =>
      currentTags.includes(tag)
    ).length;

    scores.push({key, score: match});
  }

  return scores
    .sort((a,b) => b.score - a.score)
    .slice(0,3);
}
</script>