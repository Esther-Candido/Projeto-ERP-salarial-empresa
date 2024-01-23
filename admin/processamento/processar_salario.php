<?php
include '../../validar/func_checar_admin.php'; //admin

// Incluir arquivo de conexão ao banco de dados
include '../../conexao/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTROLE - SALARIOS A PROCESSAR</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <h2>PROCESSAR SALARIOS DE UTILIZADORES</h2>
    <form method="post">
        <label for="salario_bruto">Salário Bruto:</label>
        <input type="number" step="0.01" name="salario_bruto" required>

        <label for="ano">Ano:</label>
        <input type="number" min="2000" max="2099" step="1" name="ano" required>

        <label for="mes">Mês:</label>
        <select name="mes" required>
            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <option value="3">Março</option>
            <option value="4">Abril</option>
            <option value="5">Maio</option>
            <option value="6">Junho</option>
            <option value="7">Julho</option>
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>

        <!-- Seleção do Utilizador -->
        <label for="utilizador_id">Utilizador:</label>
        <select name="utilizador_id" required>
            <?php
           
            // Consulta para obter os utilizadores e seus departamentos
            $sql = "SELECT u.id, u.nome, d.nome AS departamento FROM utilizadores u 
                    JOIN departamento d ON u.departamento_id = d.id_dep WHERE u.estado = 'ativo'";
            $result = $conn->query($sql);

            // Gerar as opções do select com os utilizadores e seus departamentos
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['nome'] . ' - ' . $row['departamento'] . '</option>';
            }
            ?>
        </select>

        <button type="submit" class='btn btn-success btn-sm' name="calcular">Calcular</button>
    </form>

    <?php


    if (isset($_POST['calcular'])) {
        $salario_bruto = $_POST['salario_bruto'];
        $mes = (int)$_POST['mes'];
        $ano = (int)$_POST['ano'];
        $utilizador_id = (int)$_POST['utilizador_id'];

        // Buscar o departamento_id do utilizador
        $sql = "SELECT departamento_id FROM utilizadores WHERE id = $utilizador_id";
        $result = $conn->query($sql);
        $departamento_id = $result->fetch_assoc()['departamento_id'];

        // Obter o número total de dias no mês selecionado
        $dias_no_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

        // Identificar os dias úteis (excluindo finais de semana)
        $dias_trabalhados = 0;
        for ($dia = 1; $dia <= $dias_no_mes; $dia++) {
            $data = date('Y-m-d', strtotime($ano.'-'.$mes.'-'.$dia));
            $dia_da_semana = date('N', strtotime($data)); // 1 (Segunda) a 7 (Domingo)

            // Se for um dia útil (segunda a sexta), incrementar a contagem de dias trabalhados
            if ($dia_da_semana >= 1 && $dia_da_semana <= 5) {
                $dias_trabalhados++;
            }
        }

        // Cálculos
        $base_ss = $salario_bruto;
        $desconto_seguranca_social = $base_ss * 0.11;

        $base_irs = $salario_bruto; // Alterado para calcular a base do IRS a partir do salário bruto
        $taxa_irs = 0;

        if ($base_irs <= 1000) {
            $taxa_irs = 0.09;
        } elseif ($base_irs > 1000 && $base_irs <= 1750) {
            $taxa_irs = 0.13;
        } elseif ($base_irs > 1750) {
            $taxa_irs = 0.16;
        }

        $desconto_irs = $base_irs * $taxa_irs;
        $alimentacao_por_dia = 5.25;
        $alimentacao = $alimentacao_por_dia * $dias_trabalhados;
        $salario_liquido = $salario_bruto - $desconto_seguranca_social - $desconto_irs + $alimentacao;

        // Armazenar valores em sessão para salvar depois
        $_SESSION['salario_bruto'] = $salario_bruto;
        $_SESSION['mes'] = $mes;
        $_SESSION['ano'] = $ano;
        $_SESSION['salario_liquido'] = $salario_liquido;
        $_SESSION['desconto_seguranca_social'] = $desconto_seguranca_social;
        $_SESSION['desconto_irs'] = $desconto_irs;
        $_SESSION['alimentacao'] = $alimentacao;
        $_SESSION['dias_trabalhados'] = $dias_trabalhados;
        $_SESSION['utilizador_id'] = $utilizador_id;
        $_SESSION['departamento_id'] = $departamento_id;

        // Mostrar os resultados
        echo "Salário Bruto: $salario_bruto <br>";
        echo "Dias Trabalhados: $dias_trabalhados <br>";
        echo "Desconto Segurança Social: $desconto_seguranca_social <br>";
        echo "Desconto IRS: $desconto_irs <br>";
        echo "Alimentação: $alimentacao <br>";
        echo "Salário Líquido: $salario_liquido <br>";

        // Mostrar botão para salvar os resultados
        echo '<form method="post"><button type="submit" name="salvar">Processar</button></form>';
    }

    if (isset($_POST['salvar'])) {
        $salario_bruto = $_SESSION['salario_bruto'];
        $mes = $_SESSION['mes'];
        $ano = $_SESSION['ano'];
        $salario_liquido = $_SESSION['salario_liquido'];
        $desconto_seguranca_social = $_SESSION['desconto_seguranca_social'];
        $desconto_irs = $_SESSION['desconto_irs'];
        $alimentacao = $_SESSION['alimentacao'];
        $dias_trabalhados = $_SESSION['dias_trabalhados'];
        $utilizador_id = $_SESSION['utilizador_id'];
        $departamento_id = $_SESSION['departamento_id'];

         // Verificar se já existe um registro para o mesmo utilizador_id, mes e ano
         $sql = "SELECT * FROM processamento_salarios WHERE utilizador_id = $utilizador_id AND mes = $mes AND ano = $ano";
         $result = $conn->query($sql);
 
         if ($result->num_rows > 0) {
             // Se existe um registro, mostrar uma mensagem de erro
             echo "Utilizador com dados já processado, não é possivel processar novamente";
         } else {
             // Se não existe um registro, inserir o novo registro
             $sql = "INSERT INTO processamento_salarios(salario_bruto, salario_liquido, desconto_seguranca_social, desconto_irs, alimentacao, dias_trabalhados, utilizador_id, departamento_id, mes, ano)
                     VALUES ('$salario_bruto', '$salario_liquido', '$desconto_seguranca_social', '$desconto_irs', '$alimentacao', '$dias_trabalhados', '$utilizador_id', '$departamento_id', '$mes', '$ano')";
 
             if ($conn->query($sql) === TRUE) {
                 echo "Processamento realizado com sucesso.";
             } else {
                 echo "Error: " . $sql . "<br>" . $conn->error;
             }
         }
 
    
     }
     ?>
</body>
</html>
