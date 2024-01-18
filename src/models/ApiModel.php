<?php
    require_once __DIR__ . "/../core/DBModel.php";
    
    /**
     * Represents an API model (for all REST API endpoints) that extends the DBModel class.
     */
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


        /**
         * Checks if an email is available in the database.
         *
         * @param string $email The email to check.
         * @return bool Returns true if the email is available, false otherwise.
         */
        public static function isEmailAvailable(string $email) {
            try {
                $query = "SELECT * FROM users WHERE email = :email";
                $statement = self::prepare($query);
                $statement->bindValue(":email", $email);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                // Returns true if the email does not exist in the database.
                if (!$user) {
                    return true;
                } 
                
                return false;
            } catch (PDOException $e) {
                return false;
            }
        }


        /**
         * Checks if a username is available in the database.
         *
         * @param string $username The username to check.
         * @return bool Returns true if the username is available, false otherwise.
         */
        public static function isUsernameAvailable(string $username) {
            try {
                $query = "SELECT * FROM users WHERE username = :username";
                $statement = self::prepare($query);
                $statement->bindValue(":username", $username);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                // Returns true if the username does not exist in the database.
                if (!$user) {
                    return true;
                } 
                
                return false;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>