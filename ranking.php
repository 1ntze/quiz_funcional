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
<title>Ranking</title>

<style>

body{
font-family:Arial;
background:#0f172a;
color:white;
text-align:center;
padding-top:60px;
}

.container{
width:500px;
margin:auto;
}

table{
width:100%;
border-collapse:collapse;
background:white;
color:black;
border-radius:10px;
overflow:hidden;
}

th{
background:#1e3a8a;
color:white;
padding:12px;
font-size:18px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
font-size:16px;
}

tr:hover{
background:#f2f2f2;
}

.posicao{
font-weight:bold;
}

.voltar{
margin-top:25px;
padding:10px 20px;
border:none;
border-radius:6px;
background:#2563eb;
color:white;
cursor:pointer;
font-size:16px;
}

.voltar:hover{
background:#1d4ed8;
}

</style>

</head>

<body>

<div class="container">

<h1>🏆 Ranking de Segurança Digital</h1>

<table>

<tr>
<th>Posição</th>
<th>Nome</th>
<th>XP</th>
</tr>

<?php

$posicao = 1;

while($row = $result->fetch_assoc()){

if($posicao == 1) $medalha = "🥇";
elseif($posicao == 2) $medalha = "🥈";
elseif($posicao == 3) $medalha = "🥉";
else $medalha = $posicao."º";

?>

<tr>

<td class="posicao"><?php echo $medalha; ?></td>

<td><?php echo $row['nome']; ?></td>

<td><?php echo $row['xp_total']; ?></td>

</tr>

<?php
$posicao++;
}
?>

</table>

<a href="index.php">
<button class="voltar">Voltar ao Menu</button>
</a>

</div>

</body>
</html>