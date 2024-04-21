<?php
include "conexao.php";
?>

<?php
session_start();

if ($_SESSION['nivel'] != "adm") {
    header("Location: ../index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Novo Estilo</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="shortcut icon" href="../img/logo.png" type="imagem">
        <link rel="stylesheet" href="../css/style.css">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/select.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<section id="header">
            <a href="#"><img src="../img/logo.png" class="logo"></a>

            <div>
                <ul id="navbar">
                    <li><a href="../funcionario/funcionario.php">Home</a></li>
                    <li><a class="active" href="select.php">Usuários</a></li>
                    <li><a href="../funcionario/loja.php">Shop</a></li>
                    <li><a href="../funcionario/adicionarproduto.php">Adicionar</a></li>
                    <li><a href="../funcionario/pedido.php">Pedidos</a></li>
                    <a href="#" id="close"><i class="far fa-times"></i></a>
                    <a href="logout.php" class="sair">Sair</a>
                </ul>
            </div>
            <div id="mobile">
                <i id="bar" class="fas fa-outdent"></i>
            </div>
</section>
<?php

// Inicializa a variável de busca e o tipo de busca
$busca = '';
$tipo_busca = '';

if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];
}

if (isset($_GET['tipo_busca'])) {
    $tipo_busca = $_GET['tipo_busca'];
}

// Cria a consulta SQL
if ($busca !== '') {
    if ($tipo_busca === 'nome') {
        $result_usuarios = "SELECT * FROM cadastro WHERE nome LIKE '%$busca%'";
    } elseif ($tipo_busca === 'email') {
        $result_usuarios = "SELECT * FROM cadastro WHERE email LIKE '%$busca%'";
    } elseif ($tipo_busca === 'cpf') {
        $result_usuarios = "SELECT * FROM cadastro WHERE cpf LIKE '%$busca%'";
    } elseif ($tipo_busca === 'nivel') {
        $result_usuarios = "SELECT * FROM cadastro WHERE nivel LIKE '%$busca%'";
    }
} else {
    $result_usuarios = "SELECT * FROM cadastro ORDER BY nome ASC";
}

// Executa a consulta
$resultado_usuarios = mysqli_query($conn, $result_usuarios);
?><div class="divtable">
<div class="container">
    <div class="tbl_container">
        <h2>Tabela de Usuários</h2>

        <!-- Formulário de pesquisa -->
        <div class="search-form">
            <form action="" method="GET">
            Filtrar por
            <select style="font-size:18px; height:30px; border:none; background:transparent; cursor:pointer;" name="tipo_busca">
                    <option value="nome">Nome</option>
                    <option value="cpf">CPF</option>
                    <option value="nivel">Nível</option>
                    <option value="email">Email</option>
                </select>
                <input style="height: 30px; font-size:18px;
                padding:5px;" type="text" name="busca" placeholder="Pesquisar...">
                <button style="font-size: 20px; background:transparent;border:none;cursor:pointer;" type="submit"><i class="fas fa-search"></i></a></button>
            </form>
        </div><br>

        <table class="tbl">
            <!-- Cabeçalho da tabela -->
            <thead>
                <tr>
                    <th>ID:</th>
                    <th>Nome:</th>
                    <th>Email:</th>
                    <th>Senha</th>
                    <th>CPF:</th>
                    <th>Data nascimento:</th>
                    <th>Cep:</th>
                    <th>Telefone:</th>
                    <th>Nivel:</th>
                    <th colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exibe os resultados
                while ($linha = mysqli_fetch_assoc($resultado_usuarios)) {
                    // Processar e exibir os dados
                    ?>
                    <tr>
                        <td data-label="User Id"><?php echo $linha['Cod_Cliente'] ?></td>
                        <td data-label="Name"><?php echo $linha['nome'] ?></td>
                        <td data-label="Email"><?php echo $linha['email'] ?></td>
                        <td data-label="Senha"><?php echo $linha['senha'] ?></td>
                        <td data-label="CPF"><?php echo $linha['cpf'] ?></td>
                        <td data-label="Data Nascimento"><?php echo $linha['datenasc'] ?></td>
                        <td data-label="CEP"><?php echo $linha['cep'] ?></td>
                        <td data-label="Telefone"><?php echo $linha['tel'] ?></td>
                        <td data-label="Nivel"><?php echo $linha['nivel'] ?></td>
                        <td data-label="Editar"><?php echo "<a class='btn btn_edit' href='editarusuario.php?&Cod_Cliente=" . $linha["Cod_Cliente"] . "'><i class='bx bx-edit'></i></a>  " ?></td>
                        <td data-label="Deletar"><?php echo "<a class='btn btn_trash' href='deleta.php?&Cod_Cliente=" . $linha["Cod_Cliente"] . "'><i class='bx bx-trash'></i></a>  " ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
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
            <p><a  href="../funcionario/funcionario.php">Home</a></p>
            <p><a class="active" href="select.php">Usuários</a></li></p>
            <p><a href="../funcionario/loja.php">Shop</a></li></p>
            <p><a  href="../funcionario/adicionarproduto.php">Adicionar Produto</a></li></p>
            <p><a href="../funcionario/pedido.php">Pedidos</a></li></p>
            <p><a href="logout.php">Sair</a></p>
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
<script src="../js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
</body>

</html>