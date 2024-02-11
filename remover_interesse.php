<?php

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o ID do jogador e o interesse a ser removido foram enviados
    if (isset($_POST['idUsuario']) && isset($_POST['removerInteresse'])) {
        $idUsuario = $_POST['idUsuario'];
        $indiceInteresse = $_POST['removerInteresse'];

        // Consulta o interesse do jogador para obter o ID correspondente
        $sql = "SELECT interesses.EsporteJogoID FROM interesses
                JOIN jogadores ON jogadores.ID = interesses.JogadorID
                WHERE jogadores.ID = $idUsuario LIMIT 1";

        $result = $conexao->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $interesseId = $row['EsporteJogoID'];

            // Remove o interesse do jogador
            $sqlRemover = "DELETE FROM interesses WHERE EsporteJogoID = $interesseId LIMIT 1";
            $resultadoRemover = $conexao->query($sqlRemover);

            if ($resultadoRemover) {
                //echo "Interesse removido com sucesso.";
                header('Location: dados.php');
            } else {
                echo "Erro ao remover o interesse: " . $conexao->error;
            }
        } else {
            echo "Interesse não encontrado.";
        }
    } else {
        echo "Dados inválidos.";
    }
} else {
    echo "Acesso inválido.";
}

?>