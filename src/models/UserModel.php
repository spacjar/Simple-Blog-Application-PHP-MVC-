<?php
    require_once __DIR__ . "/../core/DBModel.php";
    
    class UserModel extends DBModel {
        public string $email = "";
        public string $username = "";
        public string $password = "";
        public string $passwordConfirm = "";
        public string $created_at = "";
        public string $last_login = "";

        public function tableName(): string {
            return "users";
        }

        public function attributes(): array {
            return ["email", "username", "password", "created_at", "last_login"];
        }

        public function create() {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            $this->created_at = date("Y-m-d H:i:s");
            $this->last_login = date("Y-m-d H:i:s");
            return parent::create();
        }

        public function rules(): array {
            return [
                "email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, "class" => self::class]],
                "username" => [self::RULE_REQUIRED, [self::RULE_UNIQUE, "class" => self::class]],
                // "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 24]],
                "password" => [self::RULE_REQUIRED],
                "passwordConfirm" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]]
            ];
        }
    }
?>