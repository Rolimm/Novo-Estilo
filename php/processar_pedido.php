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

// Recupere o ID do cliente logado
$codCliente = $_SESSION['Cod_Cliente'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário e inserir o pedido na tabela de pedidos

    // Recupere as informações do formulário
    $formaPagamento = $_POST["forma_pagamento"];
    // Recupere outras informações do pedido conforme necessário

    // Insira um novo registro na tabela de pedidos
    $sqlInserirPedido = "INSERT INTO pedidos (Data_Pedido, Hora_Pedido, FPgto_Pedido, Cod_Cliente, Cod_Status)
                         VALUES (NOW(), NOW(), '$formaPagamento', $codCliente, 2)";

    if ($conn->query($sqlInserirPedido) === TRUE) {
        // Obter o Num_Pedido gerado para o novo pedido
        $numPedido = $conn->insert_id;

        // Você pode inserir os detalhes dos produtos no pedido aqui, se necessário

        // Exibir uma mensagem de confirmação
        echo "Pedido finalizado com sucesso! Seu número de pedido é: $numPedido";

        // Você pode redirecionar o cliente para uma página de confirmação ou outra página relevante aqui
    } else {
        echo "Erro ao finalizar o pedido: " . $conn->error;
    }
}

// Feche a conexão com o banco de dados
$conn->close();
?>