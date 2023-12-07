
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

        $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
          if (isset($_POST['submit'])) {
            $mensagem ="Cadastro feito com sucesso !";
            echo"<script type='text/javascript'> alert('$mensagem ');</script>";
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
  <title>Document</title>
</head>
<body class="view">
<main>



<form  method="post">

   <div class="form">
        <h1>Registra-te</h1>
        <input type="text" name="nome" required placeholder="Nome">
        <br><br>
        <input type="email" name="email" required placeholder="Email">
        <br><br>
        <input type="password" name="senha" required placeholder="Senha">
        <br><br>

        <input type="submit" value="Enviar" name="confirmar">
         
        
        </div>


</form>
</main>
</body>
</html>
