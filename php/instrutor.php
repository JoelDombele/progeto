<?php
// processar_cadastro_instrutor.php

// Inclua o código de conexão com o banco de dados
require_once 'connection.php';

// Inicializa a sessão (se não estiver usando session_start em outros lugares)
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaHash = password_hash($_POST['senhaHash'], PASSWORD_DEFAULT); // Recomendável usar hash de senha

    // Validação e processamento adicional se necessário

    // Conecta ao banco de dados
    $database = new DB();
    $conn = $database->connect();

    try {
        // Insere o instrutor na tabela de instrutores
        $stmt = $conn->prepare("INSERT INTO instrutores (nome, email, senhaHash) VALUES (:nome, :email, :senhaHash)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senhaHash', $senhaHash);

        // Executa a consulta
        $stmt->execute();

        // Obtém o ID do instrutor inserido
        $instrutorId = $conn->lastInsertId();

        // Insere as associações entre instrutor e categorias na tabela de instrutores_categorias
        if (isset($_POST['categorias']) && is_array($_POST['categorias'])) {
            foreach ($_POST['categorias'] as $categoriaId) {
                // Adapte conforme a estrutura real da sua tabela instrutores_categorias
                $stmtCategoria = $conn->prepare("INSERT INTO instrutores_categorias (instrutor_id, categoria_id) VALUES (:instrutorId, :categoriaId)");
                $stmtCategoria->bindParam(':instrutorId', $instrutorId);
                $stmtCategoria->bindParam(':categoriaId', $categoriaId);
                $stmtCategoria->execute();
            }
        }

        // Redireciona para uma página de sucesso ou exibe uma mensagem
        $dialogIcon = "&#x2705;";
        $dialogTitle = "Cadastro Realizado";
        $dialogMessage = "Cadastro feito com sucesso.";

    include 'dialog.php';
       
    } catch (Exception $e) {
        // Exibe uma mensagem de erro ou redireciona para uma página de erro
        $dialogIcon = "&#x26A0;&#xFE0F;";
        $dialogTitle = "ERRO !";
        $dialogMessage = "ERRO AO CADASTRO.";

        include 'dialog.php';
    } finally {
        // Fecha a conexão com o banco de dados
        $conn = null;
    }
} else {
    // Redireciona para uma página de erro ou adota outra lógica de tratamento
    $_SESSION['mensagem'] = "Requisição inválida!";
    header("Location: erro.php");
    exit();
}
?>
