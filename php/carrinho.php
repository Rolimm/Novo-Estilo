<?php
session_start();

// Verifique se o usuário está logado como cliente
if ($_SESSION['nivel'] != "cliente") {
    header("Location: ../index.php");
    exit;
}

// Conecte-se ao banco de dados (coloque suas informações de conexão aqui)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "novoestilo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão com o banco de dados
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Novo Estilo</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="shortcut icon" href="../img/logo.png" type="imagem">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="../css/select.css">
</head>
<body>

<?php

// Recupere o ID do cliente logado
$codCliente = $_SESSION['Cod_Cliente'];

// Verifique se existe um pedido em andamento para o cliente
$sqlPedidoExistente = "SELECT Num_Pedido FROM pedidos WHERE Cod_Cliente = $codCliente AND Cod_Status = 1";
$resultPedidoExistente = $conn->query($sqlPedidoExistente);

if ($resultPedidoExistente->num_rows > 0) {
    // Um pedido em andamento já existe, obtenha o Num_Pedido desse pedido
    $rowPedidoExistente = $resultPedidoExistente->fetch_assoc();
    $numPedido = $rowPedidoExistente['Num_Pedido'];

    // Armazene o número do pedido em uma variável de sessão
    $_SESSION['Num_Pedido'] = $numPedido;

    // Recupere os itens do carrinho para o pedido em andamento
    $sqlItensCarrinho = "SELECT produto.Foto_Produto, produto.Nome_Produto, itenspedido.id_itenspedido, itenspedido.Qtd_Produto, itenspedido.Valor_Item, itenspedido.tamanho
                     
                     FROM itenspedido
                     INNER JOIN produto ON itenspedido.Cod_Produto = produto.Cod_Produto
                     WHERE itenspedido.Num_Pedido = $numPedido";

    $resultItensCarrinho = $conn->query($sqlItensCarrinho);
    echo "<h1>Seu Carrinho de Compras</h1>";
} else {
    // Se não houver pedido em andamento, exiba uma mensagem indicando que o carrinho está vazio.
    echo "<h1>Seu carrinho está vazio.</h1>";
}

// Consulta para obter os pedidos com Cod_Status igual a 2 para o cliente atual
$sqlPedidos = "SELECT * FROM pedidos WHERE Cod_Cliente = $codCliente AND Cod_Status != 1";
$resultPedidos = $conn->query($sqlPedidos);

if (isset($resultItensCarrinho) && $resultItensCarrinho->num_rows > 0) {
    // Inicialize o total da compra
    $totalCompra = 0;

    // Comece a lista
    echo "<div class='carrinho'>";

    while ($rowItem = $resultItensCarrinho->fetch_assoc()) {
        $precoUnitario = $rowItem["Valor_Item"];
        $quantidade = $rowItem["Qtd_Produto"];
        $tamanho = $rowItem["tamanho"];
        $precoTotal = $precoUnitario * $quantidade;
        $totalCompra += $precoTotal;

        // Exiba a imagem e outras informações do produto
        echo "<div class='produtoscarrinho'>"; // Adicione o estilo aqui
        echo "<img src='" . $rowItem["Foto_Produto"] . "' alt='Imagem do Produto'>";
        echo"<p class='title'>Nome: ";
        echo $rowItem["Nome_Produto"] . "</p><br>Tamanho: " . $tamanho . " <br> Quantidade: " . $quantidade;
        echo "<br>Preço Unitário: R$ " . number_format($precoUnitario, 2);
        echo "<br>Preço Total: R$" . number_format($precoTotal, 2);
        echo "<br><a href='excluir_item.php?id_itenspedido=" . $rowItem["id_itenspedido"] . "'>Excluir</a><br>";
        echo "</div>";
    }

    // Encerre a lista
    echo "</div>";

    // Exiba o valor total da compra
    echo "<p><strong>Total: R$" . number_format($totalCompra, 2) . "</strong></p>";

    // Adicione um formulário para escolher a forma de pagamento
    echo "<form method='POST' action='finalizar_pedido.php'>
        <label for='forma_pagamento'>Forma de Pagamento:</label>
        <select name='forma_pagamento' id='forma_pagamento'>
            <option value='dinheiro'>Dinheiro</option>
            <option value='cartao'>Cartão</option>
            <option value='Pix'>Pix</option>
        </select>
        <input class='botaofinalizar' type='submit' value='Finalizar Compra'>
    </form>";
}
?>

