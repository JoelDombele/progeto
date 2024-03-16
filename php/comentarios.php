<?php
// Arquivo: post_comment.php
session_start();
require_once 'connection.php';

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $aula_id = $_POST['aula_id'];
    $user_id = $_POST['user_id']; // Supondo que você tenha o ID do usuário disponível
    $comment = $_POST['comment'];

    // Criar um objeto de conexão
    $database = new DB();
    $conn = $database->connect();

    // Preparar a consulta SQL
    $stmt = $conn->prepare("INSERT INTO comentarios (aula_id, usuario_id, comment) VALUES (:aula_id, :user_id, :comment)");

    // Vincular os parâmetros
    $stmt->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

    // Executar a consulta
    if ($stmt->execute()) {
        // Redirecionar de volta para a página da aula
        header("Location: aulasUser.php?aula_id=$aula_id");
    } else {
        echo "Erro ao postar o comentário.";
    }
} else {
    echo "Nenhum comentário para postar.";
}
?>
