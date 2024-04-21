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
    <link rel="stylesheet" href="../css/contato.css">
</head>
<body>
    <section id="header">
        <a href="#"><img src="../img/logo.png" class="logo"></a>

        <div>
            <ul id="navbar">
                <li><a href="../index.php">Home</a></li>
                <li><a  href="../loja/loja.php">Shop</a></li>
                <li><a class="active" href="contato.php">Contato</a></li>
                <a href="../login/login.php" class="login">Login</a>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

<section id="section-wrapper">
    <div class="box-wrapper">
        <div class="info-wrap">
            <h2 class="info-title">Nos Contate</h2>
            <h3 class="info-sub-title">Descubra o poder da elegância e do conforto com Novo Estilo, a empresa que transforma bodys em verdadeiras obras de arte da moda!</h3>
            <ul class="info-details">
                <li>
                    <i class="fas fa-phone"></i>
                    <span>Telefone:</span><a href="#">(21) 99514-4281</a>
                </li>
            </ul>
            <ul class="social-icons">
                <li><a target="_blank" href="https://instagram.com/novoestilobras?igshid=MzRlODBiNWFlZA=="><i class="fab fa-instagram"></i>@novoestilobras</a></li>
            </ul>
        </div>
        <div class="form-wrap">
            <form action="https://api.staticforms.xyz/submit" method="post">
                <h2 class="form-title">Mande Uma Mensagem</h2>
                <div class="form-fields">
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="fname" placeholder="Digite seu Nome" autocomplete="off" required>
                        <input type="hidden" name="accessKey" value="d33f2728-ce90-4b70-9aec-885c101d89ee">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Digite seu Email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="message" cols="30"  rows="10" placeholder="Digite sua Mensagem" required></textarea>
                    </div>
                    <input type="hidden" name="redirectTo" value="http://localhost/Novo%20Estilo/contato/contato.php"> 
                    <input type="submit" value="Enviar" onclick="clicarcontato()" class="submit-button">
                </div>
            </form>
        </div>
    </div>
</section>

<script>
function clicarcontato() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var message = document.getElementById("message").value;

    // Verificar se o campo de email contém "@"
    if (name !== "" && email.includes("@") && message !== "") {
        alert("Mensagem enviada com sucesso para Novo Estilo");
    } else {
        alert("Por favor, preencha todos os campos corretamente, incluindo um endereço de e-mail válido.");
    }
}
</script>

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
                <p><a href="../loja/loja.php">Shop</a></p>
                <p><a class="active" href="contato.php">Contato</a></p>
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
</body>
</html>