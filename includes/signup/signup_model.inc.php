<?php
    // ? --- Model is used to create logic (functions) that interact with the database ---
    declare(strict_types=1);

    function get_username(object $pdo, string $username): mixed {
        $query = "SELECT * FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR); // or $stmt->execute(['username' => $username]);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function get_email(object $pdo, string $email): mixed {
        $query = "SELECT * FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); // or $stmt->execute(['email' => $email]);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function set_user(object $pdo, string $username, string $email, string $password): void {
        $query = "INSERT INTO users (username, email, password, created_at, last_login) VALUES (:username, :email, :password, :createdAt, :lastLogin);";
        $stmt = $pdo->prepare($query);

        $options = [
            'cost' => 12,
        ];

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        $createdAt = date('Y-m-d H:i:s');
        $lastLogin = date('Y-m-d H:i:s');

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
        $stmt->bindParam(':lastLogin', $lastLogin, PDO::PARAM_STR);
        $stmt->execute();

        return;
    }
?>