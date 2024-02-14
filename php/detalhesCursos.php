<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
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
                            <p class="text-sm text-gray-600">Acessos: <?php echo $curso['visualizacoes']; ?></p>
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
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300" id="inscreverButton">Inscrever</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Caixa de diálogo -->
            <div id="dialog" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50">
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-8 rounded text-center">
                    <span id="closeDialogBtn" class="absolute top-2 right-2 text-xl cursor-pointer">&times;</span>
                    
                <h1 class="text-2xl font-bold mb-4">Login Necessário</h1>
                <p class="mb-4">Você precisa fazer login para comprar este curso.</p>
                <a href="login.php" class="text-blue-500 hover:underline">Faça Login</a>
                </div>
            </div>

            <!-- Adicione o script para mostrar e ocultar a caixa de diálogo -->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const openDialogBtn = document.getElementById("inscreverButton");
                    const closeDialogBtn = document.getElementById("closeDialogBtn");
                    const dialog = document.getElementById("dialog");

                    openDialogBtn.addEventListener("click", function (event) {
                        <?php if (!isset($_SESSION['usuario'])) : ?>
                            event.preventDefault(); // Impede o envio imediato do formulário
                            dialog.classList.remove('hidden');
                        <?php else : ?>
                            // Redirecionar para a página de compra se o usuário estiver logado
                            window.location.href = 'processar_compra.php?id_curso=<?php echo $id_curso; ?>';
                        <?php endif; ?>
                    });

                    closeDialogBtn.addEventListener("click", function () {
                        dialog.classList.add('hidden');
                    });
                });
            </script>
    <?php
        } else {
            echo "<p class='text-center text-red-500'>Curso não encontrado.</p>";
        }
    } else {
        echo "<p class='text-center text-red-500'>ID do curso não fornecido.</p>";
    }
    ?>
</body>

</html>
