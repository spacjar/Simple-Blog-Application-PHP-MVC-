<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = "";
        $password = "";

        if(isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if(isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        
        try {
            require_once '../config_db.php';
            require_once "./login_model.inc.php";
            require_once "./login_controller.inc.php";

            // Error handlers
            $errors = [];

            if(is_input_empty($email, $password) !== false) {
                $errors["empty_input"] = "Please fill in all fields!";
            }
            if(is_email_valid($email) !== true) {
                $errors["invalid_email"] = "Please enter a valid email!";
            }

            $result = get_user_by_email($pdo, $email);

            if(is_email_wrong($result)) {
                $errors["wrong_email"] = "Email does not exist!";
            }

            if(!is_email_wrong($result) && is_password_wrong($password, $result["password"])) {
                $errors["wrong_password"] = "Incorrect password!";
            }

            require_once "../config_session.inc.php";

            if($errors) {
                $_SESSION["errors_login"] = $errors;

                $loginData = [
                    "email" => $email,
                    "password" => $password,
                ];

                $_SESSION["login_data"] = $loginData;

                header("Location: ../../login.php?login=failed");
                die();
            }

            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];
            
            session_write_close();
            session_id($sessionId);
            session_start();
            
            $_SESSION["user_id"] = $result["id"];
            $_SESSION["user_email"] = htmlspecialchars($result["email"]); // We sanitize the email before storing it in the session, because we might output it on the website

            $_SESSION["last_regeneration"] = time();

            header("Location: ../../dashboard/index.php");

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