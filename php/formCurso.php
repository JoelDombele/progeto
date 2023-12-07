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
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/suzana.css">
</head>
<body class="view">
    <div class="form">
    <h1>Cadastrar Cursos</h1>
    <form action="teste.php" method="post" enctype="multipart/form-data">
        <label for="nome_curso">Nome do curso</label><br>
        <input type="text" required name="nome_curso"><br><br>

        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
         <?php 
         // Cria as opções do select
         foreach ($categorias as $categoria) {
                echo "<option value=\"{$categoria['id']}\">{$categoria['nome']}</option>";
            } ?>
        </select><br><br>

        <label for="descricao">Descrição </label><br>
        <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea><br><br>

        <label for="instrutor">Instrutor</label>
        <select name="instrutor" id="instrutor">
            <!-- Aqui devem ser listados os instrutores -->
            <option value="1">Instrutor 1</option>
            <option value="2">Instrutor 2</option>
            <option value="3">Instrutor 3</option>
            <!-- Adicione os instrutores dinamicamente aqui -->
        </select><br><br>

        <label for="imagem">Imagem de capa</label><br><br>
        <input type="file" name="imagem" id="imagem" required><br><br>

        <input type="submit" value="Enviar" name="confirmar">
    </form>
    </div>  
</body>
</html>
