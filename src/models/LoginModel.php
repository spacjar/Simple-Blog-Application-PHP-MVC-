<?php
    require_once __DIR__ . "/../core/Application.php";
    require_once __DIR__ . "/../core/Model.php";
    
    /**
     * Represents a Login Model.
     * 
     * This class extends the Model class and is used to handle login functionality.
     */
    class LoginModel extends Model {
        public string $email = "";
        public string $password = "";

        public static function tableName(): string {
            return "users";
        }

        public function attributes(): array {
            return ["email", "password"];
        }

        public function rules(): array {
            return [
                "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
                "password" => [self::RULE_REQUIRED]
            ];
        }

        /**
         * Logs in the user.
         *
         * This method is responsible for authenticating the user by checking if the provided email and password match a user in the database.
         * If the user is found and the password is correct, the user is logged in using the Application class.
         *
         * @return bool Returns true if the user is successfully logged in, false otherwise.
         */
        public function login() {
            try {
                $user = UserModel::getById(['email' => $this->email]);
                
                if (!$user) {
                    $this->addError('email', 'User does not exist with this email address');
                    return false;
                }
                if (!password_verify($this->password, $user->password)) {
                    $this->addError('password', 'Password is incorrect');
                    return false;
                }
    
                return Application::$app->login($user);
            } catch (Exception $e) {
                return false;
            }
        }
    }
?>