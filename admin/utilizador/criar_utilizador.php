<?php

include '../../validar/func_checar_admin.php'; //admin


$nome = "";
$data_nasc = "";
$nif = "";
$iban = "";
$tel = "";
$email = "";
$morada = "";
$localidade = "";
$cp = "";
$departamento_id = "";
$funcao = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $data_nasc = $_POST["data_nasc"];
    $nif = $_POST["nif"];
    $iban = $_POST["iban"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $morada = $_POST["morada"];
    $localidade = $_POST["localidade"];
    $cp = $_POST["cp"];
    $departamento_id = $_POST["departamento_id"];
    $funcao = $_POST["funcao"];

    $mensagemErro = "";
    $mensagemSucesso = "";

    do{
        if (empty($nome) || empty($data_nasc) || empty($email) || empty($departamento_id)) {
            $mensagemErro = "O campo [NOME], [DATA DE NASCIMENTO], [EMAIL], [DEPARTAMENTO] são obrigatorios";
            break;
        }

        include '../../conexao/conn.php';
         //adicionar o utilizador a base de dados
         mysqli_query($conn,"INSERT INTO utilizadores (nome, data_nasc, nif, iban, tel, email, morada, localidade, cp, departamento_id, funcao)  
                            VALUES ('$nome', '$data_nasc', '$nif', '$iban', '$tel', '$email', '$morada', '$localidade', '$cp', '$departamento_id', '$funcao')");
        include '../../conexao/deconn.php';

        header("location: admin.php");
        echo '<meta http-equiv="refresh" content="0;url=?p=definicoes&opt=promocoes">';
        exit;

    } while(false);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - CRIAR</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>NOVO UTILIZADOR</h2>

        <?php
            if( !empty($mensagemErro)){
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>'.$mensagemErro.'</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
             ';
        }   
        ?>
 
        <form method="post">
            <div class="row mb-3">  <!--"row" é  para criar uma linha horizontal que contém colunas & "mb-3" é usada para adicionar margem inferior (espaçamento) a um elemento. -->
                <label class="col-sm-3 col-form-label">NOME</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>">
                </div>
            </div>

            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">DATA NASC</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Ex: 2000-06-19" name="data_nasc" value="<?php echo $data_nasc; ?>">
                </div>
            </div>
                

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">NIF</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nif" value="<?php echo $nif; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">IBAN</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="iban" value="<?php echo $iban; ?>">
                </div>
            </div>

            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">TEL</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tel" value="<?php echo $tel; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">EMAIL</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">MORADA</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="morada" value="<?php echo $morada; ?>">
                </div>
            </div>


            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">LOCALIDADE</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="localidade" value="<?php echo $localidade; ?>">
                </div>
            </div>


            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">CP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cp" value="<?php echo $cp; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">DEPARTAMENTO</label>
                    <div class="col-sm-6">
                        <select name="departamento_id" class="form-control">
                            
                            <?php
                            include '../../conexao/conn.php';

                                // aqui busca os dados que existe na base de dados do departamento
                                $sql = $conn->prepare("SELECT `id_dep`, `nome` FROM `departamento`");
                                $sql->execute();
                                $result = $sql->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    $selected = ($row['id_dep'] == $departamento_id) ? 'selected' : '';
                                    echo '<option value="' . $row['id_dep'] . '" ' . $selected . '>' . $row['nome'] . '</option>';
                                }

                                $sql->close();
                                include '../../conexao/deconn.php';
                            ?>

                        </select>
                    </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">FUNÇÃO</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="funcao" value="<?php echo $funcao; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">ADICIONAR</button>
                </div>
          
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="admin.php" role="button">CANCELAR</a>
                </div>
            </div>
        </form>
    
</body>
</html>