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
            <br>
            <?php
                echo "<h5> Bem-vindo(a): $logado </h5>";
            ?>
            <br>
            <img class="d-block mx-auto mb-4" src="img/bolinhas.gif" width="80" height="80">
        </div>

        <!-- Tabela -->
        <div class="d-flex justify-content-center">
            <!--<div class="table-responsive">-->
                <table class="table table-hover FundoRoxo text-center text-white rounded">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Data de Nascimento</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">País</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Cidade</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Competição</th>
                            <th scope="col">Equipes</th>
                            <th scope="col">Horários Disponíveis</th>
                            <th scope="col">Necessidade</th>
                            <th scope="col">Saúde</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Aqui você precisa recuperar os dados do jogador do banco de dados e preencher as linhas da tabela
                    // Exemplo:
                    include_once('config.php');

                    $usuarioID = $_SESSION['email'];
                    $sql = "SELECT ID FROM jogadores WHERE Email = '$usuarioID'";
                    $result = mysqli_query($conexao, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                        $jogadorID = $row['ID'];
                        
                        // Restante do seu código
                        $sql = "SELECT * FROM jogadores WHERE ID = '$jogadorID'";
                        $result = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['NomeCompleto'] . "</td>";
                                echo "<td>" . $row['DataNascimento'] . "</td>";
                                echo "<td>" . $row['Telefone'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>" . $row['Pais'] . "</td>";
                                echo "<td>" . $row['Estado'] . "</td>";
                                echo "<td>" . $row['Cidade'] . "</td>";
                                echo "<td>" . $row['Endereco'] . "</td>";
                                echo "<td>" . $row['Sexo'] . "</td>";
                                echo "<td>" . $row['DesejaCompetir'] . "</td>";
                                echo "<td>" . $row['DesejaFormarEquipes'] . "</td>";
                                echo "<td>" . $row['HorariosDisponiveis'] . "</td>";
                                echo "<td>" . $row['Necessidade'] . "</td>";
                                echo "<td>" . $row['CondicoesSaude'] . "</td>";
                                echo "<td><a class='btn btn-outline-light FundoRoxo' href='alterar.php?id=".$row['ID']."&usuario_id=".$jogadorID."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg></a></td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            <!--</div>-->
            
        </div>
        <br><br>

        <div class="text-center"><h5> Interesses: </h5></div>

        <?php
            include("objetos.php");
            echo "<div class='text-center'>";
            echo "<br><br>";
            echo "<h5> Excluir Conta: </h5>";
            $usuarioID = $_SESSION['email'];
            $sql = "SELECT ID FROM jogadores WHERE Email = '$usuarioID'";
            $result = mysqli_query($conexao, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $jogadorID = $row['ID'];
                        
                // Restante do seu código
                $sql = "SELECT * FROM jogadores WHERE ID = '$jogadorID'";
                $result = mysqli_query($conexao, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<a class='btn btn-outline-light FundoRoxo' href='excluir.php?id=".$row['ID']."&usuario_id=".$jogadorID."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'><path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z'/></svg></a>";
                    }
                }
            }
            echo "</div>";

        ?>

        
    </main>
    <br><br><br><br><br><br><br><br><br><br><br>
    <footer class="mt-5 p-4 FundoRoxo text-white text-center">
      <p>&copy; 2023 - Maria Eduarda Zanetti Moro</p>
      <p>IFSP - Câmpus Araraquara</p>
    </footer>

    <script src="js/checkout.js"></script>
</body>
</html>