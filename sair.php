<?php
    session_start();

    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    unset($_SESSION['NomeCompleto']);
    unset($_SESSION['idUsuario']);

    header('Location: login.php');


?>