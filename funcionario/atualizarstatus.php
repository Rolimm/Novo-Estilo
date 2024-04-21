<?php
include "../php/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o Num_Pedido e o Cod_Status foram enviados
    if (isset($_POST['Num_Pedido']) && isset($_POST['Cod_Status'])) {
        $Num_Pedido = $_POST['Num_Pedido'];
        $Cod_Status = $_POST['Cod_Status'];

        // Atualiza o código de status no banco de dados
        $query = "UPDATE pedidos SET Cod_Status = '$Cod_Status' WHERE Num_Pedido = '$Num_Pedido'";
        if (mysqli_query($conn, $query)) {
            // Redirecione de volta para a página de edição de pedido
            header("Location: editarpedido.php?Num_Pedido=" . $Num_Pedido);
        } else {
            echo "Erro ao atualizar o status: " . mysqli_error($conn);
        }
    } else {
        echo "Campos obrigatórios não especificados.";
    }
} else {
    echo "Método de solicitação inválido.";
}
?>