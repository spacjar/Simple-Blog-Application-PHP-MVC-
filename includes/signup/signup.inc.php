<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = "";
        $email = "";
        $password = "";
        $password_repeat = "";

        if(isset($_POST['username'])) {
            $username = $_POST['username'];
        }

        if(isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if(isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        if(isset($_POST['password_repeat'])) {
            $password_repeat = $_POST['password_repeat'];
        }
        
        try {
            require_once '../config_db.php';
            require_once "./signup_model.inc.php";
            require_once "./signup_controller.inc.php";

            // Error handlers
            $errors = [];

            if(is_input_empty($username, $email, $password, $password_repeat) !== false) {
                $errors["empty_input"] = "Please fill in all fields!";
            }
            if(is_email_valid($email) !== true) {
                $errors["invalid_email"] = "Please enter a valid email!";
            }
            if(is_password_match($password, $password_repeat) !== true) {
                $errors["passwords_dont_match"] = "Passwords don't match!";
            }
            if(is_username_available($pdo, $username) !== true) {
                $errors["username_taken"] = "Username is already taken!";
            }
            if(is_email_available($pdo, $email) !== true) {
                $errors["email_used"] = "Email address is already registered!";
            }

            require_once "../config_session.inc.php";

            if($errors) {
                $_SESSION["errors_signup"] = $errors;

                $signupData = [
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                    "password_repeat" => $password_repeat
                ];

                $_SESSION["signup_data"] = $signupData;

                header("Location: ../../signup.php");
                die();
            }

            create_user($pdo, $username, $email, $password);

            header("Location: ../../index.php?signup=success");

            $pdo = null;
            $stmt = null;

            die();
        } catch(PDOException $e) { 
            die("Query failed: " . $e->getMessage());
        }
    } else {
        header("Location: ../../index.php");
        die();
    }
?>