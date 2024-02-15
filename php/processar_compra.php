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

<?php
require_once 'connection.php';

// Inicie ou retome a sessão
session_start();

// Verifique se o usuário está autenticado
$id_curso = $_POST['id_curso'];
if (!isset($_SESSION['usuario'])) {
    header("Location: detalhesCursos.php?id_curso=$id_curso");

    exit(); // Encerre o script se o usuário não estiver autenticado
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_curso']) && isset($_POST['preco_curso'])) {
        $id_curso = $_POST['id_curso'];
        $preco_curso = $_POST['preco_curso'];

        // Obtém o ID do usuário a partir da sessão
        $usuario_id =  $_SESSION['usuario']['id'];

        // Verifique se o usuário já está inscrito no curso
        $database = new DB();
        $conn = $database->connect();

        $stmt = $conn->prepare("SELECT COUNT(*) FROM inscricoes WHERE curso_id = :curso_id AND usuario_id = :usuario_id");
        $stmt->bindParam(':curso_id', $id_curso, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        $inscrito = $stmt->fetchColumn();

        if ($inscrito > 0) {
            echo "Você já está inscrito neste curso! Acesse seus cursos em 'Meus Cursos'.";
            exit(); // Encerre o script após exibir a mensagem
        }

        // Adicione a compra ao banco de dados
        $stmt = $conn->prepare("INSERT INTO inscricoes (curso_id, usuario_id) VALUES (:curso_id, :usuario_id)");
        $stmt->bindParam(':curso_id', $id_curso, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        // Adicione sua lógica de processamento de pagamento aqui (gateway de pagamento, etc.)

        echo "Inscrição realizada com sucesso! Acesse seu curso agora.";
    } else {
        echo "ID ou preço do curso não fornecido no formulário.";
    }
} else {
    echo "Acesso inválido ao script.";
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
