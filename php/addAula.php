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

<?php include 'viewAddAula.php';?>