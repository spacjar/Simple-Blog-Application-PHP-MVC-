<?php
    class Request {
        private array $routeParams = [];
        
        public function getMethod() {
            return strtolower($_SERVER['REQUEST_METHOD']);
        }

        public function getUrl()
        {
            $path = $_SERVER['REQUEST_URI'];
            $position = strpos($path, '?');
            if ($position !== false) {
                $path = substr($path, 0, $position);
            }
            return $path;
        }

        public function isGet () {
            return $this->getMethod() === 'get';
        }

        public function isPost () {
            return $this->getMethod() === 'post';
        }

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

        public function setRouteParams($params)
        {
            $this->routeParams = $params;
            return $this;
        }
    
        public function getRouteParams()
        {
            return $this->routeParams;
        }
    
        public function getRouteParam($param, $default = null)
        {
            return $this->routeParams[$param] ?? $default;
        }

        public function getQueryParam($param, $default = null)
        {
            return $_GET[$param] ?? $default;
        }
    }
?>