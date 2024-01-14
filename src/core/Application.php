<?php
    require_once __DIR__ . "/Router.php";
    require_once __DIR__ . "/Controller.php";
    require_once __DIR__ . "/Request.php";
    require_once __DIR__ . "/Response.php";
    require_once __DIR__ . "/Session.php";
    require_once __DIR__ . "/Database.php";

    class Application {
        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;
        public Response $response;
        public Controller $controller;
        public Session $session;
        public Database $db;
        public static Application $app;
        
        public function __construct(string $rootDir, array $config) {
            self::$app = $this;
            self::$ROOT_DIR = $rootDir;
            $this->request = new Request();
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);
            $this->controller = new Controller();
            $this->session = new Session();
            $this->db = new Database($config['db']);
        }

        public function run() {
            echo $this->router->resolve();
        }

        public function getController() {
            return $this->controller;
        }

        public function setController(Controller $controller) {
            $this->controller = $controller;
        }
    }
?>