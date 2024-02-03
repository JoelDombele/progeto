<?php
   require_once "connection.php";
   $mensagem = "";

   $database = new DB();
   $conn = $database->connect();

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        if (strlen($nome) < 5) {
            echo "O nome deve ter pelo menos 5 caracteres.";
            exit;
          }
          
          // Validação do e-mail
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "O e-mail é inválido.";
            exit;
          }
          
          // Validação da senha
          if (strlen($senha) < 8) {
            echo "A senha deve ter pelo menos 8 caracteres.";
            exit;
          }
          $stmt = $conn->prepare("INSERT INTO instrutor (instrutor_nome, instrutor_email, instrutor_senha) VALUES (:nome, :email, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        if ($stmt->execute()) {
            $mensagem = "Cadastro feito com sucesso !";
            header("Location: ../php/cursos.php");
        } else {
            $mensagem = "Erro ao criar registro.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/homepage.css">
   
</head>
<body>
<nav class="navBar">
            <h1 class="logo">EAD</h1>
            <ul class="nav-links">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Cursos</a></li>
                <li><a href="#">Categorias</a></li>
                <li><a href="login.php" class="ctn">Login</a></li>
                <li><a href="cadastrar.php" class="ctn">sign in</a></li>
            </ul>
            <img src="../imagens/menu-aberto.png" alt="" class="menu-bnt">

    </nav>
<header class="instrutor">
        <div class="overlay">
            <div class="header-content">
                <h2>Crie Conteudos e Ajude muitas mentes Evoluirem</h2>
                <div class="line"></div>
                <h1>Encontre a tua inspiração</h1>
                <a href="#" class="ctn">Aprenda mais</a>
            </div>
        </div>
</header>
<section class="tours">
        <div class="row">
            <div class="col content-col">
                <h1>Torne se um instrutor</h1>
                <div class="line"></div>
                <p>Ser um professor ou instrutor é abraçar o papel de inspiração, guiando mentes e corações rumo ao conhecimento  e crescimento. A cada aula, você não apenas transmite informações, mas planta sementes de curiosidade, desafiando alunos a explorarem seus limites e descobrirem o extraordinário.</p>
               
                
        <a href="#" class="ctn">Explorar</a>
            </div>
            <div class="col image-col">
                <form action="" method="post">
                <div class="form">
        <h1>Registra-te</h1>
        <?php if (!empty($mensagem)) : ?>
        <script type='text/javascript'>alert('<?php echo $mensagem; ?>');</script>
    <?php endif; ?>
        <input type="text" name="nome" required placeholder="Nome">
        <br><br>
        <input type="email" name="email" required placeholder="Email">
        <br><br>
        <input type="password" name="senha" required placeholder="Senha">
        <br><br>
        <input type="submit" value="Enviar" name="confirmar">
    </div>
</div> 
                </form>

                </div>
            </div>
        </div>
    </section>
    


        <section class="footer">
        <p>Explore as capacidades do seu cerebro. Projeto desenvolvido pelo grupo nº 2</p>
        <p>Copyright @ 2023 EAD</p>
    </section>
    <script>
        const menuBnt = document.querySelector('.menu-bnt')
        const navlinks = document.querySelector('.nav-links')

        menuBnt.addEventListener('click',()=>{
            navlinks.classList.toggle('mobile-menu')
        })
    </script>


</form>
    
</body>
</html>