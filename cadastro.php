<?php

  if(isset($_POST['submit']))
  {
    include_once('config.php');

    $nome = $_POST['nomeCompleto'];
    $idade = $_POST['idade'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $endereco = $_POST['endereco']; 
    $senha = $_POST['senha'];
    $sexo = $_POST['sexo'];

    

    $result = mysqli_query($conexao, "INSERT INTO jogadores(NomeCompleto, DataNascimento, Telefone, Email, Pais, Estado, Cidade, Endereco, Senha, Sexo) 
    VALUES ('$nome', '$idade', '$telefone','$email', '$pais', '$estado', '$cidade', '$endereco', '$senha', '$sexo')");

    header('Location: login.php');
  }

?>

<!doctype html>
<html lang="pt-BR" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>

    <link rel="icon" type="image/png" href="img/cadastro.png"/>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    

    <style>

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    <link href="css/checkout.css" rel="stylesheet">

  </head>

  <body class="bg-body-tertiary">
    
    <div class="container">
    <main>
        <div class="py-5 text-center">
          <img class="d-block mx-auto mb-4" src="img/bolinhas.gif" width="80" height="80">
          <h2>Cadastre-se</h2>
        </div>

          <form  action = "cadastro.php" method = "POST" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-5">
                  <label for="nomeCompleto" class="form-label">Nome Completo</label>
                  <input type="text" class="form-control" name="nomeCompleto" id="nomeCompleto" placeholder="Nome Completo do Usuário" required>
                    <div class="invalid-feedback">
                        Insira seu Nome Completo.
                    </div>
                </div>

                <div class="col-md-4">
                  <label for="idade" class="form-label">Data de Nascimento</label>
                  <input type="date" class="form-control" name = "idade" id="idade" placeholder="21" required>
                    <div class="invalid-feedback">
                        Insira sua Idade.
                    </div>
                </div>

                <div class="col-md-3">
                  <label for="telefone" class="form-label">Telefone</label>
                  <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="(XX) xxxxx-xxxx" required>
                    <div class="invalid-feedback">
                        Insira seu Telefone.
                    </div>
                </div>

                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="nome@gmail.com" required> 
                    <div class="invalid-feedback">
                        Por favor insira um endereço de e-mail válido.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo:</label>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" value = "Feminino">
                        <label class="form-check-label" for="sexo_feminino">
                            Feminino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" value = "Masculino">
                        <label class="form-check-label" for="sexo_masculino">
                            Masculino
                        </label>
                    </div>
                </div>
                <div class="col-md-5">
                  <label for="pais" class="form-label">País</label>
                  <input type="text" class="form-control" name="pais" id="pais" placeholder="Brasil" required>
                    <div class="invalid-feedback">
                        Insira seu País.
                    </div>
                </div>

                <div class="col-md-4">
                  <label for="estado" class="form-label">Estado</label>
                  <input type="text" class="form-control" name="estado" id="estado" placeholder="São Paulo" required>
                    <div class="invalid-feedback">
                        Insira seu Estado.
                    </div>
                </div>

                <div class="col-md-3">
                  <label for="cidade" class="form-label">Cidade</label>
                  <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Araraquara" required>
                  <div class="invalid-feedback">
                      Insira sua Cidade.
                  </div>
                </div>

                <div class="col-12">
                  <label for="endereco" class="form-label">Endereço</label>
                  <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua Amélia, Bairro Estrela, 364" required>
                    <div class="invalid-feedback">
                        Por favor insira seu endereço.
                    </div>
                </div>

                <div class="col-12">
                  <label for="senha" class="form-label">Senha</label>
                  <input type="password" class="form-control" name="senha" id="senha" required>
                    <div class="invalid-feedback">
                        Por favor insira uma senha.
                    </div>
                </div>

                <button class="w-100 btn btn-lg btn-outline-primary" type="submit" name = "submit" id = "submit">Finalizar Cadastro</button>
                
                <a class="text-center" href="login.php">Voltar</a>

            </div>
            
            </form>
        
    </main>
    </div>

    <footer class="my-5 pt-5 text-body-secondary text-center text-small">
      <p class="mb-1">&copy; 2023 - Maria Eduarda Zanetti Moro</p>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>

    <script src="js/checkout.js"></script>

  </body>
</html>
