<?php
include "../php/conexao.php";

if (isset($_GET['id']) && isset($_GET['Num_Pedido'])) {
    $id_itenspedido = $_GET['id'];
    $Num_Pedido = $_GET['Num_Pedido'];

    // Consulta SQL para excluir o produto com base no id_itenspedido
    $query = "DELETE FROM itenspedido WHERE id_itenspedido = $id_itenspedido";

    if (mysqli_query($conn, $query)) {
        // Redirecione de volta para a página de edição de pedido
        header("Location: editarpedido.php?Num_Pedido=" . $Num_Pedido);
    } else {
        echo "Erro ao excluir o produto.";
    }
} else {
    echo "ID do produto ou número do pedido não especificado.";
}
?>