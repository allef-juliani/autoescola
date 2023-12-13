<?php
include_once "conexao.php";
$db = new Conexao();

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$dtNascimento = $_POST['dtNascimento'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];
$db->executar("INSERT INTO usuarios(nome, cpf, data_nascimento, endereco, telefone, senha, tipo) VALUES('$nome', '$cpf', '$dtNascimento', '$endereco', '$telefone', '$senha', '$tipo')", true);
$result = $db->executar("SELECT * FROM usuarios WHERE cpf = '$cpf'", true);
if ($result->rowCount() > 0) {
    header("Location: ../Login/pagLogin.php?cadSucess");
    exit();
} else {
    header("Location: ../Login/pagLogin.php?cadFailed");
    exit();
}
