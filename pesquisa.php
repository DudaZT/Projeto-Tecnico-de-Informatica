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

    $sql = "SELECT ID FROM jogadores WHERE Email = '$logado'";
    $result = $conexao->query($sql);
    $row = $result->fetch_assoc();
    $jogadorID = $row['ID'];

    if(isset($_POST['submitInteresses']))
    {
        if (isset($_POST['esportes'])) 
        {
            $esportesSelecionados = $_POST['esportes'];
        
            foreach ($esportesSelecionados as $esporte) {
                $sql = "INSERT INTO interesses (JogadorID, EsporteJogoID) VALUES ($jogadorID, $esporte)";
                // Executar o código para inserir o registro no banco de dados
                if (mysqli_query($conexao, $sql)) {
                   // echo "Registro inserido com sucesso!<br>";
                }
            }
        } 
        else 
        {
            //echo "Nenhum esporte selecionado!";
        }

        if (isset($_POST['eletronico'])) 
        {
            $jogosSelecionados = $_POST['eletronico'];
        
            foreach ($jogosSelecionados as $jogoID) 
            {
                $sql = "INSERT INTO interesses (JogadorID, EsporteJogoID) VALUES ($jogadorID, '$jogoID')";
                // Executar o código para inserir o registro no banco de dados
                if (mysqli_query($conexao, $sql)) {
                    // echo "Registro inserido com sucesso!<br>";
                }
            }
        } 
        else 
        {
            //echo "Nenhum eletrônico selecionado!";
        }

        header('Location: galeria_fotos.php');
    }

    if(isset($_POST['submit']))
    {

        $competicao = $_POST['competicao'];
        $time = $_POST['times'];

        $necessidade = $_POST['necessidade'];
        $condicoes = isset($_POST['condicoes']) ? implode(", ", $_POST['condicoes']) : "";

        $disponibilidadeDiasSemana = array();
        $diasSemana = array('Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado', 'Domingo');

        foreach ($diasSemana as $dia) {
            if (isset($_POST[$dia]) && is_array($_POST[$dia])) {
                $horarios = implode(", ", $_POST[$dia]);
                $disponibilidadeDiasSemana[$dia] = $horarios;
            }
        }

        $horariosDisponiveis = "";

        foreach ($disponibilidadeDiasSemana as $dia => $horario) {
            $horariosDisponiveis .= $dia . ": " . $horario . ", ";
        }

        $horariosDisponiveis = rtrim($horariosDisponiveis, ', ');
       
        $query = "UPDATE jogadores SET DesejaCompetir = '$competicao', DesejaFormarEquipes = '$time', HorariosDisponiveis = '$horariosDisponiveis', Necessidade = '$necessidade', CondicoesSaude = '$condicoes' WHERE ID = $jogadorID";
        
        if (mysqli_query($conexao, $query)) {
            //echo "Dados inseridos com sucesso!<br>";
            header('Location: galeria_fotos.php');
        } 
        
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

        <form action = "pesquisa.php" method="POST" class="needs-validation" novalidate>
            <div class = "rounded p-3 Fundo">   
                
                <h5 class="text-center"> Escolha: </h5>
                <br>
                <h6 class="text-center"> Esportes - Modalidade Individual </h6><br>
                
                <div class="form-check border rounded p-3 shadow">
                    <div class = "text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="atletismo" name="esportes[]" value="1">
                            <label class="form-check-label" for="atletismo">Atletismo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="natacao" name="esportes[]" value="2">
                            <label class="form-check-label" for="natacao">Natação</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="xadrez" name="esportes[]" value="3">
                            <label class="form-check-label" for="xadrez">Xadrez</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="tenismesa" name="esportes[]" value="4">
                            <label class="form-check-label" for="tenismesa">Tênis de Mesa</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="judo" name="esportes[]" value="5">
                            <label class="form-check-label" for="judo">Judô</label>
                        </div>
                    </div>
                </div>
                <br><br>
                <h6 class="text-center"> Esportes - Modalidade Coletiva </h6><br>
                    <div class="form-check border rounded p-3 shadow text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="basquete" name="esportes[]" value="6">
                            <label class="form-check-label" for="basquete">Basquete</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="futebol" name="esportes[]" value="7">
                            <label class="form-check-label" for="futebol">Futebol</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="futsal" name="esportes[]" value="8">
                            <label class="form-check-label" for="futsal">Futsal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="handebol" name="esportes[]" value="9">
                            <label class="form-check-label" for="handebol">Handebol</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="volei" name="esportes[]" value="10">
                            <label class="form-check-label" for="volei">Vôlei</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="voleipraia" name="esportes[]" value="11">
                            <label class="form-check-label" for="voleipraia">Vôlei de Praia</label>
                        </div>
                    </div>
                <br><br>
                <h6 class="text-center"> Jogos Eletrônicos - Modalidade Coletiva</h6>
                <br>
                <div class="form-check border rounded p-3 shadow">
                    <div class = "text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="lol" name = "eletronico[]" value="12">
                            <label class="form-check-label" for="lol">League of Legends</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="freefire" name = "eletronico[]" value="14">
                            <label class="form-check-label" for="freefire">Free Fire</label>
                        </div>
                    </div>
                </div>
                <br><br>
                <h6 class="text-center"> Jogos Eletrônicos - Modalidade Individual</h6>
                <br>
                <div class="form-check border rounded p-3 shadow">
                    <div class = "text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="xadrez_arena" name = "eletronico[]" value="13">
                            <label class="form-check-label" for="xadrez_arena">Xadrez Arena</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class = "text-center">
                    <button type="submit" name = "submitInteresses" class="btn btn-outline-light FundoRoxo">Envie</button>
                </div>
            </div>
        </form>
            <br><br>
        <form action="pesquisa.php" method="POST" class="needs-validation" novalidate>
            <div class = "rounded p-3 Fundo">   
                <h5 class="text-center"> Formulário: </h5>
                <br>
                <div class="mb-3">
                    <label for="competicao" class="form-label">Jogaria Competitivamente?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="competicao" value="Sim">
                        <label class="form-check-label" for="sim">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="competicao" value="Nao">
                        <label class="form-check-label" for="nao">
                            Não
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Gostaria de formar times e encontrar novos integrantes?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="times" value="Sim">
                        <label class="form-check-label" for="sim">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="times" value="Nao">
                        <label class="form-check-label" for="nao">
                            Não
                        </label>
                    </div>
                    <div class="form-text">Se sim, concorda em disponibilizar seu telefone.</div>
                </div>
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
                <div class="mb-3">
                    <label for="necessidade" class="form-label">Possui alguma necessidade para competir?</label>
                    <input type="text" class="form-control" name="necessidade">
                    <div class="form-text">Informe se precisaria de internet, locomoção, entre outros.</div>
                </div>
                <div class="mb-3">
                    <label for="condicoes" class="form-label">Condições e/ou hábitos relacionados a saúde/prática de atividades físicas:</label>
                    <br>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" name="condicoes[]" value="Fumante">
                        <label class="form-check-label" for="fumante">Fumante</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Alcool" name="condicoes[]">
                        <label class="form-check-label" for="alcool">Faz uso de bebida alcóolica</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Medicacao" name="condicoes[]">
                        <label class="form-check-label" for="medicacao">Faz uso de medicação contínua</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Protese" name="condicoes[]">
                        <label class="form-check-label" for="protese">Faz uso de órtese/prótese</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Oculos" name="condicoes[]">
                        <label class="form-check-label" for="oculos">Usa óculos</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Lentes_de_Contato" name="condicoes[]">
                        <label class="form-check-label" for="lentes_de_contato">Usa lentes de contato</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Abafador_Ruido" name="condicoes[]">
                        <label class="form-check-label" for="abafador_ruido">Faz uso de abafador de ruído</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Lentes_Fotossensiveis" name="condicoes[]">
                        <label class="form-check-label" for="lentes_fotossensiveis">Faz uso de lentes fotossensíveis</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Intolerancia_Restricao_Alimentar" name="condicoes[]">
                        <label class="form-check-label" for="intolerancia_restricao_alimentar">Tem intolerância e/ou restrição alimentar</label>
                    </div>
                    <div class="form-check form-check">
                        <input class="form-check-input" type="checkbox" value="Alergia" name="condicoes[]">
                        <label class="form-check-label" for="alergia">Tem alergias (respiratórias, medicamentos, outras)</label>
                    </div>
                </div>
                <br>
                <div class = "text-center">
                    <button type="submit" name = "submit" class="btn btn-outline-light FundoRoxo">Envie</button>
                </div>
            </div>
                
        </form>

    
    </main>

    <footer class="mt-5 p-4 FundoRoxo text-white text-center">
      <p>&copy; 2023 - Maria Eduarda Zanetti Moro</p>
      <p>IFSP - Câmpus Araraquara</p>
    </footer>

    <script src="js/checkout.js"></script>
</body>
</html>