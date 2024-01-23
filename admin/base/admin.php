<?php
include '../../validar/func_checar_admin.php'; //admin
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO - ADMIN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <style>
        .mylogo {
                    max-width: 100px; 
                    height: auto; 
                }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #0c2f52;">
        <div class="container-fluid">
            <form class="d-flex">
            <img  class="mylogo" src="img/logoadmin.png" alt="Logo do ADMIN">


            </form>
            <div class="navbar">
                <span class="nav-link text-white">Olá, <?php echo $_SESSION["email"]; ?></span>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <div class="border-end" id="sidebar-wrapper" style="background-color: #0c2f52;">
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #0c2f52;" href="../utilizador/admin.php" target="content-frame">UTILIZADORES</a>
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #0c2f52;" href="../departamento/departamento.php" target="content-frame">DEPARTAMENTOS</a>
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #0c2f52;" href="../processamento/processar_salario.php" target="content-frame">PROCESSAR</a>
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #0c2f52;" href="../processamento/controle_salario_processado.php" target="content-frame">PROCESSADOS</a>
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #0c2f52;" href="../../login/sair.php">SAIR</a>
            </div>
        </div>
        
        <div class="container-fluid">
            <iframe name="content-frame" style="width: 100%; height: 100vh;" frameborder="0"></iframe>
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'footer.php'; ?>

</body>
</html>
