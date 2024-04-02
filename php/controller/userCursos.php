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
    header("Location:login.php");
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

    echo '<div class="course max-w-md w-full bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">';
    echo '<img class="w-full h-48 object-cover mb-4" src="../imagens/' . $foto . '" alt="Imagem do Curso">';
    echo '<h2 class="text-xl font-semibold mb-2">' . $nome . '</h2>';
    
    echo '<b class="text-blue-600">$' . $preco . '</b>';
    echo '<a href="aulaTable.php?id_curso=' . $id_curso . '" class="block mt-4 bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-300">Acessar</a>';

    echo '</div>';
}

?>
  


