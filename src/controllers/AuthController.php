<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../models/UserModel.php";
    
    class AuthController extends Controller {
        public function handleLogin(Request $request) {
            
            if($request->isPost()) {
                return "Handle submitted data";
            }
            
            $this->setLayout("login");
            return $this->render("login");
        }

        public function handleRegister(Request $request) {
            
            $user = new UserModel();
            if($request->isPost()) {
                $user->loadData($request->getBody());

                if($user->validate() && $user->create()) {
                    Application::$app->session->setFlash("success", "Thanks for registering");
                    Application::$app->response->redirect("/dashboard");
                }

                return $this->render("register", [
                    "model" => $user
                ]);
            }
            
            $this->setLayout("register");
            return $this->render("register", [
                "model" => $user
            ]);
        }

        public function handleLogout(Request $request) {
            if($request->isPost()) {
                return "Handle submitted data";
            }
        }
    }
?>