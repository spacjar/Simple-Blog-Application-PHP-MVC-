<?php
    class Database {
        public PDO $pdo;

        public function __construct(array $dbConfig = []) {
            $db_host = $dbConfig['host'] ?? '';
            $db_name = $dbConfig['name'] ?? '';
            $db_user = $dbConfig['user'] ?? '';
            $db_password = $dbConfig['password'] ?? '';

            $dsn = "mysql:host=$db_host;dbname=$db_name";

            try {
                $this->pdo = new PDO($dsn, $db_user, $db_password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // header("Location: ../views/error.php")
                die('Connection failed: ' . $e->getMessage());
            }
        }

        public function prepare($sql): PDOStatement
        {
            return $this->pdo->prepare($sql);
        }
    }
?>