<?php
include("conexao.php");

$sql = "SELECT * FROM perguntas LIMIT 5";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo $row['texto_pergunta'] . "<br>";
}
?>