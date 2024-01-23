<?php
// sair.php
session_start();

$tipouser = $_SESSION["tipouser"]; // armazena o tipo de usuário antes de limpar a sessão

// Remove todas as variáveis de sessão
session_unset();

// Destroi a sessão
session_destroy();

// Redireciona o usuário para a página apropriada baseado no tipo de usuário
if ($tipouser === "admin") {
    header("Location: ../index.html");
} else {
    header("Location: ../index.html");
}

exit();
?>
