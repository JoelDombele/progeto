<?php
            // Abre uma conexão com o banco de dados
            require_once 'connection.php';

            $database = new DB();
            $conn = $database->connect();

            // Prepara uma consulta SQL
            $stmt = $conn->prepare("SELECT id, nome FROM categorias");

            // Executa a consulta SQL
            $stmt->execute();

            // Obtém os resultados da consulta SQL
            $categorias = $stmt->fetchAll();

            // Fecha a conexão com o banco de dados
            $conn = null;

            // Cria as opções do select
            
            ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="stylesheet" href="../css/listagemCursos.css">
</head>
<body>
    <nav class="navBar">
            <h1 class="logo">EAD</h1>
            <ul class="nav-links">
  <li class="active"><a href="#">Home</a></li>
  <li>
    <details>
      <summary>Cursos</summary>
      <div class="cursos-links">
        <a href="cursosGratuitos.php?tipo_curso[]=1&tipo_curso[]=2" class="curso-link">Cursos Gratuitos</a>
        <a href="#" class="curso-link">Cursos Pagos</a>
      </div>
    </details>
  </li>
  <li>
    
  <details>
      <summary>Categorias</summary>
      <div class="cursos-links">>
              
        <?php 
         // Cria as opções do select
         foreach ($categorias as $categoria) {
                echo "<a href='buscarCursos.php?categoria_id={$categoria['id']}' class='curso-link'>{$categoria['nome']}</a>";
            } ?>
      </div>
    </details>

</li>
  <li><a href="login.php" class="ctn">Login</a></li>
  <li><a href="cadastrar.php" class="ctn">Sign in</a></li>
</ul>
 <img src="../imagens/menu-aberto.png" alt="" class="menu-bnt">

    </nav>
    <header>
    <div class="search-box">
      <form action="pesquisa.php" method="get">
            <input type="text" class="search-text" placeholder="Pesquise por Qualquer curso..." name="search">
            
    </form> 
    <script>
        // Seleciona os elementos da barra de pesquisa
        const searchInput = document.querySelector('.search-text');
        const searchButton = document.querySelector('.search-btn');

        // Adiciona um ouvinte de evento para quando o foco é perdido na barra de pesquisa
        searchInput.addEventListener('blur', () => {
            // Verifica se o campo de pesquisa está vazio
            if (searchInput.value === '') {
                // Move o ícone para a posição original
                searchButton.style.top = '50%';
                searchButton.style.transform = 'translateY(-50%)';
            }
        });
    </script>    
        </div>
        <div class="overlay">
            <div class="header-content">
                <h2>Faça os melhores Cursos Aqui</h2>
                <div class="line"></div>
                <h1>Encontre a tua inspiração</h1>
                <a href="#" class="ctn">Aprenda mais</a>
            </div>
        </div>
    </header>

    <section class="events">
        <div class="title">
            <h1>Cursos com Qualidade</h1>
            <div class="line"></div>
        </div>
        
    </section>
    <?php

        $database = new DB();
        $conn = $database->connect();

          $stmt = $conn->prepare("SELECT id, nome, descricao, imagem FROM cursos WHERE visualizacoes > 1");
          $stmt->execute();
          
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
            $id_curso = $row['id'];

            echo '<div class="course">';
            echo '<img src="../imagens/' . $foto . '" alt="Imagem do Curso">';
            echo '<h2>' . $nome . '</h2>';
            echo '<p>' . $row['descricao'] . '</p>';
            echo '<a href="visualizacao.php?id_curso=' . $id_curso . '"> Saiba Mais </a>';

            echo '</div>';
        }

        echo '</div>';
        echo '</body>';
        echo '</html>';
        
        ?>

    <section class="explore">
        <div class="overlay-explore">
            <div class="explore-content">
            <h1>Explore o seu Cerebro</h1>
            <div class="line"></div>
            <p>Explore as vastidões do seu cérebro, pois é nesse território que encontramos a inspiração e a capacidade de criar mundos inteiros.</p>
            <a href="instrutor.php" class="ctn">Ensine conosco</a>
            </div>
        </div>
    </section>
    <section class="tours">
        <div class="row">
            <div class="col content-col">
                <h1>Cursos de tecnologias do Futuro</h1>
                <div class="line"></div>
                <p>Abra os horizontes para os cursos de tecnologias do futuro, pois são eles que moldarão o amanhã que desejamos</p>
               
                
        <a href="#" class="ctn">Explorar</a>
            </div>
            <div class="col image-col">
                <div class="image-gallery">
                   <div class="img" id="img1"></div>
                   <div class="img" id="img2"></div>
                   <div class="img" id="img3"></div>
                   <div class="img" id="img4"></div>

                </div>
            </div>
        </div>
    </section>
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