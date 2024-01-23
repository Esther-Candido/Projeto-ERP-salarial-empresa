<?php 
include '../../validar/func_checar_admin.php'; //admin


function lista_edicao_departamento(){
    include '../../conexao/conn.php';
    $q = mysqli_query($conn,"SELECT * FROM departamento");
    while($a = mysqli_fetch_array($q)){
        echo '
        <div class="container mt-3">
            <form method="post">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">NOME DEPARTAMENTO</span>
                            <input type="text" class="form-control" name="nome" value="'.$a["nome"].'">
                            <input type="hidden" name="id_dep" value="'.$a["id_dep"].'">
                        </div>
                    </div>
                    <div class="col-md-6 d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-info" name="editar_departamento">
                            <i class="fas fa-info"></i> ATUALIZAR</button>
                        <button type="submit" class="btn btn-danger" name="deletar_departamento">
                            <i class="fas fa-trash"></i> APAGAR</button>
                    </div>
                </div>
            </form>
        </div>';
    }
    include '../../conexao/deconn.php';
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
