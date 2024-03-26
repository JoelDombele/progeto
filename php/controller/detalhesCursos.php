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

    $stmt = $conn->prepare("SELECT c.id, c.nome, c.descricao, c.imagem, c.instrutor_id, c.visualizacoes, c.preco_curso, i.nome as nome_instrutor, i.email as email FROM cursos c INNER JOIN instrutores i ON c.instrutor_id = i.instrutor_id WHERE c.id = :id_curso");
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->execute();
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($curso) {
        // Função para verificar se o usuário está inscrito
        function verificarSeUsuarioEstaInscrito($curso_id, $usuario_id) {
            $database = new DB();
            $conn = $database->connect();

            $stmt = $conn->prepare("SELECT COUNT(*) FROM inscricoes WHERE curso_id = :curso_id AND usuario_id = :usuario_id");
            $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->execute();

            $inscrito = $stmt->fetchColumn();

            return $inscrito > 0;
        }

        // Obtenha o ID do usuário se estiver autenticado
        $usuario_id = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : null;

        // Verifique se o usuário está inscrito
        $usuarioInscrito = verificarSeUsuarioEstaInscrito($curso['id'], $usuario_id);

        // Determine a classe CSS e o texto do botão com base na condição
        $classeBotao = $usuarioInscrito ? 'bg-green-500 text-white' : 'bg-blue-500 text-white';
        $textoBotao = $usuarioInscrito ? 'Inscrito' : 'Inscrever';
?>
         <!-- Tela de Diálogo -->
    <div id="dialog" class="dialog-container">
        <div class="dialog-content">
            <!-- Conteúdo do Curso -->
            <div class="container mx-auto bg-white p-8 shadow-md">
                <div class="flex justify-between">
                    <div class="w-1/2">
                        <img class="w-full h-auto" src="../imagens/<?php echo $curso['imagem']; ?>" alt="Imagem do Curso">
                        <div class="mt-4">
                            <h1 class="text-2xl font-bold"><?php echo $curso['nome']; ?></h1>
                            <h2 class="text-sm text-gray-600">Instrutor: <?php echo $curso['nome_instrutor']; ?></h2>
                            <p class="text-sm text-gray-600">Email do Instrutor: <?php echo $curso['email']; ?></p>
                            <p class="text-sm text-gray-600">Acessos: <?php echo $curso['visualizacoes']; ?></p>
                            <p class="text-sm text-gray-600">Preço: $<?php echo $curso['preco_curso']; ?></p>
                        </div>
                    </div>
                    <div class="w-1/2 ml-8">
                        <h2 class="text-2xl font-bold mb-4">Descrição do Curso</h2>
                        <p class="text-sm text-gray-600"><?php echo $curso['descricao']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Botão para fechar a tela de diálogo -->
            <button id="closeDialogBtn" class="absolute top-4 right-4 text-xl cursor-pointer">&times;</button>
        </div>
    </div>

    <!-- Adicione o script para mostrar e ocultar a tela de diálogo -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const closeDialogBtn = document.getElementById("closeDialogBtn");
            const dialog = document.getElementById("dialog");

            closeDialogBtn.addEventListener("click", function () {
                dialog.classList.add('hidden');
            });
        });
    </script>



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

    <?php
session_start();

// Verificar se as variáveis de sessão estão definidas
if (isset($_SESSION['usuario'])) {
    echo "ID do Usuário: " . $_SESSION['usuario']['id'] . "<br>";
    echo "Email do Usuário: " . $_SESSION['usuario']['email'] . "<br>";
} else {
    echo "Usuário não autenticado.";
}
?>

</body>

</html>

