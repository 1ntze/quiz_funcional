<?php

function adicionarXP($conn, $id_usuario, $xp){

    if(!$id_usuario){
        return;
    }

    $sql = "UPDATE usuarios 
            SET xp_total = xp_total + $xp
            WHERE id_usuario = $id_usuario";

    $conn->query($sql);
}

?>