<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="min-h-full">
 <?php include 'header.php'; ?>
  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Painel do Instrutor</h1>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        userMenuButton.addEventListener('click', function () {
            // Toggle a classe 'hidden' para mostrar ou ocultar o menu
            userMenu.classList.toggle('hidden');
        });
    });
</script>

  </header>
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <div class="flex justify-center">
            <a href="formCurso.php" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:bg-green-600 focus:outline-none focus:shadow-outline-green active:bg-green-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Adicionar Curso
            </a>
        </div>
    
</head>
<body>
    <h1>Lista de Cursos</h1>

    <div class="overflow-x-auto">
        <table class="w-80% mx-auto my-20 table-auto">
            <thead>
                <tr>
                    <th class="border bg-gray-200 p-2">ID</th>
                    <th class="border bg-gray-200 p-2">Nome</th>
                    <th class="border bg-gray-200 p-2">Categoria</th>
                    <th class="border bg-gray-200 p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'connection.php';

                // Criar um objeto de conexão
                $database = new DB();
                $conn = $database->connect();

                // Consulta ao banco de dados para obter os cursos
                $query = "SELECT id, nome, categoria_id FROM cursos";
                $stmt = $conn->prepare($query);
                $stmt->execute();

                // Exibir a lista de cursos em forma de tabela
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $id_curso = $row['id'];
                    $nome_curso = $row['nome'];
                    $categoria_id = $row['categoria_id'];

                    // Consulta para obter o nome da categoria
                    $query_categoria = "SELECT nome FROM categorias WHERE id = :categoria_id";
                    $stmt_categoria = $conn->prepare($query_categoria);
                    $stmt_categoria->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
                    $stmt_categoria->execute();
                    $categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC);
                    $nome_categoria = ($categoria && isset($categoria['nome'])) ? $categoria['nome'] : "Não especificado";

                    // Exibir os cursos como linhas de tabela com links clicáveis e botões de editar/eliminar
                    echo "<tr>";
                    echo "<td class='border p-2'>$id_curso</td>";
                    echo "<td class='border p-2'><a href='listarAula.php?id_curso=$id_curso' class='text-black'>$nome_curso</a></td>";
                    echo "<td class='border p-2'>$nome_categoria</td>";
                    echo "<td class='border p-2'>
                            <a href='editarCurso.php?id_curso=$id_curso' class='btn-editar inline-block bg-blue-500 text-white rounded-full px-3 py-1 hover:bg-blue-600 transition duration-300 text-center'>Editar 🖊️</a>
                            <a href='teste.php?id_curso=$id_curso' class='btn-eliminar inline-block bg-red-500 text-white rounded-full px-3 py-1 hover:bg-red-600 transition duration-300 text-center'>Eliminar 🗑️</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

  </main>
</div>
<?php include 'footer.php';  ?>

