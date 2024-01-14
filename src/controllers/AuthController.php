<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../models/RegisterModel.php";
    
    class AuthController extends Controller {
        public function handleLogin(Request $request) {
            
            if($request->isPost()) {
                return "Handle submitted data";
            }
            
            $this->setLayout("login");
            return $this->render("login");
        }

        public function handleRegister(Request $request) {
            
            $registerModel = new RegisterModel();
            if($request->isPost()) {
                $registerModel->loadData($request->getBody());

                if($registerModel->validate() && $registerModel->register()) {
                    return "Success";
                }

                return $this->render("register", [
                    "model" => $registerModel
                ]);
            }
            
            $this->setLayout("register");
            return $this->render("register", [
                "model" => $registerModel
            ]);
        }

        public function handleLogout(Request $request) {
            if($request->isPost()) {
                return "Handle submitted data";
            }
        }
    }
?>