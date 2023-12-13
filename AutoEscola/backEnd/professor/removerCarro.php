<?php
include_once "../conexao.php";
$db = new Conexao;
if (isset($_GET['idCarro'])) {
    $idCarro = $_GET['idCarro'];
    $result = $db->executar("SELECT * FROM agendamentos WHERE carro_id = '$idCarro'", true);
    if ($result->rowCount() > 0) {
        header("location: ../../Usuarios/Professor/homeProfessor.php?removeFailed");
        exit();
    } else {
        $result = $db->executar("SELECT * FROM log_instrutores_carros WHERE carro_id = '$idCarro'", true);
        if ($result->rowCount() > 0) {
            $db->executar("DELETE FROM log_instrutores_carros WHERE carro_id = '$idCarro'");
        }
    }
    $db->executar("DELETE FROM carros WHERE id = $idCarro");
    $result = $db->executar("SELECT * FROM carros WHERE id = '$idCarro'", true);
        if ($result->rowCount() == 0) {
            header("location: ../../Usuarios/Professor/homeProfessor.php?sucess");
            exit();
        }
    
}