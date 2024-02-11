<?php

// Classe abstrata que representa um Jogo/Esporte
abstract class JogoEsporte {
    protected $id;
    protected $nome;
    protected $modalidade;

    public function __construct($id, $nome, $modalidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->modalidade = $modalidade;
    }

    public function getNome() {
        return $this->nome;
    }

    // Métodos abstratos que serão implementados nas classes filhas
    abstract public function detalhes();
    abstract public function tipo();
}

// Classe que representa um jogo online
class JogoOnline extends JogoEsporte {
    protected $eletronico;

    public function __construct($id, $nome, $modalidade, $eletronico) {
        parent::__construct($id, $nome, $modalidade, $eletronico);
        $this->eletronico = $eletronico;
    }

    public function detalhes() {
        return "Jogo Online: " . $this->nome . ", Modalidade: " . $this->modalidade;
    }

    public function tipo() {
        return "Online";
    }
}

// Classe que representa um jogo esportivo
class JogoEsportivo extends JogoEsporte {
    public function __construct($id, $nome, $modalidade) {
        parent::__construct($id, $nome, $modalidade);
    }

    public function detalhes() {
        return "Jogo Esportivo: " . $this->nome . ", Modalidade: " . $this->modalidade;
    }

    public function tipo() {
        return "Esportivo";
    }
}

// Classe que representa um jogador
class Jogador {
    protected $id;
    protected $nomeCompleto;
    protected $interesses;

    public function __construct($id, $nomeCompleto) {
        $this->id = $id;
        $this->nomeCompleto = $nomeCompleto;
        $this->interesses = array();
    }

    public function adicionarInteresse(JogoEsporte $jogo) {
        $this->interesses[] = $jogo;
    }

    function removerInteresse($jogador, $indice) {
        $interesseRemover = $jogador->getInteresses()[$indice];
    
        // Remover interesse do objeto Jogador
        $jogador->removerInteresse($indice);
    
        // Remover interesse do banco de dados
        $idInteresse = $interesseRemover->getId(); // Supondo que exista um método getId() para obter o ID do interesse
    
        include_once('config.php');
        // Adicione a lógica para remover o interesse do banco de dados usando o ID obtido
        $sql = "DELETE FROM interesses WHERE ID = $idInteresse";
        $resultado = $conexao->query($sql);
        
        if (!$resultado) {
            echo "Erro ao remover interesse do banco de dados: " . $conexao->error;
        }
        
    }

    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    public function getInteresses() {
        return $this->interesses;
    }

    public function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function detalhesInteresses() {
        $detalhes = "<div class = 'text-center'><br>" . $this->nomeCompleto . "<br><br>";
        foreach ($this->interesses as $interesse) {
            $detalhes .= $interesse->detalhes() . "<br>";
        }
        return $detalhes;
        echo "</div>";
    }
}

//

include_once('config.php');
//session_start();

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
} else {
    // Se a sessão idUsuario não estiver definida, você pode redirecionar para a página de login
    //header('Location: login.php');
    exit;
}
//echo $idUsuario;

$sql = "SELECT jogadores.ID, jogadores.NomeCompleto, esportesjogoseletronicos.ID, esportesjogoseletronicos.Nome, esportesjogoseletronicos.Modalidade, esportesjogoseletronicos.Eletronico
        FROM jogadores
        JOIN interesses ON interesses.JogadorID = jogadores.ID
        JOIN esportesjogoseletronicos ON esportesjogoseletronicos.ID = interesses.EsporteJogoID
        WHERE jogadores.ID = $idUsuario";

$result = $conexao->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $jogador = new Jogador($idUsuario, "");

        while ($row = $result->fetch_assoc()) {
            $jogadorNome = $row['NomeCompleto'];

            // Define o nome do jogador, se ainda não estiver definido
            if ($jogador->getNomeCompleto() == "") {
                $jogador->setNomeCompleto($jogadorNome);
            }

            $jogoId = $row['ID'];
            $jogoNome = $row['Nome'];
            $jogoModalidade = $row['Modalidade'];
            $jogoEletronico = $row['Eletronico'];

            // Cria o objeto de JogoEsporte correspondente
            if ($jogoEletronico == 'Sim') {
                $jogo = new JogoOnline($jogoId, $jogoNome, $jogoModalidade, $jogoEletronico);
            } else {
                $jogo = new JogoEsportivo($jogoId, $jogoNome, $jogoModalidade, $jogoEletronico);
            }

            // Adiciona o interesse do jogador
            $jogador->adicionarInteresse($jogo);
        }

        // Exibe os detalhes dos interesses do jogador
        echo $jogador->detalhesInteresses();
        echo "<br><br>";
        // Formulário para remoção de interesse
        echo "<form action='remover_interesse.php' method='post'>";
        echo "<input type='hidden' name='idUsuario' value='" . $idUsuario . "'>"; // ID do jogador

        echo "<div class='text-center'><h5>Alterar Interesses: </h5></div>";

        foreach ($jogador->getInteresses() as $indice => $interesse) {
            echo "<div class='interesse text-center'>";
            echo $interesse->detalhes();
            echo " => <button type='submit' name='removerInteresse' class = 'btn btn-outline-light FundoRoxo' value='" . $indice . "'>Remover Interesse</button>";
            echo "</div>";
        }
        echo "<br><br><a href = 'pesquisa.php' class = 'btn btn-outline-light FundoRoxo'> Adicione Interesses </a>";
        echo "</form>";
    } else {
        echo "<br><div class = 'text-center'>Jogador ainda não se interessou em nenhum Esporte ou Jogo";
        echo "<br><br>Caso queira informar seus interesses, selecione no formulário: ";
        echo "<br><br><a href = 'pesquisa.php' class = 'btn btn-outline-light FundoRoxo'> Acesse </a></div>";
    }
} else {
    echo "Erro na consulta: " . $conexao->error;
}

?>