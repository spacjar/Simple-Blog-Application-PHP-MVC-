<?php
    require_once __DIR__ . "/../core/Application.php";
    require_once __DIR__ . "/../core/DBModel.php";
    
    class ApiModel extends DBModel {
        public static function primaryKey(): string {
            return "id";
        }

        public static function tableName(): string {
            return "users";
        }

        public function attributes(): array {
            return [];
        }

        public function rules(): array {
            return [];
        }

        public static function isEmailAvailable($email) {
            $query = "SELECT * FROM users WHERE email = :email";
            $statement = self::prepare($query);
            $statement->bindValue(":email", $email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return true;
            } 
            
            return false;
        }

        public static function isUsernameAvailable($username) {
            $query = "SELECT * FROM users WHERE username = :username";
            $statement = self::prepare($query);
            $statement->bindValue(":username", $username);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return true;
            } 
            
            return false;
        }
    }
?>