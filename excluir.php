<?php
    session_start();

    include_once('config.php');

    $logado = $_SESSION['NomeCompleto'];

    if ((!isset($_SESSION['email'])) || (!isset($_SESSION['senha']))) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }

    $email = $_SESSION['email'];

    // Consulta o banco de dados para obter o ID do jogador com base no email
    $sql = "SELECT ID FROM jogadores WHERE Email = '$email'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);

    // Obtém o ID do jogador a ser excluído
    $jogadorID = isset($_GET['id']) ? $_GET['id'] : null;

    if (!$jogadorID) {
        echo "Jogador não encontrado.";
        exit;
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Exclui o jogador do banco de dados
        $sql = "DELETE FROM jogadores WHERE ID = '$jogadorID'";
        mysqli_query($conexao, $sql);

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['NomeCompleto']);
        unset($_SESSION['idUsuario']);

        header('Location: login.php');
    }

    // Recupera os dados do jogador do banco de dados
    $sql = "SELECT * FROM jogadores WHERE ID = '$jogadorID'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);
    
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
        
        <div class="text-center">
            <h2>Excluir Jogador</h2>

            <?php if ($row): ?>
                <p>Você tem certeza que deseja excluir o jogador <?php echo $row['NomeCompleto']; ?>?</p>

                <form method="POST" action="excluir.php?id=<?php echo $jogadorID; ?>">
                    <input type="submit" value="Confirmar Exclusão">
                </form>
            <?php else: ?>
                <p>Jogador não encontrado.</p>
            <?php endif; ?>
        </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </main>

    <footer class="mt-5 p-4 FundoRoxo text-white text-center">
      <p>&copy; 2023 - Maria Eduarda Zanetti Moro</p>
      <p>IFSP - Câmpus Araraquara</p>
    </footer>

    <script src="js/checkout.js"></script>
</body>
</html>

