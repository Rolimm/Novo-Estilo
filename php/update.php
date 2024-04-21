<?php
session_start();
include_once("conexao.php");

$Cod_Cliente = filter_input(INPUT_POST, 'Cod_Cliente', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$nivel = filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_STRING);
$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$datenasc = filter_input(INPUT_POST, 'datenasc', FILTER_SANITIZE_STRING);

//echo "Nome: $nome <br>";
//echo "E-mail: $email <br>";

$result_usuario = "UPDATE cadastro SET nome='$nome', email='$email',senha='$senha',nivel='$nivel',cep='$cep',cpf='$cpf',datenasc='$datenasc' WHERE Cod_Cliente='$Cod_Cliente'";
$resultado_usuario = mysqli_query($conn, $result_usuario);

if(mysqli_affected_rows($conn)){
	echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Novo%20Estilo/php/select.php'>
					<script type=\"text/javascript\">
						alert(\"Conteúdo editado com sucesso.\");
					</script>
				";
}else{
	echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Novo%20Estilo/php/select.php'>
					<script type=\"text/javascript\">
						alert(\"Conteúdo não editado.\");
					</script>
				";
}
