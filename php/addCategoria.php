<?php
    require_once 'connection.php';

    $mensagem = ""; // Inicializa a variável de mensagem

    // Criar um objeto de conexão
    $database = new DB();
    $conn = $database->connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica se o botão 'add' foi acionado
        if (isset($_POST['add'])) {
            $nome_categoria = $_POST['nome_categoria'];
            $desc_categoria = $_POST['desc_categoria'];

            $stmt = $conn->prepare("INSERT INTO categorias (nome, descricao) VALUES (:nome_categoria, :desc_categoria)");
            $stmt->bindParam(':nome_categoria', $nome_categoria);
            $stmt->bindParam(':desc_categoria', $desc_categoria);

            if ($stmt->execute()) {
                $mensagem = "Cadastro feito com sucesso !";
            } else {
                $mensagem = "Erro ao criar registro.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/suzana.css">
</head>
<body class="view">
    <div class="form">
        <h1>Adicionar Categoria</h1>
    <?php if (!empty($mensagem)) : ?>
        <script type='text/javascript'>alert('<?php echo $mensagem; ?>');</script>
    <?php endif; ?>
    <form action="" method="post">
        <label for="nome_categoria">Nome da Categoria</label><br>
        <input type="text" name="nome_categoria"><br><br>

        <label for="desc_categoria">Descrição</label><br>
        <textarea name="desc_categoria" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Adicionar" name="add">
    </form> 
    </div>
</body>
</html>
