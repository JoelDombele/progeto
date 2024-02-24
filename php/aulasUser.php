<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
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
<body class="bg-gray-100 p-8">

    <h1 class="text-3xl font-bold mb-6">Aulas do Curso</h1>

    <main>
        <ul class="space-y-4">
            <?php
            require_once 'connection.php';

            // Verificar se o ID do curso está presente na URL
            if (isset($_GET['id_curso'])) {
                $id_curso = $_GET['id_curso'];

                // Criar um objeto de conexão
                $database = new DB();
                $conn = $database->connect();

                // Consulta ao banco de dados para obter as aulas do curso específico
                $stmt = $conn->prepare("SELECT id, nome, link_aula, video FROM aulas WHERE curso_id = :id_curso");
                $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
                $stmt->execute();
                $aulas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Exibir a lista de aulas do curso específico
                foreach ($aulas as $aula) {
                    $nome_aula = htmlspecialchars($aula['nome']);
                    $link_aula = htmlspecialchars($aula['link_aula']);
                    $video = $aula['video']; // Não precisa de htmlspecialchars para HTML

                    echo "<li class='hover:bg-gray-200 p-2 rounded transition duration-300'>
                            <a href='$link_aula' class='block'>$nome_aula</a>";

                    // Adicionar a condição para verificar se há um vídeo disponível
                    if (!empty($video)) {
                        echo "<div class='mt-2'>$video</div>";
                    }

                    echo "</li>";
                }
            } else {
                echo "<p class='text-red-500'>ID do curso não fornecido.</p>";
            }
            ?>
        </ul>
    </main></body>

</html>
