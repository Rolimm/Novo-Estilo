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
                <li><a href="../index.php">Home</a></li>
                <li><a class="active" href="loja.php">Shop</a></li>
                <li><a href="../contato/contato.php">Contato</a></li>
                <a href="../login/login.php" class="login">Login</a>
                <a href="#" id="close"><i class="far fa-times"></i></a>
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
            $sql = "SELECT Nome_Produto, Preco_Produto, Foto_Produto FROM produto";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Loop através dos resultados e exibe os produtos
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<img src="' . $row["Foto_Produto"] . '" alt="">';
                    echo '<div class="p-details">';
                    echo '<h2>' . $row["Nome_Produto"] . '</h2>';
                    echo '<h3>R$ ' . number_format($row["Preco_Produto"], 2, ',', '.') . '</h3>';
                
                    // Verificar se o usuário está logado
                        // Se não estiver logado, exibir uma mensagem e um link para a página de login
                        echo '<p>Você precisa estar logado para comprar este produto.</p>';
                        echo '<a href="../login/login.php">Faça login</a>';
                    
                
                    echo '</div>';
                    echo '</div>';
                }
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
            ?>
            <style>
                .product a{
                    text-decoration: none !important;
                    color:black !important;
                    background-color:  #44e047 !important;
                    padding: 10px !important ;
                    border-radius: 20px !important;
                }
            </style>
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
                <p><a href="../index.php">Home</a></p>
                <p><a class="active" href="loja.php">Shop</a></p>
                <p><a href="../contato/contato.php">Contato</a></p>
                <p><a href="../login/login.php">Login</a></p>
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
