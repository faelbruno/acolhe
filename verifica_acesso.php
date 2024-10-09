<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'Professor') {
    // Se não estiver autenticado ou não for Professor, redireciona
    header("Location: index.php"); // Redireciona para a página inicial
    exit();
}
?>
