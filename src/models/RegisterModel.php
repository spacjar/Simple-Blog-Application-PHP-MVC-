<?php
    require_once __DIR__ . "/../core/Model.php";
    
    class RegisterModel extends Model {
        public string $email = "";
        public string $username = "";
        public string $password = "";
        public string $passwordConfirm = "";

        public function register() {
            echo "Creating new user";
        }

        public function rules(): array {
            return [
                "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
                "username" => [self::RULE_REQUIRED],
                // "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 24]],
                "password" => [self::RULE_REQUIRED],
                "passwordConfirm" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]]
            ];
        }
    }
?>