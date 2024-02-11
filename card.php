<?php
    session_start();

    include_once('config.php');

    $logado = $_SESSION['NomeCompleto'];

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }

?>

<!DOCTYPE html>
<html lang="pt-BR" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>

    <link rel="icon" type="image/png" href="img/dado.png"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .FundoRoxo
        {
            background-color: #6A5ACD;
        }

        .Fundo
        {
            background-color: #E6E6FA;
        }

        .text-purple
        {
            color: #6A5ACD;
        }
    </style>

    <link href="css/checkout.css" rel="stylesheet">

</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg FundoRoxo" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="pagina_inicial.php">Página Inicial</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="dados.php">Dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeria_fotos.php">Encontre seu Time</a>
                    </li>
                </ul>
                </div>
            </div>
            <div class = "d-flex">
                <a href = "sair.php" class = "btn btn-outline-light me-5"> Sair </a> 
            </div>
        </nav>
    </header>

    <main class = "container mt-5">
        
        <div class="py-5 text-center">
            <h2>Jogos e Jogadores</h2>
            <br><?php
                echo "<h5> Bem-vindo(a): $logado </h5>";
            ?><br>
            <img class="d-block mx-auto mb-4" src="img/bolinhas.gif" width="80" height="80">
        </div>

        <!-- Galeria -->
        <?php
            include_once('config.php');

            if (isset($_GET['esporte'])) {
                $esporte = $_GET['esporte'];

                $formarTimes = $_POST['times'] ?? '';

                // Recuperar os usuários interessados no esporte ou jogo eletrônico específico
                $sql = "SELECT u.NomeCompleto, u.Telefone
                FROM jogadores u
                INNER JOIN interesses i ON u.ID = i.JogadorID
                WHERE i.EsporteJogoID = ? AND u.DesejaFormarEquipes = 'sim'";

                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("s", $esporte);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Exibir os resultados
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='text-center'>";
                        echo "<h6>Jogador Interessado:</h6>";
                        echo "Nome: " . $row['NomeCompleto'] . "<br>";
                        echo "Telefone: " . $row['Telefone'] . "<br><br>";
                        echo "</div>";
                    }
                } else {
                    // Nenhum resultado encontrado
                    echo "<br><br><br>";
                    echo "<div class='text-center'>";
                    echo "Ninguém se interessou nessa atividade ainda.";
                    echo "</div>";
                }

            }
        ?>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </main>

    <footer class="mt-5 p-4 FundoRoxo text-white text-center">
      <p>&copy; 2023 - Maria Eduarda Zanetti Moro</p>
      <p>IFSP - Câmpus Araraquara</p>
    </footer>

    <script src="js/checkout.js"></script>
</body>
</html>