<br><br><a class='comprarbotao' href='../cliente/loja.php'>Ir á Loja</a><br><br>



    <!-- Tabela de Pedidos -->
    <div class="divtable">
        <div class="container">
            <div class="tbl_container">
                <h2>Meus Pedidos</h2>

                <?php
                if ($resultPedidos->num_rows > 0) {
                    echo "<table class='tbl'>
                        <tr>
                            <th>Número do Pedido</th>
                            <th>Data do Pedido</th>
                            <th>Forma de Pagamento</th>
                            <th>Status do Pedido</th>
                            <th>Itens do Pedido</th>
                        </tr>";

                    while ($rowPedido = $resultPedidos->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $rowPedido["Num_Pedido"] . "</td>
                            <td>" . $rowPedido["Data_Pedido"] . "</td>
                            <td>" . $rowPedido["FPgto_Pedido"] . "</td>
                            <td>";

                        // Consulta para obter a descrição do status
                        $codStatus = $rowPedido["Cod_Status"];
                        $sqlStatus = "SELECT Descr_Status FROM status WHERE Cod_Status = $codStatus";
                        $resultStatus = $conn->query($sqlStatus);

                        if ($resultStatus->num_rows > 0) {
                            $rowStatus = $resultStatus->fetch_assoc();
                            echo $rowStatus["Descr_Status"];
                        } else {
                            echo "Status Desconhecido";
                        }

                        echo "</td>
                            <td>";

                        // Consulta para obter os itens do pedido
                        $numPedido = $rowPedido["Num_Pedido"];
                        $sqlItensPedido = "SELECT itenspedido.Cod_Produto, itenspedido.Qtd_Produto, itenspedido.Valor_Item,(itenspedido.Qtd_Produto*itenspedido.Valor_Item) As Valor_Total
                                          FROM itenspedido
                                          WHERE itenspedido.Num_Pedido = $numPedido";

                        $resultItensPedido = $conn->query($sqlItensPedido);

                        if ($resultItensPedido->num_rows > 0) {
                            echo "<table class='tbl'>
                                <tr>
                                    <th>Nome Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor do Item</th>
                                    <th>Valor Total</th>
                                </tr>";

                            while ($rowItemPedido = $resultItensPedido->fetch_assoc()) {
                                // Agora, vamos buscar o nome do produto com base no Cod_Produto
                                $codProduto = $rowItemPedido["Cod_Produto"];
                                $sqlNomeProduto = "SELECT Nome_Produto FROM produto WHERE Cod_Produto = $codProduto";
                                $resultNomeProduto = $conn->query($sqlNomeProduto);

                                if ($resultNomeProduto->num_rows > 0) {
                                    $rowNomeProduto = $resultNomeProduto->fetch_assoc();
                                    $nomeProduto = $rowNomeProduto["Nome_Produto"];
                                } else {
                                    $nomeProduto = "Nome Desconhecido";
                                }

                                echo "<tr>
                                    <td>" . $nomeProduto . "</td>
                                    <td>" . $rowItemPedido["Qtd_Produto"] . "</td>
                                    <td>R$" . number_format($rowItemPedido["Valor_Item"], 2) . "</td>
                                    <td>R$" . number_format($rowItemPedido["Valor_Total"], 2) . "</td>
                                </tr>";
                            }

                            echo "</table>";
                        } else {
                            echo "Nenhum item encontrado para este pedido.";
                        }

                        echo "</td></tr>";
                    }

                    echo "</table>";
                } else {
                    echo "Nenhum pedido em pendência.";
                }
                ?>
            </div>
        </div>
    </div>

</body>
</html>

<?php
// Feche a conexão com o banco de dados
$conn->close();
?>





