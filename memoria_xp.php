
<?php
session_start();
include("testeconexao.php");
include("xp.php");

if(isset($_SESSION['id_usuario']) && isset($_GET['xp'])){

    $xp = intval($_GET['xp']);

    adicionarXP($conn, $_SESSION['id_usuario'], $xp);

    echo "XP adicionado";

}
?>
