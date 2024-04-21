<?php
include "../php/conexao.php";

?>

<?php

session_start();

	if($_SESSION['nivel'] == "cliente" )  {
		}else{
			header("Location:../index.php");
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
    </head>

    <body>
        <section id="header">
            <a href="#"><img src="../img/logo.png" class="logo"></a>

            <div>
                <ul id="navbar">
                    <li><a class="active" href="cliente.php">Home</a></li>
                    <li><a href="loja.php">Shop</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <li><a id="lg-bag" href="../php/carrinho.php"><i class="far fa-shopping-bag"></i></a></li>
                    <a href="#" id="close"><i class="far fa-times"></i></a>
                    <a href="../php/logout.php" class="sair">Sair</a>
                </ul>
            </div>
            <div id="mobile">
                <a href="../php/carrinho.php"><i class="far fa-shopping-bag"></i></a>
                <i id="bar" class="fas fa-outdent"></i>
            </div>
        </section>

        <section id="hero">
            <video autoplay loop muted>
                <source src="../img/Roupas pack/Roupas2.mp4" type="video/mp4">
                Seu navegador não suporta a reprodução de vídeos.
              </video>

            <h4>Novo estilo</h4>
            <h2>Bem Vindo</h2>
            <h1>Bodys encatadores cheios de tendência</h1>
            <p>e na melhor vibe do verão .</p>
            <button><a href="loja.php" style="text-decoration:none ;   color: #088178;">Shop Now</a></button>
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
            <p><a class="active" href="cliente.php">Home</a></p>
            <p><a href="loja.php">Shop</a></li></p>
            <p><a href="contato.php">Contato</a></p>
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
    </body>

</html>