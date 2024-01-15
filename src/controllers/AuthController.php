<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../core/Response.php";
    require_once __DIR__ . "/../models/UserModel.php";
    require_once __DIR__ . "/../models/LoginModel.php";
    
    class AuthController extends Controller {
        public function handleLogin(Request $request, Response $response) {
            $loginModel = new LoginModel();

            if($request->isPost()) {
                $loginModel->loadData($request->getBody());

                if($loginModel->validate() && $loginModel->login()) {
                    $response->redirect("/dashboard");
                    return;
                }

                $this->setLayout("login");
                return $this->render("login", [
                    "model" => $loginModel
                ]);
            }
            
            $this->setLayout("login");
            return $this->render("login", [
                "model" => $loginModel
            ]);
        }

        public function handleRegister(Request $request, Response $response) {
            $user = new UserModel();

            if($request->isPost()) {
                $user->loadData($request->getBody());

                if($user->validate() && $user->create()) {
                    Application::$app->session->setFlash("success", "Thanks for registering");
                    $response->redirect("/login");
                }

                $this->setLayout("register");
                return $this->render("register", [
                    "model" => $user
                ]);
            }
            
            $this->setLayout("register");
            return $this->render("register", [
                "model" => $user
            ]);
        }

        public function handleLogout(Request $request, Response $response) {
            if($request->isPost()) {
                Application::$app->logout();
                $response->redirect("/");
            }
        }
    }
?>