<?php
    @require_once __DIR__ . "/BaseMiddleware.php";
    @require_once __DIR__ . "/../exceptions/ForbiddenException.php";

    class AuthMiddleware extends BaseMiddleware {
        public array $actions;

        public function __construct(array $actions = []) {
            $this->actions = $actions;
        }

        public function execute() {
            if(Application::isGuest()) {
                if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                    throw new ForbiddenException();
                }
            } else if(Application::$app->user->banned) {
                // TODO : Add flash message
                Application::$app->response->redirect("./?banned=true");
                Application::$app->logout();
                return;
            } else if(Application::$app->user->deleted) {
                // TODO : Add flash message
                Application::$app->response->redirect("./?deleted=true");
                Application::$app->logout();
                return;
            }
        }
    }
?>