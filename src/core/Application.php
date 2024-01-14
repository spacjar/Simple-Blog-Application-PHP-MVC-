<?php
    require_once __DIR__ . "/Router.php";
    require_once __DIR__ . "/Controller.php";
    require_once __DIR__ . "/Request.php";
    require_once __DIR__ . "/Response.php";
    require_once __DIR__ . "/Session.php";
    require_once __DIR__ . "/Database.php";

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

            $primaryValue = $this->session->get("user");
            if($primaryValue) {
                $primaryKey = $this->userClass::primaryKey();
                $this->user = $this->userClass::getById([$primaryKey => $primaryValue]);
            } else {
                $this->user = null;
            }
        }

        public function run() {
            try {
                echo $this->router->resolve();
            } catch(Exception $e) {
                $this->response->setStatusCode($e->getCode());
                echo $this->router->renderView("_error", [
                    "exception" => $e
                ]);
            }
        }

        public function getController() {
            return $this->controller;
        }

        public function setController(Controller $controller) {
            $this->controller = $controller;
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
    }
?>