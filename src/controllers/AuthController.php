<?php
    require_once __DIR__ . "/../core/Controller.php";
    require_once __DIR__ . "/../core/Request.php";
    require_once __DIR__ . "/../core/Response.php";
    require_once __DIR__ . "/../models/UserModel.php";
    require_once __DIR__ . "/../models/LoginModel.php";
    
    /**
     * AuthController class.
     * 
     * This class is responsible for handling authentication related operations.
     * It extends the Controller class.
     */
    class AuthController extends Controller {

        
        /**
         * Handles the login functionality.
         *
         * @param Request $request The request object.
         * @param Response $response The response object.
         * @return void
         */
        public function handleLogin(Request $request, Response $response) {
            if(!Application::isGuest()) {
                $response->redirect("dashboard/posts");
                return;
            }
            
            $loginModel = new LoginModel();

            if($request->isPost()) {
                $loginModel->loadData($request->getBody());

                if($loginModel->validate() && $loginModel->login()) {
                    $response->redirect("dashboard/posts");
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


        /**
         * Handles the registration process.
         *
         * @param Request $request The request object.
         * @param Response $response The response object.
         * @return void 
         */
        public function handleRegister(Request $request, Response $response) {
            // Check if user is already logged in
            if(!Application::isGuest()) {
                $response->redirect("dashboard/posts");
                return;
            }

            $user = new UserModel();

            if($request->isPost()) {
                $user->loadData($request->getBody());

                // Validate user data and create new user
                if($user->validate() && $user->create()) {
                    Application::$app->session->setFlash("success", "Thanks for registering");
                    $response->redirect("login");
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


        /**
         * Handles the logout functionality.
         *
         * @param Request $request The request object.
         * @param Response $response The response object.
         * @return void
         */
        public function handleLogout(Request $request, Response $response) {
            if($request->isPost()) {
                Application::$app->logout();
                $response->redirect("./");
            }
        }
    }
?>