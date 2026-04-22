
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>CyberEdu | Desafio da Memória</title>
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
    
 body:not(.dark-mode) {
    color: #0f172a; /* texto escuro */
    background: rgba(15, 23, 42, 0.05); /* leve fundo pra destacar */
    border-left: 3px solid #3b82f6;
}
    .confete-container{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
    z-index: 10000; /* 🔥 acima do overlay */
}
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


.msg-ok{
    background: rgba(59,130,246,0.1); /* azul leve */
    border: 1px solid rgba(59,130,246,0.4);

    color: #93c5fd;

    box-shadow: 0 0 10px rgba(59,130,246,0.3);
}
.msg-erro{
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.4);

    color: #fca5a5;

    box-shadow: 0 0 10px rgba(239,68,68,0.3);
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

.quiz-container{
    flex:1;
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
margin-top:0px;
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

    background: rgba(0,0,0,0.85);

    display: flex;
    justify-content: center;
    align-items: center;

    z-index: 9999;

    animation: fadeIn 0.3s ease;
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
.quiz-container{
    max-width: 700px;
    margin: 100px auto 40px auto;
     animation: fadeIn 1s ease;
}

.btn-true{
    background: #22c55e;
}

.btn-false{
    background: #ef4444;
}

.btn-next{
    background: #3b82f6;
}

.quiz-container{
    flex:1;
}
/* ========================= */
/* QUIZ VERDADEIRO/FALSO PRO */
/* ========================= */

.quiz-container{
    max-width: 700px;
    margin: 100px auto 40px auto;
    padding: 30px;

    background: rgba(15,23,42,0.75);
    backdrop-filter: blur(12px);

    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.08);

    box-shadow: 
        0 0 30px rgba(59,130,246,0.2),
        inset 0 0 10px rgba(255,255,255,0.05);

    animation: fadeInUp 0.6s ease;
}

/* PERGUNTA */
.pergunta-box{
    padding: 25px;
    border-radius: 16px;

    background: linear-gradient(135deg, rgba(30,58,138,0.4), rgba(59,130,246,0.2));
    border: 1px solid rgba(255,255,255,0.1);

    margin-bottom: 20px;

    box-shadow: 0 0 20px rgba(59,130,246,0.3);
}

.pergunta-box h2{
    font-size: 24px;
    font-weight: 600;
    line-height: 1.4;
}

