<?php
    require_once __DIR__ . "/../core/DBModel.php";
    
    class RegisterModel extends DBModel {
        public string $email = "";
        public string $username = "";
        public string $password = "";
        public string $passwordConfirm = "";

        public function tableName(): string {
            return "users";
        }

        public function attributes(): array {
            // return ["email", "username", "password", "created_at", "last_login"];
            return ["email", "username", "password"];
        }

        public function register() {
            return $this->create();
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