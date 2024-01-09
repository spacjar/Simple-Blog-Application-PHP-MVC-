<?php
    // ? --- Controller is used to handle input and interact with the model (our application logic) ---
    declare(strict_types=1);

    function is_input_empty(string $username, string $email, string $password, string $password_repeat): bool {
        if(empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
            return true;
        }

        return false;
    }

    function is_email_valid(string $email): bool {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    function is_password_match(string $password, string $password_repeat): bool {
        if($password !== $password_repeat) {
            return false;
        }

        return true;
    }

    function is_username_available(object $pdo, string $username): bool {
        if (!get_username($pdo, $username)) {
            return true;
        }

        return false;
    }

    function is_email_available(object $pdo, string $email): bool {
        if(!get_email($pdo, $email)) {
            return true;
        }

        return false;
    }

    function create_user(object $pdo, string $username, string $email, string $password): void {
        set_user($pdo, $username, $email, $password);
    }
?>