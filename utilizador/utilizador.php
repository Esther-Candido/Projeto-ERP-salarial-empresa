<?php
include '../validar/func_checar_user.php'; //user
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTILIZADOR</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <style>
        .mylogo {
                    max-width: 80px; 
                    height: auto; 
                }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #1e4308;">
        <div class="container-fluid">
            <form class="d-flex">
            <img  class="mylogo" src="img/logoutilizador.png" alt="Logo do Utilizador">
            </form>
            <div class="navbar">
                <span class="nav-link text-white">Olá, <?php echo $_SESSION["email"]; ?></span>
            </div>
        </div>
    </nav>
    <div class="d-flex">
        <div class="border-end" id="sidebar-wrapper" style="background-color: #1e4308;">
            <div class="list-group list-group-flush">
            <!-- <img  class="mylogo" src="img/logoutilizador.png" style="margin-top: 32px;" alt="Logo do Utilizador">  -->
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #1e4308;" href="dados_pessoais.php" target="content-frame">MEUS DADOS</a>
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #1e4308;" href="processamento.php" target="content-frame">PROCESSADOS</a>
                <a class="list-group-item list-group-item-action text-white p-3" style="background-color: #1e4308;" href="../login/sair.php">SAIR</a>
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
