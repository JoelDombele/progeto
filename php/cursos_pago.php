<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $preco = $_POST['preco'];
    $duracao = $_POST['duracao'];

    // Verifica se o ID do curso foi passado pela URL
    if(isset($_GET['curso_id'])) {
        $curso_id = $_GET['curso_id'];

        // Conexão com o banco de dados
        $database = new DB();
        $conn = $database->connect();

        try {
            // Insere os dados do curso pago na tabela 'curso_pago'
            $stmt = $conn->prepare("INSERT INTO curso_pago (curso_id, preco, duracao) VALUES (:curso_id, :preco, :duracao)");
            $stmt->bindParam(':curso_id', $curso_id);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':duracao', $duracao);
            $stmt->execute();

            echo "Curso pago registrado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "ID do curso não fornecido.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Cursos Pagos</title>
    <link rel="stylesheet" href="../css/suzana.css">
</head>
<body>
    <div class="form">
    <h2>Detalhes do Curso</h2>
    <form action="/processar_dados_do_formulario" method="post">
    <label for="preco">Preço:</label>
    <input type="number" id="preco" name="preco" required><br><br>

    <label for="duracao">Duração:</label>
    <input type="text" id="duracao" name="duracao" required><br><br>

    <input type="submit" value="Enviar">
</form>

    </div>
</body>
</body>
</html>