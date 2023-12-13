<?php
include_once "../conexao.php";
$db = new Conexao();
if(isset($_GET['editarCarro'])){
    $idCarro = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $capacidade = $_POST['capacidade'];
    $result = $db->executar("UPDATE carros SET marca = '$marca', modelo = '$modelo', ano = '$ano', placa = '$placa', capacidade_passageiros = '$capacidade' WHERE id = '$idCarro'", true);
    if ($result->rowCount() > 0) {
        header("Location: ../../Usuarios/Professor/homeProfessor.php?editCarSucess");
        exit();
    } else {
        header("Location: ../../Usuarios/Professor/homeProfessor.php?editCarFailed");
        exit();
    }
}
?>