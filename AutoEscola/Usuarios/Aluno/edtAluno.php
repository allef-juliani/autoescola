<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="aluno.css">
    <script src="../../backEnd/script.js"></script>
</head>

<body>
    <h1>Editar meu perfil</h1><br><br>
    <a href="homeAluno.php">Voltar</a><br><br><br>
    <form id="fr" action="../../backEnd/alterarInformacoes.php?editarUsuario" method="POST">
        <input type="text" name="endereco" placeholder="Alterar endereço" required>
        <input type="text" id="telefone" name="telefone" placeholder="Telefone" oninput="maskTelefone(this)" maxlength="14" minlength="14" required>
        <input type="email" name="email" placeholder="Alterar e-mail" required>
        <input type="password" name="senha" placeholder="Alterar senha" required>
        <input type="password" name="confirmSenha" placeholder="Confirme a nova senha" required>
        <input type="password" name="senhaAtual" placeholder="Digite a senha atual" required>
        <input id="btnEdt" type="submit" value="Atualizar dados">
    </form>
    <?php
    if (isset($_GET['senhainvalida'])) {
        echo "<p>";
        echo "<span>Senha atual inválida</span>";
    }
    ?>
</body>

</html>