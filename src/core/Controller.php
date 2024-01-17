<?php
    /**
     * The Controller class represents the base controller for all controllers in the application.
     * It provides common functionality such as setting the layout, rendering views, and registering middlewares.
     */
    class Controller {
        public string $layout = 'main';
        public string $action = '';
        protected array $middlewares = [];

        /**
         * Sets the layout for the controller.
         *
         * @param string $layout The layout name.
         * @return void
         */
        public function setLayout($layout): void {
            $this->layout = $layout;
        }
    
        /**
         * Renders a view with optional parameters.
         *
         * @param string $view The view name.
         * @param array $params The parameters to be passed to the view.
         * @return string The rendered view.
         */
        public function render($view, $params = []): string {
            return Application::$app->router->renderView($view, $params);
        }
    
        /**
         * Registers a middleware for the controller.
         *
         * @param BaseMiddleware $middleware The middleware instance.
         * @return void
         */
        public function registerMiddleware(BaseMiddleware $middleware) {
            $this->middlewares[] = $middleware;
        }

        /**
         * Gets the registered middlewares for the controller.
         *
         * @return array The array of registered middlewares.
         */
        public function getMiddlewares(): array {
            return $this->middlewares;
        }
    }
?>