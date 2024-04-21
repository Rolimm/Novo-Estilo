<?php
// Conecta ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "novoestilo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o código do produto foi passado como parâmetro
if (isset($_POST['Cod_Produto'])) {
    $codProduto = $_POST['Cod_Produto'];
    
    // Consulta SQL para excluir o produto com o código fornecido
    $sql = "DELETE FROM produto WHERE Cod_Produto = $codProduto";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produto excluído com sucesso.";
    } else {
        echo "Erro ao excluir o produto: " . $conn->error;
    }
} else {
    echo "Código do produto não foi fornecido.";
}

// Fecha a conexão com o banco de dados
$conn->close();

// Redireciona de volta para a página da lista de produtos
header("Location: loja.php");
?>