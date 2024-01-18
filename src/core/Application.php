<?php
    require_once __DIR__ . "/Router.php";
    require_once __DIR__ . "/Controller.php";
    require_once __DIR__ . "/Request.php";
    require_once __DIR__ . "/Response.php";
    require_once __DIR__ . "/Session.php";
    require_once __DIR__ . "/Database.php";
    require_once __DIR__ . "/View.php";

    /**
     * Class Application
     * 
     * The Application class represents the core of the blog application.
     * It handles the initialization of various components such as the router, request, response, database, session, and view.
     * It also provides methods for user authentication and authorization.
     */
    class Application {
        public static Application $app;

        public static string $ROOT_DIRECTORY;
        public string $userClass;
        public string $layout = "main";

        public Router $router;
        public Request $request;
        public Response $response;
        public Controller $controller;
        public Session $session;
        public Database $db;
        public View $view;
        public ?UserModel $user;
        
        public function __construct(string $rootDir, array $config) {
            $this->user = null;
            $this->userClass = $config['userClass'];

            self::$app = $this;
            self::$ROOT_DIRECTORY = $rootDir;

            $this->request = new Request();
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);
            $this->db = new Database($config['db']);
            $this->controller = new Controller();
            $this->session = new Session();
            $this->view = new View();

            $primaryValue = $this->session->get("user");
            if($primaryValue) {
                $primaryKey = $this->userClass::primaryKey();
                $user = $this->userClass::getById([$primaryKey => $primaryValue]);

                // Checks if the user exists in the DB
                if ($user === false) {
                    $user = null;
                }
                
                $this->user = $user;
            } else {
                $this->user = null;
            }
        }


        /**
         * Logs in a user by setting the user object in the application and storing the user's primary key value in the session.
         *
         * @param UserModel $user The user model object to be logged in.
         * @return bool Returns true if the user is successfully logged in, false otherwise.
         */
        public function login(UserModel $user) {
            $this->user = $user;
            $primaryKey = $user->primaryKey();
            $primaryValue = $user->{$primaryKey};
            $this->session->set("user", $primaryValue);
            return true;
        }

        /**
         * Logs out the currently logged in user by removing the user object from the application and session.
         */
        public function logout() {
            $this->user = null;
            $this->session->remove("user");
        }

        /**
         * Checks if the current user is a guest (not logged in).
         *
         * @return bool Returns true if the user is a guest, false otherwise.
         */
        public static function isGuest() {
            return !self::$app->user;
        }

        /**
         * Checks if the current user is an admin.
         *
         * @return bool Returns true if the user is an admin, false otherwise.
         */
        public static function isAdmin() {
            if(self::$app->user->super_admin === 1) {
                return true;
            }
            return false;
        }

        /**
         * Runs the application by resolving the router and handling any exceptions that occur.
         */
        public function run() {
            try {
                echo $this->router->resolve();
            } catch(Exception $e) {
                echo $this->router->renderView("_error", [
                    "exception" => $e
                ]);
            }
        }
    }
?>