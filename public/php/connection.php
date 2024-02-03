<?php
class DB {
    private $host = 'localhost';
   
    private $db_name = 'ead';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db_name;charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Registre o erro em um arquivo de log ou no sistema de monitoramento
            error_log('Erro de conexão: ' . $e->getMessage());
            // Forneça uma mensagem genérica ao usuário
           
        }

        return $this->conn;
    }
}
?>



