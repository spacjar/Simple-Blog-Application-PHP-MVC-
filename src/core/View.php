<?php
    /**
     * The View class is responsible for rendering views and layouts in the application.
     */
    class View {
        public string $title = '';

        /**
         * Renders the specified view with the given parameters and returns the combined content with the layout.
         *
         * @param string $view The name of the view file to render.
         * @param array $params The parameters to pass to the view file.
         * @return string The combined content of the view and layout.
         */
        public function renderView($view, array $params)
        {
            $layoutName = Application::$app->layout;
            if (Application::$app->controller) {
                $layoutName = Application::$app->controller->layout;
            }
            $viewContent = $this->renderViewOnly($view, $params);
            ob_start();
            include_once Application::$ROOT_DIRECTORY."/views/layouts/$layoutName.php";
            $layoutContent = ob_get_clean();
            return str_replace('{{content}}', $viewContent, $layoutContent);
        }

        /**
         * Renders the specified view with the given parameters and returns the content of the view.
         *
         * @param string $view The name of the view file to render.
         * @param array $params The parameters to pass to the view file.
         * @return string The content of the view.
         */
        public function renderViewOnly($view, array $params)
        {
            foreach ($params as $key => $value) {
                $$key = $value;
            }
            ob_start();
            include_once Application::$ROOT_DIRECTORY."/views/$view.php";
            return ob_get_clean();
        }
    }
?>