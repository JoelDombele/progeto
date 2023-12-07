<link rel="stylesheet" href="../css/suzana.css">
<?php
require_once 'connection.php';

function uploadImagem($vetor) {
    $vtipo = explode('/', $vetor['type']);
    $tipo = isset($vtipo[0]) ? $vtipo[0] : '';
    $extensao = isset($vtipo[1]) ? $vtipo[1] : '';

    if ((!$vetor['error']) and (!$vetor['size'] <= 500000) and ($tipo == "image")) {
        $nome = date('Ymd') . "emerson_coder" . $extensao;

        $diretorio = '/opt/lampp/htdocs/images'; // Caminho do diretório onde deseja armazenar as imagens

        if (!is_dir($diretorio)) {
            // Se o diretório não existir, crie um novo
            mkdir($diretorio, 0777, true); // Permissões 0777 dão acesso total
        }

        $caminhoCompleto = $diretorio . "/" . $nome;
        move_uploaded_file($vetor['tmp_name'], $caminhoCompleto);
        return $caminhoCompleto;
    } else {
        return 0;
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
    $imagem = $_FILES["imagem"];

    // ... (código de validação dos campos do formulário) ...

    if (empty($nome_curso) || $categoria_id === "" || $instrutor_id === "" || $imagem["error"] !== UPLOAD_ERR_OK || $imagem["size"] > 1000000) {
        echo "Erro nos dados do formulário.";
        exit;
    }
    // Executa a função de upload da imagem
    $arquivo = $_FILES['imagem'];
    $diretorioDestino = 'uploads/imagens/cursos'; // Substitua pelo seu diretório real

    $resultadoUpload = uploadImagem($arquivo, $diretorioDestino);

    // Verifica o resultado do upload da imagem
    if (strpos('$resultadoUpload', 'Erro') !== false) {
        echo $resultadoUpload;
        exit;
    }

    // Insere o caminho do arquivo de imagem no banco de dados
    $caminho_completo = $resultadoUpload; // Defina o caminho completo da imagem após o upload

    $stmt = $conn->prepare("INSERT INTO cursos (nome, categoria_id, instrutor_id, descricao, imagem) VALUES (:nome, :categoria_id, :instrutor_id, :descricao, :imagem)");

    $stmt->bindParam(':nome', $nome_curso);
    $stmt->bindParam(':categoria_id', $categoria_id);
    $stmt->bindParam(':instrutor_id', $instrutor_id);
    $stmt->bindParam(':descricao', $descricao);
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
                        <a href='eliminarCurso.php?id_curso=$id_curso' class='btn-eliminar'>Eliminar</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
