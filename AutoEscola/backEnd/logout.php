<?php
function logout()
{
    // Inicia a sessão, se não estiver iniciada
    session_start();

    // Destroi todas as variáveis de sessão
    $_SESSION = array();

    // Se você deseja destruir completamente a sessão, apague também o cookie de sessão
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Destroi a sessão
    session_destroy();

    // Redireciona para a página de login
    header("Location: ../Login/pagLogin.php");
    exit();
}

logout();