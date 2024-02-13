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
                echo "Usuário não encontrado.";
            } else {
                // Verifica se a senha bate com a Hash
                if (password_verify($password, $usuario['senhaHash'])) {
                    $_SESSION['usuario'] = [
                        'id' => $usuario['id'],
                        'email' => $usuario['email']
                    ];
                    header("location: lar.php");
                } else {
                    echo "Senha incorreta.";
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
    <title>DocumeRent</title>
    <link rel="stylesheet" href="../css/suzana.css">
</head>
<body class="view">
<form  method="post">


<div class="form">
    <h1>Login</h1>
    <input type="text"  placeholder="Email" name="email">
    <br><br>
    <input type="password" placeholder="Senha" name="senha">
    <br><br>
    <input type="submit" value="Entrar" name="login" >
    <p>Tens uma conta ? <a href="../php/cadastrar.php">Registra-te</a></p>
    </div>


</form>
</body>
</html>



