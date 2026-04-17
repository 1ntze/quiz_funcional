<?php

include("testeconexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome,email,senha,xp_total)
        VALUES ('$nome','$email','$senha',0)";

if($conn->query($sql)){

    echo "Conta criada com sucesso <br>";
    echo "<a href='login.php'>Fazer login</a>";

}else{

    echo "Erro ao cadastrar";

}

?>