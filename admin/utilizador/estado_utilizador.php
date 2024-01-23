<?php

include '../../validar/func_checar_admin.php'; //admin
include '../../conexao/conn.php';

// verificar o id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // verificar o campo estado 
    $sql = "SELECT estado FROM utilizadores WHERE id = $id";
    $resultado = $conn->query($sql);

    // se na consulta o numero de linhas for maior que 0 é pq encontramos nosso utilizador...
    if ($resultado -> num_rows > 0) {    //https://www.php.net/manual/en/mysqli-result.num-rows.php
        $linha = $resultado->fetch_assoc(); //https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
        $estadoAtual = $linha['estado'];

        // se caso for vdd o estado esta "ativo", entao ao ser clicado fica "inativo" e vice versa... é uma verificaçao de true e false..
        $novoEstado = ($estadoAtual == "ativo") ? "inativo" : "ativo";   //condição ? valor_se_verdadeiro : valor_se_falso;

    
        $sql = "UPDATE utilizadores SET estado = '$novoEstado' WHERE id = $id";
        $resultado = $conn->query($sql);

        // verificar se a consulta de atualização foi executada com sucesso
        if ($resultado) {
            echo "Estado atualizado com sucesso.";
        } 
    } 
} 


header("location: admin.php");
exit;

include '../../conexao/deconn.php';
?>
