<?php
include "../php/conexao.php";


$sql = "SELECT pedidos.Num_Pedido, pedidos.Data_Pedido, pedidos.Hora_Pedido, pedidos.FPgto_Pedido, pedidos.Cod_Status, cadastro.Nome as Nome_Cliente
        FROM pedidos
        INNER JOIN cadastro ON pedidos.Cod_Cliente = cadastro.Cod_Cliente";

$res = $conn->query($sql);

if($res->num_rows > 0){
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
    $html .= "<h2>Novo Estilo</h2>";

    $html .= "<thead>";
    $html .= "<th>Numero Pedido</th>";
    $html .= "<th>Cliente</th>";
    $html .= "<th>Data</th>";
    $html .= "<th>Hora</th>";
    $html .= "<th>Forma de Pagamento</th>";
    $html .= "</thead>";

    while($row = $res->fetch_object()){
        $html .= "<tbody>";
        $html .= "<tr>";
        $html .= "<td>" . $row->Num_Pedido . "</td>";
        $html .= "<td>" . $row->Nome_Cliente . "</td>";
        $html .= "<td>" . $row->Data_Pedido . "</td>";
        $html .= "<td>" . $row->Hora_Pedido . "</td>";
        $html .= "<td>" . $row->FPgto_Pedido . "</td>";
        $html .= "</tr>";
        $html .= "</tbody>";
    }
    $html .= "</table>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";

}else{
    $html = 'nenhum Dado Registrado';
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