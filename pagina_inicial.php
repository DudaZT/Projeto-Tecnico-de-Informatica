<?php
    session_start();

    include_once('config.php');

    $logado = $_SESSION['email'];
    $nome_logado = $_SESSION['NomeCompleto'];

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
            <br>
            <?php
                echo "<h5> Bem-vindo(a): $nome_logado </h5>";
            ?>
            <br>
            <img class="d-block mx-auto mb-4" src="img/bolinhas.gif" width="80" height="80">
        </div>

        <!-- Pesquisa -->

        
            <div class = "rounded p-3 Fundo">   
                
                <h5 class="text-center"> Instruções: </h5>
                <br>
                <h6 class="text-center">Passarei algumas informações básicas para ajudá-lo a navegar no site da melhor maneira. </h6>
                <br>
                <p>1 - Você poderá se cadastrar no site no botão abaixo, para informar aos administradores dados específicos de cada usuário em relação a Jogos Esportivos ou Elêtronicos.</p>
                <p>2 - Caso não queira se cadastrar, poderá entrar no campo <u>Encontre seu Time</u> na barra de navegação e selecionar o jogo esportivo ou eletrônico que lhe interessa e encontrar usuários que gostariam de formar times, competir ou treinar.</p>
                <p>3 - O usuário já cadastrado pode visualizar seus respectivos dados, alterar ou excluir suas informações no campo <u>Dados</u> na barra de navegação.</p>
                <p>4 - Todas as informações são salvas no banco de dados específico do site.</p>
                <p>5 - Poderá sair da sessão clicando no botão <u>Sair</u> no canto superior direito, na barra de navegação.</p>
                <br>
                <p><strong> Observação: </strong> Caso não queira se cadastrar no formulário, limitará sua experiência, mas não é obrigatório.</p>
                <br>
                <div class = "text-center">
                    <a class="btn btn-outline-light FundoRoxo" href="pesquisa.php">Cadastre-se</a>
                </div>
            </div>

    
    </main>

    <footer class="mt-5 p-4 FundoRoxo text-white text-center">
      <p>&copy; 2023 - Maria Eduarda Zanetti Moro</p>
      <p>IFSP - Câmpus Araraquara</p>
    </footer>

    <script src="js/checkout.js"></script>
</body>
</html>