<?php
include '../../validar/func_checar_admin.php'; //admin

function criar_departamento($nome){
    include '../../conexao/conn.php';
    
    $nome = mysqli_real_escape_string($conn, $nome);
    
    // Verificar se o nome está vazio
    if(empty($nome)) {
        echo "Nome do departamento não pode ser vazio.";
    }
    // Verificar se já existe um departamento com este nome
    else {
        $result = mysqli_query($conn, "SELECT * FROM departamento WHERE LOWER(nome) = LOWER('$nome')");
        if (mysqli_num_rows($result) > 0) {
            echo "Já existe um departamento com este nome.";
        } else {
            mysqli_query($conn, "INSERT INTO departamento (nome) VALUES ('$nome')");
            echo '<meta http-equiv="refresh" content="0;url=?p=utilizador&opt=admin">';
        }
    }
    
    include '../../conexao/deconn.php';
}
?>
