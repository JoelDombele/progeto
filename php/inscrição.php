<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main>
   
<h1>Formulário de inscrição</h1>

<form action="inscricao.php" method="post">
<fieldset>   
<input type="hidden" name="id_usuario" value="1234567890">
        <select name="curso_id">
            <option value="1">Plano mensal</option>
            <option value="2">Plano anual</option>
        </select><br><br>
        <select name="plano_id">
            <option value="1">Plano mensal</option>
            <option value="2">Plano anual</option>
        </select><br><br>
        <input type="submit" value="Inscrever-se">
    </form>
</fieldset>  
</form>
</body>
</main>
</html>