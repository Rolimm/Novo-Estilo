<?php
    $data = date('Y-m-d');
    $hora = date('Y-m-d H:i:s');

     // Cria a conexão com o banco
    include('conexao2.php');
    include('produto.php');

    $usuario = $_SESSION['email']; 
    $Cod_Cliente = $_SESSION['Cod_Cliente'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Qtd_Produto"])) {
            $quantidade = intval($_POST["Qtd_Produto"]); // Converta o valor para um número inteiro
    
            // Agora você tem o valor da quantidade ($quantidade) que pode usar no seu código para adicionar ao carrinho ou atualizar o banco de dados.
            // Por exemplo, você pode inserir um novo registro na tabela do carrinho com o código do produto e a quantidade.
        } else {
            echo "Parâmetros ausentes.";
        }
    }
    if (isset($_POST['tamanho'])) {
        $tamanhoSelecionado = $_POST['tamanho'];
        // Agora você pode usar $tamanhoSelecionado conforme necessário
    }

    $Verifica_pedido = $conexao_pdo->prepare("SELECT Num_Pedido 
                                              FROM pedidos 
                                              WHERE Cod_Cliente='$Cod_Cliente' 
                                              AND Cod_Status='1'");
    $Verifica_pedido->execute();
    $rows=$Verifica_pedido->rowcount();

        //Insere o arquivo de alertas
        include('alertas.php');   

    // Receber os dados do pedido ou produto a adicionar no pedido
    $Cod_Produto = $_POST['Cod_Produto'];
    $pdo_produto = $conexao_pdo->prepare("SELECT Preco_Produto FROM produto WHERE Cod_Produto='$Cod_Produto'");
    $pdo_produto->execute();
    $rs = $pdo_produto->fetch();
    $Preco_Produto = $rs['Preco_Produto'];
    
    if($rows<=0) {

            //Criando um novo registro na tabela de pedido, se o cliente não tiver pedido em aberto
            $pdo_insere=$conexao_pdo->prepare("INSERT INTO pedidos (Data_Pedido,Hora_Pedido,FPgto_Pedido,Cod_Cliente,Cod_Status) 
            VALUES (?, ?, ?, ?, ?)");
            $pdo_insere->execute(array($data,$hora,'Não definida',$Cod_Cliente,'1'));                    

    }
    
    $pdo_verifica = $conexao_pdo->prepare("SELECT Num_Pedido 
                                           FROM pedidos 
                                           WHERE Cod_Cliente='$Cod_Cliente' 
                                           ORDER BY Num_Pedido DESC");
    $pdo_verifica->execute();
    $rs = $pdo_verifica->fetch();
    $npedido = $rs['Num_Pedido'];   
    try {
        // Adicionar um item ao pedido
        $pdo_insere = $conexao_pdo->prepare("INSERT INTO itenspedido(Num_Pedido,Cod_Produto,Qtd_Produto,Valor_Item,tamanho) 
        VALUES (?, ?, ?, ?,?)");
        $pdo_insere->execute(array($npedido, $Cod_Produto, $quantidade , $Preco_Produto,$tamanhoSelecionado));
    
    // Após a ação ser concluída com sucesso, você pode usar JavaScript para exibir um alerta e redirecionar o usuário
    echo '<script>alert("Pedido registrado com sucesso!");</script>';
    echo '<script>window.location = "carrinho.php";</script>';
    exit(); // Certifique-se de sair do script após o redirecionamento
    } catch (PDOException $e) {
        echo "Erro ao registrar o pedido!!!";
    }
?>