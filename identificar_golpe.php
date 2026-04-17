<?php
session_start();
include("testeconexao.php");
include("xp.php");

if (!isset($_SESSION['cenario'])) {
    $_SESSION['cenario'] = 1;
}

$cenario_id = (int) $_SESSION['cenario'];

$sql = "SELECT * FROM cenarios_golpe WHERE id_cenario = $cenario_id";
$res = $conn->query($sql);

if (!$res) {
    die("Erro na query do cenário: " . $conn->error);
}

$cenario = $res->fetch_assoc();

if (!$cenario) {
    echo "<body style='font-family:Arial;background:#0f172a;color:white;text-align:center;margin-top:150px'>";
    echo "<h1>🎉 Parabéns! Você concluiu o jogo.</h1>";
    echo "<br>";
    echo "<a href='index.php'><button>Voltar ao Menu</button></a>";
    echo "</body>";

    exit();
}

$sql2 = "SELECT * FROM erros_cenario WHERE id_erro = $cenario_id";
$erros = $conn->query($sql2);

if (!$erros) {
    die("Erro na query de erros_cenario: " . $conn->error . "<br>SQL: " . $sql2);
}

$lista = [];
while ($e = $erros->fetch_assoc()) {
    $lista[] = $e;
}

$resposta = "";
$explicacao = "";
$acertou = false;

if (isset($_POST['x']) && isset($_POST['y'])) {
    $x = (float) $_POST['x'];
    $y = (float) $_POST['y'];

    foreach ($lista as $erro) {
        if (
            $x >= $erro['x_min'] &&
            $x <= $erro['x_max'] &&
            $y >= $erro['y_min'] &&
            $y <= $erro['y_max']
        ) {
            $resposta = "✔ Você encontrou o golpe! +20 XP";
            $explicacao = $erro['explicacao'];

            if (isset($_SESSION['id_usuario'])) {
                adicionarXP($conn, $_SESSION['id_usuario'], 20);
            }

            $acertou = true;
            break;
        }
    }

    if (!$acertou) {
        $resposta = "❌ Não é esse o problema. Tente novamente.";
    }
}

if (isset($_POST['proximo'])) {
    $_SESSION['cenario']++;
    header("Location: identificar_golpe.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Identificador de Golpes</title>
<style>
body{
    font-family: Arial, sans-serif;
    background: #0f172a;
    color: white;
    text-align: center;
    padding: 20px;
    margin: 0;
}
.container{
    max-width: 900px;
    margin: auto;
}
.info-debug{
    margin: 15px auto 20px auto;
    padding: 14px;
    max-width: 900px;
    background: #111827;
    border: 1px solid #334155;
    border-radius: 10px;
    text-align: left;
    line-height: 1.8;
    font-size: 16px;
}
.info-debug strong{
    color: #93c5fd;
}
.imagem-box{
    position: relative;
    display: inline-block;
    max-width: 100%;
}
.imagem-box img{
    width: 100%;
    max-height: 80vh;
    object-fit: contain;
    cursor: crosshair;
    display: block;
    border-radius: 10px;
}
button{
    padding: 12px 20px;
    margin-top: 20px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    background: #2563eb;
    color: white;
}
button:hover{
    background: #1d4ed8;
}
.debug-box{
    margin: 20px auto;
    max-width: 900px;
    background: #1e293b;
    padding: 15px;
    border-radius: 10px;
    text-align: left;
    white-space: pre-wrap;
}
</style>
</head>
<body>

<h2><?php echo htmlspecialchars($cenario['titulo']); ?></h2>
<p>Clique na parte da imagem que você acredita ser um sinal de golpe.</p>

<!-- <div class="debug-box">
<?php
echo "<strong>DEBUG PHP</strong><br>";
echo "Cenário atual: " . $cenario_id . "<br>";
echo "SQL cenário: " . htmlspecialchars($sql) . "<br>";
echo "SQL erros: " . htmlspecialchars($sql2) . "<br>";
echo "Quantidade de erros encontrados: " . count($lista) . "<br><br>";
echo "<strong>Array \$lista:</strong><br>";
echo "<pre>";
print_r($lista);
echo "</pre>";
?>
</div> -->

<div class="info-debug">
    <div><strong>Mouse:</strong> X = <span id="mx">0</span> | Y = <span id="my">0</span></div>
    <div><strong>Clique:</strong> X = <span id="cx">0</span> | Y = <span id="cy">0</span></div>
    <div><strong>Total de pontos corretos:</strong> <span id="totalErros"></span></div>
</div>

<div class="container">
    <form method="POST" id="form">
        <input type="hidden" name="x" id="x">
        <input type="hidden" name="y" id="y">

        <div class="imagem-box">
            <img
                id="imagemCenario"
                src="imagens/<?php echo htmlspecialchars($cenario['imagem']); ?>"
                alt="Imagem do cenário"
                onclick="clicar(event)"
            >
        </div>
    </form>
</div>

<h3><?php echo htmlspecialchars($resposta); ?></h3>
<p><?php echo htmlspecialchars($explicacao); ?></p>

<?php if ($acertou) { ?>
<form method="POST">
    <button type="submit" name="proximo">Próxima imagem</button>
</form>
<?php } ?>

<script>
const errosCorretos = <?php echo json_encode($lista, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
const img = document.getElementById("imagemCenario");

document.getElementById("totalErros").innerText = errosCorretos.length;

console.log("=== DEBUG JS ===");
console.log("Cenário atual:", <?php echo $cenario_id; ?>);
console.log("SQL erros:", <?php echo json_encode($sql2); ?>);
console.table(errosCorretos);

img.addEventListener("mousemove", function(e){
    const rect = img.getBoundingClientRect();

    const x = (e.clientX - rect.left) - (rect.width / 2);
    const y = (rect.height / 2) - (e.clientY - rect.top);

    document.getElementById("mx").innerText = Math.round(x);
    document.getElementById("my").innerText = Math.round(y);
});

function clicar(e){
    const rect = e.target.getBoundingClientRect();

    const x = (e.clientX - rect.left) - (rect.width / 2);
    const y = (rect.height / 2) - (e.clientY - rect.top);

    document.getElementById("cx").innerText = Math.round(x);
    document.getElementById("cy").innerText = Math.round(y);

    document.getElementById("x").value = x;
    document.getElementById("y").value = y;

    console.log("Clique:", {x: Math.round(x), y: Math.round(y)});
    document.getElementById("form").submit();
}
</script>

</body>
</html>