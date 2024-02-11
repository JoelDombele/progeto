<?php
require_once 'connection.php';

// Inicie ou retome a sessão
session_start();

// Verifique se o usuário está autenticado
$id_curso = $_POST['id_curso'];
if (!isset($_SESSION['usuario_id'])) {
    header("Location: detalhesCursos.php?id_curso=$id_curso");

    exit(); // Encerre o script se o usuário não estiver autenticado
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_curso']) && isset($_POST['preco_curso'])) {
        $id_curso = $_POST['id_curso'];
        $preco_curso = $_POST['preco_curso'];

        // Obtém o ID do usuário a partir da sessão
        $usuario_id = $_SESSION['usuario_id'];

        // Adicione a compra ao banco de dados
        $database = new DB();
        $conn = $database->connect();

        $stmt = $conn->prepare("INSERT INTO inscricoes (curso_id, usuario_id) VALUES (:curso_id, :usuario_id)");
        $stmt->bindParam(':curso_id', $id_curso, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        // Adicione sua lógica de processamento de pagamento aqui (gateway de pagamento, etc.)

        echo "Inscrição realizada com sucesso! Acesse seu curso agora.";
    } else {
        echo "ID ou preço do curso não fornecido no formulário.";
    }
} else {
    echo "Acesso inválido ao script.";
}
?>
