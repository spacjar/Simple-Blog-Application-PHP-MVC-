<?php
    declare(strict_types=1);

    function get_all_posts(object $pdo) {
        $query = "SELECT posts.*, users.username, users.email FROM posts LEFT JOIN users ON posts.author_id = users.id WHERE posts.deleted = 0";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>