<?php
session_start();

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

$codCliente = $_SESSION['Cod_Cliente'];

// Verifique se existe um pedido em andamento com Cod_Status igual a 1
$sqlPedidoExistente = "SELECT Num_Pedido FROM pedidos WHERE Cod_Cliente = $codCliente AND Cod_Status = 1";
$resultPedidoExistente = $conn->query($sqlPedidoExistente);

if ($resultPedidoExistente->num_rows > 0) {
    // Um pedido em andamento com Cod_Status igual a 1 existe, obtenha o Num_Pedido desse pedido
    $rowPedidoExistente = $resultPedidoExistente->fetch_assoc();
    $numPedido = $rowPedidoExistente['Num_Pedido'];

    // Atualize o Cod_Status para 2 no pedido encontrado
    $sqlUpdateStatus = "UPDATE pedidos SET Cod_Status = 2 WHERE Num_Pedido = $numPedido";
    $conn->query($sqlUpdateStatus);
} else {
    // Se não houver pedido em andamento com Cod_Status igual a 1, exiba uma mensagem de erro
    echo "Não foi possível encontrar um pedido em andamento com Cod_Status igual a 1.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere o número do pedido a partir da sessão
    $numPedido = $_SESSION['Num_Pedido'];

    // Recupere a forma de pagamento selecionada do formulário
    $formaPagamento = $_POST['forma_pagamento'];

    // Atualize a forma de pagamento no banco de dados
    $sqlUpdatePagamento = "UPDATE pedidos SET FPgto_Pedido = '$formaPagamento' WHERE Num_Pedido = $numPedido";
    if ($conn->query($sqlUpdatePagamento) === TRUE) {
        // Redirecione o usuário de volta à página de carrinho após a atualização

	echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Novo%20Estilo/cliente/loja.php'>
					<script type=\"text/javascript\">
						alert(\"COMPRA REALIZADA COM SUCESSO.\");
					</script>
				";
        exit;
    } else {
        echo "Erro ao atualizar a forma de pagamento: " . $conn->error;
    }
}

// Feche a conexão com o banco de dados
$conn->close();
?>