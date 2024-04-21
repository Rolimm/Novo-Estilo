<?php
include "../php/conexao.php";

if (isset($_GET['Num_Pedido'])) {
    $Num_Pedido = $_GET['Num_Pedido'];

    // Consulta SQL para obter os detalhes do pedido, incluindo o CEP e o e-mail do cliente
    $query_pedido = "SELECT pedidos.Num_Pedido, pedidos.Data_Pedido, pedidos.FPgto_Pedido, pedidos.Cod_Status, cadastro.Nome AS Nome_Cliente, cadastro.CEP AS CEP_Cliente, cadastro.Email AS Email_Cliente
                    FROM pedidos
                    LEFT JOIN cadastro ON pedidos.Cod_Cliente = cadastro.Cod_Cliente
                    WHERE pedidos.Num_Pedido = $Num_Pedido";

    $result_pedido = mysqli_query($conn, $query_pedido);

    // Verifique se o pedido foi encontrado
    if (mysqli_num_rows($result_pedido) > 0) {
        $pedido = mysqli_fetch_assoc($result_pedido);

        $query_status = "SELECT Cod_Status, Descr_Status FROM status";
        $result_status = mysqli_query($conn, $query_status);

        $Status1 = '';
        $Status2 = '';
        $Status3 = '';

        while ($row = mysqli_fetch_assoc($result_status)) {
            if ($row['Cod_Status'] == 2) {
                $Status1 = $row['Descr_Status'];
            } elseif ($row['Cod_Status'] == 3) {
                $Status2 = $row['Descr_Status'];
            } elseif ($row['Cod_Status'] == 4) {
                $Status3 = $row['Descr_Status'];
            }
        }

        ?>
        <link rel="stylesheet" href="../css/select.css">

        <?php
        // Consulta SQL para obter os produtos associados a este pedido
        $query_produtos = "SELECT itenspedido.id_itenspedido, produto.Nome_Produto, itenspedido.Cod_Produto, itenspedido.Num_Pedido, itenspedido.Qtd_Produto, itenspedido.Valor_Item, itenspedido.tamanho, (itenspedido.Qtd_Produto*itenspedido.Valor_Item) AS valor_total
                          FROM itenspedido
                          LEFT JOIN produto ON itenspedido.Cod_Produto = produto.Cod_Produto
                          WHERE itenspedido.Num_Pedido = $Num_Pedido";

        $result_produtos = mysqli_query($conn, $query_produtos);
        ?>

        <div class="divtable">
            <div class="container">
                <a href="pedido.php" style="text-decoration:none; color:white; font-size:18px; background:blue; padding:10px; border-radius:10px">Voltar para Pedidos</a>
                <div class="tbl_container">
                    <h2>Detalhes do Pedido</h2>
                    <form method="post" action="atualizarstatus.php">
                        <table class="tbl">
                            <tr>
                                <td>Número do Pedido:</td>
                                <td><?php echo $pedido['Num_Pedido']; ?></td>
                            </tr>
                            <tr>
                                <td>Nome do Cliente:</td>
                                <td><?php echo $pedido['Nome_Cliente']; ?></td>
                            </tr>
                            <tr>
                                <td>CEP do Cliente:</td>
                                <td><?php echo $pedido['CEP_Cliente']; ?></td>
                            </tr>
                            <tr>
                                <td>E-mail do Cliente:</td>
                                <td><?php echo $pedido['Email_Cliente']; ?></td>
                            </tr>
                            <tr>
                                <td>Data do Pedido:</td>
                                <td><?php echo $pedido['Data_Pedido']; ?></td>
                            </tr>
                            <tr>
                                <td>Forma de Pagamento:</td>
                                <td><?php echo $pedido['FPgto_Pedido']; ?></td>
                            </tr>

                            <tr>
                                <td>Código de Status:</td>
                                <td>
                                    <select name="Cod_Status">
                                        <option value="2" <?php if ($pedido['Cod_Status'] == 2) echo "selected"; ?>><?php echo $Status1; ?></option>
                                        <option value="3" <?php if ($pedido['Cod_Status'] == 3) echo "selected"; ?>><?php echo $Status2; ?></option>
                                        <option value="4" <?php if ($pedido['Cod_Status'] == 4) echo "selected"; ?>><?php echo $Status3; ?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" name="Num_Pedido" value="<?php echo $Num_Pedido; ?>"><br>
                        <input style="width: 100%; cursor:pointer; height:35px; background:green; color:white; border:none; font-size:18px;" type="submit" value="Atualizar Status">
                    </form>

                    <div class="tbl_container">
                        <h2>Produtos</h2>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>Nome do Produto</th>
                                    <th>Cod_Produto</th>
                                    <th>Num_Pedido</th>
                                    <th>Qtd_Produto</th>
                                    <th>Valor_Item</th>
                                    <th>tamanho</th>
                                    <th>Valor Total</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($produto = mysqli_fetch_assoc($result_produtos)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $produto['Nome_Produto']; ?></td>
                                        <td><?php echo $produto['Cod_Produto']; ?></td>
                                        <td><?php echo $produto['Num_Pedido']; ?></td>
                                        <td><?php echo $produto['Qtd_Produto']; ?></td>
                                        <td><?php echo $produto['Valor_Item']; ?></td>
                                        <td><?php echo $produto['tamanho']; ?></td>
                                        <td><?php echo $produto['valor_total']; ?></td>
                                        <td>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                                            <a class='btn btn_trash' href="excluirproduto.php?id=<?php echo $produto['id_itenspedido']; ?>&Num_Pedido=<?php echo $Num_Pedido; ?>"><i class='fas fa-trash'></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php
    } else {
        echo "Pedido não encontrado.";
    }
} else {
    echo "Número do pedido não especificado.";
}
?>