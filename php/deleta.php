<?php
include ("conexao.php");
$Cod_Cliente = $_GET ['Cod_Cliente'];
if ( $result_usuario =  ("DELETE FROM cadastro WHERE Cod_Cliente='$Cod_Cliente' ") ) {
$resultado_usuario = mysqli_query($conn, $result_usuario);
header("Location:select.php");
exit;
}else{
    header("Location:erro.php");
    exit;
}
?>