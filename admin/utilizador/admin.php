<?php
include '../../validar/func_checar_admin.php'; //admin
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - INICIO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    

    <style>

        body {  
                    zoom: 0.95;
             }

        /* Estilos da tabela e responsividade */
        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }


        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-break: break-word;
            overflow-wrap: break-word;
            line-height: 1.2em;  
            max-height: 2.4em;  
            overflow: hidden;  
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        @media screen and (max-width: 768px) {

            .btao{
                padding-bottom: 40px !important;
            }

            table thead {
                display: none;
            }

            table tr {
                margin-bottom: 10px;
                display: block;
                border-bottom: 2px solid #ddd;
            }

            table td {
                display: block;
                text-align: right;
                font-size: 13px;
                border-bottom: 1px dotted #ccc;
            }

            table td:last-child {
                border-bottom: 0;
            }

            table td:before {
                content: attr(data-label);
                float: left;
                text-transform: uppercase;
                font-weight: bold;
            }

        }

        @media screen and (max-width: 480px) {
            th, td {
                padding: 2px;
                font-size: 10px;
                line-height: 0.8em;  
                max-height: 1.6em; 
            }
        }
    </style>



</head>
<body>

    <div class="container-fluid my-5">
        <h2>LISTA DE UTILIZADORES</h2>
        <a class="btn btn-primary" href="criar_utilizador.php" role="button">ADICIONAR +</a><br>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>NASC.</th>
                    <th>NIF</th>
                    <th>IBAN</th>
                    <th>TEL</th>
                    <th>EMAIL</th>
                    <th>MORADA</th>
                    <th>LOCAL</th>
                    <th>CP</th>
                    <th>DEP.</th>
                    <th>FUNÇÃO</th>
                    <th>ESTADO</th>
                    <th>OPÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                 //solicitar a conexao com base de dados que esta em outro arquivo
                include '../../conexao/conn.php';

                //#################### consulta SQL para selecionar os utilizadores com o nome do departamento####################
                // o SELECT u.* é para selecionar todas as colunas da tabela sem precisar especificar cada uma delas individualmente
                // AS é para mudar o nome para identificar melhor -> um alias 
                //FROM utilizadores u  -> usar um alias U para identificar na consulta
                // LEFT JOIN departamento -> junção com a tabela departamento usando a coluna departamento_id da tabela utilizadores
                $sql = "SELECT u.*, d.nome AS nome_departamento     
                        FROM utilizadores u
                        LEFT JOIN departamento d ON u.departamento_id = d.id_dep";
                $resultado = $conn->query($sql);

                
                //ler as informaçoes de cada linha da tabela
                while ($linha = $resultado->fetch_assoc()) {   //https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
                    echo "
                        <tr>
                            <td>$linha[id]</td>
                            <td>$linha[nome]</td>
                            <td>$linha[data_nasc]</td>
                            <td>$linha[nif]</td>
                            <td>$linha[iban]</td>
                            <td>$linha[tel]</td>
                            <td>$linha[email]</td>
                            <td>$linha[morada]</td>
                            <td>$linha[localidade]</td>
                            <td>$linha[cp]</td>
                            <td>$linha[nome_departamento]</td>
                            <td>$linha[funcao]</td>
                            <td>$linha[estado]</td>
                            <td class='btao'>
                                <a class='btn btn-primary btn-sm ' href='editar_utilizador.php?id=$linha[id]'>EDITAR</a>   <!--https://getbootstrap.com/docs/5.3/examples/buttons/-->
                                <a class='btn btn-danger btn-sm' href='deletar_utilizador.php?id=$linha[id]'>EXCLUIR</a>
                                <a class='btn btn-warning btn-sm' href='estado_utilizador.php?id=$linha[id]'>ESTADO</a>
                            </td>
                        </tr>
                    ";
                }

                 //solicitar a desconexão da base de dados que esta em outro arquivo
                include '../../conexao/deconn.php';
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
