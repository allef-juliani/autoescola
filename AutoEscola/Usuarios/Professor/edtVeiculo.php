<?php
include_once "../../backEnd/conexao.php";
$db = new Conexao();
if (isset($_GET['idCarro'])) {
    $idCarro = $_GET['idCarro'];
    $result = $db->executar("SELECT marca, modelo, ano, placa, capacidade_passageiros AS capacidade FROM carros WHERE id = '$idCarro'", true);
    foreach ($result as $c) {
        $marca = $c['marca'];
        $modelo = $c['modelo'];
        $ano = $c['ano'];
        $placa = $c['placa'];
        $capacidade = $c['capacidade'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Veículo</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="../Aluno/aluno.css">
</head>

<body>
    <h1>Editar meu veículo</h1><br><br>
    <a href="homeProfessor.php">Voltar</a><br><br><br>
    <form id="formEdit" action="../../backEnd/professor/editarCarro.php?editarCarro" method="POST">
        <input type="text" name="id" value="<?= $idCarro ?>" readonly>
        <input type="text" name="marca" value="<?= $marca ?>" required>
        <input type="text" name="modelo" value="<?= $modelo ?>" required>
        <input type="text" name="ano" value="<?= $ano ?>" required>
        <input type="text" name="placa" value="<?= $placa ?>" required>
        <input type="text" name="capacidade" value="<?= $capacidade ?>" required>
        <input id="cada" type="submit" onclick="confirmMenssage('Editar dados do veículo?');" value="Alterar">
    </form>
</body>

</html>