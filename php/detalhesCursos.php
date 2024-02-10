<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Curso</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
require_once 'connection.php';


if (isset($_GET['id_curso'])) {
    $id_curso = $_GET['id_curso'];

    $database = new DB();
    $conn = $database->connect();

    $stmt = $conn->prepare("SELECT id, nome, descricao, imagem, instrutor_id, visualizacoes, preco_curso FROM cursos WHERE id = :id_curso");
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->execute();
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($curso) {
        ?>
        <div class="container mx-auto bg-white p-8 shadow-md my-8">
            <div class="flex justify-between">
                <div class="w-1/2">
                    <img class="w-full h-auto" src="../imagens/<?php echo $curso['imagem']; ?>" alt="Imagem do Curso">
                    <div class="mt-4">
                        <h1 class="text-2xl font-bold"><?php echo $curso['nome']; ?></h1>
                        <h2 class="text-sm text-gray-600">Instrutor: <?php echo $curso['instrutor_id']; ?></h2>
                        <p class="text-sm text-gray-600">Visualizações: <?php echo $curso['visualizacoes']; ?></p>
                        <p class="text-sm text-gray-600">Preço: $<?php echo $curso['preco_curso']; ?></p>
                    </div>
                </div>
                <div class="w-1/2 ml-8">
                    <h2 class="text-2xl font-bold mb-4">Descrição do Curso</h2>
                    <p class="text-sm text-gray-600"><?php echo $curso['descricao']; ?></p>

                    <!-- Adicionando formulário para comprar o curso -->
                    <form method="post" action="processar_compra.php" class="mt-4">
                        <input type="hidden" name="id_curso" value="<?php echo $curso['id']; ?>">
                        <input type="hidden" name="preco_curso" value="<?php echo $curso['preco_curso']; ?>">
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Comprar Curso</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "<p class='text-center text-red-500'>Curso não encontrado.</p>";
    }
} else {
    echo "<p class='text-center text-red-500'>ID do curso não fornecido.</p>";
}
?>
</html>
