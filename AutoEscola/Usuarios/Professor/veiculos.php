<?php
include_once "../../backEnd/conexao.php";
$db = new Conexao();
session_start();
$idUser = $_SESSION['idUser'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="Professor.css">
</head>

<body>
    <a href="homeProfessor.php">Voltar</a><br><br><br>
    <form id="cadVei" action="../../backEnd/professor/cadastrarCarros.php" method="POST">
        <input type="text" name="marca" placeholder="Marca" required>
        <input type="text" name="modelo" placeholder="Modelo" required>
        <input type="text" name="ano" placeholder="Ano" required>
        <input type="text" name="placa" placeholder="Placa" required>
        <input type="text" name="capacidade" placeholder="Capacidade de passageiros" required>
        <input id="cada" type="submit" value="Cadastrar">
    </form>
    <div class="cadastrados">
        <p id="titulos">
            <span>Marca</span>
            <span>Modelo</span>
            <span>Ano</span>
            <span>Placa</span>
            <span class="excluir">Editar</span>
            <span class="excluir">Excluir</span>
        </p>
        <?php
        $result = $db->executar("SELECT id, marca, modelo, ano, capacidade_passageiros AS capacidade, placa FROM carros", true);
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll();
            foreach ($result as $i) {
        ?>
                <p>
                    <span><?= $i['marca'] ?></span>
                    <span><?= $i['modelo'] ?></span>
                    <span><?= $i['ano'] ?></span>
                    <span><?= $i['placa'] ?></span>
                    <a href="edtVeiculo.php?idCarro=<?= $i['id']; ?>"><span class="excluir">Editar</span></a>
                    <a href="../../backEnd/professor/removerCarro.php?idCarro=<?= $i['id']; ?>"><span class="excluir">Excluir</span></a>
                </p>
        <?php
            }
        } else {
            echo "<p>Não há veículos cadastrados</p>";
        }
        ?>
    </div><br>
</body>

</html>