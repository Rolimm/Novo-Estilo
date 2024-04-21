<?php
    include "../php/conexao.php";
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Novo Estilo</title>
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo.png" type="imagem">
        <link rel="stylesheet" href="../css/login.css">
    </head>

<body>
    <video autoplay loop muted>
        <source src="../img/Roupas pack/Roupas4.mp4" type="video/mp4">
        Seu navegador não suporta a reprodução de vídeos.
      </video>
    <div class="wrapper">
        <form method="post" enctype="multipart/form-data" action="../php/valida.php">
            <a href="../index.php" class="voltar">Voltar</a>
            <h1>Login</h1>

            <div class="input-box">
                <div class="input-field">
                    <input type="email" name="email" id="email" placeholder="Digite seu Email" class="inputUser" required>
                    <i class="bx bxs-user"></i>
                </div>

                <div class="input-field">
                    <input type="password" name="senha" id="senha" placeholder="Digite sua Senha"  class="inputUser" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>
            </div>

            <button type="submit" class="btn">Logar</button>
            <a href="../cadastro/cadastro.php" class="cadastro">Cadastrar</a>
        </form>
    </div>

    
</body>
</html>