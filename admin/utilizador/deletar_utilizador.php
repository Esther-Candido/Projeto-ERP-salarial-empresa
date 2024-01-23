<?php

include '../../validar/func_checar_admin.php'; //admin

    if(isset($_GET["id"])){
        $id = $_GET["id"];

    include '../../conexao/conn.php';

        $sql ="DELETE FROM utilizadores WHERE id=$id";
        $resultado = $conn->query($sql);
    }

    header("location: admin.php");
    exit;
    
    include '../../conexao/deconn.php';
?>