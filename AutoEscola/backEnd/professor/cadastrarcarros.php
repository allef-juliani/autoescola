<?php
include_once "../conexao.php";
$db = new Conexao();
session_start();

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$ano = $_POST['ano'];
$placa = $_POST['placa'];
$capacidade = $_POST['capacidade'];
$idInstrutor = $_SESSION['idUser'];
$db->executar("INSERT INTO carros(marca, modelo, ano, placa, capacidade_passageiros) VALUES('$marca', '$modelo', '$ano', '$placa', '$capacidade')");
$result = $db->executar("SELECT id FROM carros WHERE placa = '$placa'");
$idCarro = $result[0][0];
$result = $db->executar("SELECT id FROM carros WHERE placa = '$placa'", true);
if ($result->rowCount() == 0) {
    header("Location: ../../Usuarios/Professor/homeProfessor.php?cadCarFailed");
    exit();
} else {
    $db->executar("INSERT INTO log_instrutores_carros(Instrutor_id, carro_id) VALUES('$idInstrutor', '$idCarro')", true);
    header("Location: ../../Usuarios/Professor/homeProfessor.php?cadCarSucess");
    exit();
}
