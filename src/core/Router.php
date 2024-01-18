<?php
    require_once(__DIR__ . '/exceptions/NotFoundException.php');


    /**
     * Class Router
     * 
     * The Router class handles routing in the application.
     */
    class Router {
        /**
         * @var Request The request object.
         */
        public Request $request;
        
        /**
         * @var Response The response object.
         */
        public Response $response;
        
        /**
         * @var array The route map containing registered routes.
         */
        private array $routeMap = [];

        /**
         * Router constructor.
         * 
         * @param Request $request The request object.
         * @param Response $response The response object.
         */
        public function __construct(Request $request, Response $response) {
            $this->request = $request;
            $this->response = $response;
        }

        /**
         * Register a GET route.
         * 
         * @param string $url The URL pattern.
         * @param mixed $callback The callback function or controller method.
         */
        public function get(string $url, $callback) {
            $this->routeMap['get'][$url] = $callback;
        }

        /**
         * Register a POST route.
         * 
         * @param string $url The URL pattern.
         * @param mixed $callback The callback function or controller method.
         */
        public function post(string $url, $callback) {
            $this->routeMap['post'][$url] = $callback;
        }

        /**
         * Get the route map for a specific HTTP method.
         * 
         * @param string $method The HTTP method.
         * @return array The route map for the specified method.
         */
        public function getRouteMap(string $method) {
            return $this->routeMap[$method] ?? [];
        }

        /**
         * Retrieves the callback function for the current request URL.
         *
         * @return mixed The callback function for the matched route, or false if no route is found.
         */
        public function getCallback()
        {
            $method = $this->request->getMethod();
            $url = $this->request->getUrl();
            // Trim slashes
            $url = trim($url, '/');
    
            // Get all routes for current request method
            $routes = $this->getRouteMap($method);
    
            $routeParams = false;
    
            // Start iterating registed routes
            foreach ($routes as $route => $callback) {
                // Trim slashes
                $route = trim($route, '/');
                $routeNames = [];
    
                if (!$route) {
                    continue;
                }
    
                // Find all route names from route and save in $routeNames
                if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                    $routeNames = $matches[1];
                }
    
                // Convert route name into regex pattern
                $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";
    
                // Test and match current route against $routeRegex
                if (preg_match_all($routeRegex, $url, $valueMatches)) {
                    $values = [];
                    for ($i = 1; $i < count($valueMatches); $i++) {
                        $values[] = $valueMatches[$i][0];
                    }
                    $routeParams = array_combine($routeNames, $values);
    
                    $this->request->setRouteParams($routeParams);
                    return $callback;
                }
            }
    
            return false;
        }

        /**
         * Resolves the current request by finding the appropriate callback based on the request method and URL.
         * If a callback is found, it is executed with the request and response objects.
         * If no callback is found, an exception is thrown.
         *
         * @return mixed The result of the executed callback.
         * @throws NotFoundException If no callback is found for the request.
         */
        public function resolve()
        {
            $method = $this->request->getMethod();
            $url = $this->request->getUrl();
            $callback = $this->routeMap[$method][$url] ?? false;
            if (!$callback) {
    
                $callback = $this->getCallback();
    
                if ($callback === false) {
                    throw new NotFoundException();
                }
            }
            if (is_string($callback)) {
                return $this->renderView($callback);
            }
            if (is_array($callback)) {
                $controller = new $callback[0];
                $controller->action = $callback[1];
                Application::$app->controller = $controller;
                $middlewares = $controller->getMiddlewares();
                foreach ($middlewares as $middleware) {
                    $middleware->execute();
                }
                $callback[0] = $controller;
            }
            return call_user_func($callback, $this->request, $this->response);
        }
        
        /**
         * Renders a view with optional parameters.
         *
         * @param string $view The name of the view to render.
         * @param array $params An optional array of parameters to pass to the view.
         * @return string The rendered view.
         */
        public function renderView($view, $params = [])
        {
            return Application::$app->view->renderView($view, $params);
        }

        /**
         * Renders a view without passing any parameters.
         *
         * @param string $view The name of the view to render.
         * @param array $params An optional array of parameters to pass to the view.
         * @return string The rendered view.
         */
        public function renderViewOnly($view, $params = [])
        {
            return Application::$app->view->renderViewOnly($view, $params);
        }
    }
?>