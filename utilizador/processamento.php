<?php
include '../validar/func_checar_user.php'; //user

// Verifica se as informações do usuário estão na sessão
if (isset($_SESSION['nif']) && isset($_SESSION['email'])) {
    $nif = $_SESSION['nif'];
    $email = $_SESSION['email'];
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEUS SALARIOS PROCESSADOS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>MEUS SALARIOS PROCESSADOS</h2>
        <form method="get" action="">
            Ano: <input type="text" name="ano">
            Mês: <input type="text" name="mes">
            <input type="submit" value="Filtrar">
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Salário Bruto</th>
                    <th>Ano</th>
                    <th>Mês</th>
                    <th>Dias Trabalhados</th>
                    <th>Desconto Segurança Social</th>
                    <th>Desconto IRS</th>
                    <th>Alimentação</th>
                    <th>Salário Líquido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../conexao/conn.php';

                // Procurar utilizador baseado em nif e email
                $sql = "SELECT id FROM utilizadores WHERE nif='$nif' AND email='$email'";
                $resultado = $conn->query($sql);
                $linha = $resultado->fetch_assoc();
                $utilizador_id = $linha['id']; // ID do utilizador validado

                // Pegar os valores de ano e mês do formulário
                $ano = $_GET['ano'] ?? '';
                $mes = $_GET['mes'] ?? '';

                // Construir o filtro SQL
                $filtro = '';
                if ($ano != '') {
                    $filtro .= " AND ano=$ano";
                }
                if ($mes != '') {
                    $filtro .= " AND mes=$mes";
                }

                $sql = "SELECT * FROM processamento_salarios WHERE utilizador_id=$utilizador_id$filtro";
                $resultado = $conn->query($sql);
                $totalBruto = $totalSeguranca = $totalIrs = $totalAlimentacao = $totalLiquido = 0;
                while ($linha = $resultado->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>$linha[id]</td>
                            <td>$linha[salario_bruto]</td>
                            <td>$linha[ano]</td>
                            <td>$linha[mes]</td>
                            <td>$linha[dias_trabalhados]</td>
                            <td>$linha[desconto_seguranca_social]</td>
                            <td>$linha[desconto_irs]</td>
                            <td>$linha[alimentacao]</td>
                            <td>$linha[salario_liquido]</td>
                        </tr>
                    ";
                    $totalBruto += $linha['salario_bruto'];
                    $totalSeguranca += $linha['desconto_seguranca_social'];
                    $totalIrs += $linha['desconto_irs'];
                    $totalAlimentacao += $linha['alimentacao'];
                    $totalLiquido += $linha['salario_liquido'];
                }
                include '../conexao/deconn.php';
                echo "
                    <tr>
                        <td colspan='8'></td>
                        <td>Total Bruto: $totalBruto</td>
                        <td>Total Segurança: $totalSeguranca</td>
                        <td>Total IRS: $totalIrs</td>
                        <td>Total Alimentação: $totalAlimentacao</td>
                        <td>Total Líquido: $totalLiquido</td>
                    </tr>
                ";
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
