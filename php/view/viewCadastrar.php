
<?php
    $title = "Registra-te";
    include '../partials/header.php' ?>
    
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <main class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
        <form method="post" class="bg-white p-8 rounded shadow-md">
            <div class="mb-6">
                <h1 class="text-3xl font-bold mb-4">Registra-te</h1>
                <input type="text" class="w-full p-2 border border-gray-300 rounded" name="nome" required placeholder="Nome">
                <?php if(isset($errors['nome'])): ?>

               <p class="text-red-500 text-xs mt-2"><?= $errors['nome'];?></p>
                <?php endif; ?> 
            </div>
               

            <div class="mb-6">
                <input type="email" class="w-full p-2 border border-gray-300 rounded" name="email" required placeholder="Email">
                <?php if(isset($errors['nome'])): ?>

                <p class="text-red-500 text-xs mt-2"><?= $errors['email'];?></p>
                <?php endif; ?> 
            </div>

            <div class="mb-6">
                <input type="password" class="w-full p-2 border border-gray-300 rounded" name="senha" required placeholder="Senha">
                <?php if(isset($errors['nome'])): ?>

                <p class="text-red-500 text-xs mt-2"><?= $errors['senha'];?></p>
                <?php endif; ?> 
            </div>

            <div class="mb-6">
                <input type="submit" value="Enviar" name="confirmar" class="w-full bg-blue-500 text-white p-2 rounded cursor-pointer">
            </div>
        </form>
    </main>

</body>
</html>