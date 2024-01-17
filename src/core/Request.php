<?php
    /**
     * Represents an HTTP request.
     */
    class Request {
        private array $routeParams = [];
        
        /**
         * Get the HTTP method of the request.
         *
         * @return string The HTTP method.
         */
        public function getMethod() {
            return strtolower($_SERVER['REQUEST_METHOD']);
        }

        /**
         * Get the URL of the request.
         *
         * @return string The URL.
         */
        public function getUrl()
        {
            $path = $_SERVER['REQUEST_URI'];
            $position = strpos($path, '?');
            if ($position !== false) {
                $path = substr($path, 0, $position);
            }
            return $path;
        }

        /**
         * Check if the request method is GET.
         *
         * @return bool True if the request method is GET, false otherwise.
         */
        public function isGet () {
            return $this->getMethod() === 'get';
        }

        /**
         * Check if the request method is POST.
         *
         * @return bool True if the request method is POST, false otherwise.
         */
        public function isPost () {
            return $this->getMethod() === 'post';
        }

        /**
         * Get the request body data.
         *
         * @return array The request body data.
         */
        public function getBody() {
            $data = [];
            if ($this->isGet()) {
                foreach ($_GET as $key => $value) {
                    $data[$key] = $value;
                }
            }
            if ($this->isPost()) {
                foreach ($_POST as $key => $value) {
                    $data[$key] = $value;
                }
            }
            return $data;
        }

        /**
         * Get the uploaded image file.
         *
         * @param string $key The key of the uploaded image file.
         * @return array|null The uploaded image file information, or null if the file does not exist.
         */
        public function getImage($key) {
            if (isset($_FILES[$key])) {
                $image = $_FILES[$key];
                return [
                    'name' => $image['name'],
                    'type' => $image['type'],
                    'tmp_name' => $image['tmp_name'],
                    'error' => $image['error'],
                    'size' => $image['size'],
                ];
            }
            return null;
        }

        /**
         * Set the route parameters for the request.
         *
         * @param array $params The route parameters.
         * @return Request The updated Request object.
         */
        public function setRouteParams($params)
        {
            $this->routeParams = $params;
            return $this;
        }
    
        /**
         * Get the route parameters of the request.
         *
         * @return array The route parameters.
         */
        public function getRouteParams()
        {
            return $this->routeParams;
        }
    
        /**
         * Get a specific route parameter of the request.
         *
         * @param string $param The name of the route parameter.
         * @param mixed $default The default value if the route parameter does not exist.
         * @return mixed The value of the route parameter, or the default value if it does not exist.
         */
        public function getRouteParam($param, $default = null)
        {
            return $this->routeParams[$param] ?? $default;
        }

        /**
         * Get a specific query parameter of the request.
         *
         * @param string $param The name of the query parameter.
         * @param mixed $default The default value if the query parameter does not exist.
         * @return mixed The value of the query parameter, or the default value if it does not exist.
         */
        public function getQueryParam($param, $default = null)
        {
            return $_GET[$param] ?? $default;
        }
    }
?>