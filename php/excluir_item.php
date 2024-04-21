<?php
session_start();

if ($_SESSION['nivel'] != "cliente") {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id_itenspedido']) && is_numeric($_GET['id_itenspedido'])) {
    $id_itenspedido = $_GET['id_itenspedido'];

    // Conecte-se ao banco de dados (coloque suas informações de conexão aqui)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "novoestilo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verifique se o item pertence ao pedido do cliente logado
    $codCliente = $_SESSION['Cod_Cliente'];
    $sql = "DELETE FROM itenspedido WHERE id_itenspedido = $id_itenspedido AND Num_Pedido IN (SELECT Num_Pedido FROM pedidos WHERE Cod_Cliente = $codCliente AND Cod_Status = 1)";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: carrinho.php"); // Redireciona de volta para a página do carrinho
        exit;
    } else {
        echo "Erro ao excluir o item: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: carrinho.php"); // Redireciona de volta para a página do carrinho se o parâmetro não for válido
    exit;
}
?>