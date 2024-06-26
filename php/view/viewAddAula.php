<?php include 'partials/header.php' ?>


<body class="view">  <?php include 'partials/nav.php' ?>
    <div class="flex items-center justify-center mt-12 mb-12">
        <form action="" method="post" enctype="multipart/form-data" class="bg-white p-8 rounded shadow-md w-full md:w-2/3 lg:w-1/3 xl:w-1/4">
            <div class="mb-4">
                <h1 class="text-3xl font-bold mb-4">Adicionar Aulas</h1>
                <label for="nome_aula" class="block text-sm font-semibold mb-2">Título da Aula:</label>
                <input type="text" id="nome_aula" name="nome_aula" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="descricao_aula" class="block text-sm font-semibold mb-2">Descrição da Aula:</label>
                <textarea id="descricao_aula" name="descricao_aula" rows="4" cols="50" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>

            <div class="mb-4">
                <label for="link_aula" class="block text-sm font-semibold mb-2">Link da Aula:</label>
                <input type="text" id="link_aula" name="link_aula" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="video" class="block text-sm font-semibold mb-2">Vídeo da Aula:</label>
                <input type="text" id="video" name="video" class="w-full p-2 border border-gray-300 rounded" placeholder="Insira o código de incorporação do vídeo">
            </div>

            <div class="mb-4">
                <label for="video_file" class="block text-sm font-semibold mb-2">ou Envie um Vídeo:</label>
                <input type="file" name="video_file" accept="video/*" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <input type="hidden" name="curso_id" value="<?php echo isset($_GET['id_curso']) ? $_GET['id_curso'] : ''; ?>">

            <div class="mb-4">
                <input type="submit" value="Adicionar Aula" class="w-full bg-blue-500 text-white p-2 rounded cursor-pointer">
            </div>
        </form>
    </div>
</body>

<?php include 'footer.php'; ?>
