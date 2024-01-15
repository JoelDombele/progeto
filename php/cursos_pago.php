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
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1200px;
        }

        .course {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            width: 300px;
            border: 1px solid #ccc;
        }

        .course img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
        }

        .course h2 {
            padding: 15px;
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }

        .course p {
            padding: 0 15px 15px;
            margin: 0;
            font-size: 0.9em;
            color: #666;
        }

        .course p.price {
            font-weight: bold;
            color: #e44d26; /* Cor laranja do Udemy */
        }

        .course a {
            display: block;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            background-color: #e44d26; /* Cor laranja do Udemy */
            color: #fff;
            font-weight: bold;
            border-top: 1px solid #ddd;
            transition: background-color 0.3s ease-in-out;
        }

        .course a:hover {
            background-color: #333;
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
            <h1>Cursos Gratuitos</h1>
            <div class="line"></div>
        </div>

<?php
require_once 'connection.php';

$database = new DB();
$conn = $database->connect();

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['tipo_curso'])) {
        $tipos = $_GET['tipo_curso'];

        // Verifica se '1' (curso pago) está presente nos tipos
        if (in_array('1', $tipos)) {
            // Prepara uma string com placeholders para os valores
            $placeholders = implode(',', array_fill(0, count($tipos), '?'));

            // Cria a consulta SQL usando IN com os placeholders
            $sql = "SELECT id, nome, descricao, imagem, PrecoCurso FROM cursos WHERE tipo_curso IN ($placeholders)";
            $stmt = $conn->prepare($sql);

            // Executa a consulta usando os valores selecionados
            $stmt->execute($tipos);

            echo '<!DOCTYPE html>';
            echo '<html lang="en">';
            echo '<head>';
            echo '<meta charset="UTF-8">';
            echo '<title>Lista de Cursos Pagos</title>';
            echo '<link rel="stylesheet" href="styles.css">';
            echo '</head>';
            echo '<body>';
            echo '<div class="courses-list">';

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $foto = $row['imagem'];
                $nome = $row['nome'];
                $preco = $row['PrecoCurso'];
                $id_curso = $row['id'];

                echo '<div class="course">';
                echo '<img src="../imagens/' . $foto . '" alt="Imagem do Curso">';
                echo '<h2>' . $nome . '</h2>';
                echo '<p>' . $row['descricao'] . '</p>';
                echo '<b><p>Preço: $' . $preco . '</p></b>'; // Exibe o preço
                echo '<a href="visualizacao.php?id_curso=' . $id_curso . '"> Começar </a>';

                echo '</div>';
            }

            echo '</div>';
            echo '</body>';
            echo '</html>';
        } else {
            echo "Nenhum curso pago encontrado.";
        }
    } else {
        echo "Nenhum dado recebido do formulário.";
    }
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