/* BOTÕES (PADRÃO QUIZ) */
.alt-btn{
    width: 100%;
    padding: 18px;
    margin: 10px 0;

    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.1);

    color: white;
    font-size: 16px;
    font-weight: 500;

    backdrop-filter: blur(10px);
    transition: all 0.25s ease;
    cursor: pointer;
}
.btn-true{
    background: linear-gradient(135deg, #16a34a, #22c55e) !important;
    box-shadow: 0 0 15px rgba(34,197,94,0.6);
}

.btn-false{
    background: linear-gradient(135deg, #dc2626, #ef4444) !important;
    box-shadow: 0 0 15px rgba(239,68,68,0.6);
}
/* HOVER INTELIGENTE */
.alt-btn:hover{
    transform: translateY(-2px) scale(1.02);
    background: rgba(59,130,246,0.35);
    box-shadow: 0 0 20px rgba(59,130,246,0.7);
}

/* CLIQUE */
.alt-btn:active{
    transform: scale(0.97);
}

/* EFEITO DIFERENCIADO */
.alt-btn:first-child:hover{
    box-shadow: 0 0 25px rgba(34,197,94,0.8); /* verde */
}

.alt-btn:last-child:hover{
    box-shadow: 0 0 25px rgba(239,68,68,0.8); /* vermelho */
}

/* COMBO */
.combo{
    margin-bottom: 15px;
    font-weight: 600;
    color: #facc15;
    text-shadow: 0 0 10px #facc15;
}

/* POPUP COMBO */
.combo-popup{
    background: rgba(250,204,21,0.2);
    border: 1px solid #facc15;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 15px;

    animation: fadeInUp 0.4s ease;
}

/* MENSAGEM */
.mensagem{
    margin-top: 15px;
    font-size: 18px;
    font-weight: 600;
}

/* EXPLICAÇÃO */
.explicacao{
    margin-top: 10px;
    opacity: 0.85;
    line-height: 1.5;
}

/* BOTÃO PRÓXIMA */
.btn-next{
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border: none;
    border-radius: 12px;
    padding: 14px 30px;
    margin-top: 15px;

    transition: 0.3s;
    box-shadow: 0 0 15px rgba(59,130,246,0.5);
}

.btn-next:hover{
    transform: scale(1.08);
    box-shadow: 0 0 30px rgba(59,130,246,1);
}



/* animação do combo */
.combo-animar{
    animation: comboPop 0.4s ease;
}

/* efeito de "pulo" */
@keyframes comboPop{
    0%{
        transform: scale(1);
    }
    40%{
        transform: scale(1.4);
    }
    70%{
        transform: scale(0.9);
    }
    100%{
        transform: scale(1);
    }
}

/* animação suave */
@keyframes slideFade{
    from{
        opacity: 0;
        transform: translateY(-5px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}
/* ERRO - combo quebrando */
.combo-break{
    animation: comboBreak 0.5s ease;
    color: #ef4444;
    text-shadow: 0 0 10px #ef4444;
}

/* animação de "quebrar" */
@keyframes comboBreak{
    0%{ transform: translateX(0); }
    20%{ transform: translateX(-8px); }
    40%{ transform: translateX(8px); }
    60%{ transform: translateX(-6px); }
    80%{ transform: translateX(6px); }
    100%{ transform: translateX(0); }
}
    .combo-bar-container{
    margin-bottom: 20px;
    text-align: center;
}

.combo-bar{
    width: 100%;
    height: 12px;
    background: rgba(255,255,255,0.1);
    border-radius: 20px;
    overflow: hidden;
}

.combo-fill{
    height: 100%;
    width: 0%;
    background: linear-gradient(90deg, #facc15, #f59e0b);
    transition: 0.4s;
}

/* SUBINDO */
.combo-up{
    animation: comboUp 0.4s ease;
}

/* QUEBRANDO */
.combo-down{
    background: #ef4444 !important;
    animation: comboBreak 0.4s ease;
}

.combo-label{
    margin-top: 5px;
    font-weight: 600;
    color: #facc15;
}

/* ANIMAÇÕES */
@keyframes comboUp{
    0%{transform: scaleX(0.8);}
    50%{transform: scaleX(1.1);}
    100%{transform: scaleX(1);}
}

@keyframes comboBreak{
    0%{transform: translateX(0);}
    25%{transform: translateX(-5px);}
    50%{transform: translateX(5px);}
    75%{transform: translateX(-3px);}
    100%{transform: translateX(0);}
}

/* BASE */
.fx-btn{
    position: relative;
    overflow: hidden;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* ========================= */
/* BOTÕES V/F (VERSÃO FORÇADA) */
/* ========================= */

.quiz-buttons button{
    width: 100%;
    padding: 18px;
    margin: 10px 0;

    border-radius: 14px;
    border: none;

    font-size: 16px;
    font-weight: 600;
    color: white;

    cursor: pointer;
    position: relative;
    overflow: hidden;

    transition: 0.25s;
}

/* VERDADEIRO */
.quiz-buttons .true{
    background: linear-gradient(135deg, #16a34a, #22c55e) !important;
    box-shadow: 0 0 20px rgba(34,197,94,0.5);
}

/* FALSO */
.quiz-buttons .false{
    background: linear-gradient(135deg, #dc2626, #ef4444) !important;
    box-shadow: 0 0 20px rgba(239,68,68,0.5);
}

/* HOVER */
.quiz-buttons button:hover{
    transform: scale(1.05);
}

/* HOVER VERDE */
.quiz-buttons .true:hover{
    box-shadow: 0 0 35px rgba(34,197,94,1);
}

/* HOVER VERMELHO */
.quiz-buttons .false:hover{
    box-shadow: 0 0 35px rgba(239,68,68,1);
}

/* CLIQUE */
.quiz-buttons button:active{
    transform: scale(0.92);
}

/* BRILHO PASSANDO */
.quiz-buttons button::before{
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;

    background: linear-gradient(
        120deg,
        transparent,
        rgba(255,255,255,0.6),
        transparent
    );

    transition: 0.5s;
}

.quiz-buttons button:hover::before{
    left: 100%;
}
.btn-next{
    color: white !important;
    font-weight: 700;
}
.imagem-box{
    display: flex;
    justify-content: center;
    align-items: center;

    margin: 30px auto;

    width: 100%;
    max-width: 900px;

    padding: 15px;

    background: rgba(15,23,42,0.6);
    border-radius: 15px;

    box-shadow: 0 0 25px rgba(59,130,246,0.3);
}

.imagem-box img{
    width: 100%;
    height: auto;

    max-height: 75vh;

    object-fit: contain;

    border-radius: 12px;

    cursor: crosshair;

    box-shadow: 0 0 20px rgba(0,0,0,0.6);
}

/* IMPORTANTE */
.imagem-box{
    position: relative;
}

.imagem-box{
    position: relative;
}

.imagem-box{
    position: relative !important; /* 🔥 ESSENCIAL */
}

/* ========================= */
/* POPUP */
/* ========================= */
.popup {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.75);

    display: flex;
    align-items: center;
    justify-content: center;

    z-index: 9999;
}

/* ========================= */
/* CAIXA */
/* ========================= */
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

/* ========================= */
/* TITULO */
/* ========================= */
.titulo {
    color: #ffffff;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 22px;
}

/* ========================= */
/* SUBTEXTO */
/* ========================= */
.sub {
    color: #9ca3af;
    margin-bottom: 25px;
    font-size: 14px;
}

/* ========================= */
/* BOTÃO NEON */
/* ========================= */
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
    cursor: pointer;
}

.btn-neon:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 20px rgba(0,255,255,0.9);
}

/* ========================= */
/* BOTÃO FECHAR */
/* ========================= */
.fechar {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 18px;
    cursor: pointer;
    color: #aaa;
    transition: 0.2s;
}

.fechar:hover {
    color: #fff;
}

/* ========================= */
/* ANIMAÇÃO */
/* ========================= */
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
.logo-img{
    width: 110%;
    max-width: 400px;

    display: block;
    margin: -30px auto 10px auto;

    filter: drop-shadow(0 0 25px rgba(0,255,255,1));

    animation: floatRotate 4s ease-in-out infinite;
}

@keyframes floatRotate{
    0%{
        transform: translateY(0px) rotate(0deg);
    }
    50%{
        transform: translateY(-10px) rotate(1deg);
    }
    100%{
        transform: translateY(0px) rotate(0deg);
    }
}
.msg-erro{
    color: #f87171 !important;
    font-size: 15px !important;
    font-weight: 500 !important;

    background: rgba(239,68,68,0.08) !important;
    padding: 6px 10px !important;

    border-left: 3px solid #ef4444 !important;
    border-radius: 6px !important;

    display: inline-block !important;
}

.anim-erro{
    animation: shakeSoft 0.25s ease !important;
}

@keyframes shakeSoft{
    0%{ transform: translateX(0); }
    50%{ transform: translateX(4px); }
    100%{ transform: translateX(0); }
}


.grid {
    display: grid;
    grid-template-columns: repeat(4, 220px);
    gap: 25px;
    justify-content: center;
    margin-top: 50px;
}


.revealed {
    background: #22c55e;
}


/* Tentativas estilizadas */
.tentativas {
    margin-top: 10px;
    font-size: 1.3rem;
    background: rgba(255,255,255,0.05);
    display: inline-block;
    padding: 10px 20px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

.card {
    width: 190px;   /* 🔥 maior */
    height: 270px;  /* 🔥 proporcional */
    perspective: 1000px;
    cursor: pointer;
    position: relative;
     transition: transform 0.3s ease;
}

.inner {
    width: 100%;
    height: 100%;
    transition: transform 0.6s;
    transform-style: preserve-3d;
    position: relative;
}

.card.flip .inner {
    transform: rotateY(180deg);
}

/* FRENTE */
.front, .back {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 12px;
    backface-visibility: hidden;
    overflow: hidden;
}

/* frente (fechada) */
.front {
    background: linear-gradient(135deg, #1e3a8a, #2563eb);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: bold;
    color: white;

    box-shadow:
        0 0 10px #3b82f6,
        0 0 20px #3b82f6;
}

/* verso (imagem) */
.back {
    transform: rotateY(180deg);
    background: #040712;
}

/* IMAGEM */
.back img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    
}

/* 🔥 HOLO EFFECT */
.back::before,
.back::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 12px;
    pointer-events: none;
}

/* brilho colorido */
.back::before {
    background: linear-gradient(
        120deg,
        transparent 20%,
        rgba(0,255,255,0.5),
        rgba(255,0,255,0.5),
        transparent 80%
    );
    mix-blend-mode: color-dodge;
    opacity: 0.6;
}

/* partículas */
.back::after {
    background: url("https://assets.codepen.io/13471/sparkles.gif");
    background-size: cover;
    mix-blend-mode: color-dodge;
    opacity: 0.4;
}

/* HOVER 3D */
.card.flip:hover {
    transform: none !important;
}

/* glow forte */
.card:hover .back::before {
    opacity: 1;
}
.card.zoom {
    transform: scale(1.2);
    z-index: 999;
    transition: transform 0.3s ease;
}
.zoom-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    display: none;

    justify-content: center;
    align-items: center;

    
    background: rgba(10, 20, 40, 0.75);

    backdrop-filter: blur(4px);

    z-index: 9999;
}

/* 🔥 CARTA CENTRAL REAL */
#zoomImg {
    width: 35vw;         
    max-width: 420px;     
    min-width: 260px;    

    height: auto;

    border-radius: 18px;

    box-shadow:
        0 0 30px rgba(0,255,255,0.6),
        0 0 80px rgba(0,255,255,0.3);

    animation: zoomIn 0.25s ease;
}

.zoom-wrap {
    position: relative;
    display: inline-block;
    perspective: 1200px;
}

/* CARTA */
#zoomImg {
    width: 35vw;
    max-width: 420px;
    min-width: 260px;

    border-radius: 18px;

    transform-style: preserve-3d;
    transition: transform 0.15s ease;

    box-shadow:
        0 0 30px rgba(0,255,255,0.6),
        0 0 80px rgba(0,255,255,0.3);

    animation: zoomIn 0.25s ease;
}

/* CAMADA HOLOGRÁFICA */
.holo {
    position: absolute;
    inset: 0;
    border-radius: 18px;
    pointer-events: none;

    background: linear-gradient(
        120deg,
        transparent 20%,
        rgba(0,255,255,0.4),
        rgba(255,0,255,0.4),
        transparent 80%
    );

    mix-blend-mode: color-dodge;
    opacity: 0.6;
}

.holo::after {
    content: "";
    position: absolute;
    inset: 0;

    background: linear-gradient(
        120deg,
        transparent 40%,
        rgba(255,255,255,0.6) 50%,
        transparent 60%
    );
}

/* PARTÍCULAS HOLO */
.holo::before {
    content: "";
    position: absolute;
    inset: 0;

    background: url("https://assets.codepen.io/13471/sparkles.gif");
    background-size: cover;

    mix-blend-mode: color-dodge;
    opacity: 0.4;
}
.titulo-holo-min {
    font-size: 48px;
    font-weight: 800;
    text-align: center;
    letter-spacing: 3px;
    position: relative;

    background: linear-gradient(
        90deg,
        #ff00cc,
        #00ffff,
        #00ffcc,
        #cc00ff,
        #ff00cc
    );
    background-size: 200%;

    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    animation: holoMove 6s linear infinite;

    /* brilho suave */
    text-shadow:
        0 0 6px rgba(255,255,255,0.4),
        0 0 12px rgba(0,255,255,0.3);
}

/* brilho sutil passando */
.titulo-holo-min::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        120deg,
        transparent 40%,
        rgba(255,255,255,0.35),
        transparent 60%
    );
    opacity: 0;
    animation: shineSoft 4s infinite;
}

