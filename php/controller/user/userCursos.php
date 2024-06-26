<?php 
     $title = "Meus Cursos";
    include 'partials/header.php';
     
?>
<body>
<?php
   // Verifique se o usuário está autenticado
session_start();
if (!isset($_SESSION['usuario'])) {
    // Redirecione para a página de login ou exiba uma mensagem de erro
    header("Location: controller/login.php");
    exit();
}
include 'partials/nav.php';

require_once "connection.php";
$database = new DB();
$conn = $database->connect();

// Obtém o ID do usuário da sessão

$usuario_id = $_SESSION['usuario']['id'];

// Consulta SQL modificada para selecionar cursos em que o usuário está inscrito
$stmt = $conn->prepare("SELECT c.id, c.nome, c.descricao, c.imagem, c.preco_curso FROM cursos c
                        JOIN inscricoes i ON c.id = i.curso_id
                        WHERE i.usuario_id = :usuario_id");
$stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
$stmt->execute();

echo '<div class="flex flex-wrap justify-center gap-8 mt-8">';
echo '<p class="text-black text-4xl font-bold mb-8 mt-30 text-center w-full">Seus Cursos</p>';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $foto = $row['imagem'];
    $nome = $row['nome'];
    $id_curso = $row['id'];
    $preco = $row['preco_curso'];

   require '../view/userCursos.view.php';
}

?>
  


