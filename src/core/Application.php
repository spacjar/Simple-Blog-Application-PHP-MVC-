<?php
    require_once __DIR__ . "/Router.php";
    require_once __DIR__ . "/Controller.php";
    require_once __DIR__ . "/Request.php";
    require_once __DIR__ . "/Response.php";

    class Application {
        public Router $router;
        public Request $request;
        public Response $response;
        public Controller $controller;
        public static Application $app;
        
        public function __construct() {
            self::$app = $this;
            $this->request = new Request();
            $this->response = new Response();
            $this->router = new Router($this->request, $this->response);
            $this->controller = new Controller();
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