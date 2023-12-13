<?php
include_once "../../backEnd/conexao.php";
session_start();
$db = new Conexao();
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
}elseif(!isset($_SESSION['idUser'])){
    header("Location: ../../Login/pagLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor</title>
    <link rel="stylesheet" href="../../index.css">
</head>

<body>
    <div class="topHome">
        <h1>Olá, seja bem vindo</h1>
    </div>
    <div class="nav">
        <a href="../../backEnd/logout.php">Sair</a>
        <a href="alunos.php">Alunos</a>
        <a href="veiculos.php">Veículos</a>
    </div>
    <div>
        <h2>Minha agenda</h2>
        <div class="cadastrados">
            <p id="titulos">
                <span>Aluno</span>
                <span>Veículo</span>
                <span>Horário</span>
                <span class="excluir">Desmarcar</span>
            </p>
            <?php
            $result = $db->executar("SELECT a.id as id, DATE_FORMAT(a.data_aula, '%d/%m/%Y') as data_aula, a.horario_aula as horario_aula, c.modelo as modelo, u.nome as nome FROM agendamentos as a JOIN carros as c ON c.id = a.carro_id JOIN usuarios as u ON u.id = a.Instrutor_id WHERE a.Instrutor_id = $idUser", true);
            foreach ($result as $i) {
            ?>
                <p>
                    <span><?= $i['nome'] ?></span>
                    <span><?= $i['modelo'] ?></span>
                    <span><?= $i['data_aula'] . " " . $i['horario_aula'] ?></span>
                    <a href="../../backEnd/professor/removerAgendamento.php?idAgend=<?= $i['id']; ?>"><span style="color:black;text-decoration:underline #ffd000;background-color: #ffd000;padding:10%;border-radius:5px;">Desmarcar</span></a>
                </p>
            <?php
            }
            if(isset($_GET['removeFailed'])){
                echo "<p>";
                echo "<span>Há algum registro de agendamento no veículo selecionado e portanto não é possível remove-lo do sistema</span>";
            }
            if(isset($_GET['cadCarSucess'])){
                echo "<p>";
                echo "<span>Veículo cadastrado com sucesso</span>";
            }
            if(isset($_GET['delAlunoFailed'])){
                echo "<p>";
                echo "<span>Não foi possível excluir o aluno</span>";
            }
            if(isset($_GET['delAlunoSucess'])){
                echo "<p>";
                echo "<span>Aluno excluido com sucesso!</span>";
            }
            if(isset($_GET['editCarSucess'])){
                echo "<p>";
                echo "<span>Informações do veículo alteradas com sucesso!</span>";
            }
            if(isset($_GET['editCarFailed'])){
                echo "<p>";
                echo "<span>Não foi possível alterar as informações do veículo!!</span>";
            }
            ?>
        </div>
    </div>
</body>

</html>