
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Jogo da Memória</title>

<style>
body {
    font-family: Arial;
    background: #0f172a;
    color: white;
    text-align: center;
}

.grid {
    display: grid;
    grid-template-columns: repeat(4, 100px);
    gap: 10px;
    justify-content: center;
    margin-top: 50px;
}

.card {
    width: 100px;
    height: 100px;
    background: #1e293b;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border-radius: 10px;
    font-size: 20px;
}

.revealed {
    background: #22c55e;
}
</style>
</head>

<body>

<h1>🧠 Jogo da Memória</h1>
<p id="tentativas">Tentativas: 0</p>

<div class="grid" id="game"></div>

<script>

const cards = [
"A","A","B","B","C","C","D","D",
"E","E","F","F","G","G","H","H"
];

let shuffled = cards.sort(() => 0.5 - Math.random());

let game = document.getElementById("game");

let first = null;
let matches = 0;
let attempts = 0;

shuffled.forEach(text => {

    let div = document.createElement("div");
    div.classList.add("card");
    div.innerText = "?";

    div.addEventListener("click", () => {

        if (div.classList.contains("revealed")) return;

        div.innerText = text;
        div.classList.add("revealed");

        if (!first) {

            first = div;

        } else {

            attempts++;
            document.getElementById("tentativas").innerText = "Tentativas: " + attempts;

            if (first.innerText === div.innerText) {

                matches++;

                if(matches === 8){

                    let xp = 15;

                    if(attempts <= 12){
                        xp = 50;
                    } else if(attempts <= 20){
                        xp = 30;
                    }

                    alert("🎉 Você completou o jogo em " + attempts + " tentativas! +" + xp + " XP");

                    fetch("memoria_xp.php?xp=" + xp);

                }

                first = null;

            } else {

                setTimeout(() => {
                    div.innerText = "?";
                    first.innerText = "?";
                    div.classList.remove("revealed");
                    first.classList.remove("revealed");
                    first = null;
                }, 800);

            }
        }

    });

    game.appendChild(div);
});

</script>

<br><br>
<a href="index.php">
<button>⬅ Voltar</button>
</a>

</body>
</html>
