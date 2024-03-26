<?php

require_once 'connection.php';
$database = new DB();
$conn = $database->connect();


if (isset($_GET['id_curso'])) {
    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $curso_id = $_GET['id_curso'];

        $stmt = $conn->prepare("UPDATE cursos SET visualizacoes = visualizacoes + 1 WHERE id = :id");
        $stmt->bindParam(':id', $curso_id);
        $stmt->execute();

        // Redireciona para outra página após atualizar o contador
        header("Location: detalhesCursos.php?id_curso=$curso_id");
        exit();
    } catch(PDOException $e) {
        echo "Erro ao atualizar contador de visualizações: " . $e->getMessage();
    }
    $conn = null;
} else {
    echo "ID do curso não fornecido.";
}
?>
<