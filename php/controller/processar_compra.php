<?php
session_start();
require_once 'connection.php';

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: detalhesCursos.php?id_curso={$_POST['id_curso']}");
    exit(); // Encerre o script se o usuário não estiver autenticado
}

// Verificar se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_curso = $_POST['id_curso'];
    $preco_curso = $_POST['preco_curso'];
    $usuario_id = $_SESSION['usuario']['id'];

    // Verificar se o usuário já está inscrito no curso
    $database = new DB();
    $conn = $database->connect();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM inscricoes WHERE curso_id = :curso_id AND usuario_id = :usuario_id");
    $stmt->bindParam(':curso_id', $id_curso, PDO::PARAM_INT);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();

    $inscrito = $stmt->fetchColumn();

    if ($inscrito > 0) {
        // Exibir mensagem de inscrição existente na caixa de diálogo
        $dialogIcon = "&#x26A0;&#xFE0F;";
        $dialogTitle = "Inscrição Inválida";
        $dialogMessage = "Você já está inscrito neste curso.";

        include 'dialog.php';
        exit(); // Encerre o script após exibir a mensagem
    }

    // Adicione a compra ao banco de dados
    $stmt = $conn->prepare("INSERT INTO inscricoes (curso_id, usuario_id) VALUES (:curso_id, :usuario_id)");
    $stmt->bindParam(':curso_id', $id_curso, PDO::PARAM_INT);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();

    // Adicione sua lógica de processamento de pagamento aqui (gateway de pagamento, etc.)
    
    // Exibir mensagem de sucesso na caixa de diálogo
    header('Location: /MeusCursos');
    $dialogIcon = "&#x2705;";
    $dialogTitle = "Inscrição Realizada";
    $dialogMessage = "Inscrição feita com sucesso.";

    include 'dialog.php';
   
}
?>
<script>
    
    setTimeout(function() {
       
        window.location.href = "/MeusCursos";
    }, 3000); // 3000 milissegundos = 3 segundos
</script>
