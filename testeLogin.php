<?php
    session_start();

    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        // Acessa o Sistema
        include_once('config.php');

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM jogadores WHERE Email = '$email' and Senha = '$senha'";
        
        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1)
        {
            //print_r("Não Existe");

            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            unset($_SESSION['idUsuario']);

            header('Location: login.php');
        }
        else
        {
            //print_r("Existe");
            // Se ainda não tem dados dos esportes, responda ao formulário e no final exiba as informações para alterar
            // Se tem os dados dos esportes exiba e altere seus dados e depois pode acessar o "encontre seu time"

            $row = $result->fetch_assoc();
            $idUsuario = $row['ID'];
            $nome = $row['NomeCompleto'];

            $_SESSION['idUsuario'] = $idUsuario;
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['NomeCompleto'] = $nome;

            $sqlVerificaDados = "SELECT * FROM jogadores WHERE Email = '$email' AND (
                Sexo IS NULL OR
                DesejaCompetir IS NULL OR
                DesejaFormarEquipes IS NULL OR
                HorariosDisponiveis IS NULL OR
                Necessidade IS NULL OR
                CondicoesSaude IS NULL
            )";

            $resultVerificaDados = $conexao->query($sqlVerificaDados);
            
            if ($resultVerificaDados === false) {
                die("Erro na verificação dos dados: " . $conexao->error);
            }
            
            if ($resultVerificaDados->num_rows > 0) {
                // Campos restantes estão vazios, redirecionar para a página de dados faltantes
                header('Location: pagina_inicial.php');
                exit;
            } else {
                // Campos restantes estão preenchidos, redirecionar para a página de sucesso
                header('Location: galeria_fotos.php');
                exit;
            }
        }

    }
    else
    {
        header('Location: login.php');
    }


?>