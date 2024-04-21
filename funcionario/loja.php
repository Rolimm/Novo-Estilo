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
    <link rel="shortcut icon" href="../img/logo.png" type="image">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/loja.css">
</head>
<body>
    <section id="header">
        <a href="#"><img src="../img/logo.png" class="logo"></a>

        <div>
        <ul id="navbar">
                    <li><a href="funcionario.php">Home</a></li>
                    <li><a href="../php/select.php">Usuários</a></li>
                    <li><a class="active" href="loja.php">Shop</a></li>
                    <li><a href="adicionarproduto.php">Adicionar</a></li>
                    <li><a href="pedido.php">Pedidos</a></li>
                    <a href="#" id="close"><i class="far fa-times"></i></a>
                    <a href="../php/logout.php" class="sair">Sair</a>
                </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section class="containerloja">
    <form>
        <i class="fas fa-search"></i>
        <input type="text" name="" id="search-item" placeholder="Procurar produto" onkeyup="search()">
    </form>

    <div class="product-list" id="product-list">
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

        // Consulta SQL para buscar todos os produtos
        $sql = "SELECT Cod_Produto, Nome_Produto, Preco_Produto, Foto_Produto FROM produto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop através dos resultados e exibe os produtos com botão de exclusão
            while ($row = $result->fetch_assoc()) {
                echo "<form action='excluir_produto.php' method='post'>";
                echo '<input type="hidden" name="Cod_Produto" value="' . $row["Cod_Produto"] . '">';
                echo '<div class="product">';
                echo '<img src="' . $row["Foto_Produto"] . '" alt="">';
                echo '<div class="p-details">';
                echo '<h2>' . $row["Nome_Produto"] . '</h2>';
                echo '<h3>R$ ' . number_format($row["Preco_Produto"], 2, ',', '.') . '</h3>';
                echo "<button style='width:200px; border:none; height:25px; cursor:pointer; color:white; background:red;' type='submit'>Excluir</button>";
                echo '</div>';
                echo '</div>';
                echo'</form>';
            }
        } else {
            echo "Nenhum produto encontrado.";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </div>
</section>




    <section class="espaco">
    </section>

    <!-- contact-section -->
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
            <p><a class="active" href="loja.php">Shop</a></li></p>
            <p><a href="adicionarproduto.php">Adicionar Produto</a></li></p>
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
    </section>
    <script src="../js/script.js"></script>
    <script src="../js/loja.js"></script>
</body>
</html>