/* animação gradiente */
@keyframes holoMove {
    0% { background-position: 0% }
    100% { background-position: 200% }
}

/* brilho suave */
@keyframes shineSoft {
    0% { opacity: 0; transform: translateX(-100%); }
    50% { opacity: 1; }
    100% { opacity: 0; transform: translateX(100%); }
}
 .descricao-memoria {
    max-width: 500px;
    margin: auto;
    text-align: center;
    font-size: 1.1rem;
    color: #e0e0e0;
    background: rgba(255,255,255,0.05);
    padding: 15px;
    border-radius: 15px;
    backdrop-filter: blur(8px);
    box-shadow: 0 0 15px rgba(0,255,255,0.2);
    line-height: 1.6;
  }

  .descricao-memoria strong {
    color: #00ffea;
  }

 
  }

  /* ========================= */
/* DESCRIÇÃO MEMÓRIA */
/* ========================= */

.descricao-memoria {
    max-width: 500px;
    margin: 10px auto 30px auto;
    text-align: center;
    font-size: 1.1rem;

    color: #e0e0e0;
    background: rgba(255,255,255,0.05);

    padding: 15px;
    border-radius: 15px;

    backdrop-filter: blur(8px);

    box-shadow: 0 0 15px rgba(0,255,255,0.2);
    line-height: 1.6;
}

