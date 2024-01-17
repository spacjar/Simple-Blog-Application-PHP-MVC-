<?php
    /**
     * AuthMiddleware class is responsible for handling authentication-related tasks.
     * It extends the BaseMiddleware class and implements middleware functionality.
     */
    @require_once __DIR__ . "/BaseMiddleware.php";
    @require_once __DIR__ . "/../exceptions/ForbiddenException.php";

    class AuthMiddleware extends BaseMiddleware {
        /**
         * @var array $actions An array of actions that require authentication.
         */
        public array $actions;

        /**
         * AuthMiddleware constructor.
         * @param array $actions An array of actions that require authentication.
         */
        public function __construct(array $actions = []) {
            $this->actions = $actions;
        }

        /**
         * Executes the middleware logic.
         * If the user is a guest and the current action requires authentication, a ForbiddenException is thrown.
         * If the user is banned, they are redirected to the banned page and logged out.
         * If the user is deleted, they are redirected to the deleted page and logged out.
         */
        public function execute() {
            if(Application::isGuest()) {
                if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                    throw new ForbiddenException();
                }
            } else if(Application::$app->user->banned) {
                Application::$app->response->redirect("./?banned=true");
                Application::$app->logout();
                return;
            } else if(Application::$app->user->deleted) {
                Application::$app->response->redirect("./?deleted=true");
                Application::$app->logout();
                return;
            }
        }
    }
?>