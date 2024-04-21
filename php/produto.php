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

// Verifica se o parâmetro Cod_Produto foi passado na URL
if (isset($_GET['Cod_Produto'])) {
    $codProduto = $_GET['Cod_Produto'];

    // Consulta SQL para buscar as informações do produto com o Cod_Produto específico
    $sql = "SELECT Cod_Produto, Nome_Produto, Preco_Produto, Foto_Produto FROM produto WHERE Cod_Produto = $codProduto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nomeProduto = $row["Nome_Produto"];
        $precoProduto = $row["Preco_Produto"];
        $fotoProduto = $row["Foto_Produto"];
    } else {
        $nomeProduto = "Produto não encontrado.";
    }
} else {
    $nomeProduto = "Parâmetro Cod_Produto não foi passado na URL.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Estilo</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="shortcut icon" href="../img/logo.png" type="image">
    <link rel="stylesheet" href="../css/produto.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: left;
            max-width: 900px;
            margin: 0 auto;
        }
        h1 {
            font-size: 24px;
        }
        p {
            font-size: 18px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-size: 16px;
        }
        input[type="number"] {
            width: 50px;
            padding: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }
        @media (min-width: 800px) {
            .container {
                display: flex;
                align-items: center;
            }
            .container img {
                max-width: 50%;
                margin-right: 20px;
            }
            .product-details {
                flex: 1;
            }
        }
    </style>
</head>
<body>
<a href="../cliente/loja.php">Voltar</a>
    <div class="container">
        <img src="<?php echo $fotoProduto; ?>" alt="<?php echo $nomeProduto; ?>">
        <div class="product-details">
            <h1><?php echo $nomeProduto; ?></h1>
            <p>Preço: R$ <?php echo number_format($precoProduto, 2, ',', '.'); ?></p>
            <form method="post" action="adicionarcarrinho.php">
                <input type="hidden" name="Cod_Produto" value="<?php echo $codProduto; ?>">
                <label for="Qtd_Produto">Quantidade:</label>
                <input type="number" name="Qtd_Produto" id="Qtd_Produto" value="1" min="1">
<br><br>
                <label for="tamanho">Tamanho:</label><br><br>
<input type="radio" name="tamanho" id="tamanho_p" value="P" checked>
<label for="tamanho_p">P</label>
<input type="radio" name="tamanho" id="tamanho_m" value="M">
<label for="tamanho_m">M</label>
<input type="radio" name="tamanho" id="tamanho_g" value="G">
<label for="tamanho_g">G</label>

                <br><br><input type="submit" value="Adicionar ao Carrinho">
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Feche a conexão com o banco de dados
$conn->close();
?>