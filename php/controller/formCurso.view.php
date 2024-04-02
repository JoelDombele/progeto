<?php
            session_start();
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

<?php 
    $title = "Formulario Curso";
    include '../partials/header.php';
?>
<?php include '../partials/nav.php'; ?>

  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <div class="min-h-screen min-w-screen-md flex items-center justify-center">
    <form action="teste.php" id="cursoForm" method="post" enctype="multipart/form-data"   class="w-full max-w-screen-md space-y-12 p-6 bg-white rounded-md shadow-md">
    <div class="border-b border-gray-900/10 pb-12">
        <h1 class="text-2xl font-semibold leading-8 text-gray-900">Cadastrar Cursos</h1>
        <p class="mt-1 text-sm leading-6 text-gray-600">Preencha as informações do curso.</p>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-4">
                <label for="nome_curso" class="block text-sm font-medium leading-6 text-gray-900">Nome do curso</label>
                <input type="text" required name="nome_curso" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>

            <div class="col-span-full">
                <label for="categoria" class="block text-sm font-medium leading-6 text-gray-900">Categoria</label>
                <select name="categoria" id="categoria" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['id']; ?>" data-id="<?php echo $curso['id']; ?>"><?php echo $categoria['nome']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-span-full">
                <label for="descricao" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>

            <div class="col-span-full">
                <label for="instrutor" class="block text-sm font-medium leading-6 text-gray-900">Instrutor</label>
                <select name="instrutor" id="instrutor" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="1">Instrutor 1</option>
                    <option value="2">Instrutor 2</option>
                    <option value="3">Instrutor 3</option>
                </select>
            </div>

            <div class="col-span-full">
                <label for="tipo_curso" class="block text-sm font-medium leading-6 text-gray-900">Tipo de Curso:</label>
                <div class="flex items-center gap-x-3">
                    <input type="checkbox" id="cursosPagos" name="tipo_curso[]" value="1" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="cursosPagos" class="text-sm font-medium leading-6 text-gray-900">Curso Pago</label>
                </div>
                <div class="flex items-center gap-x-3">
                    <input type="checkbox" id="cursosGratuitos" name="tipo_curso[]" value="2" checked class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="cursosGratuitos" class="text-sm font-medium leading-6 text-gray-900">Curso Gratuito</label>
                </div>
            </div>

            <div class="col-span-full">
                <label for="preco_curso" class="block text-sm font-medium leading-6 text-gray-900">Preço do Curso</label>
                <input type="number" name="preco_curso" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>

            <div class="col-span-full">
                <label for="metodo_pagamento" class="block text-sm font-medium leading-6 text-gray-900">Método de Pagamento</label>
                <input type="text" name="metodo_pagamento" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>

            <div class="col-span-full">
                <label for="imagem" class="block text-sm font-medium leading-6 text-gray-900">Imagem de capa</label>
                <input type="file" name="imagem" id="imagem" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enviar</button>
    </div>
</form>
</div>    

    </div>
  </main>
</div>
<?php include'../partials/footer.php';?>
  
</body>
</html>

     

