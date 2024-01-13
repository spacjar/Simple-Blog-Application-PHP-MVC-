<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";

    class SignupController extends Controller {
        public function handleSignup(Request $request) {
            $body = Application::$app->request->getBody();
            echo "<pre>";
            var_dump($body);
            echo "</pre>";
            return "Handle submitted data";
        }

        public function handleErrors() {
            echo "Pepe";

            $errors = [
                "username" => "Username is required",
                "email" => "Email is required",
                "password" => "Password is required",
                "confirmPassword" => "Confirm password is required"
            ];

            return $this->render("signup", $errors);
        }
    }
?>