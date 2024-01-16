<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Curso</title>
    <style>
       body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            margin: auto;
            display: flex;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .left-side {
            flex: 1;
            padding: 20px;
        }

        .right-side {
            flex: 1;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .course-image {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .course-info {
            margin-top: 20px;
        }

        h1, h2, p {
            margin: 0;
        }

        h1 {
            font-size: 1.5em;
            color: #333;
        }

        h2 {
            font-size: 1.2em;
            color: #555;
        }

        p {
            font-size: 0.9em;
            color: #777;
        }
        .buy-button {
            margin-top: 20px;
            text-align: right;
            
        }

        .buy-button a {
            padding: 10px 20px;
            background-color: #e44d26;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            text-decoration: none;
        }
        .buy-button a:hover {
            background-color: #333;
        }

    </style>
</head>
<body>
    <?php
        require_once 'connection.php';

        // Verificar se o ID do curso está presente na URL
        if (isset($_GET['id_curso'])) {
            $id_curso = $_GET['id_curso'];

            // Criar um objeto de conexão
            $database = new DB();
            $conn = $database->connect();

            // Consulta ao banco de dados para obter as informações do curso específico
            $stmt = $conn->prepare("SELECT id, nome, descricao, imagem, instrutor_id, visualizacoes, PrecoCurso FROM cursos WHERE id = :id_curso");
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->execute();
            $curso = $stmt->fetch(PDO::FETCH_ASSOC);

            // Exibir os detalhes do curso
            if ($curso) {
                echo '<div class="container">';
                echo '<div class="left-side">';
                echo '<img class="course-image" src="../imagens/' . $curso['imagem'] . '" alt="Imagem do Curso">';
                echo '<div class="course-info">';
                echo '<h1>' . $curso['nome'] . '</h1>';
                echo '<h2>Instrutor: ' . $curso['instrutor_id'] . '</h2>';
                echo '<p>Visualizações: ' . $curso['visualizacoes'] . '</p>';
                echo '<p>Preço: $' . $curso['PrecoCurso'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '<div class="right-side">';
                echo '<h2>Descrição do Curso</h2>';
                echo '<p>' . $curso['descricao'] . '</p>';
                echo '<div class="buy-button">';
                echo '<a href="#">Adicionar ao Carrinho</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } else {
                echo "<p>Curso não encontrado.</p>";
            }
        } else {
            echo "<p>ID do curso não fornecido.</p>";
        }
    ?>
    
</html>
