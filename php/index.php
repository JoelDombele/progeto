<?php
            // Abre uma conexão com o banco de dados
            session_start();
            require_once "connection.php";

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
    <title>EAD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="min-h-full">
      <?php include 'partials/nav.php' ?>
  <header class="bg-white shadow">
   
  </header>
  <main>
  <div class="flex-1 bg-cover bg-center relative" style="background-image: url('https://cdn.pixabay.com/photo/2017/07/31/11/21/people-2557399_960_720.jpg'); height: 70vh;">
    <!-- Conteúdo centralizado dentro da faca -->
    <div class="absolute inset-0 flex flex-col items-center justify-center">
      <p class="text-white text-4xl font-bold mb-8">Encontre a tua inspiração</p>
      <!-- Barra de pesquisa centralizada -->
    
      <div class="w-1/3 flex items-center bg-white p-2 rounded-full shadow-md">

        <svg class="w-6 h-6 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <form action="pesquisa.php" method="get">
        <input type="text" placeholder="Pesquise Qualquer curso..." class="outline-none border-none bg-transparent focus:ring-0" name="search">
      </div>
    </div>
  </div>
  </form>
  
  <?php

$database = new DB();
$conn = $database->connect();

  $stmt = $conn->prepare("SELECT id, nome, descricao, imagem, preco_curso FROM cursos WHERE visualizacoes > 10");
  $stmt->execute();

  

echo '<div class="flex flex-wrap justify-center gap-8 mt-8">'; // Adiciona uma classe de flexbox com espaçamento entre os cards
echo '<p class="text-black text-4xl font-bold mb-8 mt-30 text-center w-full">Cursos Populares</p>';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $foto = $row['imagem'];
  $nome = $row['nome'];
  $id_curso = $row['id'];
  $preco = $row['preco_curso'];

  echo '<div class="course max-w-md w-full bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">';
  
  // Ajuste do caminho para a imagem usando um caminho relativo à raiz do servidor
  echo '<img class="w-full h-48 object-cover mb-4" src=" ../imagens/' . $foto . '" alt="Imagem do Curso">';

  echo '<h2 class="text-xl font-semibold mb-2">' . $nome . '</h2>';
  echo '<b class="text-blue-600">$' . $preco . '</b>';
  echo '<a href="visualizacao.php?id_curso=' . $id_curso . '" class="block mt-4 bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-300">Saiba Mais</a>';

  echo '</div>';
}

echo '</div>';
?>

<div class="text-center my-16 w-45vw mx-auto">
    <h2 class="text-3xl font-bold mb-4">Invista em sua carreira com a nossa Plataforma</h2>
    <p class="text-lg">Transforme seu potencial em conquistas! Descubra, aprenda e evolua com nossa plataforma de cursos online. </p>
    <p class="text-lg">Seu caminho para o sucesso começa aqui.</p>
</div>

<div class="flex-1 bg-cover bg-center relative" style="background-image: url('https://image.lexica.art/full_webp/cd80952c-3eac-4725-a4e1-ba2dded9a751'); height: 70vh;">
    <!-- Conteúdo centralizado dentro da faca -->
    <div class="absolute inset-0 flex flex-col items-center justify-center">
        <p class="text-white text-4xl font-bold mb-8">Explore o seu Cerebro</p>
        <p class="text-white text-center">
Explore as vastidões do seu cérebro, pois é nesse território que encontramos a inspiração e a capacidade de criar mundos inteiros.</p>
<a href="#" class="block mt-4 bg-blue-500 text-white rounded-full px-2 py-1 hover:bg-blue-600 transition duration-300">Ensine Conosco</a>

    </div>
</div>
<div class="text-center my-16 w-45vw mx-auto">
    <h2 class="text-3xl font-bold mb-4">Cursos de tecnologias do Futuro</h2>
    <p class="text-lg">Abra os horizontes para os cursos de tecnologias do futuro, pois são eles que moldarão o amanhã que desejamos
</p>
 </div>
 <div class="flex flex-wrap justify-center mt-8">
    <img src="https://image.lexica.art/full_webp/24d6cae7-ff5e-4027-b25f-c2e963adadf9" alt="Imagem 1" class="w-60 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 object-cover mx-2 my-2 rounded-lg">
    <img src="https://image.lexica.art/full_webp/9ed24921-5653-4fa3-8852-e77fbc9a8a78" alt="Imagem 2" class="w-60 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 object-cover mx-2 my-2 rounded-lg">
    <img src="https://image.lexica.art/full_webp/03d039f2-98d6-48c3-b5f4-90ef583588a3" alt="Imagem 3" class="w-60 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 object-cover mx-2 my-2 rounded-lg">
    <img src="https://image.lexica.art/full_webp/4b551f7d-164d-4b93-9994-2dc7c37dc725" alt="Imagem 4" class="w-60 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 object-cover mx-2 my-2 rounded-lg">
    
</div>







  </main>
</div>
 <?php include 'footer.php';?>
</body>
</html>
