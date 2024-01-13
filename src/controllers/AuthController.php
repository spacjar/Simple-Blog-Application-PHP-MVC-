<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    
    class AuthController extends Controller {
        // public $setLayout;
        public function handleLogin(Request $request) {
            
            if($request->isPost()) {
                return "Handle submitted data";
            }
            
            $this->setLayout("login");
            return $this->render("login");
        }

        public function handleRegister(Request $request) {
            
            if($request->isPost()) {
                return "Handle submitted data";
            }
            
            $this->setLayout("register");
            return $this->render("register");
        }

        public function handleLogout(Request $request) {
            if($request->isPost()) {
                return "Handle submitted data";
            }
        }
    }
?>