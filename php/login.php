<?php
session_start();

require_once 'connection.php';

$database = new DB();
$conn = $database->connect();

// Verificar se o formulário foi enviado usando o método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados do formulário
    $username = isset($_POST['nome']) ? $_POST['nome'] : null;
    $password = isset($_POST['senha']) ? $_POST['senha'] : null;

    // Verificar se as chaves estão definidas
    if ($username !== null && $password !== null) {
        // Consultar o banco de dados para verificar as credenciais
        $sql = "SELECT usuario_id, senha FROM usuario WHERE nome = :nome";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $username);
        $stmt->execute();

        $errorInfo = $stmt->errorInfo();
if ($errorInfo[0] !== '00000') {
    echo "Erro na execução da consulta SQL: " . $errorInfo[2];
    exit();
}

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verificar a senha (use uma função de hash segura, como password_hash())
            if (password_verify($password, $row['senha'])) {
                // Credenciais válidas, criar uma sessão
                $_SESSION['user_id'] = $row['usuario_id'];
                header("Location: pagina_inicial.php"); // Redirecionar para a página inicial após o login
                exit();
            } else {
                echo "Senha incorreta.";
            }
        } else {
            echo "Usuário não encontrado.";
        }
    } else {
        echo "Dados do formulário não estão presentes.";
    }
}

$conn = null; // Fechar a conexão
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
    <input type="text"  placeholder="Nome_Usuario" name="nome">
    <br><br>
    <input type="password" placeholder="Senha" name="senha">
    <br><br>
    <input type="submit" value="Entrar" name="login" >
    <p>Tens uma conta ? <a href="../php/cadastrar.php">Registra-te</a></p>
    </div>


</form>
</body>
</html>



