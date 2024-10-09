<?php
session_start(); // Iniciar a sessão

// Destruir todas as variáveis da sessão
$_SESSION = [];

// Se você deseja destruir a sessão completamente, também deve
// excluir o cookie de sessão.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir a sessão
session_destroy();

// Redirecionar para a página de login ou index
header("Location: index.php");
exit();
?>
