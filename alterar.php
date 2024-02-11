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

    // Obtém o ID do jogador a ser alterado
    $jogadorID = $_GET['id'];

    // Recupera os dados do jogador do banco de dados
    $sql = "SELECT * FROM jogadores WHERE ID = '$jogadorID'";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_assoc($result);

    // Verifica se o jogador existe
    if (!$row) {
        echo "Jogador não encontrado.";
        exit;
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtenha os novos dados do formulário
        $novoNome = $_POST['nome'];
        $novoTelefone = $_POST['telefone'];
        $novaIdade = $_POST['idade'];
        $novoEmail = $_POST['email'];
        $novoPais = $_POST['pais'];
        $novoEstado = $_POST['estado'];
        $novaCidade = $_POST['cidade'];
        $novoEndereco = $_POST['endereco'];
        $novoSexo = $_POST['sexo'];
        $novaSenha = $_POST['senha'];
        $novoCompeticao = isset($_POST['competicao']) ? $_POST['competicao'] : null;
        $novoEquipes = isset($_POST['equipes']) ? $_POST['equipes'] : null;
        
        $novaNecessidade = $_POST['necessidade'];
        $novaSaude = $_POST['saude'];

        $disponibilidadeDiasSemana = array();
        $diasSemana = array('Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo');

        foreach ($diasSemana as $dia) {
            if (isset($_POST[$dia]) && is_array($_POST[$dia])) {
                $horarios = implode(", ", $_POST[$dia]);
                $disponibilidadeDiasSemana[$dia] = $horarios;
            }
        }

        $NovohorariosDisponiveis = "";
        
        foreach ($disponibilidadeDiasSemana as $dia => $horario) {
            $NovohorariosDisponiveis .= $dia . ": " . $horario . ", ";
        }

        $NovohorariosDisponiveis = rtrim($NovohorariosDisponiveis, ', ');

        // Atualiza os dados do jogador no banco de dados
        $sql = "UPDATE jogadores SET NomeCompleto = '$novoNome', DataNascimento = '$novaIdade', Telefone = '$novoTelefone', 
        Email = '$novoEmail', Pais = '$novoPais', Estado = '$novoEstado', Cidade = '$novaCidade', 
        Endereco = '$novoEndereco', Senha = '$novaSenha', Sexo = '$novoSexo', DesejaCompetir = '$novoCompeticao', DesejaFormarEquipes = '$novoEquipes',
        HorariosDisponiveis = '$NovohorariosDisponiveis', Necessidade = '$novaNecessidade', CondicoesSaude = '$novaSaude'
        WHERE ID = '$jogadorID'";
        mysqli_query($conexao, $sql);

        // Redireciona de volta para a página de pesquisa após a alteração
        header('Location: dados.php');
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
    <div class = "rounded p-3 Fundo"> 
        <div class="text-center">
        <!-- Galeria -->
        <h2>Alterar Jogador</h2>
        </div>
        <br><br>
        <form method="POST" action="alterar.php?id=<?php echo $jogadorID; ?>">
        <div class="row g-2">
            <div class="col-md">
            <label for="nome">Nome:</label>
            <input type="text" class = "form-control" name="nome" id="nome" value="<?php echo $row['NomeCompleto']; ?>" required>
            </div>
            <br><br>
            <div class="col-md">
            <label for="telefone">Telefone:</label>
            <input type="text" class = "form-control" name="telefone" id="telefone" value="<?php echo $row['Telefone']; ?>" required>
            </div>
            <br><br>
            <div class="col-md">
            <label for="email">Email:</label>
            <input type="email" class = "form-control" name="email" id="email" value="<?php echo $row['Email']; ?>" required>
            </div>
            <br><br>
            <div class="col-md">
            <label for="idade">Idade:</label>
            <input type="date" class = "form-control" name="idade" id="idade" value="<?php echo $row['DataNascimento']; ?>" required>
            </div>
        </div>
            <br><br>
        <div class="row g-2">
            <div class="col-md">
            <label for="pais">País:</label>
            <input type="text" class = "form-control" name="pais" id="pais" value="<?php echo $row['Pais']; ?>" required>
            </div>
            <br><br>
            <div class="col-md">
            <label for="estado">Estado:</label>
            <input type="text" class = "form-control" name="estado" id="estado" value="<?php echo $row['Estado']; ?>" required>
            </div>
            <br><br>
            <div class="col-md">
            <label for="cidade">Cidade:</label>
            <input type="text" class = "form-control" name="cidade" id="cidade" value="<?php echo $row['Cidade']; ?>" required>
            </div>
            <br><br>
            <div class="col-md">
            <label for="endereco">Endereço:</label>
            <input type="text" class = "form-control" name="endereco" id="endereco" value="<?php echo $row['Endereco']; ?>" required>
            </div>
        </div>
            <br><br>
        <div class="row g-2">
            <div class="col-md">
            <label for="sexo">Sexo:</label>
            <input type="text" class = "form-control" name="sexo" id="sexo" value="<?php echo $row['Sexo']; ?>" required>
            </div>
            <div class="col-md">
            <label for="sexo">Senha:</label>
            <input type="password" class = "form-control" name="senha" id="senha" value="<?php echo $row['Senha']; ?>" required>
            </div>
        </div>
        <br><br>
            <label for="competicao">Competição:</label><br>
            <input class="form-check-input" type="radio" name="competicao" value="Sim" required>
                <label class="form-check-label" for="sim">
                    Sim
                </label>
            <input class="form-check-input" type="radio" name="competicao" value="Nao" required>
                <label class="form-check-label" for="nao">
                    Não
                </label>
            
            <br><br>
            
            <label for="equipes">Equipes:</label><br>
            <input class="form-check-input" type="radio" name="equipes" value="Sim" required>
                <label class="form-check-label" for="sim">
                        Sim
                </label>
            <input class="form-check-input" type="radio" name="equipes" value="Nao" required>
                <label class="form-check-label" for="nao">
                    Não
                </label>
            <br><br><br>
        <div class="row g-2">
        <div class="mb-3">
        <table>
                    <tr>
                    <th>Dia da Semana</th>
                    <th>Horários Disponíveis</th>
                    </tr>
                    <tr>
                    <td>Segunda-Feira</td>
                    <td>
                        <input type="checkbox" name="Segunda[]" value="Matutino"> Matutino
                        <input type="checkbox" name="Segunda[]" value="Vespertino"> Vespertino
                        <input type="checkbox" name="Segunda[]" value="Noturno"> Noturno
                    </td>
                    </tr>
                    <tr>
                    <td>Terça-Feira</td>
                    <td>
                        <input type="checkbox" name="Terca[]" value="Matutino"> Matutino
                        <input type="checkbox" name="Terca[]" value="Vespertino"> Vespertino
                        <input type="checkbox" name="Terca[]" value="Noturno"> Noturno
                    </td>
                    </tr>
                    <tr>
                    <td>Quarta-Feira</td>
                    <td>
                        <input type="checkbox" name="Quarta[]" value="Matutino"> Matutino
                        <input type="checkbox" name="Quarta[]" value="Vespertino"> Vespertino
                        <input type="checkbox" name="Quarta[]" value="Noturno"> Noturno
                    </td>
                    </tr>
                    <tr>
                    <td>Quinta-Feira</td>
                    <td>
                        <input type="checkbox" name="Quinta[]" value="Matutino"> Matutino
                        <input type="checkbox" name="Quinta[]" value="Vespertino"> Vespertino
                        <input type="checkbox" name="Quinta[]" value="Noturno"> Noturno
                    </td>
                    </tr>
                    <tr>
                    <td>Sexta-Feira</td>
                    <td>
                        <input type="checkbox" name="Sexta[]" value="Matutino"> Matutino
                        <input type="checkbox" name="Sexta[]" value="Vespertino"> Vespertino
                        <input type="checkbox" name="Sexta[]" value="Noturno"> Noturno
                    </td>
                    </tr>
                    <tr>
                    <td>Sábado</td>
                    <td>
                        <input type="checkbox" name="Sabado[]" value="Matutino"> Matutino
                        <input type="checkbox" name="Sabado[]" value="Vespertino"> Vespertino
                        <input type="checkbox" name="Sabado[]" value="Noturno"> Noturno
                    </td>
                    </tr>
                    <tr>
                    <td>Domingo</td>
                    <td>
                        <input type="checkbox" name="Domingo[]" value="Matutino"> Matutino
                        <input type="checkbox" name="Domingo[]" value="Vespertino"> Vespertino
                        <input type="checkbox" name="Domingo[]" value="Noturno"> Noturno
                    </td>
                    </tr>
                    
                </table>
        </div>
            <br><br>
        </div>
        <br><br>
        <div class="row g-2">
            <div class="col-md">
            <label for="necessidade">Necessidade:</label>
            <input type="text" class = "form-control" name="necessidade" id="necessidade" value="<?php echo $row['Necessidade']; ?>" required>
            </div>
            <div class="col-md">
            <label for="saude">Saúde:</label>
            <input type="text" class = "form-control" name="saude" id="saude" value="<?php echo $row['CondicoesSaude']; ?>" required>
            </div>
        </div>
        <br><br>
            <div class="text-center">
            <button type="submit" class = "btn btn-outline-light FundoRoxo"> Salvar Alterações </button>
            </div>
    
        </form>
      
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