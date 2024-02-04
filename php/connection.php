<?php
class DB {
    private $host = '127.0.0.1';
    private $port = '3306'; // Change this to the appropriate port for your MySQL server
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
            // Log the error to a log file or monitoring system
            error_log('Connection error: ' . $e->getMessage());
            // Provide a generic message to the user
            // You can customize this message based on your needs
            die('Unable to connect to the database.');
        }

        return $this->conn;
    }
}

?>



