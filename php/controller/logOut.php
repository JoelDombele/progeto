<?php
// Inicie ou retome a sessão
session_start();

// Destrua todas as variáveis de sessão
$_SESSION = array();

// Se você está usando cookies de sessão, remova o cookie
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

// Destrua a sessão
session_destroy();

// Redirecione para a página de login ou qualquer outra página após o logout
header("Location: login.php");
exit();
?>
