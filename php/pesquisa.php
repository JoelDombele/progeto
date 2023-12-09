<style>
    /* Estilos básicos para a lista de cursos */
.courses-list {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: 0 auto;
}

.course {
  width: 300px;
  margin: 20px;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  text-align: center;
}

.course img {
  width: 100%;
  height: 250px;
  border-radius: 5px;
}

.course h2 {
  margin-top: 10px;
  font-size: 1.5em;
}

.course p {
  margin-top: 5px;
  font-size: 1em;
}

.course a {
  display: inline-block;
  margin-top: 10px;
  padding: 8px 20px;
  background-color: #007bff;
  color: white;
  text-decoration: none;
  border-radius: 3px;
  transition: background-color 0.3s ease;
}

.course a:hover {
  background-color: #0056b3;
}

</style>

<?php
require_once 'connection.php';

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
    }else {
        // Redireciona de volta para a página inicial se não houver termo de pesquisa
        header("Location: homePage.php");
        exit();
    }


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $foto = $row['imagem'];
        $nome = $row['nome'];
        echo '<div class="courses-list">';
        echo '<div class="course">';
        echo '<img src="../imagens/' . $foto . '" alt="Imagem do Curso">';
        echo '<h2>' . $nome . '</h2>';
        echo '<p>' . $row['descricao'] . '</p>';
        echo '<a href="course.php?id=' . $row['id'] . '">Saiba mais</a>';
        echo '</div>';
        echo '</div>';
    }

   
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
