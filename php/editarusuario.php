<?php

include_once("conexao.php");
$Cod_Cliente = filter_input(INPUT_GET, 'Cod_Cliente', FILTER_SANITIZE_NUMBER_INT);
$result_usuario = "SELECT * FROM cadastro WHERE Cod_Cliente = '$Cod_Cliente'";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>Novo Estilo</title>
        <link rel="shortcut icon" href="../img/logo.png" type="imagem">
        <link rel="stylesheet" href="../css/select.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<body>
<style>
  @media (max-width:1968px) {
    .tbl thead{
        display: none;
    }
    .tbl tr,
    .tbl td{
        display: block;
        width: 100%;
    }
    .tbl tr{
        margin-bottom: 1rem;
    }
    .tbl tbody tr td{
        text-align: right;
        position: relative;
    }
    .tbl td::before{
        content: attr(data-lable);
        position: absolute;
        left: 0;
        width: 50% !important;
        text-align: left !important;
        padding-left: 1.2rem !important;
    }
    .tbl tbody tr td{
        font-size: 0.8rem;
    }
}
</style>
<div class="divtable">
<div class="container">
    <div class="tbl_container">
    <a href="select.php" class="sair">< Voltar</a><br>
        <h2>
            Editar Usuario
        </h2>

        <table class="tbl">
            <thead>
                <tr>
    <th>Nome:</th>
    <th>Email:</th>
    <th>Senha:</th>
    <th>Nivel:</th>
    <th>Cpf:</th>
    <th>Data de Nasc:</th>
    <th>Telefone:</th>
    <th>Cep:</th>
                </tr>
            </thead>
            <tbody>
<form method="POST" action="update.php" class="form-group">
<input type="hidden" name="Cod_Cliente" value="<?php echo $row_usuario['Cod_Cliente']; ?>">

               
                <tr>
      <td  data-lable="Name"><input type="text" name="nome" placeholder="Digite o nome completo" class="form-control"value="<?php echo $row_usuario['nome']; ?>"></td>
			<td data-lable="Email"><input type="text" name="email" placeholder="Digite o nome completo" class="form-control"value="<?php echo $row_usuario['email']; ?>"></td>
			<td data-lable="Senha"><input type="text" name="senha" placeholder="Digite o email" class="form-control"value="<?php echo $row_usuario['senha']; ?>"></td>
			<td data-lable="Nivel"><input type="text" name="nivel" placeholder="Digite a Senha" class="form-control"value="<?php echo $row_usuario['nivel']; ?>"></td>
			<td data-lable="CPF"><input type="text" name="cpf" placeholder="Digite o Cpf" class="form-control"value="<?php echo $row_usuario['cpf']; ?>"></td>
			<td data-lable="Data Nascimento"><input type="text" name="datenasc" placeholder="Digite a data de nascimento" class="form-control"value="<?php echo $row_usuario['datenasc']; ?>"></td>
			<td data-lable="Telefone"><input type="text" name="tel" placeholder="Digite o telefone" class="form-control"value="<?php echo $row_usuario['tel']; ?>"></td>
			<td data-lable="CEP"><input type="text" name="cep" placeholder="Digite o Cep" class="form-control"value="<?php echo $row_usuario['cep']; ?>"></td>

             
                </tr>

            </tbody>
        </table>
        <button type="submit" class="btn btn-primary btn-block btnvoltar"> Editar </button>
        </form>
    </div>
</div>
</div>

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
