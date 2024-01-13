<?php
    // ? --- Controller is used to handle input and interact with the model (our application logic) ---
    declare(strict_types=1);

    function is_input_empty(string $email, string $password): bool {
        if(empty($email) || empty($password)) {
            return true;
        }

        return false;
    }

    function get_user_by_email(object $pdo, string $email) {
        get_user($pdo, $email);
    }

    function is_email_valid(string $email): bool {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    function is_email_wrong($result): bool {
        if(!$result) {
            return true;
        }

        return false;
    }

    function is_password_wrong(string $password, string $hashed_password): bool {
        if(!password_verify($password, $hashed_password)) {
            return true;
        }

        return false;
    }
?>