<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Cursos Pagos</title>
    <link rel="stylesheet" href="../css/suzana.css">
</head>
<body>
    <div class="form">
    <h2>Detalhes do Curso</h2>
    <form action="/processar_dados_do_formulario" method="post">
        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" required><br><br>

        <label for="duracao">Duração:</label>
        <input type="text" id="duracao" name="duracao" required><br><br>

        <label for="detalhes_pagamento">Detalhes de Pagamento:</label>
        <textarea id="detalhes_pagamento" name="detalhes_pagamento" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Enviar">
    </form>
    </div>
</body>
</body>
</html>