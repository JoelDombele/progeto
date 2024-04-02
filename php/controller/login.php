<?php
session_start();

require_once 'connection.php';

function dd($value) {
    echo ("<pre>");
    var_dump($value);
    echo ("</pre>");
    die();
}

// Verificar se o formulário foi enviado usando o método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados do formulário
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['senha']) ? $_POST['senha'] : null;

    // Verificar se as chaves estão definidas
    if ($email !== null && $password !== null) {
        try {
            $database = new DB();
            $conn = $database->connect();
        } catch (\Throwable $e) {
            die("Erro ao conectar ao banco de dados: {$e}");
        }

        try {
            $query = "SELECT * FROM usuario WHERE email = :email";

            // Preparar a consulta
            $stmt = $conn->prepare($query);

            // Executar a consulta com os parâmetros
            $stmt->execute(['email' => $email]);

            // Buscar o usuário no banco
            $usuario = $stmt->fetch();
            // Caso não for encontrado nenhum usuário, $usuario = false
            if (!$usuario) {
                $dialogIcon = "&#x26A0;&#xFE0F;";
                $dialogTitle = "Erro";
                $dialogMessage = "Usuario Não Encontrado.";

                include 'dialog.php';
                
            } else {
                // Verifica se a senha bate com a Hash
                if (password_verify($password, $usuario['senhaHash'])) {
                    $_SESSION['usuario'] = [
                        'id' => $usuario['id'],
                        'email' => $usuario['email']
                    ];
                   // $_SESSION['usuario_nome'] = $usuario['nome'];

                    header("location: /index");
                } else {
                    $dialogIcon = "&#x26A0;&#xFE0F;";
                    $dialogTitle = "Erro";
                    $dialogMessage = "Senha Incorreta.";
                
                    include 'dialog.php';
                }
            }
        } catch (\Throwable $e) {
            die("Erro ao autenticar usuário: {$e}");
        }
    } else {
        echo "Dados do formulário não estão presentes.";
    }
}
?>
<?php include '../view/viewLogin.html'; ?>





