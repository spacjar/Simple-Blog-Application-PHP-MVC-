<?php
    // ? --- Model is used to create logic (functions) that interact with the database ---
    declare(strict_types=1);

    function get_user(object $pdo, string $email) {
        $query = "SELECT * FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); // or $stmt->execute(['email' => $email]);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>