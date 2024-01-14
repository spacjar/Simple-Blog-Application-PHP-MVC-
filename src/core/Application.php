<?php
    require_once __DIR__ . "/Router.php";
    require_once __DIR__ . "/Controller.php";
    require_once __DIR__ . "/Request.php";
    require_once __DIR__ . "/Response.php";
    require_once __DIR__ . "/Session.php";
    require_once __DIR__ . "/Database.php";
    require_once __DIR__ . "/View.php";

    class Application {
        public static Application $app;

        public static string $ROOT_DIR;
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
            self::$ROOT_DIR = $rootDir;

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


        public function login(UserModel $user) {
            $this->user = $user;
            $primaryKey = $user->primaryKey();
            $primaryValue = $user->{$primaryKey};
            $this->session->set("user", $primaryValue);
            return true;
        }

        public function logout() {
            $this->user = null;
            $this->session->remove("user");
        }

        public static function isGuest() {
            return !self::$app->user;
        }

        public function run() {
            try {
                echo $this->router->resolve();
            } catch(Exception $e) {
                // if($e->getCode() === 403) {
                //     $this->response->redirect("/login");
                //     return;
                // }
                // $this->response->setStatusCode($e->getCode());
                echo $this->router->renderView("_error", [
                    "exception" => $e
                ]);
            }
        }
    }
?>