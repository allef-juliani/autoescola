<?php
include_once "../backEnd/conexao.php";
$db = new Conexao();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../index.css">
    <script src="../backEnd/script.js"></script>
</head>

<body>
    <div id="apresentarLogin">
        <img id="roda" src="../Imagens/icoRoda.png" alt="icone roda">
        <h1>Speed news</h1>
        <h5><img src="../Imagens/icoBandeira.png" alt="icone bandeira"> Auto escola <img src="../Imagens/icoBandeira.png" alt="icone bandeira"></h5>
    </div>
    <div id="login">
        <h2>S N</h2>
        <form action="../backEnd/processLogin.php" method="POST">
            <input type="text" id="cpfLog" name="user" placeholder="CPF" oninput="maskCPF('cpfLog')" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input class="btn" type="submit" value="Login">
            <span onclick="trocar(login,cadastro)">Cadastre-se</span>
            <span>
                <?php
                if (isset($_GET['loginFailed'])) {
                    echo "<p>Cpf ou senha incorretos, tente novamente</p>";
                }
                if (isset($_GET['cadSucess'])) {
                    echo "<p>Cadastro realizado com sucesso</p>";
                }
                ?>
            </span>
        </form>
    </div>
    <div style="display: none;" id="cadastro">
        <h2>S N</h2>
        <form action="../backEnd/processCadastro.php" method="POST" onsubmit="return validateForm()" novalidate>
            <input type="text" id="nome" name="nome" placeholder="Nome">
            <input type="date" id="data" name="dtNascimento" placeholder="Data de nascimento">
            <input type="text" name="endereco" placeholder="Endereço">
            <input type="text" id="cpfCad" name="cpf" placeholder="CPF" oninput="maskCPF('cpfCad')">
            <input type="text" id="telefone" name="telefone" placeholder="Telefone" oninput="maskTelefone(this)" maxlength="14" minlength="14">
            <input type="email" id="email" name="email" placeholder="E-mail">
            <input type="password" id="senha" name="senha" placeholder="Senha">
            <select name="tipo" id="">
                <option value="">Selecione um usuário</option>
                <?php
                $result = $db->executar("SELECT id, tipoNome FROM tipos");
                foreach ($result as $tipos) {
                    $idTipo = $tipos['id'];
                    $nomeTipo = $tipos['tipoNome'];
                    echo "<option value='$idTipo'>$nomeTipo</option>";
                }
                ?>
            </select>
            <input class="btn" type="submit" value="Cadastrar"><br>
            <span onclick="trocar(cadastro,login)">Voltar</span>
        </form>
        <div class="msgN">
            <span id="nomeError">
                <?php if (isset($nomeError)) {
                    echo $nomeError;
                } ?></span>

            <span id="cpfError"><?php if (isset($cpfError)) {
                                    echo $cpfError;
                                } ?></span>

            <span id="dtError"><?php if (isset($dtError)) {
                                    echo $dtError;
                                } ?></span>

            <span id="emailError"><?php if (isset($emailError)) {
                                        echo $emailError;
                                    } ?></span>

            <span id="passwordError"><?php if (isset($passwordError)) {
                                            echo $passwordError;
                                        } ?></span>
        </div>
    </div>
    <script src="../index.js"></script>
</body>

</html>