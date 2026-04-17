<?php

include("testeconexao.php");
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);

if($result->num_rows > 0){

    $usuario = $result->fetch_assoc();

    if(password_verify($senha, $usuario['senha'])){

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: index.php");
        exit();

    }else{
        echo "Senha incorreta";
    }

}else{
    echo "Usuário não encontrado";
}

?>