<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        /* Adicionando um estilo personalizado para tornar o iframe responsivo */
        .embed-responsive {
            position: relative;
            overflow: hidden;
            padding-bottom: 56.25%; /* Proporção 16:9 */
        }

        .embed-responsive iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <title>Aula do Curso</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <main class="bg-white p-8 rounded shadow-md w-full md:w-4/5 lg:w-3/4 xl:w-2/3">
        <?php
        require_once 'connection.php';

        // Verificar se o ID da aula está presente na URL
        if (isset($_GET['aula_id'])) {
            $aula_id = $_GET['aula_id'];

            // Criar um objeto de conexão
            $database = new DB();
            $conn = $database->connect();

            // Consulta ao banco de dados para obter os detalhes da aula específica
            $stmt = $conn->prepare("SELECT id, nome, link_aula, descricao, video FROM aulas WHERE id = :aula_id");
            $stmt->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);
            $stmt->execute();
            $aula = $stmt->fetch(PDO::FETCH_ASSOC);

            // Exibir os detalhes da aula
            if ($aula) {
                $nome_aula = htmlspecialchars($aula['nome']);
                $link_aula = htmlspecialchars($aula['link_aula']);
                $descricao = htmlspecialchars($aula['descricao']);
                $video = $aula['video']; // Não precisa de htmlspecialchars para HTML

                echo "<h1 class='text-2xl font-bold mb-4'>$nome_aula</h1>";
                echo "<p class='mb-4'>$descricao</p>";
                
                // Adicione o vídeo incorporado usando o link da aula
                echo "<div class='embed-responsive'>
                        $video
                      </div>";
            } else {
                echo "<p class='text-red-500'>Aula não encontrada.</p>";
            }
        } else {
            echo "<p class='text-red-500'>ID da aula não fornecido.</p>";
        }
        ?>
        <a href="<?php echo $link_aula; ?>" target="_blank" class="block mt-4 bg-blue-500 text-white p-2 rounded cursor-pointer text-center">Ver Aula em Texto</a>
    </main>

</body>

</html>
