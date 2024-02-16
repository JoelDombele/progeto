<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<!-- Caixa de diálogo -->
<div id="dialog" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-8 rounded text-center">
        <span id="closeDialogBtn" class="absolute top-2 right-2 text-xl cursor-pointer">&times;</span>
        <div class="text-4xl mb-4" role="img" aria-label="Ícone"><?= $dialogIcon ?></div>
        <h1 class="text-2xl font-bold mb-4"><?= $dialogTitle ?></h1>
        <p class="mb-4"><?= $dialogMessage ?></p>
    </div>
</div>

<!-- Adicione o script para mostrar e ocultar a caixa de diálogo -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dialog = document.getElementById("dialog");
        const closeDialogBtn = document.getElementById("closeDialogBtn");

        dialog.classList.remove('hidden');

        closeDialogBtn.addEventListener("click", function () {
            dialog.classList.add('hidden');
            window.location.href = 'detalhesCursos.php';
        });
    });
</script>
