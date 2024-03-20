<?php
require_once 'connection.php';

// Criar um objeto de conexão
$database = new DB();
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Criar um novo registro
    if (isset($_POST['confirmar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Validação do nome
        if (strlen($nome) < 5) {
            echo "O nome deve ter pelo menos 5 caracteres.";
            exit;
        }

        // Validação do e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "O e-mail é inválido.";
            exit;
        }

        // Validação da senha
        if (strlen($senha) < 8) {
            echo "A senha deve ter pelo menos 8 caracteres.";
            exit;
        }

        // Criptografar a senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senhaHash) VALUES (:nome, :email, :senhaHash)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senhaHash', $senhaHash);

        if ($stmt->execute()) {
            if (isset($_POST['submit'])) {
                $dialogIcon = "&#x2705;";
                $dialogTitle = "cadastro Realizado ";
                $dialogMessage = "Cadastro feito com sucesso.";

    include 'dialog.php';
            }
        } else {
            echo 'Erro ao criar registro.';
        }
    }
}
?>
<?php include 'viewCadastrar.html'; ?>
