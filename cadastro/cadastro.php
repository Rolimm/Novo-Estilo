<?php
    include "../php/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="stylecadastro.css">
	<title>Novo Estilo</title>
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="../img/logo.png" type="imagem">
		<link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>
<video autoplay loop muted>
                <source src="../img/Fundo cadastro.mp4" type="video/mp4">
              </video>
	<div class="wrapper">
		<form method="post" action="../php/inseri.php" onsubmit="return validarDataNascimento()">
			<h1>Cadastro</h1>

			<div class="input-box">

				<div class="input-field">
					<input type="text" required name="nome" id="nome" placeholder="Digite Seu nome" required>
					<i class="bx bxs-user"></i>
				</div>

				<div class="input-field">
					<input type="email" required name="email" placeholder="Digite Seu email" id="email">
					<i class="bx bxs-envelope"></i>
				</div>

				<div class="input-field">
					<input type="password" required name="senha" placeholder="Digite sua Senha" id="senha">
					<i class="bx bxs-lock-alt"></i>
				</div>

				<div class="input-field">
					<input type="text" placeholder="Digite Seu CPF" name="cpf" id="cpf" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  class="form-control" required />
				<i class='bx bxs-user-detail'></i>
				</div>

				<div class="input-field">
                    <input type="text" required name="cep" id="cep" placeholder="Digite seu CEP">
					<i class='bx bxs-home'></i>
				</div>

				<div class="input-field">
					<input type="tel" required name="tel" placeholder="Digite seu Telefone" id="tel">
					<i class="bx bxs-phone"></i>
				</div>

				<div class="input-field">
					<input type="date" required name="datenasc" id="datenasc" class="date" mid="1933-01-01" max="2005-12-31">
					<i class='bx bx-calendar-check'></i>
				</div>

			</div>


			<button type="submit" name="submit" id="submit" class="btn" onclick="criar()">Criar conta</button>

			<p>Já tenho uma conta:</p><a class="log" href="../login/login.php">Login</a>
		</form>
	</div>



<script src="../js/cadastro.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="../js/mascaravalida.js"></script>
<script type="text/javascript" src="mask/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="mask/jquery.maskedinput-1.1.4.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){$("#cpf").mask("999.999.999-99");});
$(document).ready(function(){$("#cep").mask("00000-000");});
$(document).ready(function(){$("#tel").mask("(00)00000-0000");});

</script>
<script>
				function criar(){
					if (dataNascimento > dataAtual) {
						alert("Data de nascimento inválida!");
						document.getElementById("dataNascimento").value = "";
						return false;
					}
					else{
						alert('Usuario criado com sucesso!');
					}
				}

		function validarDataNascimento() {
			var dataNascimento = new Date(document.getElementById("datenasc").value);
			var dataAtual = new Date();
			if (dataNascimento > dataAtual) {
				alert("Data de nascimento inválida!");
				document.getElementById("dataNascimento").value = "";
				return false;
			}
				return true;

		}

			</script>
</body>
</html>