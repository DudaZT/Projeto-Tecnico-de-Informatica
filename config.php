<?php

    $dbHost = '127.0.0.1';
    $dbUsername = 'root';
    $dbPassword = 'root';
    $dbName = 'formulario';
    $dbPorta = 3307;

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $dbPorta);

    /*if($conexao->connect_errno)
    {
        echo "Erro";
    }
    else
    {
        echo "Conexão Efetuada com Sucesso";

    }*/


?>