<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

    include '../../validar/func_checar_admin.php'; //admin
    include '../../conexao/conn.php';

    // Consulta SQL para deletar o processamento de salario
    $sql ="DELETE FROM processamento_salarios WHERE id=$id";
    $resultado = $conn->query($sql);

 
    header("Location: controle_salario_processado.php");
    exit;
    

    include '../../conexao/deconn.php';
}
?>
