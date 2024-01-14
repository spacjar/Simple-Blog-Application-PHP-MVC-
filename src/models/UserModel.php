<?php
    require_once __DIR__ . "/../core/UserBaseModel.php";
    
    class UserModel extends UserBaseModel {
        public int $id = 0;
        public string $email = "";
        public string $username = "";
        public string $password = "";
        public string $passwordConfirm = "";
        public ?string $created_at = "";
        public string $last_login = "";
        public int $deleted = 0;
        public ?string $deleted_at = "";
        public int $banned = 0;
        public ?string $banned_at = "";
        public int $super_admin = 0;

        public static function tableName(): string {
            return "users";
        }

        public function attributes(): array {
            return ["email", "username", "password", "created_at", "last_login"];
        }

        public static function primaryKey(): string {
            return "id";
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

        public function create() {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            $this->created_at = date("Y-m-d H:i:s");
            $this->last_login = date("Y-m-d H:i:s");
            return parent::create();
        }

        public function getDisplayName(): string {
            return $this->username;
        }
    }
?>