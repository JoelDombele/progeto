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
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="homePage.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
              <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Cursos</a>
              <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Categorias</a>
              <a href="index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Instrutor</a>
              <a href="login.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Login</a>
              <a href="cadastrar.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Sign In</a>
            </div>
          </div>
        </div>
        
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">View notifications</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
            </button>

            <!-- Profile dropdown -->
            <div class="relative ml-3">
              <div>
                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </button>
              </div>
              

              <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
              <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" id="user-menu">
                <!-- Active: "bg-gray-100", Not Active: "" -->
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Teu Aprendizado</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Saiba Mais</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
              </div>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Cursos</a>
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Categorias</a>
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Instrutor</a>
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Login</a>
        <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Sign in</a>
      </div>
      <div class="border-t border-gray-700 pb-3 pt-4">
        <div class="flex items-center px-5">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium leading-none text-white">Tom Cook</div>
            <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
          </div>
          <button type="button" class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
          </button>
        </div>
        <div class="mt-3 space-y-1 px-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Teu Aprendizado</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Saiba Mais</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
        </div>
      </div>
    </div>
  </nav>

  <header class="bg-white shadow">
   
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        userMenuButton.addEventListener('click', function () {
            // Toggle a classe 'hidden' para mostrar ou ocultar o menu
            userMenu.classList.toggle('hidden');
        });
    });
</script>

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
        <input type="text" placeholder="Pesquise Qualquer curso..." class="outline-none border-none bg-transparent focus:ring-0">
      </div>
    </div>
  </div>
  </form>
  
  <?php

$database = new DB();
$conn = $database->connect();

  $stmt = $conn->prepare("SELECT id, nome, descricao, imagem, preco_curso FROM cursos WHERE visualizacoes > 1");
  $stmt->execute();

  

echo '<div class="flex flex-wrap justify-center gap-8 mt-8">'; // Adiciona uma classe de flexbox com espaçamento entre os cards
echo '<p class="text-black text-4xl font-bold mb-8 mt-30 text-center w-full">Cursos Populares</p>';

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $foto = $row['imagem'];
    $nome = $row['nome'];
    $id_curso = $row['id'];
    $preco = $row['preco_curso'];

    echo '<div class="course max-w-md w-full bg-white p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">';
    echo '<img class="w-full h-48 object-cover mb-4" src="../imagens/' . $foto . '" alt="Imagem do Curso">'; // Adiciona estilos para a imagem
    echo '<h2 class="text-xl font-semibold mb-2">' . $nome . '</h2>';
    
    echo '<b class="text-blue-600">$' . $preco . '</b>';
    echo '<a href="visualizacao.php?id_curso=' . $id_curso . '" class="block mt-4 bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-600 transition duration-300">Saiba Mais</a>'; // Adiciona estilos para o link

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
<footer class="bg-gray-800 text-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <p>© 2024 Seu Site</p>
            <p>Links úteis | Contato | Política de Privacidade</p>
        </div>

</body>
</html>
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