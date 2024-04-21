<?php
include "../php/conexao.php";

?>

<?php
session_start();

if ($_SESSION['nivel'] != "adm") {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Novo Estilo</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="shortcut icon" href="../img/logo.png" type="imagem">
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/select.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <section id="header">
        <a href="#"><img src="../img/logo.png" class="logo"></a>

        <div>
        <ul id="navbar">
                    <li><a href="funcionario.php">Home</a></li>
                    <li><a href="../php/select.php">Usuários</a></li>
                    <li><a href="loja.php">Shop</a></li>
                    <li><a href="adicionarproduto.php">Adicionar</a></li>
                    <li><a class="active" href="pedido.php">Pedidos</a></li>
                    <a href="#" id="close"><i class="far fa-times"></i></a>
                    <a href="../php/logout.php" class="sair">Sair</a>
                </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>


    <?php
    include "../php/conexao.php";

    // Inicializa a variável de busca e o tipo de busca
    $busca = '';
    $tipo_busca = '';

    if (isset($_GET['busca'])) {
        $busca = $_GET['busca'];
    }

    if (isset($_GET['tipo_busca'])) {
        $tipo_busca = $_GET['tipo_busca'];
    }

    // Cria a consulta SQL
    if ($busca !== '') {
        if ($tipo_busca === 'Num_Pedido') {
            $result_usuarios = "SELECT p.*, s.Descr_Status 
                                FROM pedidos p 
                                JOIN status s ON p.Cod_Status = s.Cod_Status 
                                WHERE p.Num_Pedido LIKE '%$busca%' AND p.Cod_Status <> 1";
        } elseif ($tipo_busca === 'Data_Pedido') {
            $result_usuarios = "SELECT p.*, s.Descr_Status 
                                FROM pedidos p 
                                JOIN status s ON p.Cod_Status = s.Cod_Status 
                                WHERE p.Data_Pedido LIKE '%$busca%' AND p.Cod_Status <> 1";
        } elseif ($tipo_busca === 'FPgto_Pedido') {
            $result_usuarios = "SELECT p.*, s.Descr_Status 
                                FROM pedidos p 
                                JOIN status s ON p.Cod_Status = s.Cod_Status 
                                WHERE p.FPgto_Pedido LIKE '%$busca%' AND p.Cod_Status <> 1";
        } elseif ($tipo_busca === 'Cod_Status') {
            $result_usuarios = "SELECT p.*, s.Descr_Status 
                                FROM pedidos p 
                                JOIN status s ON p.Cod_Status = s.Cod_Status 
                                WHERE s.Descr_Status LIKE '%$busca%' AND p.Cod_Status <> 1";
        }
    } else {
        $result_usuarios = "SELECT p.*, s.Descr_Status 
                            FROM pedidos p 
                            JOIN status s ON p.Cod_Status = s.Cod_Status 
                            WHERE p.Cod_Status <> 1";
    }

    // Executa a consulta
    $resultado_usuarios = mysqli_query($conn, $result_usuarios);
    ?>

<div class="divtable">
        <div class="container">
            <div class="tbl_container">
                <h2>Tabela de Pedidos</h2>

                <!-- Formulário de pesquisa -->
                <div class="search-form">
                    <a href="pdf.php" style="color: white; text-decoration:none;"><i class="fa fa-print" style="color:blue; font-size:18px; background:white; padding:10px; border-radius:10px;"></i> Imprimir em Pdf</a><br><br>
                    <form action="" method="GET">
                        Filtrar por
                        <select style="font-size:18px; height:30px; border:none; background:transparent; cursor:pointer;" name="tipo_busca">
                            <option value="Num_Pedido">Numero Pedido</option>
                            <option value="Data_Pedido">Data</option>
                            <option value="FPgto_Pedido">Forma de pagamento</option>
                            <option value="Cod_Status">Status</option>
                        </select>
                        <input style="height: 30px; font-size:18px; padding:5px;" type="text" name="busca" placeholder="Pesquisar...">
                        <button style="font-size: 20px; background:transparent; border:none; cursor:pointer;" type="submit"><i class="fas fa-search"></i></button>
                    </form>
        </div><br>

        <table class="tbl">
            <!-- Cabeçalho da tabela -->
            <thead>
                <tr>
                    <th>Numero Pedido:</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Forma de pagamento</th>
                    <th>Status</th>
                    <th colspan="3">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exibe os resultados
                while ($linha = mysqli_fetch_assoc($resultado_usuarios)) {
                    // Processar e exibir os dados
                    ?>
                    <tr>
                        <td data-label="Pedido"><?php echo $linha['Num_Pedido'] ?></td>
                        <td data-label="Data"><?php echo $linha['Data_Pedido'] ?></td>
                        <td data-label="Hora"><?php echo $linha['Hora_Pedido'] ?></td>
                        <td data-label="Forma Pagamento"><?php echo $linha['FPgto_Pedido'] ?></td>
                        <td data-label="Status">
    <?php
    // $linha['Cod_Status'] contém o código de status
    $Cod_Status = $linha['Cod_Status'];
    $query_status = "SELECT Descr_Status FROM status WHERE Cod_Status = $Cod_Status";
    $result_status = mysqli_query($conn, $query_status);
    
    if ($row_status = mysqli_fetch_assoc($result_status)) {
        echo $row_status['Descr_Status'];
    } else {
        echo "Status desconhecido"; // Tratamento para códigos de status não encontrados
    }
    ?>
</td>
                        <td data-label="Editar"><?php echo "<a class='btn btn_edit' href='editarpedido.php?Num_Pedido=" . $linha['Num_Pedido'] . "'><i class='fas fa-edit'></i></a>  " ?></td>
                        <td data-label="Deletar"><?php echo "<a class='btn btn_trash' href='deleta.php?Num_Pedido=" . $linha["Num_Pedido"] . "'><i class='fas fa-trash'></i></a> " ?></td>
                        <td data-label="Imprimir"><?php echo "<a href='pdfpedido.php?Num_Pedido=" . $linha["Num_Pedido"] . "'><i class='fa fa-print' style='color:blue; font-size:18px; background:white; padding:10px; border-radius:10px;''></i></a> " ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- contact-section -->
<section class="contact">
    <div class="contact-info">
        <div class="first-info">
            <img src="../img/logo.png" alt="">
            <p><strong>Endereço: </strong>São Paulo Av.Vautier,248 - Brás</p>
            <p><strong>Telefone: </strong>(21) 99514-4281</p>
        </div>
        <div class="second-info">
        <h4>Links</h4>
        <p><a  href="funcionario.php">Home</a></p>
        <p><a href="../php/select.php">Usuários</a></li></p>
        <p><a class="active" href="loja.php">Shop</a></li></p>
        <p><a href="adicionarproduto.php">Adicionar Produto</a></li></p>
        <p><a href="pedido.php">Pedidos</a></li></p>
        <p><a href="../php/logout.php">Sair</a></p>
    </div>
        <div class="third-info">
            <h4>Sobre</h4>
            <p>Seu guarda-roupa merece o toque de sofisticação que só a Novo Estilo pode oferecer, com bodys que são sinônimo de estilo e atitude.</p>
        </div>
        <div class="four-info">
            <h4>Redes Sociais</h4>
            <div class="social-icon">
                <a target="_blank" href="https://instagram.com/novoestilobras?igshid=MzRlODBiNWFlZA=="><i class="fab fa-instagram"></i>@novoestilobras</a>
            </div>
        </div>
    </div>
</section>
<script src="../js/script.js"></script>
<script src="../js/loja.js"></script>
</body>
</html>