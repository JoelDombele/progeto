<?php
require_once 'connection.php';

// Verificar se o ID do curso está presente na URL
if (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $database = new DB();
        $conn = $database->connect();
    
        // Valida os dados do formulário
        $nome_aula = trim($_POST["nome_aula"]);
        $descricao_aula = trim($_POST["descricao_aula"]);
        $link_aula = trim($_POST["link_aula"]);
        $curso_id = $_POST["curso_id"];
        $video = trim($_POST["video"]); // Novo campo para o código de incorporação
    
        // ... (código de validação dos campos do formulário) ...
    
        if (empty($nome_aula) || empty($link_aula) || empty($video)) {
            echo "Erro nos dados do formulário:<br>";
        
            if (empty($nome_aula)) {
                echo "Nome da aula não preenchido.<br>";
            }
        
            if (empty($link_aula)) {
                echo "Link da aula não preenchido.<br>";
            }

            if (empty($video)) {
                echo "Código de Incorporação do Vídeo não preenchido.<br>";
            }
        
            // ... (adicionar outras validações conforme necessário) ...
        } else {
            // Inserir os dados na tabela 'aulas' no banco de dados usando uma consulta SQL INSERT
            $query = "INSERT INTO aulas (nome, descricao, link_aula, curso_id, video) VALUES (:nome, :descricao, :link_aula, :curso_id, :video)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nome', $nome_aula);
            $stmt->bindParam(':descricao', $descricao_aula);
            $stmt->bindParam(':link_aula', $link_aula);
            $stmt->bindParam(':curso_id', $curso_id);
            $stmt->bindParam(':video', $video);
            
            // Execute a query
            if ($stmt->execute()) {
                $dialogIcon = "&#x2705;";
                $dialogTitle = "Cadastro Realizado";
                $dialogMessage = "Cadastro feito com sucesso.";
    
                include 'dialog.php';
            } else {
                echo "Erro ao adicionar aula.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aulas</title>
    <!-- Adicione a referência ao arquivo CSS do Tailwind -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<?php include 'header.php'; ?>

<body class="view">
    <div class="flex items-center justify-center mt-12 mb-12">
        <form action="" method="post" enctype="multipart/form-data" class="bg-white p-8 rounded shadow-md w-full md:w-2/3 lg:w-1/3 xl:w-1/4">
            <div class="mb-4">
                <h1 class="text-3xl font-bold mb-4">Adicionar Aulas</h1>
                <label for="nome_aula" class="block text-sm font-semibold mb-2">Título da Aula:</label>
                <input type="text" id="nome_aula" name="nome_aula" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="descricao_aula" class="block text-sm font-semibold mb-2">Descrição da Aula:</label>
                <textarea id="descricao_aula" name="descricao_aula" rows="4" cols="50" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="link_aula" class="block text-sm font-semibold mb-2">Link da Aula:</label>
                <input type="text" id="link_aula" name="link_aula" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="video" class="block text-sm font-semibold mb-2">Vídeo da Aula:</label>
                <input type="text" id="video" name="video" class="w-full p-2 border border-gray-300 rounded" placeholder="Insira o código de incorporação do vídeo">
            </div>

            <div class="mb-4">
                <label for="video_file" class="block text-sm font-semibold mb-2">ou Envie um Vídeo:</label>
                <input type="file" name="video_file" accept="video/*" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <input type="hidden" name="curso_id" value="<?php echo isset($_GET['id_curso']) ? $_GET['id_curso'] : ''; ?>">

            <div class="mb-4">
                <input type="submit" value="Adicionar Aula" class="w-full bg-blue-500 text-white p-2 rounded cursor-pointer">
            </div>
        </form>
    </div>
</body>

<?php include 'footer.php'; ?>
