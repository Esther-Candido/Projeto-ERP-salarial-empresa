<?php
include '../conexao/conn.php';
include '../validar/func_checar_user.php'; //user


$iban = "";
$tel = "";
$morada = "";
$localidade = "";
$cp = "";
$funcao = "";

$mensagemErro = "";

$nif = $_SESSION['nif'];
$email = $_SESSION['email'];

if (!isset($_SESSION['nif']) || !isset($_SESSION['email'])) {
    // Tratar erro, por exemplo, redirecionar para a página de login
    header('Location: ../login/login.html');
    exit();
}

// Procurar utilizador baseado em nif e email
$sql = "SELECT utilizadores.*, departamento.nome AS departamento_nome 
        FROM utilizadores 
        INNER JOIN departamento ON utilizadores.departamento_id = departamento.id_dep 
        WHERE nif='$nif' AND email='$email'";

$resultado = $conn->query($sql);
$linha = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Método POST: atualizar dados do utilizador

    $iban = $_POST["iban"];
    $tel = $_POST["tel"];
    $morada = $_POST["morada"];
    $localidade = $_POST["localidade"];
    $cp = $_POST["cp"];
    $funcao = $_POST["funcao"];

    do {
        if (empty($iban) || empty($tel) || empty($morada) || empty($localidade) || empty($cp) || empty($funcao)) {
            $mensagemErro = "Todos os campos são obrigatórios";
            break;
        }

        $sql = "UPDATE utilizadores SET 
        iban = '$iban',
        tel = '$tel',
        morada = '$morada',
        localidade = '$localidade',
        cp = '$cp',
        funcao = '$funcao'
        WHERE nif='$nif' AND email='$email'";

        if (mysqli_query($conn, $sql)) {
            $mensagemErro = "Dados atualizados com sucesso!";
        } else {
            $mensagemErro = "Erro ao atualizar dados: " . mysqli_error($conn);
        }

    } while(false);
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEUS DADOS PESSOAIS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>MEUS DADOS PESSOAIS</h2>

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

            <!--CAMPOS PARA VISUALIZAR-->
            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome" value="<?php echo $linha['nome']; ?>" disabled>
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">Data de Nascimento</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="data_nasc" value="<?php echo $linha['data_nasc']; ?>" disabled>
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">NIF</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nif" value="<?php echo $linha['nif']; ?>" disabled>
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $linha['email']; ?>" disabled>
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">Departamento</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="departamento" value="<?php echo $linha['departamento_nome']; ?>" disabled>
                </div>
            </div>



        <!--CAMPOS QUE SERAO POSSIVEL EDITAR-->
        <form method="post">
            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">IBAN</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="iban" value="<?php echo $linha['iban']; ?>">
                </div>
            </div>

            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">TEL</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tel" value="<?php echo $linha['tel']; ?>">
                </div>
            </div>

            <div class="row mb-3"> 
                <label class="col-sm-3 col-form-label">MORADA</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="morada" value="<?php echo $linha['morada']; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">LOCALIDADE</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="localidade" value="<?php echo $linha['localidade']; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">CP</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cp" value="<?php echo $linha['cp']; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <label class="col-sm-3 col-form-label">FUNÇÃO</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="funcao" value="<?php echo $linha['funcao']; ?>">
                </div>
            </div>

            <div class="row mb-3">  
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">ATUALIZAR</button>
                </div>
            </div>
        </form>

    </div>
    
</body>
</html>
