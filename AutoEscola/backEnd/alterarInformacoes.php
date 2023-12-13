<?php
include_once '../BackEnd/conexao.php';
$db = new Conexao();
session_start();
$idUser = $_SESSION['idUser'];
if (isset($_GET['editarUsuario'])) {
    $email = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmSenha = $_POST['confirmSenha'];
    $senhaAtual = $_POST['senhaAtual'];
    if ($senha == $confirmSenha) {
        $result = $db->executar("SELECT * FROM usuarios WHERE senha = '$senhaAtual'", true);
        if ($result->rowCount() > 0) {
            $result = $db->executar("UPDATE usuarios SET telefone = '$telefone', email = '$email', senha = '$senha' WHERE id = '$idUser'", true);
            if ($result->rowCount() > 0) {
                header("Location: ../Usuarios/Aluno/homeAluno.php?editUserSucess");
            }
        } else {
            header("Location: ../Usuarios/Aluno/homeAluno.php?editUserFailed");
        }
    } else {
        header("Location: ../Usuarios/Aluno/edtAluno.php?senhainvalida");
    }
}
