<?php
    function sets() {
        echo"<script>alert('Operacao Processada com Sucesso!!!')</script>";
        echo"<script>location.href='../clientes.php'</script>"; 
    }
    function regped() {
        echo"<script>alert('Pedido cadastrado com Sucesso!!!')</script>";
        echo"<script>location.href='../produtos.php'</script>"; 
    }
    function del() {
        echo"<script>alert('Registro Excluido com Sucesso!')</script>";
        echo"<script>location.href='../clientes.php'</script>"; 
    }
    function confirma() {
        echo"<script>alert('As senhas não correspondem!!!')</script>";
        echo"<script>location.href='../adcliente.php'</script>"; 
    } 
    function NCad() {
        echo"<script>alert('Usuário não Cadastrado!!!')</script>";
        echo"<script>location.href='../login.php'</script>"; 
    }        
    function SenhaInv() {
        echo"<script>alert('Senha Inválida!!!')<script>";
        echo"<script>location.href='../usuario.php'</script>"; 
    } 
    function senhacad() {
        echo"<script>alert('Cliente Cadastrado com Sucesso!!!')</script>";
        echo"<script>location.href='../login.php'</script>"; 
    }  
?>