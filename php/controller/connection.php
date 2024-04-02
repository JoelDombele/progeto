<?php
class DB {
    private $host = '127.0.0.1'; // Alterado de 'localhost'
    private $port = '3306'; // Porta padrão do MySQL no LAMPP
    private $db_name = 'ead';
    private $username = 'root';
    private $password = ''; // Senha do MySQL, se aplicável
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            // Removido a parte do socket do DSN
            
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db_name;charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Logar o erro em um arquivo de log ou sistema de monitoramento

            error_log('Erro de conexão: ' . $e->getMessage());

            // Forneça uma mensagem genérica ao usuário
            
            die('Não foi possível conectar ao banco de dados.');
        }

        return $this->conn;
    }
}
?>
