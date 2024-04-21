<?php
include "../php/conexao.php";

if (isset($_GET['Num_Pedido'])) {
    $Num_Pedido = $_GET['Num_Pedido'];

    // Verifique a permissão do usuário para excluir o produto, se necessário

    // Consulta SQL para excluir o produto do pedido
    $query_excluir_produto = "DELETE FROM pedidos WHERE  Num_Pedido = $Num_Pedido";

    if (mysqli_query($conn, $query_excluir_produto)) {
        // Produto excluído com sucesso, você pode redirecionar de volta para a página do pedido
        header("Location: pedido.php");
        exit;
    } else {
        echo "Erro ao excluir o produto.";
    }
} else {
    echo "Parâmetros ausentes na URL.";
}
?>