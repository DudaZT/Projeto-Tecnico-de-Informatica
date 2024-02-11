<?php
    session_start();

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
        <h5 class= "text-center"> Esportes: </h5>
        <br><br><br><br>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">

                <img src="img_esportes/atletismo.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Atletismo</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=1" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/basquete.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Basquete</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=6" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/futebol.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Futebol de Campo</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=7" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/futsal.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Futsal</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=8" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/handebol.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Handebol</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=9" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/judo.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Judô</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=5" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/natacao.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Natação</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=2" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/tenis de mesa.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Tênis de Mesa</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=4" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/volei.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Vôlei</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=10" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/volei praia.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Vôlei de Praia</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=11" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/xadrez.jpg" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Xadrez</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=3" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>

    </div>
    <br><br><br><br>
    <h5 class= "text-center"> Jogos Eletrônicos: </h5>
    <br><br><br><br>
    <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/league-of-legends.png" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">League of Legends</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=12" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/logo-freefire.png" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Free Fire</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=14" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                <img src="img_esportes/xadrez_arena.PNG" width="315px" height="315px" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center">Xadrez Arena</h5>
                </div>
                <div class="card-footer text-center">
                    <a href = "card.php?esporte=13" class = "btn btn-outline-light FundoRoxo"> Acesse </a>
                </div>
                </div>
            </div>
        </div>

    <br>
    </main>

    <footer class="mt-5 p-4 FundoRoxo text-white text-center">
      <p>&copy; 2023 - Maria Eduarda Zanetti Moro</p>
      <p>IFSP - Câmpus Araraquara</p>
    </footer>

    <script src="js/checkout.js"></script>
</body>
</html>