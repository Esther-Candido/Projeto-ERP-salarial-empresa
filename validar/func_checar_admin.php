<?php
// Iniciar sessão se ela ainda não foi iniciada
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verifica se a sessão do usuário está ativa e se é um admin
if (!isset($_SESSION['email'], $_SESSION['nif'], $_SESSION['tipouser']) || $_SESSION['tipouser'] !== 'admin') {
    // Se a sessão do usuário não está ativa ou não é um admin, redireciona para a página de login
    header('Location: ../../index.html');
    exit();
}
?>
