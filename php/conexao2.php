<?php

    //* Define o limite de tempo da sessão em 60 minutos */
    session_cache_expire(60);

    // Inicia a sessão
    session_start();
    
    // variavel de definição do sistema de conversão de caracteres
    $charset_db='UTF8';
    // Variáveis da conexão
    $base_dados  = 'novoestilo';
    $usuario_bd  = 'root';
    $senha_bd    = '';
    $host_db     = 'localhost';
    // Concatenação das variáveis para detalhes da classe PDO
    $detalhes_pdo  = 'mysql:host='.$host_db.';';
    $detalhes_pdo .= 'dbname='.$base_dados.';';
    $detalhes_pdo .= 'charset='.$charset_db.';';
    // Tenta conectar
    try {
        // Cria a conexão PDO com a base de dados
        $conexao_pdo = new PDO($detalhes_pdo, $usuario_bd, $senha_bd);
        //echo "Banco de Dados Conectado com Sucesso!!!";
    } catch (PDOException $e) {
        // Se der algo errado, mostra o erro PDO
        echo "Erro ao conectar o Banco de Dados!!!";
        // Mata o script
        die();
    }
?>