.descricao-memoria strong {
    color: #00ffea;
}

/* 🌞 LIGHT MODE */
body:not(.dark-mode) .descricao-memoria {
    color: #0f172a;
    background: rgba(0,0,0,0.05);
    box-shadow: 0 0 15px rgba(0,0,0,0.15);
}

body:not(.dark-mode) .descricao-memoria strong {
    color: #2563eb;
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
    <button class="btn  btn-custom" onclick="window.location.href='logout.php'">
        <b> Sair</b>
    </button>

<?php else: ?>

    <!-- LOGIN -->
    <a href="login.php" class="btn btn-primary">
        Entrar
    </a>

<?php endif; ?>

</nav>
<br><br>
<h1 class="titulo-holo-min"> DESAFIO DA MEMÓRIA</h1>
<h1 class="descricao-memoria"> Prepare-se para o <strong>desafio</strong>! 
Encontre todos os pares escondidos e prove que sua memória é nível <strong>PRO!</strong>

Vire as cartas, memorize cada movimento e use estratégia para vencer! ⚡  

Será que você consegue zerar com a melhor pontuação? 🔥</h1>

<div class="grid" id="game"></div>
<script>
const cards = [
{ img: "memoria/phishing.png", pair: 1, rarity: "comum" },
{ img: "memoria/phishing_desc.png", pair: 1, rarity: "comum" },

{ img: "memoria/2fa.png", pair: 2, rarity: "rara" },
{ img: "memoria/2fa_desc.png", pair: 2, rarity: "rara" },

{ img: "memoria/wb.png", pair: 3, rarity: "epica" },
{ img: "memoria/wb_desc.png", pair: 3, rarity: "epica" },

{ img: "memoria/firewall.png", pair: 4, rarity: "lendaria" },
{ img: "memoria/firewall_desc.png", pair: 4, rarity: "lendaria" },

{ img: "memoria/engenharia.png", pair: 5, rarity: "comum" },
{ img: "memoria/engenharia_desc.png", pair: 5, rarity: "comum" },

{ img: "memoria/ransonware.png", pair: 6, rarity: "rara" },
{ img: "memoria/ransonware_desc.png", pair: 6, rarity: "rara" },

{ img: "memoria/url.png", pair: 7, rarity: "epica" },
{ img: "memoria/url_desc.png", pair: 7, rarity: "epica" },

{ img: "memoria/cavalodetroia.png", pair: 8, rarity: "lendaria" },
{ img: "memoria/cavalodetroia_desc.png", pair: 8, rarity: "lendaria" }
];

// embaralhar
let shuffled = cards.sort(() => 0.5 - Math.random());

let game = document.getElementById("game");

let first = null;
let lock = false;
let matches = 0;
let attempts = 0;


shuffled.forEach(item => {

    let div = document.createElement("div");
    div.classList.add("card");

    div.innerHTML = `
        <div class="inner">
            <div class="front">?</div>
            <div class="back">
                <img src="${item.img}" />
            </div>
        </div>
    `;

    // salvar o PAR, não a imagem
    div.dataset.pair = item.pair;
   div.dataset.rarity = item.rarity;
    div.addEventListener("click", () => {

        if (lock) return;
        if (div.classList.contains("flip")) return;

        div.classList.add("flip");

        if (!first) {
            first = div;
            return;
        }

        lock = true;
        attempts++;

        document.getElementById("tentativas").innerText =
            "Tentativas: " + attempts;

        // 🔥 comparação correta
        if (first.dataset.pair === div.dataset.pair) {

            matches++;

            first = null;
            lock = false;

            if (matches === 8) {

                let xp = 15;

                if (attempts <= 12) xp = 50;
                else if (attempts <= 20) xp = 30;

                setTimeout(() => {
                    alert("🎉 Você completou o jogo em " + attempts + " tentativas! +" + xp + " XP");
                    fetch("memoria_xp.php?xp=" + xp);
                }, 300);
            }

        } else {

            setTimeout(() => {
                div.classList.remove("flip");
                first.classList.remove("flip");

                first = null;
                lock = false;
            }, 800);
        }

    });

    game.appendChild(div);
});

</script>

<br><br>
<p id="tentativas" class="tentativas">Tentativas: 0</p>
<a href="index.php">
<button>⬅ Voltar</button>
</a>
<div id="zoomCard" class="zoom-overlay">
    <div class="zoom-wrap">
        <img id="zoomImg" src="">
        <div class="holo"></div>
    </div>
</div>
</body>
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
  
</div>
</footer>
</html>

<script>
// =======================
// ESPERA CARREGAR TUDO
// =======================
window.addEventListener("load", () => {

    let first = null;
    let lock = false;
    let matches = 0;
    let attempts = 0;

    const zoomCard = document.getElementById("zoomCard");
    const zoomImg = document.getElementById("zoomImg");

    document.querySelectorAll(".card").forEach(card => {

        // 🎮 EFEITO 3D
        card.addEventListener("mousemove", (e) => {

            let rect = card.getBoundingClientRect();
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;

            let centerX = rect.width / 2;
            let centerY = rect.height / 2;

            let rotateX = -(y - centerY) / 8;
            let rotateY = (x - centerX) / 8;

            card.style.transform = `
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
                scale(1.05)
            `;
        });

        card.addEventListener("mouseleave", () => {
            card.style.transform = "rotateX(0) rotateY(0)";
        });

        // =======================
        // CLICK (FLIP + ZOOM)
        // =======================
        card.addEventListener("click", () => {

            if (lock) return;

            // 🔥 SE JÁ ESTIVER VIRADA → ABRE ZOOM
            if (card.classList.contains("flip")) {

                let img = card.querySelector(".back img").src;

                zoomImg.src = img;
                zoomCard.style.display = "flex";

                return;
            }

            // 🔁 FLIP NORMAL
            card.classList.add("flip");

            if (!first) {
                first = card;
                return;
            }

            lock = true;
            attempts++;

            document.getElementById("tentativas").innerText =
                "Tentativas: " + attempts;

            if (first.dataset.pair === card.dataset.pair) {

                matches++;
                first = null;
                lock = false;

                if (matches === 8) {

                    let xp = 15;

                    if (attempts <= 12) xp = 50;
                    else if (attempts <= 20) xp = 30;

                    setTimeout(() => {
                        alert("🎉 Você completou o jogo em " + attempts + " tentativas! +" + xp + " XP");
                        fetch("memoria_xp.php?xp=" + xp);
                    }, 300);
                }

            } else {

                setTimeout(() => {
                    card.classList.remove("flip");
                    first.classList.remove("flip");

                    first = null;
                    lock = false;
                }, 800);
            }

        });

    });

    // =======================
    // FECHAR ZOOM (CLIQUE)
    // =======================
    zoomCard.addEventListener("click", () => {
        zoomCard.style.display = "none";
    });

    // =======================
    // FECHAR ZOOM (ESC)
    // =======================
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            zoomCard.style.display = "none";
        }
    });

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
// NAVBAR SCROLL
window.addEventListener("scroll", function(){
    const navbar = document.querySelector(".navbar");
    if(window.scrollY > 50){
        navbar.classList.add("scrolled");
    }else{
        navbar.classList.remove("scrolled");
    }
});
</script>