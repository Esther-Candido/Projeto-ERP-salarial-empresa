<?php
include '../conexao/conn.php';

session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados enviados pelo formulário
    $email = $_POST["email"];
    $nif = $_POST["nif"];

    // Query para buscar o usuário no banco de dados
    $sql = "SELECT * FROM utilizadores WHERE email = '$email' AND nif = '$nif'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Armazena o email, NIF e tipo de usuário na sessão
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["nif"] = $usuario["nif"];
        $_SESSION["tipouser"] = $usuario["tipouser"];

        // Verifica o tipo de usuário e redireciona para a página apropriada
        if ($usuario["tipouser"] === "admin") {
            header("Location: ../admin/base/admin.php");
            exit();
        } elseif ($usuario["tipouser"] === "user") {
            header("Location: ../utilizador/utilizador.php");
            exit();
        } else {
            echo "Tipo de usuário desconhecido.";
        }
    } else {
        echo "Credenciais inválidas.";
    }

    include '../conexao/deconn.php';
}
?>
