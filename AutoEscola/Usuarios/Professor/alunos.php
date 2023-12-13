<?php
include_once "../../backEnd/conexao.php";
session_start();
$db = new Conexao();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="stylesheet" href="Professor.css">
    <link rel="stylesheet" href="../../index.css">
</head>

<body>
    <a href="homeProfessor.php">Voltar</a>
    <div class="cadastrados">
        <p id="titulos">
            <span>Nome</span>
            <span>Idade</span>
            <span>CPF</span>
            <span class="excluir">Excluir</span>
        </p>
        <?php
        $result = $db->executar("SELECT id, nome, data_nascimento, TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) AS idade, cpf FROM usuarios WHERE tipo = 3");
        foreach ($result as $i) {
        ?>
            <p>
                <span><?= $i['nome']; ?></span>
                <span><?= $i['idade']; ?></span>
                <span><?= $i['cpf']; ?></span>
                <a href="../../backEnd/professor/removerAluno.php?idAluno=<?=$i['id'];?>"><span class="excluir">Excluir</span></a>
            </p>
        <?php
        }
        ?>
    </div><br>
</body>

</html>