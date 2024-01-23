<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

<?php
include '../../validar/func_checar_admin.php'; //admin
?>

<!-- Criação de novo departamento -->
<div class="container mt-4">
    <h3>CRIAR NOVO DEPARTAMENTO</h3>
    <form method="post">
        <div class="form-group row">
            <div class="col-sm-4">
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary" name="novo_departamento">CRIAR</button>
            </div>
        </div>
    </form>
</div>



<?php 
include 'func_criar_departamento.php';
include 'func_editar_departamento.php';
include 'func_lista_edicao_departamento.php';
include 'func_deletar_departamento.php';

if(isset($_POST['novo_departamento'])){
    criar_departamento($_POST["nome"]);
}
?>
<!-- Fim Criação de novos departamentos -->

<!-- Lista de departamentos existentes -->
<div class="container mt-4">
    <h3>DEPARTAMENTOS EXISTENTES</h3>
    <?php
    lista_edicao_departamento();
    if(isset($_POST["editar_departamento"])){
        editar_departamento($_POST["nome"], $_POST["id_dep"]);
    }
    if(isset($_POST["deletar_departamento"])){
        deletar_departamento($_POST["id_dep"]);
    }
    ?>
</div>
<!-- Fim Lista de departamentos existentes -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
