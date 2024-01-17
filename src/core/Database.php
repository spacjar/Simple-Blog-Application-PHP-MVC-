<?php
    /**
     * Class Database
     * 
     * Represents a database connection and provides methods for interacting with the database.
     */
    class Database {
        public PDO $pdo;

        /**
         * Database constructor.
         * 
         * @param array $dbConfig The database configuration options.
         */
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
                die('Connection failed: ' . $e->getMessage());
            }
        }

        /**
         * Prepares an SQL statement for execution.
         * 
         * @param string $sql The SQL statement to prepare.
         * @return PDOStatement The prepared statement object.
         */
        public function prepare($sql): PDOStatement
        {
            return $this->pdo->prepare($sql);
        }
    }
?>