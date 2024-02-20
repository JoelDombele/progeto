<?php
session_start();

require_once 'connection.php';

function dd($value) {
    echo ("<pre>");
    var_dump($value);
    echo ("</pre>");
    die();
}

// Verificar se o formulário foi enviado usando o método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados do formulário
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['senha']) ? $_POST['senha'] : null;

    // Verificar se as chaves estão definidas
    if ($email !== null && $password !== null) {
        try {
            $database = new DB();
            $conn = $database->connect();
        } catch (\Throwable $e) {
            die("Erro ao conectar ao banco de dados: {$e}");
        }

        try {
            $query = "SELECT * FROM usuario WHERE email = :email";

            // Preparar a consulta
            $stmt = $conn->prepare($query);

            // Executar a consulta com os parâmetros
            $stmt->execute(['email' => $email]);

            // Buscar o usuário no banco
            $usuario = $stmt->fetch();
            // Caso não for encontrado nenhum usuário, $usuario = false
            if (!$usuario) {
                $dialogIcon = "&#x26A0;&#xFE0F;";
                $dialogTitle = "Erro";
                $dialogMessage = "Usuario Não Encontrado.";

                include 'dialog.php';
                
            } else {
                // Verifica se a senha bate com a Hash
                if (password_verify($password, $usuario['senhaHash'])) {
                    $_SESSION['usuario'] = [
                        'id' => $usuario['id'],
                        'email' => $usuario['email']
                    ];
                   // $_SESSION['usuario_nome'] = $usuario['nome'];

                    header("location: index.php");
                } else {
                    $dialogIcon = "&#x26A0;&#xFE0F;";
                    $dialogTitle = "Erro";
                    $dialogMessage = "Senha Incorreta.";
                
                    include 'dialog.php';
                }
            }
        } catch (\Throwable $e) {
            die("Erro ao autenticar usuário: {$e}");
        }
    } else {
        echo "Dados do formulário não estão presentes.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Adicione a referência ao arquivo CSS do Tailwind -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <form method="post" class="bg-white p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
        <div class="mb-6">
            <h1 class="text-3xl font-bold mb-4">Login</h1>
            <input type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Email" name="email">
        </div>

        <div class="mb-6">
            <input type="password" class="w-full p-2 border border-gray-300 rounded" placeholder="Senha" name="senha">
        </div>

        <div class="mb-6">
            <input type="submit" value="Entrar" name="login" class="w-full bg-blue-500 text-white p-2 rounded cursor-pointer">
        </div>

        <p>Não tem uma conta? <a href="cadastrar.php" class="text-blue-500">Registre-se</a></p>
    </form>

</body>
</html>


</form>
</body>
</html>



