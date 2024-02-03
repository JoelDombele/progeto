<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas do Curso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        main {
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a.btn-add {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a.btn-add:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Aulas do Curso</h1>

    <main>
        <a href="addAula.php?id_curso=<?php echo $_GET['id_curso']; ?>" class="btn-add">Adicionar Aula</a>

        <ul>
            <?php
            require_once 'connection.php';

            // Verificar se o ID do curso está presente na URL
            if (isset($_GET['id_curso'])) {
                $id_curso = $_GET['id_curso'];

                // Criar um objeto de conexão
                $database = new DB();
                $conn = $database->connect();

                // Consulta ao banco de dados para obter as aulas do curso específico
                $stmt = $conn->prepare("SELECT id, nome, link_aula FROM aulas WHERE curso_id = :id_curso");
                $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
                $stmt->execute();
                $aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Exibir a lista de aulas do curso específico
                foreach ($aulas as $aula) {
                    $nome_aula = htmlspecialchars($aula['nome']); // Sanitização para evitar problemas de segurança
                    $link_aula = htmlspecialchars($aula['link_aula']);

                    echo "<li><a href='$link_aula'>$nome_aula</a></li>";
                }
            } else {
                echo "<p>ID do curso não fornecido.</p>";
            }
            ?>
        </ul>
    </main>
</body>

</html>
