<?php
require_once 'connection.php';
include('header.php'); // Inclua o cabeçalho

$database = new DB();
$conn = $database->connect();

try {
    $stmt = $conn->prepare("SELECT id, nome, descricao, imagem FROM cursos");
    $stmt->execute();

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $stmt = $conn->prepare("SELECT id, nome, descricao, imagem FROM cursos WHERE nome LIKE :search");
        $stmt->bindValue(':search', "%$search%");
        $stmt->execute();
    } else {
        // Redireciona de volta para a página inicial se não houver termo de pesquisa
        header("Location: homePage.php");
        exit();
    }

    echo '<div class="flex flex-wrap justify-center gap-4 mt-8">';
    echo '<p class="text-black text-4xl font-bold mb-8 mt-30 text-center w-full">Cursos Encontrados</p>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $foto = $row['imagem'];
        $nome = $row['nome'];
        $descricao = $row['descricao'];

        echo '<div class="course-card bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105 w-64">';
        echo '<img class="w-full h-32 object-cover mb-4" src="../imagens/' . $foto . '" alt="Imagem do Curso">';
        echo '<h2 class="text-lg font-semibold mb-2">' . $nome . '</h2>';
        echo '<p class="text-gray-600 mb-2">' . $descricao . '</p>';
        echo '<a href="course.php?id=' . $row['id'] . '" class="block bg-blue-500 text-white rounded-full px-3 py-1 hover:bg-blue-600 transition duration-300 text-center">Saiba Mais</a>';
        echo '</div>';
    }

    echo '</div>';
} catch (PDOException $e) {
    // Tratar exceções aqui, se necessário
    echo "Erro: " . $e->getMessage();
}

include('footer.php'); // Inclua o rodapé
?>
