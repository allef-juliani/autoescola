<?php
include_once "../../backEnd/conexao.php";
session_start();
$db = new Conexao();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
} elseif (!isset($_SESSION['idUser'])) {
    header("Location: ../../Login/pagLogin.php");
    exit();
}
if (isset($_POST['data']) && isset($_POST['veiculo'])) {
    $dataEscolhida = $_POST['data'];
    $veiculoEscolhido = $_POST['veiculo'];
    function isDiaUtil($data)
    {
        // Converte a data para um objeto DateTime
        $dataObj = new DateTime($data);
        // Obtém o número do dia da semana (0 para domingo, 1 para segunda, etc.)
        $diaSemana = $dataObj->format('N');
        // Retorna verdadeiro se for um dia útil (segunda a sexta)
        return ($diaSemana >= 1 && $diaSemana <= 5);
    }
    function obterHorariosDisponiveis($dataEscolhida)
    {
        global $db;
        // Verifica se a data escolhida é um dia útil
        if (isDiaUtil($dataEscolhida)) {
            // Lógica para gerar horários disponíveis nos dias úteis
            $horariosDisponiveis = [];
            $horarioInicio = new DateTime('07:00');
            $horarioFim = new DateTime('22:00');
            while ($horarioInicio <= $horarioFim) {
                $horariosDisponiveis[] = $horarioInicio->format('H:i');
                $horarioInicio->add(new DateInterval('PT1H')); // Adiciona 1 hora
            }
        } else {
            // Se não for um dia útil, retorna um array vazio (fechado)
            $horariosDisponiveis = [];
        }
        // Agora, você pode consultar o banco de dados para obter os horários já agendados para a data escolhida
        $horariosAgendados = obterHorariosAgendados($dataEscolhida);
        // Remove os horários já agendados dos disponíveis
        $horariosAgendados = array_map(function ($hora) {
            return (new DateTime($hora))->format('H:i');
        }, $horariosAgendados);
        $horariosDisponiveis = array_diff($horariosDisponiveis, $horariosAgendados);
        return $horariosDisponiveis;
    }
    // Função para obter os horários já agendados para uma data específica do banco de dados
    function obterHorariosAgendados($dataEscolhida)
    {
        global $db;
        // Aqui você faria uma consulta ao banco de dados para obter os horários agendados na data escolhida.
        // Retorna um array com os horários agendados para essa data.
        // Exemplo fictício
        $result = $db->executar("SELECT horario_aula FROM agendamentos WHERE data_aula = '$dataEscolhida'");
        $horariosAgendados = array();
        foreach ($result as $row) {
            $horariosAgendados[] = $row['horario_aula'];
        }
        return $horariosAgendados;
    }
    // Exemplo de uso:
    $horariosDisponiveis = obterHorariosDisponiveis($dataEscolhida);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="aluno.css">
</head>

<body>
    <div class="topHome">
        <h1>Olá, seja bem vindo</h1>
    </div><br><br>
    <a href="../../backEnd/logout.php">Sair</a>
    <a href="edtAluno.php">Editar perfil</a>
    <div class="cadastrados">
        <p id="titulos">
            <span>Data</span>
            <span>Horário</span>
            <span>Veículo</span>
            <span>Professor</span>
            <span class="excluir"></span>
        </p>
        <?php
        $result = $db->executar("SELECT a.id, DATE_FORMAT(a.data_aula, '%d/%m/%Y') AS data_aula, a.horario_aula, c.modelo, c.placa, u.nome FROM agendamentos AS a JOIN carros AS c ON a.carro_id = c.id JOIN usuarios AS u ON a.Instrutor_id = u.id WHERE a.aluno_id = '$idUser'", true);
        if ($result->rowCount() == 0) {
            echo '
        <p>Não há horários marcados para você </p>';
        } else {
            foreach ($result as $agendamento) {
                $idAgendamento = $agendamento['id'];
                $dataAula = $agendamento['data_aula'];
                $horarioAula = $agendamento['horario_aula'];
                $modeloCarro = $agendamento['modelo'];
                $nomeProfessor = $agendamento['nome'];
                echo '<p>';
                echo "<span>$dataAula</span>";
                echo "<span>$horarioAula</span>";
                echo "<span>$modeloCarro</span>";
                echo "<span>$nomeProfessor</span>";
                //echo "<a href='../backEnd/processRemoverAgendamento.php?idAgendamento=$idAgendamento'><button>X</button></a>";
                echo "<a href='../../backEnd/aluno/removerAgendamento.php?idAgend=$idAgendamento'><button>X</button></a>";
                echo "</p>";
            }
        }
        ?>
    </div>
    <br>
    <h2>Agendar horário</h2>
    <form method="POST">
        <select name="veiculo">
            <option value="">Selecione um veículo</option>
            <?php
            $result = $db->executar("SELECT id, modelo FROM  carros");
            foreach ($result as $carros) {
                $idCarro = $carros['id'];
                $modeloCarro = $carros['modelo'];
                echo "<option value='$idCarro'>$modeloCarro</option>";
            }
            ?>
        </select>
        <input type="date" name="data">
        <input id="btn" type="submit" value="Procurar">
    </form>
    <?php
    if (isset($dataEscolhida)) {
    ?>
        <div id="horarios">
            <?php
            echo "<h2>$dataEscolhida</h2>";
            if (empty($horariosDisponiveis)) {
                echo "<p>Fechado</p>";
            } else {
                foreach ($horariosDisponiveis as $horario) {
                    echo "<i><a href='../../backEnd/aluno/lancarAgendamento.php?horario=$horario&dtEscolhida=$dataEscolhida&veicEscolhido=$veiculoEscolhido'>$horario</a></i>";
                }
            }
            ?>
        </div>
    <?php
    }
    if (isset($_GET['editUserSucess'])) {
        echo "<p>";
        echo "<span>Informações pessoais alteradas com sucesso</span>";
    }
    if (isset($_GET['editUserFailed'])) {
        echo "<p>";
        echo "<span>Não foi possível alterar as informações pessoais</span>";
    }
    ?>
</body>

</html>