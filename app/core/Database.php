<?php

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $port;

    private $conn;
    private static $instance = null;

    private function __construct()
    {
        $this->host = $_ENV['HOST'] ?? getenv('HOST') ?: 'localhost';
        $this->db_name = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: 'moneyguard';
        $this->username = $_ENV['USERNAME'] ?? getenv('USERNAME') ?: 'moneyguard';
        $this->password = $_ENV['PASSWORD'] ?? getenv('PASSWORD') ?: 'moneyguard';
        $this->port = $_ENV['PORT'] ?? getenv('PORT') ?: '5432';
        
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";

        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erro de Conexão: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    private function __clone()
    {
    }
}

?>
