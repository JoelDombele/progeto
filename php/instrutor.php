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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Adicione a referência ao arquivo CSS do Tailwind -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        /* Adicione estilos personalizados aqui, se necessário */
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <main class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
        <form method="post" class="bg-white p-8 rounded shadow-md">
            <div class="mb-6">
                <h1 class="text-3xl font-bold mb-4">Registra-te Como instrutor</h1>
                <input type="text" class="w-full p-2 border border-gray-300 rounded" name="nome" required placeholder="Nome">
            </div>

            <div class="mb-6">
                <input type="email" class="w-full p-2 border border-gray-300 rounded" name="email" required placeholder="Email">
            </div>

            <div class="mb-6">
                <input type="password" class="w-full p-2 border border-gray-300 rounded" name="senhaHash" required placeholder="Senha">
            </div>

            <div class="mb-6">
                <input type="submit" value="Enviar" name="confirmar" class="w-full bg-blue-500 text-white p-2 rounded cursor-pointer">
            </div>
        </form>
    </main>

</body>
</html>

