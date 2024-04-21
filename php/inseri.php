<?php

include_once("conexao.php");

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($i = 9; $i < 11; $i++) {
        $sum = 0;
        for ($j = 0; $j < $i; $j++) {
            $sum += $cpf[$j] * ($i + 1 - $j);
        }
        $remainder = $sum % 11;
        if ($remainder < 2) {
            $digit = 0;
        } else {
            $digit = 11 - $remainder;
        }
        if ($digit != $cpf[$i]) {
            return false;
        }
    }

    return true;
}

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$datenasc = filter_input(INPUT_POST, 'datenasc', FILTER_SANITIZE_STRING);
$tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);

$cpf = $_POST['cpf'];

if (validarCPF($cpf)) {
    $result_usuario = "INSERT INTO cadastro (nome, email, senha, datenasc, cpf, tel, cep) VALUES ('$nome', '$email', '$senha', '$datenasc', '$cpf', '$tel', '$cep')";
    $resultado_usuario = mysqli_query($conn, $result_usuario);

    if ($resultado_usuario) {
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=http://localhost/Novo%20Estilo/login/login.php'>
        <script language='javascript'>
        window.alert('Usuário criado com sucesso!');
        </script>";
    } else {
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=http://localhost/Novo%20Estilo/cadastro/cadastro.php'>
        <script language='javascript'>
        window.alert('Erro ao inserir usuário no banco de dados.');
        </script>";
    }
} else {
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=http://localhost/Novo%20Estilo/cadastro/cadastro.php'>
	<script language='javascript'>
	window.alert('Cpf invalido, insira um cpf valido');
	</script>";
}

?>