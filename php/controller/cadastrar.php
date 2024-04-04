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

        // Validação do nome,Email e Senha
        $errors = [];

        if (strlen($nome) < 5) {
            $errors['nome'] = "O nome deve ter pelo menos 5 caracteres.";
            
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email invalido";
           
        } elseif (strlen($senha) < 8) {
            $errors['senha'] = "A senha deve ter pelo menos 8 caracteres.";
            
        }elseif(empty($errors)){
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
             header('Location: /index');
            }
        } else {
            echo 'Erro ao criar registro.';
        }
    }
}

        }
?>
<?php include '../view/viewCadastrar.php'; ?>
