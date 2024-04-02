<?php
session_start();
require_once 'connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $descricao = trim($_POST["descricao"]);
    $tiposSelecionados = implode(",", $_POST['tipo_curso']);

    // Definindo valores padrão para cursos gratuitos
    $preco_curso = (in_array('2', $_POST['tipo_curso'])) ? 0 : $_POST["preco_curso"];
    $metodo_pagamento = (in_array('2', $_POST['tipo_curso'])) ? '' : $_POST["metodo_pagamento"];

    $imagem = $_FILES["imagem"];

    // ... (código de validação dos campos do formulário) ...

    if (empty($nome_curso) || $categoria_id === "" || $imagem["error"] !== UPLOAD_ERR_OK || $imagem["size"] > 1000000) {
        echo "Erro nos dados do formulário.";
        exit;
    }

    // Executa a função de upload da imagem
    $arquivo = $_FILES['imagem'];
    $diretorioDestino = '/var/www/html/progeto/php/imagens'; // Substitua pelo seu diretório real
    $resultadoUpload = uploadImagem($arquivo, $diretorioDestino);

    // Verifica o resultado do upload da imagem
    if (strpos($resultadoUpload, 'Erro') !== false) {
        echo $resultadoUpload;
        exit;
    }
    // Verifica se o curso já existe no banco de dados
$stmt_verificar_curso = $conn->prepare("SELECT COUNT(*) as total FROM cursos WHERE nome = :nome_curso");
$stmt_verificar_curso->bindParam(':nome_curso', $nome_curso, PDO::PARAM_STR);
$stmt_verificar_curso->execute();
$resultado_verificacao = $stmt_verificar_curso->fetch(PDO::FETCH_ASSOC);

if ($resultado_verificacao['total'] > 0) {
    // Já existe um curso com esse nome
    $dialogIcon = "&#x26A0;&#xFE0F;";
    $dialogTitle = "ERRO";
    $dialogMessage = "Já existe um curso com esse nome.";
    include 'dialog.php';
    exit;
}

    // Insere o caminho do arquivo de imagem no banco de dados
    $caminho_completo = $resultadoUpload; // Defina o caminho completo da imagem após o upload

    // Obtém o ID do instrutor da sessão
    $instrutor_id = isset($_SESSION['instrutor']) ? $_SESSION['instrutor']['id'] : null;
    
    // Verifica se a categoria do instrutor é compatível com a categoria do curso
$stmt_instrutor_categoria = $conn->prepare("SELECT categoria_id FROM instrutores_categorias WHERE instrutor_id = :instrutor_id");
$stmt_instrutor_categoria->bindParam(':instrutor_id', $instrutor_id, PDO::PARAM_INT);
$stmt_instrutor_categoria->execute();
$instrutor_categoria = $stmt_instrutor_categoria->fetch(PDO::FETCH_ASSOC);


if (!$instrutor_categoria) {
    // O instrutor não tem uma categoria associada
    $dialogIcon = "&#x26A0;&#xFE0F;";
    $dialogTitle = "ERRO";
    $dialogMessage = "O instrutor não tem uma categoria associada.";
    include 'dialog.php';
    exit;
}
// Obtém a categoria do usuário da sessão
$categoria_instrutor = isset($_SESSION['instrutor']) ? $_SESSION['instrutor']['categoria_id'] : null;

// Verifica se a categoria do usuário é a mesma que a categoria do curso
if ($categoria_instrutor != $categoria_id) {
    // A categoria do usuário não é a mesma que a categoria do curso
    $dialogIcon = "⚠️";
    $dialogTitle = "ERRO";
    $dialogMessage = "Você não pode adicionar um curso que não esteja relacionado à sua categoria.";
    include 'dialog.php';
    exit;
}




    // Continua com o restante do seu código...

    $stmt = $conn->prepare("INSERT INTO cursos (nome, categoria_id, instrutor_id, descricao, tipo_curso, preco_curso, metodo_Pagamento, imagem) VALUES (:nome, :categoria_id, :instrutor_id, :descricao, :tipo_curso, :preco_curso, :metodo_pagamento, :imagem)");

    $stmt->bindParam(':nome', $nome_curso);
    $stmt->bindParam(':categoria_id', $categoria_id);
    $stmt->bindParam(':instrutor_id', $instrutor_id);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':tipo_curso', $tiposSelecionados);
    $stmt->bindParam(':preco_curso', $preco_curso);
    $stmt->bindParam(':metodo_pagamento', $metodo_pagamento);
    $stmt->bindParam(':imagem', $caminho_completo);

    if ($stmt->execute()) {
        $dialogIcon = "&#x2705;";
        $dialogTitle = "Cadastro Realizado";
        $dialogMessage = "Cadastro feito com sucesso.";
        include 'dialog.php';
    } else {
        echo 'Erro ao criar registro.';
    }
}








