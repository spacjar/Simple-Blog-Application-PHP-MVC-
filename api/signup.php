<?php
    require_once "../includes/config_db.php";
    require_once "../includes/signup/signup_model.inc.php";
    require_once "../includes/signup/signup_controller.inc.php";

    function checkUsername($pdo, $username) {
        if(is_username_available($pdo, $username) === true) {
            return array("isUsernameAvailable" => true);
        }
        
        return array("isUsernameAvailable" => false);
    }

    function checkEmail($pdo, $email) {
        if(is_email_available($pdo, $email) === true) {
            return array("isEmailAvailable" => true);
        }

        return array("isEmailAvailable" => false);
    }

    $data = array();

    if(isset($_GET["username"])) {
        $username = $_GET["username"];
        $data = checkUsername($pdo, $username);
    } elseif(isset($_GET["email"])) {
        $email = $_GET["email"];
        $data = checkEmail($pdo, $email);
    }

    header("Content-Type: application/json");

    echo json_encode($data);
?>