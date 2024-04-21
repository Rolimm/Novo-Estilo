<?php
include "../php/conexao.php";

?>

<?php
session_start();

if ($_SESSION['nivel'] != "adm") {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Novo Estilo</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="shortcut icon" href="../img/logo.png" type="imagem">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/adicionarcarrinho.css">
        <link rel="stylesheet" href="../css/select.css">
    </head>
    <body>
    <section id="header">
            <a href="#"><img src="../img/logo.png" class="logo"></a>

            <div>
                <ul id="navbar">
                    <li><a href="funcionario.php">Home</a></li>
                    <li><a href="../php/select.php">Usuários</a></li>
                    <li><a href="loja.php">Shop</a></li>
                    <li><a class="active" href="adicionarproduto.php">Adicionar</a></li>
                    <li><a href="../funcionario/pedido.php">Pedidos</a></li>
                    <a href="#" id="close"><i class="far fa-times"></i></a>
                    <a href="../php/logout.php" class="sair">Sair</a>
                </ul>
            </div>
            <div id="mobile">
                <i id="bar" class="fas fa-outdent"></i>
            </div>
        </section>
    
    <?php
    // Variável para verificar se o produto foi adicionado com sucesso
    $produtoAdicionado = false;

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Coleta os dados do formulário
        $nomeProduto = $_POST["Nome_Produto"];
        $precoProduto = $_POST["Preco_Produto"];
        
        // Verifica se um arquivo foi enviado
        if (isset($_FILES["Foto_Produto"]) && $_FILES["Foto_Produto"]["error"] == 0) {
            $fotoProduto = $_FILES["Foto_Produto"]["name"];
            $tempName = $_FILES["Foto_Produto"]["tmp_name"];
            
            // Define o caminho para salvar a imagem
            $uploadDir = "../img/products/";
            $fotoProdutoPath = $uploadDir . $fotoProduto;
            
            // Move o arquivo para a pasta de upload
            if (move_uploaded_file($tempName, $fotoProdutoPath)) {
                // Define o novo caminho onde a imagem deve ser armazenada
                $newImagePath = "../img/products/" . $fotoProduto;
                
                // Move o arquivo para a pasta "products" dentro da pasta "img"
                if (rename($fotoProdutoPath, $newImagePath)) {
                    // Prepara e executa a consulta SQL para inserir o novo produto
                    $sql = "INSERT INTO produto (Nome_Produto, Preco_Produto, Foto_Produto) VALUES ('$nomeProduto', '$precoProduto', '$newImagePath')";
                    
                    if ($conn->query($sql) === TRUE) {
                        $produtoAdicionado = true;
                    } else {
                        echo "Erro ao adicionar o produto: " . $conn->error;
                    }
                } else {
                    echo "Erro ao mover a imagem para a pasta de produtos.";
                }
            } else {
                echo "Erro ao fazer o upload da imagem.";
            }
        } else {
            echo "Por favor, selecione uma imagem para o produto.";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    }

    // Se o produto foi adicionado com sucesso, redirecione para a página de confirmação
    if ($produtoAdicionado) {
        header("Location: confirmacao.php");
        exit(); // Certifique-se de sair após redirecionar
    }
    ?>
    <div class="divtable">
    <div class="container">
        <div class="title">
        <h2>Adicionar Produto</h2>
        </div>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
            <div class="form-details">
                <div class="input-box">
                    <span for="Nome_Produto" class="detales">Nome do Produto</span>
                    <input type="text" name="Nome_Produto" placeholder="Digite o Nome do produto" required>
                </div>

                <div class="input-box">
                    <span for="Preco_Produto" class="detales">Preço do Produto:</span>
                    <input type="text" placeholder="Digite o Preço do Produto" name="Preco_Produto" required>
                </div>

                <span class="fotodoproduto" for="Foto_Produto" class="detales">Foto do Produto</span>
                <input class="foto" type="file" name="Foto_Produto" accept="image/*" required><br>
                
            </div>
            <div class="botao">
            <input class="butao" type="submit" value="Adicionar Produto">
            </div>
            

        </form>

    </div>
    </div>
    <div class="divtable">
    <div class="container">
        <h2>Produtos mais Vendidos</h2>

        <?php
        $sql = "SELECT produto.Nome_Produto, 
                       SUM(itenspedido.Qtd_Produto) AS Total_Vendido, 
                       itenspedido.Valor_Item AS Valor_Unitario, 
                       SUM(itenspedido.Valor_Item * itenspedido.Qtd_Produto) AS Custo_Total
                FROM itenspedido
                JOIN produto ON itenspedido.Cod_Produto = produto.Cod_Produto
                GROUP BY itenspedido.Cod_Produto
                ORDER BY Total_Vendido DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='tbl'>";
            echo "<thead><tr><th>Nome do Produto</th><th>Valor Unitário</th><th>Total Vendido</th><th>Valor Total</th></tr></thead>";

            while ($row = $result->fetch_assoc()) {
                $custo_total_formatado = number_format($row["Custo_Total"], 2, '.', ','); // Formatar para 2 casas decimais
                echo "<tbody><tr><td data-label='Nome produto'>" . $row["Nome_Produto"] . "</td>
                <td data-label='Valor Unitário'>" . $row["Valor_Unitario"] . "</td>
                <td data-label='Total Vendido'>" . $row["Total_Vendido"] . "</td>
                <td data-label='Valor Total'>" . $custo_total_formatado . "</td></tr></tbody>";
            }

            echo "</table>";
        } else {
            echo "Nenhum resultado encontrado.";
        }

        $conn->close();
        ?>
    </div>
</div>


    <section class="contact">
    <div class="contact-info">
        <div class="first-info">
            <img src="../img/logo.png" alt="">
            <p><strong>Endereço: </strong>São Paulo Av.Vautier,248 - Brás</p>
            <p><strong>Telefone: </strong>(21) 99514-4281</p>
        </div>

        <div class="second-info">
            <h4>Links</h4>
            <p><a  href="funcionario.php">Home</a></p>
            <p><a href="../php/select.php">Usuários</a></li></p>
            <p><a href="loja.php">Shop</a></li></p>
            <p><a class="active" href="adicionarproduto.php">Adicionar Produto</a></li></p>
            <p><a href="pedido.php">Pedidos</a></li></p>
            <p><a href="../php/logout.php">Sair</a></p>
        </div>

        <div class="third-info">
                <h4>Sobre</h4>
                <p>Seu guarda-roupa merece o toque de sofisticação que só a Novo Estilo pode oferecer, com bodys que são sinônimo de estilo e atitude.</p>
            </div>
            <div class="four-info">
                <h4>Redes Sociais</h4>
                <div class="social-icon">
                    <a target="_blank" href="https://instagram.com/novoestilobras?igshid=MzRlODBiNWFlZA=="><i class="fab fa-instagram"></i>@novoestilobras</a>
                </div>
            </div>

        </div>
    </div>
</section>
</body>
</html>