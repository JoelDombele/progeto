<?php

require_once("connection.php");

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Validar e limpar a entrada
        $email = trim($email);
        $senha = trim($senha);

        $database = new DB();
        $conn = $database->connect();

        // Use uma cláusula WHERE para verificar a combinação de email e senha_hash
        $query = "SELECT email, senha FROM usuario WHERE email = :email";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $result['senha'])) {
                header("Location: ../php/dashboard.php");
                exit;
            } else {
                $error = "A senha está incorreta.";
            }
        } else {
            $error = "O email não está cadastrado.";
        }
    }
}
?>

<!-- Exibir mensagem de erro, se houver -->
<?php if ($error): ?>
    <p><?= $error ?></p>
<?php endif; ?>    
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
    <input type="email"  placeholder="Email" name="email">
    <br><br>
    <input type="password" placeholder="Senha" name="senha">
    <br><br>
    <input type="submit" value="Entrar" name="login" >
    <p>Tens uma conta ? <a href="../php/cadastrar.php">Registra-te</a></p>
    </div>


</form>
</body>
</html>



