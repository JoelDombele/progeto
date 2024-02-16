
<link rel="stylesheet" href="../css/suzana.css">
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
                $mensagem = "Cadastro feito com sucesso!";
                echo "<script type='text/javascript'> alert('$mensagem');</script>";
            }
        } else {
            echo 'Erro ao criar registro.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Adicione a referência ao arquivo CSS do Tailwind -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        /* Adicione estilos personalizados aqui, se necessário */
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <main class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
        <form method="post" class="bg-white p-8 rounded shadow-md">
            <div class="mb-6">
                <h1 class="text-3xl font-bold mb-4">Registra-te</h1>
                <input type="text" class="w-full p-2 border border-gray-300 rounded" name="nome" required placeholder="Nome">
            </div>

            <div class="mb-6">
                <input type="email" class="w-full p-2 border border-gray-300 rounded" name="email" required placeholder="Email">
            </div>

            <div class="mb-6">
                <input type="password" class="w-full p-2 border border-gray-300 rounded" name="senha" required placeholder="Senha">
            </div>

            <div class="mb-6">
                <input type="submit" value="Enviar" name="confirmar" class="bg-blue-500 text-white p-2 rounded cursor-pointer">
            </div>
        </form>
    </main>

</body>
</html>
