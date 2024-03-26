<?php
include 'db.php';

// Criar um objeto de conexão
$database = new DB();
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Criar um novo registro
    if (isset($_POST['create'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo 'Registro criado com sucesso.';
        } else {
            echo 'Erro ao criar registro.';
        }
    }

    // Atualizar um registro
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo 'Registro atualizado com sucesso.';
        } else {
            echo 'Erro ao atualizar registro.';
        }
    }

    // Deletar um registro
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo 'Registro deletado com sucesso.';
        } else {
            echo 'Erro ao deletar registro.';
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD em PHP</title>
</head>
<body>
    <h1>CRUD em PHP com Classe de Conexão</h1>
    
    <!-- Formulário de Criação -->
    <h2>Criar Registro</h2>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="create" value="Criar">
    </form>
    
    <!-- Formulário de Atualização -->
    <h2>Atualizar Registro</h2>
    <form method="post">
        <input type="text" name="id" placeholder="ID do Registro">
        <input type="text" name="nome" placeholder="Novo Nome">
        <input type="text" name="email" placeholder="Novo Email">
        <input type="submit" name="update" value="Atualizar">
    </form>
    
    <!-- Formulário de Exclusão -->
    <h2>Deletar Registro</h2>
    <form method="post">
        <input type="text" name="id" placeholder="ID do Registro a Deletar">
        <input type="submit" name="delete" value="Deletar">
    </form>
</body>
</html>
Neste exemplo, você tem um formulário para criar, atualizar e deletar registros na tabela "usuarios". Certifique-se de substituir os valores de host, nome do banco de dados, usuário e senha em db.php com as informações do seu ambiente de banco de dados. Certifique-se também de que a tabela "usuarios" exista no banco de dados.

Esse é apenas um exemplo básico de um CRUD em PHP com uma classe de conexão. Você pode expandi-lo e melhorá-lo de acordo com suas necessidades e requisitos específicos. Certifique-se de adicionar verificações de segurança, como validação de entrada e tratamento de erros, em um ambiente de produção real.





