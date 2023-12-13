<?php
include_once "../conexao.php";
$db = new Conexao;
if (isset($_GET['idAgend'])) {
    $idAgendamento = $_GET['idAgend'];
    $db->executar("DELETE FROM agendamentos WHERE id = $idAgendamento");
    header("location: ../../Usuarios/Professor/homeProfessor.php?sucess");
}
