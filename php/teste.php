<link rel="stylesheet" href="../css/suzana.css">
<?php
require_once 'connection.php';

function uploadImagem($arquivo, $diretorioDestino) {
    if (isset($arquivo['name']) && isset($arquivo['tmp_name'])) {
        $nomeArquivo = $arquivo['name'];
        $caminhoTemporario = $arquivo['tmp_name'];
        $caminhoDestino = $diretorioDestino . '/' . $nomeArquivo;

        // Verifica se o arquivo é uma imagem válida
        $extensoesPermitidas = array('jpg', 'jpeg', 'png');
        $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
        if (!in_array($extensao, $extensoesPermitidas)) {
            return "Erro: O arquivo enviado não é uma imagem válida.";
        }

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($caminhoTemporario, $caminhoDestino)) {
            return $nomeArquivo;
        } else {
            return "Erro ao fazer upload de imagem.";
        }
    } else {
        return "Erro: Dados do arquivo não estão presentes.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new DB();
    $conn = $database->connect();

    // Valida os dados do formulário
    
    $nome_curso = trim($_POST["nome_curso"]);
    $categoria_id = $_POST["categoria"];
    $instrutor_id = $_POST["instrutor"];
    $descricao = trim($_POST["descricao"]);
    $tiposSelecionados = implode(",", $_POST['tipo_curso']);

    // Definindo valores padrão para cursos gratuitos
    $preco_curso = (in_array('2', $_POST['tipo_curso'])) ? 0 : $_POST["preco_curso"];
    $metodo_pagamento = (in_array('2', $_POST['tipo_curso'])) ? '' : $_POST["metodo_pagamento"];

    $imagem = $_FILES["imagem"];

    // ... (código de validação dos campos do formulário) ...

    if (empty($nome_curso) || $categoria_id === "" || $instrutor_id === "" || $imagem["error"] !== UPLOAD_ERR_OK || $imagem["size"] > 1000000) {
        echo "Erro nos dados do formulário.";
        exit;
    }
    // Executa a função de upload da imagem
    $arquivo = $_FILES['imagem'];
    $diretorioDestino = '/var/www/html/progeto/imagens/'; // Substitua pelo seu diretório real

    $resultadoUpload = uploadImagem($arquivo, $diretorioDestino);

    // Verifica o resultado do upload da imagem
    if (strpos($resultadoUpload, 'Erro') !== false) {
        echo $resultadoUpload;
        exit;
    }

    // Insere o caminho do arquivo de imagem no banco de dados
    $caminho_completo = $resultadoUpload; // Defina o caminho completo da imagem após o upload

    $stmt = $conn->prepare("INSERT INTO cursos (nome, categoria_id, instrutor_id, descricao, tipo_curso, PrecoCurso, metodo_Pagamento, imagem) VALUES (:nome, :categoria_id, :instrutor_id, :descricao, :tipo_curso, :preco_curso, :metodo_pagamento, :imagem)");

    $stmt->bindParam(':nome', $nome_curso);
    $stmt->bindParam(':categoria_id', $categoria_id);
    $stmt->bindParam(':instrutor_id', $instrutor_id);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':tipo_curso', $tiposSelecionados);
    $stmt->bindParam(':preco_curso', $preco_curso);
    $stmt->bindParam(':metodo_pagamento', $metodo_pagamento);
    $stmt->bindParam(':imagem', $caminho_completo);

    if ($stmt->execute()) {
        $mensagem = "Cadastro feito com sucesso!";
        echo "<script type='text/javascript'> alert('$mensagem');</script>";
    } else {
        echo 'Erro ao criar registro.';
    }
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-editar, .btn-eliminar {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            margin-right: 5px;
        }
        .btn-editar {
            background-color: #007bff;
        }
        .btn-eliminar {
            background-color: #dc3545;
        }
        table a {
            color: white;
            text-decoration: none;
        }
        h1{
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Lista de Cursos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'connection.php';

            // Criar um objeto de conexão
            $database = new DB();
            $conn = $database->connect();

            // Consulta ao banco de dados para obter os cursos
            $query = "SELECT id, nome, categoria_id FROM cursos";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Exibir a lista de cursos em forma de tabela
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_curso = $row['id'];
                $nome_curso = $row['nome'];
                $categoria_id = $row['categoria_id'];

                // Consulta para obter o nome da categoria
                $query_categoria = "SELECT nome FROM categorias WHERE id = :categoria_id";
                $stmt_categoria = $conn->prepare($query_categoria);
                $stmt_categoria->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
                $stmt_categoria->execute();
                $categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC);
                $nome_categoria = ($categoria && isset($categoria['nome'])) ? $categoria['nome'] : "Não especificado";

                // Exibir os cursos como linhas de tabela com links clicáveis e botões de editar/eliminar
                echo "<tr>";
                echo "<td>$id_curso</td>";
                echo "<td> <a href='listarAula.php?id_curso=$id_curso'>$nome_curso</a/td>";
                echo "<td>$nome_categoria</td>";
                echo "<td>
                        <a href='editarCurso.php?id_curso=$id_curso' class='btn-editar'>Editar</a>
                        <a href='teste.php?id_curso=$id_curso' class='btn-eliminar'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
require_once 'connection.php';

$mensagem = ""; // Inicializa a variável de mensagem

// Criar um objeto de conexão
$database = new DB();
$conn = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verifica se foi passado um ID na URL para exclusão
    if(isset($_GET['id_curso']) && !empty($_GET['id_curso'])) {
        $id_curso = $_GET['id_curso'];

        // Prepara a declaração SQL para excluir o curso
        $query = "DELETE FROM cursos WHERE id = :id_curso";
        $stmt = $conn->prepare($query);

        // Vincula o parâmetro ID à declaração
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $mensagem = "Curso excluído com sucesso.";
        } else {
            $mensagem = "Erro ao excluir o curso.";
        }
    } else {
        $mensagem = "ID do curso não fornecido para exclusão.";
    }
}
?>

</body>
</html>
