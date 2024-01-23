<?php
include '../../validar/func_checar_admin.php'; //admin
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTROLE - SALARIOS PROCESSADOS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container my-5">
        <h2>LISTA DE SALARIOS PROCESSADOS</h2>
        <form method="get" action="">
            Ano: <input type="text" name="ano">
            Mês: <input type="text" name="mes">
            Departamento: 
            <select name="nome_departamento">
                <option value="">Selecione</option>
                <?php
                include '../../conexao/conn.php';
                $sql = "SELECT nome FROM departamento";
                $resultado = $conn->query($sql);
                while ($linha = $resultado->fetch_assoc()) {
                    echo "<option value='{$linha['nome']}'>{$linha['nome']}</option>";
                }
                ?>
            </select>
            Utilizador: 
            <select name="nome_utilizador">
                <option value="">Selecione</option>
                <?php
                $sql = "SELECT nome FROM utilizadores";
                $resultado = $conn->query($sql);
                while ($linha = $resultado->fetch_assoc()) {
                    echo "<option value='{$linha['nome']}'>{$linha['nome']}</option>";
                }
                include '../../conexao/deconn.php';
                ?>
            </select>
            <input  class='btn btn-success btn-sm' type="submit" value="Filtrar">
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
                    <th>Nome Utilizador</th>
                    <th>Nome Departamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../conexao/conn.php';
                $ano = $_GET['ano'] ?? '';
                $mes = $_GET['mes'] ?? '';
                $nome_departamento = $_GET['nome_departamento'] ?? '';
                $nome_utilizador = $_GET['nome_utilizador'] ?? '';
                $filtro = "";
                if ($ano != '') {
                    $filtro .= " AND p.ano=$ano";
                }
                if ($mes != '') {
                    $filtro .= " AND p.mes=$mes";
                }
                if ($nome_departamento != '') {
                    $filtro .= " AND d.nome='$nome_departamento'";
                }
                if ($nome_utilizador != '') {
                    $filtro .= " AND u.nome='$nome_utilizador'";
                }
                $sql = "SELECT p.*, u.nome AS nome_utilizador, d.nome AS nome_departamento
                        FROM processamento_salarios p
                        LEFT JOIN utilizadores u ON p.utilizador_id = u.id
                        LEFT JOIN departamento d ON p.departamento_id = d.id_dep
                        WHERE 1=1 $filtro";
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
                            <td>$linha[nome_utilizador]</td>
                            <td>$linha[nome_departamento]</td>
                            <td>
                                <a class='btn btn-danger btn-sm' href='func_deletar_salario.php?id=$linha[id]'>EXCLUIR</a>
                            </td>
                        </tr>
                    ";
                    $totalBruto += $linha['salario_bruto'];
                    $totalSeguranca += $linha['desconto_seguranca_social'];
                    $totalIrs += $linha['desconto_irs'];
                    $totalAlimentacao += $linha['alimentacao'];
                    $totalLiquido += $linha['salario_liquido'];
                }
                include '../../conexao/deconn.php';
                echo "
                    <tr>
                        <td colspan='10'></td>
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
