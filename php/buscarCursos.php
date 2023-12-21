<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/homepage.css">
  <style>
/* Estilos básicos para a lista de cursos */
.courses-list {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-wrap: wrap;
  max-width: 1200px;
  margin: 0 auto;
}

.course {
  width: 300px;
  margin: 20px;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  text-align: center;
}

.course img {
  width: 100%;
  height: 250px;
  border-radius: 5px;
}

.course h2 {
  margin-top: 10px;
  font-size: 1.5em;
}

.course p {
  margin-top: 5px;
  font-size: 1em;
}

.course a {
  display: inline-block;
  margin-top: 10px;
  padding: 8px 20px;
  background-color: #007bff;
  color: white;
  text-decoration: none;
  border-radius: 3px;
  transition: background-color 0.3s ease;
}

.course a:hover {
  background-color: #0056b3;
}
.footer{
    width: 100%;
    min-height: 100px;
    padding: 20px 80px;
    margin: 0;
    background-color: #484872;
    text-align: center;

}
.footer p{
    color: whitesmoke;
    margin: 20px auto;
    padding: 20px auto ;
}


</style>

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
        $stmt = $conn->prepare("SELECT id, nome, descricao, imagem FROM cursos");
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
      echo '<a href="course.php?id=' . $row['id'] . '">Saiba mais</a>';
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