<?php
include_once "../conexao.php";
$db = new Conexao;
if (isset($_GET['idAluno'])) {
    $idAluno = $_GET['idAluno'];
    $result = $db->executar("SELECT * FROM usuarios WHERE id = '$idAluno'", true);
    if ($result->rowCount() > 0) {
        $db->executar("DELETE FROM usuarios WHERE id = '$idAluno'");
        $result = $db->executar("SELECT * FROM usuarios WHERE id = '$idAluno'", true);
        if ($result->rowCount() > 0) {
            header("location: ../../Usuarios/Professor/homeProfessor.php?delAlunoFailed");
        } else {
            header("location: ../../Usuarios/Professor/homeProfessor.php?delAlunoSucess");
        }
    }
}
