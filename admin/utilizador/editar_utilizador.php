<?php
include '../../validar/func_checar_admin.php'; //admin
include '../../conexao/conn.php';

$id = "";
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

$mensagemErro = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    //metodo get -> mostra os dados do cliente

    if( !isset($_GET["id"])){
        header("location: admin.php");
        exit;
    }

    $id = $_GET["id"];

    //ler as linha e selecionar o utilizador no banco de dados 
    //adicionar o utilizador a base de dados
    $sql ="SELECT * FROM utilizadores WHERE id=$id";
    $resultado = $conn->query($sql);
    $linha = $resultado->fetch_assoc();

    if(!$linha){
        header("location: admin.php");
        exit;
    }

    //campos para editar
    $nome = $linha["nome"];
    $data_nasc = $linha["data_nasc"];
    $nif = $linha["nif"];
    $iban = $linha["iban"];
    $tel = $linha["tel"];
    $email = $linha["email"];
    $morada = $linha["morada"];
    $localidade = $linha["localidade"];
    $cp = $linha["cp"];
    $departamento_id = $linha["departamento_id"];
    $funcao = $linha["funcao"];

}else{
    //metodo post: atualiza os dados do cliente
    $id = $_POST["id"];
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

    do{
        if (empty($nome) || empty($data_nasc) || empty($email) || empty($departamento_id)) {
            $mensagemErro = "O campo [NOME], [DATA DE NASCIMENTO], [EMAIL], [DEPARTAMENTO] são obrigatorios";
            break;
        }

        mysqli_query($conn,"UPDATE utilizadores SET 
        nome = '$nome',
        data_nasc = '$data_nasc',
        nif = '$nif',
        iban = '$iban',
        tel = '$tel',
        email = '$email',
        morada = '$morada',
        localidade = '$localidade',
        cp = '$cp',
        departamento_id = '$departamento_id',
        funcao = '$funcao'
        WHERE id = $id");

    

        header("location: admin.php");
        exit;

        include '../../conexao/deconn.php';

    }while(false);
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - EDITAR</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>EDITAR UTILIZADOR</h2>

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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
           
            <div class="row mb-3">  <!--"row" é  para criar uma linha horizontal que contém colunas & "mb-3" é usada para adicionar margem inferior (espaçamento) a um elemento. -->
                <label class="col-sm-3 col-form-label">NOME</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>">
                </div>
             </div>

                <div class="row mb-3"> 
                    <label class="col-sm-3 col-form-label">DATA NASC</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="data_nasc" value="<?php echo $data_nasc; ?>">
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