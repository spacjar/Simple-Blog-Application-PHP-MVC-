<?php
    require_once __DIR__ . "/../core/Application.php";
    require_once __DIR__ . "/../core/Model.php";
    
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

        public function login() {
            $user = UserModel::getById(['email' => $this->email]);
            
            if (!$user) {
                $this->addError('email', 'User does not exist with this email address');
                return false;
            }
            if (!password_verify($this->password, $user->password)) {
                $this->addError('password', 'Password is incorrect');
                return false;
            }

            echo "<pre>";
            var_dump($user);
            echo "</pre>";

            return Application::$app->login($user);
        }
    }
?>