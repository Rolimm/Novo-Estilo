<?php
include "conexao.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Novo Estilo</title>
<link rel="shortcut icon" href="../img/ExynosLogo.png" type="imagem">
</head>

<body>

 <?php
    session_start(); 
        //Incluindo a conexão com banco de dados   
    include_once("conexao.php");    
	
    //O campo usuário e senha preenchido entra no if para validar
    if((isset($_POST['email'])) && (isset($_POST['senha']))){
        $email = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);

        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM cadastro WHERE email = '$email' && senha = '$senha' ";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        
        //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        if(isset($resultado)){
            $_SESSION['Cod_Cliente'] = $resultado['Cod_Cliente'];
            $_SESSION['nome'] = $resultado['nome'];
            $_SESSION['email'] = $resultado['email'];
			$_SESSION['datanasc'] = $resultado['datanasc'];
			$_SESSION['nivel'] = $resultado['nivel'];
			

            if($_SESSION['nivel'] == "adm"){
                echo "
                <script type=\"text/javascript\">
                alert(\"Usuário conectado como Adm.\");
            </script>
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Novo%20Estilo/funcionario/funcionario.php'>
            ";


            }elseif($_SESSION['nivel'] == "cliente"){
                echo "
                <script type=\"text/javascript\">
                alert(\"Usuário conectado como Cliente.\");
            </script>
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Novo%20Estilo/cliente/cliente.php'>
            ";

            }else{
                header("Location: erro.php");
            }
        //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        //redireciona o usuario para a página de login
        }else{    
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            
            echo "
            <script type=\"text/javascript\">
            alert(\"Login ou senha incorretas.\");
        </script>
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Novo%20Estilo/login/login.php'>
        ";

        }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
    }
?>