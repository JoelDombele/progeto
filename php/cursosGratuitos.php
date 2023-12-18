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
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tipo_curso'])) {
        $tipos = $_GET['tipo_curso'];

        // Prepara uma string com placeholders para os valores
        $placeholders = implode(',', array_fill(0, count($tipos), '?'));

        // Cria a consulta SQL usando IN com os placeholders
        $sql = "SELECT id, nome, descricao, imagem FROM cursos WHERE tipo_curso IN ($placeholders)";
        $stmt = $conn->prepare($sql);

        // Executa a consulta usando os valores selecionados
        $stmt->execute($tipos);

        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<title>Lista de Cursos</title>';
        echo '<link rel="stylesheet" href="styles.css">';
        echo '</head>';
        echo '<body>';
        echo '<div class="courses-list">';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $foto = $row['imagem'];
            $nome = $row['nome'];

            echo '<div class="course">';
            echo '<img src="../imagens/' . $foto . '" alt="Imagem do Curso">';
            echo '<h2>' . $nome . '</h2>';
            echo '<p>' . $row['descricao'] . '</p>';
            echo '<a href="aulasUser.php?id_curso=$id_curso"> Começar </a>';
            echo '</div>';
        }

        echo '</div>';
        echo '</body>';
        echo '</html>';
    } else {
        echo "Nenhum dado recebido do formulário.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>