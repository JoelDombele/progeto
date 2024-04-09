<?php include 'partials/header.php'; ?>
<?php include 'partials/nav.php'; ?>

<div class="min-h-screen flex items-center justify-center mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <div class="form">
        <h1>Adicionar Categoria</h1>
        <?php if (!empty($mensagem)) : ?>
            <script type='text/javascript'>alert('<?php echo $mensagem; ?>');</script>
        <?php endif; ?>
        <form action="" method="post" class="w-full max-w-screen-lg space-y-12 p-6 bg-white rounded-md shadow-md">
            <label for="nome_categoria" class="block text-sm font-medium leading-6 text-gray-900">Nome da Categoria</label>
            <input type="text" name="nome_categoria" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <label for="desc_categoria" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
            <textarea name="desc_categoria" rows="4" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            <input type="submit" value="Adicionar" name="add" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        </form>
    </div>
</div>

</body>