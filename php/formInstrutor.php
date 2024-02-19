<?php
            // Abre uma conexão com o banco de dados
            require_once 'connection.php';

            $database = new DB();
            $conn = $database->connect();

            // Prepara uma consulta SQL
            $stmt = $conn->prepare("SELECT id, nome FROM categorias");

            // Executa a consulta SQL
            $stmt->execute();

            // Obtém os resultados da consulta SQL
            $categorias = $stmt->fetchAll();

            // Fecha a conexão com o banco de dados
            $conn = null;

            // Cria as opções do select
            
            ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Instrutor</title>
    <!-- Adicione a referência ao arquivo CSS do Tailwind -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!-- form_cadastro_instrutor.html -->
    <form action="instrutor.php" method="post" class="bg-white p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
        <div class="mb-4">
            <label for="nome" class="block text-sm font-medium text-gray-600">Nome do Instrutor:</label>
            <input type="text" name="nome" required class="mt-1 p-2 border border-gray-300 rounded w-full">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-600">Email do Instrutor:</label>
            <input type="email" name="email" required class="mt-1 p-2 border border-gray-300 rounded w-full">
        </div>

        <div class="mb-4">
            <label for="senhaHash" class="block text-sm font-medium text-gray-600">Senha:</label>
            <input type="password" name="senhaHash" required class="mt-1 p-2 border border-gray-300 rounded w-full">
        </div>

        <div class="mb-4">
            <label for="categorias" class="block text-sm font-medium text-gray-600">Categorias:</label>
            <!-- Use as classes do Tailwind para estilizar o select -->
            <select name="categorias[]" multiple required class="mt-1 block w-full p-2 border border-gray-300 rounded-md leading-5 focus:outline-none focus:ring focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                <!-- Aqui você pode buscar as categorias do banco de dados e criar as opções dinamicamente -->
                <?php foreach ($categorias as $categoria) { ?>
                    <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>
                <?php } ?>
                <!-- Adicione mais opções conforme necessário -->
            </select>
        </div>

        <div class="mb-4">
            <input type="submit" value="Cadastrar Instrutor" class="w-full bg-blue-500 text-white p-2 rounded cursor-pointer">
        </div>
    </form>

</body>
</html>

