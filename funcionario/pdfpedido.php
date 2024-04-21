<?php
include "../php/conexao.php";
$Num_Pedido = $_GET['Num_Pedido'];
// Query to retrieve order information
$sql_order = "SELECT pedidos.Num_Pedido, pedidos.Data_Pedido, pedidos.FPgto_Pedido, pedidos.Cod_Status, cadastro.Nome AS Nome_Cliente, cadastro.CEP AS CEP_Cliente, cadastro.Email AS Email_Cliente
FROM pedidos
LEFT JOIN cadastro ON pedidos.Cod_Cliente = cadastro.Cod_Cliente
WHERE pedidos.Num_Pedido = $Num_Pedido";

$res_order = $conn->query($sql_order);

// Query to retrieve product information
$sql_products = "SELECT itenspedido.id_itenspedido, produto.Nome_Produto, itenspedido.Cod_Produto, itenspedido.Num_Pedido, itenspedido.Qtd_Produto, itenspedido.Valor_Item, itenspedido.tamanho,(itenspedido.Qtd_Produto*itenspedido.Valor_Item) AS valor_total 
                  FROM itenspedido
                  LEFT JOIN produto ON itenspedido.Cod_Produto = produto.Cod_Produto
                  WHERE itenspedido.Num_Pedido = $Num_Pedido";

$res_products = $conn->query($sql_products);

if ($res_order->num_rows > 0) {
    $order = $res_order->fetch_object();
    $html = "<div class='divtable'>";
    $html .= "<div class='container'>";
    $html .= "<div class='tbl_container'>";
    $html .= "<style>*{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    .divtable{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        font-family: 'poppins',sans-serif;
    }
    .container{
        max-width: 1600px;
        width: 100%;
        background: linear-gradient(25deg ,#068fa1, #f7ff5c);
        padding: 5vh;
        border-radius: 10%;
        box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
    }
    .container h2{
        padding: 2rem 1rem;
        font-size: 2.5rem;
        text-align: center;
    }
    .tbl{
        width: 100%;
        border-collapse: collapse;
    }
    .tbl thead{
        background: #424949;
        color: #fff;
    }
    .tbl thead tr th{
        font-size: 0.9rem;
        padding: 0.8rem;
        vertical-align: top;
        border: 1px solid #aab7b8;
    }
    .tbl tbody tr td{
        font-size: 1rem;
        font-weight: normal;
        text-align: center;
        border: 1px solid #aab7b8;
        padding: 0.8rem;
    }
    .tbl tr:nth-child(even){
        background: #25e5f3;
    }
    .tbl tr:hover td{
        background: #9f9f9f;
        color: white;
        transition: all 0.3s ease-in;
        cursor: pointer;
    }
    </style>";
    
    $html .= "<table class='tbl'>";
    $html .= "<h1>Relatório do Novo Estilo</h1>";
    $html .= "<br>";
    $html .= "<h2>Detalhes do Pedido</h2>";
    $html .= "<thead>";
    $html .= "<th>Número Pedido</th>";
    $html .= "<th>Nome</th>";
    $html .= "<th>CEP</th>";
    $html .= "<th>E-mail</th>";
    $html .= "<th>Data</th>";
    $html .= "<th>Forma de Pagamento</th>";
    $html .= "</thead>";

    $html .= "<tbody>";
    $html .= "<tr>";
    $html .= "<td>" . $order->Num_Pedido . "</td>";
    $html .= "<td>" . $order->Nome_Cliente . "</td>";
    $html .= "<td>" . $order->CEP_Cliente . "</td>";
    $html .= "<td>" . $order->Email_Cliente . "</td>";
    $html .= "<td>" . $order->Data_Pedido . "</td>";
    $html .= "<td>" . $order->FPgto_Pedido . "</td>";
    $html .= "</tr>";
    $html .= "</tbody>";
    
    $html .= "</table>";

    // Display product information
    $html .= "<div class='tbl_container'>";
    $html .= "<h2>Produtos</h2>";
    $html .= "<table class='tbl'>";
    $html .= "<thead>";
    $html .= "<tr>";
    $html .= "<th>Nome do Produto</th>";
    $html .= "<th>Cod_Produto</th>";
    $html .= "<th>Num_Pedido</th>";
    $html .= "<th>Qtd_Produto</th>";
    $html .= "<th>Valor_Item</th>";
    $html .= "<th>Tamanho</th>";
    $html .= "<th>Valor Total</th>";
    $html .= "</tr>";
    $html .= "</thead>";
    
    while ($product = $res_products->fetch_object()) {
        $html .= "<tr>";
        $html .= "<td>" . $product->Nome_Produto . "</td>";
        $html .= "<td>" . $product->Cod_Produto . "</td>";
        $html .= "<td>" . $product->Num_Pedido . "</td>";
        $html .= "<td>" . $product->Qtd_Produto . "</td>";
        $html .= "<td>" . $product->Valor_Item . "</td>";
        $html .= "<td>" . $product->tamanho . "</td>";
        $html .= "<td>" . $product->valor_total . "</td>";
        $html .= "</tr>";
    }
    
    $html .= "</table>";
    $html .= "</div>";

    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";
} else {
    $html = 'Nenhum dado registrado';
}

use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->set_option('defaultFont','sans');

$dompdf->setPaper('A4','landscape');

$dompdf->render();

$dompdf->stream();

header("Location: pedido.php");

?>