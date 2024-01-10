<?php
    require_once './config.php';

    class Database {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function getAllPosts() {
            $query = "SELECT posts.*, users.username, users.email FROM posts LEFT JOIN users ON posts.author_id = users.id WHERE posts.deleted = 0";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // public function getPostById($id) {
        //     $query = "SELECT * FROM posts WHERE id = :id";
        //     $stmt = $this->pdo->prepare($query);
        //     $stmt->execute(['id' => $id]);
        
        //     return $stmt->fetch(PDO::FETCH_ASSOC);
        // }

        // public function checkEmailAvailability(email) {
        //     $query = "SELECT * FROM users WHERE email = :email";
        //     $stmt = $this->pdo->prepare($query);
        //     $stmt->execute(['email' => $email]);
        
        //     return $stmt->fetch(PDO::FETCH_ASSOC);
        // }
    }

    $database = new Database($pdo);
?>
