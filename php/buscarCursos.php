<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/listagemCursos.css">
</head>
<body>
<nav class="navBar">
            <h1 class="logo">EAD</h1>
            <ul class="nav-links">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Cursos</a></li>
                <li><a href="#">Categorias</a></li>
                <li><a href="login.php" class="ctn">Login</a></li>
                <li><a href="cadastrar.php" class="ctn">sign in</a></li>
            </ul>
            <img src="../imagens/menu-aberto.png" alt="" class="menu-bnt">

    </nav>
<header class="instrutor">
        <div class="overlay">
            <div class="header-content">
                <h2>Crie Conteudos e Ajude muitas mentes Evoluirem</h2>
                <div class="line"></div>
                <h1>Encontre a tua inspiração</h1>
                <a href="#" class="ctn">Aprenda mais</a>
            </div>
        </div>
</header>
<div class="title">
            <h1>Cursos Disponiveis</h1>
            <div class="line"></div>
        </div>
    <?php 
    
    
try {
    // Conexão com o banco de dados (substitua pelas suas credenciais)
    require_once 'connection.php';

    $database = new DB();
    $conn = $database->connect();
    
    // Verifica se há um parâmetro de categoria na URL
    if (isset($_GET['categoria_id'])) {
        $categoriaSelecionada = $_GET['categoria_id'];
        $stmt = $conn->prepare("SELECT id, nome, descricao, imagem FROM cursos WHERE categoria_id = :categoria_id");
        $stmt->bindParam(':categoria_id', $categoriaSelecionada);
    } else {
        // Se nenhum parâmetro de categoria for especificado, listar todos os cursos
        $stmt = $conn->prepare("SELECT id, nome, descricao, imagem FROM curso");
    }

    $stmt->execute();

    // Saída HTML para listar os cursos
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<title>Lista de Cursos</title>';
    echo '<link rel="stylesheet" href="styles.css">';
    echo '</head>';
    echo '<body>';
    echo '<div class="courses-list">';
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $foto = $row['imagem'];
      $nome = $row['nome'];
      
      echo '<div class="course">';
      echo '<img src="../imagens/' . $foto . '" alt="Imagem do Curso">';
      echo '<h2>' . $nome . '</h2>';
      echo '<p>' . $row['descricao'] . '</p>';
      echo '<a href="visualizacao.php?id_curso=' . $row['id'] . '">Saiba mais</a>';
      echo '</div>';
  }
    echo '</div>';
    echo '</body>';
    echo '</html>';
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<section class="footer">
        <p>Explore as capacidades do seu cerebro. Projeto desenvolvido pelo grupo nº 2</p>
        <p>Copyright @ 2023 EAD</p>
    </section>

    <script>
        const menuBnt = document.querySelector('.menu-bnt')
        const navlinks = document.querySelector('.nav-links')

        menuBnt.addEventListener('click',()=>{
            navlinks.classList.toggle('mobile-menu')
        })
    </script>

</body>
</html>