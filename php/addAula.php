<?php
require_once 'connection.php';

// Verificar se o ID do curso está presente na URL
if (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];

    function uploadVideo($arquivo, $diretorioDestino) {
        if (isset($arquivo['name']) && isset($arquivo['tmp_name'])) {
            $nomeArquivo = $arquivo['name'];
            $caminhoTemporario = $arquivo['tmp_name'];
            $caminhoDestino = $diretorioDestino . '/' . $nomeArquivo;
    
            // Verifica se o arquivo é um vídeo válido
            $extensoesPermitidas = array('mp4', 'avi', 'mov', 'webm');
            $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
            if (!in_array($extensao, $extensoesPermitidas)) {
                return "Erro: O arquivo enviado não é um vídeo válido.";
            }
    
            // Move o arquivo para o diretório de destino
            if (move_uploaded_file($caminhoTemporario, $caminhoDestino)) {
                return $nomeArquivo;
            } else {
                return "Erro ao fazer upload de vídeo.";
            }
        } else {
            return "Erro: Dados do arquivo não estão presentes.";
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $database = new DB();
        $conn = $database->connect();
    
        // Valida os dados do formulário
        $nome_aula = trim($_POST["nome_aula"]);
        $descricao_aula = trim($_POST["descricao_aula"]);
        $link_aula = trim($_POST["link_aula"]);
        $curso_id = $_POST["curso_id"];
    
        $video = $_FILES["video"];
    
        // ... (código de validação dos campos do formulário) ...
    
        if (empty($nome_aula) || empty($link_aula) || $video["error"] !== UPLOAD_ERR_OK || $video["size"] > 100000000) {
            echo "Erro nos dados do formulário:<br>";
        
            if (empty($nome_aula)) {
                echo "Nome da aula não preenchido.<br>";
            }
        
            if (empty($link_aula)) {
                echo "Link da aula não preenchido.<br>";
            }
        
            if ($video["error"] !== UPLOAD_ERR_OK) {
                echo "Erro no upload do vídeo. Código de erro: " . $video["error"] . "<br>";
            }
        
            if ($video["size"] > 100000000) {
                echo "Tamanho do vídeo excede o limite permitido (100 MB). Tamanho atual: " . $video["size"] . " bytes<br>";
            }
        
            echo "Informações de Depuração:<br>";
            echo "Nome da Aula: " . $nome_aula . "<br>";
            echo "Link da Aula: " . $link_aula . "<br>";
            echo "Erro no upload do vídeo: " . $video["error"] . "<br>";
            echo "Tamanho do vídeo: " . $video["size"] . " bytes<br>";
            exit;
        }
        
        // Executa a função de upload do vídeo
        $arquivoVideo = $_FILES['video'];
        $diretorioDestinoVideo = '/var/www/html/progeto/videos'; // Substitua pelo seu diretório real
        $resultadoUploadVideo = uploadVideo($arquivoVideo, $diretorioDestinoVideo);
    
        // Verifica o resultado do upload do vídeo
        if (strpos($resultadoUploadVideo, 'Erro') !== false) {
            echo $resultadoUploadVideo;
            exit;
        }
    
        // Restante do código para inserir os dados na tabela 'aulas' no banco de dados
        // ...
    
        // Inserir os dados na tabela 'aulas' no banco de dados usando uma consulta SQL INSERT
        $query = "INSERT INTO aulas (nome, descricao, link_aula, video, curso_id) VALUES (:nome, :descricao, :link_aula, :video, :curso_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome_aula);
        $stmt->bindParam(':descricao', $descricao_aula);
        $stmt->bindParam(':link_aula', $link_aula);
        $stmt->bindParam(':video', $resultadoUploadVideo); // Use o resultado do upload
        $stmt->bindParam(':curso_id', $curso_id);
    
        // Execute a query
        $stmt->execute();
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/suzana.css">
</head>

<body class="view">
    <div class="form">
        <h1>Adicionar Aulas</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nome_aula">Título da Aula:</label>
            <input type="text" id="nome_aula" name="nome_aula" required><br><br>

            <label for="descricao_aula">Descrição da Aula:</label><br>
            <textarea id="descricao_aula" name="descricao_aula" rows="4" cols="50"></textarea><br><br>

            <label for="link_aula">Link da Aula:</label>
            <input type="text" id="link_aula" name="link_aula" required><br><br>

            <label for="video">Vídeo da Aula:</label>
            <input type="file" name="video" accept="video/*" required><br><br>

            <input type="hidden" name="curso_id" value="<?php echo $_GET['id_curso']; ?>">
            <input type="submit" value="Adicionar Aula">
        </form>
    </div>
</body>

</html>
