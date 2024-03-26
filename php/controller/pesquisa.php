<?php
require_once 'connection.php';
include 'partials/nav.php'; // Inclua o cabeçalho

$database = new DB();
$conn = $database->connect();

try {
    $stmt = $conn->prepare("SELECT id, nome, descricao, imagem FROM cursos");
    $stmt->execute();

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $stmt = $conn->prepare("SELECT id, nome, descricao, imagem,preco_curso FROM cursos WHERE nome LIKE :search");
        $stmt->bindValue(':search', "%$search%");
        $stmt->execute();
    } else {
        // Redireciona de volta para a página inicial se não houver termo de pesquisa
                 $dialogIcon = "&#x2705;";
                $dialogTitle = "DESCULPE";
                $dialogMessage = "Curso não encontrado";

                 include 'dialog.php';
                 header("Location: index.php");
         exit();
    }   

    echo '<div class="flex flex-wrap justify-center gap-8 mt-8">'; // Adiciona uma classe de flexbox com espaçamento entre os cards
echo '<p class="text-black text-4xl font-bold mb-8 mt-30 text-center w-full"> Cursos Encontrados  </p>  ';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $foto = $row['imagem'];
  $nome = $row['nome'];
  $id_curso = $row['id'];
  $preco = $row['preco_curso'];

  echo '<div class="course max-w-md w-full bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">';
  
  // Ajuste do caminho para a imagem usando um caminho relativo à raiz do servidor
  echo '<img class="w-full h-48 object-cover mb-4" src="../imagens/' . $foto . '" alt="Imagem do Curso">';

  echo '<h2 class="text-xl font-semibold mb-2">' . $nome . '</h2>';
  echo '<b class="text-blue-600">$' . $preco . '</b>';
  echo '<a href="visualizacao.php?id_curso=' . $id_curso . '" class="block mt-4 bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-300">Saiba Mais</a>';

  echo '</div>';
}

echo '</div>';

} catch (PDOException $e) {
    // Tratar exceções aqui, se necessário
    echo "Erro: " . $e->getMessage();
}

include('footer.php'); // Inclua o rodapé
?>
