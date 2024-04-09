<?php
require_once 'connection.php';

$mensagem = ""; 

$database = new DB();
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $nome_categoria = $_POST['nome_categoria'];
        $desc_categoria = $_POST['desc_categoria'];

        $stmt = $conn->prepare("INSERT INTO categorias (nome, descricao) VALUES (:nome_categoria, :desc_categoria)");
        $stmt->bindParam(':nome_categoria', $nome_categoria);
        $stmt->bindParam(':desc_categoria', $desc_categoria);

        if ($stmt->execute()) {
            $mensagem = "Cadastro feito com sucesso!";
        } else {
            $mensagem = "Erro ao criar registro.";
        }
    }
}
?>

<?php include 'view/addCategoria.view.php' ;?>