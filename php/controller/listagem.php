<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/suzana.css">
</head>
<body>


<main >
    <?php
   require_once 'connection.php'; // Inclua a classe de conexão com o banco de dados
    
    // Criar um objeto de conexão
    $database = new DB();
    $conn = $database->connect();
    
    // Consulta para selecionar todos os usuários
    $query = "SELECT usuario_id, nome, email, senha FROM usuario";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    // Verificar se existem registros
    if ($stmt->rowCount() > 0) {
        echo "<h1>Lista de Usuários</h1>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Senha</th></tr>";
    
        // Loop para exibir os registros
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['usuario_id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['senha'] . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
    } else {
        echo "Nenhum usuário encontrado.";
    }
    ?>
</main>

</body>
</html>